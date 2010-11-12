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
	public $defaultShippingAddressID;
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
	public $affiliation;
	public $experience;
	
	// private variables won't show un in SQL queries
	private $_shippingAddresses;
	private $_defaultShippingAddress;
	private $_accountRewardPointsAndBalanceSummary;

	
	public function setShippingAddresses(array $addresses) { $this->_shippingAddresses = $addresses; }
	public function getShippingAddresses() { return $this->_shippingAddresses; }
	
	public function setDefaultShippingAddress(array $address) { $this->_defaultShippingAddress = $address; }
	public function getDefaultShippingAddress() { return $this->_defaultShippingAddress; }
	
	public function setAccountRewardPointsAndBalance(Application_Model_Users_AccountRewardPointsAndBalanceSummary $accountRewardPointsAndBalanceSummary){$this->_accountRewardPointsAndBalanceSummary = $accountRewardPointsAndBalanceSummary;}
	
	public function getAccountRewardPointsAndBalance(){ return $this->_accountRewardPointsAndBalanceSummary;}

}
