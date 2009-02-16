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

class Timer {
	var $startTime;
	var $stopTime;

	function start() {
		$this->startTime = microtime();
	} //start

	function stop() {
		$this->stopTime = microtime();
	} //stop

	function getTime() {
		return $this->elapsed($this->startTime, $this->stopTime);
	} //getTime

	function elapsed($a, $b) {
		list($a_micro, $a_int) = explode(' ',$a);
		list($b_micro, $b_int) = explode(' ',$b);

		if ($a_int > $b_int) {
			return ($a_int - $b_int) + ($a_micro - $b_micro);
		}
		else if ($a_int == $b_int) {
			if ($a_micro > $b_micro) {
				return ($a_int - $b_int) + ($a_micro - $b_micro);
			}
			else if ($a_micro<$b_micro) {
				return ($b_int - $a_int) + ($b_micro - $a_micro);
			}
			else {
				return 0;
			 }
		}
		else { // $a_int < $b_int
			return ($b_int - $a_int) + ($b_micro - $a_micro);
		}
	} //elapsed
} //Timer

?>
