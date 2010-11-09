<?php

class Application_Model_Users_User extends Custom_Model_Abstract
{
	public $id;
	public $username;
	public $password;
	public $role;
	public $dateCreated;
	public $lastLogin;
	
	public $details; // Application_Model_Users_UserDetails
	
	
//	public function setId($id) {
//		$this->_id = (int) $id;
//		return $this;
//	}
//	
//	public function getId() {
//		return $this->_id;
//	}
//	
//	public function setUsername($username) {
//		$this->_username = (string) $username;
//		return $this;
//	}
//	
//	public function getUsername() {
//		return $this->_username;
//	}
//	
//	public function setPassword($password) {
//		$this->_password = (string) $password;
//		return $this;
//	}
//	
//	public function getPassword() {
//		return $this->_password;
//	}
//	
//	public function setRole($role) {
//		$this->_role = (string) $role;
//		return $this;
//	}
//	
//	public function getRole() {
//		return $this->_role;
//	}
//	
//	public function setDateCreated($dateCreated) {
//		$this->_dateCreated = $dateCreated;
//		return $this;
//	}
//	
//	public function getDateCreated() {
//		return $this->_dateCreated;
//	}
}

