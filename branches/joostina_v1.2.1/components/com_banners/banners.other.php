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
// function that selecting one or more banner/s
function showBanners(&$params) {
global $database, $my;
$random = $params->get('random', 0);
$count = $params->get('count', 1);
$banners = $params->get('banners');
$categories = $params->get('categories');
$clients = $params->get('clients');
$orientation = $params->get('orientation', 0);
$moduleclass_sfx = $params->get('moduleclass_sfx');
$weekday = mosCurrentDate("%w");
$date = mosCurrentDate("%Y-%m-%d");
$time = mosCurrentDate("%H:%M:%S");
$where = array();
if($categories != '') {
$where[] = "b.tid IN ($categories)";
}
if($banners != '') {
$where[] = "b.id IN ($banners)";
}
if($clients != '') {
$where[] = "b.cid IN ($clients)";
}
if(count($where) > 0)
$where = '(' . implode(' OR ', $where) . ') AND';
else
$where = '';
/*
$query = "SELECT #__banners.* FROM #__banners,#__banners_categories,#__banners_clients
WHERE 1 AND $where
(('$date' <= publish_down_date OR publish_down_date = '0000-00-00')
AND '$date' >= publish_up_date
AND ((reccurtype = 0)
OR (reccurtype = 1 AND reccurweekdays LIKE '%$weekday%'))
AND '$time' >= publish_up_time
AND ('$time' <= publish_down_time OR publish_down_time = '00:00:00')
AND access <= '$my->gid'
AND state = '1'
AND #__banners.tid = #__banners_categories.id
AND #__banners_categories.published = 1
AND #__banners.cid = #__banners_clients.cid
AND #__banners_clients.published = 1) ORDER BY last_show ASC, msec ASC";
*/
$query ="SELECT b.* FROM #__banners AS b
INNER JOIN #__banners_categories AS cat ON b.tid = cat.id
INNER JOIN #__banners_clients AS cl ON b.cid = cl.cid
WHERE cat.published =1 AND cl.published =1 AND b.access <= '$my->gid' AND b.state = '1'
AND $where (
('$date' <= b.publish_down_date OR b.publish_down_date = '0000-00-00')
AND '$date' >= b.publish_up_date
AND ((b.reccurtype =0) OR (b.reccurtype =1 AND b.reccurweekdays LIKE '%$weekday%'))
AND '$time' >= b.publish_up_time
AND ('$time' <= b.publish_down_time OR b.publish_down_time = '00:00:00')
)
ORDER BY b.last_show ASC , b.msec ASC";
$database->setQuery($query);
$rows = $database->loadObjectList();
$numrows = count($rows);
if(!$numrows){
return '&nbsp;';
}
$result = '<table cellpadding="0" cellspacing="0" class="banners'.$moduleclass_sfx.'">';
if($random && $count == 1) {
$bannum = 0;
if($numrows > 1) {
$numrows--;
mt_srand((double)microtime() * 1000000);
$bannum = mt_rand(0, $numrows);
}
if($numrows) {
$result .= '<tr><td>'.showSingleBanner($rows[$bannum]).'</td></tr></table>';
return $result;
}
}
$showed = 0;
$first = false;
foreach($rows as $row) {
//'0' -> Vertical
//'1' -> Horizontal
if($orientation == '0') {
$result .= '<tr><td>'.showSingleBanner($row).'</td></tr>';
} else {
if($first == false) {
$result .= '<tr>';
$first = true;
}
$result .= '<td>'.showSingleBanner($row).'</td>';
}
$showed++;
if($showed == $count) {
break;
}
}
if($orientation == '1') {
$result .= '</tr>';
}
$result .= '</table>';
return $result;
}
// function that showing one banner
function showSingleBanner(&$banner) {
global $mosConfig_live_site, $database, $mosConfig_absolute_path;
$result = '';
$secs = gettimeofday();
$database->setQuery("UPDATE #__banners SET imp_made=imp_made+1, last_show='".mosCurrentDate("%Y-%m-%d %H:%M:%S")."', msec='".$secs["usec"]."' WHERE id='$banner->id'");
$database->query();
$banner->imp_made++;
if($banner->imp_total == $banner->imp_made) {
$database->setQuery("UPDATE #__banners SET state='0' WHERE id='$banner->id'");
$database->query();
}
if($banner->custom_banner_code != "") {
$result .= $banner->custom_banner_code;
} else
if(eregi("(\.bmp|\.gif|\.jpg|\.jpeg|\.png)$", $banner->image_url)) {
$image_url = "$mosConfig_live_site/images/banners/$banner->image_url";
$imginfo = @getimagesize("$mosConfig_absolute_path/images/banners/" . $banner->image_url);
$target = $banner->target;
$border_value = $banner->border_value;
$border_style = $banner->border_style;
$border_color = $banner->border_color;
$alt = $banner->name;
if($banner->alt != '')
$alt = $banner->alt;
$title = $banner->title;

$result = "<a href=\"index.php?option=com_banners&amp;task=clk&amp;id=$banner->id\" target=\"_".$target."\"  title=\"$title\"><img src=\"".$image_url. "\" style=\"border:".$border_value."px ".$border_style." ".$border_color."\" vspace=\"0\" alt=\"$alt\" width=\"$imginfo[0]\" height=\"$imginfo[1]\" /></a>";
} else
if(eregi(".swf", $banner->image_url)) {
$image_url = "$mosConfig_live_site/images/banners/".$banner->image_url;
$swfinfo = @getimagesize("$mosConfig_absolute_path/images/banners/".$banner->image_url);
$result = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,2,0\" border=\"0\" width=\"$swfinfo[0]\" height=\"$swfinfo[1]\" vspace=\"0\"><param name=\"SRC\" value=\"$image_url\"><embed src=\"$image_url\" loop=\"false\" pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"$swfinfo[0]\" height=\"$swfinfo[1]\"></object>";
}
return $result;
}
?>