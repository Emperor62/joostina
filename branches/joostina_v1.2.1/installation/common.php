<?php
/**
* @version $Id: common.php 4675 2006-08-23 16:55:24Z stingrey $
* @package Joostina
* @copyright ��������� ����� (C) 2005 Open Source Matters. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, �������� LICENSE.php
* Joomla! - ��������� ����������� �����������. ��� ������ ����� ���� ��������
* � ������������ � ����������� ������������ ��������� GNU, ������� ��������
* � ���������� ��������������� � ������� ���������� ������, ����������������
* �������� ����������� ������������ ��������� GNU ��� ������ �������� ��������� 
* �������� ��� �������� � �������� �������� �����.
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/
defined('_VALID_MOS') or die();
error_reporting(E_ALL);
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0

/** ��������� ������� ��� ��������� �������� �� ���������*/
define("_MOS_NOTRIM",0x0001);
define("_MOS_ALLOWHTML",0x0002);
function mosGetParam(&$arr,$name,$def = null,$mask = 0) {
if(isset($arr[$name])) {
if(is_string($arr[$name])) {
if(!($mask & _MOS_NOTRIM)) {
$arr[$name] = trim($arr[$name]);
}
if(!($mask & _MOS_ALLOWHTML)) {
$arr[$name] = strip_tags($arr[$name]);
}
if(!get_magic_quotes_gpc()) {
$arr[$name] = addslashes($arr[$name]);
}
}
return $arr[$name];
} else {
return $def;
}
}
function mosMakePassword($length) {
$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$len = strlen($salt);
$makepass = "";
mt_srand(10000000* (double)microtime());
for($i = 0; $i < $length; $i++) $makepass .= $salt[mt_rand(0,$len - 1)];
return $makepass;
}
/**
* ����� ������� � ������ � �����������
* @param path ��������� ���� ��� ���������� (��� ����� � �����)
* @param filemode �������� ���������� ��� ��������� ���� ������� � ������. NULL = ��� ��������� ���� �������.
* @param dirmode �������� ���������� ��� ��������� ���� ������� � �����������. NULL = ��� ��������� ���� �������..
* @return TRUE=all ������������� FALSE=one ��� ���� ������� �� ���� ������
*/
function mosChmodRecursive($path,$filemode = null,$dirmode = null) {
$ret = true;
if(is_dir($path)) {
$dh = opendir($path);
while($file = readdir($dh)) {
if($file != '.' && $file != '..') {
$fullpath = $path.'/'.$file;
if(is_dir($fullpath)) {
if(!mosChmodRecursive($fullpath,$filemode,$dirmode)) $ret = false;
} else {
if(isset($filemode))
if(!@chmod($fullpath,$filemode)) $ret = false;
} // ����
} // ����
} // � �� ����� ���
closedir($dh);
if(isset($dirmode))
if(!@chmod($path,$dirmode)) $ret = false;
} else {
if(isset($filemode)) $ret = @chmod($path,$filemode);
} // if
return $ret;
} // mosChmodRecursive
?>