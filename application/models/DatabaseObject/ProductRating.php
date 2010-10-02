<?php
// this class handles all the images that are being added as a product attribute image. 
// such as a product may have an image associated attribute like color or fabric or heel or size. 


	class DatabaseObject_ProductRating extends DatabaseObject
	{
	
		
		public function __construct($db)
		{	
			parent::__construct($db, 'product_rating', 'product_rating_id');
			$this->add('product_type_table');
			$this->add('product_id');
			$this->add('5_star');
			$this->add('4_star');
			$this->add('3_star');
			$this->add('2_star');
			$this->add('1_star');
			$this->add('total_number_review');
			$this->add('average_rating');
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
		
		public function loadForPost(DatabaseObject $product){
			$select = $this->_db->select();
			$select->from($this->_table, '*')
					->where('product_type_table = ?', $product->product_type)
					->where('product_id = ?', $product_id->getId());
			echo $select.'<br />';
			return $this->_load($select);
		}
		
	}
?>