<?php

$txt['treasury_readme_installedVersion'] = 'Installed version';
$txt['treasury_readme_checkVersionVersion'] = 'Check latest version on';

// title
$txt['treasury_readme_info_title'] = 'Treasury Information';
$txt['treasury_readme_treasSetup_title'] = 'Treasury Module Setup';
$txt['treasury_readme_paypalSetup_title'] = 'PayPal Account Setup';
$txt['treasury_readme_operationalNote_title'] = 'Operational Notes';
$txt['treasury_readme_unistallNote_title'] = 'Un-Install Notes';

// description
$txt['treasury_readme_info_description'] = 
'Treasury allows you to receive and manage donations through PayPal.<br>
In this page you can read all information to use.';

$txt['treasury_readme_treasSetup_description'] = 
'<ol>
<li>Since you are here, I presume you have installed successfully, and followed the instructions provided in the package notes.<br><br></li>
<li>In the <a href="%2$ssa=configpaypal" style="text-decoration:underline;"><strong>PayPal Config</strong></a> tab, ensure you enter your own PayPal email ID (and your PayPal primary currency) - it simply will not work with the default email ID from install.<br><br></li>
<li>If you know how to use the PayPal "sandbox", you  can test all you like after setting up a (free) developer account with PayPal.  The sandbox was used to debug this module.<br>If not, get a friend to make some test donations, unless you have a second PayPal account to use.  You can refund these through your PayPal account, without any fees or penalties.<br><br></li>
<li>Check the other options in admin for setting up the <a href="%2$ssa=config" style="text-decoration:underline;"><strong>Module</strong></a> appearance (and <a href="%2$ssa=configblock" style="text-decoration:underline;"><strong>Block</strong></a> for Portal users).<br><br></li>
<li>You will need to setup your viewing and admin <a href="%1$s?action=admin;area=permissions" style="text-decoration:underline;"><strong>permissions</strong></a> for each member group.<br><br></li>
<li>Should you wish to change the name that appears in your menu bar from Donations to something else, you can edit the value for $txt[\'treasury_menu\'] in "Themes/default/languages/Treasury/Treasury.english.php".<br><br></li>
<li>Your monthly goals are displayed on the <a href="%1$s?action=treasury" style="text-decoration:underline;"><strong>Treasury</strong></a> page.<br><br></li>
</ol>';

$txt['treasury_readme_paypalSetup_description'] = 
'If you choose to ignore this advice, ask PayPal - they get paid to answer your questions.
I don\'t mean to be rude, but the info is provided for a good reason - so you can help yourself.<br><br>
If you have problems and do not have full access to the PayPal account profile, do not contact us - it is impossible to problem solve when you cannot directly verify account settings or changes.<br><br>
I leave your selection of a PayPal account entirely up to you - I will <strong>not</strong> provide advice on this issue.
After a previous unpleasant experience, I will not leave myself open to absurd threats of legal action.<br>
<ol>
<li>Treasury requires IPN settings in your PayPal account "Profile".<br>
&#8226; Set \'IPN\' to \'On\' in "Instant Payment Notification Preferences".<br/>
&#8226; This will also require a URL to be entered - anything will do, but not blank.<br>
<br>
The URL you set here is NOT important as Treasury operates from its own Notify and Return URLs which ignore, and are independent of, your PayPal settings.<br>
&#8226; <strong>Why?</strong> If you already have an IPN setting activated for some other program, it will continue to function for that program.<br>
&#8226; <strong>Example?</strong> If you have already set your IPN URL so that you can use, say, Paid Subscriptions, then you can leave the URL on PayPal as it is, and still use Treasury.<br><br></li>
<li>You should also modify "Payment Receiving Preferences" in your "Profile" area.<br>
&#8226; Check your option for "Block payments sent to me in a currency I do not hold:".<br>
&#8226; You should set this to the second option "No, accept them and convert them...".<br>
<br><strong>Failure</strong> to do this means you will have to manually confirm each payment within your PayPal account and the donation will NOT show on your site.<br><br></li>
<li>Treasury settings in "Website Payment Preferences".<br>
  You need to set,<br>
&#8226; Set/Leave \'Auto Return\' to \'On\', <strong>repeat \'On\'</strong> in "Website Payment Preferences".<br>
&#8226; Set/Leave \'Payment Data Transfer\' to \'Off\' in "Website Payment Preferences".<br><br></li>
<li>Settings in "Currency Balances".<br>
These shouldn\'t need changing - PayPal default is fine - a primary currency which is Open and all other currencies Closed.<br>
If you do not have special reasons for operating with multiple open currencies, DO NOT fiddle!<br>
If you do have special reasons, you <strong>will not receive exchange rate and settle amounts from PayPal</strong> for non-primary currencies which you have Open.<br>
You WILL have to manually edit all Treasury transactions for currencies you receive that are not your Primary Currency!<br><br></li>
</ol>';

$txt['treasury_readme_operationalNote_description'] = 
'<ol>
<li>The <a href="%2$ssa=registry" style="text-decoration:underline;"><strong>Registry</strong></a> tab allows you to manage your site\'s <strong>receipts &amp; expenses</strong> with basic entries to record them.  You can also total your most recent user contributions as a single entry in the register by <a href="%2$ssa=registry" style="text-decoration:underline;"><strong>Reconciling</strong></a> your paypal receipts.  Should you wish to provide full disclosure to your donors, you can elect to display a summary of your Income &amp; Expenses to them.<br><br></li>
<li>The <a href="%2$ssa=configblock" style="text-decoration:underline;"><strong>Block</strong></a> is provided for Portal installations where you can have a side-block.  It allows you to display your current monthly donation goal and what funds have been received towards that goal. Display of Goals and/or Donormeter is now selectable. It also lists the users who have contributed in the current month.<br>The Treasury main page already provides all of this information.<br><br></li>
<li>There are help tips for admin options that describe their use.<br>Just click the question mark for a pop-up to see the descriptions.<br><br></li>
<li>Treasury will look at varying time periods, depending on the option you choose - monthly, quarterly, half yearly and yearly.  Alternatively, you can choose to manage donations on an event basis, with set targets for each donation campaign.<br><br></li>
<li>Users can view their personal donation summary through their <a href="%1$s?action=profile;area=showdonations;u=1" style="text-decoration:underline;"><strong>Profile</strong></a> - viewable only by the user or admin.<br><br></li>
<li>Treasury will also account for any refunds that you process - they will automatically cancel out the original donation and a record will be saved in the Transaction Log.  The donor\'s profile will show the original donation as well as the refund.<br><br></li>
<li>Got an Internal Server <strong>Error 500</strong> when PayPal returns to your site?<br>Check file permissions for %3$s/ipntreas.php are 644 or 755 (CHMOD to 644 if they are 777 or 666).<br>Similarly if you are using %3$s/Sources/Treasury/DonationBlock.php under a Portal.<br><br></li>
<li>You can verify that your site will respond to PayPal by <a href="%3$s/ipntreas.php?dbg=1" style="text-decoration:underline;" target="_blank"><strong>clicking here</strong></a>.<br>
&#8226; This will also place an entry in your <a href="%2$ssa=translog" style="text-decoration:underline;"><strong>transaction log</strong></a>.<br><br></li>
<li>If you are having problems with transactions not appearing, check the <a href="%2$ssa=translog" style="text-decoration:underline;"><strong>Transaction Log</strong></a> for any clues to problems.<br>
&#8226; if they pay by echeck (3 days to clear) the log will contain "pending_reason => echeck".<br><br></li>
<li>Whenever IPN data is not stored in your database, you will have to manually enter the data from your PayPal Email in the bottom row <a href="%2$ssa=donations" style="text-decoration:underline;"><strong>here</strong></a>.<br><br></li>
<li>Treasury accepts pending payments, like eCheck, and stores the info in the database, with status of \'Pending\'.  When the eCheck clears, it should now receive the PayPal IPN info and automatically update your datbase - otherwise, you can change status to \'Completed\' in <a href="%2$ssa=donations" style="text-decoration:underline;"><strong>Donations</strong></a> and the donation will appear in your goals and donor list - you will need to add data for the fee, settle amount and exchange rate.<br><br></li>
<li>Events based donations - this is an alternative to the existing time-based donation system.<br>You choose one or the other - it does <strong>not support both</strong> simultaneously.<br>It will only operate for one event Campaign at a time, and you must decide when to end any given campaign.<br><br></li>
<li>Treasury was initially designed for multi-purpose use, collating information on the basis of paypal transactions for different email addresses.<br>
&#8226; this means that the "business" field for a transaction is expected to match the "receiver email" address you specified in your <a href="%2$ssa=configpaypal" style="text-decoration:underline;"><strong>PayPal Config</strong></a> tab.<br>
&#8226; if the two don\'t match up, the donation will be ignored in summaries, so you need to edit the "business" field in your database \'smf_treas_donations\' table.<br>(perhaps in later versions we will put this capability to use).<br><br></li>
<li>The green bar below the goal summary (near the bottom of the block for Portal users) is the percent achievement of your monthly goal.<br><br></li>
</ol>';

$txt['treasury_readme_unistallNote_description'] = 
'<ol>
<li>The uninstall remove all file and all hooks</li>
<li>Note: Uninstall will deliberately <strong>NOT</strong> remove the Treasury database tables.<br>
For permanent Uninstall you will need to manually <strong>DROP</strong> these tables from the database:<br>
- smf_log_treasurey<br>
- smf_treas_config<br>
- smf_treas_donations<br>
- smf_treas_events<br>
- smf_treas_registry<br>
- smf_treas_subscribers<br>
- smf_treas_targets<br>
(assumes you used smf_ for your prefix)<br><br></li>
</ol>';

?>