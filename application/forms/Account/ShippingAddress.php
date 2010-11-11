<?php

class Application_Form_Account_ShippingAddress extends Zend_Form
{

    public function init()
    {
    	// Set form options
		$this->setName('userShippingAddress')
			 ->setMethod('post'); 
			 
		// Address One
		$addressOne = new Zend_Form_Element_Text('addressOne');
		$addressOne->setRequired(true);
		
		// Address One
		$addressTwo = new Zend_Form_Element_Text('addressTwo');
		$addressTwo->setRequired(false);
		
		// City
		$city = new Zend_Form_Element_Text('city');
		$city->setRequired(true);
		
		// State
		$state = new Zend_Form_Element_Text('state');
		$state->setRequired(true);
		
		// Country
		$country = new Zend_Form_Element_Text('country');
		$country->setRequired(true);
		
		// ZIP
		$zip = new Zend_Form_Element_Text('zip');
		$zip->setRequired(true);

		// Is Default Shipping?
		$defaultShipping = new Zend_Form_Element_Checkbox('defaultShipping');
		$defaultShipping->setRequired(false);
						
		
		// Add all the elements to the form
		$this->addElement($addressOne)
			 ->addElement($addressTwo)
			 ->addElement($city)
			 ->addElement($state)
			 ->addElement($country)
			 ->addElement($zip)
			 ->addElement($defaultShipping);
    }
}