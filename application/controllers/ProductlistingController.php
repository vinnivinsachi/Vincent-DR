<?php

	class ProductlistingController extends Custom_Zend_Controller_Action
	{
		
		public $productConfig;
		public $product;
		public $productListing;
		public $request;
		public $product_purchase_type;
		public $product_category;
		public $product_type;
		public $product_tag;
		public $testingUser;
		
		public function init() {
    		parent::init();  
			$this->request=$this->getRequest();
		}
		
		//this needs to change it to a redirect. 
		public function preDispatch(){
			parent::preDispatch();	
				if($this->_auth->hasIdentity()) {
					$this->usersMapper = new Application_Model_Mapper_Users_UsersMapper;
				// get user info
					$this->user = $this->usersMapper->findByUsername($this->loggedInUser->username);
				}else throw new Exception ('No user is logged in');
		}
		
		public function indexAction(){
			
		}
		
		private function verifystoreselling(){
			if($this->request->getParam('storeName')!=''){
				$storename = $this->request->getParam('storeName');
				echo 'store name is: '.$storename;
				if(!isset($storename)) $this->errorAndRedirect('No store was provided to the store controller');
				$this->storesMapper = new Application_Model_Mapper_Stores_StoresMapper;
				$this->store = $this->storesMapper->findByStoreName($storename);
				if(!$this->store) $this->errorAndRedirect('Cannot find a store by that name');

				if($this->_acl->isAllowed($this->user, $this->store, 'manage')){

					echo '<br/>edit allowed<br/>'; 
					return true;
				}else{
					//$this->errorAndRedirect('You do not have permission to upload a product for this store');

					echo '<br/>edit not allowed<br/>';//redirect from now. 
					return false;
				}
			}
		}
		
		public function uploadbuynowproductAction(){
			//if it is store, use store for info and user for verfication
			//otherwise use user for info and user for verification
			if($this->verifystoreselling()){
				//must have $this->store;
				//set up seller information
				$this->view->route = 'editbuynowfromstore';
				$this->view->storeName = 'dance-wear-ann-arbor';
				echo 'upload from store';
			}else{
				$this->view->route = 'editbuynowfrommember';
				echo 'upload from member';
			}
			
			//$this->view->purchase_type = 'Buy_now';
			//$this->view->editproductlink='editbuynowproduct';
			$this->view->productCategoryStructure = Application_Model_SysConst_Products::$productCategoryStructure;
			Zend_Debug::dump($this->view->productCategoryStructure);
		}
		
		
		public function uploadcustomizeproductAction(){
			if($this->verifystoreselling()){
				//must have $this->store;
				$this->view->sellerType = 'store';
				echo 'upload from store';
			}else{
				$this->view->sellerType = 'member';
				echo 'upload from member';
			}
			//$this->view->purchase_type = 'Customizable';
			$this->view->editproductlink='editcustomproduct';
		}
		
		public function editcustomproductAction(){
			
		}
		
		public function editbuynowproductAction(){
			//set up the seller
			$sellerSet = false;
			$purchaseType = 'BUY_NOW';
			if($this->verifystoreselling()){
				echo 'setting store info as seller info';
				$seller['sellerType']='Store';
				$seller['sellerName']=$this->store->storeName;
				$seller['sellerDisplayName']=$this->store->storeDisplayName;
				$this->view->route = 'editbuynowfromstore';
				$this->view->storeName = 'dance-wear-ann-arbor';
				$sellerSet=true;
			}elseif($this->user->role=='Seller'){
				$seller['sellerType']='Seller';
				$seller['sellerName']=$this->user->username;
				$seller['sellerDisplayName']=$this->user->username;
				$this->view->route = 'editbuynowfrommember';
				echo 'setting seller info as seller info';
				$sellerSet=true;
			}
	
			if($sellerSet){
				//start selling!
				$param['productCategory']=$this->request->getParam('category');
				$param['productType']=$this->request->getParam('type');
				$param['productTag']=$this->request->getParam('tag');
				$param['productID'] = $this->request->getParam('id');
				if($param['productID']==''){
					$param['productID']=0;
				}
				
				if(in_array($param['productTag'], Application_Model_SysConst_Products::$productCategoryStructure[$param['productCategory']][$param['productType']])){																		   				echo '<br/>good tag<br/>';
					$productForm = new Application_Form_Product_BasicInfo($param, $seller);
					$request = $this->getRequest();
    				// If form was submitted
       		 		if($request->isPost()) {
						Zend_Debug::dump($productForm);
					}else{
						
					}
					//passing variables to view;
					$this->view->sysBrands = Application_Model_SysConst_Products::$sysBrands;
					$this->view->sysColors = Application_Model_SysConst_Products::$sysColors;
					$this->view->sysConditions = Application_Model_SysConst_Products::$sysConditions;
		
					$this->view->productForm = $productForm;
					$this->view->attributePartial = '_'.Application_Model_SysConst_Products::$attributeTable[$param['productTag']].'Attribute.tpl';
					$this->view->inventoryPartial = '_'.Application_Model_SysConst_Products::$attributeTable[$param['productTag']].'Inventory.tpl';
					$this->view->inventoryPartialTitle = '_'.Application_Model_SysConst_Products::$attributeTable[$param['productTag']].'InventoryTitle.tpl';
					
					if($productForm->attributeTable=='shoes'){
						$this->view->sysShoeSizes=Application_Model_SysConst_Products::$sysShoeSizes;
					}elseif($productForm->attributeTable!='jewelry' && $productForm->attributeTable!='accessories'){
						//echo 'here at dancewear';
						$inventoryDancewearAttribute=array();
						foreach(Application_Model_SysConst_Products::$sysAttributeDetails[$productForm->attributeTable] as $k=>$v){
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
				}else{
					echo 'wrong tags!';		
				}
				
				
			}else{
				echo 'sorry, you are not eligible to list this item';	
			}
		
		//if there is an id, load the basic info. 
		
		
		//edit basic info
		
		//load inventory 
	
		$param['purchase_type'] = $this->request->getParam('purchase_type');
		
			if(in_array($param['purchase_type'], Application_Model_SysConst_Products::$allowedPurchaseType[$this->testingUser['role']])){	
				$param['product_category']=$this->request->getParam('category');
				$param['product_type']=$this->request->getParam('type');
				$param['product_tag']=$this->request->getParam('tag');
				$param['product_id'] = $this->request->getParam('id');
				$param['social_usage']=$this->request->getParam('social_usage');
				$param['competition_usage']=$this->request->getParam('competition_usage');
				if($param['product_id']==''){
					$param['product_id']=0;
				}
				
				
				
				//$config = Zend_Registry::get('config');
				//echo $config->paths->base;
				
				if(in_array($param['product_tag'], Application_Model_SysConst_Products::$uploadMenuArrays[$param['purchase_type']][$param['product_category']][$param['product_type']])){
					//display the form, 
					echo 'here at good attribute selection';
					$param['inventory_attribute_table'] = Application_Model_SysConst_Products::$attributeTables[$param['product_tag']];
					

					
					/*$fp = new FormProcessor_Product($this->db, $this->signedInUserSessionInfoHolder, $param);
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
							//*************************here at editing listing item now (uses the inventory streamline)
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
								}*/
								//echo 'here at post<br />';	
							
							
							//Zend_Debug::dump($inventories[$k]['profile']);
							
							
							//***********************end of the listing details. 
							
							//redirect to viewproductlistings.
							
						//}
					}
					if($fp->product->getId()){
						 $addPartial='_edit'.$fp->product->purchase_type.'Product.tpl';
		   				 $this->view->addPartial=$addPartial;
					}else{
						 $addPartial='_edit'.$param['purchase_type'].'Product.tpl';
		   				 $this->view->addPartial=$addPartial;
					}
					//$this->view->fp = $fp;
					//Zend_Debug::dump($fp->product);
					
					//$this->view->back= $_SERVER['HTTP_REFERER'];
				}else{
					$this->msg(array('error'=>'you have an error in this request'));
					//$this->_redirect('index/error');
				}
			/*}else{
				$this->msg(array('warning','you do not have permissions to add this type of product'));
				//$this->_redirect('index/error');*/
			
		}
		
		public function viewpendingproductAction(){
			//mapper instantiation:
			
			$this->productType = $this->request->getParam('product');
			$this->productTag = $this->request->getParam('tag');
			
			if($this->productTag!='' && in_array($this->productTag, $this->productConfig['product_tag'])){
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
				$options['status']=array('LISTED', 'UNLISTED');
			}
			$productList = Application_Model_Mapper_Products_ProductsMapper::retrieveAllProduct($this->_db, 'products', 1, 'member', $options);
			//Zend_Debug::dump($productList);
			$this->view->productList = $productList;
			$menuOptions['status']=array('LISTED', 'UNLISTED');
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
		}

		/*
		
		public function init()
		{
			parent::init();
			$this->breadcrumbs->addStep('DancewearRialto partner product listing', $this->getUrl(null, 'productlisting'));
			
			$this->gsNewProductListTrue = new Zend_Session_Namespace('gsNewProductListTrue');
			$this->gsExistingProductListInfo = new Zend_Session_Namespace('gsExistingProductListInfo');
			
		}
		
		public function preDispatch(){
			parent::preDispatch();
			$this->request = $this->getRequest();
			$this->product_id = $this->request->getParam('id');
			$this->product_purchase_type = $this->request->getParam('purchase_type');
			
			if(!($this->userObject->user_type!='generalSeller' || $this->userObject->user_type!='storeSeller')){
				echo 'you need to be upgrade to a seller in order to list items';
			}else{
				
			}
			
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
							
							echo 'product name is: '.$fp->product->name;
							DatabaseObject_Helper_ImageUpload::uploadImage($_FILES['generalImages'], $this->db,'product_images',$param['product_tag'], $fp->product_id,$fp->product->name);
							
							if($fp->product->purchase_type=='Customizable'){
								$this->_redirect('manageattribute/editproductattribute?id='.$fp->product->getId());
							}elseif($fp->product->purchase_type=='Buy_now'){
								$this->_redirect('manageinventory/addbuynowinventory?id='.$fp->product->getId());
							}
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
					
				}else{
					$this->messenger->addMessage('you have an error in this request');
					$this->_redirect('index/error');
				}
			}else{
				$this->messenger->addMessage('you do not have permissions to add this type of product');
				$this->_redirect('index/error');
			}
		}
		
		
		
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
							//*************************here at editing listing item now (uses the inventory streamline)
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
			//*******************IMAGES ATTRIBUTE****************************
			$selectColumnOptions=array('group'=>true, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$attributeArray = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('image_attribute_id', 'attribute_name', 'image_name', 'price_adjustment'));
			$imageAttribute = DatabaseObject_Helper_ProductListing::getImageAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$this->view->attributeArray=$attributeArray;
			$this->view->imageAttribute=$imageAttribute;
			
			//*******************SIZE ATTRIBUTE******************************
			$selectColumnOptions=array('group'=>true, 
									   'value'=>array ('size_attribute_id', 'attribute_name', 'size_name', 'price_adjustment'));
			$sizeAttributeArray = DatabaseObject_Helper_ProductListing::getSizeAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('size_attribute_id', 'attribute_name', 'size_name', 'price_adjustment'));
			$sizeAttribute = DatabaseObject_Helper_ProductListing::getSizeAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$this->view->sizeAttributeArray=$sizeAttributeArray;
			$this->view->sizeAttribute=$sizeAttribute;
			
			
			//*******************MEASUREMENT ATTRIBUTE***********************
			$selectColumnOptions=array('group'=>false, 
									   'value'=>array ('measurement_attribute_id', 'measurement_name', 'beginning_measurement', 'ending_measurement', 'incremental_measurement','price_adjustment','filename', 'video_youtube'));
			$measurementAttribute = DatabaseObject_Helper_ProductListing::getMeasurementAttribute($this->db, $this->tempProduct->username, $this->tempProduct->product_type, $this->product_id, $selectColumnOptions);
			
			$this->view->measurementAttribute = $measurementAttribute;
			
			//********************Tags****************************************
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
			
				
			}
			
			
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
				if($image->loadForPost($this->tempProduct->getId(), $image_id)){
					$image->delete(); //the files are unlinked/deleted at preDelete.
					////echo 'image at delete';
				}
			}
			$this->_redirect('productlisting/productlistingpreview?id='.$this->tempProduct->getId().'&product='.$this->product_type.'&tag='.$this->product_tag);
		}*/
	}
?>