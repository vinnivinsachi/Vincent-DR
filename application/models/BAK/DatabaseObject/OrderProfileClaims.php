<?php
	class DatabaseObject_OrderProfileClaims extends DatabaseObject
	{
		
		public function __construct($db){
			parent::__construct($db, 'order_profile_claims', 'order_profile_claims_id');
			
			$this->add('order_profile_id');
			$this->add('filed_by_type');
			$this->add('filer_name');
			$this->add('filing_reason');
			$this->add('description');
			$this->add('status');
			$this->add('filer_phone_number');
			$this->add('ts_created',time(), self::TYPE_TIMESTAMP);
			$this->add('ts_updated', date('Y-m-d G:i:s'));
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