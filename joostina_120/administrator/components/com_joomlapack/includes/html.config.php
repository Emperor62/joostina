<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

global $JPConfiguration,$option;

$task	= mosGetParam($_REQUEST,'task','default');
$act	= mosGetParam($_REQUEST,'act','default');

?>
<table class="adminheading">
	<tr>
		<th class="config" nowrap rowspan="2">������������ ���������� ����������� ������</th>
	</tr>
</table>
<div class="message">���������� ��������: <?php echo colorizeWriteStatus($JPConfiguration->isConfigurationWriteable());?></div>
<form action="index2.php" method="post" name="adminForm">
	<table class="adminform">
		<tr align="center" valign="middle">
			<th colspan="2">�������� ���������</th>
		</tr>
		<tr class="row0">
			<td width="30%">������� ���������� �������:</td>
			<td><input class="inputbox" type="text" name="outdir" size="60" value="<?php echo $JPConfiguration->OutputDirectory; ?>" /></td>
		</tr>
		<tr class="row0">
			<td>�������� ������:</td>
			<td><input class="inputbox" type="text" name="tarname" size="60" value="<?php echo $JPConfiguration->TarNameTemplate; ?>" /></td>
		</tr>
		<tr class="row1">
			<td>������� ������� ����:</td>
			<td><?php outputLogLevel($JPConfiguration->logLevel); ?></td>
		</tr>
		<tr>
			<th colspan="2">�������������� ���������</th>
		</tr>
		<tr class="row1">
			<td>������� �������� ������:</td>
			<td><?php echo mosHTML::yesnoRadioList('sql_pref','class="inputbox"',$JPConfiguration->sql_pref); ?></td>
		</tr>
		<tr class="row0">
			<td>��� �������� ���� ������:</td>
			<td><?php outputSQLCompat($JPConfiguration->MySQLCompat); ?></td>
		</tr>
		<tr class="row1">
			<td>��������� ������:</td>
			<td><?php AlgorithmChooser($JPConfiguration->fileListAlgorithm,"fileListAlgorithm"); ?></td>
		</tr>
		<tr class="row0">
			<td>��������� ����:</td>
			<td><?php AlgorithmChooser($JPConfiguration->dbAlgorithm,"dbAlgorithm"); ?></td>
		</tr>
		<tr class="row1">
			<td>������ ������:</td>
			<td><?php AlgorithmChooser($JPConfiguration->packAlgorithm,"packAlgorithm"); ?></td>
		</tr>
		<tr class="row0">
			<td>������ ����� ���� ������:</td>
			<td><?php outputBoolChooser($JPConfiguration->sql_pack); ?></td>
		</tr>
	</table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="act" value="config" />
</form>
<?php

// ����������� ���������� ��������
function colorizeWriteStatus($status) {
	if($status) {
		return '<font color="green"><b>��������</b></font>';
	} else {
		return '<font color="red"><b>�� ��������</b></font>';
	}
}
// ��� �������� ���� ������
function outputSQLCompat($sqlcompat) {
	$options = array(array(
		"value" => "compat","desc" =>"� ������ ������������� � MySQL 4"),
			array(
		"value" => "default","desc" =>"�� ���������"));
	echo '<select class="inputbox" name="sqlcompat">';
	foreach($options as $choice) {
		$selected = ($sqlcompat == $choice['value'])?"selected":"";
		echo "<option value=\"".$choice['value']."\" $selected>".$choice['desc']."</option>";
	}
	echo '</select>';
}
// ���� ������
function outputBoolChooser($boolOption) {
	echo '<select class="inputbox" name="sql_pack">';
		$selected = ($boolOption == "0")?"selected":"";
		echo "<option value=\"0\" $selected>�� ������������ (.sql)</option>";
		$selected = ($boolOption == "1")?"selected":"";
		echo "<option value=\"1\" $selected>������������ � TAR.GZ (.tar.gz)</option>";
		$selected = ($boolOption == "2")?"selected":"";
		echo "<option value=\"2\" $selected>������������ � ZIP (.zip)</option>";
	echo '</select>';
}
// ��������������
function AlgorithmChooser($strOption,$strName) {
	echo "<select class=\"inputbox\" name=\"$strName\">";
	$selected = ($strOption == "single")?"selected":"";
	echo "<option value=\"single\" $selected>������ - ���� ������</option>";
	$selected = ($strOption == "smart")?"selected":"";
	echo "<option value=\"smart\" $selected>������������� - ����������</option>";
	$selected = ($strOption == "multi")?"selected":"";
	echo "<option value=\"multi\" $selected>�������� - �����������������</option>";
	echo '</select>';
}
// ������ ������� ����������� ����
function outputLogLevel($strOption) {
	echo '<select class="inputbox" name="logLevel">';
		$selected = ($strOption == "1")?"selected":"";
		echo "<option value=\"1\" $selected>������ ������</option>";
		$selected = ($strOption == "2")?"selected":"";
		echo "<option value=\"2\" $selected>������ � ��������������</option>";
		$selected = ($strOption == "3")?"selected":"";
		echo "<option value=\"3\" $selected>��� ����������</option>";
		$selected = ($strOption == "4")?"selected":"";
		echo "<option value=\"4\" $selected>��� ���������� � �������</option>";
	echo '</select>';
}
?>
