<?php
	//no verification is needed, the product belongs to the current uploader
	class FormProcessor_ProductAttribute extends FormProcessor
	{
		protected $db = null;
		public $user = null;
		public $product = null;
		
		
		public function __construct($db, $uploader, $product)
		{
			parent::__construct();
		
			$this->db = $db;	
			$this->product = $product;
			//$this->			
			$this->userID = $uploader->userID;
			$this->uploader_username = $uploader->username;
			$this->product_type=$product['product_type'];
			$this->uploader_network = $uploader->affiliation;
			$this->uploader_email = $uploader->email;
			$this->purchase_type=$product['purchase_type'];
			$this->product_tag = $product['product_tag'];
			$this->purchase = $product['purchase_type'];
			$this->product_category = $product['product_category'];
			echo "product_id: ".$product['product_id'];
			$this->product_id = $product['product_id'];
			//if($this->product->load($this->product_id)){
			$this->product_tag = $product['product_tag'];
	
			//}
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
			
			
			
			$this->domestic_shipping_rate = $this->sanitize($request->getPost('domesticShippingRate'));
			if(strlen($this->domestic_shipping_rate)==0||!is_numeric($this->domestic_shipping_rate))
			{
				$this->addError('shippingRate', 'Please enter a valid shipping rate');
			}
			
			$this->international_shipping_rate = $this->sanitize($request->getPost('internationalShippingRate'));
			if(strlen($this->international_shipping_rate)==0||!is_numeric($this->international_shipping_rate))
			{
				$this->addError('shippingRate', 'Please enter a valid shipping rate');
			}
			
			$this->video_youtube = $this->sanitize($request->getPost('video_youtube'));
			$this->discount_price = $this->sanitize($request->getPost('discount_price'));
			
			if($this->sales_price!='' && is_numeric($this->sales_price) && ($this->sales_price>0)){
				echo 'here at discount price';
				$this->on_sale = 1;
				$this->reward_point = floor(0.03*$this->sales_price)*4;
			}else{
				echo 'here at price';
				$this->reward_point = floor(0.03*$this->price)*4;	
				$this->on_sale = 0;	
			}
			
			$this->return_allowed = $request->getPost('return');

			$this->backorder_time = $this->sanitize($request->getPost('backorder_time'));
			
			$this->description = FormProcessor_BlogPost::cleanHtml($request->getPost('description'));
			
			$this->product_type = $this->sanitize($request->getPost('product'));
			if(strlen($this->product_type)==0)
			{
				$this->addError('product_type', 'Please enter a valid product_type');
			}
			
			
			
			/*$imageForm=new FormProcessor_Image($this->tempProduct, 'storeSeller');
				echo 'here at instantiating image<br />';
			if($imageForm->process($this->request)){
				echo 'here at process request<br />';
				//then update the session variable for it
				$this->messenger->addMessage('Image uploaded');
			}else{
				echo 'here at process error<br />';
				foreach($imageForm->getErrors() as $error)
				{
					$this->messenger->addMessage($error);
				}
			}*/
				
			
			if(!$this->hasError())
			{
				//echo"here at good to save<br />";
				$this->product->product_category = $this->product_category;
				$this->product->inventory_attribute_table = $this->inventory_attribute_table;
				$this->product->purchase_type = $this->purchase_type;
				$this->product->product_type = $this->product_type;
				$this->product->product_tag = $this->product_tag;
				$this->product->name = $this->name;
				$this->product->uploader_id=$this->userID;
				$this->product->uploader_network = $this->uploader_network;
				$this->product->uploader_username = $this->uploader_username;
				$this->product->uploader_email = $this->uploader_email;
				$this->product->product_price_range = $this->product_price_range;
				$this->product->price=$this->price;
				$this->product->on_sale = $this->on_sale;
				$this->product->sales_price=$this->sales_price;
				$this->product->return_allowed = $this->return_allowed;
				$this->product->domestic_shipping_rate = $this->domestic_shipping_rate;
				$this->product->international_shipping_rate = $this->international_shipping_rate;
				$this->product->brand=$this->brand;
				$this->product->profile->description =$this->description;
				$this->product->reward_point = $this->reward_point;
				$this->product->video_youtube = $this->video_youtube;
				$this->product->backorder_time = $this->backorder_time;
				$this->product->save();
				$this->product_id = $this->product->getId();
				
			}else{
				echo "here at bad process";
			}
			
			return !$this->hasError();
	
		}
		
	
		
	
	
	
	
	}