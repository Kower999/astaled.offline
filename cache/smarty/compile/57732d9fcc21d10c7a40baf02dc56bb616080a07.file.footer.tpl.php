<?php /* Smarty version Smarty-3.1.8, created on 2015-01-18 09:36:39
         compiled from "/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/themes/default/pdf/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24560464254bb7097126d40-58183532%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57732d9fcc21d10c7a40baf02dc56bb616080a07' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/themes/default/pdf/footer.tpl',
      1 => 1420467945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24560464254bb7097126d40-58183532',
  'function' => 
  array (
  ),
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
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54bb70974174a0_45482808',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bb70974174a0_45482808')) {function content_54bb70974174a0_45482808($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/tools/smarty/plugins/modifier.escape.php';
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