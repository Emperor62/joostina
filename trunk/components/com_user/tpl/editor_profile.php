<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/*
------���������� ��� ������������� � �������:-----
$avatar_pic - ����������� �������
$avatar_edit - ������� ���������� ��������
*/
?>

    <div class="componentheading user_p"><h1 class="profile">������� ������������</h1></div><br />

    <table id="user_profile" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
    <td>
	<table  cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td id="user_avatar">
               <?php echo $avatar_pic;?>
            </td>
			<td id="user_info">

                    <span class="user_name">
                        <?php echo $user_real_name; ?> (<?php echo $user_nickname; ?>)
                    </span>

                     <?php if($owner){?>
                     <a title="�������������" href="<?php echo $edit_info_link;?>">
                        <img src="../images/key.png" />
                     </a>
                     <?php }?>


                     <?php echo $user_status;?>
                      <br />

                    <div class="date">
                        <strong>���� �����������:</strong> <?php echo $registerDate;?>
                    </div>

                    <div class="date">
                        <strong>��������� �����: </strong><?php echo $lastvisitDate;?>
                    </div>

                <div class="user_info">
                    <?php echo $user_info;?>
                </div>


              <br />
             <!--<a href="<?php echo $user_content_href;?>" class="user_content_link">���������� ������������</a> <br />-->
             <?php  //mosLoadModules('profile', -2);?>
             </td>
            </tr>
        </table>

       </td>
      </tr>
      </table><br /><br />

      <?php include ($_SERVER['DOCUMENT_ROOT'].'/components/com_user/user_modules/user_content.php');?> <br /><br />


      <?php include ($_SERVER['DOCUMENT_ROOT'].'/components/com_user/user_modules/user_jcomments.php');?>


