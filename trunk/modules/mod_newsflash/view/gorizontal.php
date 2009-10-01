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


if ($params->get('numrows',0)) { ?>

        <div class="mod_newsflash <?php echo $params->get('moduleclass_sfx', '');?>">
            <table>
                <tr>
                <?php foreach ($items as $row): ?>
                     <?php $module->helper->prepare_row($row, $params);?>
                    <td>
                        <?php if($params->get('image',0)): ?>
                            <?php echo $row->image;?>
                        <?php endif; ?>

                        <?php if($params->get('createdate',1)): ?>
                            <span class="date"><?php echo mosFormatDate($row->created); ?></span>
                        <?php endif; ?>

                        <?php if($params->get('show_author',0)): ?>
                            <span class="author"><?php echo $row->author;?></span>
                        <?php endif; ?>

                        <?php if($params->get('item_title',0)): ?>
                            <h4><?php echo $row->title;?></h4>
                        <?php endif; ?>

                        <?php if($params->get('text',0)): ?>
                            <?php echo $row->text;?>
                        <?php endif; ?>

                        <?php if($params->get('readmore', 0)):?>
                            <div class="readmore"><?php echo $row->readmore ;?></div>
                        <?php endif; ?>

                    </td>
                <?php endforeach; ?>
                </tr>
            </table>
        </div>

<?php } ?>
