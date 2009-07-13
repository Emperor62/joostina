<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

$params_aray = array( //-------------------------------�������� ���������
	'moduleclass_sfx' => $params->get('moduleclass_sfx'), //������� ������ ������
	'all_user' => $params->get('all_user'), //���������� ���������� ������������������ �������������
	'online_user_count' => $params->get('online_user_count'), //������������ online
	'online_users' => $params->get('online_users'), //��� online
	'user_avatar' => $params->get('user_avatar'), //������� �������������
	'module_orientation' => $params->get('module_orientation'), //���������� ������
);

$output = '';

display_module($params_aray);

unset($params_aray);

function display_module($params_aray) {
	echo '<div class="mod_who_online">';

	if($params_aray['all_user']) {
		$all_user = '<span>'._REGISTERED_USERS_COUNT.':</span> ' . all_user();
	} else {
		$all_user = '';
	}

	if($params_aray['online_user_count'] !== '2') {
		$count_online = '<span>Online:</span> ' . online_users($params_aray);
	} else {
		$count_online = '';
	}

	if($params_aray['online_users']) {
		$online_users = who_online($params_aray);
	} else {
		$online_users = '';
	}

	if($params_aray['module_orientation'] == '0') { //�������������� �����
		echo '<div class="mod_who_online_info">';
		echo $all_user;
		echo '&nbsp;&nbsp;';
		echo $count_online;
		echo '</div>';
		echo $online_users;

	} else { //������������ �����
		echo $all_user;
		echo '<br />';
		echo $count_online;
		echo '<br />';
		echo $online_users;

	}
	echo '</div>';

}

function online_users($params_aray) {
	global $database;
	$output = '';
	$query = "SELECT guest, usertype FROM #__session";
	$database->setQuery($query);
	$sessions = $database->loadObjectList();

	// calculate number of guests and members
	$user_array = 0;
	$guest_array = 0;
	foreach($sessions as $session) {
		// if guest increase guest count by 1
		if($session->guest == 1 && !$session->usertype) {
			$guest_array++;
		}
		// if member increase member count by 1
		if($session->guest == 0) {
			$user_array++;
		}
	}
	if($params_aray['online_user_count'] == '0') {
		$itogo = $guest_array + $user_array;
		return $itogo;
	}
	// check if any guest or member is on the site
	if($guest_array != 0 || $user_array != 0) {
		// guest count handling
		if($guest_array == 1) {
			// 1 guest only
			$output .= sprintf(_GUEST_COUNT, $guest_array);
		} else
			if($guest_array > 1) {
				// more than 1 guest
				$output .= sprintf(_GUESTS_COUNT, $guest_array);
			}

		// if there are guests and members online

		if($guest_array != 0 && $user_array != 0) {
			$output .= _AND;
		}

		// member count handling
		if($user_array == 1) {
			// 1 member only
			$output .= sprintf(_MEMBER_COUNT, $user_array);
		} else
			if($user_array > 1) {
				// more than 1 member
				$output .= sprintf(_MEMBERS_COUNT, $user_array);
			}

		$output .= _ONLINE;
	}

	return $output;
}


function who_online($params_aray) {
	global $database, $mosConfig_live_site;
	$output = '';
	$query = "SELECT  a.username, a.userid, b.name, b.id FROM #__session AS a, #__users AS b WHERE a.guest = 0 AND a.userid=b.id";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	if(count($rows)) {

		if($params_aray['module_orientation'] == '1') {
			$dop_class = "gorizontal";
		} else {
			$dop_class = "vertical";
		}

		// output
		$output .= '<ul class="users_online ' . $dop_class . '">';

		foreach($rows as $row) {
			if($params_aray['online_users'] == '1') {
				$user_name = $row->username;
			} else {
				$user_name = $row->name;
			}
			$user_link = 'index.php?option=com_users&amp;task=Profile&amp;user=' . $row->userid;
			$user_seflink = '<a href="' . sefRelToAbs($user_link) . '">' . $user_name . '</a>';
			$avatar = '<img id="user_avatar_img" src="' . $mosConfig_live_site . mosUser::avatar($row->userid, 'mini') . '" alt="' . $user_name . '"/>';
			$avatar_link = '<a href="' . sefRelToAbs($user_link) . '">' . $avatar . '</a>';
			if($params_aray['user_avatar'] == '1') {
				$user_item = $avatar_link . $user_seflink;
			} else
				if($params_aray['user_avatar'] == '2') {
					$user_item = $avatar_link;
				} else {
					$user_item = $user_seflink;
				}

				$output .= '<li>';
			$output .= $user_item;
			$output .= '</li>';
		}
		$output .= '</ul>';
	}
	return $output;
}


function all_user() {
	global $database;

	$q = "SELECT COUNT(id) FROM #__users WHERE block = '0' ";
	$database->setQuery($q);
	$row = $database->loadResult();

	return $row;
}




?>
