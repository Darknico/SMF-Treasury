<?php

if (!defined('SMF'))
	require '../SSI.php';
	
     $KBHooks = array(
	    'integrate_pre_include' => '$sourcedir/Treasury/hooks.php',
		'integrate_actions' => 'treeAction',
		'integrate_admin_areas' => 'treeAdminMenu',
		//'integrate_load_permissions' => 'treePermission' TODO 
	);

    foreach ($KBHooks as $hook => $function)
	    remove_integration_function($hook, $function);
?>