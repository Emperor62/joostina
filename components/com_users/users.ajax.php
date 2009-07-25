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



$task	= mosGetParam($_REQUEST,'task','');
$id		= $my->id;

switch($task) {
	case 'upload_avatar':
		echo upload_avatar();
		return;

	case 'del_avatar':
		echo x_delavatar();
		return;

    case 'request_from_plugin':
        request_from_plugin();
        break;

	default:
		echo 'error-task';
		return;
}

 function upload_avatar(){
        global $database, $my, $mosConfig_absolute_path;
        $id = intval(mosGetParam($_REQUEST,'id',0));
        
        mosMainFrame::addLib('images');
        
        $return = array();

        $resize_options = array(
                'method' => '0',        //�������� � �������� ������, �������� ���������.
                'output_file' => '',    //���� 'thumb', �� ����������� ����� ����� � �������� "thumb'
                'width'  => '150',
                'height' => '150'
        );

        $file = new Image();
        $file->field_name = 'avatar';
        $file->directory = 'images/avatars' ;
        $file->file_prefix = 'av_';
        $file->max_size = 0.5 * 1024 * 1024;

        $foto_name = $file->upload($resize_options);

        if($foto_name){
            if($id){
                $user = new mosUser($database);
                $user->load((int)$id);
                $user_id = $user->id;
                if($user->avatar!=''){
                    $foto = new Image();
                    $foto->directory = 'images/avatars';
                    $foto->name = $user->avatar;
                    $foto->delFile($foto);
                }
                $user->update_avatar($id, $foto_name);
            }

            echo $foto_name;

        }else{
            return false;
        };
    }


function x_delavatar(){
	global $database;
	$file_name = mosGetParam($_REQUEST,'file_name','');
	
	$user = new mosUser($database);
	$user->update_avatar(null, $file_name, 1);
	
	echo 'none.jpg';
}


function  request_from_plugin(){
    global $mosConfig_absolute_path;

    $plugin	= mosGetParam($_REQUEST,'plugin','');
    $act	= mosGetParam($_REQUEST,'act','');

    // ���������, ����� ���� ���������� ����������, ������ ������� �� ���������� GET �������
    if(file_exists($mosConfig_absolute_path . "/mambots/profile/$plugin/$plugin.ajax.php")) {
	    include_once ($mosConfig_absolute_path . "/mambots/profile/$plugin/$plugin.ajax.php");
    } else {
	    die('error-1');
    }
}
?>
