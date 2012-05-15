<?php
abstract class Mmt_Media 
{
	const MOVIE 	= 'movie';
	const SHOW 		= 'show';
	
	protected $_type;
	protected $_properties;
	
	public function getType() {
		return $this->_type;
	}
	
	
	
	
}
