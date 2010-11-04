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
			$this->add('product_returned', 0);
			$this->add('product_return_tracking');
			$this->add('product_return_tracking_carrier');
			$this->add('product_return_shipping_date');
			$this->add('product_return_latest_delivery_date');
			$this->add('product_return_delivered_date');
			$this->add('product_return_completion_date');//
			$this->add('product_fund_allocation_date');
			
			$this->add('buyer_return_claim_filed', 0); //NULL allowed, filing for a forced return on a none returnable item.
			$this->add('buyer_return_claim_filed_date'); //NULL allowed
			$this->add('buyer_return_claim_approved', 0); //NULL allowed
			$this->add('buyer_return_claim_approval_date'); //date of the approval by whether Seller or DR
			$this->add('buyer_return_claim_approved_by');
			$this->add('buyer_return_claim_approved_by_seller_latest_date'); //date of the latest date before DR jumps in to investigate.
			
			$this->add('buyer_return_claim_approved_warning_shipping_date');
			$this->add('buyer_return_claim_approved_latest_shipping_date');
			
			$this->add('seller_claim_filed', 0); //NULL allowed, filling for a problem on a returned item.
			$this->add('seller_claim_filed_date'); //NULL allowed
			$this->add('seller_claim_approved', 0); //NULL allowed
			$this->add('seller_claim_approved_date');
			
			$this->add('seller_claim_approved_return_tracking'); 
			$this->add('seller_claim_approved_return_tracking_carrier'); 
			$this->add('seller_claim_approved_return_shipping_date'); 
			$this->add('seller_claim_approved_return_latest_delivery_date'); 
 			$this->add('seller_claim_approved_return_delivered_date'); 
			
			$this->add('cancelled_by_buyer', 0);
			$this->add('cancelled_by_buyer_date');
			$this->add('cancelled_by_seller', 0);
			$this->add('cancelled_by_seller_date');
			
			
			$this->add('product_cancelled_date');
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