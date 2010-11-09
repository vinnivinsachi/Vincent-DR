<?php

	//must have getProductForUser()
	//must have generateGSDetailsSession()
	class DatabaseObject_Shoutout extends DatabaseObject
	{
		
		public function __construct($db){
			parent::__construct($db, 'product_shoutouts', 'product_shoutout_id');
		
			$this->add('product_id');
			
			$this->add('shoutout_name');
			$this->add('shoutout_email');
			$this->add('uploader_id');
			//this belongs to somewhere else;
			//$this->add('shoutout_user_receive_notification', 1);
			//$this->add('shoutout_email_verification_cancelling', Text_Password::create(20, 'unpronounceable'));
			$this->add('shoutout_username');
			$this->add('shoutout_user_id');
			$this->add('shoutout_message');
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
		
		
	}
?>