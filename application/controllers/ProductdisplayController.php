<?php
	/*productlist handles only one product at a time and that is the product currently being created for listing or edited for relisting.
	*uses Formgenerator to generate the right form for different product_type
	*uses ObjectGenerator to generate the right object for the listing 
	*uses product delegation function getProductForUser(userid, product_id);
	*uses product delegation function generateGSDetailsSession()
	********/
	
	class ProductdisplayController extends CustomControllerAction
	{
		public $goodURL='';
		public $searchOptions=array();
		public $searchCriteria;
		public function init()
		{
			parent::init();
			foreach($this->getRequest()->getParams() as $k=>$v){
				if ($k!='controller' && $k!='action' && $k!='module'){
					$this->searchOptions[$k]=$v;
					//echo 'key is: '.$k;
					//echo 'value is: '.$v;
					$this->view->$k=$v;
					//Zend_Debug::dump($v);
				}
			}
			$tag=$this->getRequest()->getParam('tag');
			if(isset($tag)){
				if(in_array($tag, $this->productConfig['product_tag'])){
					$this->searchCriteria =$this->productConfig['inventory_attribute_table'][$tag];
				}else{
					$this->messenger->addMessage('Wrong product categories');
					$this->_redirect('/index/error');
				}
			}else{
				$this->searchCriteria='';
			}
			//Zend_Debug::dump($this->productConfig['searchOptions']);
		}
		
		public function preDispatch(){
			parent::preDispatch();
			$this->view->basicURL=parent::modifyURL();
			$this->view->tag=$this->getRequest()->getParam('tag');
			$this->view->purchaseType=$this->getRequest()->getParam('purchaseType');
			$this->view->page=$this->getRequest()->getParam('purchaseType');
			if ($this->searchCriteria!=''){
				$this->view->searchCriteria = '_'.$this->searchCriteria.'Criteria.tpl';
			}else{
				$this->view->searchCriteria='';
			}
		}
	
		public function indexAction()
		{
			//$tag=$this->getRequest->getParam('tag');
			//$purchasetype=$this->getRequest->getParam('purchasetype');
			$this->breadcrumbs->addStep('','');
			//Zend_Debug::dump($this->searchOptions);
			//			Zend_Debug::dump($this->searchOptions);
			$products = DatabaseObject_Helper_ProductDisplay::retrieveProductsForDisplay($this->db, $this->searchOptions);
				//Zend_Debug::dump($productExistingAttribute);
			$this->view->products=$products;
			Zend_Debug::dump($products);
			//Zend_Debug::dump($_SERVER);
		}
		
		public function purchasedetailsAction(){
			$id=$this->getRequest()->getParam('number');
			$productType =$this->getRequest()->getParam('product');
			
			$referral = $this->getRequest()->getParam('referral');
			if(isset($referral)){
				$this->view->referral=$referral;
			}
			
			if(in_array($productType,$this->productConfig['productDisplay']['search_table'])){
				if($productType=='inventory'){
				$product = DatabaseObject_Helper_ProductDisplay::retrieveProductFromInventoryForPurchaseDetails($this->db, $id);
				//$this->view->currentHREF=$_SERVER['REQUEST_URI'];
					if(count($product)==0){
					$this->messenger->addMessage('Wrong selection');
					$this->_redirect('/index/error');
					}
				}elseif($productType=='products'){
					$product = DatabaseObject_Helper_ProductDisplay::retrieveProductFromProductsForPurchaseDetails($this->db, $id);
					if($product[0]['purchase_type']!='Customizable' || count($product)==0){
						$this->messenger->addMessage('Wrong selection');
						$this->_redirect('/index/error');
					}
					if($product[0]['inventory_attribute_table']=='shoes'){
					//if there are no shoe attributes, redirect
					
					$measurement = array();
					$i=$product['systemColorAndShoesAttributes']['shoes'][0]['min_size'];
					while($i<($product['systemColorAndShoesAttributes']['shoes'][0]['max_size']+0.5)){
						$measurement[]=$i;
						$i=$i+0.5;
					}
					$this->view->measurements=$measurement;
					$heels=array();
					foreach($product['systemColorAndShoesAttributes']['heels'][0] as $key=>$value){
						if($key!='product_id'){
							if($value==1){
								$heels[]=$this->productConfig['attribute_conversion_details']['heel_sizes'][$key];
							}
						}
					}
					//Zend_Debug::dump($this->productConfig['attribute_conversion_details']['heel_sizes']);
					$this->view->heels=$heels;
					}
				}
				$this->view->product=$product;
				//echo 'here';
				Zend_Debug::dump($product); 
				if($this->getRequest()->isXmlHttpRequest()){
					$this->view->layout = 'purchasedetailsAJAX';
				}else{
					$this->view->layout= 'purchasedetails';
				}
				
				$shoutboxMessages = DatabaseObject_Helper_Communication::retriveShoutOutForProduct($this->db, $product[0]['product_id']);
				$this->view->shoutboxMessages = $shoutboxMessages;
				
				$this->view->detailPartial='_'.$productType.'Details.tpl';
			}else{
				$this->_redirect('/index/error');
			}
			//publicShoutbox messages
		}
		
		public function customizablequicklookAction(){
			
		}
		
		public function detailsAction(){
			
		}
	}
?>