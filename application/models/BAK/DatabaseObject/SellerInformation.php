<?php

	class DatabaseObject_SellerInformation extends DatabaseObject
	{
		public function __construct($db)
		{
			
			parent::__construct($db, 'sellerinformation', 'User_id');
			
			$this->add('User_id');
			$this->add('unique_identifier', Text_Password::create(10, 'unpronounceable'));
			$this->add('verified', 0);
			$this->add('paypal_email');
			$this->add('phone_number');
			$this->add('type');
			$this->add('address_one');
			$this->add('address_two');
			$this->add('city');
			$this->add('state');
			$this->add('country', 'USA');
			$this->add('zip');
			$this->add('items_description');
			$this->add('store_description', '');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->add('status', 'pending'); //different type of status is ('pendingGeneralSeller', 'pendingStoreSeller','confirmedGeneralSeller', 'confirmedStoreSeller')

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
		
		public function emailExists($email, $userId){
			
			$query=sprintf("select count(*) as num from %s where paypal_email = '%s' and User_id != '%d'", $this->_table, $email, $userId);
			$result = $this->_db->fetchOne($query);
			return $result;
		}
		
		public static function verifyPaypalEmailAccount($db, $uniqueId){
			$select = $db->select();
			$select->from('sellerinformation', 'count(*)')
				->where('unique_identifier = ?', $uniqueId);
			$result = $db->fetchOne($select);
			
			if($result){
				$data = array('verified' => 1);
				$db->update('sellerinformation', $data, "unique_identifier = '".$uniqueId."'");
				return true;
			}else{
				return false;
			}
		}
	}
?>