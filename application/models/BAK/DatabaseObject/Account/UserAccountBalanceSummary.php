<?php

	class DatabaseObject_Account_UserAccountBalanceSummary extends DatabaseObject
	{
		public function __construct($db)
		{
			
			parent::__construct($db, 'user_account_balance_summary', 'user_account_balance_summary_id');
			
			$this->add('user_id');
			$this->add('available_reward_points', 0);
			$this->add('ledger_reward_points', 0);
			$this->add('available_balance', 0);
			$this->add('ledger_balance', 0);
		}
		
		
		protected function preInsert(){
		
			return true;
		}
		
		protected function postLoad(){
	
		}
		
		protected function postInsert(){
	
			return true;
		}
		
		protected function postUpdate(){
			
			return true;
		}
		
		protected function preDelete() {
		
			return true;
		}
		
		//Type is PENDING or POSTED
		public function REWARD_ADDITION($type, $amount ){
			echo "at reward addition with $type with amount $amount<br />";
			if($type =='PENDING'){
				$this->ledger_reward_points +=$amount;
			}elseif($type=='POSTED'){
				$this->available_reward_points +=$amount;
			}elseif($type=='CANCELLED'){
				$this->ledger_reward_points -=$amount;
			}
		}
		
		public function REWARD_DEDUCTION($type, $amount){
			echo "at reward deduction addition with $type<br />";

			if($type =='PENDING'){
			//$this->ledger_reward_points -=$amount;
			$this->available_reward_points -=$amount;
			}elseif($type=='POSTED'){
			$this->ledger_reward_points -=$amount;

			//$this->availabe_reward_points +=$amount;
			}elseif($type=='CANCELLED'){
			//$this->ledger_reward_points +=$amount;
			$this->available_reward_points +=$amount;
			}
			
		}
		
		public function BALANCE_ADDITION($type, $amount){
			echo "at balance addition with $type<br />";

			if($type =='PENDING'){
				$this->ledger_balance +=$amount;
			}elseif($type=='POSTED'){
				$this->available_balance +=$amount;
			//$this->availabe_reward_points +=$amount;
			}elseif($type=='CANCELLED'){
				$this->ledger_balance -=$amount;
			}
		}
		
		public function BALANCE_DEDUCTION($type, $amount){
			echo "at balance deduction addition with $type<br />";

			if($type =='PENDING'){
				$this->available_balance -=$amount;
			}elseif($type=='POSTED'){
			$this->ledger_balance -=$amount;
			//$this->availabe_reward_points -=$amount;
			}elseif($type=='CANCELLED'){
				//$this->ledger_balance +=$amount;
				$this->available_balance +=$amount;
			}
		}
		
		public function areEverySingleItemInCartProcessedInPendingAccountAndBalanceTrackingForOrderId($orderId){
			$orderInfo = array();
			$select =$this->_db->select();
			$select->from('order_profile', 'order_profile_id')
			->where('order_unique_id = ? ', $orderId);
			
			$result = $this->_db->fetchAll($select);
			
			$select2=$this->_db->select();
			$select2->from('user_pending_reward_point_and_balance_tracking', '*')
			->where('from_order_profile_id in (?)', $result)
			->where('status = ?', 'PENDING')
			->where('user_id = ?', $this->user_id);
			echo $select2;
			$result2 = $this->_db->fetchAll($select2);
			
			echo 'count is: '.count($result2);
			
			//check to see if there is any pending items for order_unique_id
			if(count($result2)==0){
				echo 'true';
				$orderInfo['processed']=true;
				
			}else{
				$orderInfo['processed']=false;
			}
			
			//checking to see if all item in cart is cancelled if all pending items are processed in order_unique_id. 
			if($orderInfo['processed']==true)
			{
				$select3=$this->_db->select();
				$select3->from('user_pending_reward_point_and_balance_tracking', '*')
				->where('from_order_profile_id in (?)', $result)
				->where('status = ?', 'CANCELLED')
				->where('user_id = ?', $this->user_id);
				echo $select3;
				$result3 = $this->_db->fetchAll($select3);
				
				if(count($result3)==count($result)){
				$orderInfo['allCancelled']=true;	
				}else{
				$orderInfo['allCancelled']=false;	
				}
			}
			
				Zend_Debug::dump($result);
			
				echo "OrderInfo:".Zend_Debug::dump($result2);
				
				Zend_Debug::dump($result3);

			return $orderInfo;
		}
		
	}
?>