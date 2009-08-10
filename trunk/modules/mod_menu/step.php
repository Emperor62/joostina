<?php defined( '_VALID_MOS' ) or die( '������ ���������' );
/**
* STEPmenu v1.1.0.
* ������ �������� ������������� ���� ������ ������� �������� ���������� � ����������� �� ��������.
* ���� ������� ( boston ).
* ������� ��� Joomla! www.joom.ru 2007 ���.
* ������ ������ �������� � ������� 2006 ���� ���������� ��� sourpuss.
*
* ��� ���������� ������ ������������ �������� ������ ���� ���� "������ - URL", � � �������� ������ ��������� #.
* ������ ��������! <--������ '#', 1 �������
*.      L ������� <-- ������ ������ ���� �� ��
*.      L ������ ��������  <--������ '#', 2-1 �������
*.      .      L ��������� - 1  <-- ������ ������ ���� �� ���
*.      .      L ��������� - 2  <-- ������ ������ ���� �� ���
*.      L ������ ��������  <--������ '#', 2-2 �������
*.      .      L ���������1 - 1  <-- ������ ������ ���� �� ���
*.      .      L ���������2 - 2  <-- ������ ������ ���� �� ���
**/

global $database, $Itemid,$mosConfig_shownoauth;

/*
��������� �������� �� �������� ������
*/
$active_css = $params->get( 'active_css' ); // CSS ����� ��������� ������ ����
$select_css = $params->get( 'select_css' ); // CSS ����� ���������� ������ ����
$menutype = $use_menu; // �������� ���� ��� ������� ������
$on_type = $params->get( 'on_type','onclick' );// ������� �� ������� ���������� �������

/*
����� ������ ��������� ��������� ����, �������� � ����� ����� ��������� ������.
*/
?>
<script type="text/javascript">
	function go_main(num_id,state) {
		drop_div = new RegExp('ssmenu_' + state + "_([0-9])");
		all_div = document.getElementsByTagName('div');
		for ( var i = 0; i < all_div.length; i++ ) {
			if (drop_div.test(all_div[i].id)) {
					all_div[i].style.display = 'none';
			};
		};
		drop_link = new RegExp('sslink_' + state + "_([0-9])");
		all_link = document.getElementsByTagName('a');
		for ( var i = 0; i < all_link.length; i++ ) {
			if (drop_link.test(all_link[i].id)) {
				all_link[i].className='';
			};
		};
		document.getElementById('ssmenu_' + state + '_' + num_id).style.display = 'block';  // ���������� ���� ��������� ������
		document.getElementById('sslink_' + state + '_' + num_id).className = '<?php echo $select_css;?>'; // ��� ����� �������� ��������� �������� (�� ���������) ������ ����
	};
</script>

<?php

if ($mosConfig_shownoauth) { // ���� � ������������� ��������� ���������� ������ �� ��������������
	$sql = "SELECT m.* FROM #__menu AS m"
	. "\nWHERE menutype='$menutype' AND published='1'"
	. "\nORDER BY parent,ordering";
} else {
	$sql = "SELECT m.* FROM #__menu AS m"
	. "\nWHERE menutype='$menutype' AND published='1' AND access <= '$my->gid'"
	. "\nORDER BY parent,ordering";
};
$database->setQuery($sql);
$rows = $database->loadObjectList();
if(count($rows) <= 0) {
	echo '���� <b>'.$menutype.'</b> �� ������� ��� �� �������� �� ������ ��������.'; // ������ ������� 0 ����������� - ����� ���� �� ���������� ��� �� �������� ��������
}

$new_div	= ''; // ����� ����� ������������ ���� � ��������� ����
$all_menu	= $rows;
foreach ($rows as $menu ) { // ������������ ��� ������ ����
	if($menu->parent == '0'){ // ���� ������ ������ �������� ������ - �.�. ����� �������
		if ($menu->link=='#') { // ���� ����� ������ ������� ��� '#' - ������ ��� ���� ������, ������������ �
			$cild = go_child($all_menu,$menu->id,'1',$active_css,$spacer); // �������� ��� �������� ������� ������ 0 ������
			$new_div .=$cild['text']; // � �������� ������� ���� � ��������� ����������
			$aktiv = $cild['vis']; // ���� � �������� ������ ���� ���� ���� �������� ������� - ��������� ���� �������� ������������� ������ � ������� ��� ��������� ������
			echo "<a id=\"sslink_1_{$menu->id}\" href=\"javascript:void(0);\" {$on_type}=\"go_main('$menu->id','1');\" $aktiv >$menu->name</a>{$spacer}"; // ������������ ������ �� �������� �������� ���� � ��������
		} else { // ���� � ��� ������� ������
			if (!eregi( "Itemid=", $menu->link )){
				$menu->link .= "&Itemid=$menu->id"; // ���� ���� ��������������� - ����������
			}
			if ($menu->id == $Itemid){
				$ad_active = 'class="'.$active_css.'"';
			}else{
				$ad_active = null; // ���� ������������� ��������� ���������������� �� ������������� ������� - ������������ �
			}
			echo '<a href="'.sefRelToAbs($menu->link).'" '.$ad_active.'>'.$menu->name.'</a>'.$spacer; // ������� ���� ������
		}
	}
};
echo $new_div; // ���������� ���� � ��������� ����

/*
��������� �������� ������
*/
function go_child($rows,$pid,$state,$active_css,$spacer){
	global $Itemid; // ���� ���������� ������������� ������� ������
	$ret = '';
	$new_div ='';
	$all_menu = $rows;
	$ad_active = '';
	$aktiv = 0;
	$cild = array();
	$aktial = 0;
	$state2 = $state +1;
	foreach ($rows as $menu ) {
		if($menu->parent == $pid){ // ���� ������ ������ ������������� �������� ��������
			if ($menu->id==$Itemid) { // ��������� �������� ���������� ������
				$aktiv = 1; // ������ �������� ��� ����������� �������� ��� ������������ ������
				$ad_active = "class=\"$active_css\"";
			}else{
				$ad_active = '';
			}
			// ����������� ��������� ������������ ��������� ������������ ������
			if ($menu->link=='#') {
				$cild = go_child($all_menu,$menu->id,$state2,$active_css); // ���� � ���������
				$new_div .=$cild['text'];
				$aktiv_menu = $cild['vis'];
				$cild['vis'] ? $aktial = 1 : null;
				$ret.= "<a id=\"sslink_{$state2}_{$menu->id}\" href=\"javascript:void(0);\" onClick=\"go_main('$menu->id','$state2');\" $aktiv_menu >$menu->name</a>{$spacer}"; // ������������ ������ �� �������� ��������
			} else {
				if (!eregi( 'Itemid=', $menu->link )) $menu->link .= "&Itemid=$menu->id";
				$ret .= '<a href="'.sefRelToAbs($menu->link)."\" $ad_active>$menu->name</a>{$spacer}";
			}
		}
	}
	// ���� � ��������� ������� �������� ���������� ���� ���� �������� - �� ������� � ��������
	if($aktiv or $aktial) {
		$vis = "style=\"display:block\""; // ���� � ������� ����� ����� � ���������
		$akt_parent = "class=\"$active_css\""; // ���� ������ ����� ����������
	}else{
		$vis = "style=\"display:none\"";
		$akt_parent = null;
	};
	$return = array(); // �������� �������� ���������
	$return['text'] = '<div '.$vis.' id="ssmenu_'.$state.'_'.$pid.'">'.$ret.$new_div.'</div>';
	$return['vis'] = $akt_parent;
	return $return;
}