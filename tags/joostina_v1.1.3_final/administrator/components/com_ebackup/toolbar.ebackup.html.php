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

class TOOLBAR_eBackup {
      function BACK_MENU($option) {
               global $option;
               mosMenuBar::startTable();
                  mosMenuBar::back("������ ����������", "index2.php?option=com_joomlapack");
               mosMenuBar::endTable();
      }
      function INFO_BACK_MENU($option) {
               //global $option;
               mosMenuBar::startTable();
               mosMenuBar::back("�����", "index2.php?option=$option&task=viewRestore");
               mosMenuBar::endTable();
      }
      function RESTORE_MENU() {
               mosMenuBar::startTable();
               mosMenuBar::back("������ ����������", "index2.php?option=com_joomlapack");
               mosMenuBar::endTable();
      }
      function SETUP_MENU(){
               mosMenuBar::startTable();
               mosMenuBar::save('saveSettings', '���������');
               mosMenuBar::spacer();
               mosMenuBar::back("������ ����������", "index2.php?option=com_joomlapack");
               mosMenuBar::endTable();
      }
      function _DEFAULT() {
               mosMenuBar::startTable();
               mosMenuBar::custom('doCheck','-check','','���������');
               mosMenuBar::spacer();
               mosMenuBar::custom('doAnalyze','-info','','�������������');
               mosMenuBar::spacer();
               mosMenuBar::custom('doOptimize','-optimize','','��������������');
               mosMenuBar::spacer();
               mosMenuBar::custom('doRepair','-help','','���������');
               mosMenuBar::divider();
               mosMenuBar::back("������ ����������", "index2.php?option=com_joomlapack");
               mosMenuBar::endTable();
      }
}
?>
