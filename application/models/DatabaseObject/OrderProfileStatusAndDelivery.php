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
			$this->add('product_completion_date');//
			$this->add('product_returned', 0);
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

	}
?>