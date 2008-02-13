<?php
/***
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
defined('_VALID_MOS') or die('������ ����� ����� ��������');

/**
* ���������� � ������
* @package Joostina
*/
class joomlaVersion {
	/**
	@var ������ �������*/
	var $PRODUCT = 'Joomla!';
	/**
	@var ������ CMS*/
	var $CMS = 'Joostina';
	/**
	@var ������*/
	var $CMS_ver = '1.1.2.2';
	/**
	@var int ����� �������� ������*/
	var $RELEASE = '1.0';
	/**
	@var ������  ������ ����������*/
	var $DEV_STATUS = '��������� ������';
	/**
	@var int ���������*/
	var $DEV_LEVEL = '13';
	/**
	@var int ����� ������*/
	var $BUILD = '$: 134';
	/**
	@var string ������� ���*/
	var $CODENAME = 'stable';
	/**
	@var string ����*/
	var $RELDATE = '09/01/2008';
	/**
	@var string �����*/
	var $RELTIME = '01:21';
	/**
	@var string ��������� ����*/
	var $RELTZ = 'UTC';
	/**
	@var string ����� ��������� ����*/
	var $COPYRIGHT = '��������� ����� &copy; 2007 Joostina Team. ��� ����� ��������.';
	/**
	@var string URL*/
	var $URL = '<a href="http://www.joostina.ru" target="_blank">Joostina!</a> - ��������� ����������� �����������, ���������������� �� �������� GNU/GPL.';
	/**
	@var string ��� ��������� ������������� ����� ���������� = 1 ��� ������������ = 0: 1 ������������ �� ���������*/
	var $SITE = 1;
	/**
	@var string Whether site has restricted functionality mostly used for demo sites: 0 is default*/
	var $RESTRICT = 0;
	/**
	@var string Whether site is still in development phase (disables checks for /installation folder) - should be set to 0 for package release: 0 is default*/
	var $SVN = 0;
	/**
	@var string ������ �� ����� ���������*/
	var $SUPPORT = '���������: <a href="http://www.joostina.ru" target="_blank" title="����������� ���� CMS Joostina">www.joostina.ru</a> | <a href="http://www.joomlaportal.ru" target="_blank" title="Joomla! CMS ��-������">www.joomlaportal.ru</a> | <a href="http://www.joom.ru" target="_blank" title="������� ��� Joomla">www.joom.ru</a> | <a href="http://www.joomla.ru" target="_blank" title="���������� ������� ���������� ������ Joomla!">www.joomla.ru</a>';
	/**
	* @return string ������� ������ ������
	*/
	function getLongVersion() {
		return $this->CMS.' '.$this->RELEASE.'. '.$this->CMS_ver.' [ '.$this->CODENAME.
			' ] '.$this->RELDATE.' '.$this->RELTIME.' '.$this->RELTZ;
	}
	/**
	* @return string ������� ������ ������
	*/
	function getShortVersion() {
		return $this->RELEASE.'.'.$this->DEV_LEVEL;
	}
	/**
	* @return string Version suffix for help files
	*/
	function getHelpVersion() {
		if($this->RELEASE > '1.0') {
			return '.'.str_replace('.','',$this->RELEASE);
		} else {
			return '';
		}
	}
}

$_VERSION = new joomlaVersion();

$version = $_VERSION->CMS.' '.$_VERSION->CMS_ver.' '.$_VERSION->DEV_STATUS.
	' [ '.$_VERSION->CODENAME.' ] '.$_VERSION->RELDATE.' '.$_VERSION->RELTIME.' '.$_VERSION->RELTZ;
$jostina_ru = $_VERSION->CMS.' '.$_VERSION->CMS_ver.'. '.$_VERSION->DEV_STATUS.
	' [ '.$_VERSION->CODENAME.' ] '.$_VERSION->RELDATE.' '.$_VERSION->RELTIME.' '.$_VERSION->RELTZ.
	'<br />'.$_VERSION->SUPPORT;
?>
