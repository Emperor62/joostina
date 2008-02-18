<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2007 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/copyleft/gpl.html GNU/GPL, �������� LICENSE.php
* Joostina! - ��������� ����������� �����������. ��� ������ ����� ���� ��������
* � ������������ � ����������� ������������ ��������� GNU, ������� ��������
* � ���������� ��������������� � ������� ���������� ������, ����������������
* �������� ����������� ������������ ��������� GNU ��� ������ �������� ���������
* �������� ��� �������� � �������� �������� �����.
* ��� ��������� ������������ � ��������� �� ��������� �����, �������� ���� COPYRIGHT.php.
*/


// ��������� ����� ������������� �����
define( "_VALID_MOS", 1 );


// ����������� common.php
require_once( 'common.php' );
require_once( '../includes/database.php' );

$DBhostname = mosGetParam( $_POST, 'DBhostname', '' );
$DBuserName = mosGetParam( $_POST, 'DBuserName', '' );
$DBpassword = mosGetParam( $_POST, 'DBpassword', '' );
$DBname          = mosGetParam( $_POST, 'DBname', '' );
$DBPrefix          = mosGetParam( $_POST, 'DBPrefix', '' );
$DBDel          = intval( mosGetParam( $_POST, 'DBDel', 0 ) );
$DBBackup          = intval( mosGetParam( $_POST, 'DBBackup', 0 ) );
$DBSample        = intval( mosGetParam( $_POST, 'DBSample', 0 ) );
$DBcreated        = intval( mosGetParam( $_POST, 'DBcreated', 0 ) );
$DBold          = intval( mosGetParam( $_POST, 'DBold', 0 ) );
$DBexp      = intval( mosGetParam( $_POST, 'DBexp', 0 ) );
$BUPrefix = 'old_';
$configArray['sitename'] = trim( mosGetParam( $_POST, 'sitename', '' ) );
$database = null;

$errors = array();
if (!$DBcreated){
	if (!$DBhostname || !$DBuserName || !$DBname) {
		db_err ('stepBack3','���� ������� �������� ������ � �� MySQL ��� �� ��������� ����������� ���� �����.');
	}

	if($DBPrefix == '') {
		db_err ('stepBack','�� ������ �� ������� ������� ���� ������.');
	}

	$database = new database( $DBhostname, $DBuserName, $DBpassword, '', '', false );
	$test = $database->getErrorMsg();

	if (!$database->_resource) {
		db_err ('stepBack2','������� �������� ��� ������������ � ������.');
	}

	// Does this code actually do anything???
	$configArray['DBhostname'] = $DBhostname;
	$configArray['DBuserName'] = $DBuserName;
	$configArray['DBpassword'] = $DBpassword;
	$configArray['DBname']	 = $DBname;
	$configArray['DBPrefix']	= $DBPrefix;

	// ��������� ������ ������ MySQL
	if(!$DBold)
	// ��� ������� ������ MySQL
		$sql = "CREATE DATABASE `$DBname` DEFAULT CHARACTER SET cp1251 COLLATE cp1251_general_ci";
	else
	// ��� ������� ������ MySQL
		$sql = "CREATE DATABASE `$DBname`";

	$database->setQuery( $sql );
	$database->query();
	$test = $database->getErrorNum();

	if ($test != 0 && $test != 1007) {
		db_err( 'stepBack', '������ �������� ������: ' . $database->getErrorMsg() );
	}

	// �������� ����� ���������� �� � ������ ������������
	$database = new database( $DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix );

	// �������� ������������ ������ (���� ������)
	if ($DBDel) {
		$query = "SHOW TABLES FROM `$DBname`";
		$database->setQuery( $query );
		$errors = array();
		if ($tables = $database->loadResultArray()) {
			foreach ($tables as $table) {
				if (strpos( $table, $DBPrefix ) === 0) {
					if ($DBBackup) {
						$butable = str_replace( $DBPrefix, $BUPrefix, $table );
						$query = "DROP TABLE IF EXISTS `$butable`";
						$database->setQuery( $query );
						$database->query();
						if ($database->getErrorNum()) {
							$errors[$database->getQuery()] = $database->getErrorMsg();
						}
						$query = "RENAME TABLE `$table` TO `$butable`";
						$database->setQuery( $query );
						$database->query();
						if ($database->getErrorNum()) {
							$errors[$database->getQuery()] = $database->getErrorMsg();
						}
					}
					$query = "DROP TABLE IF EXISTS `$table`";
					$database->setQuery( $query );
					$database->query();
					if ($database->getErrorNum()) {
						$errors[$database->getQuery()] = $database->getErrorMsg();
					}
				}
			}
		}
	}
		// ��������� ������ ������ MySQL
		if($DBexp)
			//����������������� ��� ������
			populate_db( $database, 'joostina_exp.sql' );
		elseif(!$DBold)
			// ��� ������� ������ MySQL
			populate_db( $database, 'joostina.sql' );
		else
			populate_db( $database, 'joostina_old.sql' );

		if ($DBSample) {
			populate_db( $database, 'sample_data.sql' );
		}
			$DBcreated = 1;
		}

function db_err($step, $alert) {
	global $DBhostname,$DBuserName,$DBpassword,$DBDel,$DBname;
	echo "<form name=\"$step\" method=\"post\" action=\"install1.php\">
	<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\">
	<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\">
	<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\">
	<input type=\"hidden\" name=\"DBDel\" value=\"$DBDel\">
	<input type=\"hidden\" name=\"DBname\" value=\"$DBname\">
	</form>\n";
	echo "<script>alert(\"$alert\"); document.location.href='install1.php';</script>";
	exit();
}

/**
 * @param object
 * @param string File name
 */
function populate_db( &$database, $sqlfile='mambo.sql') {
	global $errors,$DBold;
	// ��������� � '���������� �����'
	if(!$DBold) $database->setQuery( "SET NAMES 'cp1251'" );

	$database->query();
	$mqr = @get_magic_quotes_runtime();
	@set_magic_quotes_runtime(0);
	$query = fread( fopen( 'sql/' . $sqlfile, 'r' ), filesize( 'sql/' . $sqlfile ) );
	@set_magic_quotes_runtime($mqr);
	$pieces  = split_sql($query);

	for ($i=0; $i<count($pieces); $i++) {
		$pieces[$i] = trim($pieces[$i]);
		if(!empty($pieces[$i]) && $pieces[$i] != "#") {
			$database->setQuery( $pieces[$i] );
			if (!$database->query()) {
				$errors[] = array ( $database->getErrorMsg(), $pieces[$i] );
			}
		}
	}
}

/**
 * @param string
 */
function split_sql($sql) {
	$sql = trim($sql);
	$sql = ereg_replace("\n#[^\n]*\n", "\n", $sql);

	$buffer = array();
	$ret = array();
	$in_string = false;

	for($i=0; $i<strlen($sql)-1; $i++) {
		if($sql[$i] == ";" && !$in_string) {
			$ret[] = substr($sql, 0, $i);
			$sql = substr($sql, $i + 1);
			$i = 0;
		}

		if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
			$in_string = false;
		}
		elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
			$in_string = $sql[$i];
		}
		if(isset($buffer[1])) {
			$buffer[0] = $buffer[1];
		}
		$buffer[1] = $sql[$i];
	}

	if(!empty($sql)) {
		$ret[] = $sql;
	}
	return($ret);
}

$isErr = intval( count( $errors ) );

echo "<?xml version=\"1.0\" encoding=\"windows-1251\"?".">";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Joostina - Web-���������. ��� 2 ...</title>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="shortcut icon" href="../images/favicon.ico" />
 <link rel="stylesheet" href="install.css" type="text/css" />
 <script type="text/javascript">
<!--
function check() {
	// �������� ������������ ���������� �����
	var formValid = true;
	var f = document.form;
	if ( f.sitename.value == '' ) {
		alert('������� �������� ������ �����');
		f.sitename.focus();
		formValid = false
	}
	return formValid;
}
//-->
 </script>
</head>
<body onload="document.form.sitename.focus();">
 <div id="wrapper">
  <div id="header">
   <div id="joomla"><img src="header_install.png" alt="��������� Joostina" /></div>
  </div>
 </div>

 <div id="ctr" align="center">
  <form action="install3.php" method="post" name="form" id="form" onsubmit="return check();">
   <input type="hidden" name="DBhostname" value="<?php echo "$DBhostname"; ?>" />
   <input type="hidden" name="DBuserName" value="<?php echo "$DBuserName"; ?>" />
   <input type="hidden" name="DBpassword" value="<?php echo "$DBpassword"; ?>" />
   <input type="hidden" name="DBname" value="<?php echo "$DBname"; ?>" />
   <input type="hidden" name="DBPrefix" value="<?php echo "$DBPrefix"; ?>" />
   <input type="hidden" name="DBcreated" value="<?php echo "$DBcreated"; ?>" />
   <input type="hidden" name="DBold" value="<?php echo "$DBold"; ?>" />
   <div class="install">
    <div id="stepbar">
     <div class="step-off">�������� �������</div>
     <div class="step-off">��������</div>
     <div class="step-off">��� 1</div>
     <div class="step-on">��� 2</div>
     <div class="step-off">��� 3</div>
     <div class="step-off">��� 4</div>
    </div>
    <div id="right">
     <div class="far-right">
      <?php if (!$isErr) { ?>
      <input class="button" type="submit" name="next" value="����� >>"/>
      <?php } ?>
     </div>
     <div id="step">��� 2</div>
     <div class="clr"></div>

     <h1>������� �������� ������ �����:</h1>
     <div class="install-text">
      <?php if ($isErr) { ?>
      ��������� ������ ��� ������� ������ � ���� ���� ������!<br />
      ����������� ��������� ����������!
      <?php } else { ?>
      ��� ������������ ��� �������������� �������� ��������� �� ����������� ����� � ����� ������������ � ��������� �����.
      <?php } ?>
     </div>
     <div class="install-form">
      <div class="form-block">
	<?php
	 if ($isErr) {
	 echo '<tr><td colspan="2">';
	 echo '<b></b>';
	 echo "<br/><br />������:<br />\n";
	 // �����
	 echo '<textarea rows="20" cols="60">';
	 foreach($errors as $error) {
	 echo "SQL=$error[0]:\n- - - - - - - - - -\n$error[1]\n= = = = = = = = = =\n\n";
	 }
	 echo '</textarea>';
	 echo "</td></tr>\n";
	 } else {
	?>
       <table class="content2">
	<tr>
	 <td width="100">�������� �����</td>
	 <td align="center"><input class="inputbox" type="text" name="sitename" size="40" value="<?php echo "{$configArray['sitename']}"; ?>" /></td>
	</tr>
	<tr>
	 <td width="100">&nbsp;</td>
	 <td align="center" class="small">��������: ��� ����� ����!</td>
	</tr>
       </table>
       <?php
	} // if
       ?>
      </div>
     </div>
     <div class="clr"></div>
     <div id="break"></div>
    </div>
    <div class="clr"></div>
  </form>
</div>
  <div class="clr"></div>
 <div class="ctr" id="footer"><a href="http://www.Joostina.ru" target="_blank">Joostina</a> - ��������� ����������� �����������, ���������������� �� �������� GNU/GPL.</div>
</body>
</html>
