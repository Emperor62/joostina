<?php
/**
* @package Joostina
* @copyright ��������� ����� (C) 2008-2009 Joostina team. ��� ����� ��������.
* @license �������� http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, ��� help/license.php
* Joostina! - ��������� ����������� ����������� ���������������� �� �������� �������� GNU/GPL
* ��� ��������� ���������� � ������������ ����������� � ��������� �� ��������� �����, �������� ���� help/copyright.php.
*/

// ������ ������� �������
defined( '_VALID_MOS' ) or die();
$mainframe = &mosMainFrame::getInstance(); global $my;
$module->helper->prepare_login_form($params); 

$validate = josSpoofValue(1); ?>

<div class="mod_ml_login login horizontal">

	<div class="form_pretext">
	 	<?php echo $params->get('pretext' ,'')?>
	</div>	
	
  	<?php if($mainframe->get('_multisite')==2){ ?>
	<a href="<?php echo $mainframe->_multisite_params->main_site; ?>/index.php?option=com_login" class="login_button">
		<?php echo $params->get( 'dr_login_text', _LOGIN_TEXT);?>
	</a>
  	<?php echo '</div>'; return; } ?>
    
    <form action="<?php echo sefRelToAbs('index.php'); ?>" method="post" name="login">

        <table class="login_form_inputs">
            <tr>
                <td id="inputlogin">
					<?php echo $params->_input_login; ?>
				</td>
				
                <td id="inputpass">
					<?php echo $params->_input_pass; ?>
				</td>
				
                <td id="loginbutton">
					<span class="button">
						<input type="submit" name="Submit" class="button" id="login_button" value="<?php echo $params->get( 'submit_button_text', _BUTTON_LOGIN );?>" />
					</span>
				</td>
				
            </tr>
        </table>
        
        <?php if ($params->get( 'show_remember', 1) || $params->get('show_lost_pass', 1) || $params->get('show_register', 1)) { ?>
        <table class="login_form_misc">
            <tr>
            
                <td id="input_rememberme">
				<?php if ($params->get( 'show_remember', 1)) { ?>
					<input type="checkbox" name="remember" id="mod_login_remember"  value="yes" alt="Remember Me" />
					<label for="mod_login_remember"><?php echo $params->get( 'ml_rem_text', _REMEMBER_ME );?></label>
				  <?php } ?>
			  	</td>
			  	
                <td id="lostpass">
				<?php if ($params->get('show_lost_pass', 1)) { ?>
					<a href="<?php echo sefRelToAbs( 'index.php?option=com_users&amp;task=lostPassword' );?>">
						<?php echo $params->get('ml_rem_pass_text', _LOST_PASSWORD) ;?>
					</a>
				<?php }	?>				
				</td>
				
                <td id="register">
				<?php if($params->get('show_register', 1)) {?>
					<a  href="<?php echo sefRelToAbs( 'index.php?option=com_users&amp;task=register' );?>">
						<?php echo $params->get('ml_reg_text', _CREATE_ACCOUNT)?>
					</a>
				<?php }?>				
				</td>
				
            </tr>
        </table>
        <?php }?>
     
    <div class="form_posttext">
		<?php echo $params->get('posttext', '');?>
	</div>


	<input type="hidden" name="option" value="login" />
	<input type="hidden" name="op2" value="login" />
	<input type="hidden" name="lang" value="<?php echo $mainframe->getCfg('lang'); ?>" />
	<input type="hidden" name="return" value="<?php echo sefRelToAbs($params->get('login',$params->_returnUrl)); ?>" />
	<input type="hidden" name="message" value="<?php echo $params->get('login_message',''); ?>" />
	<input type="hidden" name="force_session" value="1" />
	<input type="hidden" name="<?php echo $validate; ?>" value="1" />
	</form>
	
</div>

