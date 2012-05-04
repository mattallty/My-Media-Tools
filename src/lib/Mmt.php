<?php
class Mmt {
	
	
	/**
	 * Mmt instance
	 * @var Mmt Mmt instance
	 */
	static public $instance;
	
	
	/**
	 * Private constructor, following the singleton pattern,
	 * so cannot be called outside this class. Use getInstance() instead
	 * @return Supa Supa instance
	 */
	private function __construct($args = array())
	{
	}
		
	/**
	 * autoload - called when a new instance of a Class is being instancied
	 *
	 * @param string class name
	 * @return void
	 */
	public function __autoload($class) {
		$file = MMT_LIB_PATH.implode(DIRECTORY_SEPARATOR, explode("_", $class)).".php";
		if(file_exists($file))
			require($file);
	}
	
	/**
	 * Returns the Mmt main instance
	 * @return Mmt Mmt instance
	 */
	static function getInstance($args = array()) {
		if (!isset(self::$instance)) {
		    self::$instance = new self($args);
		}
		return self::$instance;
	}	
}

spl_autoload_register(array(Mmt::getInstance(), '__autoload'));