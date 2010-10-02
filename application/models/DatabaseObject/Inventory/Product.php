<?php
// this class handles all the invenory that are being added with an inventory image and video. 
// this product has very flexible profile attributes

	class DatabaseObject_Inventory_Product extends DatabaseObject
	{
		protected $_uploadedFile;
		protected $table;
		public $profile;
		public $attributeSet = false;
		public $images=array();
		
		public function __construct($db)
		{	
			parent::__construct($db, 'product_inventories', 'product_inventory_id');
			$this->add('product_id');
			$this->add('uploader_id');
			$this->add('sys_name');
			$this->add('sys_color');
			$this->add('sys_shoe_metric');
			$this->add('sys_shoe_size');
			$this->add('sys_shoe_heel');
			$this->add('sys_fullbody_size');
			$this->add('sys_top_size');
			$this->add('sys_bottom_size');
			$this->add('sys_price');
			$this->add('sys_video');
			$this->add('sys_quantity',1);
			$this->add('sys_description');
			$this->add('sys_conditions');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->profile = new Profile_InventoryProducts($db);
		}
		
		protected function postLoad(){
			//$this->getImages();
			$this->profile->setProductId($this->getId());
			$this->profile->load();
			$this->images = $this->getImages();
		}

		public function preInsert()
		{
			return true;
		}
		
		public function postInsert()
		{
			$this->profile->setProductId($this->getId());
			$this->profile->save(false);
			return true;
		}
		
		protected function postUpdate(){
			return true;
		}
		
		public function preDelete()
		{
			$product = DatabaseObject_Helper_ProductDisplay::getBasicProductInfo($this->_db, $this->product_id);
			if($product[0]['purchase_type']=='Buy_now'){
				//remove color from product_colors;
				echo 'here at color removal';
				$colors=array();
				$colors[''.$this->sys_color.'']=0;
				DatabaseObject_Helper_ManageAttribute::insertProductColors($this->_db, 'product_colors', $this->product_id, $colors);
			}
			
			$this->getImages();
			foreach ($this->images as $image){
				$image->delete(false);
			}
			
			$this->profile->delete();
			return true;
		}
		
		public function loadForPost($User_id, $inventory_id){
			$select = $this->_db->select();
			$select->from($this->_table, '*')
					->where('User_id = ?', $User_id)
					->where('product_inventory_id = ?', $inventory_id);
			echo $select.'<br />';
			return $this->_load($select);
		}
		
		public function getImages(){	
			$options=array('Product_id' =>$this->getId()); //loading images
			$this->images = DatabaseObject_Image::GetImages($this->getDb(), $options, 'Product_id', 'product_inventory_images', 'inventory');
		}
	}
?>