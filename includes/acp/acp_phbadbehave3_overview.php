<?php
/**
*
* @package acp
* @version $Id acp_phbadbehave3_overview.php
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
			foreach (array_keys($bb2_responses) as $key)
			{
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

			//purging		
			$form_key = 'pbb3_purge';
			add_form_key($form_key);
			if ('no' != request_var('purge', 'no'))
			{
				if (!check_form_key($form_key))
				{
					trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
				}
				else
				{
					$db->sql_query('DELETE FROM ' . BAD_BEHAVIOR_TABLE . '
						WHERE 1=1');
				}
			}
			$template->assign_var('U_ACTION', $this->u_action);

			//latest blocked requests
			$result = $db->sql_query_limit(
				'SELECT t.ip, FROM_UNIXTIME(t.date) AS date, t.request_uri, t.user_agent, t.key 
				FROM ' . BAD_BEHAVIOR_TABLE . ' AS t 
				WHERE t.key <> \'00000000\' 
				ORDER BY t.id DESC', 20);
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
			if (0 == $i)
			{
				$template->assign_block_vars('lc_lucky', array());
			}

			//latest non blocked requests
			$result = $db->sql_query_limit(
				'SELECT t.ip, FROM_UNIXTIME(t.date) AS time, t.request_uri, t.user_agent, t.key 
				FROM ' . BAD_BEHAVIOR_TABLE . ' AS t 
				WHERE t.key = \'00000000\' 
				ORDER BY t.id DESC', 20);
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('la_loop', array (
					'IP'		=> $row['ip'],
					'DATE'		=> $row['time'],
					'URL'		=> $row['request_uri'],
					'AGENT'		=> $row['user_agent'],
					'KEY'		=> $row['key'],
					'ROW'		=> ($i++) % 2 +1));
			}
			if (0 == $i)
			{
				$template->assign_block_vars('la_note', array());
			}

			//distribution of keys
			$result = $db->sql_query(
				'SELECT COUNT(*) AS sum 
				FROM ' . BAD_BEHAVIOR_TABLE);
			$total = (double)$db->sql_fetchfield('sum');
			$result = $db->sql_query(
				'SELECT COUNT(*) AS sum, t.key, FROM_UNIXTIME(MAX(t.date)) AS last 
				FROM ' . BAD_BEHAVIOR_TABLE . ' AS t 
				GROUP BY t.key 
				ORDER BY t.date DESC');
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('di_loop', array (
					'AMOUNT'	=> $row['sum'],
					'PERCENTAGE'	=> round($row['sum'] / $total * 100 . '%', 2),
					'KEY'		=> $row['key'],
					'LAST'		=> $row['last'],
					'ROW'		=> ($i++) % 2 +1));
			}
			if (0 == $i) {
				$template->assign_block_vars('bh_lucky', array());
			}

			//blocking over last days
			$result = $db->sql_query(
				'SELECT COUNT(*) AS sum 
				FROM ' . BAD_BEHAVIOR_TABLE . ' AS t 
				WHERE t.date > UNIX_TIMESTAMP(SUBDATE(NOW(), INTERVAL 30 DAY)) 
					AND t.key <> \'00000000\'');
			$total = (double)$db->sql_fetchfield('sum');
			$result = $db->sql_query(
				'SELECT COUNT(*) AS sum, DAY(FROM_UNIXTIME(t.date)) AS day, MONTH(FROM_UNIXTIME(t.date)) AS month 
				FROM ' . BAD_BEHAVIOR_TABLE . ' AS t 
				WHERE t.date > UNIX_TIMESTAMP(SUBDATE(NOW(), INTERVAL 30 DAY)) 
					AND t.key <> \'00000000\' 
				GROUP BY month, day 
				ORDER BY t.date DESC');
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('bd_loop', array (
					'AMOUNT'	=> $row['sum'],
					'PERCENTAGE'=> round($row['sum'] / $total * 100 . '%', 2),
					'DATE'		=> $row['month']."/".$row['day'],
					'ROW'		=> ($i++) % 2 +1));
			}
			if (0 == $i)
			{
				$template->assign_block_vars('bd_lucky', array());
			}

			//blocking over hour
			$result = $db->sql_query(
				'SELECT COUNT(*) AS sum 
				FROM ' . BAD_BEHAVIOR_TABLE . ' AS t 
				WHERE t.date > UNIX_TIMESTAMP(NOW() - INTERVAL 30 DAY) 
					AND t.key <> \'00000000\'');
			$total = (double)$db->sql_fetchfield('sum');
			$result = $db->sql_query(
				'SELECT COUNT(*) AS sum, HOUR(FROM_UNIXTIME(t.date)) AS hour 
				FROM ' .BAD_BEHAVIOR_TABLE . ' AS t 
				WHERE t.date > UNIX_TIMESTAMP(SUBDATE(NOW(), INTERVAL 30 DAY)) 
					AND t.key <> \'00000000\' 
				GROUP BY hour 
				ORDER BY t.date DESC');
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('bh_loop', array (
					'AMOUNT'	=> $row['sum'],
					'PERCENTAGE'=> round($row['sum'] / $total * 100 . '%', 2),
					'HOUR'		=> $row['hour'],
					'ROW'		=> ($i++) % 2 +1));
			}
			if (0 == $i)
			{
				$template->assign_block_vars('bh_lucky', array());
			}

			//top 20 blocked ips			
			$result = $db->sql_query_limit(
				'SELECT t.ip, COUNT(*) AS sum, FROM_UNIXTIME(MAX(t.date)) AS last 
				FROM ' . BAD_BEHAVIOR_TABLE . ' AS t 
				WHERE t.key <> \'00000000\' 
				GROUP BY t.ip 
				ORDER BY t.ip DESC', 20);
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('bi_loop', array(
					'AMOUNT'	=> $row['sum'],
					'IP'		=> $row['ip'],
					'LAST'		=> $row['last'],
					'ROW'		=> ($i++) %  2 +1));
			}
			if (0 == $i)
			{
				$template->assign_block_vars('bi_lucky', array());
			}

			//top 20 blocked pages
			$result = $db->sql_query_limit(
				'SELECT COUNT( * ) AS sum, FROM_UNIXTIME(MAX(t.date)) AS last, t.request_uri 
				FROM ' . BAD_BEHAVIOR_TABLE . ' AS t 
				WHERE t.key <> \'00000000\' 
				GROUP BY t.request_uri 
				ORDER BY sum DESC', 20);
			$i = 0;
			while ($row = $db->sql_fetchrow($result))
			{
				$template->assign_block_vars('bp_loop', array(
					'AMOUNT'	=> $row['sum'],
					'PAGE'		=> $row['request_uri'],
					'LAST'		=> $row['last'],
					'ROW'		=> ($i++) %  2 +1));
			}
			if (0 == $i)
			{
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
