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

include($mosConfig_absolute_path . '/administrator/components/com_customquickicons/lang/russian.php' );

function MOD_quickiconButton( $row, $newWindow ){
	global $mosConfig_live_site,$my;
	$title  = ( $row->akey ? $row->title . ' [ ' . _QI_MOD_ACCESSKEY . ' ' . $row->akey . ' ]' : ( $row->title ? $row->title : $row->text ));
	$accKey = $row->akey ? ' accesskey="' . $row->akey . '"' : ''; ?>
				<div><a href="<?php echo htmlentities( $row->target ); ?>" title="<?php echo $title; ?>"<?php echo $accKey . $newWindow; ?>>
				<?php
				$icon = '<img src="' . $mosConfig_live_site . $row->icon . '" alt="" border="0" />';
				if( $row->display == 1 ){ ?>
					<span><?php echo $row->prefix . $row->text . $row->postfix; ?></span>
					<?php
					}elseif( $row->display == 2 ){
						echo $icon;
					}else{
						echo $icon; ?>
						<?php echo $row->prefix . $row->text . $row->postfix; ?>
						<?php
					} ?>
				</a></div>
	<?php
}
?>
<div class="admin_front">
<div class="cpicons">
	<?php
		$query = 'SELECT *'
		. ' FROM #__custom_quickicons'
		. ' WHERE published = 1'
		. ' AND gid <= ' . $my->gid
		. ' ORDER BY ordering'
		;
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		foreach( $rows AS $row ){
			$callMenu = true;
			if( $row->cm_check ){
				if( !file_exists( $mosConfig_absolute_path . '/administrator/components/' . $row->cm_path )){
					$callMenu = false;
				}
			}
			if( $callMenu ){
				$newWindow = $row->new_window ? ' target="_blank"' : '';
				MOD_quickiconButton( $row, $newWindow );
			}
		} ?>
</div>
			<?php
		$securitycheck = intval( $params->get( 'securitycheck', 1 ) );
		if( !empty( $securitycheck )) {
			// show security setting check
			josSecurityCheck('88%');
		} ?>
	</div>
	<?php if($my->usertype=='Super Administrator'){?>
		<a href="index2.php?option=com_customquickicons" style="display: block; clear: both; text-align:left; padding-top:10px;"><img border="0" src="<?php echo $mosConfig_live_site;?>/administrator/images/shortcut.png" />�������� ������ �������� �������</a>
	<?php
}
?>
