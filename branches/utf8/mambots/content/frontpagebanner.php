<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2007 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/copyleft/gpl.html GNU/GPL, �������� LICENSE.php
* Joostina! - ��������� ����������� �����������. ��� ������ ����� ���� ��������
* � ������������ � ����������� ������������ ��������� GNU, ������� ��������
* � ���������� ��������������� � ������� ���������� ������, ����������������
* �������� ����������� ������������ ��������� GNU ��� ������ �������� ���������
* �������� ��� �������� � �������� �������� �����.
* ��� ��������� ������������ � ��������� �� ��������� �����, �������� ���� COPYRIGHT.php.
*/

// ������ ������� �������
defined( '_VALID_MOS' ) or die( '������ ����� ����� ��������' );

$_MAMBOTS->registerFunction( 'onAfterDisplayContent', 'frontpagebanner' );

function frontpagebanner( &$row, &$params, $page=0 ) {
	global $option, $task, $mosConfig_absolute_path, $mosConfig_live_site, $database,$_MAMBOTS;
	
	$pvars = array_keys(get_object_vars($params->_params));
	if ($params->get( 'popup' ) || in_array('moduleclass_sfx', $pvars)) {
		return;
	}

	if ($option == 'com_frontpage') {
		if (!defined('_FRONTPAGEBANNER')) {
			define('_FRONTPAGEBANNER', 1);

			if ( !isset($_MAMBOTS->_content_mambot_params['frontpagebanner']) ) {
				$database->setQuery( "SELECT params FROM #__mambots WHERE element = 'frontpagebanner' AND folder = 'content'" );
				$database->loadObject($mambot);
				$_MAMBOTS->_content_mambot_params['bot_frontpagebanner'] = $mambot;
			}
			$params = new mosParameters($_MAMBOTS->_content_mambot_params['frontpagebanner']->params);

			echo '<div class="frontpagebanner">';
			include($mosConfig_absolute_path . '/modules/mod_banners.php');
			echo '</div>';
		}
	}
}
?>
