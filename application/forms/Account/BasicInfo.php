<?php

class Application_Form_Account_BasicInfo extends Zend_Form
{

    public function init()
    {
    	// Set form options
		$this->setName('userBasicInfo')
			 ->setAction(SITE_ROOT.'/account/editbasicinfo')
			 ->setMethod('post');
						
		// First Name
		$firstName = new Zend_Form_Element_Text('firstName');
		$firstName->setRequired(false)
				 //->addValidator('Alpha')
				 ->addValidator('StringLength', false, array(0, 30));
				 
		// Last Name
		$lastName = new Zend_Form_Element_Text('lastName');
		$lastName->setRequired(false)
				 //->addValidator('Alpha')
				 ->addValidator('StringLength', false, array(0, 30));
				 
		// Affiliations
		$affiliation = new Zend_Form_Element_Text('affiliation');
		$affiliation->setRequired(false)
				 	->addValidator('StringLength', false, array(0, 100));
				 
		// Dance Experience
		$experience = new Zend_Form_Element_Select('experience');
		$experience->setRequired(false)
				   ->setRegisterInArrayValidator(false);
						
		
		// Add all the elements to the form
		$this->addElement($firstName)
			 ->addElement($lastName)
			 ->addElement($affiliation)
			 ->addElement($experience);
    }
}