<?php

abstract class Custom_Model_Abstract
{
	// protected $_mapperClass = '[Path_To_Mapper]'; // must be set in the child model
	// protected $_primaryIDColumn = 'primaryID'; // must be set in the child model
	
	protected $_primaryID;
	
	public function __construct(array $options = null) {
		// require an associated mapper class
			if(!isset($this->_mapperClass)) throw new Exception('The model must have an associated mapper class: '.get_class($this));
		// require and set the primaryKey accessor property
			if(!isset($this->_primaryIDColumn)) throw new Exception('The model must have a _primaryIDColumn: '.get_class($this));
			$primaryIDColumn = $this->_primaryIDColumn;
			$this->_primaryID =& $this->$primaryIDColumn;
		// set default properties that require a function
			if(property_exists($this, 'dateCreated')) $this->dateCreated = date('Y-m-d H:i:s');
		// set any options that were passed
			if(is_array($options)) $this->setOptions($options);
	}
	
	public function __set($property, $value) {
		if(!property_exists($this, $property)) throw new Exception('Trying to set invalid '.get_class($this).' property: '.$property);
		$this->$property = $value;
	}
	
	public function &__get($property) {
		if(!property_exists($this, $property)) throw new Exception('Trying to get invalid '.get_class($this).' property: '.$property);
		return $this->$property;
	}
	
	public function setOptions(array $options) {
		foreach($options as $property => $value) {
			if(property_exists($this, $property)) $this->$property = $value;
		}
		return $this;
	}

	// returns an array of all the properties of the object, private or public (for JSON)
	public function getProperties() {
		$object = array();
		foreach($this as $k=>$v) {
			if(is_object($v) && get_parent_class($v) == 'Custom_Model_Abstract') $object[$k] = $v->getProperties();
			else if(is_array($v)) $object[$k] = $this->getArrayProperties($v);
			else $object[$k] = $v;
		}
		return $object;
	}  // END getProperties()
	
	// traverse an array to see if any values are objects that have the method getProperties() (for JSON)
	private function getArrayProperties($array) {
		$newArray = array();
		foreach($array as $k=>$v) {
			if(is_object($v) && get_parent_class($v) == 'Custom_Model_Abstract') $newArray[$k] = $v->getProperties();
			else if(is_array($v)) $newArray[$k] = $this->getArrayProperties($v);
			else $newArray[$k] = $v;
		}
		return $newArray;
	} // END getArrayProperties()
	
	
	
//	public function __set($name, $value)
//        {
//		
//            if (array_key_exists($name, $this->_properties)) {
//                $this->_properties[$name]['value'] = $value;
//                $this->_properties[$name]['updated'] = true;
//                return true;
//            }
//
//            return false;
//        }
//
//        public function __get($name)
//        {
//            return array_key_exists($name, $this->_properties) ? $this->_properties[$name]['value'] : null;
//        }
//
//        protected function add($field, $default = null, $type = null)
//        {
//            $this->_properties[$field] = array('value'   => $default,
//                                               'type'    => in_array($type, self::$types) ? $type : null,
//                                               'updated' => false);
//        }
	

}

?>
