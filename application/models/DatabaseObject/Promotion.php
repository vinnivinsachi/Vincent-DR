<?php

	class DatabaseObject_Promotion extends DatabaseObject
	{
		public $profile=null;
		public $images = array();
		
		const EVENT_STATUS_DRAFT = 'D';
		const EVENT_STATUS_LIVE = 'L';
		
		public function __construct($db)
		{
		
			parent::__construct($db, 'promotions', 'promotion_id');
			$this->add('user_id');
			$this->add('url');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->add('ts_end', time(), self::TYPE_TIMESTAMP);
			$this->add('status', self::EVENT_STATUS_DRAFT);
		
			$this->profile = new Profile_Event($db);
		
		}
		
		protected function postLoad()
		{
			$this->profile->setEventId($this->getId());
			$this->profile->load();
		}
		
		protected function postInsert()
		{
			$this->profile->setEventId($this->getId());
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
			return $this->isSaved() && $this->status==self::EVENT_STATUS_LIVE;
		}
	
		public function sendLive()
		{
			if($this->status != self::EVENT_STATUS_LIVE)
			{
				$this->status = self::EVENT_STATUS_LIVE;
				$this->profile->ts_published = time();
			}
		}
		
		public function sendBackToDraft()
		{
			$this->status = self::EVENT_STATUS_DRAFT;
		}
		
		public static function GetObjects($db, $options=array()) //got the user, got form, got to, got order. 
		{
			//initialize the options
			$defaults = array('offset'=>10,
							  'limit'=>0,
							  'order' => 'p.ts_created'
							  );
			
			//echo $options['username'];
			
			foreach($defaults as $k=>$v)
			{
				$options[$k]=array_key_exists($k, $options)?$options[$k]:$v;
			}
			
			$select = self::_GetBaseQuery($db, $options); //got the basic query form the GetbaseQuery. 
			
			//set the fields to select
			$select->from(null,'p.*');
			
			//set the offset, limit, and ordering of results
			if($options['limit']>0)
			{
				$select->limitpage($options['limit'], $options['offset']);
			}
			if(!empty($options['alphabetLink']) && strlen($options['alphabetLink'])>0)
			{
				$select->joinInner(array('pp'=>'events_profile'), 'pp.event_id = p.event_id');
				$select->where('pp.profile_key = "name"');
				$select->where('pp.profile_value like "'.$options['alphabetLink'].'%"');
			}
			
			$select->order($options['order']);
			
			
			//fetch post data from database
			$data=$db->fetchAll($select);
			
			//turn data into array of Database object_BlogPost objects
			$posts = self::BuildMultiple($db,__CLASS__,$data); //turn everything into a class __CLASS__ represents THIS Class.
			$post_ids = array_keys($posts);
			
			if(count($post_ids)==0)
			{
				return array();
			}
			
			/*******!!!!!!!!!!!!!!!!!!############Very important for getting the correct posts
			*************correct produts/ correct memberships /correct orders**********
			*/
			//load the profile data for loaded posts
			//first argment->database argument, second argument->profile subclass, third argument->ids of post loaded.
			$profiles =Profile::BuildMultiple($db, 'Profile_Event', array('event_id'=>$post_ids));
			//this is a complicated part. //also returns the profile part that corresponds to the postids in profileids. 
			foreach($posts as $post_id =>$post)
			{
				if(array_key_exists($post_id, $profiles) && $profiles[$post_id] instanceof Profile_Event)
				{
					$posts[$post_id]->profile=$profiles[$post_id]; //setting the current Databaseobject Blogpost->post-id = to The current ProfilespostId from the postid in blogpost. putting all the post in one month??
				}
				else
				{
					$posts[$post_id]->profile->setEventId($post_id);
				}
				
			}
			
			$imageOptions = array('event_id' =>$post_ids);
			
			//echo "image options is: ".$imageOptions['username'];
			$images = DatabaseObject_Image::GetImages($db, $imageOptions, 'event_id', 'events_images');
			
			foreach($images as $image)
			{
				$posts[$image->event_id]->images[$image->getId()] = $image;
			}
			
			return $posts;
			
		}
		
		
		private static function _GetBaseQuery($db, $options) 
		{
			return DatabaseObject_StaticUtility:: _GetBaseQuery($db, $options, 'event_id', 'events', 'events_tags', 'p');
		}
		
		public function getTeaser($length)
		{
			return DatabaseObject_StaticUtility::GetTeaser($this->profile->content, $length);
		}
		
		
		public static function GetObjectsCount($db, $options)
		{
			$select = self::_GetBaseQuery($db, $options);
			$select->from(null, 'count(*)');
			return $db->fetchOne($select);
		}
		
		
		public static function GetTagSummary($db, $user_id)
		{
			//echo "your user_id is: ".$user_id;
			return DatabaseObject_StaticUtility::getTagSummaryForObject($db, $user_id, 'events_tags', 'events', self::EVENT_STATUS_LIVE, 'event_id');
		}
		
		
		
		public function getImages()
		{
			$options=array('event_id' =>$this->getId()); //loading images
			$this->images = DatabaseObject_Image::GetImages($this->getDb(), $options, 'event_id', 'events_images');
		}
	
		public function eventTestLoad($ID)
		{
			$id = (int)$ID;
			
			if(strlen($ID)<=0)
			{
				echo "your ID is invalid";
				return false;
			}
			
			$query = sprintf('select %s from %s where event_id = ?', join(', ', $this->getSelectFields()), $this->_table);
			$query = $this->_db->quoteInto($query, $ID);
			
			return $this->_load($query);
		}
		
		public static function GetMonthlySummary($db, $options)
		{
			return DatabaseObject_StaticUtility::GetMonthlySummary($db, $options, 'event_id', 'events', 'events_tags', 'p');
		}
		
		public function setImageOrder($order)
		{	
		
			$this->getImages();
			DatabaseObject_StaticUtility::setImageOrder($this->_db, 'events_images', $order, $this->images);
		}
		
		public function loadLiveObject($user_id, $url)
		{
			
		
			$query = DatabaseObject_StaticUtility::loadLiveObjects($this->_db, $user_id, $url, $this->_table, $this->getSelectFields(), self::EVENT_STATUS_LIVE);
			
			//echo $query;
			//echo "here";
			return $this->_load($query);

		}
		
	}


?>