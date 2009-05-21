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

$moduleclass_sfx= $params->get( 'moduleclass_sfx' );
$button_vis		= $params->get( 'button', 1 );
$button_pos		= $params->get( 'button_pos', 'left' );
$button_text	= $params->get( 'button_text', _SEARCH_TITLE );
$width			= intval( $params->get( 'width', 20 ) );
$text			= $params->get( 'text', _SEARCH_BOX );
$text_pos		= $params->get( 'text_pos', 'inside' );
$set_Itemid		= intval( $params->get( 'set_itemid', 0 ) );

switch ($text_pos){
    case 'iside':
    default:
        $output = '<input name="searchword" id="mod_search_searchword" maxlength="100" alt="search" class="inputbox'. $moduleclass_sfx .'" type="text" size="'. $width .'" value="'. $text .'"  onblur="if(this.value==\'\') this.value=\''. $text .'\';" onfocus="if(this.value==\''. $text .'\') this.value=\'\';" />';
        break;

    case 'left':
        $output = '<strong>'.$text.'</strong>&nbsp;<input name="searchword" id="mod_search_searchword" maxlength="100" alt="search" class="inputbox'. $moduleclass_sfx .'" type="text" size="'. $width .'" value=""  />';
    break;

    case 'top':
        $output = '<strong>'.$text.'</strong><br /><input name="searchword" id="mod_search_searchword" maxlength="100" alt="search" class="inputbox'. $moduleclass_sfx .'" type="text" size="'. $width .'" value=""  />';
    break;

    case 'hidden':
        $output = '<input name="searchword" id="mod_search_searchword" maxlength="100" alt="search" class="inputbox'. $moduleclass_sfx .'" type="text" size="'. $width .'" value=""  />';
    break;

}



if ( $button_vis ) {
	$button = '<input type="submit" value="'. $button_text .'" class="button'. $moduleclass_sfx .'"/>';
}else{
	$button = '';
}

switch ( $button_pos ) {
	case 'top':
		$button = $button .'<br/>';
		$output = $button . $output;
		break;

	case 'bottom':
		$button =  '<br/>'. $button;
		$output = $output . $button;
		break;

	case 'right':
		$output = $output . $button;
		break;

	case 'left':
	default:
		$output = $button . $output;
		break;
}	  

// ��������� Itemid
if ( $set_Itemid ) {
	$_Itemid	= $set_Itemid;
	$link		= 'index.php?option=com_search&amp;Itemid='. $set_Itemid;
} else {
	$query = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_search' AND published = 1";
	$database->setQuery( $query,0,1 );
	$s_itemid = $database->loadResult();

	// try to auto detect search component Itemid
	if ( $s_itemid ) {
		$_Itemid	= $s_itemid;
		$link		= 'index.php?Itemid='. $_Itemid;
	} else {
	// Assign no Itemid
	$_Itemid	= '';
	$link		= 'index.php';
	}
}
?>

<form action="<?php echo $link; ?>" method="post">
	<div class="search<?php echo $moduleclass_sfx; ?>"><?php echo $output; ?></div>
	<input type="hidden" name="option" value="com_search" />
	<input type="hidden" name="Itemid" value="<?php echo $_Itemid; ?>" />
</form>