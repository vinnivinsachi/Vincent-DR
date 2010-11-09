<?php

	class DatabaseObject_Helper_ManageAttribute extends DatabaseObject
	{
		
		
		public static function getImageAttribute($db, $username, $product_type_table, $product_id, $options=array())
		{
			$select=$db->select();
			$select->from('image_attribute', $options['value'])
				->where('username = ?',$username)
				->where('product_id = ?', $product_id)
				->where('product_type_table = ?', $product_type_table);
				
			if($options['group']==true)
			{
				$select->group('attribute_name');
			}
			//echo $select.'<br /><br />';
			return $db->fetchAll($select);
		}
		
		public static function confirmattributeidwithuploader($db, $table, $userID, $attributeID){
			$select = $db->select();
			$select->from($table, '*')
			->where('id=?',$attributeID)
			->where('uploader_id = ?', $userID);
			
			//echo $select;
			return $db->fetchAll($select);
		}
		
		public static function loadAttributeIdDetail($db, $table, $id){
			$select = $db->select();
			$select->from($table, '*')
			->where('id=?',$id);
			
			$attribute['basicInfo'] = $db->fetchAll($select);
			//Zend_Debug::dump($attribute['basicInfo']);
			$attribute['name'] = $attribute['basicInfo'][0]['name_of_set'];
			$attribute['id']=$attribute['basicInfo'][0]['id'];
			$attribute['uploader_id']=$attribute['basicInfo'][0]['uploader_id'];
			//pulling attributeDetails now
			$select2 = $db->select();
			$select2->from($table.'_details', '*')
			->where('set_id =?', $id);
			$attributeDetails = $db->fetchAll($select2);
			$attribute['details']=$attributeDetails;
			$attribute['attributeTable']=$table.'_details';
			$attribute['table']=$table;
			return $attribute;
		}
		
		public static function confirmattributenamewithuploader($db, $table, $userID, $attributeName){
			$select = $db->select();
			$select->from($table, '*')
			->where('name_of_set=?',$attributeName)
			->where('uploader_id=?',$userID);
			//echo $select;
			
			$item = $db->fetchAll($select);
			
			if (count($item)==1){
				return true;
			}else{
				return false;
			}
		}
		
		public static function confirmproductattribute($db, $table, $productID, $attributeID){
			$select = $db->select();
			$select->from('product_'.$table, '*')
			->where('product_'.$table.'_id = ?', $attributeID)
			->where('product_id = ?', $productID);
			
			//echo $select;
			$item = $db->fetchAll($select);
			
			if(count($item)==1){
				return true;
			}else{
				return false;
			}
		}
		
		
		public static function receiveAttributeSetFromId($db, $table, $set_id){
			$select = $db->select();
			$select->from($table, '*')
			->where('id=?',$set_id);
			//echo $select;
			return $db->fetchAll($select);
		}
		
		public static function retrieveAvailableAttributeForUser($db, $table, $uploader_id){
			
			$select = $db->select();
			$select->from($table, '*')
			->where('uploader_id=?',$uploader_id);
			//echo $select;
			$attributeSet= $db->fetchAll($select);
			foreach ($attributeSet as $k=>$v){
				$select2 = $db->select();
				$select2->from($table.'_details', '*')
				->where('set_id=?', $v['id']);
				//echo $select2.'<br/>';
				
				$attributeSet[$k]['details']= $db->fetchAll($select2);
			}
			return $attributeSet;
		}
		
		public static function addAttributeToProduct($db, $table, $product_id, $attribute_set_id){
			$productAttributeTable = 'product_'.$table;
			
			$data = array('product_id'=>$product_id, $table.'_id'=>$attribute_set_id);
					
			$db->insert($productAttributeTable, $data);
		}
		
		public static function retrieveAttributeForProduct($db, $table, $product_id){
			$productAttributeTable = 'product_'.$table;
			$select = $db->select();
			$select->from($productAttributeTable, '*')
			->where('product_id = ?', $product_id)
			->order($table.'_id');
						
			$records =$db->fetchAll($select);
			$id=array();
			$attributeArray=array();
			foreach($records as $k=>$v){				
				$attributeDetail = self::loadAttributeIdDetail($db, $table, $v[$table.'_id']);
				$attributeDetail['product_attribute_id']=$v['product_'.$table.'_id'];
				$attributeArray[]=$attributeDetail;
			}
			//return $id;
			return $attributeArray;
		}
		
		public static function removeAttributeForProduct($db, $table, $product_attribute_set_id){
			$where = array('product_'.$table.'_id = '.$product_attribute_set_id);
			
			//echo 'product_'.$table.'_id: '.$product_attribute_set_id;
			$db->delete('product_'.$table, $where);
		}
		
		public static function insertProductColors($db, $table, $productID, $colors)
		{
			$select =$db->select();
			$select->from($table, '*')
			->where('product_id =?', $productID);
			
			$product = $db->fetchAll($select);
			if(count($product)==1){
				//update colors
				$db->update($table ,$colors, "product_id = '".$productID."'");
			}elseif(count($product)==0){
				$colors['product_id']=$productID;
				$db->insert($table, $colors);
				//insert colors
			}else{
				return false;	
			}
		}
		public static function insertShoeHeelAttribute($db, $table, $productID, $heelAttributes){
			$select =$db->select();
			$select->from($table, '*')
			->where('product_id =?', $productID);
			
			$product = $db->fetchAll($select);
			if(count($product)==1){
				//update colors
				$db->update($table ,$heelAttributes, "product_id = '".$productID."'");
			}elseif(count($product)==0){
				$heelAttributes['product_id']=$productID;
				$db->insert($table, $heelAttributes);
				//insert colors
			}else{
				return false;	
			}
		}
		
		
		public static function insertShoeProductAttribute($db, $table, $productID, $shoeAttribute){
			$select =$db->select();
			$select->from($table, '*')
			->where('product_id =?', $productID);
			
			$product = $db->fetchAll($select);
			if(count($product)==1){
				//update colors
				$db->update($table ,$shoeAttribute, "product_id = '".$productID."'");
			}elseif(count($product)==0){
				$db->insert($table, $shoeAttribute);
				//insert colors
			}else{
				return false;	
			}
		}	
		
		public static function retrieveProductColorAndShoeAttribute($db, $inventoryAttributeType, $productID)
		{
			$select=$db->select();
			$select->from('product_colors','*')
			->where('product_id =?', $productID);
			$productAttributes['colors']=$db->fetchAll($select);
			if($inventoryAttributeType=='shoes'){
				$select2=$db->select();
				$select2->from('product_shoes_attributes','*')
				->where('product_id=?',$productID);
				$productAttributes['shoes']=$db->fetchAll($select2);
				$select3=$db->select();
				$select3->from('product_shoes_heel')
				->where('product_id=?', $productID);
				$productAttributes['heels']=$db->fetchAll($select3);
			}
			return $productAttributes;
		}
		
		public static function removeAttributeForUser($db, $attributeType, $attributeID, $username){
			$select = $db->select();
			$select->from($attributeType, '*')
			->where('id=?',$attributeID);
			$attributeSet = $db->fetchAll($select);
			Zend_Debug::dump($attributeSet);
			$select=$db->select();
			$select->from($attributeType.'_details','*')
			->where('set_id = ?', $attributeID);
			//echo $select;
			$attributeDetails=$db->fetchAll($select);
	
			
			//$attributeEverything = $db->fetchAll('$select');
			//Zend_Debug::dump($attributeEverything);
			//Zend_Debug::dump($attributeDetails);
			foreach($attributeDetails as $k=>$v){
				echo 'here at delete details';
				$detailsImage = new DatabaseObject_Attribute_CustomAttributeDetails($db, $attributeType.'_details');
				
				echo 'id is: '.$v['id'];
				//$detailsImage->load($v['id']);
				if($detailsImage->load($v['id'])){
					echo 'here at image delete';
					$detailsImage->setSaveFilePath($username, $attributeType.'_details', $attributeSet[0]['name_of_set']);
					$detailsImage->delete();
				}
			}
			
			$where = array($attributeType.'_id = '.$attributeID);
			//echo 'product_'.$table.'_id: '.$product_attribute_set_id;
			$db->delete('product_'.$attributeType, $where);
			$where2 = array('id = '.$attributeID);
			$db->delete($attributeType, $where2);
			
		}
	}
?>