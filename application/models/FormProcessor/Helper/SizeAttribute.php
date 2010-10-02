<?php
/*****
 *pg 80
 *Form processor_userRegistration is a child of Form Processor
 *It set variables by using parent _set() function.
 *
 *NOTE: EMAIL CONFIRMATION OF SIGNUPS WILL BE NEEDED on 
 *
 */


	class FormProcessor_Helper_SizeAttribute extends FormProcessor  //so this zend looks at the controller folder FormProcessor and finds the file UserRegistration. 
	{
		protected $db = null;
		public $SizeAttribute = null;
		protected $_validateOnly = false;
		public $product;
		
		public function __construct($product)
		{
			parent::__construct();
			
			$this->db= $product->getDb();
			$this->SizeAttribute = new DatabaseObject_Attribute_SizeAttribute($this->db);
			$this->SizeAttribute->product_type_table = $product->product_type;
			$this->SizeAttribute->product_id = $product->getId();
			$this->SizeAttribute->username = $product->username;
			
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			//validate the user's name
			$this->attribute_name= $this->sanitize($request->getPost('attribute_name')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->attribute_name)==0)
			{
				echo 'length is: '.strlen($this->attribute_name);
				//echo 'request measurmrent-name is: '.$request->getPost('size_name');
				$this->addError('size_name', 'Please enter the beginning size');
				echo 'here at size_name errorasdfasdf';
			}
			else
			{
				$this->SizeAttribute->attribute_name = $this->attribute_name;
			}
			
			$this->size_name= $this->sanitize($request->getPost('size_name')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->size_name)==0)
			{
				echo 'length is: '.strlen($this->size_name);
				//echo 'request measurmrent-name is: '.$request->getPost('size_name');
				$this->addError('size_name', 'Please enter the beginning size');
				echo 'here at size_name errorasdfasdf';
			}
			else
			{
				$this->SizeAttribute->size_name = $this->size_name;
			}
			
			
			
			
			$this->price_adjustment= $this->sanitize($request->getPost('price_adjustment')); //sanitize uses FormProcessor's zend_filter funciton to clean strings. 
			if(strlen($this->price_adjustment) ==0)
			{
				$this->addError('price_adjustment', 'Please enter the price_adjustment');
								echo 'here at price_adjustment error';

			}
			else
			{
				$this->SizeAttribute->price_adjustment = $this->price_adjustment;
			}
			
			
			
			//echo $request->getPost('clubAdmin');
			//$this->user->user_type = $request->getPost('clubAdmin');
			
			//if no erros have occured, save the user 
			if(!$this->_validateOnly && !$this->hasError())
			{
				$this->SizeAttribute->save();
			}
			
			//return true if no errors have occurred
			return !$this->hasError();
			
		}
		
	}
?>		