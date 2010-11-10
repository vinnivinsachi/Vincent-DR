<?php

class Application_Model_Users_User extends Custom_Model_Abstract
{
	public $userID;
	public $username;
	public $password;
	public $salt;
	public $role;
	public $dateCreated;
	public $lastLogin;
	
	public $referralID;
	public $uniqueID;
	public $email;
	public $sex;
	public $measurement;
	public $firstName;
	public $lastName;
	public $isInstructor;
	public $findingPartner;
	public $status;
	public $rewardPoints;
	public $verification;
	public $typeID;
	public $reviewCount;
	public $reviewAverageScore;
	public $reviewTotalScore;
	
	// private variables won't show un in SQL queries
	private $_shippingAddresses;

	
	public function setShippingAddresses(array $addresses) { $this->_shippingAddresses = $addresses; }
	public function getShippingAddresses() { return $this->_shippingAddresses; }

}

