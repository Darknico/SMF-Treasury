<?php
/*******************************************************************************
* This program is free software; you can redistribute it and/or modify         *
* it under the terms of the GNU General Public License as published by         *
* the Free Software Foundation; either version 2 of the License.               *
* $Source: /0cvs/TreasurySMF/install.php,v $                                   *
* $Revision: 1.48 $                                                            *
* $Date: 2013/07/21 03:06:49 $                                                 *
* SMF2 Treasury Version 2.12 by Resourcez at resourcez.biz                     *
*******************************************************************************/
if (!defined('SMF'))
	die('Hacking attempt...');
db_extend();
db_extend('packages');

global $smcFunc, $db_prefix;
/*******************************************************************************
* Create new treas_config Table and insert some sample date, if empty          *
*******************************************************************************/
$cfg_columns = array(
	array('name' => 'name', 'type' => 'varchar', 'size' => 25, 'null' => false, 'default' => 0),
	array('name' => 'value', 'type' => 'text', 'null' => false, 'default' => ''),
);
$cfg_indexes = array(
	array('type' => 'primary', 'columns' => array('name')),
);
$smcFunc['db_create_table']('{db_prefix}treas_config', $cfg_columns, $cfg_indexes, array(), 'update');

// Insert settings
$smcFunc['db_insert']('ignore',
	'{db_prefix}treas_config',
	array('name' => 'string', 'value' => 'string'),
	array(
		array('receiver_email', 'nochange@noworky.LMAO'), 
		array('date_format', '0'), 
		array('swing_day', '1'), 
		array('group_use', '0'), 
		array('group_id', '0'), 
		array('group_anonymous', '0'), 
		array('group_minimum', '0'), 
		array('group_duration', '0'), 
		array('duration', '0'), 
		array('event_active', '0'), 
		array('show_registry', '0'), 
		array('use_curl', '0'), 
		array('dm_title', '<b>Please Support Us!</b>'), 
		array('dm_show_targets', '1'), 
		array('dm_show_meter', '1'), 
		array('dm_name_length', '10'), 
		array('dm_comments', 'Something for Here'), 
		array('dm_num_don', '10'), 
		array('dm_show_amt', '1'), 
		array('dm_show_date', '1'), 
		array('dm_button', 'x-click-but21.gif'), 
		array('dm_img_width', '110'), 
		array('dm_img_height', '23'), 
		array('pp_ty_url', 'index.php?action=profile'), 
		array('pp_notify_url', 'ipntreas.php'), 
		array('pp_cancel_url', 'index.php?action=treasury'), 
		array('pp_image_url', 'logo.gif'), 
		array('pp_itemname', 'Donation'), 
		array('pp_item_num', '222'), 
		array('pp_currency', 'USD'), 
		array('pp_currency2', '1'), 
		array('pp_sandbox', '0'), 
		array('pp_get_addr', '0'), 
		array('pp_language', 'US'), 
		array('don_button_submit', 'x-click-but04.gif'), 
		array('don_button_top', 'x-click-but21.gif'), 
		array('don_amt_checked', '1'), 
		array('don_amt_other', '1'),
		array('don_top_img_width', '110'), 
		array('don_top_img_height', '23'), 
		array('don_sub_img_width', '62'), 
		array('don_sub_img_height', '31'), 
		array('don_show_currency', '1'), 
		array('don_num_don', '100'), 
		array('don_show_button_top', '1'), 
		array('don_show_amt', '1'), 
		array('don_show_date', '1'), 
		array('don_show_gross', '0'), 
		array('don_show_info_center', '0'), 
		array('don_name_prompt', 'Do you want your username to be shown?'), 
		array('don_name_yes', 'Yes! - Tell the world I gave my hard-earned cash!'), 
		array('don_name_no', 'No - List my donation as Anonymous'), 
		array('don_text_title', '<b>We Appreciate Your Support</b>'),
		array('don_text', 'Hey, what are you doing here - we don\'t want your money, so keep it, go away!<br /><br />LOL, just kidding - if you see this message, the person who installed it still hasn\'t finished setting it up and customizing it, so please be patient if there are some glitches.<br />'), 
		array('ipn_dbg_lvl', '2'), 
		array('ipn_log_entries', '50'),
	),
	array('name')
);

/*******************************************************************************
* Check for existence of the old treas_cfg table and remove                    *
*******************************************************************************/
$cfg_exists = $smcFunc['db_list_tables'](false, $db_prefix . 'treas_cfg');
if (!empty($cfg_exists))
{
	$smcFunc['db_drop_table']('treas_cfg');
}

/*******************************************************************************
* Create treas_targets Table and insert some sample date, if empty             *
*******************************************************************************/
$tgt_columns = array(
	array('name' => 'name', 'type' => 'varchar', 'size' => 25, 'null' => false, 'default' => 0),
	array('name' => 'subtype', 'type' => 'varchar', 'size' => 20, 'null' => false, 'default' => 0),
	array('name' => 'value', 'type' => 'varchar', 'size' => 255, 'null' => false, 'default' => 0),
);
$tgt_indexes = array(
	array('name' => 'unique_tgt', 'type' => 'unique', 'columns' => array('name', 'subtype')),
);
$smcFunc['db_create_table']('{db_prefix}treas_targets', $tgt_columns, $tgt_indexes, array(), 'update');

$smcFunc['db_insert']('ignore',
	'{db_prefix}treas_targets',
	array('name' => 'string', 'subtype' => 'string', 'value' => 'string'),
	array(
		array('goal', '1', '60'), 
		array('goal', '2', '50'), 
		array('goal', '3', '40'), 
		array('goal', '4', '40'), 
		array('goal', '5', '40'), 
		array('goal', '6', '40'), 
		array('goal', '7', '40'), 
		array('goal', '8', '40'), 
		array('goal', '9', '40'), 
		array('goal', '10', '40'), 
		array('goal', '11', '40'), 
		array('goal', '12', '40'), 
		array('don_amount', '1', '5'), 
		array('don_amount', '2', '10'), 
		array('don_amount', '3', '15'), 
		array('don_amount', '4', '20'), 
		array('don_amount', '5', '25'), 
		array('don_amount', '6', '50'), 
		array('don_amount', '7', '100'), 
		array('don_amount', '8', '200'), 
		array('don_amount', '9', '0'), 
		array('don_amount', '10', '0'), 
		array('currency', 'USD', '$'), 
		array('currency', 'EUR', '&euro;'), 
		array('currency', 'GBP', '&pound;'), 
		array('currency', 'CAD', '$'), 
		array('currency', 'JPY', '&yen;'), 
		array('currency', 'AUD', '$'), 
		array('currency', 'MXN', '$'), 
		array('currency', 'ILS', '&#8362;'), 
		array('currency', 'NOK', 'kr')
	),
	array('unique_tgt')
);

/*******************************************************************************
* Check for existence of the old treas_currency table and remove               *
*******************************************************************************/
$curr_exists = $smcFunc['db_list_tables'](false, $db_prefix . 'treas_currency');
if (!empty($curr_exists))
{
	$smcFunc['db_drop_table']('treas_currency');
}

/*******************************************************************************
* Check for old treas_finance table, convert records, rename to treas_registry *
*******************************************************************************/
$fin_exists = $smcFunc['db_list_tables'](false, $db_prefix . 'treas_finance');
if (!empty($fin_exists))
{
	// We'll do this the safest way and avoid potential issues
	$date_temp = array('name' => 'date_temp', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => time());
	$smcFunc['db_add_column']('treas_finance', $date_temp);

	$fin_fix = $smcFunc['db_query']('','
		SELECT id, UNIX_TIMESTAMP(date) 
		FROM {db_prefix}treas_finance
		',
		array()
	);
	while ($fin_fix && $row = $smcFunc['db_fetch_row']($fin_fix))
	{
		$smcFunc['db_query']('', '
			UPDATE {db_prefix}treas_finance 
			SET date_temp = {int:date} 
			WHERE id = {int:fid}
			', 
			array(
				'fid' => $row[0],
				'date' => $row[1],
			)
		);
	}
	if ($fin_fix)
		$smcFunc['db_free_result']($fin_fix);

	$smcFunc['db_remove_column']('treas_finance', 'date');

	$smcFunc['db_change_column']('treas_finance', 'date_temp', 
		array('name' => 'date', 'type' => 'int', 'size' => '10', 'null' => false, 'default' => time())
	);

	$smcFunc['db_query']('', '
		ALTER TABLE {db_prefix}treas_finance
		RENAME {db_prefix}treas_registry
		',
		array()
	);
}
else
{
/*******************************************************************************
* Create new treas_registry table                                              *
*******************************************************************************/
	$reg_columns = array(
		array('name' => 'id', 'type' => 'int', 'size' => 11, 'null' => false, 'auto' => true),
		array('name' => 'date', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => time()),
		array('name' => 'num', 'type' => 'varchar', 'size' => 16, 'null' => false, 'default' => 0),
		array('name' => 'name', 'type' => 'varchar', 'size' => 128, 'null' => false, 'default' => 0),
		array('name' => 'descr', 'type' => 'varchar', 'size' => 128, 'null' => false, 'default' => 0),
		array('name' => 'amount', 'type' => 'varchar', 'size' => 10, 'null' => false, 'default' => 0),
	);
	$reg_indexes = array(
		array('type' => 'primary', 'columns' => array('id')),
	);
	$smcFunc['db_create_table']('{db_prefix}treas_registry', $reg_columns, $reg_indexes, array(), 'update');

	$smcFunc['db_insert']('ignore',
		'{db_prefix}treas_registry',
		array('id' => 'int', 'date' => 'int', 'num' => 'string', 'name' => 'string', 'descr' => 'string', 'amount' => 'string'),
		array(
			array('1', '1191628800', '20', 'PayPal IPN', 'Auto reconcile', '267.94'), 
			array('2', '1191628800', '1', 'WebHost', 'Quality hosting for 3 months', '-59.40'), 
		),
		array('id')
	);
}

/*******************************************************************************
* Check for old treas_trans table, convert records, rename to treas_donations  *
*******************************************************************************/
$trans_exists = $smcFunc['db_list_tables'](false, $db_prefix . 'treas_trans');
if (!empty($trans_exists))
{
	// We'll do this the safest way and avoid potential issues
	$payment_temp = array('name' => 'payment_temp', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => time());
	$smcFunc['db_add_column']('treas_trans', $payment_temp);

	$trans_fix = $smcFunc['db_query']('', '
		SELECT id, UNIX_TIMESTAMP(payment_date) 
		FROM {db_prefix}treas_trans
		',
		array()
	);
	while ($trans_fix && $row = $smcFunc['db_fetch_row']($trans_fix))
	{
		$smcFunc['db_query']('', '
			UPDATE {db_prefix}treas_trans 
			SET payment_temp = {int:date} 
			WHERE id = {int:tid}', 
			array(
				'tid' => $row[0],
				'date' => $row[1],
			)
		);
	}
	if ($trans_fix)
		$smcFunc['db_free_result']($trans_fix);

	$smcFunc['db_remove_column']('treas_trans', 'payment_date');

	$smcFunc['db_change_column']('treas_trans', 'payment_temp', 
		array('name' => 'payment_date', 'type' => 'int', 'size' => '10', 'null' => false, 'default' => time())
	);

	$smcFunc['db_query']('', '
		ALTER TABLE {db_prefix}treas_trans
		RENAME {db_prefix}treas_donations
		',
		array()
	);
}
else
{
/*******************************************************************************
* Create new treas_donations table                                             *
*******************************************************************************/
	$don_columns = array(
		array('name' => 'id', 'type' => 'int', 'size' => 11, 'null' => false, 'auto' => true),
		array('name' => 'user_id', 'type' => 'mediumint', 'size' => 8, 'null' => false, 'default' => 0),
		array('name' => 'business', 'type' => 'varchar', 'size' => 50, 'null' => false, 'default' => 0),
		array('name' => 'txn_id', 'type' => 'varchar', 'size' => 20, 'null' => false, 'default' => 0),
		array('name' => 'item_name', 'type' => 'varchar', 'size' => 60, 'null' => false, 'default' => 0),
		array('name' => 'item_number', 'type' => 'varchar', 'size' => 40, 'null' => false, 'default' => 0),
		array('name' => 'quantity', 'type' => 'varchar', 'size' => 6, 'null' => false, 'default' => 0),
		array('name' => 'invoice', 'type' => 'varchar', 'size' => 40, 'null' => false, 'default' => 0),
		array('name' => 'custom', 'type' => 'varchar', 'size' => 127, 'null' => false, 'default' => 0),
		array('name' => 'tax', 'type' => 'varchar', 'size' => 10, 'null' => false, 'default' => 0),
		array('name' => 'option_name1', 'type' => 'varchar', 'size' => 60, 'null' => false, 'default' => 0),
		array('name' => 'option_seleczion1', 'type' => 'varchar', 'size' => 127, 'null' => false, 'default' => 0),
		array('name' => 'option_name2', 'type' => 'varchar', 'size' => 60, 'null' => false, 'default' => 0),
		array('name' => 'option_seleczion2', 'type' => 'varchar', 'size' => 127, 'null' => false, 'default' => 0),
		array('name' => 'memo', 'type' => 'text', 'null' => false, 'default' => ''),
		array('name' => 'payment_status', 'type' => 'varchar', 'size' => 15, 'null' => false, 'default' => 0),
		array('name' => 'payment_date', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => time()),
		array('name' => 'txn_type', 'type' => 'varchar', 'size' => 15, 'null' => false, 'default' => 0),
		array('name' => 'mc_gross', 'type' => 'varchar', 'size' => 10, 'null' => false, 'default' => 0),
		array('name' => 'mc_fee', 'type' => 'varchar', 'size' => 10, 'null' => false, 'default' => 0),
		array('name' => 'mc_currency', 'type' => 'varchar', 'size' => 5, 'null' => false, 'default' => 0),
		array('name' => 'settle_amount', 'type' => 'varchar', 'size' => 12, 'null' => false, 'default' => 0),
		array('name' => 'exchange_rate', 'type' => 'varchar', 'size' => 10, 'null' => false, 'default' => 0),
		array('name' => 'first_name', 'type' => 'varchar', 'size' => 127, 'null' => false, 'default' => 0),
		array('name' => 'last_name', 'type' => 'varchar', 'size' => 127, 'null' => false, 'default' => 0),
		array('name' => 'address_street', 'type' => 'varchar', 'size' => 127, 'null' => false, 'default' => 0),
		array('name' => 'address_city', 'type' => 'varchar', 'size' => 127, 'null' => false, 'default' => 0),
		array('name' => 'address_state', 'type' => 'varchar', 'size' => 127, 'null' => false, 'default' => 0),
		array('name' => 'address_zip', 'type' => 'varchar', 'size' => 20, 'null' => false, 'default' => 0),
		array('name' => 'address_country', 'type' => 'varchar', 'size' => 127, 'null' => false, 'default' => 0),
		array('name' => 'address_status', 'type' => 'varchar', 'size' => 15, 'null' => false, 'default' => 0),
		array('name' => 'payer_email', 'type' => 'varchar', 'size' => 127, 'null' => false, 'default' => 0),
		array('name' => 'payer_status', 'type' => 'varchar', 'size' => 15, 'null' => false, 'default' => 0),
		array('name' => 'currency_symbol', 'type' => 'varchar', 'size' => 7, 'null' => false, 'default' => '$'),
		array('name' => 'group_id', 'type' => 'smallint', 'size' => 5, 'null' => false, 'default' => 0),
	);
	$don_indexes = array(
		array('type' => 'primary', 'columns' => array('id')),
	);
	$smcFunc['db_create_table']('{db_prefix}treas_donations', $don_columns, $don_indexes, array(), 'update');

	$smcFunc['db_insert']('ignore',
		'{db_prefix}treas_donations',
		array('id' => 'int', 'user_id' => 'int', 'business' => 'string', 'txn_id' => 'string', 'item_name' => 'string', 'item_number' => 'string', 'quantity' => 'string', 'invoice' => 'string', 'custom' => 'string', 'tax' => 'string', 'option_name1' => 'string', 'option_seleczion1' => 'string', 'option_name2' => 'string', 'option_seleczion2' => 'string', 'memo' => 'string', 'payment_status' => 'string', 'payment_date' => 'int', 'txn_type' => 'string', 'mc_gross' => 'string', 'mc_fee' => 'string', 'mc_currency' => 'string', 'settle_amount' => 'string', 'exchange_rate' => 'string', 'first_name' => 'string', 'last_name' => 'string', 'address_street' => 'string', 'address_city' => 'string', 'address_state' => 'string', 'address_zip' => 'string', 'address_country' => 'string', 'address_status' => 'string', 'payer_email' => 'string', 'payer_status' => 'string', 'currency_symbol' => 'string', 'group_id' => 'int'),
		array(
			array('1', '1', 'resourcez@gmail.com', '88P702274X5188615', 'Donation', '231', '', '', 'Resourcez', '', '', 'Yes', '', '', '', 'Completed', '1195406212', 'web_accept', '2.00', '0.36', 'USD', '2.00', '1.00', '', '', '', '', '', '', '', '', '', '', '$', 0), 
		),
		array('id')
	);
}

/*******************************************************************************
* Check for old log_treasury table, convert records, rename to log_treasurey   *
*******************************************************************************/
$log_exists = $smcFunc['db_list_tables'](false, $db_prefix . 'log_treasury');
if (!empty($log_exists))
{
	// We'll do this the safest way to avoid potential issues
	$log_temp = array('name' => 'log_temp', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => time());
	$date_temp = array('name' => 'payment_temp', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => time());
	$smcFunc['db_add_column']('log_treasury', $log_temp);
	$smcFunc['db_add_column']('log_treasury', $date_temp);

	$log_fix = $smcFunc['db_query']('','
		SELECT id, UNIX_TIMESTAMP(log_date), UNIX_TIMESTAMP(payment_date) 
		FROM {db_prefix}log_treasury
		',
		array()
	);
	while ($log_fix && $row = $smcFunc['db_fetch_row']($log_fix))
	{
		$smcFunc['db_query']('', '
			UPDATE {db_prefix}log_treasury 
			SET log_temp = {int:log}, payment_temp = {int:payment} 
			WHERE id = {int:lid}
			', 
			array(
				'lid' => $row[0],
				'log' => $row[1],
				'payment' => $row[2],
			)
		);
	}
	if ($log_fix)
		$smcFunc['db_free_result']($log_fix);

	$smcFunc['db_remove_column']('log_treasury', 'log_date');
	$smcFunc['db_remove_column']('log_treasury', 'payment_date');

	$smcFunc['db_change_column']('log_treasury', 'log_temp', 
		array('name' => 'log_date', 'type' => 'int', 'size' => '10', 'null' => false, 'default' => time())
	);
	$smcFunc['db_change_column']('log_treasury', 'payment_temp', 
		array('name' => 'payment_date', 'type' => 'int', 'size' => '10', 'null' => false, 'default' => time())
	);

	$smcFunc['db_query']('', '
		ALTER TABLE {db_prefix}log_treasury
		RENAME {db_prefix}log_treasurey
		',
		array()
	);
}
else
{
/*******************************************************************************
* Create new log_treasurey table                                               *
*******************************************************************************/
	$log_columns = array(
		array('name' => 'id', 'type' => 'int', 'size' => 11, 'null' => false, 'auto' => true),
		array('name' => 'log_date', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => time()),
		array('name' => 'payment_date', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => time()),
		array('name' => 'logentry', 'type' => 'text', 'null' => false),
	);
	$log_indexes = array(
		array('type' => 'primary', 'columns' => array('id')),
	);
	$smcFunc['db_create_table']('{db_prefix}log_treasurey', $log_columns, $log_indexes, array(), 'update');
}

/*******************************************************************************
* Create new treas_subscribers table                                           *
*******************************************************************************/
	$sub_columns = array(
		array('name' => 'id', 'type' => 'int', 'size' => 11, 'null' => false, 'auto' => true),
		array('name' => 'user_id', 'type' => 'mediumint', 'size' => 8, 'null' => false, 'default' => 0),
		array('name' => 'group_id', 'type' => 'smallint', 'size' => 5, 'null' => false, 'default' => 0),
		array('name' => 'group_end', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => 0),
	);
	$sub_indexes = array(
		array('type' => 'primary', 'columns' => array('id')),
		array('name' => 'user_id', 'type' => 'index', 'columns' => array('user_id')),
	);
	$smcFunc['db_create_table']('{db_prefix}treas_subscribers', $sub_columns, $sub_indexes, array(), 'update');

/*******************************************************************************
* Setup settings variables for checking subscribers and for treasury version   *
*******************************************************************************/
$smcFunc['db_insert']('ignore',
	'{db_prefix}settings',
	array('variable' => 'string', 'value' => 'string'),
	array(
		array('treasury_groupcheck', '0'), 
		array('treasury_version', '2.12'), 
	),
	array('variable')
);

/*******************************************************************************
* Create new treas_events table                                                *
*******************************************************************************/
	$evt_columns = array(
		array('name' => 'eid', 'type' => 'int', 'size' => 11, 'null' => false, 'auto' => true),
		array('name' => 'date_start', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => time()),
		array('name' => 'date_end', 'type' => 'int', 'size' => 10, 'null' => false, 'default' => 0),
		array('name' => 'title', 'type' => 'varchar', 'size' => 25, 'null' => true, 'default' => ''),
		array('name' => 'description', 'type' => 'text', 'null' => true, 'default' => ''),
		array('name' => 'target', 'type' => 'varchar', 'size' => 10, 'null' => false, 'default' => 0),
		array('name' => 'actual', 'type' => 'varchar', 'size' => 10, 'null' => false, 'default' => 0),
	);
	$evt_indexes = array(
		array('type' => 'primary', 'columns' => array('eid')),
	);
	$smcFunc['db_create_table']('{db_prefix}treas_events', $evt_columns, $evt_indexes, array(), 'update');

/*******************************************************************************
* Update Treasury version                                                      *
*******************************************************************************/
$smcFunc['db_query']('', '
	UPDATE {db_prefix}settings 
	SET value = {string:val} 
	WHERE variable = {string:var}', 
	array(
		'val' => '2.12.1',
		'var' => 'treasury_version',
	)
);

?>