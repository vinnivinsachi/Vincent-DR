<?php

class Application_Model_Users_User extends Custom_Model_Abstract implements Zend_Acl_Role_Interface
{
	// setup
	protected $_primaryIDColumn = 'userID';
	protected $_mapperClass = 'Application_Model_Mapper_Users_UsersMapper';
	private $dateCreated;
	private $dateUpdated;
	
	// columns
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
	public $lastLogin;
	public $salt;
	public $affiliation;
	public $experience;
	public $defaultShippingAddressID;
	
	// private variables won't show up in SQL queries
	protected $shippingAddresses;
	protected $defaultShippingAddress;
	protected $accountRewardPointsAndBalanceSummary;
	protected $profiles;
	protected $storeLinks;
	
	// used for ACL
	public function getRoleId() {
		return $this->role;
	}
	
}
