<?php

	class DatabaseObject_Helper_ProductCategory extends DatabaseObject
	{
		
		
		public static function retrieveAllProductType($db, $options=array())
		{
			$select=$db->select();
			$select->from('product_types', '*');
			
			//echo $select;
			return $db->fetchAll($select);
		}
	}
?>