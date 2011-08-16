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
			200	=> array ('explain'	=> $user->lang['PBB3_200'], 'class'	=> 'ok'), 
			400	=> array ('explain'	=> $user->lang['PBB3_400'], 'class'	=> 'error'),
			403	=> array ('explain'	=> $user->lang['PBB3_403'], 'class'	=> 'error'),
			417	=> array ('explain'	=> $user->lang['PBB3_417'], 'class'	=> 'error'));
			$this->page_title = 'ACP_PBB3_TITLE_LEGEND';
			$this->tpl_name = 'acp_phbadbehave3_legend';

			include($phpbb_root_path."/bb2.0.x/responses.inc.".$phpEx);
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
			/*fallthrough*/
		default:
			$this->page_title = 'ACP_PBB3_TITLE_OVERVIEW';
			$this->tpl_name = 'acp_phbadbehave3_overview';

			break;
	}
   }
}
?>
