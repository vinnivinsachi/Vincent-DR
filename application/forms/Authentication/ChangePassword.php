<?php

class Application_Form_Authentication_ChangePassword extends Zend_Form
{
    public function init()
    {
    	// Set form options
		$this->setName('userBasicInfo')
			 ->setAction(SITE_ROOT.'/account/editbasicinfo')
			 ->setMethod('post');

		// Old Password
		$oldPassword = new Zend_Form_Element_Password('oldPassword');
		$oldPassword->setRequired(true);
			 
		// New Password
		$password = new Zend_Form_Element_Password('password');
		$password->setRequired(false)
				 ->addValidator('Alnum')
				 ->addValidator('StringLength', false, array(6, 20));
		
		// Confirm Password
		$passwordConfirm = new Zend_Form_Element_Password('passwordConfirm');
		$passwordConfirm->setRequired(false)
						->addValidator('Identical', false, array('token' => 'password'));
				
		
		// Add all the elements to the form
		$this->addElement($oldPassword)
			 ->addElement($password)
			 ->addElement($passwordConfirm);
    }
}