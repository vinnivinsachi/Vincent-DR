<?php

	//must have getProductForUser()
	//must have generateGSDetailsSession()
	class DatabaseObject_ReceiverMessage extends DatabaseObject
	{
		
		public function __construct($db){
			parent::__construct($db, 'receiver_message', 'receiver_message_id');
			$this->add('receiver_User_id');
			//$this->add('receiver_Username');
			$this->add('receiver_email');
			$this->add('receiver_name');
			$this->add('product_id');
			$this->add('sender_name');
			$this->add('sender_email');
			$this->add('sender_subject');
			//$this->add('sender_user_receive_notification', 1);
			//$this->add('sender_email_verification_cancelling', Text_Password::create(20, 'unpronounceable'));
			$this->add('sender_username');
			$this->add('sender_user_id');
			$this->add('sender_message');
			$this->add('message_read', '0');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			//this attribute is purely for the sake of passing it to other objects
		}
		
		//because of all the constraints make sure that all the profile stuff that is connected iwth the product must have something done to it when messing with the database. 
		protected function postLoad(){
			
		}
		
		protected function postInsert(){
			
			return true;
		}
		
		protected function postUpdate(){
			return true;
		}
		
		protected function preDelete(){
			
			return true;
		}
		
		protected function preInsert(){
			
			return true;
		}
		
		public function setImageDatabaseTable(){
		}
		
		public function setUsernameForProduct($username)
		{
		}
		
		public function isLive(){
		}
	
		public function sendLive(){
			
		}
		
		public function sendBackToDraft(){
		}
	}
?>