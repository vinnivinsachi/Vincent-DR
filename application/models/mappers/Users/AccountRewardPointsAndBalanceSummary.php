<?php

class Application_Model_Mapper_Users_AccountRewardPointsAndBalanceSummary extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Users_AccountRewardPointsAndBalanceSummary';
	protected $_modelClass = 'Application_Model_Users_AccountRewardPointsAndBalanceSummary';

	public function getAccountSummaryForUser(Application_Model_Users_User $user, array $options = null){
		return $this->findByColumn('userID', $user->userID, $options);	
	}
	
	public function REWARD_ADDITION(Application_Model_Users_AccountRewardPointsAndBalanceSummary $accountRewardPointsAndBalanceSummary, $type, $amount ){
		echo "at reward addition with $type with amount $amount<br />";
		if($type =='PENDING'){
			$accountRewardPointsAndBalanceSummary->ledgerRewardPoints +=$amount;
		}elseif($type=='POSTED'){
			$accountRewardPointsAndBalanceSummary->availableRewardPoints +=$amount;
		}elseif($type=='CANCELLED'){
			$accountRewardPointsAndBalanceSummary->ledgerRewardPoints -=$amount;
		}
	}
	
	public function REWARD_DEDUCTION(Application_Model_Users_AccountRewardPointsAndBalanceSummary $accountRewardPointsAndBalanceSummary, $type, $amount){
		echo "at reward deduction addition with $type<br />";

		if($type =='PENDING'){
		//$this->ledger_reward_points -=$amount;
		$accountRewardPointsAndBalanceSummary->availableRewardPoints -=$amount;
		}elseif($type=='POSTED'){
		$accountRewardPointsAndBalanceSummary->ledgerRewardPoints -=$amount;

		//$this->availabe_reward_points +=$amount;
		}elseif($type=='CANCELLED'){
		//$this->ledger_reward_points +=$amount;
		$accountRewardPointsAndBalanceSummary->availableRewardPoints +=$amount;
		}
	}
	
	public function BALANCE_ADDITION(Application_Model_Users_AccountRewardPointsAndBalanceSummary $accountRewardPointsAndBalanceSummary, $type, $amount){
		echo "at balance addition with $type<br />";

		if($type =='PENDING'){
			$accountRewardPointsAndBalanceSummary->ledgerBalance +=$amount;
		}elseif($type=='POSTED'){
			$accountRewardPointsAndBalanceSummary->availableBalance +=$amount;
		//$this->availabe_reward_points +=$amount;
		}elseif($type=='CANCELLED'){
			$accountRewardPointsAndBalanceSummary->ledgerBalance -=$amount;
		}
	}
	
	public function BALANCE_DEDUCTION(Application_Model_Users_AccountRewardPointsAndBalanceSummary $accountRewardPointsAndBalanceSummary, $type, $amount){
		echo "at balance deduction addition with $type<br />";

		if($type =='PENDING'){
			$accountRewardPointsAndBalanceSummary->availableBalance -=$amount;
		}elseif($type=='POSTED'){
		$accountRewardPointsAndBalanceSummary->ledgerBalance -=$amount;
		//$this->availabe_reward_points -=$amount;
		}elseif($type=='CANCELLED'){
			//$this->ledger_balance +=$amount;
			$accountRewardPointsAndBalanceSummary->availableBalance +=$amount;
		}
	}
	
	public function save(Application_Model_Users_AccountRewardPointsAndBalanceSummary $accountRewardPointsAndBalanceSummary){
		
		parent::save($accountRewardPointsAndBalanceSummary);
		
	}
	

}
?>