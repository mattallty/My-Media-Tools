<?php
class Mmt_Config {
	
	public static $_configs;
	
	public static function get($section, $varname = '') 
	{
		if(!isset(self::$_configs[$section])) {
			if(file_exists(MMT_CONFIG_PATH.$section.".cfg.php")) {
				self::$_configs[$section] = include MMT_CONFIG_PATH.$section.".cfg.php";
			}else{
				return NULL;
			}			
		}
		return (empty($varname)) ? self::$_configs[$section] :
					((isset(self::$_configs[$section][$varname])) ?
							self::$_configs[$section][$varname] : NULL); 
		
	}
	
	public static function set($section, $property, $value) {
		
	} 
	
	public static function handleCommand() {
		$argn = func_num_args();
		if($argn === 1) {
			return json_encode(self::get(func_get_arg(0)));
		}else if($argn === 2) {
			return json_encode(self::get(func_get_arg(0), func_get_arg(1)));
		}else if($argn === 3) {
						
		}
	}
}
