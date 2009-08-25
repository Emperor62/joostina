<?php /**
 * @package Joostina
 * @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
 * @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
 * Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
 * ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
 */

// ������ ������� �������
defined('_VALID_MOS') or die(); ?>
<!--�������� ���������:BEGIN-->
<div class="category_page<?php echo $sfx; ?>">
	<!--��������� ��������:BEGIN-->
<?php if($page_title) { ?>
	<div class="componentheading"><h1><?php echo $page_title; ?></h1></div>
<?php } ?>

	<!--�������� ���������� ��������:BEGIN-->
	<div class="contentpane<?php echo $sfx; ?>">
	
	<!--��������:BEGIN-->
<?php if($title_description || $title_image) { ?>
		<div class="contentdescription">
<?php if($title_image) { ?>
			<div class="desc_img"><?php echo $title_image; ?></div>
<?php } ?>
<?php if($title_description) { ?>
			<p><?php echo $title_description; ?></p>
<?php } ?>
		</div>
<?php } ?>
	<!--��������:END-->
	<!--������� � ���������� ��� ��������� ���������:BEGIN-->
<?php if($items) {
	//���������� ������ ������ ������� � ��������
	include_once (Jconfig::getInstance()->config_absolute_path.'/components/com_content/view/item/table_of_items/default.php');
} elseif($catid) { ?>
	<br />
	<?php echo _EMPTY_CATEGORY; ?>
	<br /><br />
<?php } ?>
	<!--������� � ���������� ��� ��������� ���������:END-->
	<!--������ ���������� �����������-->
<?php if($add_button) { ?>
	<div class="add_button"><?php echo $add_button; ?></div>
<?php } ?>
	<!--������ ��������� �������:BEGIN-->
<?php if($show_categories) {
	include_once (Jconfig::getInstance()->config_absolute_path.'/components/com_content/view/category/show_categories/default.php');
	//HTML_content :: showCategories($params, $items, $gid, $other_categories, $catid, $id, $Itemid);
} ?>
	<!--������ ��������� �������:END-->
	<?php mosHTML::BackButton($params); ?>
	<!--�������� ���������� ��������:END-->
	</div>
<!--�������� ���������:END-->
</div>