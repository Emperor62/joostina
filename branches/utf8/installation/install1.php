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


// Set flag that this is a parent file
define( "_VALID_MOS", 1 );
/** Include common.php */
require_once( 'common.php' );
$DBhostname = mosGetParam( $_POST, 'DBhostname', '' );
$DBuserName = mosGetParam( $_POST, 'DBuserName', '' );
$DBpassword = mosGetParam( $_POST, 'DBpassword', '' );
$DBname     = mosGetParam( $_POST, 'DBname', '' );
$DBPrefix   = mosGetParam( $_POST, 'DBPrefix', 'jos_' );
$DBDel      = intval( mosGetParam( $_POST, 'DBDel', 0 ) );
$DBBackup   = intval( mosGetParam( $_POST, 'DBBackup', 0 ) );
$DBSample   = intval( mosGetParam( $_POST, 'DBSample', 1 ) );
$DBold      = intval( mosGetParam( $_POST, 'DBold', 0 ) );
$DBexp      = intval( mosGetParam( $_POST, 'DBexp', 0 ) );
// �������� �� 1 ��� ����������� ������ ������������������ ���� ���� �����
$YA_UVEREN = 0;

?>
<?php echo "<?xml version=\"1.0\" encoding=\"windows-1251\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Joostina - Web-���������. ��� 1 ...
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
		<link rel="shortcut icon" href="../images/favicon.ico" />
		<link rel="stylesheet" href="install.css" type="text/css" />
<script  type="text/javascript">
<!--
function check() {
// ����� �������� ������������
var formValid=false;
var f = document.form;
if ( f.DBhostname.value == '' ) {
alert('����������, ������� ��� ����� MySQL');
f.DBhostname.focus();
formValid=false;
} else if ( f.DBuserName.value == '' ) {
alert('����������, ������� ��� ������������ ���� ������ MySQL');
f.DBuserName.focus();
formValid=false;
} else if ( f.DBname.value == '' ) {
alert('����������, ������� ��� ��� ����� ����� ��');
f.DBname.focus();
formValid=false;
} else if ( f.DBPrefix.value == '' ) {
alert('��� ���������� ������ Joostina �� ������ ������ ������� ������ �� MySQL.');
f.DBPrefix.focus();
formValid=false;
} else if ( f.DBPrefix.value == 'old_' ) {
alert('�� �� ������ ������������ ������� ������ "old_", ��� ��� Joostina ���������� ��� ��� �������� ��������� ������.');
f.DBPrefix.focus();
formValid=false;
} else if ( confirm('�� �������, ��� ��������� ����� ������? \Joostina ����� ��������� ������� � ��, ��������� ������� �� �������.')) {
formValid=true;
}
return formValid;
}
//-->
</script>
	</head>
	<body onload="document.form.DBhostname.focus();">
		<div id="wrapper">
			<div id="header">
				<div id="joomla">
					<img src="header_install.png" alt="��������� Joostina" />
				</div>
			</div>
		</div>
		<div id="ctr" align="center">
			<form action="install2.php" method="post" name="form" id="form" onsubmit="return check();">
				<div class="install">
					<div id="stepbar">
						<div class="step-off">�������� �������
						</div>
						<div class="step-off">��������
						</div>
						<div class="step-on">��� 1
						</div>
						<div class="step-off">��� 2
						</div>
						<div class="step-off">��� 3
						</div>
						<div class="step-off">��� 4
						</div>
					</div>
					<div id="right">
						<div class="far-right">
							<input class="button" type="submit" name="next" value="����� > >"/>
						</div>
						<div id="step">��� 1
						</div>
						<div class="clr">
						</div><h1>������������ ���� ������ MySQL:</h1>
						<div class="install-form">
							<div class="form-block">
								<table class="content2" width="100%">
									<tr class="trongate-1">
										<td colspan="2"> ��� ����� MySQL<br />
											<input class="inputbox" type="text" name="DBhostname" value="<?php echo "$DBhostname"; ?>" /></td><td><br />&nbsp;&nbsp;
											������ ��� &nbsp;<b>localhost</b>
										</td>
									</tr>
									<tr class="trongate-2">
										<td colspan="2" valign="top"> ��� ������������ MySQL<br />
											<input class="inputbox" type="text" name="DBuserName" value="<?php echo "$DBuserName"; ?>" /></td><td>&nbsp;&nbsp;
											��� ��������� �� �������� ���������� ���� ����� ������������ ���&nbsp;
											<b>
												<font color="green">root
												</font></b>
											, � ��� ��������� � ���������, ������� ������, ���������� � �������.
											</td>
									</tr>
									<tr class="trongate-1">
										<td colspan="2" valign="top"> ������ ������� � �� MySQL<br />
											<input class="inputbox" type="text" name="DBpassword" value="<?php echo "$DBpassword"; ?>" /></td><td>&nbsp;&nbsp;
											 �������� ���� ������ ��� �������� ��������� ��� ������� ������ ������� � ����� ��, ���������� � �������.
											</td>
									</tr>
									<tr class="trongate-2">
										<td colspan="2" valign="top"> ��� �� MySQL<br />
											<input class="inputbox" type="text" name="DBname" value="<?php echo "$DBname"; ?>" /></td><td>&nbsp;&nbsp;
											��� ������������ ��� ����� ��, ������� ����� �������������� ��� �����
											</td>
									</tr>
									<tr class="trongate-1">
										<td colspan="2" valign="top"> ������� ������ �� MySQL<br />
											<input class="inputbox" type="text" name="DBPrefix" value="<?php echo "$DBPrefix"; ?>" /></td><td>&nbsp;&nbsp;
											����������� ������� ������ ��� ��������� � ���� ��.
											�� ����������� <font color="red">'old_'</font> - ��� ����������������� �������.
											</td>
									</tr>
									<tr class="trongate-2">
										<td valign="top">
											<input type="checkbox" name="DBDel" id="DBDel" value="1" <?php if ($DBDel) echo 'checked="checked"'; ?> /></td>
										<td valign="top">
											<label for="DBDel">������� ������������ �������.
											</label></td>
										<td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;
											 ��� ������������ ������� �� ���������� ��������� Joostina ����� �������.
											</td>
									</tr>
									<tr class="trongate-1">
										<td valign="top">
											<input type="checkbox" name="DBBackup" id="DBBackup" value="1" <?php if ($DBBackup) echo 'checked="checked"'; ?> /></td>
										<td valign="top">
											<label for="DBBackup">������� ��������� ����� ������������ ������
											</label></td><td>&nbsp;&nbsp;&nbsp;&nbsp;
											 ��� ������������ ��������� ����� ������ �� ���������� ��������� Joostina ����� ��������.
											</td>
									</tr>
									<tr class="trongate-2">
										<td valign="top">
											<input type="checkbox" name="DBSample" id="DBSample" value="1" <?php if ($DBSample) echo 'checked="checked"'; ?> /></td>
										<td valign="top" width="200px">
											<label for="DBSample">���������� ���������������� ������
											</label></td>
										<td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;
											�� ���������� ���, ���� �� ��� �� ������� � Joostina!
											</td>
									</tr>
									<tr class="trongate-1">
										<td valign="top">
											<input type="checkbox" name="DBold" id="DBold" value="1" <?php if ($DBold) echo 'checked="checked"'; ?> /></td>
										<td valign="top">
											<label for="DBold">��������� MySQL ������ 4.1
											</label></td><td>&nbsp;&nbsp;&nbsp;&nbsp;
											 ������������ ������ � ������ ������������� � �������� �������� ���� ������.
											</td>
									</tr>
									<?php if($YA_UVEREN){?>
									<tr class="trongate-2">
										<td valign="top">
											<input type="checkbox" name="DBexp" id="DBexp" value="1" <?php if ($DBexp) echo 'checked="checked"'; ?> /></td>
										<td valign="top">
											<label for="DBexp">����� ��� ������
											</label></td><td>&nbsp;&nbsp;&nbsp;&nbsp;
											<font color="red"><b>��������! ����������������� �����.</b><br />������������ ����� ��� ������ ��� ������ �������.</font>
										</td>
									</tr>
									<?php };?>
								</table>
							</div>
						</div>
					</div>
					<div class="clr">
					</div>
				</div>
			</form>
		</div>
		<div class="clr"></div>
		 <div class="ctr" id="footer"><a href="http://www.Joostina.ru" target="_blank">Joostina</a> - ��������� ����������� �����������, ���������������� �� �������� GNU/GPL.</div>
	</body>
</html>
