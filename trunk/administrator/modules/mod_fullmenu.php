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

if (!defined( '_JOS_FULLMENU_MODULE' )) {
	/** ensure that functions are declared only once */
	define( '_JOS_FULLMENU_MODULE', 1 );

/**
* Full DHTML Admnistrator Menus
* @package Joostina
*/
class mosFullAdminMenu {
	/**
	* Show the menu
	* @param string The current user type
	*/
	function show( $usertype='' ) {
		global $acl, $database,$my;
		global $mosConfig_live_site, $mosConfig_enable_stats, $mosConfig_caching,$mosConfig_secret,$mosConfig_adm_menu_cache;
		echo '<div id="myMenuID"></div>'; // � ���� ���� ��������� ���������� ����
		if($mosConfig_adm_menu_cache){ // ���������, ������������ �� ����������� � ������ ����������
			// boston, ��������� ����������� ����
			$usertype = $my->usertype;
			$usertype_menu = str_replace(' ','_',$usertype);
			// �������� ����� ���� ������� �� md5 ���� ���� ������������ � ���������� ����� ���������� ���������
			$menuname = md5($usertype_menu.$mosConfig_secret);
			echo "<script type=\"text/javascript\" src=\"".$mosConfig_live_site."/cache/adm_menu_".$menuname.".js\"></script>";
			if(js_menu_cache('',$usertype_menu,1)=='true'){ // ���� ����, ������� ������ �� ���� � ���������� ������
				return; // ���������� ��������� ���� �� ����
			}// ����� �� ���� - ���������� ���, ������ � �� ����� ���������� ������
			}
		// ��������� ������ � ������ ������������
		$canConfig = $acl->acl_check( 'administration', 'config', 'users', $usertype );
		$manageTemplates= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_templates' );
		$manageTrash  = $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_trash' );
		$manageMenuMan  = $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_menumanager' );
		$manageLanguages= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_languages' );
		$installModules= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'modules', 'all' );
		$editAllModules= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'modules', 'all' );
		$installMambots= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'mambots', 'all' );
		$editAllMambots= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'mambots', 'all' );
		$installComponents= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'components', 'all' );
		$editAllComponents= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', 'all' );
		$canMassMail  = $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_massmail' );
		$canManageUsers= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_users' );
		$menuTypes = mosAdminMenus::menutypes();
		$query = "SELECT a.id, a.title, a.name"
		. "\n FROM #__sections AS a"
		. "\n WHERE a.scope = 'content'"
		. "\n GROUP BY a.id"
		. "\n ORDER BY a.ordering";
		$database->setQuery( $query );
		$sections = $database->loadObjectList();
ob_start(); // ���������� �� ���������� ���� � �����
?>
var myMenu =[
 [null,'�������','index2.php',null,'������� �� ������� �������� ������ ����������'],
 _cmSplit,
 [null,'����',null,null,'���������� ��������� ������������� �������',
<?php
if ($canConfig) {
?>  ['<img src="../includes/js/ThemeOffice/config.png" />','���������� ������������','index2.php?option=com_config&hidemainmenu=1',null,'��������� �������� ���������� ������������ �������'],
<?php
}
if ($manageLanguages) {
?>  ['<img src="../includes/js/ThemeOffice/language.png" />','�������� ������',null,null,'���������� ��������� �������',
['<img src="../includes/js/ThemeOffice/language.png" />','�������� ������ �����','index2.php?option=com_languages',null,'���������� ��������� �������� �����'],
],
<?php
}
?>['<img src="../includes/js/ThemeOffice/media.png" />','����� ��������','index2.php?option=com_jwmmxtd',null,'���������� ����� �������'],
<?php if ($canConfig) { ?>
['<img src="../administrator/components/com_joomlaxplorer/images/joomla_x_icon.png" />','�������� ��������','index2.php?option=com_joomlaxplorer',null,'���������� �������'],
['<img src="../includes/js/ThemeOffice/license.png" />','SQL ��������','index2.php?option=com_easysql',null,'���������� sql ��������'],
<?php }?>
['<img src="../includes/js/ThemeOffice/preview.png" />', '������������ �����', null, null, '������������ �����',
['<img src="../includes/js/ThemeOffice/preview.png" />','� ����� ����','<?php echo $mosConfig_live_site; ?>/index.php','_blank','<?php echo $mosConfig_live_site; ?>'],
['<img src="../includes/js/ThemeOffice/preview.png" />','������','index2.php?option=com_admin&task=preview',null,'<?php echo $mosConfig_live_site; ?>'],
['<img src="../includes/js/ThemeOffice/preview.png" />','������ � ���������','index2.php?option=com_admin&task=preview2',null,'<?php echo $mosConfig_live_site; ?>'],
],
 ['<img src="../includes/js/ThemeOffice/globe1.png" />', '���������� �����', null, null, '�������� ���������� �� �����',
<?php
if ($mosConfig_enable_stats == 1) {
?> ['<img src="../includes/js/ThemeOffice/globe4.png" />', '��������, ��, ������', 'index2.php?option=com_statistics', null, '���������� ��������� ����� �� ���������, �� � �������'],
<?php
}
?>['<img src="../includes/js/ThemeOffice/search_text.png" />', '��������� �������', 'index2.php?option=com_statistics&task=searches', null, '���������� ��������� �������� �� �����'],
['<img src="../includes/js/ThemeOffice/globe3.png" />', '���������� ��������� �������', 'index2.php?option=com_statistics&task=pageimp', null, '���������� ��������� �������']
],
<?php
	if ($manageTemplates) {
	?>['<img src="../includes/js/ThemeOffice/template.png" />','�������',null,null,'���������� ���������',
	['<img src="../includes/js/ThemeOffice/template.png" />','������� �����','index2.php?option=com_templates',null,'������� �����'],
	['<img src="../includes/js/ThemeOffice/install.png" />','��������� ������ �������','index2.php?option=com_installer&element=template&client=',null,'��������� �������� �����'],
	_cmSplit,
	['<img src="../includes/js/ThemeOffice/template.png" />','������� �����������','index2.php?option=com_templates&client=admin',null,'������� ������ ����������'],
	['<img src="../includes/js/ThemeOffice/install.png" />','��������� ������ �������','index2.php?option=com_installer&element=template&client=admin',null,'��������� �������� ������ ����������'],
	_cmSplit,
	['<img src="../includes/js/ThemeOffice/template.png" />','������� �������','index2.php?option=com_templates&task=positions',null,'������� �������']
	],
<?php
	}
if ($manageTrash) {
	?>
	['<img src="../includes/js/ThemeOffice/trash.png" />','�������','index2.php?option=com_trash',null,'���������� ���������, ������������ � �������'],
<?php
	}
if ($canManageUsers || $canMassMail) {
?>['<img src="../includes/js/ThemeOffice/users.png" />','������������','index2.php?option=com_users&task=view',null,'���������� ��������������'],
<?php
}
?>],
<?php
  // Menu Sub-Menu
?>_cmSplit,
[null,'����',null,null,'���������� ����',
<?php
if ($manageMenuMan) {
?>['<img src="../includes/js/ThemeOffice/menus.png" />','���������� ����','index2.php?option=com_menumanager',null,'���������� ���� �����'],
_cmSplit,
<?php
}
foreach ( $menuTypes as $menuType ) {
?>['<img src="../includes/js/ThemeOffice/menus.png" />','<?php echo $menuType;?>','index2.php?option=com_menus&menutype=<?php echo $menuType;?>',null,''],
	<?php
}
?>],_cmSplit,[null,'����������',null,null,'���������� ���������� �����������',
<?php
if (count($sections) > 0) {
?>  ['<img src="../includes/js/ThemeOffice/edit.png" />','���������� �� ��������',null,null,'���������� �� ��������',
<?php
foreach ($sections as $section) {
	$txt = addslashes( $section->title ? $section->title : $section->name );
	?>['<img src="../includes/js/ThemeOffice/document.png" />','<?php echo $txt;?>', null, null,'������: <?php echo $txt;?>',
	['<img src="../includes/js/ThemeOffice/edit.png" />', '���������� � �������: <?php echo $txt;?>', 'index2.php?option=com_content&sectionid=<?php echo $section->id;?>',null,null],
	['<img src="../includes/js/ThemeOffice/backup.png" />', '����� �������: <?php echo $txt;?>', 'index2.php?option=com_content&task=showarchive&sectionid=<?php echo $section->id;?>',null,null],
	['<img src="../includes/js/ThemeOffice/sections.png" />', '��������� �������: <?php echo $txt;?>', 'index2.php?option=com_categories&section=<?php echo $section->id;?>',null, null],
	],
<?php
	} // foreach
?>
],_cmSplit,
<?php
}
?>
['<img src="../includes/js/ThemeOffice/edit.png" />','�� ����������','index2.php?option=com_content&sectionid=0',null,'���������� ������� ���� �������� ����������� �����'],
['<img src="../includes/js/ThemeOffice/edit.png" />','�������� ������� / ������','index2.php?option=com_content&sectionid=0&task=new',null,'�������� ����� ���������� �� ����'],
_cmSplit,
['<img src="../includes/js/ThemeOffice/edit.png" />','��������� ����������','index2.php?option=com_typedcontent',null,'���������� ����� ���������� ��������� ����������� �����'],
['<img src="../includes/js/ThemeOffice/edit.png" />','�������� ��������� ����������','index2.php?option=com_typedcontent&task=new',null,'�������� ����� ��������� ���������� �� ����'],
_cmSplit,
['<img src="../includes/js/ThemeOffice/add_section.png" />','�������','index2.php?option=com_sections&scope=content',null,'���������� ���������'],
['<img src="../includes/js/ThemeOffice/sections.png" />','���������','index2.php?option=com_categories&section=content',null,'���������� �����������'],
_cmSplit,
['<img src="../includes/js/ThemeOffice/home.png" />','������� ��������','index2.php?option=com_frontpage',null,'���������� ��������� �����������, ��������������� �� ������� �������� �����'],
['<img src="../includes/js/ThemeOffice/edit.png" />','�����','index2.php?option=com_content&task=showarchive&sectionid=0',null,'���������� ��������� �����������, ������������ � ������'],
['<img src="../includes/js/ThemeOffice/globe3.png" />', '���������� ��������� �������', 'index2.php?option=com_statistics&task=pageimp', null, '���������� �������'],
],
<?php
// Components Sub-Menu
if ($installComponents | $editAllComponents) {
?>_cmSplit,
[null,'����������',null,null,'���������� ������������',
<?php
$query = "SELECT *"
. "\n FROM #__components"
. "\n ORDER BY ordering, name";
$database->setQuery( $query );
$comps = $database->loadObjectList();  // component list
$subs = array();  // sub menus
// first pass to collect sub-menu items
foreach ($comps as $row) {
	if ($row->parent) {
		if (!array_key_exists( $row->parent, $subs )) {
			$subs[$row->parent] = array();
		}
		$subs[$row->parent][] = $row;
	}
}
$topLevelLimit = 19; //You can get 19 top levels on a 800x600 Resolution
$topLevelCount = 0;
foreach ($comps as $row) {
if ($editAllComponents | $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', $row->option )) {
if ($row->parent == 0 && (trim( $row->admin_menu_link ) || array_key_exists( $row->id, $subs ))) {
	$topLevelCount++;
	if ($topLevelCount > $topLevelLimit) {
		continue;
	}
	$name = addslashes( $row->name );
	$alt = addslashes( $row->admin_menu_alt );
	$link = $row->admin_menu_link ? "'index2.php?$row->admin_menu_link'" : "null";
	echo "\t\t\t\t['<img src=\"../includes/$row->admin_menu_img\" />','$name',$link,null,'$alt'";
	if (array_key_exists( $row->id, $subs )) {
		foreach ($subs[$row->id] as $sub) {
			echo ",\n";
			$name = addslashes( $sub->name );
			$alt = addslashes( $sub->admin_menu_alt );
			$link = $sub->admin_menu_link ? "'index2.php?$sub->admin_menu_link'" : "null";
			echo "\t\t\t\t\t['<img src=\"../includes/$sub->admin_menu_img\" />','$name',$link,null,'$alt']";
		}
	}
	echo "\n\t\t\t\t],\n";
	}
}
}
if ($topLevelLimit < $topLevelCount) {
	echo "\t\t\t\t['<img src=\"../includes/js/ThemeOffice/sections.png\" />','��� ����������...','index2.php?option=com_admin&task=listcomponents',null,'��� ����������'],\n";
}
?> _cmSplit,
['<img src="../includes/js/ThemeOffice/install.png" />', '������������� ���� �����������','index2.php?option=com_linkeditor ',null,'������������� ���� �����������'],
['<img src="../includes/js/ThemeOffice/install.png" />', '������ �������� �������','index2.php?option=com_customquickicons ',null,'������ �������� �������'],  
['<img src="../includes/js/ThemeOffice/install.png" />', '��������� / �������� �����������','index2.php?option=com_installer&element=component',null,'���������� ��� ������� ����������'],
],

<?php
// Modules Sub-Menu
 if ($installModules | $editAllModules) {
?>_cmSplit,
[null,'������',null,null,'���������� ��������',
<?php
if ($editAllModules) {
	?>
	['<img src="../includes/js/ThemeOffice/module.png" />', '������ �����', "index2.php?option=com_modules", null, '������ �����'],
	['<img src="../includes/js/ThemeOffice/module.png" />', '������ ������ ����������', "index2.php?option=com_modules&client=admin", null, '������ ������ ����������'],
	_cmSplit,
	['<img src="../includes/js/ThemeOffice/install.png" />', '��������� / �������� �������', 'index2.php?option=com_installer&element=module', null, '���������� ��� ������� ������'],
	<?php
	}
?>],
<?php
 } // if ($installModules | $editAllModules)
  } // if $installComponents
  // Mambots Sub-Menu
  if ($installMambots | $editAllMambots) {
?>_cmSplit,
[null,'�������',null,null,'���������� ���������',
<?php
 if ($editAllMambots) {
?>['<img src="../includes/js/ThemeOffice/module.png" />', '������� �����', "index2.php?option=com_mambots", null, '������� �����'],
_cmSplit,
['<img src="../includes/js/ThemeOffice/install.png" />', '��������� / �������� ��������', 'index2.php?option=com_installer&element=mambot', null, '���������� ��� ������� �������'],

<?php
 }
?>],
<?php
  }
?>
<?php
  // Installer Sub-Menu
  if ($installModules) {
?>_cmSplit,
[null,'����������',null,null,'���������� ������������',
['<img src="../includes/js/ThemeOffice/install.png" />', '����������','index2.php?option=com_installer&element=component',null,'���������� ��� ������� ����������'],
['<img src="../includes/js/ThemeOffice/install.png" />', '������', 'index2.php?option=com_installer&element=module', null, '���������� ��� ������� ������'],
['<img src="../includes/js/ThemeOffice/install.png" />', '�������', 'index2.php?option=com_installer&element=mambot', null, '���������� ��� ������� �������'],
_cmSplit,
<?php
 if ($manageLanguages) {
?>['<img src="../includes/js/ThemeOffice/install.png" />','����� �����','index2.php?option=com_installer&element=language',null,'��������� ��� �������� �������� �������'],
<?php
 }
?>
<?php
 if ($manageTemplates) {
?>_cmSplit,
['<img src="../includes/js/ThemeOffice/install.png" />','������� �����','index2.php?option=com_installer&element=template&client=',null,'��������� �������� �����'],
['<img src="../includes/js/ThemeOffice/install.png" />','������� �����������','index2.php?option=com_installer&element=template&client=admin',null,'��������� �������� ������ ����������'],
<?php
 }
?>
],
<?php
  } // if ($installModules)
  // Messages Sub-Menu
  if ($canConfig) {
?>_cmSplit,
[null,'���������',null,null,'���������� �����������',
['<img src="../includes/js/ThemeOffice/messaging_inbox.png" />','��������','index2.php?option=com_messages',null,'������ ���������'],
['<img src="../includes/js/ThemeOffice/messaging_config.png" />','���������','index2.php?option=com_messages&task=config&hidemainmenu=1',null,'������������']
],
_cmSplit,
[null,'�������',null,null,'���������� ��������',
['<img src="../includes/js/ThemeOffice/sysinfo.png" />', '���������� � �������', 'index2.php?option=com_admin&task=sysinfo', null,'��������� ����������'],
<?php
if ($canConfig) {
?>
['<img src="../includes/js/ThemeOffice/checkin.png" />', '���������� �������������', 'index2.php?option=com_checkin', null,'�������������� ��� ��������������� �������'],
['<img src="../includes/js/ThemeOffice/checkin.png" />', '��������������� �������', 'index2.php?option=com_mycheckin', null,'���������� � ��������������� ��������'],
<?php
if ($mosConfig_caching) {
?>['<img src="../includes/js/ThemeOffice/config.png" />','�������� ��� �����������','index2.php?option=com_admin&task=clean_cache',null,'������� ���� �������� �����������'],
['<img src="../includes/js/ThemeOffice/config.png" />','�������� ���� ���','index2.php?option=com_admin&task=clean_all_cache',null,'������� ����� ����'],
<?php
}
 }
// ������ �� ����� ������
// ['<img src="../includes/js/ThemeOffice/help.png" />','������','index2.php?option=com_admin&task=help',null,'']
?>
],
<?php
}
?>_cmSplit,
<?php
  // ����� ���� "������"
  //[null,'������','index2.php?option=com_admin&task=help',null,null]
?>
];
cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
<?php
// boston, ���������� ���� � ���, � ���������� � ����
		$cur_menu = ob_get_contents();
		ob_end_clean();

			$cur_menu = str_replace("\n",'',$cur_menu);
			$cur_menu = str_replace("\r",'',$cur_menu);
			$cur_menu = str_replace("\t",'',$cur_menu);
			$cur_menu = str_replace('  ',' ',$cur_menu);

		if($mosConfig_adm_menu_cache) 
			js_menu_cache($cur_menu,$usertype_menu);
		else
			echo '<script language="JavaScript" type="text/javascript">'.$cur_menu.'</script>';
?>

<?php
        }


        /**
        * Show an disbaled version of the menu, used in edit pages
        * @param string The current user type
        */
        function showDisabled( $usertype='' ) {
                global $acl;

                $canConfig                         = $acl->acl_check( 'administration', 'config', 'users', $usertype );
                $installModules         = $acl->acl_check( 'administration', 'install', 'users', $usertype, 'modules', 'all' );
                $editAllModules         = $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'modules', 'all' );
                $installMambots         = $acl->acl_check( 'administration', 'install', 'users', $usertype, 'mambots', 'all' );
                $editAllMambots         = $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'mambots', 'all' );
                $installComponents         = $acl->acl_check( 'administration', 'install', 'users', $usertype, 'components', 'all' );
                $editAllComponents         = $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', 'all' );
                $canMassMail                 = $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_massmail' );
                $canManageUsers         = $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_users' );

                $text = '�� ���� �������� ���� �� �������';
                ?>
                <div id="myMenuID" class="inactive"></div>
                <script language="JavaScript" type="text/javascript">
                var myMenu =
                [
                <?php
        /* Home Sub-Menu */
                ?>
                        [null,'<?php echo '�������'; ?>',null,null,'<?php echo $text; ?>'],
                        _cmSplit,
                <?php
        /* Site Sub-Menu */
                ?>
                        [null,'<?php echo '����'; ?>',null,null,'<?php echo $text; ?>'
                        ],
                <?php
        /* Menu Sub-Menu */
                ?>
                        _cmSplit,
                        [null,'<?php echo '����'; ?>',null,null,'<?php echo $text; ?>'
                        ],
                        _cmSplit,
                <?php
        /* Content Sub-Menu */
                ?>
                         [null,'<?php echo '����������'; ?>',null,null,'<?php echo $text; ?>'
                        ],
                <?php
        /* Components Sub-Menu */
                        if ( $installComponents) {
                                ?>
                                _cmSplit,
                                [null,'<?php echo '����������'; ?>',null,null,'<?php echo $text; ?>'
                                ],
                                <?php
                        } // if $installComponents
                        ?>
                <?php
        /* Modules Sub-Menu */
                        if ( $installModules | $editAllModules) {
                                ?>
                                _cmSplit,
                                [null,'<?php echo '������'; ?>',null,null,'<?php echo $text; ?>'
                                ],
                                <?php
                        } // if ( $installModules | $editAllModules)
                        ?>
                <?php
        /* Mambots Sub-Menu */
                        if ( $installMambots | $editAllMambots) {
                                ?>
                                _cmSplit,
                                [null,'<?php echo '�������'; ?>',null,null,'<?php echo $text; ?>'
                                ],
                                <?php
                        } // if ( $installMambots | $editAllMambots)
                        ?>


                        <?php
        /* Installer Sub-Menu */
                        if ( $installModules) {
                                ?>
                                _cmSplit,
                                [null,'<?php echo '����������'; ?>',null,null,'<?php echo $text; ?>'
                                        <?php
                                        ?>
                                ],
                                <?php
                        } // if ( $installModules)
                        ?>
                        <?php
        /* Messages Sub-Menu */
                        if ( $canConfig) {
                                ?>
                                _cmSplit,
                                  [null,'<?php echo '���������'; ?>',null,null,'<?php echo $text; ?>'
                                  ],
                                <?php
                        }
                        ?>

                        <?php
        /* System Sub-Menu */
                        if ( $canConfig) {
                                ?>
                                _cmSplit,
                                  [null,'<?php echo '�������'; ?>',null,null,'<?php echo $text; ?>'
                                ],
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
$cache =& mosCache::getCache( 'mos_fullmenu' );

$hide = intval( mosGetParam( $_REQUEST, 'hidemainmenu', 0 ) );

if ( $hide ) {
        mosFullAdminMenu::showDisabled( $my->usertype );
} else {
        mosFullAdminMenu::show( $my->usertype );
}
?>
