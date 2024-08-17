<?php
/**
 * hooks_install.php
 *
 * @package Treasury
 * @link https://github.com/Darknico/SMF-Treasury
 * @author Darknico <info@darknico.com>
 * @copyright Originally NukeTreasury - Financial management for PHP-Nuke Copyright (c) 2004 - Resourcez at resourcez.biz Copyright (c) 2008 - Edited by Darknico  Copyright (c) 2024 
 * @license https://spdx.org/licenses/GPL-2.0-or-later.html GPL-2.0-or-later
 *
 * @version 2.12.9
 */

if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
	require_once(dirname(__FILE__) . '/SSI.php');
elseif (!defined('SMF'))
	exit('<strong>Error:</strong> Cannot install - please verify you put this in the same place as SMF\'s index.php.');
	
$TRHooks = array(
	'integrate_load_theme' => 'treeloadTheme',
	'integrate_menu_buttons' => 'treeMenu',
	'integrate_actions' => 'treeActions',	
	'integrate_admin_areas' => 'treeAdminMenu',
	'integrate_load_permissions' => 'treePermission',
	'integrate_profile_areas' => 'treeProfileAreas',
	'integrate_credits' => 'treeCredits',
	'integrate_pre_include' => '$sourcedir/Treasury/hooks.php'
);

foreach ($TRHooks as $hook => $function)
    add_integration_function($hook, $function);
?>