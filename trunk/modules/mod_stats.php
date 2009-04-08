<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined( '_VALID_MOS' ) or die();

global $mosConfig_offset, $mosConfig_caching, $mosConfig_enable_stats;
global $mosConfig_gzip;

$serverinfo = $params->get( 'serverinfo' );
$siteinfo	= $params->get( 'siteinfo' );

$content = '';

if ($serverinfo) {
	echo "<strong>OS:</strong> "  . substr(php_uname(),0,7) . "<br />\n";
	echo "<strong>PHP:</strong> " .phpversion() . "<br />\n";
	echo "<strong>MySQL:</strong> " .$database->getVersion() . "<br />\n";
	echo "<strong>"._TIME_STAT.": </strong> " .date("H:i",time()+($mosConfig_offset*60*60)) . "<br />\n";
	$c = $mosConfig_caching ? _CMN_YES:_CMN_NO;
	echo '<strong>'._CACHE.':</strong> ' . $c . '<br />';
	$z = $mosConfig_gzip ? _CMN_YES:_CMN_NO;
	echo '<strong>GZIP:</strong> ' . $z . '<br />';
}

if ($siteinfo) {
	$query="SELECT COUNT( id ) AS count_users FROM #__users";
	$database->setQuery($query);
	echo "<strong>"._MEMBERS_STAT.":</strong> " .$database->loadResult() . "<br />\n";

	$query="SELECT COUNT( id ) AS count_items FROM #__content";
	$database->setQuery($query);
	echo "<strong>"._NEWS_STAT.":</strong> ".$database->loadResult() . "<br />\n";

	$query="SELECT COUNT( id ) AS count_links FROM #__weblinks WHERE published = 1";
	$database->setQuery($query);
	echo "<strong>"._LINKS_STAT.":</strong> ".$database->loadResult() . "<br />\n";
}

if ($mosConfig_enable_stats) {
	$counter	= $params->get( 'counter' );
	$increase	= $params->get( 'increase' );
	if ($counter) {
		$query = "SELECT SUM( hits ) AS count FROM #__stats_agents WHERE type = 1";
		$database->setQuery( $query );
		$hits = $database->loadResult();

		$hits = $hits + $increase;

		if ($hits == NULL) {
			$content .= "<strong>" . _VISITORS . ":</strong> 0\n";
		} else {
			$content .= "<strong>" . _VISITORS . ":</strong> " . $hits . "\n";
		}
	}
}
?>
