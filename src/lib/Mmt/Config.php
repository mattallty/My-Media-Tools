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
		if(ctype_digit($value)) {
			$value = intval($value);
		}elseif(is_numeric($value)) {
			$value = floatval($value);
		}elseif(is_string($value)) {
			if($new_val = @json_decode($value, true)) {
				$value = $new_val;
			}	
		}
		$section_arr = self::get($section);
		if(is_null($section_arr)) {
			$section_arr = array();
		}
		$section_arr[$property] = $value;
		if(file_put_contents(MMT_CONFIG_PATH.$section.".cfg.php", "<?php\nreturn ".var_export($section_arr, true).";")) {
			return $section_arr;
		}
		return false;
	} 
	
	public static function handleCommand() {
		$argn = func_num_args();
		if($argn === 1) {
			return json_encode(self::get(func_get_arg(0)));
		}else if($argn === 2) {
			return json_encode(self::get(func_get_arg(0), func_get_arg(1)));
		}else if($argn === 3) {
			return json_encode(self::set(func_get_arg(0), func_get_arg(1), func_get_arg(2)));			
		}
	}
}
