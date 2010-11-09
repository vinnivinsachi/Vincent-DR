<?php



	class FormProcessor_Helper_ProductTypes extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		
		public $productType;
		
		public function __construct($db)
		{
			parent::__construct();
			
			$this->productType = new DatabaseObject_ProductTypes($db);
			
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			//validate the user's name
			$this->product_types_name= $this->sanitize($request->getPost('type')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->product_types_name)==0)
			{
				echo 'length is: '.strlen($this->product_types_name);
				//echo 'request measurmrent-name is: '.$request->getPost('size_name');
				$this->addError('productType', 'Please enter the beginning size');
				echo 'here at size_name errorasdfasdf';
			}
			else
			{
				$this->productType->product_types_name = $this->product_types_name;
			}
			
			
			if(!$this->_validateOnly && !$this->hasError())
			{
				$this->productType->save();
			}
			
			//return true if no errors have occurred
			return !$this->hasError();
			
		}
		
	}
?>		