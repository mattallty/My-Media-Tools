<?php
class Mmt_Cli_Command {
	
	private $_name;
	private $_props;
	
	public function __construct($name) {
		$this->_name = $name;
		if(file_exists(MMT_CLI_PATH."commands/".$name.".php")) {
			$this->_props = include MMT_CLI_PATH."commands/".$name.".php";
		}
	}
	
	public function isValid() {
		return (isset($this->_props) && is_array($this->_props) && $this->_props['enabled'] == true);
	}
	
	public function call($args) {
		if(isset($this->_props['callback']) && is_callable($this->_props['callback'])) {
			return call_user_func_array($this->_props['callback'], $args);
		}
		throw new Mmt_Exception("Callback is not callable.");
	}
	
	public function getHelp() {
		if(file_exists(MMT_CLI_PATH."help/".$this->_name.".txt")) {
			return file_get_contents(MMT_CLI_PATH."help/".$this->_name.".txt")."\n";
		}
		return "No help found for this command.";
	}
	
}	