<?php

class FindController extends Custom_Zend_Controller_Action
{

    public function init() {
        parent::init();  // Because this is a custom controller class
        $this->_ajaxContext->addActionContext('fetchmoreproducts', 'json')
			 			   ->initContext();
    }

    public function indexAction() {
    	//index action
    } // END indexAction()
    
    public function fetchmoreproductsAction() {
    	// get products
    		$products = $this->getTestData();
    		
    	// get properties of each object
    		foreach($products as $product) $productObjects[] = $product->getProperties();
    		$this->view->products = $productObjects;
    		
    	// send products to view
    		$this->view->products = $productObjects;    		
    		
    } // END fetchMoreProducts()
    
    
    // TEST DATA
    private function getTestData() {
	    // mappers
	        $productsMapper = New Application_Model_Mapper_Products_ProductsMapper;
	        
	    // products
	        $products = array();
	        for($i=0; $i<3; $i++) {
	        	$product = New $productsMapper->_modelClass(array('price'=>50.79, 'productUniqueID'=>rand()));
	        	$product->_images = $this->addImages();
	        	$products[] = $product;
	        	
	        	$product = New $productsMapper->_modelClass(array('price'=>60, 'productUniqueID'=>rand()));
	        	$product->_images = $this->addImages();
	        	$products[] = $product;
	        	
	        	$product = New $productsMapper->_modelClass(array('price'=>41.30, 'productUniqueID'=>rand()));
	        	$product->_images = $this->addImages();
	        	$products[] = $product;
	        	
	        	$product = New $productsMapper->_modelClass(array('price'=>72, 'productUniqueID'=>rand()));
	        	$product->_images = $this->addImages();
	        	$products[] = $product;
	        	
	        	$product = New $productsMapper->_modelClass(array('price'=>100.50, 'productUniqueID'=>rand()));
	        	$product->_images = $this->addImages();
	        	$products[] = $product;
	        	
	        	$product = New $productsMapper->_modelClass(array('price'=>3050.99, 'productUniqueID'=>rand()));
	        	$product->_images = $this->addImages();
	        	$products[] = $product;
	        }
		return $products;
    } // END getTestData()
    private function addImages() {
    	$imagesMapper = New Application_Model_Mapper_Products_ProductImagesMapper;
    	$images[] = new $imagesMapper->_modelClass(array('filename'=>IMAGES_DIR.'/TEST/shoes1.jpg'));
    	$images[] = new $imagesMapper->_modelClass(array('filename'=>IMAGES_DIR.'/TEST/dress1.jpg'));
    	$images[] = new $imagesMapper->_modelClass(array('filename'=>IMAGES_DIR.'/TEST/dress2.jpg'));
    	$images[] = new $imagesMapper->_modelClass(array('filename'=>IMAGES_DIR.'/TEST/shoes2.jpg'));
    	$images[] = new $imagesMapper->_modelClass(array('filename'=>IMAGES_DIR.'/TEST/dress3.jpg'));
    	//$images[] = new $imagesMapper->_modelClass(array('filename'=>IMAGES_DIR.'/TEST/shoes3.jpg'));
    	return $images;
    }// END addImages()
}

