<?php
	//must have getProductForUser()
	//must have generateGSDetailsSession()
	class DatabaseObject_Products extends DatabaseObject
	{
		public $profile=null;
		public $images = array();
		//inventory is actually buy now. 
		public $inventory = array();
		public $image_table;
		//public $product_id;
		public $username;
		public $inventoryTable = '';
		//product status include:
		//Unlisted, Listed, Deleted, Bought(Buy_now only), Flagged 
		const PRODUCT_STATUS_DRAFT = 'Unlisted';
		const PRODUCT_STATUS_LIVE = 'Listed';
		const PRODUCT_FLAGGED = 'FLAGGED';
		const PRODUCT_STATUS_UNLIST = 'Unlisted';
		
		public function __construct($db){
			parent::__construct($db, 'products', 'product_id');
			$this->add('purchase_type');
			$this->add('product_category');
			$this->add('inventory_attribute_table');
			$this->add('product_type');
			$this->add('product_tag');
			$this->add('product_price_range');
			$this->add('domestic_shipping_rate');
			$this->add('international_shipping_rate');
			$this->add('uploader_id');
			$this->add('uploader_username');
			$this->add('uploader_network');
			$this->add('uploader_email');
			$this->add('url');
			$this->add('name');	
			$this->add('price');
			$this->add('on_sale');
			$this->add('sales_price');
			$this->add('brand');
			$this->add('inventory_reference', Text_Password::create(10, 'alphabetical'));
			$this->add('uniqueIdentifierForJS', Text_Password::create(10, 'alphabetical'));
			$this->add('return_allowed', '1');
			$this->add('flagged', '0');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->add('status', self::PRODUCT_STATUS_DRAFT);
			$this->add('listing_type');
			$this->add('new','0');
			$this->add('video_youtube');
			$this->add('reward_point',0);
			$this->add('backorder_time', '0');
			$this->add('social_usage','off');
			$this->add('competition_usage','off');
			$this->add('last_status_change', time(), self::TYPE_TIMESTAMP);
			
			$this->profile = new Profile_Products($db);
			$this->setImageDatabaseTable();
			//this attribute is purely for the sake of passing it to other objects
		}
		
		//because of all the constraints make sure that all the profile stuff that is connected iwth the product must have something done to it when messing with the database. 
		protected function postLoad(){
			//$this->getImages();
			$this->profile->setProductId($this->getId());
			$this->profile->load();
			//echo "here at post load<br />";
			//for display of product images
			$this->images=$this->getImages();
			//for display of inventory items
			//$this->inventory = $this->getInventory($this->inventory_attribute_table);
		}
		
		protected function postInsert(){
			$this->profile->setProductId($this->getId());
			$this->profile->save(false);
			return true;
		}
		
		protected function postUpdate(){
			$this->profile->save(false);
			return true;
		}
		
		protected function preDelete(){
			$this->getImages();
			foreach ($this->images as $image){
				$image->delete(false);
			}
			
			$this->profile->delete();
			return true;
		}
		
		protected function preInsert(){
			$this->url= DatabaseObject_StaticUtility::generateUniqueUrl($this->_db, $this->_table, $this->name, $this->uploader_id);
			return true;
		}
		
		public function setImageDatabaseTable(){
			$this->image_table='product_images';	
		}
		
		public function setUsernameForProduct($username)
		{
			$this->username=$username;
		}
		
		public function isLive(){
			return $this->isSaved() && $this->status==self::PRODUCT_STATUS_LIVE;
		}
	
		public function sendLive(){
			if($this->status != self::PRODUCT_STATUS_LIVE){
				$this->status = self::PRODUCT_STATUS_LIVE;
				$this->profile->ts_published = time();
			}
		}
		
		public function sendBackToDraft(){
			$this->status = self::PRODUCT_STATUS_DRAFT;
		}
		
		public function getProductForUser($userId, $productId, $product_type)
		{
			$select = $this->_db->select();
			$select->from('products', '*')
				   ->where('uploader_id = ?', $userId)
				   ->where('product_id = ?', $productId)
				   ->where('product_tag = ?', $product_type);
			return $this->_load($select);
		}
		
		public function loadAllProductForUser($userId, $options)
		{
			$select = $this->_db->select();
			$select->from('products', '*')
				   ->where('products.uploader_id = ?', $userId);
		
			if($options['order']){
				$select->order($options['order']);
			}
			if($options['tag']!=''){
				$select->joinInner(array('t'=>'product_tags'), "t.product_id = $this->_idField");
				$select->where('t.product_type_table = ?', $options['product']);
				$select->where('t.tag = ?', $options['tag']);	
			}
			//echo $select;
			return $this->_db->fetchAll($select);
		}
		
		
		public function getTagFromProduct(){
			$select = $this->_db->select();
				
			$select->from('product_tags', 'tag')
				  ->where('product_id = ?', $this->getId());
					 
			return $this->_db->fetchOne($select);
		}
		
		public function generateGSDetailsSession(){
			$details = new stdClass;
			
			$details->name = $this->name;
			$details->discount_price = $this->discount_price;
			$details->reward_point = $this->reward_point;
			$details->product_tag = $this->product_tag;
			$details->product_type = $this->product_type;
			$details->user_network = $this->user_network;
			$details->product_id = $this->getId();
			$details->backorder_time = $this->backorder_time;
			$details->price = $this->price;
			$details->brand = $this->brand;
			$details->status = $this->status;
			if($this->status=='VendorItemD'){
				$details->vendorItem = true;
			}else{
				$details->vendorItem=false;
			}

			$details->description = $this->profile->description;
			echo "here at genearteGSDetailsSession<br />";
			return $details;	
		}
		
		public static function GetObjectsCount($db, $options){
			$select = self::_GetBaseQuery($db, $options);
			$select->from(null, 'count(*)');
			return $db->fetchOne($select);
		}
			
		public function getImages(){	
			$select = $this->_db->select();
			$select->from('product_images', '*')
				   ->where('Product_id = ?', $this->getId());
			//echo $select;
			return $this->_db->fetchAll($select);
		}
		
		//grabs inventory in the products_shoes_inventory or products_dancewear_inventory
		public function getInventory($inventoryTable){
			$select = $this->_db->select();
			$select->from($inventoryTable,'*')
				->where('product_id=?',$this->getId());
			
			return $this->_db->fetchAll($select);
		}
		
		//grabs customize attributes in products_shoes_customize or products_dancewear_customize (cm)
		public function getCustomizeAttributes($attributeTable){
		}
		
		//sets customize orders in order_shoes_customize (with selected attributs)
		//sets customize orders in order_dancewear_customize (with inputed body measurements)
		public function setCustomizeOrder($attributesArray){
			
		}
	
		public function setImageOrder($order){	
			$this->getImages();
			DatabaseObject_StaticUtility::setImageOrder($this->_db, 'product_images', $order, $this->images);
		}	
	}
?>