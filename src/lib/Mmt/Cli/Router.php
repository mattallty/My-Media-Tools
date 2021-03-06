<?php
class Mmt_Cli_Router {
	
	private $_cli_colors;
	
	public function __construct() {
		$this->_cli_colors = new Mmt_Cli_Colors();
	}
	
	public function handleCommands($args) {
		$s = '';
		if(!count($args) || !in_array($args[0], array_keys($this->getAvailableCommands()))) {
			$s = $this->help();
		}else{
			$cmd = new Mmt_Cli_Command($args[0]);
			if($cmd->isValid()) {
				$s = $cmd->call(array_slice($args, 1));
			}
		}
		echo $this->_cli_colors->formatString($s)."\n";
	}
	
	public function getAvailableCommands() {
		$commands = array();
		foreach (new DirectoryIterator(MMT_CLI_PATH."commands") as $fileInfo) 
		{
    		if($fileInfo->isDot()) continue;
			if($fileInfo->getExtension() != "php") continue;
			
			$cmd_path 	= $fileInfo->getPathname();
			$cmd_name 	= $fileInfo->getBasename(".php");
			$cmd_config = include($cmd_path);
			
			if(isset($cmd_config['enabled']) && $cmd_config['enabled']) {
				$commands[$cmd_name] = $cmd_config;
			}
		}
		return $commands;
	}
	
	public function helpCommand($command) {
		$cmd = new Mmt_Cli_Command($command);
		if($cmd->isValid()) {
			return $cmd->getHelp();
		}
	}
	
	public function help() {
		$s = 'Usage: [color=light_red]./mmt[/color] [color=purple]<command>[/color] [color=cyan]<options>[/color]'."\n";
		$s.= 'Type [color=light_red]./mmt[/color] [color=brown]help[/color] [color=purple]<command>[/color] for more details about a specific command.'."\n\n";
		$s.= "Available commands are:\n";
		
		foreach ($this->getAvailableCommands() as $cmd_name => $cmd_config) {
			$s .= '[color=purple]'.$cmd_name.'[/color]' . str_repeat(" ", 22-strlen($cmd_name))." ". $cmd_config['description'] ."\n";
		}
		return $s;
	}
}
