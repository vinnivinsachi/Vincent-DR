<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Measurement_WomenMeasurement extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		protected $_validateOnly = false;
		public $user;
		public function __construct($db,$user)
		{
			parent::__construct();
			$this->db= $db;
			$this->WomenMeasurement = new DatabaseObject_Measurement_WomenMeasurement($this->db);
			$this->User_referee_id = $user->referee_id;
			$this->user = $user;
			$this->WomenMeasurement->username = $this->user->username;
			$this->WomenMeasurement->userID=$this->user->getId();
			echo 'user id is: '.$this->User_referee_id;
			if($user->measurement==1)
			{
				if($this->WomenMeasurement->loadForPost($this->User_referee_id))
				{
					$this->body_height = $this->WomenMeasurement->body_height;
					$this->neck = $this->WomenMeasurement->neck;
					$this->chest = $this->WomenMeasurement->chest;
					$this->bust = $this->WomenMeasurement->bust;
					$this->bust_bust = $this->WomenMeasurement->bust_bust;
					$this->bust_waist = $this->WomenMeasurement->bust_waist;
					$this->shoulder_bust = $this->WomenMeasurement->shoulder_bust;
					$this->shoulder_to_waist = $this->WomenMeasurement->shoulder_to_waist;
					$this->nape_waist = $this->WomenMeasurement->nape_waist;
					$this->shoulder = $this->WomenMeasurement->shoulder;
					$this->armpit_circumference = $this->WomenMeasurement->armpit_circumference;
					$this->arm_length = $this->WomenMeasurement->arm_length;
					$this->bicept = $this->WomenMeasurement->bicept;
					$this->wrist = $this->WomenMeasurement->wrist;
					$this->waist = $this->WomenMeasurement->waist;
					$this->waist_floor = $this->WomenMeasurement->waist_floor;
					$this->hip = $this->WomenMeasurement->hip;
					$this->crotch = $this->WomenMeasurement->crotch;
					
				}else{
					echo 'error loading pants';
				}
			}else{
				echo 'user dose not have measurement';
			}
			
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			//validate the user's name
			$this->body_height= $this->sanitize($request->getPost('body_height')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->body_height)==0)
			{
				echo 'length is: '.strlen($this->body_height);
				//echo 'request measurmrent-name is: '.$request->getPost('size_name');
				$this->addError('body_height', 'Please enter the beginning size');
				echo 'here at size_name errorasdfasdf';
			}
			else
			{
				$this->WomenMeasurement->body_height = $this->body_height;
			}
			
			$this->neck= $this->sanitize($request->getPost('neck')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->neck)==0)
			{
				echo 'length is: '.strlen($this->neck);
				//echo 'request measurmrent-name is: '.$request->getPost('size_name');
				$this->addError('size_name', 'Please enter the beginning size');
				echo 'here at size_name errorasdfasdf';
			}
			else
			{
				$this->WomenMeasurement->neck = $this->neck;
			}
			
			$this->chest= $this->sanitize($request->getPost('chest')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->chest) ==0)
			{
				$this->addError('chest', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->chest = $this->chest;
			}
			
			
			$this->shoulder= $this->sanitize($request->getPost('shoulder')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->shoulder) ==0)
			{
				$this->addError('shoulder', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->shoulder = $this->shoulder;
			}
			
			$this->bust= $this->sanitize($request->getPost('bust')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->bust) ==0)
			{
				$this->addError('bust', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->bust = $this->bust;
			}
			
			
			$this->bust_bust= $this->sanitize($request->getPost('bust_bust')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->bust_bust) ==0)
			{
				$this->addError('bust_bust', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->bust_bust = $this->bust_bust;
			}
			
			$this->bust_waist= $this->sanitize($request->getPost('bust_waist')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->bust_waist) ==0)
			{
				$this->addError('bust_waist', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->bust_waist = $this->bust_waist;
			}
			
			
			
			
			$this->armpit_circumference= $this->sanitize($request->getPost('armpit_circumference')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->armpit_circumference) ==0)
			{
				$this->addError('armpit_circumference', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->armpit_circumference = $this->armpit_circumference;
			}
			
			$this->arm_length= $this->sanitize($request->getPost('arm_length')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->arm_length) ==0)
			{
				$this->addError('arm_length', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->arm_length = $this->arm_length;
			}
			
			$this->waist_floor= $this->sanitize($request->getPost('waist_floor')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->waist_floor) ==0)
			{
				$this->addError('waist_floor', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->waist_floor = $this->waist_floor;
			}
			
			$this->shoulder_to_waist= $this->sanitize($request->getPost('shoulder_to_waist')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->shoulder_to_waist) ==0)
			{
				$this->addError('shoulder', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->shoulder_to_waist = $this->shoulder_to_waist;
			}
			
			$this->shoulder_bust= $this->sanitize($request->getPost('shoulder_bust')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->shoulder_bust) ==0)
			{
				$this->addError('shoulder_bust', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->shoulder_bust = $this->shoulder_bust;
			}
			
			$this->nape_waist= $this->sanitize($request->getPost('nape_waist')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->nape_waist) ==0)
			{
				$this->addError('nape_waist', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->nape_waist = $this->nape_waist;
			}
			
		
			
			$this->waist= $this->sanitize($request->getPost('waist')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->waist) ==0)
			{
				$this->addError('shoulder', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->waist = $this->waist;
			}
			
			$this->hip= $this->sanitize($request->getPost('hip')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->hip) ==0)
			{
				$this->addError('hip', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->hip = $this->hip;
			}
			
			$this->bicept= $this->sanitize($request->getPost('bicept')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->bicept) ==0)
			{
				$this->addError('bicept', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->bicept = $this->bicept;
			}
			
			$this->crotch= $this->sanitize($request->getPost('crotch')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->crotch) ==0)
			{
				$this->addError('crotch', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->crotch = $this->crotch;
			}
			
			$this->wrist= $this->sanitize($request->getPost('wrist')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->wrist) ==0)
			{
				$this->addError('wrist', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->WomenMeasurement->wrist = $this->wrist;
			}
			
			
			//echo $request->getPost('clubAdmin');
			//$this->user->user_type = $request->getPost('clubAdmin');
			
			//if no erros have occured, save the user 
			if(!$this->_validateOnly && !$this->hasError())
			{
				$this->WomenMeasurement->User_referee_id = $this->User_referee_id;
				$this->WomenMeasurement->save();
				$this->user->measurement = 1;
				$this->user->save();
			}
			
			//return true if no errors have occurred
			return !$this->hasError();
			
		}
		
	}
?>		