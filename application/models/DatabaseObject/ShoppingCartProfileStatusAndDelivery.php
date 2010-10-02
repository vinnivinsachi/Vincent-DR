<?php
	class DatabaseObject_ShoppingCartProfile extends DatabaseObject
	{
		
		public function __construct($db){
			parent::__construct($db, 'shopping_cart_profile_status_and_delivery', 'shopping_cart_profile_status_and_delivery_id');
			
			$this->add('cart_profile_id');
			$this->add('order_status', 'UNSHIPPED');
			$this->add('product_tracking');
			$this->add('product_tracking_carrier');
			$this->add('product_shipping_date');
			$this->add('product_warning_delivery_date',time()+345600, self::TYPE_TIMESTAMP);
			$this->add('product_latest_delivery_date', time()+518400, self::TYPE_TIMESTAMP);
			$this->add('product_delivered_date');
			$this->add('product_returned', 0);
			$this->add('product_return_tracking');
			$this->add('product_return_tracking_carrier');
			$this->add('product_return_shipping_date');
			$this->add('product_return_latest_delivery_date');
			$this->add('product_return_delivered_date');
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