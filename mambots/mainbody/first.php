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

$_MAMBOTS->registerFunction('onMainbody','body_clear');
$_MAMBOTS->registerFunction('onTemplate','template_clear');

global $mosConfig_absolute_path;

require_once ($mosConfig_absolute_path.'/includes/libraries/html_optimize/html_optimize.php');


/* ������� ���������� ������� ����������� �������� ����� ���������� �� ������������*/
function body_clear() {
	global $_MOS_OPTION;
	$_MOS_OPTION['buffer'] = html_optimize($_MOS_OPTION['buffer']);
	return;
}

/* ������� ����� ���� �������� �� ���������*/
function template_clear() {
	global $_MOS_OPTION;
	$_MOS_OPTION['mainbody'] = html_optimize($_MOS_OPTION['mainbody']);
	return;
}

?>
