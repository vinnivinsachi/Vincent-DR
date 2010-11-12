<?php

class Application_Form_Porduct_BasicInfo extends Zend_Form
{
	public $param;
	public $postAction;
	
	public function __construct($postAction, $param){ 
		$this->postAction=$postAction;
		$this->param = $param;
	}

    public function init()
    {
    	// Set form options
		$this->setName('productBasicInfo')
			 ->setAction(SITE_ROOT.'/productlisting/'.$this->postAction)
			 ->setMethod('post');
		
		//name
		$name = new Zend_Form_Element_Text('name');
		$name->setRequired(true)
			 ->addValidator('Alnum')
			 ->addvalidator('StringLength', false, array(4, 150));
	
		//brand
		$brand = new Zend_Form_Element_Select('brand' );
		$brand->setRequired(true)
			  ->addValidator('Alnum');
		
		//social_usage
		$socialUsage = new Zend_Form_Element_Checkbox('socialUsage');
		
		$competativeUsage = new Zend_Form_Element_Checkbox('competativeUsage');
		
		$price = new Zend_form_Element_Text('price');
		$price->setRequired(true)
			->addValidator(new Zend_Validate_Float(), true);
		
		//domestic shipping rate
		$domesticShippingRate = new Zend_Form_Element_Text('domesticShippingRate');
		$domesticShippingRate->setRequired(true)
		->addValidator(new Zend_Validate_Float(), true);
		
		//international shipping rate
		$internationalShippingRate = new Zend_Form_Element_Text('internationalShippingRate');
		$internationalShippingRate->setRequired(true)
		->addValidator(new Custom_Validators_Price(), true);
		
		//backordertime
		$backorderTime = new Zend_Form_Element_Text('backorderTime');
		
		//returnable
		$return = new Zend_Form_Element_Radio('return');

		$return->setLabel('Return:')
			->addMultiOptions(array(
		
					'returnable' => 'Returnable',
		
					'Unreturnable' => 'Not returnable'))
			->setSeparator(" ")
			->setAttrib("checked","checked");
			
		//videos
		$video = new Zend_Form_Element_Text('videoYoutube');
						
		
		// Add all the elements to the form
		$this->addElement($name)
			 ->addElement($brand)
			 ->addElement($socialUsage)
			 ->addElement($competativeUsage)
			 ->addElement($price)
			 ->addElement($domesticShippingRate)
			 ->addElement($internationalShippingRate)
			 ->addElement($backorderTime)
			 ->addElement($return)
			 ->addElement($video);
    }
}
?>