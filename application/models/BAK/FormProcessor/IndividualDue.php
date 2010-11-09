<?php
	class FormProcessor_IndividualDue extends FormProcessor
	{
		
		
		public $objects;
		
		public function __construct($db, DatabaseObject $objects)
		{
			parent::__construct();
			
			$this->objects= $objects;
			
			if($this->objects->isSaved())
			{
				echo "<br/>due at is saved.";
				
				$this->name= $this->objects->profile->name;
				$this->content = $this->objects->profile->content;
				$this->price = $this->objects->profile->price;
				$this->ts_created = $this->objects->date_set;
				
				echo "<br/>this name is: ".$this->name;
			}
			
			
			
		}
		
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			
			//echo "<br/>here at process.";
			$this->name = $this->sanitize($request->getPost('name'));
			$this->name = substr($this->name, 0, 255);
			
			if(strlen($this->name)==0)
			{
				$this->addError('name', 'Please enter a name for this general membership due'); //this is a giving FormProcessor.php function. 
			}
			
			
			$this->price = $this->sanitize(trim(($request->getPost('price'))));
			
			
			//echo "<br/>your ticket_price is: ".$this->ticket_price;
			if($this->price == 'FREE')
			{
				//echo "<br/>after ticket_price";
				$this->price=(int)0;
				//echo "<br/>after ticket_price is: ".$this->ticket_price;
			}
			if(!is_numeric($this->price))
			{
				$this->addError('price', 'Please enter a valid product price');
			}
		
			$this->content = FormProcessor_BlogPost::cleanHtml($request->getPost('content'));
			
			//echo "<br/>you are at after clean HTML";
			
			if(!$this->hasError())
			{
			
				echo "<br/>you are at no error";
				$this->objects->profile->name = $this->name;
				$this->objects->profile->price = $this->price;
				$this->objects->profile->content = $this->content;
				//echo "<br/>you are at before save()";				
				$this->objects->Save();

			}
			
			//echo "<br/>you are at before return";
			return !$this->hasError();
		
		
		}
		

	}	


?>