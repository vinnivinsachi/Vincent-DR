<?php

	class DatabaseObject_Helper_ShoppingcartManager extends DatabaseObject
	{
		public static function addInventoryProductToCart($db, $item, $params=array()){
			
		}
		
		public static function addCustomizeProductToCart($db, $item, $params=array()){
			
		}
		
		public static function setInventoryProductInfoForCart($item){
			$currentItem=array();
				//Zend_Debug::dump($item);
				$currentitem['current_shipping_rate']=0;
				$currentItem['product_id'] = $item[0]['product_id'];
				$currentItem['product_type']=$item[0]['product_type'];
				$currentItem['purchase_type']=$item[0]['purchase_type'];
				$currentItem['inventory_attribute_table']=$item[0]['inventory_attribute_table'];
				$currentItem['product_inventory_id']=$item[0]['product_inventory_id'];
				$currentItem['uploader_username']=$item[0]['uploader_username'];
				$currentItem['uploader_email']=$item[0]['uploader_email'];
				$currentItem['uploader_id']=$item[0]['uploader_id'];
				$currentItem['return_allowed']=$item[0]['return_allowed'];
				$currentItem['product_country_origin']=$item[0]['uploader_network'];
				$currentItem['product_name']=$item[0]['name'];
				//this must change
				$currentItem['product_price']=$item[0]['sys_price'];
				$currentItem['product_tag']=$item[0]['product_tag'];
				$currentItem['backorder_time']=$item[0]['backorder_time'];
				if(count($item['images'])>0){
				$currentItem['product_image_id']=$item['images'][0]['image_id'];
				}
				$currentItem['reward_points_awarded']=$item[0]['reward_point'];
				echo $item[0]['reward_point'];
				$currentItem['domestic_shipping_rate']=$item[0]['domestic_shipping_rate'];
				$currentItem['international_shipping_rate']=$item[0]['international_shipping_rate'];
				switch ($item[0]['inventory_attribute_table']){
					case 'shoes':
						$currentItem['attributes']['sys_shoe_size']=$item[0]['sys_shoe_size'];
						$currentItem['attributes']['sys_shoe_metric']=$item[0]['sys_shoe_metric'];
						$currentItem['attributes']['sys_shoe_heel']=$item[0]['sys_shoe_heel'];
						$currentItem['attributes']['sys_color']=$item[0]['sys_color'];
						$currentItem['attributes']['brand']=$item[0]['brand'];
						break;
					case 'fullbody':
						$currentItem['attributes']['sys_fullbody_size']=$item[0]['sys_fullbody_size'];
						$currentItem['attributes']['sys_color']=$item[0]['sys_color'];
						$currentItem['attributes']['brand']=$item[0]['brand'];
						break;
					case 'bottom':
						$currentItem['attributes']['sys_bottom_size']=$item[0]['sys_bottom_size'];
						$currentItem['attributes']['sys_color']=$item[0]['sys_color'];
						$currentItem['attributes']['brand']=$item[0]['brand'];
						break;
					case 'top':
						$currentItem['attributes']['sys_top_size']=$item[0]['sys_top_size'];
						$currentItem['attributes']['sys_color']=$item[0]['sys_color'];
						$currentItem['attributes']['brand']=$item[0]['brand'];
						break;
				}
				foreach ($item['inventory']['profile'] as $k=>$v){
					$currentItem['attributes'][$v['profile_key']]=$v['profile_value'];
				}
				return $currentItem;
		}
		
		public static function setCustomizeBasicProductInfoForCart($item){
			$currentItem=array();
				$currentitem['current_shipping_rate']=0;
				$currentItem['product_id'] = $item[0]['product_id'];
				$currentItem['product_type']=$item[0]['product_type'];
				$currentItem['purchase_type']=$item[0]['purchase_type'];
				$currentItem['uploader_username']=$item[0]['uploader_username'];
				$currentItem['uploader_email']=$item[0]['uploader_email'];
				$currentItem['uploader_id']=$item[0]['uploader_id'];
				$currentItem['product_name']=$item[0]['name'];
				$currentItem['return_allowed']=$item[0]['return_allowed'];
				$currentItem['product_country_origin']=$item[0]['uploader_network'];
				$currentItem['inventory_attribute_table']=$item[0]['inventory_attribute_table'];
				//this must change
				$currentItem['product_price']=$item[0]['price'];
				$currentItem['product_tag']=$item[0]['product_tag'];
				$currentItem['backorder_time']=$item[0]['backorder_time'];
				if(count($item['images'])>0){
				$currentItem['product_image_id']=$item['images'][0]['image_id'];
				}
				$currentItem['reward_points_awarded']=$item[0]['reward_point'];
				$currentItem['domestic_shipping_rate']=$item[0]['domestic_shipping_rate'];
				$currentItem['international_shipping_rate']=$item[0]['international_shipping_rate'];
				return $currentItem;
		}
	}
?>