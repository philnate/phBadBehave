<?php
/**
*
* @package acp
* @version $Id acp_phbadbehave3_settings.php
* @copyright (c) 2011 philnate <phsoftware.de>
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class acp_phbadbehave3_settings
{
   var $u_action;
   var $new_config;
   function main($id, $mode)
   {
		global $db, $user, $auth, $template;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		$this->page_title = 'ACP_PBB3_TITLE_SETTINGS';
		$this->tpl_name = 'acp_phbadbehave3_settings';

		if (false !== request_var('submit', false))
		{
			//page was submitted check if all values are as expected;
			set_config('pbb3_logging', 	(request_var('pbb3_logging', true))? 'true' : 'false');
			set_config('pbb3_verbose', (request_var('pbb3_verbose', false))? 'true' : 'false');
			set_config('pbb3_strict', (request_var('pbb3_strict', false))? 'true' : 'false');
			set_config('pbb3_offsite', (request_var('pbb3_offsite', false))? 'true' : 'false');
			set_config('pbb3_httpbl_maxage', (int) request_var('pbb3_httpbl_maxage', 30));
			set_config('pbb3_httpbl_level', (int) request_var('pbb3_httpbl_level', 25));
			set_config('pbb3_httpbl_key', preg_replace('#[^a-z]#', '', strtolower(request_var('pbb3_httpbl_key', ''))));
			set_config('pbb3_keep_days', (int) request_var('pbb3_keep_days', 30));
			set_config('pbb3_keep_amount', (int) request_var('pbb3_keep_amount', 4000));
		}

		$keys = array('pbb3_logging', 'pbb3_verbose', 'pbb3_strict', 'pbb3_offsite', 'pbb3_httpbl_key', 'pbb3_httpbl_maxage', 'pbb3_httpbl_level', 'bb3_keep_days', 'pbb3_keep_amount');
		foreach ($keys as $key)
		{
			$template->assign_var('S_' . strtoupper($key), ('true' == $config[$key])? 'checked' : $config[$key]);
		}
		//TODO allow switching bad behavior version
   }
}
?>
