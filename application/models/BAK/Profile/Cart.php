<?php
	
	class Profile_Cart extends DatabaseObject
	{
		public $ProductAttribute=null;
		protected $shoppingCart;
		public function __construct($db)
		{
			parent::__construct($db, 'shopping_cart_profile', 'profile_id');
			$this->add('cart_id');
			$this->add('cart_key');
			$this->add('product_id');
			$this->add('product_name');
			$this->add('product_type');
			$this->add('attribute_type','none');
			$this->add('quantity');
			$this->add('unit_cost');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			
		//	$shoppingCart = new DatabaseObject_ShoppingCart($db);
			
		//	$this->shoppingCart = $shoppingCart->loadCartOnly();
			$this->ProductAttribute = new Profile_CartAttribute($db);
			
			
		}
		
		protected function postLoad()
		{
			//echo "here at cart_profile postload";
			$this->ProductAttribute->setPostId($this->getId());
			$this->ProductAttribute->load();
		}
		
		protected function postInsert()
		{
			$this->ProductAttribute->setPostId($this->getId());
			$this->ProductAttribute->save(false);
			return true;
		}
		
		protected function postUpdate()
		{
			$this->ProductAttribute->save(false);
			return true;
		}
		
		protected function preDelete()
		{
		
			echo "here at delete";
			$this->ProductAttribute->delete();
			return true;
		}
		
		/*protected function preInsert()
		{
			$this->url= DatabaseObject_StaticUtility::generateUniqueUrl($this->_db, $this->_table, $this->profile->name, $this->user_id);
			return true;
		
		}
		
		*/
		
		public function loadProifleByOrderID($ID)
		{
			$id = (int)$ID;
			
			if(strlen($ID)<=0)
			{
				echo "your ID is invalid";
				return false;
			}
			
			$query = sprintf('select %s from %s where cart_key = ?', join(', ', $this->getSelectFields()), $this->_table);
			$query = $this->_db->quoteInto($query, $ID);
			
			return $this->_db->fetchAll($query);
		}
		
		public function loadProduct($object, $profile_id, $cartKey, $object_type)
		{
			//echo "profile id is: ".$object->getId()."<br/>";
			//echo "cart key is: ".$cartKey."<br/>";
			$select = $this->_db->select();
						
			/*if($object_type =='individualDue')
			{
				$club_id = $object->clubAdmin_id;
			}
			else
			{
				$club_id = $object->user_id;
			}
			*/
			
			$select->from('shopping_cart_profile', '*')
				   ->where('cart_key =?', $cartKey)
				   ->where('profile_id=?', $profile_id)
				   // ->where('product_id =?', $object->getId())
				   ->where('product_type = ?', $object_type);
				   
			//echo "<br/> your select query is: ".$select;
			
			return $this->_load($select);		
		}
	
	
		public function loadPastDueProfile()
		{
		
			$select = $this->_db->select();
			$select->from('shopping_cart_profile', '*')
			->where('ts_created < ?', date('Y-m-d H:i:sO', time()-60))
			->order('ts_created'); 
			
			//echo $select;
			$data=$this->_db->fetchAll($select);
		
			$profiles = self::BuildMultiple($this->_db,__CLASS__,$data); 
			
			return $profiles;
		}
	
		
	}
?>