<?php

class Application_Model_Users_User extends Custom_Model_Abstract implements Zend_Acl_Role_Interface
{
	
	public $userID;
	public $referrerID;
	public $userUniqueID;
	public $username;
	public $password;
	public $email;
	public $sex;
	public $measurement;
	public $firstName;
	public $lastName;
	public $role = 'member';
	public $isInstructor;
	public $findingPartner;
	public $status;
	public $rewardPoints;
	public $verification;
	public $reviewCount;
	public $reviewAverageScore;
	public $reviewTotalScore;
	public $dateCreated;
	public $lastLogin;
	public $salt;
	public $affiliation;
	public $experience;
	public $defaultShippingAddressID;
	public $dateUpdated;

	
	// private variables won't show up in SQL queries
	protected $shippingAddresses;
	protected $defaultShippingAddress;
	protected $accountRewardPointsAndBalanceSummary;
	protected $profiles;
	protected $stores;
	
	
	public function getRoleId() {
		return $this->role;
	}
	
}
