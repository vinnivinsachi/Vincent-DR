<?php

class TestController extends Custom_Zend_Controller_Action
{
	protected $db;
    public function init() {
		parent::init();  // Because this is a custom controller class
    }
	
	public function preDispatch(){
		
		parent::preDispatch();
		$this->render('index');
		
	}

    public function indexAction() {
        // action body
		echo 'stuff';
		//Zend_Debug::dump(Zend_Registry::get('config'));
		
		
		//$this->db = Zend_Registry::get('db');
		//Zend_Debug::dump($this->db);
		//$select = $this->db->select();
		
    }
	
	//productListing testing section
	public function productsavetestingAction(){
	 	echo '<br/>';
	 	//enter new product. make sure that model works. 
	 	//after product is entered. make sure that image can be uploaded.
	 	//after product image is uploaded. 
	 	//make sure that inventory works now. 
	 	
		$product = new Application_Model_Products_Product();
		$product->purchaseType='CUSTIMIZE';
		$product->productCategory='MEN';
		$product->inventoryAttributeTable='shoes';
		$product->productTag='Ladies latin shoes';
		//$product->productType
		$product->backorderTime='5 weeks';
		$product->brand='DanceNaturals';
		$product->competitionUsage=true;
		$product->domesticShippingRate=8.95;
		$product->internationalShippingRate=12.95;
		$product->sellerType='asdfe';
		$product->sellerDisplayName='professional ballroom shoes - Ann Arbor';
		$product->sellerName='professional-ballroom-shoes-ann-arbor';
		$product->url = 'asdfe';
		$product->name='asdfe';
		$product->price=65.95;
		$product->onSale=false;

		
		
		$product->returnAllowed=true;
		$product->flagged;
		
		$product->dateCreated=date('Y-m-d G:i:s');
		$product->status='UNLISTED';
		$product->rewardPoint=4;
		$product->socialUsage=true;
		$product->lastStatusChange=date('Y-m-d G:i:s');
		
		$productMapper = new Application_Model_Mapper_Products_ProductsMapper();
	}
}

?>