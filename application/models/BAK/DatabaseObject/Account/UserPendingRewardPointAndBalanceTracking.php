<?php

	class DatabaseObject_Account_UserPendingRewardPointAndBalanceTracking extends DatabaseObject
	{
		public function __construct($db)
		{
			
			parent::__construct($db, 'user_pending_reward_point_and_balance_tracking', 'user_pending_reward_point_and_balance_tracking_id');
			$this->add('pending_tracking_unique_id',Text_Password::create(1, 'unpronounceable','alphabetical').Text_Password::create(8, 'unpronounceable','numeric'));
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
			$this->add('status');
			$this->add('description');
			$this->add('date', time(), self::TYPE_TIMESTAMP);
			$this->add('ts_updated', date('Y-m-d G:i:s'));


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
		
		public function loadUserPendingTrackingFromTrackingId($user_id, $pending_tracking_id){
			$select=$this->_db->select();
			$select->from($this->_table, '*')
			->where('user_id = ?', $user_id)
			->where("$this->_idField = ?", $pending_tracking_id);
			echo $select;
			
			return $this->_load($select);	
		}
		
		public function loadAllUserRecords($user_id, $param=array()){
			$records=array();
			$select=$this->_db->select();
			$select->from($this->_table, '*')
			->where('user_id = ?', $user_id)
			->order('ts_updated DESC');
			
			if(isset($param['begin_date'])){
				$select->where('date > ?', $param['begin_date']);
			}
			
			if(isset($param['end_date'])){
				$select->where('date < ?', $param['end_date']);
			}
			
			if(isset($param['limit'])){
				$select->limitPage($param['limit'],40);
			}
			
			echo '<br />record loader select: '.$select;
			
			
			
			return $this->_db->fetchAll($select);
			
		}
		
		public static function loadTrackingIdByColumnId($db, $userId, $column, $id){
			$select=$db->select();
			$select->from('user_pending_reward_point_and_balance_tracking', '*')
			->where('user_id = ?', $userId)
			->where('status = ?', 'PENDING')
			->where("$column = ?", $id);
			
			echo $select;
			$result = $db->fetchAll($select);
			return $result;
		}
		
		
	}
?>