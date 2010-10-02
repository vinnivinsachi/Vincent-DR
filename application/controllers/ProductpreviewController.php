<?php

	/*productpreview handles the display of product
	productpreview 
	
	********/
	class ProductpreviewController extends CustomControllerAction
	{
		public $product;
		public $request;
		public function init()
		{
			parent::init();
			$this->breadcrumbs->addStep('DancewearRialto partner product list', $this->getUrl(null, 'Productpreview'));

			//$this->request=new stdClass();
			
		}
		
		public function preDispatch(){
			parent::preDispatch();
			$this->request = $this->getRequest();
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;

		}
	
		public function indexAction()
		{
				
		}
		
		public function tagAction()
		{
			$options=array();
			$tag = $this->request->getParam('tag');
			$this->view->seller='dancewear rialto';
			$sellerType = $this->request->getParam('seller');
			if($sellerType!='dancewear rialto'){
				$this->view->seller = $sellerType;
			}
			$network = $this->request->getParam('network');
			if($network!=''){
				$options['user_network']=$network;
			}
			//echo 'here';
			
			$product = DatabaseObject_Helper_ProductPreview::retrieveAllSingleTagForProduct($this->db, $tag, 'storeSeller', $options);
			//this is for retrieving supplimentary tags fro products. 
			/*$product = DatabaseObject_Helper_ProductPreview::retrieveAllProductForTag($this->db, $tag, 'storeSeller', $options);*/

			$this->view->tag = $tag;
			$this->view->products = $product;
			//Zend_Debug::dump($product);
		}
		
		public function detailsAction(){
			$id = $this->request->getParam('id');
			$tag = $this->request->getParam('tag');
			$this->view->tag=$tag;
			
			$product = new DatabaseObject_Products($this->db);
			$product->load($id);
			//Zend_Debug::dump($product);
			//selecting color/image attributes
			$selectColumnOptions=array('group'=>true, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$attributeArray = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $product->Username, $product->product_type, $id, $selectColumnOptions);
			
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$imageAttribute = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $product->Username, $product->product_type, $id, $selectColumnOptions);
			
			$this->view->attributeArray=$attributeArray;
			$this->view->imageAttribute=$imageAttribute;
			
			include('productConfig.php');

			$this->view->productType = $productTypeConfig[$product->product_type];
			//Zend_Debug::Dump($productTypeConfig[$product->product_type]);

			$this->view->product = $product;
			
			
			$shoutboxMessages = DatabaseObject_Helper_Communication::retriveShoutOutForProduct($this->db, $product->getId(), $product->product_type, 'storeSeller');
			
			$this->view->shoutboxMessages = $shoutboxMessages;
			
			$this->view->productSellerEmail = DatabaseObject_Helper_ProductPreview::retrieveUserEmailForProduct($this->db,$product->getId(), $product->product_type, 'storeSeller');
			$this->view->user=$this->userObject;

		}
		
		public function quicklookAction(){
			$id = $this->request->getParam('id');
			
			$product = new DatabaseObject_Products($this->db);
			$product->load($id);
			//Zend_Debug::dump($product);
			//selecting color/image attributes
			$selectColumnOptions=array('group'=>true, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$attributeArray = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $product->Username, $product->product_type, $id, $selectColumnOptions);
			
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$imageAttribute = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $product->Username, $product->product_type, $id, $selectColumnOptions);
			
			$this->view->attributeArray=$attributeArray;
			$this->view->imageAttribute=$imageAttribute;
			
			
			include('productConfig.php');

			$this->view->productType = $productTypeConfig[$product->product_type];
			//Zend_Debug::Dump($productTypeConfig[$product->product_type]);

			$this->view->product = $product;
			
		}
		
		//this is for storeSellers ONLY!
		public function listingpreviewAction(){
			$id=$this->request->getParam('id');
			$product_type=$this->request->getParam('product');
			//error check for type;
			//$product = ObjectGenerator::generateProductForListing($this->db, $product_type);
			$product= new DatabaseObject_Products($this->db);
			echo $this->signedInUserSessionInfoHolder->generalInfo->userID;
			$product->getProductForUser($this->signedInUserSessionInfoHolder->generalInfo->userID, $id);								   			
			$this->view->product=$product;
			//load all image attribute for order
			//*******************IMAGES ATTRIBUTE*****************************//
			$selectColumnOptions=array('group'=>true, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$attributeArray = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $product->Username, $product_type, $id, $selectColumnOptions);
			
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$imageAttribute = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $product->Username, $product_type, $id, $selectColumnOptions);
			
			$this->view->attributeArray=$attributeArray;
			$this->view->imageAttribute=$imageAttribute;
			//load all measurement w/ image attribute for order
			//*******************MEASUREMENT ATTRIBUTE*************************//
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('measurement_attribute_id', 'measurement_name', 'beginning_measurement', 'ending_measurement', 'incremental_measurement','price_adjustment','filename', 'video_youtube', 'description'));
			$measurementAttribute = DatabaseObject_Helper_ProductListing::getMeasurementAttribute($this->db, $product->Username, $product_type, $id, $selectColumnOptions);
			
			$this->view->measurementAttribute = $measurementAttribute;
			//load all sizing attribute for order
			//*******************SIZE ATTRIBUTE*******************************//
			$selectColumnOptions=array('group'=>true, 
									   'value'=>array ('size_attribute_id', 'attribute_name', 'size_name', 'price_adjustment'));
			$sizeAttributeArray = DatabaseObject_Helper_ProductListing::getSizeAttribute($this->db, $product->Username, $product_type, $id, $selectColumnOptions);
			
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('size_attribute_id', 'attribute_name', 'size_name', 'price_adjustment'));
			$sizeAttribute = DatabaseObject_Helper_ProductListing::getSizeAttribute($this->db, $product->Username, $product_type, $id, $selectColumnOptions);
			$this->view->sizeAttributeArray=$sizeAttributeArray;
			$this->view->sizeAttribute=$sizeAttribute;
			
			//********************RETRIEVE INVENTORY ITEMS*********************//
			$inventoryItems = DatabaseObject_Helper_InventoryManager::retriveAllInventoryForSpecificProduct($this->db, $product->Username, $product_type, $id);
			
			//Zend_Debug::dump($inventoryItems);
			$this->view->inventoryItems = $inventoryItems;
			
			//load review for product
		}
		
	}
?>