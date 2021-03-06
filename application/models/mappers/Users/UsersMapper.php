<?php

class Application_Model_Mapper_Users_UsersMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Users_Users';
	protected $_modelClass = 'Application_Model_Users_User';
	
	public function save(Application_Model_Users_User $user) {
		// right now users can only be saved one at a time
			if(is_array($user)) throw new Exception('Saving an array of users in not yet supported');
		
		// Generate password crypt and salt IF password provided
			if($user->password && $user->password != '') {
				$user->salt = $this->generateSalt();
				$user->password = $this->saltHashPassword($user->password, $user->salt);
			}
			else if($user->password == '') unset($user->password);
				
		// new user defaults
			if(($uniqueID = $user->userUniqueID) === null) {
				$user->userUniqueID = $this->createUniqueID();
			}
		
		// call parent function
			parent::save($user);
	}
	
	public function findByUsername($username, array $options = null) {
		if(!$options) $options = array('exclude' => array('password', 'salt'));
		return $this->findByColumn('username', $username, $options);
	} // END findByUsername()
	
	public function findByEmail($email, array $options = null) {
		return $this->findByColumn('email', $email, $options);
	} // END findByEmail()
	
	// is the given username available?
	// returns true / false
	public function usernameAvailable($username) {
		if($this->findByUsername($username, array('include', array('username')))) return false;
		else return true;
	}
	
	// is the given email available?
	// return true / false
	public function emailAvailable($email) {
		if($this->findByEmail($email, array('include', array('email')))) return false;
		else return true;
	}
	
	public function findByUniqueID($uniqueID, array $options = null) {
		if(!$options) $options = array('exclude' => array('password', 'salt'));
		return parent::findByUniqueID($uniqueID, $options);
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

