<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Account_Guest extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		public $guest = null;
		protected $_validateOnly = false;
		
		
		
		public function __construct($db)
		{
			parent::__construct();
			
			$this->db= $db;
			$this->guest = new DatabaseObject_Guest($db);
			
			//$this->guest->loadByID($userID);
			
			//$this->universities = DatabaseObject_StaticUtility::loadUniversities($db);
			
			//$this->club_types = DatabaseObject_StaticUtility::loadTypes($db);

			
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
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
				$this->guest->first_name = $this->first_name;
			}
			
			$this->last_name = $this->sanitize($request->getPost('last_name'));
			if(strlen($this->last_name)==0)
			{
				$this->addError('last_name', 'Please enter your last_name');
			}
			else
			{
				$this->guest->last_name = $this->last_name;
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
				$this->guest->email = strtolower($this->email);
			}
			
			$this->phone = $this->sanitize($request->getPost('phone'));
			
			if(strlen($this->phone)==0)
			{

				$this->addError('phone', 'Please enter you address address');
			}
			else
			{
				$this->guest->phone = strtolower($this->phone);
			}
			
			$this->address = $this->sanitize($request->getPost('address'));
			
			if(strlen($this->address)==0)
			{

				$this->addError('address', 'Please enter you address address');
			}
			else
			{
				$this->guest->address = strtolower($this->address);
			}
			
			$this->zip = $this->sanitize($request->getPost('zip'));
			
			if(strlen($this->zip)==0)
			{

				$this->addError('zip', 'Please enter you zip');
			}
			else
			{
				$this->guest->zip = strtolower($this->zip);
			}
			
			$this->city = $this->sanitize($request->getPost('city'));
			
			if(strlen($this->city)==0)
			{

				$this->addError('city', 'Please enter you city');
			}
			else
			{
				$this->guest->city = strtolower($this->city);
			}
			
			
			$this->state = $this->sanitize($request->getPost('states'));
			
			if(strlen($this->state)==0)
			{

				$this->addError('states', 'Please enter your state');
			}
			else
			{
				$this->guest->state = strtolower($this->state);
			}
			
			
			$this->car = $request->getPost('car');
			
			if($this->car =="")
			{
				$this->addError('car','Please make a selection here');
			}
			else
			{
				$this->guest->car = $this->car;
			}
			
			$this->boombox = $request->getPost('boombox');
			
			if($this->boombox =="")
			{
				$this->addError('boombox', 'Please make a selection here');
			}
			else
			{
				$this->guest->boombox = $this->boombox;
			}
			
			$this->ethnicity = $request->getPost('ethnicity');
			if($this->ethnicity=="")
			{
				$this->addError('ethnicity', 'Please make a selection here');
			}
			else
			{
				$this->guest->ethnicity = $this->ethnicity;
			}
			
			$this->hear_about_us = $request->getPost('hear_about_us');
			if($this->hear_about_us =="")
			{
				$this->addError('hear_about_us', 'Please make a selection here');
			}
			else
			{
				$this->guest->hear_about_us = $this->hear_about_us;
			}
			
			$this->school = $request->getPost('school');
			if($this->school =="")
			{
				$this->addError('school', 'Please enter your school of concentration');
			}
			else
			{
				$this->guest->school = $this->school;
			}
			
			//---------------------------------------------------------
			/*foreach($this->publicProfile as $key =>$label)
			{
				$this->$key = $this->sanitize($request->getPost($key));
				$this->user->profile->$key = $this->$key;
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
			*/
			//--------------------------------------------------------
			
			//validate CAPTCHA phrase
			$session= new Zend_Session_Namespace('captcha');
			$this->captcha = $this->sanitize($request->getPost('captcha'));
			
			if($this->captcha !=$session->phrase)
			{
				$this->addError('captcha', 'Please enter the correct phrase');
			}
			
			//echo $request->getPost('clubAdmin');
			//$this->user->user_type = $request->getPost('clubAdmin');
			
			//if no erros have occured, save the user 
			if(!$this->_validateOnly && !$this->hasError())
			{
				$this->guest->save();
				unset($session->phrase);

			}
			
			//return true if no errors have occurred
			return !$this->hasError();
			
		}
		
	}
?>		