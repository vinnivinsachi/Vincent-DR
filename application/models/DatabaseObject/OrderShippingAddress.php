<?php

	class DatabaseObject_OrderShippingAddress extends DatabaseObject
	{
		public function __construct($db)
		{
			
			parent::__construct($db, 'order_shipping_address', 'address_id');
			
			$this->add('address_one');
			$this->add('address_two');
			$this->add('city');
			$this->add('state');
			$this->add('country');
			$this->add('zip');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
		}
		
		
		protected function preInsert(){
			return true;
		}
		
		protected function postLoad(){
			return true;
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
		
		public function loadByIDs($addressID, $orderId){
			$select = $this->_db->select();
			$select->from('shippingaddress')
				   ->where('address_id = ?', $addressID)
				   ->where('order_unique_id = ?', $orderId);
			//echo $select;
			return $this->_load($select);
		}
		
		public static function loadByUserId($db, $orderId){
			$select = $db->select();
			$select->from('shippingaddress')
				   ->where('order_unique_id = ?', $orderId);
			return $db->fetchAll($select);
		}
	}
?>