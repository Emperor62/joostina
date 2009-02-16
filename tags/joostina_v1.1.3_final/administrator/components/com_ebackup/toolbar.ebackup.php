<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2007 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/copyleft/gpl.html GNU/GPL, �������� LICENSE.php
* Joostina! - ��������� ����������� �����������. ��� ������ ����� ���� ��������
* � ������������ � ����������� ������������ ��������� GNU, ������� ��������
* � ���������� ��������������� � ������� ���������� ������, ����������������
* �������� ����������� ������������ ��������� GNU ��� ������ �������� ���������
* �������� ��� �������� � �������� �������� �����.
* ��� ��������� ������������ � ��������� �� ��������� �����, �������� ���� COPYRIGHT.php.
*/

// ������ ������� �������
defined( '_VALID_MOS' ) or die( '������ ����� ����� ��������' );

require_once($mainframe->getPath('toolbar_html'));
require_once($mainframe->getPath('toolbar_default'));
if ($task<>'') {
    $func = $task;
} elseif ($act<>'') {
    $func = $act;
} else {
  $act = mosGetParam( $_REQUEST, 'act', "" );
  if ($act<>'') {
    $func = $act;
  } else {
    $func = '';
  }
}

switch ($func) {
       case 'doBackup':
            TOOLBAR_eBackup::BACK_MENU($option);
            break;
       case 'doCheck':
            TOOLBAR_eBackup::BACK_MENU($option);
            break;
       case 'doAnalyze':
            TOOLBAR_eBackup::BACK_MENU($option);
            break;
       case 'doOptimize':
            TOOLBAR_eBackup::BACK_MENU($option);
            break;
       case 'doRepair':
            TOOLBAR_eBackup::BACK_MENU($option);
            break;
       case 'viewInfo':
            TOOLBAR_eBackup::INFO_BACK_MENU($option);
            break;
       case 'viewTables':
            TOOLBAR_eBackup::_DEFAULT();
            break;
       case 'viewSetup':
            TOOLBAR_eBackup::SETUP_MENU();
            break;
       case 'viewRestore':
            TOOLBAR_eBackup::RESTORE_MENU();
            break;
       default:
            TOOLBAR_eBackup::_DEFAULT();
            break;
}

?>
