<?php

class Application_Model_Users_UserAccountBalanceWithdrawTracking extends Custom_Model_Abstract
{
	protected $_primaryIDColumn = 'userAccountBalanceWithdrawTrackingID';
	protected $_mapperClass = 'Application_Model_Mapper_Users_UserAccountBalanceWithdrawTracking';
	
	public $userAccountBalanceWithdrawTrackingID;
	public $userAccountBalanceWithdrawTrackingUniqueID;
	public $userID;
	public $balanceWithdrawAmount;
	public $pendingTrackingID;
	public $status;
	public $dateCreated;
	public $dateUpdated;
	
	
}

?>