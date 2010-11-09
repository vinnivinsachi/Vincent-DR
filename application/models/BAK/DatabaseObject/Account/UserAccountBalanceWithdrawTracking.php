<?php

	class DatabaseObject_Account_UserAccountBalanceWithdrawTracking extends DatabaseObject
	{
		public function __construct($db)
		{
			
			parent::__construct($db, 'user_account_balance_withdraw_tracking', 'user_account_balance_withdraw_tracking_id');
			$this->add('balance_withdraw_unique_id',Text_Password::create(1, 'unpronounceable','alphabetical').Text_Password::create(8, 'unpronounceable','numeric'));
			$this->add('user_id');
			$this->add('balance_withdraw_amount');
			$this->add('status', 'PENDING');
			$this->add('pending_tracking_id');
			$this->add('date_of_request', time(), self::TYPE_TIMESTAMP);
			$this->add('date_processed');
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
		
	}
?>