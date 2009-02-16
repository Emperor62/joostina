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


global $mosConfig_absolute_path,$mosConfig_live_site,$my;
/* ���� �� �������������� ���������� */
if(!$my->id) exit;

$task	= mosGetParam( $_GET, 'task', 'publish');
$id		= intval(mosGetParam( $_GET, 'id', '0'));

// ������������ ���������� �������� task
switch($task){
	case "publish":
		$img = x_publish($id);
		echo '<img src="'.$mosConfig_live_site.'/administrator/images/'.$img.'" width="12" height="12" border="0" alt="" />';
		return ;
	case "frontpage":
		$img = x_frontpage($id);
		echo '<img src="'.$mosConfig_live_site.'/administrator/images/'.$img.'" width="12" height="12" border="0" alt="" />';
		return;
	case "x_save":
		echo x_save($id);
		return;
	case "x_rustypo":
		echo x_RusTypo();
		return;
	default:
		echo '$task not found';
		return;
}

/* ������� ���������� ����������� ����������
$id - ������������� �����������
*/
function x_save($id){
	global $database,$my;
	$introtext	= mosGetParam( $_POST, 'introtext', 'none',_MOS_ALLOWRAW);
	$fulltext	= '<br />'.mosGetParam( $_POST, 'fulltext', 'none',_MOS_ALLOWRAW);
	// ������������ �� ������� � cp1251
	$introtext = joostina_api::convert($introtext);
	$fulltext = '222';
	$query = "UPDATE #__content"
	. "\n SET introtext = '" . $introtext . "'"
	. "\n WHERE id = ". (int) $id." AND ( checked_out = 0 OR (checked_out = " . (int) $my->id . ") )";
	$database->setQuery( $query );
	$text = gmdate( 'H:i:s (d.m.y)' );
	if (!$database->query()) {
		$text = 'error'.$database->getErrorMsg().'<br />';
	}
	return $text;
}

function x_RusTypo(){
	global $database;
	$introtext	= mosGetParam( $_POST, 'introtext', 'none',_MOS_ALLOWRAW);
	$introtext	= mosStripslashes( $introtext );
	// ������������ �� ������� � cp1251
	$introtext = joostina_api::convert($introtext);
	// ����������� �� �������� "������� �����������"
	$introtext = joostina_api::RusTypo($introtext);
	// ������� ������������ � utf-8
	$introtext = joostina_api::convert($introtext,1);
	// ��������� ����� ��������� ��� ����� ��� � �������
	header("Content-type: text/html; charset=utf-8");
	return $introtext;
}


/* ���������� �������
$id - ������������� �������
 */
function x_publish($id=null){
	global $database,$my;
	// id ����������� ��� ��������� �� ������� - ����� ������	
	if(!$id) return '������������� �� �������.';

	$state = new stdClass();
	$query = "SELECT state, publish_up, publish_down"
	. "\n FROM #__content "
	. "\n WHERE id = " . (int) $id;
	$database->setQuery( $query );
	$row = $database->loadobjectList();
	$row = $row['0'];// ��������� ������� � ���������� ��������� ��������

	$now = _CURRENT_SERVER_TIME;
	$nullDate = $database->getNullDate();
	$ret_img = '';// ���� ���� ����������� ������ ���������� ���� ������� ���������	
	if ( $now <= $row->publish_up && $row->state == 1 ) {
		// ������� � ����������, ������������, �� ��� �� ��������  - ���������� ������ "��������������"
		$ret_img = 'publish_x.png';
		$state = '0'; // ���� ������������ - ������� � ����������
	} elseif( $now <= $row->publish_up && $row->state == 0 ) {
		// ������� � ����������, �� ������������, � ��� �� ��������  - ���������� ������ "�� �������"
		$ret_img = 'publish_y.png';
		$state = '1'; /* �� ���� ������������ - ��������� */
	} else if ( ( $now <= $row->publish_down || $row->publish_down == $nullDate ) && $row->state == 1 ) {
		// �������� � ������������, ������� � ���������� � ���������� ������ "�� ������������"
		$ret_img = 'publish_x.png';
		$state = '0'; // ���� ������������ - ������� � ����������
	} else if ( ( $now <= $row->publish_down || $row->publish_down == $nullDate ) && $row->state == 0 ) {
		// �������� � ������������, ������� � ���������� � ���������� ������ "�� ������������"
		$ret_img = 'publish_g.png';
		$state = '1'; /* �� ���� ������������ - ��������� */
	} else if ( $now > $row->publish_down && $row->state == 1 ) {
		// ������������, �� ���� ���������� ����, ������� � ���������� � ���������� ������ "�� ������������"
		$ret_img = 'publish_x.png';
		$state = '0'; /* �� ���� ������������ - ��������� */
	} else if ( $now > $row->publish_down && $row->state == 0 ) {
		// ������������, �� ���� ���������� ����, ������� � ���������� � ���������� ������ "�� ������������"
		$ret_img = 'publish_r.png';
		$state = '1'; /* �� ���� ������������ - ��������� */
	}
	
	$query = "UPDATE #__content"
	. "\n SET state = " . (int) $state . ", modified = " . $database->Quote( date( 'Y-m-d H:i:s' ) )
	. "\n WHERE id = " .$id. " AND ( checked_out = 0 OR (checked_out = " . (int) $my->id . ") )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
		return 'error!';
	}else{
		return $ret_img;
	}
}
/* ���������� ������� �� �������(������) ��������
$id - ������������� �����������
 */
function x_frontpage($id){
	global $mainframe,$database;
	require_once( $mainframe->getPath( 'class', 'com_frontpage' ) );

	$fp = new mosFrontPage( $database );
		if ($fp->load( $id )) {
			if (!$fp->delete( $id )) {
				$ret_img = 'error!';
			}
			$fp->ordering = 0;
			$ret_img = 'publish_x.png';
		} else {
			$query = "INSERT INTO #__content_frontpage"
			. "\n VALUES ( " . (int) $id . ", 0 )"
			;
			$database->setQuery( $query );
			if (!$database->query()) {
				$ret_img = 'error!';
			}
			$fp->ordering = 0;
			$ret_img = 'tick.png';
		}
		$fp->updateOrder();
	return $ret_img;
	mosCache::cleanCache( 'com_content' ); // �������� ��� �������
}

?>
