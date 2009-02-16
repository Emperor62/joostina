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

global $mosConfig_live_site, $mosConfig_absolute_path, $option, $JPLang;
require_once("$mosConfig_absolute_path/administrator/components/$option/includes/sajax.php");
require_once("$mosConfig_absolute_path/administrator/components/$option/includes/ajaxtool.php");
?>
<script language="javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/<?php echo $option; ?>/js/xp_progress.js">
	// WinXP Progress Bar- By Brian Gosselin- http://www.scriptasylum.com/
</script>
<script language="JavaScript" type="text/javascript">
	/*
	 * (S)AJAX Library code
	 */
<?php
	sajax_show_javascript();
?>
	var globRoot;

	function ToggleFilter( myRoot, myDir, myID ) {
		var sCheckStatus = (document.getElementById(myID).checked == true) ? "on" : "off";

		globRoot = myRoot;

		document.getElementById("DEFScreen").style.display = "none";
		document.getElementById("DEFProgressBar").style.display = "block";

		x_toggleDirFilter( myRoot, myDir, sCheckStatus, ToggleFilter_cb );
	}

	function ToggleFilter_cb( myRet ) {
		dirSelectionHTML( globRoot );
		document.getElementById("DEFScreen").style.display = "block";
		document.getElementById("DEFProgressBar").style.display = "none";
	}

	function dirSelectionHTML( myRoot ) {
		globRoot = myRoot;
		x_dirSelectionHTML( myRoot, cb_dirSelectionHTML );
	}

	function cb_dirSelectionHTML( myRet ) {
		document.getElementById("DEFOperationList").innerHTML = myRet;
	}
</script>

<div id="DEFProgressBar" style="display:none;" class="sitePack">
	<h4>Please wait...</h4>
	<script type="text/javascript">
		var bar0 = createBar(320,15,'white',1,'black','blue',85,7,3,"");
	</script>
</div>

<div id="DEFScreen">
	<table class="adminheading">
		<tr>
			<th class="info" nowrap rowspan="2">
				<?php echo $JPLang['common']['jptitle']; ?>
			</th>
		</tr>
		<tr>
			<td nowrap><h2><?php echo $JPLang['cpanel']['def']; ?></h2></td>
		</tr>
	</table>

	<div id="DEFOperationList">
		<script type="text/javascript">
			dirSelectionHTML('<?php echo $mosConfig_absolute_path; ?>');
		</script>
	</div>
</div>