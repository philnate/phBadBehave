<?php
class acp_phbadbehave3_info
{
    function module()
    {
        return array(
            'filename'	=> 'acp_phbadbehave3',
            'title'	=> 'ACP_PBB3_TITLE',
            'version'	=> '1.0.0',
            'modes'	=> array(
                'overview'	=> array('title' => 'ACP_PBB3_OVERVIEW', 'auth' => 'acl_a_', 'cat' => array('')),
		'settings'	=> array('title' => 'ACP_PBB3_SETTINGS', 'auth' => 'acl_a_', 'cat' => array('')),	
            )
        );
    }

    function install()
    {
    }

    function uninstall()
    {
    }
}
?>
