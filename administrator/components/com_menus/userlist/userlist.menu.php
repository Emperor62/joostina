<?php
/**
* @package Joostina
* @copyright Авторские права (C) 2007-2010 Joostina team. Все права защищены.
* @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
* Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
* Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
*/

// запрет прямого доступа
defined('_VALID_MOS') or die();

mosAdminMenus::menuItem($type);

switch($task) {
	case 'userlist':
		// this is the new item, ie, the same name as the menu `type`
		userlist_menu::edit(0,$menutype,$option,$menu);
		break;

	case 'edit':
		userlist_menu::edit($cid[0],$menutype,$option,$menu);
		break;

	case 'save':
	case 'apply':
	case 'save_and_new':
		userlist_menu::saveMenu($option,$task);
		break;
}