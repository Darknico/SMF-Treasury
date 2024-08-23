<?php
/**
 * TreasuryAdmin.template.php
 *
 * @package Treasury
 * @link https://github.com/Darknico/SMF-Treasury
 * @author Darknico <info@darknico.com>
 * @copyright Originally NukeTreasury - Financial management for PHP-Nuke Copyright (c) 2004 - Resourcez at resourcez.biz Copyright (c) 2008 - Edited by Darknico  Copyright (c) 2024 
 * @license https://spdx.org/licenses/GPL-2.0-or-later.html GPL-2.0-or-later
 *
 * @version 2.12.10
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
	echo $txt['treas_registry_IPN_number'] . ': ', $num_ipn, ' - ', $txt['treas_totalling'], ' ', $tr_targets['currency'][$tr_config['pp_currency']].sprintf('%0.2f',  $ipn_tot);
	echo '</td></tr>';
    	echo '<tr class="windowbg"><td align="center">';
	echo '<input type="submit" value="' . $txt['treas_registry_reconcile'] . '" 
		onclick="return confirm(\'' . $txt['treas_registry_reconcile_confirm'] . '\')" />';
	echo '<input type="hidden" name="sc" value="', $context['session_id'], '" />';
	echo '</td></tr></table>';
	echo '</form>';

	echo '<br><table style="margin:auto;"><tr>';
	if ( $pageNum_Recordset1 > 0 )
	{
		echo '<td><form action="', $scripturl.$context['treas_link'], ';sa=registry" method="post" style="margin:0;">'
		.'<input type="hidden" name="pageNum_Recordset1" value="0" />'
		.'<input type="hidden" name="totalRows_Recordset1" value="', $totalRows_Recordset1, '" />'
		.'<input type="submit" name="navig" value="|&laquo;" title="', $txt['treas_registry_current'], '" /></form></td>';
		echo '<td><form action="', $scripturl.$context['treas_link'], ';sa=registry" method="post" style="margin:0;">'
		.'<input type="hidden" name="pageNum_Recordset1" value="', max(0, $pageNum_Recordset1 - 1), '" />'
		.'<input type="hidden" name="totalRows_Recordset1" value="', $totalRows_Recordset1, '" />'
		.'<input type="hidden" name="sc" value="', $context['session_id'], '" />'
		.'<input type="submit" name="navig" value="&laquo;" title="', $txt['treas_registry_next_newest'], '" /></form></td>';
	} else {
		echo '<td colspan="2"></td>';
	}
	if ( $pageNum_Recordset1 < $totalPages_Recordset1 )
	{
		echo '<td><form action="', $scripturl.$context['treas_link'], ';sa=registry" method="post" style="margin:0;">'
		.'<input type="hidden" name="pageNum_Recordset1" value="', min($totalPages_Recordset1, $pageNum_Recordset1 + 1), '" />'
		.'<input type="hidden" name="totalRows_Recordset1" value="', $totalRows_Recordset1, '" />'
		.'<input type="submit" name="navig" value="&raquo;" title="', $txt['treas_registry_next_oldest'], '" /></form></td>';
		echo '<td><form action="', $scripturl.$context['treas_link'], ';sa=registry" method="post" style="margin:0;">'
		.'<input type="hidden" name="pageNum_Recordset1" value="', $totalPages_Recordset1, '" />'
		.'<input type="hidden" name="totalRows_Recordset1" value="', $totalRows_Recordset1, '" />'
		.'<input type="hidden" name="sc" value="', $context['session_id'], '" />'
		.'<input type="submit" name="navig" value="&raquo;|" title="', $txt['treas_registry_oldest'], '" /></form></td>';
	} else {
		echo '<td colspan="2"></td>';
	}
	echo '</tr></table><br>';

    echo '<table class="tborder" width="100%" style="margin:auto;"><tr>'
    .'<td class="titlebg2" align="center">&nbsp;</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_date'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_num'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_name'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_event_descr'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_amount'], '</td></tr>';

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
	  		.'<img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/edit.png" alt="', $txt['treas_record_edit'], '" /></a>&nbsp;'
			.'<a href="', $scripturl.$context['treas_link'], ';sa=finregdel;rid=', $register_treas['id'], ';sesc=', $context['session_id'], '">'
			.'<img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/drop.png" onclick="return confirm(\'' . $txt['treas_record_delete_confirm'] . '\')" alt="', $txt['treas_record_delete'], '" />'
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
    echo '</table><table width="100%"><tr><td align="right"><strong>Net Balance&nbsp;&nbsp;&nbsp;';
	echo $tr_targets['currency'][$tr_config['pp_currency']].sprintf('%0.2f', $total), '&nbsp;</strong></td>';
    echo '</tr></table>';
    echo '<form name="recedit" action="', $scripturl.$context['treas_link'], '" method="post">'
	.'<table><tr>'
    .'<td class="titlebg2" align="center">', $txt['treas_date'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_num'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_name'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_event_descr'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_amount'], '</td></tr><tr>'
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
    echo '<br>';
}

function template_treasury_donations()
{
	global $scripturl, $txt, $context, $settings;
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
    .'<td class="titlebg2" align="center"><strong>&nbsp;</strong></td>'
    .'<td class="titlebg2" align="center">', $txt['treas_taxid'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_name'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_show'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_donations_status'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_currency'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_gross'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_fees'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_settle'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_date'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_donations_rate'], '</td>'
    .'<td class="titlebg2" align="center">', $txt['treas_event'], '</td>'
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
	  		.'<img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/edit.png" alt="', $txt['treas_record_edit'], '" /></a><br>'
			.'<a href="', $scripturl.$context['treas_link'], ';sa=transregdel;did=', $donations_treas['id'], ';start=', $start, ';order=', $sort_order, ';mode=', $mode,';sesc=', $context['session_id'],  '">'
			.'<img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/drop.png" onclick="return confirm(\'' . $txt['treas_record_delete_confirm'] . '\')" alt="', $txt['treas_record_delete'], '" />'
			.'</a></td>'
			."<td align=\"center\" class=\"smalltext\">$donations_treas[txn_id]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[custom]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[option_seleczion1]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[payment_status]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[mc_currency]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[mc_gross]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[mc_fee]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[settle_amount]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[payment_date]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[exchange_rate]</td>"
	        ."<td align=\"center\" class=\"smalltext\">$donations_treas[eid]</td>"
			."</tr>";
		}
	}

	echo '</table><br>';
    echo '<form name="transedit" action="', $scripturl.$context['treas_link'], '" method="post">'
		.'<table><tr>'
	    .'<td class="titlebg2" align="center">', $txt['treas_taxid'], '</td>'
	    .'<td class="titlebg2" align="center">', $txt['treas_name'], '</td>'
	    .'<td class="titlebg2" align="center">', $txt['treas_show'], '</td>'
	    .'<td class="titlebg2" align="center">', $txt['treas_donations_status'], '</td>'
	    .'<td class="titlebg2" align="center">', $txt['treas_currency'], '</td>'
	    .'<td class="titlebg2" align="center">', $txt['treas_gross'], '</td>'
	    .'<td class="titlebg2" align="center">', $txt['treas_fees'], '</td>'
	    .'<td class="titlebg2" align="center">', $txt['treas_settle'], '</td>'
	    .'<td class="titlebg2" align="center">', $txt['treas_date'], '</td>'
	    .'<td class="titlebg2" align="center">', $txt['treas_donations_rate'], '</td>'
	    .'<td class="titlebg2" align="center">', $txt['treas_event'], '</td>'
		.'</tr><tr>'
        .'<td align="left" style="width:8px;"><input name="id" type="hidden" />'
        .'<input name="Txn_id" type="text" size="20" class="smalltext" /></td>'
        .'<td align="center"><input name="Custom" type="text" size="13" class="smalltext" /></td>'
        .'<td align="center"><input name="Option_seleczion1" type="text" size="4" class="smalltext" /></td>'
        .'<td align="center"><input name="Payment_status" type="text" size="10" class="smalltext" /></td>'
        .'<td align="center"><input name="Mc_currency" type="text" size="6" class="smalltext" /></td>'
        .'<td align="center"><input name="Mc_gross" type="text" size="6" class="smalltext" /></td>'
        .'<td align="center"><input name="Mc_fee" type="text" size="6" class="smalltext" /></td>'
        .'<td align="center"><input name="Settle_amount" type="text" size="6" class="smalltext" /></td>'
        .'<td align="center"><input name="Payment_date" type="text" size="22" class="smalltext" /></td>'
        .'<td align="center"><input name="Exchange_rate" type="text" size="6" class="smalltext" /></td>'
        .'<td align="center"><input name="Eid" type="text" size="3" class="smalltext" /></td>'
		.'</tr>';
	echo '<tr><td align="right" colspan="11"><br>'
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

	echo '<br>
	<table width="100%" style="border:1px solid;" class="windowbg">
	<tr><td><strong>', $txt['treas_taxid'], ':</strong></td><td> ', $txt['treas_taxid_description'], '</td></tr>
	<tr><td><strong>', $txt['treas_name'], ':</strong></td><td> ', $txt['treas_name_description'], '</td></tr>
	<tr><td><strong>', $txt['treas_show'], ':</strong></td><td> ', $txt['treas_show_description'], '</td></tr>
	<tr><td><strong>', $txt['treas_donations_status'], ':</strong></td><td> ', $txt['treas_donations_status_description'], '</td></tr>
	<tr><td><strong>', $txt['treas_currency'], ':</strong></td><td> ', $txt['treas_currency_description'], '</td></tr>
	<tr><td><strong>', $txt['treas_gross'], ':</strong></td><td> ', $txt['treas_gross_description'], '</td></tr>
	<tr><td><strong>', $txt['treas_fees'], ':</strong></td><td> ', $txt['treas_fees_description'], '</td></tr>
	<tr><td><strong>', $txt['treas_settle'], ':</strong></td><td> ', $txt['treas_settle_description'], '</td></tr>
	<tr><td><strong>', $txt['treas_date'], ':</strong></td><td> ', sprintf($txt['treas_date_description'], timeformat(time(), treasdate())), '</td></tr>
	<tr><td><strong>', $txt['treas_donations_rate'], ':</strong></td><td> ', $txt['treas_donations_rate_description'], '</td></tr>
	<tr><td><strong>', $txt['treas_event'], ':</strong></td><td> ', $txt['treas_event_description'], '</td></tr>
	</table></div>';
}

function template_treasury_totals() {
	global $scripturl, $boardurl, $txt, $context, $settings, $tr_config;
	global $start, $sort_order, $maxRows, $mode, $totalRows, $search_time, $search_event;
	global $num, $total, $fees, $net, $settled, $periods, $periode;

	$pagination = treasuryPages($context['treas_link'] . ';sa=donortotals;search_time=' . $search_time . ';search_event=' . $search_event . ';mode=' . $mode . ';order=' . $sort_order, $totalRows, $maxRows, $start) . '&nbsp;';

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
	$select4 .= '<option value="0">'.$txt['treas_no_event'].'</option>';
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
	
    <strong>&raquo;</strong> ', $txt['treas_calendar_from'], ' 
    <input type="date" name="periods" value="', ($periods >0 ? strftime('%Y-%m-%d', $periods) : ''), '" size="10" /> 

	&nbsp;', $txt['treas_calendar_to'], '&nbsp;
    <input type="date" name="periode" value="', ($periode > 0 ? strftime('%Y-%m-%d', $periode) : ''), '" size="10" /> 
    
	<strong>&laquo;</strong>&nbsp;&nbsp;&nbsp;&nbsp; 
	<input type="hidden" name="sc" value="', $context['session_id'], '" />
	<input type="hidden" name="start" value="', $start, '" />
	<input type="submit" name="submit" value="', $txt['treas_change'], '" style="margin:0;" />&nbsp;</span>
	</td></tr>
	</table></form>';

    echo '<table width="100%" class="tborder"><tr class="titlebg2">'
    .'<td align="left"><strong>', $txt['treas_name'], '</strong></td>'
    .'<td align="center"><strong>', $txt['treas_currency'], '</strong></td>'
    .'<td align="right"><strong>', $txt['treas_gross'], '</strong></td>'
    .'<td align="right"><strong>', $txt['treas_fees'], '</strong></td>'
    .'<td align="right"><strong>', $txt['treas_net'], '</strong></td>'
    .'<td align="right"><strong>', $txt['treas_settle'], '</strong></td>'
    .'<td align="center"><strong>', $txt['treas_last_date'], '</strong></td>'
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
	echo '</table><br>';

	$period = '';
	foreach($options2 as $opname2 => $opvalue2) {
		$period .= ($opname2 == $search_time) ? $opvalue2 : '';
	}
    echo '<table class="tborder" style="margin:auto; width:50%;">'
	.'<tr class="titlebg2"><td colspan="6" align="center"><strong>', $txt['treas_summary_of'], ' ', ($search_event ? $txt['treas_all_donations'] : $period), '</strong></td></tr>'
    .'<tr class="windowbg">'
	.'<td><strong>', $txt['treas_type'], '</strong></td><td align="right"><strong>', $txt['treas_num'], '</strong></td><td align="right"><strong>', $txt['treas_total'], ' ', $tr_config['pp_currency'], '</strong></td>'
	.'<td align="right"><strong>', $txt['treas_gross'], '</strong></td><td align="right"><strong>', $txt['treas_fees'], '</strong></td><td align="right"><strong>', $txt['treas_net'], '</strong></td>'
	.'</tr>'
	.'<tr>'
	.'<td class="windowbg"><strong>', $txt['treas_amount'], '</strong></td><td align="right" class="windowbg2">', $num, '</td><td align="right" class="windowbg2">', $settled, '</td>'
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

	echo '</dl><hr><dl class="settings">';
	
	$time_durations = array('0' => $txt['treas_monthly'], '1' => $txt['treas_quarterly'], '2' => $txt['treas_half_yearly'], '3' => $txt['treas_yearly']);
	selectBox('duration', $txt['treas_duration'] , $tr_config['duration'], $time_durations, '1');
	showYNBox('show_registry', $txt['treas_show_registry'] , '', '', '1');
	ShowTextBox('don_num_don', $txt['treas_num_donors'] , '', '4', '1');
	showTextBoxImage('don_button_submit', $txt['treas_submit_button'] , '', '15', '1');
	showImgXYBox('don_sub_img_width', 'don_sub_img_height', $txt['treas_image_dims'] , '2', '1');

	echo '</dl><hr><dl class="settings">';

	showTextBox('don_name_prompt', $txt['treas_username_prompt'] , '', '60', '1');
	showTextBox('don_name_yes', $txt['treas_username_yes'] , '', '60', '1');
	showTextBox('don_name_no', $txt['treas_username_no'] , '', '60', '1');

	if ($tr_config['event_active']) {
		echo '<dt><span style="color:red;">'.$txt['treas_event_beware_message'].'</span></dt><dd></dd>';
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
		$row1 .= '<td style=\"text-align:center;\" class="titlebg">' . timeformat(mktime(0, 0, 0, $block_month, 2, 0), '%b') . '</td>';
		$row2 .= "<td><input style=\"text-align:center;\" size=\"4\" name=\"var_goal-$block_month\" type=\"text\" value=\"$block_goal\" /></td>";
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
		$row1 .= "<td style=\"text-align:center;\" class=\"titlebg\">$amountn</td>";
		$row2 .= "<td><input style=\"text-align:center;\" size=\"4\" name=\"var_don_amount-$amountn\" type=\"text\" value=\"$amounts\" /></td>";
	}
	$row1 .= '</tr>';
	$row2 .= '</tr>';
	echo $row1, ' ', $row2;
	echo '</table></dt><dd></dd>';
	
	showTextBox('don_amt_checked', $txt['treas_donation_default'] , '300', '4', '1');
	showYNBox('don_amt_other', $txt['treas_donation_other_amounts'], '', '', '1');
	
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
	ShowTextBox('pp_notify_url', $txt['treas_pp_notify_file'] . '<br><a href="' . $boardurl . '/ipntreas.php?dbg=1" target="_blank"><strong><i>' . $txt['treas_pp_test_ipn'] . '</i></strong></a> ipntreas.php ', '', '50', '1');
	showTextBox('pp_ty_url', $txt['treas_pp_return_file'] . '<br>index.php?action=profile ', '', '50', '1');
	showTextBox('pp_cancel_url', $txt['treas_pp_cancel_file'] . '<br>index.php?action=treasury ', '', '50', '1');
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
	echo '<div class="cat_bar"><h3 class="catbg">' . $txt['treas_block_config'] . '</h3></div>
	<div class="windowbg noup"><dl class="settings">';
	ShowTextBox('dm_name_length', $txt['treas_block_username'] , '', '4', '1');
	showTextBox('dm_num_don', $txt['treas_block_number'] ,  '', '4', '1');
	showTextBoxImage('dm_button', $txt['treas_block_image'] , '', '15', '1');
	showImgXYBox('dm_img_width', 'dm_img_height',  $txt['treas_block_image_size'] , '4', '1');

	echo '</dl><hr><dl class="settings">';

	showYNBox('dm_show_date', $txt['treas_block_dates'] , '', '', '1');
	showYNBox('dm_show_amt', $txt['treas_block_amounts'] , '', '', '1');
	
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
	
	echo '<div class="cat_bar"><h3 class="catbg">' . $txt['treas_events'] . '</h3></div>
		<div class="windowbg noup">';
		
		if ($tr_config['event_active']) {
			echo '<dl><br><span style="color:red;">'.$txt['treas_event_beware_message'].'</span></dl>';
		}
		
	echo' <dl class="settings">';
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
	echo '</form></dl>';

	# Events paging
	$pagination = treasuryPages($context['treas_link'] . ';sa=configevents;mode=' . $mode . ';order=' . $sort_order, $totalRows, $maxRows, $start) . '&nbsp;';
	echo '<form method="post" action="', $scripturl.$context['treas_link'], ';sa=configevents">
	<table width="100%" cellspacing="2" cellpadding="2" style="border:1px solid;" class="windowbg">
	<tr>
	<td align="left">', sprintf($txt['treas_page_of'], ( floor( $start / $maxRows ) + 1 ), ceil( $totalRows / $maxRows )), '</td>
	  <td align="right" style="white-space:nowrap;">', $txt['treas_select_sort'], ':&nbsp;';
	$options = array('lastevent' => $txt['treas_event_sort_last_event'], 'target' => $txt['treas_event_sort_target'], 'actual' => $txt['treas_event_sort_actual']);
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
			.'<a href="', $scripturl.$context['treas_link'], ';sa=configevents;op=edit;eid=', $events_treas['eid'], ';start=', $start, ';sesc=', $context['session_id'],  '"><img style="border:0; width:12px; height:13px;" src="', $settings['default_images_url'], '/Treasury/edit.png" alt="Edit" /></a><br>'
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
	echo '</table><br>';

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
		.'<td valign="top"><input name="date_start" type="date" size="11" class="smalltext" value="', $date_start, '"/></td>'
		.'<td valign="top"><input name="date_end" type="date" size="11" class="smalltext" value="', $date_end, '" /></td>'
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
		<input type="submit" name="update" style="width:130px;" value="'.$txt['treas_event_update_event'].'" /></td>
		</tr>';
	} else {
		echo '
		<input type="hidden" name="sa" value="eventsadd" />
		<input type="submit" name="save" style="width:130px;" value="'.$txt['treas_event_add_event'].'" class="button" /></td>
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
	.'<td class="titlebg2" align="center"><strong>&nbsp;</strong></td>'
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

	echo '<div class="titlebg" style="text-align:center;"><strong>', $txt['treas_financial'], ' ', $txt['treas_reconciliation'], '</strong>';
	echo '<br><strong>', $txt['treas_registry_updated'], '</strong><br><br>';

	if ( $numrecs == 0 )
	{
		echo $txt['treas_registry_reconcile_norecords'];
	} else {
		ipnrecUpdate();
		if ($rval)
		{
			echo "<strong>$numrecs</strong> ", $txt['treas_registry_imported'], " $", sprintf('%0.2f', $ipn_total);
		}
		else
		{
			echo "<strong>", sprintf($txt['treas_registry_reconcile_error'], $numrecs), "</strong>";
		}
	}

	echo '<br><br>
		<button type="button" onclick="self.location.href=\'', $scripturl.$context['treas_link'], ';sa=registry\';" style="background-color:#FFCC68; color:#000068; font-weight:bold;">
		', $txt['treas_return_treasury_admin'], '
		</button>';
	echo '</div>';

}

function template_read_me()
{
	global $context, $sourcedir, $txt;
	require($sourcedir.'/Treasury/TreasuryReadme.php');
}

/*Temporary removed - evaluate if is necessary...

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
}*/


?>
