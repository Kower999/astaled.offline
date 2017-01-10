<?php /* Smarty version Smarty-3.1.8, created on 2015-02-26 01:25:19
         compiled from "C:\wamp\www\themes\default\pdf\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2744554da7a28be7f11-21621025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fa301316e2a59860c994d032e15e6bd10fb2564' => 
    array (
      0 => 'C:\\wamp\\www\\themes\\default\\pdf\\footer.tpl',
      1 => 1424910095,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2744554da7a28be7f11-21621025',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54da7a28c88298_93686913',
  'variables' => 
  array (
    'dodaci' => 0,
    'address' => 0,
    'shop_address' => 0,
    'shop_phone' => 0,
    'shop_fax' => 0,
    'shop_details' => 0,
    'free_text' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54da7a28c88298_93686913')) {function content_54da7a28c88298_93686913($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.escape.php';
?>
<div style="font-size: 7pt; color: #444">
<table style="width: 100%" cellspacing="0" cellpadding="5">
    <tr>
        <td style="width: 5%"></td>        
        <td style="width: 15%;border-top: 1px dotted #777;text-align: center"><?php if (isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>Odovzdal<?php }else{ ?>Vyhotovil<?php }?></td>
        <td style="width: <?php if (isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>45%<?php }else{ ?>60%<?php }?>;text-align: center; font-size: 6pt; color: #444">        
			<?php echo $_smarty_tpl->tpl_vars['address']->value->company;?>
, <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_address']->value, 'html', 'UTF-8');?>
<br />
				<?php if (!empty($_smarty_tpl->tpl_vars['shop_phone']->value)){?>
					Tel: <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_phone']->value, 'html', 'UTF-8');?>

				<?php }?>

				<?php if (!empty($_smarty_tpl->tpl_vars['shop_fax']->value)){?>
					Fax: <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_fax']->value, 'html', 'UTF-8');?>

				<?php }?>
				<br />
            
            <?php if (isset($_smarty_tpl->tpl_vars['shop_details']->value)){?>
                <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_details']->value, 'html', 'UTF-8');?>
<br />
            <?php }?>

            <?php if (isset($_smarty_tpl->tpl_vars['free_text']->value)){?>
    			<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['free_text']->value, 'html', 'UTF-8');?>
<br />
            <?php }?>
        </td>
        <?php if (isset($_smarty_tpl->tpl_vars['dodaci']->value)){?>
        <td style="width: 14%;border-top: 1px dotted #777;text-align: center">Dátum prevzatia</td>
        <td style="width: 1%;"></td>
        <?php }?>
        <td style="width: 15%;border-top: 1px dotted #777;text-align: center">Prevzal</td>
        <td style="width: 5%"></td>
    </tr>
</table>
</div>
<?php }} ?>