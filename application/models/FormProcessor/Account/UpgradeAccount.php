<?php

	class FormProcessor_Account_UpgradeAccount extends FormProcessor  
	{
		
		
		public function __construct($db, $userID='', $type=''){
			parent::__construct();
			$this->db= $db;
			$this->userID=$userID;
			$this->type=$type;
			echo "here at php type is: ".$this->type;
			$this->sellerInformation = new DatabaseObject_SellerInformation($db);
			if(($type=='generalSeller' || $type=='storeSeller')&&$userID!=''){
				if($this->sellerInformation->load($userID)){
					echo "<br />here at load<br />";
					echo "sellerInformation->paypal_email is: ".$this->sellerInformation->paypal_email."<br />";
					$this->paypal_email = $this->sellerInformation->paypal_email;
					$this->verified = $this->sellerInformation->verified;
					echo "this fp paypal_email is: ".$this->paypal_email."<br />";
					$this->phone_number = $this->sellerInformation->phone_number;
					$this->items_description = $this->sellerInformation->items_description;
					$this->store_description = $this->sellerInformation->store_description;
					$this->address_one = $this->sellerInformation->address_one;
					$this->address_two = $this->sellerInformation->address_two;
					$this->zip =$this->sellerInformation->zip;
					$this->city = $this->sellerInformation->city;
					$this->state = $this->sellerInformation->state;
					$this->country = $this->sellerInformation->country;
				}
			}
		}
		
		public function process(Zend_Controller_Request_Abstract $request){	
			//validate the user's name
			if($this->verified!=1){
				$this->paypal_email = $this->sanitize($request->getPost('paypal_email'));
				if(strlen($this->paypal_email) ==0){
					$this->addError('paypal_email', 'Please enter your paypal_email');
				}
				elseif($this->sellerInformation->emailExists($this->paypal_email, $this->userID)){
					$this->addError('paypal_email', 'Sorry, this paypal email is already taken. Please enter a unique paypal email address');											 
				}
				else{
					$this->sellerInformation->paypal_email = $this->paypal_email;
				}
			}
			
			$this->phone_number = $this->sanitize($request->getPost('phone_number'));
			if(strlen($this->phone_number) ==0){
				$this->addError('phone_number', 'Please enter your phone number');
			}
			else{
				$this->sellerInformation->phone_number = $this->phone_number;
			}
			
			
																	
																	
			$this->address_one= $this->sanitize($request->getPost('address_one')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->address_one) ==0){
				$this->addError('address_one', 'Please enter your address one');
			}else{
				$this->sellerInformation->address_one = $this->address_one;
			}
			
			$this->address_two = $this->sanitize($request->getPost('address_two'));
			$this->sellerInformation->address_two = $this->address_two;
	
			
			$this->zip = $this->sanitize($request->getPost('zip'));
			if(strlen($this->zip)==0){
				$this->addError('zip', 'Please enter you zip');
			}else{
				$this->sellerInformation->zip = strtolower($this->zip);
			}
			
			$this->city = $this->sanitize($request->getPost('city'));
			
			if(strlen($this->city)==0){
				$this->addError('city', 'Please enter you city');
			}else{
				$this->sellerInformation->city = strtolower($this->city);
			}
			
			$this->state = $this->sanitize($request->getPost('state'));
			if(strlen($this->state)==0){
				$this->addError('states', 'Please enter your state');
			}else{
				$this->sellerInformation->state = strtolower($this->state);
			}
			
			$this->country = $this->sanitize($request->getPost('country'));
			if(strlen($this->country)==0){
				$this->addError('country', 'Please enter your country');
			}else{
				$this->sellerInformation->country = strtolower($this->country);
			}
			
			$this->items_description = $this->sanitize($request->getPost('items_description'));
			if(strlen($this->items_description) ==0){
				$this->sellerInformation->items_description = 'no items description';
			}else{
				$this->sellerInformation->items_description = $this->items_description;
			}
			
			$this->store_description = $this->sanitize($request->getPost('store_description'));
			if(strlen($this->store_description) ==0){
				$this->sellerInformation->store_description = 'no store description';
			}else{
				$this->sellerInformation->store_description = $this->store_description;
			}
		
			
			//validating the correct password
			//if no erros have occured, save the user 
			if(!$this->hasError()){
				$this->sellerInformation->User_id = $this->userID;
				$this->sellerInformation->type=$this->type;
				$this->sellerInformation->save();
				$this->unique_identifier=$this->sellerInformation->unique_identifier;

			}
			//return true if no errors have occurredd
			return !$this->hasError();
			
		}
		
	}
?>		