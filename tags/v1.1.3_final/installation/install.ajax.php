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

// ������������� ������������ ����
define( '_VALID_MOS', 1 );
// �������� ����� ������������
if (!file_exists( '../configuration.php' )) {
	die('NON config file');
}

require_once( '../configuration.php' );
// ������� �������� �������� ���������
if(!deldir($mosConfig_absolute_path.'/installation/')) echo 'Error!'; else echo 'www.joostina.ru';


function deldir( $dir ) {
	$current_dir = opendir( $dir );
	$old_umask = umask(0);
	while ($entryname = readdir( $current_dir )) {
		if ($entryname != '.' and $entryname != '..') {
			if (is_dir( $dir . $entryname )) {
				@deldir( $dir . $entryname.'/' ) ;
			} else {
				@chmod($dir . $entryname, 0777);
				@unlink( $dir . $entryname );
			}
		}
	}
	@umask($old_umask);
	@closedir( $current_dir );
	return @rmdir( $dir );
}

?>
