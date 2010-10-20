<?php

	//this class works for all controller/action because all other controller will extend from this one. 
	class CustomControllerAction extends Zend_Controller_Action //this can set post dispatch items. for header.tpl and footer.tpl
	{
		protected $db;
		public $breadcrumbs;
		public $messenger;
		protected $referral;
		protected $returnPage;
		protected $logger;
		protected $_sanitizeChain;
		//protected $availableProductCategory = array('women','men','jewelry','accessories');
		//protected $availablePurchaseType=array('buy_now','customize');
		//protected $availableProductType = array('womens latin shoes', 'womens standard shoes', 'mens latin shoes', 'mens standard shoes','mens');
		

		//zend auth***
		protected $auth;		
		//sessions***
		protected $signedInUserSessionInfoHolder; 
		//databaseobjects**
		protected $userObject;// this instance is used for all extended controlls to use any user operations. 
		protected $shoppingCartDatabaseObject; //this instance is used for all extended controls to use the shoppingCart functions. 
		protected $shoppingCartInfoSession;
		protected $numberOfItemsInShoppingCart;
		protected $compareChart;
		
		protected $productConfig;
		
		public function init(){
			require APPLICATION_PATH .'/../library/productConfig.php';
			$this->productConfig= $productConfig;
			$this->db = Zend_Registry::get('db');
			$this->breadcrumbs = new Breadcrumbs();
			$this->orderLogger =Zend_Registry::get('orderLog');			
			$this->debugLogger = Zend_Registry::get('logger');
			$this->messenger = $this->_helper->_flashMessenger;
			$this->userObject = new DatabaseObject_User($this->db);//this is purely used as a constant user object.
			$this->signedInUserSessionInfoHolder = new Zend_Session_Namespace('signedInUser');
			$this->shoppingCartInfoSession = new Zend_Session_Namespace('shoppingCartInfoSession');
			$this->compareChart = new Zend_Session_Namespace('compareChart');
			$this->shoppingCartInfoSession->setExpirationSeconds(86400);
			$this->referralID = new Zend_Session_Namespace('referral');
		}
		
		public function preDispatch(){
			$this->auth=Zend_Auth::getInstance();
			//check signed in?
			if($this->auth->hasIdentity()){
				$this->view->authenticated = true;
				//load information about signed in user.
				if($this->userObject->load($this->auth->getIdentity()->userID)){
					//check to see if basic user info is in sessoin
					if(!isset($this->signedInUserSessionInfoHolder->generalInfo)){
						$this->signedInUserSessionInfoHolder->generalInfo=$this->userObject->createGeneralInfoSessionObject();
					}
					if($this->userObject->user_type=='generalSeller' || $this->userObject->user_type=='storeSeller' ||$this->userObject->user_type=='admin'){
						if(!isset($this->signedInUserSessionInfoHolder->sellerInfo)){
							$this->signedInUserSessionInfoHolder->sellerInfo=$this->userObject->createSellerInfoSessionObject();
						}
					}	
				}
			}
			else{
				$this->view->authenticated = false;
			}
			
			$referral=$this->getRequest()->getParam('referral');
			if($referral!=''){
				if(DatabaseObject_Helper_UserManager::loadByReferral($this->db, $referral)){
					$this->referral->referralID = $referral;
					$_SESSION['referral'] =$referral;
					
					//echo 'referral id is: '.$this->referral->referralID;
				}else{
					//echo 'error with referral ID';
				}
			}
						
			if(!isset($this->shoppingCartInfoSession->cartInfo->totalCost)){
				echo 'here at set totalCost = 0';
				$this->shoppingCartInfoSession->cartInfo->totalCost=0;
			}
			
			
			if(!isset($this->shoppingCartInfoSession->cartInfo->promotionCodeUsed)){
				$this->shoppingCartInfoSession->cartInfo->promotionCodeUsed='';
			}
			if(!isset($this->shoppingCartInfoSession->cartInfo->promotionAmountDeducted)){
				$this->shoppingCartInfoSession->cartInfo->promotionAmountDeducted=0;
			}
			if(!isset($this->shoppingCartInfoSession->cartInfo->totalItems)){
				$this->shoppingCartInfoSession->cartInfo->totalItems = 0;
			}
			if(!isset($this->shoppingCartInfoSession->cartInfo->totalRewardPoints)){
				$this->shoppingCartInfoSession->cartInfo->totalRewardPoints = 0;
			}
			if(!isset($this->shoppingCartInsoSession->cartInfo->rewardAmountDeducted)){
				$this->shoppingCartInsoSession->cartInfo->rewardAmountDeducted=0;
			}
			if(!isset($this->shoppingCartInfoSession->cartInfo->checkoutOk)){
				$this->shoppingCartInfoSession->cartInfo->checkoutOk = false;
			}
			
			//Zend_Debug::dump($this->signedInUserSessionInfoHolder->sellerInfo);
			
			$this->view->shoppingCartProducts = $this->shoppingCartInfoSession->productInfo;
			$this->view->shoppingCartInfo = $this->shoppingCartInfoSession->cartInfo;
			
			
			if(isset($_SESSION['referral'])){
				//$this->referralID = new Zend_Session_Namespace('referral');
				//echo $this->referralID;
				//$this->view->referral = $this->referral;
				//echo 'referral is: '.$_SESSION['referral'];
				//Zend_Debug::dump($this->referral);
			}
			
			//setting default layouts
			if($this->getRequest()->isXmlHttpRequest()){
				$this->view->layout = 'applicationAJAX';
			}else{
				$this->view->layout = 'application';
			}
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
			$this->shoppingCartInfoSession->setExpirationSeconds(43200);
			
			//$this->view->productConfig = $this->productConfig;
			$this->view->siteRoot = SITE_ROOT;
			$this->view->cssDir = CSS_DIR;
			$this->view->imagesDir = IMAGES_DIR;
			$this->view->jsDir = JS_DIR;
		}
		
		public function postDispatch(){
			$this->view->breadcrumbs = $this->breadcrumbs;
			$this->view->title=$this->breadcrumbs->getTitle();
			$this->view->messages=$this->messenger->getMessages();
			$this->view->isXmlHttpRequest=$this->getRequest()->isXmlHttpRequest();
			
		}
		
		public function getUrl($action=null, $controller=null){
			$url = rtrim($this->getRequest()->getBaseUrl(), '/');
			$url .=$this->_helper->url->simple($action, $controller); //simple funciton does this.
			return $url;
		}
		
		public function getCustomUrl($options, $route=null){//first argument is the url parameter, and second argument is name of route. 
			return $this->_helper->url->url($options, $route); //this returns a string. //check the zend framework on this url thing. 
		
		}
		
		public function sendJson($data){ //this is a wrappe to Zend_json
			$this->_helper->viewRenderer->setNoRender(); //no output here
			
			$this->getResponse()->setHeader('content-type','application/json');
			echo Zend_Json::encode($data);
		}
		
		 public function sanitize($value)
        {
            if (!$this->_sanitizeChain instanceof Zend_Filter) {
                $this->_sanitizeChain = new Zend_Filter();
                $this->_sanitizeChain->addFilter(new Zend_Filter_StringTrim())
                                     ->addFilter(new Zend_Filter_StripTags());
            }
            // filter out any line feeds / carriage returns
            $ret = preg_replace('/[\r\n]+/', ' ', $value);
            // filter using the above chain
            return $this->_sanitizeChain->filter($ret);
        }	
        
        public function modifyURL(){
        	$urlString=$this->getRequest()->getPathInfo();
        	$tag=$this->getRequest()->getParam('tag');
        	$paramTag=array();
        	if(isset($tag)){
        		/*$this->getRequest()->getParam('controller').'/'.$this->getRequest()->getParam('action');*/
          		$paramTag['tag']=$tag;
        	}
          	$purchaseType = $this->getRequest()->getParam('purchaseType');
          	if(isset($purchaseType)){
        		/*$this->getRequest()->getParam('controller').'/'.$this->getRequest()->getParam('action');*/
          		$paramTag['purchaseType']=$purchaseType;
          	}
  			$count=0;
          	foreach($paramTag as $k=>$v){
          		if($count==0){
          		$urlString.='?'.$k.'='.$v;
          		}else{
          			$urlString.='&'.$k.'='.$v;
          		}
          		$count++;
          	}
          	//echo 'new string = '.$urlString;
          	return $urlString;
        }
	}
?>