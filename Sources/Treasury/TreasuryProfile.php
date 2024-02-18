<?php
/**
 * TreasuryProfile.php
 *
 * @package Treasury
 * @link https://github.com/Darknico/SMF-Treasury
 * @author Darknico <info@darknico.com>
 * @copyright Resourcez at resourcez.biz - Edited by Darknico
 * @license https://spdx.org/licenses/GPL-2.0-or-later.html GPL-2.0-or-later
 *
 * @version 2.12.3
 */

if (!defined('SMF'))
	die('Hacking attempt...');

function showDonations($memID)
{
    global $db_prefix, $smcFunc, $context, $txt, $user_profile;
    global $donor_result, $site_total, $ttotal, $tr_config;

    // Load treasury template and language.
    loadTemplate('Treasury/Treasury');
    loadLanguage('Treasury/Treasury');

    $context['page_title'] = $txt['showDonations'] . ' ' . $user_profile[$memID]['real_name'];
    $context['sub_template'] = 'treasury_profile';
    $donor_name = $context['member']['name'];

    $cfgset = $smcFunc['db_query']('', '
        SELECT * 
        FROM {db_prefix}treas_config',
        array(
        )
    );
    $tr_config = array();
    while ( $cfgset && $row = $smcFunc['db_fetch_assoc']($cfgset)) {
        $tr_config[$row['name']] = $row['value'];
    }
    $smcFunc['db_free_result']($cfgset);

    // Check if Donations, select the last 10
    $result1 = $smcFunc['db_query']('', '
        SELECT mc_currency, mc_gross, payment_date, payment_status 
        FROM {db_prefix}treas_donations 
            WHERE custom={string:my_name} 
            ORDER BY payment_date DESC 
            LIMIT 0,10',
        array(
            'my_name' => $donor_name,
        )
    );
    $donor_result = $smcFunc['db_affected_rows']();

    if ($donor_result)
    {
        // List the most recent
        while ($row = $smcFunc['db_fetch_assoc']($result1))
            $context['my_donations'][] = array(
                'mc_currency' => $row['mc_currency'],
                'mc_gross' => $row['mc_gross'],
                'payment_date' => $row['payment_date'],
                'payment_status' => $row['payment_status'],
            );
        $smcFunc['db_free_result']($result1);

        // Calculate total in the site currency
        $result2 = $smcFunc['db_query']('', '
            SELECT round(sum(settle_amount),2) AS total 
            FROM {db_prefix}treas_donations 
                WHERE custom={string:my_name}',
            array(
                'my_name' => $donor_name,
            )
        );
        $row2 = $smcFunc['db_fetch_assoc']($result2);
        $site_total = $row2['total'];
        $smcFunc['db_free_result']($result2);
        // List totals for each currency donated
        $ttotal = array();
        $result3 = $smcFunc['db_query']('', '
            SELECT mc_gross, mc_currency 
            FROM {db_prefix}treas_donations 
                WHERE custom={string:my_name}',
            array(
                'my_name' => $donor_name,
            )
        );
        while ($row3 = $smcFunc['db_fetch_row']($result3)) {
            $ammount = $row3[0];
            if (isset($ttotal[$row3[1]]))
            {
                $ttotal[$row3[1]] += $ammount;
            } else {
                $ttotal[$row3[1]] = $ammount;
            }
        }
        $smcFunc['db_free_result']($result3);
    }
}
?>