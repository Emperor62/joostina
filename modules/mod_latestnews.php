<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined( '_VALID_MOS' ) or die();

$mainframe = &mosMainFrame::getInstance();

$type = intval($params->get('type', 1));
$def_itemid	= $params->get('def_itemid', false);
$params->def('item_title', 1); $params->def('link_titles', 1);
$params->def('template', 'default.php');

//���������� ��������������� �����
$module->get_helper();

// ����� ����� ������� ����������� ��������, 
//������������ ����������� ��� ����� �����
switch ($type) {
	case 2: 
		//������ ����������� ����������
		$rows = $module->helper->get_static_items($params);
		break;

	case 3: 
		//��� ����		
		$rows = $module->helper->get_items_both($params);
		break;

	case 1:
	default: 
		//������ ���������� ���������
		$rows = $module->helper->get_category_items($params); 	
		break;
}

$params->def('numrows', count($rows));
$params->set('intro_only',1);

if(!$def_itemid>0){
	// ���������� ��������� �������, ������������ getItemid ��� �������� �����������
	if (($type == 1) || ($type == 3)) {
		$params->def('bs', $mainframe->getBlogSectionCount());
		$params->def('bc', $mainframe->getBlogCategoryCount());
		$params->def('gbs',$mainframe->getGlobalBlogSectionCount());
	}
}

//���������� ������
if($module->set_template($params)){
	require($module->template);
}