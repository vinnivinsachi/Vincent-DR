<?php

	class Application_Model_Helper_ProductListing
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
		
		public static function getMeasurementAttribute($db, $username, $product_type_table, $product_id, $options=array())
		{
			$select=$db->select();
			$select->from('measurement_attribute', $options['value'])
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
		
		public static function getSizeAttribute($db, $username, $product_type_table, $product_id, $options=array())
		{
			$select=$db->select();
			$select->from('size_attribute', $options['value'])
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
		
		public static function addTagToObject(DatabaseObject $product, $tag, $seller_type, $userID){
			
			  $data = array(
				  'product_id' => $product->getId(),
				  'tag'      => $tag,
				  'User_id' =>$userID
			  );			
		
			if($seller_type == 'storeSeller'){
			$product->_db->insert('products_tags', $data);
			}elseif($seller_type == 'generalSeller'){
			$product->_db->insert('user_products_tag', $data);
			}
		}
		
		public static function loadTagForObject(DatabaseObject $product, $seller_type){
			$select=$product->getDb()->select();
			if($seller_type =='storeSeller'){
					$select->from('products_tags', '*')
				->where('product_id = ?', $product->getId());
			
			}elseif($seller_type=='generalSeller'){
				$select->from('user_products_tag', '*')
				->where('product_id = ?', $product->getId());
			}
			return $product->getDb()->fetchAll($select);
		}
		
		public static function removeTagFromObject(DatabaseObject $product, $tagid, $seller_type, $userID){
			//echo 'tag id is: '.$tagid;
			//echo 'product type is: '.$product->product_type;
			echo 'tag id is: '.$tagid.'<br />';
			echo 'seller type is: '.$seller_type.'<br />';
			echo 'product id: '.$product->getId();'<br />';
			
			if($seller_type == 'storeSeller'){
				echo 'here';
			$product->_db->delete('products_tags', array("product_id = '".$product->getId()."'",
														 "tag_id = '".$tagid."'",
														 "User_id = '".$userID."'"
															 )); 
			}elseif($seller_type == 'generalSeller'){
				echo 'here2';
			$product->_db->delete('user_products_tag', array(
														 "product_id = '".$product->getId()."'",
														 "tag_id = '".$tagid."'",
														 "User_id = '".$userID."'"
															 )); 
			}
			//echo "here";
		}
		
		public static function markAsNew(DatabaseObject $product, $status, $seller_type){
			
				$id = $product->getId();
				$data = array('new' => $status);
		
				$product->_db->update($product->_table, $data, "$product->_idField = $id");

		}
		
		public static function retrieveAllProduct($db, $productTable, $userID, $options=array()){
			$select = $db->select();
			$select->from($productTable, '*')
			->where('uploader_id = ?', $userID);
			
			if($options['no_options']==false){
				foreach($options as $k=>$v){
					if($k!='no_options' && $k!='status'){
					$select->where("$k = ?", $v);
					}
				}
			}
			
			//this is a grounp of status that are joined by or
			//can use multiple or statments
			if(isset($options['status'])){
				$statusString='';
				foreach($options['status'] as $k=>$v){
					//echo 'here at key is: '.$k.' value is: '.$v.'<br/>';
					if($k==0){
						$statusString .="status = '$v'";
					}else{
						$statusString .=" or status = '$v'";
					}
				}
				$select->where($statusString);
			}
			
			$select->order(array('ts_created DESC'));
			echo $select.'<br/>';
			return $db->fetchAll($select);
		}
		
		public static function confirmproductforuploader($db, $productTable, $userID, $productID){
			
			$select = $db->select();
			$select->from($productTable, '*')
				->where('uploader_id=?', $userID)
				->where('product_id=?', $productID);
			//echo $select;
			return $db->fetchAll($select);
		}	
		
		//this can set the product status of any uploaded product to anything.
		public static function updateProductStatus($db, $productTable, $uploaderID, $productID, $status){
			$select = $db->select();
			$select->from($productTable,'*')
			->where('uploader_id=?', $uploaderID)
			->where('product_id=?', $productID);
			
			$product = $db->fetchAll($select);
			
			if(count($product)==1){
				$data = array(
   		 						'status'=> ''.$status.''
							);
			    $db->update($productTable, $data, "product_id = '".$productID."' and uploader_id='".$uploaderID."'");
			    return true;			
			}else{
				return false;
			}
		}
		
	}
?>