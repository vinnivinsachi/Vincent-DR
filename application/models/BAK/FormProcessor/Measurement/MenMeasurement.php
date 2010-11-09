<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Measurement_MenMeasurement extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		protected $_validateOnly = false;
		public $user;
		public function __construct($db,$user)
		{
			parent::__construct();
			$this->db= $db;
			$this->MenMeasurement = new DatabaseObject_Measurement_MenMeasurement($this->db);
			$this->User_referee_id = $user->referee_id;
			$this->user = $user;
			echo 'user id is: '.$this->User_referee_id;
			if($user->measurement==1)
			{
				if($this->MenMeasurement->loadForPost($this->User_referee_id))
				{
					$this->body_height = $this->MenMeasurement->body_height;
					$this->neck = $this->MenMeasurement->neck;
					$this->chest = $this->MenMeasurement->chest;
					$this->shoulder = $this->MenMeasurement->shoulder;
					$this->armpit_circumference = $this->MenMeasurement->armpit_circumference;
					$this->arm_length = $this->MenMeasurement->arm_length;
					$this->shoulder_waist = $this->MenMeasurement->shoulder_waist;
					$this->waist = $this->MenMeasurement->waist;
					$this->hip = $this->MenMeasurement->hip;
					$this->thigh=$this->MenMeasurement->thigh;
					$this->length_pants=$this->MenMeasurement->length_pants;
					
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
				$this->MenMeasurement->body_height = $this->body_height;
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
				$this->MenMeasurement->neck = $this->neck;
			}
			
			$this->chest= $this->sanitize($request->getPost('chest')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->chest) ==0)
			{
				$this->addError('chest', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->MenMeasurement->chest = $this->chest;
			}
			
			
			$this->shoulder= $this->sanitize($request->getPost('shoulder')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->shoulder) ==0)
			{
				$this->addError('shoulder', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->MenMeasurement->shoulder = $this->shoulder;
			}
			
			$this->armpit_circumference= $this->sanitize($request->getPost('armpit_circumference')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->armpit_circumference) ==0)
			{
				$this->addError('armpit_circumference', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->MenMeasurement->armpit_circumference = $this->armpit_circumference;
			}
			
			$this->arm_length= $this->sanitize($request->getPost('arm_length')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->arm_length) ==0)
			{
				$this->addError('arm_length', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->MenMeasurement->arm_length = $this->arm_length;
			}
			
			$this->shoulder_waist= $this->sanitize($request->getPost('shoulder_waist')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->shoulder_waist) ==0)
			{
				$this->addError('shoulder', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->MenMeasurement->shoulder_waist = $this->shoulder_waist;
			}
			
			$this->waist= $this->sanitize($request->getPost('waist')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->waist) ==0)
			{
				$this->addError('shoulder', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->MenMeasurement->waist = $this->waist;
			}
			
			$this->hip= $this->sanitize($request->getPost('hip')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->hip) ==0)
			{
				$this->addError('hip', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->MenMeasurement->hip = $this->hip;
			}
			
			$this->thigh= $this->sanitize($request->getPost('thigh')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->thigh) ==0)
			{
				$this->addError('thigh', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->MenMeasurement->thigh = $this->thigh;
			}
			
			$this->length_pants= $this->sanitize($request->getPost('length_pants')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->length_pants) ==0)
			{
				$this->addError('length_pants', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->MenMeasurement->length_pants = $this->length_pants;
			}
			
			
			//echo $request->getPost('clubAdmin');
			//$this->user->user_type = $request->getPost('clubAdmin');
			
			//if no erros have occured, save the user 
			if(!$this->_validateOnly && !$this->hasError())
			{
				$this->MenMeasurement->User_referee_id = $this->User_referee_id;
				$this->MenMeasurement->save();
				$this->user->measurement = 1;
				$this->user->save();
			}
			
			//return true if no errors have occurred
			return !$this->hasError();
			
		}
		
	}
?>		