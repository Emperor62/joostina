<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ��������� �����, ��� ���� ���� - ������������
define('_VALID_MOS',1);

if(!file_exists('../configuration.php')) {
	header('Location: ../installation/index.php');
	exit();
}

require ('../globals.php');
require_once ('../configuration.php');

// ��������� ����������� �������� ���� ������ ��� ������ ����������
$mosConfig_db_cache_handler_orig = $mosConfig_db_cache_handler;
$mosConfig_db_cache_handler = 'none';

// SSL ��������  - $http_host returns <live site url>:<port number if it is 443>
$http_host = explode(':',$_SERVER['HTTP_HOST']);
if((!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off' || isset($http_host[1]) && $http_host[1] == 443) && substr($mosConfig_live_site,0,8) !='https://') {
	$mosConfig_live_site = 'https://' . substr($mosConfig_live_site,7);
}

require_once ($mosConfig_absolute_path . '/includes/joomla.php');
include_once ($mosConfig_absolute_path . '/language/' . $mosConfig_lang . '.php');
require_once ($mosConfig_absolute_path.'/'.ADMINISTRATOR_DIRECTORY.'/includes/admin.php');

global $database;

// ������ � �������� ���������� �� �������� �������� ������� �������������� � �����
session_name(md5($mosConfig_live_site));
session_start();

$option	= strval(strtolower(mosGetParam($_REQUEST,'option','')));
$task	= strval(mosGetParam($_REQUEST,'task',''));

// �������� ������� �������������� � ����� �������
$mainframe = new mosMainFrame($database,$option,'..',true);

// ������ ������ ������ ����������
$my = $mainframe->initSessionAdmin($option,$task);



// ��������� �������� ����������
$act		= strtolower(mosGetParam($_REQUEST,'act',''));
$section	= mosGetParam($_REQUEST,'section','');
$no_html	= intval(mosGetParam($_REQUEST,'no_html',0));
$id			= intval(mosGetParam($_REQUEST,'id',0));

$cur_template = $mainframe->getTemplate();

// �������� ������ ���������� �� ���������
if($option == '') {
	$option = 'com_admin';
}

// ��������� ��������� overlib
$mainframe->set('loadOverlib',false);

// ������������� ���������
require_once ($mosConfig_absolute_path . '/editor/editor.php');

ob_start();
if($path = $mainframe->getPath('admin')) {
	require_once ($path);
} else {
?>
	<img src="images/error.png" border="0" alt="Joostina!" />
<?php
}

$_MOS_OPTION['buffer'] = ob_get_contents();
ob_end_clean();

initGzip();

// ������ ������ html
if($no_html == 0) {
	// �������� ����� �������
	if(!file_exists($mosConfig_absolute_path . '/'.ADMINISTRATOR_DIRECTORY.'/templates/' . $cur_template .'/index.php')) {
		echo _TEMPLATE_NOT_FOUND.': ',$cur_template;
	} else {
		require_once ($mosConfig_absolute_path . '/'.ADMINISTRATOR_DIRECTORY.'/templates/' . $cur_template .'/index.php');
	}
} else {
	mosMainBody_Admin();
}

// ���������� �������, ����� �������� � ��
if($mosConfig_debug) {
	echo _SQL_QUERIES_COUNT.': '. $database->_ticker;
	echo '<pre>';
	foreach($database->_log as $k => $sql) {
		echo $k + 1 . ":&nbsp;" . $sql . '<br /><br />';
	}
	echo '</pre>';
}

// �������������� ������
if($task == 'save' || $task == 'apply' || $task == 'save_and_new' ) {
	$mainframe->initSessionAdmin($option,'');
}

doGzip();

?>
