<?php
class Mmt_Cli_Router {
	
	private $_cli_colors;
	
	public function __construct() {
		$this->_cli_colors = new Mmt_Cli_Colors();
	}
	
	public function handleCommands($args) {
		if(!count($args)) {
			die($this->help());
		}
		
	}
	
	public function help() {
		return "Usage: ".$this->_cli_colors->getColoredString("./mmt-cli.php", "light_red")." ".
			$this->_cli_colors->getColoredString("<command>", "purple")." ".
			$this->_cli_colors->getColoredString("<options>", "cyan").
			"\n";
	}
	
	
	
}
