<?php
/**
* @package Joostina
* @copyright Авторские права (C) 2007 Joostina team. Все права защищены.
* @license Лицензия http://www.gnu.org/copyleft/gpl.html GNU/GPL, смотрите LICENSE.php
* Joostina! - свободное программное обеспечение. Эта версия может быть изменена
* в соответствии с Генеральной Общественной Лицензией GNU, поэтому возможно
* её дальнейшее распространение в составе результата работы, лицензированного
* согласно Генеральной Общественной Лицензией GNU или других лицензий свободных
* программ или программ с открытым исходным кодом.
* Для просмотра подробностей и замечаний об авторском праве, смотрите файл COPYRIGHT.php.
*/
// запрет прямого доступа
defined( '_VALID_MOS' ) or die( 'Прямой вызов файла запрещен' );

if(!class_exists('mosMenuBar')){
	class mosMenuBar {

		/**
		* Writes the start of the button bar table
		*/
		function startTable() {
			?>
				<div id="toolbar">
					<ul>
			<?php
		}

		/**
		* Создание произвольных кнопок тулбара с параметром в виде ссылки
		*/
		function ext( $alt='Кнопка', $href='',$class='' ) {
			?>
			<li>
				<a class="tb-ext<?php echo $class;?>" href="<?php echo $href; ?>"><span><?php echo $alt;?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a custom option and task button for the button bar
		* @param string The task to perform (picked up by the switch($task) blocks
		* @param string The image to display
		* @param string The image to display when moused over
		* @param string The alt text for the icon image
		* @param boolean True if required to check that a standard list item is checked
		*/
		function custom( $task='', $icon='', $iconOver='', $alt='', $listSelect=true ) {
			if ($listSelect) {
				$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('Пожалуйста, сделайте выбор из списка для $alt');}else{submitbutton('$task')}";
			} else {
				$href = "javascript:submitbutton('$task')";
			}
			?>
			<li>
				<a class="tb-custom<?php echo $icon;?>" href="<?php echo $href;?>"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a custom option and task button for the button bar.
		* Extended version of custom() calling hideMainMenu() before submitbutton().
		* @param string The task to perform (picked up by the switch($task) blocks
		* @param string The image to display
		* @param string The image to display when moused over
		* @param string The alt text for the icon image
		* @param boolean True if required to check that a standard list item is checked
		*/
		function customX( $task='', $class='', $iconOver='', $alt='', $listSelect=true ) {
			if ($listSelect) {
				$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('Пожалуйста, сделайте выбор из списка $alt');}else{hideMainMenu();submitbutton('$task')}";
			} else {
				$href = "javascript:hideMainMenu();submitbutton('$task')";
			}
			?>
			<li>
				<a class="tb-custom-x<?php echo $class;?>" href="<?php echo $href;?>"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes the common 'new' icon for the button bar
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function addNew( $task='new', $alt='Создать' ) {
			?>
			<li>
				<a class="tb-add-new" href="javascript:submitbutton('<?php echo $task;?>');"><span><?php echo $alt; ?></span></a></li>
			<?php
		}

		/**
		* Writes the common 'new' icon for the button bar.
		* Extended version of addNew() calling hideMainMenu() before submitbutton().
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function addNewX( $task='new', $alt='Создать' ) {
			?>
			<li>
				<a class="tb-add-new-x" href="javascript:hideMainMenu();submitbutton('<?php echo $task;?>');"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'publish' button
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function publish( $task='publish', $alt='Показать' ) {
			?>
			<li>
				<a class="tb-publish" href="javascript:submitbutton('<?php echo $task;?>');"><span><?php echo $alt; ?></span></a></li>
			<?php
		}

		/**
		* Writes a common 'publish' button for a list of records
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function publishList( $task='publish', $alt='Показать' ) {
			?>
			<li>
				<a class="tb-publish-list" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Пожалуйста, выберите из списка объекты для их публикации на сайте'); } else {submitbutton('<?php echo $task;?>', '');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'default' button for a record
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function makeDefault( $task='default', $alt='По умолчанию' ) {
			?>
			<li>
				<a class="tb-makedefault" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Пожалуйста, выберите объект, чтобы назначить его по умолчанию'); } else {submitbutton('<?php echo $task;?>', '');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'assign' button for a record
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function assign( $task='assign', $alt='Назначить' ) {
			?>
			<li>
				<a class="tb-assign" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Пожалуйста, для назначения объекта выберите его'); } else {submitbutton('<?php echo $task;?>', '');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'unpublish' button
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function unpublish( $task='unpublish', $alt='Скрыть' ) {
			?>
			<li>
				<a class="tb-unpublish" href="javascript:submitbutton('<?php echo $task;?>');"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'unpublish' button for a list of records
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function unpublishList( $task='unpublish', $alt='Скрыть' ) {
			?>
			<li>
				<a class="tb-unpublish-list" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Для отмены публикации объекта, сначала выберите его'); } else {submitbutton('<?php echo $task;?>', '');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'archive' button for a list of records
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function archiveList( $task='archive', $alt='В&nbsp;архив' ) {
			?>
			<li>
				<a class="tb-archive-list" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Пожалуйста, выберите из списка объекты для их архивации'); } else {submitbutton('<?php echo $task;?>', '');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes an unarchive button for a list of records
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function unarchiveList( $task='unarchive', $alt='Из&nbsp;архива' ) {
			?>
			<li>
				<a class="unarchive-list" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Выберите объект для восстановления его из архива'); } else {submitbutton('<?php echo $task;?>', '');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'edit' button for a list of records
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function editList( $task='edit', $alt='Изменить' ) {
			?>
			<li>
				<a class="edit-list" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Выберите объект из списка для его редактирования'); } else {submitbutton('<?php echo $task;?>', '');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'edit' button for a list of records.
		* Extended version of editList() calling hideMainMenu() before submitbutton().
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function editListX( $task='edit', $alt='Изменить' ) {
			?>
			<li>
				<a class="tb-edit-list-x" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Выберите объект из списка для его редактирования'); } else {hideMainMenu();submitbutton('<?php echo $task;?>', '');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'edit' button for a template html
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function editHtml( $task='edit_source', $alt='Ред.&nbsp;HTML' ) {
			?>
			<li>
				<a class="tb-edit-html" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Выберите объект из списка для его редактирования'); } else {submitbutton('<?php echo $task;?>', '');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'edit' button for a template html.
		* Extended version of editHtml() calling hideMainMenu() before submitbutton().
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function editHtmlX( $task='edit_source', $alt='Ред.&nbsp;HTML' ) {
			?>
			<li>
				<a class="tb-edit-html-x" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Выберите объект из списка для его редактирования'); } else {hideMainMenu();submitbutton('<?php echo $task;?>', '');}""><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'edit' button for a template css
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function editCss( $task='edit_css', $alt='Ред.&nbsp;CSS' ) {
			?>
			<li>
				<a class="tb-edit-css" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Выберите объект из списка для его редактирования'); } else {submitbutton('<?php echo $task;?>', '');}""><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'edit' button for a template css.
		* Extended version of editCss() calling hideMainMenu() before submitbutton().
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function editCssX( $task='edit_css', $alt='Ред.&nbsp;CSS' ) {
			?>
			<li>
				<a class="tb-edit-css-x" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Выберите объект из списка для его редактирования'); } else {hideMainMenu();submitbutton('<?php echo $task;?>', '');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'delete' button for a list of records
		* @param string Postscript for the 'are you sure' message
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function deleteList( $msg='', $task='remove', $alt='Удалить' ) {
			?>
			<li>
				<a class="tb-delete-list" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Выберите объект из списка для его удаления'); } else if (confirm('Вы действительно хотите удалить выбранные объекты? <?php echo $msg;?>')){ submitbutton('<?php echo $task;?>');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a common 'delete' button for a list of records.
		* Extended version of deleteList() calling hideMainMenu() before submitbutton().
		* @param string Postscript for the 'are you sure' message
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function deleteListX( $msg='', $task='remove', $alt='Удалить' ) {
			?>
			<li>
				<a class="tb-delete-list-x" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Выберите объект из списка для его удаления'); } else if (confirm('Вы действительно хотите удалить выбранные объекты? <?php echo $msg;?>')){ hideMainMenu();submitbutton('<?php echo $task;?>');}"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Write a trash button that will move items to Trash Manager
		*/
		function trash( $task='remove', $alt='В&nbsp;корзину', $check=true ) {
			if ( $check ) {
				$js = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('Выберите объект из списка для перемещения его в корзину'); } else { submitbutton('$task');}";
			} else {
				$js = "javascript:submitbutton('$task');";
			}
			?>
			<li>
				<a class="tb-trash" href="<?php echo $js; ?>"><span><?php echo $alt; ?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a preview button for a given option (opens a popup window)
		* @param string The name of the popup file (excluding the file extension)
		*/
		function preview( $popup='', $updateEditors=false ) {
			global $mosConfig_live_site, $task;
			?>
				<li><script language="javascript" type="text/javascript">
				<!--
				function popup() {
					document.adminForm.target='_blank';
					var action=document.adminForm.action;
					document.adminForm.action='<?php echo $mosConfig_live_site; ?>/administrator/popups/contentwindow.php';
					submitbutton('<?php echo $task;?>');
					document.adminForm.target='_self';
					document.adminForm.action=action;
					return false;
				}
				//-->
				</script>
				<a class="tb-preview" href="#" onclick="popup();"><span>Просмотр</span></a></li>
			<?php
		}

		/**
		* Writes a preview button for a given option (opens a popup window)
		* @param string The name of the popup file (excluding the file extension for an xml file)
		* @param boolean Use the help file in the component directory
		*/
		function help( $ref, $com=false ) {
			global $mosConfig_disable_button_help;
			if($mosConfig_disable_button_help) return; // при активном отключении кнопки "Помощь" функция прерывается в самом начале
			global $mosConfig_live_site;
			$helpUrl = mosGetParam( $GLOBALS, 'mosConfig_helpurl', '' );
			if ( $helpUrl == 'http://help.mamboserver.com' ) {
				$helpUrl = 'http://help.joomla.org';
			}

			if ($com) {
		// help file for 3PD Components
				$url = $mosConfig_live_site . '/administrator/components/' . $GLOBALS['option'] . '/help/';
				if (!eregi( '\.html$', $ref ) && !eregi( '\.xml$', $ref )) {
					$ref = $ref . '.html';
				}
				$url .= $ref;
			} else if ( $helpUrl ) {
		// Online help site as defined in GC
				$ref .= $GLOBALS['_VERSION']->getHelpVersion();
				$url = $helpUrl . '/index2.php?option=com_content&amp;task=findkey&amp;pop=1&amp;keyref=' . urlencode( $ref );
			} else {
		// Included html help files
				$url = $mosConfig_live_site . '/help/';
				if (!eregi( '\.html$', $ref ) && !eregi( '\.xml$', $ref )) {
				$ref = $ref . '.html';
				}
				$url .= $ref;
			}
			?>
			<li>
				<a class="tb-help" href="#" onclick="window.open('<?php echo $url;?>', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"><span>Помощь</span></a>
			</li>
			<?php
		}

		/**
		* Writes a save button for a given option
		* Apply operation leads to a save action only (does not leave edit mode)
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function apply( $task='apply', $alt='Применить' ) {
			?>
			<li>
				<a class="tb-apply" href="javascript:submitbutton('<?php echo $task;?>');"><span><?php echo $alt;?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a save button for a given option
		* Save operation leads to a save and then close action
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function save( $task='save', $alt='Сохранить' ) {
			?>
			<li>
				<a class="tb-save" href="javascript:submitbutton('<?php echo $task;?>');"><span><?php echo $alt;?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a save button for a given option (NOTE this is being deprecated)
		*/
		function savenew() {
			?>
			<li>
				<a class="tb-save-new" href="javascript:submitbutton('savenew');"><span>Сохранить</span></a>
			</li>
			<?php
		}

		/**
		* Writes a save button for a given option (NOTE this is being deprecated)
		*/
		function saveedit() {
			?>
			<li>
				<a class="tb-save-edit" href="javascript:submitbutton('saveedit');"><span>Сохранить</span></a>
			</li>
			<?php
		}

		/**
		* Writes a cancel button and invokes a cancel operation (eg a checkin)
		* @param string An override for the task
		* @param string An override for the alt text
		*/
		function cancel( $task='cancel', $alt='Отмена' ) {
			?>
			<li>
				<a class="tb-cancel" href="javascript:submitbutton('<?php echo $task;?>');"><span><?php echo $alt;?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a cancel button that will go back to the previous page without doing
		* any other operation
		*/
		function back( $alt='Назад', $href='' ) {
			if ( $href ) {
				$link = $href;
			} else {
				$link = 'javascript:window.history.back();';
			}
			?>
			<li>
				<a class="tb-back" href="<?php echo $link; ?>"><span><?php echo $alt;?></span></a>
			</li>
			<?php
		}

		/**
		* Write a divider between menu buttons
		*/
		function divider() {
			?>
			<li>
				&nbsp;
			</li>
			<?php
		}

		/**
		* Writes a media_manager button
		* @param string The sub-drectory to upload the media to
		*/
		function media_manager( $directory='', $alt='Загрузить' ) {
			global $database, $mainframe;
			$cur_template = $mainframe->getTemplate();
			?>
			<li>
				<a class="tb-media-manager" href="#" onclick="popupWindow('popups/uploadimage.php?directory=<?php echo $directory; ?>&amp;t=<?php echo $cur_template; ?>','win1',250,100,'no');"><span><?php echo $alt;?></span></a>
			</li>
			<?php
		}

		/**
		* Writes a spacer cell
		* @param string The width for the cell
		*/
		function spacer( $width='' ) {
			return true;
		}

		/**
		* Writes the end of the menu bar table
		*/
		function endTable() {
			?>
				</ul>
			</div>
			<?php
		}
	}
}
?>
