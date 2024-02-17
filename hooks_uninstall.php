<?php

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');
elseif (!defined('SMF'))
	exit('<b>Error:</b> Cannot install - please verify you put this in the same place as SMF\'s index.php.');
	
$KBHooks = array(
	'integrate_load_theme' => 'treeloadTheme',
	'integrate_menu_buttons' => 'treeMenu',
	'integrate_actions' => 'treeActions',	
	'integrate_admin_areas' => 'treeAdminMenu',
	'integrate_load_permissions' => 'treePermission',
	'integrate_credits' => 'treeCredits',
	'integrate_pre_include' => '$sourcedir/Treasury/hooks.php'
);

foreach ($KBHooks as $hook => $function)
	remove_integration_function($hook, $function);
?>