<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2007 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

global $JPConfiguration,$option,$mosConfig_live_site,$mosConfig_absolute_path;

$WSOutdir = $JPConfiguration->isOutputWriteable();

$appStatusGood = true;
if(!($WSOutdir)) {
	$appStatusGood = false;
}

// ���������� � ��������� ������
echo colorizeAppStatus($appStatusGood);
?>

<table class="adminheading">
	<tr>
		<th class="cpanel">��������� �����������</th>
	</tr>
</table>
<table>
	<tr>
		<td width="40%" valign="top">
			<div class="cpicons">
<?php
	$link = "index2.php?option=com_joomlapack&act=pack";
	quickiconButton($link,'pack.png', '������� ����� ������');

	$link = 'index2.php?option=com_joomlapack&act=db';
	quickiconButton($link,'db.png','���������� ����� ������');

	$link = "index2.php?option=com_joomlapack&act=def";
	quickiconButton($link,'stopfolder.png', '�� ��������� ��������');

	$link = "index2.php?option=com_joomlapack&act=config";
	quickiconButton($link,'config.png', '��������� ����������');

	$link = "index2.php?option=com_joomlapack&act=log";
	quickiconButton($link,'log.png', '��� ���������� ��������');
?>
				</div>
			<div style="clear:both;">&nbsp;</div>
		</td>
		<td valign="top">
		<?php
		require_once ($mosConfig_absolute_path.'/administrator/components/com_joomlapack/includes/html.files.php');
		?>
		</td>
	</tr>
</table>

<?php

/**
* ����� ��������� ��������� ������
*/
function colorizeAppStatus($status) {
	global $JPConfiguration;
	$statusVerbal = '���������� ������, ��������� ����������� ������ � ������� �������� ��������� ����� ( <b>'.$JPConfiguration->OutputDirectory.'</b> )';
	if(!$status) {
		return '<div class="jwarning">'.$statusVerbal.'</div>';
	}
}
// ���������� ������ ����������
function quickiconButton($link,$image,$text) {
?>
	<span>
		<a href="<?php echo $link; ?>" title="<?php echo $text; ?>">
<?php
			echo mosAdminMenus::imageCheckAdmin($image,'/administrator/images/',null,null,$text);
			echo $text;
?>
		</a>
	</span>
	<?php
}
?>
