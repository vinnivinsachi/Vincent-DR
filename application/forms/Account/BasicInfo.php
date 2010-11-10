<?php

class Application_Form_Account_Register extends Zend_Form
{

    public function init()
    {
    	// Set form options
		$this->setName('register')
			 ->setAction(SITE_ROOT.'/account/register')
			 ->setMethod('post');
		
		// Username
		$username = new Zend_Form_Element_Text('username');
		$username->setRequired(true)
				 ->addFilter('StringToLower')
				 ->addValidator('Alnum')
				 ->addValidator('StringLength', false, array(4, 20));

		// Password
		$password = new Zend_Form_Element_Password('password');
		$password->setRequired(true)
				 ->addValidator('Alnum')
				 ->addValidator('StringLength', false, array(6, 20));
		
		// Confirm Password
		$passwordConfirm = new Zend_Form_Element_Password('passwordConfirm');
		$passwordConfirm->setRequired(true)
						->addValidator('Identical', false, array('token' => 'password'));
						
		
		// Add all the elements to the form
		$this->addElement($username)
			 ->addElement($password)
			 ->addElement($passwordConfirm);
    }
}