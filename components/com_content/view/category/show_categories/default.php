<?php /**
 * @package Joostina
 * @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
 * @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
 * Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
 * ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
 */

// ������ ������� �������
defined('_VALID_MOS') or die(); ?>
<?php
if(!count($other_categories)){
	return;
}
?>
<ul class="cat_list">
<?php foreach ($other_categories as $row) {
	$row->name = htmlspecialchars(stripslashes(ampReplace($row->name)), ENT_QUOTES);
	if($catid != $row->id) { ?>
	<li>
<?php if($row->access <= $gid) {
		$link = sefRelToAbs('index.php?option=com_content&amp;task=category&amp;sectionid='.$row->section.'&amp;id='.$row->id.'&amp;Itemid='.$Itemid); ?>
		<a href="<?php echo $link; ?>" class="category" title="<?php echo $row->name; ?>"><?php echo $row->name; ?></a>
<?php if($params->get('cat_items')) { ?>
			&nbsp;<i>( <?php echo $row->numitems._CHECKED_IN_ITEMS; ?> )</i>
<?php } ?>
<?php if($params->get('cat_description') && $row->description) { ?>
	<br />
	<?php echo $row->description; ?>
<?php } ?>
<?php } else { ?>
<?php echo $row->name; ?>
		<a href="<?php echo sefRelToAbs('index.php?option=com_registration&amp;task=register'); ?>">( <?php echo _E_REGISTERED; ?> )</a>
<?php } ?>
	</li>
	<?php }
} ?>
</ul>