<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined('_VALID_MOS') or die();

require_once ($mainframe->getPath('class','com_search'));
require_once ($mainframe->getPath('front_html'));
$mainframe->addLib('text');

$tag = mosGetParam( $_REQUEST, 'tag', '' );
if($tag){
    search_by_tag($tag);
}
else{
    $mainframe->setPageTitle(_SEARCH);
    viewSearch();
}

function search_by_tag($tag){
    global $database, $mainframe;

    $items = new contentTags($database);

    /**
    * ��������� "��������� ������" )
     * ������ ������ - ��������� � ������-�� ����������� ����������
     *
     * >    'group_name' - ��� ������, ������ ��������� � ��������� ����������
            � ��������� ���� ������� (������� ������������ � ������� � ������)
     * >     'group_title' - ��������� ������. ��� �������� ����� ��������������
            ��� ������ ����������� ������ �� ����. ��� ��� ���������� ������������ �� ��������,
            �������  ���� �� ��������� ��������� �����
     * >    'table' - �������, � ������� �������� ������
     * >    'id' - �������� ����/������������� ������
     * >    'title' - ����, �������� �� �������� ����� �������������� ��� ������ ���������� �����������
     * >    'text' -  ����, �������� �� �������� ����� �������������� ��� ������ ������� �����������
     * >    'date' -  ����, �������� �� �������� ����� �������������� ��� ������ ���� �������� ������ � ������ �����������

     *  � ������, ���� ������ ��� �������� � ���������� ������� �������� ������
        (��������, ��� � com_content: task=view&id=$item->id)
        ������� �������������� ����������� �� ���������. ���������� ��������� �������� 'task'
     * >    'task' -  ��������� � �������� ������� ��������� ������� ������

     * ���� �� ��������� ���������� ��������������� ������� � ������ �� ������, ���������� �������������� ���������,
     * ���������� ������� ��� ��������� � 'url_params'
     * ��������: ��� ���������� ������������ ������ �� ������ ���������� com_content, ������ ������������� � ����������
     * ������ id ��������� � �������, � ������� ����������� ��������� ��������. � ����� ����� �������� ��� ���� ������ ��������
     * 'page_type' �� ���������, ��������, 'simple'
     * �.�. ������ �� ������� � �������� �� ������� ������ ��������� �������� ���:
        index.php?option=com_content&task=view&id=[��������_id]&page_type=simple&category=[id_���������]&section=[id_�������]

     *  index.php? - ����� ����������� �������������
     *  option=com_content - ����� ������������� ������������ �� ���� ������� (obj_type � ������� � ������)
     *  task=view   -  ����� ������������� ������������ �� ��������� ���� 'task'
     *  id=[��������_id]   - ����������� �������������
     *  ��������� ��������� ����� ����������� �������:
        ---  'url_params'=>'page_type=simple&category=%category&section=%section'
     *  >>>  ���� '%' ����������, ��� � �������� �������� ����� ����� ����������� �������� ������� $item,
     *  >>>  �.�., ������ %category - ����� ����������� $item->category, � ������ %section - $item->section
     *  � ������� 'content' ID ��������� �������� � ���� 'catid', � ID ������� � ���� 'sectionid', �������������
     *  ���������� �������� ��� ���� � ������� ��� ������, ������� �� ��������������� ����������

     * >    'select' - �������������� ����� ��� SQL-��������� SELECT

     *  ����, � ����� ������, �������� 'select' ����� ��������� ��������� �������:
        ---  'select'=>'item.catid AS category, item.sectionid AS section'

	 */
    $groups = array();
    $comcontent_params = array(
                        'group_name' => 'com_content',
                        'group_title' => '����������',
                        'table'=>'content',
                        'id'=>'id',
                        'title'=>'title',
                        'text'=>'introtext',
                        'date'=>'created',
                        'task'=>'view',
                        'url_params'=>'',
                        'select'=>'',
                        'join'=>'',
                        'where'=>'',
                        'order'=>'id DESC'

                    );
    $groups['com_content'] = $comcontent_params;

    $items->items = array();
    foreach($groups as $v){
        $group_name = $v['group_name'];
        $items->items[$group_name] = $items->load_by_type_tag($v, $tag);
    }

    $items->tag = $tag;

    //Params
    $params = new searchByTagConfig($database);
    $mainframe->setPageTitle($params->title.' - '.$tag);

    search_by_tag_HTML::tag_page($items, $params, $groups);
}

function viewSearch() {
	global $mainframe,$mosConfig_absolute_path,$mosConfig_lang;
	global $Itemid,$database,$_MAMBOTS;
	global $mosConfig_list_limit;

	$restriction = 0;

	// try to find search component's Itemid
	// Only search if we don't have a valid Itemid (e.g. from module)
	if(!intval($Itemid) || intval($Itemid) == 99999999) {
		$query = "SELECT id"
			."\n FROM #__menu"
			."\n WHERE type = 'components'"
			."\n AND published = 1"
			."\n AND link = 'index.php?option=com_search'";
		$database->setQuery($query);
		$_Itemid = $database->loadResult();

		if($_Itemid != "") {
			$Itemid = $_Itemid;
		}
	}

	// Adds parameter handling
	if($Itemid > 0 && $Itemid != 99999999) {
		$menu = $mainframe->get('menu');
		$params = new mosParameters($menu->params);
		$params->def('page_title',1);
		$params->def('pageclass_sfx','');
		$params->def('header',$menu->name,_SEARCH);
		$params->def('back_button',$mainframe->getCfg('back_button'));
	} else {
		$params = new mosParameters('');
		$params->def('page_title',1);
		$params->def('pageclass_sfx','');
		$params->def('header',_SEARCH);
		$params->def('back_button',$mainframe->getCfg('back_button'));
	}

	// html output
	search_html::openhtml($params);

	$searchphrase = mosGetParam( $_REQUEST, 'searchphrase', 'any' );
	$searchphrase = preg_replace( '/[^a-z]/', '', strtolower( $searchphrase ) );

	$searchword = strval(mosGetParam($_REQUEST,'searchword',''));
	$searchword = trim(stripslashes($searchword));

	// boston, ������������� ����� smart'a, �������� ����� �������� ��� ������ �� 100
	if(Jstring::strlen($searchword) > 100) {
		$searchword = Jstring::substr($searchword,0,99);
		$restriction = 1;
	}

	// searchword must contain a minimum of 3 characters
	if($searchword && Jstring::strlen($searchword) < 3) {
		$searchword = '';
		$restriction = 1;
	}

	if ($searchphrase != 'exact') {
		$aterms = explode( ' ', Jstring::strtolower( $searchword ) );
		$search_ignore = array();
		// filter out search terms that are too small
		foreach( $aterms AS $aterm ) {
			if (Jstring::strlen( $aterm ) < 3) {
				$search_ignore[] = $aterm;
			}
		}
		$pruned = array_diff( $aterms, $search_ignore );
		$pruned = array_unique( $pruned );
		$searchword = implode( ' ', $pruned );
		if (trim( $searchword ) == '') {
			$restriction = 1;
		}
	}
	@include "$mosConfig_absolute_path/language/$mosConfig_lang/ignore.php";

	$orders = array();
	$orders[] = mosHTML::makeOption('newest',_SEARCH_NEWEST);
	$orders[] = mosHTML::makeOption('oldest',_SEARCH_OLDEST);
	$orders[] = mosHTML::makeOption('popular',_SEARCH_POPULAR);
	$orders[] = mosHTML::makeOption('alpha',_SEARCH_ALPHABETICAL);
	$orders[] = mosHTML::makeOption('category',_SEARCH_CATEGORY);
	$ordering = mosGetParam($_REQUEST,'ordering','newest');
	$ordering = preg_replace('/[^a-z]/','',strtolower($ordering));
	$lists = array();
	$lists['ordering'] = mosHTML::selectList($orders,'ordering','id="search_ordering" class="inputbox"','value','text',$ordering);

	$searchphrases = array();

	$phrase = new stdClass();
	$phrase->value = 'any';
	$phrase->text = _SEARCH_ANYWORDS;
	$searchphrases[] = $phrase;

	$phrase = new stdClass();
	$phrase->value = 'all';
	$phrase->text = _SEARCH_ALLWORDS;
	$searchphrases[] = $phrase;

	$phrase = new stdClass();
	$phrase->value = 'exact';
	$phrase->text = _SEARCH_PHRASE;
	$searchphrases[] = $phrase;

	$lists['searchphrase'] = mosHTML::radioList($searchphrases,'searchphrase','',$searchphrase);

	// html output
	search_html::searchbox(htmlspecialchars($searchword),$lists,$params);

	if(!$searchword) {
		if(count($_POST)) {
			// html output
			// no matches found
			search_html::message(_NOKEYWORD,$params);
		} else
			if($restriction) {
				// html output
				search_html::message(_SEARCH_MESSAGE,$params);
			}
	} elseif(in_array($searchword,$search_ignore)) {
			// html output
			search_html::message(_IGNOREKEYWORD,$params);
		} else {
			// html output

			if($restriction) {
				// html output
				search_html::message(_SEARCH_MESSAGE,$params);
			}

			$searchword_clean = htmlspecialchars($searchword);

			search_html::searchintro($searchword_clean,$params);

			mosLogSearch($searchword);

			$_MAMBOTS->loadBotGroup('search');
			$results 	= $_MAMBOTS->trigger( 'onSearch', array( $database->getEscaped( $searchword, true ), $searchphrase, $ordering ) );
			$totalRows = 0;

			$rows = array();
			$_n = count($results);
			for($i = 0,$n = $_n; $i < $n; $i++) {
				$rows = array_merge((array )$rows,(array )$results[$i]);
			}

			$totalRows = count($rows);

			for($i = 0; $i < $totalRows; $i++) {
				$text = &$rows[$i]->text;

				if($searchphrase == 'exact') {
					$searchwords = array($searchword);
					$needle = $searchword;
				} else {
					$searchwords = explode(' ',$searchword);
					$needle = $searchwords[0];
				}

				$text = mosPrepareSearchContent($text,200,$needle);

				foreach ($searchwords as $k=>$hlword) {
					$searchwords[$k] = htmlspecialchars( stripslashes( $hlword ) );
				}
				$searchRegex = implode( '|', $searchwords );
				$text = eregi_replace( '('.$searchRegex.')', '<span class="highlight">\0</span>', $text );

				if(strpos($rows[$i]->href,'http') == false) {
					$url = parse_url($rows[$i]->href);
					parse_str(@$url['query'],$link);

					// determines Itemid for Content items where itemid has not been included
					if(isset($rows[$i]->type) && @$link['task'] == 'view' && isset($link['id']) && !
						isset($link['Itemid'])) {
						$itemid = '';
						$_itemid = $mainframe->getItemid($link['id'],0);

						if($_itemid) {
							$itemid = '&amp;Itemid='.$_itemid;
						}

						$rows[$i]->href = $rows[$i]->href.$itemid;
					}
				}
			}

			$mainframe->setPageTitle(_SEARCH);

			$total = $totalRows;
			$limit = intval(mosGetParam($_GET,'limit',$mosConfig_list_limit));
			$limit = ($limit?$limit:$mosConfig_list_limit);
			$limitstart = intval(mosGetParam($_GET,'limitstart',0));

			// prepares searchword for proper display in url
			$searchword_clean = urlencode($searchword_clean);

			if($n) {
				// html output
				require_once ($GLOBALS['mosConfig_absolute_path'].'/includes/pageNavigation.php');
				$pageNav = new mosPageNav($total,$limitstart,$limit);

				search_html::display($rows,$params,$pageNav,$limitstart,$limit,$total,$totalRows,$searchword_clean);
			} else {
				// html output
				search_html::displaynoresult();
			}

			// html output
			search_html::conclusion($searchword_clean,$pageNav);
		}

		// displays back button
		echo '<br/>';
	mosHTML::BackButton($params,0);
}

function mosLogSearch($search_term) {
	global $database;
	global $mosConfig_enable_log_searches;

	if(@$mosConfig_enable_log_searches) {
		$query = "SELECT hits FROM #__core_log_searches WHERE LOWER( search_term ) = ".
			$database->Quote($search_term);
		$database->setQuery($query);
		$hits = intval($database->loadResult());
		if($hits) {
			$query = "UPDATE #__core_log_searches SET hits = ( hits + 1 ) WHERE LOWER( search_term ) = ".
				$database->Quote($search_term);
			$database->setQuery($query);
			$database->query();
		} else {
			$query = "INSERT INTO #__core_log_searches VALUES ( ".$database->Quote($search_term).", 1 )";
			$database->setQuery($query);
			$database->query();
		}
	}
}
?>
