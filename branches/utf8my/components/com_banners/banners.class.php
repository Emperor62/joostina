<?php
/**
* @package Joostina
* @copyright Авторские права (C) 2007 Joostina team. Все права защищены.
* @license Лицензия http://www.gnu.org/copyleft/gpl.html GNU/GPL, смотрите LICENSE.php
* Joostina! - свободное программное обеспечение. Эта версия может быть изменена
* в соответствии с Генеральной Общественной Лицензией GNU, поэтому возможно
* её дальнейшее распространение в составе результата работы, лицензированного
* согласно Генеральной Общественной Лицензией GNU или других лицензий свободных
* программ или программ с открытым исходным кодом.
* Для просмотра подробностей и замечаний об авторском праве, смотрите файл COPYRIGHT.php.
*/
require(dirname(__FILE__).'/../../die.php');

/**
* @package Joostina
* @subpackage Banners
*/
class mosBannerClient extends mosDBTable {
	var	$cid 				= null;
	var $name 				= '';
	var $contact 			= '';
	var $email 				= '';
	var $extrainfo 			= '';
	var $checked_out 		= 0;
	var $checked_out_time 	= 0;
	var $editor				= '';

	function mosBannerClient( &$_db ) {
		$this->mosDBTable( '#__bannerclient', 'cid', $_db );
	}

	function check() {
		// check for valid client name
		if (trim($this->name == '')) {
			$this->_error = _BNR_CLIENT_NAME;
			return false;
		}

		// check for valid client contact
		if (trim($this->contact == '')) {
			$this->_error = _BNR_CONTACT;
			return false;
		}

		// check for valid client email
		if ((trim($this->email == '')) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $this->email )==false)) {
			$this->_error = _BNR_VALID_EMAIL;
			return false;
		}

		return true;
	}
}

/**
* @package Joostina
*/
class mosBanner extends mosDBTable {
	/** @var int */
	var $bid				= null;
	/** @var int */
	var $cid				= null;
	/** @var string */
	var $type				= '';
	/** @var string */
	var $name				= '';
	/** @var int */
	var $imptotal			= 0;
	/** @var int */
	var $impmade			= 0;
	/** @var int */
	var $clicks				= 0;
	/** @var string */
	var $imageurl			= '';
	/** @var string */
	var $clickurl			= '';
	/** @var date */
	var $date				= null;
	/** @var int */
	var $showBanner			= 0;
	/** @var int */
	var $checked_out		= 0;
	/** @var date */
	var $checked_out_time	= 0;
	/** @var string */
	var $editor				= '';
	/** @var string */
	var $custombannercode	= '';

	function mosBanner( &$_db ) {
		$this->mosDBTable( '#__banner', 'bid', $_db );
		$this->set( 'date', date( 'Y-m-d G:i:s' ) );
	}

	function clicks() {
		$query = "UPDATE #__banner"
		. "\n SET clicks = ( clicks + 1 )"
		. "\n WHERE bid = " . (int) $this->bid
		;
		$this->_db->setQuery( $query );
		$this->_db->query();
	}

	function check() {
		// check for valid client id
		if (is_null($this->cid) || $this->cid == 0) {
			$this->_error = _BNR_CLIENT;
			return false;
		}

		if(trim($this->name) == '') {
			$this->_error = _BNR_NAME;
			return false;
		}

		if(trim($this->imageurl) == '') {
			$this->_error = _BNR_IMAGE;
			return false;
		}
		if(trim($this->clickurl) == '' && trim($this->custombannercode) == '') {
			$this->_error = _BNR_URL;
			return false;
		}
		$this->imptotal = (int) $this->imptotal;

		return true;
	}
}
?>
