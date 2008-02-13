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

/**
* @package Mambo_4.5.1
*/
class TOOLBAR_JCE {
        /**
    	* Writes a common 'publish' button
    	* @param string An override for the task
    	* @param string An override for the alt text
    	*/
    	function accessButton( $task='applyaccess', $alt='������' ) {
    		?>
    		<li>
    			<a class="tb-access" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('�������� ����������� ��� ���������� ������ �������'); } else {submitbutton('<?php echo $task;?>', '');}">
    				<?php echo $alt; ?></a>
    		</li>
    	 	<?php
	   }
	   function helpButton( $section, $alt='������') {
			?>
    	 	<li>
    			<a class="tb-help" href="javascript:void(0);" onclick="window.open('http://www.cellardoor.za.net/index2.php?option=com_content&amp;task=findkey&amp;pop=1&amp;keyref=<?php echo $section;?>', '������', 'width=750,height=500,top=20,left=20,scrollbars=yes,resizable=yes');">
    				<?php echo $alt; ?></a>
    		</li>
    	 	<?php
	   }
        function _CONFIG() {
                mosMenuBar::startTable();
                mosMenuBar::save();
                mosMenuBar::custom('main', '-back', '', '�������', false);
                mosMenuBar::spacer();
                mosMenuBar::cancel();
                mosMenuBar::endTable();
        }
        function _PLUGINS() {
    		mosMenuBar::startTable();
    		mosMenuBar::publishList();
    		mosMenuBar::spacer();
    		mosMenuBar::unpublishList();
    		mosMenuBar::spacer();
    		mosMenuBar::custom('newplugin', '-new', '', '�����', false);
    		mosMenuBar::spacer();
    		mosMenuBar::custom('installplugin', '-new', '', '���������',false);
    		mosMenuBar::spacer();
    		mosMenuBar::custom('editlayout', '-preview', '', '������������',false);
    		mosMenuBar::spacer();
    		TOOLBAR_JCE::accessButton();
    		mosMenuBar::spacer();
			TOOLBAR_JCE::helpButton('admin.plugins.view');
			mosMenuBar::spacer();
    		mosMenuBar::custom('cancel', '-cancel', '', '������', false);
    		mosMenuBar::endTable();
        }
        function _EDIT_PLUGINS() {
    		global $id;

    		mosMenuBar::startTable();
    		mosMenuBar::custom('saveplugin', '-save', '', '���������', false);
    		mosMenuBar::spacer();
    		if ( $id ) {
    			// for existing content items the button is renamed `close`
    			mosMenuBar::custom('canceledit', '-cancel', '', '�������', false);
    		} else {
                mosMenuBar::custom('canceledit', '-cancel', '', '������', false);
    		}
    		mosMenuBar::spacer();
    		mosMenuBar::endTable();
    	}
    	function _INSTALL( $element ) {
            if( $element == 'plugins' ){
                mosMenuBar::startTable();
                mosMenuBar::custom('showplugins', '-new', '', '�������', false);
                mosMenuBar::spacer();
                mosMenuBar::custom('removeplugin', '-delete', '', '��������', false);
                mosMenuBar::spacer();
				TOOLBAR_JCE::helpButton('admin.plugins.install');
				mosMenuBar::spacer();
                mosMenuBar::custom('cancel', '-cancel', '', '������', false);
    		    mosMenuBar::endTable();
            }
        }
        function _LAYOUT() {
    		mosMenuBar::startTable();
    		mosMenuBar::custom('savelayout', '-save', '', '���������', false);
    		mosMenuBar::spacer();
			TOOLBAR_JCE::helpButton('admin.layout');
			mosMenuBar::spacer();
    		mosMenuBar::custom('cancel', '-cancel', '', '������', false);
    		mosMenuBar::endTable();
        }
        function _LANGS() {
    		mosMenuBar::startTable();
    		mosMenuBar::publishList('publishlang');
    		mosMenuBar::spacer();
    		mosMenuBar::custom('removelang', '-delete', '', '�������', false);
    		mosMenuBar::spacer();
    		mosMenuBar::custom('newlang', '-new', '', '����������',false);
			mosMenuBar::spacer();
			TOOLBAR_JCE::helpButton('admin.languages');
			mosMenuBar::spacer();
    		mosMenuBar::custom('cancel', '-cancel', '', '������', false);
    		mosMenuBar::endTable();
        }
}
?>
