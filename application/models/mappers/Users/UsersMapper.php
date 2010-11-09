<?php

class Application_Model_Mapper_Users_UsersMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Users_Users';
	protected $_modelClass = 'Application_Model_Users_User';
	
	protected $_columns = array(
		'username'				=> null,
		'password'				=> null,
		'salt'					=> null,
		'role'					=> null,
		'lastLogin'				=> null,
		'dateCreated'			=> null,
	
		'userID'				=> null,
		'referralID'			=> null,
		'uniqueID'				=> null,
		'email'					=> null,
		'sex'					=> null,
		'measurement'			=> null,
		'firstName'				=> null,
		'lastName'				=> null,
		'isInstructor'			=> null,
		'findingPartner'		=> null,
		'status'				=> null,
		'rewardPoints'			=> null,
		'verification'			=> null,
		'typeID'				=> null,
		'reviewCount'			=> null,
		'reviewAverageScore'	=> null,
		'reviewTotalScore'		=> null,
	);
	
	public function save(Application_Model_Users_User $user) {
		// Generate password crypt and salt IF password provided
		if($user->password) {
			$user->salt = $this->generateSalt();
			$user->password = $this->saltHashPassword($user->password, $user->salt);
		}
				
		// Add date and uniqueID to new users
		if(($uniqueID = $user->uniqueID) === null) {
			$user->dateCreated = date('Y-m-d H:i:s');
			$user->uniqueID = $this->createUniqueID();
		}
		
		parent::save($user);
	}
	
	public function createUniqueID() {
		do {
			$uniqueID = Text_Password::create(10, 'unpronounceable');
		} while($this->findByUniqueID($uniqueID));
		return $uniqueID;
	}
	
	public function findByUniqueID($uniqueID) {
		$select = $this->getDbTable()->select();
		$select->where('uniqueID = ?', $uniqueID);
		$result = $this->getDbTable()->fetchAll($select);
		if(count($result) == 0) return null;
		if(count($result) > 1) exit('More than one user with the same uniqueID: '.$uniqueID);
		$row = $result->current();
		$userData = $row->toArray();
		$user = new Application_Model_Users_User($userData);
		return $user;
	}
	
	public function findByUsername($username, array $options = null) {
		$columns = $this->getColumns($options);
		
		$select = $this->getDbTable()->select();
		$select->from($this->getDbTable(), $columns)
			   ->where('username = ?', $username);
		$result = $this->getDbTable()->fetchAll($select);
		if(count($result) == 0) return null;
		if(count($result) > 1) exit('More than one user with the same username: '.$username);
		$row = $result->current();
		$userData = $row->toArray();
		$user = new Application_Model_Users_User($userData);
		return $user;
	}
	
	public function usernameAvailable($username) {
		$select = $this->getDbTable()->select();
		$select->where('username = ?', $username);
		$result = $this->getDbTable()->fetchAll($select);
		if(count($result) == 0) return true;
		else return false;
	}
	
	public function updateLastLogin($user) {
		$user->lastLogin = date('Y-m-d H:i:s');
		$this->save($user);
		return $user;
	}

	
	// ---------------------------------- HELPER FUNCTIONS ------------------------------------
	private function generateSalt() {
		return sha1(time());
	}
	
	private function saltHashPassword($password, $salt) {
		return sha1($password.$salt);
	}
}

