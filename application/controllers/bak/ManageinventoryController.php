<?php
	/*Manage attribute controller 
	********/
	
	class ManageinventoryController extends CustomControllerAction
	{
		public function init()
		{
			parent::init();
			//require APPLICATION_PATH .'/../library/productConfig.php';
			$this->breadcrumbs->addStep('Manage product attributes', $this->getUrl(null, 'productlisting'));
		}
		
		public function preDispatch(){
			parent::preDispatch();
			//require APPLICATION_PATH .'/../library/productConfig.php';
			$this->request = $this->getRequest();
			//must have id and product type. otherwise redirect!XXXXXXXXXXXXXXXXXXXXXxx
		}
	
		public function indexAction()
		{
			
		}
		
		public function addinventoryAction(){
			//for uploading information into product_inventory add 'sys_' infront of all the variables uploaded 
			//
			$productID = $this->request->getParam('id');
			//$product = DatabaseObject_Helper_ProductDisplay::getBasicProductInfo($this->db, $productID);
			//Zend_Debug::dump($product);
			$allowedProduct=DatabaseObject_Helper_ProductListing::confirmproductforuploader($this->db, 'products', $this->signedInUserSessionInfoHolder->generalInfo->userID, $productID);
			
			//make sure that the product is not a Buy_now product
			if(count($allowedProduct)==1 && $allowedProduct[0]['purchase_type']=='Customizable'){
				$allowedProduct['existingFabricSet'] = DatabaseObject_Helper_ManageAttribute::retrieveAttributeForProduct($this->db, 'fabric_set', $productID);
					//Zend_Debug::dump($fp->existingFabricSet);
				$allowedProduct['existingAttributeSet'] = DatabaseObject_Helper_ManageAttribute::retrieveAttributeForProduct($this->db, 'custom_attribute', $productID);
					
				$allowedProduct['systemColorAndShoesAttributes'] = DatabaseObject_Helper_ManageAttribute::retrieveProductColorAndShoeAttribute($this->db, $allowedProduct[0]['inventory_attribute_table'], $productID);
				
				//check to see if searchable criteria color is available. If not, redirect.
				$hasColor=false;
				foreach($allowedProduct['systemColorAndShoesAttributes']['colors'][0] as $k=>$v){
					if($v =='1' && $k!='product_id'){
						$hasColor=true;
						break;
					}
				}
				if(!$hasColor){
					$this->messenger->addMessage('Please select at least one major color categories this product belongs to.');
					$this->_redirect('/manageattribute/editproductattribute?id='.$productID);
				}
				
				//if the item is shoes, then fill all the measurements. 
				if($allowedProduct[0]['inventory_attribute_table']=='shoes'){
					//if there are no shoe attributes, redirect
					if(count($allowedProduct['systemColorAndShoesAttributes']['shoes'])==0){
						$this->messenger->addMessage('You must specify shoes attributes first!');
						$this->_redirect('/manageattribute/editproductattribute?id='.$productID);
					}
					$measurement = array();
					$i=$allowedProduct['systemColorAndShoesAttributes']['shoes'][0]['min_size'];
					while($i<($allowedProduct['systemColorAndShoesAttributes']['shoes'][0]['max_size']+0.5)){
						$measurement[]=$i;
						$i=$i+0.5;
					}
					$this->view->measurements=$measurement;
					$heels=array();
					foreach($allowedProduct['systemColorAndShoesAttributes']['heels'][0] as $key=>$value){
						if($key!='product_id'){
							if($value==1){
								$heels[]=$this->productConfig['attribute_conversion_details']['heel_sizes'][$key];
							}
						}
					}
					Zend_Debug::dump($this->productConfig['attribute_conversion_details']['heel_sizes']);
					$this->view->heels=$heels;
					
				}elseif($allowedProduct[0]['inventory_attribute_table']!='jewelry' && $allowedProduct[0]['inventory_attribute_table']!='accessories'){
					echo 'here at dancewear';
					$inventoryDancewearAttribute=array();
					foreach($this->productConfig['attribute_categories_details'][$allowedProduct[0]['inventory_attribute_table']] as $k=>$v){
						$inventoryDancewearAttribute[$k]=array();
						$inventoryDancewearAttribute[$k][]='Flexible';
						$temp=$v['min'];
						while($temp<$v['max']){
							$inventoryDancewearAttribute[$k][]=$temp;
							$temp+=$v['interval'];
						}
					}
					$this->view->measurements=$inventoryDancewearAttribute;
					Zend_Debug::dump($inventoryDancewearAttribute);
				}
				//inventory_attribute_table is the defualt system attribute system. 
				$this->view->attributePartial='_'.$allowedProduct[0]['inventory_attribute_table'].'Attribute.tpl';
				
				$this->view->product = $allowedProduct;
				Zend_Debug::dump($allowedProduct); 
				
				$fp = new FormProcessor_Inventory_AddInventory($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID);
				if($this->request->isPost()){
					if($fp->process($this->request)){
						
						//process images
						echo 'post is: '.Zend_Debug::dump($this->request->getParams());
						
						DatabaseObject_Helper_ImageUpload::uploadImage($_FILES['generalImages'], $this->db,'product_inventory_images','inventory', $fp->inventoryProduct->getId(),$fp->sys_name);
						$this->messenger->addMessage('Inventory product has been added');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}
					//echo 'here at post<br />';	
				}
				$inventories= DatabaseObject_Helper_ManageInventory::retrieveInventoryForProduct($this->db, 'product_inventories', $productID);
				
				if(count($inventories)!=0){
					$tmpInventoryKey=array();
					foreach($inventories as $k=>$v){
						$tmpInventoryKey[]=$v['basic']['product_inventory_id'];
					}
					
					Zend_Debug::dump($tmpInventoryKey);
					$completeInventoryProfile = DatabaseObject_Helper_ManageInventory::retrieveUniqueProfileKeys($this->db, 'product_inventory_profile', $tmpInventoryKey);
					Zend_Debug::dump($completeInventoryProfile);
					$this->view->mostInventoryProfile=$completeInventoryProfile;
				}else{
					$this->view->mostInventoryProfile=array();
				}
				
				//Zend_Debug::dump($inventories[$k]['profile']);
				$this->view->inventories = $inventories;
				$this->view->inventoryPartial='_'.$allowedProduct[0]['inventory_attribute_table'].'Inventory.tpl';
				$this->view->inventoryPartialTitle='_'.$allowedProduct[0]['inventory_attribute_table'].'InventoryTitle.tpl';
				$this->view->addPartial='_add'.$allowedProduct[0]['purchase_type'].'Inventory.tpl';
				echo 'add partial is: '.'_add'.$allowedProduct[0]['purchase_type'].'Inventory.tpl';
				Zend_Debug::dump($inventories);
				//$this->sendJson($json);
				//Zend_Debug::dump($json);
				//Zend_Debug::dump($this->request->getParams());
			}else{
				$this->messenger->addMessage('sorry, an error has occured. You may not add an inventory product at this moment');
				$this->_redirect('/index/error');
			}
		}
		
		/*public function addbuynowinventoryAction(){
			$productID = $this->request->getParam('id');
			
			
			//$product = DatabaseObject_Helper_ProductDisplay::getBasicProductInfo($this->db, $productID);
			//Zend_Debug::dump($product);
			$allowedProduct=DatabaseObject_Helper_ProductListing::confirmproductforuploader($this->db, 'products', $this->signedInUserSessionInfoHolder->generalInfo->userID, $productID);
			
			if(count($allowedProduct)==1 && $allowedProduct[0]['purchase_type']=='Buy_now'){
				$allowedProduct['existingFabricSet'] = DatabaseObject_Helper_ManageAttribute::retrieveAttributeForProduct($this->db, 'fabric_set', $productID);
					//Zend_Debug::dump($fp->existingFabricSet);
				$allowedProduct['existingAttributeSet'] = DatabaseObject_Helper_ManageAttribute::retrieveAttributeForProduct($this->db, 'custom_attribute', $productID);
					
				$allowedProduct['systemColorAndShoesAttributes'] = DatabaseObject_Helper_ManageAttribute::retrieveProductColorAndShoeAttribute($this->db, $allowedProduct[0]['inventory_attribute_table'], $productID);
				
				if($allowedProduct[0]['inventory_attribute_table']=='shoes'){
					
					$measurement=array();
					$i=0;
					while($i<50){
						$measurement[]=$i;
						$i=$i+0.5;
					}
					$this->view->measurements=$measurement;
					
				}elseif($allowedProduct[0]['inventory_attribute_table']!='jewelry' && $allowedProduct[0]['inventory_attribute_table']!='accessories'){
					echo 'here at dancewear';
					$inventoryDancewearAttribute=array();
					foreach($this->productConfig['attribute_categories_details'][$allowedProduct[0]['inventory_attribute_table']] as $k=>$v){
						$inventoryDancewearAttribute[$k]=array();
						$temp=$v['min'];
						while($temp<$v['max']){
							$inventoryDancewearAttribute[$k][]=$temp;
							$temp+=$v['interval'];
						}
					}
					$this->view->measurements=$inventoryDancewearAttribute;
					Zend_Debug::dump($inventoryDancewearAttribute);
				}
				//inventory_attribute_table is the defualt system attribute system. 
				$this->view->attributePartial='_'.$allowedProduct[0]['inventory_attribute_table'].'Attribute.tpl';
				$this->view->product = $allowedProduct;
				Zend_Debug::dump($allowedProduct); 
				
				$fp = new FormProcessor_Inventory_AddInventory($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID);
				//actually processing the inventory
				$inventories= DatabaseObject_Helper_ManageInventory::retrieveInventoryForProduct($this->db, 'product_inventories', $productID);
				
				if(count($inventories)!=0){
					$tmpInventoryKey=array();
					foreach($inventories as $k=>$v){
						$tmpInventoryKey[]=$v['basic']['product_inventory_id'];
					}
					
					Zend_Debug::dump($tmpInventoryKey);
					$completeInventoryProfile = DatabaseObject_Helper_ManageInventory::retrieveUniqueProfileKeys($this->db, 'product_inventory_profile', $tmpInventoryKey);
					Zend_Debug::dump($completeInventoryProfile);
					$this->view->mostInventoryProfile=$completeInventoryProfile;
				}else{
					$this->view->mostInventoryProfile=array();
				}
				
				if(count($inventories)>1){
					echo 'you can not add more than one product';
					//$this->messenger->addMessage('You can not add more than one listing item');
					//$this->_redirect('/index/error');
				}else{
					if($this->request->isPost()){
						if($fp->process($this->request)){
							
							//process images
						echo 'post is: '.Zend_Debug::dump($this->request->getParams());
							//Adding color to this product for front end search.
							$colors=array();
							$colors[''.$this->request->getParam('sys_color').'']=1;
							//insert color into digital sheep.
							DatabaseObject_Helper_ManageAttribute::insertProductColors($this->db, 'product_colors', $productID, $colors);
							//upload image of inventory.
							DatabaseObject_Helper_ImageUpload::uploadImage($_FILES['generalImages'], $this->db,'product_inventory_images','inventory', $fp->inventoryProduct->getId(),$fp->sys_name);
							//update digital sheep status.
							if(DatabaseObject_Helper_ProductListing::updateProductStatus($this->db, 'products',$this->signedInUserSessionInfoHolder->generalInfo->userID, $productID, 'Listed')){
							$this->messenger->addMessage('A new product has been listed');
							$this->_redirect('/productlisting/viewpendingproduct');
							}else{
								//fatal error. 
								//need to log!
							}
						}
						//echo 'here at post<br />';	
					}
				}
				
				
				//Zend_Debug::dump($inventories[$k]['profile']);
				$this->view->inventories = $inventories;
				$this->view->inventoryPartial='_'.$allowedProduct[0]['inventory_attribute_table'].'Inventory.tpl';
				$this->view->inventoryPartialTitle='_'.$allowedProduct[0]['inventory_attribute_table'].'InventoryTitle.tpl';
				$this->view->addPartial='_add'.$allowedProduct[0]['purchase_type'].'Inventory.tpl';
				echo 'add partial is: '.'_add'.$allowedProduct[0]['purchase_type'].'Inventory.tpl';
				Zend_Debug::dump($inventories);
				//$this->sendJson($json);
				//Zend_Debug::dump($json);
				//Zend_Debug::dump($this->request->getParams());
			}else{
				$this->messenger->addMessage('sorry, an error has occured. You may not add an inventory product at this moment');
				$this->_redirect('/index/error');
			}
		}
		*/
		public function deleteinventoryAction(){
			$inventoryId=$this->request->getParam('id');
			$inventoryProduct = new DatabaseObject_Inventory_Product($this->db);
			//check inventory_purchase_type
			
			$inventoryProduct->load($inventoryId);
			
			$product = DatabaseObject_Helper_ProductDisplay::getBasicProductInfo($this->db, $inventoryProduct->product_id);
			if($inventoryProduct->delete()){
				if($product[0]['purchase_type']=='Buy_now'){
					if(DatabaseObject_Helper_ProductListing::updateProductStatus($this->db, 'products',$this->signedInUserSessionInfoHolder->generalInfo->userID, $product[0]['product_id'], 'Removed')){
						$this->messenger->addMessage('This item had been removed.');
						$this->_redirect('/productlisting/viewpendingproduct');
					}else{
						$this->messenger->addMessage('Error at delete inventory');
						$this->_redirect('/index/error');
					}
				}elseif($product[0]['purchase_type']=='Customizable'){
					$this->messenger->addMessage('This item had been deleted.');
					$this->_redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}
		
		public function updateinventoryquantityAction(){
			$inventory = $this->request->getParam('quantity');
			
			foreach($inventory as $key=>$value){
				DatabaseObject_Helper_ManageInventory::updateInventoryQuantity($this->db,'product_inventories',$key, $this->signedInUserSessionInfoHolder->generalInfo->userID, $value);
			}
			$this->messenger->addMessage('Inventory quantities had been updated');
			$this->_redirect($_SERVER['HTTP_REFERER']);
			//Zend_Debug::dump($inventory);
		}
		
		public function manageinventoryforproductAction(){
		}
		
		public function imageAction(){
			if($this->request->getParam('delete')){
				$image_id = (int) $this->request->getParam('image');
				$inventory_id = (int) $this->request->getParam('id');
				//$attribute_name = $this->request->getParam('attribute_name');
				if(DatabaseObject_Helper_ImageUpload::removeProductAndInventoryImage($this->db, 'product_inventories', 'product_inventory_images', 'inventory', $image_id, $inventory_id, $this->signedInUserSessionInfoHolder->generalInfo->userID)){
					$this->messenger->addMessage('image successfully deleted');
					$this->_redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}
	}
?>