<?php
/**
 * Treasury.template.php
 *
 * @package Treasury
 * @link https://github.com/Darknico/SMF-Treasury
 * @author Darknico <info@darknico.com>
 * @copyright Originally NukeTreasury - Financial management for PHP-Nuke Copyright (c) 2004 - Resourcez at resourcez.biz Copyright (c) 2008 - Edited by Darknico  Copyright (c) 2024 
 * @license https://spdx.org/licenses/GPL-2.0-or-later.html GPL-2.0-or-later
 *
 * @version 2.12.5
 */

function template_main()
{
	global $scripturl, $boardurl, $txt, $settings, $context, $modSettings;
	global $tr_config, $tr_targets, $period, $is_donor, $net_registry, $row_Recordset3;

	$userid = $context['user']['is_guest'] ? 0 : $context['user']['id'];
	$username = $context['user']['is_guest'] ? $txt['treas_anonymous'] : $context['user']['name'];

	// Get currency symbol
	$currency_symbol = $tr_targets['currency'][$tr_config['pp_currency']];

	// Fill out some image dimension tags
	$don_top_image_dims = is_numeric($tr_config['don_top_img_width']) ? " width:$tr_config[don_top_img_width]px;" : '';
	$don_top_image_dims .= is_numeric($tr_config['don_top_img_height']) ? " height:$tr_config[don_top_img_height]px;" : '';
	$don_sub_image_dims = is_numeric($tr_config['don_sub_img_width']) ? " width:$tr_config[don_sub_img_width]px;" : '';
	$don_sub_image_dims .= is_numeric($tr_config['don_sub_img_height']) ? " height:$tr_config[don_sub_img_height]px;" : '';

	if ($tr_config['event_active'] && isset($context['info_event']))
	{
		foreach ($context['info_event'] as $event_info)
		{
			$row_Recordset3['due_by'] = !empty($event_info['date_end']) ? timeformat($event_info['date_end'], '%b %d') : $txt['treas_event_open'];
			$period[2] = $txt['treas_event_campaign'];
			$period[3] = $event_info['target'];
			$context['don_text'] = $event_info['description'];
			$tr_config['don_text_title'] = $event_info['title'];
			$eventid = $event_info['eid'];
		}
	}
	
	echo '
	<div class="cat_bar">
		<h3 class="catbg">
			<span class="main_icons treasury"></span>
			', $txt['treasury_menu'], '
		</h3>
	</div>

	<div class="roundframe noup">';
		echo $context['don_text'], '

	  <hr />
          
		    <form action="', ($tr_config['pp_sandbox'] ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr'), '" method="post">
	  			  
			<input type="hidden" name="cmd" value="_xclick" />
			<input type="hidden" name="business" value="', $tr_config['receiver_email'], '" />
			<input type="hidden" name="item_name" value="', $tr_config['pp_itemname'], '" />
			<input type="hidden" name="item_number" value="', $tr_config['pp_item_num'], '" />';

	echo '<dl class="settings">
		<dt><strong>', $txt['treas_select_amount'], '</strong></dt>
		<dd>';	
	
	$don_amounts = array();
	foreach($tr_targets['don_amount'] AS $subtype => $value) {
		if( is_numeric($value) && $value > 0 ) {
			$don_amounts[] = $value;
		}
	}
	if (count($don_amounts) == 1)
	{
		echo '<input type="hidden" name="amount" value="', $don_amounts[0], '" />
			<strong>', $txt['treas_donation_amount'], '&nbsp;', $don_amounts[0], '</strong><br>';
	}
	else
	{
		echo ($tr_config['don_amt_other'] ? '<input type="radio" name="amount" value="" /> ' . $txt['treas_other'] . '&nbsp; 
			<input type="text" name="amount" value="0.00" size="6" /><br>' : '');	

				
		$i = 0;
		foreach($don_amounts AS $subtypes => $values) {
			if( is_numeric($values) && $values > 0 ) {
				$checked = ($subtypes == $tr_config['don_amt_checked']-1) ? 'checked="checked"' : '';
				echo '<input type="radio" name="amount" value="', $values, '" ', $checked, ' /> ', $values.( ($i == 4 || $i == 9 || $i == 14 ) ? '<br>' :  ' ' );
			}
			$i++;
		}
	
					
	}	

	echo	  '</dd></dl>
		<dl class="settings">';

	if ($tr_config['pp_currency2'])
	{
		echo '<dt><strong>', $txt['treas_choose_currency'], '&nbsp;</strong></dt>';
		
		echo '<dd>';
		
		$i = 0;
		foreach($tr_targets['currency'] AS $subtype => $value) {
			$checked = ($tr_config['pp_currency'] == $subtype) ? 'checked="checked"' :  '';
			echo '<input type="radio" name="currency_code" value="', $subtype, '" ', $checked, ' /> ', $value, ' ', $subtype.( ($i == 2 || $i == 5 ) ? '<br>' : ' ' );
			$checked = '';
			$i++;
		}
		echo '</dd>';		
	}
	else
	{
		echo '<dt><strong>', $txt['treas_site_currency'], '</strong></dt>';
		echo '<dd>', $tr_config['pp_currency'], '<input type="hidden" name="currency_code" value="', $tr_config['pp_currency'], '" /></dd>';
	}

	echo	 '</dl>
		
				<input type="hidden" name="custom" value="', $username, '" />
				<input type="hidden" name="on1" value="User Name" />';
				
				if (!$context['user']['is_guest'])
				{
					echo '<input type="hidden" name="custom" value="', $username, '" />
					<input type="hidden" name="os1" value="', $username, '" />';
				}
				else
				{
					echo' <dl class="settings">';
					echo '<dt><strong>', $txt['treas_not_logged'], '</strong></dt>
					<dd><strong>', $txt['treas_username'], ':</strong> <input type="text" name="custom" size="20" />
					<input type="hidden" name="os1" value="Guest" /><dd></dl>';
				}
				echo '<input type="hidden" name="on0" value="', (!empty($eventid) ? $eventid : 0), '" />';
				
				echo' <dl class="settings">';
				echo'<dt><strong>', $tr_config['don_name_prompt'], '</strong></dt>
				<dd><select name="os0" class="smalltext">
				  <option selected="selected" value="Yes">', $tr_config['don_name_yes'], '</option>
				  <option value="No">', $tr_config['don_name_no'], '</option>
				</select><dd></dl>';
				
				echo' <dl class="settings">';				
				$pp_lang = array('DE' => 'Deutsch', 'NL' => 'Dutch', 'US' => 'English', 'ES' => 'Espa&ntilde;ol', 'FR' => 'Fran&ccedil;ais', 'IT' => 'Italiano');
				
				echo '<dt><strong>', $txt['treas_paypal_lang'], '</strong></dt>
				<dd><select name="lc" class="smalltext">';
				foreach($pp_lang AS $lc_lang => $lc_val) {
					$lc_select = ($tr_config['pp_language'] == $lc_lang) ? ' selected="selected"' :  '';
					echo '<option value="', $lc_lang, '"', $lc_select, '>', $lc_val, '</option>';
					$lc_select = '';
				}
				echo '</select>
				<input type="image" src="', $settings['default_images_url'], '/Treasury/', $tr_config['don_button_submit'], '" name="I1"  style="background:transparent;box-shadow:none;border:0;', $don_sub_image_dims, '" />
				</dd>';
	echo	  '
				<input type="hidden" name="no_shipping" value="1" />
				<input type="hidden" name="cn" value="Comments" />
				<input type="hidden" name="image_url" value="', $settings['default_images_url'], '/Treasury/', $tr_config['pp_image_url'], '" />
				<input type="hidden" name="notify_url" value="', $boardurl, '/', $tr_config['pp_notify_url'], '" />
				<input type="hidden" name="cancel_return" value="', $boardurl, '/', $tr_config['pp_cancel_url'], '" />
				<input type="hidden" name="return" value="', $boardurl, '/', $tr_config['pp_ty_url'], '&u=', $userid, '&area=showdonations" />
				<input type="hidden" name="rm" value="2" />
				

              
            </form>
            
 </div>';
 
 
	 echo'	
	 <div class="cat_bar">
		<h3 class="catbg">
			', $tr_config['don_text_title'], '
		</h3>
		</div>
	<div class="roundframe noup">


	<dl class="settings">
	<dt>';

	// Do we wish to display the targets and progress section?
	if ($tr_config['dm_show_targets'] || $tr_config['dm_show_meter']) {

		$dm_left = sprintf('%.02f', $period[3] - ($tr_config['don_show_gross'] ? $row_Recordset3['receipts'] : $row_Recordset3['net']));
		$pp_fees = sprintf('%.02f', $row_Recordset3['receipts'] - $row_Recordset3['net']);
		$donatometer = ($period[3] > 0) ? round((100 * ($tr_config['don_show_gross'] ? $row_Recordset3['receipts'] : $row_Recordset3['net']) / $period[3]), 0) : '0';

		$donormeter = 
		'<div style="width:100%; height:20px; background-color:#FFFFFF; border:1px solid green;">'
		.($donatometer < 15 
		? '<div style="width:'.$donatometer.'%; height:16px; margin:1px; background-color:green;"></div><div style="font-size:11px; margin-top:-17px; text-indent:'.$donatometer.'%; color:green;">&nbsp;'.$donatometer.'%</div>' 
		: ($donatometer > 99 ? '<div style="height:16px; margin:1px; background-color:blue;"><span style="font-size:11px; float:right; color:#FFFFFF;">'.$donatometer.'%&nbsp;</span></div>' : '<div style="width:'.$donatometer.'%; height:16px; margin:1px; background-color:green;"><span style="font-size:11px; float:right; color:#FFFFFF;">'.$donatometer.'%&nbsp;</span></div>')).'</div>';


		if ($tr_config['dm_show_targets']) {
		echo'
			<table style="width:100%; margin:auto;" class="windowbg2" cellpadding="0" cellspacing="0">
				<tr>
					<th align="left" class="smalltext">', $txt['treas_goal'], ' ', $period[2], '</th>
					<td align="right" class="smalltext">', $currency_symbol.sprintf('%.02f', $period[3]), '</td>
				</tr>
				<tr>
					<th align="left" class="smalltext">', $txt['treas_due_date'], '</th>
					<td align="right" class="smalltext">', $row_Recordset3['due_by'], '</td>
				</tr>	
				<tr>
					<th align="left" class="smalltext">', $txt['treas_total_receipts'], '</th>
					<td align="right" class="smalltext">', $currency_symbol.sprintf('%.02f', $row_Recordset3['receipts']), '</td>
				</tr>';
				if ($tr_config['don_show_gross'] == 0) 
				{
					echo'
					<tr>
						<th align="left" class="smalltext">', $txt['treas_paypal_fees'], '</th>
						<td align="right" class="smalltext">', $currency_symbol.$pp_fees, '</td>
					</tr>
					<tr>
						<th align="left" class="smalltext">', $txt['treas_net_balance'], '</th>
						<td align="right" class="smalltext">', $currency_symbol.sprintf('%.02f', $row_Recordset3['net']), '</td>
					</tr>';
				}
				echo'
				<tr>
					<th align="left" class="smalltext">', (($dm_left >= 0 ) ? $txt['treas_below_goal'] : $txt['treas_above_goal']), '</th>
					<td align="right" class="smalltext">', $currency_symbol.sprintf('%.02f', abs($dm_left)), '</td>
				</tr>
				<tr>
					<th align="left" class="smalltext">', $txt['treas_site_currency'], '</th>
					<td align="right" class="smalltext">', $tr_config['pp_currency'], '</td>
				</tr>';
				if ($tr_config['dm_show_meter'])
				{
					echo'
					<tr>
						<td colspan="2">', $donormeter, '</td>
					</tr>';
				}
		echo'</table>';
		}

	}

	echo'</dt>
	<dd>			


	      
    	    <table style="border-collapse:collapse; padding:5px;" cellpadding="0" cellspacing="0">
				<tr>
					<th style="width:100%;" colspan="4" class="smalltext"><strong>', $txt['treas_thanks_donated'], '</strong></th>
				</tr>
  	          <tr>
                <td align="left" class="smalltext">', $txt['treas_name'], '</td>
                <td align="center" class="smalltext">', ($tr_config['don_show_amt'] ? $txt['treas_amount'] : ''), '</td>
                <td align="center" class="smalltext">', ($tr_config['don_show_date'] ? $txt['treas_date'] : ''), '</td>
                <td align="right" class="smalltext">', ($tr_config['don_show_amt'] ? $tr_config['pp_currency'] : ''), '</td>
              </tr>
			  <tr>
			    <td colspan="4"><hr /></td>
			  </tr>';

	if (isset($context['rows_donators']))
	{
		foreach ($context['rows_donators'] as $donators_rows)
		{
			if ( $donators_rows['amt'] > 0 )
			{
				$doname = (strcmp($donators_rows['showname'], 'Yes') == 0) ? $donators_rows['name'] : $txt['treas_anonymous'];
				$doname = (($donators_rows['name'] == $context['user']['name'] || allowedTo('admin_treasury')) && $donators_rows['user_id'] > 0) ? '<a href="' . $scripturl . '?action=profile;u=' . $donators_rows['user_id'] . ';area=showdonations" style="text-decoration:underline;">' . $doname . '</a>' : $doname;

				echo '<tr>';
				echo '<td align="left" class="smalltext"> ';
				echo $doname;
				echo '</td>';
				echo '<td align="center" class="smalltext">';
				if ( $tr_config['don_show_amt'] )
				{
					echo $donators_rows['symbol'].($donators_rows['currency'] == 'JPY' ? round($donators_rows['amt'],0) : $donators_rows['amt']), ' (', $donators_rows['currency'], ')';
				}
				echo '</td>';
				echo '<td align="center" class="smalltext" style="height:1px;">';
				if ( $tr_config['don_show_date'] )
				{
					echo $donators_rows['date'];
				}
				echo '</td>';
				if ( $tr_config['don_show_amt'] )
				{
					if ($donators_rows['settled'] > '0')
					{
						echo '<td align="right" class="smalltext">', $donators_rows['settled'], '</td>';
					} else {
						echo '<td align="right" class="smalltext">', $donators_rows['amt'], '</td>';
					}
				}
				echo '</tr>';
			}
		}
	}
	echo '</table></dd></dl></div>';


	// Registry			
	if ($tr_config['show_registry'] && $is_donor)
	{
		if (isset($context['show_registry']))
		{
	        echo '<div class="roundframe">';
	        	
			echo '<table style="border-collapse:collapse; margin:auto; padding:5px; width:50%">';
			echo '<tr class="windowbg"><td colspan="3" align="center"><strong>', $txt['treas_income_expend'], '</strong></td></tr>';
			echo '<tr class="windowbg"><td><strong>', $txt['treas_item'], '</strong></td><td align="center"><strong>', $txt['treas_number'], '</strong></td><td align="center"><strong>', $txt['treas_total'], '</strong></td></tr>';
			foreach ($context['show_registry'] as $registry_show)
			{
				echo '<tr class="windowbg"><td>', $registry_show['name'], '</td><td align="center">', $registry_show['number'], '</td><td align="right">', sprintf('%.02f', $registry_show['total']), '</td></tr>';
			}
			echo '<tr><td><strong>', $txt['treas_net_balance'], '</strong></td><td></td><td align="right">', sprintf('%.02f', $net_registry), '</td></tr>';
			echo '</table>';
			echo '</div>';
		}
	}

}

function template_paypal_return()
{
	global $scripturl, $txt, $context;
	global $first_name, $last_name, $custom, $option_seleczion1, $item_name, $payment_amount, $payment_currency, $total;

	echo '<div style="text-align:center;padding-bottom:10px;" class="tborder"><h4>', $txt['treas_appreciate_donation'], ' ', $custom, '.</h4>';
	echo $txt['treas_thanks'], '<br>';
	echo '<div style="width:30%; margin:auto;"><br>
      <div class="titlebg">', $txt['treas_pay_details'], '</div>
	  <ul style="text-align:left;">
      <li>', $txt['treas_name'], ': ', $first_name, ' ', $last_name, '</li>
      <li>', $txt['treas_show'], ': ', $option_seleczion1, '</li>
      <li>', $txt['treas_item'], ': ', $item_name, '</li>
      <li>', $txt['treas_amount'], ': ', $payment_amount, ' ', $payment_currency, '</li></ul>';
	if (isset($total))
	{
		echo '<br><ul style="text-align:left;">';
		foreach ($total AS $currency => $ammount) {
			echo '<li>', $txt['treas_total'], '&nbsp;', $currency, ': ', substr($ammount,0,-2), '.', substr($ammount,-2), '</li>';
		}
	}
	echo '</ul>';
	echo '<button type="button" onclick="self.location.href=\'', $scripturl, '?action=treasury\';" style="background-color:#FFCC68; color:#000068; font-weight:bold; margin:auto;">', $txt['treas_continue'], '</button><br><br></div></div>';
}

function template_treasury_profile()
{
	global $context, $txt, $settings, $webmaster_email;
	global $donor_result, $site_total, $ttotal, $tr_config;

	if ($tr_config['date_format'] == 0) { $treas_date = '%Y-%m-%d %H:%M:%S'; }
	elseif ($tr_config['date_format'] == 1) { $treas_date = '%Y/%m/%d %H:%M:%S'; }
	elseif ($tr_config['date_format'] == 2) { $treas_date = '%d-%m-%Y %H:%M:%S'; }
	elseif ($tr_config['date_format'] == 3) { $treas_date = '%d/%m/%Y %H:%M:%S'; }
	
	echo '
	<div class="cat_bar">
		<h3 class="catbg">
			<span class="main_icons treasury"></span>
			', $txt['treasury_menu'], '
		</h3>
	</div>
		
	<div class="roundframe noup">';	

    if ($donor_result)
	{
		echo '
		<table width="90%" cellspacing="1" cellpadding="4" style="margin:auto; border:0;" class="bordercolor">
			<tr class="titlebg">
				<td colspan="2" style="height:26px;">
					&nbsp;<img src="', $settings['images_url'], '/icons/profile_hd.png" alt="" align="top" />&nbsp;', $txt['treas_show_donations'], '
					</td>
			</tr>
			<tr class="windowbg2">
				<td colspan="2">&nbsp;<strong>', $txt['treas_last_ten_donations'], ' ', $context['member']['name'], ':</strong>';
		echo '<div style="text-align:left;"><br>';
		foreach ($context['my_donations'] as $donations_mine) {
			$paydate = timeformat($donations_mine['payment_date'], $treas_date);
            echo '<span style="width:10px; padding-left:27px; float:left;">&#8226;</span><span style="width:80px; float:left; text-align:right;">', $donations_mine['mc_gross'], ' ', $donations_mine['mc_currency'], '</span>&nbsp;&raquo;&nbsp;', $paydate, ' (', $donations_mine['payment_status'], ')<br>';
		}
        echo '<br>';
		echo '<strong>', $txt['treas_total_site_currency'], ':</strong> ', $site_total, ' - ', $txt['treas_thank_you'], '</div>';

		$summary = '';
		if (isset($ttotal))
		{
			foreach ($ttotal AS $currency => $ammount) {
				$summary .= '<li>' . $currency . ': ' . $ammount . '</li>';
			}
		}
		echo "<ul>$summary</ul>";
		echo '</td>
			</tr>
		</table>';
	}
	else
	{
		echo '
		<table width="90%" cellspacing="1" cellpadding="4" style="margin:auto; border:0;" class="bordercolor">
			<tr class="titlebg">
				<td style="height:26px;">
					&nbsp;<img src="', $settings['images_url'], '/icons/profile_hd.png" alt="" align="top" />&nbsp;', $txt['treas_show_donations'], '
				</td>
			</tr>
			<tr class="windowbg2">
				<td><br>', $txt['treas_no_donations'],' ', $context['member']['name'], '.<br>
				</td>
			</tr>
		</table>';
	}
	echo '
	<table width="90%" cellspacing="1" cellpadding="4" style="margin:auto; border:0;" class="bordercolor">
		<tr class="windowbg2">
			<td>
			', $txt['treas_paypal_confirm'], '<br><br/>
			</td>
		</tr>
	</table>
	</div>';
}
?>