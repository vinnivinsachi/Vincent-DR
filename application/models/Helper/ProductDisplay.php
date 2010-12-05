<?php

	class Application_Model_Helper_ProductDisplay 
	{
		
		
		public static function retriveAllTagsForProductType($db, $product_tag_table, $userID)
		{
			$select=$db->select();
			$select->from($product_tag_table, 'distinct(tag)')
					->where('uploader_id = ?', $userID);
			echo $select;
			return $db->fetchAll($select);
		}		
		
		public static function retrieveSingleTagForProduct($db, $product_table, $userID, $options=array()){
			$select=$db->select();
			$select->from($product_table, 'distinct(product_tag)')
				->where('uploader_id = ?', $userID)
				->order('product_tag');
			
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
			
				echo $select;
				return $db->fetchAll($select);
		}
		
		public static function retrieveBrandForProduct($db, $product_table, $userID, $product_tag=''){
			$select=$db->select();
			$select->from($product_table, 'distinct(brand)')
			->where('uploader_id =?',$userID)
			->order('brand');
			
			if($product_tag!=''&&$product_tag!='all'){
				$select->where('product_tag=?',$product_tag);
			}
			return $db->fetchAll($select);
		}
		
		public static function getBasicProductInfo($db, $productID){
			$select = $db->select();
			$select->from('products', '*')
			->where('product_id =?', $productID);
			
			return $db->fetchAll($select);
		}
		
	public static function retrieveProductsForDisplay($db, $options=array()){
			$select = $db->select();
			$select->from(array('p' => 'products'), '*');
			$inventory=false;
			foreach($options as $k=>$v){
				switch ($k){
					case 'tag':
						$select->where('p.productTag=?',$v);
						
						break;
					case 'purchaseType':
						if($v=='Customizable'){
						$select->where('p.purchaseType=?',$v);
						}elseif($v=='BUY_NOW'){
						$inventory=true;
						}
						break;
					case 'color':
						if($inventory){
							$colorString='';
							$count=1;
							foreach($v as $key=>$value){
								if($count==1){
									$colorString.="i.sys_color = '$key'";
								}else{
									$colorString.=" or i.sys_color = '$key'";
								}
								$count++;
							}
							$select->where($colorString);
						}else{
							if(in_array('multicolor', $v)){
								$colorString='';
								$count=1;
								foreach($v as $key=>$value){
									if($count==1){
										$colorString.="c.$key = 1";
									}else{
										$colorString.=" and c.$key = 1";
									}
									$count++;
								}
								$select->where($colorString);
							}else{
								$colorString='';
								$count=1;
								foreach($v as $key=>$value){
									if($count==1){
										$colorString.="c.$key = 1";
									}else{
										$colorString.=" or c.$key = 1";
									}
									$count++;
								}
								$select->where($colorString);
							}
						}
						break;
					case 'size':
						//Zend_Debug::dump($v);
						$inventory=true;
						foreach($v as $key=>$value){
							$sizeString='';
							$count=1;
							foreach($value as $KEY=>$VALUE){
								if($count==1){
									$sizeString.="i.sys_".$key."_size = '$VALUE'";
								}else{
									$sizeString.=" or i.sys_".$key."_size = '$VALUE'";
								}
								$count++;
								
							}
						}
						//echo $sizeString;
						$select->where($sizeString);
						break;
					case 'pricecat':
							$priceString='';
							$count=1;
							foreach($v as $key=>$value){
								if($count==1){
									$priceString.="p.productPriceRange = '$key'";
								}else{
									$priceString.=" or p.productPriceRange = '$key'";
								}
								$count++;
							}
							$select->where($priceString);							
						break;
					case 'size_system':
						$inventory=true;
						if($v!=''){
						$select->where('i.sys_shoe_metric = ? ', $v);
						}
						break; 
					case 'shoe_size':
						$inventory=true;
						$shoesizeString='';
						$firstCount=1;
						
						foreach($v as $KEY=>$VALUE){
							//echo 'here at KEY is: '.$KEY.'<br/>';
							if($firstCount==1){
							$shoesizeString.="(i.sys_metric_type = '$KEY' and (";
							}else{
							$shoesizeString.=" or (i.sys_metric_type = '$KEY' and (";	
							}
							$count=1;
							foreach($VALUE as $key=>$value){
								if($count==1){
									$shoesizeString.=" i.sys_shoe_size = '$value'";
								}else{
									$shoesizeString.=" or i.sys_shoe_size = '$value'";
								}
								$count++;
							}
							$shoesizeString.="))";
							$firstCount++;
						}
						$select->where($shoesizeString);	
						
						break;
					case 'heel':
						$heelString='';
						$count=1;
						$inventory=true;
						foreach($v as $key=>$value){
							if($count==1){
								$heelString.="i.sys_shoe_heel = '$value'";
							}else{
								$heelString.=" or i.sys_shoe_heel = '$value'";
							}
							$count++;
						}
						$select->where($heelString);	
						//$select->where('i.sys_shoe_heel=?',$v);
						break;
					case 'socialUsage':
						$select->where('p.socialUsage = on');
						break;
					case 'competitionUsage':
						$select->where('p.competitionUsage = on');
						break;
					case 'uploader_country':
						$select->where('p.uploaderCountry = ?',$v);
						break;
					case 'condition':
							$conditionString='';
							$count=1;
							$inventory=true;
							foreach($v as $key=>$value){
								if($count==1){
									$conditionString.="i.sys_conditions = '$key'";
								}else{
									$conditionString.=" or i.sys_conditions = '$key'";
								}
								$count++;
							}
							$select->where($conditionString);				
						
						break;
					case 'limit':
						$select->limitPage($v,100);
						break;
				}
				//echo $k;
			}
			if($inventory){
			$select->join(array('i' => 'productInventories'),
                    				'p.productID = i.productID');
			//$select->group('i.product_id');
			}
			
			$select->join(array('c' => 'productColors'),
                    	'p.productID = c.productID');
			$select->order('lastStatusChange DESC');
			$select->where("p.status='LISTED'");
			
			
			echo "<br/>$select<br/>";
			
			$products = $db->fetchAll($select);
			/*foreach($products as $k=>$value){
				if($value['purchaseType']=='BUY_NOW' && !$inventory){
					$tempProduct=DatabaseObject_Helper_ManageInventory::loadBasicInventory($db, $value['product_id']);
					foreach($tempProduct[0] as $KEY=>$VALUE){
						$products[$k][$KEY]=$VALUE;
					}
					$products[$k]['inventoryProfile']=DatabaseObject_Helper_ManageInventory::loadInventoryProfileDetail($db, 'productInventoryProfile', $products[$k]['productInventoryID']);
					$products[$k]['inventoryImages']=DatabaseObject_Helper_ImageUpload::loadImagesForItem($db, 'productInventoryImages', $products[$k]['productInventoryID']);	
				}
				$select2=$db->select();
				$select2->from(array('images'=>'productImages'),'*')
				->where('images.productID = ?', $value['productID']);
				//echo $select2;
				$products[$k]['images']=$db->fetchAll($select2);
				if($inventory){
					$products[$k]['inventoryProfile']=DatabaseObject_Helper_ManageInventory::loadInventoryProfileDetail($db, 'product_inventory_profile', $value['productInventoryID']);
					$products[$k]['inventoryImages']=DatabaseObject_Helper_ImageUpload::loadImagesForItem($db, 'productInventoryImages', $value['productInventoryID']);
				}
			}*/
			//$products=array();
			return $products;
		}
		
		public function retrieveCompareChartProductsForDisplay($db, $compareChart){
			$products=array();
			if(isset($compareChart['products']) && count($compareChart['products'])>0){
				$select = $db->select();
				$select->from(array('p' => 'products'), '*');
				
				$select->where('product_id IN (?)', $compareChart['products']);
				$select->order('last_status_change DESC');
				$select->where("p.status='Listed'");
				
				$select->join(array('u'=>'users'),
						'u.userID=p.uploader_id');
				$tempProduct=$db->fetchAll($select);
				foreach($tempProduct as $k=>$value){
					$products[]=$value;
				}
			}
			if(isset($compareChart['inventory']) && count($compareChart['inventory'])>0){
				$select2 = $db->select();
				$select2->from(array('p' => 'products'), '*')
					->join(array('i' => 'product_inventories'), 'p.product_id = i.product_id')
					->order('last_status_change DESC')
					->where('i.product_inventory_id in (?)', $compareChart['inventory'])
					->where("p.status='Listed'");
				$select2->join(array('u'=>'users'),
						'u.userID=p.uploader_id');
				$tempInventory=$db->fetchAll($select2);
				
				
				foreach($tempInventory as $k =>$value){
					$products[]=$value;
				}
			}
			
			foreach($products as $k=>$value){
				if($value['purchase_type']=='Buy_now' && isset($value['product_inventory_id'])){
					$tempProduct=DatabaseObject_Helper_ManageInventory::loadBasicInventory($db, $value['product_id']);
					foreach($tempProduct[0] as $KEY=>$VALUE){
						$products[$k][$KEY]=$VALUE;
					}
					$products[$k]['inventoryProfile']=DatabaseObject_Helper_ManageInventory::loadInventoryProfileDetail($db, 'product_inventory_profile', $value['product_inventory_id']);
					$products[$k]['inventoryImages']=DatabaseObject_Helper_ImageUpload::loadImagesForItem($db, 'product_inventory_images', $value['product_inventory_id']);	
				}
				$select2=$db->select();
				$select2->from(array('images'=>'product_images'),'*')
				->where('images.Product_id = ?', $value['product_id']);
				//echo $select2;
				$products[$k]['images']=$db->fetchAll($select2);
				if(isset($value['product_inventory_id']) && $value['purchase_type']=='Customizable'){
					$products[$k]['inventoryProfile']=DatabaseObject_Helper_ManageInventory::loadInventoryProfileDetail($db, 'product_inventory_profile', $value['product_inventory_id']);
					$products[$k]['inventoryImages']=DatabaseObject_Helper_ImageUpload::loadImagesForItem($db, 'product_inventory_images', $value['product_inventory_id']);
				}
			}
			
			return $products;
		}

		
		public function retrieveProductFromInventoryForPurchaseDetails($db, $inventoryID){
			
			$inventorySelect =$db->select();
			$inventorySelect->from(array('i'=>'product_inventories'), array('i.*', 'p.*'))
			->where('i.product_inventory_id = ?', $inventoryID)
			->join (array('p'=>'products'), 'i.product_id = p.product_id');
			
			$inventorySelect->join(array('u'=>'users'),
						'u.userID=p.uploader_id', array('u.first_name', 'u.last_name'));
			
			echo $inventorySelect;
			$product = $db->fetchAll($inventorySelect);
			if(count($product)=='1'){
			//Fetch description
			$productProfileQuery = $db->select();
			$productProfileQuery->from('product_profiles', '*')
						->where('Product_id = ?', $product[0]['product_id']);
			$product['profile']=$db->fetchAll($productProfileQuery);
			
			//Fetch product images
			$productImageQuery=$db->select();
				$productImageQuery->from(array('images'=>'product_images'),'*')
				->where('images.Product_id = ?', $product[0]['product_id']);
				//echo $select2;
			$product['images']=$db->fetchAll($productImageQuery);
			
			//Fetch inventory profile details
			$inventoryProfileQuery = $db->select();
			$inventoryProfileQuery->from('product_inventory_profile', '*')
			->where('product_inventory_profile_id =?', $inventoryID);
			$product['inventory']['profile']=$db->fetchAll($inventoryProfileQuery);
			
			}
			
			Zend_Debug::dump($product);
			return $product;
		}
		
		public function retrieveProductFromProductsForPurchaseDetails($db, $productID){
			
			//Fetch product
			$productProfileQuery = $db->select();
			$productProfileQuery->from(array('p'=>'products'), '*')
						->where('product_id = ?', $productID);
						
			$productProfileQuery->join(array('u'=>'users'),
					'u.userID=p.uploader_id', array('u.first_name', 'u.last_name'));
			
			$product=$db->fetchAll($productProfileQuery);
			if(count($product)=='1'){
			
			//Fetch description
			$productProfileQuery = $db->select();
			$productProfileQuery->from('product_profiles', '*')
						->where('Product_id = ?', $product[0]['product_id']);
		
			$product['profile']=$db->fetchAll($productProfileQuery);
			
			//Fetch product images
			$productImageQuery=$db->select();
				$productImageQuery->from(array('images'=>'product_images'),'*')
				->where('images.Product_id = ?', $product[0]['product_id']);
				//echo $select2;
			$product['images']=$db->fetchAll($productImageQuery);
			
			//Fetch general inventory information
			$inventorySelect =$db->select();
			$inventorySelect->from(array('i'=>'product_inventories'), '*')
			->where('i.product_id = ?', $productID);
			$product['inventory']=$db->fetchAll($inventorySelect);
			
			foreach($product['inventory'] as $k=>$v){
				//Fetch inventory profile details
				$inventoryProfileQuery = $db->select();
				$inventoryProfileQuery->from('product_inventory_profile', '*')
				->where('product_inventory_profile_id =?', $v['product_inventory_id']);
				$product['inventory'][$k]['profile']=$db->fetchAll($inventoryProfileQuery);
				$product['inventory'][$k]['images']=DatabaseObject_Helper_ImageUpload::loadImagesForItem($db, 'product_inventory_images', $v['product_inventory_id']);
			}
			
			$product['existingFabricSet'] = DatabaseObject_Helper_ManageAttribute::retrieveAttributeForProduct($db, 'fabric_set', $product[0]['product_id']);
				//Zend_Debug::dump($fp->existingFabricSet);
			$product['existingAttributeSet'] = DatabaseObject_Helper_ManageAttribute::retrieveAttributeForProduct($db, 'custom_attribute', $product[0]['product_id']);
			$product['systemColorAndShoesAttributes'] = DatabaseObject_Helper_ManageAttribute::retrieveProductColorAndShoeAttribute($db, $product[0]['inventory_attribute_table'], $product[0]['product_id']);
			}
			return $product;
		}
		
		public function retrieveBuyNowProductForPurchase($db, $inventoryID){
			//retrive product & seller reviews, public shout boxes,  
			$inventorySelect =$db->select();
			$inventorySelect->from(array('i'=>'product_inventories'), '*')
			->where('i.product_inventory_id = ?', $inventoryID)
			->join (array('p'=>'products'), 'i.product_id = p.product_id');
			
			//echo 'select is:'.$inventorySelect;
			$product = $db->fetchAll($inventorySelect);
			//Zend_Debug::dump($product);
			//Fetch description
			$productProfileQuery = $db->select();
			$productProfileQuery->from('product_profiles', '*')
						->where('Product_id = ?', $product[0]['product_id']);
			$product['profile']=$db->fetchAll($productProfileQuery);
			
			//Fetch product images
			$productImageQuery=$db->select();
				$productImageQuery->from(array('images'=>'product_images'),'*')
				->where('images.Product_id = ?', $product[0]['product_id']);
				//echo $select2;
			$product['images']=$db->fetchAll($productImageQuery);
			
			//Fetch inventory profile details
			$inventoryProfileQuery = $db->select();
			$inventoryProfileQuery->from('product_inventory_profile', '*')
			->where('product_inventory_id =?', $product[0]['product_id']);
			$product['inventory_profile']=$db->fetchAll($productProfileQuery);
			
			return $product;
		}
		
		public function retrieveCustomizeProductForPurchase($db, $inventoryID){
			
		}
	}
?>