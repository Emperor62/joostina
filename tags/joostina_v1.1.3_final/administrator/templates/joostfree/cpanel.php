<?php
/** joostfree
* @version 1.0
* @����������� � ������������� (C) 2007 Joom.Ru
* @translator Nikoay P. Kirsh aka boston (boston56@mail.ru)
*/

defined( '_VALID_MOS' ) or die( '������ ����� ����� ��������.' );

$tabs = new mosTabs(0,1);
	$tabs->startPane("ico");
	$tabs->startTab("������","ico-page");
		mosLoadAdminModules( 'icon', 0 );
	$tabs->endTab();
	$tabs->startTab("������","panel-page");
?>
	<div class="polovina">
<?php
	mosLoadAdminModules( 'advert1', 1 );
?></div>
	<div class="polovina">
<?php
	mosLoadAdminModules( 'advert2', 1 );
?>
	</div>
<?php
	mosLoadAdminModules( 'cpanel', 1 );
	$tabs->endTab();
	$tabs->endPane();
?>
