<?php
/**
* @package Joostina
* @copyright Авторские права (C) 2007 Joostina team. Все права защищены.
* @license Лицензия http://www.gnu.org/copyleft/gpl.html GNU/GPL, смотрите LICENSE.php
* Joostina! - свободное программное обеспечение. Эта версия может быть изменена
* в соответствии с Генеральной Общественной Лицензией GNU, поэтому возможно
* её дальнейшее распространение в составе результата работы, лицензированного
* согласно Генеральной Общественной Лицензией GNU или других лицензий свободных
* программ или программ с открытым исходным кодом.
* Для просмотра подробностей и замечаний об авторском праве, смотрите файл COPYRIGHT.php.
*/
require(dirname(__FILE__).'/../../../die.php');

// Constants
define("_DBPACKER_TABLES_CORE", 1);
define("_DBPACKER_TABLES_SAMPLE_DATA", 2);

global $DBPACKER_CORE_TABLES, $DBPACKER_OMIT_DATA;

// These are defined in the original joomla.sql file
$DBPACKER_CORE_TABLES = array(
	"#__groups", "#__mambots", "#__menu", "#__modules", "#__modules_menu", "#__templates_menu", "#__template_positions", "#__usertypes", "#__core_acl_aro_groups", "#__core_acl_aro_sections"
);

// These are the temporary tables of Joomla! Pack that shouldn't be dumped
$DBPACKER_OMIT_DATA = array(
	"#__jp_packvars"
);

class CDBBackupEngine {

	/**
     * Stores the results of JoomFish detection
     * @access private
     * @var boolean
     */
	var $_hasJoomFish;

	/**
     * The prefix used in the MySQL database for Joomla! table (i.e. "jos_");
     * @access private
     * @var string
     */
	var $_dbprefix;

	/**
     * Have we finished processing our task?
     * @access private
     * @var boolean
     */
	var $_isFinished;

	/**
     * SQL compatibility level
     * @access private
     * @var string
     */
	var $_sqlMode;

	/**
     * Database status table
     * @access private
     * @var array
     */
	var $_all_tables;

	/**
     * Next table to pack
     * @access private
     * @var string
     */
	var $_nextTable;

	/**
     * Starting row to pack
     * @access private
     * @var string
     */
	var $_nextRange;

	/**
     * Next tables maximum data range
     * @access private
     * @var long
     */
	var $_maxRange;

	/**
     * Filename of dump file : core tables
     * @access private
     * @var string
     */
	var $_filenameCore;

	/**
     * Filename of dump file : sample data table
     * @access private
     * @var string
     */
	var $_filenameSample;

	/**
     * We are only dumping the database, not the entire site if this is true
     * @access private
     * @var boolean
     */
	var $_onlyDBDumpMode;

	/**
	 * Created the DB Backup Engine instance
	 * @param boolean $onlyDBDumpMode If true, notifies the engine that we are backing up only the database and not the entire site.
	 */
	function CDBBackupEngine( $onlyDBDumpMode = false ){
		global $mosConfig_absolute_path, $mosConfig_dbprefix;
		global $JPConfiguration, $database;

		// SECTION 1.
		// Populate basic global variables
		// =====================================================================
		CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: new instance");
		// Initialize private variables
		$this->_onlyDBDumpMode = $onlyDBDumpMode;
		$this->_dbprefix = $mosConfig_dbprefix;
		// Detect JoomFish
		if (file_exists($mosConfig_absolute_path . '/administrator/components/com_joomfish/config.joomfish.php')) {
			$this->_hasJoomFish = true;
		} else {
			$this->_hasJoomFish = false;
		}
		// Indicate we are not done yet
		$this->_isFinished = false;
		// Fetch SQL compatibility level
		$this->_sqlMode = $JPConfiguration->MySQLCompat;

		// SECTION 2.
		// Fetch information about tables
		// =====================================================================
		CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: Populating 'All Tables' array");
		// Populate _all_tables array
		$sql = "show tables";
		$database->setQuery( $sql );
		$database->query();

		$this->_all_tables = $database->loadResultArray();

		// SECTION 3.
		// Initialize the algorithm
		// =====================================================================
		// Define where to store the files
		$folderPath = $JPConfiguration->TempDirectory;
		if ($this->_onlyDBDumpMode) {
			CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: Only dump database mode detected");
			$this->_filenameCore = $this->_getSQLOnlyFile();
			$this->_filenameSample = $this->_filenameCore;
		} else {
			if ($JPConfiguration->AltInstaller->SQLDumpMode == "split") {
				CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: Split files detected");
				$this->_filenameCore = $folderPath . "/joomla.sql";
				$this->_filenameSample = $folderPath . "/sample_data.sql";
			} else {
				CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: Single file detected");
				$this->_filenameCore = $folderPath . "/" .$JPConfiguration->AltInstaller->BaseDump;
				$this->_filenameSample = $folderPath . "/" . $JPConfiguration->AltInstaller->BaseDump;
			}
		}

		$this->_filenameCore = $JPConfiguration->TranslateWinPath( $this->_filenameCore );
		$this->_filenameSample = $JPConfiguration->TranslateWinPath( $this->_filenameSample );

		CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: Core SQL file is " . $this->_filenameCore);
		CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: Sample SQL file is " . $this->_filenameSample);

		// Delete leftover files
		CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: Deleting leftover files, if any");
		@unlink( $this->_filenameCore );
		@unlink( $this->_filenameSample );

		// Initialize with the first table, offset
		CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: Initializing algorithm for first run");
		$this->_nextTable = $this->_all_tables[0];
		$this->_nextRange = 0;
	}

	function tick(){
		global $database;
		$out =''; // joostina pach
		if ($this->_isFinished) {
			// Indicate we're done
			CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: Already finished");
			return $this->_returnTable( true );
		} else {
			// Enforce SQL compatibility
			CJPLogger::WriteLog(_JP_LOG_DEBUG, "CDBBackupEngine :: Enforcing SQL compatibility");
			$this->_connectDatabase();
			$RowsPerStep = 100;
			// Do we have more data on the current table? Try to find only if
			// it's not the first pass to the table...
			if ( ($this->_nextRange > 0) ) {
				if ( $this->_nextRange >= $this->_maxRange) {
					CJPLogger::WriteLog(_JP_LOG_DEBUG, "Done with " . $this->_nextTable);
					// We are done with this table, get next table
					$boolFound = false;
					$nextTable = ""; // this is a check variable to trigger end-of-dumping condition when left empty
					foreach($this->_all_tables as $aTable){
						if ($boolFound) {
							$boolFound = false;
							$this->_nextTable = $aTable;
							$this->_nextRange = 0;
							$nextTable = $this->_nextTable;
							break;
						}
						if ($this->_nextTable == $aTable) {
							$boolFound = true;
						}
					}
					if ($nextTable == "") {
						CJPLogger::WriteLog(_JP_LOG_DEBUG, "Done backing up database");
						// If $nextTable is an empty string, we are done packing.
						$this->_isFinished = true;

						if (!($this->_onlyDBDumpMode)) {
							// Add a new fragment with the dump files
							$fileList = array();
							$fragmentSize = 0;

							$filename = $this->_filenameCore;
							$filesize = filesize( $filename );
							$fragmentSize += $filesize;
							$fileList[] = $filename;

							if ($this->_filenameCore != $this->_filenameSample) {
								$filename = $this->_filenameSample;
								$filesize = filesize( $filename );
								$fragmentSize += $filesize;
								$fileList[] = $filename;
							}

							$fragmentDescriptor = array();
							$fragmentDescriptor['type'] = "sql";
							$fragmentDescriptor['size'] = $fragmentSize;
							$fragmentDescriptor['files'] = $fileList;

							$serializedDescriptor = serialize($fragmentDescriptor);

							$sql = 'SELECT COUNT(*) FROM #__jp_packvars WHERE `key` LIKE "fragment%"';
							$database->setQuery( $sql );
							$currentNode = $database->loadResult();
							$currentNode++;

							$sql = "INSERT INTO #__jp_packvars (`key`, value2) VALUES (\"" . mysql_escape_string("fragment$currentNode") . "\", \"" . mysql_escape_string( $serializedDescriptor ) . "\")";
							$database->setQuery( $sql );
							$database->query();

							CJPLogger::WriteLog(_JP_LOG_DEBUG, "Added new fragment with SQL files");
						}

						// Return OK result
						return $this->_returnTable( true );
					} else {
						// TO-DO : Have the resulting SQL file emailed to the user
					}
				}
			}

			// Define the backup file type we should use
			$abstracttablename = $this->_getTableAbstractName( $this->_nextTable );
			if ( $this->_isCoreTable( $abstracttablename ) ) {
			 	$fileName = $this->_filenameCore;
			 	CJPLogger::WriteLog(_JP_LOG_INFO, "Core table : " . $this->_nextTable);
			} else {
				$fileName = $this->_filenameSample;
			}

			// set max string size before writing to file
			/*
			if (@ini_get("memory_limit")) $max_size=0.6 * ini_get("memory_limit") - memory_get_usage();
				else $max_size=1024000;
			*/
			$max_size = 250000;

			$tablename=$this->_nextTable;

			// First pass on a table
			// This is not an "else" on the if many lines above because we might have run on a new table from that code!
			if ($this->_nextRange == 0) {
				CJPLogger::WriteLog(_JP_LOG_DEBUG, "First pass on " . $this->_nextTable);
				// Get table's maximum range on first run

				$sql = "SELECT COUNT(*) FROM $abstracttablename";
				$database->setQuery( $sql );
				//$database->query();
				$this->_maxRange = $this->_hasJoomFish ? $database->loadResult(false) : $database->loadResult();

				CJPLogger::WriteLog(_JP_LOG_DEBUG, "Rows on " . $this->_nextTable . " : " . $this->_maxRange);

				// Retrieve its definition
				$sql = "SHOW CREATE TABLE `$abstracttablename`";
				$database->setQuery( $sql );
				$database->query();
				$temp = $database->loadAssocList();
				$tablesql = $temp[0]['Create Table'];
				unset( $temp );
				$tablesql = str_replace( $this->_dbprefix, "#__", $tablesql );
				$tablesql = str_replace( "\n", " ", $tablesql ); // FIX 1.0.3.4 -- Eat newlines

				$out .= $tablesql;
				$out.=" ;\n";

				CJPLogger::WriteLog(_JP_LOG_DEBUG, "Output definition for " . $this->_nextTable);
			}

			if ( $abstracttablename == "#__jp_packvars" ) {
				// Skip JoomlaPack's temporary tables
				CJPLogger::WriteLog(_JP_LOG_INFO, "Skipping table " . $this->_nextTable);
				$this->_nextRange = $this->_maxRange + 1;
				$numRows = 0;// joostina pach
			} else {
				// Dump data if not a JoomlaPack temporary table

				$sql = "select * from `".$abstracttablename."`";
				$database->setQuery( $sql, $this->_nextRange, $RowsPerStep );
				$database->query();

				$numRows = $database->getNumRows();

				CJPLogger::WriteLog(_JP_LOG_DEBUG, "Dumping $numRows rows of " . $this->_nextTable);

				for ( $j=0; $j < $numRows; $j++ ) {
					$out .= "insert into `" . $abstracttablename . "` values (";
					$row2 = mysql_fetch_row( $database->_cursor );
					// run through each field
					$nf = mysql_num_fields(  $database->_cursor );
					for ($k=0; $k < $nf; $k++) {
						// FIX 1.0.3.4 -- Double slashes with magic_quotes_runtime set to on
						if (!is_null($row2[$k])) {
							if (get_magic_quotes_runtime()) {
								$value = stripslashes( $row2[$k] );
							} else {
								$value = $row2[$k];
							}
							$value ="'" . mysql_real_escape_string($value, $database->_resource) . "'";
						} else {
							$value = "null";
						}
						$out .= $value;
						if ($k<($nf-1)) $out .=", ";
					}
					$out .=");\n";

					// if saving is successful, then empty $out, else set error flag
					if (strlen($out)>=$max_size) {
						if ( $this->_save_to_file($fileName,$out,"a") ) {
							$out="";
						} else {
							CJPLogger::WriteLog(_JP_LOG_ERROR, "Could not open $fileName for writing database backup");
							return $this->_returnTable( false, $this->_nextTable, $this->_nextRange, $this->_maxRange, "Could not save to dump file $fileName" );
						}
					}
				}
				mysql_free_result( $database->_cursor );
			}

			// Increment _nextRange pointer. If it was an empty table increase by one
			// so that the algorigthm can skip over to the next table
			$this->_nextRange += ($numRows == 0) ? 1 : $numRows;

			// Save to file
			if ($this->_save_to_file( $fileName, $out, "a" )) {
				return $this->_returnTable( false, $this->_nextTable, $this->_nextRange, $this->_maxRange );
			} else {
				// Failed to write to the dump file
				$this->_isFinished = true;
				CJPLogger::WriteLog(_JP_LOG_ERROR, "Could not open $fileName for writing database backup");
				return $this->_returnTable( false, $this->_nextTable, $this->_nextRange, $this->_maxRange, "Could not save to dump file $fileName" );
			}
		}
	}

	/**
	* Returns an abstracted table name, i.e. 'jos_users' is transformed to '#__users'
	* @param string $tableName The name of the table
	* @return string
	*/
	function _getTableAbstractName( $tableName ) {
		return str_replace( $this->_dbprefix, "#__", $tableName );
	}

	/**
	* Enforces the user selected SQL compatibility mode
	*/
	function _connectDatabase(){
		// set sql_mode allows exporting SQL files for different versions of MySQL
		if (($this->_sqlMode != null) && ($this->_sqlMode != "") && ($this->_sqlMode != "default")) {
			$res = @mysql_query("SET SESSION sql_mode='HIGH_NOT_PRECEDENCE,NO_TABLE_OPTIONS'");
			unset($res);
		} else {
			$res = @mysql_query("SET SESSION sql_mode=''");
			unset($res);
		}
	}

	/**
	* Saves the string in $fileData to the file $backupfile. Returns TRUE. If saving failed, return value is FALSE.
	* @param string $backupfile Name of backup file
	* @param string $fileData Data to write
	* @param string $mode PHP file mode used in writing to file
	* @return boolean
	*/
	function _save_to_file($backupfile,$fileData,$mode) {
		if ($zp=fopen($backupfile, $mode)) {
			fwrite($zp,$fileData);
			fclose($zp);
			return true;
		} else {
			return false;
		}
	}

	/**
	* Makes the return table (used by CUBE to determine what has happened during the run
	* @return array A CUBE return table
	*/
	function _returnTable( $finished, $table = "", $range = "", $maxRange = "", $error = null ) {
		$returnArray = array();
		$returnArray['HasRun'] = !$finished;
		if ($finished) {
			$this->_all_tables = null;
			$this->_table_sql = null;
		}
		$returnArray['Domain'] = "PackDB";
		$returnArray['Step'] = $table;
		$returnArray['Substep'] = "$range / $maxRange";
		if (!is_null($error)) {
			$returnArray['Error'] = $error;
		}
		return $returnArray;
	}

	/**
	* Checks to see if a given table is a Joomla! core table. Shorta hack...
	* @param $abstractName string The abstracted table name we want to test
	* @return boolean TRUE if it is a core table, FALSE otherwise
	*/
	function _isCoreTable( $abstractName ){
		global $DBPACKER_CORE_TABLES;
		return in_array( $abstractName, $DBPACKER_CORE_TABLES );
	}

	function _getSQLOnlyFile() {
		global $JPConfiguration;
		// Get the proper extension
		$extension = ".sql";
		$templateName = $JPConfiguration->TarNameTemplate;

		// Parse [DATE] tag
		$dateExpanded = strftime("%Y%m%d", time());
		$templateName = str_replace("[DATE]", $dateExpanded, $templateName);

		// Parse [TIME] tag
		$timeExpanded = strftime("%H%M%S", time());
		$templateName = str_replace("[TIME]", $timeExpanded, $templateName);

		// Parse [HOST] tag
		$templateName = str_replace("[HOST]", $_SERVER['SERVER_NAME'], $templateName);

		return $JPConfiguration->OutputDirectory . "/" . $templateName . $extension;
	}
}

?>