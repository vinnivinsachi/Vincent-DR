<?php

	class DatabaseObject_Helper_SizeFinder extends DatabaseObject
	{
		
		
		public static function findSizeByAttribute($db, $options=array())
		{
			$select=$db->select();
			$select->from(array('t'=>'orders_profile'),'*');
			if(isset($options['productTag'])){
				$select->where('product_tag = ?', $options['productTag']);
			}
			if(isset($options['productShoeSizes'])){
				
				$select->joinInner(array('o'=>'orders_profile_attribute'), 'o.order_profile_attribute_id = t.order_profile_id');
				$select->where("o.profile_key = 'size'");
			}
			
			echo $select;
			//return $db->fetchAll($select);
		}	
	}
?>