<?php
/**
 * @package Joostina
 * @copyright Авторские права (C) 2008-2010 Joostina team. Все права защищены.
 * @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
 * Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
 * Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
 */

// запрет прямого доступа
defined('_VALID_MOS') or die();

global $my;

// при любых действиях будем чистить кэш меню панели управления
js_menu_cache_clear();


$task = mosGetParam($_POST, 'task', false);
$id = intval(mosGetParam($_GET, 'id', '0'));

$obj_id = intval(mosGetParam($_POST, 'obj_id', false));

switch ($task) {

    case 'publish':
        echo x_publish($obj_id);
        return;

    case 'access':
        echo x_access($id);
        return;

    case 'get_sec':
        echo x_get_sections($id);
        return;

    case 'save_sec':
        echo x_save_sections($id);
        return;

    case 'apply':
        echo x_apply();
        return;
        
    default:
        echo 'error-task';
        return;
}

/**
 * Saves the catefory after an edit form submit
 * @param string The name of the category section
 */
function x_apply() {
    josSpoofCheck();

    $database = database::getInstance();

    $redirect = strval(mosGetParam($_POST, 'redirect', ''));
    $oldtitle = stripslashes(strval(mosGetParam($_POST, 'oldtitle', null)));

    $row = new mosCategory($database);

    if (!$row->bind($_POST, 'folders')) return 'error-bind';
    $row->title = addslashes($row->title);
    $row->name = addslashes($row->name);

    // handling for MOSImage directories
    if ($row->section > 0) {
        $folders = mosGetParam($_POST, 'folders', array());
        $folders = implode(',', $folders);

        if (strpos($folders, '*2*') !== false) {
            $folders = '*2*';
        } else
        if (strpos($folders, '*1*') !== false) {
            $folders = '*1*';
        } else
        if (strpos($folders, '*0*') !== false) {
            $folders = '*0*';
        } else
        if (strpos($folders, ',*#*') !== false) {
            $folders = str_replace(',*#*', '', $folders);
        } else
        if (strpos($folders, '*#*,') !== false) {
            $folders = str_replace('*#*,', '', $folders);
        } else
        if (strpos($folders, '*#*') !== false) {
            $folders = str_replace('*#*', '', $folders);
        }

        $row->params = 'imagefolders=' . $folders;
    }

    if (!$row->check()) return 'error-check';
    if (!$row->store()) return 'error-store';
    if (!$row->checkin()) return 'error-checkin';

    $row->updateOrder("section = " . $database->Quote($row->section));

    if ($oldtitle) {
        if ($oldtitle != $row->title) {
            $query = "UPDATE #__menu SET name = " . $database->Quote($row->title) . " WHERE name = " .
                    $database->Quote($oldtitle) . "\n AND type = 'content_category'";
            $database->setQuery($query);
            $database->query();
        }
    }

    // Update Section Count
    if ($row->section != 'com_contact_details' && $row->section != 'com_newsfeeds') {
        $query = "UPDATE #__sections SET count=count+1 WHERE id = " . $database->Quote($row->section);
        $database->setQuery($query);
    }
    if (!$database->query()) return 'error-update';

    if ($redirect == 'content') {
        // clean any existing cache files
        mosCache::cleanCache('com_content');
    }
    return _CATEGORY_CHANGES_SAVED;
}

function x_save_sections($id) {
    global  $my;

    $database = database::getInstance();

    $new_section = intval(mosGetParam($_GET, 'new_sec', 0));
    $query = "UPDATE #__categories SET section = '" . $new_section . "' WHERE id = " . $id . " AND ( checked_out = 0 OR ( checked_out = " . (int) $my->id . " ) )";
    $database->setQuery($query);
    if (($database->query()) AND (_update_content($id, $new_section))) {
        $row = new mosSection($database);
        $row->load((int) $new_section);
        return '<a href="javascript: ch_get_sec(' . $id . ',' . $new_section . ');" onclick="ch_get_sec(' . $id . ',' . $new_section . ');">' . $row->title . '</a>';
    } else {
        return 'error-db'; // ошибка
    }
}

// обновление идентификаторов разделов
function _update_content($id, $new_section) {
    $database = database::getInstance();

    $query = "UPDATE #__content SET sectionid = '" . $new_section . "' WHERE catid = " . $id . " ";
    $database->setQuery($query);
    if ($database->query()) {
        return TRUE;
    }
    return FALSE;
}

function x_get_sections($id) {
    $database = database::getInstance();

    $sectionid = intval(mosGetParam($_GET, 'cur_sec', 0));
    $javascript = 'onchange="ch_save_sec(' . $id . ',this.value)"';

    $query = "SELECT id AS value, title AS text"
            . "\n FROM #__sections"
            . "\n WHERE published = 1"
            . "\n ORDER BY title";
    $database->setQuery($query);
    return mosHTML::selectList($database->loadObjectList(), 'sectionid', 'class="inputbox" size="1" ' . $javascript, 'value', 'text', $sectionid);
}

function x_access($id) {
    $database = database::getInstance();
    
    $access = mosGetParam($_GET, 'chaccess', 'accessregistered');
    $option = strval(mosGetParam($_REQUEST, 'option', ''));

    switch ($access) {
        case 'accesspublic':
            $access = 0;
            break;
        case 'accessregistered':
            $access = 1;
            break;
        case 'accessspecial':
            $access = 2;
            break;
        default:
            $access = 0;
            break;
    }

    $row = new mosCategory($database);
    $row->load((int) $id);
    $row->access = $access;

    if (!$row->check()) return 'error-check';
    if (!$row->store()) return 'error-store';

    if (!$row->access) {
        $color_access = 'style="color: green;"';
        $task_access = 'accessregistered';
        $text_href = _USER_GROUP_ALL;
    } elseif($row->access == 1) {
        $color_access = 'style="color: red;"';
        $task_access = 'accessspecial';
        $text_href = _USER_GROUP_REGISTERED;
    } else {
        $color_access = 'style="color: black;"';
        $task_access = 'accesspublic';
        $text_href = _USER_GROUP_SPECIAL;
    }
    
    // чистим кэш
    mosCache::cleanCache('com_content');
    return '<a href="#" onclick="ch_access(' . $row->id . ',\'' . $task_access . '\',\'' . $option . '\')" ' . $color_access . '>' . $text_href . '</a>';
}

/**
 *
 * @global <type> $my
 * @param <type> $id
 * @return <type>
 */
function x_publish($id = null) {
    $database = database::getInstance();

    if (!$id) return 'error-id';

    $cat = new mosCategory($database);
    $cat->load($id);

    // пустой объект для складирования результата
    $return_onj = new stdClass();

    // меняем состояние объекта на противоположное
    if ( $cat->changeState('published')) {
        // формируем ответ из противоположных элементов текущему состоянию
        $return_onj->image = $cat->published ?  'publish_x.png' : 'publish_g.png';
        $return_onj->mess = $cat->published ?  _UNPUBLISHED : _PUBLISHED;
        mosCache::cleanCache('com_content');
    } else {
        // формируем резульлтат с ошибкой
        $return_onj->image = 'error.png';
        $return_onj->mess = 'error-class';
    }
    return json_encode($return_onj);
}