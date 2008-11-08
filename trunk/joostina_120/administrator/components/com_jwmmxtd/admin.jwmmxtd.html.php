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

global $mosConfig_live_site,$mainframe,$task;

class HTML_mmxtd {
// ����������� ����������� �������� ��������
	function show_dir($path,$dir,$listdir) {
		if($listdir) {
			$link = 'index2.php?option=com_jwmmxtd&amp;curdirectory='.$listdir."/".$path;
			$count = HTML_mmxtd::num_files($listdir."/".$path);
		} else {
			$link = 'index2.php?option=com_jwmmxtd&amp;curdirectory='."/".$path;
			$count = HTML_mmxtd::num_files('/'.$path);
		}
		$num_files = $count[0];
		$num_dir = $count[1];
?>
<div class="folder_style">
<table cellpadding="0" cellspacing="0">
	<tr>
		<td class="filename" colspan="2"><h2><?php echo substr($dir,0,20).(strlen($dir) > 20?'...':''); ?></h2></td>
	</tr>
	<tr>
		<td class="fileinfo">
			���������: <?php echo $num_dir; ?><br />
			������: <?php echo $num_files; ?>
		</td>
		<td class="fileactions">
			<a href="javascript:void(null)" onclick="javascript:document.adminForm.selectedfile.value='<?php echo $path ?>';document.adminForm.subtask.value='renamefile';document.adminForm.submit( );" title="�������������">
			<img src="images/ico/rename.png" alt="�������������" title="�������������" /></a>
			<a href="javascript:void(null)" onclick="javascript:document.adminForm.selectedfile.value='<?php echo $path ?>';document.adminForm.subtask.value='copyfile';document.adminForm.submit( );" title="����������">
			<img src="images/ico/copy.png" alt="����������" title="����������" /></a>
			<a href="javascript:void(null)" onclick="javascript:document.adminForm.selectedfile.value='<?php echo $path ?>';document.adminForm.subtask.value='movefile';document.adminForm.submit( );" title="�����������">
			<img src="images/ico/cut.png" alt="�����������" title="�����������" /></a>
			<a href="index2.php?option=com_jwmmxtd&amp;task=deletefolder&amp;delFolder=<?php echo $path; ?>&amp;curdirectory=<?php echo $listdir; ?>" onclick="return deleteFolder('<?php echo $dir; ?>', <?php echo $num_files; ?>);" title="�������">
			<img src="images/ico/delete.png" alt="�������" title="�������" /></a>
		</td>
	</tr>
</table>
<div style="text-align:center;margin:2px auto;"> <a href="<?php echo $link; ?>"><img src="components/com_jwmmxtd/images/folder.gif" /></a> </div>
</div>
<?php
	}
// ������� �������
	function parse_size($size) {
		if($size < 1024) {
			return $size.' ����';
		} else
			if($size >= 1024 && $size < 1024* 1024) {
				return sprintf('%01.2f',$size / 1024.0).' ��';
			} else {
				return sprintf('%01.2f',$size / (1024.0* 1024)).' ��';
			}
	}
// ����� �����������
	function show_image($img,$file,$info,$size,$listdir) {
		$img_file = basename($img);
		$img_url_link = JWMMXTD_STARTURLPATH.$listdir."/".rawurlencode($img_file);
		$cur = $listdir;
		$filesize = HTML_mmxtd::parse_size($size);
		if(($info[0] > 200) || ($info[1] > 200)) {
			$img_dimensions = HTML_mmxtd::imageResize($info[0],$info[1],200);
		} else {
			$img_dimensions = 'style="width:'.$info[0].'px;height:'.$info[1].'px; margin:4px auto;display:block;"';
		}
?>
<div class="image_style">
<table cellpadding="0" cellspacing="0">
		<tr>
			<td class="filename" colspan="2">
				<h2><a href="<?php echo $img_url_link; ?>" title="<?php echo $file; ?>" rel="lightbox[jwmmxtd-title]">
				<?php echo htmlspecialchars(substr($file,0,20).(strlen($file) > 20?'...':''),ENT_QUOTES); ?></a></h2>
			</td>
		</tr>
		<tr>
			<td class="fileactions">
				<a href="index2.php?option=com_jwmmxtd&task=edit&curdirectory=<?php echo $cur; ?>&img=<?php echo $img_file; ?>" title="�������������">
				<img src="images/ico/picture_edit.png" alt="�������������" title="�������������" /></a>
				<a href="#" onclick="javascript:document.adminForm.selectedfile.value='<?php echo $file ?>';document.adminForm.subtask.value='renamefile';document.adminForm.submit( );" title="�������������">
				<img src="images/ico/rename.png" alt="�������������" title="�������������" /></a>
				<a href="#" onclick="javascript:document.adminForm.selectedfile.value='<?php echo $file ?>';document.adminForm.subtask.value='copyfile';document.adminForm.submit( );" title="����������">
				<img src="images/ico/copy.png" alt="����������" title="����������" /></a>
				<a href="#" onclick="javascript:document.adminForm.selectedfile.value='<?php echo $file ?>';document.adminForm.subtask.value='movefile';document.adminForm.submit( );" title="�����������">
				<img src="images/ico/cut.png" alt="�����������" title="�����������" /></a>
				<a href="index2.php?option=com_jwmmxtd&amp;task=delete&amp;delFile=<?php echo $file; ?>&amp;curdirectory=<?php echo $cur; ?>" onclick="javascript:if(confirm('������� ����:<?php echo $file; ?>')) return true; return false;" title="�������">
				<img src="images/ico/delete.png" alt="�������" title="�������" /></a>
			</td>
		</tr>
</table>
<div class="fileimage"> <a href="<?php echo $img_url_link; ?>" rel="lightbox[jwmmxtd]" title="����:<br /><?php echo $file; ?>" alt="������� ��� ���������">
	<img src="<?php echo $img_url_link; ?>?ok=ok" <?php echo $img_dimensions; ?> alt="������� ��� ���������" title="������� ��� ���������" /></a>
</div>
������: <?php echo $filesize; ?><br />
������: <?php echo $info[0]; ?>px, ������: <?php echo $info[1]; ?>px
</div>
<?php
	}
// ������� ����� ������
	function num_files($dir) {
		$total_file = 0;
		$total_dir = 0;
		$dir = JWMMXTD_STARTABSPATH.$dir;
		if(is_dir($dir)) {
			$d = dir($dir);

			while(false !== ($entry = $d->read())) {
				if(substr($entry,0,1) != '.' && is_file($dir.DIRECTORY_SEPARATOR.$entry) &&
					strpos($entry,'.html') === false && strpos($entry,'.php') === false) {
					$total_file++;
				}
				if(substr($entry,0,1) != '.' && is_dir($dir.DIRECTORY_SEPARATOR.$entry)) {
					$total_dir++;
				}
			}

			$d->close();
		}

		return array($total_file,$total_dir);
	}
// ����������� ����������
	function show_doc($doc,$size,$listdir,$icon) {
		$size = HTML_mmxtd::parse_size($size);
		$doc_url_link = JWMMXTD_STARTURLPATH.$listdir."/".rawurlencode($doc);
		$cur = $listdir;
?>

<div class="file_style">
<table cellpadding="0" cellspacing="0">
	<tr>
		<td class="filename" colspan="2"><h2><?php echo htmlspecialchars(substr($doc,0,14).(strlen($doc) > 14?'...':''),ENT_QUOTES); ?></h2></td>
	</tr>
	<tr>
		<td class="fileinfo"><?php echo $size; ?></td>
		<td class="fileactions">
<?php
// �����
if($icon == "../images/icons/zip.png") { ?>
		<a href="#" onclick="javascript:document.adminForm.selectedfile.value='<?php echo $doc ?>';document.adminForm.subtask.value='unzipfile';document.adminForm.submit( );" title="�����������">
		<img src="components/com_jwmmxtd/images/compress.png" alt="�����������" title="�����������" /></a>
<?php } ?>
			<a href="#" onclick="javascript:document.adminForm.selectedfile.value='<?php echo $doc ?>';document.adminForm.subtask.value='renamefile';document.adminForm.submit( );" title="�������������">
			<img src="images/ico/rename.png" alt="�������������" title="�������������" /></a>
			<a href="#" onclick="javascript:document.adminForm.selectedfile.value='<?php echo $doc ?>';document.adminForm.subtask.value='copyfile';document.adminForm.submit( );" title="����������">
			<img src="images/ico/copy.png" alt="����������" title="����������" /></a>
			<a href="#" onclick="javascript:document.adminForm.selectedfile.value='<?php echo $doc ?>';document.adminForm.subtask.value='movefile';document.adminForm.submit( );" title="�����������">
			<img src="images/ico/cut.png" alt="�����������" title="�����������" /></a>
			<a href="index2.php?option=com_jwmmxtd&amp;task=delete&amp;delFile=<?php echo $doc; ?>&amp;curdirectory=<?php echo $cur; ?>" onclick="javascript:if(confirm('������� ����: <?php echo $doc; ?>')) return true; return false;" title="�������">
			<img src="images/ico/delete.png" alt="�������" title="�������" /></a>
		</td>
	</tr>
</table>
<div class="fileimage">
<?php
	// ���� - ���� flv
	if($icon == "../images/icons/flv.png") {
?>
	<a href="components/com_jwmmxtd/js/flvplayer.swf?file=<?php echo $doc_url_link; ?>&amp;autostart=true&amp;allowfullscreen=true" rel="vidbox 800 600" title="����� ����:<br /><?php echo $doc; ?>" alt="������� �� ������ ��� ���������">
	<img src="<?php echo $icon ?>" alt="<?php echo $doc; ?>" title="������� �� ������ ��� ���������" /></a>
<?php
	// ���� - ���� swf
	} elseif($icon == "../images/icons/swf.png") {
		$swfinfo = @getimagesize($doc_url_link);
?>
	<a href="<?php echo $doc_url_link; ?>" rel="vidbox <?php echo $swfinfo[0]; ?> <?php echo $swfinfo[1]; ?>" title="����:</b><br /><?php echo $doc; ?>" alt="������� �� ������ ��� ���������">
	<img src="<?php echo $icon ?>" alt="<?php echo $doc; ?>" title="������� �� ������ ��� ���������" /></a>
<?php
	} else {
?>
	<img src="<?php echo $icon ?>" alt="<?php echo $doc; ?>" />
<?php
	}
?>
</div>
</div>
<?php
	}
// ������ � ����������� ������� �����������
	function imageResize($width,$height,$target) {
		if($width > $height) {
			$percentage = ($target / $width);
		} else {
			$percentage = ($target / $height);
		}
		$width = round($width* $percentage);
		$height = round($height* $percentage);
		return 'width="'.$width.'" height="'.$height.'"';

	}
}
?>
