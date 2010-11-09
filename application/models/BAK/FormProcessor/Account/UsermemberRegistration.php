<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Account_UsermemberRegistration extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		public $user = null;
		protected $_validateOnly = false;
			
		public function __construct($db)
		{
			parent::__construct();
			
			$this->db= $db;
			$this->user = new DatabaseObject_User($db);
			$this->universities = DatabaseObject_StaticUtility::loadUniversities($db);
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			$this->affiliation = $request->getPost('affiliation');
			if($this->affiliation =='0')
			{
								//echo "uni name is: ".$this->university_id;

				$this->addError('university', 'Please select an university from the above list');
			}
			else
			{
				//echo "uni name is: ".$this->university_id;
				$this->user->profile->affiliation = $this->affiliation;
			}
			
			//validate the username
			$this->username = trim($request->getPost('username')); //contraint the post item from request
			//echo $this->username;
			
			//echo "the existance fo the user name: ".$this->user->usernameExists($this->username);
				
			if(strlen($this->username)==0)
			{
				$this->addError('username', 'Please enter a username');
			}
			else if(!DatabaseObject_User::IsValidUsername($this->username))
			{
				$this->addError('username', 'Please enter a valid username');
			}
			else if($this->user->usernameExists($this->username))	
			{
				$this->addError('username', 'The selected username is already taken');
			}
			else
			{
				$this->user->username= $this->username;
				//echo "<br/> and the current name is: ".$this->user->username;
			}
			
			//validate the user's name
			$this->first_name= $this->sanitize($request->getPost('first_name')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->first_name) ==0)
			{
				$this->addError('first_name', 'Please enter your first name');
			}
			else
			{
				$this->user->first_name = $this->first_name;
			}
			
			$this->last_name = $this->sanitize($request->getPost('last_name'));
			if(strlen($this->last_name)==0)
			{
				$this->addError('last_name', 'Please enter your last name');
			}
			else
			{
				$this->user->last_name = $this->last_name;
			}
			
			
			$this->email = $this->sanitize($request->getPost('email'));
			$validator = new Zend_Validate_EmailAddress();
			
			if(strlen($this->email)==0)
			{

				$this->addError('email', 'Please enter you email address');
			}
			elseif(!$validator->isValid($this->email))
			{
				$this->addError('email', 'Please enter a valid email address');
			}
			elseif($this->user->emailExists($this->email)){
				$this->addError('email', 'this email address is already taken, please use another email address');								
			}
			else
			{
				$this->user->email=$this->email;
			}
			
			$this->experience = $this->sanitize($request->getPost('experience'));
			
			if(strlen($this->experience)==0)
			{

				$this->addError('experience', 'Please enter your country');
			}
			else
			{
				$this->user->profile->experience = strtolower($this->experience);
			}
			
			$this->hear_about_us = $this->sanitize($request->getPost('hear_about_us'));
			if(strlen($this->hear_about_us)==0)
			{

				$this->addError('hear_about_us', 'let us know how you heared about us');
			}
			else
			{
				$this->user->profile->hear_about_us = strtolower($this->hear_about_us);
			}
			
			$this->sex = $this->sanitize($request->getPost('sex'));
			if(strlen($this->sex)==0)
			{

				$this->addError('sex', 'let us know how your gender');
			}
			else
			{
				$this->user->sex = strtolower($this->sex);
			}
	
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
				$this->addError('password', 'please enter the password');

			}
			else
			{
				//echo "password changed";
				$this->user->password = $this->password;
			}
			
			if(isset($_SESSION['referral'])){
				$this->user->referral_id = $_SESSION['referral'];	
			}
			
			//echo $request->getPost('clubAdmin');
			//$this->user->user_type = $request->getPost('clubAdmin');
			$this->user->status = 'L';
			$this->user->type_id = 0;
			
			//if no erros have occured, save the user 
			if(!$this->_validateOnly && !$this->hasError())
			{		
				//echo 'here';
				$this->user->profile->registrationIP = $_SERVER['REMOTE_ADDR'];
				$this->user->save();
				//unset($session->phrase);
			}
			//echo 'here at error';
			
			//echo 'has error: '.$this->hasError();
			//echo 'not has error: '.!$this->hasError();
			return !$this->hasError(); 
			
		}
		
	}
?>		