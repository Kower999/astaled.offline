<?php /* Smarty version Smarty-3.1.8, created on 2015-01-15 15:11:10
         compiled from "/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/controllers/groups/helpers/view/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150822096954b7ca7e449896-50077973%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fe658ff859104af3f7d180ab885e86c66e2c9ad' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/controllers/groups/helpers/view/view.tpl',
      1 => 1420467881,
      2 => 'file',
    ),
    '997c799acd757f5b738d74ca8c95f94476dd0180' => 
    array (
      0 => '/var/www/virtual/esystem.sk/htdocs/clients/astaledonline/shopadmin/themes/default/template/helpers/view/view.tpl',
      1 => 1420467850,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150822096954b7ca7e449896-50077973',
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
  'unifunc' => 'content_54b7ca7e62c502_18935394',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b7ca7e62c502_18935394')) {function content_54b7ca7e62c502_18935394($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['show_toolbar']->value){?>
	<?php echo $_smarty_tpl->getSubTemplate ("toolbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('toolbar_btn'=>$_smarty_tpl->tpl_vars['toolbar_btn']->value,'toolbar_scroll'=>$_smarty_tpl->tpl_vars['toolbar_scroll']->value,'title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>

<?php }?>

<div class="leadin"></div>



	<fieldset>
		<ul>
			<li><span style="font-weight: bold; font-size: 13px; color:#000;"><?php echo smartyTranslate(array('s'=>'Name:'),$_smarty_tpl);?>
</span> <?php echo $_smarty_tpl->tpl_vars['group']->value->name[$_smarty_tpl->tpl_vars['language']->value->id];?>
</li>
		<li><span style="font-weight: bold; font-size: 13px; color:#000;"><?php echo smartyTranslate(array('s'=>'Discount: %d%%','sprintf'=>$_smarty_tpl->tpl_vars['group']->value->reduction),$_smarty_tpl);?>
</span></li>
		<li><span style="font-weight: bold; font-size: 13px; color:#000;"><?php echo smartyTranslate(array('s'=>'Current category discount:'),$_smarty_tpl);?>
</span>
			<?php if (!$_smarty_tpl->tpl_vars['categorieReductions']->value){?>
				<?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>

			<?php }else{ ?>
				<table cellspacing="0" cellpadding="0" class="table" style="margin-top:10px">
					<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['categorieReductions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['category']->key;
?>
						<tr class="alt_row">
							<td><?php echo $_smarty_tpl->tpl_vars['category']->value['path'];?>
</td>
							<td><?php echo smartyTranslate(array('s'=>'Discount: %d%%','sprintf'=>$_smarty_tpl->tpl_vars['category']->value['reduction']),$_smarty_tpl);?>
</td>
						</tr>
					<?php } ?>
				</table>
			<?php }?>
			</li>
			
		<li><span style="font-weight: bold; font-size: 13px; color:#000;"><?php echo smartyTranslate(array('s'=>'Price display method:'),$_smarty_tpl);?>
</span>
			<?php if ($_smarty_tpl->tpl_vars['group']->value->price_display_method){?>
				<?php echo smartyTranslate(array('s'=>'Tax excluded'),$_smarty_tpl);?>

			<?php }else{ ?>
				<?php echo smartyTranslate(array('s'=>'Tax included'),$_smarty_tpl);?>

			<?php }?>
		</li>
		<li><span style="font-weight: bold; font-size: 13px; color:#000;"><?php echo smartyTranslate(array('s'=>'Show prices:'),$_smarty_tpl);?>
</span> <?php if ($_smarty_tpl->tpl_vars['group']->value->show_prices){?><?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'No'),$_smarty_tpl);?>
<?php }?>
		</li>
		</ul>
	</fieldset>
	<h2><?php echo smartyTranslate(array('s'=>'Members of this customer group'),$_smarty_tpl);?>
</h2>
	<?php echo $_smarty_tpl->tpl_vars['customerList']->value;?>




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