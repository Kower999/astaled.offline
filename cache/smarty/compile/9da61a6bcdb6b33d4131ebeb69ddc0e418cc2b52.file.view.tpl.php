<?php /* Smarty version Smarty-3.1.8, created on 2015-01-18 23:38:48
         compiled from "/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/controllers/supply_orders/helpers/view/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:86979918654bc35f85c3ff8-88001798%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9da61a6bcdb6b33d4131ebeb69ddc0e418cc2b52' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/controllers/supply_orders/helpers/view/view.tpl',
      1 => 1420467903,
      2 => 'file',
    ),
    '997c799acd757f5b738d74ca8c95f94476dd0180' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/helpers/view/view.tpl',
      1 => 1420467850,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86979918654bc35f85c3ff8-88001798',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'show_toolbar' => 0,
    'toolbar_btn' => 0,
    'toolbar_scroll' => 0,
    'title' => 0,
    'name_controller' => 0,
    'hookName' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54bc35f8722d20_02624153',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bc35f8722d20_02624153')) {function content_54bc35f8722d20_02624153($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['show_toolbar']->value){?>
	<?php echo $_smarty_tpl->getSubTemplate ("toolbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('toolbar_btn'=>$_smarty_tpl->tpl_vars['toolbar_btn']->value,'toolbar_scroll'=>$_smarty_tpl->tpl_vars['toolbar_scroll']->value,'title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>

<?php }?>

<div class="leadin"></div>


	<div style="margin-top: 20px;">
		<fieldset>
			<legend><?php if (isset($_smarty_tpl->tpl_vars['is_template']->value)&&$_smarty_tpl->tpl_vars['is_template']->value==1){?> <?php echo smartyTranslate(array('s'=>'Template'),$_smarty_tpl);?>
 <?php }?><?php echo smartyTranslate(array('s'=>'General information'),$_smarty_tpl);?>
</legend>
			<table style="width: 400px;" classe="table">
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Creation date:'),$_smarty_tpl);?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_creation_date']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Supplier:'),$_smarty_tpl);?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_supplier_name']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Last update:'),$_smarty_tpl);?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_last_update']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Delivery expected:'),$_smarty_tpl);?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_expected']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Warehouse:'),$_smarty_tpl);?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_warehouse']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Currency:'),$_smarty_tpl);?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_currency']->value->name;?>
</td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Global discount rate:'),$_smarty_tpl);?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['supply_order_discount_rate']->value;?>
 %</td>
				</tr>
			</table>
		</fieldset>
	</div>

	<div style="margin-top: 20px;">
		<fieldset>
			<legend><?php if (isset($_smarty_tpl->tpl_vars['is_template']->value)&&$_smarty_tpl->tpl_vars['is_template']->value==1){?> <?php echo smartyTranslate(array('s'=>'Template'),$_smarty_tpl);?>
 <?php }?><?php echo smartyTranslate(array('s'=>'Products'),$_smarty_tpl);?>
</legend>
			<?php echo $_smarty_tpl->tpl_vars['supply_order_detail_content']->value;?>

		</fieldset>
	</div>

	<div style="margin-top: 20px;">
		<fieldset>
			<legend><?php if (isset($_smarty_tpl->tpl_vars['is_template']->value)&&$_smarty_tpl->tpl_vars['is_template']->value==1){?> <?php echo smartyTranslate(array('s'=>'Template'),$_smarty_tpl);?>
 <?php }?><?php echo smartyTranslate(array('s'=>'Summary'),$_smarty_tpl);?>
</legend>
			<table style="width: 400px;" classe="table">
				<tr>
					<th><?php echo smartyTranslate(array('s'=>'Designation'),$_smarty_tpl);?>
</th>
					<th width="100px"><?php echo smartyTranslate(array('s'=>'Value'),$_smarty_tpl);?>
</th>
				</tr>
				<tr>
					<td bgcolor="#000000"></td>
					<td bgcolor="#000000"></td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Total (tax excl.)'),$_smarty_tpl);?>
</td>
					<td align="right"><?php echo $_smarty_tpl->tpl_vars['supply_order_total_te']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Discount'),$_smarty_tpl);?>
</td>
					<td align="right"><?php echo $_smarty_tpl->tpl_vars['supply_order_discount_value_te']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Total with discount (tax excl.)'),$_smarty_tpl);?>
</td>
					<td align="right"><?php echo $_smarty_tpl->tpl_vars['supply_order_total_with_discount_te']->value;?>
</td>
				</tr>
				<tr>
					<td bgcolor="#000000"></td>
					<td bgcolor="#000000"></td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Total Tax'),$_smarty_tpl);?>
</td>
					<td align="right"><?php echo $_smarty_tpl->tpl_vars['supply_order_total_tax']->value;?>
</td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'Total (tax incl.)'),$_smarty_tpl);?>
</td>
					<td align="right"><?php echo $_smarty_tpl->tpl_vars['supply_order_total_ti']->value;?>
</td>
				</tr>
				<tr>
					<td bgcolor="#000000"></td>
					<td bgcolor="#000000"></td>
				</tr>
				<tr>
					<td><?php echo smartyTranslate(array('s'=>'TOTAL TO PAY'),$_smarty_tpl);?>
</td>
					<td align="right"><?php echo $_smarty_tpl->tpl_vars['supply_order_total_ti']->value;?>
</td>
				</tr>
			</table>
		</fieldset>
	</div>



<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>'displayAdminView'),$_smarty_tpl);?>

<?php if (isset($_smarty_tpl->tpl_vars['name_controller']->value)){?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('hookName', 'hookName', null); ob_start(); ?>display<?php echo ucfirst($_smarty_tpl->tpl_vars['name_controller']->value);?>
View<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>$_smarty_tpl->tpl_vars['hookName']->value),$_smarty_tpl);?>

<?php }elseif(isset($_GET['controller'])){?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('hookName', 'hookName', null); ob_start(); ?>display<?php echo htmlentities(ucfirst($_GET['controller']));?>
View<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
	<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>$_smarty_tpl->tpl_vars['hookName']->value),$_smarty_tpl);?>

<?php }?>
<?php }} ?>