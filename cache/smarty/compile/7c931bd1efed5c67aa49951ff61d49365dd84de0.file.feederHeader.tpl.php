<?php /* Smarty version Smarty-3.1.8, created on 2013-02-28 22:22:49
         compiled from "/var/www/virtual/astaled.sk/htdocs/modules/feeder/feederHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1992955889512fcaa9e66e55-35414670%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c931bd1efed5c67aa49951ff61d49365dd84de0' => 
    array (
      0 => '/var/www/virtual/astaled.sk/htdocs/modules/feeder/feederHeader.tpl',
      1 => 1356963556,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1992955889512fcaa9e66e55-35414670',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta_title' => 0,
    'feedUrl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_512fcaa9e75f46_49143180',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_512fcaa9e75f46_49143180')) {function content_512fcaa9e75f46_49143180($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/virtual/astaled.sk/htdocs/tools/smarty/plugins/modifier.escape.php';
?>

<link rel="alternate" type="application/rss+xml" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['meta_title']->value, 'html', 'UTF-8');?>
" href="<?php echo $_smarty_tpl->tpl_vars['feedUrl']->value;?>
" /><?php }} ?>