<?php

class Application_Form_Authentication_Login extends Zend_Form
{

    public function init()
    {
    	// Set form options
		$this->setName('login');
		
		// Username
		$username = new Zend_Form_Element_Text('username');
		$username->setRequired(true)
				 ->addFilter('StringTrim')
				 ->addFilter('StringToLower');

		// Password
		$password = new Zend_Form_Element_Password('password');
		$password->setRequired(true);
		
		// Add all the elements to the form
		$this->addElement($username)
			 ->addElement($password);
    }


}

