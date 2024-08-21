<?php
/**
 * Hooks.php
 *
 * @package Treasury
 * @link https://github.com/Darknico/SMF-Treasury
 * @author Darknico <info@darknico.com>
 * @copyright Originally NukeTreasury - Financial management for PHP-Nuke Copyright (c) 2004 - Resourcez at resourcez.biz Copyright (c) 2008 - Edited by Darknico  Copyright (c) 2024 
 * @license https://spdx.org/licenses/GPL-2.0-or-later.html GPL-2.0-or-later
 *
 * @version 2.12.10
 */

if (!defined('SMF'))
	die('Hacking attempt...');  

	defined('TREAS_VERSION') || define('TREAS_VERSION', '2.12.10');	

function treeloadTheme() 
{
	global $context, $settings;
	
	loadLanguage('Treasury/Treasury');
	
	addInlineCss('
		.main_icons.treasury::before {
			background:url(' . $settings['default_images_url'] . '/Treasury/admin/treasury.gif) no-repeat 0 0 !important;
		}');		

	$context['allow_view_treasury'] = allowedTo('view_treasury');
}	

function treeMenu(&$menu_buttons)
{
	global $txt, $context, $scripturl;
	
	$menu_buttons['treasury'] = array(
		'title' => $txt['treasury_menu'],
		'href' => $scripturl . '?action=treasury',
		'show' => $context['allow_view_treasury'],
		'icon' => 'treasury',
		'sub_buttons' => array(
		),
	);
}	

function treeActions(&$actionArray)
{
	global $sourcedir, $modSettings;

	$actionArray['treasury'] = array('Treasury/Treasury.php', 'treasuryMain');
}	

function treeAdminMenu(array &$admin_areas) 
{
	global $txt;
	
	$admin_areas['config']['areas']['treasury'] = array(
		'file' => 'Treasury/TreasuryAdmin.php',
		'label' => $txt['treasury_admin'],
		'function' => 'treasuryAdmin',
		'permission' => 'admin_treasury',
		'icon' => 'treasury',
		'subsections' => array(
			'readme'    => array($txt['treas_read_me']),
			'registry'    => array($txt['treas_fin_register']),
			'donations'  => array($txt['treas_donations']),
			'donortotals' => array($txt['treas_donor_totals']),
			'config' => array($txt['treas_main_config']),
			'configpaypal' => array($txt['treas_paypal_config']),
			'configblock'   => array($txt['treas_block_config']),
			'configevents' => array($txt['treas_events']),
			'translog'  => array($txt['treas_transaction_log'])
		)
	);
}

function treeProfileAreas(array &$profile_areas) 
{
	global $txt;
	
	$profile_areas['info']['areas']['showdonations'] = array(
		'file' => 'Treasury/TreasuryProfile.php',
		'label' => $txt['showDonations'],
		'function' => 'showDonations',
		'permission' => array(
			'own' => array('profile_view_own'),
			'any' => array('admin_treasury'),
		),
		'icon' => 'treasury',
	);
}	

function treePermission(array &$permissionGroups, array &$permissionList)
{
	$permissionList['membergroup']['view_treasury'] = array(false, 'treasury', 'view_basic_info');
	$permissionList['membergroup']['admin_treasury'] = array(false, 'treasury', 'administrate');
}

function treeCredits()	
{
	global $context;

	$context['copyrights']['mods'][] = 
	'<a href="https://github.com/Darknico/SMF-Treasury" target="_blank" rel="noopener">Treasury</a> ' .TREAS_VERSION. ' | &copy; 2024, 
	<a href="https://www.simplemachines.org/community/index.php?action=profile;u=69956" target="_blank" rel="noopener">Resourcez</a> 
	edited by <a href="https://www.darknico.com" target="_blank" rel="noopener">Darknico</a> 
	- <a href="https://www.italiansmf.net" target="_blank" rel="noopener">Italian SMF</a>
	| Licensed under <a href="https://github.com/Darknico/SMF-Treasury/blob/main/LICENSE" target="_blank" rel="noopener">GNU GPLv2</a>';
}	
    
?>
