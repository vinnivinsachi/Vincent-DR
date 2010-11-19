<?php

abstract class Custom_Model_Abstract
{
	
	public function __construct(array $options = null) {
		if(is_array($options)) $this->setOptions($options);
	}
	
	public function __set($property, $value) {
		if(!property_exists($this, $property)) throw new Exception('Trying to set invalid User property: '.$property);
		$this->$property = $value;
	}
	
	public function __get($property) {
		if(!property_exists($this, $property)) throw new Exception('Trying to get invalid User property: '.$property);
		return $this->$property;
	}
	
	public function setOptions(array $options) {
		foreach($options as $property => $value) {
			if(property_exists($this, $property)) $this->$property = $value;
		}
		return $this;
	}

	
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
