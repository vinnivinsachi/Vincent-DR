<?php

	//pg 221
	class DatabaseObject_BlogPost extends DatabaseObject
	{
		public $profile=null; //setting the profile of the BlogPost.
		public $images = array();
		//public $post_id = null;
		
		private $databaseColumn = 'post_id';
		
		
		const STATUS_DRAFT = 'D';
		const STATUS_LIVE = 'L';
		
		public function __construct($db)
		{
			parent::__construct($db, 'blog_posts', 'post_id'); //database, table, idField
			$this->add('user_id');
			$this->add('url');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->add('status', self::STATUS_DRAFT);
			
			$this->profile = new Profile_BlogPost($db);
			
			//ah everthing here added can be automatically called because when instantiated, authough it is not inserted into the database, its value can be retrieved. because of the add funciton puts in the databaseobject arrays, and paired with the _get function, everything here can be retrieved. 
			
		}
		
		protected function postLoad()
		{
			$this->profile->setPostId($this->getId());
			$this->profile->load();
			
		
		}
		
		protected function postInsert()
		{
			$this->profile->setPostId($this->getId());
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
			$this->url = DatabaseObject_StaticUtility::generateUniqueUrl($this->_db, $this->_table, $this->profile->title,  $this->user_id);
			
			//echo "here at preinsert id: ".$this->user_id; this->user_id is retrived because when the user inserts a new column, the user_id is automatically et. 
			return true;
		}
		
		public function sendLive()
		{
			if($this->status!=self::STATUS_LIVE)
			{
				$this->status=self::STATUS_LIVE;
				$this->profile->ts_published = time();
			}
		}
		
		
		
		public function isLive()
		{
			return $this->isSaved() && $this->status == self::STATUS_LIVE; //isSaved is a mother DataObject function. 
		}
		
		public function sendBackToDraft()
		{
			$this->status = self::STATUS_DRAFT;
		}
	
		public function getTeaser($length)
		{
			return DatabaseObject_StaticUtility::GetTeaser($this->profile->content, $length);
		}
		
		
		
		public static function GetObjects($db, $options=array()) //got the user, got form, got to, got order. 
		{
			//initialize the options
			$defaults = array('offset'=>10,
							  'limit'=>0,
							  'order' => 'p.ts_created'
							  );
			
			//echo $options['username'];
			
			//echo "params for get Objects: ".$options['style']."<br/>";
			
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
			//set the fields to select
			$select->from(null,'p.*');
			
			//set the offset, limit, and ordering of results
			if($options['limit']>0)
			{
				$select->limitpage($options['limit'], $options['offset']);
			}
			
			if(!empty($options['alphabetLink']) && strlen($options['alphabetLink'])>0)
			{
				$select->joinInner(array('pp'=>'blog_posts_profile'), 'pp.post_id = p.post_id');
				$select->where('pp.profile_key = "title"');
				$select->where('pp.profile_value like "'.$options['alphabetLink'].'%"');
			}
			
				if(!empty($options['brand']) && $options['brand']!="none")
			{
			
				//echo $options['brand']."<br/>";
			
				$select->joinInner(array('t'=>'blog_posts_category'), 't.post_id = p.post_id');
				$select->where('t.tag = ?', $options['brand']);
				
			}
			/*else
			{
				$select->joinInner(array('t'=>'blog_posts_category'), 't.post_id = p.post_id');

			}*/
			
			
			if(isset($options['style']) && $options['style']!="none")
			{
				$select->joinInner(array('d'=>'blog_posts_tags'), 'd.post_id = p.post_id');
				$select->where('d.tag = ?', $options['style']);
			}
			/*else
			{
				$select->joinInner(array('d'=>'blog_posts_tags'), 'd.post_id = p.post_id');
			}*/
			
			if(!empty($options['status']) && $options['status']!="all")
			{
				$select->where('p.status = ?', $options['status']);
			}
			
			
			$select->order($options['order']);
			
			//echo "<br/>".$select; 
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
			$profiles =Profile::BuildMultiple($db, 'Profile_BlogPost', array('post_id'=>$post_ids));
			//this is a complicated part. //also returns the profile part that corresponds to the postids in profileids. 
			foreach($posts as $post_id =>$post)
			{
				if(array_key_exists($post_id, $profiles) && $profiles[$post_id] instanceof Profile_BlogPost)
				{
					$posts[$post_id]->profile=$profiles[$post_id]; //setting the current Databaseobject Blogpost->post-id = to The current ProfilespostId from the postid in blogpost. putting all the post in one month??
				}
				else
				{
					$posts[$post_id]->profile->setPostId($post_id);
				}
				
			}
			

			
			
			$imageOptions = array('post_id' =>$post_ids);
			
			//echo "image options is: ".$imageOptions['username'];
			$images = DatabaseObject_Image::GetImages($db, $imageOptions, 'post_id', 'blog_posts_images');
			
			foreach($images as $image)
			{
				$posts[$image->post_id]->images[$image->getId()] = $image;
			}
			
			
			return $posts;
		}
		
		
		public static function GetMonthlySummary($db, $options)
		{
			return DatabaseObject_StaticUtility::GetMonthlySummary($db, $options, 'post_id', 'blog_posts', 'blog_posts_tags', 'p');
		}
		
		
		public static function GetObjectsCount($db, $options)
		{
			$select = self::_GetBaseQuery($db, $options);
			$select->from(null, 'count(*)');
			return $db->fetchOne($select);
		}
		
		private static function _GetBaseQuery($db, $options) 
		{
			return DatabaseObject_StaticUtility:: _GetBaseQuery($db, $options, 'post_id', 'blog_posts', 'blog_posts_tags', 'p');
		}
		
		private static function _GetBaseQuery2($db, $options) 
		{
			return DatabaseObject_StaticUtility::_GetBaseQuery($db, $options, 'post_id', 'blog_posts', 'blog_posts_category', 'p');
		}
			
		public function loadLiveObject($user_id, $url)
		{
			
		
			$query = DatabaseObject_StaticUtility::loadLiveObjects($this->_db, $user_id, $url, $this->_table, $this->getSelectFields(), self::STATUS_LIVE);
			
			//echo $query;
			//echo "here";
			return $this->_load($query);

		}
		
		public function getImages()
		{
			$options=array('post_id' =>$this->getId()); //loading images
			$this->images = DatabaseObject_Image::GetImages($this->getDb(), $options, 'post_id', 'blog_posts_images');   
		}
		//---------------------------------------------The Tagging Section
		
		
		public function hasTag($tag)
		{
			if(!$this->isSaved())
			{
				return array();			
			}
			
			$select = DatabaseObject_StaticUtility::hasTag($this->_db, $tag, 'blog_posts_tags', 'post_id', $this->getId());
	
			return $this->_db->fetchOne($select) > 0;
		}	
		

		
		public function deleteAllTags()
		{
			if(!$this->isSaved())
			{
				return;
			}
			
			$this->_db->delete('blog_posts_tags', 'post_id= '.$this->getId());
		}
		
		
		
		public static function GetTagSummary($db, $user_id)
		{
			return DatabaseObject_StaticUtility::getTagSummaryForObject($db, $user_id, 'blog_posts_tags','', 'blog_posts', 'all', 'post_id');
		}
		
		public static function getCatSummary($db, $user_id)
		{
			return DatabaseObject_StaticUtility::getTagSummaryForObject($db, $user_id, 'blog_posts_category','', 'blog_posts', 'all', 'post_id');
		
		}
		
		public static function getCatTagSummary($db, $user_id, $cat='')
		{
			return DatabaseObject_StaticUtility::getTagSummaryForObject($db, $user_id, 'blog_posts_tags', 'blog_posts_category', 'blog_posts', self::PRODUCT_STATUS_LIVE, 'post_id',$cat);
		
		}
		
		public static function getTagCatSummary($db, $user_id, $cat='')
		{
			return DatabaseObject_StaticUtility::getTagSummaryForObject($db, $user_id, 'blog_posts_category','blog_posts_tags', 'blog_posts', self::PRODUCT_STATUS_LIVE, 'post_id',$cat);
		
		}
		
//******************************************************Image Section
		public function setImageOrder($order)
		{	
						$this->getImages();

			DatabaseObject_StaticUtility::setImageOrder($this->_db, 'blog_posts_images', $order, $this->images);
		}
		
	}
?>