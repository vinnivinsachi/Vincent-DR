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
		
		
		
	}
?>