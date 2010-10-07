<?php
	class DatabaseObject_OrderProfile extends DatabaseObject
	{
		public $productShippingAddress=null;
		public $profile =null;
		public $orderStatus = null;
		
		public function __construct($db){
			parent::__construct($db, 'order_profile', 'order_profile_id');
			
			$this->add('order_unique_id');
			$this->add('order_id');
			$this->add('product_id'); 
			$this->add('product_type');
			$this->add('purchase_type');
			$this->add('inventory_attribute_table'); //need
			$this->add('product_inventory_id');
			$this->add('uploader_username');
			$this->add('uploader_email'); //need
			$this->add('uploader_id');
			$this->add('product_country_origin'); //need
			$this->add('product_name');
			$this->add('product_price');
			$this->add('product_tag');
			$this->add('backorder_time');
			$this->add('product_image_id');
			$this->add('reward_points_awarded');
			$this->add('domestic_shipping_rate'); //need
			$this->add('international_shipping_rate'); //need
			$this->add('current_shipping_rate'); //need
			$this->add('product_type_added_to_shopping_cart'); //need
			$this->add('order_shipping_id');
			$this->add('return_allowed');
			$this->add('seller_receivable');//for seller
			$this->add('buyer_name');
			$this->add('buyer_id');
			$this->add('buyer_username');
			$this->add('buyer_email');
			$this->add('buyer_country');//buyer_network;
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			
			$this->profile= new Profile_OrderProfileAttribute($db);
			$this->orderStatus = new DatabaseObject_OrderProfileStatusAndDelivery($db);
		
		}
		
		protected function preInsert(){
			
			return true;
		}
		
		protected function postUpdate(){
		}
		
		protected function postInsert(){
			$this->profile->setProfileId($this->getId());
			$this->profile->save(false);
			return true;
		}
		
		protected function postLoad(){
			$this->profile->setProfileId($this->getId());
			$this->profile->load();
			$this->orderStatus->load($this->getId());
		}
	
		public function loadCartOnly($order_unique_id){
			$select = $this->_db->select();
			$select->from('shopping_cart')
				   ->where('order_unique_id = ?', $order_unique_id);
			//echo $select;
			return $this->_load($select);
		}
		public function loadShippingAddressForProduct(){
			$this->productShippingAddress= new DatabaseObject_OrderShippingAddress($this->db);
			$this->productShippingAddress->load($this->order_shipping_address_id);
		}
	}
?>