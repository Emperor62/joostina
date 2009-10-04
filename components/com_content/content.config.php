<?php /**
 * @package Joostina
 * @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
 * @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
 * Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
 * ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
 */

// ������ ������� �������
defined('_VALID_MOS') or die();

class configContent_ucontent extends dbConfig {
	/**
	 * ��������� ��������
	 */
	var $title = _C_CONTENT_USER_CONTENT;
	/**
	 * ���������� ����
	 */
	var $date = 1;
	/**
	 * ���������� ���������� ����������
	 */
	var $hits = 1;
	/**
	 * ���������� ������/���������
	 */
	var $section = 1;
	/**
	 * ���� �������
	 */
	var $filter = 1;
	/**
	 * ����� ���� ����������
	 */
	var $order_select = 1;
	/**
	 * ���������� ������ ��� ������ ���������� ������� �� ��������
	 */
	var $display = 1;
	/**
	 * ���������� ������� �� �������� �� ���������
	 */
	var $display_num = 10;
	/**
	 * ��������� �������
	 */
	var $headings = 1;
	/**
	 * ������������ ���������
	 */
	var $navigation = 1;

	function configContent_ucontent(&$db, $group = 'com_content', $subgroup = 'user_page') {
		$this->dbConfig($db, $group, $subgroup);
	}

	function display_config($option) { ?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			submitform( pressbutton );

		}
		</script>
	<table class="adminheading"><tbody>
		<tr><th class="config">
		<?php echo _C_CONTENT_SET_DEF_CONTENT_SETTINGS?><br />
		<small><?php echo _C_CONTENT_SET_USER_CONTENT?></small>
		</th></tr>
	</tbody></table>
	<form action="index2.php" method="post" name="adminForm">
		<table class="adminform">
			<tr>
				<td width="250"><?php echo _PAGE_TITLE?></td>
				<td><input class="inputbox" type="text" name="title" size="100" value="<?php echo $this->title; ?>" /></td>
			</tr>
			<tr>
				<td><?php echo _C_CONTENT_SET_DISPLAY_DATE?></td>
				<td><?php echo mosHTML::yesnoRadioList('date', '', $this->date?1 : 0); ?></td>
			</tr>
			<tr>
				<td><?php echo _C_CONTENT_SET_DISPLAY_HIT_COUNTER?></td>
				<td><?php echo mosHTML::yesnoRadioList('hits', '', $this->hits?1 : 0); ?></td>
			</tr>
			<tr>
				<td><?php echo _C_CONTENT_SET_DISPLAY_SEC_CAT?></td>
				<td><?php echo mosHTML::yesnoRadioList('section', '', $this->section?1 : 0); ?></td>
			</tr>
			<tr>
				<td><?php echo _C_CONTENT_SET_DISPLAY_FILTER?></td>
				<td><?php echo mosHTML::yesnoRadioList('filter', '', $this->filter?1 : 0); ?></td>
			</tr>
			<tr>
				<td><?php echo _C_CONTENT_SET_DISPLAY_ORDER?></td>
				<td><?php echo mosHTML::yesnoRadioList('order_select', '', $this->order_select?1 : 0); ?></td>
			</tr>
			<tr>
				<td><?php echo _C_CONTENT_SET_DISPLAY_PAGE_LIMIT?></td>
				<td><?php echo mosHTML::yesnoRadioList('display', '', $this->display?1 : 0); ?></td>
			</tr>
			<tr>
				<td><?php echo _C_CONTENT_SET_DISPLAY_DEF_PAGE_LIMIT?></td>
				<td><input class="inputbox" type="text" name="display_num" value="<?php echo $this->display_num; ?>" /></td>
			</tr>
			<tr>
				<td><?php echo _C_CONTENT_SET_DISPLAY_TABLE_HEADER?></td>
				<td><?php echo mosHTML::yesnoRadioList('headings', '', $this->headings?1 : 0); ?></td>
			</tr>
			<tr>
				<td><?php echo _C_CONTENT_SET_DISPLAY_PAGENAV?></td>
				<td><?php echo mosHTML::yesnoRadioList('navigation', '', $this->navigation?1 : 0); ?></td>
			</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="act" value="ucontent" />
		<input type="hidden" name="task" value="save_config" />
		<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
	<?php }

	function save_config() {
		if(!$this->bindConfig($_REQUEST)) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>";
			exit();
		}

		if(!$this->storeConfig()) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>";
			exit();
		}
	}
}

class configContent_sectionblog extends dbConfig {

	//�������� ��������, ������������ � ��������� �������� (��� title)
	//���� �� ������ - ������� �������� ��������� $header
	//����� $header ����� �� ����� - ������� �������� �������� �������
	var $page_name = '';
	//��������/������ �������� ����� � title �������� (��������� ��������)
	var $no_site_name = 1;
	//����-��� robots, ������������ �� ��������:
	//int [-1,0,1,2,3]=['�� ����������', 'Index, follow', 'Index, NoFollow', 'NoIndex, Follow', 'NoIndex, NoFollow']
	var $robots = -1;
	//META-���: Description: string
	var $meta_description = '';
	//ETA-��� keywords: string
	var $meta_keywords = '';
	//META-��� author: string
	var $meta_author = '';
	//����������� ����
	var $menu_image = '';
	//������� CSS-������ ��������
	var $pageclass_sfx = '';
	//��������� �������� (���������� �������)
	var $header = '';
	//��������-������ ��������� ��������
	var $page_title = 1;
	//��������-������ ������ ����� (���������), ������������ �� ���������� ������������� ��������
	//��-��������� - ������������ ���������� ���������
	var $back_button = -1;
	//���������� ������� �������� (�� ��� ������). ��� 0 ������� ������� ������������ �� �����.
	var $leading = 1;
	//���������� ��������, � ������� ������������ ������������� (intro) �����
	var $intro = 4;
	//������� ������� � ������ ������������ ��� ����������� �������� ������
	var $columns = 2;
	//���������� ��������, ������������ � ���� �����
	var $link = 4;
	//���������� �������� � ���������
	var $orderby_pri = '';
	//�������, � ������� ����� ������������ �������
	var $orderby_sec = '';
	//��������/������ ������������ ���������
	var $pagination = 2;
	//��������/������ ���������� � ����������� ��������� �� �������� ( ��������, 1-4 �� 4 )
	var $pagination_results = 1;
	//���������� {mosimages}
	var $image = 1;
	//��������/������ �������� ��������, � ������� ����������� �������
	var $section = 0;
	//������� �������� �������� �������� �� �������� �������� �������
	var $section_link = 0;
	//��� ������ �� ������: 'blog' / 'list'
	var $section_link_type = 'blog';
	//��������/������ �������� ���������, ������� ����������� �������
	var $category = 0;
	//������� �������� ��������� �������� �� �������� ������� ���������
	var $category_link = 0;
	//��� ������ �� ���������: 'blog' / 'table'
	var $cat_link_type = 'blog';
	//��������/������ ��������� ��������
	var $item_title = 1;
	//������� ��������� �������� � ���� ������ �� �������
	var $link_titles = '';
	//��������/������ ������ [���������...]
	//��-��������� - ������������ ���������� ���������
	var $readmore = '';
	//��������/������ ����������� ������ ��������
	var $rating = '';
	//��������/������ ����� ������� ��������
	var $author = '';
	//��� ����������� ���� �������
	var $author_name = '';
	//��������/������ ���� �������� �������
	var $createdate = '';
	//�������/������ ���� ��������� �������
	var $modifydate = '';
	//��������/������ ������ ������ �������
	var $print = '';
	//��������/������ ������ �������� ������� �� e-mail
	var $email = '';
	//��������/������ ���������������� ������� ��� ������ ������������� `Publisher` � ����
	var $unpublished = 0;
	//����������� �� ����������
	var $group_cat = 0;
	//���������� ������� � ������
	var $groupcat_limit = 5;

	//��������/������ �������� �������
	var $description = 0;
	//��������/������ ����������� �������� �������
	var $description_image = 0;

	//��������/������ ������� �����
	var $view_introtext = 1;
	//����� ���� ��� �����������. ���� ����� �� ��������� � ������� - �������� ���� ������
	var $introtext_limit = '';
	//������ ����������
	var $intro_only = 1;

	//��������/������ ���� ����������
	var $view_tags = 1;

	function configContent_sectionblog(&$db, $group = 'com_content', $subgroup = 'section_blog') {
		$this->dbConfig($db, $group, $subgroup);
	}

	function display_config($option) {
		$mainframe = &mosMainFrame::getInstance();

		$params = $this->prepare_for_xml_render();
		$params = new mosParameters($params, $mainframe->getPath('menu_xml', 'content_blog_section'), 'menu'); ?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			submitform( pressbutton );
		}
		</script>
		<table class="adminheading"><tbody>
			<tr><th class="config">
			<?php echo _C_CONTENT_SET_DEF_CONTENT_SETTINGS?><br />
			<small><?php echo _C_CONTENT_SET_SECTION_BLOG?></small>
			</th></tr>
		</tbody></table>
		<form action="index2.php" method="post" name="adminForm">
			<?php echo $params->render(); ?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="act" value="sectionblog" />
			<input type="hidden" name="task" value="save_config" />
			<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
	<?php }

	function save_config() {

		$params = mosGetParam($_POST, 'params', '');
		if(is_array($params)) {
			$txt = array();
			foreach ($params as $k => $v) {
				$_REQUEST[$k] = $v;
			}

		}

		if(!$this->bindConfig($_REQUEST)) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>";
			exit();
		}

		if(!$this->storeConfig()) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>";
			exit();
		}
	}
}

class configContent_categoryblog extends dbConfig {

	//�������� ��������, ������������ � ��������� �������� (��� title)
	//���� �� ������ - ������� �������� ��������� $header
	//����� $header ����� �� ����� - ������� �������� ������� ���������
	var $page_name = '';
	//��������/������ �������� ����� � title �������� (��������� ��������)
	var $no_site_name = 1;
	//����-��� robots, ������������ �� ��������:
	//int [-1,0,1,2,3]=['�� ����������', 'Index, follow', 'Index, NoFollow', 'NoIndex, Follow', 'NoIndex, NoFollow']
	var $robots = -1;
	//META-���: Description: string
	var $meta_description = '';
	//ETA-��� keywords: string
	var $meta_keywords = '';
	//META-��� author: string
	var $meta_author = '';
	//����������� ����
	var $menu_image = '';
	//������� CSS-������ ��������
	var $pageclass_sfx = '';
	//��������� �������� (���������� �������)
	var $header = '';
	//��������-������ ��������� ��������
	var $page_title = 1;
	//��������-������ ������ ����� (���������), ������������ �� ���������� ������������� ��������
	var $back_button = '-1';
	//���������� ������� �������� (�� ��� ������). ��� 0 ������� ������� ������������ �� �����.
	var $leading = 1;
	//���������� ��������, � ������� ������������ ������������� (intro) �����
	var $intro = 4;
	//������� ������� � ������ ������������ ��� ����������� �������� ������
	var $columns = 2;
	//���������� ��������, ������������ � ���� �����
	var $link = 4;
	//���������� �������� � ���������
	var $orderby_pri = '';
	//�������, � ������� ����� ������������ �������
	var $orderby_sec = '';
	//��������/������ ������������ ���������
	var $pagination = 2;
	//��������/������ ���������� � ����������� ��������� �� �������� ( ��������, 1-4 �� 4 )
	var $pagination_results = 1;
	//���������� {mosimages}
	var $image = 1;
	//��������/������ �������� ��������, � ������� ����������� �������
	var $section = 0;
	//������� �������� �������� �������� �� �������� �������� �������
	var $section_link = 0;
	//��� ������ �� ������: 'blog' / 'list'
	var $section_link_type = 'blog';
	//��������/������ �������� ���������, ������� ����������� �������
	var $category = 0;
	//������� �������� ��������� �������� �� �������� ������� ���������
	var $category_link = 0;
	//��� ������ �� ���������: 'blog' / 'table'
	var $cat_link_type = 'blog';
	//��������/������ ��������� ��������
	var $item_title = 1;
	//������� ��������� �������� � ���� ������ �� �������
	var $link_titles = '';
	//��������/������ ������ [���������...]
	var $readmore = '';
	//��������/������ ����������� ������ ��������
	var $rating = '';
	//��������/������ ����� ������� ��������
	var $author = '';
	//��� ����������� ���� �������
	var $author_name = '';
	//��������/������ ���� �������� �������
	var $createdate = '';
	//�������/������ ���� ��������� �������
	var $modifydate = '';
	//��������/������ ������ ������ �������
	var $print = '';
	//��������/������ ������ �������� ������� �� e-mail
	var $email = '';
	//��������/������ ���������������� ������� ��� ������ ������������� `Publisher` � ����
	var $unpublished = 0;
	//��������/������ �������� �������
	var $description = 0;
	//��������/������ ����������� �������� �������
	var $description_image = 0;
	//��������/������ ������� �����
	var $view_introtext = 1;
	//����� ���� ��� �����������. ���� ����� �� ��������� � ������� - �������� ���� ������
	//TODO: ������� ��������� "������� �� ��������"
	//TODO: ������� ��������� "������� ������ ����������� �� ������ ��������� � ������" (+ ����� ���� ������� ���� �������� � �������)
	var $introtext_limit = '';
	//������ ����������
	var $intro_only = 1;

	//��������/������ ���� ����������
	var $view_tags = 1;
	var $_params = null;

	function configContent_categoryblog(&$db, $group = 'com_content', $subgroup = 'category_blog') {
		$this->dbConfig($db, $group, $subgroup);
		$this->_params = $this;
	}

	function display_config($option) {
		$mainframe = &mosMainFrame::getInstance();

		$params = $this->prepare_for_xml_render();
		$params = new mosParameters($params, $mainframe->getPath('menu_xml', 'content_blog_category'), 'menu'); ?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			submitform( pressbutton );
		}
		</script>
		<table class="adminheading"><tbody>
			<tr><th class="config">
			<?php echo _C_CONTENT_SET_DEF_CONTENT_SETTINGS?><br />
			<small><?php echo _C_CONTENT_SET_CATEGORY_BLOG?></small>
			</th></tr>
		</tbody></table>
		<form action="index2.php" method="post" name="adminForm">
			<?php echo $params->render(); ?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="act" value="categoryblog" />
			<input type="hidden" name="task" value="save_config" />
			<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
	<?php }

	function save_config() {

		$params = mosGetParam($_POST, 'params', '');
		if(is_array($params)) {
			$txt = array();
			foreach ($params as $k => $v) {
				$_REQUEST[$k] = $v;
			}

		}

		if(!$this->bindConfig($_REQUEST)) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>\n";
			exit();
		}

		if(!$this->storeConfig()) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>\n";
			exit();
		}
	}
}

class configContent_sectionarchive extends dbConfig {

	//�������� ��������, ������������ � ��������� �������� (��� title)
	var $page_name = '';
	//��������/������ �������� ����� � title �������� (��������� ��������)
	var $no_site_name = 1;
	//����-��� robots, ������������ �� ��������:
	//int [-1,0,1,2,3]=['�� ����������', 'Index, follow', 'Index, NoFollow', 'NoIndex, Follow', 'NoIndex, NoFollow']
	var $robots = -1;
	//META-���: Description: string
	var $meta_description = '';
	//ETA-��� keywords: string
	var $meta_keywords = '';
	//META-��� author: string
	var $meta_author = '';
	//����������� ����
	var $menu_image = '';
	//������� CSS-������ ��������
	var $pageclass_sfx = '';
	//��������� �������� (���������� �������)
	var $header = '';
	//��������-������ ��������� ��������
	var $page_title = 1;
	//��������-������ ������ ����� (���������), ������������ �� ���������� ������������� ��������
	var $back_button = '';
	//���������� ������� �������� (�� ��� ������). ��� 0 ������� ������� ������������ �� �����.
	var $leading = 1;
	//���������� ��������, � ������� ������������ ������������� (intro) �����
	var $intro = 4;
	//������� ������� � ������ ������������ ��� ����������� �������� ������
	var $columns = 2;
	//���������� ��������, ������������ � ���� �����
	var $link = 4;
	//���������� �������� � ���������
	var $orderby_pri = '';
	//�������, � ������� ����� ������������ �������
	var $orderby_sec = '';
	//��������/������ ������������ ���������
	var $pagination = 2;
	//��������/������ ���������� � ����������� ��������� �� �������� ( ��������, 1-4 �� 4 )
	var $pagination_results = 1;
	//���������� {mosimages}
	var $image = 1;
	//��������/������ �������� ��������, � ������� ����������� �������
	var $section = 0;
	//������� �������� �������� �������� �� �������� �������� �������
	var $section_link = 0;
	//��� ������ �� ������: 'blog' / 'list'
	var $section_link_type = 'blog';
	//��������/������ �������� ���������, ������� ����������� �������
	var $category = 0;
	//������� �������� ��������� �������� �� �������� ������� ���������
	var $category_link = 0;
	//��� ������ �� ���������: 'blog' / 'table'
	var $cat_link_type = 'blog';
	//��������/������ ��������� ��������
	var $item_title = 1;
	//������� ��������� �������� � ���� ������ �� �������
	var $link_titles = '';
	//��������/������ ������ [���������...]
	var $readmore = '';
	//��������/������ ����������� ������ ��������
	var $rating = '';
	//��������/������ ����� ������� ��������
	var $author = '';
	//��� ����������� ���� �������
	var $author_name = '';
	//��������/������ ���� �������� �������
	var $createdate = '';
	//�������/������ ���� ��������� �������
	var $modifydate = '';
	//��������/������ ������ ������ �������
	var $print = '';
	//��������/������ ������ �������� ������� �� e-mail
	var $email = '';
	//��������/������ ���������������� ������� ��� ������ ������������� `Publisher` � ����
	var $unpublished = 0;
	//����������� �� ����������
	var $group_cat = 0;
	//���������� ������� � ������
	var $groupcat_limit = 5;

	//��������/������ �������� �������
	var $description = 0;
	//��������/������ ����������� �������� �������
	var $description_image = 0;

	//��������/������ ������� �����
	var $view_introtext = 1;
	//����� ���� ��� �����������. ���� ����� �� ��������� � ������� - �������� ���� ������
	var $introtext_limit = '';
	//������ ����������
	var $intro_only = 1;

	function configContent_sectionarchive(&$db, $group = 'com_content', $subgroup = 'section_archive') {
		$this->dbConfig($db, $group, $subgroup);
	}

	function display_config($option) {
		global $mainframe;
		$params = $this->prepare_for_xml_render();
		$params = new mosParameters($params, $mainframe->getPath('menu_xml', 'content_archive_section'), 'menu'); ?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

				submitform( pressbutton );

		}
		</script>
		<table class="adminheading"><tbody>
			<tr><th class="config">
			<?php echo _C_CONTENT_SET_DEF_CONTENT_SETTINGS?><br />
			<small><?php echo _C_CONTENT_SET_SECTION_ARHIVE?></small>
			</th></tr>
		</tbody></table>
		<form action="index2.php" method="post" name="adminForm">
			<?php echo $params->render(); ?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="act" value="sectionarchive" />
			<input type="hidden" name="task" value="save_config" />
			<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
	<?php }

	function save_config() {

		$params = mosGetParam($_POST, 'params', '');
		if(is_array($params)) {
			$txt = array();
			foreach ($params as $k => $v) {
				$_REQUEST[$k] = $v;
			}

		}

		if(!$this->bindConfig($_REQUEST)) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>";
			exit();
		}

		if(!$this->storeConfig()) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>";
			exit();
		}
	}
}

class configContent_categoryarchive extends dbConfig {

	//�������� ��������, ������������ � ��������� �������� (��� title)
	var $page_name = '';
	//��������/������ �������� ����� � title �������� (��������� ��������)
	var $no_site_name = 1;
	//����-��� robots, ������������ �� ��������:
	//int [-1,0,1,2,3]=['�� ����������', 'Index, follow', 'Index, NoFollow', 'NoIndex, Follow', 'NoIndex, NoFollow']
	var $robots = -1;
	//META-���: Description: string
	var $meta_description = '';
	//ETA-��� keywords: string
	var $meta_keywords = '';
	//META-��� author: string
	var $meta_author = '';
	//����������� ����
	var $menu_image = '';
	//������� CSS-������ ��������
	var $pageclass_sfx = '';
	//��������� �������� (���������� �������)
	var $header = '';
	//��������-������ ��������� ��������
	var $page_title = 1;
	//��������-������ ������ ����� (���������), ������������ �� ���������� ������������� ��������
	var $back_button = '';
	//���������� ������� �������� (�� ��� ������). ��� 0 ������� ������� ������������ �� �����.
	var $leading = 1;
	//���������� ��������, � ������� ������������ ������������� (intro) �����
	var $intro = 4;
	//������� ������� � ������ ������������ ��� ����������� �������� ������
	var $columns = 2;
	//���������� ��������, ������������ � ���� �����
	var $link = 4;
	//���������� �������� � ���������
	var $orderby_pri = '';
	//�������, � ������� ����� ������������ �������
	var $orderby_sec = '';
	//��������/������ ������������ ���������
	var $pagination = 2;
	//��������/������ ���������� � ����������� ��������� �� �������� ( ��������, 1-4 �� 4 )
	var $pagination_results = 1;
	//���������� {mosimages}
	var $image = 1;
	//��������/������ �������� ��������, � ������� ����������� �������
	var $section = 0;
	//������� �������� �������� �������� �� �������� �������� �������
	var $section_link = 0;
	//��� ������ �� ������: 'blog' / 'list'
	var $section_link_type = 'blog';
	//��������/������ �������� ���������, ������� ����������� �������
	var $category = 0;
	//������� �������� ��������� �������� �� �������� ������� ���������
	var $category_link = 0;
	//��� ������ �� ���������: 'blog' / 'table'
	var $cat_link_type = 'blog';
	//��������/������ ��������� ��������
	var $item_title = 1;
	//������� ��������� �������� � ���� ������ �� �������
	var $link_titles = '';
	//��������/������ ������ [���������...]
	var $readmore = '';
	//��������/������ ����������� ������ ��������
	var $rating = '';
	//��������/������ ����� ������� ��������
	var $author = '';
	//��� ����������� ���� �������
	var $author_name = '';
	//��������/������ ���� �������� �������
	var $createdate = '';
	//�������/������ ���� ��������� �������
	var $modifydate = '';
	//��������/������ ������ ������ �������
	var $print = '';
	//��������/������ ������ �������� ������� �� e-mail
	var $email = '';
	//��������/������ ���������������� ������� ��� ������ ������������� `Publisher` � ����
	var $unpublished = 0;
	//��������/������ �������� �������
	var $description = 0;
	//��������/������ ����������� �������� �������
	var $description_image = 0;
	//��������/������ ������� �����
	var $view_introtext = 1;
	//����� ���� ��� �����������. ���� ����� �� ��������� � ������� - �������� ���� ������
	//TODO: ����������� ������������ ������� �� ������ ��� ������� �����
	//TODO: ������� ��������� "������� ������"
	//TODO: ������� ��������� "������� �� ��������"
	//TODO: ������� ��������� "������� ������ ����������� �� ������ ��������� � ������" (+ ����� ���� ������� ���� �������� � �������)
	var $introtext_limit = '';
	//������ ����������
	var $intro_only = 1;

	function configContent_categoryarchive(&$db, $group = 'com_content', $subgroup = 'category_archive') {
		$this->dbConfig($db, $group, $subgroup);
	}

	function display_config($option) {
		global $mainframe;
		$params = $this->prepare_for_xml_render();
		$params = new mosParameters($params, $mainframe->getPath('menu_xml', 'content_archive_category'), 'menu'); ?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

				submitform( pressbutton );

		}
		</script>
		<table class="adminheading"><tbody>
			<tr><th class="config">
			<?php echo _C_CONTENT_SET_DEF_CONTENT_SETTINGS?><br />
			<small><?php echo _C_CONTENT_SET_CATEGORY_ARHIVE?></small>
			</th></tr>
		</tbody></table>
		<form action="index2.php" method="post" name="adminForm">
			<?php echo $params->render(); ?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="act" value="categoryarchive" />
			<input type="hidden" name="task" value="save_config" />
			<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
	<?php }

	function save_config() {

		$params = mosGetParam($_POST, 'params', '');
		if(is_array($params)) {
			$txt = array();
			foreach ($params as $k => $v) {
				$_REQUEST[$k] = $v;
			}

		}

		if(!$this->bindConfig($_REQUEST)) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>\n";
			exit();
		}

		if(!$this->storeConfig()) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>\n";
			exit();
		}
	}
}

class configContent_categorytable extends dbConfig {

	//�������� ��������, ������������ � ��������� �������� (��� title)
	var $page_name = '';
	//��������/������ �������� ����� � title �������� (��������� ��������)
	var $no_site_name = 1;
	//����-��� robots, ������������ �� ��������:
	//int [-1,0,1,2,3]=['�� ����������', 'Index, follow', 'Index, NoFollow', 'NoIndex, Follow', 'NoIndex, NoFollow']
	var $robots = -1;
	//META-���: Description: string
	var $meta_description = '';
	//ETA-��� keywords: string
	var $meta_keywords = '';
	//META-��� author: string
	var $meta_author = '';
	//����������� ����
	var $menu_image = '';
	//������� CSS-������ ��������
	var $pageclass_sfx = '';
	//��������� �������� (���������� �������)
	var $header = '';
	//��������-������ ��������� ��������
	var $page_title = 1;
	//��������-������ ������ ����� (���������), ������������ �� ���������� ������������� ��������
	var $back_button = -1;
	//��������/������ �������� ���������
	var $description_cat = 1;
	//��������/������ ����������� � �������� ���������
	var $description_cat_image = 1;
	//������� ��������
	var $orderby = '';

	//������ ������������ ����. ��� �������������� ������������ ������� PHP - strftime.
	//���� ���� ��������� ������, �� ����� �������������� ������ �� ��������� �����
	var $date_format = '';

	//��������/������ � ������� ������� ����
	var $date = '';
	//��������/������ ������� �����
	var $author = '';
	//�������� ����������� ���� �������
	var $author_name = 0;
	//��������/������ ������� ����������
	var $hits = 0;
	//��������/������ ��������� ������
	var $headings = 1;
	//��������/������ ������ ���������
	var $navigation = 1;
	//��������/������ �������������� ������ � ������� ������� ����������
	var $order_select = 1;
	//��������/������ �������������� ������ � ������� ���������� ������������ �������� �� ��������
	var $display = 1;
	//���������� ������������ �������� �� ���������
	var $display_num = 50;
	//��������/������ ����������� ����������
	var $filter = 1;
	//����� ���� ������������ ��� ����������
	var $filter_type = 'title';
	//��������/������ ������ ������ ���������
	var $other_cat = 1;
	//��������/������ ������ (��� ��������) ���������
	var $empty_cat = 0;
	//��������/������ ����� �������� ������ ���������
	var $cat_items = 1;
	//��������/������ �������� ���������, ������� ������������� ���� �������� ���������
	var $cat_description = 1;
	//��������/������ ���������������� ������� ��� ������ ������������� `Publisher` � ����
	var $unpublished = 1;

	//��������/������ ������� �����
	//TODO: �����������
	var $view_introtext = 1;
	//����� ���� ��� �����������. ���� ����� �� ��������� � ������� - �������� ���� ������
	//TODO: ����������� ������������ ������� �� ������ ��� ������� �����
	//TODO: ������� ��������� "������� ������"
	//TODO: ������� ��������� "������� �� ��������"
	//TODO: ������� ��������� "������� ������ ����������� �� ������ ��������� � ������" (+ ����� ���� ������� ���� �������� � �������)
	var $introtext_limit = '';

	function configContent_categorytable(&$db, $group = 'com_content', $subgroup = 'category_table') {
		$this->dbConfig($db, $group, $subgroup);
	}

	function display_config($option) {
		global $mainframe;
		$params = $this->prepare_for_xml_render();
		$params = new mosParameters($params, $mainframe->getPath('menu_xml', 'content_category'), 'menu'); ?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

				submitform( pressbutton );

		}
		</script>
		<table class="adminheading"><tbody>
			<tr><th class="config">
			<?php echo _C_CONTENT_SET_DEF_CONTENT_SETTINGS?><br />
			<small><?php echo _C_CONTENT_SET_CATEGORY_TABLE?></small>
			</th></tr>
		</tbody></table>
		<form action="index2.php" method="post" name="adminForm">
			<?php echo $params->render(); ?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="act" value="categorytable" />
			<input type="hidden" name="task" value="save_config" />
			<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
	<?php }

	function save_config() {

		$params = mosGetParam($_POST, 'params', '');
		if(is_array($params)) {
			$txt = array();
			foreach ($params as $k => $v) {
				$_REQUEST[$k] = $v;
			}
		}

		if(!$this->bindConfig($_REQUEST)) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>\n";
			exit();
		}

		if(!$this->storeConfig()) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>\n";
			exit();
		}
	}
}

class configContent_sectionlist extends dbConfig {

	//�������� ��������, ������������ � ��������� �������� (��� title)
	//���� �� ������ - ������� �������� ��������� $header
	//���� $header ����� �� ����� - ������� �������� �������� �������
	var $page_name = '';
	//��������/������ �������� ����� � title �������� (��������� ��������)
	var $no_site_name = 1;
	//����-��� robots, ������������ �� ��������:
	//int [-1,0,1,2,3]=['�� ����������', 'Index, follow', 'Index, NoFollow', 'NoIndex, Follow', 'NoIndex, NoFollow']
	var $robots = -1;
	//META-���: Description: string
	var $meta_description = '';
	//ETA-��� keywords: string
	var $meta_keywords = '';
	//META-��� author: string
	var $meta_author = '';
	//����������� ����
	var $menu_image = '';
	//������� CSS-������ ��������
	var $pageclass_sfx = '';
	//��������� �������� (���������� �������)
	//����  �� ����� - ������� �������� �������� �������
	var $header = '';
	//��������-������ ��������� ��������
	var $page_title = 1;
	//��������-������ ������ ����� (���������), ������������ �� ���������� ������������� ��������
	var $back_button = -1;
	//��������/������ �������� �������
	var $description_sec = 1;
	//��������/������ ����������� � �������� �������
	var $description_sec_image = 1;
	//������� ����������
	var $orderby = '';
	//��� ������ �� ���������: 'blog' / 'table'
	var $cat_link_type = 'table';
	//��������/������ ������ (��� ��������) ��������� ��� ��������� �������
	var $empty_cat_section = 0;
	//��������/������ �������� ������ ��������� � ������
	var $description = 1;
	//��������/������ ����������� � �������� ������ ��������� � ������
	var $description_image = 1;

	//��������/������ ����� �������� ������ ���������
	var $cat_items = 1;
	//��������/������ �������� ���������, ������� ������������� ���� �������� ���������
	var $cat_description = 1;

	function configContent_sectionlist(&$db, $group = 'com_content', $subgroup = 'section_list') {
		$this->dbConfig($db, $group, $subgroup);
	}

	function display_config($option) {
		global $mainframe;
		$params = $this->prepare_for_xml_render();
		$params = new mosParameters($params, $mainframe->getPath('menu_xml', 'content_section'), 'menu'); ?>
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

				submitform( pressbutton );

		}
		</script>
		<table class="adminheading"><tbody>
			<tr><th class="config">
			<?php echo _C_CONTENT_SET_DEF_CONTENT_SETTINGS?><br />
			<small><?php echo _C_CONTENT_SET_SECTION_TABLE?></small>
			</th></tr>
		</tbody></table>
		<form action="index2.php" method="post" name="adminForm">
			<?php echo $params->render(); ?>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="act" value="sectionlist" />
			<input type="hidden" name="task" value="save_config" />
			<input type="hidden" name="<?php echo josSpoofValue(); ?>" value="1" />
		</form>
	<?php }

	function save_config() {

		$params = mosGetParam($_POST, 'params', '');
		if(is_array($params)) {
			$txt = array();
			foreach ($params as $k => $v) {
				$_REQUEST[$k] = $v;
			}
		}

		if(!$this->bindConfig($_REQUEST)) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>\n";
			exit();
		}

		if(!$this->storeConfig()) {
			echo "<script> alert('".$this->_error."'); window.history.go(-1); </script>\n";
			exit();
		}
	}
}