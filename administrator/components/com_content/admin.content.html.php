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
* @package Joostina
* @subpackage Content
*/
class HTML_content {

	/**
	* Writes a list of the content items
	* @param array An array of content objects
	*/
	function showContent( &$rows, $section, &$lists, $search, $pageNav, $all=NULL, $redirect ) {
		global $my, $acl, $database, $mosConfig_offset,$mosConfig_live_site;
		mosCommonHTML::loadOverlib();
		/* ���������� Pquery */
		mosCommonHTML::loadPquery();
		$pquery= new PQuery();
		?>
		<form action="index2.php?option=com_content" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit" rowspan="2" class="jtd_nowrap">
			<?php
			if ( $all ) {
				?>
				���������� ����� <small><small>[ ��� ������� ]</small></small>
				<?php
			} else {
				?>
				���������� ����� <small><small>[ ������: <?php echo $section->title; ?> ]</small></small>
				<?php
			}
			?>
			</th>
				<td align="right" valign="top">
				<?php echo $lists['sectionid'];?>
				</td>
				<td align="right" valign="top">
				<?php echo $lists['catid'];?>
				</td>
				<td valign="top">
				<?php echo $lists['authorid'];?>
				</td>
		</tr>
		<tr>
			<td>
				�������:<br /><?php echo $lists['order_sort'];?>
			</td>
			<td align="left">
				���������� ��:<br /><?php echo $lists['order'];?>
			</td>
			<td>
				������:<br /><input type="text" name="search" value="<?php echo htmlspecialchars( $search );?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>
		<table class="adminlist" id="myTable">
		<thead>
		<tr>
			<th width="5">
			#
			</th>
			<th width="5">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title">
			���������
			</th>
			<th width="5%">
			������������
			</th>
			<th class="jtd_nowrap" width="5%">
			�� �������
			</th>
			<th colspan="2" align="center" width="5%">
			����������
			</th>
			<th width="2%">
			�������
			</th>
			<th width="1%">
				<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="��������� �������" /></a>
			</th>
			<th >
			������
			</th>
			<th width="2%">
			ID
			</th>
			<?php
			if ( $all ) {
				?>
				<th align="left">
				������
				</th>
				<?php
			}
			?>
			<th align="left">���������</th>
			<th align="left">�����</th>
			<th align="center" width="10">�������</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$k = 0;
		$nullDate = $database->getNullDate();
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			mosMakeHtmlSafe($row);

			$link 	= 'index2.php?option=com_content&sectionid='. $redirect .'&task=edit&hidemainmenu=1&id='. $row->id;

			$row->sect_link = 'index2.php?option=com_sections&task=editA&hidemainmenu=1&id='. $row->sectionid;
			$row->cat_link 	= 'index2.php?option=com_categories&task=editA&hidemainmenu=1&id='. $row->catid;

			$now = _CURRENT_SERVER_TIME;
			if ( $now <= $row->publish_up && $row->state == 1 ) {
			// ������������
				$img = 'publish_y.png';
				$alt = '������������';
			} else if ( ( $now <= $row->publish_down || $row->publish_down == $nullDate ) && $row->state == 1 ) {
			// ��������
				$img = 'publish_g.png';
				$alt = '������������';
			} else if ( $now > $row->publish_down && $row->state == 1 ) {
			// �������
				$img = 'publish_r.png';
				$alt = '����������';
			} elseif ( $row->state == 0 ) {
			// �� ������������
				$img = 'publish_x.png';
				$alt = '�� ������������';
			}

			// ������������� � �������� �������
			$row->publish_up = mosFormatDate( $row->publish_up, _CURRENT_SERVER_TIME_FORMAT );
			if (trim( $row->publish_down ) == $nullDate || trim( $row->publish_down ) == '' || trim( $row->publish_down ) == '-' ) {
				$row->publish_down = '�������';
			}
			$row->publish_down = mosFormatDate( $row->publish_down, _CURRENT_SERVER_TIME_FORMAT );

			$times = '';
				if ($row->publish_up == $nullDate) {
					$times .= "<tr><td>������: ������</td></tr>";
				} else {
					$times .= "<tr><td>������: $row->publish_up</td></tr>";
				}
			if ($row->publish_down == $nullDate || $row->publish_down == '�������') {
					$times .= "<tr><td>���������: ��� ���������</td></tr>";
				} else {
					$times .= "<tr><td>���������: $row->publish_down</td></tr>";
			}

			if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) ) {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$linkA 	= 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='. $row->created_by;
					$author = '<a href="'. $linkA .'" title="�������� ������ ������������">'. $row->author .'</a>';
				}
			} else {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$author = $row->author;
				}
			}
			$date		= mosFormatDate( $row->created, '%x' );
			$access		= mosCommonHTML::AccessProcessing( $row, $i );
			$checked	= mosCommonHTML::CheckedOutProcessing( $row, $i );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<?php echo $checked; ?>
				</td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id )) {
					echo $row->title;
				} else {
					?>
					<a href="<?php echo $link; ?>" title="�������� ����������">
					<?php echo $row->title; ?>
					</a>
					<?php
				}
				?>
				</td>
				<?php
				if ( $times ) {
					?>
					<td align="center">
					<?php
						global $mosConfig_live_site;
						$url = $mosConfig_live_site.'/administrator/index4.php?option=com_content&task=publish&id='.$row->id;
						$div_id = 'div_'.$row->id;
						$div = '<div class="mini_ico" id="'.$div_id.'"><img src="images/'.$img.'" width="12" height="12" border="0" alt="" /></div>';
						if ( !$row->checked_out ) { // ������ ������������ - �������� ��������� ��������� ����������
							echo $pquery->link_to_remote($div,array('url'=>$url,'update'=>'#'.$div_id,'beforeSend'=>$pquery->visual_effect('show','#ajax_status'),'success'=>$pquery->visual_effect('hide','#ajax_status')),null,'�����������&nbsp;/&nbsp;������&nbsp;�������');
						}else{
							echo $div;
						}
						?>
					</td>
					<?php
				}
				?>
				<td align="center">
					<?php
						global $mosConfig_live_site;
						if ($row->frontpage) $front_img = 'tick.png'; else $front_img = 'publish_x.png';
						$url = $mosConfig_live_site.'/administrator/index4.php?option=com_content&task=frontpage&id='.$row->id;
						$div_id = 'div_f_'.$row->id;
						$div = '<div class="mini_ico" id="'.$div_id.'"><img src="images/'.$front_img.'" width="12" height="12" border="0" alt="" /></div>';
						if ( !$row->checked_out ) { // ������ ������������ - �������� ��������� ��������� �� ������� ��������
							echo $pquery->link_to_remote($div,array('url'=>$url,'update'=>'#'.$div_id,'beforeSend'=>$pquery->visual_effect('show','#ajax_status'),'success'=>$pquery->visual_effect('hide','#ajax_status')),null,'����������&nbsp;��&nbsp;�������&nbsp;��������');
						}else{
							echo $div;
						}	
					?>
				</td>
				<td align="right">
				<?php echo $pageNav->orderUpIcon( $i, ($row->catid == @$rows[$i-1]->catid) ); ?>
				</td>
				<td align="left">
				<?php echo $pageNav->orderDownIcon( $i, $n, ($row->catid == @$rows[$i+1]->catid) ); ?>
				</td>
				<td align="center" colspan="2">
					<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<td align="center">
					<?php echo $access;?>
				</td>
				<td align="left">
					<?php echo $row->id; ?>
				</td>
				<?php
				if ( $all ) {
					?>
					<td align="left">
					<a href="<?php echo $row->sect_link; ?>" title="�������� ������">
					<?php echo $row->section_name; ?>
					</a>
					</td>
					<?php
				}
				?>
				<td align="left">
				<a href="<?php echo $row->cat_link; ?>" title="�������� ���������">
				<?php echo $row->name; ?>
				</a>
				</td>
				<td align="left">
				<?php echo $author; ?>
				</td>
				<td align="left">
				<?php echo $date; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</tbody>
		</table>
		<?php echo $pageNav->getListFooter(); ?>
		<?php mosCommonHTML::ContentLegend(); ?>
		<input type="hidden" name="option" value="com_content" />
		<input type="hidden" name="sectionid" value="<?php echo $section->id;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
		</form>
		<?php
	}


	/**
	* Writes a list of the content items
	* @param array An array of content objects
	*/
	function showArchive( &$rows, $section, &$lists, $search, $pageNav, $option, $all=NULL, $redirect ) {
		global $my, $acl;

		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'remove') {
				if (document.adminForm.boxchecked.value == 0) {
					alert('����������, �������� �� ������ �������, ������� �� ������ ��������� � �������');
				} else if ( confirm('�� �������, ��� ������ ��������� ������(�) � �������? \n ��� �� �������� � ������� �������� ��������')) {
					submitform('remove');
				}
			} else {
				submitform(pressbutton);
			}
		}
		</script>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="edit" rowspan="2">
			<?php
			if ( $all ) {
				?>
				����� <small><small>[ ��� ������� ]</small></small>
				<?php
			} else {
				?>
				����� <small><small>[ ������: <?php echo $section->title; ?> ]</small></small>
				<?php
			}
			?>
			</th>
			<?php
			if ( $all ) {
				?>
				<td align="right" rowspan="2" valign="top">
				<?php echo $lists['sectionid'];?>
				</td>
				<?php
			}
			?>
			<td align="right" valign="top">
			<?php echo $lists['catid'];?>
			</td>
			<td valign="top">
			<?php echo $lists['authorid'];?>
			</td>
		</tr>
		<tr>
			<td align="right">
			������:
			</td>
			<td>
			<input type="text" name="search" value="<?php echo htmlspecialchars( $search );?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="5">
			#
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title">
			���������
			</th>
			<th width="2%">
			�������
			</th>
			<th width="1%">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="��������� �������" /></a>
			</th>
			<th width="15%" align="left">
			���������
			</th>
			<th width="15%" align="left">
			�����
			</th>
			<th align="center" width="10">
			����
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];

			$row->cat_link 	= 'index2.php?option=com_categories&task=editA&hidemainmenu=1&id='. $row->catid;

			if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) ) {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$linkA 	= 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='. $row->created_by;
					$author = '<a href="'. $linkA .'" title="�������� ������ ������������">'. $row->author .'</a>';
				}
			} else {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$author = $row->author;
				}
			}

			$date = mosFormatDate( $row->created, '%x' );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td width="20">
				<?php echo mosHTML::idBox( $i, $row->id ); ?>
				</td>
				<td>
				<?php echo $row->title; ?>
				</td>
				<td align="center" colspan="2">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<td>
				<a href="<?php echo $row->cat_link; ?>" title="�������� ���������">
				<?php echo $row->name; ?>
				</a>
				</td>
				<td>
				<?php echo $author; ?>
				</td>
				<td>
				<?php echo $date; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="sectionid" value="<?php echo $section->id;?>" />
		<input type="hidden" name="task" value="showarchive" />
		<input type="hidden" name="returntask" value="showarchive" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
		</form>
		<?php
	}


	/**
	* ����������� ����� �������� / �������������� �����������
	*
	* ����� ������ ��������������� ���������� <var>$row</var> �  <var>id</var>
	* ������� 0.
	* @param mosContent The category object
	* @param string The html for the groups select list
	*/
	function editContent( &$row, $section, &$lists, &$sectioncategories, &$images, &$params, $option, $redirect, &$menus ) {
		global $database,$mosConfig_live_site,$mosConfig_disable_image_tab;

		mosMakeHtmlSafe( $row );

		$nullDate 		= $database->getNullDate();
		$create_date = null;

		if ( $row->created != $nullDate ) {
			$create_date 	= mosFormatDate( $row->created, '%A, %d %B %Y %H:%M', '0' );
		}
		$mod_date = null;
		if ( $row->modified != $nullDate ) {
			$mod_date 		= mosFormatDate( $row->modified, '%A, %d %B %Y %H:%M', '0' );
		}
		// ������ ����������� ���� -  � �������������� Jquery
		$tabs = new mosTabs(1);
		
		// used to hide "Reset Hits" when hits = 0
		if ( !$row->hits ) {
			$visibility = "style='display: none; visibility: hidden;'";
		} else {
			$visibility = "";
		}

		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadCalendar();
		
		/* ���������� Pquery */
		mosCommonHTML::loadPquery();
		$pquery= new PQuery();
		?>

		<script language="javascript" type="text/javascript">
		<!--
		var sectioncategories = new Array;
		<?php
		$i = 0;
		foreach ($sectioncategories as $k=>$items) {
			foreach ($items as $v) {
				echo "sectioncategories[".$i++."] = new Array( '$k','".addslashes( $v->id )."','".addslashes( $v->name )."' );\t";
			}
		}
		?>
	<?php
	// ���������� ������� "�����������"
	if(!$mosConfig_disable_image_tab){ ?>
			var folderimages = new Array;
			<?php
			$i = 0;
			foreach ($images as $k=>$items) {
				foreach ($items as $v) {
					echo "folderimages[".$i++."] = new Array( '$k','".addslashes( ampReplace( $v->value ) )."','".addslashes( ampReplace( $v->text ) )."' );\t";
				}
			}
		}
		?>
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if ( pressbutton == 'menulink' ) {
				if ( form.menuselect.value == "" ) {
					alert( "����������, �������� ����" );
					return;
				} else if ( form.link_name.value == "" ) {
					alert( "����������, ������� �������� ��� ����� ������ ����" );
					return;
				}
			}

			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			<?php
			// ���������� ������� "�����������"
			if(!$mosConfig_disable_image_tab){
			?>
				var temp = new Array;
				for (var i=0, n=form.imagelist.options.length; i < n; i++) {
					temp[i] = form.imagelist.options[i].value;
				}
				form.images.value = temp.join( '\n' );
			<?php }?>
			// do field validation
			if (form.title.value == ""){
				alert( "���� ������ ������ ����� ���������" );
			} else if (form.sectionid.value == "-1"){
				alert( "�� ������ ������� ������." );
			} else if (form.catid.value == "-1"){
				alert( "�� ������ ������� ���������." );
			} else if (form.catid.value == ""){
				alert( "�� ������ ������� ���������." );
			} else {
				<?php getEditorContents( 'editor1', 'introtext' ) ; ?>
				<?php getEditorContents( 'editor2', 'fulltext' ) ; ?>
				<?php getEditorContents( 'editor3', 'notetext' ) ; ?>
				submitform( pressbutton );
			}
		}
		function x_save(){
			$("#ajax_status").show("normal");
			<?php getEditorContents( 'editor1', 'introtext' ) ; ?>
			<?php getEditorContents( 'editor2', 'fulltext' ) ; ?>
			<?php getEditorContents( 'editor3', 'notetext' ) ; ?>
			$.ajax({
				url: "index4.php?option=com_content&task=x_save&id=<?php echo $row->id;?>",
				data: $("#adminForm").serialize(),
				type: "POST",
				success:
					function(response){
						$("#ajax_status").hide("normal");
						$("#x_save_b").val('��������� ����������: '+response);
					},
				dataType: "html"
				});
		}
		//-->
		</script>
		<table class="adminheading">
		<tr>
			<th class="edit">
			����������:
			<small>
			<?php echo $row->id ? '��������������' : '�����';?>
			</small>
			<?php
			if ( $row->id ) {?>
				<small><small>
				[ ������: <?php echo $section; ?> ]
				</small></small>
				<?php
			}?>
			</th>
		</tr>
		</table>
		<div align="right">
			���������:&nbsp;<?php echo $pquery->link_to_function('��������',$pquery->visual_effect('fadeIn','#params'));?>&nbsp;/&nbsp;
			<?php echo $pquery->link_to_function('������',$pquery->visual_effect('fadeOut','#params'));?>&nbsp;
		</div>
		<form action="index2.php" method="post" name="adminForm" id="adminForm">
		<table cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td width="100%" valign="top">
				<table width="100%" class="adminform" id="adminForm">
				<tr>
					<td width="100%">
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
						<tr>
							<th colspan="4">
							������ �������
							</th>
						</tr>
						<tr>
							<td width="15">
							���������:
							</td>
							<td width="50%">
								<input class="text_area" type="text" name="title" size="30" maxlength="255" style="width:99%" value="<?php echo $row->title; ?>" />
							</td>
							<td width="15">
							������:
							</td>
							<td width="50%">
							<?php echo $lists['sectionid']; ?>
							</td>
						</tr>
						<tr>
							<td width="15">
							���������:
							</td>
							<td width="50%">
								<input name="title_alias" type="text" class="text_area" id="title_alias" value="<?php echo $row->title_alias; ?>" size="30" style="width:99%" maxlength="255" />
							</td>
							<td width="15">
							���������:
							</td>
							<td width="50%">
							<?php echo $lists['catid']; ?>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="100%">
					������� �����: (�����������)
					&nbsp;<?php echo $pquery->link_to_function('��������',$pquery->visual_effect('fadeIn','#intro_text'));?>&nbsp;/&nbsp;
					<?php echo $pquery->link_to_function('������',$pquery->visual_effect('fadeOut','#intro_text'));
					if(function_exists('jceEditorInit')){
					?>&nbsp;/&nbsp;
					<a id="editor_toggle_i" href="javascript:jceFunctions.toggleEditor('introtext');">���</a>
					<?php };?>
					<div id="intro_text">
					<?php
						// parameters : areaname, content, hidden field, width, height, rows, cols
						editorArea( 'editor1',  $row->introtext , 'introtext', '99%;', '350', '75', '20' ) ; ?>
					</div>
					</td>
				</tr>
				<tr>
					<td width="100%">
					�������� �����: (�������������)
					&nbsp;<?php echo $pquery->link_to_function('��������',$pquery->visual_effect('fadeIn','#full_text'));?>&nbsp;/&nbsp;
					<?php echo $pquery->link_to_function('������',$pquery->visual_effect('fadeOut','#full_text'));
					if(function_exists('jceEditorInit')){
					?>&nbsp;/&nbsp;
					<a id="editor_toggle_f" href="javascript:jceFunctions.toggleEditor('fulltext');">���</a>
					<?php };?>
					<div id="full_text">
					<?php
						// parameters : areaname, content, hidden field, width, height, rows, cols
						editorArea( 'editor2',  $row->fulltext , 'fulltext', '99%;', '400', '75', '30' ) ; ?>
					</div>
					</td>
				</tr>
				<tr>
					<td width="100%">
					�������: (�������������)
					&nbsp;<?php echo $pquery->link_to_function('��������',$pquery->visual_effect('fadeIn','#note_text'));?>&nbsp;/&nbsp;
					<?php echo $pquery->link_to_function('������',$pquery->visual_effect('fadeOut','#note_text'));?>&nbsp;/&nbsp;
					<a id="editor_toggle_n" href="javascript:jceFunctions.toggleEditor('notetext');">���</a>
					<div id="note_text">
					<?php
						// parameters : areaname, content, hidden field, width, height, rows, cols
						editorArea( 'editor3',  $row->notetext , 'notetext', '99%;', '150', '75', '20' ) ; ?>
					</div>
					</td>
				</tr>
				</table>
			</td>
			<td valign="top">
			<div id="params" style="width:370px">
			<?php if($row->id){?>
				<div id="qsett">
					<span id="lastsavetime">&nbsp;</span>
					<input name="x_save_b" type="button" class="button" id="x_save_b" onclick="x_save();" value="������� ����������" />
					<!--#�� �������, ��� ���, �������� ����������#<input name="x_rus_typo_b" type="button" class="button" onclick="x_rus_typo();" value="�������������" />-->
					<!--#�� �������, ��� ���, �������� ����������#<script type="text/javascript">
						$(document).ready(function() {
							setInterval(function(){
							x_save();
							},3000)
						});
					</script>-->
				</div>
				<?php };?>
				<?php
					$tabs->startPane("content-pane");
					$tabs->startTab("�������� � ����������","publish-page");
				?>
				<table width="100%" class="adminform">
					<tr>
					<td valign="top" align="right" width="120">
						���������� �� �������:
						</td>
						<td>
						<input type="checkbox" name="frontpage" value="1" <?php echo $row->frontpage ? 'checked="checked"' : ''; ?> />
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						������������:
						</td>
						<td>
						<input type="checkbox" name="published" value="1" <?php echo $row->state ? 'checked="checked"' : ''; ?> />
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						������� �������:
						</td>
						<td>
					<?php echo $lists['access']; ?>
					</td>
						</tr>
					<tr>
						<td valign="top" align="right">
						��������� ������:
						</td>
						<td>
							<input type="text" name="created_by_alias" style="width:90%" size="30" maxlength="100" value="<?php echo $row->created_by_alias; ?>" class="text_area" />
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						�����:
						</td>
						<td>
					<?php echo $lists['created_by']; ?>
					</td>
					</tr>
					<tr>
						<td valign="top" align="right">�������:</td>
						<td>
					<?php echo $lists['ordering']; ?>
					</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						������������ ���� ��������:
						</td>
						<td>
						<input class="text_area" type="text" name="created" id="created" size="25" maxlength="19" value="<?php echo $row->created; ?>" />
						<input name="reset" type="reset" class="button" onclick="return showCalendar('created', 'y-mm-dd');" value="..." />
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						������ ����������:
						</td>
						<td>
						<input class="text_area" type="text" name="publish_up" id="publish_up" size="25" maxlength="19" value="<?php echo $row->publish_up; ?>" />
					<input type="reset" class="button" value="..." onclick="return showCalendar('publish_up', 'y-mm-dd');" />
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						��������� ����������:
						</td>
						<td>
						<input class="text_area" type="text" name="publish_down" id="publish_down" size="25" maxlength="19" value="<?php echo $row->publish_down; ?>" />
					<input type="reset" class="button" value="..." onclick="return showCalendar('publish_down', 'y-mm-dd');" />
						</td>
					</tr>
					</table>
					<br />
					<table class="adminform">
					<?php
					if ( $row->id ) {
						?>
						<tr>
							<td>
							<strong>ID �������:</strong>
							</td>
							<td>
							<?php echo $row->id; ?>
							</td>
						</tr>
						<?php
					}
					?>
					<tr>
					<td width="120" valign="top" align="right">
						<strong>���������:</strong>
						</td>
						<td>
						<?php echo $row->state > 0 ? '������������' : ($row->state < 0 ? '� ������' : '�������� - �� �����������');?>
						</td>
					</tr>
					<tr >
						<td valign="top" align="right">
						<strong>
							����������:
						</strong>
						</td>
						<td>
						<?php echo $row->hits;?>
						<div <?php echo $visibility; ?>>
						<input name="reset_hits" type="button" class="button" value="�������� ������� ����������" onclick="submitbutton('resethits');" />
						</div>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<strong>
							����������:
						</strong>
						</td>
						<td>
						<?php echo $row->version;?> ���
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<strong>
						�������:
						</strong>
						</td>
						<td>
						<?php
						if ( !$create_date ) {
							?>
							����� ��������
							<?php
						} else {
							echo $create_date;
						}
						?>
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">
						<strong>
						��������� ���������:
						</strong>
						</td>
						<td>
						<?php
						if ( !$mod_date ) {
							?>
							�� �������
							<?php
						} else {
							echo $mod_date;
							?>
							<br />
							<?php
							echo $row->modifier;
						}
						?>
						</td>
					</tr>
					</table>
					<?php
					$tabs->endTab();
					// ���������� ������� "�����������"
 					if(!$mosConfig_disable_image_tab){
					$tabs->startTab("�����������","images-page");
					?>
					<table class="adminform" width="100%">
					<tr>
						<td colspan="2">
							<table width="100%">
							<tr>
								<td width="48%" valign="top">
									<div align="center">
										�������:
										<br />
										<?php echo $lists['imagefiles'];?>
									</div>
								</td>
								<td width="2%">
									<input class="button" type="button" value=">>" onclick="addSelectedToList('adminForm','imagefiles','imagelist')" title="��������" />
									<br />
									<input class="button" type="button" value="<<" onclick="delSelectedFromList('adminForm','imagelist')" title="�������" />
								</td>
								<td width="48%">
									<div align="center">
										������������ �����������:
										<br />
										<?php echo $lists['imagelist'];?>
										<br />
										<input class="button" type="button" value="�����" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,-1)" />
										<input class="button" type="button" value="����" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,+1)" />
									</div>
								</td>
							</tr>
							</table>
							��������: <?php echo $lists['folders'];?>
						</td>
					</tr>
					<tr valign="top">
						<td>
							<div align="center">
								������ �����������:<br />
								<img name="view_imagefiles" src="../images/M_images/blank.png" alt="������ �����������" width="100" />
							</div>
						</td>
						<td valign="top">
							<div align="center">
								�������� �����������:<br />
								<img name="view_imagelist" src="../images/M_images/blank.png" alt="�������� �����������" width="100" />
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							��������� �����������:
							<table>
							<tr>
								<td align="right">
								��������:
								</td>
								<td>
								<input style="width:99%" class="text_area" type="text" name= "_source" value="" />
								</td>
							</tr>
							<tr>
								<td align="right">
								������������:
								</td>
								<td>
								<?php echo $lists['_align']; ?>
								</td>
							</tr>
							<tr>
								<td align="right">
								�������������� �����:
								</td>
								<td>
								<input style="width:99%" class="text_area" type="text" name="_alt" value="" />
								</td>
							</tr>
							<tr>
								<td align="right">
								�����:
								</td>
								<td>
								<input class="text_area" type="text" name="_border" value="" size="3" maxlength="1" />
								</td>
							</tr>
							<tr>
								<td align="right">
								�������:
								</td>
								<td>
								<input class="text_area" type="text" name="_caption" value="" size="30" />
								</td>
							</tr>
							<tr>
								<td align="right">
								������� �������:
								</td>
								<td>
								<?php echo $lists['_caption_position']; ?>
								</td>
							</tr>
							<tr>
								<td align="right">
								������������ �������:
								</td>
								<td>
								<?php echo $lists['_caption_align']; ?>
								</td>
							</tr>
							<tr>
								<td align="right">
								������ �������:
								</td>
								<td>
								<input class="text_area" type="text" name="_width" value="" size="5" maxlength="5" />
								</td>
							</tr>
							<tr>
								<td colspan="2">
								<input class="button" type="button" value="���������" onclick="applyImageProps()" />
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
					<?php
					$tabs->endTab();
					}
					else echo '<input type="hidden" name="images" id="images" value="" />';
					$tabs->startTab("���������","params-page");
					?>
					<table class="adminform">
					<tr>
						<td>
						* ��� ��������� ��������� ������� ����� ������ � ������ ������� ��������� *
						<br />
						</td>
					</tr>
					<tr>
						<td>
						<?php echo $params->render();?>
						</td>
					</tr>
					</table>
					<?php
					$tabs->endTab();
					$tabs->startTab("���� - ����","metadata-page");
					?>
					<table class="adminform">
					<tr>
						<td>
						�������� (Description):
						<br />
					<textarea class="text_area" cols="30" rows="3" style="width: 350px; height: 50px" name="metadesc"><?php echo str_replace('&','&amp;',$row->metadesc); ?></textarea>
						</td>
					</tr>
						<tr>
						<td>
						�������� ����� (Keywords)
						<br />
							<textarea class="text_area" cols="30" rows="3" style="width: 350px; height: 50px" name="metakey"><?php echo str_replace('&','&amp;',$row->metakey); ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
						<input type="button" class="button" style="width: 356px; height: 25px" value="�������� (������, ���������, ���������)" onclick="f=document.adminForm;f.metakey.value=document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].text+', '+getSelectedText('adminForm','catid')+', '+f.title.value+f.metakey.value;" />
						</td>
					</tr>
					<tr>
						<td>��������� ���������� ��������: <br />
						<?php echo $lists['robots'] ?>
						</td>
					</tr>
					</table>
					<?php
					$tabs->endTab();
					$tabs->startTab("�������� � ������� ����","link-page");
					?>
					<table class="adminform">
					<tr>
						<td colspan="2">
						����� ��������� ����� ���� (������ - ������ �����������), ������� ����������� � ��������� �� ������ ����
						<br /><br />
						</td>
				</tr>
					<tr>
					<td valign="top" width="90">
						�������� ����
						</td>
						<td>
						<?php echo $lists['menuselect']; ?>
						</td>
				</tr>
					<tr>
					<td valign="top" width="90">
						�������� ������ ����
						</td>
						<td>
						<input style="width:90%" type="text" name="link_name" class="text_area" value="" size="30" />
						</td>
				</tr>
					<tr>
						<td>
						</td>
						<td>
						<input name="menu_link" type="button" class="button" value="������� � ����" onclick="submitbutton('menulink');" />
						</td>
				</tr>
					<tr>
						<th colspan="2">
						������������ ������ ����
						</th>
					</tr>
					<?php
					if ( $menus == NULL ) {
						?>
						<tr>
							<td colspan="2">
							�����������
							</td>
						</tr>
						<?php
					} else {
						mosCommonHTML::menuLinksContent( $menus );
					}
					?>
					<tr>
						<td colspan="2">
						</td>
					</tr>
					</table>
					<?php
					$tabs->endTab();
					$tabs->endPane();
					?>
					</div>
					</td>
				</tr>
				</table>

		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="version" value="<?php echo $row->version; ?>" />
		<input type="hidden" name="mask" value="0" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="redirect" value="<?php echo $redirect;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="images" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php

	}


	/**
	* Form to select Section/Category to move item(s) to
	* @param array An array of selected objects
	* @param int The current section we are looking at
	* @param array The list of sections and categories to move to
	*/
	function moveSection( $cid, $sectCatList, $option, $sectionid, $items ) {
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			if (!getSelectedValue( 'adminForm', 'sectcat' )) {
				alert( "����������, �������� ���-������" );
			} else {
				submitform( pressbutton );
			}
		}
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<br />
		<table class="adminheading">
		<tr>
			<th class="edit">
			����������� ��������
			</th>
		</tr>
		</table>

		<br />
		<table class="adminform">
		<tr>
			<td align="left" valign="top" width="40%">
			<strong>����������� � ������/���������:</strong>
			<br />
			<?php echo $sectCatList; ?>
			<br /><br />
			</td>
			<td align="left" valign="top">
			<strong>����� ���������� �������:</strong>
			<br />
			<?php
			echo "<ol>";
			foreach ( $items as $item ) {
				echo "<li>". $item->title ."</li>";
			}
			echo "</ol>";
			?>
			</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>" />
		<input type="hidden" name="task" value="" />
		<?php
		foreach ($cid as $id) {
			echo "\n<input type=\"hidden\" name=\"cid[]\" value=\"$id\" />";
		}
		?>
		</form>
		<?php
	}



	/**
	* Form to select Section/Category to copys item(s) to
	*/
	function copySection( $option, $cid, $sectCatList, $sectionid, $items  ) {
		?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			// do field validation
			if (!getSelectedValue( 'adminForm', 'sectcat' )) {
				alert( "����������, �������� ������ ��� ��������� ��� ����������� �������� � " );
			} else {
				submitform( pressbutton );
			}
		}
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<br />
		<table class="adminheading">
		<tr>
			<th class="edit">
			����������� �������� �����������
			</th>
		</tr>
		</table>

		<br />
		<table class="adminform">
		<tr>
			<td align="left" valign="top" width="40%">
			<strong>���������� � ������/���������:</strong>
			<br />
			<?php echo $sectCatList; ?>
			<br /><br />
			</td>
			<td align="left" valign="top">
			<strong>����� ����������� �������:</strong>
			<br />
			<?php
			echo "<ol>";
			foreach ( $items as $item ) {
				echo "<li>". $item->title ."</li>";
			}
			echo "</ol>";
			?>
			</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>" />
		<input type="hidden" name="task" value="" />
		<?php
		foreach ($cid as $id) {
			echo "\n<input type=\"hidden\" name=\"cid[]\" value=\"$id\" />";
		}
		?>
		</form>
		<?php
	}
}
?>
