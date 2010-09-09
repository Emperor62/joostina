<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/
/** �������� ��������� ����� ����� ������-����������*/
defined('_VALID_MOS') or die();
require_once ('includes/joomla.php');
include_once ('language/'.$mosConfig_lang.'.php');
global $option,$database;
global $mosConfig_live_site;
// ��������� ������� ��������
$cur_template = @$mainframe->getTemplate();
if(!$cur_template) {
$cur_template = 'rhuk_solarflare_ii';
}
// ����� HTML
// ��������� ��� ���������� ������ ISO �� ��������� ��������� ����� _ISO
$iso = split('=',_ISO);
// xml prolog
echo '<?xml version="1.0" encoding="'.$iso[1].'"?'.'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<title><?php echo $mosConfig_sitename; ?> - ���� ��������</title>
<link rel="stylesheet" href="<?php echo $mosConfig_live_site; ?>/templates/<?php echo
$cur_template; ?>/css/template_css.css" type="text/css" />
</head>
<body class="moswarning">
<table class="moswarning">
<?php if($mosConfig_offline == 1) { ?>
<tr>
<td>
<h2><?php echo $mosConfig_sitename; echo ' - '; echo $mosConfig_offline_message; ?></h2>
</td>
</tr>
<?php } else if(@$mosSystemError) { ?>
<tr>
<td>
<h2><?php echo $mosConfig_error_message; ?></h2><?php echo $mosSystemError; ?>
</td>
</tr>
<?php } else { ?>
<tr>
<td>
<h2><?php echo 'INSTALL_WARN'; ?></h2>
</td>
</tr>
<?php } ?>
</table>
</body>
</html>