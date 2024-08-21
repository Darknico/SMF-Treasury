<?php
/**
 * DonationBlock.php
 *
 * @package Treasury
 * @link https://github.com/Darknico/SMF-Treasury
 * @author Darknico <info@darknico.com>
 * @copyright Originally NukeTreasury - Financial management for PHP-Nuke Copyright (c) 2004 - Resourcez at resourcez.biz Copyright (c) 2008 - Edited by Darknico  Copyright (c) 2024 
 * @license https://spdx.org/licenses/GPL-2.0-or-later.html GPL-2.0-or-later
 *
 * @version 2.12.10
 */

if (!defined('SMF'))
	die('Hacking attempt...');

loadLanguage('Treasury/TreasuryReadMe');
global $scripturl, $boardurl, $modSettings;

$admin_treas = '?action=admin;area=treasury;';
$admin_baseurl_treas = $scripturl.$admin_treas;

echo '
	<div class="cat_bar"><h3 class="catbg">', $txt['treasury_readme_info_title'],'</h3></div>
	<div class="windowbg noup">
		<dl class="settings">
			<dt>
				Originally NukeTreasury - Financial management for PHP-Nuke &copy; 2004 <br>
				<a href="https://www.simplemachines.org/community/index.php?action=profile;u=69956" target="_blank" rel="noopener">Resourcez</a> 
				at resourcez.biz &copy; 2008 <br>
				Edited by <a href="https://www.darknico.com" target="_blank" rel="noopener">Darknico</a> 
				at <a href="https://www.italiansmf.net" target="_blank" rel="noopener">Italian SMF</a> &copy; 2024
				<br><br>
				', $txt['treasury_readme_info_description'],'
			</dt>
			<dd>
				', $txt['treasury_readme_installedVersion'],': <strong>',TREAS_VERSION,'</strong><br>
				', $txt['treasury_readme_checkVersionVersion'],' <a href="https://github.com/Darknico/SMF-Treasury/releases" target="_blank">GitHub</a>
			</dd>
		<dl>
	</div>';

echo '
<div class="cat_bar"><h3 class="catbg">', $txt['treasury_readme_treasSetup_title'],'</h3></div>

<div class="windowbg noup">
', sprintf($txt['treasury_readme_treasSetup_description'], $scripturl, $admin_baseurl_treas),'
</div>
<br>


<div class="cat_bar"><h3 class="catbg">', $txt['treasury_readme_paypalSetup_title'],'</h3></div>

<div class="windowbg noup">
', $txt['treasury_readme_paypalSetup_description'],'
</div>
<br>


<div class="cat_bar"><h3 class="catbg">', $txt['treasury_readme_operationalNote_title'],'</h3></div>

<div class="windowbg noup">
', sprintf($txt['treasury_readme_operationalNote_description'], $scripturl, $admin_baseurl_treas, $boardurl),'
</div>
<br>


<div class="cat_bar"><h3 class="catbg">', $txt['treasury_readme_unistallNote_title'],'</h3></div>

<div class="windowbg noup">
', $txt['treasury_readme_unistallNote_description'],'
</div>';

?>