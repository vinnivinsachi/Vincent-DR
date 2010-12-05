<?php

	class DatabaseObject_Helper_ManageInventory extends DatabaseObject
	{
		public static function retrieveInventoryForProduct($db, $table, $product_id){
			$select = $db->select();
			$select->from($table, '*')
			->where('product_id = ?', $product_id);
			
			$records =$db->fetchAll($select);
			$id=array();
			$inventoryArray=array();
			foreach($records as $k=>$v){
				$inventoryDetail['basic']=$v;				
				$inventoryDetail['profile'] = self::loadInventoryProfileDetail($db, 'product_inventory_profile', $v['product_inventory_id']);
				$inventoryDetail['profileCount']=count($inventoryDetail['profile']);
				$inventoryDetail['images']=DatabaseObject_Helper_ImageUpload::loadImagesForItem($db, 'product_inventory_images', $v['product_inventory_id']);
				$inventoryArray[]=$inventoryDetail;
			}
			//return $id;
			return $inventoryArray;
		}
		
		
		public static function loadInventoryProfileDetail($db, $table, $inventoryID){
			$select = $db->select();
			$select->from($table, '*')
			->where($table.'_id=?', $inventoryID);
			return $db->fetchAll($select);
		}
		
		
		public static function updateInventoryQuantity($db, $table, $inventoryID, $uploaderID, $quantity){
			$data = array(
   		 						'sys_quantity'      => $quantity
							);
				return $db->update($table, $data, "product_inventory_id = '".$inventoryID."' and uploader_id='".$uploaderID."'");
		}
		
		public static function retrieveUniqueProfileKeys($db, $table, $ids=array()){
			$select = $db->select()
			->distinct()
			->from($table, 'profile_key')
			->where('product_inventory_profile_id in (?)', $ids);
			
			echo $select;
			return $db->fetchAll($select);
		}
		
		public static function hasInventory($db, $productID){
			$select = $db->select();
			$select->from('product_inventories','*')
			->where('product_id=?',$productID);
			
			if(count($db->fetchAll($select))==0){
				return false;
			}else{
				return true;		
			}
		}
		
		public static function loadBasicInventory($db, $productID){
			$select = $db->select();
			$select->from('product_inventories','*')
			->where('product_id=?',$productID);
			
			return $db->fetchAll($select);
		}
	}
?>