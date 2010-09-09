<?php
/**
* ������� �� ������������ mosSociable.php 1.1.2 (For Joomla 1.1.2)
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author Walter Cedric 
* @email: webmaster@waltercedric.com
* @link http://www.waltercdric.com
* @��������� � ����������� ��� ������ � �������� ����������� ���������:
* @autor doctorgrif 
* @email: artem.grafov@gmail.com
* @link: http://www.hospsurg.ru
* @package Joostina
* @copyright ��������� ����� (C) 2008 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
**/
defined('_VALID_MOS') or die();
$_MAMBOTS->registerFunction('onAfterDisplayContent', 'joostinasocialbot');
function joostinasocialbot(& $row, & $params, $page = 0) {
global $database, $mainframe, $task, $option, $mosConfig_live_site, $mainframe, $_MAMBOTS;
if ($option == 'com_content' AND $task == 'view') {
// Get Settings from Parameter-System
$query = "SELECT id"
. "\n FROM #__mambots"
. "\n WHERE element = 'joostinasocialbot'"
. "\n AND folder = 'content'";
$database->setQuery($query);
$id = $database->loadResult();
$mambot = new mosMambot($database);
$mambot->load($id);
$params = & new mosParameters($mambot->params);
if ($Itemid == NULL) {
$Itemid = '';
} else {
$Itemid = '&amp;Itemid='.$Itemid;
}
$arturl= sefRelToAbs('index.php?option=com_content&amp;task=view&amp;id='.$row->id .$Itemid);
$arttitle = $params->get('arttitle',$row->title);
echo iconv('utf-8','windows-1251//TRANSLIT',$arttitle);
$arttitle=urlencode($arttitle);
$textbefore = $params->get('textbefore','�������� �������� �:');
$textafter = $params->get('textafter','Powered by <a href="http://www.joostina.ru" title="Joostina - ����������� ������� ���������� ���������� ���������� ������ � ���������" target="_new">JostinaTeam</a>');
$sociable .= "<div class=\"sociable\"><span class=\"sociable_tagline_before\">$textbefore</span>";
$sociable .= "<ul class=\"sociable_tagline_list\">";
$sociable .= "<li><a href=\"http://www.bobrdobr.ru/addext.html?url=$arturl&title=$arttitle\"class=\"sociable\" target=\"_new\" title=\"�������� � BobrDob\" rel=\"nofollow\"><img src=\"/images/sociable/bobrdobr.png\" alt=\"�������� � BobrDob\" /></a></li>";
$sociable .= "<li><a href=\"http://www.del.icio.us/post?v=4&noui&jump=close&url=$arturl&title=$arttitle\" class=\"sociable\" target=\"_new\" title=\"�������� � del.icio.us\" rel=\"nofollow\"><img src=\"/images/sociable/delicious.png\" alt=\"�������� � del.icio.us\" /></a></li>";
$sociable .= "<li><a href=\"http://digg.com/submit?url=$arturl\" target=\"_new\" class=\"sociable\" title=\"�������� � Digg\" rel=\"nofollow\"><img src=\"/images/sociable/digg.png\" alt=\"�������� � Digg\" /></a></li>";
$sociable .= "<li><a href=\"http://www.facebook.com/sharer.php?u=$arturl\" class=\"sociable\" target=\"_new\" title=\"���������� ������� � FaceBook\" rel=\"nofollow\"><img src=\"/images/sociable/facebook.png\" alt=\"���������� ������� � FaceBook\" /></a></li>";
//$sociable .= "<li><a href=\"http://feedblog.ru/submit.php?url=$arturl\" target=\"_new\" title=\"�������� � Feedblog\" rel=\"nofollow\"><img src=\"/images/sociable/feedblog.png\" alt=\"�������� � Feedblog\" /></a></li>";
$sociable .= "<li><a href=\"http://www.google.com/bookmarks/mark?op=add&bkmk=$arturl&title=$arttitle\" class=\"sociable\" target=\"_new\" title=\"�������� � Google\" rel=\"nofollow\"><img src=\"/images/sociable/google.png\" alt=\"�������� � Google\" /></a></li>";
$sociable .= "<li><a href=\"http://www.google.com/reader/link?url=$arturl&amp;title=$arttitle&amp;srcURL=$mosConfig_live_site\" class=\"sociable\" target=\"_new\" title=\"�������� � Google Buzz\" rel=\"nofollow\"><img src=\"/images/sociable/googlebuzz.png\" alt=\"�������� � Google Buzz\" /></a></li>";
$sociable .= "<li><a href=\"http://www.liveinternet.ru/journal_post.php?action=l_add&amp;cnurl=$arturl\" class=\"sociable\" target=\"_new\" title=\"�������� � ���� ���� �� ���� (Liveinternet)\" rel=\"nofollow\"><img src=\"/images/sociable/liveinternet.png\" alt=\"�������� � ���� ���� �� ���� (Liveinternet)\" /></a></li>";
$sociable .= "<li><a href=\"http://www.livejournal.com/update.bml?event=$arturl&amp;subject=$arttitle\" class=\"sociable\" target=\"_new\" title=\"������������ � ����� ����� livejournal.com\" rel=\"nofollow\"><img src=\"/images/sociable/livejournal.png\" alt=\"������������ � ����� ����� livejournal.com\" /></a></li>";
$sociable .= "<li><a href=\"http://connect.mail.ru/share?share_url=$arturl\" class=\"sociable\" target=\"_new\" title=\"�������� � ��� ���\" rel=\"nofollow\" ><img src=\"/images/sociable/mojmir.png\" alt=\"�������� � ��� ���\" /></a></li>";
$sociable .= "<li><a href=\"http://www.memori.ru/link/?sm=1&u_data[url]=$arturl&u_data[name]=$arttitle\" class=\"sociable\" target=\"_new\" title=\"�������� � Memori\" rel=\"nofollow\"><img src=\"/images/sociable/memori.png\" alt=\"�������� � Memori\" /></a></li>";
$sociable .= "<li><a href=\"http://www.mister-wong.ru/index.php?action=addurl&bm_url=$arturl&bm_description=$title\" class=\"sociable\" target=\"_new\" title=\"�������� � Mister Wong\" rel=\"nofollow\"><img src=\"/images/sociable/mrwong.png\" alt=\"�������� � Mister Wong\" /></a></li>";
$sociable .= "<li><a href=\"moemesto.ru/post.php?url=$arturl&title=$arttitle\" class=\"sociable\" target=\"_new\" title=\"�������� � MoeMesto\" rel=\"nofollow\"><img src=\"/images/sociable/moemesto.png\" alt=\"�������� � MoeMesto\" /></a></li>";
$sociable .= "<li><a href=\"http://news2.ru/add_story.php?url=$arturl\" class=\"sociable\" target=\"_new\" title=\"�������� � News2.ru\" rel=\"nofollow\"><img src=\"/images/sociable/news2ru.png\" alt=\"�������� � News2.ru\" /></a></li>";
$sociable .= "<li><a href=\"http://pikabu.ru/add_story.php?story_url=$arturl\" class=\"sociable\" target=\"_new\" title=\"�������� � ������\" rel=\"nofollow\"><img src=\"/images/sociable/pikabu.png\" alt=\"�������� � ������\" /></a></li>";
$sociable .= "<li><a href=\"http://www.technorati.com/faves?add=$arturl\" class=\"sociable\" target=\"_new\" title=\"�������� � Technorati\" rel=\"nofollow\"><img src=\"/images/sociable/technorati.png\" alt=\"�������� � Technorati\" /></a></li>";
$sociable .= "<li><a href=\"http://twitter.com/home/?status=$arttitle+$arturl\" class=\"sociable\" target=\"_new\" title=\"�������� � Twitter\" rel=\"nofollow\"><img src=\"/images/sociable/twitter.png\" alt=\"�������� � Twitter\" /></a></li>";
$sociable .= "<li><a href=\"http://vkontakte.ru/share.php?url=$arturl\" class=\"sociable\" target=\"_new\" title=\"���������� ���������\" rel=\"nofollow\"><img src=\"/images/sociable/vkontakte.png\" alt=\"���������� ���������\" /></a></li>";
$sociable .= "<li><a href=\"http://my.ya.ru/posts_add_link.xml?title=$arttitle&amp;URL=$arturl\" class=\"sociable\" target=\"_new\" title=\"���������� ������� �� �.��\" rel=\"nofollow\"><img src=\"/images/sociable/yandex.png\" alt=\"���������� ������� �� �.��\" /></a></li>";
$sociable .= "</ul>";
$sociable .= "<span class=\"sociable_tagline_after\">$textafter</span></div>";
}
return $sociable;
}
?>