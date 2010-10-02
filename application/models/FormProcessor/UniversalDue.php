<?php
	class FormProcessor_UniversalDue extends FormProcessor
	{
		protected $db = null;
		public $user = null;
		public $universal_dues = null;
		
		
		public function __construct($db, $userID, $universal_dues_id=0)
		{
			parent::__construct();
			
			$this->db = $db;
			$this->user= new DatabaseObject_User($db);
			$this->user->load($userID); //load everything about the user.
			
			//echo "user loaded".$this->user->getId();
			
			
			$this->universal_dues= new DatabaseObject_UniversalDue($db);			
			
			$databaseColumn = 'universal_dues_id';
			
			DatabaseObject_StaticUtility::loadObjectForUser($this->universal_dues, $this->user->getId(), $universal_dues_id, $databaseColumn);
			
			if($this->universal_dues->isSaved())
			{
				//echo "<br/>post at is saved.";
				$this->name= $this->universal_dues->profile->name;
				$this->content = $this->universal_dues->profile->content;
				$this->price = $this->universal_dues->profile->price;
				$this->ts_created = $this->universal_dues->ts_created;
			}
			else
			{
				//echo "<br/>post user_id is getId(): ".$this->user->getId();
				$this->universal_dues->user_id = $this->user->getId(); //$this->user_id at blogPost object came from this. 
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
			
			
			if($this->price =='')
			{
				$this->price=(int)0;
			}
			
			if(!is_numeric($this->price))
			{
				$this->addError('price', 'Please enter a valid product price');
			}
		
			$this->content = FormProcessor_BlogPost::cleanHtml($request->getPost('content'));
			
			//echo "<br/>you are at after clean HTML";
			
			if(!$this->hasError())
			{
			
				//echo "<br/>you are at no error";
				$this->universal_dues->profile->name = $this->name;
				$this->universal_dues->profile->price = $this->price;
				$this->universal_dues->profile->content = $this->content;
				//echo "<br/>you are at before save()";
				$this->universal_dues->save();
			}
			
			//echo "<br/>you are at before return";
			return !$this->hasError();
		
		
		}
		

	}	


?>