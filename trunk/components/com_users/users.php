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

global $my, $task, $option;

userHelper::_load_core_js();
?>
<script type="text/javascript">
	var _comuser_url = '<?php echo $mosConfig_live_site;?>/components/com_users';
	var _comuser_ajax_handler = 'ajax.index.php?option=com_users';
	var _comuser_defines = new Array();
</script>
<?php

// Editor usertype check
$access = new stdClass();
$access->canEdit = $acl->acl_check('action','edit','users',$my->usertype,'content','all');
$access->canEditOwn = $acl->acl_check('action','edit','users',$my->usertype,'content','own');

require_once ($mainframe->getPath('front_html'));
require_once ($mainframe->getPath('config','com_users'));
require_once ($mainframe->getPath('class'));

$config = &Jconfig::getInstance();

$uid = intval(mosGetParam( $_REQUEST, 'user', 0 ));

switch($task) {
	case 'edit';
	case 'UserDetails':
		userEdit($option,$my->id,_UPDATE);
		break;

	case 'saveUserEdit':
		// check to see if functionality restricted for use as demo site
		if($_VERSION->RESTRICT == 1) {
			mosRedirect('index.php?mosmsg='._RESTRICT_FUNCTION);
		} else {
			userSave($option,$my->id);
		}
		break;

	case 'CheckIn':
		CheckIn($my->id,$access,$option);
		break;

	case 'cancel':
		mosRedirect('index.php?option=com_users&task=profile&user='.mosGetParam( $_REQUEST, 'id', 0 ));
		break;

	case 'profile':
		$cache = &mosCache::getCache('user_profile');
		$_view = strval(mosGetParam( $_REQUEST, 'view', '' ));
		$r = $cache->call('profile',$uid,$_view);
		echo $r['content'];
		mosMainFrame::getInstance()->SetPageTitle($r['title']);
		break;

	case 'lostPassword':
		if($config->config_frontend_login != null && ($config->config_frontend_login === 0 || $config->config_frontend_login=== '0')) {
			echo _NOT_AUTH;
			return;
		}
		lostPassForm($option);
		break;

	case 'sendNewPass':
		if($config->config_frontend_login != null && ($config->config_frontend_login === 0 || $config->config_frontend_login=== '0')) {
			echo _NOT_AUTH;
			return;
		}
		sendNewPass($option);
		break;

	case 'register':
		if($config->config_frontend_login != null && ($config->config_frontend_login === 0 || $config->config_frontend_login=== '0')) {
			echo _NOT_AUTH;
			return;
		}
		registerForm($option,$config->config_useractivation);
		break;

	case 'saveRegistration':
		if($config->config_frontend_login != null && ($config->config_frontend_login === 0 || $config->config_frontend_login=== '0')) {
			echo _NOT_AUTH;
			return;
		}
		saveRegistration();
		break;

	case 'activate':
		if($config->config_frontend_login != null && ($config->config_frontend_login === 0 || $config->config_frontend_login=== '0')) {
			echo _NOT_AUTH;
			return;
		}
		activate($option);
		break;
		
	case 'userlist':
		$cache = &mosCache::getCache('user_lists');
		$gid = intval(mosGetParam($_GET,'group',0));
		$limit = intval(mosGetParam($_REQUEST,'limit',null));
		$limitstart = intval(mosGetParam($_REQUEST,'limitstart',0));
		$cache->call('userList',$gid,$limit,$limitstart);
		break;

	default:
		HTML_user::frontpage();
		break;
}

function profile($uid){

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	$row = new mosUser($database);
	if($row->load($uid)){
		//�������������� ���������� � ������������
		$row->user_extra = $row->get_user_extra();

		$file = $mainframe->getPath('com_xml','com_users');
		$params = &new mosUserParameters($row->params,$file,'component');

		$config = new configUser_profile($database);
		$config->set('title',sprintf($config->get('title'),$row->name));
		$title = $config->get('title');

		ob_start();
			HTML_user::profile($row,'com_users', $params, $config);
			$content_boby = ob_get_contents(); // ������� ���������� - ���� ������ ���������� - mainbody
		ob_end_clean();
		return array('content' => $content_boby, 'title' => $title);
	}else{
		return _USER_NOT_FOUND;
	}

}

function userEdit($option,$uid,$submitvalue) {

	$mainframe = &mosMainFrame::getInstance();
	$database = &database::getInstance();

	if($uid == 0) {
		mosNotAuth();
		return;
	}
	$user = new mosUser($database);
	$user->load((int)$uid);
	$user->orig_password = $user->password;

	$user->name = trim($user->name);
	$user->email = trim($user->email);
	$user->username = trim($user->username);

	$file = $mainframe->getPath('com_xml','com_users');
	$params = &new mosUserParameters($user->params,$file,'component');

	$user_extra = new userUsersExtra($database);
	$user_extra->load((int)$uid);
	$user->user_extra = $user_extra;

	$user_config = new configUser_profile($database);

	HTML_user::userEdit($user,$option,$submitvalue,$params, $user_config);
}

function userSave($option,$uid) {
	global $my;

	// simple spoof check security
	josSpoofCheck();

	$config = &Jconfig::getInstance();
	$database = &database::getInstance();

	$user_id = intval(mosGetParam($_POST,'id',0));

	// do some security checks
	if($uid == 0 || $user_id == 0 || $user_id != $uid) {
		mosNotAuth();
		return;
	}

	$row = new mosUser($database);
	$row->load((int)$user_id);

	$orig_password = $row->password;
	$orig_USER = $row->username;

	if(!$row->bind($_POST,'gid usertype')) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$row->name = trim($row->name);
	$row->email = trim($row->email);
	$row->username = trim($row->username);

	mosMakeHtmlSafe($row);

	if(isset($_POST['password']) && $_POST['password'] != '') {
		if(isset($_POST['verifyPass']) && ($_POST['verifyPass'] == $_POST['password'])) {
			$row->password = trim($row->password);
			$salt = mosMakePassword(16);
			$crypt = md5($row->password.$salt);
			$row->password = $crypt.':'.$salt;
		} else {
			echo "<script> alert(\"".addslashes(_PASS_MATCH)."\"); window.history.go(-1); </script>\n";
			exit();
		}
	} else {
		// Restore 'original password'
		$row->password = $orig_password;
	}

	if($config->config_frontend_userparams == '1' || $config->config_frontend_userparams == 1 || $config->config_frontend_userparams == null) {
		// save params
		$params = mosGetParam($_POST,'params','');
		if(is_array($params)) {
			$txt = array();
			foreach($params as $k => $v) {
				$txt[] = "$k=$v";
			}
			$row->params = implode("\n",$txt);
		}
	}
	if(!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if(!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}

	$user_extra = new userUsersExtra($database);
	$ret = $user_extra->load((int)$user_id);
	if(!$user_extra->bind($_POST)) {
		echo "<script> alert('".$user_extra->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$user_extra->birthdate  = $_POST['birthdate_year'].'-'.$_POST['birthdate_month'].'-'.$_POST['birthdate_day'].' 00:00:00';

	if(!$ret){
		$user_extra->insert($user_id);
	}

	$user_extra->store();

	// check if username has been changed
	if($orig_USER != $row->username) {
		// change username value in session table
		$query = "UPDATE #__session"
				."\n SET username = ".$database->Quote($row->username)
				."\n WHERE username = ".$database->Quote($orig_USER)
				."\n AND userid = ".(int)$my->id
				."\n AND gid = ".(int)$my->gid
				."\n AND guest = 0";
		$database->setQuery($query);
		$database->query();
	}
	
	mosRedirect('index.php?option=com_users&task=UserDetails', '�� ������');

	//userEdit($option,$my->id,_UPDATE);
}

function userList($gid,$limit,$limitstart=0){

	$database = &database::getInstance();
	$mainframe = &mosMainFrame::getInstance();
	$acl = &gacl::getInstance();

	if(isset($mainframe->menu)){
		$menu = $mainframe->menu;
	}else{
		$link = 'index.php?option=com_users&task=userlist';
		if($gid){
			$link = 'index.php?option=com_users&task=userlist&group='.$gid;
		}
		$menu = new mosMenu($database);
		$menu = $menu->getMenu(false, 'userlist', $link);
	}

	$params = new mosParameters($mainframe->menu->params);

	$usertype = $acl->get_group_name($params->get('group', 0));
	$limit = $limit ? $limit : $params->get('limit',20);

	$template = 'default.php';
	$template_dir = 'components'.DS.'com_users'.DS.'view'.DS.'userlist';

	if($params->get('template')){
		$template = $params->get('template');
	}elseif($params->get('group', 0)){
		$template = strtolower(str_replace(' ', '', $usertype )).'.php';
	}

	if($params->get('template_dir')){
		$template_dir = 'templates'.DS. $mainframe->getTemplate() .DS.'html'.DS.'com_users'.DS.'userlist';
	}
	$template_file = $mainframe->getCfg('absolute_path').DS.$template_dir.DS.$template;

	$users = new mosUser($database);
	
	//���������� ������
	if(is_file($template_file)){
		include_once($template_file);
	}
}

function CheckIn($userid,$access) {

	$database = &database::getInstance();
	$config = &Jconfig::getInstance();

	$nullDate = $database->getNullDate();
	if(!($access->canEdit || $access->canEditOwn || $userid > 0)) {
		mosNotAuth();
		return;
	}

	// security check to see if link exists in a menu
	$link = 'index.php?option=com_users&task=CheckIn';
	$query = "SELECT id"
			."\n FROM #__menu"
			."\n WHERE link LIKE '%$link%'"
			."\n AND published = 1";
	$database->setQuery($query);
	$exists = $database->loadResult();
	if(!$exists) {
		mosNotAuth();
		return;
	}

	$lt = mysql_list_tables($config->config_db);
	$k = 0;
	echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">";
	while(list($tn) = mysql_fetch_array($lt)) {
		// only check in the jos_* tables
		if(strpos($tn,$database->_table_prefix) !== 0) {
			continue;
		}
		$lf = mysql_list_fields($config->config_db,"$tn");
		$nf = mysql_num_fields($lf);

		$checked_out = false;
		$editor = false;

		for($i = 0; $i < $nf; $i++) {
			$fname = mysql_field_name($lf,$i);
			if($fname == "checked_out") {
				$checked_out = true;
			} else
				if($fname == "editor") {
					$editor = true;
				}
		}

		if($checked_out) {
			if($editor) {
				$query = "SELECT checked_out, editor"
						."\n FROM `$tn`"
						."\n WHERE checked_out > 0"
						."\n AND checked_out = ".(int)$userid;
				$database->setQuery($query);
			} else {
				$query = "SELECT checked_out"
						."\n FROM `$tn`"
						."\n WHERE checked_out > 0"
						."\n AND checked_out = ".(int)$userid;
				$database->setQuery($query);
			}
			$res = $database->query();
			$num = $database->getNumRows($res);

			if($editor) {
				$query = "UPDATE `$tn`"
						."\n SET checked_out = 0, checked_out_time = ".$database->Quote($nullDate).", editor = NULL"
						."\n WHERE checked_out > 0"
						."\n AND checked_out = ".(int)$userid;
				$database->setQuery($query);
			} else {
				$query = "UPDATE `$tn`"
						."\n SET checked_out = 0, checked_out_time = ".$database->Quote($nullDate)
						."\n WHERE checked_out > 0"
						."\n AND checked_out = ".(int)$userid;
				$database->setQuery($query);
			}
			$res = $database->query();

			if($res == 1) {
				if($num > 0) {
					echo "\n<tr class=\"row$k\">";
					echo "\n\t<td width=\"250\">";
					echo _CHECK_TABLE;
					echo " - $tn</td>";
					echo "\n\t<td>";
					echo _CHECKED_IN;
					echo "<b>$num</b>";
					echo _CHECKED_IN_ITEMS;
					echo "</td>";
					echo "\n</tr>";
				}
				$k = 1 - $k;
			}
		}
	}
?>
	<tr>
		<td colspan="2">
			<b><?php echo _CONF_CHECKED_IN; ?></b>
		</td>
	</tr>
	</table>
<?php
}

/* ����� �������������� ������ */
function lostPassForm($option) {
	
	$mainframe = &mosMainFrame::getInstance();
	$mainframe->SetPageTitle(_PROMPT_PASSWORD);	
	
	$config = &JConfig::getInstance();
	$database = &database::getInstance();
	
	$user_config = new configUser_lostpass($database);	
	
	//������
	$template = $user_config->get('template');
	$template_dir = 'components/com_users/view/lostpass';
		
	if($user_config->get('template_dir')){
		$template_dir = 'templates'.DS. $mainframe->getTemplate() . '/html/com_users/lostpass';
	}
	$template_file = $mainframe->getCfg('absolute_path').DS.$template_dir.DS.$template;
	
	if(is_file($template_file)){
		include_once ($template_file);	
	}
}

function sendNewPass() {
	josSpoofCheck();

	$database = &database::getInstance();
	$config = &Jconfig::getInstance();

	$checkusername = stripslashes(mosGetParam($_POST,'checkusername',''));
	$confirmEmail = stripslashes(mosGetParam($_POST,'confirmEmail',''));

	if($config->config_captcha_reg) {
		session_start();
		$captcha = strval(mosGetParam($_POST, 'captcha', null));
		$captcha_keystring =mosGetParam($_SESSION,'captcha_keystring');
		if($captcha_keystring!== $captcha) {
			unset($_SESSION['captcha_keystring']);
			mosRedirect('index.php?option=com_users&task=lostPassword',_BAD_CAPTCHA_STRING);
			exit;
		}
		session_unset();
		session_write_close();
	}

	$query = "SELECT id FROM #__users WHERE username = ".$database->Quote($checkusername)." AND email = ".$database->Quote($confirmEmail);
	$database->setQuery($query);
	if(!($user_id = $database->loadResult()) || !$checkusername || !$confirmEmail) {
		mosRedirect("index.php?option=com_users&task=lostPassword",_ERROR_PASS);
	}

	echo $newpass = mosMakePassword();
	$message = _NEWPASS_MSG;
	eval("\$message = \"$message\";");
	$subject = _NEWPASS_SUB;
	eval("\$subject = \"$subject\";");

	mosMail($config->config_mailfrom,$config->config_fromname,$confirmEmail,$subject,$message);

	$salt = mosMakePassword(16);
	$crypt = md5($newpass.$salt);
	$newpass = $crypt.':'.$salt;
	$sql = "UPDATE #__users SET block = 0, password = ".$database->Quote($newpass)." WHERE id = ".(int)$user_id;
	$database->setQuery($sql);
	if(!$database->query()) {
		die("SQL error".$database->stderr(true));
	}

	mosRedirect('index.php',_NEWPASS_SENT);
}

function registerForm($option,$useractivation) {

	$database = &database::getInstance();
	$mainframe = &mosMainFrame::getInstance();
	$acl = &gacl::getInstance();
	
	if(!$mainframe->getCfg('allowUserRegistration')) {
		mosNotAuth();
		return;
	}

	session_start();

	$params = new configUser_registration($database);
	
	$type = mosGetParam( $_REQUEST, 'type', '' );
	$gid = $params->get('gid');	

	$mainframe->SetPageTitle($params->get('title'));

	//���������� ������ ��� ������ ��������������� �����
	$template = 'default.php';
	
	if(!$params->get('template')){		
		if($type){
			if(is_file($mainframe->getCfg('absolute_path').DS.'components'.DS.'com_users'.DS.'view'.DS.'registration'.DS.$type.'.php')){
				$template = $type.'.php';
			}
			$gid = $acl->get_group_id($type,'ARO');
		}
	}
	$gid_check = mosHash($gid);

	// used for spoof hardening
	$validate = josSpoofValue();

	include ($mainframe->getCfg('absolute_path').DS.'components'.DS.'com_users'.DS.'view'.DS.'registration'.DS.$template);

}

function saveRegistration() {

	josSpoofCheck();

	$database = &database::getInstance();
	$mainframe = &mosMainFrame::getInstance();
	$acl = &gacl::getInstance();

	if($mainframe->getCfg('allowUserRegistration') == 0) {
		mosNotAuth();
		return;
	}

	$params = new configUser_registration($database);

	if($mainframe->getCfg('captcha_reg')) {
		session_start();
		$captcha = strval(mosGetParam($_POST, 'captcha', null));
		$captcha_keystring =mosGetParam($_SESSION,'captcha_keystring');
		if($captcha_keystring!== $captcha) {
			unset($_SESSION['captcha_keystring']);
			mosRedirect('index.php?option=com_users&task=register',_BAD_CAPTCHA_STRING);
			exit;
		}
		session_unset();
		session_write_close();
	}

	$row = new mosUser($database);

	if(!$row->bind($_POST,'usertype')) {
		mosErrorAlert($row->getError());
	}

	$row->name = trim($row->name);
	$row->email = trim($row->email);
	$row->username = trim($row->username);
	$row->password = trim($row->password);

	mosMakeHtmlSafe($row);

	$row->id = 0;
	
	//���������� ������ ������������
	//���� � ���������� ����������� ������� ������������� ������ �������� - ����� ����� ������ �� �������� ����
	//��������������� �����
	//���� ������������ ������ ������ - ������ ����� �� ������� �����������.
	if(!$params->get('template')){
		$row->gid = $_POST['gid'];			
	}
	else{
		$row->gid = $params->get('gid');	
	}
	//���������, �� ��������� �� ������ "�� ����"
	$gid_md5 = $_POST['gid_check'];
	
	if($gid_md5 != md5($GLOBALS['mosConfig_secret'].md5($row->gid))){ 
		mosErrorAlert('Go home, stuppid hacker!');
	}
		
	$row->usertype = $acl->get_group_name($row->gid,'ARO');

	if($mainframe->getCfg('useractivation') == 1) {
		$row->activation = md5(mosMakePassword());
		$row->block = '1';
	}

	if(!$row->check()) {
		echo "<script> alert('".html_entity_decode($row->getError())."'); window.history.go(-1); </script>\n";
		exit();
	}

	$pwd = $row->password;

	$salt = mosMakePassword(16);
	$crypt = md5($row->password.$salt);
	$row->password = $crypt.':'.$salt;
	
	$row->registerDate = date('Y-m-d H:i:s');

	if(!$row->store()) {
		echo "<script> alert('".html_entity_decode($row->getError())."'); window.history.go(-1); </script>\n";
		exit();
	}
	//$row->id = $database->insertid();
	$row->checkin();

	$email_info = array();
	$email_info['name']		= trim($row->name);
	$email_info['email']	= trim($row->email);
	$email_info['username']	= trim($row->username);

	//�������������� ������ ������������
	$email_info['subject'] = sprintf(_SEND_SUB, $email_info['name'], $mainframe->getCfg('sitename'));
	$email_info['subject'] = html_entity_decode($email_info['subject'], ENT_QUOTES);

	if($mainframe->getCfg('useractivation') == 1 ) {
		$email_info['message'] = sprintf(_USEND_MSG_ACTIVATE, $email_info['name'],
							$mainframe->getCfg('sitename'),
							$mainframe->getCfg('live_site')."/index.php?option=com_users&task=activate&activation=".$row->activation,
							$mainframe->getCfg('live_site'),
							$email_info['username'], $pwd);
	} else {
		$email_info['message'] = sprintf(_USEND_MSG,$email_info['name'],$mainframe->getCfg('sitename'),$mainframe->getCfg('live_site'));
	}
	$email_info['message'] = html_entity_decode($email_info['message'],ENT_QUOTES);

	if($mainframe->getCfg('mailfrom') != '' && $mainframe->getCfg('fromname') != '') {
		$email_info['adminName'] = $mainframe->getCfg('fromname');
		$email_info['adminEmail'] = $mainframe->getCfg('mailfrom');
	} else {
		// use email address and name of first superadmin for use in email sent to user
		$query = "SELECT name, email FROM #__users WHERE LOWER( usertype ) = 'superadministrator' OR LOWER( usertype ) = 'super administrator'";
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		$row2 = $rows[0];
		$email_info['adminName'] = $row2->name;
		$email_info['adminEmail'] = $row2->email;
	}

	// �������� ������������ ������ ������ � ������, ���� �� �������� "��������� ���������������"
	if(!$params->get('admin_activation')){
		$row->send_mail_to_user($email_info);
	}


	// �������������� ������ ��������������� �����
	$email_info['subject'] = sprintf(_SEND_SUB, $email_info['name'],$mainframe->getCfg('sitename'));
	$email_info['message'] = sprintf(_ASEND_MSG, $email_info['adminName'],$mainframe->getCfg('sitename'), $row->name, $email_info['email'],$email_info['username']);
	$email_info['subject'] = html_entity_decode($email_info['subject'],ENT_QUOTES);
	$email_info['message'] = html_entity_decode($email_info['message'],ENT_QUOTES);
	//���������� ������
	$row->send_mail_to_admins($email_info);



	if($mainframe->getCfg('useractivation') == 1) {

		$msg = _REG_COMPLETE_ACTIVATE;
		if($params->get('admin_activation')){
			$msg = _WAIT_ACTIVATION;
		}

		if($params->get('redirect_url')){
			mosRedirect($params->get('redirect_url'), $msg);
		}

		//���������� ������
		$template = 'default.php';

		//���� � ���������� ��������� ����������� ������ �������������
		//������ �������� ��� ������ ����� ������������� -
		//��� ����������� �������� ��������� ����� � ������� ������ ��������
		//���� ������ ��� ������ �� ������ - ���������� ����������� ������
		if(!$params->get('template')){
			$group_name = $acl->get_group_name($row->gid,'ARO');
			if($group_name){
				if(!is_file($mainframe->getCfg('absolute_path').DS.'components'.DS.'com_users'.DS.'view'.DS.'after_registration'.DS.$group_name.'.php')){
					$template = $group_name.'.php';
				}
			}
		}

		include ($mainframe->getCfg('absolute_path').DS.'components'.DS.'com_users'.DS.'view'.DS.'after_registration'.DS.$template);
		return;

	}
	else {
		$msg = _REG_COMPLETE;
		//$mainframe->login($row->username,$row->password,0,$row->id);
		mosRedirect('index.php?option=com_users&task=profile&user='.$row->id, $msg);
	}
}

function activate() {
	global $my;

	$database = &database::getInstance();
	$mainframe = &mosMainFrame::getInstance();

	if($my->id) {
		mosRedirect('index.php');
	}

	if($mainframe->getCfg('allowUserRegistration') == '0' || $mainframe->getCfg('useractivation') == '0') {
		mosNotAuth();
		return;
	}

	$activation = stripslashes(mosGetParam($_REQUEST,'activation',''));

	if(empty($activation)) {
		echo _REG_ACTIVATE_NOT_FOUND;
		return;
	}

	$query = "SELECT id FROM #__users WHERE activation = ".$database->Quote($activation)." AND block = 1";
	$database->setQuery($query);
	$result = $database->loadResult();

	if($result) {
		$query = "UPDATE #__users SET block = 0, activation = '' WHERE activation = ".$database->Quote($activation)." AND block = 1";
		$database->setQuery($query);
		if(!$database->query()) {
			if(!defined(_REG_ACTIVATE_FAILURE)) {
				DEFINE('_REG_ACTIVATE_FAILURE',_USER_ACTIVATION_FAILED);
			}
			echo _REG_ACTIVATE_FAILURE;
		} else {
			if($mainframe->getCfg('auto_activ_login') == 1) {
				$user = new mosUser($database);
				if($user->load($result)) {
					$_POST['remember'] = 1;
					$mainframe->login($user->username,$user->password);
					mosRedirect( 'index.php', _REG_ACTIVATE_COMPLETE );
				}
			} else {
				echo _REG_ACTIVATE_COMPLETE;
			}
		}
	} else {
		echo _REG_ACTIVATE_NOT_FOUND;
	}
}