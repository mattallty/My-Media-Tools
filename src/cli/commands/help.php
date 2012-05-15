<?php
return array(
	'description' => 'Displays help related to a command',
	'enabled' => true,
	'options' => '[<command>]',
	'callback' => array('Mmt_Cli_Router', 'helpCommand'),	
);
?>