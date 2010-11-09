<?php

	class FormProcessor_Account_ShippingAddress extends FormProcessor  
	{
		protected $_validateOnly = false;
		public function __construct($db, $addressID ='', $userID='')
		{
			parent::__construct();
			
			$this->db= $db;
			$this->shippingAddress = new DatabaseObject_ShippingAddress($db);
			$this->shippingAddress->User_id=$userID;
			if($addressID!==''){
				if($this->shippingAddress->loadByIDs($addressID, $userID))
				{
					$this->address_one = $this->shippingAddress->address_one;
					$this->address_two = $this->shippingAddress->address_two;
					$this->zip =$this->shippingAddress->zip;
					$this->city = $this->shippingAddress->city;
					$this->state = $this->shippingAddress->state;
					$this->country = $this->shippingAddress->country;
					$this->addShipping=false;
				}
				else{
					$this->addShipping=true;
				}
			}
			else
			{
				$this->addShipping=true;
			}
				
			
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		public function process(Zend_Controller_Request_Abstract $request)
		{	
			//validate the user's name
			$this->address_one= $this->sanitize($request->getPost('address_one')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->address_one) ==0)
			{
				$this->addError('address_one', 'Please enter this address');
			}
			else
			{
				$this->shippingAddress->address_one = $this->address_one;
			}
			
			$this->address_two = $this->sanitize($request->getPost('address_two'));
			$this->shippingAddress->address_two = $this->address_two;
	
			
			$this->zip = $this->sanitize($request->getPost('zip'));
			if(strlen($this->zip)==0)
			{

				$this->addError('zip', 'Please enter you zip');
			}
			else
			{
				$this->shippingAddress->zip = strtolower($this->zip);
			}
			
			$this->city = $this->sanitize($request->getPost('city'));
			
			if(strlen($this->city)==0)
			{

				$this->addError('city', 'Please enter you city');
			}
			else
			{
				$this->shippingAddress->city = strtolower($this->city);
			}
			
			
			$this->state = $this->sanitize($request->getPost('state'));
			
			if(strlen($this->state)==0)
			{

				$this->addError('state', 'Please enter your state');
			}
			else
			{
				$this->shippingAddress->state = strtolower($this->state);
			}
			
			$this->country = $this->sanitize($request->getPost('country'));
			
			if(strlen($this->country)==0)
			{

				$this->addError('country', 'Please enter your country');
			}
			else
			{
				$this->shippingAddress->country = strtolower($this->country);
			}
			//validating the correct password
			//if no erros have occured, save the user 
			if(!$this->hasError())
			{
				$this->shippingAddress->save();
				//echo 'here at save';
				$this->shippingId = $this->shippingAddress->getId();
			}
			
			$this->defaultShipping = $this->sanitize($request->getPost('defaultShipping'));
			if($this->defaultShipping!='on'){
				$this->defaultShipping='off';
			}
			
			//return true if no errors have occurredd
			return !$this->hasError();
			
		}
		
	}
?>		