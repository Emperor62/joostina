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

// запрет прямого доступа
defined( '_VALID_MOS' ) or die( 'Прямой вызов файла запрещен' );

require_once( $mainframe->getCfg('absolute_path') . '/administrator/components/com_jce/layout.html.php' );
require_once( $mainframe->getCfg('absolute_path') . '/administrator/components/com_jce/plugins/plugins.class.php' );

$client = mosGetParam( $_REQUEST, 'client', '' );

function getOrderArray( $input, $listname, $itemKeyName = 'element', $orderKeyName = 'order' ) {
		parse_str( $input, $inputArray );
		$inputArray = $inputArray[$listname];
		$orderArray = array();
		for( $i=0; $i<count( $inputArray ); $i++ ) {
			$orderArray[] = array( $itemKeyName => $inputArray[$i], $orderKeyName => $i +1 );
		}
		return $orderArray;
}
/**
* Compiles a list of installed or defined modules
*/
function editLayout( $option, $client ) {
    global $database, $mainframe;

	$query = "SELECT id AS id, name, plugin, type, layout_icon"
    . "\n FROM #__jce_plugins"
    . "\n WHERE row = 1"
    . "\n AND published = 1"
    . "\n AND icon != ''"
    . "\n ORDER BY ordering ASC"
    ;
    $database->setQuery( $query );
    $row1 = $database->loadAssocList();

    $query = "SELECT id, name, plugin, type, layout_icon"
    . "\n FROM #__jce_plugins"
    . "\n WHERE row = 2"
    . "\n AND published = 1"
    . "\n AND icon != ''"
    . "\n ORDER BY ordering ASC"
    ;
    $database->setQuery( $query );
    $row2 = $database->loadAssocList();

    $query = "SELECT id, name, plugin, type, layout_icon"
    . "\n FROM #__jce_plugins"
    . "\n WHERE row = 3"
    . "\n AND published = 1"
    . "\n AND icon != ''"
    . "\n ORDER BY ordering ASC"
    ;
    $database->setQuery( $query );
    $row3 = $database->loadAssocList();

    $query = "SELECT id, name, plugin, type, layout_icon"
    . "\n FROM #__jce_plugins"
    . "\n WHERE row = 4"
    . "\n AND published = 1"
    . "\n AND icon != ''"
    . "\n ORDER BY ordering ASC"
    ;
    $database->setQuery( $query );
    $row4 = $database->loadAssocList();

	$query = "SELECT id, name, plugin, type, layout_icon"
    . "\n FROM #__jce_plugins"
    . "\n WHERE row = 5"
    . "\n AND published = 1"
    . "\n AND icon != ''"
    . "\n ORDER BY ordering ASC"
    ;
    $database->setQuery( $query );
    $row5 = $database->loadAssocList();

    // load JCE info
	$query = "SELECT id"
	. "\n FROM #__mambots"
	. "\n WHERE element = 'jce'"
	. "\n AND folder = 'editors'"
	;
	$database->setQuery( $query );
	$id = $database->loadResult();
	$mambot = new mosMambot( $database );
	$mambot->load( $id );
	$params = new mosParameters( $mambot->params );

	$width = $params->get( 'width', '600' );
	$height = $params->get( 'height', '600' );

	JCE_layout::showLayout( $row1, $row2, $row3, $row4, $row5, $width, $height, $option, $client );
}
/**
* Saves the module after an edit form submit
*/
function saveLayout( $option, $client ) {
	global $database;

	$row1 = mosGetParam( $_REQUEST, 'row1' );
    $row2 = mosGetParam( $_REQUEST, 'row2' );
    $row3 = mosGetParam( $_REQUEST, 'row3' );
    $row4 = mosGetParam( $_REQUEST, 'row4' );
	$row5 = mosGetParam( $_REQUEST, 'row5' );

    if($row1){
        $arr = getOrderArray( $row1, 'row1' );

        foreach ( $arr as $item )
        {
          $id = $item['element'];
          $order = $item['order'];

          $row = new jcePlugins( $database );
          $row->load( $id );
          $row->row = 1;
          $row->ordering = $order;

    	if ( !$row->check() ) {
    		return $row->getError();
    	}
    	if ( !$row->store() ) {
    		return $row->getError();
    	}
        }
    }

    if($row2){
        $arr = getOrderArray( $row2, 'row2' );

        foreach ( $arr as $item )
        {
          $id = $item['element'];
          $order = $item['order'];

          $row = new jcePlugins( $database );
          $row->load( $id );
          $row->row = 2;
          $row->ordering = $order;

    	if ( !$row->check() ) {
    		return $row->getError();
    	}
    	if ( !$row->store() ) {
    		return $row->getError();
    	}
        }
    }
    if($row3){
        $arr = getOrderArray( $row3, 'row3' );

        foreach ( $arr as $item )
        {
          $id = $item['element'];
          $order = $item['order'];

          $row = new jcePlugins( $database );
          $row->load( $id );
          $row->row = 3;
          $row->ordering = $order;

    	if ( !$row->check() ) {
    		return $row->getError();
    	}
    	if ( !$row->store() ) {
    		return $row->getError();
    	}
        }
    }
    if($row4){
        $arr = getOrderArray( $row4, 'row4' );

        foreach ( $arr as $item )
        {
          $id = $item['element'];
          $order = $item['order'];

          $row = new jcePlugins( $database );
          $row->load( $id );
          $row->row = 4;
          $row->ordering = $order;

    	if ( !$row->check() ) {
    		return $row->getError();
    	}
    	if ( !$row->store() ) {
    		return $row->getError();
    	}
        }
    }
	if($row5){
        $arr = getOrderArray( $row5, 'row5' );

        foreach ( $arr as $item )
        {
          $id = $item['element'];
          $order = $item['order'];

          $row = new jcePlugins( $database );
          $row->load( $id );
          $row->row = 5;
          $row->ordering = $order;

    	if ( !$row->check() ) {
    		return $row->getError();
    	}
    	if ( !$row->store() ) {
    		return $row->getError();
    	}
        }
    }
    mosRedirect( 'index2.php?option='. $option .'&client='. $client .'&task=editlayout', 'Расположение значков сохранено' );
}
?>