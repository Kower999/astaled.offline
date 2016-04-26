<?php /* Smarty version Smarty-3.1.8, created on 2014-10-31 20:01:54
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\customer_threads\message.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46395453dca27997e9-34072871%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6b6d005b5789b71fc85692ac5af3c4670cd0c43' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\customer_threads\\message.tpl',
      1 => 1412842276,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46395453dca27997e9-34072871',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'email' => 0,
    'message' => 0,
    'PS_SHOP_NAME' => 0,
    'file_name' => 0,
    'current' => 0,
    'token' => 0,
    'contacts' => 0,
    'contact' => 0,
    'id_employee' => 0,
    'PS_CUSTOMER_SERVICE_SIGNATURE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5453dca29ec960_16370452',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5453dca29ec960_16370452')) {function content_5453dca29ec960_16370452($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.escape.php';
?>



<?php if (!$_smarty_tpl->tpl_vars['email']->value){?>

	<fieldset style="margin-top:10px;<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['id_employee'])){?>background-color:#F0F8E6;border:1px solid #88D254<?php }?>">
		<legend <?php if (!empty($_smarty_tpl->tpl_vars['message']->value['id_employee'])){?>style="background-color:#F0F8E6;color:#000;border:1px solid #88D254;"<?php }?>>
			<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['employee_name'])){?>
				<img src="../img/t/AdminCustomers.gif" alt="<?php echo $_smarty_tpl->tpl_vars['PS_SHOP_NAME']->value;?>
" />
					<?php echo $_smarty_tpl->tpl_vars['PS_SHOP_NAME']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['message']->value['employee_name'];?>

			<?php }else{ ?>
				<img src="../img/admin/tab-customers.gif" alt="<?php echo $_smarty_tpl->tpl_vars['PS_SHOP_NAME']->value;?>
" />
				<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['id_customer'])){?>
					<a href="index.php?tab=AdminCustomers&id_customer=<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer'];?>
&viewcustomer&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminCustomers'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'View customer'),$_smarty_tpl);?>
">
						<?php echo $_smarty_tpl->tpl_vars['message']->value['customer_name'];?>

					</a>
				<?php }else{ ?>
					<?php echo $_smarty_tpl->tpl_vars['message']->value['email'];?>

				<?php }?>
			<?php }?>
		</legend>

		<div class="infoCustomer">
			<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['id_customer'])&&empty($_smarty_tpl->tpl_vars['message']->value['id_employee'])){?>
			<dl>
				<dt><?php echo smartyTranslate(array('s'=>'Customer ID:'),$_smarty_tpl);?>
</dd> 
				<dd><a href="index.php?tab=AdminCustomers&id_customer=<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer'];?>
&viewcustomer&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminCustomers'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'View customer'),$_smarty_tpl);?>
">
					<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer'];?>
 <img src="../img/admin/search.gif" alt="<?php echo smartyTranslate(array('s'=>'view'),$_smarty_tpl);?>
" />
				</a>
				</dd>
			</dl>
			<?php }?>
			
			<dl>			
				<dt><?php echo smartyTranslate(array('s'=>'Sent on:'),$_smarty_tpl);?>
</dt>
				<dd><?php echo $_smarty_tpl->tpl_vars['message']->value['date_add'];?>
</dd> 
			
			</dl>

			<?php if (empty($_smarty_tpl->tpl_vars['message']->value['id_employee'])){?>
			<dl>
				<dt><?php echo smartyTranslate(array('s'=>'Browser:'),$_smarty_tpl);?>
</dt>
				<dd><?php echo $_smarty_tpl->tpl_vars['message']->value['user_agent'];?>
</dd>
			</dl>
			<?php }?>

			<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['file_name'])&&$_smarty_tpl->tpl_vars['file_name']->value){?>
			<dl>
				<dt><?php echo smartyTranslate(array('s'=>'File attachment'),$_smarty_tpl);?>
</dt> 
				<dd><a href="index.php?tab=AdminCustomerThreads&id_customer_thread=<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer_thread'];?>
&viewcustomer_thread&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminCustomerThreads'),$_smarty_tpl);?>
&filename=<?php echo $_smarty_tpl->tpl_vars['message']->value['file_name'];?>
"
					title="<?php echo smartyTranslate(array('s'=>'View file'),$_smarty_tpl);?>
">
						<img src="../img/admin/search.gif" alt="<?php echo smartyTranslate(array('s'=>'view'),$_smarty_tpl);?>
" />
				</a>
				</dd>
			</dl>
			<?php }?>

			<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['id_order'])&&empty($_smarty_tpl->tpl_vars['message']->value['id_employee'])){?>
				<dl>
					<dt><?php echo smartyTranslate(array('s'=>'Order #'),$_smarty_tpl);?>
</dt> 
					<dd><a href="index.php?tab=AdminOrders&id_order=<?php echo $_smarty_tpl->tpl_vars['message']->value['id_order'];?>
&vieworder&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminOrders'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'View order'),$_smarty_tpl);?>
">
					<?php echo $_smarty_tpl->tpl_vars['message']->value['id_order'];?>
 <img src="../img/admin/search.gif" alt="<?php echo smartyTranslate(array('s'=>'view'),$_smarty_tpl);?>
" />
				</a></dd>
				</dl>
			<?php }?>

			<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['id_product'])&&empty($_smarty_tpl->tpl_vars['message']->value['id_employee'])){?>
				<dl>
					<dt><?php echo smartyTranslate(array('s'=>'Product #'),$_smarty_tpl);?>
</dt> 
					<dd><a href="index.php?tab=AdminProducts&id_product=<?php echo $_smarty_tpl->tpl_vars['message']->value['id_product'];?>
&updateproduct&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminProducts'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'View order'),$_smarty_tpl);?>
">
					<?php echo $_smarty_tpl->tpl_vars['message']->value['id_product'];?>
 <img src="../img/admin/search.gif" alt="<?php echo smartyTranslate(array('s'=>'view'),$_smarty_tpl);?>
" />
				</a></dd>
				</dl>
			<?php }?>
			
				<form action="<?php echo $_smarty_tpl->tpl_vars['current']->value;?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
&id_customer_thread=<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer_thread'];?>
&viewcustomer_thread" method="post">
				<b><?php echo smartyTranslate(array('s'=>'Subject:'),$_smarty_tpl);?>
</b>
				<input type="hidden" name="id_customer_message" value="<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer_message'];?>
" />
				<select name="id_contact" onchange="this.form.submit();">
					<?php  $_smarty_tpl->tpl_vars['contact'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['contact']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['contacts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['contact']->key => $_smarty_tpl->tpl_vars['contact']->value){
$_smarty_tpl->tpl_vars['contact']->_loop = true;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['contact']->value['id_contact'];?>
" <?php if ($_smarty_tpl->tpl_vars['contact']->value['id_contact']==$_smarty_tpl->tpl_vars['message']->value['id_contact']){?>selected="selected"<?php }?>>
							<?php echo $_smarty_tpl->tpl_vars['contact']->value['name'];?>

						</option>
					<?php } ?>
				</select>
			</form>


<?php }else{ ?>

	<div class="infoEmployee">
		<?php if ($_smarty_tpl->tpl_vars['id_employee']->value){?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['current']->value;?>
&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminCustomerThreads'),$_smarty_tpl);?>
&id_customer_thread=<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer_thread'];?>
&viewcustomer_thread">'.
				<?php echo smartyTranslate(array('s'=>'View this thread'),$_smarty_tpl);?>

			</a><br />
		<?php }?>
		<b><?php echo smartyTranslate(array('s'=>'Sent by:'),$_smarty_tpl);?>
</b>

		<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['customer_name'])){?>
			<?php echo $_smarty_tpl->tpl_vars['message']->value['customer_name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['message']->value['email'];?>
)
		<?php }else{ ?>
			<?php echo $_smarty_tpl->tpl_vars['message']->value['email'];?>

		<?php }?>

		<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['id_customer'])&&empty($_smarty_tpl->tpl_vars['message']->value['id_employee'])){?>
			<br /><b><?php echo smartyTranslate(array('s'=>'Customer ID:'),$_smarty_tpl);?>
</b> <?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer'];?>
<br />
		<?php }?>

		<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['id_order'])&&empty($_smarty_tpl->tpl_vars['message']->value['id_employee'])){?>
			<br /><b><?php echo smartyTranslate(array('s'=>'Order #'),$_smarty_tpl);?>
:</b> <?php echo $_smarty_tpl->tpl_vars['message']->value['id_order'];?>
<br />
		<?php }?>

		<?php if (!empty($_smarty_tpl->tpl_vars['message']->value['id_product'])&&empty($_smarty_tpl->tpl_vars['message']->value['id_employee'])){?>
			<br /><b><?php echo smartyTranslate(array('s'=>'Product #'),$_smarty_tpl);?>
:</b> <?php echo $_smarty_tpl->tpl_vars['message']->value['id_product'];?>
<br />
		<?php }?>

		<br /><b><?php echo smartyTranslate(array('s'=>'Subject:'),$_smarty_tpl);?>
</b> <?php echo $_smarty_tpl->tpl_vars['message']->value['subject'];?>


<?php }?>
		<dl>
			<dt><?php echo smartyTranslate(array('s'=>'Thread ID:'),$_smarty_tpl);?>
</dt>
			<dd><?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer_thread'];?>
</dd>
		</dl>
		<dl>
			<dt><?php echo smartyTranslate(array('s'=>'Message ID:'),$_smarty_tpl);?>
</dt>
			<dd><?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer_message'];?>
</dd>
		</dl>
		<dl>
			<dt><?php echo smartyTranslate(array('s'=>'Message:'),$_smarty_tpl);?>
</dt>
			<dd><?php echo nl2br(smarty_modifier_escape($_smarty_tpl->tpl_vars['message']->value['message'], 'htmlall', 'UTF-8'));?>
</dd>
		</dl>
	</div>

<?php if (!$_smarty_tpl->tpl_vars['email']->value){?>
	<?php if (empty($_smarty_tpl->tpl_vars['message']->value['id_employee'])){?>
			<button class="button" style="font-size:12px;"
				onclick="$('#reply_to_<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer_message'];?>
').show(500); $(this).hide();">
				<img src="../img/admin/contact.gif" alt=""/><?php echo smartyTranslate(array('s'=>'Reply to this message'),$_smarty_tpl);?>

			</button>
	<?php }?>

	<div id="reply_to_<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer_message'];?>
" style="display: none; margin-top: 20px;"">
		<form action="<?php echo $_smarty_tpl->tpl_vars['current']->value;?>
&token=<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['getAdminToken'][0][0]->getAdminTokenLiteSmarty(array('tab'=>'AdminCustomerThreads'),$_smarty_tpl);?>
&id_customer_thread=<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer_thread'];?>
&viewcustomer_thread" method="post" enctype="multipart/form-data">
			<p><?php echo smartyTranslate(array('s'=>'Please type your reply below:'),$_smarty_tpl);?>
</p>
			<textarea style="width: 450px; height: 175px;" name="reply_message"><?php echo $_smarty_tpl->tpl_vars['PS_CUSTOMER_SERVICE_SIGNATURE']->value;?>
</textarea>
			<div style="width: 450px; text-align: right; font-style: italic; font-size: 9px; margin-top: 2px;">
				<?php echo smartyTranslate(array('s'=>'Your reply will be sent to:'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['message']->value['email'];?>

			</div>
			<div style="width: 450px; margin-top: 0px;">
				<input type="file" name="joinFile"/>
			<div>
			<div>
				<input type="submit" class="button" name="submitReply" value="<?php echo smartyTranslate(array('s'=>'Send my reply'),$_smarty_tpl);?>
" style="margin-top:20px;" />
				<input type="hidden" name="id_customer_thread" value="<?php echo $_smarty_tpl->tpl_vars['message']->value['id_customer_thread'];?>
" />
				<input type="hidden" name="msg_email" value="<?php echo $_smarty_tpl->tpl_vars['message']->value['email'];?>
" />
			</div>					
		</form>
	</div>

	</fieldset>

<?php }?>

	</fieldset>
<?php }} ?>