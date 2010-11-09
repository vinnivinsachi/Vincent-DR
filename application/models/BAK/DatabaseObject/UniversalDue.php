<?php
	class DatabaseObject_UniversalDue extends DatabaseObject
	{
		
		public $profile=null;
		public $images = array();
		
		const UNIVERSAL_DUE_STATUS_DRAFT = 'D';
		const UNIVERSAL_DUE_STATUS_LIVE = 'L';
		
		public function __construct($db)
		{
			parent::__construct($db, 'universal_dues', 'universal_dues_id');
			$this->add('user_id');
			$this->add('url');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->add('status', self::UNIVERSAL_DUE_STATUS_DRAFT);
			
		
			$this->profile = new Profile_UniversalDue($db);
		}
		
		//because of all the constraints make sure that all the profile stuff that is connected iwth the product must have something done to it when messing with the database. 
		protected function postLoad()
		{
		
			$this->profile->setUniversalDueId($this->getId());
			$this->profile->load();
			
			
		}
		
		protected function postInsert()
		{
			$this->profile->setUniversalDueId($this->getId());
			$this->profile->save(false);
			return true;
		}
		
		protected function postUpdate()
		{
			$this->profile->save(false);
			return true;
		}
		
		protected function preDelete()
		{	
			$this->getImages();
			foreach ($this->images as $image)
			{
				$image->delete(false);
			}
			
			$this->profile->delete();
			return true;
		}
		
		protected function preInsert()
		{
			$this->url= DatabaseObject_StaticUtility::generateUniqueUrl($this->_db, $this->_table, $this->profile->name, $this->user_id);
			return true;
		
		}
		
		public function isLive()
		{
			return $this->isSaved() && $this->status==self::UNIVERSAL_DUE_STATUS_LIVE;
		}
	
		public function sendLive()
		{
			if($this->status != self::UNIVERSAL_DUE_STATUS_LIVE)
			{
				$this->status = self::UNIVERSAL_DUE_STATUS_LIVE;
				$this->profile->ts_published = time();
			}
		}
		
		public function sendBackToDraft()
		{
			$this->status = self::UNIVERSAL_DUE_STATUS_DRAFT;
		}
		
		
		
		public static function GetObjects($db, $options=array()) //got the user, got form, got to, got order. 
		{
			$defaults = array('offset'=>0,
							  'limit'=>0,
							  'order' => 'p.ts_created'
							  );
					
			foreach($defaults as $k=>$v)
			{
				$options[$k]=array_key_exists($k, $options)?$options[$k]:$v;
			}
			
			$select = self::_GetBaseQuery($db, $options); 
			$select->from(null,'p.*');
			
			if($options['limit']>0)
			{
				$select->limit($options['limit'], $options['offset']);
			}
			
			$select->order($options['order']);
			
			//echo $select;
			
			$data=$db->fetchAll($select);
			
			//echo count($data);
			
			$products = self::BuildMultiple($db,__CLASS__,$data); 
			
			//echo "<br/>first product count: ".count($products);
			$products_ids = array_keys($products);
			
			if(count($products_ids)==0)
			{
				return array();
			}
			
			//echo "here";
			$profiles =Profile::BuildMultiple($db, 'Profile_UniversalDue', array('universal_dues_id'=>$products_ids));
			
			//echo "<br/>profile count: ".count($profiles);
			
			foreach($products as $product_id =>$product)
			{
				if(array_key_exists($product_id, $profiles) && $profiles[$product_id] instanceof Profile_UniversalDue)
				{
					$products[$product_id]->profile=$profiles[$product_id]; 
				}
				else
				{
					$products[$product_id]->profile->setUniversalDueId($product_id);
					
				}
			}
		
			//load for the images for each post
			$imageOptions = array('universal_dues_id' =>$products_ids );
			
			$images = DatabaseObject_Image::GetImages($db, $imageOptions, 'universal_dues_id', 'universal_dues_images');
			
			//echo "<br/>count images: ".count($images);
			
			//echo "<br/>product count before images: ".count($products);
			
			foreach($images as $image)
			{
				//echo "<br/>------image_product_id is: ".$image->universal_dues_id;
				$products[$image->universal_dues_id]->images[$image->getId()] = $image;
			}
			
			
			//echo "<br/>product count: ".count($products);
			return $products;
		}
		
		
		public static function GetObjectsCount($db, $options)
		{
			$select = self::_GetBaseQuery($db, $options);
			$select->from(null, 'count(*)');
			return $db->fetchOne($select);
		}
		
		
		
		public function loadLiveObject($user_id, $url)
		{
			$query = DatabaseObject_StaticUtility::loadLiveObjects($this->_db, $user_id, $url, $this->_table, $this->getSelectFields(), self::UNIVERSAL_DUE_STATUS_LIVE);
			
			//echo "query is: ".$query;
			
			return $this->_load($query);
		}
		
		
		public function getImages()
		{
			$options=array('universal_dues_id' =>$this->getId()); //loading images
			$this->images = DatabaseObject_Image::GetImages($this->getDb(), $options, 'universal_dues_id', 'universal_dues_images');
		}
		
		
		
		
		
		private static function _GetBaseQuery($db, $options) 
		{
			return DatabaseObject_StaticUtility::_GetBaseQuery($db, $options, 'universal_dues_id', 'universal_dues', 'universal_dues_tags', 'p');
		}
		
		
		public function getTeaser($length)
		{
			return DatabaseObject_StaticUtility::GetTeaser($this->profile->content, $length);
		}		
		
		
		public static function GetMonthlySummary($db, $options)
		{
			return DatabaseObject_StaticUtility::GetMonthlySummary($db, $options, 'universal_dues_id', 'universal_dues', 'universal_dues_tags', 'p');
		}
		
		public static function getTagSummary($db, $user_id)
		{
			//echo "<br/>you are at getTagSummary in products databaseobject<br/>";
			return DatabaseObject_StaticUtility::getTagSummaryForObject($db, $user_id, 'universal_dues_tags','', 'universal_dues', self::UNIVERSAL_DUE_STATUS_LIVE, 'universal_dues_id');
		
		}
		
		
		
		
		public function setImageOrder($order)
		{	
						$this->getImages();

			DatabaseObject_StaticUtility::setImageOrder($this->_db, 'universal_dues_images', $order, $this->images);
		}
		
		
		
		
		public function TestLoad($ID)
		{
			$id = (int)$ID;
			
			if(strlen($ID)<=0)
			{
				echo "your ID is invalid";
				return false;
			}
			
			$query = sprintf('select %s from %s where universal_dues_id = ?', join(', ', $this->getSelectFields()), $this->_table);
			$query = $this->_db->quoteInto($query, $ID);
			
			return $this->_load($query);
		}
	}

?>