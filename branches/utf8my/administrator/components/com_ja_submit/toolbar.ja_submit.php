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
require(dirname(__FILE__).'/../../die.php');

require_once( $mainframe->getPath( 'toolbar_default' ) );

switch ($task) {
	default:
		menusubmit::CONFIG_MENU();
	break;
}

class menusubmit {
	function CONFIG_MENU() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'savesettings', 'Сохранить' );
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
}
?>
