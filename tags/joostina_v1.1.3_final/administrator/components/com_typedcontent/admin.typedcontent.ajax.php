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

switch($task){
	case "publish":
		$img = x_publish($id);
		echo '<img src="'.$mosConfig_live_site.'/administrator/images/'.$img.'" width="12" height="12" border="0" alt="" />';
		return ;
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
?>
