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

class HTML_JCEAdmin {
    function showAdmin()
    {
        global $mainframe;
        ?>
        <form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="cpanel">
			������������ JCE
			</th>
        </tr>
        <tr>
        <td width="55%" valign="top">
	    <div id="cpanel">
            <div style="float:left;">
        		<div class="icon">
        			<a href="index2.php?option=com_jce&task=config&hidemainmenu=1">
        				<div class="iconimage">
        					<img src="<?php echo $mainframe->getCfg('live_site');?>/administrator/images/config.png" alt="������������" align="middle" name="image" border="0" />				</div>
        				������������ ���������</a>
        		</div>
    		</div>
    		<div style="float:left;">
        		<div class="icon">
        			<a href="index2.php?option=com_jce&task=showplugins">
        				<div class="iconimage">
        					<img src="<?php echo $mainframe->getCfg('live_site');?>/administrator/images/module.png" alt="�������� �������" align="middle" name="image" border="0" />				</div>
        				�������</a>
        		</div>
    		</div>
    		<div style="float:left;">
        		<div class="icon">
        			<a href="index2.php?option=com_jce&task=install&element=plugins">
        				<div class="iconimage">
        					<img src="<?php echo $mainframe->getCfg('live_site');?>/administrator/images/install.png" alt="���������� �������" align="middle" name="image" border="0" />				</div>
        				��������� ��������</a>
        		</div>
    		</div>
    		<div style="float:left;">
        		<div class="icon">
        			<a href="index2.php?option=com_jce&task=editlayout&hidemainmenu=1">
        				<div class="iconimage">
        					<img src="<?php echo $mainframe->getCfg('live_site');?>/administrator/images/templatemanager.png" alt="�������� ������������" align="middle" name="image" border="0" />				</div>
        				������������ �������</a>
        		</div>
    		</div>
    		<div style="float:left;">
        		<div class="icon">
        			<a href="index2.php?option=com_jce&task=lang&hidemainmenu=1">
        				<div class="iconimage">
        					<img src="<?php echo $mainframe->getCfg('live_site');?>/administrator/images/langmanager.png" alt="�������� �����������" align="middle" name="image" border="0" />				</div>
        				�������� �����������</a>
        		</div>
    		</div>
		</div>
		</td>
        </tr>
        </table>
        <?php
    }
}
?>
