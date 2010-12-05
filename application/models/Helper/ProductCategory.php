<?php

	class Application_Model_Helper_ProductCategory
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