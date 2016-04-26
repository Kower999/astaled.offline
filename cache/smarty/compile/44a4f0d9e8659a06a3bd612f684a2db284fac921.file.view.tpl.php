<?php /* Smarty version Smarty-3.1.8, created on 2015-02-27 21:15:23
         compiled from "C:\wamp\www\shopadmin\themes\default\template\controllers\warehouses\helpers\view\view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1452354f0d05bd46e51-98074268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44a4f0d9e8659a06a3bd612f684a2db284fac921' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin\\themes\\default\\template\\controllers\\warehouses\\helpers\\view\\view.tpl',
      1 => 1423781537,
      2 => 'file',
    ),
    '51367bb1fb14a4a57aa34f1fb21f6c485b92f92d' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\helpers\\view\\view.tpl',
      1 => 1423781537,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1452354f0d05bd46e51-98074268',
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
  'unifunc' => 'content_54f0d05bed7701_17906148',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54f0d05bed7701_17906148')) {function content_54f0d05bed7701_17906148($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['show_toolbar']->value){?>
	<?php echo $_smarty_tpl->getSubTemplate ("toolbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('toolbar_btn'=>$_smarty_tpl->tpl_vars['toolbar_btn']->value,'toolbar_scroll'=>$_smarty_tpl->tpl_vars['toolbar_scroll']->value,'title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>

<?php }?>

<div class="leadin"></div>


<?php if (isset($_smarty_tpl->tpl_vars['warehouse']->value)){?>
	<div>
			<fieldset>
				<legend><img src="../img/t/AdminPreferences.gif" alt="" />  <?php echo smartyTranslate(array('s'=>'General informations'),$_smarty_tpl);?>
</legend>
				<table style="width: 400px;" classe="table">
					<tr>
						<td><?php echo smartyTranslate(array('s'=>'Reference:'),$_smarty_tpl);?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['warehouse']->value->reference;?>
</td>
					</tr>
					<tr>
						<td><?php echo smartyTranslate(array('s'=>'Name:'),$_smarty_tpl);?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['warehouse']->value->name;?>
</td>
					</tr>
					<tr>
						<td><?php echo smartyTranslate(array('s'=>'Manager:'),$_smarty_tpl);?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['employee']->value->lastname;?>
 <?php echo $_smarty_tpl->tpl_vars['employee']->value->firstname;?>
</td>
					</tr>
					<tr>
						<td><?php echo smartyTranslate(array('s'=>'Country:'),$_smarty_tpl);?>
</td>
						<td><?php if ($_smarty_tpl->tpl_vars['address']->value->country!=''){?><?php echo $_smarty_tpl->tpl_vars['address']->value->country;?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'N/D'),$_smarty_tpl);?>
<?php }?></td>
					</tr>
					<tr>
						<td><?php echo smartyTranslate(array('s'=>'Phone:'),$_smarty_tpl);?>
</td>
						<td><?php if ($_smarty_tpl->tpl_vars['address']->value->phone!=''){?><?php echo $_smarty_tpl->tpl_vars['address']->value->phone;?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'N/D'),$_smarty_tpl);?>
<?php }?></td>
					</tr>
					<tr>
						<td><?php echo smartyTranslate(array('s'=>'Management type:'),$_smarty_tpl);?>
</td>
						<td><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['warehouse']->value->management_type),$_smarty_tpl);?>
</td>
					</tr>
					<tr>
						<td><?php echo smartyTranslate(array('s'=>'Valuation currency:'),$_smarty_tpl);?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['currency']->value->name;?>
 (<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
)</td>
					</tr>
					<tr>
						<td><?php echo smartyTranslate(array('s'=>'Products:'),$_smarty_tpl);?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['warehouse_num_products']->value;?>
 <?php echo smartyTranslate(array('s'=>'References:'),$_smarty_tpl);?>
</td>
					</tr>
					<tr>
						<td><?php echo smartyTranslate(array('s'=>'Physical product quantities:'),$_smarty_tpl);?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['warehouse_quantities']->value;?>
</td>
					</tr>
					<tr>
						<td><?php echo smartyTranslate(array('s'=>'Stock valuation:'),$_smarty_tpl);?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['warehouse_value']->value;?>
</td>
					</tr>
				</table>
			</fieldset>
		</div>
		<div style="margin-top: 30px">
			<fieldset>
				<legend><img src="../img/t/AdminShop.gif" alt="" /> <?php echo smartyTranslate(array('s'=>'Shops'),$_smarty_tpl);?>
</legend>
				<?php echo smartyTranslate(array('s'=>'The following are the shops associated with this warehouse.'),$_smarty_tpl);?>

				<table style="width: 400px; margin-top:20px" classe="table">
					<tr>
						<th><?php echo smartyTranslate(array('s'=>'ID'),$_smarty_tpl);?>
</th>
						<th><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</th>
					<?php  $_smarty_tpl->tpl_vars['shop'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['shop']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shops']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['shop']->key => $_smarty_tpl->tpl_vars['shop']->value){
$_smarty_tpl->tpl_vars['shop']->_loop = true;
?>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['shop']->value['id_shop'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['shop']->value['name'];?>
</td>
					</tr>
					<?php } ?>
				</table>
			</fieldset>
		</div>
		<div style="margin-top: 30px">
			<fieldset>
				<legend><img src="../img/t/AdminStock.gif" alt="" /> <?php echo smartyTranslate(array('s'=>'Stock'),$_smarty_tpl);?>
</legend>
				<a href="index.php?controller=adminstockinstantstate&id_warehouse=<?php echo $_smarty_tpl->tpl_vars['warehouse']->value->id;?>
&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminStockInstantState'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Click here if you want details on products in this warehouse'),$_smarty_tpl);?>
</a>
			</fieldset>
		</div>
		<div style="margin-top: 30px">
		<fieldset>
			<legend><img src="../img/t/AdminLogs.gif" alt="" /> <?php echo smartyTranslate(array('s'=>'History'),$_smarty_tpl);?>
</legend>
			<a href="index.php?controller=adminstockmvt&id_warehouse=<?php echo $_smarty_tpl->tpl_vars['warehouse']->value->id;?>
&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminStockMvt'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Click here if you want details on what happened in this warehouse'),$_smarty_tpl);?>
</a>
		</fieldset>
		</div>
<?php }else{ ?>
	<?php echo smartyTranslate(array('s'=>'This warehouse does not exist'),$_smarty_tpl);?>

<?php }?>


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