<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2007 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� LICENSE.php
* Joostina! - ��������� ����������� ����������� ��������������� �� �������� ��������� GNU/GPL
* ��� ��������� ������������ � ��������� �� ��������� �����, �������� ���� COPYRIGHT.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();


////////////////////////////////////////////////////////////////
// Execute sql query and display grid
////////////////////////////////////////////////////////////////
function ExecSQL($task = 'execsql') {
	global $database,$mosConfig_db;

	$nDisplayRecords	= intval(mosGetParam($_POST,'easysql_records',10));

	if($task == 'execsql') {
		$cCurrentTable	= mosGetParam($_POST,'easysql_table','');
		$cCurrentSQL	= mosGetParam($_POST,'easysql_query',mosGetParam($_GET,'prm2',''));
		$cCurrentSQL	= stripslashes($cCurrentSQL);
	} else {
		$cCurrentTable	= base64_decode(mosGetParam($_POST,'easysql_table',''));
		$cCurrentSQL	= base64_decode(mosGetParam($_POST,'easysql_query',mosGetParam($_GET,'prm2','')));
		$cCurrentSQL	= stripslashes($cCurrentSQL);
	}

	// Get table list
	$database->setQuery('SHOW TABLES');
	$tables = $database->loadAssocList();

	if(!empty($tables)) {
		$key = 'Tables_in_'.$mosConfig_db;
		$htmTablesList = '';
		foreach($tables as $val) {
			if($val[$key] == $cCurrentTable)
				$_sel = 'selected';
			else
				$_sel = '';
			$htmTablesList .= '<OPTION '.$_sel.' VALUE="'.$val[$key].'">'.$val[$key].'</OPTION>';
		}
	}

	// Header
	$htmTableHeader = '';
	if(!empty($cCurrentSQL)) {
		$database->setQuery($cCurrentSQL);
		$rows = $database->loadAssocList();
		if(!empty($rows)) {
			$aTableHeader = array();
			foreach($rows[0] as $key => $val) {
				$aTableHeader[] = $key;
			}
		}
	} else{
		$rows = array();
	};
	$htmTableData = '';
	if(!empty($cCurrentSQL)) {
			if(trim($cCurrentSQL) != '') $htmTableData .= record_html($cCurrentSQL);
	}

?>

<script language="javascript" type="text/javascript">
<!--
function changeQuery(thiz) {
	limit = 'LIMIT ' + document.getElementById('easysql_records').value;
	sel = document.getElementById('easysql_sel').value;
	if (sel!='SELECT* FROM ') limit='';
	table = '';
	if  (sel=='SELECT* FROM ' ||
		sel=='SHOW KEYS FROM ' || 
		sel=='SHOW FIELDS FROM ' || 
		sel=='REPAIR TABLE ' || 
		sel=='OPTIMIZE TABLE ' || 
		sel=='CHECK TABLE ' ||
		sel=='SHOW FULL COLUMNS FROM ' ||
		sel=='SHOW INDEX FROM ' ||
		sel=='SHOW TABLE STATUS ' ||
		sel=='SHOW CREATE TABLE ' ||
		sel=='ANALYZE TABLE ') 
		table=document.getElementById('easysql_table').value+' '+limit;
	document.getElementById('easysql_query').value=sel+table;
}
//-->
</script>

<form id="adminForm" action="index2.php?option=com_easysql" method="post" name="adminForm">
<table border=0 cellsppacing=0 cellpadding=5 width=100%>
<tr>
	<td>
		�������:<select id="easysql_sel" class="text_area" onchange="changeQuery(this);">
		<option value="SELECT* FROM ">SELECT*</option>
		<option value="SHOW DATABASES ">SHOW DATABASES~</option>
		<option value="SHOW TABLES ">SHOW TABLES~</option>
		<option value="SHOW FULL COLUMNS FROM ">SHOW COLUMNS</option>
		<option value="SHOW INDEX FROM ">SHOW INDEX</option>
		<option value="SHOW TABLE STATUS ">SHOW TABLE STATUS~</option>
		<option value="SHOW STATUS ">SHOW STATUS~</option>
		<option value="SHOW VARIABLES ">SHOW VARIABLES</option>
		<option value="SHOW LOGS ">SHOW LOGS (BDB - Berkeley DB)</option>
		<option value="SHOW FULL PROCESSLIST ">SHOW PROCESSLIST</option>
		<option value="SHOW GRANTS FOR ">SHOW GRANTS FOR username</option>
		<option value="SHOW CREATE TABLE ">SHOW CREATE TABLE</option>
		<option value="SHOW MASTER STATUS ">SHOW MASTER STATUS</option>
		<option value="SHOW MASTER LOGS ">SHOW MASTER LOGS</option>
		<option value="SHOW SLAVE STATUS ">SHOW SLAVE STATUS</option>
		<option value="SHOW KEYS FROM ">SHOW KEYS</option>
		<option value="SHOW FIELDS FROM ">SHOW FIELDS</option>
		<option value="REPAIR TABLE ">REPAIR TABLE</option>
		<option value="OPTIMIZE TABLE ">OPTIMIZE TABLE</option>
		<option value="CHECK TABLE ">CHECK TABLE</option>
		<option value="ANALYZE TABLE ">ANALYZE TABLE</option>
		</select> &nbsp; &nbsp; �������:
		<select class="text_area" id="easysql_table" name="easysql_table" onchange="changeQuery(this);">
		<?php echo $htmTablesList; ?>
		</select> &nbsp; &nbsp; ������� �����:
		<input class="text_area" type="text" id="easysql_records" name="easysql_records" value="<?php echo $nDisplayRecords; ?>" size=2 onchange="changeQuery(this)">&nbsp;&nbsp;&nbsp;
		<input class="button" type="button" value="������� SQL" onclick="changeQuery(this)" name="crsql"/>
	</td>
</tr>
<tr>
	<td>
		<textarea class="text_area" id="easysql_query" name="easysql_query" style="width:100%;height:150px;"><?php echo $cCurrentSQL; ?></textarea>
		<input type="hidden" name="task" value="">
	</td>
</tr>
</table>
<?php echo $htmTableData; ?>
</form>

<?php
}


////////////////////////////////////////////////////////////////
// Make grid table from result query
////////////////////////////////////////////////////////////////
function is_table($table) {
	global $database;
	$tables = $database->getTableList();
	$table = str_replace("#__",$database->_table_prefix,$table);
	return (strpos(implode(";",$tables),$table) > 0);
}


function Record_HTML($query) {
	global $database;
	// trim long query for output
	$show_query = (strlen(trim($query)) > 100) ? substr($query,0,100).'...':$query;
	// exec query
	$database->setQuery($query);
	$rows = $database->loadAssocList();
	$body = '<div class="c_sql">SQL: '.$show_query.'</div>';
	$table = TableFromSQL($query); // get table name from query string
	$_sel = (substr(strtolower($query),0,6) == 'select');
	// If return rows then display table
	if(!empty($rows)) {
		// Begin form and table
		$body .= '<div style="overflow: auto;"><table class="adminlist">';
		$body .= "<thead><tr>\n";
		// Display table header
		if($_sel) $body .= '<th>����������</th>';
		$k_arr = $rows[0];
		$f = 1;
		$key = '';
		foreach($k_arr as $var => $val) {
			if($f) {
				$key = $var;
				$f = 0;
			}
			if(ereg("[a-zA-Z]+",$var,$array)) $body .= '<th>'.$var."</th>\n";
		}
		$body .= "</tr></thead>\n";
		// Get unique field of table
		$uniq_fld	= (is_table($table)) ? GetUniqFld($table):'';
		$key		= empty($uniq_fld) ? $key:$uniq_fld;
		// Display table rows
		$k = 0;
		$i = 0;
		foreach($rows as $row) {
			$body .= '<tbody><tr valign=top class="row'.$k.'">';
			if($_sel) $body .= '<td align=center nowrap>
					<a onclick="this.href=\'index2.php?option=com_easysql&task=edit&hidemainmenu=1&prm1='.
					base64_encode($table).'&key='.$key.'&id='.$row[$key].'&prm2='.base64_encode($query).
					'\';" href="#">	<img border=0 src="../images/M_images/edit.png" alt="�������������" /></a>&nbsp;
					<a onclick="if (confirm(\'������� ��� ������ ?\')) {this.href=\'index2.php?option=com_easysql&task=delete&prm1='.
					base64_encode($table).'&key='.$key.'&id='.$row[$key].'&prm2='.base64_encode($query).
					'\'};" href="#"><img border=0 src="images/publish_x.png" alt="�������" /></a></td>';
			foreach($row as $var => $val) {
				if(ereg("[a-zA-Z]+",$var,$array)) $body .= '<td>&nbsp;'.prepare(substr($val,0,50))."</td>\n";
			}
			$body .= "</tbody></tr>\n";
			$k = 1 - $k;
			$i++;
		}
		// End table and form
		$body .= '</table><br></div>';
		$body .= '<input type="hidden" name="key" value="'.$key.'">';
	} else {
		// Display DB errors
		$body .= '<small style="color:red;">'.$database->_errorMsg.'</small><br/>';
	}
	return $body.'<br/>';
}

// ���������� ������ � �����������
function prepare( $text ) {
	$text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text ); // ������� �������
	$text = preg_replace( '/{.+?}/', '', $text); // ������� �����������
	$text = preg_replace( "'<(br[^/>]*?/|hr[^/>]*?/|/(div|h[1-6]|li|p|td))>'si", ' ', $text ); // ������ ������ ����
	$text = preg_replace("/<img.+?>/", "", $text);
	$text = strip_tags($text); // ������ ��� ���������� ����
	return $text;
}

////////////////////////////////////////////////////////////////
// Get unique field of table
////////////////////////////////////////////////////////////////
function GetUniqFld($table) {
	global $database;

	$database->setQuery('SHOW KEYS FROM '.$table);
	$indexes = $database->loadAssocList();

	$uniq_fld = '';
	if(!empty($indexes))
		foreach($indexes as $index)
			if($index['Non_unique'] == 0) {
				$uniq_fld = $index['Column_name'];
				break;
			}
	return $uniq_fld;
}


////////////////////////////////////////////////////////////////
// Get table name from query
////////////////////////////////////////////////////////////////
function TableFromSQL($sql) {
	$in = strpos(strtolower($sql),'from ') + 5;
	$end = strpos($sql,' ',$in);
	$end = empty($end)?strlen($sql):$end; // If table name in query end
	return substr($sql,$in,$end - $in);
}

////////////////////////////////////////////////////////////////
// Display page for editing record of grid
////////////////////////////////////////////////////////////////
function EditRecord($task,$table,$id) {
	global $database;
	$sql = base64_decode(mosGetParam($_GET,'prm2',null));
	$key = mosGetParam($_GET,'key',mosGetParam($_POST,'key',null));
	if($task == 'edit') {
		$get_fld_value = '$value = $rows[$id][$field];';
	} else {
		$table = mosGetParam($_POST,'easysql_table',null);
		$sql = mosGetParam($_POST,'easysql_query',null);
		$get_fld_value = '$value = "";';
	}
	if(!is_null($sql) && !is_null($key) && !is_null($task)) {
		$fields = $database->getTableFields(array($table));
		$database->setQuery($sql);
		$rows = $database->loadAssocList();
		$last_key_vol = $rows[count($rows) - 1][$key];
		if($task == 'edit') {
			foreach($rows as $row) $rows[$row[$key]] = $row;
		} else {
			$rows[0] = array();
		}
?>
<form id="adminForm" action="index2.php?option=com_easysql" method="post" name="adminForm">
	<table class="adminheading">
		<tr>
			<th>
				<?php echo "$table [ $key = $id ]"; ?>:<small><?php echo $task == 'edit' ? '��������������' : '��������'; ?></small>
			</th>
		</tr>
		</table>
		<table class="adminlist">
		<tr>
			<th colspan="2">����</th>
		</tr>
		<?php $k = 0;
		foreach($fields[$table] as $field => $type) { ?>
		<tr valign="top" class="row<?php echo $k; ?>">
			<td width="20%" class="key"><?php echo $field; ?>: <?php echo $key == $field ? "PK" : ""; ?></td>
			<td width="80%">
				<?php
			if(($key == $field) && ($task == 'edit')) {
				echo $id.GetHtmlForType($field,'hidden',$id).' [ '.$type.' ]';
			} else {
				if(($key == $field) && ($task == 'new'))
					if(is_numeric($last_key_vol))
						$value = $last_key_vol + 1;
					else
						$value = $last_key_vol.'_1';
				else eval($get_fld_value);
				echo GetHtmlForType($field,$type,$value).' [ '.$type.' ]';
			}
?>
			</td>
		</tr>
		<?php $k = 1 - $k;
		} ?>
	</table>
	<INPUT TYPE="hidden" NAME="task" VALUE="">
	<INPUT TYPE="hidden" NAME="key" VALUE="<?php echo $key; ?>">
	<INPUT TYPE="hidden" NAME="easysql_table" VALUE="<?php echo base64_encode($table); ?>">
	<INPUT TYPE="hidden" NAME="easysql_query" VALUE="<?php echo base64_encode($sql); ?>">
</form>
<?php
	}
}
////////////////////////////////////////////////////////////////
// Save record
////////////////////////////////////////////////////////////////
function SaveRecord() {
	global $database;
	$table = base64_decode(mosGetParam($_POST,'easysql_table',null));
	$key = mosGetParam($_POST,'key',null);
	$sql = base64_decode(mosGetParam($_POST,'easysql_query',null));
	$fields = mosGetParam($_POST,'field',null);
	if((!is_null($table)) && !is_null($sql) && !is_null($fields)) {
		$sql_save = "UPDATE $table SET ";
		$i = 0;
		$comma = ', ';
		$cnt = count($fields);
		foreach($fields as $name => $val) {
			$i++;
			if($cnt <= $i) $comma = '';
			$sql_save .= "`$name`='".htmlspecialchars($val,ENT_QUOTES)."'".$comma;
		}
		$sql_save .= " WHERE $key='".$fields[$key]."'";
	}
	$database->setQuery($sql_save);
	//$database->loadResult();
	if(!$database->query()) {
		echo '<small style="color:red;">'.$database->getErrorMsg().'</small><br/>';
		return false;
	} else {
		return true;
	}
}
////////////////////////////////////////////////////////////////
// Create new record
////////////////////////////////////////////////////////////////
function InsertRecord() {
	global $database;
	$table = base64_decode(mosGetParam($_POST,'easysql_table',null));
	$sql = base64_decode(mosGetParam($_POST,'easysql_query',null));
	$fields = mosGetParam($_POST,'field',null);
	if((!is_null($table)) && !is_null($sql) && !is_null($fields)) {
		$i = 0;
		$comma = ', ';
		$cnt = count($fields);
		$sql_fields = '';
		$sql_values = '';
		foreach($fields as $name => $val) {
			$i++;
			if($cnt <= $i) $comma = '';
			$sql_fields .= "$name".$comma;
			$sql_values .= "'$val'".$comma;
		}
		$sql_insert = "INSERT INTO $table ($sql_fields) VALUES($sql_values)";
	}
	$database->setQuery($sql_insert);
	$database->loadAssocList();

	if(!empty($database->_errorMsg)) {
		echo '<small style="color:red;">'.$database->_errorMsg.'</small><br/>';
		return false;
	} else {
		return true;
	}
}

////////////////////////////////////////////////////////////////
// Delete record
////////////////////////////////////////////////////////////////
function DeleteRecord($table,$id) {
	global $database;
	$task = mosGetParam($_GET,'task',null);
	$sql = base64_decode(mosGetParam($_GET,'prm2',null));
	$key = mosGetParam($_GET,'key',null);
	if(!is_null($sql) && !is_null($key) && !is_null($task)) {
		$database->setQuery("DELETE FROM $table WHERE $key = '$id'");
		$database->loadAssocList();
		if(!empty($database->_errorMsg)) {
			echo '<small style="color:red;">'.$database->_errorMsg.'</small><br/>';
			break;
			return false;
		} else {
			return true;
		}
	}
}

////////////////////////////////////////////////////////////////
// Get html field for table type
////////////////////////////////////////////////////////////////
function GetHtmlForType($name,$type,$value) {
	$type = trim(eregi_replace('unsigned','',$type));
	switch(strtolower($type)) {
			//text
		case 'hidden':
			$ret = '<INPUT TYPE="hidden" NAME="field['.$name.']" value="'.$value.'">';
			break;
		case 'disabled':
			$ret = '<INPUT DISABLED TYPE="text" NAME="field['.$name.']" value="'.$value.
				'">';
			break;
		case 'char':
		case 'nchar':
			$ret = '<INPUT TYPE="text" NAME="field['.$name.']"  style="width:7%;" value="'.
				$value.'">';
			break;
		case 'varchar':
		case 'nvarchar':
			$ret = '<INPUT TYPE="text" NAME="field['.$name.']" style="width:40%;" value="'.
				$value.'">';
			break;
		case 'tinyblob':
		case 'tinytext':
		case 'blob':
		case 'text':
			$ret = '<TEXTAREA NAME="field['.$name.']" style="width:70%;">'.$value.
				'</TEXTAREA>';
			break;
		case 'mediumblob':
		case 'mediumtext':
		case 'longblob':
		case 'longtext':
			$ret = '<TEXTAREA NAME="field['.$name.']" style="width:70%;height:150px;">'.$value.
				'</TEXTAREA>';
			break;
			//int
		case 'bit':
		case 'bool':
			$ret = '<INPUT TYPE="checkbox" NAME="field['.$name.']">';
			break;
		case 'tinyint':
		case 'smallint':
		case 'mediumint':
		case 'integer':
		case 'int':
		case 'bigint':
		case 'datetime':
		case 'time':
			$ret = '<INPUT TYPE="text" NAME="field['.$name.']" style="width:15%;" value="'.
				$value.'">';
			break;
			//real
		case 'real':
		case 'float':
		case 'decimal':
		case 'numeric':
		case 'double':
		case 'double precesion':
			$ret = '<INPUT TYPE="text" NAME="field['.$name.']" style="width:15%;" value="'.
				$value.'">';
			break;
		default:
			return false;
	}
	return $ret;
}
?>