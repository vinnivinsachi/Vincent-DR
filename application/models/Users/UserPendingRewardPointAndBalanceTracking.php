<?php

class Application_Model_Users_UserPendingRewardPointAndBalanceTracking extends Custom_Model_Abstract
{
	protected $_primaryIDColumn = 'userPendingRewardPointAndBalanceTrackingID';
	protected $_mapperClass = 'Application_Model_Mapper_Users_UserPendingRewardPointAndBalanceTracking';
	
	public $userPendingRewardPointAndBalanceTrackingID;
	public $userPendingRewardPointAndBalanceTrackingUniqueID;
	public $userID;
	public $trackingType;
	public $causedByType;
	public $fromOrderID;
	public $fromOrderProfileID;
	public $causedByUserID;
	public $REWARD_ADDITION;
	public $REWARD_DEDUCTION;
	public $BALANCE_DEDUCTION;
	public $BALANCE_ADDITION;
	public $status;
	public $description;
	public $dateCreated;
	public $dateUpdated;
		
}

?>