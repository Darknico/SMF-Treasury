<?php

if (! defined('SMF'))
    die('No direct access...');

    add_integration_function('integrate_actions', 'treeAction');
    add_integration_function('integrate_admin_areas', 'treeAdminMenu');
    //add_integration_function('integrate_load_permissions', 'treePermission'); TODO
    

    function treeAction(&$actionArray) {
          $actionArray += array('treasuryadmin' => array('Treasury/TreasuryAdmin.php', 'treasuryAdmin'));
      }    

    function treeAdminMenu(array &$admin_areas) {
		global $settings, $txt;
		loadLanguage('Treasury/Treasury');
		
		addInlineCss('
			.main_icons.treasury::before {
				background:url(' . $settings['default_images_url'] . '/Treasury/admin/treasury.gif) no-repeat 0 0 !important;
			}');
		
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

    /* TODO
    function treePermission(array &$permissionGroups, array &$permissionList)
	{
		$permissionList['membergroup']['view_treasury'] = array(false, 'general', 'view_basic_info');
        $permissionList['membergroup']['admin_treasury'] = array(false, 'general', 'view_basic_info');
	}
    */
?>