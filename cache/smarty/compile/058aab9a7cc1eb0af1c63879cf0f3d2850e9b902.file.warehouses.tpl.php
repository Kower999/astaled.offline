<?php /* Smarty version Smarty-3.1.8, created on 2014-08-25 16:58:18
         compiled from "/var/www/virtual/astaled.sk/htdocs/shopadmin/themes/default/template/controllers/products/warehouses.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151483350253fb4f0a6b6c10-20174176%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '058aab9a7cc1eb0af1c63879cf0f3d2850e9b902' => 
    array (
      0 => '/var/www/virtual/astaled.sk/htdocs/shopadmin/themes/default/template/controllers/products/warehouses.tpl',
      1 => 1356963554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151483350253fb4f0a6b6c10-20174176',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
    'link' => 0,
    'warehouses' => 0,
    'warehouse' => 0,
    'attributes' => 0,
    'associated_warehouses' => 0,
    'aw' => 0,
    'attribute' => 0,
    'index' => 0,
    'selected' => 0,
    'product_designation' => 0,
    'location' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_53fb4f0a7fbce3_84401310',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fb4f0a7fbce3_84401310')) {function content_53fb4f0a7fbce3_84401310($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/virtual/astaled.sk/htdocs/tools/smarty/plugins/modifier.escape.php';
?>

<input type="hidden" name="warehouse_loaded" value="1">
<?php if (isset($_smarty_tpl->tpl_vars['product']->value->id)){?>
	<input type="hidden" name="submitted_tabs[]" value="Warehouses" />
	<h4><?php echo smartyTranslate(array('s'=>'Product location in warehouses'),$_smarty_tpl);?>
</h4>
				<div class="separation"></div>
				<div class="hint" style="display:block; position:'auto';">
		<p><?php echo smartyTranslate(array('s'=>'This interface allows you to specify in which warehouses the product is stocked.'),$_smarty_tpl);?>
</p>
		<p><?php echo smartyTranslate(array('s'=>'It is also possible to specify for each product/product combination its location in each warehouse.'),$_smarty_tpl);?>
</p>
	</div>
	<p><?php echo smartyTranslate(array('s'=>'Please choose the warehouses associated with this product, and the default one.'),$_smarty_tpl);?>
</p>

	<a class="button bt-icon confirm_leave" href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminWarehouses'), 'htmlall', 'UTF-8');?>
&addwarehouse">
		<img src="../img/admin/add.gif" alt="<?php echo smartyTranslate(array('s'=>'Create new warehouse'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Create new warehouse'),$_smarty_tpl);?>
" /><span><?php echo smartyTranslate(array('s'=>'Create new warehouse'),$_smarty_tpl);?>
</span>
	</a>

	<div id="warehouse_accordion" style="margin-top:10px; display:block;">
		<?php  $_smarty_tpl->tpl_vars['warehouse'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['warehouse']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['warehouse']->key => $_smarty_tpl->tpl_vars['warehouse']->value){
$_smarty_tpl->tpl_vars['warehouse']->_loop = true;
?>
		    <h3 style="margin-bottom:0;"><a href="#"><?php echo $_smarty_tpl->tpl_vars['warehouse']->value['name'];?>
</a></h3>
		    <div style="display:block;">
				<table cellpadding="10" cellspacing="0" class="table">
					<tr>
						<th width="100"><?php echo smartyTranslate(array('s'=>'Stored'),$_smarty_tpl);?>
</th>
						<th><?php echo smartyTranslate(array('s'=>'Product'),$_smarty_tpl);?>
</th>
						<th width="150"><?php echo smartyTranslate(array('s'=>'Location (optional)'),$_smarty_tpl);?>
</th>
					</tr>
					<?php  $_smarty_tpl->tpl_vars['attribute'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['attribute']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['attributes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['attribute']->key => $_smarty_tpl->tpl_vars['attribute']->value){
$_smarty_tpl->tpl_vars['attribute']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['attribute']->key;
?>
						<?php $_smarty_tpl->tpl_vars['location'] = new Smarty_variable('', null, 0);?>
						<?php $_smarty_tpl->tpl_vars['selected'] = new Smarty_variable('', null, 0);?>
						<?php  $_smarty_tpl->tpl_vars['aw'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['aw']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['associated_warehouses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['aw']->key => $_smarty_tpl->tpl_vars['aw']->value){
$_smarty_tpl->tpl_vars['aw']->_loop = true;
?>
							<?php if ($_smarty_tpl->tpl_vars['aw']->value->id_product==$_smarty_tpl->tpl_vars['attribute']->value['id_product']&&$_smarty_tpl->tpl_vars['aw']->value->id_product_attribute==$_smarty_tpl->tpl_vars['attribute']->value['id_product_attribute']&&$_smarty_tpl->tpl_vars['aw']->value->id_warehouse==$_smarty_tpl->tpl_vars['warehouse']->value['id_warehouse']){?>
								<?php $_smarty_tpl->tpl_vars['location'] = new Smarty_variable($_smarty_tpl->tpl_vars['aw']->value->location, null, 0);?>
								<?php $_smarty_tpl->tpl_vars['selected'] = new Smarty_variable(true, null, 0);?>
							<?php }?>
						<?php } ?>
						<tr <?php if ((1 & $_smarty_tpl->tpl_vars['index']->value)){?>class="alt_row"<?php }?>>
							<td><input type="checkbox"
								name="check_warehouse_<?php echo $_smarty_tpl->tpl_vars['warehouse']->value['id_warehouse'];?>
_<?php echo $_smarty_tpl->tpl_vars['attribute']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['attribute']->value['id_product_attribute'];?>
"
								<?php if ($_smarty_tpl->tpl_vars['selected']->value==true){?>checked="checked"<?php }?>
								value="1" />
							</td>
							<td><?php echo $_smarty_tpl->tpl_vars['product_designation']->value[$_smarty_tpl->tpl_vars['attribute']->value['id_product_attribute']];?>
</td>
							<td><input type="text"
								name="location_warehouse_<?php echo $_smarty_tpl->tpl_vars['warehouse']->value['id_warehouse'];?>
_<?php echo $_smarty_tpl->tpl_vars['attribute']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['attribute']->value['id_product_attribute'];?>
"
								value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['location']->value, 'htmlall', 'UTF-8');?>
"
								size="20" />
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
					<?php if (count($_smarty_tpl->tpl_vars['attributes']->value)>1){?>
					<tr>
						<td><input type="checkbox" class="check_all_warehouse" value="check_warehouse_<?php echo $_smarty_tpl->tpl_vars['warehouse']->value['id_warehouse'];?>
" /></td>
						<td colspan="2"><i><?php echo smartyTranslate(array('s'=>'Mark all products as stored in this warehouse.'),$_smarty_tpl);?>
</i></td>
					</tr>
					<?php }?>
				</table>
			</div>
		<?php } ?>
	</div>
	<p>&nbsp;</p>
<?php }?><?php }} ?>