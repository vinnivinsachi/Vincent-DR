<?php

	class DatabaseObject_Invprofile extends DatabaseObject
	{

		public function __construct($db)
		{
			parent::__construct($db, 'invprofile', 'inv_id');
			
			$this->add('product_id');
			$this->add('size');
			$this->add('heel');
			$this->add('color');
			$this->add('leather');
			$this->add('width');
			$this->add('height');
			$this->add('waist'); 
			$this->add('hip');
			$this->add('length');
			$this->add('price');
			$this->add('comment');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->add('quantity');
			
		}
		
		
		protected function preSave()
		{
			//$this->ts_created = time();
			return true;
		}
		
		protected function preInsert()
		{
			return true;
			
		}
		
		protected function postDelete()
		{
			return true;
			
		}
		
		protected function postUpdate()
		{
		
			return true;
		}
		
		protected function preUpdate()
		{
		
			$this->ts_created = time();
			return true;
		
		}
		
		protected function preDelete()
		{
			return true;
		}
		
		
		public static function GetObjects($db, $options)
		{
			$defaults = array(
							  'order' => 'p.ts_created'
							  );
					
			foreach($defaults as $k=>$v)
			{
				$options[$k]=array_key_exists($k, $options)?$options[$k]:$v;
			}
			
			//product_id and order must be present;
			
			$select=$db->select();
		
			$select->from('invprofile','*')
				->where('product_id =?', $options['product_id'])
				->where('quantity > 0');
			
			$select->order($options['order']);
			
			//echo $select."<br/>";
			
			$data=$db->fetchAll($select);
			
			$invProfile = self::BuildMultiple($db,__CLASS__,$data); 
			
			
			
			return $invProfile;
		}
		
		public function loadItem($id)
		{
			$select = "select * from invprofile where inv_id = '".$id."'";
			$this->_load($select);
		}
		
			
		
		
	}
	
?>