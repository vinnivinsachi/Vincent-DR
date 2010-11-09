<?php

class Application_Model_Mapper_Users_UsersMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Users_Users';
	
	public function save(Application_Model_Users_User $user) {
		$data = array(
			'username'		=> $user->username,
			'role'			=> isset($user->role) ? $user->role : 'buyer',
			'lastLogin'		=> isset($user->lastLogin) ? $user->lastLogin : '0000-00-00 00:00:00',
		
			'userID'		=> $details->userID,
			'referralID'	=> $details->referralID,
			'refereeID'	=> $details->refereeID,
			'email'	=> $details->email,
			'sex'	=> $details->sex,
			'measurement'	=> $details->measurement,
			'firstName'	=> $details->firstName,
			'lastName'	=> $details->lastName,
			'isInstructor'	=> $details->isInstructor,
			'findingPartner'	=> $details->findingPartner,
			'status'	=> $details->status,
			'rewardPoints'	=> $details->rewardPoints,
			'verification'	=> $details->verification,
			'typeID'	=> $details->typeID,
			'reviewCount'	=> $details->reviewCount,
			'reviewAverageScore'	=> $details->reviewAverageScore,
			'reviewTotalScore'	=> $details->reviewTotalScore,
		);
		
		// Generate password crypt and salt IF password provided
		if($user->password) {
			$data['salt'] = $this->generateSalt();
			$data['password'] = $this->saltHashPassword($user->password, $data['salt']);
		}
		
		// Add a new user, or update and existing user
		if(($id = $user->id) === null) {
			$data['dateCreated'] = date('Y-m-d H:i:s');
			$userID = $this->getDbTable()->insert($data);
			// also add new user details if it is a new user
				$detailsMapper = new Application_Model_Mapper_Users_UserDetailsMapper;
				$detailsMapper->newDetailsForUserID($userID);
		}
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

