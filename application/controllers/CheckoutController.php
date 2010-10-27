<?php
	/*******************************************************************************
	**This class requires alot of work!!! with a real server
	*******************************************************************************/

	class CheckoutController extends CustomControllerAction
	{
		protected $rewardPointsArray;
		public function preDispatch()
		{	
			parent::preDispatch();	
			if($this->auth->hasIdentity()){
				if(!isset($this->signedInUserSessionInfoHolder->generalInfo->shippingAddress)){
					$this->userObject->createShippingAddressInfoSessionObject($this->signedInUserSessionInfoHolder->generalInfo->shippingAddress);
				}
			} 
			if(!($this->shoppingCartInfoSession->cartInfo->totalItems>0)){
				$this->messenger->addMessage('You must have an item in your shopping cart before check out. Thank you.');
				$this->_redirect('/shoppingcart/index');
			}
			
			$cart = $this->shoppingCartInfoSession->cartInfo->tempTotalCost;
			$incrementalRewardNumber = floor($cart-10);
			//Zend_Debug::dump($rewardPointsArray);

			$maxDeductionRewardPointIs = $incrementalRewardNumber*4;
			$userAvailableIncrement = $this->userObject->accountBalanceSummary->available_reward_points/4;
			
			//echo $userAvailableIncrement;
			$this->rewardPointsArray[]=0;
			if($maxDeductionRewardPointIs>0){
				$finalIncrementalRewardNumber = min($incrementalRewardNumber, $userAvailableIncrement);
				$i = 1;
				while ($i <= $finalIncrementalRewardNumber){
					$this->rewardPointsArray[$i]=$i*4;
					$i++;
				}
				$this->view->incrementalRewardNumber = $this->rewardPointsArray;
				//Zend_Debug::dump($rewardPointsArray);
			}
			$this->view->shoppingCartProducts = $this->shoppingCartInfoSession->productInfo;
			$this->view->shoppingCartInfo = $this->shoppingCartInfoSession->cartInfo;
			
		}
		
		public function indexAction()
		{
			$this->view->user=$this->signedInUserSessionInfoHolder;
			$this->view->userRewardPoint=$this->userObject->accountBalanceSummary->available_reward_points;
		
			
			if(isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id)){
				$this->view->defaultShippingKey = $this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id;
			}
			else{
				//echo "there is no default shipping key set in session variable";
			}
			$this->breadcrumbs->addStep('Check out', $this->getUrl('index', 'checkout'));
			$ip=$_SERVER['REMOTE_ADDR'];
			
			
			Zend_Debug::dump($this->shoppingCartInfoSession->cartInfo);
			Zend_Debug::dump($this->shoppingCartInfoSession->productInfo);
			//$this->view->shoppingCartProducts=$this->shoppingCartInfoSession->productInfo;
			//$this->view
			if($this->userObject->accountbalanceExists()){
				
				echo 'accountbalance exist';
			}else{
				echo 'account balance does not exist';
			}
		}
		
		
		//not really used. 
		public function rewardsandpromotionsAction(){
			$request = $this->getRequest();
			$rewardpoints = $request->getParam('rewardPoints');
			$promotionCode = $request->getParam('promotionCode');
			if(in_array($rewardpoints, $this->rewardPointsArray) || $rewardpoints=='0'){
				//echo 'yes reward points correct!'; 
				$this->shoppingCartInfoSession->cartInfo->rewardPointsUsed=$rewardpoints;
				$this->shoppingCartInfoSession->cartInfo->rewardAmountDeducted = $this->shoppingCartInfoSession->cartInfo->rewardPointsUsed/4;
				//echo "reward Amound deducted: ".$this->shoppingCartInfoSession->cartInfo->rewardAmountDeducted;
				$this->shoppingCartInfoSession->cartInfo->promotionCodeUsed = $promotionCode;
				$this->shoppingCartInfoSession->cartInfo->promotionAmountDeducted = 0;
				$this->shoppingCartInfoSession->cartInfo->finalTotalCost=$this->shoppingCartInfoSession->cartInfo->tempTotalCost-$this->shoppingCartInfoSession->cartInfo->rewardAmountDeducted-$this->shoppingCartInfoSession->cartInfo->promotionAmountDeducted;
				$this->shoppingCartInfoSession->cartInfo->buyerId = $this->signedInUserSessionInfoHolder->generalInfo->userID;
				$this->shoppingCartInfoSession->cartInfo->buyerUsername = $this->signedInUserSessionInfoHolder->generalInfo->username;
				$this->shoppingCartInfoSession->cartInfo->buyerEmail = $this->signedInUserSessionInfoHolder->generalInfo->email;
				$this->shoppingCartInfoSession->cartInfo->buyerName = $this->signedInUserSessionInfoHolder->generalInfo->first_name.' '.$this->signedInUserSessionInfoHolder->generalInfo->last_name;
				$this->shoppingCartInfoSession->cartInfo->checkoutOk=true;
				//Zend_Debug::dump($this->shoppingCartInfoSession->cartInfo);
				//Zend_Debug::dump($this->shoppingCartInfoSession->productInfo);
				$json = array('successful'=>true, 'rewardPoints'=>$rewardpoints, 'promotionCode'=>$promotionCode);
				$this->sendJson($json);
			}else{
				
				$json = array('successful'=>false, 'rewardPoints'=>$rewardpoints, 'promotionCode'=>$promotionCode);
				$this->sendJson($json);
			}
			
			//work on promotion code later after the shopping cart is done. 
			//start this when I start to make the promotions for the website. 
		}
		
		public function confirmationAction()
		{	
			/*
				$this->zendSession->variable = blah.
				
				$this->zendSession->variable['blah']=blah2;
				
				$_SESSION['variable']=blah.
				
				$_SESSION['variable']['blah']=2;
				
			
			*/

			if($this->shoppingCartInfoSession->cartInfo->checkoutOk==false){
				$this->messenger->addMessage('We are sorry, but you have incomplete information during checkout.');
				$this->_redirect('/shoppingcart/index');	
			}
			if(!isset($this->shoppingCartInfoSession->cartInfo->finalTotalCost)){
				$this->messenger->addMessage('We are sorry, please enter your reward points and promotions if you have any.');
				$this->_redirect('/shoppingcart/index');	
			}
			$this->view->user=$this->signedInUserSessionInfoHolder;
			$this->view->userRewardPoint=$this->userObject->reward_point;
			if(isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id)){
				$this->view->defaultShippingKey = $this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id;
				$this->shoppingCartInfoSession->cartInfo->totalShippingCosts=0;
				$this->shoppingCartInfoSession->cartInfo->tempTotalCost=0;
				$this->shoppingCartInfoSession->cartInfo->totalCost=0;
				$this->shoppingCartInfoSession->cartInfo->rewardPointsAwarded=0;
				foreach($this->shoppingCartInfoSession->productInfo as $k=>$v){
					if(strtolower($this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id]->country)==strtolower($v['product_country_origin'])){
						echo 'here at domestic shipping';
						$this->shoppingCartInfoSession->productInfo[$k]['current_shipping_rate']=$v['domestic_shipping_rate'];
						$this->shoppingCartInfoSession->cartInfo->totalShippingCosts+=$this->shoppingCartInfoSession->productInfo[$k]['current_shipping_rate'];
						$this->shoppingCartInfoSession->cartInfo->rewardPointsAwarded+=$v['reward_points_awarded'];
						
						//$this->shoppingCartInfoSession->cartInfo->afterShippingTempTotalCost +=$this->shoppingCartInfoSession->cartInfo->totalShippingCosts;
					}else{
						echo 'here at international shipping';
						$this->shoppingCartInfoSession->productInfo[$k]['current_shipping_rate']=$v['international_shipping_rate'];
						$this->shoppingCartInfoSession->cartInfo->totalShippingCosts+=$this->shoppingCartInfoSession->productInfo[$k]['current_shipping_rate'];
						$this->shoppingCartInfoSession->cartInfo->rewardPointsAwarded+=$v['reward_points_awarded'];
						
						//$this->shoppingCartInfoSession->cartInfo->afterShippingTempTotalCost +=$this->shoppingCartInfoSession->cartInfo->totalShippingCosts;
					}
					$this->shoppingCartInfoSession->cartInfo->tempTotalCost +=$v['product_price'];
				}
				$this->shoppingCartInfoSession->cartInfo->currentDeliveryId = $this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id;
					
				$this->shoppingCartInfoSession->cartInfo->totalCost = $this->shoppingCartInfoSession->cartInfo->tempTotalCost+$this->shoppingCartInfoSession->cartInfo->totalShippingCosts - $this->shoppingCartInfoSession->cartInfo->rewardAmountDeducted;
			}
			else{
				$this->messenger->addMessage('We are sorry, but you must indicate a shipping address.');
				$this->_redirect('/shoppingcart/index');	
				//echo "there is no default shipping key set in session variable";
			}
			//$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
			//$view= $viewRenderer->view;
			//echo 'here'.Zend_Debug::dump($view);
			$this->view->shoppingCartProducts = $this->shoppingCartInfoSession->productInfo;
			$this->view->shoppingCartInfo = $this->shoppingCartInfoSession->cartInfo;
			Zend_Debug::dump($this->shoppingCartInfoSession->cartInfo);
			Zend_Debug::dump($this->shoppingCartInfoSession->productInfo);
		}
		
		public function testAction()
		{
			
		
		
		}
	
		/*this puts the cart session into the shopping cart database. 
		**then it proceeds to paypal. 
		**/
		public function createorderAction()
		{	
			if(!isset($this->shoppingCartInfoSession->cartInfo->checkoutOk)|| $this->shoppingCartInfoSession->cartInfo->checkoutOk!=true){
				$this->messenger->addMessage('You currently have an error in your shopping cart, please empty your cart and try again. We are sorry for the inconvience.');
				//$this->_redirect('/shoppingcart/index');
			}else{
				//proceed to creating the shoppingcart item. 
				
				$orderShippingAddress = new DatabaseObject_OrderShippingAddress($this->db);
				$orderShippingAddress->address_one = $this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id]->address_one;
				$orderShippingAddress->address_two = $this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id]->address_two;
				$orderShippingAddress->city = $this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id]->city;
				$orderShippingAddress->state= $this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id]->state;
				$orderShippingAddress->country = $this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id]->country;
				$orderShippingAddress->zip = $this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id]->zip;
				
				$orderShippingAddress->save();
				
				$shoppingCart = new DatabaseObject_ShoppingCart($this->db);
				
				$shoppingCart->order_shipping_id =$orderShippingAddress->getId();
				$shoppingCart->buyer_username = $this->shoppingCartInfoSession->cartInfo->buyerUsername;
				$shoppingCart->buyer_id = $this->shoppingCartInfoSession->cartInfo->buyerId;
				$shoppingCart->buyer_email = $this->shoppingCartInfoSession->cartInfo->buyerEmail;
				$shoppingCart->buyer_name = $this->shoppingCartInfoSession->cartInfo->buyerName;
				$shoppingCart->total_number_items = $this->shoppingCartInfoSession->cartInfo->totalItems;
				$shoppingCart->cart_costs = $this->shoppingCartInfoSession->cartInfo->tempTotalCost;
				$shoppingCart->total_costs = $this->shoppingCartInfoSession->cartInfo->totalCost;
				$shoppingCart->total_shipping_costs=$this->shoppingCartInfoSession->cartInfo->totalShippingCosts;
				$shoppingCart->reward_points_awarded = $this->shoppingCartInfoSession->cartInfo->rewardPointsAwarded;
				$shoppingCart->final_total_costs = $this->shoppingCartInfoSession->cartInfo->finalTotalCost;
				$shoppingCart->reward_points_used = $this->shoppingCartInfoSession->cartInfo->rewardPointsUsed;
				$shoppingCart->reward_amount_deducted = $this->shoppingCartInfoSession->cartInfo->rewardAmountDeducted;
				$shoppingCart->promotion_code_used = $this->shoppingCartInfoSession->cartInfo->promotionCodeUsed;
				$shoppingCart->promotion_amount_deducted = $this->shoppingCartInfoSession->cartInfo->promotionAmountDeducted;
				$shoppingCart->save();
				
				$tempShipping='';
				foreach($this->shoppingCartInfoSession->productInfo as $k=>$v){
					$productProfile=new DatabaseObject_ShoppingCartProfile($this->db);
					foreach($v as $key=>$value){
						
						if($key!=='attributes'){
							$productProfile->$key = $value;
								//echo " key is: ".$key.' ';
								//echo " value is: ".$value.'<br />';	
						}
						if($key=='current_shipping_rate'){
							$tempShipping=$value;
						}
						echo "key is: ".$key.' ';
						echo "value is: ".$value.'<br />';
						if($key=='attributes'){
							foreach($value as $attributeKey =>$attributeValue){
								$productProfile->profile->$attributeKey = $attributeValue;
								echo "attribute key is: ".$attributeKey.' ';
								echo "attribute value is: ".$attributeValue.'<br />';
							}
						}
					}
					$productProfile->seller_receivable = $productProfile->product_price*0.85+$tempShipping;
					$productProfile->order_unique_id = $shoppingCart->order_unique_id;
					$productProfile->order_shipping_id = $shoppingCart->order_shipping_id;
					$productProfile->buyer_name = $shoppingCart->buyer_name;
					$productProfile->buyer_id = $shoppingCart->buyer_id;
					$productProfile->buyer_username = $shoppingCart->buyer_username;
					$productProfile->buyer_email = $shoppingCart->buyer_email;
					$productProfile->buyer_country = $this->signedInUserSessionInfoHolder->generalInfo->affiliation;
					//$productProfile->order_shipping_id=$shoppingCart->order_shipping_id
					$productProfile->cart_id = $shoppingCart->getId();
					$productProfile->save();
				}
				
				$this->view->orderUniqueId = $shoppingCart->order_unique_id;
				//unset($this->shoppingCartInfoSession->productInfo);
				//unset($this->shoppingCartInfoSession->cartInfo);
				//after this creates the order, transfer to paypal. erase cart session. 
			}
		}
		
		
		//this is the order transfer process after paypal transaction is complete. 
		public function orderconfirmedAction(){
			$request = $this->getRequest();
			$orderId = $request->getParam('orderId');
			$shoppingCart = new DatabaseObject_ShoppingCart($this->db);
			$shoppingCart->loadCartOnly($orderId);
			$shoppingCart->loadCartProducts();
			Zend_Debug::dump($shoppingCart->products);
			
			$buyer = new DatabaseObject_User($this->db);
			$buyer->load($shoppingCart->buyer_id);
			$buyerBalanceAccountProcessor = new AccountBalanceAndRewardPointProcessor($this->db, $buyer);
			
			$danceRialto = new DatabaseObject_User($this->db);
			//that is the id of DanceRialto Admin
			$danceRialto->load(1);
			$danceRialtoAccountProcessor = new AccountBalanceAndRewardPointProcessor($this->db, $danceRialto);
			
			//DanceRialto load;
			
			$confirmedOrder = new DatabaseObject_Order($this->db);
			$confirmedOrder->order_unique_id = $shoppingCart->order_unique_id;
			$confirmedOrder->buyer_username = $shoppingCart->buyer_username;
			$confirmedOrder->buyer_id = $shoppingCart->buyer_id;
			$confirmedOrder->buyer_email = $shoppingCart->buyer_email;
			$confirmedOrder->buyer_name = $shoppingCart->buyer_name;
			$confirmedOrder->total_number_items = $shoppingCart->total_number_items;
			$confirmedOrder->reward_points_awarded = $shoppingCart->reward_points_awarded;
			$confirmedOrder->cart_costs=$shoppingCart->cart_costs;
			$confirmedOrder->total_costs = $shoppingCart->total_costs;
			$confirmedOrder->total_shipping_costs=$shoppingCart->total_shipping_costs;
			$confirmedOrder->reward_points_used = $shoppingCart->reward_points_used;
			$confirmedOrder->reward_amount_deducted = $shoppingCart->reward_amount_deducted;
			$confirmedOrder->promotion_code_used = $shoppingCart->promotion_code_used;
			$confirmedOrder->promotion_amount_deducted = $shoppingCart->promotion_amount_deducted;
			$confirmedOrder->final_total_costs = $shoppingCart->final_total_costs;
			$confirmedOrder->order_shipping_id = $shoppingCart->order_shipping_id;
			
			if($confirmedOrder->save()){
				//upate reward points for buyer
				if($confirmedOrder->reward_points_used>0){
					$buyerBalanceAccountProcessor->updatePendingRewardPointsAndBalanceForUser('REWARD_DEDUCTION', $confirmedOrder->reward_points_used, 'from_order_id', $confirmedOrder->order_unique_id, 'Reward points used for the purchase of order id: '.$confirmedOrder->order_unique_id);
				}
			}
			
			foreach($shoppingCart->products as $k =>$v){
				$orderProfile = new DatabaseObject_OrderProfile($this->db);
				foreach($v as $key=>$value){
					if($key!='profile' && $key!='ts_created'){
					echo 'key is: '.$key.' value is:'.$value.'<br />';
					$orderProfile->$key = $value;
					}elseif($key=='profile'){
						foreach($value as $attributeKey =>$attributeValue){
							//$productProfile->profile->$attributeKey = $attributeValue;
							$orderProfile->profile->$attributeValue['profile_key'] = $attributeValue['profile_value'];
							echo "attribute key is: ".$attributeValue['profile_key'].' ';
							echo "attribute value is: ".$attributeValue['profile_value'].'<br />';
						}
					}
				}	
				$orderProfile->dr_receivable = $orderProfile->product_price*0.15;
				$orderProfile->order_id = $confirmedOrder->getId();
				
				if($orderProfile->save()){
					//****update reward points for buyer
					if($orderProfile->reward_points_awarded>0){
					$buyerBalanceAccountProcessor->updatePendingRewardPointsAndBalanceForUser('REWARD_ADDITION', $orderProfile->reward_points_awarded, 'from_order_profile_id', $orderProfile->getId(), 'Reward points awarded for the purchase of '.$orderProfile->product_name.' in order Id: '.$confirmedOrder->order_unique_id);
					}
					
					//****update seller account balance
					$seller = new DatabaseObject_User($this->db);
					$seller->load($orderProfile->uploader_id);
					echo 'orderProfile uploader_id is: '.$seller->getId();
					//Zend_Debug::dump($seller);
					$sellerBalanceAccountProcessor = new AccountBalanceAndRewardPointProcessor($this->db, $seller);
					echo 'account processor user: '.$sellerBalanceAccountProcessor->user->getId();
					//Zend_Debug::dump($sellerBalanceAccountProcessor);
					$sellerBalanceAccountProcessor->updatePendingRewardPointsAndBalanceForUser('BALANCE_ADDITION', $orderProfile->seller_receivable, 'from_order_profile_id', $orderProfile->getId(), 'Balance addition from the sale of '.$orderProfile->product_name.' in order Id: '.$orderProfile->order_unique_id);
					
					//update balance for DR.
					$danceRialtoAccountProcessor->updatePendingRewardPointsAndBalanceForUser('BALANCE_ADDITION', $orderProfile->dr_receivable, 'from_order_profile_id', $orderProfile->getId(), 'Balance addition from the sale of '.$orderProfile->product_name.' in order Id: '.$orderProfile->order_unique_id);
					
				}
				
				$orderProfileStatusAndDelivery = new DatabaseObject_OrderProfileStatusAndDelivery($this->db);
				$orderProfileStatusAndDelivery->order_profile_id=$orderProfile->getId();
				$orderProfileStatusAndDelivery->save();
			}
			
			//now at deleting the shopping cart after completion. 
			foreach($shoppingCart->products as $k =>$v){
				$shoppingCartProfile = new DatabaseObject_ShoppingCartProfile($this->db);
				$shoppingCartProfile->load($k);
				$shoppingCartProfile->delete();
			}
			
			//echo 'shoppingcart->rewardPointsUsed: '.$shoppingCart->reward_points_used;
			//$rewardPoints = 0-$shoppingCart->reward_points_used;
			//echo'shopping cart reward point is: '.$rewardPoints.'<br />';
			//DatabaseObject_Helper_UserManager::addRewardPointToUser($this->db, $this->signedInUserSessionInfoHolder->generalInfo->referee_id, $rewardPoints, "Reward points used for the purchase of order: $confirmedOrder->order_unique_id", $_SERVER['REMOTE_ADDR'], $this->signedInUserSessionInfoHolder->generalInfo->username, $this->signedInUserSessionInfoHolder->generalInfo->userID, $this->signedInUserSessionInfoHolder->generalInfo->referee_id);
			$shoppingCart->delete();
		}
	}
?>