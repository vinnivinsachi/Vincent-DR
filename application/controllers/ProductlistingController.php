<?php
	/*productlist handles only one product at a time and that is the product currently being created for listing or edited for relisting.
	*uses Formgenerator to generate the right form for different product_type
	*uses ObjectGenerator to generate the right object for the listing 
	*uses product delegation function getProductForUser(userid, product_id);
	*uses product delegation function generateGSDetailsSession()
	********/
	
	class ProductlistingController extends CustomControllerAction
	{
		public $product;
		public $productListing;
		public $request;
		public $product_purchase_type;
		public $product_category;
		public $product_type;
		public $product_tag;
		
		public function init()
		{
			parent::init();
			//require APPLICATION_PATH .'/../library/productConfig.php';
			$this->breadcrumbs->addStep('DancewearRialto partner product listing', $this->getUrl(null, 'productlisting'));
			//$this->request=new stdClass();
			//$_SESSION['categoryType'] = 'product';
			$this->gsNewProductListTrue = new Zend_Session_Namespace('gsNewProductListTrue');
			$this->gsExistingProductListInfo = new Zend_Session_Namespace('gsExistingProductListInfo');
			//echo $productConfig['purchase_type'][0];
			
		}
		
		public function preDispatch(){
			parent::preDispatch();
			//require APPLICATION_PATH .'/../library/productConfig.php';
			$this->request = $this->getRequest();
			//must have id and product type. otherwise redirect!XXXXXXXXXXXXXXXXXXXXXxx
			$this->product_id = $this->request->getParam('id');
			$this->product_purchase_type = $this->request->getParam('purchase_type');
			//$this->product_type = $this->request->getParam('product');
			//$this->product_tag = $this->request->getParam('tag');
			//check to see if there is a product id
			
			
			//echo 'here at predispatch';
			//echo 'echoing stuff'.$this->product_purchase_type.' '.$PRODUCT_CONFIG['purchase_type'];
			
			/*if($this->product_purchase_type =='' || !in_array($this->product_purchase_type, $this->productConfig['purchase_type'])){
				if($this->product_purchase_type =='customize' && $this->signedInUserSessionInfoHolder->generalInfo->user_type!='admin'){
					$this->messenger->addMessage('you are not allowed to upload customized products');
					$this->_redirect('index/error');
				}
				$this->messenger->addMessage('bad purchase type');
				//echo $this->product_purchase_type.'<br/>';
			
				$this->_redirect('index/error');
			}else{
				echo 'working!';
				$this->view->product_purchase_type = $this->product_purchase_type;
			}*/
			
			
			
			/*if($this->product_type!='' && !in_array($this->product_type, $this->availableProduct)){
				$this->messenger->addMessage('bad product type: '.$this->product_type);
				$this->_redirect('index/error');
			}
			if(!isset($this->product_id)||!is_numeric($this->product_id)){
				echo 'here at unset existing<br />';
				unset($this->gsExistingProductListTrue);
				$this->gsNewProductList=true;
			//check to see if there is a product_type
			}elseif(in_array($this->product_type, $this->availableProduct) && in_array($this->product_tag, $this->availableProductTags)){
				echo 'here at in array product type<br />';
				//if(isset($this->gsExistingProductListTrue)&&$this->gsExistingProductListTrue='true'){
				echo 'here at existing product listing true<br />';
				//check to see if that product is already loaded from database, if it is, load the product anyway.
				if(isset($this->gsExistingProductListInfo->products_info[$this->product_type][$this->product_id]->valid)){
					if($this->gsExistingProductListInfo->products_info[$this->product_type][$this->product_id]->valid){
						echo 'here at unsetting new product listing true<br />';
						$this->tempProduct = new DatabaseObject_Products($this->db);
						//$this->tempProduct = ObjectGenerator::generateProductForListing($this->db, $this->product_type);
						$this->tempProduct->getProductForUser($this->signedInUserSessionInfoHolder->generalInfo->userID, $this->product_id, $this->product_type);
						//this is to make sure that the product's username can be pulled for image attribute storage purposes
						$this->tempProduct->setUsernameForProduct($this->signedInUserSessionInfoHolder->generalInfo->username);
						unset($this->gsNewProductListTrue);
					}else{
						$this->_redirect('productlisting/productlistingerror');

					}
				}
				//if not loaded, load and then store to gxExisitngProductListInfo session
				else{
					echo 'here at load and settin existing product info session<br />';
					//load product and insert into the session
					//All products must have getProductForUser()
					$this->tempProduct = new DatabaseObject_Products($this->db);
					if($this->tempProduct->getProductForUser($this->signedInUserSessionInfoHolder->generalInfo->userID, $this->product_id, $this->product_type)){
						$this->tempProduct->setUsernameForProduct($this->signedInUserSessionInfoHolder->generalInfo->username);
						echo'product loaded for user<br />';
						$this->gsExistingProductListInfo->products_info[$this->product_type][$this->product_id]->valid=true;				
						$this->gsExistingProductListInfo->products_info[$this->product_type][$this->product_id]->details=$this->tempProduct->generateGSDetailsSession();
						//Zend_Debug::dump($this->gsExistingProductListInfo->products_info);
						//echo 'here is the -----this->gsExistingProductListInfo->products_info-------<br />'.Zend_Debug::dump($this->gsExistingProductListInfo->products_info);
						
					}else{
						echo 'failed to load product<br />';
						$this->gsExistingProductListInfo->products_info[$this->product_type][$this->product_id]->valid=false;
						$this->_redirect('productlisting/productlistingerror');

}
				}
			}else{
				echo 'error url<br />';
				$this->_redirect('productlisting/productlistingerror');

			}
			$this->productListing = new Zend_Session_Namespace('productListing');
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;*/
		}
	
		public function indexAction()
		{
			/*$this->product_category = $this->request->getParam('category');
			$currentProductSelectionPage = 'selectcategory';
			if($this->product_category=='' || !in_array($this->product_category, $this->productConfig['product_categories'])){
				//$this->messenger->addMessage('please select a main category of products to upload');
				$this->_forward($currentProductSelectionPage);
			}else{
				
				$this->view->product_category = $this->product_category;
				if($this->product_category=='women'){
					$currentProductSelectionPage='selectwomenproducttype';
					$this->_forward('selectwomenproducttype');
				}elseif($this->product_category=='men'){
					$currentProductSelectionPage='selectmenproducttype';
					$this->_forward('selectmenproducttype');
				}elseif($this->product_category=='jewelry'){
					$currentProductSelectionPage='selectjewelrytype';
					$this->_forward('selectjewelrytype');
				}elseif($this->product_category=='accessories'){
					$currentProductSelectionPage='selectaccessoriestype';
					$this->_forward('selectaccessoriestype');
				}
			}
			
			$this->product_type = $this->request->getParam('type');
			
			if($this->product_type=='' || !in_array($this->product_type, $this->productConfig['product_type'])){
				$this->messenger->addMessage('please select a correct category of products to upload');
				$this->_forward($currentProductSelectionPage);
			}else{
				$currentProductSelectionPage = 'enterattributeforproduct';
				$this->_forward($currentProductSelectionPage);
			}
			*/
			
			//for multiple users to login in and upgrade their account status and post items. 
			if(!($this->userObject->user_type!='generalSeller' || $this->userObject->user_type!='storeSeller')){
				echo 'you need to be upgrade to a seller in order to list items';
				//$this->_forward('upgradegeneralseller', 'account');
			}else{
				/*$size = $this->getRequest()->getParam('size_category');
				$sex= $this->getRequest()->getParam('sex');
				$type = $this->getRequest()->getParam('type');
				$heel = $this->getRequest()->getParam('heel');
				$tag = $this->getRequest()->getParam('productTag');
				$product_id =$this->getRequest()->getParam('id');
				$product =$size.$sex.$type.$heel;
				//echo $product;
				if(in_array($product, $this->availableProduct) && in_array($tag, $this->availableProductTags)){
					echo 'here at good product';
					$this->productListing->product_type = $product;
					$this->_redirect('productlisting/editproduct?id='.$product_id.'&product='.$product.'&tag='.$tag);
				}else{
					echo 'product type is: '.$product;
					echo 'you need to select a type of product that you would like to list';
				}*/
			}
			
			//include('productConfig.php');
			//Zend_Debug::Dump($productTypeConfig);
			//$this->view->productConfig = $productTypeConfig;
		}
		
		public function uploadbuynowproductAction(){
			$this->view->purchase_type = 'Buy_now';
			$this->view->editproductlink='editbuynowproduct';
		}
		public function uploadcustomizeproductAction(){
			$this->view->purchase_type = 'Customizable';
			$this->view->editproductlink='editcustomproduct';
		}
		
		
		//retrievs the necessary form for product uploading
		//allows a range on selections per attribute
		//ultimate product editing page. 
		public function editcustomproductAction(){
		$param['purchase_type'] = $this->request->getParam('purchase_type');
			if(in_array($param['purchase_type'], $this->productConfig['allowedPurchaseType'][$this->signedInUserSessionInfoHolder->generalInfo->user_type])){
				$param['product_category']=$this->request->getParam('category');
				$param['product_type']=$this->request->getParam('type');
				$param['product_tag']=$this->request->getParam('tag');
				$param['product_id'] = $this->request->getParam('id');
				$param['social_usage']=$this->request->getParam('social_usage');
				$param['competition_usage']=$this->request->getParam('competition_usage');
				if($param['product_id']==''){
					$param['product_id']=0;
				}
				
				$config = Zend_Registry::get('config');
				echo $config->paths->base;
				
				if(in_array($param['product_tag'], $this->productConfig['upload_menu_item'][$param['purchase_type']][$param['product_category']][$param['product_type']])){
					//display the form, 
					echo 'here at good attribute selection';
					$param['inventory_attribute_table'] = $this->productConfig['inventory_attribute_table'][$param['product_tag']];
					$fp = new FormProcessor_Product($this->db, $this->signedInUserSessionInfoHolder, $param);
					if($this->request->isPost()){
						echo 'here at post<br />';
						if($fp->process($this->request)){
							Zend_Debug::dump($_FILES);
							
								//Zend_Debug::dump($v);
							echo 'product name is: '.$fp->product->name;
							DatabaseObject_Helper_ImageUpload::uploadImage($_FILES['generalImages'], $this->db,'product_images',$param['product_tag'], $fp->product_id,$fp->product->name);
							//}
							//echo 'productlisting/editproduct?purchase_type='.$fp->product->purchase_type.'&category='.$fp->product->product_category.'&type='.$fp->product->product_type.'&tag='.$fp->product->product_tag.'&id='.$fp->product->getId();
							//$this->_redirect('productlisting/editproduct?purchase_type='.$fp->product->purchase_type.'&category='.$fp->product->product_category.'&type='.$fp->product->product_type.'&tag='.$fp->product->product_tag.'&id='.$fp->product->getId());
							if($fp->product->purchase_type=='Customizable'){
								$this->_redirect('manageattribute/editproductattribute?id='.$fp->product->getId());
							}elseif($fp->product->purchase_type=='Buy_now'){
								$this->_redirect('manageinventory/addbuynowinventory?id='.$fp->product->getId());
							}
							//$this->_redirect($_SERVER['HTTP_REFERER']);
						}
					}
					if($fp->product->getId()){
						 $addPartial='_edit'.$fp->product->purchase_type.'Product.tpl';
		   				 $this->view->addPartial=$addPartial;
					}else{
						 $addPartial='_edit'.$param['purchase_type'].'Product.tpl';
		   				 $this->view->addPartial=$addPartial;
					}
					$this->view->fp = $fp;
					//Zend_Debug::dump($fp->product);
					
					//$this->view->back= $_SERVER['HTTP_REFERER'];
				}else{
					$this->messenger->addMessage('you have an error in this request');
					$this->_redirect('index/error');
				}
			}else{
				$this->messenger->addMessage('you do not have permissions to add this type of product');
				$this->_redirect('index/error');
			}
		}
		
		/*public function editgeneralinfoAction(){
			$this->purchase_type = 'customize';
			$this->product_category=$this->request->getParam('category');
			$this->product_type=$this->request->getParam('type');
			$this->product_tag=$this->request->getParam('tag');
			if($this->productConfig[$this->purchase_type][$this->product_category][$this->product_type]==$this->product_tag){
				//display the form, 
			}
		}*/
		
		public function editbuynowproductAction(){
		$param['purchase_type'] = $this->request->getParam('purchase_type');
			if(in_array($param['purchase_type'], $this->productConfig['allowedPurchaseType'][$this->signedInUserSessionInfoHolder->generalInfo->user_type])){
				$param['product_category']=$this->request->getParam('category');
				$param['product_type']=$this->request->getParam('type');
				$param['product_tag']=$this->request->getParam('tag');
				$param['product_id'] = $this->request->getParam('id');
				$param['social_usage']=$this->request->getParam('social_usage');
				$param['competition_usage']=$this->request->getParam('competition_usage');
				if($param['product_id']==''){
					$param['product_id']=0;
				}
				
				$config = Zend_Registry::get('config');
				echo $config->paths->base;
				
				if(in_array($param['product_tag'], $this->productConfig['upload_menu_item'][$param['purchase_type']][$param['product_category']][$param['product_type']])){
					//display the form, 
					echo 'here at good attribute selection';
					$param['inventory_attribute_table'] = $this->productConfig['inventory_attribute_table'][$param['product_tag']];
					$fp = new FormProcessor_Product($this->db, $this->signedInUserSessionInfoHolder, $param);
					//Zend_Debug::dump($fp);
					$allowedProduct=array();	
					
					if($fp->inventory_attribute_table=='shoes'){
						$measurement=array();
						$i=0;
						while($i<50){
							$measurement[]=$i;
							$i=$i+0.5;
						}
						$this->view->measurements=$measurement;
					}elseif($fp->inventory_attribute_table!='jewelry' && $fp->inventory_attribute_table!='accessories'){
						echo 'here at dancewear';
								$inventoryDancewearAttribute=array();
								foreach($this->productConfig['attribute_categories_details'][$fp->inventory_attribute_table] as $k=>$v){
									$inventoryDancewearAttribute[$k]=array();
									$inventoryDancewearAttribute[$k][]='Flexible';
									
									$temp=$v['min'];
									while($temp<$v['max']){
										$inventoryDancewearAttribute[$k][]=$temp;
										$temp+=$v['interval'];
									}
								}
								$this->view->measurements=$inventoryDancewearAttribute;
					}
					
					//loading current inventory
					$inventories= DatabaseObject_Helper_ManageInventory::retrieveInventoryForProduct($this->db, 'product_inventories', $fp->product->getId());
							
					if(count($inventories)!=0){
						$tmpInventoryKey=array();
						foreach($inventories as $k=>$v){
							$tmpInventoryKey[]=$v['basic']['product_inventory_id'];
						}
						
						Zend_Debug::dump($tmpInventoryKey);
						$completeInventoryProfile = DatabaseObject_Helper_ManageInventory::retrieveUniqueProfileKeys($this->db, 'product_inventory_profile', $tmpInventoryKey);
						Zend_Debug::dump($completeInventoryProfile);
						$this->view->mostInventoryProfile=$completeInventoryProfile;
						$this->view->inventory = $inventories[0];
						echo 'inventory is: ';
						Zend_Debug::dump($inventories);
						
					}else{
						echo '<br/>no inventory item<br/>';
						$this->view->mostInventoryProfile=array();
					}
							
							//Zend_Debug::dump($inventories);
					//Zend_Debug::dump($inventories);
					$this->view->attributePartial='_'.$fp->inventory_attribute_table.'Attribute.tpl';
					$this->view->inventoryPartial='_'.$fp->inventory_attribute_table.'Inventory.tpl';
					$this->view->inventoryPartialTitle='_'.$fp->inventory_attribute_table.'InventoryTitle.tpl';
					$this->view->addPartial='_add'.$fp->inventory_attribute_table.'Inventory.tpl';
					//echo 'add partial is: '.'_add'.$fp->inventory_attribute_table.'Inventory.tpl';
					if($this->request->isPost()){
						if($fp->process($this->request)){
							//Zend_Debug::dump($_FILES);
							//echo 'product name is: '.$fp->product->name;
							DatabaseObject_Helper_ImageUpload::uploadImage($_FILES['generalImages'], $this->db,'product_images',$param['product_tag'], $fp->product->getId(),$fp->product->name);
							echo 'here at finish upload image <br/>';
							//*************************here at editing listing item now (uses the inventory streamline)**********
							
							//inventory_attribute_table is the defualt system attribute system. 
							Zend_Debug::dump($fp);
							//echo 'fp id is: '.$fp->product->getId();
							$fpInventory = new FormProcessor_Inventory_AddBuyNowInventory($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID, $fp->product);
								//actually processing the inventory
								//echo 'here at setting up inventory';
								//echo 'inventory id is here '.$fpInventory->product_id;
								//first delete any existing inventory
								if(count($inventories)==1){
									//$inventoryId=$this->request->getParam('id');
									$inventoryProduct = new DatabaseObject_Inventory_Product($this->db);
									//check inventory_purchase_type
									
									$inventoryProduct->load($inventories[0]['basic']['product_inventory_id']);
				
									$inventoryProduct->delete();
								}
							
							//then proceed to upload the new inventory item.
								if($fpInventory->process($this->request)){
									//process images
									//echo 'post is: '.Zend_Debug::dump($this->request->getParams());
									//Adding color to this product for front end search.
									$colors=array();
									$whichColor= $this->request->getParam('inventory');
									$tempColor=$whichColor['sys_color'];
									//echo 'which color is: '.$tempColor;
									$colors[''.$tempColor.'']=1;
									//insert color into digital sheep.
									DatabaseObject_Helper_ManageAttribute::insertProductColors($this->db, 'product_colors', $fp->product->getId(), $colors);
									//update digital sheep status.
									if(DatabaseObject_Helper_ProductListing::updateProductStatus($this->db, 'products',$this->signedInUserSessionInfoHolder->generalInfo->userID, $fp->product->getId(), 'Listed')){
									$this->messenger->addMessage($fp->name.' has been listed');
									$this->_redirect('/productlisting/viewpendingproduct');
									}else{
										echo 'problem with settin status';
									}
								}
								//echo 'here at post<br />';	
							
							
							//Zend_Debug::dump($inventories[$k]['profile']);
							
							
							//***********************end of the listing details. 
							
							//redirect to viewproductlistings.
							
						}
					}
					if($fp->product->getId()){
						 $addPartial='_edit'.$fp->product->purchase_type.'Product.tpl';
		   				 $this->view->addPartial=$addPartial;
					}else{
						 $addPartial='_edit'.$param['purchase_type'].'Product.tpl';
		   				 $this->view->addPartial=$addPartial;
					}
					$this->view->fp = $fp;
					//Zend_Debug::dump($fp->product);
					
					//$this->view->back= $_SERVER['HTTP_REFERER'];
				}else{
					$this->messenger->addMessage('you have an error in this request');
					$this->_redirect('index/error');
				}
			}else{
				$this->messenger->addMessage('you do not have permissions to add this type of product');
				$this->_redirect('index/error');
			}
		}
		

		public function productlistingpreviewAction(){
			if(!(isset($this->product_id)||($this->product_id>0)&&is_numeric($this->product_id))){
				echo 'error url<br />';
				$this->_redirect('productlisting/productlistingerror');
			}elseif(!(in_array($this->product_type, $this->availableProduct))){
				echo 'product type is: '.$this->product_type;
				echo 'error bad type';
				$this->_redirect('productlisting/productlistingerror');
				
			}else{
				
				echo 'display shit';	
				$this->view->product = $this->tempProduct;
				
				//Zend_Debug::dump($this->tempProduct);
				echo 'count of tempProduct images: '.count($this->tempProduct->images);
				//Zend_Debug::dump($this->tempProduct->images);
			}
			//echo 'username is: '.$this->tempProduct->username;
			//*******************IMAGES ATTRIBUTE*****************************//
			$selectColumnOptions=array('group'=>true, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$attributeArray = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$imageAttribute = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$this->view->attributeArray=$attributeArray;
			$this->view->imageAttribute=$imageAttribute;
			
			//*******************SIZE ATTRIBUTE*******************************//
			$selectColumnOptions=array('group'=>true, 
									   'value'=>array ('size_attribute_id', 'attribute_name', 'size_name', 'price_adjustment'));
			$sizeAttributeArray = DatabaseObject_Helper_ProductListing::getSizeAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('size_attribute_id', 'attribute_name', 'size_name', 'price_adjustment'));
			$sizeAttribute = DatabaseObject_Helper_ProductListing::getSizeAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$this->view->sizeAttributeArray=$sizeAttributeArray;
			$this->view->sizeAttribute=$sizeAttribute;
			
			
			//*******************MEASUREMENT ATTRIBUTE*************************//
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('measurement_attribute_id', 'measurement_name', 'beginning_measurement', 'ending_measurement', 'incremental_measurement','price_adjustment','filename', 'video_youtube'));
			$measurementAttribute = DatabaseObject_Helper_ProductListing::getMeasurementAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$this->view->measurementAttribute = $measurementAttribute;
			
			//********************Tags*****************************************//
			$tags = DatabaseObject_Helper_ProductListing::loadTagForObject($this->tempProduct, 'storeSeller');
			//Zend_Debug::dump($tags);
			$this->view->tags = $tags;
		}
		

		
		public function markproductasnewAction()
		{
			DatabaseObject_Helper_ProductListing::markAsNew($this->tempProduct,1);
			$this->_redirect($_SERVER['HTTP_REFERER']);
		}
		
		public function removeproductasnewAction(){
			DatabaseObject_Helper_ProductListing::markAsNew($this->tempProduct,0);
			$this->_redirect($_SERVER['HTTP_REFERER']);
		}
		
		public function sendproductliveAction(){
			//$validate = $this->request->isXmlHttpRequest();
			$product_id = $this->request->getParam('id');
			$product_type = $this->request->getParam('tag');
			$this->tempProduct = new DatabaseObject_Products($this->db);
			$this->tempProduct->getProductForUser($this->signedInUserSessionInfoHolder->generalInfo->userID, $product_id, $product_type);
			if(isset($this->tempProduct)){
				if($this->tempProduct->purchase_type=='Buy_now'){
					if(DatabaseObject_Helper_ManageInventory::hasInventory($this->db, $this->tempProduct->getId())){
						$this->tempProduct->status='Listed';
						$this->tempProduct->save();
						$this->messenger->addMessage($this->tempProduct->name.' had been listed');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}else{
						$this->messenger->addMessage('Please add listing details before this product can be listed.');
						$this->_redirect('productlisting/editbuynowproduct?id='.$this->tempProduct->getId().'&purchase_type='.$this->tempProduct->purchase_type.'&category='.$this->tempProduct->product_category.'&type='.$this->tempProduct->product_type.'&tag='.$this->tempProduct->product_tag);
					}
				}elseif($this->tempProduct->purchase_type=='Customizable'){
					$this->tempProduct->status='Listed';
					$this->tempProduct->save();
					$this->messenger->addMessage($this->tempProduct->name.' had been listed');
					$this->_redirect($_SERVER['HTTP_REFERER']);
				}
			}else{
				
			}
		}
		
		public function sendproductdraftAction(){
			$product_id = $this->request->getParam('id');
			$product_type = $this->request->getParam('tag');
			$this->tempProduct = new DatabaseObject_Products($this->db);
			$this->tempProduct->getProductForUser($this->signedInUserSessionInfoHolder->generalInfo->userID, $product_id, $product_type);
			if(isset($this->tempProduct)){
				$this->tempProduct->status='Unlisted';
				$this->tempProduct->save();
				$this->messenger->addMessage($this->tempProduct->name.' had been unlisted');
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}else{
				
			}
		}
		
		public function removeproductfromlistingAction(){
			$product_id = $this->request->getParam('id');
			$product_type = $this->request->getParam('tag');
			$this->tempProduct = new DatabaseObject_Products($this->db);
			$this->tempProduct->getProductForUser($this->signedInUserSessionInfoHolder->generalInfo->userID, $product_id, $product_type);
			if(isset($this->tempProduct)){
				$this->tempProduct->status='Removed';
				$this->tempProduct->save();
				$this->messenger->addMessage($this->tempProduct->name.' had been removed. You may relist the items under the removed sections');
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}else{
				
			}
		}
		
		public function viewpendingproductAction(){
			
			$this->product_type = $this->request->getParam('product');
			$this->product_tag = $this->request->getParam('tag');
			if($this->product_tag!='' && in_array($this->product_tag, $this->productConfig['product_tag'])){
				$options['product_tag']=$this->product_tag;
				//$options['status']=array('Listed', 'Unlisted');
				$options['no_options']=false;	
			}else{
				$options['no_options']=true;	
			}
			
			$status = $this->request->getParam('status');
			if(isset($status)){
				$options['status'][]=$this->request->getParam('status');
				
			}else{
				$options['status']=array('Listed', 'Unlisted');
			}
			$productList = DatabaseObject_Helper_ProductListing::retrieveAllProduct($this->db, 'products', $this->signedInUserSessionInfoHolder->generalInfo->userID, $options);
			//Zend_Debug::dump($productList);
			$this->view->productList = $productList;
			$menuOptions['status']=array('Listed', 'Unlisted');
			$tags = DatabaseObject_Helper_ProductDisplay::retrieveSingleTagForProduct($this->db, 'products', $this->signedInUserSessionInfoHolder->generalInfo->userID, $menuOptions);
			$this->view->tagArray = $tags;
			//Zend_Debug::dump($tags);
			//Zend_Debug::dump($this->productConfig['upload_menu_item']);
			//$menuBar=array();
			$menuBars = DatabaseObject_Helper_UtilityManager::setTagMenuForProductListing($tags);
			Zend_Debug::dump($menuBars);
			$this->view->menuBars=$menuBars;
			$brand = DatabaseObject_Helper_ProductDisplay::retrieveBrandForProduct($this->db, 'products',$this->signedInUserSessionInfoHolder->generalInfo->userID, $this->product_tag);
			$this->view->brands=$brand;
			//Zend_Debug::dump($brand);
			
			//*********************************************************OLD VERSION*********************************//
			/*$tag = $this->request->getParam('tag');
			$product = $this->request->getParam('product');
			
			if($product=='')
			{
				$product='pants';
			}
			$options = array(
							'order' => 'ts_created DESC',
							'tag' => $tag,
							'product' => $product
			);				
			
			//$v is used here and all products must have a loadAllProductForUser
			$product = ObjectGenerator::generateProductForListing($this->db, $product)->loadAllProductForUser($this->signedInUserSessionInfoHolder->generalInfo->userID, $options);
			
			$this->view->pantsProduct = $product;
			
			//retrieve appropiate tages for product category now
			$tagArray=array();
			foreach($this->availableProduct as $k=>$v)
			{
				$options=array('groupby'=>'tag');
				$tags = DatabaseObject_Helper_ProductDisplay::retriveAllTagsForProductType($this->db, $v, $options);
				
				$tagArray[$v]['tag']=$tags;
			}
			
			$this->view->tagArray = $tags;


			$this->view->productTypes = $this->availableProduct;*/
		}
		
	
		
		
		public function tagsAction()
		{
			if(!isset($this->tempProduct)){
				
				echo 'you are here at product unavailable';
			}
			
			$tag = $this->request->getPost('tag');
			
			if($this->request->getPost('add'))
			{
				DatabaseObject_Helper_ProductListing::addTagToObject($this->tempProduct, $tag,'storeSeller', $this->signedInUserSessionInfoHolder->generalInfo->userID );	
				$this->messenger->addMessage('Categories added to product');
			}
			else if($this->request->getPost('delete'))
			{
				DatabaseObject_Helper_ProductListing::removeTagFromObject($this->tempProduct, $this->request->getParam('tagid'), 'storeSeller', $this->signedInUserSessionInfoHolder->generalInfo->userID );	
				$this->messenger->addMessage('Categories deleted for user product');
			}
			//$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);
		}
		
		public function categoriesAction()
		{
			
		}
		
		
		//not used anymore
		public function addmeasurementtoproductAction(){
			if($this->request->getPost('upload')){
				$fp=new FormProcessor_Helper_MeasurementAttribute($this->tempProduct);
				
				if($fp->process($this->request)){
					echo 'here at added to product';
				}else{
					echo 'error';
				}
			}elseif($this->request->getPost('delete')){
				$id = $this->request->getParam('measurement');
				$measurement = new DatabaseObject_Attribute_MeasurementWithImageAttribute($this->db);
				
				if($measurement->loadForPost($id, $this->tempProduct->username, $this->product_type, $this->product_id))
				{
					$measurement->delete();
					//Zend_Debug::dump($measurement);
					echo 'measurement deleted';
				}else{
					echo 'failed at delete';
				}	
			}
		}
		
		//not used anymore
		public function addsizeattributetoproductAction(){
			
			if($this->request->getPost('upload')){
				$fp=new FormProcessor_Helper_SizeAttribute($this->tempProduct);
				
				if($fp->process($this->request)){
					echo 'here at added to product';
				}else{
					echo 'error';
				}
			}elseif($this->request->getParam('delete')){
				$id = $this->request->getParam('size');
				$size = new DatabaseObject_Attribute_SizeAttribute($this->db);
				
				if($size->loadForPost($id, $this->tempProduct->username, $this->product_type, $this->product_id))
				{
					$size->delete();
					//Zend_Debug::dump($measurement);
					echo 'size deleted';
				}else{
					echo 'failed at delete';
				}
				
			}
			$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);
		}
		
		//work with qualified products. 
		public function imagesAction()
		{
			if($this->request->getPost('upload')){
				echo 'here at image upload<br />';
				$fp=new FormProcessor_Image($this->tempProduct, 'storeSeller');
				echo 'here at instantiating image<br />';
				if($fp->process($this->request)){
					echo 'here at process request<br />';
					//then update the session variable for it
					$this->messenger->addMessage('Image uploaded');
				}else{
					echo 'here at process error<br />';
					foreach($fp->getErrors() as $error)
					{
						$this->messenger->addMessage($error);
					}
				}
			}
			elseif($this->request->getParam('delete'))
			{
				$image_id = (int) $this->request->getParam('image');
				$product_id = (int) $this->request->getParam('id');
				$tag = $this->request->getParam('tag');
				$table = $this->request->getParam('image_type'); 
				//$attribute_name = $this->request->getParam('attribute_name');
				
				if(DatabaseObject_Helper_ImageUpload::removeProductAndInventoryImage($this->db, 'products', $table, $tag, $image_id, $product_id, $this->signedInUserSessionInfoHolder->generalInfo->userID)){
					$this->messenger->addMessage('Image deleted');
					$this->_redirect($_SERVER['HTTP_REFERER']);
				}
			
				/*$image_id = (int) $this->request->getPost('image');
				$image = new DatabaseObject_Image($this->db, $this->tempProduct->image_table, $this->tempProduct->product_tag);
				
				if($image->loadForPost($this->product_id, $image_id)){
					$image->delete(); //the files are unlinked/deleted at preDelete.
					////echo 'image at delete';
					
					if($this->request->isXmlHttpRequest()){
						$json = array('deleted' =>true, 'image_id' =>$image_id);
					}
					else{
						$this->messenger->addMessage('Image deleted');
					}
				}*/
			}
			
			/*elseif($this->request->getPost('reorder'))
			{
				$order = $request->getPost('post_images');
				$product->setImageOrder($order);

			}*/
			//$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);
		}
		
		//must have an id and producttype
		//not used anymore
		public function addimageattributetoproductAction(){
			if($this->request->getPost('upload')){
				echo 'here at image upload<br />';
				$fp = new FormProcessor_Helper_ImageAttribute($this->tempProduct);
				echo 'here at instantiating image<br />';
				if($fp->process($this->request)){
					echo 'here at process request<br />';
					//then update the session variable for it
					$this->messenger->addMessage('Image uploaded');
				}else{
					echo 'here at process error<br />';
					foreach($fp->getErrors() as $error)
					{
						$this->messenger->addMessage($error);
					}
				}
			}
			elseif($this->request->getParam('delete'))
			{
				//echo "at delete";
				//must check availability, can not delete other people stuff.
				$image_id = (int) $this->request->getParam('image');
				//$attribute_name = $this->request->getParam('attribute_name');
				$image = new DatabaseObject_Attribute_ImageAttribute($this->db);
				/*$image->setSaveFilePath($this->tempProduct->username, $this->tempProduct->product_type, $this->tempProduct->getId(), $attribute_name);*/
				if($image->loadForPost($this->tempProduct->getId(), $image_id)){
					$image->delete(); //the files are unlinked/deleted at preDelete.
					////echo 'image at delete';
					
					/*if($request->isXmlHttpRequest()){
						$json = array('deleted' =>true, 'image_id' =>$image_id);
					}
					else{
						$this->messenger->addMessage('Image deleted');
					}*/
				}
			}
			$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);
		}
	}
?>