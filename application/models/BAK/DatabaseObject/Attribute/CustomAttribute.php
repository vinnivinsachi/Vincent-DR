<?php
// this class handles all the images that are being added as a product attribute image. 
// such as a product may have an image associated attribute like color or fabric or heel or size. 


	class DatabaseObject_Attribute_CustomAttribute extends DatabaseObject
	{
	
		
		public function __construct($db, $table)
		{	
			parent::__construct($db, $table, 'id');
			$this->add('name_of_set');
			$this->add('uploader_id');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
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
		
		protected function verifyNameAvailability(){
	
		}
		
	}
?>