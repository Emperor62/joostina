<?php
/**
* @package Joostina
* @copyright Авторские права (C) 2007 Joostina team. Все права защищены.
* @license Лицензия http://www.gnu.org/copyleft/gpl.html GNU/GPL, смотрите LICENSE.php
* Joostina! - свободное программное обеспечение. Эта версия может быть изменена
* в соответствии с Генеральной Общественной Лицензией GNU, поэтому возможно
* её дальнейшее распространение в составе результата работы, лицензированного
* согласно Генеральной Общественной Лицензией GNU или других лицензий свободных
* программ или программ с открытым исходным кодом.
* Для просмотра подробностей и замечаний об авторском праве, смотрите файл COPYRIGHT.php.
*/
require(dirname(__FILE__).'/../die.php');

require_once( $mainframe->getPath( 'front_html', 'com_content') );

if (!defined( '_JOS_NEWSFLASH_MODULE' )) {
	/** ensure that functions are declared only once */
	define( '_JOS_NEWSFLASH_MODULE', 1 );	  

	function output_newsflash( &$row, &$params, &$access ) {	
		global $mainframe;		   

		$row->text 		= $row->introtext;
		$row->groups 	= '';
		$row->readmore 	= (trim( $row->fulltext ) != '');
		$row->metadesc 	= '';
		$row->metakey 	= '';
		$row->access 	= '';
		$row->created 	= '';
		$row->modified 	= '';	

		HTML_content::show( $row, $params, $access, 0 );
	}
}	

global $my, $mosConfig_shownoauth, $mosConfig_offset, $mosConfig_link_titles, $acl;

// Отключается значок возможности редактирования
$access = new stdClass();
$access->canEdit 	= 0;
$access->canEditOwn = 0;
$access->canPublish = 0;

$now 				= _CURRENT_SERVER_TIME;
$noauth 			= !$mainframe->getCfg( 'shownoauth' );
$nullDate 			= $database->getNullDate();

$catid 				= intval( $params->get( 'catid' ) );
$items 				= intval( $params->get( 'items', 0 ) );
$style 				= $params->get( 'style', 'flash' );
$moduleclass_sfx    = $params->get( 'moduleclass_sfx' );
$link_titles		= $params->get( 'link_titles', $mosConfig_link_titles );

$params->set( 'intro_only', 1 );
$params->set( 'hide_author', 1 );
$params->set( 'hide_createdate', 0 );
$params->set( 'hide_modifydate', 1 );
$params->set( 'link_titles', $link_titles );

// запрос определения количества статей
$query = "SELECT a.id, a.introtext, a.fulltext , a.images, a.attribs, a.title, a.state"
."\n FROM #__content AS a"
."\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
."\n INNER JOIN #__sections AS s ON s.id = a.sectionid"
."\n WHERE a.state = 1"
. ( $noauth ? "\n AND a.access <= " . (int) $my->gid . " AND cc.access <= " . (int) $my->gid . " AND s.access <= " . (int) $my->gid : '' )
."\n AND (a.publish_up = " . $database->Quote( $nullDate ) . " OR a.publish_up <= " . $database->Quote( $now ) . " ) "
."\n AND (a.publish_down = " . $database->Quote( $nullDate ) . " OR a.publish_down >= " . $database->Quote( $now ) . " )"
."\n AND a.catid = " . (int) $catid
."\n AND cc.published = 1"
."\n AND s.published = 1"
."\n ORDER BY a.ordering"
;
$database->setQuery( $query, 0, $items );
$rows = $database->loadObjectList();

$numrows = count( $rows );

// check if any results returned
if ( $numrows ) {
switch ($style) {
	case 'horiz':
		echo '<table class="moduletable' . $moduleclass_sfx .'">';
		echo '<tr>';
		foreach ($rows as $row) {
			echo '<td>';
			output_newsflash( $row, $params, $access );
			echo '</td>';
		}
		echo '</tr></table>';
		break;

	case 'vert':
		foreach ($rows as $row) {
			output_newsflash( $row, $params, $access );
		}
		break;

	case 'flash':
		default:
			srand ((double) microtime() * 1000000);
			$flashnum = rand( 0, $numrows-1 );
		$row = $rows[$flashnum];

		output_newsflash( $row, $params, $access );
		break;
	}
}
?>