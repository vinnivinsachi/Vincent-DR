<?php

	//must have getProductForUser()
	//must have generateGSDetailsSession()
	class DatabaseObject_UserProducts extends DatabaseObject
	{
		
		public $profile=null;
		public $images = array();
		public $image_table;
		public $username;
		const PRODUCT_STATUS_DRAFT = 'DRAFT';
		const PRODUCT_STATUS_LIVE = 'LIVE';
		const PRODUCT_STATUS_SOLD = 'SOLD';
		const PRODUCT_STATUS_UNLIST = 'UNLISTED';
		
		public function __construct($db){
			parent::__construct($db, 'user_products', 'products_id');
			$this->add('product_type');
			$this->add('product_tag');
			$this->add('product_price_range');
			$this->add('shipping_rate');
			$this->add('uniqueIdentifierForJS', Text_Password::create(10, 'unpronounceable'));
			$this->add('User_id');
			$this->add('Username');
			$this->add('user_network');
			$this->add('user_city');
			$this->add('url');
			$this->add('name');
			$this->add('price');
			$this->add('brand');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->add('status', self::PRODUCT_STATUS_DRAFT);
			$this->add('listing_type');
			$this->add('new','0');
			$this->add('video_youtube');
			$this->add('reward_point',0);
			$this->add('quantity');
			$this->add('main_color');
			$this->add('arm_length');
			$this->add('bust');
			$this->add('bust_to_bust');
			$this->add('chest');
			$this->add('crotch');
			$this->add('hip');
			$this->add('nape_to_waist');
			$this->add('neck');
			$this->add('shoulder_to_bust');
			$this->add('shoulder');
			$this->add('shoulder_to_waist');
			$this->add('waist');
			$this->add('waist_floor');
			$this->add('wrist');
			$this->add('armpit_circumference');
			$this->add('pants_length');
			$this->add('size');
			$this->add('heel');
			$this->add('body_height');
			$this->add('last_status_change', time(), self::TYPE_TIMESTAMP);
			
			$this->profile = new Profile_UserProducts($db);
			$this->setImageDatabaseTable();
			//this attribute is purely for the sake of passing it to other objects
		}
		
		
		//because of all the constraints make sure that all the profile stuff that is connected iwth the product must have something done to it when messing with the database. 
		protected function postLoad(){
			//$this->getImages();
			$this->profile->setProductId($this->getId());
			$this->profile->load();
			//echo "here at post load<br />";
			$this->images=$this->getImages();
			//$this->images = $this->getImages();
		}
		
		protected function postInsert(){
			$this->profile->setProductId($this->getId());
			$this->profile->save(false);
			return true;
		}
		
		protected function preUpdate()
        {
			$this->user_network = DatabaseObject_StaticUtility::generateUniqueUrl($this->_db, $this->_table, $this->user_network, $this->User_id);
			$this->user_city = DatabaseObject_StaticUtility::generateUniqueUrl($this->_db, $this->_table, $this->user_city, $this->User_id);
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
			$this->name= DatabaseObject_StaticUtility::generateUniqueUrl($this->_db, $this->_table, $this->url, $this->User_id);
			return true;
		}
		
		public function setImageDatabaseTable(){
			$this->image_table='user_products_images';	
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
			$select->from('user_products', '*')
				   ->where('User_id = ?', $userId)
				   ->where('products_id = ?', $productId)
				   ->where('product_type =?', $product_type);
				   
			echo $select;
			return $this->_load($select);
		}
		
		public function loadAllProductForUser($userId, $options)
		{
			$select = $this->_db->select();
			$select->from('user_products', '*')
				   ->where('products.User_id = ?', $userId);
		
			if($options['order']){
				$select->order($options['order']);
			}
			if($options['tag']!=''){
				$select->joinInner(array('t'=>'products_tags'), "t.product_id = $this->_idField");
				$select->where('t.product_type_table = ?', $options['product']);
				$select->where('t.tag = ?', $options['tag']);	
			}
			//echo $select;
			return $this->_db->fetchAll($select);
		}
		
		
		public function getTagFromProduct(){
			$select = $this->_db->select();
				
			$select->from('user_products_tags', 'tag')
				  ->where('product_id = ?', $this->getId());
					 
			return $this->_db->fetchOne($select);
		}
		
		public function generateGSDetailsSession(){
			$details = new stdClass;
			
			$details->name = $this->name;
			$details->discount_price = $this->discount_price;
			$details->reward_point = $this->reward_point;
			$details->product_type = $this->product_type;
			$details->product_id = $this->getId();
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
		
		//The following is way tooooo expensive
		/*public static function GetObjects($db, $options=array()){
			$defaults = array('offset'=>12,
							  'limit'=>0,
							  'order' => 'p.ts_created'
							  );
					
			foreach($defaults as $k=>$v)
			{
				$options[$k]=array_key_exists($k, $options)?$options[$k]:$v;
			}
			
			if(!empty($options['cat']) && strlen($options['cat'])>0)
			{
				$select = self::_GetBaseQuery2($db, $options); 
				//echo "here";
			}
			else
			{
				$select = self::_GetBaseQuery($db, $options); 
			}
			
			$select->from(null,'p.*');
			
			if($options['limit']>0)
			{
				$select->limitpage($options['limit'], $options['offset']);
			}
			

			if(!empty($options['alphabetLink']) && strlen($options['alphabetLink'])>0)
			{
				$select->joinInner(array('pp'=>'products_profile'), 'pp.product_id = p.product_id');

				$select->where('pp.profile_key = "name"');
				$select->where('pp.profile_value like "'.$options['alphabetLink'].'%"');
			}
			
			if(!empty($options['brand']) && $options['brand']!="none")
			{
			
				//echo $options['brand']."<br/>";
			
				$select->joinInner(array('t'=>'products_profile'), 't.product_id = p.product_id');
				$select->where('t.profile_key = "brand"');
				$select->where('t.profile_value = ?', $options['brand']);
				
			}
			
			
			if(!empty($options['style']) && $options['style']!="none")
			{
				$select->joinInner(array('e'=>'products_profile'), 'e.product_id = p.product_id');

				$select->where('e.profile_key = "type"');
				$select->where('e.profile_value = ?', $options['style']);
			}
			
			if(!empty($options['status']) && strlen($options['status'])>0)
			{
				$select->where('p.status = ?', $options['status']);
			}
			
			if(!empty($options['search']) && strlen($options['search'])>0)
			{
			
				$select-> joinInner(array('u' =>'products_profile'), 'p.product_id = u.product_id', array())
				   ->where('lower(u.profile_value) like lower(?)', '%'.$options['search']. '%')
				   ->where('u.profile_key = ?', 'name');
			}
			
			//echo $select."<br/>";
			
			$data=$db->fetchAll($select);
			
			$products = self::BuildMultiple($db,__CLASS__,$data); 
			$products_ids = array_keys($products);
			
			//echo "count of products_ids is: ".count($products_ids)."<br/>";
			
			if(count($products_ids)==0)
			{
				return array();
			}
			
			
			$profiles =Profile::BuildMultiple($db, 'Profile_Product', array('product_id'=>$products_ids));
			
			foreach($products as $product_id =>$product)
			{
				if(array_key_exists($product_id, $profiles) && $profiles[$product_id] instanceof Profile_Product)
				{
					$products[$product_id]->profile=$profiles[$product_id]; 
				}
				else
				{
					$products[$product_id]->profile->setProductId($product_id);
				}
				
			}
			
			//load for the images for each post
			$imageOptions = array('product_id' =>$products_ids );
			
			$images = DatabaseObject_Image::GetImages($db, $imageOptions, 'product_id', 'products_images');
			
			foreach($images as $image)
			{
				//echo "image id is: ".$image->product_id."<br/>";
				$products[$image->product_id]->images[$image->getId()] = $image;
			}
			
			
			return $products;
		}*/
		
		
		public static function GetObjectsCount($db, $options){
			$select = self::_GetBaseQuery($db, $options);
			$select->from(null, 'count(*)');
			return $db->fetchOne($select);
		}
		
		
		public function getImages(){
			$select = $this->_db->select();
			$select->from('user_products_images', '*')
				   ->where('product_id = ?', $this->getId());
			//echo $select;
			return $this->_db->fetchAll($select);
		}
		

		
		public function setImageOrder($order){	
			$this->getImages();
			DatabaseObject_StaticUtility::setImageOrder($this->_db, 'user_products_images', $order, $this->images);
		}
		
	}

?>