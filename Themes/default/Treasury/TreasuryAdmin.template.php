<?php
/**
 * TreasuryAdmin.template.php
 *
 * @package Treasury
 * @link https://github.com/Darknico/SMF-Treasury
 * @author Darknico <info@darknico.com>
 * @copyright Resourcez at resourcez.biz - Edited by Darknico
 * @license https://spdx.org/licenses/GPL-2.0-or-later.html GPL-2.0-or-later
 *
 * @version 2.12.3
 */

function template_treasuryregister()
{
	global $scripturl, $txt, $context, $settings, $tr_config, $tr_targets, $num_ipn, $ipn_tot, $total;
	global $pageNum_Recordset1, $totalRows_Recordset1, $totalPages_Recordset1;

	# Output the page
	echo '<form action="', $scripturl.$context['treas_link'], ';sa=ipnrec" method="post">';
	echo '<div class="cat_bar"><h3 class="catbg">' . $txt['treas_fin_register'] . '</h3></div>';
    	echo '<div class="windowbg noup"><table class="tborder" width="100%">';
	echo '<tr class="catbg2"><td align="center">';
	echo 'Number of new IPN records: ', $num_ipn, ' - ', $txt['treas_totalling'], ' ', $tr_targets['currency'][$tr_config['pp_currency']].sprintf('%0.2f',  $ipn_tot);
	echo '</td></tr>';
    	echo '<tr class="windowbg"><td align="center">';
	echo '<input type="submit" value="PayPal IPN reconcile" onclick="return confirm(\'This action will total up all recent PayPal IPN' . '\n' . 'transactions and post them here in the register.' . '\n\n' . 'Are you sure you want to do this now?\')" />';
	echo '<input type="hidden" name="sc" value="', $context['session_id'], '" />';
	echo '</td></tr></table>';
	echo '</form>';

	echo '<br /><table style="margin:auto;"><tr>';
	if ( $pageNum_Recordset1 > 0 )
	{
		echo '<td><form action="', $scripturl.$context['treas_link'], ';sa=registry" method="post" style="margin:0;">'
		.'<input type="hidden" name="pageNum_Recordset1" value="0" />'
		.'<input type="hidden" name="totalRows_Recordset1" value="', $totalRows_Recordset1, '" />'
		.'<input type="submit" name="navig" value="|&laquo;" title="Current" /></form></td>';
		echo '<td><form action="', $scripturl.$context['treas_link'], ';sa=registry" method="post" style="margin:0;">'
		.'<input type="hidden" name="pageNum_Recordset1" value="', max(0, $pageNum_Recordset1 - 1), '" />'
		.'<input type="hidden" name="totalRows_Recordset1" value="', $totalRows_Recordset1, '" />'
		.'<input type="hidden" name="sc" value="', $context['session_id'], '" />'
		.'<input type="submit" name="navig" value="&laquo;" title="Next newest" /></form></td>';
	} else {
		echo '<td colspan="2"></td>';
	}
	if ( $pageNum_Recordset1 < $totalPages_Recordset1 )
	{
		echo '<td><form action="', $scripturl.$context['treas_link'], ';sa=registry" method="post" style="margin:0;">'
		.'<input type="hidden" name="pageNum_Recordset1" value="', min($totalPages_Recordset1, $pageNum_Recordset1 + 1), '" />'
		.'<input type="hidden" name="totalRows_Recordset1" value="', $totalRows_Recordset1, '" />'
		.'<input type="submit" name="navig" value="&raquo;" title="Next Oldest" /></form></td>';
		echo '<td><form action="', $scripturl.$context['treas_link'], ';sa=registry" method="post" style="margin:0;">'
		.'<input type="hidden" name="pageNum_Recordset1" value="', $totalPages_Recordset1, '" />'
		.'<input type="hidden" name="totalRows_Recordset1" value="', $totalRows_Recordset1, '" />'
		.'<input type="hidden" name="sc" value="', $context['session_id'], '" />'
		.'<input type="submit" name="navig" value="&raquo;|" title="Oldest" /></form></td>';
	} else {
		echo '<td colspan="2"></td>';
	}
	echo '</tr></table><br />';

    echo '<table class="tborder" width="100%" style="margin:auto;"><tr>'
    .'<td class="titlebg2" align="center">&nbsp;</td>'
    .'<td class="titlebg2" align="center">Date</td>'
    .'<td class="titlebg2" align="center">Num</td>'
    .'<td class="titlebg2" align="center">Name</td>'
    .'<td class="titlebg2" align="center">Description</td>'
    .'<td class="titlebg2" align="center">Amount</td></tr>';

	if (isset($context['treas_registry']))
	{
		foreach ($context['treas_registry'] as $register_treas)
		{
			$register_treas['fdate'] = timeformat($register_treas['fdate'], treasdate());
		    echo '<tr class="windowbg">'
		    .'<td align="center">'
			  ."<a href=\"javascript: void 0\" onclick=\""
			    ."document.recedit.id.value = '$register_treas[id]'; "
			    ."document.recedit.Date.value = '$register_treas[fdate]'; "
			    ."document.recedit.Num.value = '$register_treas[num]'; "
			    ."document.recedit.Name.value = '$register_treas[name]'; "
				."document.recedit.Descr.value = '$register_treas[descr]'; "
			 	."document.recedit.Amount.value = '$register_treas[amount]'; "
			 	."document.recedit.Submit.value = 'Modify'; "
			 	."document.recedit.sa.value = 'finregedit'; "
			  ."return false;\">"
	  		.'<img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/edit.png" alt="Edit" /></a>&nbsp;'
			.'<a href="', $scripturl.$context['treas_link'], ';sa=finregdel;rid=', $register_treas['id'], ';sesc=', $context['session_id'], '">'
			.'<img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/drop.png" onclick="return confirm(\'Are you sure you want to delete this record?\n\nAre you sure you want to do this now?\')" alt="Delete" />'
			.'</a></td>'
			."<td align=\"left\">$register_treas[fdate]</td>"
	        ."<td align=\"left\" width=\"8\">$register_treas[num]</td>"
	        ."<td align=\"left\">$register_treas[name]</td>"
	        ."<td align=\"left\">$register_treas[descr]</td>"
	        .'<td align="right"><span ';
			$amt =  sprintf('%10.2f', $register_treas['amount']);
			if ( $amt < 0 )
				echo 'style="color:#FF0000;"';
			echo ">", $tr_targets['currency'][$tr_config['pp_currency']].$amt, "</span></td></tr>";
		}
	}
    echo '</table><table width="100%"><tr><td align="right"><b>Net Balance&nbsp;&nbsp;&nbsp;';
	echo $tr_targets['currency'][$tr_config['pp_currency']].sprintf('%0.2f', $total), '&nbsp;</b></td>';
    echo '</tr></table>';
    echo '<form name="recedit" action="', $scripturl.$context['treas_link'], '" method="post">'
	.'<table><tr>'
    .'<td class="titlebg2" align="center">Date</td>'
    .'<td class="titlebg2" align="center">Num</td>'
    .'<td class="titlebg2" align="center">Name</td>'
    .'<td class="titlebg2" align="center">Description</td>'
    .'<td class="titlebg2" align="center">Amount</td></tr><tr>'
	.'<td align="left" style="width:8px;"><input name="id" type="hidden" />'
	.'<input name="Date" type="text" size="22" /></td>'
	.'<td align="left" style="width:8px;"><input name="Num" type="text" size="6" /></td>'
	.'<td align="left"><input name="Name" type="text" size="15" /></td>'
	.'<td align="left"><input name="Descr" type="text" size="30" /></td>'
	.'<td align="right"><input name="Amount" type="text" size="8" /></td></tr>';
	echo '<tr><td align="right" colspan="5">'
	.'<input type="hidden" name="sc" value="', $context['session_id'], '" />'
	.'<input type="hidden" name="sa" value="finreg" />'
	."<input name=\"\" type=\"reset\" value=\"Reset\" onclick=\""
	."document.recedit.Submit.value = 'Add'; "
	."document.recedit.sa.value = 'finregadd'; "
	."return true;\" />&nbsp;"
	.'<input name="Submit" type="submit" value="', $txt['treas_add'], '" class="button" />';
	echo '</td></tr></table></div></form>';
	echo '<div><b>Note date format -</b> ', timeformat(time(), treasdate()), '</div>';
    echo '<br />';
}

function template_treasury_donations()
{
	global $scripturl, $txt, $context, $settings, $tr_config;
	global $start, $sort_order, $maxRows, $mode, $totalRows;

	# Donation paging
	$pagination = treasuryPages($context['treas_link'] . ';sa=donations;mode=' . $mode . ';order=' . $sort_order, $totalRows, $maxRows, $start) . '&nbsp;';

	echo '<form method="post" action="', $scripturl.$context['treas_link'], ';sa=donations">
	<div class="cat_bar"><h3 class="catbg">' . $txt['treas_donations'] . '</h3></div>
	<div class="windowbg noup"><table width="100%" cellspacing="2" cellpadding="2" style="border:1px solid;" class="windowbg">
	<tr>
	<td align="left">', sprintf($txt['treas_page_of'], ( floor( $start / $maxRows ) + 1 ), ceil( $totalRows / $maxRows )), '</td>
	  <td align="right" style="white-space:nowrap;">', $txt['treas_select_sort'], ':&nbsp;';
	$options = array('lastdonated' => $txt['treas_sort_lastdate'], 'username' => $txt['treas_sort_username'], 'donation' => $txt['treas_sort_donations']);
	$select = '<select name="mode" id="mode">';
	foreach($options as $opname => $opvalue) {
		$select .= '<option value="' . $opname . '" ' . (($opname == $mode) ? 'selected="selected"' : '') . '>' . $opvalue . '</option>' . "\n";
	}
	$select .= '</select>';
	echo $select;
	echo '&nbsp;&nbsp;', $txt['treas_select_order'], '&nbsp;';
	$options2 = array('DESC' => $txt['treas_sort_desc'], 'ASC' => $txt['treas_sort_asc']);
	$select2 = '<select name="order" id="order">';
	foreach($options2 as $opname2 => $opvalue2) {
		$select2 .= '<option value="' . $opname2 . '" ' . (($opname2 == $sort_order) ? 'selected="selected"' : '') . '>' . $opvalue2 . '</option>' . "\n";
	}
	$select2 .= '</select>';
	echo $select2;
	echo '	  </td>
	</tr>
	<tr>
	<td align="left">', $pagination, '</td>
	<td align="right">
		<input type="hidden" name="start" value="', $start, '" />
		<input type="submit" name="submit" value="', $txt['treas_sort'], '" />
	</td></tr>
	</table></form>';

    echo '<table width="100%" style="margin:auto;" class="tborder"><tr>'
    .'<td class="titlebg2" align="center"><b>&nbsp;</b></td>'
    .'<td class="titlebg2" align="center">Tax ID</td>'
    .'<td class="titlebg2" align="center">Name</td>'
    .'<td class="titlebg2" align="center">Show</td>'
    .'<td class="titlebg2" align="center">Status</td>'
    .'<td class="titlebg2" align="center">Curr.</td>'
    .'<td class="titlebg2" align="center">Gross</td>'
    .'<td class="titlebg2" align="center">Fee</td>'
    .'<td class="titlebg2" align="center">Settle</td>'
    .'<td class="titlebg2" align="center">Date</td>'
    .'<td class="titlebg2" align="center">Rate</td>'
    .'<td class="titlebg2" align="center">Event</td>'
	.'</tr>';

	if (isset($context['treas_donations']))
	{
		foreach ($context['treas_donations'] as $donations_treas)
		{
			$donations_treas['payment_date'] = timeformat($donations_treas['payment_date'], treasdate());
			echo '<tr class="windowbg">'
			.'<td align="center">'
			  ."<a href=\"javascript: void 0\" onclick=\""
				."document.transedit.id.value = '$donations_treas[id]'; "
				."document.transedit.Txn_id.value = '$donations_treas[txn_id]'; "
				."document.transedit.Custom.value = '$donations_treas[custom]'; "
				."document.transedit.Option_seleczion1.value = '$donations_treas[option_seleczion1]'; "
				."document.transedit.Payment_status.value = '$donations_treas[payment_status]'; "
			 	."document.transedit.Mc_currency.value = '$donations_treas[mc_currency]'; "
			 	."document.transedit.Mc_gross.value = '$donations_treas[mc_gross]'; "
			 	."document.transedit.Mc_fee.value = '$donations_treas[mc_fee]'; "
			 	."document.transedit.Settle_amount.value = '$donations_treas[settle_amount]'; "
			 	."document.transedit.Payment_date.value = '$donations_treas[payment_date]'; "
			 	."document.transedit.Exchange_rate.value = '$donations_treas[exchange_rate]'; "
			 	."document.transedit.Eid.value = '$donations_treas[eid]'; "
			 	."document.transedit.Submit.value = 'Modify'; "
			 	."document.transedit.sa.value = 'transregedit'; "
			."return false;\">"
	  		.'<img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/edit.png" alt="Edit" /></a><br />'
			.'<a href="', $scripturl.$context['treas_link'], ';sa=transregdel;did=', $donations_treas['id'], ';start=', $start, ';order=', $sort_order, ';mode=', $mode,';sesc=', $context['session_id'],  '">'
			.'<img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/drop.png" onclick="return confirm(\'Are you sure you want to delete this record?\n\nAre you sure you want to do this now?\')" alt="Delete" />'
			.'</a></td>'
			."<td align=\"left\" class=\"smalltext\">$donations_treas[txn_id]</td>"
	        ."<td align=\"left\" class=\"smalltext\">$donations_treas[custom]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[option_seleczion1]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[payment_status]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[mc_currency]</td>"
	        ."<td align=\"right\" class=\"smalltext\">$donations_treas[mc_gross]</td>"
	        ."<td align=\"right\" class=\"smalltext\">$donations_treas[mc_fee]</td>"
	        ."<td align=\"right\" class=\"smalltext\">$donations_treas[settle_amount]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[payment_date]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[exchange_rate]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[eid]</td>"
			."</tr>";
		}
	}

    echo '</table><br />';
    echo '<form name="transedit" action="', $scripturl.$context['treas_link'], '" method="post">'
		.'<table><tr>'
	    .'<td class="titlebg2" align="center">Tax ID</td>'
	    .'<td class="titlebg2" align="center">Name</td>'
	    .'<td class="titlebg2" align="center">Show</td>'
	    .'<td class="titlebg2" align="center">Status</td>'
	    .'<td class="titlebg2" align="center">Curr.</td>'
	    .'<td class="titlebg2" align="center">Gross</td>'
	    .'<td class="titlebg2" align="center">Fee</td>'
	    .'<td class="titlebg2" align="center">Settle</td>'
	    .'<td class="titlebg2" align="center">Date</td>'
	    .'<td class="titlebg2" align="center">Rate</td>'
	    .'<td class="titlebg2" align="center">Event</td>'
		.'</tr><tr>'
        .'<td align="left" style="width:8px;"><input name="id" type="hidden" />'
        .'<input name="Txn_id" type="text" size="20" class="smalltext" /></td>'
        .'<td align="left"><input name="Custom" type="text" size="13" class="smalltext" /></td>'
        .'<td align="center"><input name="Option_seleczion1" type="text" size="4" class="smalltext" /></td>'
        .'<td align="center"><input name="Payment_status" type="text" size="10" class="smalltext" /></td>'
        .'<td align="center"><input name="Mc_currency" type="text" size="6" class="smalltext" /></td>'
        .'<td align="right"><input name="Mc_gross" type="text" size="6" class="smalltext" /></td>'
        .'<td align="right"><input name="Mc_fee" type="text" size="6" class="smalltext" /></td>'
        .'<td align="right"><input name="Settle_amount" type="text" size="6" class="smalltext" /></td>'
        .'<td align="center"><input name="Payment_date" type="text" size="22" class="smalltext" /></td>'
        .'<td align="center"><input name="Exchange_rate" type="text" size="6" class="smalltext" /></td>'
        .'<td align="center"><input name="Eid" type="text" size="3" class="smalltext" /></td>'
		.'</tr>';
	echo '<tr><td align="center" colspan="9"><br />'
		.'<input type="hidden" name="mode" value="', $mode, '" />'
		.'<input type="hidden" name="start" value="', $start, '" />'
		.'<input type="hidden" name="sort_order" value="', $sort_order, '" />'
		.'<input type="hidden" name="sc" value="', $context['session_id'], '" />'
		.'<input type="hidden" name="sa" value="transregadd" />'
	    ."<input name=\"\" type=\"reset\" value=\"Reset\" onclick=\""
		."document.transedit.Submit.value = 'Add'; "
		."document.transedit.sa.value = 'transregadd'; "
	    ."return true;\" />&nbsp;"
		.'<input name="Submit" type="submit" value="', $txt['treas_add'], '" />';
	echo '</td></tr></table></form>';
	echo '<br /><table width="100%" style="border:1px solid;" class="windowbg">
	<tr><td><b>Tax ID:</b></td><td> the receipt from paypal, something like ZYXGTY1234567890 (must be UNIQUE for every entry)</td></tr>
<tr><td><b>Name:</b></td><td> the Username who donated (must be genuine for details to show in Profile)</td></tr>
<tr><td><b>Show:</b></td><td> <b>Yes</b>, if they wanted their name displayed, otherwise <b>No</b>.</td></tr>
<tr><td><b>Status:</b></td><td> <b>Completed</b> for display,  <b>Refunded</b> if refund, <b>Pending</b> if waiting on echeck clearance.</td></tr>
<tr><td><b>Curr. :</b></td><td> currency of donation - must match one of USD CAD AUD YEN EUR GBP</td></tr>
<tr><td><b>Gross:</b></td><td> the donation amount, in that currency.</td></tr>
<tr><td><b>Fee:</b></td><td> the paypal fee for that donation, in that currency.</td></tr>
<tr><td><b>Settle:</b></td><td> the Gross less Fee, <b>converted</b> to your site (primary) currency.</td></tr>
<tr><td><b>Date:</b></td><td> the format ', timeformat(time(), treasdate()), ' - <b>must</b> match this format.</td></tr>
<tr><td><b>Rate:</b></td><td> the exchange rate (1.00 if donation currency same as site currency)</td></tr>
<tr><td><b>Event:</b></td><td> the ID value for any events you may have used, default 0)</td></tr>
</table></div>';
}

function template_treasury_totals() {
	global $scripturl, $boardurl, $txt, $context, $settings, $tr_config;
	global $start, $sort_order, $maxRows, $mode, $totalRows, $search_time, $search_event;
	global $num, $total, $fees, $net, $settled, $periods, $periode;

	$pagination = treasuryPages($context['treas_link'] . ';sa=donortotals;search_time=' . $search_time . ';search_event=' . $search_event . ';mode=' . $mode . ';order=' . $sort_order, $totalRows, $maxRows, $start) . '&nbsp;';
	echo '<script type="text/javascript" src="', $settings['default_theme_url'], '/Treasury/scripts/ts_picker.js">
	//Script by Denis Gritcyuk: tspicker@yahoo.com
	//Submitted to JavaScript Kit (http://javascriptkit.com)
	//Visit http://javascriptkit.com for this script
	</script>';
	echo '<form name="treas" method="post" action="', $scripturl.$context['treas_link'], ';sa=donortotals">
	<div class="cat_bar"><h3 class="catbg">' . $txt['treas_donor_totals'] . '</h3></div>
	<div class="windowbg noup">
	<table width="100%" cellspacing="2" cellpadding="2" style="border:1px solid;" class="windowbg">
	<tr>
	<td align="left">', sprintf($txt['treas_page_of'], ( floor( $start / $maxRows ) + 1 ), ceil( $totalRows / $maxRows )), '</td>
	<td align="right" style="white-space:nowrap; font-size:10px;">', $txt['treas_select_sort'], ':&nbsp;';
	$options = array('lastdonated' => $txt['treas_sort_lastdate'], 'username' => $txt['treas_sort_username'], 'donation' => $txt['treas_sort_donations']);
	$select = '<select name="mode" id="mode">';
	foreach($options as $opname => $opvalue) {
		$select .= '<option value="' . $opname . '" ' . (($opname == $mode) ? 'selected="selected"' : '') . '>' . $opvalue . '</option>' . "\n";
	}
	$select .= '</select>';
	echo $select;

	echo '&nbsp;', $txt['treas_select_order'], ':&nbsp;';
	$options3 = array('DESC' => $txt['treas_sort_desc'], 'ASC' => $txt['treas_sort_asc']);
	$select3 = '<select name="order" id="order">';
	foreach($options3 as $opname3 => $opvalue3) {
		$select3 .= '<option value="' . $opname3 . '" ' . (($opname3 == $sort_order) ? 'selected="selected"' : '') . '>' . $opvalue3 . '</option>' . "\n";
	}
	$select3 .= '</select>';
	echo $select3;

	echo '&nbsp;', $txt['treas_select_time'], ':&nbsp;';
	$options2 = array(0 => $txt['treas_all_donations'], 1 => $txt['treas_last_day'], 7 => $txt['treas_last_week'], 
	14 => $txt['treas_last_fortnight'], 30 => $txt['treas_last_month'], 91 => $txt['treas_last_quarter'], 
	182 => $txt['treas_last_half'], 365 => $txt['treas_last_year'], 730 => $txt['treas_last_2years']);
	$select2 = '<select name="search_time" id="search_time">';
	foreach($options2 as $opname2 => $opvalue2) {
		$select2 .= '<option value="' . $opname2 . '" ' . (($opname2 == $search_time) ? 'selected="selected"' : '') . '>' . $opvalue2 . '</option>' . "\n";
	}
	$select2 .= '</select>';
	echo $select2;

	echo '&nbsp;', $txt['treas_event'], ':&nbsp;';
	$select4 = '<select name="search_event" id="search_event">';
	$select4 .= '<option value="0">No Event</option>';
	if (!empty($context['treas_eventid'])) {
		foreach($context['treas_eventid'] AS $eid => $etitle) {
			$select4 .= '<option value="' . $eid . '" ' . (($eid == $search_event) ? 'selected="selected"' : '') . '>' . $etitle . '</option>' . "\n";
		}
	}
	$select4 .= '</select>';
	echo $select4;

	echo '&nbsp;</td>
	</tr>
	<tr class="windowbg"><td colspan="2"><span style="float:left;">', $pagination, '</span>';
	echo '<span style="float:right;">
	<b>&raquo;</b> From <input type="text" name="periods" value="', ($periods >0 ? strftime('%Y-%m-%d', $periods) : ''), '" size="10" /> <a href="javascript:show_calendar(\'document.treas.periods\', document.treas.periods.value);" title="Choose Start Date"><img src="', $settings['default_images_url'], '/cal.gif" style="margin-bottom:-2px; width:16px; height:15px;" alt="" /></a>&nbsp;to&nbsp;<input type="text" name="periode" value="', ($periode > 0 ? strftime('%Y-%m-%d', $periode) : ''), '" size="10" /> <a href="javascript:show_calendar(\'document.treas.periode\', document.treas.periode.value);" title="Choose End Date"><img src="', $settings['default_images_url'], '/Treasury/cal.gif" style="margin-bottom:-2px; width:16px; height:15px;" alt="" /></a> <a href="', $scripturl.$context['treas_link'], ';sa=treashelp;help=treas_choose_period" onclick="return reqWin(this.href);" class="help"><img src="', $settings['images_url'], '/helptopics_hd.png" alt="', ($context['treas_smf'] == 1 ? $txt['119'] : $txt['help']), '" align="top" /></a> <b>&laquo;</b>&nbsp;&nbsp;&nbsp;&nbsp; 
	<input type="hidden" name="sc" value="', $context['session_id'], '" />
	<input type="hidden" name="start" value="', $start, '" />
	<input type="submit" name="submit" value="', $txt['treas_change'], '" style="margin:0;" />&nbsp;</span>
	</td></tr>
	</table></form>';

    echo '<table width="100%" class="tborder"><tr class="titlebg2">'
    .'<td align="left"><b>', $txt['treas_name'], '</b></td>'
    .'<td align="center"><b>', $txt['treas_currency'], '</b></td>'
    .'<td align="right"><b>', $txt['treas_gross'], '</b></td>'
    .'<td align="right"><b>', $txt['treas_fees'], '</b></td>'
    .'<td align="right"><b>', $txt['treas_net'], '</b></td>'
    .'<td align="right"><b>', $txt['treas_settle'], '</b></td>'
    .'<td align="center"><b>', $txt['treas_last_date'], '</b></td>'
	.'</tr>';
	if (isset($context['donor_totals']))
	{
		foreach ($context['donor_totals'] as $totals_donor)
		{
			$totals_donor['lastdate'] = timeformat($totals_donor['lastdate'], treasdate());
	    	echo '<tr class="windowbg2">'
	        .'<td align="left">', $totals_donor['custom'], '</td>'
	        .'<td align="center">', $totals_donor['mc_currency'], '</td>'
	        .'<td align="right">', $totals_donor['mc_gross'], '</td>'
	        .'<td align="right">', $totals_donor['mc_fee'], '</td>'
	        .'<td align="right">', $totals_donor['mc_net'], '</td>'
	        .'<td align="right">', $totals_donor['settle_amount'], '</td>'
	        .'<td align="center">', $totals_donor['lastdate'], '</td>'
			.'</tr>';
		}
	}
	echo '</table><br />';

	$period = '';
	foreach($options2 as $opname2 => $opvalue2) {
		$period .= ($opname2 == $search_time) ? $opvalue2 : '';
	}
    echo '<table class="tborder" style="margin:auto; width:50%;">'
	.'<tr class="titlebg2"><td colspan="6" align="center"><b>', $txt['treas_summary_of'], ' ', ($search_event ? $txt['treas_all_donations'] : $period), '</b></td></tr>'
    .'<tr class="windowbg">'
	.'<td><b>', $txt['treas_type'], '</b></td><td align="right"><b>', $txt['treas_num'], '</b></td><td align="right"><b>', $txt['treas_total'], ' ', $tr_config['pp_currency'], '</b></td>'
	.'<td align="right"><b>', $txt['treas_gross'], '</b></td><td align="right"><b>', $txt['treas_fees'], '</b></td><td align="right"><b>', $txt['treas_net'], '</b></td>'
	.'</tr>'
	.'<tr>'
	.'<td class="windowbg"><b>', $txt['treas_amount'], '</b></td><td align="right" class="windowbg2">', $num, '</td><td align="right" class="windowbg2">', $settled, '</td>'
	.'<td align="right" class="windowbg2">', $total, '</td><td align="right" class="windowbg2">', $fees, '</td><td align="right" class="windowbg2">', $net, '</td>'
	.'</tr>'
	.'</table></div>';

}

function template_config()
{
	global $db_prefix, $context, $settings, $options, $scripturl, $txt, $tr_config, $tr_targets;

	echo '<form name="tr_configs" action="', $scripturl.$context['treas_link'], ';sa=configupdate" method="post">';
	echo '<div class="cat_bar"><h3 class="catbg">' . $txt['treas_main_config'] . '</h3></div>';
	echo '<div class="windowbg noup">';
	echo '<dl class="settings">';

	$date_types = array('0' => 'yyyy-mm-dd hh:mm:ss', '1' => 'yyyy/mm/dd hh:mm:ss', 
	'2' => 'dd-mm-yyyy hh:mm:ss', '3' => 'dd/mm/yyyy hh:mm:ss');
	selectBox('date_format',  $txt['treas_date_format'] , $tr_config['date_format'], $date_types, '1');
	ShowYNBox('dm_show_targets', $txt['treas_display_goals'] , '', '', '1');
	ShowYNBox('dm_show_meter', $txt['treas_display_meter'] , '', '', '1');
	showYNBox('don_show_gross', $txt['treas_show_gross'] , '', '', '1');
	showYNBox('don_show_date', $txt['treas_reveal_dates'] , '', '', '1');
	showYNBox('don_show_amt', $txt['treas_reveal_amounts'] , '', '', '1');
#	ShowYNBox('don_show_info_center', $txt['treas_show_info'] , '', '4', '1');
	showYNBox('don_show_button_top' , $txt['treas_top_button_show'] , '', '', '1');
	showTextBox('don_button_top', $txt['treas_top_button'] , '', '25', '1');
	showImgXYBox('don_top_img_width', 'don_top_img_height', $txt['treas_image_dims'] , '2', '1');

	echo '</dl><hr><dl class="settings">';
	
	$time_durations = array('0' => $txt['treas_monthly'], '1' => $txt['treas_quarterly'], '2' => $txt['treas_half_yearly'], '3' => $txt['treas_yearly']);
	selectBox('duration', $txt['treas_duration'] , $tr_config['duration'], $time_durations, '1');
	ShowYNBox('group_use', $txt['treas_group_use'] , '', '', '1');
	$donor_groups = array();
	$donor_groups[0] = 'None Selected';
	foreach($context['groups'] AS $gid => $gname) {
		$donor_groups[$gid] = $gname;
	}
	selectBox('group_id', $txt['treas_group_select'] , $tr_config['group_id'], $donor_groups, '1');
	showYNBox('group_duration', $txt['treas_group_duration'] , '', '', '1');
	showYNBox('group_anonymous', $txt['treas_group_anonymous'] , '', '', '1');
#	showTextBox('group_minimum', $txt['treas_group_min'] , '', '10', '1');
	showYNBox('show_registry', $txt['treas_show_registry'] , '', '', '1');
	ShowTextBox('don_num_don', $txt['treas_num_donors'] , '', '4', '1');
	showTextBox('don_button_submit', $txt['treas_submit_button'] , '', '25', '1');
	showImgXYBox('don_sub_img_width', 'don_sub_img_height', $txt['treas_image_dims'] , '2', '1');

	echo '</dl><hr><dl class="settings">';

	showTextBox('don_name_prompt', $txt['treas_username_prompt'] , '', '60', '1');
	showTextBox('don_name_yes', $txt['treas_username_yes'] , '', '60', '1');
	showTextBox('don_name_no', $txt['treas_username_no'] , '', '60', '1');
	if ($tr_config['event_active']) {
		echo '<tr><td colspan="3" align="center"><span style="color:red;">BEWARE: you have an active event, so the following Title, Text and Monthly Goals are inoperative!</span></td></tr>';
	}
	ShowTextBox('don_text_title', $txt['treas_donation_title'] , '', '60', '1');
	showTextArea('don_text', $txt['treas_donation_text'] , '50', '10', '1');

	echo '</dl><hr><dl class="settings">';

	
    	echo '
	<dt>
		', addDescriptionHelp("goal") ,'
		<span>', $txt['treas_donation_goals'], '<span>
	</dt>';	
    	echo '<dt><table class="tborder" width="100%">';
	$row1 = '<tr><td class="titlebg"> </td>';
	$row2 = '<tr><td class="titlebg" align="left">' . $txt['treas_goal'] . '</td>';
	ksort($tr_targets['goal']);
	foreach ($tr_targets['goal'] as $block_month => $block_goal)
	{
		$row1 .= '<td class="titlebg">' . timeformat(mktime(0, 0, 0, $block_month, 2, 0), '%b') . '</td>';
		$row2 .= "<td><input size=\"4\" name=\"var_goal-$block_month\" type=\"text\" value=\"$block_goal\" /></td>";
	}
	$row1 .= '</tr>';
	$row2 .= '</tr>';
	echo $row1, ' ', $row2;
	echo '</table></dt><dd></dd>';

    	echo '
	<dt>
		', addDescriptionHelp("don_amount") ,'
		<span>', $txt['treas_donation_amounts'], '<span>
	</dt>';		
    	echo '<dt><table class="tborder">';
	$row1 = '<tr><td class="titlebg"> </td>';
	$row2 = '<tr><td class="titlebg">' . $txt['treas_amount'] . '</td>';
	ksort($tr_targets['don_amount']);
	foreach ($tr_targets['don_amount'] AS $amountn => $amounts)
	{
		$row1 .= "<td class=\"titlebg\">$amountn</td>";
		$row2 .= "<td><input size=\"4\" name=\"var_don_amount-$amountn\" type=\"text\" value=\"$amounts\" /></td>";
	}
	$row1 .= '</tr>';
	$row2 .= '</tr>';
	echo $row1, ' ', $row2;
	echo '</table></dt><dd></dd>';
	
	showTextBox('don_amt_checked', $txt['treas_donation_default'] , '300', '4', '1');
	showYNBox('don_amt_other', 'User can specify "Other" Amount?', '', '', '1');
	
	echo '</dl></div>';
	echo '<input type="hidden" name="configger" value="', ($context['treas_smf'] == 2 ? 'action=admin;area=treasury' : 'action=treasuryadmin'), ';sa=config" />';
	echo '<input type="hidden" name="sc" value="', $context['session_id'], '" />';
	echo '<input type="submit" value="', $txt['treas_submit'], '" class="button" />';
	echo '</form>';
}

function template_config_paypal()
{
	global $context, $txt, $scripturl, $boardurl, $tr_config, $tr_targets;

	echo '<form action="', $scripturl.$context['treas_link'], ';sa=configupdate" method="post">';
	echo '<div class="cat_bar"><h3 class="catbg">' . $txt['treas_paypal_config'] . '</h3></div>
	<div class="windowbg noup"><dl class="settings">';
	showTextBox('receiver_email', $txt['treas_pp_email'] , '', '50', '1');
	ShowTextBox('pp_notify_url', $txt['treas_pp_notify_file'] . '<br /><a href="' . $boardurl . '/ipntreas.php?dbg=1" target="_blank"><b><i>' . $txt['treas_pp_test_ipn'] . '</i></b></a> ipntreas.php ', '', '50', '1');
	showTextBox('pp_ty_url', $txt['treas_pp_return_file'] . '<br />index.php?action=profile ', '', '50', '1');
	showTextBox('pp_cancel_url', $txt['treas_pp_cancel_file'] . '<br />index.php?action=treasury ', '', '50', '1');
	showTextBox('pp_image_url', $txt['treas_pp_image'] , '', '50', '1');

	echo '</dl><hr><dl class="settings">';
	
	selectBox('use_curl', $txt['treas_use_curl'] , $tr_config['use_curl'], array('0' => 'fsockopen', '1' => 'cURL',), '1');
	showTextBox('pp_itemname', $txt['treas_pp_item_name'] , '', '15', '1');
	$currencies = array();
	foreach($tr_targets['currency'] AS $subtype => $value) {
		$currencies[] = $subtype;
	}
	selectOption('pp_currency', $txt['treas_pp_currency'] , $tr_config['pp_currency'], $currencies, '1');
	showYNBox('pp_sandbox', $txt['treas_pp_use_sandbox'] , '', '', '1');
	selectBox('pp_language', $txt['treas_pp_language'] , $tr_config['pp_language'], array('DE' => 'Deutsch', 'NL' => 'Dutch', 'US' => 'English', 'ES' => 'Espa&ntilde;ol', 'FR' => 'Fran&ccedil;ais', 'IT' => 'Italiano',), 1);
	showTextBox('pp_item_num', $txt['treas_pp_item_number'] , '', '15', '1');
	showYNBox('pp_currency2', $txt['treas_pp_other_currency'] , '', '', '1');

	echo '</dl><hr><dl class="settings">';
	
	selectBox('ipn_dbg_lvl', $txt['treas_pp_log_level'] , $tr_config['ipn_dbg_lvl'], array('0' => 'Off', '1' => 'Log errors only', '2' => 'Log everything'), '1');
	showTextBox('ipn_log_entries', $txt['treas_pp_log_number'] , '', '4', '1');
	echo '</dl></div>';

	echo '<input type="hidden" name="configger" value="', ($context['treas_smf'] == 2 ? 'action=admin;area=treasury' : 'action=treasuryadmin'), ';sa=configpaypal" />';
	echo '<input type="hidden" name="sc" value="', $context['session_id'], '" />';
	echo '<input type="submit" value="', $txt['treas_submit'], '" class="button" />';
	echo '</form>';
}

function template_config_block()
{
	global $context, $scripturl, $txt, $tr_config, $tr_targets;

	echo '<form name="tr_configs" action="', $scripturl.$context['treas_link'], ';sa=configupdate" method="post">';
	echo '<div class="cat_bar"><h3 class="catbg">' . $txt['treas_paypal_config'] . '</h3></div>
	<div class="windowbg noup"><dl class="settings">';
	ShowTextBox('dm_name_length', $txt['treas_block_username'] , '', '4', '1');
	showTextBox('dm_num_don', $txt['treas_block_number'] ,  '', '4', '1');
	showTextBox('dm_button', $txt['treas_block_image'] , '', '25', '1');

	echo '</dl><hr><dl class="settings">';

	showYNBox('dm_show_date', $txt['treas_block_dates'] , '', '', '1');
	showYNBox('dm_show_amt', $txt['treas_block_amounts'] , '', '', '1');
	showImgXYBox('dm_img_width', 'dm_img_height',  $txt['treas_block_image_size'] , '4', '1');

	echo '</dl><hr><dl class="settings">';
	
	showTextBox('dm_title', $txt['treas_block_title'] , '', '40', '1');
	showTextArea('dm_comments', $txt['treas_block_comment'] , '40', '2', '1');
	echo '</dl></div>';

	echo '<input type="hidden" name="configger" value="', ($context['treas_smf'] == 2 ? 'action=admin;area=treasury' : 'action=treasuryadmin'), ';sa=configblock" />';
	echo '<input type="hidden" name="sc" value="', $context['session_id'], '" />';
	echo '<input type="submit" value="', $txt['treas_submit'], '" class="button" />';
	echo '</form>';
}

function template_config_events()
{
	global $context, $scripturl, $txt, $tr_config, $settings;
	global $start, $sort_order, $maxRows, $mode, $totalRows;
	echo '<script type="text/javascript" src="', $settings['default_theme_url'], '/Treasury/scripts/ts_picker.js">
	//Script by Denis Gritcyuk: tspicker@yahoo.com
	//Submitted to JavaScript Kit (http://javascriptkit.com)
	//Visit http://javascriptkit.com for this script
	</script>';
	
	echo '<div class="cat_bar"><h3 class="catbg">' . $txt['treas_events'] . '</h3></div>
		<div class="windowbg noup"><dl class="settings">';

	echo '<form name="tr_events" action="', $scripturl.$context['treas_link'], ';sa=configupdate" method="post">';

	$event_id = array();
	$event_id[0] = $txt['treas_event_inactive'];
	if (isset($context['eventid']))
	{
		foreach($context['eventid'] AS $eid => $etitle) {
			$event_id[$eid] = $etitle;
		}
	}
	selectBox('event_active', $txt['treas_event_active'] , $tr_config['event_active'], $event_id, '1');
	echo '<tr class="windowbg"><td colspan="3" align="center">';
	echo '<input type="hidden" name="configger" value="', ($context['treas_smf'] == 2 ? 'action=admin;area=treasury' : 'action=treasuryadmin'), ';sa=configevents" />';
	echo '<input type="hidden" name="sc" value="', $context['session_id'], '" />';
	echo '<input type="submit" value="', $txt['treas_submit'], '" class="button"  />';
	if ($tr_config['event_active']) {
		echo '<br /><span style="color:red;">BEWARE: you activated an event - this will change your Treasury display!</span>';
	}
	echo '</form></dl>';

	# Events paging
	$pagination = treasuryPages($context['treas_link'] . ';sa=configevents;mode=' . $mode . ';order=' . $sort_order, $totalRows, $maxRows, $start) . '&nbsp;';
	echo '<form method="post" action="', $scripturl.$context['treas_link'], ';sa=configevents">
	<table width="100%" cellspacing="2" cellpadding="2" style="border:1px solid;" class="windowbg">
	<tr>
	<td align="left">', sprintf($txt['treas_page_of'], ( floor( $start / $maxRows ) + 1 ), ceil( $totalRows / $maxRows )), '</td>
	  <td align="right" style="white-space:nowrap;">', $txt['treas_select_sort'], ':&nbsp;';
	$options = array('lastevent' => 'Sort Last Event', 'target' => 'Sort Target', 'actual' => 'Sort Actual');
	$select = '<select name="mode" id="mode">';
	foreach($options as $opname => $opvalue) {
		$select .= '<option value="' . $opname . '" ' . (($opname == $mode) ? 'selected="selected"' : '') . '>' . $opvalue . '</option>' . "\n";
	}
	$select .= '</select>';
	echo $select;
	echo '&nbsp;&nbsp;', $txt['treas_select_order'], '&nbsp;';
	$options2 = array('DESC' => $txt['treas_sort_desc'], 'ASC' => $txt['treas_sort_asc']);
	$select2 = '<select name="order" id="order">';
	foreach($options2 as $opname2 => $opvalue2) {
		$select2 .= '<option value="' . $opname2 . '" ' . (($opname2 == $sort_order) ? 'selected="selected"' : '') . '>' . $opvalue2 . '</option>' . "\n";
	}
	$select2 .= '</select>';
	echo $select2;
	echo '	  </td>
	</tr>
	<tr>
	<td align="left">', $pagination, '</td>
	<td align="right">
		<input type="hidden" name="start" value="', $start, '" />
		<input type="submit" name="submit" value="', $txt['treas_sort'], '" />
	</td></tr>
	</table></form>';

	$txt_help = $context['treas_smf'] == 1 ? $txt['119'] : $txt['help'];
	echo '<table width="100%" class="tborder">'
	.'<tr>
		<td class="catbg2" align="center"> </td>'.'
		<td class="catbg2" width="120">
				', addDescriptionHelp("events_title") ,'
			<span>', $txt['treas_event_title'], '<span>
		</td>
		<td class="catbg2">
				', addDescriptionHelp("events_descr") ,'
			<span>', $txt['treas_event_descr'], '<span>
		</td>
		<td class="catbg2" width="70" align="center">
				', addDescriptionHelp("events_target") ,'
			<span>', $txt['treas_event_target'], '<span>
		</td>
		<td class="catbg2" width="70" align="center">
				', addDescriptionHelp("events_actual") ,'
			<span>', $txt['treas_event_actual'], '<span>
		</td>
		<td class="catbg2" width="90">
				', addDescriptionHelp("events_start") ,'
			<span>', $txt['treas_event_start'], '<span>
		</td>				
		<td class="catbg2" width="90">
				', addDescriptionHelp("events_end") ,'
			<span>', $txt['treas_event_end'], '<span>
		</td>			
	</tr>';

	if (isset($context['treas_events']))
	{
		foreach ($context['treas_events'] as $events_treas)
		{
			$events_treas['date_start'] = timeformat($events_treas['date_start'], '%Y-%m-%d');
			$events_treas['date_end'] = $events_treas['date_end'] == '0' ? '' : timeformat($events_treas['date_end'], '%Y-%m-%d');
			echo '<tr class="windowbg">'
			.'<td align="center">'
			.'<a href="', $scripturl.$context['treas_link'], ';sa=configevents;op=edit;eid=', $events_treas['eid'], ';start=', $start, ';sesc=', $context['session_id'],  '"><img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/edit.png" alt="Edit" /></a><br />'
			.'<a href="', $scripturl.$context['treas_link'], ';sa=eventsdel;eid=', $events_treas['eid'], ';start=', $start, ';order=', $sort_order, ';mode=', $mode,';sesc=', $context['session_id'],  '">'
			.'<img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/drop.png" onclick="return confirm(\'Are you sure you want to delete this record?\n\nAre you sure you want to do this now?\')" alt="Delete" />'
			.'</a></td>'
	        .'<td align="left" class="smalltext">'.stripslashes($events_treas['title']).'</td>'
	        .'<td align="left" class="smalltext">'.stripslashes($events_treas['description']).'</td>'
	        ."<td align=\"center\" class=\"smalltext\">$events_treas[target]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$events_treas[actual]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$events_treas[date_start]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$events_treas[date_end]</td>"
			.'</tr>';
		}
	}
	echo '</table><br />';

	if (isset($context['treas_event']))
	{
		foreach ($context['treas_event'] as $event_treas)
		{
			$eid = $event_treas['eid'];
			$title = stripslashes($event_treas['title']);
			$description = stripslashes($event_treas['description']);
			$date_start = timeformat($event_treas['date_start'], '%Y-%m-%d');
			$date_end = $event_treas['date_end'] == '0' ? '' : timeformat($event_treas['date_end'], '%Y-%m-%d');
			$target = $event_treas['target'];
			$actual = $event_treas['actual'];
		}
	} else {
		$eid = 0;
		$title = '';
		$description = '';
		$date_start = '';
		$date_end = '';
		$target = '';
		$actual = '';
	}
	echo '<form name="treas" action="', $scripturl.$context['treas_link'], '" method="post">'
		.'<table class="tborder" width="100%"><tr>'
		.'<td class="catbg2">', $txt['treas_event_titlemax'], '</td>'
		.'<td class="catbg2">', $txt['treas_event_descr'], '</td>'
		.'<td class="catbg2" align="center" width="60">', $txt['treas_event_target'], '</td>'
		.'<td class="catbg2" align="center" width="60">', $txt['treas_event_actual'], '</td>'
		.'<td class="catbg2" width="100">', $txt['treas_event_start'], '</td>'
		.'<td class="catbg2" width="100">', $txt['treas_event_end'], '</td>'
		.'</tr><tr class="windowbg">'
		.'<td valign="top">'
		.'<input name="title" type="text" size="30" maxlength="25" class="smalltext" value="', $title, '" /></td>'
		.'<td><textarea name="description" cols="43" rows="6" class="smalltext">', $description, '</textarea></td>'
		.'<td align="center" valign="top"><input name="target" type="text" size="9" class="smalltext" value="', $target, '" /></td>'
		.'<td align="center" valign="top"><input name="actual" type="text" size="9" class="smalltext" value="', $actual, '" /></td>'
		.'<td valign="top"><input name="date_start" type="text" size="11" class="smalltext" value="', $date_start, '"/><a href="javascript:show_calendar(\'document.treas.date_start\', document.treas.date_start.value);" title="Choose Start Date"><img src="', $settings['default_images_url'], '/Treasury/cal.gif" style="margin-bottom:-2px; width:16px; height:15px;" alt="" /></a></td>'
		.'<td valign="top"><input name="date_end" type="text" size="11" class="smalltext" value="', $date_end, '" /><a href="javascript:show_calendar(\'document.treas.date_end\', document.treas.date_end.value);" title="Choose End Date"><img src="', $settings['default_images_url'], '/Treasury/cal.gif" style="margin-bottom:-2px; width:16px; height:15px;" alt="" /></a></td>'
		.'</tr>';
	echo '<tr class="windowbg">
	<td colspan="6" align="center">
	<input type="hidden" name="sc" value="', $context['session_id'], '" />';
	if ($eid) {
		echo '
		<input type="hidden" name="sa" value="eventsedit" />
		<input type="hidden" name="mode" value="', $mode, '" />
		<input type="hidden" name="start" value="', $start, '" />
		<input type="hidden" name="eid" value="', $eid, '" />
		<input type="submit" name="update" style="width:120px;" value="Update Event" /></td>
		</tr>';
	} else {
		echo '
		<input type="hidden" name="sa" value="eventsadd" />
		<input type="submit" name="save" style="width:100px;" value="Add an Event" class="button" /></td>
		</tr>';
	}
	echo '</td></tr>';
	echo '</table></form></div>';
}

function template_trans_log()
{
	global $scripturl, $txt, $context, $settings, $tr_config;
	global $start, $sort_order, $maxRows, $mode, $totalRows;

	# Transaction log paging
	$pagination = treasuryPages($context['treas_link'] . ';sa=translog;order=' . $sort_order, $totalRows, $maxRows, $start). '&nbsp;';
	
	echo '<div class="cat_bar"><h3 class="catbg">' . $txt['treas_transaction_log'] . '</h3></div>
		<div class="windowbg noup">';	

	echo '<form method="post" action="', $scripturl.$context['treas_link'], ';sa=translog">
	<table width="100%" cellspacing="2" cellpadding="2" style="border:1px solid;" class="windowbg">
	<tr>
	<td align="left">', sprintf($txt['treas_page_of'], ( floor( $start / $maxRows ) + 1 ), ceil( $totalRows / $maxRows )), '</td>
	  <td align="right" style="white-space:nowrap;">', $txt['treas_select_order'], '&nbsp;';
	$options = array('DESC' => $txt['treas_sort_desc'], 'ASC' => $txt['treas_sort_asc']);
	$select = '<select name="order" id="order">';
	foreach($options as $opname => $opvalue) {
		$select .= '<option value="' . $opname . '" ' . (($opname == $sort_order) ? 'selected="selected"' : '') . '>' . $opvalue . '</option>' . "\n";
	}
	$select .= '</select>';
	echo $select;
	echo '	  </td>
	</tr>
	<tr>
	<td align="left">', $pagination, '</td>
	<td align="right">
		<input type="hidden" name="start" value="', $start, '" />
		<input type="submit" name="submit" value="', $txt['treas_sort'], '" />
	</td></tr>
	</table></form>';


    echo '<table class="tborder" width="100%" style="margin:auto;"><tr>'
	.'<td class="titlebg2" align="center"><b>&nbsp;</b></td>'
    .'<td class="titlebg2" align="center">Log Date</td>'
    .'<td class="titlebg2" align="center">Payment</td>'
    .'<td class="titlebg2" align="center">Log Entry</td></tr>';
	if (!empty($context['trans_log']))
	{
		foreach ($context['trans_log'] as $log_trans)
		{
		    echo '<tr>'
			.'<td align="left"><a href="', $scripturl.$context['treas_link'], ';sa=translogdel;lid=', $log_trans['id'], ';start=', $start, ';order=', $sort_order, ';sesc=', $context['session_id'],  '">'
			.'<img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/drop.png" onclick="return confirm(\'Are you sure you want to delete this record?\n\nAre you sure you want to do this now?\')" alt="Delete" />'
			.'</a></td>'
			.'<td align="left">', timeformat($log_trans['log_date'], treasdate()), '</td>'
	        .'<td align="left">', ($log_trans['payment_date'] > 0) ? timeformat($log_trans['payment_date'], treasdate()) : '-', '</td>'
	        ."<td align=\"left\">$log_trans[logentry]</td></tr>";
			echo '<tr><td colspan="4"><hr /></td></tr>';
		}
	}
	else
	{
		echo '<tr><td colspan="3">No data.</td></tr>';
	}
    echo '</table></div>';

}

function template_ipn_reconcile()
{
	global $context, $scripturl, $txt, $curdate, $ipn_total, $numrecs, $rval;

	echo '<div class="titlebg" style="text-align:center;"><b>', $txt['treas_financial'], ' ', $txt['treas_reconciliation'], '</b>';
	echo '<br /><b>', $txt['treas_registry_updated'], '</b><br /><br />';

	if ( $numrecs == 0 )
	{
		echo 'There are no new IPN records to import!';
	} else {
		ipnrecUpdate();
		if ($rval)
		{
			echo "<b>$numrecs</b> ", $txt['treas_registry_imported'], " $", sprintf('%0.2f', $ipn_total);
		}
		else
		{
			echo "<b> ERROR : There are $numrecs records to import, but there was an<br />error encountered during db record insertion into the Financial table.<br />Insertion FAILED!";
		}
	}

	echo '<br /><br /><button type="button" onclick="self.location.href=\'', $scripturl.$context['treas_link'], ';sa=registry\';" style="background-color:#FFCC68; color:#000068; font-weight:bold;">Return to Treasury Admin</button>';
	echo '</div>';

}

function template_read_me()
{
	global $context, $sourcedir, $txt;
	require($sourcedir.'/Treasury/TreasuryReadme.php');
}

function template_treasuryhelp()
{
	# TODO Remove - check how use native popup
	global $context, $settings, $txt, $modSettings;

	echo '<!DOCTYPE html>
<html', $context['right_to_left'] ? ' dir="rtl"' : '', '>
	<head>
		<meta charset="', $context['character_set'], '">
		<meta name="robots" content="noindex">
		<title>', $context['page_title'], '</title>
		', template_css(), '
		<script src="', $settings['default_theme_url'], '/scripts/script.js', $context['browser_cache'], '"></script>
	</head>
	<body id="help_popup">
		<div class="windowbg description">
			', $context['help_text'], '<br>
			<br>
			<a href="javascript:self.close();">Close</a>
		</div>
	</body>
</html>';
}


?>
