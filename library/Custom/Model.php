<?php

class Custom_Model
{

	
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
	
	public function __construct(array $options = null) {
		if(is_array($options)) $this->setOptions($options);
	}
	
//	public function __set($name, $value) {
//		$method = 'set'.ucfirst($name);
//		if(($name == 'mapper') || !method_exists($this, $method)) throw new Exception('Invalid User property: '.$method);
//		$this->$method($value);
//	}
//	
//	public function __get($name) {
//		$method = 'get'.ucfirst($name);
//		if(($name == 'mapper') || !method_exists($this, $method)) throw new Exception('Invalid User property: '.$method);
//		return $this->$method();
//	}
	
	public function setOptions(array $options) {
//		$methods = get_class_methods($this);
//		foreach($options as $key => $value) {
//			$method = 'set'.ucfirst($key);
//			if(in_array($method, $methods)) $this->$method($value);
//		}

		foreach($options as $property => $value) {
			if(property_exists($this, $property)) $this->$property = $value;
		}
		return $this;
	}

}

