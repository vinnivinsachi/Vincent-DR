<?php
	class DatabaseObject_IndividualDue extends DatabaseObject
	{
		protected $memberID;
		protected $clubID;
		
		protected $individual_dues_key;
		
		public $profile=null;
		public $images = array();
		
		const INDIVIDUAL_DUES_STATUS_PAID = 'paid';
		const INDIVIDUAL_DUES_STATUS_DRAFT = 'D';
		const INDIVIDUAL_DUES_STATUS_LIVE = 'L';
		
		const INDIVIDUAL_DUES_STATUS_UNPAID = 'unpaid';
		
		public function __construct($db)
		{
			parent::__construct($db, 'individual_dues', 'individual_dues_key');
		
			
			$this->add('member_id');
			$this->add('clubAdmin_id');
			$this->add('url');
			$this->add('status', self::INDIVIDUAL_DUES_STATUS_DRAFT);
			$this->add('payment_status', 'unpaid');
			$this->add('date_set', time(), self::TYPE_TIMESTAMP);
			
			//echo "individual_dues_key is: ".$this->individual_dues_key;
			
			$this->profile = new Profile_IndividualDue($db);
		}
		

		protected function postLoad()
		{
		
			$this->profile->setIndividualDueId($this->getId());
			$this->profile->load();
			
		}
		
		protected function postInsert()
		{
			$this->profile->setIndividualDueId($this->getId());
			$this->profile->save(false);
			
			//echo "<br/>at profile->save";
			return true;
		}
		
		protected function postUpdate()
		{
			$this->profile->save(false);
			return true;
		}
		
		protected function preDelete()
		{
			/*$this->getImages();
			foreach ($this->images as $image)
			{
				$image->delete(false);
			}
			*/
			$this->profile->delete();
			return true;
		}
		
		
		protected function preInsert()
		{
					
			$url = strtolower($this->profile->name);
			
				$filters = array(//replace & with 'and' for readability
				'/&+/' => 'and',
				//replace non-alphanumeric haracter with a hyphen
				'/[^a-z0-9]+/i'=>'-',
				//replace multiple hyphens iwth a single hyphen
				'/-+/' =>'-');
				
				//apply each replacement
				foreach($filters as $regex =>$replacement)
				{
					$url = preg_replace($regex, $replacement, $url);
				}
				//remove hyphens from the start and end of string
				$url = trim($url, '-');
				
				//restrict the lenght of th url
				$url = substr($url, 0, 30);
				
				//set a default value just in case
				if(strlen($url)==0)
				{
					$url = 'post';
				}
				//find similar URLS
				$query = sprintf("select url from %s where clubAdmin_id=%d and url like ?",
				$this->_table, $this->clubAdmin_id); 
				
				$query=$this->_db->quoteInto($query, $url.'%'); //these are zend function
			
				$result = $this->_db->fetchCol($query);//these are zend function
				
				//if no matching urls then return the current url
				if(count($result)==0 || !in_array($url, $result))
				{
					$this->url = $url;
					
					echo "here at this->url: ".$url;
					return true;
				}
				
				//generate a uniq url
				$i=2;
				do{
					$_url = $url.'-'.$i++;
				}while(in_array($_url,$result));			
			
			$this->url= $_url;
			return true;
		
		}
		
		
		
		public function isLive()
		{
			return $this->isSaved() && $this->status==self::INDIVIDUAL_DUES_STATUS_LIVE;
		}
	
		public function sendLive()
		{
			if($this->status != self::INDIVIDUAL_DUES_STATUS_LIVE)
			{
				$this->status = self::INDIVIDUAL_DUES_STATUS_LIVE;
				$this->date_set = time();
			}
		}
		
		public function sendBackToDraft()
		{
			$this->status = self::INDIVIDUAL_DUES_STATUS_DRAFT;
		}
		
		
		
		
		
		public function setIndividualDues($memberID, $clubID)
		{
			$this->member_id = $memberID;
			$this->clubAdmin_id = $clubID;
		}
		
		
		public function checkIndividualDues($memberID, $clubID, $individual_dues_key)
		{
			$select =$this->_db->select();
			
			$select->from('individual_dues', '*')
				   ->where('member_id = ?', $memberID)
				   ->where('clubAdmin_id =?', $clubID)
				   ->where('individual_dues_key', $individual_due_key);
				   
			$return = $this->_db->fetchAll($select);
			
			if(count($return) ==0)
			{
				return false;
			}
			elseif(count($return)>0)
			{
				return true;
			}
		
		}
		
		public function loadClubIndividualDues($db, $individual_dues_key)
		{
			$select =$db->select();
			
			$select->from('individual_dues', '*')
				   ->where('individual_dues_key = ?', $individual_dues_key);
			
			
			//echo "<br/>select: ".$select;
			return $this->_load($select);
		}
		
		public function loadMemberDueList($db, $memberID, $clubID)
		{
		
			$products_ids=array();
		
			$select = $db->select();
			
			$select->from('individual_dues', '*')
				   ->where('member_id = ?', $memberID)
				   ->where('status= ?', 'L')
				   ->where('clubAdmin_id =?', $clubID)
				   ->order('date_set desc'); 
				   
			$data=$db->fetchAll($select);
			
			
			if(count($data)>0)
			{
				$products = self::BuildMultiple($db,__CLASS__,$data); 
				
				$products_ids = array_keys($products);

				
				if(count($products_ids)==0)
				{
					return array();
				}
				
				
				$profiles =Profile::BuildMultiple($db, 'Profile_IndividualDue', array('individual_dues_key'=>$products_ids));
				
				foreach($products as $product_id =>$product)
				{
					//echo "product_id key is: ".$product_id;
					if(array_key_exists($product_id, $profiles) && $profiles[$product_id] instanceof Profile_IndividualDue)
					{
						$products[$product_id]->profile=$profiles[$product_id]; 
						//echo "<br/>here at exists";
					}
					else
					{
						$products[$product_id]->profile->setIndividualDueId($product_id);
						//echo "<br/>here at not exists";
					}
					
				}
			}
			
			else
			{
				$products= array();
			}
			
			return $products;
		
		
		}
		
		public function loadLiveObject($user_id, $url)
		{
			$query = DatabaseObject_StaticUtility::loadLiveObjects($this->_db, $user_id, $url, $this->_table, $this->getSelectFields(), self::INDIVIDUAL_DUES_STATUS_LIVE);
			
			return $this->_load($query);
		}
		
		public function loadMemberIndividualDues($individual_dues_key)
		{
			$select =$db->select();
			
			$select->from('individual_dues', '*')
				   ->where('individual_dues_key = ?', $individual_dues_key);
				   
			return $this->_load($select);
		}
		
		public function getTeaser($length)
		{
			echo "<br/>here at teaser";
			return DatabaseObject_StaticUtility::GetTeaser($this->profile->content, $length);
		}	
		
		/*public static function loadClubAffiliation($db, $clubID)
		{
			$select =$db->select();
			
			$select->from('affiliation', '*')
				   ->where('clubAdmin_id = ?', $clubID);
				   
			return $db->fetchAll($select);
		}*/
		

	}
?>