<?php

class Application_Model_Mapper_Users_UsersMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable) {
		if(is_string($dbTable)) $dbTable = new $dbTable();
		if(!$dbTable instanceof Zend_Db_Table_Abstract) throw new Exception('Invalid table data gateway provided');
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable() {
		if($this->_dbTable === null) $this->setDbTable('Application_Model_DbTable_Users_Users');
		return $this->_dbTable;
	}
	
	public function save(Application_Model_Users_User $user) {
		$data = array(
			'username'	=> $user->username,
			'dateCreated'	=> date('Y-m-d H:i:s'),
		);
		
		// Generate password crypt and salt IF password provided
		if($user->getPassword()) {
			$data['salt'] = $this->generateSalt();
			$data['password'] = $this->saltHashPassword($user->password, $data['salt']);
		}
		
		// Add a new user, or update and existing user
		if(($id = $user->id) === null) $this->getDbTable()->insert($data);
		else $this->getDbTable()->update($data, array('id = ?' => $id));
	}
	
	public function find($id) {
		$result = $this->getDbTable()->find($id);
		if(count($result) == 0) return null; // return null if nothing found
		$row = $result->current();
		$userData = $row->toArray();
		unset($userData['password']);
		$user = new Application_Model_Users_User($userData);
		return $user;
	}
	
	public function findByUsername($username) {
		$select = $this->getDbTable()->select();
		$select->where('username = ?', $username);
		$result = $this->getDbTable()->fetchAll($select);
		if(count($result) == 0) return null;
		if(count($result) > 1) exit('More than one user with the same username: '.$username);
		$row = $result->current();
		$userData = $row->toArray();
		unset($userData['password']);
		$user = new Application_Model_Users_User($userData);
		return $user;
	}
	
	public function fetchAll() {
		$resultSet = $this->getDbTable()->fetchAll();
		$users = array();
		foreach($resultSet as $row) {
			$userData = $row->toArray();
			unset($userData['password']);
			$user = new Application_Model_Users_User($userData);
			$users[] = $user;
		}
		return $users;
	}
	
	public function usernameAvailable($username) {
		$select = $this->getDbTable()->select();
		$select->where('username = ?', $username);
		$result = $this->getDbTable()->fetchAll($select);
		if(count($result) == 0) return true;
		else return false;
	}

	
	// ---------------------------------- HELPER FUNCTIONS ------------------------------------
	private function generateSalt() {
		return sha1(time());
	}
	
	private function saltHashPassword($password, $salt) {
		return sha1($password.$salt);
	}
}

