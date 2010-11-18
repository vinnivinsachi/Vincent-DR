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
	
	public function areEverySingleItemInCartProcessedInPendingAccountAndBalanceTrackingForOrderId($orderId){
	
		//work when products are working. 
		//cart is working. 
		//and order profile is working. 
		
		
		$orderInfo = array();
		$select =$this->getDbTable()->select();
		$select->from('order_profile', 'order_profile_id')
		->where('order_unique_id = ? ', $orderId);
		
		$result = $this->getDbTable()->fetchAll($select);
		
		$select2=$this->getDbTable()->select();
		$select2->from('user_pending_reward_point_and_balance_tracking', '*')
		->where('from_order_profile_id in (?)', $result)
		->where('status = ?', 'PENDING')
		->where('user_id = ?', $this->user_id);
		echo $select2;
		$result2 = $this->getDbTable()->fetchAll($select2);
		
		echo 'count is: '.count($result2);
		
		//check to see if there is any pending items for order_unique_id
		if(count($result2)==0){
			echo 'true';
			$orderInfo['processed']=true;
		}else{
			$orderInfo['processed']=false;
		}
			
		
		/*$select=$this->getDbTable()->select();
		$select->from($this->getDbTable(), '*')
		->where('userID = ?', $user->userID)
		->order('dateUpdated DESC');*/	
	}
	
	public function save(Application_Model_Users_AccountRewardPointsAndBalanceSummary $accountRewardPointsAndBalanceSummary){
		
		parent::save($accountRewardPointsAndBalanceSummary);
		
	}
	

}
?>