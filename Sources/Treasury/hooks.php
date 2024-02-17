<?php

if (! defined('SMF'))
    die('No direct access...');    

	function treeloadTheme() {
		global $context, $settings;
		
		loadLanguage('Treasury/Treasury');
		
		addInlineCss('
			.main_icons.treasury::before {
				background:url(' . $settings['default_images_url'] . '/Treasury/admin/treasury.gif) no-repeat 0 0 !important;
			}');		

		$context['allow_view_treasury'] = allowedTo('view_treasury');
	}	

	function treeMenu(&$menu_buttons){
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

	function treeActions(&$actionArray){
		global $sourcedir, $modSettings;

		$actionArray['treasury'] = array('Treasury/Treasury.php', 'treasuryMain');
	}	

    function treeAdminMenu(array &$admin_areas) {
		global $settings, $txt;
		
		
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

    function treePermission(array &$permissionGroups, array &$permissionList)
	{
		$permissionList['membergroup']['view_treasury'] = array(false, 'treasury', 'view_basic_info');
        $permissionList['membergroup']['admin_treasury'] = array(false, 'treasury', 'administrate');
	}

 	function treeCredits()	{
		global $context;

		$context['copyrights']['mods'][] = 'Treasury by <a href="https://www.simplemachines.org/community/index.php?action=profile;u=69956" target="_blank" rel="noopener">Resourcez</a> - edited by <a href="https://www.darknico.com target="_blank" rel="noopener">Darknico</> &copy; 2024, ';
	}	
    
?>
