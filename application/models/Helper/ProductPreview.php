<?php

	class Application_Model_Helper_ProductPreview
	{
		
		public static function retrieveAllSingleTagForProduct($db, $tag, $seller_type, $options=array())
		{
			$select2=$db->select();
			if($seller_type=='storeSeller'){
				$select2->from('products', '*');
			}elseif($seller_type=='generalSeller'){
				$select2->from('user_products', '*');
			}
			
			foreach($options as $k=>$v){
			$select2->where("$k = ?", $v);
			}
			$select2->where('product_tag = ?', $tag);
			$select2->where("status = 'LIVE'");
			//echo "$select2";
			//load the products in those ids
			$product = $db->fetchAll($select2);
			
			//add images to product ids
			foreach($product as $k=>$v)
			{
				//retrieve images for product
				$select3 = $db->select();
				if($seller_type=='storeSeller'){
				$select3->from('products_images', '*');
				}elseif($seller_type=='generalSeller'){
				$select3->from('user_products_images', '*');

				}
				$select3->where('Product_id = ?', $v['products_id']);
				$images = $db->fetchAll($select3);
				$product[$k]['images']=$images;
				//retrieve profileInfo for product
				$select4 = $db->select();
				
				if($seller_type=='storeSeller'){
				$select4->from('products_profile','*');
				}elseif($seller_type=='generalSeller'){
				$select4->from('user_products_profile','*');
				}
				$select4->where('Product_id = ?', $v['products_id']);
				$profile = $db->fetchAll($select4);
				$product[$k]['profile']=$profile;
			}
			return $product;
			
			
		}
		
		public static function retrieveAllProductForTag($db, $tag, $seller_type, $options=array())
		{
			$select=$db->select();
			if($seller_type=='storeSeller'){
			$select->from('products_tags', 'Products_id');
			}elseif($seller_type=='generalSeller'){
			$select->from('user_products_tag', 'Products_id');
			}
			$select->where('tag = ?', $tag);
			//load the ids for tags.
			//echo $select;
			$id= $db->fetchAll($select);
			
			if(count($id)>0){
			foreach($id as $k=>$v){
				$idArray[] =$v;
			}
			
			$select2=$db->select();
			if($seller_type=='storeSeller'){
				$select2->from('products', '*');
			}elseif($seller_type=='generalSeller'){
				$select2->from('user_products', '*');
			}
			
			foreach($options as $k=>$v){
			$select2->where("$k = ?", $v);
			}
			
			$select2->where('products_id in (?)',$idArray);

			
			$select2->where("status = 'LIVE'");
			//echo "$select2";
			//load the products in those ids
			$product = $db->fetchAll($select2);
			
			//add images to product ids
			foreach($product as $k=>$v)
			{
				//retrieve images for product
				$select3 = $db->select();
				if($seller_type=='storeSeller'){
				$select3->from('products_images', '*');
				}elseif($seller_type=='generalSeller'){
				$select3->from('user_products_images', '*');

				}
				$select3->where('Product_id = ?', $v['products_id']);
				$images = $db->fetchAll($select3);
				$product[$k]['images']=$images;
				//retrieve profileInfo for product
				$select4 = $db->select();
				
				if($seller_type=='storeSeller'){
				$select4->from('products_profile','*');
				}elseif($seller_type=='generalSeller'){
				$select4->from('user_products_profile','*');
				}
				$select4->where('Product_id = ?', $v['products_id']);
				$profile = $db->fetchAll($select4);
				$product[$k]['profile']=$profile;
			}
			return $product;
			}else{
			}
		}
		
		public static function retriveProductAttributes($db, $tag, $product_tag_table, $product_table, $attribute){
			/*$select=$db->select();
			
			$select->from($product_tag_table, 'Products_id')
					->where('tag = ?', $tag);
			//load the ids for tags.
			$id= $db->fetchAll($select);
			
			if(count($id)>0){
				foreach($id as $k=>$v){
					$idArray[] =$v;
				}*/
				
				$select2=$db->select();
				$select2->from($product_table, "distinct($attribute)")
						->where('product_tag = ?',$tag)
					  ->order("$attribute ASC")
						->where("status = 'LIVE'");
				
				//echo '<br /><br /><br />'.$select2;

				$attributes = $db->fetchAll($select2);
				return $attributes;	
			//}
		}
		
		public static function retriveProductBasedOnAttribute($db, $product_table, $userID, $attributeArray=array())
		{
			$select=$db->select();
			$select->from($product_table, '*')
				->where('User_id = ?', $userID);
			foreach($attributeArray as $k=>$v){
				
				$select->where("$k = ?", $v);
			}
			//echo $select.'<br />';
			return $db->fetchAll($select);
		}
		
		
		public static function retrieveAllUserProductForTag($db, $tag, $options=array())
		{
			$select=$db->select();
			$select->from('user_products_tag', 'Products_id');
			$select->where('tag = ?', $tag);
			//load the ids for tags.
			$id= $db->fetchAll($select);
			
			
			foreach($id as $k=>$v){
				$idArray[] =$v;
			}
			
			$select2=$db->select();
			$select2->from('products', '*')
					->where('products_id in (?)',$idArray)
					->where("status = 'LIVE'");
			//load the products in those ids
			$product = $db->fetchAll($select2);
			
			//add images to product ids
			foreach($product as $k=>$v)
			{
				//retrieve images for product
				$select3 = $db->select();
				$select3->from('products_images', '*')
				->where('Product_id = ?', $v['products_id']);
				$images = $db->fetchAll($select3);
				$product[$k]['images']=$images;
				//retrieve profileInfo for product
				$select4 = $db->select();
				$select4->from('products_profile','*')
				->where('Product_id = ?', $v['products_id']);
				$profile = $db->fetchAll($select4);
				$product[$k]['profile']=$profile;
			}
			return $product;
		}
		
		
		//look for 'product id 5' under 'latin pants' in 'generalSeller' sections. 
		public static function retrieveUserEmailForProduct($db, $product_id){
			$select = $db->select();
			
			$select->from('products', 'uploader_email')
				->where('products_id = ?', $product_id);
			
			
			$userId = $db->fetchOne($select);

			return $userId;		
		}
		
	}


?>