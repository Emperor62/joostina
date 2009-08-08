<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined( '_VALID_MOS' ) or die();

// ��������� ������ ������ � ������� - ��� �� �� ������� ������ ���������� � ������� ���������
if(!defined( '_MOD_ARCHIVE_INCLUDED')){
	DEFINE('_MOD_ARCHIVE_INCLUDED',1);

	function _mod_archive($count){
		$database = &database::getInstance();

		$query = "SELECT MONTH(created) AS created_month, created, id, sectionid, title, YEAR(created) AS created_year FROM #__content WHERE ( state = -1 AND checked_out = 0 AND sectionid > 0 ) GROUP BY created_year DESC, created_month DESC";
		$database->setQuery( $query, 0, $count );
		$rows = $database->loadObjectList();

		if( count( $rows ) ) {
			echo '<ul>';
			foreach ( $rows as $row ) {
				$created_month	= mosFormatDate ( $row->created, "%m" );
				$month_name		= mosFormatDate ( $row->created, "%B" );
				$created_year	= mosFormatDate ( $row->created, "%Y" );
				$link			= sefRelToAbs( 'index.php?option=com_content&amp;task=archivecategory&amp;year='. $created_year .'&amp;month='. $created_month .'&amp;module=1' );
				$text			= $month_name .', '. $created_year;
				?><li>
					<a href="<?php echo $link; ?>"><?php echo $text; ?></a>
				</li><?php
			}
			echo '</ul>';
		}
	}
}

$count = intval($params->def( 'count', 10 ));
_mod_archive($count);

// ������ ������
unset($params,$count);