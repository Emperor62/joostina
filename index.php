<?php
/**
 * @package Joostina
 * @copyright Авторские права (C) 2007-2010 Joostina team. Все права защищены.
 * @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
 * Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
 * Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
 */

// Установка флага родительского файла
define('_VALID_MOS',1);
// корень файлов
define('JPATH_BASE', dirname(__FILE__) );
// разделитель каталогов
define('DS', DIRECTORY_SEPARATOR );

// рассчет памяти
function_exists('memory_get_usage') ? define('_MEM_USAGE_START', memory_get_usage()) : null;

// проверка конфигурационного файла, если не обнаружен, то загружается страница установки
if(!file_exists('configuration.php') || filesize('configuration.php') < 10) {
	$self = rtrim(dirname($_SERVER['PHP_SELF']),'/\\').'/';
	header('Location: http://'.$_SERVER['HTTP_HOST'].$self.'installation/index.php');
	exit();
}

// подключение файла эмуляции отключения регистрации глобальных переменных
(ini_get('register_globals') == 1) ? require_once (JPATH_BASE.DS.'includes'.DS.'globals.php') : null;

// подключение файла конфигурации
require_once (JPATH_BASE.DS.'configuration.php');

// для совместимости
$mosConfig_absolute_path = JPATH_BASE;

// считаем время за которое сгенерирована страница
$mosConfig_time_generate ? $sysstart = microtime(true) : null;

// Проверка SSL - $http_host возвращает <url_сайта>:<номер_порта, если он 443>
$http_host = explode(':',$_SERVER['HTTP_HOST']);
if((!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off' || isset($http_host[1]) && $http_host[1] == 443) && substr($mosConfig_live_site,0,8) !='https://') {
	$mosConfig_live_site = 'https://'.substr($mosConfig_live_site,7);
}
unset($http_host);

// live_site
define('JPATH_SITE', $mosConfig_live_site );

// подключение главного файла - ядра системы
require_once (JPATH_BASE.DS.'includes'.DS.'joostina.php');

//Проверка подпапки установки, удалена при работе с SVN
if(file_exists('installation/index.php') && coreVersion::get('SVN') == 0) {
	define('_INSTALL_CHECK',1);
	include (JPATH_BASE.DS.'templates'.DS.'system'.DS.'offline.php');
	exit();
}

if(file_exists(JPATH_BASE.DS.'components'.DS.'com_sef'.DS.'sef.php')) {
	require_once (JPATH_BASE.DS.'components'.DS.'com_sef'.DS.'sef.php');
} else {
	require_once (JPATH_BASE.DS.'includes'.DS.'sef.php');
}

require_once (JPATH_BASE.DS.'includes'.DS.'frontend.php');

// mainframe - основная рабочая среда API, осуществляет взаимодействие с 'ядром'
$mainframe = mosMainFrame::getInstance();

$option = $mainframe->option;
$Itemid = $mainframe->Itemid;

// отображение страницы выключенного сайта
if($mosConfig_offline == 1) {
	require (JPATH_BASE.DS.'templates'.DS.'system'.DS.'offline.php');
}

// отключение ведения сессий на фронте
($mosConfig_no_session_front == 0) ? $mainframe->initSession() : null;

// триггер событий onAfterStart
($mosConfig_mmb_system_off == 0) ? $_MAMBOTS->trigger('onAfterStart') : null;

// проверка, если мы можем найти Itemid в содержимом
if($option == 'com_content' && $Itemid === 0) {
	$id = intval(mosGetParam($_REQUEST,'id',0));
	$Itemid = $mainframe->getItemid($id);
}

// путь уменьшения воздействия на шаблоны
$option = ($option == 'search') ? 'com_search' : $option;

// загрузка файла русского языка по умолчанию
$mosConfig_lang = ($mosConfig_lang == '') ? 'russian' : $mosConfig_lang;
$mainframe->set('lang', $mosConfig_lang);
include_once($mainframe->getLangFile('',$mosConfig_lang));

$my = $mainframe->getUser();

// получение шаблона страницы
define('JTEMPLATE', $mainframe->getTemplate() );

/*** * @global - Места для хранения информации обработки компонента*/
$_MOS_OPTION = array();

// подключение функций редактора, т.к. сессии(авторизация ) на фронте отключены - это тоже запрещаем
if($mosConfig_frontend_login == 1) {
	require_once (JPATH_BASE.DS.'includes'.DS.'editor.php');
}
// начало буферизации основного содержимого

ob_start();

if($path = $mainframe->getPath('front')) {
	$task = strval(mosGetParam($_REQUEST,'task',''));
	$ret = mosMenuCheck($Itemid,$option,$task,$my->gid,$mainframe);
	if($ret) {
		//Подключаем язык компонента
		if($mainframe->getLangFile($option)) {
			require_once($mainframe->getLangFile($option));
		}
		require_once ($path);
		mosMainFrame::addLib('joiadmin');
		JoiAdmin::dispatch();
	} else {
		mosNotAuth();
	}
} else {
	header('HTTP/1.0 404 Not Found');
	echo _NOT_EXIST;
}
$_MOS_OPTION['buffer'] = ob_get_contents(); // главное содержимое - стек вывода компонента - mainbody
ob_end_clean();

initGzip();

header('Content-type: text/html; charset=UTF-8');
// при активном кэшировании отправим браузеру более "правильные" заголовки
/*
if(!$mosConfig_caching) { // не кэшируется
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0',false);
	header('Pragma: no-cache');
} elseif($option != 'logout' or $option != 'login') { // кэшируется
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Expires: '.gmdate('D, d M Y H:i:s',time() + 3600).' GMT');
	header('Cache-Control: max-age=3600');
}
*/

($mosConfig_mmb_system_off == 0) ? $_MAMBOTS->trigger('onAfterDispatch') : null;

// отображение предупреждения о выключенном сайте, при входе админа
if(defined('_ADMIN_OFFLINE')) {
	include (JPATH_BASE.'/templates/system/offlinebar.php');
}
// буферизация итогового содержимого, необходимо для шаблонов группы templates
ob_start();
// загрузка файла шаблона
if(!file_exists(JPATH_BASE.'/templates/'.JTEMPLATE.'/index.php')) {
	echo _TEMPLATE_WARN.JTEMPLATE;
} else {
	require_once (JPATH_BASE.'/templates/'.JTEMPLATE.'/index.php');
}
$_template_body = ob_get_contents(); // главное содержимое - стек вывода компонента - mainbody
ob_end_clean();

// активация мамботов группы mainbody
if($mosConfig_mmb_mainbody_off == 0) {
	$_MAMBOTS->loadBotGroup('mainbody');
	$_MAMBOTS->trigger('onTemplate',array(&$_template_body));
}

// вывод стека всего тела страницы, уже после обработки мамботами группы onTemplate
echo $_template_body;

unset($_template_body,$_MAMBOTS,$mainframe,$my,$_MOS_OPTION,$database);

// подсчет времени генерации страницы
echo $mosConfig_time_generate ? '<div id="time_gen">'.round((microtime(true) - $sysstart),5).'</div>' : null;


// вывод лога отладки
if( JDEBUG ) {
	if(defined('_MEM_USAGE_START')) {
		$mem_usage = (memory_get_usage() - _MEM_USAGE_START);
		jd_log_top('<b>'._SCRIPT_MEMORY_USING.':</b> '.sprintf('%0.2f',$mem_usage / 1048576).' MB');
	}
	jd_get();
}

doGzip();
// запускаем встроенный оптимизатор таблиц
($mosConfig_optimizetables == 1) ? joostina_api::optimizetables() : null;