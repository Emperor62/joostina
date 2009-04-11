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


function writableCell($folder) {
	echo '<tr><td class="item">'.$folder.'/</td><td align="left">';
	echo is_writable($GLOBALS['mosConfig_absolute_path'].'/'.$folder)?'<b><font color="green">'._WRITEABLE.'</font></b>':'<b><font color="red">'._UNWRITEABLE.'</font></b></td>';
	echo '</tr>';
}

/**
* @package Joostina
*/
class HTML_installer {

	// Drawing control button
	function quickiconButton($link,$image,$text) {
		?>
		<span>
		<a href="<?php echo $link; ?>" title="<?php echo $text; ?>">
		<?php
		echo mosAdminMenus::imageCheckAdmin($image,'/'.ADMINISTRATOR_DIRECTORY.'/images/',null,null,$text);
		echo $text;
		?>
		</a>
		</span>
		<?php
	}
	//Drawing group of control buttons
	function cPanel() {?>

		<table>
		<tr>
		<td width="100%" valign="top">
		<div class="cpicons">
		<?php

		$link = 'index2.php?option=com_installer&amp;element=installer';
		HTML_installer::quickiconButton($link,'down.png', _INSTALLATION);

		$link = 'index2.php?option=com_installer&amp;element=component';
		HTML_installer::quickiconButton($link,'db.png', _COMPONENTS);

		$link = 'index2.php?option=com_installer&amp;element=module';
		HTML_installer::quickiconButton($link,'db.png', _MODULES);

		$link = 'index2.php?option=com_installer&amp;element=mambot';
		HTML_installer::quickiconButton($link,'ext.png', _MAMBOTS);

		$link = 'index2.php?option=com_installer&amp;element=template';
		HTML_installer::quickiconButton($link,'joostina.png', _MENU_SITE_TEMPLATES);
		
		$link = 'index2.php?option=com_installer&amp;element=template&client=admin';
		HTML_installer::quickiconButton($link,'joostina.png', _MENU_ADMIN_TEMPLATES);

		$link = 'index2.php?option=com_installer&amp;element=language';
		HTML_installer::quickiconButton($link,'log.png', _SITE_LANGUAGES);

		?>
		</div>
		</td>
		</tr>
		</table>
		<?php
	}
	
	function showInstallForm($title,$option,$element,$client = "",$p_startdir = "",	$backLink = "") 
	{
	?>
	<script language="javascript" type="text/javascript">
		function submitbutton3(pressbutton) {
			var form = document.adminForm_dir;
			if (form.userfile.value == ""){
				alert( "<?php echo _CHOOSE_DIRECTORY_PLEASE?>" );
			} else {
				form.submit();
			}
		}
		function submitbutton4(pressbutton) {
			var form = document.adminForm_url;
			if (form.url.value == "" || form.url.value == "http://"){
				alert( "<?php echo _CHOOSE_URL_PLEASE?>" );
			} else {
				form.submit();
			}
		}
	</script>
		<table class="adminheading">
		<tr>
			<th class="install"><?php echo $title; ?></th>
			<td align="right" class="jtd_nowrap"><?php echo $backLink; ?></td>
		</tr>
		<tr> 
			<?php HTML_installer::cPanel(); ?>
		</tr>
		</table>
		<table width="100%">
			<tr>
				<td>
					<form enctype="multipart/form-data" action="index2.php" method="post" name="filename">
					<table class="adminform" style="width: 100%;">
					<tr>
						<th colspan="2"><?php echo _ZIP_UPLOAD_AND_INSTALL?></th>
					</tr>
					<tr>
					<td align="left" style="width: 15%; color: red; font-weight: bold;">
					<?php 
						if(!extension_loaded('zlib')) {
							echo _CANNOT_INSTALL_NO_ZLIB;
						}
					?>
					</td>
					</tr>
					<tr>
						<td align="left" style="width: 15%;">
							<?php echo _PACKAGE_FILE?>:
						</td>
						<td align="left" style="width: 85%;">
							<input class="text_area" name="userfile" type="file" size="50"/>
							<input class="button" type="submit" value="<?php echo _UPLOAD_AND_INSTALL?>" />
						</td>
					</tr>
					</table>
					<input type="hidden" name="task" value="uploadfile"/>
					<input type="hidden" name="option" value="com_installer"/>
					<input type="hidden" name="element" value="installer"/>
					<input type="hidden" name="client" value="<?php echo $client; ?>"/>
					<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
					</form>
					<br />
				</td>
			</tr>
			<tr>
				<td>
					<form enctype="multipart/form-data" action="index2.php" method="post" name="adminForm_dir">
					<table class="adminform" style="width: 100%;">
					<tr>
						<th colspan="2"><?php echo _INSTALL_FROM_DIR?></th>
					</tr>
					<tr>
						<td align="left" style="width: 15%;">
							<?php echo _INSTALLATION_DIRECTORY?>:
						</td>
						<td align="left" style="width: 85%;">
							<input type="text" name="userfile" class="text_area" size="50" value="<?php echo $p_startdir; ?>"/>
							<input type="button" class="button" value="<?php echo _INSTALL ?>" onclick="submitbutton3()" />
						</td>
					</tr>
					</table>
					<input type="hidden" name="task" value="installfromdir" />
					<input type="hidden" name="option" value="<?php echo $option; ?>"/>
					<input type="hidden" name="element" value="installer"/>
					<input type="hidden" name="client" value="<?php echo $client; ?>"/>
					<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
					</form>
					<br />
				</td>
			</tr>
			<tr>
				<td>
					<form enctype="multipart/form-data" action="index2.php" method="post" name="adminForm_url">
					<table class="adminform" style="width: 100%;">
					<tr>
						<th colspan="2"><?php echo _INSTALL_FROM_URL?></th>
					</tr>
					<tr>
					<td align="left" style="width: 15%; color: red; font-weight: bold;">
					<?php 
						if(!(bool)ini_get('allow_url_fopen')) {
						echo _CANNOT_INSTALL_DISABLED_UPLOAD;
						}
					?>
					</td>
					</tr>
					<tr>
						<td align="left" style="width: 15%;">
							<?php echo _INSTALLATION_URL?>:
						</td>
						<td align="left" style="width: 85%;">
							<input type="text" name="url" class="text_area" size="50" value="http://"/>
							<input type="button" class="button" value="<?php echo _INSTALL?>" onclick="submitbutton4()" />
						</td>
					</tr>
					</table>
					<input type="hidden" name="task" value="installfromurl" />
					<input type="hidden" name="option" value="<?php echo $option; ?>"/>
					<input type="hidden" name="element" value="installer"/>
					<input type="hidden" name="client" value="<?php echo $client; ?>"/>
					<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
					</form>
				</td>
			</tr>
		</table>
		<br />
		<table class="adminlist">
<?php
		writableCell('media');
		writableCell(ADMINISTRATOR_DIRECTORY.'/components');
		writableCell('components');
		writableCell('images/stories');
?>
		</table>
<?php
	}

	function showInstallMessage($message,$title,$url) {
		global $PHP_SELF;
?>
	<table class="adminheading">
		<tr>
			<th class="install"><?php echo $title; ?></th>
		</tr>
	</table>
	<table class="adminform">
		<tr>
			<td align="left"><strong><?php echo $message; ?></strong></td>
		</tr>
		<tr>
			<td colspan="2" align="center">[&nbsp;<a href="<?php echo $url; ?>" style="font-size: 16px; font-weight: bold"><?php echo _CONTINUE?> ...</a>&nbsp;]</td>
		</tr>
	</table>
<?php
	}
}
?>
