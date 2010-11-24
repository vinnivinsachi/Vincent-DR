<?php

class Application_Model_Users_AccountRewardPointsAndBalanceSummary extends Custom_Model_Abstract
{
	protected $_primaryIDColumn = 'accountRewardPointsAndBalanceSummaryID';
	protected $_mapperClass = 'Application_Model_Mapper_Users_AccountRewardPointsAndBalanceSummary';
	
	public $accountRewardPointsAndBalanceSummaryID;
	public $userID;
	public $availableRewardPoints;
	public $ledgerRewardPoints;
	public $availableBalance;
	public $ledgerBalance;

	
}
?>