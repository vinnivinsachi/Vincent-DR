<?php

class Application_Model_Users_UserPendingRewardPointAndBalanceTracking extends Custom_Model_Abstract
{
	public $UserPendingRewardPointAndBalanceTrackingID;
	public $userPendingRewardPointAndBalanceTrackingUniqueID;
	public $trackingType;
	public $causedByType;
	public $fromOrderID;
	public $fromOrderProfileID;
	public $causedByUserID;
	public $addedRewardPoints;
	public $deductedRewardPoints;
	public $addedDollarAmount;
	public $deductedDollarAmount;
	public $status;
	public $description;
	public $dateCreated;
	public $dateUpdated;
	
	public function __construct(){
		//$this->pendingTrackingUniqueID=Text_Password::create(1, 'unpronounceable','alphabetical').Text_Password::create(8, 'unpronounceable','numeric');
	}
}

?>