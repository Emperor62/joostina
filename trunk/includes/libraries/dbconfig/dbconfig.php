<?php
/**
 * ����� ��� ��������� ������������ � ���� ������
 * 
 * @package Joostina
 * @copyright (C) 2009 Extention Team. Joostina Team. ��� ����� ��������.
 * @license GNU/GPL, ��������� � help/lisense.php
 * @version $Id: config.php 22.04.2009 21:49:48 e-FreeZe $;
 * @since 1.3 - 21.04.2009
 */
defined('_VALID_MOS') or die();


/**
 * ����� ��� ��������� ���������� �� ���� ������
 */
class DBconfig{
	var $_group = '';
	var $_subgroup = '';
	var $_db = null;
	var $_error = '';
	/**
	 * 
	 */
	function DBconfig($database, $group = '', $subgroup='') {
		global $option;

		$database = &database::getInstance();
		$this->_db = $database;
		
		// ��������� - ������ �� ������
		if (trim($group) == '') {
			$this->_group = $option;// ��� �� ������ - ��������� �������� $option
		} else {
			$this->_group = $group;// ������
		}

		// ��������� - ������ �� ���������
		if (trim($subgroup) == '') {
			$this->_subgroup = '';
		} else {
			$this->_subgroup = $subgroup;
		}
		
		// �������� ��� �������� �� ���� ������
		if($this->bindConfig($this->_formatArray($this->getBatchValues()))){
			return true;
		};
		return false;
	}

	function bindConfig($array, $prefix = '') {
		if (!is_array($array)) {
			$this->_error = 'No array param';
			return false;
		} else {
			$prefix = trim($prefix);
			$rows = get_object_vars($this);
			foreach ($rows as $key => $value) {
				if (isset($array[$prefix . $key]) and substr($key, 0, 1) !== '_') {
					$this->$key = $array[$key];
				}
			}
			return true;
		}
	}
	
	function prepare_for_xml_render(){
			
		$rows = get_object_vars($this); 
		$array = array();
		foreach ($rows as $key => $value) {
			if(substr($key, 0, 1) !== '_'){
				$array[] = "$key=$value";	
			}	
		}
		$txt = implode("\n", $array);
		return $txt;
	}

	function storeConfig() {
		$rows = get_object_vars($this);

		$title = '';
		$info = '';

		foreach ( $rows as $key => $value ) {

			if (substr($key, 0, 1) !== '_') {
				$return = $this->setValue($key, $value);
				if (!$return) {
					break;
				}
			}
		}
		return $return;
	}

	function def($key,$value = '') {
		return $this->set($key,$this->get($key,$value));
	}

	function get($key,$default = '') {
		if(isset($this->$key)) {
			return $this->$key === ''?$default:$this->$key;
		} else {
			return $default;
		}
	}

	function set($key,$value = '') {
		$this->$key = $value;
		return $value;
	}
	
	function getBatchValues() {

		$where = '';
		if($this->_subgroup){
			$where = " AND c.subgroup = '".$this->_subgroup."'";
		}

		$this->_db->setQuery("SELECT c.name, c.value FROM #__config AS c WHERE c.group='$this->_group'".$where);

		$return = $this->_db->loadObjectList();
		if (is_array($return)) {
			return $return;
		} else {
			return null;
		}
	}

	
	/**
	 * ��������� ���������� ��������� �� ���� ������
	 *
	 * @var string $name ��� ���������
	 * @var string $group ������ ���������
	 * @var string $type ��� ������: s - ��������� ������; i - ����� �����; f - ������� �����; a - ������; b - ���������� �/�
	 * @var variant $default �������� �� ���������, ���� �������� �� ����� ������ � ���� ������, �� �������� �� ��������� ����������
	 * 
	 * @return variant �������� ��������� ������������
	 */
	function getValue($name, $default = null) {
		// �������� ������ �� ��������� �� ���� ������
		$this->_db->setQuery("SELECT c.value " .
				"FROM #__config AS c " .
				"WHERE c.name='$name' " .
				"AND c.group='$this->_group' " .
				"LIMIT 1");
		$value = $this->_db->loadResult();

		// �������� �������� ���������
		$return = $this->_parseValue($value);

		if (!$return) {
			$return = $default;
		}
		
		return $return;
	}

	/**
	 * ��������� �������� ���������
	 *
	 * @var string $name ��� ���������
	 * @var variant $value �������� ���������
	 * @var string $group ������ ���������, ���� �������� �� ������, �� ������� �������� ���������� �� ���������� $option
	 * @var string $type ��� ���������, ���� ��� �� �����, �� �������������� ������� ���������� ��� ���������, �� ��������� - ������
	 * @return int ���������� �������� � ����������� ������ �� $database->query()
	 */
	function setValue($name, $value, $type = '', $title = '', $info = '') {
		// ������� ���������� ���
		if ($type == '') {						// ���� ��� �� ����� �� ���������
			if (is_array($value)) {				// ���� ������
				$type = 'a';					// �� ������������� ��� "������"
			} else if (is_bool($value)) {		// ���� ����������
				$type = 'b';					// �� ������������� ��� "����������"
			} else if (is_int($value)) {		// ���� ����� �����
				$type = 'i';					// �� ������������� ��� "����� �����"
			} else if (is_float($value)) {		// ���� ������� �����
				$type = 'f';					// �� ������������� ��� "������� �����"
			} else {							// ����� - ��������� ������
				$type = 's';					// �� ������������� ��� "��������� ������"
			}
		}

		$str = $this->_formatValue($type,$value);

		$where = '';
		if($this->_subgroup){
			$where = " AND c.subgroup = '".$this->_subgroup."'";
		}

		// ��������, ���� �� � ���� �������� � ����� ������ � ������
		$this->_db->setQuery("SELECT c.id " .
				"FROM #__config AS c " .
				"WHERE c.name='$name' " .
				"AND c.group='$this->_group' $where " .
				"LIMIT 1;");

		$id = $this->_db->loadResult();
		if ($id) {							// ���� ����,
			$sql = "UPDATE #__config " .	// �� ��������� ������
					"SET value='$str' " .	// ��� ���������� ������
					"WHERE id='$id' " .
					"LIMIT 1;";
		} else {							// ���� ���,
			$sql = "INSERT INTO #__config " .// �� ��������� ������
					"VALUES (0,'$this->_group', '$this->_subgroup', '$name', '$str')";	// ��� ���������� ������
		}
		$this->_db->setQuery($sql);
		// �������� ���������
		return $this->_db->query();
	}

	/**
	 * ��������� "�����������" ������ �� ������, ���
	 * type - ��� ���������
	 * length - ����� ������ �� ���������
	 * value - �������� ���������
	 * ������ � ���� ����� ���: <type>:<length>{<value>},
	 *
	 * @var string $value ������ ��� �������
	 */
	private function _parseValue($value) {
		$value_array = array();

		if (substr($value, 1, 1) == ":"){
			$type = substr($value, 0, 1);
		} else {
			$type = "u";
		}
		$pos = strpos($value, "{");
		$length = (int)substr($value, 2, $pos-2);
		$value = substr($value, $pos+1, strlen($value)-2-$pos);
		$value = substr($value, 0, $length);
		
		// ������ ��� ���������
		switch ($type) {
			// ��������� ������
			case 's':
				$return = (string)substr($value, 0, $length);
				break;

			// ����� �����
			case 'i':
				$return = (int)substr($value, 0, $length);
				break;

			// ������� �����
			case 'f':
				$return = (float)substr($value, 0, $length);
				break;

			// ������ ��������
			case 'a':
				$items = explode(";",$value);
				$return = array();
				for ($i=0; $i<count($items); $i++) {
					$return[] = $this->_parseValue($items[$i]);
				}
				break;

			// ���������� ��������
			case 'b':
				$return = ($value_array['value'] == '1')?true:false;
				break;
				
			case 'u':
			default:
				$return = $value;
				break;
		}

		return $return;
	}

	/**
	 * ������������ ������ ��� ������ � ���� ������
	 * 
	 * @var string $type ��� ���������
	 * @var variant $value �������� ���������
	 */
	private function _formatValue($type, $value) {
		switch ($type){
			case 's':
			case 'i':
			case 'f':
				$v = (string)$value;
				break;

			case 'b':
				$v = ($value == true or $value == '1' or $value == 1)?'1':'0';
				break;

			case 'a':
				// �������� �������� �� �������� ��������
				if (is_array($value)) {
					$a = array();
					for ($i=0; $i<count($value); $i++) {
						$a[] = $this->_formatValue($value[$i]['type'], $value[$i]['value']);
					}
					$v = implode(';', $a);
				}
				break;
		}
		return $type . ":" . strlen($v) . "{" . $v . "}";
	}
	
	function _formatArray($array) {
		$return = array();
		if (is_array($array) and count($array) > 0) {
			for ( $i = 0; $i < count($array); $i++ ) {
				$item = &$array[$i];
				$return[$item->name] = $this->_parseValue($item->value);
			}
		}
		return $return;
	}
}