<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Account_UserBalanceWithdraw extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		public $user = null;
		protected $_validateOnly = false;

		
		public function __construct($db, &$user)
		{
			parent::__construct();
			
			$this->db= $db;
			$this->user = $user;
		}
		
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		public function process(Zend_Controller_Request_Abstract $request)
		{	
			//validate form.
			
			
			
			if(!$this->_validateOnly && !$this->hasError())
			{		
				//save shit
			}
			
			return !$this->hasError(); 
			
		}
		
	}
?>		