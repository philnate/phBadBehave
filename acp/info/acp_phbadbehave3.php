<?php
/**
*
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class acp_phbadbehave3
{
	function module()
	{
		return array(
			'enabled'	=> '1',
			'display'	=> '1',
			'filename'	=> 'acp_phbadbehave3',
			'title'		=> 'ACP_PHBADBEHAVE_MANAGEMENT',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'manage'	=> array('title' => 'Suppi', 'auth' => 'acl_a_', 'cat' => array(0)),
			),
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
