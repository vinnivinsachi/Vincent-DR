<?php

	class DatabaseObject_Helper_InventoryManager extends DatabaseObject
	{
		
		
		public static function retriveAllInventoryForSpecificProduct($db, $username, $type, $productId, $options=array())
		{
			$select=$db->select();
			$select->from('inventory_products', '*')
				->where('product_type_table = ?',$type)
				->where('username = ?', $username)
				->where('product_id= ?', $productId);
				
				if(isset($options['groupby']))
				{
					$select->group($options['groupby']);
				}
				echo $select.'<br />';
			
			$result = $db->fetchAll($select);
			
			foreach($result as $k =>$v)
			{
				$select2=$db->select();
				$select2->from('inventory_products_profile', '*')
						->where('inventory_products_id = ?', $result[$k]['inventory_products_id']);
				
				echo $select2.'<br />';
				$result[$k]['profileAttributes']=$db->fetchAll($select2);
				foreach($result[$k]['profileAttributes'] as $key=>$value)
				{
					//echo $result['profileAttributes'][$key]['profile_key'];
					if(strpos($result[$k]['profileAttributes'][$key]['profile_key'],'price_adjustment')!==false)
					{
						unset($result[$k]['profileAttributes'][$key]);
					}
				}
				//Zend_Debug::dump($result['profileAttributes']);

			}
			
			return $result;
		}
		
		public static function verifyInventoryItemForUser($db, $inventory_id, $uploader_id){
			$select= $db->select();
			$select->from('product_inventories','product_id')
			->where('product_inventory_id =?', $inventory_id)
			->where('uploader_id = ?', $uploader_id);
			
			if(count($db->fetchAll($select))==1){
				return true;
			}else{
				return false;
			}
			
		}
		
		
	}
?>