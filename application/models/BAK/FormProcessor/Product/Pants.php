<?php

	class FormProcessor_Product_Pants extends FormProcessor
	{
		protected $db = null;
		public $user = null;
		public $product = null;
		
		
		public function __construct($db, $userID, $username, $product_type, $product_id=0)
		{
			parent::__construct();
		
			$this->db = $db;		
			$this->product = ObjectGenerator::generateProductForListing($db, $product_type);
			$this->userID = $userID;
			$this->username = $username;
			
			echo "product_id: ".$product_id;
			if($this->product->load($product_id)){
				echo "here at load product id<br />";
				$this->product_id=$product_id;
				$this->name=$this->product->name;
				$this->price=$this->product->price;
				$this->brand=$this->product->brand;
				$this->reward_point = $this->product->reward_point;
				$this->discount_price = $this->product->discount_price;
				$this->video_youtube = $this->product->video_youtube;
				$this->description = $this->product->profile->description;
			}
		}
	
	
		public function process(Zend_Controller_Request_Abstract $request)
		{
		
			//echo "<br/> Here at process";
		
			$this->name = $this->sanitize($request->getPost('name'));
			//$this->name = substr($this->name, 0, 255);
			
			echo "current product name: ".$this->name."<br />";
			if(strlen($this->name)==0)
			{
				$this->addError('name', 'Please enter a valid product name');
			}
			
			$this->price = $this->sanitize($request->getPost('price'));
			
			if(strlen($this->price)==0 || !is_numeric($this->price))
			{
				$this->addError('price', 'Please enter a valid product price');
			}
			
			
			$this->brand = $this->sanitize($request->getPost('brand'));
			if(strlen($this->brand)==0)
			{
				$this->addError('brand', 'Please enter a valid product brand');
			}
			
			$this->reward_point = $this->sanitize($request->getPost('reward_point'));
			$this->video_youtube = $this->sanitize($request->getPost('video_youtube'));
			$this->discount_price = $this->sanitize($request->getPost('discount_price'));
			
			$this->description = FormProcessor_BlogPost::cleanHtml($request->getPost('description'));
			
			if(!$this->hasError())
			{
				echo"here at good to save<br />";
				$this->product->User_id=$this->userID;
				$this->product->name=$this->name;
				$this->product->price=$this->price;
				$this->product->brand=$this->brand;
				$this->product->profile->description =$this->description;
				$this->product->reward_point = $this->reward_point;
				$this->product->video_youtube = $this->video_youtube;
				$this->product->Username = $this->username;
				$this->product->discount_price=$this->discount_price;
				$this->product->save();
				$this->product_id = $this->product->getId();
				
			}else{
				echo "here at bad process";
			}
			
			return !$this->hasError();
	
		}
		
	
		
	
	
	
	
	}