<?php
abstract class Mmt_Media {
	const MOVIE = 1;
	const SHOW = 2;
	
	private $_type;
	
	public function getType() {
		return $this->_type;
	}
}
