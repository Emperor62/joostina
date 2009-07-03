<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
?>
 
  <script>

    $(document).ready(function() {
        $("#apply").click(function () {
            $("input#task").val('apply');
            $("#addContent").submit();
        });
        $("#save").click(function () {
            $("input#task").val('save');
            $("#addContent").submit();
        });
        $("#cancel").click(function () {
            $("input#task").val('cancel');
            $("#addContent").submit();
        });
   });


    $(document).ready(function(){
        jQuery.validator.messages.required = "";
        $("#addContent").validate();
  });
  </script>


   <script language="javascript" type="text/javascript">
		onunload = WarnUser;

		function submitbutton(pressbutton) {
			var form = document.adminForm;
			form.goodexit.value=1;
			try {
				form.onsubmit();
			}
			catch(e){}

            <?php
		        getEditorContents('editor1','introtext');
		        getEditorContents('editor2','fulltext');
            ?>

            submitform(pressbutton);
		}

		function setgood(){
			document.adminForm.goodexit.value=1;
		}

		function WarnUser(){
			if (document.adminForm.goodexit.value==0) {
				alert('<?php echo addslashes(_E_WARNUSER); ?>');
				window.location="<?php echo $good_exit_link; ?>";
			}
		}

	</script>




		<form action="index.php" id="addContent" onSubmit="javascript:setgood();" method="post" name="adminForm" enctype="multipart/form-data">
        <div class="componentheading"><?php echo $row->id ? '&nbsp;'.$params->get('form_title_edit',_E_EDIT):  '&nbsp;'.$params->get('form_title_add',_E_ADD ); ?></div>

        <?php if ($row->id && $allow_info){ ?>
        <div class="info">
            <strong><?php echo _E_EXPIRES ;?></strong> <?php echo $row->publish_down;?>
            <strong><?php echo _E_VERSION ;?></strong> <?php echo $row->version;?>
            <strong><?php echo _E_CREATED ;?></strong> <?php echo $row->created;?>
            <?php if($row->modified){?>
				<strong><?php echo _E_LAST_MOD ;?></strong> <?php echo $row->modified;?>
			<?php } ?>
			<strong><?php echo _E_HITS ;?></strong> <?php echo $row->hits;?>

        </div>
        <?php }?>
        
                <span class="button">
			<input type="submit" class="button submit" name="submit" id="save" value="Сохранить" />			
		</span>
        <span class="button"><input type="submit" class="button apply" name="apply" id="apply" value="Применить" /></span>
        <span class="button"><input type="submit" class="button cancel" name="cancel" id="cancel" value="Отмена" /></span>
        
        <table class="cedit_misc" cellspacing="0" cellpadding="0" border="0">
            <tr>

                <?php if($access->canPublish || $auto_publish==1 || $my->usertype=="Super Administrator"){?>
                <td><b><?php echo _CMN_PUBLISHED ?>:</b>&nbsp;&nbsp;</td><td><?php echo  mosHTML::yesnoRadioList('state','',$row->state);?></td>
                <?php }?>

                <?php if( $allow_frontpage==1 || $my->usertype=="Super Administrator") {?>
				<td align="right">&nbsp;&nbsp;&nbsp;<b><?php echo $front_label;?>:</b>&nbsp;</td>
				<td  align="left"> <?php echo mosHTML::yesnoRadioList('frontpage','',$row->frontpage ? 1:0);?></td>
                <?php }?>

            </tr>
       </table>


         <table class="cedit_main" cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td width="25"><strong><?php echo _HEADER_TITLE?>:</strong></td>
                <td><input class="inputbox required title" type="text" name="title" size="30" maxlength="255" style="width:99%" value="<?php echo $row->title; ?>" /></td>
            </tr>

             <?php if($allow_alias){?>
            <tr>
                <td><strong><?php echo _ALIAS?>:</strong></td>
				<td>
					<input name="title_alias" type="text" class="inputbox" id="title_alias" value="<?php echo $row->title_alias; ?>" size="30" style="width:99%" maxlength="255" />
				</td>
            </tr>
             <?php } ?>

                        <tr <?php echo $class;?>>
                            <td><strong><?php echo _E_CATEGORY?>:</strong></td>
				            <td> <?php  echo $lists['catid'];?>	</td>
                        </tr>




            <?php  if($allow_tags){ ?>
            <tr>
				<td align="left" valign="top"><strong><?php echo _TAGS; ?></strong></td>
				<td><input class="inputbox" style="width:99%" type="text" name="tags" value="<?php echo $row->tags;?>" /></td>
			</tr>
            <?php }?>


           <?php  if($allow_desc){ ?>   <tr>
				<td align="left" valign="top"><strong><?php echo _E_M_DESC; ?></strong></td>
				<td><textarea class="inputbox" style="width:99%"  rows="2" name="metadesc"><?php echo str_replace('&','&amp;',$row->metadesc); ?></textarea></td>
			</tr>
           <?php }?>

         </table>

         <br />
         <div class="cedit_introtext">
            <strong><?php echo _E_INTRO.' ('._CMN_REQUIRED.')'; ?>:</strong><br />
            <?php if($p_wwig){
			// parameters : areaname, content, hidden field, width, height, rows, cols
			editorArea('editor1',$row->introtext,'introtext','700','400','70','15', $wwig_params);
		    }else{
            ?>
			<textarea style="width: 700px; height: 400px;" class="inputbox introtext" rows="15" cols="70" id="introtext" name="introtext"/><?php echo $row->introtext;?></textarea>
            <?php }?>
         </div>

         <?php if($p_fulltext){?>
		 <br /><br />
         <div class="cedit_fulltext">
            <strong><?php echo _E_MAIN.' ('._CMN_OPTIONAL.')'; ?>:</strong>
            <?php if($p_wwig){
			// parameters : areaname, content, hidden field, width, height, rows, cols
			editorArea('editor2',$row->fulltext,'fulltext','600','400','70','15', $wwig_params);
		    }else { ?>
			<textarea style="width: 700px; height: 400px;" class="inputbox" rows="15" cols="70" id="fulltext" name="fulltext"/><?php echo $row->fulltext;?></textarea>
            <?php } ?>
        </div>
         <?php } ?>



<?php if( $allow_params){ ?>
    <h4><?php echo _E_PUBLISHING;?></h4>
			<table class="adminform">
			<tr>
				<td align="left"><?php echo _E_ACCESS_LEVEL; ?></td>
				<td><?php echo $lists['access']; ?></td>
			</tr>
			<tr>
				<td align="left"><?php echo _E_AUTHOR_ALIAS; ?></td>
				<td>
				<input type="text" name="created_by_alias" size="50" maxlength="255" value="<?php echo $row->created_by_alias; ?>" class="inputbox" />
				</td>
			</tr>
			<tr>
				<td align="left"><?php echo _E_ORDERING; ?></td>
				<td><?php echo $lists['ordering']; ?></td>
			</tr>
			<tr>
				<td align="left"><?php echo _E_START_PUB; ?></td>
				<td>
				<input class="inputbox" type="text" name="publish_up" id="publish_up" size="25" maxlength="19" value="<?php echo $row->publish_up; ?>" />
				<input type="reset" class="button" value="..." onclick="return showCalendar('publish_up', 'y-mm-dd');" />
				</td>
			</tr>
			<tr>
				<td align="left"><?php echo _E_FINISH_PUB; ?></td>
				<td>
				<input class="inputbox" type="text" name="publish_down" id="publish_down" size="25" maxlength="19" value="<?php echo $row->publish_down; ?>" />
				<input type="reset" class="button" value="..." onclick="return showCalendar('publish_down', 'y-mm-dd');" />
				</td>
			</tr>
			</table>
<?php } ?>

		<div style="clear:both;"></div> <br /><br />

        <span class="button">
			<input type="submit" class="button submit" name="submit" id="save" value="Сохранить" />			
		</span>
        <span class="button"><input type="submit" class="button apply" name="apply" id="apply" value="Применить" /></span>
        <span class="button"><input type="submit" class="button cancel" name="cancel" id="cancel" value="Отмена" /></span>

		<input type="hidden" name="goodexit" id="goodexit" value="0" />
		<input type="hidden" name="option" value="com_content" />

		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="version" value="<?php echo $row->version; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $section_id; ?>" />
		<input type="hidden" name="created_by" value="<?php echo $row->created_by; ?>" />
		<input type="hidden" name="referer" value="<?php echo ampReplace(@$_SERVER['HTTP_REFERER']); ?>" />
		<input type="hidden" name="task" id="task" value="save" />
		<input type="hidden" name="<?php echo $validate; ?>" value="1" />
		</form>