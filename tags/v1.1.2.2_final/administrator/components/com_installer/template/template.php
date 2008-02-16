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

// ensure user has access to this function
if ( !$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element . 's', 'all' ) ) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

$client 	= mosGetParam( $_REQUEST, 'client', '' );
$userfile 	= mosGetParam( $_REQUEST, 'userfile', dirname( __FILE__ ) );
$userfile 	= mosPathName( $userfile );

HTML_installer::showInstallForm( '��������� ������� <small><small>[ ' . ($client == 'admin' ? '����������' : '�����') .' ]</small></small>',
	$option, 'template', $client, $userfile,
	'<a href="index2.php?option=com_templates&client='.$client.'">������� � ���������� ���������</a>'
);
?>
<table class="content">
<?php
writableCell( 'media' );
writableCell( 'administrator/templates' );
writableCell( 'templates' );
writableCell( 'images/stories' );
?>
</table>
