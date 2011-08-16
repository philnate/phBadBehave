<?php
class acp_phbadbehave3
{
   var $u_action;
   var $new_config;
   function main($id, $mode)
   {
      global $db, $user, $auth, $template;
      global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
      switch($mode)
      {
        case 'overview':
		$this->page_title = 'ACP_PBB3_TITLE_OVERVIEW';
		$this->tpl_name = 'acp_phbadbehave3_overview';
	break;
	case 'settings':
		$this->page_title = 'ACP_PBB3_TITLE_SETTINGS';
		$this->tpl_name = 'acp_phbadbehave3_settings';
		break;
	default:
		$this->page_title = 'ACP_PBB3_TITLE';
		$this->tpl_name = 'acp_phbadbehave3';
      }

   }
}
?>
