<?php
	class FormProcessor_ShoutOut extends FormProcessor
	{
	
		protected $db = null;
		protected $_validateOnly = false;
		

		public function __construct($db, $loggedInUser=NULL)
		{
			parent::__construct();
			$this->db = $db;
			$this->shoutout= new DatabaseObject_Shoutout($this->db);
			
			if($loggedInUser !=NULL){
			//echo 'here at lggedInUser != null';
			$this->loggedInUser = true;
			$this->shoutout_username = $loggedInUser->username;
			$this->shoutout_user_id=$loggedInUser->getId();
			//echo $this->shoutout_username;
			//echo 'AT CONSTRUCT '.$this->shoutout_user_id;
			}
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			
			$this->product_id = $request->getParam('product_id');
			$this->uploader_id=$request->getParam('uploader_id');
			
			$this->shoutout_name = $request->getParam('shoutout_name');
			
			if(strlen($this->shoutout_name)==0){
				$this->addError('shoutout_name', 'Please enter a valid name');
			}else{
				$this->removeError('shoutout_name');
			}
			$this->shoutout_email = $this->sanitize($request->getParam('shoutout_email'));
			$validator = new Zend_Validate_EmailAddress();
			
			if(strlen($this->shoutout_email)==0)
			{

				$this->addError('shoutout_email', 'Please enter you email address');
			}
			elseif(!$validator->isValid($this->shoutout_email))
			{
				$this->addError('shoutout_email', 'Please enter a valid email address');
			}else{
				$this->removeError('shoutout_email');
			}
			
			
			//$this->shoutout_user_receive_notification = 1;
			//$this->shoutout_user_id = $request->getParam('shoutout_user_id');
			
			$this->shoutout_message = $request->getParam('shoutout_message');
			if(strlen($this->shoutout_message)==0){
				$this->addError('shoutout_message', 'Please enter a valid shout out message');
			}else{
				$this->removeError('shoutout_message');
			}
			
			if(!$this->hasError()){
				$this->shoutout->product_id = $this->product_id;
				$this->shoutout->shoutout_name = $this->shoutout_name;
				$this->shoutout->shoutout_email = $this->shoutout_email;
				$this->shoutout->uploader_id = $this->uploader_id;
				//$this->shoutout->shout_user_receive_notification = 1;
				
				if($this->loggedInUser){
					//echo 'here at loggedInUser isset';
					$this->shoutout->shoutout_username = $this->shoutout_username;
					$this->shoutout->shoutout_user_id = $this->shoutout_user_id;
					//echo 'USER_ID IS:'.$this->shoutout_user_id;
				}
				$this->shoutout->shoutout_message = $this->shoutout_message;
				$this->shoutout->save();
			}
			return !$this->hasError(); 
		}
	}	