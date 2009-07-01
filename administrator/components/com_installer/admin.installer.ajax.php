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

global $mosConfig_absolute_path,$mosConfig_live_site,$my;

$task	= mosGetParam($_GET,'task','publish');
$id		= intval(mosGetParam($_REQUEST,'id',0));

// ������������ ���������� �������� task
switch($task) {
	case 'publish':
		echo x_publish($id);
		return;

	default:
		echo 'error-task';
		return;
}

function x_publish($id = null) {
	$database = &database::getInstance();

	if(!$id) return 'error-id';

	$query = "SELECT menuid FROM #__components WHERE id = ".(int)$id;
	$database->setQuery($query);
	$state = $database->loadResult();

	if($state == 0) {
		$ret_img = 'publish_x.png';
		$state = 1;
	} else {
		$ret_img = 'publish_g.png';
		$state = 0;
	}
	$query = "UPDATE #__components SET menuid = ".(int)$state." WHERE id = ".$id;
	$database->setQuery($query);
	if(!$database->query()) {
		return 'error-db';
	} else {
		return $ret_img;
	}
}

?>
