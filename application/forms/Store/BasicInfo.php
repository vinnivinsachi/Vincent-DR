<?php

class Application_Form_Store_BasicInfo extends Zend_Form
{

    public function init()
    {
		// Store email
		$storeEmail = new Zend_Form_Element_Text('storeEmail');
		$storeEmail->setRequired(false);
				   //->addValidator('EmailAddress');
				 
		// Store Phone
		$storePhone = new Zend_Form_Element_Text('storePhone');
		$storePhone->setRequired(false)
				 ->addFilter('Digits')
				 ->addValidator('StringLength', false, array(10, 20));
				 
		// Store Fax
		$storeFax = new Zend_Form_Element_Text('storeFax');
		$storeFax->setRequired(false)
					->addFilter('Digits')
				 	->addValidator('StringLength', false, array(10, 20));
		
		// Add all the elements to the form
		$this->addElement($storeEmail)
			 ->addElement($storePhone)
			 ->addElement($storeFax);
    }
}