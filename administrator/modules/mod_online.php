<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();
$mainframe = &mosMainFrame::getInstance();
$cur_file_icons_path = $mainframe->getCfg('live_site').'/'.ADMINISTRATOR_DIRECTORY.'/templates/'.$mainframe->getTemplate().'/images/ico';

$session_id = stripslashes(mosGetParam($_SESSION,'session_id',''));

// Get no. of users online not including current session
$query = "SELECT COUNT( session_id ) FROM #__session WHERE session_id != ".$database->Quote($session_id);
$database->setQuery($query);
$online_num = intval($database->loadResult());

echo $online_num." <img src=\"".$cur_file_icons_path."/users.png\" align=\"middle\" alt=\""._ONLINE_USERS."\" />";