<?php /* Smarty version Smarty-3.1.8, created on 2016-04-27 13:44:53
         compiled from "C:\wamp\www\shopadmin/themes/default\template\form_submit_ajax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:626454fd887b27d0e9-25679382%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '474ad885a8c4e3d5e8c19f3f686b18e06a2afbd9' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\form_submit_ajax.tpl',
      1 => 1461742550,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '626454fd887b27d0e9-25679382',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_54fd887b2c5881_47228909',
  'variables' => 
  array (
    'table' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54fd887b2c5881_47228909')) {function content_54fd887b2c5881_47228909($_smarty_tpl) {?>

<script type="text/javascript">
var form_is_not_submitting = true;
	$(document).ready(function() {
		$('#<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
_form').submit(function(e) {
			e.preventDefault();
            if(form_is_not_submitting) {
                 form_is_not_submitting = false;
			     var form_datas = new Object;
			     form_datas['liteDisplaying'] = 1;
			     form_datas['submitFormAjax'] = 1;
			     var form_inputs = $('#<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
_form input, #<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
_form textarea, #<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
_form button');
			     var form_selects = $('#<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
_form select');
			     $.each(form_inputs, function() {
				    if (this.type == 'radio' || this.type == 'checkbox')
					   if (!this.checked)
						  return true;
				    form_datas[this.name] = this.value;
			     });
			     $.each(form_selects, function() {
				    if	(this.options != undefined && this.options.selectedIndex != undefined && this[this.options.selectedIndex] != undefined)
					   form_datas[this.name] = this[this.options.selectedIndex].value;
			     });
                 
			     $.ajax({
				    type: this.method,
				    url : this.action,
				    async: true,
				    dataType: "html",
				    data : form_datas,
				    success : function(res)
				    {
					   // Replace de body by the new one
					   $('body').html(res.replace(/^.*<body>/, '').replace(/<\/body>.*$/, ''));
                       form_is_not_submitting = true;
				    }
			     });
                                 
            }
		});
	});
</script>
<?php }} ?>