<?php
class acp_phbadbehave3_overview
{
   var $u_action;
   var $new_config;
   function main($id, $mode)
   {
      global $db, $user, $auth, $template;
      global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

	switch ($mode)
	{
		case 'legend':
			$http_codes = array (
			200	=> array ('explain'	=> $user->lang['PBB3_200'], 'class'	=> 'success'), 
			400	=> array ('explain'	=> $user->lang['PBB3_400'], 'class'	=> 'error'),
			403	=> array ('explain'	=> $user->lang['PBB3_403'], 'class'	=> 'error'),
			417	=> array ('explain'	=> $user->lang['PBB3_417'], 'class'	=> 'error'));
			$this->page_title = 'ACP_PBB3_TITLE_LEGEND';
			$this->tpl_name = 'acp_phbadbehave3_legend';

			include($phpbb_root_path.'/bb2.0.x/responses.inc.'.$phpEx);
			global $bb2_responses;

			$i = 0;
			foreach (array_keys($bb2_responses) as $key) {
				$response =  bb2_get_response($key);
				$template->assign_block_vars('legend_loop', array (
					'KEY'		=> $key,
					'HTTP'		=> $response['response'],
					'HTTP_MEANING'	=> $http_codes[$response['response']]['explain'],
					'CLASS'		=> $http_codes[$response['response']]['class'],
					'REASON'	=> $response['log'],
					'ROW'		=> ($i++)%2 + 1));
			}
			break;
		case 'overview':
			$this->page_title = 'ACP_PBB3_TITLE_OVERVIEW';
			$this->tpl_name = 'acp_phbadbehave3_overview';

			//latest blocked requests
			$result = $db->sql_query_limit('SELECT * FROM ' . BAD_BEHAVIOR . ' WHERE `key` <> \'00000000\' ORDER BY `id` DESC', 20);
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('lc_loop', array (
					'IP'		=> $row['ip'],
					'DATE'		=> $row['date'],
					'URL'		=> $row['request_uri'],
					'AGENT'		=> $row['user_agent'],
					'KEY'		=> $row['key'],
					'ROW'		=> ($i++) % 2 +1));
			}
			if (0 == $i) {
				$template->assign_block_vars('lc_lucky', array());
			}

			//latest non blocked requests
			$result = $db->sql_query_limit('SELECT * FROM ' . BAD_BEHAVIOR . ' WHERE `key` = \'00000000\' ORDER BY `id` DESC', 20);
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('la_loop', array (
					'IP'		=> $row['ip'],
					'DATE'		=> $row['date'],
					'URL'		=> $row['request_uri'],
					'AGENT'		=> $row['user_agent'],
					'KEY'		=> $row['key'],
					'ROW'		=> ($i++) % 2 +1));
			}
			if (0 == $i) {
				$template->assign_block_vars('la_note', array());
			}

			//distribution of keys
			$result = $db->sql_query('SELECT COUNT(*) AS sum FROM ' . BAD_BEHAVIOR);
			$total = (double)$db->sql_fetchfield('sum');
			$result = $db->sql_query('SELECT COUNT(*) AS sum , `key`, MAX(`date`) AS last FROM ' . BAD_BEHAVIOR . ' GROUP BY `key` ORDER BY `date` DESC');
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('di_loop', array (
					'AMOUNT'	=> $row['sum'],
					'PERCENTAGE'	=> $row['sum'] / $total * 100 . '%',
					'KEY'		=> $row['key'],
					'LAST'		=> $row['last'],
					'ROW'		=> ($i++) % 2 +1));
			}
			if (0 == $i) {
				$template->assign_block_vars('bh_lucky', array());
			}

			//blocking over last days
			$result = $db->sql_query('SELECT COUNT(*) AS sum FROM ' . BAD_BEHAVIOR . ' WHERE `date` > (NOW() - INTERVAL 30 DAY) AND `key` <> \'00000000\'');
			$total = (double)$db->sql_fetchfield('sum');
			$result = $db->sql_query('SELECT COUNT(*) AS sum, DAY(`date`) AS day, MONTH(`date`) AS month FROM ' . BAD_BEHAVIOR . ' WHERE `date` > (NOW() - INTERVAL 30 DAY) AND `key` <> \'00000000\' GROUP BY MONTH(`date`), DAY(`date`) ORDER BY `date` DESC');
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('bd_loop', array (
					'AMOUNT'	=> $row['sum'],
					'PERCENTAGE'	=> $row['sum'] / $total * 100 . '%',
					'DATE'		=> $row['month']."/".$row['day'],
					'ROW'		=> ($i++) % 2 +1));
			}
			if (0 == $i) {
				$template->assign_block_vars('bd_lucky', array());
			}

			//blocking over hour
			$result = $db->sql_query('SELECT COUNT(*) AS sum FROM ' . BAD_BEHAVIOR . ' WHERE `date` > (NOW() - INTERVAL 30 DAY) AND `key` <> \'00000000\'');
			$total = (double)$db->sql_fetchfield('sum');
			$result = $db->sql_query('SELECT COUNT(*) AS sum, HOUR(`date`) AS hour FROM ' .BAD_BEHAVIOR . ' WHERE `date` > (NOW() - INTERVAL 30 DAY) AND `key` <> \'00000000\' GROUP BY HOUR(`date`) ORDER BY `date` DESC');
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('bh_loop', array (
					'AMOUNT'	=> $row['sum'],
					'PERCENTAGE'	=> $row['sum'] / $total * 100 . '%',
					'HOUR'		=> $row['hour'],
					'ROW'		=> ($i++) % 2 +1));
			}
			if (0 == $i) {
				$template->assign_block_vars('bh_lucky', array());
			}

			//top 20 blocked ips			
			$result = $db->sql_query_limit('SELECT `ip`, COUNT(*) AS sum, MAX(`date`) AS last FROM ' . BAD_BEHAVIOR . ' WHERE `key` <> \'00000000\' GROUP BY `ip` ORDER BY `ip` DESC', 20);
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('bi_loop', array(
					'AMOUNT'	=> $row['sum'],
					'IP'		=> $row['ip'],
					'LAST'		=> $row['last'],
					'ROW'		=> ($i++) %  2 +1));
			}
			if (0 == $i) {
				$template->assign_block_vars('bi_lucky', array());
			}

			//top 20 blocked pages
			$result = $db->sql_query_limit('SELECT COUNT( * ) AS sum, MAX( `date` ) AS last, `request_uri` FROM ' . BAD_BEHAVIOR . ' WHERE `key` = \'00000000\' GROUP BY `request_uri` ORDER BY sum DESC', 20);
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('bp_loop', array(
					'AMOUNT'	=> $row['sum'],
					'PAGE'		=> $row['request_uri'],
					'LAST'		=> $row['last'],
					'ROW'		=> ($i++) %  2 +1));
			}
			if (0 == $i) {
				$template->assign_block_vars('bp_lucky', array());
			}

			//show bad behavior version
			include_once($phpbb_root_path.'/bb2.0.x/version.inc.'.$phpEx);
			$template->assign_var('S_PBB3_VERSION', BB2_VERSION);

			break;
		default:
			$this->page_title = 'ACP_PBB3_TITLE_OVERVIEW';
			$this->tpl_name = 'acp_phbadbehave3_overview';

			break;
	}
   }
}
?>
