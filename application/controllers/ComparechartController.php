<?php
	
	
	class ComparechartController extends CustomControllerAction
	{
		
		public function init()
		{
			parent::init();
			
		}
		
		public function preDispatch(){
			parent::preDispatch();
			$this->view->controllerMessage='<strong>Compare chart</strong> expires in 5 hours if not saved.';
			
			$this->view->controller='Comparechart';
		}
	
		public function indexAction()
		{
			//$tag=$this->getRequest->getParam('tag');
			//$purchasetype=$this->getRequest->getParam('purchasetype');
			$this->breadcrumbs->addStep('My compare chart','');
			Zend_Debug::dump($this->compareChart->comparechart);
			//Zend_Debug::dump($this->searchOptions);
			//			Zend_Debug::dump($this->searchOptions);
			if($this->auth->hasIdentity()){
			$products =DatabaseObject_Helper_ProductDisplay::retrieveCompareChartProductsForDisplay($this->db, DatabaseObject_Helper_CompareChartManager::retrieveCompareChart($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID));
				
			}else{
			$products = DatabaseObject_Helper_ProductDisplay::retrieveCompareChartProductsForDisplay($this->db, $this->compareChart->comparechart);
			}
				//Zend_Debug::dump($productExistingAttribute);
			Zend_Debug::dump($products);
			$this->view->products=$products;
        	$this->render('productdisplay/index', null, true);
			//Zend_Debug::dump($_SERVER);
		}
		
		public function addtocomparelistAction(){
			$productTable=$this->getRequest()->getParam('product');
			$id = $this->getRequest()->getParam('number');
			$this->compareChart->comparechart[$productTable][$id]=$id;
			if($this->getRequest()->isXmlHttpRequest()){
				$json=array('Message'=>'This product had been added to your compare chart.');
				//Zend_Debug::dump($this->compareChart->comparechart);
				
				$this->sendJson($json);
			}else{
				$this->messenger->addMessage('This product had been added to your compare chart.');
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}
			
		}
		
		public function removefromcomparelistAction(){
			$productTable=$this->getRequest()->getParam('product');
			$id = $this->getRequest()->getParam('number');
			unset($this->compareChart->comparechart[$productTable][$id]);
			if($this->auth->hasIdentity()){
				$param['id']=$id;
				$param['product']=$productTable;
				DatabaseObject_Helper_CompareChartManager::removeCompareChartItem($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID, $param);
			}
			if($this->getRequest()->isXmlHttpRequest()){
				$json=array('Message'=>'This product had been removed from your compare chart.');
				//Zend_Debug::dump($this->compareChart->comparechart);
				
				$this->sendJson($json);
			}else{
				$this->messenger->addMessage('This product had been removed to your compare chart.');
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}
		}
		
		//can't access this page until logged in
		/*public function displaycomparelistforuserAction(){
			
		}*/
		
		//can't save until logged in
		public function savecomparelistAction(){
			DatabaseObject_Helper_CompareChartManager::mergeCompareChart($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID, $this->compareChart->comparechart);
			$this->messenger->addMessage('Your compare chart had been saved');
			$this->_redirect('/comparechart/index');
		}
	}
?>