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

/**
* @package Joostina
* @subpackage Menus
*/
class TOOLBAR_menumanager {
	/**
	* Draws the menu for the Menu Manager
	*/
	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::customX( 'copyconfirm', '-copy', '', '����������', true );
		mosMenuBar::spacer();
		mosMenuBar::customX( 'deleteconfirm', '-delete', '', '�������', true );
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::help( 'screen.menumanager' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to delete a menu
	*/
	function _DELETE() {
		mosMenuBar::startTable();
		mosMenuBar::cancel( );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to create a New menu
	*/
	function _NEWMENU(){
		mosMenuBar::startTable();
		mosMenuBar::custom( 'savemenu', '-save', '', '���������', false );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'screen.menumanager.new' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to create a New menu
	*/
	function _COPYMENU()	{
		mosMenuBar::startTable();
		mosMenuBar::custom( 'copymenu', '-copy', '', '����������', false );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'screen.menumanager.copy' );
		mosMenuBar::endTable();
	}
}
?>
