<?php

class Application_Model_Mapper_Users_UsersMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Users_Users';
	protected $_modelClass = 'Application_Model_Users_User';
	
	public function save(Application_Model_Users_User $user) {
		// Generate password crypt and salt IF password provided
		if($user->password && $user->password != '') {
			$user->salt = $this->generateSalt();
			$user->password = $this->saltHashPassword($user->password, $user->salt);
		}
		else if($user->password == '') unset($user->password);
				
		// new user defaults
		if(($uniqueID = $user->uniqueID) === null) {
			$user->dateCreated = date('Y-m-d H:i:s');
			$user->role = 'buyer';
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
	
	public function findByUniqueID($uniqueID, array $options = null) {
		if(!$options) $options = array('exclude' => array('password', 'salt'));
		$users = $this->findByColumn('uniqueID', $uniqueID, $options);
		if(count($users) == 0) return null;
		if(count($users) > 1) throw new Exception('More than one user with the uniqueID: '.$uniqueID);
		return $users[0];
	}
	
	public function findByUsername($username, array $options = null) {
		if(!$options) $options = array('exclude' => array('password', 'salt'));
		$users = $this->findByColumn('username', $username, $options);
		if(count($users) == 0) return null;
		if(count($users) > 1) throw new Exception('More than one user with the username: '.$username);
		return $users[0];
	}
	
	public function usernameAvailable($username) {
		if($this->findByUsername($username, array('include', array('username')))) return false;
		else return true;
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

