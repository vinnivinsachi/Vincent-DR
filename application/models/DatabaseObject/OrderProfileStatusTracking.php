<?php
	class DatabaseObject_OrderProfileStatusTracking extends DatabaseObject
	{
		
		public function __construct($db){
			parent::__construct($db, 'order_profile_status_tracking', 'order_profile_status_tracking_id');
			
			$this->add('order_profile_id');
			$this->add('status');
			$this->add('status_changed_date',time(), self::TYPE_TIMESTAMP);
			$this->add('message');
		}
		
		protected function preInsert(){
			return true;
		}
		
		protected function postInsert(){
			return true;
		}
		
		protected function preDelete(){
			return true;
		}
		
		protected function postLoad(){
	
		}

	}
?>