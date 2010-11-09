<?php

class Application_Model_Users_User
{
	protected $_id;
	protected $_username;
	protected $_password;
	protected $_role;
	protected $_dateCreated;

	
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
	
	public function __set($name, $value) {
		$method = 'set'.ucfirst($name);
		if(($name == 'mapper') || !method_exists($this, $method)) throw new Exception('Invalid User property: '.$method);
		$this->$method($value);
	}
	
	public function __get($name) {
		$method = 'get'.ucfirst($name);
		if(($name == 'mapper') || !method_exists($this, $method)) throw new Exception('Invalid User property: '.$method);
		return $this->$method();
	}
	
	public function setOptions(array $options) {
		$methods = get_class_methods($this);
		foreach($options as $key => $value) {
			$method = 'set'.ucfirst($key);
			if(in_array($method, $methods)) $this->$method($value);
		}
		return $this;
	}
	
	public function setId($id) {
		$this->_id = (int) $id;
		return $this;
	}
	
	public function getId() {
		return $this->_id;
	}
	
	public function setUsername($username) {
		$this->_username = (string) $username;
		return $this;
	}
	
	public function getUsername() {
		return $this->_username;
	}
	
	public function setPassword($password) {
		$this->_password = (string) $password;
		return $this;
	}
	
	public function getPassword() {
		return $this->_password;
	}
	
	public function setRole($role) {
		$this->_role = (string) $role;
		return $this;
	}
	
	public function getRole() {
		return $this->_role;
	}
	
	public function setDateCreated($dateCreated) {
		$this->_dateCreated = $dateCreated;
		return $this;
	}
	
	public function getDateCreated() {
		return $this->_dateCreated;
	}
}

