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

if(!defined('_JOS_FULLMENU_MODULE')) {
	/** ensure that functions are declared only once*/
	define('_JOS_FULLMENU_MODULE',1);

	/**
	* Full DHTML Admnistrator Menus
	* @package Joostina
	*/
	class mosFullAdminMenu {
		/**
		* Show the menu
		* @param string The current user type
		*/
		function show($usertype = '') {
			global $acl,$my;
			$database = &database::getInstance();
			$config = &Jconfig::getInstance();

			echo '<div id="myMenuID"></div>'; // � ���� ���� ��������� ���������� ����
			if($config->config_adm_menu_cache) { // ���������, ������������ �� ����������� � ������ ����������
				$usertype = $my->usertype;
				$usertype_menu = str_replace(' ','_',$usertype);
				// �������� ����� ���� ������� �� md5 ���� ���� ������������ � ���������� ����� ���������� ���������
				$menuname = md5($usertype_menu.$config->config_secret);
				echo '<script type="text/javascript" src="'.$config->config_live_site.'/cache/adm_menu_'.$menuname.'.js"></script>';
				if(js_menu_cache('',$usertype_menu,1) == 'true') { // ���� ����, ������� ������ �� ���� � ���������� ������
					return; // ���������� ��������� ���� �� ����
				} // ����� �� ���� - ���������� ���, ������ � �� ����� ���������� ������
			}
			// ��������� ������ � ������ ������������
			$canConfig = $acl->acl_check('administration','config','users',$usertype);
			$manageTemplates = $acl->acl_check('administration','manage','users',$usertype,'components','com_templates');
			$manageTrash = $acl->acl_check('administration','manage','users',$usertype,'components','com_trash');
			$manageMenuMan = $acl->acl_check('administration','manage','users',$usertype,'components','com_menumanager');
			$manageLanguages = $acl->acl_check('administration','manage','users',$usertype,'components','com_languages');
			$installModules = $acl->acl_check('administration','install','users',$usertype,'modules','all');
			$editAllModules = $acl->acl_check('administration','edit','users',$usertype,'modules','all');
			$installMambots = $acl->acl_check('administration','install','users',$usertype,'mambots','all');
			$editAllMambots = $acl->acl_check('administration','edit','users',$usertype,'mambots','all');
			$installComponents = $acl->acl_check('administration','install','users',$usertype,'components','all');
			$editAllComponents = $acl->acl_check('administration','edit','users',$usertype,'components','all');
			$canMassMail = $acl->acl_check('administration','manage','users',$usertype,'components','com_massmail');
			$canManageUsers = $acl->acl_check('administration','manage','users',$usertype,'components','com_users');
			$menuTypes = mosAdminMenus::menutypes();
			$query = "SELECT a.id, a.title, a.name FROM #__sections AS a WHERE a.scope = 'content' ORDER BY a.ordering";
			$database->setQuery($query);
			$sections = $database->loadObjectList();

			// �������������� ������� � �������� �������� ����
			$mainframe = mosMainFrame::getInstance(true);
			$cur_file_icons_patch = $mainframe->getCfg('live_site').'/'.ADMINISTRATOR_DIRECTORY.'/templates/'.$mainframe->getTemplate().'/images/menu_ico/';

			ob_start(); // ���������� �� ���������� ���� � �����
?>
var myMenu =[
[null,'<?php echo _SITE?>',null,null,'<?php echo _MOD_FULLMENU_CMS_FEATURES?>',
<?php
	if($canConfig) {
?>['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_GLOBAL_CONFIG?>','index2.php?option=com_config&hidemainmenu=1',null,'<?php echo _MOD_FULLMENU_GLOBAL_CONFIG_TIP?>'],
<?php
	}
	if($manageLanguages) {
?>['<img src="<?php echo $cur_file_icons_patch ?>language.png" />','<?php echo _MOD_FULLMENU_LANGUAGES?>','index2.php?option=com_languages',null,'<?php echo _MOD_FULLMENU_LANGUAGES_TIP?>',

],
<?php
	}
?>['<img src="<?php echo $cur_file_icons_patch ?>preview.png" />', '<?php echo _MOD_FULLMENU_SITE_PREVIEW?>', null, null, '<?php echo _MOD_FULLMENU_SITE_PREVIEW?>',
['<img src="<?php echo $cur_file_icons_patch ?>preview.png" />','<?php echo _MOD_FULLMENU_SITE_PREVIEW_IN_NEW_WINDOW?>','<?php echo $config->config_live_site; ?>/index.php','_blank','<?php echo $config->config_live_site; ?>'],
['<img src="<?php echo $cur_file_icons_patch ?>preview.png" />','<?php echo _MOD_FULLMENU_SITE_PREVIEW_IN_THIS_WINDOW?>','index2.php?option=com_admin&task=preview',null,'<?php echo $config->config_live_site; ?>'],
['<img src="<?php echo $cur_file_icons_patch ?>preview.png" />','<?php echo _MOD_FULLMENU_SITE_PREVIEW_WITH_MODULE_POSITIONS?>','index2.php?option=com_admin&task=preview2',null,'<?php echo $config->config_live_site; ?>'],
],
 ['<img src="<?php echo $cur_file_icons_patch ?>globe1.png" />', '<?php echo _MOD_FULLMENU_SITE_STATS?>', null, null, '<?php echo _MOD_FULLMENU_SITE_STATS_TIP?>',
<?php
	if($config->config_enable_stats == 1) {
?> ['<img src="<?php echo $cur_file_icons_patch ?>globe4.png" />', '<?php echo _MOD_FULLMENU_STATS_BROWSERS?>', 'index2.php?option=com_statistics', null, '<?php echo _MOD_FULLMENU_STATS_BROWSERS_TIP?>'],
<?php
	}
?>['<img src="<?php echo $cur_file_icons_patch ?>search_text.png" />', '<?php echo _MOD_FULLMENU_SEARCHES?>', 'index2.php?option=com_statistics&task=searches', null, '<?php echo _MOD_FULLMENU_SEARCHES_TIP?>'],
['<img src="<?php echo $cur_file_icons_patch ?>globe3.png" />', '<?php echo _MOD_FULLMENU_PAGE_STATS?>', 'index2.php?option=com_statistics&task=pageimp', null, '<?php echo _MOD_FULLMENU_PAGE_STATS?>']
],
<?php
	if($manageTemplates) {
?>['<img src="<?php echo $cur_file_icons_patch ?>template.png" />','<?php echo _TEMPLATES?>',null,null,'<?php echo _MOD_FULLMENU_TEMPLATES_TIP?>',
	['<img src="<?php echo $cur_file_icons_patch ?>template.png" />','<?php echo _MOD_FULLMENU_SITE_TEMPLATES?>','index2.php?option=com_templates',null,'<?php echo _MOD_FULLMENU_SITE_TEMPLATES?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>template.png" />','<?php echo _MOD_FULLMENU_ADMIN_TEMPLATES?>','index2.php?option=com_templates&client=admin',null,'<?php echo _MOD_FULLMENU_ADMIN_TEMPLATES?>'],
	_cmSplit,
	['<img src="<?php echo $cur_file_icons_patch ?>template.png" />','<?php echo _MOD_FULLMENU_MODULES_POSITION?>','index2.php?option=com_templates&task=positions',null,'<?php echo _MOD_FULLMENU_MODULES_POSITION?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>install.png" />','<?php echo _MOD_FULLMENU_NEW_SITE_TEMPLATE?>','index2.php?option=com_installer&element=template&client=admin',null,'<?php echo _MOD_FULLMENU_NEW_SITE_TEMPLATE?>']
	],
<?php }
		// Menu Sub-Menu
?>],
<?php if($canManageUsers || $canMassMail) {
?>[null,'<?php echo _USERS?>',null,null,'<?php echo _USERS?>',
	['<img src="<?php echo $cur_file_icons_patch ?>user.png" />','<?php echo _MOD_FULLMENU_ALL_USERS?>','index2.php?option=com_users&task=view',null,'<?php echo _MOD_FULLMENU_ALL_USERS?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>template.png" />','<?php echo _MOD_FULLMENU_ADD_USER?>','index2.php?option=com_users&task=edit',null,'<?php echo _MOD_FULLMENU_ADD_USER?>'],
	_cmSplit,
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_REGISTER_SETUP?>','index2.php?option=com_users&task=config&act=registration',null,'<?php echo _MOD_FULLMENU_REGISTER_SETUP?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_PROFILE_SETUP?>','index2.php?option=com_users&task=config&act=profile',null,'<?php echo _MOD_FULLMENU_PROFILE_SETUP?>']
],
<?php } ?>

[null,'<?php echo _MOD_FULLMENU_MENU?>',null,null,'<?php echo _MOD_FULLMENU_MENU?>',
<?php
	if($manageMenuMan) {
?>['<img src="<?php echo $cur_file_icons_patch ?>menus.png" />','<?php echo _MOD_FULLMENU_MENU?>','index2.php?option=com_menumanager',null,'<?php echo _MOD_FULLMENU_MENU?>'],
_cmSplit,
<?php
	}
	foreach($menuTypes as $menuType) {
?>['<img src="<?php echo $cur_file_icons_patch ?>menus.png" />','<?php echo $menuType; ?>','index2.php?option=com_menus&menutype=<?php echo $menuType; ?>',null,''],
<?php
	}
	if($manageTrash) {
?>
_cmSplit,['<img src="<?php echo $cur_file_icons_patch ?>trash.png" />','<?php echo _TRASH?>','index2.php?option=com_trash&catid=menu',null,'<?php echo _TRASH?>'],
<?php
	}
?>
],[null,'<?php echo _CONTENT?>',null,null,'<?php echo _CONTENT?>',
<?php
		if(count($sections) > 0) {
?>  ['<img src="<?php echo $cur_file_icons_patch ?>edit.png" />','<?php echo _MOD_FULLMENU_CONTENT_IN_SECTIONS?>',null,null,'<?php echo _MOD_FULLMENU_CONTENT_IN_SECTIONS?>',
<?php
	foreach($sections as $section) {
		$txt = addslashes($section->title ? $section->title:$section->name);
?>['<img src="<?php echo $cur_file_icons_patch ?>document.png" />','<?php echo $txt; ?>', null, null,'<?php echo _SECTION?>: <?php echo $txt; ?>',
	['<img src="<?php echo $cur_file_icons_patch ?>edit.png" />', '<?php echo _MOD_FULLMENU_CONTENT_IN_SECTION?>: <?php echo $txt; ?>', 'index2.php?option=com_content&sectionid=<?php echo $section->id; ?>',null,null],
	['<img src="<?php echo $cur_file_icons_patch ?>backup.png" />', '<?php echo _MOD_FULLMENU_SECTION_ARCHIVE?>: <?php echo $txt; ?>', 'index2.php?option=com_content&task=showarchive&sectionid=<?php echo $section->id; ?>',null,null],
	['<img src="<?php echo $cur_file_icons_patch ?>sections.png" />', '<?php echo _MOD_FULLMENU_SECTION_CATEGORIES2?>: <?php echo $txt; ?>', 'index2.php?option=com_categories&section=<?php echo $section->id; ?>',null, null],
],
<?php
	} // foreach
?>
],_cmSplit,
<?php
	}
?>
['<img src="<?php echo $cur_file_icons_patch ?>edit.png" />','<?php echo _ALL_CONTENT?>','index2.php?option=com_content&sectionid=0',null,'<?php echo _ALL_CONTENT?>'],
['<img src="<?php echo $cur_file_icons_patch ?>edit.png" />','<?php echo _MOD_FULLMENU_ADD_CONTENT_ITEM?>','index2.php?option=com_content&sectionid=0&task=new',null,'<?php echo _MOD_FULLMENU_ADD_CONTENT_ITEM?>'],
_cmSplit,
['<img src="<?php echo $cur_file_icons_patch ?>edit.png" />','<?php echo _STATIC_CONTENT?>','index2.php?option=com_typedcontent',null,'<?php echo _STATIC_CONTENT?>'],
['<img src="<?php echo $cur_file_icons_patch ?>edit.png" />','<?php echo _MOD_FULLMENU_ADD_STATIC_CONTENT?>','index2.php?option=com_typedcontent&task=new',null,'<?php echo _MOD_FULLMENU_ADD_STATIC_CONTENT?>'],
_cmSplit,
['<img src="<?php echo $cur_file_icons_patch ?>add_section.png" />','<?php echo _SECTIONS?>','index2.php?option=com_sections&scope=content',null,'<?php echo _SECTIONS?>'],
['<img src="<?php echo $cur_file_icons_patch ?>sections.png" />','<?php echo _CATEGORIES?>','index2.php?option=com_categories&section=content',null,'<?php echo _CATEGORIES?>'],
['<img src="<?php echo $cur_file_icons_patch ?>masadd.png" />','<?php echo _MOD_FULLMENU_MASS_CONTENT_ADD?>','index2.php?option=com_sections&task=masadd',null,'<?php echo _MOD_FULLMENU_MASS_CONTENT_ADD?>'],
_cmSplit,
['<img src="<?php echo $cur_file_icons_patch ?>home.png" />','<?php echo _MOD_FULLMENU_CONTENT_ON_FRONTPAGE?>','index2.php?option=com_frontpage',null,'<?php echo _MOD_FULLMENU_CONTENT_ON_FRONTPAGE?>'],
['<img src="<?php echo $cur_file_icons_patch ?>edit.png" />','<?php echo _ARCHIVE?>','index2.php?option=com_content&task=showarchive&sectionid=0',null,'<?php echo _ARCHIVE?>'],
_cmSplit,
['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_C_DEF_SETUP?>',null,null,'<?php echo _MOD_FULLMENU_C_DEF_SETUP?>',
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_C_SECTION_BLOG?>','index2.php?option=com_content&task=config&act=sectionblog',null,'<?php echo _MOD_FULLMENU_C_SECTION_BLOG?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_C_CAT_BLOG?>','index2.php?option=com_content&task=config&act=categoryblog',null,'<?php echo _MOD_FULLMENU_C_CAT_BLOG?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_C_LIST_BLOG?>','index2.php?option=com_content&task=config&act=sectionlist',null,'<?php echo _MOD_FULLMENU_C_LIST_BLOG?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_C_TABLE_BLOG?>','index2.php?option=com_content&task=config&act=categorytable',null,'<?php echo _MOD_FULLMENU_C_TABLE_BLOG?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_C_ARH_SECTION?>','index2.php?option=com_content&task=config&act=sectionarchive',null,'<?php echo _MOD_FULLMENU_C_ARH_SECTION?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_C_ARH_CAT?>','index2.php?option=com_content&task=config&act=categoryarchive',null,'<?php echo _MOD_FULLMENU_C_ARH_CAT?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_USER_CONTENT?>','index2.php?option=com_content&task=config&act=ucontent',null,'<?php echo _MOD_FULLMENU_USER_CONTENT?>']
],
['<img src="<?php echo $cur_file_icons_patch ?>globe3.png" />', '<?php echo _MOD_FULLMENU_PAGES_HITS?>', 'index2.php?option=com_statistics&task=pageimp', null, '<?php echo _MOD_FULLMENU_PAGES_HITS?>'],
['<img src="<?php echo $cur_file_icons_patch ?>trash.png" />','<?php echo _MOD_FULLMENU_CONTENT_TRASH?>','index2.php?option=com_trash&catid=content',null,'<?php echo _MOD_FULLMENU_CONTENT_TRASH?>'],
],
<?php
	// Components Sub-Menu
	if($installComponents | $editAllComponents) {
?>
[null,'<?php echo _COMPONENTS?>',null,null,'<?php echo _COMPONENTS?>',
<?php
				$query = "SELECT* FROM #__components ORDER BY ordering, name";
				$database->setQuery($query);
				$comps = $database->loadObjectList(); // component list
				$subs = array(); // sub menus
				// first pass to collect sub-menu items
				foreach($comps as $row) {
					if($row->parent) {
						if(!array_key_exists($row->parent,$subs)) {
							$subs[$row->parent] = array();
						}
						$subs[$row->parent][] = $row;
					}
				}
				$topLevelLimit = 19; //You can get 19 top levels on a 800x600 Resolution
				$topLevelCount = 0;
				foreach($comps as $row) {
					if($editAllComponents | $acl->acl_check('administration','edit','users',$usertype,'components',$row->option)) {
						if($row->parent == 0 && (trim($row->admin_menu_link) || array_key_exists($row->id,
							$subs))) {
							$topLevelCount++;
							if($topLevelCount > $topLevelLimit) {
								continue;
							}
							$name = addslashes($row->name);
							$alt = addslashes($row->admin_menu_alt);
							$link = $row->admin_menu_link?"'index2.php?$row->admin_menu_link'":"null";
							echo "\t['<img src=\"../includes/$row->admin_menu_img\" />','$name',$link,null,'$alt'";
							if(array_key_exists($row->id,$subs)) {
								foreach($subs[$row->id] as $sub) {
									echo ",\n";
									$name = addslashes($sub->name);
									$alt = addslashes($sub->admin_menu_alt);
									$link = $sub->admin_menu_link?"'index2.php?$sub->admin_menu_link'":"null";
									echo "['<img src=\"../includes/$sub->admin_menu_img\" />','$name',$link,null,'$alt']";
								}
							}
							echo "],\n";
						}
					}
				}
				if($topLevelLimit < $topLevelCount) {
					echo "['<img src=\"<?php echo $cur_file_icons_patch ?>sections.png\" />','"._MOD_FULLMENU_ALL_COMPONENTS."','index2.php?option=com_admin&task=listcomponents',null,'"._MOD_FULLMENU_ALL_COMPONENTS."'],\n";
				}
				if($installModules){
					?> _cmSplit,
					['<img src="<?php echo $cur_file_icons_patch ?>install.png" />', '<?php echo _MOD_FULLMENU_EDIT_COMPONENTS_MENU?>','index2.php?option=com_linkeditor ',null,'<?php echo _MOD_FULLMENU_EDIT_COMPONENTS_MENU?>'],
					['<img src="<?php echo $cur_file_icons_patch ?>install.png" />', '<?php echo _MOD_FULLMENU_COMPONENTS_INSTALL_UNINSTALL?>','index2.php?option=com_installer&element=component',null,'<?php echo _MOD_FULLMENU_COMPONENTS_INSTALL_UNINSTALL?>'],
					],
<?php
	}
	// Modules Sub-Menu
	if($installModules | $editAllModules) {
?>
[null,'<?php echo _MODULES?>',null,null,'<?php echo _MOD_FULLMENU_MODULES_SETUP?>',
<?php
	if($editAllModules) {
?>
	['<img src="<?php echo $cur_file_icons_patch ?>module.png" />', '<?php echo _MOD_FULLMENU_SITE_MODULES?>', "index2.php?option=com_modules", null, '<?php echo _MOD_FULLMENU_SITE_MODULES?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>module.png" />', '<?php echo _MOD_FULLMENU_ADMIN_MODULES?>', "index2.php?option=com_modules&client=admin", null, '<?php echo _MOD_FULLMENU_ADMIN_MODULES?>'],
	_cmSplit,
	['<img src="<?php echo $cur_file_icons_patch ?>install.png" />', '<?php echo _MOD_FULLMENU_MODULES_INSTALL_DEINSTALL?>', 'index2.php?option=com_installer&element=module', null, '<?php echo _MOD_FULLMENU_MODULES_INSTALL_DEINSTALL?>'],
	<?php
	}
?>],
<?php
	}
} if($installMambots | $editAllMambots) { ?>
[null,'<?php echo _MAMBOTS?>',null,null,'<?php echo _MAMBOTS?>',
<?php if($editAllMambots) { ?>
['<img src="<?php echo $cur_file_icons_patch ?>module.png" />', '<?php echo _MOD_FULLMENU_SITE_MAMBOTS?>', "index2.php?option=com_mambots", null, '<?php echo _MOD_FULLMENU_SITE_MAMBOTS?>'],
_cmSplit,
['<img src="<?php echo $cur_file_icons_patch ?>install.png" />', '<?php echo _MOD_FULLMENU_MAMBOTS_INSTALL_UNINSTALL?>', 'index2.php?option=com_installer&element=mambot', null, '<?php echo _MOD_FULLMENU_MAMBOTS_INSTALL_UNINSTALL?>'],
<?php } ?>
],
<?php } if($installModules) { ?>
[null,'<?php echo _EXTENSIONS?>',null,null,'<?php echo _MOD_FULLMENU_EXTENSION_MANAGEMENT?>',
['<img src="<?php echo $cur_file_icons_patch ?>install.png" />', '<?php echo _INSTALLATION . " / " . _DELETING?>','index2.php?option=com_installer&element=installer',null,'<?php echo _INSTALLATION . " / " . _DELETING?>'],
<?php if($manageLanguages) { ?>
_cmSplit,['<img src="<?php echo $cur_file_icons_patch ?>install.png" />','<?php echo _MOD_FULLMENU_SITE_LANGUAGES?>','index2.php?option=com_installer&element=language',null,'<?php echo _MOD_FULLMENU_SITE_LANGUAGES?>'],
<?php } if($manageTemplates) {?>
_cmSplit,
['<img src="<?php echo $cur_file_icons_patch ?>install.png" />','<?php echo _MOD_FULLMENU_SITE_TEMPLATES?>','index2.php?option=com_installer&element=template&client=',null,'<?php echo _MOD_FULLMENU_SITE_TEMPLATES?>'],
['<img src="<?php echo $cur_file_icons_patch ?>install.png" />','<?php echo _MOD_FULLMENU_ADMIN_TEMPLATES?>','index2.php?option=com_installer&element=template&client=admin',null,'<?php echo _MOD_FULLMENU_ADMIN_TEMPLATES?>'],
<?php } ?>
],
<?php }?>
[null,'<?php echo _MOD_FULLMENU_JOOMLA_TOOLS?>',null,null,'<?php echo _MOD_FULLMENU_JOOMLA_TOOLS?>',
['<img src="<?php echo $cur_file_icons_patch ?>messaging_inbox.png" />','<?php echo _MOD_FULLMENU_PRIVATE_MESSAGES?>','index2.php?option=com_messages',null,'<?php echo _MOD_FULLMENU_PRIVATE_MESSAGES?>'],
['<img src="<?php echo $cur_file_icons_patch ?>messaging_config.png" />','<?php echo _MOD_FULLMENU_PRIVATE_MESSAGES_CONFIG?>','index2.php?option=com_messages&task=config&hidemainmenu=1',null,'<?php echo _MOD_FULLMENU_PRIVATE_MESSAGES_CONFIG?>'],
_cmSplit,
['<img src="<?php echo $cur_file_icons_patch ?>media.png" />','<?php echo _MOD_FULLMENU_JWMM_MEDIA_MANAGER?>','index2.php?option=com_jwmmxtd',null,'<?php echo _MOD_FULLMENU_JWMM_MEDIA_MANAGER?>'],
<?php if($canConfig) { ?>
['<img src="<?php echo $cur_file_icons_patch ?>jfmanager.png" />','<?php echo _MOD_FULLMENU_FILE_MANAGER?>','index2.php?option=com_joomlaxplorer',null,'<?php echo _MOD_FULLMENU_FILE_MANAGER?>'],
['<img src="<?php echo $cur_file_icons_patch ?>license.png" />','<?php echo _MOD_FULLMENU_SQL_CONSOLE?>','index2.php?option=com_easysql',null,'<?php echo _MOD_FULLMENU_SQL_CONSOLE?>'],
_cmSplit,
['<img src="<?php echo $cur_file_icons_patch ?>checkin.png" />', '<?php echo _MOD_FULLMENU_GLOBAL_CHECKIN?>', 'index2.php?option=com_checkin', null,'<?php echo _MOD_FULLMENU_GLOBAL_CHECKIN?>'],
['<img src="<?php echo $cur_file_icons_patch ?>checkin.png" />', '<?php echo _MOD_FULLMENU_BLOCKED_OBJECTS?>', 'index2.php?option=com_checkin&task=mycheckin', null,'<?php echo _MOD_FULLMENU_BLOCKED_OBJECTS?>'],
 _cmSplit,
['<img src="<?php echo $cur_file_icons_patch ?>jbackup.png" />','<?php echo _MOD_FULLMENU_JP_BACKUP_MANAGEMENT?>','index2.php?option=com_joomlapack',null,'<?php echo _MOD_FULLMENU_JP_BACKUP_MANAGEMENT?>',
['<img src="<?php echo $cur_file_icons_patch ?>jbackup.png" />','<?php echo _MOD_FULLMENU_JP_CREATE_BACKUP?>','index2.php?option=com_joomlapack&act=pack&hidemainmenu=1',null,'<?php echo _MOD_FULLMENU_JP_CREATE_BACKUP?>'],
['<img src="<?php echo $cur_file_icons_patch ?>db.png" />','<?php echo _MOD_FULLMENU_JP_DB_MANAGEMENT?>','index2.php?option=com_joomlapack&act=db',null,'<?php echo _MOD_FULLMENU_JP_DB_MANAGEMENT?>'],
['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_BACKUP_CONFIG?>','index2.php?option=com_joomlapack&act=config',null,'<?php echo _MOD_FULLMENU_BACKUP_CONFIG?>']],
<?php } ?>
<?php if($config->config_cache_handler == 'file') { ?>
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_CACHE_MANAGEMENT?>','index2.php?option=com_cache',null,'<?php echo _MOD_FULLMENU_CACHE_MANAGEMENT?>'],
<?php }?>
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_CLEAR_CONTENT_CACHE?>','index2.php?option=com_admin&task=clean_cache',null,'<?php echo _MOD_FULLMENU_CLEAR_CONTENT_CACHE?>'],
	['<img src="<?php echo $cur_file_icons_patch ?>config.png" />','<?php echo _MOD_FULLMENU_CLEAR_ALL_CACHE?>','index2.php?option=com_admin&task=clean_all_cache',null,'<?php echo _MOD_FULLMENU_CLEAR_ALL_CACHE?>'],

<?php
if($canConfig) {?>
['<img src="<?php echo $cur_file_icons_patch ?>sysinfo.png" />', '<?php echo _MOD_FULLMENU_SYSTEM_INFO?>', 'index2.php?option=com_admin&task=sysinfo', null,'<?php echo _MOD_FULLMENU_SYSTEM_INFO?>'],
<?php
}
?>
],
_cmSplit];
cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
<?php
			// boston, ���������� ���� � ���, � ���������� � ����
			$cur_menu = ob_get_contents();
			ob_end_clean();
			if($config->config_adm_menu_cache){
				js_menu_cache($cur_menu,$usertype_menu);
			}else{
				echo '<script language="JavaScript" type="text/javascript">'.$cur_menu.'</script>';
			}

	}
		/**
		* Show an disbaled version of the menu, used in edit pages
		* @param string The current user type
		*/
		function showDisabled($usertype = '') {
			global $acl;

			$canConfig = $acl->acl_check('administration','config','users',$usertype);
			$installModules = $acl->acl_check('administration','install','users',$usertype,'modules','all');
			$editAllModules = $acl->acl_check('administration','edit','users',$usertype,'modules','all');
			$installMambots = $acl->acl_check('administration','install','users',$usertype,'mambots','all');
			$editAllMambots = $acl->acl_check('administration','edit','users',$usertype,'mambots','all');
			$installComponents = $acl->acl_check('administration','install','users',$usertype,'components','all');
			$editAllComponents = $acl->acl_check('administration','edit','users',$usertype,'components','all');
			$text = _MOD_FULLMENU_NO_ACTIVE_MENU_ON_THIS_PAGE;
?>
  <div id="myMenuID" class="inactive"></div>
  <script language="JavaScript" type="text/javascript">
  var myMenu =
  [
   [null,'<?php echo _SITE; ?>',null,null,'<?php echo $text; ?>'],
   _cmSplit,
   [null,'<?php echo _USERS?>',null,null,'<?php echo _USERS?>'],
   [null,'<?php echo _MOD_FULLMENU_MENU; ?>',null,null,'<?php echo $text; ?>'],
   _cmSplit,
  <?php
			/* Content Sub-Menu*/
?>
    [null,'<?php echo _CONTENT; ?>',null,null,'<?php echo $text; ?>'
   ],
  <?php
			/* Components Sub-Menu*/
				if ( $installComponents | $editAllComponents) {
?>
    _cmSplit,
    [null,'<?php echo _COMPONENTS; ?>',null,null,'<?php echo $text; ?>'
    ],
    <?php
			} // if $installComponents

?>
  <?php
			/* Modules Sub-Menu*/
			if($installModules | $editAllModules) {
?>
    _cmSplit,
    [null,'<?php echo _MODULES; ?>',null,null,'<?php echo $text; ?>'
    ],
    <?php
	} // if ( $installModules | $editAllModules)
	/* Mambots Sub-Menu*/
	if($installMambots | $editAllMambots) {
?>
_cmSplit,
[null,'<?php echo _MAMBOTS; ?>',null,null,'<?php echo $text; ?>'],
<?php
			} // if ( $installMambots | $editAllMambots)
			/* Installer Sub-Menu*/
	if($installModules) {
?>
    _cmSplit,
    [null,'<?php echo _EXTENSIONS; ?>',null,null,'<?php echo $text; ?>'
     <?php
?>
    ],
    <?php
	} // if ( $installModules)
	/* System Sub-Menu*/
if($canConfig) {
?>
_cmSplit,[null,'<?php echo _MOD_FULLMENU_JOOMLA_TOOLS; ?>',null,null,'<?php echo $text; ?>'],
<?php
	}
?>
  ];
  cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
  </script>
  <?php
		}
	}
}
$hide = intval(mosGetParam($_REQUEST,'hidemainmenu',0));

global $my;

if($hide) {
	mosFullAdminMenu::showDisabled($my->usertype);
} else {
	mosFullAdminMenu::show($my->usertype);
}