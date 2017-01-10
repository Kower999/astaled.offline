<?php /* Smarty version Smarty-3.1.8, created on 2014-10-31 01:10:39
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\cart_rules\form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:182595452d37f55d4a1-21220482%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8b27ae97b8cab0801408374b0015f63a56b429a' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\cart_rules\\form.tpl',
      1 => 1412842267,
      2 => 'file',
    ),
    '53c28046de01b186b9039848b575b0b121209475' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\cart_rules\\informations.tpl',
      1 => 1412842267,
      2 => 'file',
    ),
    '8406074f58c9f0097c7fe3a160a9b1be35b2ca11' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\cart_rules\\conditions.tpl',
      1 => 1412842267,
      2 => 'file',
    ),
    '3be7cfd391766008be0343ad696657e54f81f23f' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\cart_rules\\actions.tpl',
      1 => 1412842267,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182595452d37f55d4a1-21220482',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'toolbar_btn' => 0,
    'toolbar_scroll' => 0,
    'title' => 0,
    'currentIndex' => 0,
    'currentToken' => 0,
    'currentObject' => 0,
    'table' => 0,
    'product_rule_groups_counter' => 0,
    'languages' => 0,
    'k' => 0,
    'language' => 0,
    'id_lang_default' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5452d37fc0e170_66410738',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5452d37fc0e170_66410738')) {function content_5452d37fc0e170_66410738($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("toolbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('toolbar_btn'=>$_smarty_tpl->tpl_vars['toolbar_btn']->value,'toolbar_scroll'=>$_smarty_tpl->tpl_vars['toolbar_scroll']->value,'title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>

<div class="leadin"></div>

<div>
 	<div class="productTabs">
		<ul class="tab">
			<li class="tab-row">
				<a class="tab-page" id="cart_rule_link_informations" href="javascript:displayCartRuleTab('informations');"><?php echo smartyTranslate(array('s'=>'Information'),$_smarty_tpl);?>
</a>
			</li>
			<li class="tab-row">
				<a class="tab-page" id="cart_rule_link_conditions" href="javascript:displayCartRuleTab('conditions');"><?php echo smartyTranslate(array('s'=>'Conditions'),$_smarty_tpl);?>
</a>
			</li>
			<li class="tab-row">
				<a class="tab-page" id="cart_rule_link_actions" href="javascript:displayCartRuleTab('actions');"><?php echo smartyTranslate(array('s'=>'Actions'),$_smarty_tpl);?>
</a>
			</li>
		</ul>
	</div>
</div>
<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentIndex']->value, ENT_QUOTES, 'UTF-8');?>
&token=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentToken']->value, ENT_QUOTES, 'UTF-8');?>
&addcart_rule" id="cart_rule_form" method="post">
	<?php if ($_smarty_tpl->tpl_vars['currentObject']->value->id){?><input type="hidden" name="id_cart_rule" value="<?php echo intval($_smarty_tpl->tpl_vars['currentObject']->value->id);?>
" /><?php }?>
	<input type="hidden" id="currentFormTab" name="currentFormTab" value="informations" />
	<div id="cart_rule_informations" class="cart_rule_tab">
		<h4><?php echo smartyTranslate(array('s'=>'Cart rule information'),$_smarty_tpl);?>
</h4>
		<div class="separation"></div>
		<?php /*  Call merged included template "controllers/cart_rules/informations.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('controllers/cart_rules/informations.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '182595452d37f55d4a1-21220482');
content_5452d37f610940_02872585($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "controllers/cart_rules/informations.tpl" */?>
	</div>
	<div id="cart_rule_conditions" class="cart_rule_tab">
		<h4><?php echo smartyTranslate(array('s'=>'Cart rule conditions'),$_smarty_tpl);?>
</h4>
		<div class="separation"></div>
		<?php /*  Call merged included template "controllers/cart_rules/conditions.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('controllers/cart_rules/conditions.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '182595452d37f55d4a1-21220482');
content_5452d37f72ade8_58707816($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "controllers/cart_rules/conditions.tpl" */?>
	</div>
	<div id="cart_rule_actions" class="cart_rule_tab">
		<h4><?php echo smartyTranslate(array('s'=>'Cart rule actions'),$_smarty_tpl);?>
</h4>
		<div class="separation"></div>
		<?php /*  Call merged included template "controllers/cart_rules/actions.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('controllers/cart_rules/actions.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '182595452d37f55d4a1-21220482');
content_5452d37f9fbd87_96698556($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "controllers/cart_rules/actions.tpl" */?>
	</div>
	<div class="separation"></div>
	<div style="text-align:center">
		<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" class="button" name="submitAddcart_rule" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['table']->value, ENT_QUOTES, 'UTF-8');?>
_form_submit_btn" />
		<!--<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Save and stay'),$_smarty_tpl);?>
" class="button" name="submitAddcart_ruleAndStay" id="" />-->
	</div>
</form>
<script type="text/javascript">
	var product_rule_groups_counter = <?php if (isset($_smarty_tpl->tpl_vars['product_rule_groups_counter']->value)){?><?php echo intval($_smarty_tpl->tpl_vars['product_rule_groups_counter']->value);?>
<?php }else{ ?>0<?php }?>;
	var product_rule_counters = new Array();
	var currentToken = '<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['currentToken']->value);?>
';
	var currentFormTab = '<?php if (isset($_POST['currentFormTab'])){?><?php echo preg_replace("%(?<!\\\\)'%", "\'",$_POST['currentFormTab']);?>
<?php }else{ ?>informations<?php }?>';
	
	var languages = new Array();
	<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['language']->key;
?>
		languages[<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
] = {
			id_lang: <?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
,
			iso_code: '<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['language']->value['iso_code']);?>
',
			name: '<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['language']->value['name']);?>
'
		};
	<?php } ?>
	displayFlags(languages, <?php echo $_smarty_tpl->tpl_vars['id_lang_default']->value;?>
);
</script>
<script type="text/javascript" src="themes/default/template/controllers/cart_rules/form.js"></script><?php }} ?><?php /* Smarty version Smarty-3.1.8, created on 2014-10-31 01:10:39
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\cart_rules\informations.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5452d37f610940_02872585')) {function content_5452d37f610940_02872585($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.escape.php';
?><table cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<label><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</label>
			<div class="margin-form">
				<div class="translatable">
				<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value){
$_smarty_tpl->tpl_vars['language']->_loop = true;
?>
					<div class="lang_<?php echo intval($_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
" style="display:<?php if ($_smarty_tpl->tpl_vars['language']->value['id_lang']==$_smarty_tpl->tpl_vars['id_lang_default']->value){?>block<?php }else{ ?>none<?php }?>;float:left">
						<input type="text" id="name_<?php echo intval($_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
" name="name_<?php echo intval($_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'name',intval($_smarty_tpl->tpl_vars['language']->value['id_lang'])), 'html', 'UTF-8');?>
" style="width:400px" />
						<sup>*</sup>
					</div>
				<?php } ?>
				</div>
				<p class="preference_description"><?php echo smartyTranslate(array('s'=>'Will be displayed in the cart summary as well as on the invoice.'),$_smarty_tpl);?>
</p>
			</div>
			<label><?php echo smartyTranslate(array('s'=>'Description'),$_smarty_tpl);?>
</label>
			<div class="margin-form">
				<textarea name="description" style="width:80%;height:100px"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'description'), ENT_QUOTES, 'UTF-8');?>
</textarea>
				<p class="preference_description"><?php echo smartyTranslate(array('s'=>'For you only, never displayed to the customer.'),$_smarty_tpl);?>
</p>
			</div>
			<label><?php echo smartyTranslate(array('s'=>'Code'),$_smarty_tpl);?>
</label>
			<div class="margin-form">
				<input type="text" id="code" name="code" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'code'), ENT_QUOTES, 'UTF-8');?>
" />
				<a href="javascript:gencode(8);" class="button"><?php echo smartyTranslate(array('s'=>'(Click to generate random code)'),$_smarty_tpl);?>
</a>
				<p class="preference_description"><?php echo smartyTranslate(array('s'=>'Caution! The rule will automatically be applied if you leave this field blank.'),$_smarty_tpl);?>
</p>
			</div>
			<label><?php echo smartyTranslate(array('s'=>'Highlight'),$_smarty_tpl);?>
</label>
			<div class="margin-form">
				&nbsp;&nbsp;
				<input type="radio" name="highlight" id="highlight_on" value="1" <?php if (intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'highlight'))){?>checked="checked"<?php }?> />
				<label class="t" for="highlight_on"> <img src="../img/admin/enabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Yes'),$_smarty_tpl);?>
" style="cursor:pointer" /></label>
				&nbsp;&nbsp;
				<input type="radio" name="highlight" id="highlight_off" value="0"  <?php if (!intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'highlight'))){?>checked="checked"<?php }?> />
				<label class="t" for="highlight_off"> <img src="../img/admin/disabled.gif" alt="<?php echo smartyTranslate(array('s'=>'No'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'No'),$_smarty_tpl);?>
" style="cursor:pointer" /></label>
				<p class="preference_description">
					<?php echo smartyTranslate(array('s'=>'If the voucher is not yet in the cart, it will be displayed under the cart in the cart summary.'),$_smarty_tpl);?>

				</p>
			</div>
			<label><?php echo smartyTranslate(array('s'=>'Partial use'),$_smarty_tpl);?>
</label>
			<div class="margin-form">
				&nbsp;&nbsp;
				<input type="radio" name="partial_use" id="partial_use_on" value="1" <?php if (intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'partial_use'))){?>checked="checked"<?php }?> />
				<label class="t" for="partial_use_on"> <img src="../img/admin/enabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Allowed'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Allowed'),$_smarty_tpl);?>
" style="cursor:pointer" /></label>
				&nbsp;&nbsp;
				<input type="radio" name="partial_use" id="partial_use_off" value="0"  <?php if (!intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'partial_use'))){?>checked="checked"<?php }?> />
				<label class="t" for="partial_use_off"> <img src="../img/admin/disabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Not allowed'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Not allowed'),$_smarty_tpl);?>
" style="cursor:pointer" /></label>
				<p class="preference_description">
					<?php echo smartyTranslate(array('s'=>'Only applicable if the voucher value is greater than the cart total.'),$_smarty_tpl);?>
<br />
					<?php echo smartyTranslate(array('s'=>'If you do not allow partial use, the voucher value will be lowered to the total order amount, but if you do, a new voucher will be created with the remainder.'),$_smarty_tpl);?>

				</p>
			</div>
			<label><?php echo smartyTranslate(array('s'=>'Priority'),$_smarty_tpl);?>
</label>
			<div class="margin-form">
				<input type="text" name="priority" value="<?php echo intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'priority'));?>
" />
				<p class="preference_description"><?php echo smartyTranslate(array('s'=>'Cart rules are applied to the cart by priority. A cart rule with priority of "1" will be processed before a cart rule with a priority of "2".'),$_smarty_tpl);?>
</p>
			</div>
			<label><?php echo smartyTranslate(array('s'=>'Status'),$_smarty_tpl);?>
</label>
			<div class="margin-form">
				&nbsp;&nbsp;
				<input type="radio" name="active" id="active_on" value="1" <?php if (intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'active'))){?>checked="checked"<?php }?> />
				<label class="t" for="active_on"> <img src="../img/admin/enabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
" style="cursor:pointer" /></label>
				&nbsp;&nbsp;
				<input type="radio" name="active" id="active_off" value="0"  <?php if (!intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'active'))){?>checked="checked"<?php }?> />
				<label class="t" for="active_off"> <img src="../img/admin/disabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
" style="cursor:pointer" /></label>
			</div>
		</td>
	</tr>
</table><?php }} ?><?php /* Smarty version Smarty-3.1.8, created on 2014-10-31 01:10:39
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\cart_rules\conditions.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5452d37f72ade8_58707816')) {function content_5452d37f72ade8_58707816($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.escape.php';
?><label><?php echo smartyTranslate(array('s'=>'Limit to a single customer'),$_smarty_tpl);?>
</label>
<div class="margin-form">
	<input type="hidden" id="id_customer" name="id_customer" value="<?php echo intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'id_customer'));?>
" />
	<input type="text" id="customerFilter" name="customerFilter" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['customerFilter']->value, 'htmlall', 'UTF-8');?>
" style="width:400px" />
	<p class="preference_description"><?php echo smartyTranslate(array('s'=>'Optional, the cart rule will be available for everyone if you leave this field blank.'),$_smarty_tpl);?>
</p>
</div>
<label><?php echo smartyTranslate(array('s'=>'Valid'),$_smarty_tpl);?>
</label>
<div class="margin-form">
	<strong><?php echo smartyTranslate(array('s'=>'from'),$_smarty_tpl);?>
</strong>
	<input type="text" class="datepicker" name="date_from"
		value="<?php if ($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'date_from')){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'date_from'), ENT_QUOTES, 'UTF-8');?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['defaultDateFrom']->value;?>
<?php }?>" />
	<strong><?php echo smartyTranslate(array('s'=>'to'),$_smarty_tpl);?>
</strong>
	<input type="text" class="datepicker" name="date_to"
		value="<?php if ($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'date_to')){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'date_to'), ENT_QUOTES, 'UTF-8');?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['defaultDateTo']->value;?>
<?php }?>" />
	<p class="preference_description"><?php echo smartyTranslate(array('s'=>'Default period is one month.'),$_smarty_tpl);?>
</p>
</div>
<label><?php echo smartyTranslate(array('s'=>'Minimum amount'),$_smarty_tpl);?>
</label>
<div class="margin-form">
	<input type="text" name="minimum_amount" value="<?php echo floatval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'minimum_amount'));?>
" />
	<select name="minimum_amount_currency">
	<?php  $_smarty_tpl->tpl_vars['currency'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['currencies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency']->key => $_smarty_tpl->tpl_vars['currency']->value){
$_smarty_tpl->tpl_vars['currency']->_loop = true;
?>
		<option value="<?php echo intval($_smarty_tpl->tpl_vars['currency']->value['id_currency']);?>
"
		<?php if ($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'minimum_amount_currency')==$_smarty_tpl->tpl_vars['currency']->value['id_currency']||(!$_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'minimum_amount_currency')&&$_smarty_tpl->tpl_vars['currency']->value['id_currency']==$_smarty_tpl->tpl_vars['defaultCurrency']->value)){?>
			selected="selected"
		<?php }?>
		>
			<?php echo $_smarty_tpl->tpl_vars['currency']->value['iso_code'];?>

		</option>
	<?php } ?>
	</select>
	<select name="minimum_amount_tax">
		<option value="0" <?php if ($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'minimum_amount_tax')==0){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Tax excluded'),$_smarty_tpl);?>
</option>
		<option value="1" <?php if ($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'minimum_amount_tax')==1){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Tax included'),$_smarty_tpl);?>
</option>
	</select>
	<select name="minimum_amount_shipping">
		<option value="0" <?php if ($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'minimum_amount_shipping')==0){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Shipping excluded'),$_smarty_tpl);?>
</option>
		<option value="1" <?php if ($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'minimum_amount_shipping')==1){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Shipping included'),$_smarty_tpl);?>
</option>
	</select>
	<p class="preference_description"><?php echo smartyTranslate(array('s'=>'You can choose a minimum amount for the cart either with or without the taxes, and with or without shipping.'),$_smarty_tpl);?>
</p>
</div>
<label><?php echo smartyTranslate(array('s'=>'Total available'),$_smarty_tpl);?>
</label>
<div class="margin-form">
	<input type="text" name="quantity" value="<?php echo intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'quantity'));?>
" />
	<p class="preference_description"><?php echo smartyTranslate(array('s'=>'The cart rule will be applied to the first X customers only.'),$_smarty_tpl);?>
</p>
</div>
<label><?php echo smartyTranslate(array('s'=>'Total available for each user'),$_smarty_tpl);?>
</label>
<div class="margin-form">
	<input type="text" name="quantity_per_user" value="<?php echo intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'quantity_per_user'));?>
" />
	<p class="preference_description"><?php echo smartyTranslate(array('s'=>'A customer will only be able to use the cart rule X time(s).'),$_smarty_tpl);?>
</p>
</div>
<?php if (count($_smarty_tpl->tpl_vars['countries']->value['unselected'])+count($_smarty_tpl->tpl_vars['countries']->value['selected'])>1){?>
<br />
<input type="checkbox" id="country_restriction" name="country_restriction" value="1" <?php if (count($_smarty_tpl->tpl_vars['countries']->value['unselected'])){?>checked="checked"<?php }?> /> <strong><?php echo smartyTranslate(array('s'=>'Country selection'),$_smarty_tpl);?>
</strong>
<div id="country_restriction_div" style="border:1px solid #AAAAAA;margin-top:10px;padding:0 10px 10px 10px;background-color:#FFF5D3">
	<table>
		<tr>
			<td style="padding-left:20px;">
				<p><strong><?php echo smartyTranslate(array('s'=>'Unselected countries'),$_smarty_tpl);?>
</strong></p>
				<select id="country_select_1" style="border:1px solid #AAAAAA;width:400px;height:160px" multiple>
					<?php  $_smarty_tpl->tpl_vars['country'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['country']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['countries']->value['unselected']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['country']->key => $_smarty_tpl->tpl_vars['country']->value){
$_smarty_tpl->tpl_vars['country']->_loop = true;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['country']->value['id_country']);?>
">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['country']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select><br /><br />
				<a
					id="country_select_add"
					style="cursor:pointer;text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px"
				>
					<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
 &gt;&gt;
				</a>
			</td>
			<td>
				<p><strong><?php echo smartyTranslate(array('s'=>'Selected countries'),$_smarty_tpl);?>
</strong></p>
				<select name="country_select[]" id="country_select_2" style="border:1px solid #AAAAAA;width:400px;height:160px" multiple>
					<?php  $_smarty_tpl->tpl_vars['country'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['country']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['countries']->value['selected']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['country']->key => $_smarty_tpl->tpl_vars['country']->value){
$_smarty_tpl->tpl_vars['country']->_loop = true;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['country']->value['id_country']);?>
">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['country']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select><br /><br />
				<a
					id="country_select_remove"
					style="cursor:pointer;text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px"
				>
					&lt;&lt; <?php echo smartyTranslate(array('s'=>'Remove'),$_smarty_tpl);?>

				</a>
			</td>
		</tr>
	</table>
</div>
<?php }?>
<?php if (count($_smarty_tpl->tpl_vars['carriers']->value['unselected'])+count($_smarty_tpl->tpl_vars['carriers']->value['selected'])>1){?>
<br />
<input type="checkbox" id="carrier_restriction" name="carrier_restriction" value="1" <?php if (count($_smarty_tpl->tpl_vars['carriers']->value['unselected'])){?>checked="checked"<?php }?> /> <strong><?php echo smartyTranslate(array('s'=>'Carrier selection'),$_smarty_tpl);?>
</strong>
<div id="carrier_restriction_div" style="border:1px solid #AAAAAA;margin-top:10px;padding:0 10px 10px 10px;background-color:#FFF5D3">
	<table>
		<tr>
			<td style="padding-left:20px;">
				<p><strong><?php echo smartyTranslate(array('s'=>'Unselected carriers'),$_smarty_tpl);?>
</strong></p>
				<select id="carrier_select_1" style="border:1px solid #AAAAAA;width:400px;height:160px" multiple>
					<?php  $_smarty_tpl->tpl_vars['carrier'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['carrier']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['carriers']->value['unselected']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['carrier']->key => $_smarty_tpl->tpl_vars['carrier']->value){
$_smarty_tpl->tpl_vars['carrier']->_loop = true;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['carrier']->value['id_carrier']);?>
">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carrier']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select><br /><br />
				<a
					id="carrier_select_add"
					style="cursor:pointer;text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px"
				>
					<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
 &gt;&gt;
				</a>
			</td>
			<td>
				<p><strong><?php echo smartyTranslate(array('s'=>'Selected carriers'),$_smarty_tpl);?>
</strong></p>
				<select name="carrier_select[]" id="carrier_select_2" style="border:1px solid #AAAAAA;width:400px;height:160px" multiple>
					<?php  $_smarty_tpl->tpl_vars['carrier'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['carrier']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['carriers']->value['selected']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['carrier']->key => $_smarty_tpl->tpl_vars['carrier']->value){
$_smarty_tpl->tpl_vars['carrier']->_loop = true;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['carrier']->value['id_carrier']);?>
">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['carrier']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select><br /><br />
				<a
					id="carrier_select_remove"
					style="cursor:pointer;text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px"
				>
					&lt;&lt; <?php echo smartyTranslate(array('s'=>'Remove'),$_smarty_tpl);?>

				</a>
			</td>
		</tr>
	</table>
</div>
<?php }?>
<?php if (count($_smarty_tpl->tpl_vars['groups']->value['unselected'])+count($_smarty_tpl->tpl_vars['groups']->value['selected'])>1){?>
<br />
<input type="checkbox" id="group_restriction" name="group_restriction" value="1" <?php if (count($_smarty_tpl->tpl_vars['groups']->value['unselected'])){?>checked="checked"<?php }?> />
<strong><?php echo smartyTranslate(array('s'=>'Customer group selection'),$_smarty_tpl);?>
</strong>
<div id="group_restriction_div" style="border:1px solid #AAAAAA;margin-top:10px;padding:0 10px 10px 10px;background-color:#FFF5D3">
	<table>
		<tr>
			<td style="padding-left:20px;">
				<p><strong><?php echo smartyTranslate(array('s'=>'Unselected groups'),$_smarty_tpl);?>
</strong></p>
				<select id="group_select_1" style="border:1px solid #AAAAAA;width:400px;height:160px" multiple>
					<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value['unselected']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['group']->value['id_group']);?>
">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select><br /><br />
				<a
					id="group_select_add"
					style="text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px"
				>
					<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
 &gt;&gt;
				</a>
			</td>
			<td>
				<p><strong><?php echo smartyTranslate(array('s'=>'Selected groups'),$_smarty_tpl);?>
</strong></p>
				<select name="group_select[]" id="group_select_2" style="border:1px solid #AAAAAA;width:400px;height:160px" multiple>
					<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value['selected']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['group']->value['id_group']);?>
">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select><br /><br />
				<a
					id="group_select_remove"
					style="text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px"
				>
					&lt;&lt; <?php echo smartyTranslate(array('s'=>'Remove'),$_smarty_tpl);?>

				</a>
			</td>
		</tr>
	</table>
</div>
<?php }?>
<?php if (count($_smarty_tpl->tpl_vars['cart_rules']->value['unselected'])+count($_smarty_tpl->tpl_vars['cart_rules']->value['selected'])>0){?>
<br />
<input type="checkbox" id="cart_rule_restriction" name="cart_rule_restriction" value="1" <?php if (count($_smarty_tpl->tpl_vars['cart_rules']->value['unselected'])){?>checked="checked"<?php }?> />
<strong><?php echo smartyTranslate(array('s'=>'Compatibility with other cart rules'),$_smarty_tpl);?>
</strong>
<div id="cart_rule_restriction_div" style="border:1px solid #AAAAAA;margin-top:10px;padding:0 10px 10px 10px;background-color:#FFF5D3">
	<table>
		<tr>
			<td style="padding-left:20px;">
				<p><strong><?php echo smartyTranslate(array('s'=>'Uncombinable cart rules'),$_smarty_tpl);?>
</strong></p>
				<select id="cart_rule_select_1" style="border:1px solid #AAAAAA;width:400px;height:160px" multiple="">
					<?php  $_smarty_tpl->tpl_vars['cart_rule'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cart_rule']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cart_rules']->value['unselected']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cart_rule']->key => $_smarty_tpl->tpl_vars['cart_rule']->value){
$_smarty_tpl->tpl_vars['cart_rule']->_loop = true;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['cart_rule']->value['id_cart_rule']);?>
">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart_rule']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select><br /><br />
				<a
					id="cart_rule_select_add"
					style="text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px"
				>
					<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
 &gt;&gt;
				</a>
			</td>
			<td>
				<p><strong><?php echo smartyTranslate(array('s'=>'Combinable cart rules'),$_smarty_tpl);?>
</strong></p>
				<select name="cart_rule_select[]" id="cart_rule_select_2" style="border:1px solid #AAAAAA;width:400px;height:160px" multiple>
					<?php  $_smarty_tpl->tpl_vars['cart_rule'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cart_rule']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cart_rules']->value['selected']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cart_rule']->key => $_smarty_tpl->tpl_vars['cart_rule']->value){
$_smarty_tpl->tpl_vars['cart_rule']->_loop = true;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['cart_rule']->value['id_cart_rule']);?>
">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart_rule']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select><br /><br />
				<a
					id="cart_rule_select_remove"
					style="text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px"
				>
					&lt;&lt; <?php echo smartyTranslate(array('s'=>'Remove'),$_smarty_tpl);?>

				</a>
			</td>
		</tr>
	</table>
</div>
<?php }?>
<br />
<input type="checkbox" id="product_restriction" name="product_restriction" value="1" <?php if (count($_smarty_tpl->tpl_vars['product_rule_groups']->value)){?>checked="checked"<?php }?> /> <strong><?php echo smartyTranslate(array('s'=>'Product selection'),$_smarty_tpl);?>
</strong>
<div id="product_restriction_div">
	<table id="product_rule_group_table" style="border:1px solid #AAAAAA;margin:10px 0 10px 0;padding:10px 10px 10px 10px;background-color:#FFF5D3;width:600px" cellpadding="0" cellspacing="0">
		<?php  $_smarty_tpl->tpl_vars['product_rule_group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product_rule_group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product_rule_groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product_rule_group']->key => $_smarty_tpl->tpl_vars['product_rule_group']->value){
$_smarty_tpl->tpl_vars['product_rule_group']->_loop = true;
?>
			<?php echo $_smarty_tpl->tpl_vars['product_rule_group']->value;?>

		<?php } ?>
	</table>
	<a href="javascript:addProductRuleGroup();">
		<img src="../img/admin/add.gif" alt="<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
" /> <?php echo smartyTranslate(array('s'=>'Product selection'),$_smarty_tpl);?>

	</a>
</div>
<?php if (count($_smarty_tpl->tpl_vars['shops']->value['unselected'])+count($_smarty_tpl->tpl_vars['shops']->value['selected'])>1){?>
<br />
<input type="checkbox" id="shop_restriction" name="shop_restriction" value="1" <?php if (count($_smarty_tpl->tpl_vars['shops']->value['unselected'])){?>checked="checked"<?php }?> /> <strong><?php echo smartyTranslate(array('s'=>'Shop selection'),$_smarty_tpl);?>
</strong>
<div id="shop_restriction_div" style="border:1px solid #AAAAAA;margin-top:10px;padding:0 10px 10px 10px;background-color:#FFF5D3">
	<table>
		<tr>
			<td style="padding-left:20px;">
				<p><strong><?php echo smartyTranslate(array('s'=>'Unselected shops'),$_smarty_tpl);?>
</strong></p>
				<select id="shop_select_1" style="border:1px solid #AAAAAA;width:400px;height:160px" multiple>
					<?php  $_smarty_tpl->tpl_vars['shop'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['shop']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shops']->value['unselected']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['shop']->key => $_smarty_tpl->tpl_vars['shop']->value){
$_smarty_tpl->tpl_vars['shop']->_loop = true;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['shop']->value['id_shop']);?>
">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select><br /><br />
				<a
					id="shop_select_add"
					style="text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px"
				>
					<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
 &gt;&gt;
				</a>
			</td>
			<td>
				<p><strong><?php echo smartyTranslate(array('s'=>'Selected shops'),$_smarty_tpl);?>
</strong></p>
				<select name="shop_select[]" id="shop_select_2" style="border:1px solid #AAAAAA;width:400px;height:160px" multiple>
					<?php  $_smarty_tpl->tpl_vars['shop'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['shop']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['shops']->value['selected']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['shop']->key => $_smarty_tpl->tpl_vars['shop']->value){
$_smarty_tpl->tpl_vars['shop']->_loop = true;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['shop']->value['id_shop']);?>
">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
					<?php } ?>
				</select><br /><br />
				<a
					id="shop_select_remove"
					style="text-align:center;display:block;border:1px solid #aaa;text-decoration:none;background-color:#fafafa;color:#123456;margin:2px;padding:2px"
				>
					&lt;&lt; <?php echo smartyTranslate(array('s'=>'Remove'),$_smarty_tpl);?>

				</a>
			</td>
		</tr>
	</table>
</div>
<?php }?><?php }} ?><?php /* Smarty version Smarty-3.1.8, created on 2014-10-31 01:10:39
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\cart_rules\actions.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5452d37f9fbd87_96698556')) {function content_5452d37f9fbd87_96698556($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.escape.php';
?><label><?php echo smartyTranslate(array('s'=>'Free shipping'),$_smarty_tpl);?>
</label>
<div class="margin-form">
	&nbsp;&nbsp;
	<input type="radio" name="free_shipping" id="free_shipping_on" value="1" <?php if (intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'free_shipping'))){?>checked="checked"<?php }?> />
	<label class="t" for="free_shipping_on"> <img src="../img/admin/enabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
" style="cursor:pointer" /></label>
	&nbsp;&nbsp;
	<input type="radio" name="free_shipping" id="free_shipping_off" value="0"  <?php if (!intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'free_shipping'))){?>checked="checked"<?php }?> />
	<label class="t" for="free_shipping_off"> <img src="../img/admin/disabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
" style="cursor:pointer" /></label>
</div>
<hr />
<label><?php echo smartyTranslate(array('s'=>'Apply a discount'),$_smarty_tpl);?>
</label>
<div class="margin-form">
	&nbsp;&nbsp;
	<input type="radio" name="apply_discount" id="apply_discount_percent" value="percent" <?php if (floatval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_percent'))>0){?>checked="checked"<?php }?> />
	<label class="t" for="apply_discount_percent"> <img src="../img/admin/enabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
" style="cursor:pointer" /> <?php echo smartyTranslate(array('s'=>'Percent (%)'),$_smarty_tpl);?>
</label>
	&nbsp;&nbsp;
	<input type="radio" name="apply_discount" id="apply_discount_amount" value="amount" <?php if (floatval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_amount'))>0){?>checked="checked"<?php }?> />
	<label class="t" for="apply_discount_amount"> <img src="../img/admin/enabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
" style="cursor:pointer" /> <?php echo smartyTranslate(array('s'=>'Amount'),$_smarty_tpl);?>
</label>
	&nbsp;&nbsp;
	<input type="radio" name="apply_discount" id="apply_discount_off" value="off" <?php if (!floatval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_amount'))>0&&!floatval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_percent'))>0){?>checked="checked"<?php }?> />
	<label class="t" for="apply_discount_off"> <img src="../img/admin/disabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
" style="cursor:pointer" /> <?php echo smartyTranslate(array('s'=>'None'),$_smarty_tpl);?>
</label>
</div>
<div id="apply_discount_percent_div">
	<label><?php echo smartyTranslate(array('s'=>'Value'),$_smarty_tpl);?>
</label>
	<div class="margin-form">
		<input type="text" id="reduction_percent" name="reduction_percent" value="<?php echo floatval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_percent'));?>
" style="width:40px" /> %
		<p><?php echo smartyTranslate(array('s'=>'Does not apply to the shipping costs'),$_smarty_tpl);?>
</p>
	</div>
</div>
<div id="apply_discount_amount_div">
	<label><?php echo smartyTranslate(array('s'=>'Amount'),$_smarty_tpl);?>
</label>
	<div class="margin-form">
		<input type="text" id="reduction_amount" name="reduction_amount" value="<?php echo floatval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_amount'));?>
" />
		<select name="reduction_currency">
		<?php  $_smarty_tpl->tpl_vars['currency'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['currencies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency']->key => $_smarty_tpl->tpl_vars['currency']->value){
$_smarty_tpl->tpl_vars['currency']->_loop = true;
?>
			<option value="<?php echo intval($_smarty_tpl->tpl_vars['currency']->value['id_currency']);?>
" <?php if ($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_currency')==$_smarty_tpl->tpl_vars['currency']->value['id_currency']||(!$_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_currency')&&$_smarty_tpl->tpl_vars['currency']->value['id_currency']==$_smarty_tpl->tpl_vars['defaultCurrency']->value)){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['currency']->value['iso_code'];?>
</option>
		<?php } ?>
		</select>
		<select name="reduction_tax">
			<option value="0" <?php if ($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_tax')==0){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Tax excluded'),$_smarty_tpl);?>
</option>
			<option value="1" <?php if ($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_tax')==1){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Tax included'),$_smarty_tpl);?>
</option>
		</select>
	</div>
</div>
<div id="apply_discount_to_div">
	<label><?php echo smartyTranslate(array('s'=>'Apply discount to'),$_smarty_tpl);?>
</label>
	<div class="margin-form">
		&nbsp;&nbsp;
		<input type="radio" name="apply_discount_to" id="apply_discount_to_order" value="order" <?php if (intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_product'))==0){?>checked="checked"<?php }?> />
		<label class="t" for="apply_discount_to_order"> <?php echo smartyTranslate(array('s'=>'Order (without shipping)'),$_smarty_tpl);?>
</label>
		&nbsp;&nbsp;
		<input type="radio" name="apply_discount_to" id="apply_discount_to_product" value="specific"  <?php if (intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_product'))>0){?>checked="checked"<?php }?> />
		<label class="t" for="apply_discount_to_product"> <?php echo smartyTranslate(array('s'=>'Specific product'),$_smarty_tpl);?>
</label>
		&nbsp;&nbsp;
		<input type="radio" name="apply_discount_to" id="apply_discount_to_cheapest" value="cheapest"  <?php if (intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_product'))==-1){?>checked="checked"<?php }?> />
		<label class="t" for="apply_discount_to_cheapest"> <?php echo smartyTranslate(array('s'=>'Cheapest product'),$_smarty_tpl);?>
</label>
		&nbsp;&nbsp;
		<input type="radio" name="apply_discount_to" id="apply_discount_to_selection" value="selection"  <?php if (intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_product'))==-2){?>checked="checked"<?php }?> />
		<label class="t" for="apply_discount_to_selection"> <?php echo smartyTranslate(array('s'=>'Selected product(s)'),$_smarty_tpl);?>
</label>
	</div>
	<div id="apply_discount_to_product_div">
		<label><?php echo smartyTranslate(array('s'=>'Product'),$_smarty_tpl);?>
</label>
		<div class="margin-form">
			<input type="hidden" id="reduction_product" name="reduction_product" value="<?php echo intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'reduction_product'));?>
" />
			<input type="text" id="reductionProductFilter" name="reductionProductFilter" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['reductionProductFilter']->value, 'htmlall', 'UTF-8');?>
" style="width:400px" />
		</div>
	</div>
</div>
<hr />
<label><?php echo smartyTranslate(array('s'=>'Send a free gift'),$_smarty_tpl);?>
</label>
<div class="margin-form">
	&nbsp;&nbsp;
	<input type="radio" name="free_gift" id="free_gift_on" value="1" <?php if (intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'gift_product'))){?>checked="checked"<?php }?> />
	<label class="t" for="free_gift_on"> <img src="../img/admin/enabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Enabled'),$_smarty_tpl);?>
" style="cursor:pointer" /></label>
	&nbsp;&nbsp;
	<input type="radio" name="free_gift" id="free_gift_off" value="0" <?php if (!intval($_smarty_tpl->tpl_vars['currentTab']->value->getFieldValue($_smarty_tpl->tpl_vars['currentObject']->value,'gift_product'))){?>checked="checked"<?php }?> />
	<label class="t" for="free_gift_off"> <img src="../img/admin/disabled.gif" alt="<?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Disabled'),$_smarty_tpl);?>
" style="cursor:pointer" /></label>
</div>
<div id="free_gift_div">
	<label><?php echo smartyTranslate(array('s'=>'Search a product'),$_smarty_tpl);?>
</label>
	<div class="margin-form">
		<input type="text" id="giftProductFilter" value="<?php echo $_smarty_tpl->tpl_vars['giftProductFilter']->value;?>
" style="width:400px" />
	</div>
	<div id="gift_products_found" <?php if ($_smarty_tpl->tpl_vars['gift_product_select']->value==''){?>style="display:none"<?php }?>>
		<div id="gift_product_list">
			<label><?php echo smartyTranslate(array('s'=>'Matching products'),$_smarty_tpl);?>
</label>
			<select name="gift_product" id="gift_product" onclick="displayProductAttributes();">
				<?php echo $_smarty_tpl->tpl_vars['gift_product_select']->value;?>

			</select>
		</div>
		<div class="clear">&nbsp;</div>
		<div id="gift_attributes_list" <?php if (!$_smarty_tpl->tpl_vars['hasAttribute']->value){?>style="display:none"<?php }?>>
			<label><?php echo smartyTranslate(array('s'=>'Available combinations'),$_smarty_tpl);?>
</label>
			<div id="gift_attributes_list_select">
				<?php echo $_smarty_tpl->tpl_vars['gift_product_attribute_select']->value;?>

			</div>
		</div>
		<div class="clear">&nbsp;</div>
	</div>
	<div id="gift_products_err" class="warn" style="display:none"></div>
</div>
<?php }} ?>