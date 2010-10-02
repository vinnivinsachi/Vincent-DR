<?php

		/*add of products needs to be checked against an all attribute array so that no other attributes can be added at randome*/

		class ShoppingcartController extends CustomControllerAction
		{
			
			public function init(){
				parent::init();
	
				$this->breadcrumbs->addStep('Shopping cart', $this->getUrl(null, 'index'));
			}
			
			public function preDispatch(){
				parent::preDispatch();	
				if($this->auth->hasIdentity()){
					if(!isset($this->signedInUserSessionInfoHolder->generalInfo->shippingAddress)){
						$this->userObject->createShippingAddressInfoSessionObject($this->signedInUserSessionInfoHolder->generalInfo->shippingAddress);
					}
					$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
				} 
				
				$this->view->shoppingCartProducts = $this->shoppingCartInfoSession->productInfo;
				$this->view->shoppingCartInfo = $this->shoppingCartInfoSession->cartInfo;
			
			}
			
			public function indexAction(){
				
			
				//$request = $this->getRequest();
				Zend_Debug::dump($this->shoppingCartInfoSession->cartInfo);
				Zend_Debug::dump($this->shoppingCartInfoSession->productInfo);
				//echo $this->shoppingCartInfoSession->cartInfo->totalCost;
				
				//echo $this->shoppingCartInfoSession->cartInfo->totalCost + $this->shoppingCartInfoSession->productInfo[0]['product_price'];
				//$this->shoppingCartInfoSession->cartInfo->totalCost = $this->shoppingCartInfoSession->cartInfo->totalCost + $this->shoppingCartInfoSession->productInfo[0]['product_price'];
				//echo $this->shoppingCartInfoSession->cartInfo->totalCost;
				//$this->view->shoppingCartProducts = $this->shoppingCartInfoSession->productInfo;

			}
			
			public function additemtoshoppingcartAction(){
				$request = $this->getRequest();
				
				$id=$this->getRequest()->getParam('id');
				$purchase_type=$this->getRequest()->getParam('product');
				$currentItem=array();
				$product=array();
				
				if($purchase_type=='Inventory'){
						$product = DatabaseObject_Helper_ProductDisplay::retrieveProductFromInventoryForPurchaseDetails($this->db, $id);
					
						//echo 'product count is: '.count($product);
						Zend_Debug::dump($product);
					if(count($product)>0){
						echo 'here';
						$currentItem=DatabaseObject_Helper_ShoppingcartManager::setInventoryProductInfoForCart($product);
						$currentItem['product_type_added_to_shopping_cart']='Inventory';
						
						$this->shoppingCartInfoSession->productInfo[]=$currentItem;
						$this->shoppingCartInfoSession->cartInfo->tempTotalCost += $this->shoppingCartInfoSession->cartInfo->totalCost + $currentItem['product_price'];
						$this->shoppingCartInfoSession->cartInfo->totalRewardPoints = $this->shoppingCartInfoSession->cartInfo->totalRewardPoints + $currentItem['reward_points_awarded'];
						Zend_Debug::dump($currentItem);
						$this->shoppingCartInfoSession->cartInfo->totalItems = $this->shoppingCartInfoSession->cartInfo->totalItems+1;
			
					}
					
				}elseif($purchase_type=='Customize'){
					$product = DatabaseObject_Helper_ProductDisplay::retrieveProductFromProductsForPurchaseDetails($this->db, $id);
					if(count($product)>0){
						$currentItem=DatabaseObject_Helper_ShoppingcartManager::setCustomizeBasicProductInfoForCart($product);
						$currentItem['product_type_added_to_shopping_cart']='Customize';
						
						foreach($this->getRequest()->getParam('attribute') as $k=>$v){
							$currentItem['attributes'][$k]=$v;
						}
						$this->shoppingCartInfoSession->productInfo[]=$currentItem;
						$this->shoppingCartInfoSession->cartInfo->tempTotalCost += $this->shoppingCartInfoSession->cartInfo->totalCost + $currentItem['product_price'];
						$this->shoppingCartInfoSession->cartInfo->totalRewardPoints = $this->shoppingCartInfoSession->cartInfo->totalRewardPoints + $currentItem['reward_point'];
				
						$this->shoppingCartInfoSession->cartInfo->totalItems = $this->shoppingCartInfoSession->cartInfo->totalItems+1;
					}
					
				}
				//Zend_Debug::dump($currentItem);
					
				
				$this->messenger->addMessage('Product added to shopping cart.');
				$this->_redirect($_SERVER['HTTP_REFERER']);	
				//$this->sendJSON($currentItem);
			}
			
			public function removeitemsfromshoppingcartAction(){
				$request = $this->getRequest();
				$cartId = $request->getParam('cartProductId');
				//echo $cartId;
				//Zend_Debug::dump($this->shoppingCartInfoSession->productInfo[8]['product_price']);
				//echo $this->shoppingCartInfoSession->productInfo[$cartId]['product_price'];
				$this->shoppingCartInfoSession->cartInfo->tempTotalCost -= $this->shoppingCartInfoSession->productInfo[$cartId]['product_price'];
				$this->shoppingCartInfoSession->cartInfo->totalRewardPoints = $this->shoppingCartInfoSession->cartInfo->totalRewardPoints - $this->shoppingCartInfoSession->productInfo[$cartId]['reward_point'];
				$this->shoppingCartInfoSession->cartInfo->totalItems = $this->shoppingCartInfoSession->cartInfo->totalItems-1;
				unset($this->shoppingCartInfoSession->productInfo[$cartId]);
				
				if($this->shoppingCartInfoSession->cartInfo->totalItems==0){
				unset($this->shoppingCartInfoSession->productInfo);
				unset($this->shoppingCartInfoSession->cartInfo);
				}
				$this->messenger->addMessage('Product removed from shopping cart.');
				$this->_redirect($_SERVER['HTTP_REFERER']);	
			}
			
			public function resetshoppingcartAction(){
				
				unset($this->shoppingCartInfoSession->productInfo);
				unset($this->shoppingCartInfoSession->cartInfo);
				$this->_redirect($_SERVER['HTTP_REFERER']);	
			}
		}
?>