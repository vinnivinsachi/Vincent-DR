<?php

	class FormProcessor_UserProduct extends FormProcessor
	{
		protected $db = null;
		public $user = null;
		public $product = null;
		
		
		public function __construct($db, $signedInUserSessionInfoHolder, $product_type, $product_tag, $product_id=0, $specificProductTypeConfig)
		{
			parent::__construct();
		
		
			$this->db = $db;	
			$this->product = new DatabaseObject_UserProducts($this->db);
			$this->userID = $signedInUserSessionInfoHolder->generalInfo->userID;
			$this->product_tag = $product_tag;
			$this->username = $signedInUserSessionInfoHolder->generalInfo->username;
			$this->user_network = $signedInUserSessionInfoHolder->generalInfo->affiliation;
			$this->user_city = $signedInUserSessionInfoHolder->sellerInfo->city;
			$this->product_type=$product_type;
			$this->specificProductTypeConfig=$specificProductTypeConfig;
			//Zend_Debug::dump($productTypeConfig);
			echo "product_id: ".$product_id;
			if($this->product->getProductForUser($this->userID, $product_id, $product_type)){
				$this->product_id=$product_id;
				$this->name=$this->product->name;				
				$this->shipping_rate = $this->product->shipping_rate;
				$this->quantity = $this->product->quantity;
				$this->price=$this->product->price;
				$this->product_tag = $this->product->product_tag;
				$this->brand=$this->product->brand;
				$this->reward_point = $this->product->reward_point;
				$this->video_youtube = $this->product->video_youtube;
				$this->description = $this->product->profile->description;
				foreach($this->specificProductTypeConfig['measurement'] as $k=>$v){
					$this->$k = $this->product->$k;
				}
			}
		}
	
	
		public function process(Zend_Controller_Request_Abstract $request)
		{
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
			}else{
				switch ($this->price){
					case ($this->price<100):
						$this->product_price_range = 'price_category_1';
						break;
					case ($this->price>100 && $this->price<200):
						$this->product_price_range = 'price_category_2';
						break;
					case ($this->price>200 && $this->price<500):
						$this->product_price_range = 'price_category_3';
						break;
					case ($this->price>500 && $this->price<1000):
						$this->product_price_range = 'price_category_4';
						break;
					case ($this->price>1000 && $this->price<5000):
						$this->product_price_range = 'price_category_5';
						break;
				}
			}
			
			$this->brand = $this->sanitize($request->getPost('brand'));
			if(strlen($this->brand)==0)
			{
				$this->addError('brand', 'Please enter a valid product brand');
			}
			
			$this->shipping_rate = $this->sanitize($request->getPost('shippingRate'));
			if(strlen($this->shipping_rate)==0||!is_numeric($this->shipping_rate))
			{
				$this->addError('shippingRate', 'Please enter a valid shipping rate');
			}
																	 
			
			$this->reward_point = floor(0.03*$this->price)*4;
			$this->quantity = $this->sanitize($request->getPost('quantity'));
			$this->video_youtube = $this->sanitize($request->getPost('video_youtube'));
			$this->description = FormProcessor_BlogPost::cleanHtml($request->getPost('description'));
			$this->product_type = $this->sanitize($request->getPost('product'));
			if(strlen($this->product_type)==0)
			{
				$this->addError('product_type', 'Please enter a valid product_type');
			}
			
			if(!$this->hasError())
			{
				//echo"here at good to save<br />";
				$this->product->product_type = $this->product_type;
				$this->product->url = $this->name;
				$this->product->User_id=$this->userID;
				$this->product->Username = $this->username;
				$this->product->shipping_rate=$this->shipping_rate;
				$this->product->quantity = $this->quantity;
				$this->product->user_network = $this->user_network;
				$this->product->product_price_range = $this->product_price_range;
				$this->product->user_city = $this->user_city;
				$this->product->name=$this->name;
				$this->product->price=$this->price;
				$this->product->brand=$this->brand;
				$this->product->profile->description =$this->description;
				$this->product->product_tag = $this->product_tag;
				$this->product->user_network = $this->user_network;
				$this->product->reward_point = $this->reward_point;
				$this->product->video_youtube = $this->video_youtube;
				foreach($this->specificProductTypeConfig['measurement'] as $k=>$v){
					$this->product->$k = $this->sanitize($request->getPost($k));
				}
				$this->product->save();
				$this->product_id = $this->product->getId();
				
			}else{
				echo "here at bad process";
			}
			
			return !$this->hasError();
	
		}
		
	
		
	
	
	
	
	}