<?php

class TestController extends Custom_Zend_Controller_Action
{
	//protected $db;
    public function init() {
		parent::init();  // Because this is a custom controller class
    }
	
	public function preDispatch(){
		$this->_db->getProfiler()->setEnabled(true);
		
		parent::preDispatch();
		
	}
	
	public function postDispatch(){
		$profiler = $this->_db->getProfiler();
		
		$query = $profiler->getLastQueryProfile();
 
		//echo 'last query is: '. $query->getQuery();
		Zend_Debug::dump($query);
	
	}

    public function indexAction() {
		
		/*$image = new Application_Model_Products_ProductImage();
		$image->sourceName = 'products';
		$image->sourceTypeTitle = 'productTag';
		$image->sourceTypeName = 'mens standard dance shoes';
		$image->sourceID = '3';
		$image->filename = 'blah.jpg';
		
		$imageMapper = new Application_Model_Mapper_Products_ProductImagesMapper();*/
		//$imageMapper->save($image);
        // action body
		echo 'stuff';
		
		//Zend_Debug::dump(Zend_Registry::get('config'));
		
		//$this->db = Zend_Registry::get('db');
		//Zend_Debug::dump($this->db);
		//$select = $this->db->select();
    }
	
	public function productlistingAction(){
		
		
	}
    
    public function accountbalancetestingAction(){
    	$userMapper = new Application_Model_Mapper_Users_UsersMapper();
		
		$user = $userMapper->findByUsername('test1');
		
		$userProcessor = new Custom_Processor_Users_AccountBalanceAndRewardPointProcessor($user);
		$accountSummaryMapper = new Application_Model_Mapper_Users_AccountRewardPointsAndBalanceSummary();
		$accountSummaryTmp = $accountSummaryMapper->getAccountSummaryForUser($user);
		
		if(!$accountSummaryTmp){			
			$accountSummary = new Application_Model_Users_AccountRewardPointsAndBalanceSummary();
			$accountSummary->userID=$user->userID;
			$accountSummary->availableRewardPoints=8;
			$accountSummary->availableBalance=8;
			$accountSummary->ledgerBalance=8;
			$accountSummary->ledgerRewardPoints=8;
		
			$user->accountRewardPointsAndBalanceSummary=$accountSummary;
			//$user->setAccountRewardPointsAndBalance($accountSummary);
			$accountSummaryMapper->save($accountSummary);
		}else{
			Zend_Debug::dump($accountSummaryTmp);
			$user->accountRewardPointsAndBalanceSummary=$accountSummaryTmp[0];
			
		}
		
		//******Post withdraws 
		
		/*$this->_db->beginTransaction();
		try{
			$userProcessor->widthdrawBalance(3);
			$this->_db->commit();
		}catch(Exception $e){
			$this->_db->rollback();
			echo $e->getMessage();
		}*/
		//******END
		
		//******Post pending reward points 
		
		/*
		
		$userProcessor->cancelPendingRewardPointsAndBalanceForUser(2);*/
		
		//******END
		
		//******Post pending reward points for user
		
		/*$userMapper = new Application_Model_Mapper_Users_UsersMapper();
		
		$user = $userMapper->findByUsername('test1');
		
		$userProcessor = new Custom_Processor_Users_AccountBalanceAndRewardPointProcessor($user);
		
		$userProcessor->postPendingRewardPointsAndBalanceForUser(1);*/
		
		//*******END
		
		
		//******loading all pending reward points for user
		/*$userMapper = new Application_Model_Mapper_Users_UsersMapper();
		
		$user = $userMapper->findByUsername('test1');
		
		$userProcessor = new Custom_Processor_Users_AccountBalanceAndRewardPointProcessor($user);
		
		$pendingStuff = $userProcessor->loadRewardPointsAndBalanceForUser();
		
		Zend_Debug::dump($pendingStuff);*/
		//****END
		
		
		/***************testing updatePendingBalanceTracking*/
		
		/*
			$this->_db->beginTransaction();
			$pendingRewardAndBalanceTracking = new Application_Model_Users_UserPendingRewardPointAndBalanceTracking();
			$pendingRewardAndBalanceTracking->trackingType='BALANCE_ADDITION';
			$amountType = $pendingRewardAndBalanceTracking->trackingType;
	
			$pendingRewardAndBalanceTracking->causedByType='fromOrderProfileID';
			$causedByColumn = $pendingRewardAndBalanceTracking->causedByType;
			$pendingRewardAndBalanceTracking->$causedByColumn=1;
			$pendingRewardAndBalanceTracking->description='Bloody hell';
			$pendingRewardAndBalanceTracking->status = 'PENDING';
			$pendingRewardAndBalanceTracking->$amountType=5;
		
			//must fetch the accountRewardPointsAndBalanceSummary for user first. 
			//must then apply that fetched accountRewardPoints for the processor.
		
			echo 'updated reward point tracking is: '.$userProcessor->updatePendingRewardPointsAndBalanceForUser($user->accountRewardPointsAndBalanceSummary, $pendingRewardAndBalanceTracking);
			
			Zend_Debug::dump($user);
			Zend_Debug::dump($accountSummaryMapper->getAccountSummaryForUser($user));
			$this->_db->rollback();
		*/
		//***********end of the testing for updatePendingBalanceTrakcing 
    	$this->render('index');
    }
	
	public function imagetestAction(){
		
		//takes in image files and then process them by thumbnail them and display them. 
		
		Zend_Debug::dump($_FILES['generalImages']);
		
		$image =new Application_Model_Products_ProductImage();
		$imageMapper = new $image->_mapperClass;
		$imageProcessor = new Custom_Processor_Images_ImageProcessor($imageMapper);
		
		$imageProcessor->uploadImage($_FILES['generalImages'], 'productImages', 'product', 'productTag', 'mens standard shoes', '3');
		
		$this->render('index');
		
	}
	
	public function saveinventoryprofileAction(){
		$inventory = new Application_Model_Products_ProductInventory();
		
		$inventory->productID = 6;
		
		$inventory->sys_name = 'new inventory product name';
		$inventory->sys_price = 20.35;
		$inventory->sys_quantity = 3;
		$inventory->sys_metric_type = 'US';
		$inventory->sys_shoe_size = '5';
		$inventory->sys_shoe_heel = '3 inch';
		$inventory->sys_conditions = 'BRAND NEW';
		$inventory->sys_color = 'BLUE';
		$inventoryMapper = new $inventory->_mapperClass;
		$inventory->_primaryID=$inventoryMapper->save($inventory);
		Zend_Debug::dump($inventory);
		$this->render('index');
	}
	
	public function saveproductcolorAction(){
		$productColor = new Application_Model_Products_ProductColor();
		$productColorMapper = new $productColor->_mapperClass;
		
		$productColor->productID = 2;
		if($productColor->productID !=''){
			$productColor = $productColorMapper->findByColumn('productID', $productColor->productID);
		}
		$productColor->Pin_stripe = 1;
		$productColor->Black = 0;
		$productColor->Yellow = 1;
		$productColorMapper->save($productColor);
		
		Zend_Debug::dump($productColor);
		$this->render('index');
	
	}
	
	public function testingvariablesAction(){
		$product = new Application_Model_Products_Product();
		$productMapper=new $product->_mapperClass;
		$product=$productMapper->find(24);
		$product->_colors = 'blah';
		$product->_images=array('blah');
		echo $product->_colors;
		Zend_Debug::Dump($product);
		
	}
	
	//productListing testing section
	public function productsavetestingAction(){
	 	echo '<br/>';
	 	//enter new product. make sure that model works. 
	 	//after product is entered. make sure that image can be uploaded.
	 	//after product image is uploaded. 
	 	//make sure that inventory works now. 

	 	//$this->_db->beginTransaction();
	 	
	 	//try{

	 		$product = new Application_Model_Products_Product();
			//$product->productID=6;
			$product->purchaseType='CUSTOMIZE';
			$product->productCategory='WOMEN';
			$product->inventoryAttributeTable='shoes';
			$product->productTag='Ladies latin shoes';
			$product->productPriceRange = 'productPrice1';
			$product->domesticShippingRate=8.95;
			$product->internationalShippingRate=12.95;
			$product->sellerType='MEMBER';
			$product->sellerDisplayName='professional ballroom shoes - Ann Arbor';
			$product->sellerName='vinzha';
			$product->url = 'fancy-pants';
			$product->name='fancy pants';
			$product->price=65.95;
			$product->onSale=false;
			$product->brand='DanceNaturals';
			$product->returnAllowed=true;
			$product->flagged=false;
			//$product->dateCreated=date('Y-m-d G:i:s');
			$product->status='UNLISTED';
			$product->rewardPoint=4;
			$product->backorderTime='5 weeks';
			$product->competitionUsage=true;
			$product->socialUsage=true;
			$product->lastStatusChange=date('Y-m-d G:i:s');
			$productMapper = new $product->_mapperClass;
			$product->_primaryID = $productMapper->save($product);
			
			Zend_Debug::dump($product);

			//$product->image = new Application
			
			
			//$this->_db->rollback();
			
		//	$this->_db->commit();
	 	//}catch(Exception $e){
	 		//$this->_db->rollback();
	 	//	echo $e->getMessage();
	 	//}
	 	$this->render('index');
			
	}
	
	public function productinventoryprofiletestingAction(){
			$productInventory = new Application_Model_Products_ProductInventory();
			$productInventory->productID = 4;
			$productInventory->profile = new Application_Model_Products_ProductInventoryProfiles();
			$productInventory->profile->love = 'vincent and daisy';
			$productInventory->profile->passion = 'dancing';
			$productInventory->profile->sadness = 'without daisy';
			$productInventoryMapper = new $productInventory->_mapperClass;
			$productInventory->_primaryID = $productInventoryMapper->save($productInventory);
			
			Zend_Debug::dump($productInventory);
			$mapperClass= $productInventory->profile->getMapperClass();
			$productInventoryProfileMapper = new $mapperClass();
			$productInventoryProfileMapper->saveForAssociatedID($productInventory->profile, $productInventory->_primaryID);
			
			//$productInventoryMapper = new $productInventory->_mapperClass;
			
			$this->render('index');
	}
	
	public function productinventorytestAction(){
		
		$this->_db->beginTransaction();
		try{
			$product = new Application_Model_Products_Product();
			$productMapper = new $product->_mapperClass;
			
			//$product->_primaryID=2;
			if(isset($product->_primaryID) || $product->_primaryID!=''){
				echo 'finding product';
				$productTmp=$productMapper->findByColumn('productID', $product->_primaryID);
				if(count($productTmp)>0){
					echo 'productFound';
					$product = $productTmp;
					echo '<br/>Product tmp is: <br/>';
					//Zend_Debug::dump($productTmp);
				}
			}else{
				echo '<br/>primary not set<br/>';
			}
			$product->purchaseType='BUY_NOW';
			$product->productCategory='WOMEN';
			$product->inventoryAttributeTable='shoes';
			$product->productTag='Ladies latin shoes';
			$product->productPriceRange = 'product_price_1';
			$product->domesticShippingRate=8.95;
			$product->internationalShippingRate=12.95;
			$product->sellerType='MEMBER';
			$product->sellerDisplayName='professional ballroom shoes - Ann Arbor';
			$product->sellerName='vinzha';
			$product->url = 'vincent-pants';
			$product->name='vincent pants';
			$product->price=65.95;
			$product->onSale=false;
			$product->brand='VEdance';
			$product->returnAllowed=true;
			$product->flagged=false;
			//$product->dateCreated=date('Y-m-d G:i:s');
			$product->status='LISTED';
			$product->rewardPoint=4;
			$product->backorderTime='5 weeks';
			$product->competitionUsage=true;
			$product->socialUsage=true;
			$product->lastStatusChange=date('Y-m-d G:i:s');
			$product->_primaryID = $productMapper->save($product);
			
			//Zend_Debug::dump($product);
			//attribute setter
			 //= new Application_Model_Products_ProductColor();
			$product->_colors = new Application_Model_Products_ProductColor();
			$productColorMapper = new $product->_colors->_mapperClass;
			$product->_colors->productID = $product->_primaryID;
			if($product->_colors->productID !=''){
				echo 'here at checking';
				$productColorTmp = $productColorMapper->findByColumn('productID', $product->_colors->productID);	
				
				if(count($productColorTmp)>0){
					echo 'here at found';
					$product->_colors = $productColorTmp;
				}
				echo 'here at productColor found: <br/>';
				//Zend_Debug::dump($product->_colors);
			}
			$product->_colors->Pin_stripe = 1;
			$product->_colors->Black = 0;
			$product->_colors->Yellow = 1;
			echo 'after change: ';
			Zend_Debug::dump($product->_colors);			
			$product->_colors->_primaryID=$productColorMapper->save($product->_colors);
	
			//productInventory
			$productInventory = new Application_Model_Products_ProductInventory();
			$productInventory->productID = $product->_primaryID;
			$productInventory->sys_name = 'product';
			$productInventory->sys_metric_type = 'US';
			$productInventory->sys_shoe_size = '6.5';
			$productInventory->sys_shoe_heel = '2.5 inch';
			$productInventory->sys_price = '30.95';
			$productInventory->sys_quantity = 1;
			$productInventory->sys_conditions = 'New';
			$productInventory->sys_color = 'Brown';
			//setting profile
			$productInventory->profile = new Application_Model_Products_ProductInventoryProfiles();
			$productInventory->profile->love = 'vincent and daisy';
			$productInventory->profile->passion = 'dancing';
			$productInventory->profile->sadness = 'without daisy';
			$productInventoryMapper = new $productInventory->_mapperClass;
			$productInventory->_primaryID = $productInventoryMapper->save($productInventory);
			
			Zend_Debug::dump($productInventory);
			$mapperClass= $productInventory->profile->getMapperClass();
			$productInventoryProfileMapper = new $mapperClass();
			$productInventoryProfileMapper->saveForAssociatedID($productInventory->profile, $productInventory->_primaryID);
			
		
			$product->_inventory[$productInventory->_primaryID]=$productInventory;
			
			if(isset($_FILES['generalImages'])){
			Zend_Debug::dump($_FILES['generalImages']);
			
			$image =new Application_Model_Products_ProductImage();
			$imageMapper = new $image->_mapperClass;
			$imageProcessor = new Custom_Processor_Images_ImageProcessor($imageMapper);
			$imageProcessor->uploadImage($_FILES['generalImages'], 'productImages', 'product', 'productTag', $product->productTag, $product->_primaryID);
			}
			
			Zend_Debug::dump($product);
			$this->_db->commit();
			
		}catch(Exception $e){
			echo $e->getMessage();
			$this->_db->rollback();
		}

			//$this->render('index');
	}
	
	public function loadproducttestingAction(){
		$this->view->searchCriteria = '_shoesCriteria.tpl';
		
			$this->searchOptions=array();
			foreach($this->getRequest()->getParams() as $k=>$v){
				if ($k!='controller' && $k!='action' && $k!='module'){
					$this->searchOptions[$k]=$v;
					echo 'key is: '.$k;
					//echo 'value is: '.$v;
					$this->view->$k=$v;
					Zend_Debug::dump($v);
				}
			}
			
			$products = Application_Model_Mapper_Products_ProductsMapper::retrieveProductsForDisplay($this->_db, $this->searchOptions);
			Zend_Debug::dump($products);
			$this->render('index');
	}
}
?>