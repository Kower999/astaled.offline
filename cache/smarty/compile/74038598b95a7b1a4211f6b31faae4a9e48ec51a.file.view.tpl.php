<?php /* Smarty version Smarty-3.1.8, created on 2015-01-18 23:37:27
         compiled from "/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/controllers/suppliers/helpers/view/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132391935954bc35a7c31768-17985392%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74038598b95a7b1a4211f6b31faae4a9e48ec51a' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/controllers/suppliers/helpers/view/view.tpl',
      1 => 1420467901,
      2 => 'file',
    ),
    '997c799acd757f5b738d74ca8c95f94476dd0180' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/helpers/view/view.tpl',
      1 => 1420467850,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132391935954bc35a7c31768-17985392',
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
  'unifunc' => 'content_54bc35a7dfdd29_50823549',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bc35a7dfdd29_50823549')) {function content_54bc35a7dfdd29_50823549($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['show_toolbar']->value){?>
	<?php echo $_smarty_tpl->getSubTemplate ("toolbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('toolbar_btn'=>$_smarty_tpl->tpl_vars['toolbar_btn']->value,'toolbar_scroll'=>$_smarty_tpl->tpl_vars['toolbar_scroll']->value,'title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>

<?php }?>

<div class="leadin"></div>



<h2><?php echo $_smarty_tpl->tpl_vars['supplier']->value->name;?>
</h2>

<h3><?php echo smartyTranslate(array('s'=>'Number of products:'),$_smarty_tpl);?>
 <?php echo count($_smarty_tpl->tpl_vars['products']->value);?>
</h3>
<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
	<hr />
	<?php if (!$_smarty_tpl->tpl_vars['product']->value->hasAttributes()){?>
		<table border="0" cellpadding="0" cellspacing="0" class="table" style="">
			<tr>
				<th  width="450"><?php echo smartyTranslate(array('s'=>'Name:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value->name;?>
</th>
				<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->product_supplier_reference)){?><th width="190"><?php echo smartyTranslate(array('s'=>'Supplier Reference:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value->product_supplier_reference;?>
</th><?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->product_supplier_price_te)){?><th width="190"><?php echo smartyTranslate(array('s'=>'Wholesale price:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value->product_supplier_price_te;?>
</th><?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->reference)){?><th width="150"><?php echo smartyTranslate(array('s'=>'Reference:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value->reference;?>
</th><?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->ean13)){?><th width="120"><?php echo smartyTranslate(array('s'=>'EAN13:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value->ean13;?>
</th><?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->upc)){?><th width="120"><?php echo smartyTranslate(array('s'=>'UPC:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value->upc;?>
</th><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['stock_management']->value){?><th class="right" width="150"><?php echo smartyTranslate(array('s'=>'Available Quantity:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['product']->value->quantity;?>
</th><?php }?>
			</tr>
		</table>
	<?php }else{ ?>
		<h3><a href="?tab=AdminProducts&id_product=<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
&updateproduct&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminProducts'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value->name;?>
</a></h3>
		<table border="0" cellpadding="0" cellspacing="0" class="table" style="width:100%;">
			<colgroup>
				<col>
				<col width="190">
				<col width="190">
				<col width="80">
				<col width="80">
				<col width="80">
				<col width="80">
			</colgroup>
			<tr>
				<th style="height:40px;"><?php echo smartyTranslate(array('s'=>'Attribute name'),$_smarty_tpl);?>
</th>
				<th><?php echo smartyTranslate(array('s'=>'Supplier Reference'),$_smarty_tpl);?>
</th>
				<th ><?php echo smartyTranslate(array('s'=>'Wholesale price'),$_smarty_tpl);?>
</th>
				<th><?php echo smartyTranslate(array('s'=>'Reference'),$_smarty_tpl);?>
</th>
				<th><?php echo smartyTranslate(array('s'=>'EAN13'),$_smarty_tpl);?>
</th>
				<th><?php echo smartyTranslate(array('s'=>'UPC'),$_smarty_tpl);?>
</th>
				<?php if ($_smarty_tpl->tpl_vars['stock_management']->value&&$_smarty_tpl->tpl_vars['shopContext']->value!=Shop::CONTEXT_ALL){?><th class="right"><?php echo smartyTranslate(array('s'=>'Available Quantity'),$_smarty_tpl);?>
</th><?php }?>
			</tr>
			<?php  $_smarty_tpl->tpl_vars['product_attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product_attribute']->_loop = false;
 $_smarty_tpl->tpl_vars['id_product_attribute'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['product']->value->combination; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product_attribute']->key => $_smarty_tpl->tpl_vars['product_attribute']->value){
$_smarty_tpl->tpl_vars['product_attribute']->_loop = true;
 $_smarty_tpl->tpl_vars['id_product_attribute']->value = $_smarty_tpl->tpl_vars['product_attribute']->key;
?>
				<tr <?php if ($_smarty_tpl->tpl_vars['id_product_attribute']->value%2){?>class="alt_row"<?php }?> >
					<td><?php echo $_smarty_tpl->tpl_vars['product_attribute']->value['attributes'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['product_attribute']->value['product_supplier_reference'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['product_attribute']->value['product_supplier_price_te'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['product_attribute']->value['reference'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['product_attribute']->value['ean13'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['product_attribute']->value['upc'];?>
</td>
					<?php if ($_smarty_tpl->tpl_vars['stock_management']->value&&$_smarty_tpl->tpl_vars['shopContext']->value!=Shop::CONTEXT_ALL){?><td class="right"><?php echo $_smarty_tpl->tpl_vars['product_attribute']->value['quantity'];?>
</td><?php }?>
				</tr>
			<?php } ?>
		</table>
	<?php }?>
<?php } ?>



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