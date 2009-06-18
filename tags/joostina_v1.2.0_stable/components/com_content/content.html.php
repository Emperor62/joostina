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

/**
* Utility class for writing the HTML for content
* @package Joostina
* @subpackage Content
*/
class HTML_content {
	/**
	* Draws a Content List
	* Used by Content Category & Content Section
	*/
	function showMyContentList( &$items, &$access, &$params, &$pageNav, &$lists, $order ) {
		global $Itemid, $database;

		if ( $params->get( 'page_title' ) ) {
			$title = $params->get( 'my_page_title' );
			if(!$title){
				$menu = new mosMenu( $database );
				$menu->load( $Itemid );
				$title = $menu->name;
			}
?>
			<div class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>"><?php echo $title; ?></div>
<?php
		}
?>
		<table width="100%" align="center" class="contentpane<?php echo $params->get( 'pageclass_sfx' ); ?>">
			<tr>
				<td  width="100%">
<?php
				if ( $items ) {
					HTML_content::showMyTable( $params, $items, $pageNav, $access, $lists, $order );
				} else {
					echo _YOU_HAVE_NO_CONTENT;
				}?>
				</td>
			</tr>
		</table>
<?php
		// displays back button
		mosHTML::BackButton ( $params );
	}


	/**
	* Display Table of items
	*/
	function showMyTable( &$params, &$items, &$pageNav, &$access, &$lists, $order ) {
		global $mosConfig_live_site, $Itemid,$mosConfig_form_date_full;
		$link = 'index.php?option=com_content&amp;task=mycontent&amp;Itemid='. $Itemid;
		/* ���������� fullajax */
		mosCommonHTML::loadFullajax();
		?>
		<script type="text/javascript">
		// ����� ������� ����������, elID - ������������� ������� � �������� �������� ������ ����������
		function ch_publ(elID){
			log('����� ������� ���������� �����������: '+elID);
			id('img-pub-'+elID).src = ADMINISTRATOR_DIRECTORY.'/images/aload.gif';
			dax({
				url: 'ajax.index.php?option=com_content&utf=0&task=publish&id='+elID,
				id:'publ-'+elID,
				callback:
					function(resp, idTread, status, ops){
						log('������� �����: ' + resp.responseText);
						id('img-pub-'+elID).src = ADMINISTRATOR_DIRECTORY.'/images/'+resp.responseText;
					}
			});
		}
		</script>
		<form action="<?php echo sefRelToAbs($link); ?>" method="post" name="adminForm" id="adminForm">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
		if ( $params->get( 'filter' ) || $params->get( 'order_select' ) || $params->get( 'display' ) ) {
			?>
			<tr>
				<td colspan="5">
					<table>
					<tr>
			<?php
						if ( $params->get( 'filter' ) ) {
							?>
								<td align="right" width="80%"><?php echo _FILTER; ?><br />
									<input type="text" name="filter" size="50" value="<?php echo $lists['filter'];?>" class="inputbox" onchange="document.adminForm.submit();" />
								</td><?php
						}
							if ( $params->get( 'order_select' ) ) {
						?>
							<td align="right" width="20%"><?php echo _ORDER_DROPDOWN;?><br /><?php echo $lists['order']; ?></td><?php
						}
						if ( $params->get( 'display' ) ) {
							?>
							<td align="right" width="80%"><?php echo _PN_DISPLAY_NR;?><br /><?php
							$link = 'index.php?option=com_content&amp;task=mycontent&amp;Itemid='. $Itemid.'&amp;order='.$order;
							echo $pageNav->getLimitBox( $link );
							?></td><?php
						}
						?>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>">&nbsp;</td>
				<td class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>" width="60%"><?php echo _HEADER_TITLE;?></td>
				<td class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>"><?php echo _E_PUBLISHING;?></td>
				<td class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>" width="20%"><?php echo _DATE;?></td>
				<td class="sectiontableheader<?php echo $params->get( 'pageclass_sfx' ); ?>"><?php echo _HEADER_HITS;?></td>
			</tr>
<?php
		}

		$k = 0;
		foreach ( $items as $row ) {
			$row->Itemid_link = '&amp;Itemid='.$Itemid;
			$row->_Itemid = $Itemid;
			$row->created = mosFormatDate ($row->created,$mosConfig_form_date_full,'0');
			$link	= sefRelToAbs( 'index.php?option=com_content&amp;task=view&amp;id='. $row->id .'&amp;Itemid='. $Itemid );
			$img	= $row->published ? 'publish_g.png' : 'publish_x.png';
			$img	= $mosConfig_live_site.'/'.ADMINISTRATOR_DIRECTORY.'/images/'.$img;
			?>
			<tr class="sectiontableentry<?php echo ($k+1) . $params->get( 'pageclass_sfx' ); ?>" >
					<td><?php HTML_content::EditIcon( $row, $params, $access );?></td>
					<td>
						<a href="<?php echo $link; ?>"><?php echo $row->title; ?></a><br />
						<span class="small"><?php
						if($row->sectionid!=0)
							echo $row->section.' / '.$row->category; // ������ / ���������
						else
							echo '��������� ����������'; // ��� ������������ ����������� - ��������� ����������
						?></span>
					</td>
					<td align="center" <?php echo ($access->canPublish) ? 'onclick="ch_publ('.$row->id.');" class="td-state"' : null ;?>>
						<img class="img-mini-state" src="<?php echo $img;?>" id="img-pub-<?php echo $row->id;?>" alt="����������" />
					</td>
					<td><?php echo $row->created; ?></td>
					<td align="center"><?php echo $row->hits ? $row->hits : 0; ?></td>
			</tr>
<?php
			$k = 1 - $k;
		}
		if ( $params->get( 'navigation' ) ) {
			?>
			<tr>
				<td colspan="5">&nbsp;</td>
			</tr>
			<tr>
				<td align="center" colspan="5" class="sectiontablefooter<?php echo $params->get( 'pageclass_sfx' ); ?>">
	<?php
				$link = 'index.php?option=com_content&amp;task=mycontent&amp;Itemid='. $Itemid. '&amp;order=' .$order;
				echo $pageNav->writePagesLinks( $link );
				?>
				</td>
			</tr>
<?php
		}
		?>
		</table>
		<input type="hidden" name="task" value="mycontent" />
		<input type="hidden" name="option" value="com_content" />
		</form>
<?php
	}

	/**
	* Draws a Content List
	* Used by Content Category & Content Section
	*/
	function showContentList($title,&$items,&$access,$id = 0,$sectionid = null,$gid,&$params,&$pageNav,$other_categories,&$lists,$order,$categories_exist) {
		global $Itemid,$mosConfig_live_site;

		if($sectionid) {
			$id = $sectionid;
		}

		if(strtolower(get_class($title)) == 'mossection') {
			$catid = 0;
		} else {
			$catid = $title->id;
		}

		if($params->get('page_title')) {
?>
			<div class="componentheading<?php echo $params->get('pageclass_sfx'); ?>">
<?php echo htmlspecialchars($title->name,ENT_QUOTES); ?>
			</div>
<?php
		}
?>
		<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" class="contentpane<?php echo $params->get('pageclass_sfx'); ?>">
<?php
		if(($params->get('description') && $title->description) || ($params->get('description_image') && $title->image)) {
?>
		<tr>
			<td width="60%" valign="top" class="contentdescription<?php echo $params->get('pageclass_sfx'); ?>" colspan="2">
<?php
			if($params->get('description_image') && $title->image) {
				$link = $mosConfig_live_site.'/images/stories/'.$title->image;
?>
				<img src="<?php echo $link; ?>" align="<?php echo $title->image_position; ?>" hspace="6" alt="<?php echo
$title->image; ?>" />
	<?php
			}
			if($params->get('description')) {
				echo $title->description;
			}
?>
			</td>
		</tr>
<?php
		}
?>
		<tr>
			<td width="100%">
<?php
		// Displays the Table of Items in Category View
		if($items) {
			HTML_content::showTable($params,$items,$gid,$catid,$id,$pageNav,$access,$sectionid,
				$lists,$order);
		} else
			if($catid) {
?>
				<br />
	<?php echo _EMPTY_CATEGORY; ?>
				<br /><br />
	<?php
			}
		// New Content Icon
		if(($access->canEdit || $access->canEditOwn) && $categories_exist) {
			$link = sefRelToAbs('index.php?option=com_content&amp;task=new&amp;sectionid='.
				$id.'&amp;Itemid='.$Itemid);
?>
				<a href="<?php echo $link; ?>">
					<img src="<?php echo $mosConfig_live_site; ?>/images/M_images/new.png" width="13" height="14" align="middle" border="0" alt="<?php echo
_CMN_NEW; ?>" />
						&nbsp;<?php echo _CMN_NEW; ?>...</a>
				<br /><br />
	<?php
		}
?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
<?php
		// Displays listing of Categories
		if(((count($other_categories) > 1) || (count($other_categories) < 2 && count($items) <
			1))) {
			if(($params->get('type') == 'category') && $params->get('other_cat')) {
				HTML_content::showCategories($params,$items,$gid,$other_categories,$catid,$id,$Itemid);
			}
			if(($params->get('type') == 'section') && $params->get('other_cat_section')) {
				HTML_content::showCategories($params,$items,$gid,$other_categories,$catid,$id,$Itemid);
			}
		}
?>
			</td>
		</tr>
		</table>
<?php
		// displays back button
		mosHTML::BackButton($params);
	}


	/**
	* Display links to categories
	*/
	function showCategories(&$params,&$items,$gid,&$other_categories,$catid,$id,$Itemid) {
		if(!count($other_categories)) return;
?>
		<ul>
<?php
		foreach($other_categories as $row) {
			$row->name = htmlspecialchars(stripslashes(ampReplace($row->name)),ENT_QUOTES);
			if($catid != $row->id) {
?>
				<li>
		<?php
				if($row->access <= $gid) {
					$link = sefRelToAbs('index.php?option=com_content&amp;task=category&amp;sectionid='.
						$id.'&amp;id='.$row->id.'&amp;Itemid='.$Itemid);
?>
					<a href="<?php echo $link; ?>" class="category" title="<?php echo $row->name; ?>">
				<?php echo $row->name; ?></a>
		<?php
					if($params->get('cat_items')) {
?>
						&nbsp;<i>( <?php echo $row->numitems;
						echo _CHECKED_IN_ITEMS; ?> )</i>
			<?php
					}

					// Writes Category Description
					if($params->get('cat_description') && $row->description) {
?>
							<br />
				<?php
						echo $row->description;
					}
				} else {
					echo $row->name;
?>
					<a href="<?php echo sefRelToAbs('index.php?option=com_registration&amp;task=register'); ?>">
							( <?php echo _E_REGISTERED; ?> )</a>
		<?php
				}
?>
				</li>
	<?php
			}
		}
?>
		</ul>
<?php
	}


	/**
	* Display Table of items
	*/
	function showTable(&$params,&$items,&$gid,$catid,$id,&$pageNav,&$access,&$sectionid,&$lists,$order) {
		global $Itemid;
		$link = 'index.php?option=com_content&amp;task=category&amp;sectionid='.$sectionid.'&amp;id='.$catid.'&amp;Itemid='.$Itemid;
?>
		<form action="<?php echo sefRelToAbs($link); ?>" method="post" name="adminForm">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
		if($params->get('filter') || $params->get('order_select') || $params->get('display')) {
?>
		<tr>
			<td colspan="4">
				<table>
				<tr><?php
			if($params->get('filter')) {
?>
						<td align="right" width="100%" class="jtd_nowrap">
<?php
				echo _FILTER.'&nbsp;';
?>
						<br />
						<input type="text" name="filter" value="<?php echo $lists['filter']; ?>" class="inputbox" onchange="document.adminForm.submit();" />
						</td>
<?php
			}

			if($params->get('order_select')) {
?>
						<td align="right" width="100%" class="jtd_nowrap">
<?php
				echo '&nbsp;&nbsp;&nbsp;'._ORDER_DROPDOWN.'&nbsp;';
				echo '<br />';
				echo $lists['order'];
?>
						</td>
<?php
			}

			if($params->get('display')) {
?>
						<td align="right" width="100%" class="jtd_nowrap">
<?php $order = '';
				if($lists['order_value']) {
					$order = '&amp;order='.$lists['order_value'];
				}
				$filter = '';
				if($lists['filter']) {
					$filter = '&amp;filter='.$lists['filter'];
				}

				$link = 'index.php?option=com_content&amp;task=category&amp;sectionid='.$sectionid.
					'&amp;id='.$catid.'&amp;Itemid='.$Itemid.$order.$filter;

				echo '&nbsp;&nbsp;&nbsp;'._PN_DISPLAY_NR.'&nbsp;';
				echo '<br />';
				echo $pageNav->getLimitBox($link);
?>
						</td>
<?php
			}
?>
				</tr>
				</table>
			</td>
		</tr>
<?php
		}

		if($params->get('headings')) {
?>
			<tr>
<?php
			if($params->get('date')) {
?>
					<td class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" width="15%"><?php echo _DATE; ?></td>
<?php
			}
			if($params->get('title')) {
?>
					<td class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>"><?php echo _HEADER_TITLE; ?></td>
<?php
			}
			if($params->get('author')) {
?>
					<td class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" align="left"><?php echo _HEADER_AUTHOR; ?></td>
<?php
			}
			if($params->get('hits')) {
?>
					<td align="center" class="sectiontableheader<?php echo $params->get('pageclass_sfx'); ?>" width="5%"><?php echo _HEADER_HITS; ?></td>
<?php
			}
?>
			</tr>
<?php
		}

		$k = 0;
		foreach($items as $row) {
			$row->created = mosFormatDate($row->created,$params->get('date_format'));
			// calculate Itemid
			HTML_content::_Itemid($row);
?>
			<tr class="sectiontableentry<?php echo ($k + 1).$params->get('pageclass_sfx'); ?>" >
<?php
			if($params->get('date')) {
?>
				<td><?php echo $row->created; ?></td>
<?php
			}
			if($params->get('title')) {
				if($row->access <= $gid) {
					$link = sefRelToAbs('index.php?option=com_content&amp;task=view&amp;id='.$row->id.'&amp;Itemid='.$Itemid);
?>
				<td><?php HTML_content::EditIcon($row,$params,$access); ?>
					<a href="<?php echo $link; ?>" title="<?php echo $row->title; ?>"><?php echo $row->title; ?></a>
				</td>
<?php
				} else {
?>
				<td>
<?php
					echo $row->title.' : ';
					$link = sefRelToAbs('index.php?option=com_registration&amp;task=register');
?>
					<a href="<?php echo $link; ?>" title="<?php echo $row->title; ?>"><?php echo _READ_MORE_REGISTER; ?></a>
				</td>
<?php
				}
			}
			if($params->get('author')) {
?>
				<td align="left"><?php echo $row->created_by_alias ? $row->created_by_alias : $row->author; ?></td>
		<?php
			}
			if($params->get('hits')) {
?>
				<td align="center"><?php echo $row->hits?$row->hits:'-'; ?></td>
<?php
			} ?>
		</tr>
<?php
			$k = 1 - $k;
		}
		if($params->get('navigation')) {
?>
			<tr>
				<td colspan="4">&nbsp;</td>
			</tr>
			<tr>
				<td align="center" colspan="4" class="sectiontablefooter<?php echo $params->get('pageclass_sfx'); ?>">
	<?php
			$order = '';
			if($lists['order_value']) {
				$order = '&amp;order='.$lists['order_value'];
			}
			$filter = '';
			if($lists['filter']) {
				$filter = '&amp;filter='.$lists['filter'];
			}

			$link = 'index.php?option=com_content&amp;task=category&amp;sectionid='.$sectionid.
				'&amp;id='.$catid.'&amp;Itemid='.$Itemid.$order.$filter;
			echo $pageNav->writePagesLinks($link);
?>
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right">
	<?php echo $pageNav->writePagesCounter(); ?>
				</td>
			</tr>
<?php
		}
?>
		</table>
		<input type="hidden" name="id" value="<?php echo $catid; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>" />
		<input type="hidden" name="task" value="<?php echo $lists['task']; ?>" />
		<input type="hidden" name="option" value="com_content" />
		</form>
<?php
	}


	/**
	* Display links to content items
	*/
	function showLinks(&$rows,$links,$total,$i = 0,$show = 1,$ItemidCount = null) {
		global $mainframe,$Itemid;

		// getItemid compatibility mode, holds maintenance version number
		$compat = (int)$mainframe->getCfg('itemid_compat');

		if($show) {
?>
			<div>
			<strong>
<?php echo _MORE; ?>
			</strong>
			</div>
<?php
		}
?>
			<ul>
<?php
		for($z = 0; $z < $links; $z++) {
			if(!isset($rows[$i])) {
				// stops loop if total number of items is less than the number set to display as intro + leading
				break;
			}

			if($compat > 0 && $compat <= 11) {
				$_Itemid = $mainframe->getItemid($rows[$i]->id,0,0);
			} else {
				$_Itemid = $Itemid;
			}

			if($_Itemid && $_Itemid != 99999999) {
				// where Itemid value is returned, do not add Itemid to url
				$Itemid_link = '&amp;Itemid='.$_Itemid;
			} else {
				// where Itemid value is NOT returned, do not add Itemid to url
				$Itemid_link = '';
			}

			$link = sefRelToAbs('index.php?option=com_content&amp;task=view&amp;id='.$rows[$i]->id.$Itemid_link)
?>
			<li>
			<a class="blogsection" href="<?php echo $link; ?>" title="<?php echo $rows[$i]->title; ?>">
		<?php echo $rows[$i]->title; ?></a>
			</li>
<?php
			$i++;
		}
?>
		</ul>
<?php
	}


	/**
	* ����������� �����������
	* @param object An object with the record
	* @param boolean If <code>false</code>, the print button links to a popup window.  If <code>true</code> then the print button invokes the browser print method.
	* boston + ��� ���������� �������� ������ content
	*/
	function show(&$row,&$params,&$access,$page = 0) {
		global $mainframe,$hide_js,$_MAMBOTS,$mosConfig_mmb_content_off,$mosConfig_live_site,$mosConfig_uid_news;
		global $news_uid,$task;
		// ���������� �������������� ��������
		$news_uid_css_title = '';
		$news_uid_css_body = '';
		if($mosConfig_uid_news) {
			$news_uid++;
			$news_uid_css_title = 'id="title-news-uid-'.$news_uid.'" ';
			$news_uid_css_body = 'id="body-news-uid-'.$news_uid.'" ';
		}
		// boston, ��� ��� �����
		//if($task == 'view') $news_uid_css = 'id="pageclass_uid_'.$params->get( 'pageclass_uids' ).'" ';

		$mainframe->appendMetaTag('description',$row->metadesc);
		$mainframe->appendMetaTag('keywords',$row->metakey);

		// adds mospagebreak heading or title to <site> Title
		if(isset($row->page_title) && $row->page_title) {
			$mainframe->setPageTitle($row->title.' '.$row->page_title);
		}

		// ��������� ���������� �������� �����������
		$cur_params = new mosParameters($row->attribs);
		$news_uid_css_page = $cur_params->get('pageclass_uids');
		if($cur_params->get('pageclass_uids_full') && trim($news_uid_css_page) != '') {
			$news_uid_css_title = 'id="title-news-'.$news_uid_css_page.'" ';
			$news_uid_css_body = 'id="body-news-'.$news_uid_css_page.'" ';
		};
		// ������ Itemid
		HTML_content::_Itemid($row);
		// determines the link and `link text` of the readmore button & linked title
		HTML_content::_linkInfo($row,$params);
		// link used by print button
		$print_link = $mosConfig_live_site.'/index2.php?option=com_content&amp;task=view&amp;id='.$row->id.'&amp;pop=1&amp;page='.$page.$row->Itemid_link;

		// ��������� �������� ������, ���� � ���������� ������������ ��� ��������� - �� ������� ��  ����������
		if($mosConfig_mmb_content_off != 1) {
			$_MAMBOTS->loadBotGroup('content');
			$results = $_MAMBOTS->trigger('onPrepareContent',array(&$row,&$params,$page),true);
		}
		if($params->get('item_title') || $params->get('print') || $params->get('email')) {
?>
			<table <?php echo $news_uid_css_title; ?>class="contentpaneopen<?php echo $params->get('pageclass_sfx'); ?>">
			<tr>
<?php
			// displays Item Title
			HTML_content::Title($row,$params,$access);
			// ��������������
			if($access->canEdit) HTML_content::EditIcon2($row,$params,$access);
			// displays Print Icon
			mosHTML::PrintIcon($row,$params,$hide_js,$print_link);
			// displays Email Icon
			HTML_content::EmailIcon($row,$params,$hide_js);
?>
			</tr>
			</table>
<?php
		}
		if(!$params->get('intro_only')) {
			$results = $_MAMBOTS->trigger('onAfterDisplayTitle',array(&$row,&$params,$page));
			echo trim(implode("\n",$results));
		}
		$results = $_MAMBOTS->trigger('onBeforeDisplayContent',array(&$row,&$params,$page));
		echo trim(implode("\n",$results));
?>

		<table <?php echo $news_uid_css_body; ?>class="contentpaneopen<?php echo $params->get('pageclass_sfx'); ?>">
<?php
		// displays Section & Category
		HTML_content::Section_Category($row,$params);

		// displays Author Name
		HTML_content::Author($row,$params);

		// displays Created Date
		HTML_content::CreateDate($row,$params);

		// displays Urls
		HTML_content::URL($row,$params);
?>
		<tr>
			<td valign="top" colspan="2">
<?php
		// displays Table of Contents
		HTML_content::TOC($row);

		// displays Item Text
		echo ampReplace($row->text);
?>
			</td>
		</tr>
<?php

		// displays Modified Date
		HTML_content::ModifiedDate($row,$params);

		// displays Readmore button
		HTML_content::ReadMore($row,$params);
?>
		</table>

		<span class="article_seperator">&nbsp;</span>

<?php
		$results = $_MAMBOTS->trigger('onAfterDisplayContent',array(&$row,&$params,$page));
		echo trim(implode("\n",$results));

		// displays the next & previous buttons
		HTML_content::Navigation($row,$params);

		// displays close button in pop-up window
		mosHTML::CloseButton($params,$hide_js);

		// displays back button in pop-up window
		mosHTML::BackButton($params,$hide_js);
	}

	/**
	* calculate Itemid
	*/
	function _Itemid(&$row) {
		global $task,$Itemid,$mainframe;
		// getItemid compatibility mode, holds maintenance version number
		$compat = (int)$mainframe->getCfg('itemid_compat');
		if(($compat > 0 && $compat <= 11) && $task != 'view' && $task != 'category') {
			$row->_Itemid = $mainframe->getItemid($row->id,0,0);
		} else {
			// when viewing a content item, it is not necessary to calculate the Itemid
			$row->_Itemid = $Itemid;
		}

		if($row->_Itemid && $row->_Itemid != 99999999) {
			// where Itemid value is returned, do not add Itemid to url
			$row->Itemid_link = '&amp;Itemid='.$row->_Itemid;
		} else {
			// where Itemid value is NOT returned, do not add Itemid to url
			$row->Itemid_link = '';
		}
	}

	/**
	* determines the link and `link text` of the readmore button & linked title
	*/
	function _linkInfo(&$row,&$params) {
		global $my;

		$row->link_on = '';
		$row->link_text = '';

		if($params->get('readmore') || $params->get('link_titles')) {
			if($params->get('intro_only')) {
				// checks if the item is a public or registered/special item
				if($row->access <= $my->gid) {
					$row->link_on = sefRelToAbs('index.php?option=com_content&amp;task=view&amp;id='.
						$row->id.$row->Itemid_link);

					if(isset($row->readmore) && @$row->readmore) {
						// text for the readmore link
						$row->link_text = _READ_MORE;
					}
				} else {
					$row->link_on = sefRelToAbs('index.php?option=com_registration&amp;task=register');

					if(isset($row->readmore) && @$row->readmore) {
						// text for the readmore link if accessible only if registered
						$row->link_text = _READ_MORE_REGISTER;
					}
				}
			}
		}
	}

	/**
	* ����� ���������
	*/
	function Title(&$row,&$params,&$access) {
		global $mosConfig_title_h1,$mosConfig_title_h1_only_view,$task;
		if($params->get('item_title')) {
			if($params->get('link_titles') && $row->link_on != '') {
?>
				<td class="contentheading<?php echo $params->get('pageclass_sfx'); ?>" width="100%">
					<a href="<?php echo $row->link_on; ?>" title="<?php echo $row->title; ?>" class="contentpagetitle<?php echo $params->get('pageclass_sfx'); ?>">
<?php
				if($mosConfig_title_h1 or ($task == 'view') and ($mosConfig_title_h1_only_view))
					echo '<h1>'.$row->title.'</h1>';
				else
					echo $row->title;
?>
					</a>
				</td>
	<?php
			} else {
?>
				<td class="contentheading<?php echo $params->get('pageclass_sfx'); ?>" width="100%">
<?php
				if($mosConfig_title_h1 or ($task == 'view') and ($mosConfig_title_h1_only_view))
					echo '<h1>'.$row->title.'</h1>';
				else
					echo $row->title;
?>
				</td>
	<?php
			}
		}
	}

	/**
	* Writes Edit icon that links to edit page
	*/
	function EditIcon(&$row,&$params,&$access) {
		global $my;

		if($params->get('popup')) {
			return;
		}
		if($row->state < 0) {
			return;
		}
		if(!$access->canEdit && !($access->canEditOwn && $row->created_by == $my->id)) {
			return;
		}
		mosCommonHTML::loadOverlib();
		$link = 'index.php?option=com_content&amp;task=edit&amp;id='.$row->id.$row->Itemid_link.'&amp;Returnid='.$row->_Itemid;
		$image = mosAdminMenus::ImageCheck('edit.png','/images/M_images/',null,null,_E_EDIT,_E_EDIT);
		if($row->state == 0) {
			$overlib = _CMN_UNPUBLISHED;
		} else {
			$overlib = _CMN_PUBLISHED;
		}
		$date = mosFormatDate($row->created);
		$author = $row->created_by_alias ? $row->created_by_alias : $row->author;

		$overlib .= ' / ';
		$overlib .= $row->groups;
		$overlib .= '<br />';
		$overlib .= $date;
		$overlib .= '<br />';
		$overlib .= $author;
?>
		<a href="<?php echo sefRelToAbs($link); ?>" onmouseover="return overlib('<?php echo $overlib; ?>', CAPTION, '<?php echo _E_EDIT; ?>', BELOW, RIGHT);" onmouseout="return nd();"><?php echo $image; ?></a>
<?php
	}

	/**
	* Writes Edit icon that links to edit page
	*/
	function EditIcon2(&$row,&$params,&$access) {
		global $my;

		if($params->get('popup')) {
			return;
		}
		if($row->state < 0) {
			return;
		}
		if(!$access->canEdit && !($access->canEditOwn && $row->created_by == $my->id)) {
			return;
		}

		mosCommonHTML::loadOverlib();

		$link = 'index.php?option=com_content&amp;task=edit&amp;id='.$row->id.$row->Itemid_link.'&amp;Returnid='.$row->_Itemid;
		$image = mosAdminMenus::ImageCheck('edit.png','/images/M_images/',null,null,_E_EDIT,_E_EDIT);

		if($row->state == 0) {
			$overlib = _CMN_UNPUBLISHED;
		} else {
			$overlib = _CMN_PUBLISHED;
		}
		$date = mosFormatDate($row->created);
		$author = $row->created_by_alias?$row->created_by_alias:$row->author;

		$overlib .= '<br />';
		$overlib .= $row->groups;
		$overlib .= '<br />';
		$overlib .= $date;
		$overlib .= '<br />';
		$overlib .= $author;
?>
		<td>
			<a href="<?php echo sefRelToAbs($link); ?>" onmouseover="return overlib('<?php echo $overlib; ?>', CAPTION, '<?php echo _E_EDIT; ?>', BELOW, RIGHT);" onmouseout="return nd();"><?php echo $image; ?></a>
		</td>
<?php
	}

	/**
	* Writes Email icon
	*/
	function EmailIcon(&$row,&$params,$hide_js) {
		global $mosConfig_live_site,$Itemid,$task,$cne_i;
		if(!isset($cne_i)) $cne_i = '';
		if($params->get('email') && !$params->get('popup') && !$hide_js) {
			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=400,height=250,directories=no,location=no';

			if($task == 'view') {
				$_Itemid = '&amp;itemid='.$Itemid;
			} else {
				$_Itemid = '';
			}

			$link = $mosConfig_live_site.'/index2.php?option=com_content&amp;task=emailform&amp;id='.$row->id.$_Itemid;

			if($params->get('icons')) {
				$image = mosAdminMenus::ImageCheck('emailButton.png','/images/M_images/',null,null,_CMN_EMAIL,'email'.$cne_i);
				$cne_i++;
			} else {
				$image = '&nbsp;'._CMN_EMAIL;
			}
?>
			<td align="right" width="100%" class="buttonheading">
				<a href="<?php echo $link; ?>" target="_blank" onclick="window.open('<?php echo $link; ?>','win2','<?php echo $status; ?>'); return false;" title="<?php echo _CMN_EMAIL; ?>"><?php echo $image; ?></a>
			</td>
<?php
		}
	}

	/**
	* Writes Container for Section & Category
	*/
	function Section_Category(&$row,&$params) {
		if($params->get('section') || $params->get('category')) {
?>
			<tr>
				<td>
<?php
		}

		// displays Section Name
		HTML_content::Section($row,$params);

		// displays Section Name
		HTML_content::Category($row,$params);

		if($params->get('section') || $params->get('category')) {
?>
				</td>
			</tr>
<?php
		}
	}

	/**
	* Writes Section
	*/
	function Section(&$row,&$params) {
		if($params->get('section')) {
?>
				<span class="section_name">
	<?php
			echo $row->section;
			// writes dash between section & Category Name when both are active
			if($params->get('category')) {
				echo ' - ';
			}
?>
				</span>
<?php
		}
	}

	/**
	* Writes Category
	*/
	function Category(&$row,&$params) {
		if($params->get('category')) {
?>
			<span class="category_name">
<?php
			echo $row->category;
?>
			</span>
<?php
		}
	}

	/**
	* Writes Author name
	*/
	function Author(&$row,&$params) {
		if(($params->get('author')) && ($row->author != '')) {
?>
		<tr>
			<td width="70%" align="left" valign="top" colspan="2">
			<span class="author">
                <strong><?php echo _WRITTEN_BY;?></strong> 
                <?php echo($row->created_by_alias?$row->created_by_alias:$row->author); ?>
			</span>
			&nbsp;&nbsp;
			</td>
		</tr>
<?php
		}
	}


	/**
	* Writes Create Date
	*/
	function CreateDate(&$row,&$params) {
		$create_date = null;

		if(intval($row->created) != 0) {
			$create_date = mosFormatDate($row->created);
		}

		if($params->get('createdate')) {
?>
			<tr>
				<td valign="top" colspan="2" class="createdate"><span class="date"><?php echo $create_date; ?></span></td>
			</tr>
<?php
		}
	}

	/**
	* Writes URL's
	*/
	function URL(&$row,&$params) {
		if($params->get('url') && $row->urls) {
?>
			<tr>
				<td valign="top" colspan="2"><a href="http://<?php echo $row->urls; ?>" target="_blank"><?php echo $row->urls; ?></a></td>
			</tr>
<?php
		}
	}

	/**
	* Writes TOC
	*/
	function TOC(&$row) {
		if(isset($row->toc)) {
			echo $row->toc;
		}
	}

	/**
	* Writes Modified Date
	*/
	function ModifiedDate(&$row,&$params) {
		$mod_date = null;

		if(intval($row->modified) != 0) {
			$mod_date = mosFormatDate($row->modified);
		}

		if(($mod_date != '') && $params->get('modifydate')) {
?>
			<tr>
				<td colspan="2" align="left" class="modifydate"><?php echo _LAST_UPDATED; ?> ( <?php echo $mod_date; ?> )</td>
			</tr>
<?php
		}
	}

	/**
	* Writes Readmore Button
	*/
	function ReadMore(&$row,&$params) {
		if($params->get('readmore')) {
			if($params->get('intro_only') && $row->link_text) {
?>
				<tr>
					<td align="left" colspan="2">
						<a href="<?php echo $row->link_on; ?>" title="<?php echo $row->title; ?>" class="readon<?php echo $params->get('pageclass_sfx'); ?>"><?php echo $row->link_text; ?></a>
					</td>
				</tr>
	<?php
			}
		}
	}

	/**
	* Writes Next & Prev navigation button
	*/
	function Navigation(&$row,&$params) {
		global $task;

		$link_part = 'index.php?option=com_content&amp;task=view&amp;id=';

		// determines links to next and prev content items within category
		if($params->get('item_navigation')) {
			if($row->prev) {
				$row->prev = sefRelToAbs($link_part.$row->prev.$row->Itemid_link);
			} else {
				$row->prev = 0;
			}

			if($row->next) {
				$row->next = sefRelToAbs($link_part.$row->next.$row->Itemid_link);
			} else {
				$row->next = 0;
			}
		}

		if($params->get('item_navigation') && ($task == 'view') && !$params->get('popup') &&
			($row->prev || $row->next)) {
?>
			<table align="center" style="margin-top: 15px;">
			<tr>
	<?php
			if($row->prev) {
?>
				<th class="pagenav_prev">
					<a href="<?php echo $row->prev; ?>" title="<?php echo $row->prev_title; ?>"><?php echo _ITEM_PREVIOUS.$row->prev_title;?></a>
				</th>
		<?php
			}

			if($row->prev && $row->next) {
?>
				<td width="50">&nbsp;</td>
		<?php
			}

			if($row->next) {
?>
				<th class="pagenav_next">
					<a href="<?php echo $row->next; ?>" title="<?php echo $row->next_title; ?>">
				<?php echo $row->next_title._ITEM_NEXT; ?></a>
				</th>
		<?php
			}
?>
			</tr>
			</table>
<?php
		}
	}

	/**
	* Writes the edit form for new and existing content item
	*
	* A new record is defined when <var>$row</var> is passed with the <var>id</var>
	* property set to 0.
	* @param mosContent The category object
	* @param string The html for the groups select list
	*/
    function editContent(&$row,$section,&$lists,&$images,&$access,$myid,$sectionid,$task,$Itemid,$params) {
		global $mosConfig_live_site,$mainframe, $my;

		mosMakeHtmlSafe($row);

		require_once ($GLOBALS['mosConfig_absolute_path'].'/includes/HTML_toolbar.php');

		// used for spoof hardening
		$validate = josSpoofValue();

		$Returnid = intval(mosGetParam($_REQUEST,'Returnid',$Itemid));
		$tabs = new mosTabs(0,1);

		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadCalendar();

		// ��������� ���������� �� �������� ������ � ����
		$p_wwig = $params->get('wwig',1);// ������������� ����������� ���������
		$content_type = $params->get('content_type',1); // ��� ��������
		$p_fulltext = $params->get('fulltext',1); // ���������� ���� ������� ��������� ������
		$allow_alias = $params->get('allow_alias',0); // ���������� ���� "��������� ���������"
		$allow_img = $params->get('allow_img',1); // ���������� ������� "�����������"
		$allow_params = $params->get('allow_params',1); // ���������� ������� "���������"
		$allow_desc = $params->get('allow_desc',1); // ���������� ���� "��������"
		$allow_tags = $params->get('allow_tags',1); // ���������� ���� "�������� �����"
        $auto_publish = $params->get('auto_publish',0); // ��������� ��������������
        $allow_frontpage = $params->get('allow_frontpage',0); // ������������� "�� �������"
        $front_label = $params->get('front_label','�� �������'); // ������� ������������� "�� �������"

?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
        <script language="javascript" type="text/javascript">
		onunload = WarnUser;

        <?php
        //��������� ������� "�����������"
        if($allow_img){ ?>
		    var folderimages = new Array;

            <?php
		    $i = 0;
		    foreach($images as $k => $items) {
			    foreach($items as $v) {
				    echo "\n folderimages[".$i++."] = new Array( '$k','".addslashes($v->value)."','".addslashes($v->text)."' );";
			    }
		    }
        }
        ?>

		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			// var goodexit=false;
			// assemble the images back into one field
			form.goodexit.value=1;
            <?php
            //��������� ������� "�����������"
            if($allow_img){ ?>
                var temp = new Array;
			    for (var i=0, n=form.imagelist.options.length; i < n; i++) {
				    temp[i] = form.imagelist.options[i].value;
		    	}
			form.images.value = temp.join( '\n' );
            <?php }?>


			try {
				form.onsubmit();
			}
			catch(e){}
			// do field validation
			if (form.title.value == "") {
				alert ( "<?php echo addslashes(_E_WARNTITLE); ?>" );
			} else if (parseInt('<?php echo $row->sectionid; ?>')) {
<?php
		getEditorContents('editor1','introtext');
		getEditorContents('editor2','fulltext');
?>
					submitform(pressbutton);

			//} else if (form.introtext.value == "") {
			//	alert ( "<?php echo addslashes(_E_WARNTEXT); ?>" );
			} else {
				// for static content
<?php
		getEditorContents('editor1','introtext');
?>
				submitform(pressbutton);
			}
		}

		function setgood(){
			document.adminForm.goodexit.value=1;
		}

		function WarnUser(){

			if (document.adminForm.goodexit.value==0) {
				alert('<?php echo addslashes(_E_WARNUSER); ?>');
				window.location="<?php echo sefRelToAbs("index.php?option=com_content&task=".$task."&sectionid=".$sectionid."&id=".$row->id."&Itemid=".$Itemid); ?>";
			}
		}

        	/* ������� ������ ��������� �� ��������� ����������� */
		function ntreetoggle(){
			if(SRAX.get('ntdree').style.display =='none'){
				SRAX.get('ntdree').style.display ='block';
				SRAX.get('tdtoogle').className='tdtoogleoff';
				setCookie('j-ntree-hide','0');
			}else{
				SRAX.get('ntdree').style.display ='none';
				SRAX.get('tdtoogle').className='tdtoogleon';
				setCookie('j-ntree-hide','1');
			}
		}
	</script>
		</script>

<?php
		$docinfo = "<strong>"._E_EXPIRES."</strong> ";
		$docinfo .= $row->publish_down."<br />";
		$docinfo .= "<strong>"._E_VERSION."</strong> ";
		$docinfo .= $row->version."<br />";
		$docinfo .= "<strong>"._E_CREATED."</strong> ";
		$docinfo .= $row->created."<br />";
		$docinfo .= "<strong>"._E_LAST_MOD."</strong> ";
		$docinfo .= $row->modified."<br />";
		$docinfo .= "<strong>"._E_HITS."</strong> ";
		$docinfo .= $row->hits."<br />";
?>
		<form action="index.php" method="post" name="adminForm" onSubmit="javascript:setgood();" enctype="multipart/form-data">
        <div class="componentheading"><?php echo $row->id ? _E_EDIT : _E_ADD; ?></div>

        <?php if ($row->id){  ?>
        <div class="joo_message">
              <a href="javascript: void(0);" onMouseOver="return overlib('<table><?php echo $docinfo; ?></table>', CAPTION, '<?php echo _E_ITEM_INFO; ?>', BELOW, RIGHT);" onMouseOut="return nd();">
					<strong>[����������]</strong>
				</a>
        </div>
        <?php }?>
        <table class="cedit_misc" cellspacing="0" cellpadding="0" border="0">
            <tr>
               <?php mosToolBar::save(); 	mosToolBar::apply(); mosToolBar::cancel();  ;?>

                <?php if($access->canPublish || $auto_publish==1 || $my->usertype=="Super Administrator"){?>
                <td><b>&nbsp;&nbsp;������������:</b>&nbsp;&nbsp;</td><td><?php echo  mosHTML::yesnoRadioList('state','',$row->state);?></td>
                <?php }?>

                <?php if( ($row->sectionid || !$content_type) && ($allow_frontpage==1 || $my->usertype=="Super Administrator") ){?>
				<td align="right">&nbsp;&nbsp;&nbsp;<b><?php echo $front_label;?>:</b>&nbsp;</td>
				<td  align="left"> <?php echo mosHTML::yesnoRadioList('frontpage','',$row->frontpage ? 1:0);?></td>
                <?php }?>

            </tr>
       </table>


         <table class="cedit_main" cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td width="25"><strong>���������:</strong></td>
                <td><input class="text_area" type="text" name="title" size="30" maxlength="255" style="width:99%" value="<?php echo $row->title; ?>" /></td>
            </tr>

             <?php if( $row->sectionid || $allow_alias){?>
            <tr>
                <td><strong>���������:</strong></td>
				<td>
					<input name="title_alias" type="text" class="text_area" id="title_alias" value="<?php echo $row->title_alias; ?>" size="30" style="width:99%" maxlength="255" />
				</td>
            </tr>
             <?php }?>
             <?php if( $content_type==0 || $row->sectionid>0){?>
            <tr>
                <td><strong>���������:</strong></td>
				<td>
				    <?php
                    echo $lists['catid'];
                    ?>
				</td>
            </tr>
            <?php }?>
            <?php  if($allow_tags){ ?>
            <tr>
				<td align="left" valign="top"><strong><?php echo _E_M_KEY; ?></strong></td>
				<td><input class="inputbox" style="width:99%" type="text" name="metakey" value="<?php echo str_replace('&','&amp;',$row->metakey); ?>"></td>
			</tr>
            <?php }?>


           <?php  if($allow_desc){ ?>   <tr>
				<td align="left" valign="top"><strong><?php echo _E_M_DESC; ?></strong></td>
				<td><textarea class="inputbox" style="width:99%"  rows="2" name="metadesc"><?php echo str_replace('&','&amp;',$row->metadesc); ?></textarea></td>
			</tr>
           <?php }?>

         </table>

         <br />
         <div class="cedit_introtext">
            <strong><?php echo _E_INTRO.' ('._CMN_REQUIRED.')'; ?>:</strong><br />
            <?php if($p_wwig){
			// parameters : areaname, content, hidden field, width, height, rows, cols
			editorArea('editor1',$row->introtext,'introtext','700','400','70','15');
		    }else{
            ?>
			<textarea style="width: 700px; height: 400px;" class="inputbox" rows="15" cols="70" id="introtext" name="introtext"/><?php echo $row->introtext;?></textarea>
            <?php }?>
         </div>

         <?php if(($content_type==0 && $p_fulltext) || ($row->sectionid &&  $p_fulltext) ){?>
		 <br /><br />
         <div class="cedit_fulltext">
            <strong><?php echo _E_MAIN.' ('._CMN_OPTIONAL.')'; ?>:</strong>
            <?php if($p_wwig){
			// parameters : areaname, content, hidden field, width, height, rows, cols
			editorArea('editor2',$row->fulltext,'fulltext','600','400','70','15');
		    }else { ?>
			<textarea style="width: 700px; height: 400px;" class="inputbox" rows="15" cols="70" id="fulltext" name="fulltext"/><?php echo $row->fulltext;?></textarea>
            <?php } ?>
        </div>
         <?php } ?>



<?php if( $allow_params || $allow_img){
		$tabs->startPane('content-pane');

        if( $allow_img){
		$tabs->startTab(_E_IMAGES,'images-page');
?>
			<table class="adminform">
			<tr>
				<td colspan="4">
	<?php echo _CMN_SUBFOLDER; ?> :: <?php echo $lists['folders']; ?>
				</td>
			</tr>
			<tr>
				<td align="top">
		<?php echo _E_GALLERY_IMAGES; ?>
				</td>
				<td width="2%">
				</td>
				<td align="top">
		<?php echo _E_CONTENT_IMAGES; ?>
				</td>
				<td align="top">
		<?php echo _E_EDIT_IMAGE; ?>
				</td>
			</tr>
			<tr>
				<td valign="top">
		<?php echo $lists['imagefiles']; ?>
					<br />
					<input class="button" type="button" value="<?php echo _E_INSERT; ?>" onclick="addSelectedToList('adminForm','imagefiles','imagelist')" />
				</td>
				<td width="2%">
					<input class="button" type="button" value=">>" onclick="addSelectedToList('adminForm','imagefiles','imagelist')" title="<?php echo _E_ADD; ?>"/>
					<br/>
					<input class="button" type="button" value="<<" onclick="delSelectedFromList('adminForm','imagelist')" title="<?php echo _E_REMOVE; ?>"/>
				</td>
				<td valign="top">
		<?php echo $lists['imagelist']; ?>
					<br />
					<input class="button" type="button" value="<?php echo _E_UP; ?>" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,-1)" />
					<input class="button" type="button" value="<?php echo _E_DOWN; ?>" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,+1)" />
				</td>
				<td valign="top">
					<table>
					<tr>
						<td align="right">
			<?php echo _E_SOURCE; ?>
						</td>
						<td>
						<input class="inputbox" type="text" name= "_source" value="" size="15" />
						</td>
					</tr>
					<tr>
						<td align="right" valign="top">
			<?php echo _E_ALIGN; ?>
						</td>
						<td>
			<?php echo $lists['_align']; ?>
						</td>
					</tr>
					<tr>
						<td align="right">
			<?php echo _E_ALT; ?>
						</td>
						<td>
						<input class="inputbox" type="text" name="_alt" value="" size="15" />
						</td>
					</tr>
					<tr>
						<td align="right">
			<?php echo _E_BORDER; ?>
						</td>
						<td>
						<input class="inputbox" type="text" name="_border" value="" size="3" maxlength="1" />
						</td>
					</tr>
					<tr>
						<td align="right">
			<?php echo _E_CAPTION; ?>:
						</td>
						<td>
						<input class="text_area" type="text" name="_caption" value="" size="30" />
						</td>
					</tr>
					<tr>
						<td align="right">
			<?php echo _E_CAPTION_POSITION; ?>:
						</td>
						<td>
			<?php echo $lists['_caption_position']; ?>
						</td>
					</tr>
					<tr>
						<td align="right">
			<?php echo _E_CAPTION_ALIGN; ?>:
						</td>
						<td>
			<?php echo $lists['_caption_align']; ?>
						</td>
					</tr>
					<tr>
						<td align="right">
			<?php echo _E_CAPTION_WIDTH; ?>:
						</td>
						<td>
						<input class="text_area" type="text" name="_width" value="" size="5" maxlength="5" />
						</td>
					</tr>
					<tr>
						<td align="right">
						</td>
						<td>
						<input class="button" type="button" value="<?php echo _E_APPLY; ?>" onclick="applyImageProps()" />
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<img name="view_imagefiles" src="<?php echo $mosConfig_live_site; ?>/images/M_images/blank.png" width="50" alt="<?php echo _E_NO_IMAGE; ?>" />
				</td>
				<td width="2%">
				</td>
				<td>
					<img name="view_imagelist" src="<?php echo $mosConfig_live_site; ?>/images/M_images/blank.png" width="50" alt="<?php echo _E_NO_IMAGE; ?>" />
				</td>
				<td>
				</td>
			</tr>
			</table>
<?php
		$tabs->endTab();
        }

        if( $allow_params){
		$tabs->startTab(_E_PUBLISHING,'publish-page');
?>
			<table class="adminform">
			<tr>
				<td align="left"><?php echo _E_ACCESS_LEVEL; ?></td>
				<td><?php echo $lists['access']; ?></td>
			</tr>
			<tr>
				<td align="left"><?php echo _E_AUTHOR_ALIAS; ?></td>
				<td>
				<input type="text" name="created_by_alias" size="50" maxlength="255" value="<?php echo $row->created_by_alias; ?>" class="inputbox" />
				</td>
			</tr>
			<tr>
				<td align="left"><?php echo _E_ORDERING; ?></td>
				<td><?php echo $lists['ordering']; ?></td>
			</tr>
			<tr>
				<td align="left"><?php echo _E_START_PUB; ?></td>
				<td>
				<input class="inputbox" type="text" name="publish_up" id="publish_up" size="25" maxlength="19" value="<?php echo $row->publish_up; ?>" />
				<input type="reset" class="button" value="..." onclick="return showCalendar('publish_up', 'y-mm-dd');" />
				</td>
			</tr>
			<tr>
				<td align="left"><?php echo _E_FINISH_PUB; ?></td>
				<td>
				<input class="inputbox" type="text" name="publish_down" id="publish_down" size="25" maxlength="19" value="<?php echo $row->publish_down; ?>" />
				<input type="reset" class="button" value="..." onclick="return showCalendar('publish_down', 'y-mm-dd');" />
				</td>
			</tr>
			</table>
<?php
		$tabs->endTab();
        }

		$tabs->endPane();
}
?>

		<div style="clear:both;"></div> <br /><br />
        <table class="cedit_misc" cellspacing="0" cellpadding="0" border="0">
            <tr>
               <?php mosToolBar::save(); 	mosToolBar::apply(); mosToolBar::cancel();  ;?>
            </tr>
       </table>

		<input type="hidden" name="images" value="" />
		<input type="hidden" name="goodexit" value="0" />
		<input type="hidden" name="option" value="com_content" />
		<input type="hidden" name="Returnid" value="<?php echo $Returnid; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="version" value="<?php echo $row->version; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $row->sectionid; ?>" />
		<input type="hidden" name="created_by" value="<?php echo $row->created_by; ?>" />
		<input type="hidden" name="referer" value="<?php echo ampReplace(@$_SERVER['HTTP_REFERER']); ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="<?php echo $validate; ?>" value="1" />
		</form>
<?php
	}

	/**
	* Writes Email form for filling in the send destination
	*/
	function emailForm($uid,$title,$template = '',$itemid) {
		global $mainframe;

		// used for spoof hardening
		$validate = josSpoofValue();

		$mainframe->setPageTitle($title);
		$mainframe->addCustomHeadTag('<link rel="stylesheet" href="templates/'.$template.'/css/template_css.css" type="text/css" />');
?>
		<script language="javascript" type="text/javascript">
		function submitbutton() {
			var form = document.frontendForm;
			// do field validation
			if (form.email.value == "" || form.youremail.value == "") {
				alert( '<?php echo addslashes(_EMAIL_ERR_NOINFO); ?>' );
				return false;
			}
			return true;
		}
		</script>

		<form action="index2.php?option=com_content&amp;task=emailsend" name="frontendForm" method="post" onSubmit="return submitbutton();">
		<table cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td colspan="2"><?php echo _EMAIL_FRIEND; ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td width="130"><?php echo _EMAIL_FRIEND_ADDR; ?></td>
			<td>
			<input type="text" name="email" class="inputbox" size="25" />
			</td>
		</tr>
		<tr>
			<td height="27"><?php echo _EMAIL_YOUR_NAME; ?></td>
			<td>
			<input type="text" name="yourname" class="inputbox" size="25" />
			</td>
		</tr>
		<tr>
			<td><?php echo _EMAIL_YOUR_MAIL; ?></td>
			<td>
			<input type="text" name="youremail" class="inputbox" size="25" />
			</td>
		</tr>
		<tr>
			<td><?php echo _SUBJECT_PROMPT; ?></td>
			<td>
			<input type="text" name="subject" class="inputbox" maxlength="100" size="40" />
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">
			<input type="submit" name="submit" class="button" value="<?php echo _BUTTON_SUBMIT_MAIL; ?>" />
			&nbsp;&nbsp;
			<input type="button" name="cancel" value="<?php echo _BUTTON_CANCEL; ?>" class="button" onclick="window.close();" />
			</td>
		</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $uid; ?>" />
		<input type="hidden" name="itemid" value="<?php echo $itemid; ?>" />
		<input type="hidden" name="<?php echo $validate; ?>" value="1" />
		</form>
<?php
	}

	/**
	* Writes Email sent popup
	* @param string Who it was sent to
	* @param string The current template
	*/
	function emailSent($to,$template = '') {
		global $mosConfig_sitename,$mainframe;

		$mainframe->setPageTitle($mosConfig_sitename);
		$mainframe->addCustomHeadTag('<link rel="stylesheet" href="templates/'.$template.'/css/template_css.css" type="text/css" />');
?>
		<span class="contentheading"><?php echo _EMAIL_SENT." $to"; ?></span> <br />
		<br />
		<br />
		<a href='javascript:window.close();'>
		<span class="small"><?php echo _PROMPT_CLOSE; ?></span>
		</a>
<?php
	}
}
?>