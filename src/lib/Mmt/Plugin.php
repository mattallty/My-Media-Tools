<?php
abstract class Mmt_Plugin {
	
	protected $_plugin_config;
	protected $_plugin_uid;
	protected $_hooks;
	
	abstract function init();
	
	final public function __construct($plugin_uid) {
		$this->_plugin_uid = $plugin_uid;
		$this->_plugin_config = $this->getPluginConfig();
		$this->init();
	}
	
	final public function disablePlugin() {
		return $this->enable(false);
	}
	
	public function getHooks() {
		return $this->_hooks;
	}
	
	final public function enablePlugin($enabled = true) {
		$this->_updatePluginConfig(array('enabled' => $enabled));
		return $this;
	}
	
	final private function _getPluginManifestFilepath() {
		return MMT_PLUGINS_PATH.$this->_plugin_uid.DIRECTORY_SEPARATOR."manifest.json";
	}
	
	final public function getPluginConfig() {
		if(isset($this->_plugin_config)) {
			return $this->_plugin_config;
		}
		$manifest = $this->_getPluginManifestFilepath();
		if(!file_exists($manifest))
			return false;
		return ($this->_plugin_config = json_decode(file_get_contents($manifest), true));
	}	
	
	final private function _updatePluginConfig($new_properties) {
		$this->_plugin_config = array_merge($this->_plugin_config, $new_properties);
		$manifest = $this->_getPluginManifestFilepath();
		if(file_put_contents($manifest, json_encode($this->_plugin_config))) {
			return $this->_plugin_config;
		}
		return false;
	}
	
	final public function getPluginUid() {
		return $this->_plugin_uid;
	}
	final public function getPluginType() {
		return $this->_getPluginConfigVar('type');
	}
	final public function getPluginVersion() {
		return $this->_getPluginConfigVar('version');
	}
	final public function getPluginName() {
		return $this->_getPluginConfigVar('name');
	}
	final public function getPluginAuthor() {
		return $this->_getPluginConfigVar('author');
	}
	final public function getPluginDescription() {
		return $this->_getPluginConfigVar('description');
	}
	final public function getPluginEnabled() {
		return $this->_getPluginConfigVar('enabled');
	}
	final public function getPluginDependencies() {
		return $this->_getPluginConfigVar('dependencies');
	}
	final public function getPluginUrl() {
		return $this->_getPluginConfigVar('url');
	}
	
	final private function _getPluginConfigVar($varname) {
		return (isset($this->_plugin_config[$varname])) ? $this->_plugin_config[$varname] : null;
	}
	
} 