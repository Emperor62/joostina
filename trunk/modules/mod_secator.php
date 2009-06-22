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

$use_to = intval($params->get( 'use_to', 0 ));

if($use_to==1){
	_use_category(&$params); // ���������� ���������
}else{
	_use_sections(&$params); // ���������� �������
}


# ���������� ��� ��������
function _use_sections(&$params){
	$order_section = strval($params->get( 'order_section', 'order' ));
}

# ���������� ��� ���������
function _use_category(&$params){
	$database = &database::getInstance();

	$count			= intval($params->get( 'count', 5 ));
	$order_asc_desc	= strval($params->get( 'order_asc_desc', 'ASC' ));
	$order_category	= strval($params->get( 'order_category', 'order' ));

	$_where = 'WHERE ';
	$_where_published = _get_where_published($params->get( 'show_published', 1 ));

	$sql = 'SELECT #__categories.id,#__categories.title,#__categories.name,#__categories.image,#__categories.image_position,#__categories.description from #__categories
			INNER JOIN #__sections ON #__sections.id = #__categories.section
			'.$_where.$_where_published.' ORDER BY #__categories.'.$order_category.' '.$order_asc_desc.' ';
	$database->setQuery( $sql,0,$count );
	$database->getQuery( );
	$rows = $database->loadObjectList();

	$view_category	= strval($params->get( 'view_category', 'category_defaults.php' ));

	$_config		= Jconfig::getInstance();
	$file			= $_config->config_absolute_path.DS.'modules'.DS.'mod_secator'.DS.$view_category;
	$file_defaults	= $_config->config_absolute_path.DS.'modules'.DS.'mod_secator'.DS.'category_defaults.php';

	require_once is_file($file) ? $file : $file_defaults;
}

/* ��������� ���� ���������� */
function _get_where_published($show_published=null){

	if($show_published==0){
		$_where_published = ' #__categories.published=0';
	}elseif($show_published==2){
		$_where_published = ' ';
	}else{
		$_where_published = ' #__categories.published=1';
	}
	return $_where_published;
}


function _get_secator_link($row,$params){
	$link = 'index.php?option=com_content';

	$Itemid = $params->get( 'Itemid', null );
	$use_to = $params->get( 'use_to', 0 );

	if($use_to==1){
		// ���������� ���������
		$task = $params->get( 'task_category', 'blogcategory' );
	}else{
		$task = $params->get( 'task_category', 'blogsection' );
	}

	$link = $link.'&task='.$task.'&id='.$row->id.'&Itemid='.$Itemid;
	
	return sefRelToAbs($link);
}

?>
