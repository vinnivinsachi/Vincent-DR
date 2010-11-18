<?php
class Custom_Model_Profiles
{
	
	private $properties = array();
	
	public function __construct(array $properties = null) {
		if(is_array($properties)) $this->setProperties($properties);
	}
	
	public function __set($property, $value) {
		$this->properties[$property] = $value;
	}
	
	public function __get($property) {
		if(!isset($this->properties[$property])) return null;
		return $this->properties[$property];
	}
	
	// provide an array of key value pairs to set as properties
	public function setProperties(array $properties) {
		foreach($properties as $key => $value) {
			$this->properties[$key] = $value;
		}
		return $this;
	}
	
	// return an array of key value pairs
	public function getProperties() {
		return $this->properties;
	}

}