<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();
/**
* Displays the capture output of the main element
*/
function mosMainBody() {
	global $mosConfig_live_site;
	// message passed via the url
	$mosmsg = stripslashes(strval(mosGetParam($_REQUEST,'mosmsg','')));

	$popMessages = false;

	// Browser Check
	$browserCheck = 0;
	if(isset($_SERVER['HTTP_USER_AGENT']) && isset($_SERVER['HTTP_REFERER']) &&
		strpos($_SERVER['HTTP_REFERER'],$mosConfig_live_site) !== false) {
		$browserCheck = 1;
	}

	// Session Check
	$sessionCheck = 0;
	// Session Cookie `name`
	$sessionCookieName = mosMainFrame::sessionCookieName();
	// Get Session Cookie `value`
	$sessioncookie = mosGetParam($_COOKIE,$sessionCookieName,null);
	if((strlen($sessioncookie) == 32 || $sessioncookie == '-')) {
		$sessionCheck = 1;
	}

	// limit mosmsg to 150 characters
	if(strlen($mosmsg) > 150) {
		$mosmsg = substr($mosmsg,0,150);
	}

	// mosmsg outputed within html
	if($mosmsg && !$popMessages && $browserCheck && $sessionCheck) {
		echo "\n<div class=\"message\">$mosmsg</div>";
	}

	echo $GLOBALS['_MOS_OPTION']['buffer'];

	// mosmsg outputed in JS Popup
	if($mosmsg && $popMessages && $browserCheck && $sessionCheck) {
		echo "\n<script language=\"javascript\">alert('".addslashes($mosmsg)."');</script>";
	}
}
/**
* Utility functions and classes
*/
function mosLoadComponent($name) {
	// set up some global variables for use by frontend components
	global $mainframe,$database,$my,$acl;
	global $task,$Itemid,$id,$option,$gid;
	include ($mainframe->getCfg('absolute_path')."/components/com_$name/$name.php");
}
/**
* Cache some modules information
* @return array
*/
function &initModules() {
	global $database,$my,$Itemid,$mosConfig_disable_access_control;

	if(!isset($GLOBALS['_MOS_MODULES'])) {
		$Itemid = intval($Itemid);
		$check_Itemid = '';
		if($Itemid) {
			$check_Itemid = "OR mm.menuid = ".(int)$Itemid;
		}
		if(!$mosConfig_disable_access_control) $where_ac = "\n AND access <= ".(int)$my->gid;
		else $where_ac = '';
#		$query = "SELECT id, title, module, position, content, showtitle, params, assign_to_url FROM #__modules AS m"
		$query = "SELECT id, title, module, position, content, showtitle, params FROM #__modules AS m"
				."\n INNER JOIN #__modules_menu AS mm ON mm.moduleid = m.id"
				."\n WHERE m.published = 1"
				.$where_ac
				."\n AND m.client_id != 1 AND ( mm.menuid = 0 $check_Itemid )"
				."\n ORDER BY ordering";

		$database->setQuery($query);
		$modules = $database->loadObjectList();

		foreach($modules as $module) {
			$GLOBALS['_MOS_MODULES'][$module->position][] = $module;
		}
	}
	return $GLOBALS['_MOS_MODULES'];
}
/**
* @param string THe template position
*/
function mosCountModules($position = 'left') {
	global $database,$my,$Itemid;

	$tp = intval(mosGetParam($_GET,'tp',0));
	if($tp) {
		return 1;
	}

	$modules = &initModules();
	if(isset($GLOBALS['_MOS_MODULES'][$position])) {
		return count($GLOBALS['_MOS_MODULES'][$position]);
	} else {
		return 0;
	}
}
/**
* @param string The position
* @param int The style.  0=normal, 1=horiz, -1=no wrapper
*/
function mosLoadModules($position = 'left',$style = 0,$noindex = 0) {
	global $mosConfig_gzip,$mosConfig_absolute_path,$database,$my,$Itemid,$mosConfig_caching,$mainframe,$mosConfig_disable_tpreview;

	$tp = intval(mosGetParam($_GET,'tp',0));

	if($tp && !$mosConfig_disable_tpreview ) {
		echo '<div style="height:50px;background-color:#eee;margin:2px;padding:10px;border:1px solid #f00;color:#700;">';
		echo $position;
		echo '</div>';
		return;
	}
	$style = intval($style);
	$cache = &mosCache::getCache('com_content');

	require_once ($mosConfig_absolute_path.'/includes/frontend.html.php');

	$allModules = &initModules();

	if(isset($GLOBALS['_MOS_MODULES'][$position])) {
		$modules = $GLOBALS['_MOS_MODULES'][$position];
	} else {
		$modules = array();
	}

	if($noindex == 1) echo '<noindex>';
	if(count($modules) < 1) {
		$style = 0;
	}
	if($style == 1) {
		echo '<table cellspacing="1" cellpadding="0" border="0" width="100%"><tr>';
	}
	$prepend = ($style == 1)?"<td valign=\"top\">\n":'';
	$postpend = ($style == 1)?"</td>\n":'';

	$count = 1;
	foreach($modules as $module) {

		$params = new mosParameters($module->params);

		echo $prepend;

		if((substr($module->module,0,4)) == 'mod_') {
			// normal modules
			if($params->get('cache') == 1 && $mosConfig_caching == 1) {
				// module caching
				$cache->call('modules_html::module2',$module,$params,$Itemid,$style,$my->gid);
			} else {
				modules_html::module2($module,$params,$Itemid,$style,$count);
			}
		} else {
			// custom or new modules
			if($params->get('cache') == 1 && $mosConfig_caching == 1) {
				// module caching
				$cache->call('modules_html::module',$module,$params,$Itemid,$style,0,$my->gid);
			} else {
				modules_html::module($module,$params,$Itemid,$style);
			}
		}

		echo $postpend;

		$count++;
	}
	if($style == 1) {
		echo "</tr>\n</table>\n";
	}
	if($noindex == 1) echo '</noindex>';
	return;
}
/**
* ����� ��������
*/
function mosShowHead() {
	global $database,$option,$my,$mainframe,$_VERSION,$task,$id,$mosConfig_disable_favicon;
	global $mosConfig_MetaDesc,$mosConfig_MetaKeys,$mosConfig_live_site,$mosConfig_sef,
		$mosConfig_absolute_path,$mosConfig_sitename,$mosConfig_favicon;

	$description = '';
	$keywords = '';

	$_meta_keys_index = -1;
	$_meta_desc_index = -1;

	$n = count($mainframe->_head['meta']);
	for($i = 0; $i < $n; $i++) {
		if($mainframe->_head['meta'][$i][0] == 'keywords') {
			$_meta_keys_index = $i;
			$keywords = $mainframe->_head['meta'][$i][1];
		} else
			if($mainframe->_head['meta'][$i][0] == 'description') {
				$_meta_desc_index = $i;
				$description = $mainframe->_head['meta'][$i][1];
			}
	}

	if(!$description) {
		$mainframe->appendMetaTag('description',$mosConfig_MetaDesc);
	}

	if(!$keywords) {
		$mainframe->appendMetaTag('keywords',$mosConfig_MetaKeys);
	}

	if($_meta_keys_index != -1) {
		$keys = $mainframe->_head['meta'][$_meta_keys_index][1];
		$keys = preg_replace("/\,+/is",", ",$keys);
		$keys = preg_replace("/\s+/is"," ",$keys);
		$keys = strtolower($keys);
		$keys = implode(', ',array_unique(split(', ',$keys)));
		$mainframe->_head['meta'][$_meta_keys_index][1] = $keys;
	}
	// boston, ���������� ���� Generator
	global $mosConfig_generator_off,$mosConfig_lang;
	if($mosConfig_generator_off == 0) $mainframe->addMetaTag('Generator',$_VERSION->CMS.' - '.$_VERSION->COPYRIGHT);
	//boston, �������������� ���� ����������
	global $mosConfig_index_tag,$mosConfig_mtage_base,$mosConfig_mtage_revisit;
	if($mosConfig_index_tag == 1) {
		$mainframe->addMetaTag('distribution','global');
		$mainframe->addMetaTag('rating','General');
		$mainframe->addMetaTag('document-state','Dynamic');
		$mainframe->addMetaTag('documentType','WebDocument');
		$mainframe->addMetaTag('audience','all');
		$mainframe->addMetaTag('revisit',$mosConfig_mtage_revisit.' days');
		$mainframe->addMetaTag('revisit-after',$mosConfig_mtage_revisit.' days');
		$mainframe->addMetaTag('allow-search','yes');
		$mainframe->addMetaTag('language',$mosConfig_lang);
	}

	// ���������� �����������
	if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
		$cache = &mosCache::getCache('com_content');
		echo $cache->call('mainframe->getHead',@$_SERVER['QUERY_STRING'],$id);
	} else {
		echo $mainframe->getHead();
	}
	// ������� ������ �� ������� �������� ���� ��� ����������� sef
	if ( $mosConfig_mtage_base == 1) {
	echo "<base href=\"$mosConfig_live_site/\" />\r\n";
	}

	if($my->id || $mainframe->get('joomlaJavascript')) {
?>
		<script src="<?php echo $mosConfig_live_site; ?>/includes/js/joomla.javascript.js" type="text/javascript"></script>
		<?php
	}

	// boston, ���������� RSS
	global $mosConfig_syndicate_off;
	if($mosConfig_syndicate_off==0) {
		$row = new mosComponent($database);
		$query = "SELECT a.* FROM #__components AS a"
			." WHERE ( a.admin_menu_link = 'option=com_syndicate' OR a.admin_menu_link = 'option=com_syndicate&hidemainmenu=1' )"
			."\n AND a.option = 'com_syndicate'";
		$database->setQuery($query);
		$database->loadObject($row);

		// get params definitions
		$syndicateParams = new mosParameters($row->params,$mainframe->getPath('com_xml',$row->option),'component');

		// needed to reduce query
		$GLOBALS['syndicateParams'] = $syndicateParams;

		$live_bookmark = $syndicateParams->get('live_bookmark',0);

		// and to allow disabling/enabling of selected feed types
		switch($live_bookmark) {
			case 'RSS0.91':
				if(!$syndicateParams->get('rss091',1)) {
					$live_bookmark = 0;
				}
				break;

			case 'RSS1.0':
				if(!$syndicateParams->get('rss10',1)) {
					$live_bookmark = 0;
				}
				break;

			case 'RSS2.0':
				if(!$syndicateParams->get('rss20',1)) {
					$live_bookmark = 0;
				}
				break;

			case 'ATOM0.3':
				if(!$syndicateParams->get('atom03',1)) {
					$live_bookmark = 0;
				}
				break;
		}

		// support for Live Bookmarks ability for site syndication
		if($live_bookmark) {
			$show = 1;

			$link_file = $mosConfig_live_site.'/index2.php?option=com_rss&feed='.$live_bookmark.'&no_html=1';

			// xhtml check
			$link_file = ampReplace($link_file);

			// security chcek
			$check = $syndicateParams->def('check',1);
			if($check) {
				// test if rssfeed module is published
				// if not disable access
				$query = "SELECT m.id"
						."\n FROM #__modules AS m"
						."\n WHERE m.module = 'mod_rssfeed'"
						."\n AND m.published = 1";
				$database->setQuery($query);
				$check = $database->loadResultArray();
				if(empty($check)) {
					$show = 0;
				}
			}
			// outputs link tag for page
			if($show) {
				// test if security check is enbled
?>
				<link rel="alternate" type="application/rss+xml" title="<?php echo $mosConfig_sitename; ?>" href="<?php echo $link_file; ?>" />
				<?php
			}
		}
	} // boston, ��������� ���� ���������� RSS
	// favourites icon
	if(!$mosConfig_disable_favicon) {
		if(!$mosConfig_favicon) {
			$mosConfig_favicon = 'favicon.ico';
		}
		$icon = $mosConfig_absolute_path.'/images/'.$mosConfig_favicon;
		if(!file_exists($icon)) {
			$icon = $mosConfig_live_site.'/images/favicon.ico';
		} else {
			$icon = $mosConfig_live_site.'/images/'.$mosConfig_favicon;
		}
		echo '<link rel="shortcut icon" href="'.$icon.'" />';
	}
}

function set_robot_metatag($robots) {
	global $mainframe;
	if($robots == 0) {
		$mainframe->addMetaTag('robots','index, follow');
	}
	if($robots == 1) {
		$mainframe->addMetaTag('robots','index, nofollow');
	}
	if($robots == 2) {
		$mainframe->addMetaTag('robots','noindex, follow');
	}
	if($robots == 3) {
		$mainframe->addMetaTag('robots','noindex, nofollow');
	}
}

?>
