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

/**
* @package Joostina
* @subpackage Content
*/
class ContentView {

	/**
	* Writes a list of the content items
	* @param array An array of content objects
	*/
	function showContent(&$rows,$section,&$lists,$search,$pageNav,$all = null,$redirect='') {
		global $my,$acl,$database,$mosConfig_live_site;

		$mainframe = &mosMainFrame::getInstance();
		$cur_file_icons_path = JPATH_SITE.'/'.ADMINISTRATOR_DIRECTORY.'/templates/'.JTEMPLATE.'/images/ico';
		$cur_file_icons_path2 = JPATH_SITE.'/'.ADMINISTRATOR_DIRECTORY.'/templates/'.JTEMPLATE.'/images';

		$selected_cat = intval( mosGetParam($_REQUEST,'catid',0));
		$showarchive = intval( mosGetParam($_REQUEST,'showarchive',0));

		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadDtree();
		
		include_once($mainframe->adminView('showcontent'));
	}


	/**
	* Writes a list of the content items
	* @param array An array of content objects
	*/
	function showArchive(&$rows,$section,&$lists,$search,$pageNav,$option,$all = null,$redirect) {
		global $my,$acl;
		
		$mainframe = &mosMainFrame::getInstance();
		$cur_file_icons_path = JPATH_SITE.'/'.ADMINISTRATOR_DIRECTORY.'/templates/'.JTEMPLATE.'/images/ico';
		
		include_once($mainframe->adminView('showarchive'));
	}


	/**
	* ����������� ����� �������� / �������������� �����������
	*
	* ����� ������ ��������������� ���������� <var>$row</var> �  <var>id</var>
	* ������� 0.
	* @param mosContent The category object
	* @param string The html for the groups select list
	*/
	function editContent(&$row,$section,&$lists,&$sectioncategories,&$images,&$params,$option,$redirect,&$menus) {

		$mainframe = &mosMainFrame::getInstance();
		$cur_file_icons_path = JPATH_SITE.'/'.ADMINISTRATOR_DIRECTORY.'/templates/'.JTEMPLATE.'/images';
		
		mosMakeHtmlSafe($row);
		$nullDate = database::getInstance()->getNullDate();
		$create_date = null;
		if($row->created != $nullDate) {
			$create_date = mosFormatDate($row->created,'%d %B %Y %H:%M','0');
		}
		$mod_date = null;
		if($row->modified != $nullDate) {
			$mod_date = mosFormatDate($row->modified,'%d %B %Y %H:%M','0');
		}
		$tabs = new mosTabs(1);
		// used to hide "Reset Hits" when hits = 0
		if(!$row->hits) {
			$visibility = "style='display: none; visibility: hidden;'";
		} else {
			$visibility = '';
		}
		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadCalendar();

		
		include_once($mainframe->adminView('editcontent'));

	}

	/**
	* Form to select Section/Category to move item(s) to
	* @param array An array of selected objects
	* @param int The current section we are looking at
	* @param array The list of sections and categories to move to
	*/
	function moveSection($cid,$sectCatList,$option,$sectionid,$items) {
		
		include_once($mainframe->adminView('movesection'));
	}

	/**
	* Form to select Section/Category to copys item(s) to
	*/
	function copySection($option,$cid,$sectCatList,$sectionid,$items) {
		include_once($mainframe->adminView('copysection'));
	}
	function submit($params){
		mosCommonHTML::loadOverlib();
		echo $params->render(null);
	}

}