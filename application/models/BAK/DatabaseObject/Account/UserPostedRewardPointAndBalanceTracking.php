<?php

	class DatabaseObject_Account_UserPostedRewardPointAndBalanceTracking extends DatabaseObject
	{
		public function __construct($db)
		{
			
			parent::__construct($db, 'user_posted_reward_point_and_balance_tracking', 'user_posted_reward_point_and_balance_tracking_id');
			$this->add('user_pending_reward_point_and_balance_tracking_id');
			$this->add('user_id');
			$this->add('tracking_type');
			$this->add('caused_by_type');
			$this->add('from_order_id');
			$this->add('from_order_profile_id');
			$this->add('caused_by_user_id');
			$this->add('added_reward_points');
			$this->add('deducted_reward_points');
			$this->add('added_dollar_amount');
			$this->add('deducted_dollar_amount');
			$this->add('description');
			$this->add('date', time(), self::TYPE_TIMESTAMP);

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