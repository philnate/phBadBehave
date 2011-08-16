<?php
/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
    $lang = array();
}
// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACP_PBB3_TITLE'                        	=> 'phBadBehave3',
	'ACP_PBB3_TITLE_SETTINGS'			=> 'phBadBehave3 - Settings',
	'ACP_PBB3_TITLE_OVERVIEW'			=> 'phBadBehave3 - Overview',
	'ACP_PBB3_TITLE_SEARCH'				=> 'phBadBehave3 - Search',
	'ACP_PBB3_TITLE_LEGEND'				=> 'phBadBehave3 - Legend',
	'ACP_PBB3_MENU'					=> 'phBadBehave3',
	'ACP_PBB3_MENU_GENERAL'				=> 'General',
	'ACP_PBB3_MENU_OVERVIEW'			=> 'Overview',
	'ACP_PBB3_MENU_SETTINGS'			=> 'Settings',
	'ACP_PBB3_MENU_SEARCH'				=> 'Search',
	'ACP_PBB3_MENU_LEGEND'				=> 'Legend',
	'PBB3_LEGEND_CAPTION'				=> 'Keys used within Bad Behavior',
	'PBB3_LEGEND_KEY'				=> 'Key',
	'PBB3_LEGEND_HTTP'				=> 'HTTP Code returned',
	'PBB3_LEGEND_REASON'				=> 'Reason for Blocking',
	'PBB3_200'					=> 'OK - Site delivered normally',
	'PBB3_400'					=> 'ERROR - Request was wrong constructed',
	'PBB3_403'					=> 'ERROR - Client is missing rights to access page',
	'PBB3_417'					=> 'ERROR - Behavior can\'t be delivered from server',
));
?>
