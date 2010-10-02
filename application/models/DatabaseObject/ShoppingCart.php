<?php

	class DatabaseObject_ShoppingCart extends DatabaseObject
	{
		public $shippingAddress;
		public $products = array();
		public function __construct($db){
			parent::__construct($db, 'shopping_cart', 'cart_id');
			$this->add('order_unique_id', Text_Password::create(16, 'unpronounceable','alphabetical'));
			$this->add('order_shipping_id');
			$this->add('buyer_username');
			$this->add('buyer_id');
			$this->add('buyer_email');
			$this->add('buyer_name');
			$this->add('total_number_items');
			$this->add('cart_costs');
			$this->add('total_costs');
			$this->add('total_shipping_costs');
			$this->add('reward_points_awarded');
			$this->add('reward_points_used');
			$this->add('reward_amount_deducted');
			$this->add('promotion_code_used');
			$this->add('promotion_amount_deducted');
			$this->add('final_total_costs');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->shippingAddress = new DatabaseObject_OrderShippingAddress($db);
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
			$this->shippingAddress->load($this->order_shipping_id);	
		}
	
		public function loadCartOnly($order_unique_id){
			$select = $this->_db->select();
			$select->from('shopping_cart')
				   ->where('order_unique_id = ?', $order_unique_id);
			//echo $select;
			return $this->_load($select);
		}
		
		/*public function loadCartProductsForDeletion(){
			$select = $this->_db->select();
			$select->from('shopping_cart_profile', 'shopping_cart_profile_id')
					->where('order_unique_id = ?', $this->order_unique_id);
			//echo $select;
			$idArray = $this->_db->fetchAll($select);
			//Zend_Debug::dump($productArray);
			foreach($idArray as $k=>$v){
			echo $v['shopping_cart_profile_id'];
			$this->products[$v['shopping_cart_profile_id']]=new DatabaseObject_ShoppingCartProfile($this->_db);
			$this->products[$v['shopping_cart_profile_id']]->load($v);
			}
			
		}*/
		
		public function loadCartProducts(){
			$select = $this->_db->select();
			$select->from('shopping_cart_profile', '*')
					->where('order_unique_id = ?', $this->order_unique_id);
			//echo $select;
			$productArray = $this->_db->fetchAll($select);
			//Zend_Debug::dump($productArray);
			foreach($productArray as $k=>$v){
				$attributeSelect = $this->_db->select();
				$attributeSelect->from('shopping_cart_profile_attribute', '*')
				->where('shopping_cart_profile_attribute_id = ? ', $v['shopping_cart_profile_id']);
				$productAttribute = $this->_db->fetchAll($attributeSelect);
				$this->products[$v['shopping_cart_profile_id']]=$v;
				$this->products[$v['shopping_cart_profile_id']]['profile']=$productAttribute;
			}
		}
	}
?>