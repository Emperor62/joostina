<?php /**
 * @package Joostina
 * @copyright Авторские права (C) 2008-2010 Joostina team. Все права защищены.
 * @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
 * Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
 * Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
 */

// запрет прямого доступа
defined('_VALID_MOS') or die(); ?>
<!--Страница категории:BEGIN-->
<div class="category_page<?php echo $sfx; ?>">
    <!--Заголовок страницы:BEGIN-->
    <?php if($page_title) { ?>
    <div class="componentheading"><h1><?php echo $page_title; ?></h1></div>
        <?php } ?>

    <!--Основное содержимое страницы:BEGIN-->
    <div class="contentpane<?php echo $sfx; ?>">

        <!--Описание:BEGIN-->
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
        <!--Описание:END-->
        <!--Таблица с содержимым при просмотре категории:BEGIN-->

        <?php //Подключаем шаблон вывода таблицы с записями
        include_once (JPATH_BASE.'/components/com_content/view/item/table_of_items/default.php');
        ?>

        <!--Таблица с содержимым при просмотре категории:END-->
        <!--Кнопка добавления содержимого-->
        <?php if($add_button) { ?>
        <div class="add_button"><?php echo $add_button; ?></div>
            <?php } ?>
        <!--Список категорий раздела:BEGIN-->
        <?php if($show_categories) {
            include_once (JPATH_BASE.'/components/com_content/view/category/show_categories/default.php');
            //ContentView :: showCategories($params, $items, $gid, $other_categories, $catid, $id, $Itemid);
        } ?>
        <!--Список категорий раздела:END-->
        <?php mosHTML::BackButton($params); ?>
        <!--Основное содержимое страницы:END-->
    </div>
    <!--Страница категории:END-->
</div>