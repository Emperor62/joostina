<?php
/**
* @package Joostina
* @copyright Авторские права (C) 2008-2009 Joostina team. Все права защищены.
* @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/LICENSE.php
* Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
* Для просмотра подробностей и замечаний об авторском праве, смотрите файл help/COPYRIGHT.php.
*
* Данный файл изменен Mitrich http://mitrichlab.ru
*/

// запрет прямого доступа
defined( '_VALID_MOS' ) or die();

$mainframe = &mosMainFrame::getInstance();
global $my;

if ( $mainframe->getCfg('frontend_login') != NULL && ($mainframe->getCfg('frontend_login') === 0 || $mainframe->getCfg('frontend_login') === '0')) {	
	return; 
}

if ($my->id) {
	$params->set('template', 'logout.php');
} 
else {
	$params->def('template', 'vertical.php');
}

//Подключаем вспомогательный класс
$module->get_helper();

//Подключаем шаблон
if($module->set_template($params)){
	require($module->template);
}