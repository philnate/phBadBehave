<?php

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

		if (false !== request_var('submit', false)) {
			//page was submitted check if all values are as expected;

			set_config('pbb3_log', 	(request_var('pbb3_logging', true))? 'true' : 'false');
			set_config('pbb3_verbose', (request_var('pbb3_verbose', false))? 'true' : 'false');
			set_config('pbb3_strict', (request_var('pbb3_strict', false))? 'true' : 'false');
			set_config('pbb3_offsite', (request_var('pbb3_offsite', false))? 'true' : 'false');
			set_config('pbb3_httpbl_maxage', (int) request_var('pbb3_httpbl_maxage', 30));
			set_config('pbb3_httpbl_level', (int) request_var('pbb3_httpbl_level', 25));
			set_config('pbb3_httpbl_key', preg_replace('#[^a-z]#', '', strtolower(request_var('pbb3_httpbl_key', ''))));
			set_config('pbb3_keep_days', (int) request_var('pbb3_keep_days', 30));
			set_config('pbb3_keep_amount', (int) request_var('pbb3_keep_amount', 4000));
		}

		$result = $db->sql_query('SELECT * FROM ' . CONFIG_TABLE . ' WHERE config_name LIKE \'' . $db->sql_escape('pbb3_%') . '\'');
		$rows =	$db->sql_fetchrowset($result);
		foreach ($rows as $row) {
			$template->assign_var('S_' . strtoupper($row['config_name']), ('true' == $row['config_value'])? 'checked' : $row['config_value']);
		}
		//TODO allow switching bad behavior version
   }
}
?>
