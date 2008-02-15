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

// Установка флага, что это - родительский файл
define( '_VALID_MOS', 1 );

require( 'globals.php' );
require_once( 'configuration.php' );

// SSL check - $http_host returns <live site url>:<port number if it is 443>
$http_host = explode(':', $_SERVER['HTTP_HOST'] );
if( (!empty( $_SERVER['HTTPS'] ) && strtolower( $_SERVER['HTTPS'] ) != 'off' || isset( $http_host[1] ) && $http_host[1] == 443) && substr( $mosConfig_live_site, 0, 8 ) != 'https://' ) {
	$mosConfig_live_site = 'https://'.substr( $mosConfig_live_site, 7 );
}

require_once( 'includes/joomla.php' );

// отображение состояния выключенного сайта
if ($mosConfig_offline == 1) {
	require( $mosConfig_absolute_path .'/offline.php' );
}

// загрузка группы системного бота
$_MAMBOTS->loadBotGroup( 'system' );

// переключение событий onStart
$_MAMBOTS->trigger( 'onStart' );

if (file_exists( $mosConfig_absolute_path .'/components/com_sef/sef.php' )) {
	require_once( $mosConfig_absolute_path .'/components/com_sef/sef.php' );
} else {
	require_once( $mosConfig_absolute_path .'/includes/sef.php' );
}
require_once( $mosConfig_absolute_path .'/includes/frontend.php' );

// запрос ожидаемых аргументов url (или формы)
$option 	= strtolower( strval( mosGetParam( $_REQUEST, 'option' ) ) );
$Itemid 	= intval( mosGetParam( $_REQUEST, 'Itemid', 0 ) );
$no_html 	= intval( mosGetParam( $_REQUEST, 'no_html', 0 ) );
$act 		= strval( mosGetParam( $_REQUEST, 'act', '' ) );

// главное окно рабочего компонента API, для взаимодействия многих 'ядер'
$mainframe = new mosMainFrame( $database, $option, '.' );
$mainframe->initSession();

// trigger the onAfterStart events
$_MAMBOTS->trigger( 'onAfterStart' );

// get the information about the current user from the sessions table
$my = $mainframe->getUser();
// patch to lessen the impact on templates
if ($option == 'search') {
	$option = 'com_search';
}

// загрузка файла русского языка по умолчанию
if ($mosConfig_lang=='') {
	$mosConfig_lang = 'russian';
}
include_once( $mosConfig_absolute_path .'/language/' . $mosConfig_lang . '.php' );


if ($option == 'login') {
	$mainframe->login();
	mosRedirect('index.php');
} else if ($option == 'logout') {
	$mainframe->logout();
	mosRedirect( 'index.php' );
}



// обнаружение первого посещения
$mainframe->detect();

$gid = intval( $my->gid );

$cur_template = $mainframe->getTemplate();

// предварительный захват вывода компонента
require_once( $mosConfig_absolute_path . '/editor/editor.php' );

ob_start();

if ($path = $mainframe->getPath( 'front' )) {
	$task 	= strval( mosGetParam( $_REQUEST, 'task', '' ) );
	$ret 	= mosMenuCheck( $Itemid, $option, $task, $gid );
	if ($ret) {
		require_once( $path );
	} else {
		mosNotAuth();
	}
} else {
	header("HTTP/1.0 404 Not Found");
	echo _NOT_EXIST;
}
$_MOS_OPTION['buffer'] = ob_get_contents();

ob_end_clean();

initGzip();

// при активном кешировании отправиим браузеру более "правильные" заголовки
if(!$mosConfig_caching){ // не кэшируется
	header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
	header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
	header( 'Cache-Control: no-store, no-cache, must-revalidate' );
	header( 'Cache-Control: post-check=0, pre-check=0', false );
	header( 'Pragma: no-cache' );
}else{ // кэшируется
	header( 'Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT' );
	// 60*60=3600 - использования кэширования на 1 час
	header( 'Expires: '.gmdate('D, d M Y H:i:s',time()+3600).' GMT' );
	header( 'Cache-Control: max-age=3600' );
}

// отображение состояния выключенного сайта при входе админа
if (defined( '_ADMIN_OFFLINE' )) {
	include( $mosConfig_absolute_path .'/offlinebar.php' );
}

// старт основного HTML
if ( $no_html == 0 ) {
	$customIndex2 = 'templates/'. $mainframe->getTemplate() .'/index2.php';
	if (file_exists( $customIndex2 )) {
		require( $customIndex2 );
	} else {
	// требуется для отделения номера ISO от константы  _ISO языкового файла языка
	$iso = split( '=', _ISO );
	// пролог xml
	echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php echo $mainframe->getHead(); ?>
	<link rel="stylesheet" href="templates/<?php echo $cur_template;?>/css/template_css.css" type="text/css" />
	<link rel="shortcut icon" href="<?php echo $mosConfig_live_site; ?>/images/favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
		<?php if ($my->id || $mainframe->get( 'joomlaJavascript' )) { ?>
		<script language="JavaScript" src="<?php echo $mosConfig_live_site;?>/includes/js/joomla.javascript.js" type="text/javascript"></script>
		<?php } ?>
	</head>
	<body class="contentpane">
	<?php mosMainBody(); ?>
	</body>
	</html>
	<?php
	}
} else {
	mosMainBody();
}
doGzip();
?>
