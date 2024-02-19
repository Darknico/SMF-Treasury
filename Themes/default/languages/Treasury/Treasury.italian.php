<?php
/**
 * Treasury.italian.php.php
 *
 * @package Treasury
 * @link https://github.com/Darknico/SMF-Treasury
 * @author Darknico <info@darknico.com>
 * @copyright Originally NukeTreasury - Financial management for PHP-Nuke Copyright (c) 2004 - Resourcez at resourcez.biz Copyright (c) 2008 - Edited by Darknico  Copyright (c) 2024 
 * @license https://spdx.org/licenses/GPL-2.0-or-later.html GPL-2.0-or-later
 *
 * @version 2.12.3
 */

global $mbname;

$txt['treasury_menu'] = 'Donazioni';
$txt['treasury_admin'] = 'Treasury';
$txt['whoall_treasury'] = 'Sta visualizzando la pagina <a href="' . $scripturl . '?action=treasury">Donazioni</a>';

// ipntreas.php
$txt['treas_appreciate_donation'] = 'Lo staff di '.$mbname.' apprezza molto la tua generosità';
$txt['treas_thanks'] = 'La tua donazione sarà di grande aiuto per lo sviluppo del sito.';
$txt['treas_continue'] = 'Continua al sommario';
$txt['treas_pay_details'] = 'Dettagli pagamenti';
$txt['treas_name'] = 'Nome';
$txt['treas_show'] = 'Visualizza';
$txt['treas_item'] = 'Item';
$txt['treas_date'] = 'Data';
$txt['treas_amount'] = 'Importo';
$txt['treas_total_amount'] = 'Importo Totale';
$txt['treas_total'] = 'Totale';

// block
$txt['treas_goal'] = 'Obiettivo';
$txt['treas_due_date'] = 'Scadenza';
$txt['treas_gross_amount'] = 'Importo Lordo';
$txt['treas_total_receipts'] = 'Totale ricevute';
$txt['treas_net_balance'] = 'Saldo Netto';
$txt['treas_paypal_fees'] = 'Tasse PayPal';
$txt['treas_above_goal'] = 'Sopra l\'obiettivo';
$txt['treas_below_goal'] = 'Sotto l\'obiettivo';

// mod
$txt['treas_anonymous'] = 'Anonimo';
$txt['treas_thanks_donated'] = 'Un grandissimo GRAZIE a chi ha donato in questo periodo';
$txt['treas_site_currency'] = 'Valuta del sito';
$txt['treas_choose_currency'] = 'Seleziona valuta';
$txt['treas_select_amount'] = 'Per favore, specifica quando vuoi donare';
$txt['treas_show_donations'] = 'visualizza Donazioni';
$txt['treas_no_donations'] = 'Non sembra ci siano Donazioni registrate per';
$txt['treas_total_site_currency'] = 'Valuta del sito Totale';
$txt['treas_thank_you'] = 'Grazie';
$txt['treas_last_ten_donations'] = 'Ultime 10 Donazioni';
$txt['treas_paypal_confirm'] = 'Se avete recentemente fatto una donazione e non è mostrato qui, potremmo essere in attesa di conferma da parte di PayPal. Una ricevuta per la transazione dovrebbe essere stata inviato per email. Si può accedere al tuo account all\'indirizzo <a href="https://www.paypal.com/" target="_blank" style="text-decoration:underline;"><b>PayPal</b></a> per visualizzare le transazioni.<br /><br />In caso di problemi, contattare l\'<a href="index.php?action=pm;sa=send;u=1" style="text-decoration:underline;"><b>Amministratore</b></a> del sito.';
$txt['treas_paypal_lang'] = 'Scegli lingua PayPal';
$txt['treas_not_logged'] = 'Dal momento che non sei loggato o sei un visitatore';
$txt['treas_other'] = 'Altro';
$txt['treas_username'] = 'Username';
$txt['treas_income_expend'] = 'Registry - Income &amp; Expenditure';
$txt['treas_number'] = 'Numero';
$txt['treas_net_balance'] = 'Saldo netto';

// admin
$txt['treasury_menu'] = 'Donazioni';
$txt['treasury_admin'] = 'Treasury';
$txt['permissiongroup_treasury'] = 'Treasury';
$txt['permissionname_view_treasury'] = 'View Treasury';
$txt['permissionhelp_view_treasury'] = 'Sets if the user can view Treasury.';
$txt['cannot_view_treasury'] = 'You can not view Treasury.';
$txt['permissionname_admin_treasury'] = 'Administer Treasury';
$txt['permissionhelp_admin_treasury'] = 'If the user is allowed to administer Treasury';
$txt['cannot_admin_treasury'] = 'You can not administer Treasury.';
$txt['showDonations'] = 'Show Donations';
$txt['treas_fees'] = 'Fees';
$txt['treas_add'] = 'Add';
$txt['treas_administration'] = 'Administration';
$txt['treas_all_donations'] = 'All Donations';
$txt['treas_amount'] = 'Importo';
$txt['treas_block_amounts'] = 'Reveal Amounts in Block';
$txt['treas_block_comment'] = 'Donations Block comment';
$txt['treas_block_config'] = 'Block';
$txt['treas_block_config_descr'] = 'Configuration applicable only to the TinyPortal side block.';
$txt['treas_block_dates'] = 'Reveal Dates in Block';
$txt['treas_block_image'] = 'Button image for Block';
$txt['treas_block_image_size'] = 'Button Image dimensions';
$txt['treas_block_number'] = 'Number of donors in Block';
$txt['treas_block_title'] = 'Donation Block Title';
$txt['treas_block_username'] = 'Length of Username in Block';
$txt['treas_change'] = 'Change';
$txt['treas_config'] = 'Treasury Configuration';
$txt['treas_config_mod'] = 'Treasury Mod Configuration';
$txt['treas_config_block'] = 'Treasury Block Config';
$txt['treas_config_error'] = 'Treasury Configuration Error';
$txt['treas_currency'] = 'Currency';
$txt['treas_date_format'] = 'Displayed Date Format';
$txt['treas_display_goals'] = 'Display Goals';
$txt['treas_display_meter'] = 'Display Donormeter';
$txt['treas_donation_text'] = 'Donations Page Text';
$txt['treas_donation_title'] = 'Donations Page Title';
$txt['treas_donation_goals'] = 'Donation Goals by Month';
$txt['treas_donation_amount'] = 'Donation Amount';
$txt['treas_donation_amounts'] = 'Suggested Donation Amounts';
$txt['treas_donation_default'] = 'Which Donation Amount is default?';
$txt['treas_donations'] = 'Donazioni';
$txt['treas_donations_descr'] = 'All payments can be edited or deleted, or you can add a payment.';
$txt['treas_donor_totals'] = 'Totals';
$txt['treas_donor_totals_descr'] = 'You can select various time periods to display total donations during that time, or choose an event.';
$txt['treas_duration'] = 'Select Duration of Donations';
$txt['treas_event'] = 'Event';
$txt['treas_events'] = 'Events';
$txt['treas_event_active'] = 'Active Event';
$txt['treas_event_actual'] = 'Actual';
$txt['treas_event_config'] = 'Configure an events based donations system - add, edit, delete or activate.';
$txt['treas_event_campaign'] = 'Campaign';
$txt['treas_event_descr'] = 'Description';
$txt['treas_event_end'] = 'Date End';
$txt['treas_event_inactive'] = 'Not Active';
$txt['treas_event_open'] = 'Open';
$txt['treas_event_start'] = 'Date Start';
$txt['treas_event_target'] = 'Target';
$txt['treas_event_title'] = 'Title';
$txt['treas_event_titlemax'] = 'Title (max. 25 chars)';
$txt['treas_fees'] = 'Fees';
$txt['treas_fin_register'] = 'Registry';
$txt['treas_fin_register_descr'] = 'Reconcile PayPal payments &amp; edit / delete / add details to the financial registry.';
$txt['treas_financial'] = 'Treasury Financial';
$txt['treas_gross'] = 'Gross';
$txt['treas_group_anonymous'] = 'Add Anonymous to Groups?';
$txt['treas_group_select'] = 'Select a Group for Donors';
$txt['treas_group_use'] = 'Place Donors in a Group?';
$txt['treas_group_min'] = 'Group Access Minimum Donation';
$txt['treas_group_duration'] = 'Group Access<br />Duration Limited?';
$txt['treas_image_dims'] = 'Image dimensions';
$txt['treas_goto_page'] = 'Go to page';
$txt['treas_half_yearly'] = 'Half Yearly';
$txt['treas_last_10_pays'] = 'Treasury - Last 10 Payments';
$txt['treas_last_2years'] = 'Last 2 Years';
$txt['treas_last_date'] = 'Last Donation Date';
$txt['treas_last_day'] = 'Last Day';
$txt['treas_last_fortnight'] = 'Last Fortnight';
$txt['treas_last_half'] = 'Last 6 Months';
$txt['treas_last_month'] = 'Last Month';
$txt['treas_last_quarter'] = 'Last Quarter';
$txt['treas_last_week'] = 'Last Week';
$txt['treas_last_year'] = 'Last Year';
$txt['treas_main_config'] = 'Main';
$txt['treas_main_config_descr'] = 'General configuration section.';
$txt['treas_monthly'] = 'Monthly';
$txt['treas_net'] = 'Net';
$txt['treas_next'] = 'Next';
$txt['treas_num'] = 'No.';
$txt['treas_num_donors'] = 'Number of donors to list';
$txt['treas_page_of'] = 'Page <b>%d</b> of <b>%d</b>';
$txt['treas_paypal_config'] = 'PayPal';
$txt['treas_paypal_config_descr'] = 'PayPal Configuration information.';
$txt['treas_pp_email'] = 'PayPal Receiver Email';
$txt['treas_pp_notify_file'] = 'PayPal IPN notify file';
$txt['treas_pp_test_ipn'] = 'Click here to test IPN';
$txt['treas_pp_return_file'] = 'Link for return to site';
$txt['treas_pp_cancel_file'] = 'Link for cancelled donation';
$txt['treas_pp_image'] = 'Image to display in PayPal';
$txt['treas_pp_item_name'] = 'PayPal Item Name';
$txt['treas_pp_item_number'] = 'PayPal Item Number';
$txt['treas_pp_currency'] = 'Your PayPal Currency';
$txt['treas_pp_other_currency'] = 'Accept other Currencies?';
$txt['treas_pp_get_address'] = 'Ask user for postal address';
$txt['treas_pp_use_sandbox'] = 'Use the Paypal Sandbox';
$txt['treas_pp_language'] = 'Default PayPal language';
$txt['treas_pp_log_options'] = 'IPN Logging options';
$txt['treas_pp_log_level'] = 'Logging Level';
$txt['treas_pp_log_number'] = 'Keep this many log entries';
$txt['treas_quarterly'] = 'Quarterly';
$txt['treas_previous'] = 'Previous';
$txt['treas_read_me'] = 'Read Me';
$txt['treas_read_me_descr'] = 'Installation and operational guidelines - the instructions are quite explicit - ignore at your peril.';
$txt['treas_reconciliation'] = 'Reconciliation';
$txt['treas_record_add'] = 'Treasury Record Add';
$txt['treas_record_delete'] = 'Treasury Record Delete';
$txt['treas_record_edit'] = 'Treasury Record Edit';
$txt['treas_registry_updated'] = 'Registry updated with PayPal IPN';
$txt['treas_registry_imported'] = 'IPN records have been imported for a total of';
$txt['treas_reveal_amounts'] = 'Reveal Amounts';
$txt['treas_reveal_dates'] = 'Reveal Dates';
$txt['treas_select_order'] = 'Order';
$txt['treas_select_sort'] = 'Method';
$txt['treas_select_time'] = 'Period';
$txt['treas_settle'] = 'Settle';
$txt['treas_show_info'] = 'Show Donations in Forum Info Center';
$txt['treas_show_gross'] = 'Show Gross Only<br />(ignore PayPal fees)';
$txt['treas_show_registry'] = 'Show Registry info to Donors';
$txt['treas_sort'] = 'Sort';
$txt['treas_sort_asc'] = 'Sort Ascending';
$txt['treas_sort_desc'] = 'Sort Descending';
$txt['treas_sort_donations'] = 'Sort Donations';
$txt['treas_sort_lastdate'] = 'Sort LastDate';
$txt['treas_sort_username'] = 'Sort Username';
$txt['treas_submit'] = 'Submit';
$txt['treas_submit_button'] = 'Donations page submit button';
$txt['treas_summary_of'] = 'Summary of';
$txt['treas_totalling'] = 'Totalling';
$txt['treas_top_button'] = 'Donations page top button';
$txt['treas_top_button_show'] = 'Display the top button?';
$txt['treas_trans_add'] = 'Transaction Record Add';
$txt['treas_trans_delete'] = 'Transaction Record Delete';
$txt['treas_trans_edit'] = 'Transaction Record Edit';
$txt['treas_transaction_log'] = 'Log';
$txt['treas_transaction_log_descr'] = 'View details in the paypal transaction log.';
$txt['treas_type'] = 'Type';
$txt['treas_use_curl'] = 'Post back to PayPal for IPN';
$txt['treas_username_prompt'] = 'Prompt to use username';
$txt['treas_username_yes'] = 'Username request: YES Response';
$txt['treas_username_no'] = 'Username request: NO Response';
$txt['treas_year'] = 'Anno';
$txt['treas_yearly'] = 'Yearly';
?>