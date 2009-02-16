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

/**
* Class to support function caching
* @package Xmap
*/
class XmapCache {
	/**
	* @return object A function cache object
	*/
	function &getCache( &$sitemap ) {
		global $mosConfig_absolute_path, $mosConfig_cachepath, $mosConfig_cachetime;

		if (class_exists('JFactory')) {
			$cache = &JFactory::getCache('com_xmap_'.$sitemap->id);
			$cache->setCaching($sitemap->usecache);
			$cache->setLifeTime($sitemap->cachelifetime);
		} else {
			require_once( $mosConfig_absolute_path . '/includes/joomla.cache.php' );
			$options = array (
				'cacheDir'		=> $mosConfig_cachepath . '/',
				'caching'		=> $sitemap->usecache,
				'defaultGroup'	=> 'com_xmap_'.$sitemap->id,
				'lifeTime'		=> $sitemap->cachelifetime
			);
			$cache = new JCache_Lite_Function( $options );
		}
		return $cache;
	}
	/**
	* Cleans the cache
	*/
	function cleanCache( &$sitemap ) {
		$cache =&XmapCache::getCache( $sitemap );
		if (class_exists('JFactory')) {
			return $cache->clean();
		} else {
			return $cache->clean( $cache->_cache->_defaultGroup );
		}
	}
}
?>
