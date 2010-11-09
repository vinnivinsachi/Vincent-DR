<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Account_UserDetails extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		public $user = null;
		
		public $publicProfile = array(
			'public_club_name' => 'Club name',
			'public_club_email' => 'Email',
			'public_club_website' => 'Website'

			);
		
		public $paypalEmail = null;
		public $club_description = null;
		
		public function __construct($db, $userID)
		{
			parent::__construct();
			
			$this->db= $db;
			$this->user = new DatabaseObject_User($db);
			$this->user->load($userID);
		
			//echo "univerity_id: ".$this->user->university_id;
			//$this->university = DatabaseObject_StaticUtility::loadUniversityName($db, $this->user->university_id);
			
			$this->profile_type = $this->user->user_type;
			//echo "your university: ".$this->university;
			$this->email = $this->user->profile->email;
			$this->first_name = $this->user->profile->first_name;
			$this->last_name = $this->user->profile->last_name;
			
			$this->club_public = $this->user->status;
			$this->num_posts = $this->user->profile->num_posts;
			$this->paypalEmail = $this->user->profile->paypalEmail;
			$this->club_description =$this->user->profile->club_description;
			
			$this->address = $this->user->profile->address;
			$this->zip = $this->user->profile->zip;
			$this->city = $this->user->profile->city;
			$this->state = $this->user->profile->state;
			
			//echo $this->paypalEmail;
			
			if($this->user->user_type == 'clubAdmin')
			{
				foreach($this->publicProfile as $key => $label)
				{
					$this->$key = $this->user->profile->$key;
				}
			}
			
		}
		
		public function process(Zend_Controller_Request_Abstract $request)
		{	
			//validate the user's name
			$this->first_name= $this->sanitize($request->getPost('first_name')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->first_name) ==0)
			{
				$this->addError('first_name', 'Please enter your first name');
			}
			else
			{
				$this->user->profile->first_name = $this->first_name;
				$this->user->first_name = $this->first_name;
			}
			
			$this->last_name = $this->sanitize($request->getPost('last_name'));
			if(strlen($this->last_name)==0)
			{
				$this->addError('last_name', 'Please enter your last_name');
			}
			else
			{
				$this->user->profile->last_name = $this->last_name;
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
			else
			{
				$this->user->profile->email = $this->email;
				//echo "here";
			}
			
			$this->address = $this->sanitize($request->getPost('address'));
			
			if(strlen($this->address)==0)
			{

				$this->addError('address', 'Please enter you address address');
			}
			else
			{
				$this->user->profile->address = strtolower($this->address);
			}
			
			$this->zip = $this->sanitize($request->getPost('zip'));
			
			if(strlen($this->zip)==0)
			{

				$this->addError('zip', 'Please enter you zip');
			}
			else
			{
				$this->user->profile->zip = strtolower($this->zip);
			}
			
			$this->city = $this->sanitize($request->getPost('city'));
			
			if(strlen($this->city)==0)
			{

				$this->addError('city', 'Please enter you city');
			}
			else
			{
				$this->user->profile->city = strtolower($this->city);
			}
			
			
			$this->state = $this->sanitize($request->getPost('states'));
			
			if(strlen($this->state)==0)
			{

				$this->addError('states', 'Please enter your state');
			}
			else
			{
				$this->user->profile->state = strtolower($this->state);
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
				//nothing.
				//echo "here at nothing with password";
			}
			else
			{
				//echo "password changed";
				$this->user->password = $this->password;
			}
			
			
			if($this->user->user_type == 'clubAdmin')
			{
			
				foreach($this->publicProfile as $key =>$label)
				{
					$this->$key = $this->sanitize($request->getPost($key));
					$this->user->profile->$key = $this->$key;
				}
			}
			
			$this->paypalEmail = $this->sanitize($request->getPost('paypalEmail'));
			if(!empty($this->paypalEmail))
			{
			$this->user->profile->paypalEmail = $this->paypalEmail;
			}
			
		$this->club_description = FormProcessor_BlogPost::cleanHtml($request->getPost('club_description')); 
			//echo "the current club_description is: ".$this->club_description;
			if(!empty($this->club_description))
			{
			$this->user->profile->club_description = $this->club_description;
			}
			
			//$this->paypalEmail = $this->user->profile->paypalEmail;
			$this->num_posts = max(1, (int)$request->getPost('num_posts'));
			//$this->user->status = $request->getPost('club_public');
			$this->user->profile->num_posts = $this->num_posts;
			
			//if no erros have occured, save the user 
			if(!$this->hasError())
			{
				$this->user->save();
			}
			
			
			//return true if no errors have occurredd
			return !$this->hasError();
			
		}
		
	}
?>		