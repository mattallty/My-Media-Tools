<?php
class Mmt {
	
	/**
	 * Mmt instance
	 * @var Mmt Mmt instance
	 */
	static public $instance;
	
	private $_plugins; 				// plugins list
	private $_plugins_instances; 	// plugins instances
	
	
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
		$infos = explode("_", $class);
		$file = MMT_LIB_PATH.implode(DIRECTORY_SEPARATOR, $infos).".php";
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
	
	/**
	 * Returns plugins list
	 * 
	 * @param $enabled boolean If true, returns only enabled plugins (default)
	 * @return array list of plugins
	 */
	public function getPlugins($enabled = true) 
	{
		if(!is_null($this->_plugins)) 
			return $this->_plugins;
		
		$plugins = array();
		
		foreach (new DirectoryIterator(MMT_PLUGINS_PATH) as $fileInfo) 
		{
    		if($fileInfo->isDot()) continue;
			if(!$fileInfo->isDir()) continue;
			
			$plugin_path 	= $fileInfo->getPathname();
			$plugin_name 	= $fileInfo->getBasename();
			$plugin_config 	= json_decode(file_get_contents($plugin_path.DIRECTORY_SEPARATOR."manifest.json"), true);
			
			$plugin_config['path'] = $plugin_path;
			$plugins[$plugin_name] = $plugin_config;
		}
		return ($this->_plugins = $plugins);
	}
	
	public function plug($plugin_name) 
	{
		if(isset($this->_plugins_instances[$plugin_name])) {
			return $this->_plugins_instances[$plugin_name];
		}
		
		$plugins = $this->getPlugins();
		
		if(!array_key_exists($plugin_name, $plugins)) {
			throw new Mmt_Exception("Plugin '$plugin_name' does not exist or is not enabled.");
		}
		
		$plugin_class = str_replace(".", "_", $plugin_name);
		require($plugins[$plugin_name]['path'].DIRECTORY_SEPARATOR."plugin.php");
		
		return ($this->_plugins_instances[$plugin_name] = new $plugin_class($plugin_name));
	}
}


function plugin($plugin) {
	return Mmt::getInstance()->plug($plugin);
}


spl_autoload_register(array(Mmt::getInstance(), '__autoload'));