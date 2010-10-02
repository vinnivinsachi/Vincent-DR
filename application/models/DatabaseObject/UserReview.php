<?php

	//must have getProductForUser()
	//must have generateGSDetailsSession()
	class DatabaseObject_UserReview extends DatabaseObject
	{
		
		public function __construct($db){
			parent::__construct($db, 'user_review', 'user_review_id');
			$this->add('rating');
			$this->add('description');
			$this->add('order_profile_id');
			$this->add('order_unique_id');
			$this->add('order_product_name');
			$this->add('User_id');
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