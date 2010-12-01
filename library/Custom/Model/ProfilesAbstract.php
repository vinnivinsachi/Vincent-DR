<?php
abstract class Custom_Model_ProfilesAbstract
{
	// protected $_mapperClass = '[Path_To_Mapper]'; // must be set in the child model
	
	private $properties = array();
	
	public function __construct(array $properties = null) {
		if(is_array($properties)) $this->setProperties($properties);
		
		if(!isset($this->_mapperClass)) throw new Exception('The model must have an associated mapper class: '.get_class($this));
		// require and set the primaryKey accessor property
			
			//$this->_primaryID =& $this->$primaryIDColumnValue;
	}
	
	public function getMapperClass(){
		return $this->_mapperClass;	
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

}?>