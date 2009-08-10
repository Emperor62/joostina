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

// ������� ���� ������ �����������
$_MAMBOTS->registerFunction('onMainbody','body_clear');
// ������� ���� ����� �������
$_MAMBOTS->registerFunction('onTemplate','body_clear');

/* ������� ���������� ������� �� ������������*/
function body_clear(&$body) {
	require_once (Jconfig::getInstance()->config_absolute_path.DS.'includes'.DS.'libraries'.DS.'html_optimize'.DS.'html_optimize.php');
	$body = html_optimize($body);
	return true;
}