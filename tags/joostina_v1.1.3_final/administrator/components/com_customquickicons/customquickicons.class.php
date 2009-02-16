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

/**
 * @package Custom QuickIcons
 */
class CustomQuickIcons extends mosDBTable {
	/** @var int Primary key */
	var $id				= null;
	/** @var string */
	var $text			= null;
	/** @var string */
	var $target			= null;
	/** @var string */
	var $icon			= null;
	/** @var int */
	var $ordering		= null;
	/** @var int */
	var $new_window		= null;
	/** @var string */
	var $prefix			= null;
	/** @var string */
	var $postfix		= null;
	/** @var int */
	var $published		= null;

	/* varchar(30) - title.tag */
	var $title			= null;
	/* tinyint(1) - check com/mod before display icon */
	var $cm_check		= null;
	/* varchar(255) - path for com/mod if it is to check */
	var $cm_path		= null;
	/* varchar(1) - accessibility key */
	var $akey			= null;
	/* tinyint(1) - outpu: only icon/text/text & icon */
	var $display		= null;
	/* access int(11) */
	var $access			= null;
	/* gid int(3) - acl-group.id */
	var $gid			= null;

	/* last user worked on - but left without saving item */
	var $checked_out	= null;

	function CustomQuickIcons() {
  		global $database;
  		$this->mosDBTable( '#__custom_quickicons', 'id', $database );
  	}

	function check() {
  		$returnVar = true;

  	    if( empty( $this->icon ) && $this->display != '1' ) {
        	$this->_error = _QI_MSG_ICON;
            $returnVar = false;
        }
        if( empty( $this->target ) ){
        	$this->_error = _QI_MSG_TARGET;
            $returnVar = false;
        }
        if( empty($this->text ) ){
        	$this->_error = _QI_MSG_TEXT;
            $returnVar = false;
        }

        return $returnVar;
    }

    function _QI_version(){
    	global $qiVersion;

    	$qiVersion = array();
    	$qiVersion['version'] 	= '2.0.7';
    	$qiVersion['date'] 		= '2007.08.29';

    	return $qiVersion;
    }
}
?>