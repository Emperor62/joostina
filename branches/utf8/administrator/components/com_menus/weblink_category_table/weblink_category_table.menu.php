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

mosAdminMenus::menuItem( $type );

switch ($task) {
	case 'weblink_category_table':
		// this is the new item, ie, the same name as the menu `type`
		weblink_category_table_menu::editCategory( 0, $menutype, $option );
		break;

	case 'edit':
		weblink_category_table_menu::editCategory( $cid[0], $menutype, $option );
		break;

	case 'save':
	case 'apply':
		saveMenu( $option, $task );
		break;
}
?>
