<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

// XML library
require_once ($mosConfig_absolute_path.
	'/includes/domit/xml_domit_lite_include.php');
require_once ($mosConfig_absolute_path.
	"/administrator/components/com_jce/installer/installer.html.php");
require_once ($mosConfig_absolute_path.
	"/administrator/components/com_jce/installer/installer.class.php");

function jceInstaller($option,$client,$opt) {
	global $mosConfig_absolute_path;
	$element = mosGetParam($_REQUEST,'element','');

	$path = $mosConfig_absolute_path."/administrator/components/com_jce/installer/$element/$element.php";

	// map the element to the required derived class
	$classMap = array('plugins' => 'JCEPluginInstaller','language' =>
		'JCELanguageInstaller');

	if(array_key_exists($element,$classMap)) {
		require_once ($mosConfig_absolute_path.
			"/administrator/components/com_jce/installer/$element/$element.class.php");

		switch($opt) {

			case 'uploadfile':
				uploadPackage($classMap[$element],$option,$element,$client);
				break;

			case 'installfromdir':
				installFromDirectory($classMap[$element],$option,$element,$client);
				break;

			case 'remove':
				removeElement($classMap[$element],$option,$element,$client);
				break;

			case 'show':
				$path = $mosConfig_absolute_path."/administrator/components/com_jce/installer/$element/$element.php";

				if(file_exists($path)) {
					require $path;
				} else {
					echo "����������� �� ��������� ������� [$element]";
				}
				break;
		}
	} else {
		echo "����������� ���������� ��� �������� [$element]";
	}
}

/**
* @param string The class name for the installer
* @param string The URL option
* @param string The element name
*/
function uploadPackage($installerClass,$option,$element,$client) {
	$installer = new $installerClass();

	// Check if file uploads are enabled
	if(!(bool)ini_get('file_uploads')) {
		HTML_installer::showInstallMessage("��������� ����������, ���� �� ����� ��������� �������� ������. �����������, ����������, ����� ��������� �� ��������.",
			'������ ���������',$installer->returnTo($option,'&task=install&element='.$element,
			$client));
		exit();
	}

	// Check that the zlib is available
	if(!extension_loaded('zlib')) {
		HTML_installer::showInstallMessage("��������� ����������, ���� �� ����� ��������� zlib",
			'������ ���������',$installer->returnTo($option,'&task=install&element='.$element,
			$client));
		exit();
	}

	$userfile = mosGetParam($_FILES,'userfile',null);

	if(!$userfile) {
		HTML_installer::showInstallMessage('����� �� �������',
			'������ �������� ������ ������',$installer->returnTo($option,
			'&task=install&element='.$element,$client));
		exit();
	}

	$userfile_name = $userfile['name'];

	$msg = '';
	$resultdir = uploadFile($userfile['tmp_name'],$userfile['name'],$msg);

	if($resultdir !== false) {
		if(!$installer->upload($userfile['name'])) {
			HTML_installer::showInstallMessage($installer->getError(),'������ �������� '.$element,
				$installer->returnTo($option,'&task=install&element='.$element,$client));
		}
		$ret = $installer->install();

		HTML_installer::showInstallMessage($installer->getError(),'�������� '.$element.
			' - '.($ret?'�������':'����������� �������'),$installer->returnTo($option,
			'&task=install&element='.$element,$client));
		cleanupInstall($userfile['name'],$installer->unpackDir());
	} else {
		HTML_installer::showInstallMessage($msg,'������ �������� '.$element,$installer->returnTo
			($option,'&task=install&element='.$element,$client));
	}
}

/**
* Install a template from a directory
* @param string The URL option
*/
function installFromDirectory($installerClass,$option,$element,$client) {
	$userfile = mosGetParam($_REQUEST,'userfile','');

	if(!$userfile) {
		mosRedirect("index2.php?option=$option&element=module",
			"��������, ����������, �������");
	}

	$installer = new $installerClass();

	$path = mosPathName($userfile);
	if(!is_dir($path)) {
		$path = dirname($path);
	}

	$ret = $installer->install($path);
	HTML_installer::showInstallMessage($installer->getError(),'�������� ������ '.$element.
		' - '.($ret?'�������':'������'),$installer->returnTo($option,
		'&task=install&element='.$element,$client));
}
/**
*
* @param
*/
function removeElement($installerClass,$option,$element,$client) {
	$cid = mosGetParam($_REQUEST,'cid',array(0));
	if(!is_array($cid)) {
		$cid = array(0);
	}

	$installer = new $installerClass();
	$result = false;
	if($cid[0]) {
		$result = $installer->uninstall($cid[0],$option,$client);
	}

	$msg = $installer->getError();

	mosRedirect($installer->returnTo($option,'&task=install&element='.$element,$client),
		$result?'������� '.$msg:'������ '.$msg);
}
/**
* @param string The name of the php (temporary) uploaded file
* @param string The name of the file to put in the temp directory
* @param string The message to return
*/
function uploadFile($filename,$userfile_name,&$msg) {
	global $mosConfig_absolute_path;
	$baseDir = mosPathName($mosConfig_absolute_path.'/media');

	if(file_exists($baseDir)) {
		if(is_writable($baseDir)) {
			if(move_uploaded_file($filename,$baseDir.$userfile_name)) {
				if(mosChmod($baseDir.$userfile_name)) {
					return true;
				} else {
					$msg = '���������� �������� ����� ������� � ������������ �����.';
				}
			} else {
				$msg = '���������� ����������� ����������� ���� � ������� <code>/media</code>.';
			}
		} else {
			$msg = '�������� ���������� ��-�� ���������� ���������� �� ������ � ������� <code>/media</code>.';
		}
	} else {
		$msg = '�������� ���������� ��-�� ���������� �������� <code>/media</code>.';
	}
	return false;
}
?>
