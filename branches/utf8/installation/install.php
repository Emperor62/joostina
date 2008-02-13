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

define( "_VALID_MOS", 1 );

if (file_exists( '../configuration.php' ) && filesize( '../configuration.php' ) > 10) {
        header( 'Location: ../index.php' );
        exit();
}
/** Include common.php */
include_once( 'common.php' );
function writableCell( $folder ) {
        echo "<tr>";
        echo "<td class=\"item\">" . $folder . "/</td>";
        echo "<td align=\"left\">";
        echo is_writable( "../$folder" ) ? '<b><font color="green">�������� ��� ������ </font></b>' : '<b><font color="red">���������� ��� ������</font></b>' . "</td>";
        echo "</tr>";
}
?>
<?php echo "<?xml version=\"1.0\" encoding=\"windows-1251\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Joostina - Web-���������. �������� ...</title>
 <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link rel="shortcut icon" href="../images/favicon.ico" />
 <link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body>
 <div id="wrapper">
  <div id="header">
   <div id="joomla"><img src="header_install.png" alt="��������� Joomla" /></div>
  </div>
 </div>
 <div id="ctr" align="center">
  <form action="install1.php" method="post" name="adminForm" id="adminForm">
   <div class="install">
    <div id="stepbar">
     <div class="step-off">�������� �������</div>
     <div class="step-on">��������</div>
     <div class="step-off">��� 1</div>
     <div class="step-off">��� 2</div>
     <div class="step-off">��� 3</div>
     <div class="step-off">��� 4</div>
    </div>
    <div id="right">
     <div id="step">��������</div>
     <div class="far-right">
      <input class="button" type="submit" name="next" value="����� &gt;&gt;"/>
     </div>
     <div class="clr"></div>
     <h1>�������� GNU/GPL:</h1>
     <div class="licensetext">
      Joostina- ��������� ����������� �����������, ���������������� �� �������� GNU/GPL, ��� ������������� ������� �� ������ ��������� ����������� � ��������������� ���������.
     </div>
     <div class="clr"></div>
     <div class="license-form">
      <div class="form-block" style="padding: 0px;">
       <iframe src="gpl.html" class="license" frameborder="0" scrolling="auto"></iframe>
      </div>
     </div>
     <div class="clr"></div>
     <div class="clr"></div>
    </div>
    <div id="break"></div>
    <div class="clr"></div>
    <div class="clr"></div>
   </div>
  </form>
 </div>
 <div class="ctr"><a href="http://www.Joostina.ru" target="_blank">Joostina</a> - ��������� ����������� �����������, ���������������� �� �������� GNU/GPL.</div>
</body>
</html>
