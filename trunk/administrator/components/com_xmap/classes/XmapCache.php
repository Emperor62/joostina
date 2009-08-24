<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();


class XmapCache {
	/**
	* @return object A function cache object
	*/
	function &getCache(&$sitemap, $handler = 'callback', $storage = 'file'){
		$handler = ($handler == 'function') ? 'callback' : $handler;

		$config = &Jconfig::getInstance();

		if(!isset($storage)) {
			$storage =($config->config_cache_handler != '')? $config->config_cache_handler : 'file';
		}

		$options = array(
			'defaultgroup' 	=> 'com_xmap',
			'cachebase' 	=> $config->config_cachepath.'/',
			'lifetime' 		=> $sitemap->cachelifetime,
			'language' 		=> $config->config_lang,
			'storage'		=> $storage
		);



		require_once ($config->config_absolute_path.'/includes/libraries/cache/cache.php');
		$cache =&JCache::getInstance( $handler, $options );
		if($cache != NULL){
			$cache->setCaching($sitemap->usecache);
		}
		return $cache;
	}
	/**
	* Cleans the cache
	*/
	function cleanCache(&$group = false) {
		$cache = &XmapCache::getCache($group);
		//_xdump($cache);
		if($cache != NULL){
			$cache->clean($cache->_options['defaultgroup']);
		}
	}
}