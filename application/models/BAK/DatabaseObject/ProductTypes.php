<?php
// this class handles all the images that are being added as a product attribute image. 
// such as a product may have an image associated attribute like color or fabric or heel or size. 


	class DatabaseObject_ProductTypes extends DatabaseObject
	{
	
		public $colorAttributes;
		public $sizeAttributes;
		
		public function __construct($db)
		{	
			parent::__construct($db, 'product_types', 'product_types_id');
			$this->add('product_types_name');
			
			//$this->colorAttributes= new Database
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
		
	}
?>