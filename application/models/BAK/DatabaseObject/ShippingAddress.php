<?php

	class DatabaseObject_ShippingAddress extends DatabaseObject
	{
		public function __construct($db)
		{
			
			parent::__construct($db, 'shippingaddress', 'address_id');
			
			$this->add('User_id');
			$this->add('address_one');
			$this->add('address_two');
			$this->add('city');
			$this->add('state');
			$this->add('country', 'USA');
			$this->add('zip');
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
		
		
		public function loadByIDs($addressID, $userId){
			$select = $this->_db->select();
			
			$select->from('shippingaddress')
				   ->where('address_id = ?', $addressID)
				   ->where('User_id = ?', $userId);
			//echo $select;
			return $this->_load($select);
		}
		
		public static function loadByUserId($db, $userId){
			$select = $db->select();
			
			$select->from('shippingaddress')
				   ->where('User_id = ?', $userId);
				   		
			return $db->fetchAll($select);		
		}
	}
?>