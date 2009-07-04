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

$_MAMBOTS->registerFunction('userProfile','botUserInfo');

/**
*/
function botUserInfo(&$user) {
	global $database,$_MAMBOTS;

	$params = new mosParameters($_MAMBOTS->_mambot_params['user_info']);
	
	?>                        
	<div id="userInfo_area">
                 
		<?php if($params->get('show_header') && $params->get('header') ){
			?>
				<h6><?php echo $params->get('header') ?></h6>
			<?php
		} ?>
		
		<?php if($params->get('gender')){?>
        	<?php if(isset($user->user_extra->gender)) {?>
            	<strong>���:</strong> <?php echo $user->get_gender($user, $params);?>
        	<?php } else {?>
            	<strong>���:</strong> �� ������
        	<?php }?>
		<?php } ?>
		
		<?php if($params->get('show_location')){?>
        	<?php if(isset($user->user_extra->location)) {?>
            	<strong>������:</strong> <?php echo $user->user_extra->location;?>
        	<?php } else {?>
            	<strong>������:</strong> �� �������
        	<?php }?>
		<?php } ?>
		
		<?php if($params->get('show_about')){?>
	        <?php if(isset($user->user_extra->about)) {?>
	            <p><?php echo $user->user_extra->about;?></p>
	        <?php } else {?>
	            <p>������������ ��� �� ��������� � ����</p>
	        <?php }?>
  		<?php } ?>

	</div>
	
	<?php

	
}

?>
