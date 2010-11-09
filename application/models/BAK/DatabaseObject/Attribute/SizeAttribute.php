<?php
// this class handles all the images that are being added as a product attribute image. 
// such as a product may have an image associated attribute like color or fabric or heel or size. 


	class DatabaseObject_Attribute_SizeAttribute extends DatabaseObject
	{
	
		
		public function __construct($db)
		{	
			parent::__construct($db, 'size_attribute', 'size_attribute_id');
			$this->add('attribute_name');
			$this->add('username');
			$this->add('product_type_table');
			$this->add('product_id');
			$this->add('size_name');
			$this->add('price_adjustment');
		}

		protected function postLoad()
		{

		}
		
		protected function postInsert()
		{
			return true;
		}
		
		protected function postUpdate()
		{
			return true;
		}
		
		protected function preDelete()
		{
		
			return true;
		}
		
		protected function preInsert()
		{
			return true;
		}
		
		public function loadForPost($id, $username, $product_type, $product_id){
			$select = $this->_db->select();
			$select->from($this->_table, '*')
					->where('product_type_table = ?', $product_type)
					->where('product_id = ?', $product_id)
					->where('username = ?', $username)
					->where('size_attribute_id = ?', $id);
			
			echo $select.'<br />';
			return $this->_load($select);
		}
		
	}
?>