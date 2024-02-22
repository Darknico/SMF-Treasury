<?php
/**
 * install.php
 *
 * @package Treasury
 * @link https://github.com/Darknico/SMF-Treasury
 * @author Darknico <info@darknico.com>
 * @copyright Originally NukeTreasury - Financial management for PHP-Nuke Copyright (c) 2004 - Resourcez at resourcez.biz Copyright (c) 2008 - Edited by Darknico  Copyright (c) 2024 
 * @license https://spdx.org/licenses/GPL-2.0-or-later.html GPL-2.0-or-later
 *
 * @version 2.12.4
 */

if (!defined('SMF'))
	die('Hacking attempt...');
db_extend();
db_extend('packages');

global $smcFunc, $db_prefix;

/*******************************************************************************
* Update Treasury version                                                      *
*******************************************************************************/
$smcFunc['db_query']('', '
	UPDATE {db_prefix}settings 
	SET value = {string:val} 
	WHERE variable = {string:var}', 
	array(
		'val' => '2.12.4',
		'var' => 'treasury_version',
	)
);

?>