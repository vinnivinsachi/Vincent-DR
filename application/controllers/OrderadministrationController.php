<?php
	/**account**
	*ALL account actions must be required to sign in!
	*/
	class OrderadministrationController extends CustomControllerAction
	{	
		/*init**********
		*initializes all the variables necessary for this control
		
		****************/
		public function init(){
			parent::init();
			$this->breadcrumbs->addStep('Ordermanager', $this->getUrl(null, 'account'));
		}
		
		/*init*********
		*checks to see if the user is logged in
		*loads all the shipping information of a user into a session variables
		***************/
		public function preDispatch(){					
			parent::preDispatch();	
			
		}
	
		/*index***********
		 * summary
		******************/
		public function indexAction(){
			
		}
		
	public function markorderpaymentstatusAction(){
			$this->adminOrders = new Zend_Session_Namespace('adminOrders');
			$orderItemId = $this->getRequest()->getParam('id');
			$product = new DatabaseObject_OrderProfile($this->db);
			if($product->load($orderItemId)){
				if($product->orderStatus->order_status == 'COMPLETED'){
					$product->orderStatus->order_status ='COMPLETED_AND_PAYMENT_TRANSFERED';	
					$product->orderStatus->product_fund_allocation_date=date('Y-m-d G:i:s');
					$this->messenger->addMessage('order payment transfered');
					$product->orderStatus->save();
					$this->adminOrders->orderProfiles->paymentTransfered[$orderItemId]=$this->adminOrders->orderProfiles->completedOrders[$orderItemId];
					unset($this->adminOrders->orderProfiles->completedOrders[$orderItemId]);
				}else if($product->orderStatus->order_status=='RETURN_COMPLETED'){
					$product->orderStatus->order_status='RETURN_COMPLETED_AND_REFUND_TRANSFERED';
					$product->orderStatus->product_fund_allocation_date = date('Y-m-d G:i:s');
					$this->messenger->addMessage('order payment returned');
					$product->save();
					$this->adminOrders->orderProfiles->paymentReturned[$orderItemId]=$this->adminOrders->orderProfiles->returnCompleteOrders[$orderItemId];
					unset($this->adminOrders->orderProfiles->returnCompleteOrders[$orderItemId]);
				}
				$this->messenger->addMessage('Appropriate funds had been allocated');
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->messenger->addMessage('not even loaded');
			}
			$this->_redirect($_SERVER['HTTP_REFERER']);
		
		}
		
	public function markorderascompleteAction(){
			$this->adminOrders = new Zend_Session_Namespace('adminOrders');
			$orderItemId = $this->getRequest()->getParam('id');
			$product = new DatabaseObject_OrderProfile($this->db);
			//when the product_completion_date < now
			if($product->load($orderItemId)){
				if($product->orderStatus->order_status == 'DELIVERED' && strtotime($product->orderStatus->product_completion_date)<time()){
					$product->orderStatus->order_status ='ORDER_COMPLETED';	
					$this->messenger->addMessage($product->late_delivery_confirmation_date);
					$this->messenger->addMessage('order profile completed');
					if($product->orderStatus->save()){
						DatabaseObject_Helper_Admin_OrderManager::updateStatusTracking($this->db, $orderItemId, 'ORDER_COMPLETED');

					
					$this->adminOrders->orderProfiles->orderCompletedOrders[$orderItemId]=$this->adminOrders->orderProfiles->deliveredOrders[$orderItemId];
					unset($this->adminOrders->orderProfiles->deliveredOrders[$orderItemId]);
					}
				}else if($product->orderStatus->order_status=='RETURN_DELIVERED'){
					$product->orderStatus->order_status='RETURN_COMPLETED';
					$this->messenger->addMessage($product->late_return_delivery_confirmation_date);
					$this->messenger->addMessage('order profile return completed');
					if($product->orderStatus->save()){
						DatabaseObject_Helper_Admin_OrderManager::updateStatusTracking($this->db, $orderItemId, 'RETURN_COMPLETED');
						
							
					$this->adminOrders->orderProfiles->returnCompletedOrders[$orderItemId]=$this->adminOrders->orderProfiles->returnDeliveredOrders[$orderItemId];
					unset($this->adminOrders->orderProfiles->returnDeliveredOrders[$orderItemId]);
					$this->messenger->addMessage('return completed');
					
					}
				}else{
					$this->messenger->addMessage('This order is not ready to be completed');
				}
				
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->messenger->addMessage('not even loaded');
			}
			$this->_redirect($_SERVER['HTTP_REFERER']);
		}
		
	public function markorderasdeliveredAction(){
			$this->adminOrders = new Zend_Session_Namespace('adminOrders');

			$orderItemId = $this->getRequest()->getParam('id');
			$product = new DatabaseObject_OrderProfile($this->db);
			if($product->load($orderItemId)){
				if($product->orderStatus->order_status == 'SHIPPED'){
					$product->orderStatus->order_status ='DELIVERED';	
					$product->orderStatus->product_delivered_date=date('Y-m-d',mktime(0,0,0,date("m"),date("d"),date("Y")));
					$product->orderStatus->product_completion_date=date('Y-m-d',mktime(0,0,0,date("m"),date("d")+7,date("Y")));
					$this->messenger->addMessage($product->late_delivery_confirmation_date);
					$this->messenger->addMessage('shipped delivered');
					if($product->orderStatus->save()){
						//update profile status tracking
						DatabaseObject_Helper_Admin_OrderManager::updateStatusTracking($this->db, $orderItemId, 'DELIVERED');
						
					}
					$this->adminOrders->orderProfiles->deliveredOrders[$orderItemId]=$this->adminOrders->orderProfiles->shippedOrders[$orderItemId];
					unset($this->adminOrders->orderProfiles->shippedOrders[$orderItemId]);
				}else if($product->orderStatus->order_status=='RETURN_SHIPPED'){
					$product->orderStatus->order_status='RETURN_DELIVERED';
					$product->orderStatus->product_return_delivered_date=date('Y-m-d',mktime(0,0,0,date("m"),date("d"),date("Y")));
					$product->orderStatus->product_return_completion_date = date('Y-m-d',mktime(0,0,0,date("m"),date("d")+3,date("Y")));
					$this->messenger->addMessage($product->late_return_delivery_confirmation_date);
					if($product->orderStatus->save()){
						//update profile status tracking
						DatabaseObject_Helper_Admin_OrderManager::updateStatusTracking($this->db, $orderItemId, 'RETURN_DELIVERED');
					}
					$this->messenger->addMessage('return shipped delivered');

					$this->adminOrders->orderProfiles->returnDeliveredOrders[$orderItemId]=$this->adminOrders->orderProfiles->returnShippedOrders[$orderItemId];
					unset($this->adminOrders->orderProfiles->returnShippedOrders[$orderItemId]);
				}
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->messenger->addMessage('not even loaded');
			}
			$this->_redirect($_SERVER['HTTP_REFERER']);
			//edit orderprofile stuff afterwarcds
		}
		
	
		
	public function completeorderAction(){
			$request=$this->getRequest();
			$this->productId = $request->getParam('orderProductId');
			if($this->productId!=''&&is_numeric($this->productId) && isset($this->productId)){
			$product = new DatabaseObject_OrderProfile($this->db);
				if($product->load($this->productId)){
					if(($product->buyer_UserID==$this->signedInUserSessionInfoHolder->generalInfo->userID && $product->product_order_status=='shipped')||($product->product_UserId==$this->signedInUserSessionInfoHolder->generalInfo->userID)&&($product->product_order_status=='return shipped')){						
						//edict shipping info here
						//make sure this is in either shipped or return_shipped status.
						if($product->buyer_UserID==$this->signedInUserSessionInfoHolder->generalInfo->userID && $product->product_order_status=='shipped'){
							//adding respective reward points from buying that product
							DatabaseObject_Helper_UserManager::addRewardPointToUser($this->db, $this->signedInUserSessionInfoHolder->generalInfo->referee_id, $product->reward_points, 'purchase of product: '.$product->product_name.'from order: '.$product->order_unique_id, $_SERVER['REMOTE_ADDR'], $this->signedInUserSessionInfoHolder->generalInfo->username, $this->signedInUserSessionInfoHolder->generalInfo->userID, $this->signedInUserSessionInfoHolder->generalInfo->referee_id);
							//echo 'here at adding rewardpoints';
							$product->product_order_status='completed';
							$product->save();

						}elseif(($product->product_UserId==$this->signedInUserSessionInfoHolder->generalInfo->userID)&&($product->product_order_status=='return shipped')){
							$product->product_order_status='order return completed';
							$product->save();
						}
						
						$this->messenger->addMessage('Thank you for completing this order. Payments/refunds will be transfered to the correct party during the next business day.');
						//$this->messenger->addMessage('Thank you, order status has been updated.');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}else{
						$this->messenger->addMessage('we are sorry, but you do not have permission to this page');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
		
		
	}
?>