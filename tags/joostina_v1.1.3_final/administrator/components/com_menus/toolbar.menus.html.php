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
class TOOLBAR_menus {
	/**
	* Draws the menu for a New top menu item
	*/
	function _NEW()	{
		mosMenuBar::startTable();
		mosMenuBar::customX( 'edit', '-next', '', '�����', true );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'screen.menus.new' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to Move Menut Items
	*/
	function _MOVEMENU()	{
		mosMenuBar::startTable();
		mosMenuBar::custom( 'movemenusave', '-move', '', '���������', false );
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelmovemenu' );
		mosMenuBar::spacer();
		mosMenuBar::help( 'screen.menus.move' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to Move Menut Items
	*/
	function _COPYMENU()	{
		mosMenuBar::startTable();
		mosMenuBar::custom( 'copymenusave', '-copy', '', '����������', false );
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelcopymenu' );
		mosMenuBar::spacer();
		mosMenuBar::help( 'screen.menus.copy' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to edit a menu item
	*/
	function _EDIT() {
		global $id;

		if ( !$id ) {
			$cid 	= josGetArrayInts( 'cid' );
			$id = $cid[0];
		}
		$menutype 	= strval( mosGetParam( $_REQUEST, 'menutype', 'mainmenu' ) );

		mosMenuBar::startTable();
		if ( !$id ) {
			$link = 'index2.php?option=com_menus&menutype='. $menutype .'&task=new&hidemainmenu=1';
			mosMenuBar::back( '�����', $link );
			mosMenuBar::spacer();
		}
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::apply();
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			mosMenuBar::cancel( 'cancel', '�������' );
		} else {
			mosMenuBar::cancel();
		}
		mosMenuBar::spacer();
		mosMenuBar::help( 'screen.menus.edit' );
		mosMenuBar::endTable();
	}

	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::customX( 'movemenu', '-move', '', '���������', true );
		mosMenuBar::spacer();
		mosMenuBar::customX( 'copymenu', '-copy', '', '����������', true );
		mosMenuBar::spacer();
		mosMenuBar::trash();
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::help( 'screen.menus' );
		mosMenuBar::endTable();
	}
}
?>
