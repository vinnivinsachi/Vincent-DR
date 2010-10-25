<?php
	class DatabaseObject_OrderProfileStatusAndDelivery extends DatabaseObject
	{
		
		public function __construct($db){
			parent::__construct($db, 'order_profile_status_and_delivery', 'order_profile_status_and_delivery_id');
			
			$this->add('order_profile_id');
			$this->add('order_status', 'UNSHIPPED');
			$this->add('product_tracking');
			$this->add('product_tracking_carrier');
			$this->add('product_shipping_date');
			$this->add('product_warning_delivery_date',time()+345600, self::TYPE_TIMESTAMP);
			$this->add('product_latest_delivery_date', time()+518400, self::TYPE_TIMESTAMP);
			$this->add('product_delivered_date');
			$this->add('product_completion_date');// the date of order completion if not returned and status = DELIVERED. 
			$this->add('product_return_tracking');
			$this->add('product_return_tracking_carrier');
			$this->add('product_return_shipping_date');
			$this->add('product_return_latest_delivery_date');
			$this->add('product_return_delivered_date');
			$this->add('product_return_completion_date');//
			$this->add('product_fund_allocation_date');
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
		
		public function loadByProfileId($id){
				$select = $this->_db->select();
				$select->from('order_profile_status_and_delivery', '*')
				->where('order_profile_id = ?', $id);
				
				echo $select;
				return $this->_load($select);
		}

	}
?>