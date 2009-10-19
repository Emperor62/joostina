<?php #
/**
* @package Joostina
* @copyright Авторские права (C) 2008 Joostina team. Все права защищены.
* @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
* Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
* Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
*/

// запрет прямого доступа
defined( '_VALID_MOS' ) or die();

	//Подключаем CSS модуля (если указано в настройках)
	$module->helper->load_css($params);
	
	//Получаем пункты меню
	$menus = $module->helper->get_menu_tree($params);
	?>
		<ul class="dropdown_hor1">
			<?php menu_recurse_hor1( 0, 0, $menus ); ?>
		</ul>

<?php

function menu_recurse_hor1( $id, $level, &$children) {
	global $Itemid;
	
	if ( isset( $children[$id] ) ) {
		
		foreach ($children[$id] as $row) {
			
			$a_class = ''; $li_class = '';
			if($Itemid == $row->id){
				if($level == 0){
					$li_class = ' class="current"';
				}
				else{
					$li_class = ' class="currentsub"';	
				}
			}
			
			if($row->type == 'separator'){
				$href = 'javascript:void(0)';
			}
			else{
				$href = sefRelToAbs($row->link.'&Itemid='.$row->id);	
			}
				
			if (isset($children[$row->id])) {
				
				if($level == 0){
					$a_class = ' class="sub"';
				}
				else{
					$a_class = ' class="fly"';	
				}
				
				echo '<li '.$li_class.'><a href="'.$href.'" '.$a_class.'>'.$row->name."<!--[if gte IE 7]><!--></a><!--<![endif]-->";
				if (isset($children[$row->id])) {
					
					echo '<!--[if lte IE 6]><table><tr><td><![endif]--><ul class="submenu">';
					menu_recurse_hor1( $row->id, $level+1, $children);
					echo "<!--[if lte IE 6]></td></tr></table></a><![endif]--></ul>";
				}

				echo "</li>";
			} else {

				echo '<li  '.$li_class.'><a href="'.$href.'">'.$row->name."</a></li>";
			}
		}
	}
}