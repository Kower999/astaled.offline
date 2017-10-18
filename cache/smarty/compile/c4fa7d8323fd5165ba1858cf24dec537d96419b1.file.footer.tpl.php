<?php /* Smarty version Smarty-3.1.8, created on 2017-10-18 16:31:58
         compiled from "C:\wamp\www\astaled.offline\shopadmin/themes/default\template\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160683805659e765de6c5588-06925989%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4fa7d8323fd5165ba1858cf24dec537d96419b1' => 
    array (
      0 => 'C:\\wamp\\www\\astaled.offline\\shopadmin/themes/default\\template\\footer.tpl',
      1 => 1501670721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160683805659e765de6c5588-06925989',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'display_footer' => 0,
    'ps_version' => 0,
    'timer_start' => 0,
    'LAST_STOCK_UPDATE' => 0,
    'LAST_UPDATE_PRODUCTS_VERSION' => 0,
    'LAST_UPDATE_VERSION' => 0,
    'iso_is_fr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_59e765de6cece4_85487434',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e765de6cece4_85487434')) {function content_59e765de6cece4_85487434($_smarty_tpl) {?>

					<div style="clear:both;height:0;line-height:0">&nbsp;</div>
					</div>
					<div style="clear:both;height:0;line-height:0">&nbsp;</div>
				</div>
		<?php if ($_smarty_tpl->tpl_vars['display_footer']->value){?>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displayBackOfficeFooter"),$_smarty_tpl);?>

				<div id="footer">
					<div class="footerLeft">
						<a href="http://www.prestashop.com/" target="_blank">PrestaShop&trade; <?php echo $_smarty_tpl->tpl_vars['ps_version']->value;?>
</a><br />
						<span><?php echo smartyTranslate(array('s'=>'Load time: '),$_smarty_tpl);?>
<?php echo number_format(microtime(true)-$_smarty_tpl->tpl_vars['timer_start']->value,3,'.','');?>
s</span>
					</div>
					<div class="footerLeft" style="margin-left: 15px;">
						<span>Dátum vystavenia poslednej výdajky: <?php echo $_smarty_tpl->tpl_vars['LAST_STOCK_UPDATE']->value;?>
</span><br />
						<span>Posledná aktualizácia databázy produktov: <?php echo $_smarty_tpl->tpl_vars['LAST_UPDATE_PRODUCTS_VERSION']->value;?>
</span>
					</div>
					<div class="footerLeft" style="margin-left: 15px;">
						<span>Atuálna verzia systému: <?php echo $_smarty_tpl->tpl_vars['LAST_UPDATE_VERSION']->value;?>
</span><br />
					</div>
					<div class="footerRight">
						<?php if ($_smarty_tpl->tpl_vars['iso_is_fr']->value){?>
							<span>Questions / Renseignements / Formations :</span> <strong>+33 (0)1.40.18.30.04</strong> de 09h &agrave; 18h
						<?php }?>
						|&nbsp;<a href="http://www.prestashop.com/en/contact_us/" target="_blank" class="footer_link"><?php echo smartyTranslate(array('s'=>'Contact'),$_smarty_tpl);?>
</a>
						|&nbsp;<a href="http://forge.prestashop.com" target="_blank" class="footer_link"><?php echo smartyTranslate(array('s'=>'Bug Tracker'),$_smarty_tpl);?>
</a>
						|&nbsp;<a href="http://www.prestashop.com/forums/" target="_blank" class="footer_link"><?php echo smartyTranslate(array('s'=>'Forum'),$_smarty_tpl);?>
</a>	
					</div>
				</div>
			</div>
		</div>
		<div id="ajax_confirmation" style="display:none"></div>
		
		<div id="ajaxBox" style="display:none"></div>
		<?php }?>
		<div id="scrollTop"><a href="#top"></a></div>
	</body>
</html>
<?php }} ?>