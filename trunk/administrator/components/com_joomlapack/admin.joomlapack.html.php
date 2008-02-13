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

global $JPLang;

class jpackScreens {
	function fConfig() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fConfig.php" );
	}

	function fPack() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fPack.php" );
	}

	function fMain() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fMain.php" );
	}

	function fBUAdmin() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fBUAdmin.php" );
	}

	function fDirExclusion() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fDirExclusion.php" );
	}

	function fLog() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fLog.php" );
	}

	function fDebug() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fDebug.php" );
	}

	function CommonFooter() {
		global $option, $JPLang;
		return;
	?>
		<p>
			[
			<a href="index2.php?option=<?php echo $option; ?>"><?php echo $JPLang['cpanel']['home']; ?></a>
			]
			<br />
			<span style="font-size:x-small;">
			JoomlaPack <?php echo _JP_VERSION; ?>. Copyright &copy; 2006-2007 <a href="mailto:nikosdion@gmail.com">Nicholas K. Dionysopoulos</a>.<br/>
			<a href="http://forge.joomla.org/sf/projects/joomlapack">JoomlaPack</a> is Free Software released under the GNU/GPL License.
			</span>
		</p>
	<?php
	}
}
?>
