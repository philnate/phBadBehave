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
	'ACP_PBB3_TITLE'					=> 'phBadBehave3',
	'ACP_PBB3_TITLE_SETTINGS'			=> 'phBadBehave3 - Settings',
	'ACP_PBB3_TITLE_OVERVIEW'			=> 'phBadBehave3 - Overview',
	'ACP_PBB3_TITLE_SEARCH'				=> 'phBadBehave3 - Search',
	'ACP_PBB3_TITLE_LEGEND'				=> 'phBadBehave3 - Legend',
	'ACP_PBB3_MENU'						=> 'phBadBehave3',
	'ACP_PBB3_MENU_GENERAL'				=> 'General',
	'ACP_PBB3_MENU_OVERVIEW'			=> 'Overview',
	'ACP_PBB3_MENU_SETTINGS'			=> 'Settings',
	'ACP_PBB3_MENU_SEARCH'				=> 'Search',
	'ACP_PBB3_MENU_LEGEND'				=> 'Legend',
	'PBB3_LEGEND_CAPTION'				=> 'Keys used within Bad Behavior',
	'PBB3_LEGEND_REASON'				=> 'Reason for Blocking',
	'PBB3_KEY'							=> 'Key',
	'PBB3_HTTP'							=> 'HTTP Code returned',
	'PBB3_IP'							=> 'IP-Adress',
	'PBB3_PAGE'							=> 'Page',
	'PBB3_AMOUNT'						=> 'Total Number',
	'PBB3_PERCENTAGE'					=> '%',
	'PBB3_LASTTIME'						=> 'Last time',
	'PBB3_AGENT'						=> 'Useragent',
	'PBB3_DATE'							=> 'Date',
	'PBB3_HOUR'							=> 'Hour',
	'PBB3_URL'							=> 'request URL',
	'PBB3_METHOD'						=> 'Request method',
	'PBB3_PROTOCOL'						=> 'Server Protocol',
	'PBB3_HEADERS'						=> 'HTTP Headers',
	'PBB3_200'							=> 'OK - Site delivered normally',
	'PBB3_400'							=> 'ERROR - Request was wrong constructed',
	'PBB3_403'							=> 'ERROR - Client is missing rights to access page',
	'PBB3_417'							=> 'ERROR - Behavior can\'t be delivered from server',
	'PBB3_OVERVIEW_STATS'				=> 'phBadBehave3 Statistics',
	'PBB3_OVERVIEW_STATS_DESC'			=> 'Here you can see some statistics about how Bad Behavior is doing it\'s job',
	'PBB3_OVERVIEW_LAST_CATCHES'		=> 'Last blocked accesses',
	'PBB3_OVERVIEW_LC_DESC'				=> 'Latest 20 blocked requests to your forum',
	'PBB3_OVERVIEW_LAST_ACTIONS'		=> 'Last accesses which where not blocked',
	'PBB3_OVERVIEW_LA_DESC'				=> 'Latest 20 non blocked requests to your forum',
	'PBB3_OVERVIEW_DISTRIBUTION'		=> 'Distribution of Keys',
	'PBB3_OVERVIEW_DI_DESC'				=> 'Distribution of the Keys Bad Behavior uses; all not displayed keys where never assigned',
	'PBB3_OVERVIEW_BLOCK_DAY'			=> 'Blocks per Day',
	'PBB3_OVERVIEW_BD_DESC'				=> 'Overview of the distribution of Blocks over the last 30 days',
	'PBB3_OVERVIEW_BLOCK_HOUR'			=> 'Blocks per Hour',
	'PBB3_OVERVIEW_BH_DESC'				=> 'Bad Behavior blocks distributed around the day for the last 30 days',
	'PBB3_OVERVIEW_BLOCK_IP'			=> 'Most blocked IPs',
	'PBB3_OVERVIEW_BI_DESC'				=> 'Overview of the most blocked IPs',
	'PBB3_OVERVIEW_BLOCK_PAGE'			=> 'Most blocked Requests',
	'PBB3_OVERVIEW_BP_DESC'				=> 'Overview of the most blocked page requests',
	'PBB3_LUCKY'						=> 'Be Lucky, within the given period no Bad Behave has been logged',
	'PBB3_OVERVIEW_LA_NOTE'				=> 'No not blocked actions happened or verbose logging is turned off',
	'PBB3_RUNNING_WITH'					=> 'phBadBehave3 is powered by',
	'PBB3_LOGGING'						=> 'Log requests',
	'PBB3_VERBOSE'						=> 'Verbose logging (log even successful requests). NOTE: this can cause heavy database traffic',
	'PBB3_STRICT'						=> 'Check more strictly. Locks out some buggy software, but can lockout legit users as well!',
	'PBB3_OFFSITE'						=> 'Allow to receive data from offsite forms like Google Cache, normally this is misused by spammers, but some apps like OpenID require this functionality',
	'PBB3_HTTPBL_KEY'					=> 'Bad Behavior is capable to include http:BL to do further checking of incoming requests. To enable it you need an http:BL key which you can get at <a href="http://projecthoneypot.org">ProjectHoneyPot</a>',
	'PBB3_HTTPBL_MAXAGE'				=> 'Request froms IPs with suspicious actions within this count of days or less will be blocked',
	'PBB3_HTTPBL_LEVEL'					=> 'The ThreatLevel tells you how suspicious an IP is. Request from IPs with the given or higher ThreatLevel will be blocked through Bad Behavior',
	'PBB3_HTTPBL'						=> 'http:BL settings (purely optional)',
	'PBB3_SEARCH_NOTE'					=> 'No Entries where found, who matched your criteria',
	'PBB3_SEARCH_IS'					=> 'Is',
	'PBB3_SEARCH_ISNT'					=> 'Is Not',
	'PBB3_SEARCH_LIKE'					=> 'Contains',
	'PBB3_SEARCH'						=> 'search',
	'PBB3_SEARCH_LIMIT'					=> 'Max Records',
	'PBB3_SEARCH_ASC'					=> 'Ascending',
	'PBB3_SEARCH_DESC'					=> 'Descending',
	'PBB3_SEARCH_ORDERBY'					=> 'Order By',
));
?>
