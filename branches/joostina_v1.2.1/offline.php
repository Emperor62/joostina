<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
* doctorgrif: ��������� ��� ������
*/
// ������ ������� �������
defined('_VALID_MOS') or die();
global $database;
global $mosConfig_live_site,$mosConfig_lang;
$adminOffline = false;
if(!defined('_INSTALL_CHECK')) {
// ���� ����� ���������� �� ��������� � 1.1, �.�. ���������� ��������� ������
session_name(md5($mosConfig_live_site));
session_start();
if(class_exists('mosUser')) {
// �������������� ��������� ���������� ������
$admin = new mosUser($database);
$admin->id = intval(mosGetParam($_SESSION,'session_user_id',''));
$admin->username = strval(mosGetParam($_SESSION,'session_username',''));
$admin->usertype = strval(mosGetParam($_SESSION,'session_usertype',''));
$session_id = mosGetParam($_SESSION,'session_id','');
$logintime = mosGetParam($_SESSION,'session_logintime','');
// �������� ������� ������ ������ � ���� ������
if($session_id == md5($admin->id.$admin->username.$admin->usertype.$logintime)) {
$query = "SELECT* FROM #__session WHERE session_id = ".$database->Quote($session_id)."\n AND username = ".$database->Quote($admin->username)."\n AND userid = ".
intval($admin->id);
$database->setQuery($query);
if(!$result = $database->query()) {
echo $database->stderr();
}
if($database->getNumRows($result) == 1) {
define('_ADMIN_OFFLINE',1);
}
}
}
}
if(!defined('_ADMIN_OFFLINE') || defined('_INSTALL_CHECK')) {
@include_once ('language/'.$mosConfig_lang.'.php');
if($database != null) {
// ��������� �������� ������� ����� �� ���������
$query = "SELECT template FROM #__templates_menu WHERE client_id = 0 AND menuid = 0";
$database->setQuery($query);
$cur_template = $database->loadResult();
$path = "$mosConfig_absolute_path/templates/$cur_template/index.php";
if(!file_exists($path)) {
$cur_template = 'jooway';
}
} else {
$cur_template = 'jooway';
}
// ��������� ��� ���������� ������ ISO �� ��������� ��������� ����� _ISO
$iso = split('=',_ISO);
// xml prolog
echo '<?xml version="1.0" encoding="'.$iso[1].'"?'.'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $mosConfig_sitename; ?> - ���� ��������</title>
<style type="text/css">
@import url(<?php echo $mosConfig_live_site; ?>/administrator/templates/joostfree/css/admin_login.css);
</style>
<link rel="stylesheet" href="<?php echo $mosConfig_live_site; ?>/templates/css/offline.css" type="text/css" />
<?php
// ������ ���������� (favicon)
if(!$mosConfig_favicon) {
$mosConfig_favicon = 'favicon.ico';
}
$icon = $mosConfig_absolute_path.'/images/'.$mosConfig_favicon;
// checks to see if file exists
if(!file_exists($icon)) {
$icon = $mosConfig_live_site.'/images/favicon.ico';
} else {
$icon = $mosConfig_live_site.'/images/'.$mosConfig_favicon;
}
?>
<link rel="shortcut icon" href="<?php echo $icon; ?>" />
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
</head>
<body class="joo_offline">
<div id="joo"><img src="<?php echo $mosConfig_live_site;?>/administrator/templates/joostfree/images/logo.png" alt="Joostina!" /></div>
<div id="ctr1" align="center">
<p>&nbsp;</p><p>&nbsp;</p>
<table align="center" class="outline">
<tr>
	<td align="center" class="image">
		<img src="<?php echo $mosConfig_live_site; ?>/images/syte_off.png" alt="���� ��������!" align="middle" />
	</td>
</tr>
<tr>
	<td align="center">
		<h1><?php echo $mosConfig_sitename; ?></h1>
	</td>
</tr>
<?php if($mosConfig_offline == 1) { ?>
<tr>
	<td align="center" class="offline_message">
		<b><?php echo $mosConfig_offline_message; ?></b>
	</td>
</tr>
<?php } else if(@$mosSystemError) { ?>
<tr>
	<td align="center" class="error_message">
		<b><?php echo $mosConfig_error_message; ?></b><br />
		<span class="err">
		<?php echo defined('_SYSERR'.$mosSystemError)?constant('_SYSERR'.$mosSystemError):$mosSystemError; ?>
		</span>
	</td>
</tr>
<?php } else { ?>
<tr>
	<td align="center" class="instal_warning">
		<b><?php echo _INSTALL_WARN; ?></b>
	</td>
</tr>
<?php } ?>
<tr>
    <td align="center" class="clear_td"></td>
</tr>
</table>
</div>
<div id="break"></div>
<div id="footer_off" align="center">
	<div align="center"><?php echo @$_VERSION->URL; ?></div>
</div>
</body>
</html>
<?php exit(0); } ?>