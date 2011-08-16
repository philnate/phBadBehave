<?php
class acp_phbadbehave3_search
{
   var $u_action;
   var $new_config;
   function main($id, $mode)
   {
      global $db, $user, $auth, $template;
      global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

	$this->page_title = 'ACP_PBB3_TITLE_SEARCH';
	$this->tpl_name = 'acp_phbadbehave3_search';

   }
}
?>
