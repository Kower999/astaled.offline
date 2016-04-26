<?php /* Smarty version Smarty-3.1.8, created on 2015-03-28 15:25:31
         compiled from "C:\wamp\www\shopadmin/themes/default\template\controllers\modules\js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20348544571d89d97c8-18290885%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6ea278c5fb63c572128ce1f9ffa18d78d8f29a2' => 
    array (
      0 => 'C:\\wamp\\www\\shopadmin/themes/default\\template\\controllers\\modules\\js.tpl',
      1 => 1427206705,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20348544571d89d97c8-18290885',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_544571d8b8c5c9_59213463',
  'variables' => 
  array (
    'autocompleteList' => 0,
    'token' => 0,
    'currentIndex' => 0,
    'dirNameCurrentIndex' => 0,
    'ajaxCurrentIndex' => 0,
    'installed_modules' => 0,
    'error_module' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544571d8b8c5c9_59213463')) {function content_544571d8b8c5c9_59213463($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include 'C:\\wamp\\www\\tools\\smarty\\plugins\\modifier.replace.php';
?>

<script type="text/javascript"><?php echo $_smarty_tpl->tpl_vars['autocompleteList']->value;?>
</script>
<script type="text/javascript">
	var token = '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
';
	var currentIndex = '<?php echo $_smarty_tpl->tpl_vars['currentIndex']->value;?>
';
	var currentIndexWithToken = '<?php echo $_smarty_tpl->tpl_vars['currentIndex']->value;?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
';
	var dirNameCurrentIndex = '<?php echo $_smarty_tpl->tpl_vars['dirNameCurrentIndex']->value;?>
';
	var ajaxCurrentIndex = '<?php echo $_smarty_tpl->tpl_vars['ajaxCurrentIndex']->value;?>
';
	var installed_modules = <?php if (isset($_smarty_tpl->tpl_vars['installed_modules']->value)&&count($_smarty_tpl->tpl_vars['installed_modules']->value)){?><?php echo $_smarty_tpl->tpl_vars['installed_modules']->value;?>
<?php }else{ ?>false<?php }?>;
	var by = '<?php echo smartyTranslate(array('s'=>'by'),$_smarty_tpl);?>
';
	var errorLogin = '<?php echo smartyTranslate(array('s'=>'PrestaShop was unable to login to Addons, please check your credentials and your internet connection.'),$_smarty_tpl);?>
';
	var confirmPreferencesSaved = '<?php echo smartyTranslate(array('s'=>'Preferences saved'),$_smarty_tpl);?>
';
	<?php if (isset($_GET['anchor'])&&!isset($_smarty_tpl->tpl_vars['error_module']->value)){?>var anchor = '<?php echo smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(smarty_modifier_replace(htmlentities($_GET['anchor']),'(',''),')',''),'{',''),'}',''),'\'',''),'/','');?>
';<?php }else{ ?>var anchor = '';<?php }?>

	

	function getPrestaStore(){if(getE("prestastore").style.display!='block')return;$.post(dirNameCurrentIndex+"/ajax.php",{page:"prestastore"},function(a){getE("prestastore-content").innerHTML=a;})}
	function truncate_author(author){return ((author.length > 20) ? author.substring(0, 20)+"..." : author);}
	function modules_management(action)
	{
		var modules = document.getElementsByName('modules');
		var module_list = '';
		for (var i = 0; i < modules.length; i++)
		{
			if (modules[i].checked == true)
			{
				rel = modules[i].getAttribute('rel');
				if (rel != "false" && action == "uninstall")
				{
					if (!confirm(rel))
						return false;
				}
				module_list += '|'+modules[i].value;
			}
		}
		document.location.href=currentIndex+'&token='+token+'&'+action+'='+module_list.substring(1, module_list.length);
	}

	$('document').ready( function() {
		// ScrollTo
		if (anchor != '')
			$.scrollTo('#'+anchor, 1200, {offset: -100});

		// AutoComplete Search
		$('input[name="filtername"]').autocomplete(moduleList, {
				minChars: 0,
				width: 310,
				matchContains: true,
				highlightItem: true,
				formatItem: function(row, i, max, term) {
					var image = '../modules/'+row.name+'/logo.gif';
					if (row.image != '')
						image = row.image;
					return '<img src="'+image+'" style="float:left;margin:5px;width:16px;height:16px"><strong>'+row.displayName+'</strong>'+((row.author != '') ? ' ' + by + ' ' + truncate_author(row.author) : '') + '<br /><span style="font-size: 80%;">'+ row.desc +'</span><br/><div style="height:15px;padding-top:5px">'+ row.option +'</div>';
				},
				formatResult: function(row) {
					return row.displayName;
				}
		});
		$('input[name="filtername"]').result(function(event, data, formatted) {
			 $('#filternameForm').submit();
		});

		// Method to check / uncheck all modules checkbox
		$('#checkme').click(function()
		{
			if ($(this).attr("rel") == 'false')
			{
				$(this).attr("checked", true);
				$(this).attr("rel", "true");
				$("input[name=modules]").attr("checked", true);
			}
			else
			{
				$(this).removeAttr("checked");
				$(this).attr("rel", "false");
				$("input[name=modules]").removeAttr("checked");
			}
		});		

		// Method to reload filter in ajax
		$('.categoryModuleFilterLink').click(function()
		{
			$('.categoryModuleFilterLink').css('background-color', 'white');
			$(this).css('background-color', '#EBEDF4');
			var ajaxReloadCurrentIndex = $(this).find('a').attr('href').replace('index.php', 'ajax-tab.php');
			try
			{
				resAjax = $.ajax({
						type:"POST",
						url : ajaxReloadCurrentIndex,
						async: true,
						data : {
							ajax : "1",
							token : token,
							controller : "AdminModules",
							action : "reloadModulesList"
						},
 						beforeSend: function(xhr)
						{
							$('#moduleContainer').html('<img src="../img/loader.gif" alt="" border="0" />');
						},
						success : function(data)
						{
							$('#moduleContainer').html(data);
						},
						error: function(res,textStatus,jqXHR)
						{
							//jAlert("TECHNICAL ERROR"+res);
						}
				});
			}
			catch(e){}
			return false;
		});

		// Method to get modules_list.xml from prestashop.com and default_country_modules_list.xml from addons.prestashop.com
		try
		{
			resAjax = $.ajax({
					type:"POST",
					url : ajaxCurrentIndex,
					async: true,
					data : {
					ajaxMode : "1",
					ajax : "1",
					token : token,
					controller : "AdminModules",
					action : "refreshModuleList"
				},
				success : function(data)
				{
					// res.status  = cache or refresh
					if (data == '{"status":"refresh"}')
						window.location.href = window.location.href;
				},
				error: function(res,textStatus,jqXHR)
				{
					//jAlert("TECHNICAL ERROR"+res);
				}
			});
		}
		catch(e) { }

		// Method to log on PrestaShop Addons WebServices
		$('#addons_login_button').click(function()
		{
			var username_addons = $("#username_addons").val();
			var password_addons = $("#password_addons").val();
			try
			{
				resAjax = $.ajax({
						type:"POST",
						url : ajaxCurrentIndex,
						async: true,
						data : {
							ajax : "1",
							token : token,
							controller : "AdminModules",
							action : "logOnAddonsWebservices",
							username_addons : username_addons,
							password_addons : password_addons
						},
 						beforeSend: function(xhr)
						{
							$('#addons_loading').html('<img src="../img/loader.gif" alt="" border="0" />');
						},
						success : function(data)
						{
							// res.status  = cache or refresh
							if (data == 'OK')
							{
								$('#addons_loading').html('');
								$('#addons_login_div').fadeOut();
								window.location.href = currentIndexWithToken;
							}
							else
								$('#addons_loading').html(errorLogin);
						},
						error: function(res,textStatus,jqXHR)
						{
							//jAlert("TECHNICAL ERROR"+res);
						}
				});
			}
			catch(e){}
			return false;
		});

		// Method to log out PrestaShop Addons WebServices
		$('#addons_logout_button').click(function()
		{
			try
			{
				resAjax = $.ajax({
						type:"POST",
						url : ajaxCurrentIndex,
						async: true,
						data : {
							ajax : "1",
							token : token,
							controller : "AdminModules",
							action : "logOutAddonsWebservices"
						},
 						beforeSend: function(xhr)
						{
							$('#addons_loading').html('<img src="../img/loader.gif" alt="" border="0" />');
						},
						success : function(data)
						{
							// res.status  = cache or refresh
							if (data == 'OK')
							{
								$('#addons_loading').html('');
								$('#addons_login_div').fadeOut();
								window.location.href = currentIndexWithToken;
							}
							else
								$('#addons_loading').html(errorLogin);
						},
						error: function(res,textStatus,jqXHR)
						{
							//jAlert("TECHNICAL ERROR"+res);
						}
				});
			}
			catch(e){}
			return false;
		});

		// Method to set filter on modules
		function setFilter()
		{
			var module_type = $("#module_type_filter").val();
			var module_install = $("#module_install_filter").val();
			var module_status = $("#module_status_filter").val();
			var country_module_value = $("#country_module_value_filter").val();
			try
			{
				resAjax = $.ajax({
						type:"POST",
						url : ajaxCurrentIndex,
						async: true,
						data : {
							ajax : "1",
							token : token,
							controller : "AdminModules",
							action : "setFilter",
							module_type : module_type,
							module_install : module_install,
							module_status : module_status,
							country_module_value : country_module_value,
							filterModules : 'Filter'
						},
						success : function(data)
						{
							// res.status  = cache or refresh
							if (data == 'OK')
								window.location.href = currentIndexWithToken;
						},
						error: function(res,textStatus,jqXHR)
						{
							//jAlert("TECHNICAL ERROR"+res);
						}
				});
			}
			catch(e){}
			return false;
		}
		$('#module_type_filter').change(function() { setFilter(); });
		$('#module_install_filter').change(function() { setFilter(); });
		$('#module_status_filter').change(function() { setFilter(); });
		$('#country_module_value_filter').change(function() { setFilter(); });

		// Method to save favorites preferences
		$('.moduleFavorite').change(function()
		{
			var value_pref = $(this).val();
			var module_pref = $(this).attr('name');
			var action_pref = module_pref.substring(0, 1);
			module_pref = module_pref.substring(2, module_pref.length);
			try
			{
				resAjax = $.ajax({
						type:"POST",
						url : ajaxCurrentIndex,
						async: true,
						data : {
							ajax : "1",
							token : token,
							controller : "AdminModules",
							action : "saveFavoritePreferences",
							action_pref : action_pref,
							module_pref : module_pref,
							value_pref : value_pref
						},
						success : function(data)
						{
							// res.status  = cache or refresh
							if (data == 'OK')
								$('#r_' + module_pref).html(confirmPreferencesSaved);
						},
						error: function(res,textStatus,jqXHR)
						{
							//jAlert("TECHNICAL ERROR"+res);
						}
				});
			}
			catch(e){}
			return false;
		});
	});

	
</script><?php }} ?>