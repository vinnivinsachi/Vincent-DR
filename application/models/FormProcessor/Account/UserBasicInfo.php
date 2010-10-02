<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Account_UserBasicInfo extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		public $user = null;
		
		public function __construct($db, $userID)
		{
			parent::__construct();
			
			$this->db= $db;
			$this->user = new DatabaseObject_User($db);
			if($this->user->load($userID)){
				$this->user_type = $this->user->user_type;
				$this->email = $this->user->email;
				$this->first_name = $this->user->first_name;
				$this->last_name = $this->user->last_name;
				$this->sex = $this->user->sex;
				$this->username = $this->user->username;
				$this->affiliation = $this->user->profile->affiliation;
				$this->experience = $this->user->profile->experience;
				$this->hear_about_us = $this->user->profile->hear_about_us;
				$this->reward_point = $this->user->reward_point;
			}
		}
		
		public function process(Zend_Controller_Request_Abstract $request)
		{	
			//validate the user's name
			$this->first_name= $this->sanitize($request->getPost('first_name')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->first_name) ==0){
				$this->addError('first_name', 'Please enter your first name');
			}
			else{
				$this->user->first_name = $this->first_name;
			}
			
			$this->last_name = $this->sanitize($request->getPost('last_name'));
			if(strlen($this->last_name)==0){
				$this->addError('last_name', 'Please enter your last_name');
			}
			else{
				$this->user->last_name = $this->last_name;
			}
			
			$this->affiliation=$this->sanitize($request->getPost('affiliation'));
			if(strlen($this->affiliation)>0){
				$this->user->profile->affiliation = $this->affiliation;
			}
			
			$this->experience = $this->sanitize($request->getPost('experience'));
			if(strlen($this->experience)>0){
				$this->user->profile->experience=$this->experience;	
			}
			//validating the correct password
			$this->password = $this->sanitize($request->getPost('password'));
			$this->confirm_password = $this->sanitize($request->getPost('confirm_password'));
			
			if(empty($this->password) && !empty($this->confirm_password))
			{
				$this->addError('password', 'please enter the password');
			}
			elseif(!empty($this->password) && empty($this->confirm_password))
			{
				$this->addError('confirm_password', 'please ReEnter your password above');
			}
			elseif($this->password != $this->confirm_password)
			{
				$this->addError('confirm_password', 'the ReEntered password does not match the above passowrd');
			}
			elseif($this->password=='' && $this->confirm_password=='')
			{
	
			}
			else
			{
				$this->user->password = $this->password;
			}
			
			
			
			if(!$this->hasError())
			{
				$this->user->save();
			}
			
			return !$this->hasError();
			
		}
		
	}
?>		