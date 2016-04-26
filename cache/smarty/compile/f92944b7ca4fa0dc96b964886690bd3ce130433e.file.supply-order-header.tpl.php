<?php /* Smarty version Smarty-3.1.8, created on 2015-01-18 23:40:43
         compiled from "/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/pdf/supply-order-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:97564098854bc366b0b0cf8-50384090%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f92944b7ca4fa0dc96b964886690bd3ce130433e' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/pdf/supply-order-header.tpl',
      1 => 1420467766,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '97564098854bc366b0b0cf8-50384090',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'logo_path' => 0,
    'shop_name' => 0,
    'date' => 0,
    'title' => 0,
    'reference' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54bc366b1218d5_08067306',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bc366b1218d5_08067306')) {function content_54bc366b1218d5_08067306($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/tools/smarty/plugins/modifier.escape.php';
?>
<table>
	<tr><td style="line-height: 6px">&nbsp;</td></tr>
</table>
	
<table style="width: 100%">
<tr>
	<td style="width: 50%">
        <?php if ($_smarty_tpl->tpl_vars['logo_path']->value){?>
            <img src="<?php echo $_smarty_tpl->tpl_vars['logo_path']->value;?>
" />
        <?php }?>
	</td>
	<td style="width: 50%; text-align: right;">
		<table style="width: 100%">
			<tr>
				<td style="font-weight: bold; font-size: 14pt; color: #444; width: 100%"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_name']->value, 'htmlall', 'UTF-8');?>
</td>
			</tr>
			<tr>
				<td style="font-size: 14pt; color: #444; font-weight: bold;"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['date']->value, 'htmlall', 'UTF-8');?>
</td>
			</tr>
			<tr>
				<td style="font-size: 14pt; color: #444; font-weight: bold;"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['title']->value, 'htmlall', 'UTF-8');?>
</td>
			</tr>
			<tr>
				<td style="font-size: 14pt; color: #444; font-weight: bold;"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['reference']->value, 'htmlall', 'UTF-8');?>
</td>
			</tr>
		</table>
	</td>
</tr>
</table>

<?php }} ?>