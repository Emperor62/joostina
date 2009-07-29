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

require_once ($mainframe->getPath('front_html', 'com_content'));
require_once ($mainframe->getPath('config', 'com_content'));
include_once ($mainframe->getLangFile('com_content'));

global $task, $Itemid, $option, $my;

//���������� js com_content-�
contentHelper::_load_core_js();

$id = intval(mosGetParam($_REQUEST, 'id', 0));

// cache activation
$cache = &mosCache::getCache('com_content');

// loads function for frontpage component
if($option == 'com_frontpage') {
	$r = $cache->call('frontpage', $my->gid);
	from_cache($r);
	return;
}

switch ($task) {

	case 'ucontent':
		showUserItems();
		break;

	case 'view':
	case 'preview':
		showFullItem($id,$my->gid,$cache);
		break;

	case 'section':
		showSectionCatlist($id,$cache);
		break;

	case 'category':
		showTableCategory($id,$cache);
		break;

	case 'blogsection':
		showBlogSection($id,$my->gid);
		break;

	case 'blogcategorymulti':
	case 'blogcategory':
		// ���� ���������
		showBlogCategory($id,$my->gid);
		break;

	case 'archivesection':
		// ����� �������
		$cache->call('showArchiveSection', $id);
		break;

	case 'archivecategory':
		// ����� ���������
		$cache->call('showArchiveCategory', $id);
		break;

	case 'edit':
		editItem($task);
		break;

	case 'new':
		editItem($task);
		break;

	case 'save':
	case 'apply':
	case 'apply_new':
		mosCache::cleanCache('com_content');
		saveContent($task);
		break;

	case 'cancel':
		cancelContent();
		break;

	case 'emailform':
		emailContentForm($id, $my->gid);
		break;

	case 'emailsend':
		emailContentSend($id, $my->gid);
		break;

	case 'vote':
		recordVote();
		break;

	default:
		header("HTTP/1.0 404 Not Found");
		echo _NOT_EXIST;
		break;
}

/**
 * �������� � �������� ���������� ������������
 */
function showUserItems() {
	global $Itemid, $my;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();
	$acl = &gacl::getInstance();

	$limit = intval(mosGetParam($_REQUEST, 'limit', 0));
	$limitstart = intval(mosGetParam($_REQUEST, 'limitstart', 0));

	$user_id = intval(mosGetParam($_REQUEST, 'user', 0));

	//����� �������
	$access = new contentAccess();
	// Paramters
	$params = new configContent_ucontent($database);
	$limit = $limit ? $limit : $params->get('display_num');
	$params->set('limitstart', $limitstart);
	$params->set('limit', $limit);

	$user_items = new mosContent($database);
	//�������� ���������� ������� ������������
	$user_items->total = $user_items->_get_count_user_items($user_id, $params);
	//�������� ��� ������ ������������
	$user_items->items = $user_items->_load_user_items($user_id, $params);

	if(!$user_items->items) {
		$user = new mosUser($database);
		if($user->load($user_id)) {
			$user_items->user = $user;
		} else {
			$user_items = null;
		}
	}

	if($user_items) {

		//������������ ���������
		if($user_items->total <= $limit){
			$limitstart = 0;
		}

		mosMainFrame::addLib('pageNavigation');
		$pageNav = new mosPageNav($user_items->total, $limitstart, $limit);

		$check = 0;
		if($params->get('date')) {
			$order[] = mosHTML::makeOption('date', _ORDER_DROPDOWN_DA);
			$order[] = mosHTML::makeOption('rdate', _ORDER_DROPDOWN_DD);
			$check .= 1;
		}
		if($params->get('title')) {
			$order[] = mosHTML::makeOption('alpha', _ORDER_DROPDOWN_TA);
			$order[] = mosHTML::makeOption('ralpha', _ORDER_DROPDOWN_TD);
			$check .= 1;
		}
		if($params->get('hits')) {
			$order[] = mosHTML::makeOption('hits', _ORDER_DROPDOWN_HA);
			$order[] = mosHTML::makeOption('rhits', _ORDER_DROPDOWN_HD);
			$check .= 1;
		}
		if($params->get('section')) {
			$order[] = mosHTML::makeOption('section', _ORDER_DROPDOWN_S_C_ASC);
			$order[] = mosHTML::makeOption('rsection', _ORDER_DROPDOWN_S_C_DESC);
			$check .= 1;
		}
		$order[] = mosHTML::makeOption('order', _ORDER_DROPDOWN_O);
		$lists['order'] = mosHTML::selectList($order, 'order', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $params->get('orderby'));
		if($check < 1) {
			$lists['order'] = '';
			$params->set('order_select', 0);
		}

		$lists['task'] = 'category';
		$lists['filter'] = $params->get('filter_value');
		$lists['limit'] = $limit;
		$lists['limitstart'] = $limitstart;

	}

	$pagetitle = '';
	if($Itemid) {
		$menu = new mosMenu($database);
		$menu->load($Itemid);
		$pagetitle = $menu->name;
	}
	// Dynamic Page Title
	$mainframe->SetPageTitle($pagetitle);

	HTML_content::showUserContent($user_items, $access, $params, $pageNav, $lists, $params->get('orderby'));
}

/**
 * ����� ������� ��������
 * ��������� 'com_frontpage'
 */
function frontpage() {
	global $my;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	$pop = intval(mosGetParam($_REQUEST, 'pop', 0));
	$limit = intval(mosGetParam($_REQUEST, 'limit', 0));
	$limitstart = intval(mosGetParam($_REQUEST, 'limitstart', 0));

	//����� �������
	$access = new contentAccess();

	//��������� ���������� �������� ����� �������
	$params = contentPageConfig::setup_frontpage();
	$limit = $params->get('intro') + $params->get('leading') + $params->get('link');

	$frontpage = new mosContent($database);
	//�������� ����� ���������� ������� �� ������� ��������
	$frontpage->total = $frontpage->_get_result_frontpage($params, $access);

	if($frontpage->total <= $limit) {
		$limitstart = 0;
	}
	$params->set('limitstart', $limitstart);
	$params->set('limit', $limit);

	//�������� ��� ������ ������
	$frontpage->content = $frontpage->_load_frontpage($params, $access);

	$params->def('pop', $pop);
	$params->page_type = 'frontpage';

	ob_start();
		BlogOutput($frontpage, $params, $access);
		$content_boby = ob_get_contents(); // ������� ���������� - ���� ������ ���������� - mainbody
	ob_end_clean();

	return array('content' => $content_boby, 'params' => $params);
}

function showSectionCatlist($id,$cache){
	global $Itemid, $my;

	$config = &Jconfig::getInstance();
	$r = $cache->call('_showSectionCatlist', $id,$my->gid);
	from_cache($r);
}

/**
 * ����� ������ ��������� �������
 * ��� ������ - ������� �������
 *
 * @param int The section id
 */
function _showSectionCatlist($id) {
	global $Itemid, $my;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	if(!$id) {
		$error = new errorCase(1);
		return;
	}

	//����� �������
	$access = new contentAccess();

	//�������� ������ �������
	$section = new mosSection($database);
	$section->load((int)$id);

	//��������� ����� ������� � �������
	if(!$section->published || $section->access > $my->gid) {
		$error = new errorCase(2);
		return;
	}

	//��������� ���������� �������� ������� �������
	$params = contentPageConfig::setup_section_catlist_page($section);

	//�������� ���������, ������������� �������� �������
	$section->content = $section->_load_table_section($section, $params, $access);
	$categories = $section->content;

	//�������� ����� ���������� �������������� ��������� � �������,
	//����� �������� - ����� �� �������� ������ ���������� ����������
	$section->categories_exist = false;
	if($access->canEdit) {
		$section->categories_exist = $section->get_count_all_cats($section, $params, $access);
	}

	// remove slashes
	$section->name = stripslashes($section->name);

	$params->section_data = $section;
	$params->page_type = 'section_catlist';

	// ����-������ ��������
	if(!$params->get('header')) {
		$params->set('header', $section->name);
	}

	ob_start();
		HTML_content::showSectionCatlist($section, $access, $params);
		$content_boby = ob_get_contents(); // ������� ���������� - ���� ������ ���������� - mainbody
	ob_end_clean();

	unset($params->_raw,$params->section_data,$params->menu->params);

	return array('content' => $content_boby, 'params' => $params);
}

function showTableCategory($id,$cache){
	global $my;

	$limit = intval(mosGetParam($_REQUEST, 'limit', 0));
	$limitstart = intval(mosGetParam($_REQUEST, 'limitstart', 0));
	$sectionid = intval(mosGetParam($_REQUEST, 'sectionid', 0));
	$selected = strval(mosGetParam($_REQUEST, 'order', ''));
	$filter = stripslashes(strval(mosGetParam($_REQUEST, 'filter', '')));

	$r = $cache->call('_showTableCategory', $id,$my->gid,$limit,$limitstart,$sectionid,$selected,$filter);
	from_cache($r);
}

/**
 * ����� ������� ����������� ���������
 *
 * @param int The category id
 */
function _showTableCategory($id,$gid,$limit,$limitstart,$sectionid,$selected,$filter) {
	global $Itemid, $my;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	$selected = preg_replace('/[^a-z]/i', '', $selected);

	if(!$id) {
		$error = new errorCase(1);
		return;
	}

	//����� �������
	$access = new contentAccess();

	//������ ������ ���������
	$category = new mosCategory($database);
	if(!($category->load((int)$id))) {
		$error = new errorCase(1);
		return;
	}
	//������ ������ �������
	$section = new mosSection($database);
	if(!($section->load((int)$category->section))) {
		$error = new errorCase(1);
		return;
	}
	$category->section_data = $section;

	//��������� ����� ������� � ������� � ���������
	if(!$section->published || !$category->published) {
		$error = new errorCase(2);
		return;
	}
	if($section->access > $my->gid || $category->access > $my->gid) {
		$error = new errorCase(2);
		return;
	}

	//��������� ���������� �������� ������� ���������
	$params = contentPageConfig::setup_table_category_page($category);

	$lists['order_value'] = '';
	if($selected) {
		$orderby = $selected;
		$lists['order_value'] = $selected;
	} else {
		$orderby = $params->get('orderby', 'rdate');
		$selected = $orderby;
	}
	$params->def('orderby', $orderby);
	$params->def('cur_filter', $filter);
	$params->def('selected', $selected);

	if($sectionid == 0) {
		$sectionid = $category->section;
	}

	//������ ������ ��������� �������
	$category->other_categories = $category->get_other_cats($category, $access, $params);

	$content = new mosContent($database);

	// query to determine total number of records
	//�������� ����� ���������� ������� � ������� ���������
	$category->total = $content->_get_result_table_category($category, $params, $access);

	$limit = $limit?$limit : $params->get('display_num');
	if($category->total <= $limit) {
		$limitstart = 0;
	}
	$params->set('limitstart', $limitstart);
	$params->set('limit', $limit);

	//�������� ��� ������ ������
	$category->content = $content->_load_table_category($category, $params, $access);

	// remove slashes
	$category->name = stripslashes($category->name);

	$params->category_data = $category;
	$params->section_data = $section;
	$params->page_type = 'category_table';

	// ����-������ ��������
	if(!$params->get('header')) {
		$params->set('header', $category->name);
	}

	ob_start();
		HTML_content::showContentList($category, $access, $params);
		$content_boby = ob_get_contents(); // ������� ���������� - ���� ������ ���������� - mainbody
	ob_end_clean();

	unset($params->category_data,$params->_db,$params->section_data);

	return array('content' => $content_boby, 'params' => $params);

}

function showBlogSection($id = 0,$gid=0) {
	$pop = intval(mosGetParam($_REQUEST, 'pop', 0));
	$limit = intval(mosGetParam($_REQUEST, 'limit', 0));
	$limitstart = intval(mosGetParam($_REQUEST, 'limitstart', 0));

	$cache = &mosCache::getCache('com_content');
	$r = $cache->call('_showBlogSection', $id,$gid,$pop,$limit,$limitstart);
	from_cache($r);
}

/**
 * ����� ����� �������
 *
 * @param int The section id
 */
function _showBlogSection($id,$gid,$pop,$limit,$limitstart) {
	global $Itemid, $my;

	$mainframe = &mosMainFrame::getInstance();
	$database  = &database::getInstance();
	
	$section = new mosSection($database);
	//���� ID ������ - �������� ������ � ���������� �������
	if($id){
		//ID ��������, �� ������� � ����� ID �� ����������
		//������ ������
		if(!($section->load((int)$id))) {
			$error = new errorCase(1);
			return; 
		}
		
		//��������� ����� ������� � �������
		//���� ������ �� ����������� ��� ������ ������������ ���� ������ �������
		//- ����� ��������� � ������������� �������
		if(!$section->published) {
			$error = new errorCase(2);
			return;
		}
		if($section->access > $my->gid) {
			$error = new errorCase(2);
			return;
		}		
	}

	//����� �������
	$access = new contentAccess();

	//��������� ���������� �������� ����� �������
	$params = contentPageConfig::setup_blog_section_page($id);
	$params->def('pop', $pop);
	$params->page_type = 'section_blog';

	//���������� ������� �� ��������
	$limit = $limit ? $limit : ($params->get('intro') + $params->get('leading') + $params->get('link'));

	$content = new mosContent($database);
	//�������� ����� ���������� ������� � �����
	$section->total = $content->_get_result_blog_section($section, $params, $access);

	//������������� ������������� ��������� $limit � $limitstart
	if($section->total <= $limit) {
		$limitstart = 0;
	}
	$params->set('limitstart', $limitstart);
	$params->set('limit', $limit);

	//�������� ��� ������ ������ ������
	$section->content = $content->_load_blog_section($section, $params, $access);

	$params->section_data = $section;

	// ����-������ ��������
	if(!$params->get('header')) {
		$params->set('header', $section->name);
	}

	ob_start();
		BlogOutput($section, $params, $access);
		$content_boby = ob_get_contents(); // ������� ���������� - ���� ������ ���������� - mainbody
	ob_end_clean();

	unset($params->_db,$params->section_data->_db,$params->section_data->_db,$params->section_data->content);
	return array('content' => $content_boby, 'params' => $params);
}

/**
 * ����� ����� ���������
 *
 * @param int The category id
 */
function showBlogCategory($id = 0,$gid=0) {

	$pop = intval(mosGetParam($_REQUEST, 'pop', 0));
	$limit = intval(mosGetParam($_REQUEST, 'limit', 0));
	$limitstart = intval(mosGetParam($_REQUEST, 'limitstart', 0));

	$cache = &mosCache::getCache('com_content');
	$r = $cache->call('_showBlogCategory', $id,$gid,$pop,$limit,$limitstart);
	from_cache($r);
}

function _showBlogCategory($id = 0,$gid,$pop,$limit,$limitstart) {
	global $Itemid, $my;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	//����� �������
	$access = new contentAccess();

	//��������� ���������� �������� ����� ���������
	$params = contentPageConfig::setup_blog_category_page($id);

	//���������� ������� �� ��������
	$limit = $limit?$limit : ($params->get('intro') + $params->get('leading') + $params->get('link'));


	$category = new mosCategory($database);
	$section = new mosSection($database);
	
	if($id){
		if(!($category->load((int)$id))) {
			$error = new errorCase(1);
			return;
		}
		//������ ������ �������	
		if(!($section->load((int)$category->section))) {
			$error = new errorCase(1);
			return;
		}
		
		//��������� ����� ������� � ������� � ���������
		//���� ������/��������� �� ������������ ��� ������ ������������ ���� ������ �������
		//- ����� ��������� � ������������� �������
		if(!$section->published || !$category->published) {
			$error = new errorCase(2);
			return;
		}
		if($section->access > $my->gid || $category->access > $my->gid) {
			$error = new errorCase(2);
			return;
		}		
	}

	$category->section = $section;

	$content = new mosContent($database);
	//�������� ����� ���������� ������� � �����
	$category->total = $content->_get_result_blog_category($category, $params, $access);

	if($category->total <= $limit) {
		$limitstart = 0;
	}
	$params->set('limitstart', $limitstart);
	$params->set('limit', $limit);

	//�������� ��� ������ ������ ������
	$category->content = $content->_load_blog_category($category, $params, $access);

	$params->category_data = $category;
	$params->section_data = $section;
	$params->def('pop', $pop);
	$params->page_type = 'category_blog';

	ob_start();
		BlogOutput($category, $params, $access);
		$content_boby = ob_get_contents(); // ������� ���������� - ���� ������ ���������� - mainbody
	ob_end_clean();

	unset($params->_db,$params->section_data->_db,$params->section_data->_db,$params->section_data->content);
	return array('content' => $content_boby, 'params' => $params);
}

/**
 * ����� ������ �������
 *
 * @param int The section id
 */
function showArchiveSection($id = null) {
	global $Itemid, $my;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	$year = intval(mosGetParam($_REQUEST, 'year', date('Y')));
	$month = intval(mosGetParam($_REQUEST, 'month', date('m')));
	$module = intval(mosGetParam($_REQUEST, 'module', 0));

	$pop = intval(mosGetParam($_REQUEST, 'pop', 0));
	$limit = intval(mosGetParam($_REQUEST, 'limit', 0));
	$limitstart = intval(mosGetParam($_REQUEST, 'limitstart', 0));

	if(!$id) {
		$error = new errorCase(1);
		return;
	}

	//����� �������
	$access = new contentAccess();

	//��������� ���������� �������� ����� �������
	$params = contentPageConfig::setup_blog_archive_section_page($id);
	$params->set('year', $year);
	$params->set('month', $month);
	$params->set('intro_only', 1);

	//���������� ������� �� ��������
	$limit = $limit?$limit : ($params->get('intro') + $params->get('leading') + $params->get('link'));

	//������ ������ �������
	$section = new mosSection($database);
	if(!($section->load((int)$id))) {
		$error = new errorCase(1);
		return;
	}

	//��������� ����� ������� � �������
	//���� ������ �� ����������� ��� ������ ������������ ���� ������ �������
	//- ����� ��������� � ������������� �������
	if(!$section->published) {
		$error = new errorCase(2);
		return;
	}
	if($section->access > $my->gid) {
		$error = new errorCase(2);
		return;
	}

	$content = new mosContent($database);
	//�������� ����� ���������� ������� � �����
	$section->total = $content->_get_result_archive_section($section, $params, $access);

	//������������� ������������� ��������� $limit � $limitstart
	if($section->total <= $limit) {
		$limitstart = 0;
	}
	$params->set('limitstart', $limitstart);
	$params->set('limit', $limit);

	//�������� ��� ������ ������ ������
	$section->content = $content->_load_archive_section($section, $params, $access);

	$params->section_data = $section;
	$params->def('pop', $pop);
	$params->page_type = 'section_archive';

	// ����-������ ��������
	$meta = new contentMeta($params);
	$meta->set_meta();

	BlogOutput($section, $params, $access);

}

/**
 * ����� ������ ���������
 *
 * @param int The category id
 */
function showArchiveCategory($id = 0) {
	global $Itemid, $my;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	$year = intval(mosGetParam($_REQUEST, 'year', date('Y')));
	$month = intval(mosGetParam($_REQUEST, 'month', date('m')));
	$module = intval(mosGetParam($_REQUEST, 'module', 0));

	$pop = intval(mosGetParam($_REQUEST, 'pop', 0));
	$limit = intval(mosGetParam($_REQUEST, 'limit', 0));
	$limitstart = intval(mosGetParam($_REQUEST, 'limitstart', 0));

	if(!$module && !$id) {
		$error = new errorCase(1);
		return;
	}

	//����� �������
	$access = new contentAccess();

	//��������� ���������� �������� ����� ���������
	$params = contentPageConfig::setup_blog_archive_category_page($id);
	$params->set('year', $year);
	$params->set('month', $month);
	$params->def('module', $module);

	//���������� ������� �� ��������
	$limit = $limit?$limit : ($params->get('intro') + $params->get('leading') + $params->get('link'));

	if(!$params->get('module')) {
		//������ ������ ���������
		$category = new mosCategory($database);
		if(!($category->load((int)$id))) {
			$error = new errorCase(1);
			return;
		}
		//������ ������ �������
		$section = new mosSection($database);
		if(!($section->load((int)$category->section))) {
			$error = new errorCase(1);
			return;
		}
		$category->section = $section;

		//��������� ����� ������� � ������� � ���������
		//���� ������/��������� �� ������������ ��� ������ ������������ ���� ������ �������
		//- ����� ��������� � ������������� �������
		if(!$section->published || !$category->published) {
			$error = new errorCase(2);
			return;
		}
		if($section->access > $my->gid || $category->access > $my->gid) {
			$error = new errorCase(2);
			return;
		}
		$params->page_type = 'category_archive';
	} else {
		$category = new stdClass();

		$section = new stdClass();
		$params->page_type = 'archive_by_month';
		$params->def('header', '�����');
	}

	$content = new mosContent($database);

	//�������� ����� ���������� ������� � ����� ������ ���������
	$category->total = $content->_get_result_blog_archive_category($category, $params, $access);

	if($category->total <= $limit) {
		$limitstart = 0;
	}
	$params->set('limitstart', $limitstart);
	$params->set('limit', $limit);

	//���������, ���� �� ������ � ���� �������� ���������
	$category->archives = $content->check_archives_categories($category, $params);

	//�������� ��� ������ ������ ������
	$category->content = $content->_load_blog_archive_category($category, $params, $access);

	$params->def('pop', $pop);
	$params->category_data = $category;
	$params->section_data = $section;

	// ����-������ ��������
	$meta = new contentMeta($params);
	$meta->set_meta();

	BlogOutput($category, $params, $access);
}

function BlogOutput(&$obj, $params, &$access) {
	global $Itemid, $task, $id, $option, $my;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	$rows = $obj->content;
	$total = $obj->total;

	$gid = $my->gid;

	$menu = $params->menu;
	$limitstart = $params->get('limitstart');
	$limit = $params->get('limit');
	$pop = $params->get('pop');

	$archive = null;
	$archive_page = null;
	if($params->page_type == 'section_archive' || $params->page_type == 'category_archive' || $params->page_type == 'archive_by_month') {
		$archive = 1;
	}

	$i = 0;
	$header = '';
	$display_desc = 0;
	$display_desc_img = 0;
	$display_desc_text = 0;
	$display_pagination = 0;
	$display_pagination_results = 0;
	$display_blog_more = 0;
	$tpl = '';

	$header = $params->get('header');
	if(!$header) {
		$header = $obj->name;
	}

	$columns = $params->get('columns');
	if($columns == 0) {
		$columns = 1;
	}

	$intro = $params->get('intro');
	$leading = $params->get('leading');
	$links = $params->get('link');
	$pagination = $params->get('pagination');
	$pagination_results = $params->get('pagination_results');
	$descrip = $params->get('description');
	$descrip_image = $params->get('description_image');

	//����������� �� ����������
	$group_cat = $params->get('group_cat');
	$groupcat_limit = $params->get('groupcat_limit');
	$cats_arr = array();
	$k = 0;

	$sfx = $params->get('pageclass_sfx');

	//��������� ���������� ������� � �����
	$params = contentPageConfig::setup_blog_item($params);

	// used to display section/catagory description text and images
	// currently not supported in Archives
	if($params->get('description') && ($descrip || $descrip_image)) {
		$display_desc = 1;

		switch ($params->page_type) {
			case 'section_blog':
			case 'category_blog':
				$description = $obj->description;
				$description_img = $obj->image;
				break;

			case 'frontpage':
			default:
				$menu->componentid = 0;
				$description = '';
				$description_img = '';
				break;
		}

		if($params->get('description_image') && $description_img) {
			$display_desc_img = 1;
		}
		if($params->get('description') && $description) {
			$display_desc_text = 1;
		}
	}

	// checks to see if there are there any items to display
	if($total) {
		$col_with = 100 / $columns; // width of each column
		$width = 'width="'.intval($col_with).'%"';

		if($archive) {
			// Search Success message
			$msg = sprintf(_ARCHIVE_SEARCH_SUCCESS, $params->get('month'), $params->get('year'));
		}

		// Links output
		if($links && ($i < $total - $limitstart)) {
			$display_blog_more = 1;
			$showmore = $leading + $intro;
		}

		// Pagination output
		if($pagination) {
			if(($pagination == 2) && ($total <= $limit)) {
				// not visible when they is no 'other' pages to display
			} else {
				$display_pagination = 1;
				$limitstart = $limitstart?$limitstart : 0;

				mosMainFrame::addLib('pageNavigation');
				$pageNav = new mosPageNav($total, $limitstart, $limit);

				if($Itemid && $Itemid != 99999999) {
					// where Itemid value is returned, do not add Itemid to url
					$Itemid_link = '&amp;Itemid='.$Itemid;
				} else {
					// where Itemid value is NOT returned, do not add Itemid to url
					$Itemid_link = '';
				}

				if($option == 'com_frontpage') {
					$link = 'index.php?option=com_frontpage'.$Itemid_link;
				} else
					if($archive_page) {
						$year = $params->get('year');
						$month = $params->get('month');

						if(!$archive) {
							// used when access via archive module
							$pid = '&amp;id=0';
							$module = '&amp;module=1';
						} else {
							// used when access via menu item
							$pid = '&amp;id='.$id;
							$module = '';
						}

						$link = 'index.php?option=com_content&amp;task='.$task.$pid.$Itemid_link.'&amp;year='.$year.'&amp;month='.$month.$module;
					} else {
						$link = 'index.php?option=com_content&amp;task='.$task.'&amp;id='.$id.$Itemid_link;
					}

					if($pagination_results) {
						$display_pagination_results = 1;
					}
			}
		}
	} else
		if($archive && !$total) {
			$msg = sprintf(_ARCHIVE_SEARCH_FAILURE, $params->get('month'), $params->get('year'));
		}

	//����
	$tags = new contentTags($database);
	$all_tags = $tags->load_by_type('com_content');
	$tags_arr = array();
	foreach ($all_tags as $tag) {
		$tag->tag = '<a class="tag" href="'.$tags->get_tag_url($tag->tag).'">'.$tag->tag.'</a>';
		if(array_key_exists($tag->obj_id, $tags_arr)) {
			$tags_arr[$tag->obj_id] .= ', '.$tag->tag;
		} else {
			$tags_arr[$tag->obj_id] = $tag->tag;
		}
	}

	$template = new ContentTemplate();
	$templates = null;
	//���������� ������ ������ ��������

	//���� ��� �����
	if($archive) {
		switch ($task) {
				//����� �������
			case 'archivesection':
			default:
				$page_type = 'section_archive';
				$templates = $params->section_data->templates;
				break;

				//����� ���������
			case 'archivecategory':
				$page_type = 'category_archive';

				if($params->get('module')) {
					include_once ($mainframe->getCfg('absolute_path').'/components/com_content/view/category/archive_by_month/default.php');
					return;
				}

				if($template->isset_settings($page_type, $params->category_data->templates)) {
					$templates = $params->category_data->templates;
				} elseif($template->isset_settings($page_type, $params->section_data->templates)) {
					$templates = $params->section_data->templates;
				}
				break;
		}
	}

	//���� ��� ������� �������� - ��������� 'com_frontpage'
	else{
		if($_REQUEST['option'] == 'com_frontpage') {
			include_once ($mainframe->getCfg('absolute_path').'/components/com_content/view/frontpage/default.php');
			return;
		}else { //�� ������� �������� � �� ����� - ������� ���� ������� ��� ���������
			switch ($task) {
				case 'blogcategory':
				default:
					$page_type = 'category_blog';
					//��������� ��������� ��������� �� �������  ��������� �������
					if($template->isset_settings($page_type, $params->category_data->templates)) {
						$templates = $params->category_data->templates;
					//����� - ��������� ��������� �������
					}elseif($template->isset_settings($page_type, $params->section_data->templates)) {
						$templates = $params->section_data->templates;
					}

					break;

				case 'blogsection':
					//���� ����������� �� ���������� ��������� - ��������� ����� ��� � ��� ������
					if(!$group_cat) {
						$page_type = 'section_blog';
					//���� �������� ����������� �� ����������
					}else {
						$page_type = 'section_groupcats';
						$counts = array();
						$k = 0;
						foreach ($rows as $row) {
							if(!key_exists($row->catid, $counts)) {
								$counts[$row->catid] = 1;
							}
							if($counts[$row->catid] <= $groupcat_limit) {
								$cats_arr[$row->catid]['obj'][] = $row;
								$cats_arr[$row->catid]['cat_name'] = $row->category;
								$counts[$row->catid]++;
								$k++;
							}
						}
					}
					$templates = $params->section_data->templates;
					break;
			}
		}
	}
	$template->set_template($page_type, $templates);
	include_once ($template->template_file);
}

// ����������� � ����������� ����-�����
function showFullItem($id,$gid=0,$cache){
	$config = &Jconfig::getInstance();
	if($config->config_enable_stats) {
		$r =_showFullItem($id);
	} else {
		$r = $cache->call('_showFullItem', $id,$gid);
	}
	from_cache($r);
}

/**
 * �������� ��������� ���������
 *
 * @param int The item id
 */
function _showFullItem($id) {
	global $my;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	$pop = intval(mosGetParam($_REQUEST, 'pop', 0));
	$task = strval(mosGetParam($_REQUEST, 'task', ''));

	//����� �������
	$access = new contentAccess();

	$where = mosContent::_construct_where_for_fullItem($access);

	// voting control
	$params = new mosParameters('');
	$params->def('rating', $mainframe->getCfg('vote'));
	$voting = new contentVoiting($params);
	$voting = $voting->_construct_sql();

	// main query
	$query = "SELECT a.*,
	cc.name AS category, cc.templates as c_templates, cc.access AS cat_access, cc.id as cat_id, cc.published AS cat_pub,
	s.name AS section, s.published AS sec_pub, s.id AS sec_id, s.templates as s_templates, s.access AS sec_access,
	u.name AS author, u.usertype, u.username,
	g.name AS groups
	".$voting['select']."
	FROM #__content AS a
	LEFT JOIN #__categories AS cc ON cc.id = a.catid
	LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope = 'content'
	LEFT JOIN #__users AS u ON u.id = a.created_by
	LEFT JOIN #__groups AS g ON a.access = g.id
	".$voting['join']."
	WHERE a.id = ".(int)$id.$where;
	$database->setQuery($query);
	$row = null;

	if($database->loadObject($row)) {

		if($task == 'preview' && $my->id != $row->created_by) {
			mosNotAuth();
			return;
		}

		/*
		* check whether category is published
		*/
		if(!$row->cat_pub && $row->catid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether section is published
		*/
		if(!$row->sec_pub && $row->sectionid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether category access level allows access
		*/
		if(($row->cat_access > $my->gid) && $row->catid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether section access level allows access
		*/
		if(($row->sec_access > $my->gid) && $row->sectionid) {
			mosNotAuth();
			return;
		}

		//������������� ����������� ��������� ��������
		$params = new mosParameters($row->attribs);
		$params = contentPageConfig::setup_full_item_page($row, $params);
		$params->def('pop', $pop);

		// loads the links for Next & Previous Button
		if($params->get('item_navigation')) {
			$row->prev = '';
			$row->next = '';
			$row = mosContent::get_prev_next($row, $where, $access, $params);
		}

		//����
		$tags = new contentTags($database);
		$row->tags = $tags->load_by($row);
		$row->tags = $tags->arr_to_links($row->tags, ', ');

		// ����-������ ��������
		$meta_params = new mosParameters('');
		$meta_params = $params;
		$meta_params->object->title = $row->title;
		$meta_params->object->created_by_alias = $row->created_by_alias;
		$meta_params->object->author = $row->author;
		$meta_params->object->description = $row->metadesc;
		$meta_params->object->metakey = $row->metakey;
		$meta_params->page_type = $params->page_type;
		// ������� ������ �������, ��� ����-����� ��� �� �������������, � � ���� �� �����
		unset($meta_params->_raw,$meta_params->section_data->_db,$meta_params->category_data->_db);

		// �������� ���������� �������� � ����� - ��� �����������
		ob_start();
			_showItem($row, $params, $my->gid, $access, $pop);
			$content_boby = ob_get_contents(); // ������� ���������� - ���� ������ ���������� - mainbody
		ob_end_clean();

		return array('content' => $content_boby, 'params' => $meta_params);
	} else {
		return mosNotAuth();
	}
}

/**
 * ����� ��������� � �����
 */
function _showItem($row, $params, $gid, &$access, $pop, $template = '') {
	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	$noauth = !$mainframe->getCfg('shownoauth');

	if($access->canEdit) {
		if($row->id === null || $row->access > $gid) {
			mosNotAuth();
			return;
		}
	} else {
		if($row->id === null || $row->state == 0) {
			mosNotAuth();
			return;
		}
		if($row->access > $gid) {
			if($noauth) {
				mosNotAuth();
				return;
			} else {
				if(!($params->get('intro_only'))) {
					mosNotAuth();
					return;
				}
			}
		}
	}

	// if a popup item (e.g. print page) set popup param to correct value
	if($pop) {
		$params->set('popup', 1);
	}

	if(!$params->get('rating')) {
		$row->rating = null;
		$row->rating_count = null;
	}

	$row->category = htmlspecialchars(stripslashes($row->category), ENT_QUOTES);

	//������ �� ������/���������
	if($params->get('section_link') || $params->get('category_link')) {

		// ������ �� ������
		if($params->get('section_link') && $row->sectionid) {
			$section_link = mosSection::get_section_link($row, $params);
			$row->section = '<a href="'.$section_link.'">'.$row->section.'</a>';
		}

		// ������ �� ���������
		if($params->get('category_link') && $row->catid) {
			$category_link = mosCategory::get_category_link($row, $params);
			$row->category = '<a href="'.$category_link.'">'.$row->category.'</a>';
		}
	}

	// show/hides the intro text
	if($params->get('introtext')) {
		$row->text = $row->introtext.($params->get('intro_only')?'' : chr(13).chr(13).$row->fulltext.chr(13).chr(13).$row->notetext);
	} else {
		$row->text = $row->fulltext;
	}

	//����� �����������
	$limit_introtext = $params->get('introtext_limit', 0);
	if($limit_introtext) {
		mosMainFrame::addLib('text');
		$row->text = Text::word_limiter($row->text, $limit_introtext, '');
	}

	// deal with the {mospagebreak} mambots
	// only permitted in the full text area
	$page = intval(mosGetParam($_REQUEST, 'limitstart', 0));

	// ������ �������� ���������
	if(!$params->get('intro_only') && ($page == 0) && ($mainframe->getCfg('content_hits'))) {
		$obj = new mosContent($database);
		$obj->hit($row->id);
	}

	// needed for caching purposes to stop different cachefiles being created for same item
	// does not affect anything else as hits data not outputted
	$row->hits = 0;

	HTML_content::show($row, $params, $access, $page, $template);
}

/**
 * �������������� ���������
 */
function editItem($task) {
	global $my, $gid;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();
	$acl = &gacl::getInstance();

	if($mainframe->getCfg('module_on_edit_off') == 1) {
		$GLOBALS['_MOS_MODULES'] = '';
	}

	$nullDate = $database->getNullDate();
	$lists = array();

	//$id �������������� � �������� ������ ������ � ��� ������, ���� ������������ ����������� ��������
	$id = intval(mosGetParam($_REQUEST, 'id', 0));
	//$section ����� �������������� � ������, ���� ����� ��������� ��� ������-�� ����������� �������  � ��� ���������� ������
	$section = intval(mosGetParam($_REQUEST, 'section', 0));

	//��-��������� � '__menus' ���������� ������ � ������ ����,
	//� ������� �������� ������������� ����������/�������������� ���� ������� (���������� �� �������)
	$link = 'index.php?option=com_content&task=new';
	$special_params = 0;

	// Editor usertype check
	$access = new stdClass();
	$access->canEdit = $acl->acl_check('action', 'edit', 'users', $my->usertype, 'content', 'all');
	$access->canEditOwn = $acl->acl_check('action', 'edit', 'users', $my->usertype, 'content', 'own');
	$access->canPublish = $acl->acl_check('action', 'publish', 'users', $my->usertype, 'content', 'all');

	//������� ������
	$content = new mosContent($database);

	//���� ��� ���������� ����� ������
	if($task == 'new') {
		$row = $content;
		//��������� ������ ���, ���� ���� - � ���� ��� ���� �� �� �������������� ������, �� �� �������������� ������ ��������
		if(!($access->canEdit || $access->canEditOwn)) {
			HTML_content::_no_access();
			return;
		}

		//���� � ������, �� ������� ������������ ������ ��������� �������, �������������� 'section' -
		//���� � ���� ����� ����, � ������� �������� ������������� ����� ������ ��� �������� �������
		if($section) {
			$link = 'index.php?option=com_content&task=new&section='.(int)$section;
			$special_params = 1;
		}

		//������ �� ������ � ������ ����
		$query = "SELECT id, params FROM #__menu WHERE (link LIKE '%$link') AND published = 1";
		$r = null;
		$database->setQuery($query);
		$database->loadObject($r);
		$exists = $r;
	}

	//���� ��� �������������� ������
	else
		if($task == 'edit') {
			$row = $content->get_item((int)$id);

			$section = $row->sectionid;
			// ��������� ������
			if(!($access->canEdit || ($access->canEditOwn && $row->created_by == $my->id))) {
				mosNotAuth();
				return;
			}

			// ������� ���������, ���� ������ ������ ������ ������������� ���-�� ������
			if($content->isCheckedOut($my->id)) {
				mosErrorAlert("[ ".$row->title." ] "._CONTENT_IS_BEING_EDITED_BY_OTHER_PEOPLE);
			}

			//��� ��������, � ������� ����� ������������ ������ �� ����������/��������������
			$link1 = 'index.php?option=com_content&task=new&section='.(int)$section;
			$link2 = 'index.php?option=com_content&task=new';

			//������ �� ������ � ������ ����
			$query = "SELECT a.id AS menu_id2, a.params AS menu_params2 , b.id AS menu_id1, b.params AS menu_params1
				FROM #__menu AS a
				LEFT JOIN  #__menu AS b  ON  b.link LIKE '%$link1' AND b.published = 1
				WHERE  a.link LIKE '%$link2' AND a.published = 1";
			$database->setQuery($query);
			$exists = $database->loadObjectList();
		}

	if(!$exists) {
		mosNotAuth();
		return;
	}

	//���� ��� ���������� ����� ������ - ��� ������, �������� ��������� ��� ��������
	if($task == 'new') {
		$params = new mosParameters($exists->params);
	}
	//���� �� ��� �������������� - �� ����� ����������, ����� ������ ��������� ����� ����������
	//- �� �������� ������ ��-���������, ��� �� ���� ��������� ��� �������� �������
	else {
		//��������, ���� �� ����������� ���������
		if(isset($exists[0]->menu_id1)) {
			$params = new mosParameters($exists[0]->menu_params1);
			$special_params = 1;
		}
		//����� ��������, ���������� �� ��������� ��-���������
		else
			if(isset($exists[0]->menu_id2)) {
				$params = new mosParameters($exists[0]->menu_params2);
			}
		//�� � ���, �� ������ ������. � �����!
			else {
				$menu = $mainframe->get('menu');
				$params = new mosParameters($menu->params);
			}
	}

	// ��������� ���������� �� �������� ������ � ����
	$ids_user = $params->get('ids_user', 0); // ��������� �������� ID
	$ids_action = $params->get('ids_action', 0); // ��� ��������� ��������� ID

	$where_c = "";
	$where_s = "";
	if($ids_action && $ids_user) {
		switch ($ids_action) {
			case '1': //��������� ���������� ������ � ��������� ��������
			default:
				$where_s = " AND ( s.id IN (".$ids_user.") )";
				//���� ���� ����������� ��������� ��� ������� - ���������� �������� ID ��������, ������ ����� ������������
				//��������� ���� ���� ����������� ��������� -  ������ ����� ���� ��������� ������ � ������������ ������
				if($special_params) {
					$where_s = " ";
				}
				break;

			case '2': //��������� ���������� ������ � ��������� ����������
				$where_c = " AND ( c.id IN (".$ids_user.") )";
				break;

			case '3': //��������� ���������� � ��������� ��������
				$where_s = " AND ( s.id NOT IN (".$ids_user.") )";
				if($special_params) {
					$where_s = " ";
				}
				break;

			case '4': //��������� ���������� � ��������� ����������
				$where_c = " AND ( c.id NOT IN (".$ids_user.") )";
				break;
		}
	}

	if($task == 'edit') {
		$content->checkout($my->id);

		$row->created = mosFormatDate($row->created, _CURRENT_SERVER_TIME_FORMAT);
		$row->modified = $row->modified == $nullDate?'' : mosFormatDate($row->modified, _CURRENT_SERVER_TIME_FORMAT);
		$row->publish_up = mosFormatDate($row->publish_up, _CURRENT_SERVER_TIME_FORMAT);

		if(trim($row->publish_down) == $nullDate || trim($row->publish_down) == '' || trim($row->publish_down) == '-') {
			$row->publish_down = _NEVER;
		}
		$row->publish_down = mosFormatDate($row->publish_down, _CURRENT_SERVER_TIME_FORMAT);

		$row->creator = $row->author_nickname;
		$row->modifier = $row->modifier_nickname;
		if($row->created_by == $row->modified_by) {
			$row->modifier = $row->creator;
		}

		$query = "SELECT content_id FROM #__content_frontpage WHERE content_id = ".(int)$row->id;
		$database->setQuery($query);
		$row->frontpage = $database->loadResult();

		if($row->sectionid) {
			$sec = new mosSection($database);
			$sec->templates = $row->s_templates;
			$params->section_data = $sec;
		}

	} else {
		$row->sectionid = $section;
		$row->version = 0;
		$row->ordering = 0;
		$row->images = array();
		$row->publish_up = date('Y-m-d H:i:s', time() + ($mainframe->getCfg('offset') * 60 * 60));
		$row->publish_down = _NEVER;
		$row->creator = 0;
		$row->modifier = 0;
		$row->frontpage = 0;
		$params->section_data = null;
		//���������� ��������
		// Publishing state hardening for Authors
		$auto_publish = $params->get('auto_publish', 0);

		if(!$auto_publish) { //���� ������ ������ �������� - ����� �� �������
			if(!$access->canPublish) {
				$row->state = 0;
			} else {
				$row->state = 1;
			}
		} else {
			$row->state = 1;
		}

		if($section) {
			$sec = new mosSection($database);
			$sec->load((int)$section);
			$params->section_data = $sec;
		}

	}

	// make the select list for the states
	$states[] = mosHTML::makeOption(0, _UNPUBLISHED);
	$states[] = mosHTML::makeOption(1, _PUBLISHED);
	$lists['state'] = mosHTML::selectList($states, 'state', 'class="inputbox" size="1"', 'value', 'text', intval($row->state));

	// build the html select list for ordering
	$query = "SELECT ordering AS value, title AS text FROM #__content WHERE catid = ".(int)$row->catid." ORDER BY ordering";
	$lists['ordering'] = mosAdminMenus::SpecificOrdering($row, $id, $query, 1);

	//$database->setQuery("SELECT CONCAT(s.id,'/',c.id) as value, CONCAT(s.name,'/',c.name) as text  FROM #__categories AS c ,#__sections AS s where s.id=c.section  ");
	//$z_cats_main = $database->loadObjectList();
	//$lists['catid'] = mosHTML::selectList($rows,'catid','class="inputbox" size="1"','value','text',intval($row->catid));

	//--->>>������ selectlist ��� ������ ���������, � ������� ����� ������������ ��������: BEGIN---<<<

	//���� ���� ����������� ��������� ��� ���������� ��������� � ������
	//�������� ������ ���������, ������������� ������� �������
	if($special_params) {
		$database->setQuery(" SELECT  CONCAT(c.section,'*',c.id) AS cid , c.title AS c_title, c.section  FROM   #__categories AS c WHERE c.section=$section AND c.published=1 $where_c ORDER BY c.title ASC ");
		$cids = $database->loadObjectList();
		//$cats[] = mosHTML::makeOption('-1','�������� ���������','id','c_title');
		//$cats = array_merge($cats,$cids);
		$lists['catid'] = mosHTML::selectList($cids, 'catid', 'class="inputbox" size="1"', 'cid', 'c_title', intval($row->catid).'*'.($row->sectionid));
	}
	//���� �� ��� ��������� �� ��������� - ����� ��������� ������, � ������� ������������ � �������, � ���������
	else {
		$database->setQuery(" SELECT  c.id AS cid , c.title AS c_name, c.section  FROM   #__categories AS c WHERE c.published=1 $where_c ORDER BY title ASC ");
		$cids = $database->loadObjectList();

		$database->setQuery(" SELECT   s.id, s.title  FROM  #__sections AS s WHERE s.published=1 $where_s ORDER BY title ASC");
		$sids = $database->loadObjectList();

		//����� �������, ���� �� ���������� ((
		$return = "<select name=\"catid\" class=\"inputbox\" size=\"1\">";
		$cids_arr = array();
		$i2 = 0;
		$i3 = 0;
		foreach ($cids as $row2) {
			$cids_arr[$i2]['cat_name'] = $row2->c_name;
			$cids_arr[$i2]['parent'] = $row2->section;
			$cids_arr[$i2]['cid'] = $row2->cid;
			$i2++;
		}

		foreach ($sids as $row3) {
			$return .= "<option value=\"\" disabled=\"disabled\" style=\"color:#EF3527;\">".$row3->title."</option>";
			foreach ($cids_arr as $v) {
				if($v['parent'] == $row3->id) {
					if($v['cid'] == $row->catid) {
						$extra = " selected=\"selected\"";
					} else {
						$extra = "";
					}
					$return .= "<option value=\"".$row3->id."*".$v['cid']."\"$extra>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ".$v['cat_name']."</option>";
				}
			}
			$i3++;
		}

		$return .= "</select>";
		$lists['catid'] = $return;
	}
	//--->>>������ selectlist ��� ������ ���������, � ������� ����� ������������ ��������: END---<<<

	// build the html select list for the group access
	$lists['access'] = mosAdminMenus::Access($row);

	$page = new stdClass();
	$page->params = $params;
	$page->access = $access;
	$page->params->page_type = 'item_edit';

	$row->lists = $lists;

	//����
	$row->tags = null;
	if($row->id) {
		$tags = new contentTags($database);

		$load_tags = $tags->load_by($row);
		if(count($load_tags)) {
			$row->tags = implode(',', $load_tags);
		}
	}

	// ������� ����������������
	if($mainframe->getCfg('use_content_edit_mambots')) {
		global $_MAMBOTS;
		$_MAMBOTS->loadBotGroup('content');
		$_MAMBOTS->trigger('onEditContent', array($row));
	}

	HTML_content::editContent($row, $page, $task);
}

/**
 * ���������� ���������
 */
function saveContent($task) {
	global $my,$Itemid;

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	// simple spoof check security
	josSpoofCheck();

	//����� �������
	$access = new contentAccess();

	$nullDate = $database->getNullDate();
	$row = new mosContent($database);

	if(!$row->bind($_POST)) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	// sanitise id field
	$row->id = (int)$row->id;

	$isNew = $row->id < 1;
	if($isNew) {
		// new record
		if(!($access->canEdit || $access->canEditOwn)) {
			mosNotAuth();
			return;
		}

		$row->created = date('Y-m-d H:i:s');
		$row->created_by = $my->id;
	} else {
		// existing record
		if(!($access->canEdit || ($access->canEditOwn && $row->created_by == $my->id))) {
			mosNotAuth();
			return;
		}

		$row->modified = date('Y-m-d H:i:s');
		$row->modified_by = $my->id;
	}

	if(strlen(trim($row->publish_up)) <= 10) {
		$row->publish_up .= ' 00:00:00';
	}
	$row->publish_up = mosFormatDate($row->publish_up, _CURRENT_SERVER_TIME_FORMAT, -$mainframe->getCfg('offset'));

	if(trim($row->publish_down) == _NEVER || trim($row->publish_down) == '') {
		$row->publish_down = $nullDate;
	} else {
		if(strlen(trim($row->publish_down)) <= 10) {
			$row->publish_down .= ' 00:00:00';
		}
		$row->publish_down = mosFormatDate($row->publish_down, _CURRENT_SERVER_TIME_FORMAT, -$mainframe->getCfg('offset'));
	}

	// code cleaner for xhtml transitional compliance
	$row->introtext = str_replace('<br>', '<br />', $row->introtext);
	$row->fulltext = str_replace('<br>', '<br />', $row->fulltext);

	// remove <br /> take being automatically added to empty fulltext
	$length = strlen($row->fulltext) < 9;
	$search = strstr($row->fulltext, '<br />');
	if($length && $search) {
		$row->fulltext = null;
	}

	$row->title = ampReplace($row->title);

	// Publishing state hardening for Authors
	//������� ��������� � ������� ��������������

	if(isset($_POST['catid'])) {
		$catid0 = explode('*', $_POST['catid']);
		$row->catid = $catid0[1];
		$row->sectionid = $catid0[0];
	}

	if(!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$row->version++;

	// ������� ����������
	if($mainframe->getCfg('use_content_save_mambots')) {
		global $_MAMBOTS;
		$_MAMBOTS->loadBotGroup('content');
		$_MAMBOTS->trigger('onSaveContent', array($row));
	}

	if(!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	//���������� �����
	$tags = explode(',', $_POST['tags']);
	$tag = new contentTags($database);
	$tags = $tag->clear_tags($tags);
	//������ �����
	$row->obj_type = 'com_content';
	$tag->update($tags, $row);
	//$row->metakey = implode(',', $tags);

	// manage frontpage items
	require_once ($mainframe->getPath('class', 'com_frontpage'));
	$fp = new mosFrontPage($database);

	if(intval(mosGetParam($_REQUEST, 'frontpage', 0))) {
		// toggles go to first place
		if(!$fp->load((int)$row->id)) {
			// new entry
			$query = "INSERT INTO #__content_frontpage VALUES ( ".(int)$row->id.", 1 )";
			$database->setQuery($query);
			if(!$database->query()) {
				echo "<script> alert('".$database->stderr()."');</script>\n";
				exit();
			}
			$fp->ordering = 1;
		}
	} else {
		// no frontpage mask
		if(!$fp->delete((int)$row->id)) {
			$msg .= $fp->stderr();
		}
		$fp->ordering = 0;
	}
	$fp->updateOrder();

	$row->checkin();
	$row->updateOrder("catid = ".(int)$row->catid);

	$msg = $isNew?_THANK_SUB : _E_ITEM_SAVED;

	if($my->usertype == 'Publisher' || $row->state == 1) {
		$msg = _THANK_SUB_PUB;
	}

	$page = new stdClass();
	$page->access = $access;
	$page->task = $task;

	if($isNew) {
		_after_create_content($row, $page);
	} else {
		_after_update_content($row, $page);
	}
}

function _after_create_content($row, $page) {
	global $my, $mosConfig_absolute_path;

	$database = &database::getInstance();

	// gets section name of item
	$query = "SELECT s.title FROM #__sections AS s WHERE s.scope = 'content' AND s.id = ".(int)$row->sectionid;
	$database->setQuery($query);
	// gets category name of item
	$section = $database->loadResult();

	$query = "SELECT c.title FROM #__categories AS c WHERE c.id = ".(int)$row->catid;
	$database->setQuery($query);
	$category = $database->loadResult();
	$category = stripslashes($category);

	// �������� ��������� ������� � ����� ������
	require_once ($mosConfig_absolute_path.'/components/com_messages/messages.class.php');
	$query = "SELECT id FROM #__users WHERE sendEmail = 1";
	$database->setQuery($query);
	$users = $database->loadResultArray();
	foreach ($users as $user_id) {
		$msg = new mosMessage($database);
		$msg->send($my->id, $user_id, _COM_CONTENT_NEW_ITEM, sprintf(_ON_NEW_CONTENT, $my->username, $row->title, $section, $category));
	}

	switch ($page->task) {

			//���� "���������"
		case 'apply':
			//������������ �� �������� ��������������
			$msg = _COM_CONTENT_ITEM_SAVED;
			$link = $_SERVER['HTTP_REFERER'];
			break;

			//���� "���������"
		case 'save':
		default:
			//���� ������ ������������, ���� ������ �� �������� � ������� ������
			if($row->state == 1) {
				$msg = _COM_CONTENT_ITEM_ADDED_THANK;
				$link = 'index.php?option=com_content&task=view&id='.$row->id;
			}
			//����� - ��������� ������ �� ��������������� �������� ������
			else {
				$msg = _COM_CONTENT_ITEM_ADDED;
				$link = 'index.php?option=com_content&task=preview&id='.$row->id;
			}

			break;
	}

	mosRedirect($link, $msg);

}

function _after_update_content($row, $page) {
	global $my;

	switch ($page->task) {
		case 'apply':
			$msg = _COM_CONTENT_ITEM_CHANGES_SAVED;
			$link = $_SERVER['HTTP_REFERER'];
			break;

		case 'save':
		default:
			//���� ������ ������������, ���� ������ �� �������� � ������� ������
			if($row->state == 1) {
				$msg = _COM_CONTENT_ITEM_ALL_CHANGES_SAVED;
				$link = 'index.php?option=com_content&task=view&id='.$row->id;
			}
			//����� - ��������� ������ �� ��������������� �������� ������
			else {
				$msg = _COM_CONTENT_ITEM_ADDED_THANK_2;
				$link = 'index.php?option=com_content&task=preview&id='.$row->id;
			}

	}

	mosRedirect($link, $msg);

}

/**
 * Cancels an edit operation
 */
function cancelContent() {
	global $my, $task;

	$database = &database::getInstance();

	//����� �������
	$access = new contentAccess();

	$row = new mosContent($database);
	$row->bind($_POST);

	if($access->canEdit || ($access->canEditOwn && $row->created_by == $my->id)) {
		$row->checkin();
	}

	$Itemid = intval(mosGetParam($_POST, 'Returnid', '0'));

	$referer = strval(mosGetParam($_POST, 'referer', ''));
	$parts = parse_url($referer);
	parse_str($parts['query'], $query);

	if($task == 'edit' || $task == 'cancel') {
		$Itemid = mosGetParam($_POST, 'Returnid', '');
		$referer = 'index.php?option=com_content&task=view&id='.$row->id.'&Itemid='.$Itemid;
	}

	if($referer && $row->id) {
		mosRedirect($referer);
	} else {
		mosRedirect('index.php');
	}
}

/**
 * Shows the email form for a given content item.
 */
function emailContentForm($uid, $gid) {

	$database = &database::getInstance();

	$id = intval(mosGetParam($_REQUEST, 'id', 0));
	if($id) {
		$query = 'SELECT attribs FROM #__content WHERE `id`='.$id;
		$database->setQuery($query);
		$params = new mosParameters($database->loadResult());
	} else {
		$params = new mosParameters('');
	}
	$email = intval($params->get('email', 0));

	if(!Jconfig::getInstance()->config_showEmail && !$email) {
		echo _NOT_AUTH;
		return;
	}

	$itemid = intval(mosGetParam($_GET, 'itemid', 0));

	$now = _CURRENT_SERVER_TIME;
	$nullDate = $database->getNullDate();

	// query to check for state and access levels
	$query = "SELECT a.*, cc.name AS category, s.name AS section, s.published AS sec_pub, cc.published AS cat_pub,"
		."\n s.access AS sec_access, cc.access AS cat_access, s.id AS sec_id, cc.id as cat_id"
		."\n FROM #__content AS a"
		."\n LEFT JOIN #__categories AS cc ON cc.id = a.catid"
		."\n LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope = 'content'"
		."\n WHERE a.id = ".(int)$uid."\n AND a.state = 1 OR a.state = -1"
		."\n AND a.access <= ".(int)$gid."\n AND ( a.publish_up = ".$database->Quote($nullDate)
		." OR a.publish_up <= ".$database->Quote($now)." )"
		."\n AND ( a.publish_down = ".$database->Quote($nullDate)
		." OR a.publish_down >= ".$database->Quote($now)." )";
	$database->setQuery($query);
	$row = null;

	if($database->loadObject($row)) {
		/*
		* check whether category is published
		*/
		if(!$row->cat_pub && $row->catid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether section is published
		*/
		if(!$row->sec_pub && $row->sectionid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether category access level allows access
		*/
		if(($row->cat_access > $gid) && $row->catid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether section access level allows access
		*/
		if(($row->sec_access > $gid) && $row->sectionid) {
			mosNotAuth();
			return;
		}

		$query = "SELECT template FROM #__templates_menu WHERE client_id = 0 AND menuid = 0";
		$database->setQuery($query);
		$template = $database->loadResult();

		HTML_content::emailForm($row->id, $row->title, $template, $itemid);
	} else {
		mosNotAuth();
		return;
	}
}

/**
 * Shows the email form for a given content item.
 */
function emailContentSend($uid, $gid) {

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	$id = intval(mosGetParam($_REQUEST, 'id', 0));
	if($id) {
		$query = 'SELECT attribs FROM #__content WHERE `id`='.$id;
		$database->setQuery($query);
		$params = new mosParameters($database->loadResult());
	} else {
		$params = new mosParameters('');
	}
	$paramEmail = intval($params->get('email', 0));
	if(!$mainframe->getCfg('showEmail') && !$paramEmail) {
		echo _NOT_AUTH;
		return;
	}

	// simple spoof check security
	josSpoofCheck(1);

	// check for session cookie
	// Session Cookie `name`
	$sessionCookieName = mosMainFrame::sessionCookieName();
	// Get Session Cookie `value`
	$sessioncookie = mosGetParam($_COOKIE, $sessionCookieName, null);

	if(!(strlen($sessioncookie) == 32 || $sessioncookie == '-')) {
		mosErrorAlert(_NOT_AUTH);
	}

	$itemid = intval(mosGetParam($_POST, 'itemid', 0));
	$now = _CURRENT_SERVER_TIME;
	$nullDate = $database->getNullDate();

	// query to check for state and access levels
	$query = "SELECT a.*, cc.name AS category, s.name AS section, s.published AS sec_pub, cc.published AS cat_pub,"
			."\n  s.access AS sec_access, cc.access AS cat_access, s.id AS sec_id, cc.id as cat_id"
			."\n FROM #__content AS a"
			."\n LEFT JOIN #__categories AS cc ON cc.id = a.catid"
			."\n LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope = 'content' WHERE a.id = ".(int)$uid
			."\n AND a.state = 1 AND a.access <= ".(int)$gid
			."\n AND ( a.publish_up = ".$database->Quote($nullDate)
			." OR a.publish_up <= ".$database->Quote($now)." )"
			."\n AND ( a.publish_down = ".$database->Quote($nullDate)
			." OR a.publish_down >= ".$database->Quote($now)." )";
	$database->setQuery($query);
	$row = null;

	if($database->loadObject($row)) {
		/*
		* check whether category is published
		*/
		if(!$row->cat_pub && $row->catid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether section is published
		*/
		if(!$row->sec_pub && $row->sectionid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether category access level allows access
		*/
		if(($row->cat_access > $gid) && $row->catid) {
			mosNotAuth();
			return;
		}
		/*
		* check whether section access level allows access
		*/
		if(($row->sec_access > $gid) && $row->sectionid) {
			mosNotAuth();
			return;
		}

		$email = strval(mosGetParam($_POST, 'email', ''));
		$yourname = strval(mosGetParam($_POST, 'yourname', ''));
		$youremail = strval(mosGetParam($_POST, 'youremail', ''));
		$subject = strval(mosGetParam($_POST, 'subject', ''));
		if(empty($subject)) {
			$subject = _EMAIL_INFO.' '.$yourname;
		}

		if($uid < 1 || !$email || !$youremail || (JosIsValidEmail($email) == false) || (JosIsValidEmail($youremail) == false)) {
			mosErrorAlert(_EMAIL_ERR_NOINFO);
		}

		$query = "SELECT template FROM #__templates_menu WHERE client_id = 0 AND menuid = 0";
		$database->setQuery($query);
		$template = $database->loadResult();

		// determine Itemid for Item
		if($itemid) {
			$_itemid = '&Itemid='.$itemid;
		} else {
			$itemid = $mainframe->getItemid($uid, 0, 0);
			$_itemid = '&Itemid='.$itemid;
		}

		// link sent in email
		$link = sefRelToAbs('index.php?option=com_content&task=view&id='.$uid.$_itemid);

		// message text
		$msg = sprintf(_EMAIL_MSG, html_entity_decode($mainframe->getCfg('sitename'), ENT_QUOTES), $yourname, $youremail, $link);

		// mail function
		$success = mosMail($youremail, $yourname, $email, $subject, $msg);
		if(!$success) {
			mosErrorAlert(_EMAIL_ERR_NOINFO);
		}

		HTML_content::emailSent($email, $template);
	} else {
		mosNotAuth();
		return;
	}
}

function from_cache($cache){
	$meta = new contentMeta($cache['params']);
	$meta->set_meta();
	echo $cache['content'];
	unset($cache);
	return false;
}
