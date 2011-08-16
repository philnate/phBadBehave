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
			$this->page_title = 'ACP_PBB3_TITLE_LEGEND';
			$this->tpl_name = 'acp_phbadbehave3_legend';
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
