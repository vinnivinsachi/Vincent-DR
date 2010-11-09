<?php



	class FormProcessor_Helper_ColorAttribute extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		
		public $colors;
		
		public function __construct($db)
		{
			parent::__construct();
			
			$this->colors = new DatabaseObject_Attribute_ColorAttribute($db);
			
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			//validate the user's name
			$this->product_types_id= $this->sanitize($request->getPost('id')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->product_types_id)==0)
			{
				echo 'length is: '.strlen($this->product_types_id);
				//echo 'request measurmrent-name is: '.$request->getPost('size_name');
				$this->addError('product_types_id', 'Please enter the beginning size');
				echo 'here at size_name errorasdfasdf';
			}
			else
			{
				$this->colors->product_types_id = $this->product_types_id;
			}
			
			$this->name_of_color= $this->sanitize($request->getPost('name_of_color')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->name_of_color)==0)
			{
				echo 'length is: '.strlen($this->name_of_color);
				//echo 'request measurmrent-name is: '.$request->getPost('size_name');
				$this->addError('name_of_color', 'Please enter the beginning size');
				echo 'here at size_name errorasdfasdf';
			}
			else
			{
				$this->colors->name_of_color = $this->name_of_color;
			}
			
			$this->price_of_product= $this->sanitize($request->getPost('price_of_product')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->price_of_product)==0)
			{
				echo 'length is: '.strlen($this->price_of_product);
				//echo 'request measurmrent-name is: '.$request->getPost('size_name');
				$this->addError('price_of_product', 'Please enter the beginning size');
				echo 'here at size_name errorasdfasdf';
			}
			else
			{
				$this->colors->price_of_product = $this->price_of_product;
			}
			
			$this->discount_price= $this->sanitize($request->getPost('discount_price')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->discount_price)==0)
			{
				echo 'length is: '.strlen($this->discount_price);
				//echo 'request measurmrent-name is: '.$request->getPost('size_name');
				$this->addError('discount_price', 'Please enter the beginning size');
				echo 'here at size_name errorasdfasdf';
			}
			else
			{
				$this->colors->discount_price = $this->discount_price;
			}
			
			$this->multiple_price= $this->sanitize($request->getPost('multiple_price')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->multiple_price)==0)
			{
				echo 'length is: '.strlen($this->multiple_price);
				//echo 'request measurmrent-name is: '.$request->getPost('size_name');
				$this->addError('multiple_price', 'Please enter the beginning size');
				echo 'here at size_name errorasdfasdf';
			}
			else
			{
				$this->colors->multiple_price = $this->multiple_price;
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