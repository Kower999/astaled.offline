<?php /* Smarty version Smarty-3.1.8, created on 2015-01-18 23:40:43
         compiled from "/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/pdf/supply-order-footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172039833554bc366b12ca66-52473447%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14d4e55e600a19378a5c6ff04cb7f2ee6d219d46' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/pdf/supply-order-footer.tpl',
      1 => 1420467766,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172039833554bc366b12ca66-52473447',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'shop_address' => 0,
    'shop_phone' => 0,
    'shop_fax' => 0,
    'shop_details' => 0,
    'free_text' => 0,
    'text' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54bc366b19e7b8_63344484',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bc366b19e7b8_63344484')) {function content_54bc366b19e7b8_63344484($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/tools/smarty/plugins/modifier.escape.php';
?>
<table>
	<tr>
		<td style="text-align: left; font-size: 6pt; color: #444">
			<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_address']->value, 'htmlall', 'UTF-8');?>
<br />

			<?php if (!empty($_smarty_tpl->tpl_vars['shop_phone']->value)||!empty($_smarty_tpl->tpl_vars['shop_fax']->value)){?>
				<?php echo smartyTranslate(array('s'=>'For more assistance, contact Support:','pdf'=>'true'),$_smarty_tpl);?>
<br />
				<?php if (!empty($_smarty_tpl->tpl_vars['shop_phone']->value)){?>
					Tel: <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_phone']->value, 'htmlall', 'UTF-8');?>

				<?php }?>

				<?php if (!empty($_smarty_tpl->tpl_vars['shop_fax']->value)){?>
					Fax: <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_fax']->value, 'htmlall', 'UTF-8');?>

				<?php }?>
				<br />
			<?php }?>
            
            <?php if (isset($_smarty_tpl->tpl_vars['shop_details']->value)){?>
                <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['shop_details']->value, 'htmlall', 'UTF-8');?>
<br />
            <?php }?>

            <?php if (isset($_smarty_tpl->tpl_vars['free_text']->value)){?>
            	<?php  $_smarty_tpl->tpl_vars['text'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['text']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['free_text']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['text']->key => $_smarty_tpl->tpl_vars['text']->value){
$_smarty_tpl->tpl_vars['text']->_loop = true;
?>
    				<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['text']->value, 'htmlall', 'UTF-8');?>
<br />
    			<?php } ?>
            <?php }?>
		</td>
	</tr>
</table>

<?php }} ?>