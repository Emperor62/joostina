<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/
define('_VALID_MOS',1);
if(file_exists('../configuration.php') && filesize('../configuration.php') > 10) {
header("Location: ../index.php");
exit();
}
require ('../globals.php');
require_once ('../includes/version.php');
/** ���������� common.php*/
include_once ('common.php');
$sp = ini_get('session.save_path');
$_VERSION = new joomlaVersion();
$versioninfo = $_VERSION->RELEASE.'.'.$_VERSION->CMS_ver;
$version = $_VERSION->CMS.' '.$_VERSION->CMS_ver.' '.$_VERSION->DEV_STATUS.' [ '.$_VERSION->CODENAME.' ] '.$_VERSION->RELDATE.' '.$_VERSION->RELTIME.' '.$_VERSION->RELTZ;
echo "<?xml version=\"1.0\" encoding=\"windows-1251\"?".">";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Joostina - Web-���������. �������� �������</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body>
<div id="wrapper">
<div id="header">
<div id="joomla"><img src="img/header_install.png" alt="��������� Joostina" /></div>
</div>
</div>
<div id="ctr" align="center">
<div class="install">
<div id="step"><span>�������� �������</span>
<div class="step-right">
<input type="button" class="button" value="��������� �����" onclick="window.location=window.location" />
<input name="Button2" type="submit" class="button" value="����� >>" onclick="window.location='install.php';" />
</div>
</div>
<div id="stepbar">
<div class="step-on">�������� �������</div>
<div class="step-off">��������</div>
<div class="step-off">��� 1</div>
<div class="step-off">��� 2</div>
<div class="step-off">��� 3</div>
<div class="step-off">��� 4</div>
<div class="step-off"><img src="img/img-1.png" alt="��������� Joostina" /></div>
</div>
<div id="right">
<div class="clr"></div>
<h1 style="text-align:center;"><?php echo $version; ?></h1>
<h1>�������� �������� �������: </h1>
<div class="install-text">���� �� ������� ������� ���������, ��������� �������� � ������� �� ����� ��������� ��� ������ Joostina, �� �� ���� �������� ��� ����� �������� <b><font color="red">������� ������</font></b>. ��� ����������� � ��� ���������� ������ ������� ����������� ��������� ��� ����������� ���������.
<div class="ctr"></div>
</div>
<div class="install-form">
<div class="form-block">
<table class="content">
<tr>
<td class="item">������ PHP >= 4.1.0</td>
<td align="left"><?php echo phpversion() < '4.1'?'<b><font color="red">���</font></b>':'<b><font color="green">��</font></b>'; ?></td>
</tr>
<tr>
<td>&nbsp; - ��������� zlib-������</td>
<td align="left"><?php echo extension_loaded('zlib')?'<b><font color="green">��������</font></b>':'<b><font color="red">����������</font></b>'; ?></td>
</tr>
<tr><td>&nbsp; - ��������� XML</td>
<td align="left"><?php echo extension_loaded('xml')?'<b><font color="green">��������</font></b>':'<b><font color="red">����������</font></b>'; ?></td>
</tr>
<tr><td>&nbsp; - ��������� MySQL</td>
<td align="left"><?php echo function_exists('mysql_connect')?'<b><font color="green">��������</font></b>':'<b><font color="red">����������</font></b>'; ?></td>
</tr>
<tr>
<td valign="top" class="item">���� <strong>configuration.php</strong></td>
<td align="left">
<?php
if(@file_exists('../configuration.php') && @is_writable('../configuration.php')) {
echo '<b><font color="green">�������� ��� ������</font></b>';
} else
if(is_writable('..')) {
echo '<b><font color="green">�������� ��� ������</font></b>';
} else {
echo '<b><font color="red">���������� ��� ������</font></b><br /><span class="small">�� ������ ���������� ���������, �������� ����� ������������ ����� �������� � �����. ����������� ��������� ���: ����������/�������� ���������� � ��������� ���� ���� configuration.php � ��������� �� ������!</span>';
}
?></td>
</tr>
<tr>
<td class="item">������� ��� ������ ������</td>
<td align="left" valign="top">
<?php echo is_writable($sp)?'<b><font color="green">�������� ��� ������</font></b>':'<b><font color="red">���������� ��� ������</font></b>'; ?></td>
</tr>
<tr>
<td class="item" colspan="2"><b><?php echo $sp?$sp:'�� ����������'; ?></b></td>
</tr>
</table>
</div>
</div>
<div class="clr"></div>
<?php
$wrongSettingsTexts = array();
if(ini_get('magic_quotes_gpc') != '1') {
$wrongSettingsTexts[] = '�������� PHP magic_quotes_gpc - `OFF` ������ `ON`';
}
if(ini_get('register_globals') == '1') {
$wrongSettingsTexts[] = '�������� PHP register_globals - `ON` ������ `OFF`';
}
if(RG_EMULATION != 0) {
$wrongSettingsTexts[] =
'�������� RG_EMULATION � ����� globals.php -<br />`ON` ������ `OFF`<br /><span style="font-weight: normal; font-style: italic; color: #666;">`ON` - �� ��������� - ��� �������������</span>';
}

if(count($wrongSettingsTexts)) {
?>
<h1>�������� ������������:</h1>
<div class="install-text"><p>��������� ��������� PHP �������� �������������� ��� <strong>������������</strong> � �� ������������� ��������:</p><p>����������, �� �������������� ����������� ����������� �� <a href="http://forum.joomla.org/index.php/topic,81058.0.html" target="_blank">����������� ����� Joomla! - ���� � ������������</a>.</p>
<div class="ctr"></div>
</div>
<div class="install-form">
<div class="form-block" style=" border: 1px solid #cc0000; background: #ffffcc;">
<table class="content" style=" width:355px">
<tr>
<td class="item">
<ul style="margin: 0px; padding: 0px; padding-left: 5px; text-align: left; padding-bottom: 0px; list-style: none;">
<?php
foreach($wrongSettingsTexts as $txt) {
?>
<li style="min-height:25px;padding-bottom:5px;padding-left:25px;color:red;font-weight:bold;background-image:url(../includes/js/ThemeOffice/warning.png);background-repeat:no-repeat;background-position:0px 2px;" >
<?php
echo $txt;
?>
</li>
<?php
}
?>
</ul>
</td>
</tr>
</table>
</div>
</div>
<div class="clr"></div>
<?php
}
?>
<h1>������������� ��������� PHP:</h1>
<div class="install-text">
&nbsp;&nbsp;��� ��������� PHP ������������� ��� ������ ������������� � Joostina.<br />������, Joostina ����� ��������, ���� ��� ��������� �� � ������ ���� ������������� �������������.
<div class="ctr"></div>
</div>
<div class="install-form">
<div class="form-block">

<table class="content">
<tr>
<td class="toggle">���������</td>
<td class="toggle">�������������</td>
<td class="toggle">�����������</td>
</tr>
<?php
$php_recommended_settings = array(
array('Safe Mode','safe_mode','OFF'),
array('Display Errors','display_errors','ON'),
array('File Uploads','file_uploads','ON'),
array('Magic Quotes GPC','magic_quotes_gpc','ON'),
array('Magic Quotes Runtime','magic_quotes_runtime','OFF'),
array('Register Globals','register_globals','OFF'),
array('Output Buffering','output_buffering','OFF'),
array('Session auto start','session.auto_start','OFF')
,);
foreach($php_recommended_settings as $phprec) {
?>
<tr>
<td class="item"><?php echo $phprec[0]; ?>:</td>
<td class="toggle"><?php echo $phprec[2]; ?>:</td>
<td>
<b>
<?php
if(get_php_setting($phprec[1]) == $phprec[2]) {
?>
<font color="green">
<?php
} else {
?>
<font color="red">
<?php
}
echo get_php_setting($phprec[1]);
?>
</font>
</b>
<td>
</tr>
<?php
}
?>
<tr>
<td class="item">�������� Register Globals:</td>
<td class="toggle">OFF:</td>
<td>
<?php
if(RG_EMULATION) {
?>
<font color="red"><b>
<?php
} else {
?>
<font color="green"><b>
<?php
}
echo ((RG_EMULATION)?'ON':'OFF');
?>
</b>
</font>
<td>
</tr>
</table>
</div>
</div>
<div class="clr"></div>
<div class="clr"></div>
<h1>����������� �������������� �������</h1>
<div class="install-text">��������� ��������� ������ �� �������� ���������� ��� ������, �� ������������ ��������� ��������� �������� ������ � Joostina ������������ �������� � ������������.
<div class="clr">&nbsp;&nbsp;</div>
<div class="ctr"></div>
</div>
<div class="install-form">
<div class="form-block">
<table class="content">
<tr>
<td class="toggle">���������</td>
<td class="toggle">�������������</td>
<td class="toggle">�����������</td>
</tr>
<?php
$php_recommended_settings = array(
array('allow_url_fopen','allow_url_fopen','OFF'),
array('short_open_tag','short_open_tag','OFF'),
array('post_max_size','post_max_size','8M'),
array('upload_max_filesize','upload_max_filesize','2M'),
array('default_socket_timeout (in sec.)','default_socket_timeout','30'),
array('max_execution_time (in sec.)','max_execution_time','30'),
);
foreach($php_recommended_settings as $phprec) {
?>
<tr>
<td class="item"><?php echo $phprec[0]; ?></td>
<td class="toggle"><?php echo $phprec[2]; ?></td>
<td>
<?php
$act_val = ini_get($phprec[1]);
if($act_val == '1' || $act_val == '2' || $act_val == '') {
if(get_php_setting($phprec[1]) == $phprec[2]) { ?>
<font color="green"><strong>
<?php
} else { ?>
<font color="red"><strong>
<?php
}
}
if($act_val == '1') {
echo 'ON';
} elseif($act_val == '2' || $act_val == '') {
echo 'OFF';
} else echo '<strong><font color="green">'.$act_val.'</font>';
?>
</strong></font>
</td>
</tr>
<?php
} // end foreach
?>
</table>
</div>
<div class="clr"></div>
</div>
<div id="dir_info" style="display:none;"><h1>����� ������� � ������ � ���������:</h1>
<div class="install-text">��� ���������� ������ Joostina ����������, ����� �� ������������ ����� � �������� ���� ����������� ����� ������. ���� �� ������ <b><font color="red">���������� ��� ������</font></b> ��� ��������� ������ � ���������, �� ���������� ���������� �� ��� ����� �������, ����������� �������������� ��.</div>
</div>
<div class="install-form">
<div class="form-block">
<div class="button" id="cr" style="width: 98%;" onclick="document.getElementById('cool_dirs').style.display=''; document.getElementById('dir_info').style.display=''; document.getElementById('cr').style.display='none';">
��������� ����� ������� � ��������� ���������
</div>
<div class="clr">&nbsp;</div><br /><br />
<?php
// ������ ��������� ������� ��������� ��������� �� ����������� ������ � ���
$dirs = array(
'administrator/backups',
'administrator/components',
'administrator/modules',
'administrator/templates',
'cache',
'components',
'images',
'images/banners',
'images/stories',
'language',
'mambots',
'mambots/content',
'mambots/editors',
'mambots/editors-xtd',
'mambots/search',
'mambots/system',
'media',
'modules',
'templates');
$cool_dirs= '';
$bad_dirs= '';
foreach($dirs as $dir) {
if(writableCell($dir)){
// �������� � ������� ������ ���������
$cool_dirs .= '<tr><td class="item">'.$dir.'/</td><td align="right"><b><font color="green">�������� ��� ������</font></b></tr>';
}else{
// �������� � ������� ������ ���������
$bad_dirs .= '<tr><td class="item">'.$dir.'/</td><td align="right"><b><font color="red">���������� ��� ������</font></b></tr>';
}
}

if($bad_dirs!=''){
echo '<table class="content">'.$bad_dirs.'</table>';
};
echo '<table id="cool_dirs" class="content" style="display:none;">'.$cool_dirs.'</table>';

?>
</div>
<div class="clr"></div>
</div>
<div class="clr"></div>
</div>
<div class="clr"></div>
</div>
</div>
<div class="ctr" id="footer"><a href="http://www.joostina.ru" target="_blank">Joostina</a> - ��������� ����������� �����������, ���������������� �� �������� GNU/GPL.</div>
</body>
</html>
<?php
function get_php_setting($val) {
$r = (ini_get($val) == '1' ? 1:0);
return $r ? 'ON':'OFF';
}
function writableCell($folder,$relative = 1) {
if($relative) {
return is_writable("../$folder") ? 1:0;
} else {
return is_writable("$folder") ? 1:0;
}
}
function writableCell_old($folder,$relative = 1,$text = '') {
$writeable = '<b><font color="green">�������� ��� ������</font></b>';
$unwriteable = '<b><font color="red">���������� ��� ������</font></b>';
echo '<tr>';
echo '<td class="item">'.$folder.'/</td>';
echo '<td align="right">';
if($relative) {
echo is_writable("../$folder") ? $writeable:$unwriteable;
} else {
echo is_writable("$folder") ? $writeable:$unwriteable;
}
echo '</tr>';
}
?>