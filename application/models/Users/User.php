<?php

class Application_Model_Users_User extends Custom_Model_Abstract
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
	public $userType;
	public $reviewCount;
	public $reviewAverageScore;
	public $reviewTotalScore;
	public $dateCreated;
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
	
	public function __construct(array $options = null) {
		parent::__construct($options);
		$this->dateCreated = date('Y-m-d H:i:s');
	}
	
}
