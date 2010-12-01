<?php

class Application_Model_Mapper_Products_ProductsMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Products_Products';
	protected $_modelClass = 'Application_Model_Products_Product';

		//product status include:
		//Unlisted, Listed, Deleted, Bought(Buy_now only), Flagged 
	
	
	public function save(Application_Model_Products_Product $product) {
		//pre save
		//public $inventoryReference;
		//public $uniqueIdentifierForJS; need to set unique id;
		echo 'presave';
		$product->productUniqueID =$this->createUniqueID();
		return parent::save($product);
		//echo 'postsave';
		//post save
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
			
			$select->join(array('c' => 'product_colors'),
                    	'p.productID = c.productID');
			$select->order('lastStatusChange DESC');
			$select->where("p.status='Listed'");
			
			
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
}
?>