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
* @package Joostina
* @subpackage Content
*/
class HTML_content {

	/**
	* Writes a list of the content items
	* @param array An array of content objects
	*/
	function showContent(&$rows,$section,&$lists,$search,$pageNav,$all = null,$redirect='') {
		global $my,$acl,$database,$mosConfig_live_site;
		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadDtree();
	?>
	<script type="text/javascript">
		// ����� ������� ����������� �� ������� ��������
		function ch_fpage(elID){
			log('����� ����������� �� �������: '+elID);
			SRAX.get('img-fpage-'+elID).src = 'images/aload.gif';
			dax({
				url: 'ajax.index.php?option=com_content&utf=0&task=frontpage&id='+elID,
				id:'fpage-'+elID,
				callback:
					function(resp, idTread, status, ops){
						log('������� �����: ' + resp.responseText);
						SRAX.get('img-fpage-' + elID).src = 'images/'+resp.responseText;
			}});
		}
		// ����������� ����������� � �������
		function ch_trash(elID){
			log('�������� � �������: '+elID);
			if(SRAX.get('img-trash-'+elID).src == '<?php echo $mosConfig_live_site;?>/administrator/images/trash_mini.png'){
				SRAX.get('img-trash-'+elID).src = 'images/help.png';
				return null;
			}

			SRAX.get('img-trash-'+elID).src = 'images/aload.gif';
			dax({
				url: 'ajax.index.php?option=com_content&utf=0&task=to_trash&id='+elID,
				id:'trash-'+elID,
				callback:
					function(resp, idTread, status, ops){
						log('������� �����: ' + resp.responseText);
						if(resp.responseText=='1') {
							log('����������� � ������� �������: ' + elID);
							SRAX.remove('tr-el-'+elID);
						}else{
							log('������ ����������� � �������: ' + elID);
							SRAX.get('tr-el-'+elID).style.background='red';
						}
			}});
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
	<form action="index2.php?option=com_content" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit" colspan="3" class="jtd_nowrap">
<?php if($all) { ?>
				���������� ���� �������� � ���������.
<?php } else { ?>
				���������� �����, <?php echo $section->params['name'];?>: <a href="<?php echo $section->params['link'];?>" title="������� � ��������������"><?php echo $section->title; ?></a>
<?php } ?>
			</th>
		</tr>
		<tr>
			<td>
				������:<br /><input type="text" style="width: 99%;" name="search" value="<?php echo htmlspecialchars($search); ?>" class="inputbox" onChange="document.adminForm.submit();" />
			</td>
			<td>���������� ��:<br /><?php echo $lists['order']; ?></td>
			<td>�������:<br /><?php echo $lists['order_sort']; ?></td>
		</tr>
	</table>

<table class="adminlisttop adminlist">
	<tr class="row0">
	<td valign="top" align="left" id="ntdree"><img src="images/con_pix.gif"><?php echo $lists['sectree'];?></td>
	<td onclick="ntreetoggle();" width="1" id="tdtoogle" <?php echo $lists['sectreetoggle'];?>><img border="0" alt="������ ������ ���������" src="images/tgl.gif" /></td>
	<td valign="top" width="100%">
	<table class="adminlist" width="100%">
		<thead>
		<tr>
			<th width="5">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title">���������</th>
			<th>������������</th>
			<th class="jtd_nowrap">�� �������</th>
			<th width="2%">�������</th>
			<th width="1%">
				<a href="javascript: saveorder( <?php echo count($rows) - 1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="��������� �������" /></a>
			</th>
			<th width="10%">������</th>
			<th align="center">� �������</th>
			<th width="5">ID</th>
		</tr>
		</thead>
		<tbody>
<?php
		$k = 0;
		$nullDate = $database->getNullDate();
		$now = _CURRENT_SERVER_TIME;
		for($i = 0,$n = count($rows); $i < $n; $i++) {
			$row = &$rows[$i];
			mosMakeHtmlSafe($row);
			$link = 'index2.php?option=com_content&sectionid='.$redirect.'&task=edit&hidemainmenu=1&id='.$row->id;
			$row->sect_link = 'index2.php?option=com_sections&task=editA&hidemainmenu=1&id='.$row->sectionid;
			$row->cat_link = 'index2.php?option=com_categories&task=editA&hidemainmenu=1&id='.$row->catid;
			if($now <= $row->publish_up && $row->state == 1) {
				// ������������
				$img = 'publish_y.png';
				//$alt = '������������';
			} else if(($now <= $row->publish_down || $row->publish_down == $nullDate) && $row->state ==1) {
				// ��������
				$img = 'publish_g.png';
				//$alt = '������������';
			} else if($now > $row->publish_down && $row->state == 1) {
				// �������
				$img = 'publish_r.png';
				//$alt = '����������';
			} elseif($row->state == 0) {
				// �� ������������
				$img = 'publish_x.png';
				//$alt = '�� ������������';
			}
			// ������������� � �������� �������
			$row->publish_up = mosFormatDate($row->publish_up,_CURRENT_SERVER_TIME_FORMAT);
			if(trim($row->publish_down) == $nullDate || trim($row->publish_down) == '' || trim($row->publish_down) == '-') {
				$row->publish_down = '�������';
			}
			$row->publish_down = mosFormatDate($row->publish_down,_CURRENT_SERVER_TIME_FORMAT);
			$times = '';
			if($row->publish_up == $nullDate) {
				$times .= "<tr><td>������: ������</td></tr>";
			} else {
				$times .= "<tr><td>������: $row->publish_up</td></tr>";
			}
			if($row->publish_down == $nullDate || $row->publish_down == '�������') {
				$times .= "<tr><td>���������: ��� ���������</td></tr>";
			} else {
				$times .= "<tr><td>���������: $row->publish_down</td></tr>";
			}
			if($acl->acl_check('administration','manage','users',$my->usertype,'components','com_users')) {
				if($row->created_by_alias) {
					$author = $row->created_by_alias;
				} else {
					$linkA = 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='.$row->created_by;
					$author = '<a href="'.$linkA.'" title="�������� ������ ������������">'.$row->author.'</a>';
				}
			} else {
				if($row->created_by_alias) {
					$author = $row->created_by_alias;
				} else {
					$author = $row->author;
				}
			}
			//$date		= mosFormatDate($row->created,'%x');
			$access		= mosCommonHTML::AccessProcessing($row,$i,1);
			$checked	= mosCommonHTML::CheckedOutProcessing($row,$i);
			// ������ ����������� �� ������� ��������
			$front_img = $row->frontpage ? 'tick.png' : 'publish_x.png';
?>
			<tr class="row<?php echo $k; ?>" id="tr-el-<?php echo $row->id;?>">
				<td align="center"><?php echo $checked; ?></td>
				<td align="left">
<?php
				if($row->checked_out && ($row->checked_out != $my->id)) {
					echo $row->title;
				} else {
?>
				<a class="abig" href="<?php echo $link; ?>" title="�������� ����������"><?php echo $row->title; ?></a>
<?php
				}
?>
				<br />
				<?php echo $row->created;?>,  <?php echo $row->hits;?> ���������� : <?php echo $author; ?>
				</td>
<?php
			if($times) {
?>
				<td align="center" <?php echo ($row->checked_out && ($row->checked_out != $my->id)) ? null : 'onclick="ch_publ('.$row->id.',\'com_content\');" class="td-state"';?>>
					<img class="img-mini-state" src="images/<?php echo $img;?>" id="img-pub-<?php echo $row->id;?>" alt="����������" />
				</td>
<?php
			}
?>
				<td align="center" <?php echo ($row->checked_out && ($row->checked_out != $my->id)) ? null : 'onclick="ch_fpage('.$row->id.');" class="td-state"';?>>
					<img class="img-mini-state" src="images/<?php echo $front_img;?>" id="img-fpage-<?php echo $row->id;?>" alt="����������� �� ������� ��������" />
				</td>
				<td align="center" colspan="2">
					<?php echo $pageNav->orderUpIcon($i,($row->catid == @$rows[$i - 1]->catid)); ?>
					<input type="text" name="order[]" size="3" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
					<?php echo $pageNav->orderDownIcon($i,$n,($row->catid == @$rows[$i + 1]->catid)); ?>
				</td>
				<td align="center" id="acc-id-<?php echo $row->id;?>"><?php echo $access; ?></td>
				<td align="center" <?php echo $row->checked_out ? null : 'onclick="ch_trash('.$row->id.');" class="td-state"';?>>
					<img class="img-mini-state" src="images/trash_mini.png" id="img-trash-<?php echo $row->id;?>"/>
				</td>
				<td align="center"><?php echo $row->id; ?></td>
			</tr>
<?php
			$k = 1 - $k;
		}
?>
		</tbody>
		</table>
		</td>
	</tr>
</table>
		<?php echo $pageNav->getListFooter(); ?>
		<?php mosCommonHTML::ContentLegend(); ?>
		<input type="hidden" name="option" value="com_content" />
		<input type="hidden" name="sectionid" value="<?php echo $section->id; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php
	}


	/**
	* Writes a list of the content items
	* @param array An array of content objects
	*/
	function showArchive(&$rows,$section,&$lists,$search,$pageNav,$option,$all = null,$redirect) {
		global $my,$acl;

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
		if($all) {
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
		if($all) {
?>
				<td align="right" rowspan="2" valign="top"><?php echo $lists['sectionid']; ?></td>
				<?php
		}
?>
			<td align="right" valign="top"><?php echo $lists['catid']; ?></td>
			<td valign="top"><?php echo $lists['authorid']; ?></td>
		</tr>
		<tr>
			<td align="right">������:</td>
			<td>
				<input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>
		<table class="adminlist">
		<tr>
			<th width="5">#</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title">���������</th>
			<th width="2%">�������</th>
			<th width="1%">
				<a href="javascript: saveorder( <?php echo count($rows) - 1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="��������� �������" /></a>
			</th>
			<th width="15%" align="left">���������</th>
			<th width="15%" align="left">�����</th>
			<th align="center" width="10">����</th>
		</tr>
		<?php
		$k = 0;
		for($i = 0,$n = count($rows); $i < $n; $i++) {
			$row = &$rows[$i];

			$row->cat_link = 'index2.php?option=com_categories&task=editA&hidemainmenu=1&id='.$row->catid;

			if($acl->acl_check('administration','manage','users',$my->usertype,'components','com_users')) {
				if($row->created_by_alias) {
					$author = $row->created_by_alias;
				} else {
					$linkA = 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='.$row->created_by;
					$author = '<a href="'.$linkA.'" title="�������� ������ ������������">'.$row->author.'</a>';
				}
			} else {
				if($row->created_by_alias) {
					$author = $row->created_by_alias;
				} else {
					$author = $row->author;
				}
			}

			$date = mosFormatDate($row->created,'%x');
?>
			<tr class="<?php echo "row$k"; ?>">
				<td><?php echo $pageNav->rowNumber($i); ?></td>
				<td width="20"><?php echo mosHTML::idBox($i,$row->id); ?></td>
				<td><?php echo $row->title; ?></td>
				<td align="center" colspan="2">
					<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<td>
					<a href="<?php echo $row->cat_link; ?>" title="�������� ���������">
						<?php echo $row->name; ?>
					</a>
				</td>
				<td><?php echo $author; ?></td>
				<td><?php echo $date; ?></td>
			</tr>
			<?php
			$k = 1 - $k;
		}
?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $section->id; ?>" />
		<input type="hidden" name="task" value="showarchive" />
		<input type="hidden" name="returntask" value="showarchive" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
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
	function editContent(&$row,$section,&$lists,&$sectioncategories,&$images,&$params,$option,$redirect,&$menus) {
		global $database,$mosConfig_disable_image_tab,$mosConfig_one_editor;
		mosMakeHtmlSafe($row);
		$nullDate = $database->getNullDate();
		$create_date = null;
		if($row->created != $nullDate) {
			$create_date = mosFormatDate($row->created,'%d %B %Y %H:%M','0');
		}
		$mod_date = null;
		if($row->modified != $nullDate) {
			$mod_date = mosFormatDate($row->modified,'%d %B %Y %H:%M','0');
		}
		$tabs = new mosTabs(1);
		// used to hide "Reset Hits" when hits = 0
		if(!$row->hits) {
			$visibility = "style='display: none; visibility: hidden;'";
		} else {
			$visibility = '';
		}
		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadCalendar();
?>
		<script language="javascript" type="text/javascript">
		<!--
		var sectioncategories = new Array;
<?php
		$i = 0;
		foreach($sectioncategories as $k => $items) {
			foreach($items as $v) {
				echo "sectioncategories[".$i++."] = new Array( '$k','".addslashes($v->id)."','".addslashes($v->name)."' );\t";
			}
		}
?>
<?php
		// ���������� ������� "�����������"
		if(!$mosConfig_disable_image_tab) { ?>
			var folderimages = new Array;
<?php
			$i = 0;
			foreach($images as $k => $items) {
				foreach($items as $v) {
					echo "folderimages[".$i++."] = new Array( '$k','".addslashes(ampReplace($v->value))."','".addslashes(ampReplace($v->text))."' );\t";
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
	if(!$mosConfig_disable_image_tab) {
?>
			var temp = new Array;
				for (var i=0, n=form.imagelist.options.length; i < n; i++) {
					temp[i] = form.imagelist.options[i].value;
				}
				form.images.value = temp.join( '\n' );
<?php } ?>
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
				<?php getEditorContents('editor1','introtext'); ?>
				<?php if(!$mosConfig_one_editor) getEditorContents('editor2','fulltext'); ?>
				<?php getEditorContents('editor3','notetext'); ?>
				submitform( pressbutton );
			}
		}
		function ch_apply(){
			var form = document.adminForm;
			SRAX.get('tb-apply').className='tb-load';
			<?php getEditorContents('editor1','introtext'); ?>
			<?php if(!$mosConfig_one_editor) getEditorContents('editor2','fulltext'); ?>
			<?php getEditorContents('editor3','notetext'); ?>
<?php
	// ���������� ������� "�����������"
	if(!$mosConfig_disable_image_tab) {
?>
			var temp = new Array;
				for (var i=0, n=form.imagelist.options.length; i < n; i++) {
					temp[i] = form.imagelist.options[i].value;
				}
				form.images.value = temp.join( '\n' );
<?php } ?>
			dax({
				url: 'ajax.index.php?option=com_content&task=apply',
				id:'publ-1',
				method:'post',
				form: 'adminForm',
				callback:
					function(resp){
						log('������� �����: ' + resp.responseText);
						mess_cool(resp.responseText);
						SRAX.get('tb-apply').className='tb-apply';
			}});
		}
		function ch_metakey(){
			<?php getEditorContents('editor1','introtext'); ?>
			<?php if(!$mosConfig_one_editor){?><?php getEditorContents('editor2','fulltext'); ?> <?php };?>
			<?php getEditorContents('editor3','notetext'); ?>
			dax({
				url: 'ajax.index.php?option=com_content&task=metakey',
				id:'publ-1',
				method:'post',
				form: 'adminForm',
				callback:
					function(resp){
						log('������� �����: ' + resp.responseText);
						SRAX.get('metakey').value = (resp.responseText);
			}});
		}
		function ntreetoggle(){
			if(SRAX.get('ncontent').style.display =='none'){
				SRAX.get('ncontent').style.display ='block';
				SRAX.get('ncontent').style.width ='410px';
				SRAX.get('tdtoogle').className='tdtoogleon';
			}else{
				SRAX.get('ncontent').style.display ='none';
				SRAX.get('tdtoogle').className='tdtoogleoff';
			}
		}
		function x_resethits(){
			id = SRAX.get('id').value;
			dax({
				url: 'ajax.index.php?option=com_content&task=resethits&id='+id,
				id:'resethits',
				method:'post',
				callback:
					function(resp){
						log('������� �����: ' + resp.responseText);
						mess_cool(resp.responseText);
						SRAX.get('count_hits').innerHTML='0';
			}});
		}
		//-->
		</script>
		<table class="adminheading">
		<tr><th class="edit">����������: <small><?php echo $row->id ? '��������������':'��������'; ?></small></th></tr>
		</table>
		<form action="index2.php" method="post" name="adminForm" id="adminForm">
		<table class="adminform" cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td width="100%" valign="top">
				<table width="100%" class="adminform" style="width:100%;" id="adminForm">
				<tr>
					<td width="100%">
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
						<tr>
							<th colspan="4">������ �������</th>
						</tr>
						<tr>
							<td width="15">���������:</td>
							<td width="50%">
								<input class="text_area" type="text" name="title" size="30" maxlength="255" style="width:99%" value="<?php echo $row->title; ?>" />
							</td>
							<td width="15">������������:</td>
							<td width="50%"><?php echo mosHTML::yesnoRadioList('published','',$row->state);?></td>
						</tr>
						<tr>
							<td width="15">���������:</td>
							<td width="50%">
								<input name="title_alias" type="text" class="text_area" id="title_alias" value="<?php echo $row->title_alias; ?>" size="30" style="width:99%" maxlength="255" />
							</td>
							<td width="15">�� �������:</td>
							<td width="50%"><?php echo mosHTML::yesnoRadioList('frontpage','',$row->frontpage ? 1:0);?></td>
						</tr>
						<tr>
							<td width="15">������:</td>
							<td width="50%"><?php echo $lists['sectionid']; ?></td>
							<td width="15">���������:</td>
							<td width="50%"><?php echo $lists['catid']; ?></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="100%">
						<?php echo $mosConfig_one_editor ? '':'������� �����: (�����������)'; ?>
						<div id="intro_text"><?php editorArea('editor1',$row->introtext,'introtext','99%;','350','75','30'); ?></div>
					</td>
				</tr>
				<?php if(!$mosConfig_one_editor){?>
				<tr>
					<td width="100%">
						�������� �����: (�������������)
						<div id="full_text"><?php editorArea('editor2',$row->fulltext,'fulltext','99%;','400','75','30'); ?></div>
					</td>
				</tr>
				<?php };?>
				<tr>
					<td width="100%">
						�������: (�������������)
						<div id="note_text"><?php editorArea('editor3',$row->notetext,'notetext','99%;','150','75','10'); ?></div>
					</td>
				</tr>
				</table>
			</td>
			<td onclick="ntreetoggle();" width="1" id="tdtoogle" class="tdtoogleon">
				<img border="0" alt="������ ������ ����������" src="images/tgl.gif" />
			</td>
			<td valign="top" id="ncontent">
				<img src="images/con_pix.gif" width="410px;">
				<table class="adminform">
				<tr>
					<th>
					<table class="adminform">
						<tr>
							<th>���������</th>
						</tr>
					</table>
					</th>
				</tr>
				<tr>
				<td>
				<table width="100%">
				<tr>
					<td><strong>���������:</strong></td>
					<td><?php echo $row->state > 0?'������������':($row->state < 0?'� ������':'�������� - �� �����������'); ?></td>
				</tr>
				<tr <?php echo $visibility; ?>>
					<td><strong>����������:</strong></td>
					<td id="count_hits">
						<?php echo $row->hits; ?>&nbsp;&nbsp;&nbsp;<input name="reset_hits" type="button" class="button" value="��������" onclick="return x_resethits();" />
					</td>
				</tr>
				<tr>
					<td><strong>����������:</strong></td>
					<td><?php echo $row->version; ?> ���</td>
				</tr>
				<tr>
					<td><strong>�������:</strong></td>
					<td><?php echo $create_date ? $create_date : '����� ��������';?></td>
				</tr>
				<tr>
					<td><strong>��������� ���������:</strong></td>
					<td><?php echo $mod_date ? $mod_date.$row->modifier : '�� ����������';?></td>
				</tr>
			</table>
<?php
		$tabs->startPane("content-pane");
		$tabs->startTab("����������","publish-page");
?>
			<table width="100%" class="adminform">
					<tr>
						<td valign="top" align="right">������� �������:</td>
						<td><?php echo $lists['access']; ?></td>
					</tr>
					<tr>
						<td valign="top" align="right">��������� ������:</td>
						<td>
							<input type="text" name="created_by_alias" style="width:90%" size="30" maxlength="100" value="<?php echo $row->created_by_alias; ?>" class="text_area" />
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">�����:</td>
						<td><?php echo $lists['created_by']; ?></td>
					</tr>
					<tr>
						<td valign="top" align="right">�������:</td>
						<td><?php echo $lists['ordering']; ?></td>
					</tr>
					<tr>
						<td valign="top" align="right">���� ��������:</td>
						<td>
							<input class="text_area" type="text" name="created" id="created" size="25" maxlength="19" value="<?php echo $row->created; ?>" />
							<input name="reset" type="reset" class="button" onclick="return showCalendar('created', 'y-mm-dd');" value="..." />
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">������ ����������:</td>
						<td>
							<input class="text_area" type="text" name="publish_up" id="publish_up" size="25" maxlength="19" value="<?php echo $row->publish_up; ?>" />
							<input type="reset" class="button" value="..." onclick="return showCalendar('publish_up', 'y-mm-dd');" />
						</td>
					</tr>
					<tr>
						<td valign="top" align="right">��������� ����������:</td>
						<td>
							<input class="text_area" type="text" name="publish_down" id="publish_down" size="25" maxlength="19" value="<?php echo $row->publish_down; ?>" />
							<input type="reset" class="button" value="..." onclick="return showCalendar('publish_down', 'y-mm-dd');" />
						</td>
					</tr>
				</table>
				<br />
				<table class="adminform">
<?php
	if($row->id) {
?>
					<tr>
						<td><strong>ID �������:</strong></td>
						<td><?php echo $row->id; ?></td>
					</tr>
<?php
		}
?>
			</table>
<?php
		$tabs->endTab();
		// ���������� ������� "�����������"
		if(!$mosConfig_disable_image_tab) {
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
										<?php echo $lists['imagefiles']; ?>
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
										<?php echo $lists['imagelist']; ?>
										<br />
										<input class="button" type="button" value="�����" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,-1)" />
										<input class="button" type="button" value="����" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,+1)" />
									</div>
								</td>
							</tr>
							</table>
							��������: <?php echo $lists['folders']; ?>
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
								<td align="right">��������:</td>
								<td><input style="width:99%" class="text_area" type="text" name= "_source" value="" /></td>
							</tr>
							<tr>
								<td align="right">������������:</td>
								<td><?php echo $lists['_align']; ?></td>
							</tr>
							<tr>
								<td align="right">�������������� �����:</td>
								<td><input style="width:99%" class="text_area" type="text" name="_alt" value="" /></td>
							</tr>
							<tr>
								<td align="right">�����:</td>
								<td><input class="text_area" type="text" name="_border" value="" size="3" maxlength="1" /></td>
							</tr>
							<tr>
								<td align="right">�������:</td>
								<td><input class="text_area" type="text" name="_caption" value="" size="30" /></td>
							</tr>
							<tr>
								<td align="right">������� �������:</td>
								<td><?php echo $lists['_caption_position']; ?></td>
							</tr>
							<tr>
								<td align="right">������������ �������:</td>
								<td><?php echo $lists['_caption_align']; ?></td>
							</tr>
							<tr>
								<td align="right">������ �������:</td>
								<td><input class="text_area" type="text" name="_width" value="" size="5" maxlength="5" /></td>
							</tr>
							<tr>
								<td colspan="2"><input class="button" type="button" value="���������" onclick="applyImageProps()" /></td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
<?php
		$tabs->endTab();
		} else
		echo '<input type="hidden" name="images" id="images" value="" />';
		$tabs->startTab("���������","params-page");
?>
					<table class="adminform">
					<tr>
						<td>
						* ��� ��������� ��������� ������� ����� ������ � ������ ������� ���������*
						<br />
						</td>
					</tr>
					<tr>
						<td><?php echo $params->render(); ?></td>
					</tr>
					</table>
<?php
		$tabs->endTab();
		$tabs->startTab("����������","metadata-page");
?>
					<table class="adminform">
					<tr>
						<td>�������� (Description):
						<br />
						<textarea class="text_area" cols="60" rows="8" style="width:98%" name="metadesc"><?php echo str_replace('&','&amp;',$row->metadesc); ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
						�������� ����� (Keywords)
						<br />
						<textarea class="text_area" cols="60" rows="8" style="width:98%" name="metakey" id="metakey"><?php echo str_replace('&','&amp;',$row->metakey); ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
						<input type="button" class="button" value="�������� (������, ���������, ���������)" onclick="f=document.adminForm;f.metakey.value=document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].text+', '+getSelectedText('adminForm','catid')+', '+f.title.value+f.metakey.value;" />
						<input type="button" class="button" value="�������������"onclick="return ch_metakey();" />
						</td>
					</tr>
					<tr>
						<td>��������� ���������� ��������: <br /><?php echo $lists['robots'] ?></td>
					</tr>
				</table>
<?php
		$tabs->endTab();
		$tabs->startTab("����� � ����","link-page");
?>
			<table class="adminform">
				<tr>
					<td colspan="2">����� ��������� ����� ���� (������ - ������ �����������), ������� ����������� � ��������� �� ������ ����</td>
				</tr>
				<tr>
					<td valign="top" width="90">�������� ����</td>
					<td><?php echo $lists['menuselect']; ?></td>
				</tr>
				<tr>
					<td valign="top" width="90">�������� ������ ����</td>
					<td><input style="width:90%" type="text" name="link_name" class="text_area" value="" size="30" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input name="menu_link" type="button" class="button" value="������� � ����" onclick="submitbutton('menulink');" /></td>
				</tr>
				<tr>
					<th colspan="2">������������ ������ ����</th>
				</tr>
<?php
		if($menus == null) {
?>
				<tr>
					<td colspan="2">�����������</td>
				</tr>
<?php
		} else {
			mosCommonHTML::menuLinksContent($menus);
		}
?>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
<?php
		$tabs->endTab();
		$tabs->endPane();
?>
				</td>
			</tr>
		</table>
		</tr>
		</td>
		</table>
		<input type="hidden" name="id" id="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="version" value="<?php echo $row->version; ?>" />
		<input type="hidden" name="mask" value="0" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="images" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php

	}


	/**
	* Form to select Section/Category to move item(s) to
	* @param array An array of selected objects
	* @param int The current section we are looking at
	* @param array The list of sections and categories to move to
	*/
	function moveSection($cid,$sectCatList,$option,$sectionid,$items) {
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
		foreach($items as $item) {
			echo "<li>".$item->title."</li>";
		}
		echo "</ol>";
?>
			</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>" />
		<input type="hidden" name="task" value="" />
		<?php
		foreach($cid as $id) {
			echo "\n<input type=\"hidden\" name=\"cid[]\" value=\"$id\" />";
		}
?>
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php
	}


	/**
	* Form to select Section/Category to copys item(s) to
	*/
	function copySection($option,$cid,$sectCatList,$sectionid,$items) {
?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
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
		foreach($items as $item) {
			echo "<li>".$item->title."</li>";
		}
		echo "</ol>";
?>
			</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>" />
		<input type="hidden" name="task" value="" />
		<?php
		foreach($cid as $id) {
			echo "\n<input type=\"hidden\" name=\"cid[]\" value=\"$id\" />";
		}
?>
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
		<?php
	}
	function submit($params){
		mosCommonHTML::loadOverlib();
		echo $params->render(null);
	}
}
?>
