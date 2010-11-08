<?php

	class DatabaseObject_Account_UserAccountBalanceTransferTracking extends DatabaseObject
	{
		public function __construct($db)
		{	
			parent::__construct($db, 'user_account_balance_transfer_tracking', 'user_account_balance_transfer_tracking_id');
			$this->add('balance_transfer_unique_id',Text_Password::create(1, 'unpronounceable','alphabetical').Text_Password::create(8, 'unpronounceable','numeric'));
			$this->add('from_user_id');
			$this->add('to_user_id');
			$this->add('to_user_email');
			$this->add('to_username');
			$this->add('balance_transfer_amount');
			$this->add('status', 'PENDING');
			$this->add('sender_pending_tracking_id');
			$this->add('receiver_pending_tracking_id');
			$this->add('message');
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