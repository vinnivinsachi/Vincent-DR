<?php
	/**account**
	*AdminAccount is the master account that manages all network flow. 
	*/
	class AdminordersController extends CustomControllerAction
	{
		
		/*init**********
		*initializes all the variables necessary for this control
		*uses $this->signedInUserSessionInfoHolder instantiated and loaded in customController
		*sets up breadcrumbs for all the actions
		****************/
		public function init(){
			parent::init();
			$this->adminOrders = new Zend_Session_Namespace('adminOrders');
		}
		
		/*init*********
		*checks to see if the user is logged in
		*loads all the shipping information of a user into a session variables
		***************/
		public function preDispatch(){				
			parent::preDispatch();	
			if($this->auth->hasIdentity()){
				
				if($this->adminOrders->orderProfilesLoaded == true){
					echo 'here at already loaded';
				}else
				{
					//load all the orders;
					$orderProfiles = DatabaseObject_Helper_Admin_OrderManager::loadAllOrderProfiles($this->db);
					echo 'here at dumping';
					//Zend_Debug::dump($orderProfiles);
					foreach($orderProfiles as $k => $v)
					{
						
						switch ($orderProfiles[$k]['order_status']) {
							case 'UNSHIPPED':
								$this->adminOrders->orderProfiles->unshippedOrders[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;
							case 'SHIPPED':
								$this->adminOrders->orderProfiles->shippedOrders[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;
							case 'DELIVERED':
								$this->adminOrders->orderProfiles->deliveredOrders[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;
							case 'RETURN_SHIPPED':
								$this->adminOrders->orderProfiles->returnShippedOrders[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;
							case 'RETURN_DELIVERED':
								$this->adminOrders->orderProfiles->returnDeliveredOrders[$orderProfiles[$k]['order_profile_id']]= $orderProfiles[$k];
								break;
							case 'ORDER_COMPLETED':
								$this->adminOrders->orderProfiles->orderCompletedOrders[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
							case 'RETURN_COMPLETED':
								$this->adminOrders->orderProfiles->returnCompletedOrders[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
								break;
							case 'BALANCE_UPDATED':
								$this->adminOrders->orderProfiles->balanceUpdatedOrders[$orderProfiles[$k]['order_profile_id']]= $orderProfiles[$k];
								break;
							case 'BALANCE_REFUNDED':
								$this->adminOrders->orderProfiles->balanceRefundedOrders[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;
							case 'CANCELLED_BY_SELLER':
								$this->adminOrders->orderProfiles->cancelledBySellerOrders[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
								break;
							case 'CANCELLED_BY_BUYER':
								$this->adminOrders->orderProfiles->cancelledByBuyerOrders[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
								break;
							case 'HELD_BY_BUYER_FOR_ARBITRATION':
								$this->adminOrders->orderProfiles->heldByBuyerForArbitrationOrders[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
								break;
							case 'HELP_BY_SELLER_FOR_ARBITRATION':
								$this->adminOrders->orderProfiles->heldBySellerForArbitrationOrders[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
								break;
							case 'SELLER_CLAIM_APPROVED_UNSHIPPED':
								$this->adminOrders->orderProfiles->sellerClaimApprovedUnshippedOrders[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
								break;
							case 'SELLER_CLAIM_APPROVED_RESHIPPED':
								$this->adminOrders->orderProfiles->sellerClaimApprovedReshippedOrders[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
								break;
							case 'SELLER_CLAIM_APPROVED_DELIVERED':
							$this->adminOrders->orderProfiles->sellerClaimApprovedDeliveredOrders[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
								break;
						}
					}
					
						
					//$this->adminOrders->orderProfilesLoaded = true;
					echo 'here at loading and setting loaded equals true';
				}
			} 
		}
	
		/*index***********
		*displays everything there is that is in the session variable
		******************/
		public function indexAction(){
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
			
			$this->view->orderProfiles = $this->adminOrders->orderProfiles;		
		}
		
		public function getorderprofiletypeAction(){
			
			$this->type = $this->getRequest()->getParam('type');
			if($this->type =='' || !isset($this->type)){
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}else{
				$orderProfilesType = DatabaseObject_Helper_Admin_OrderManager::loadAllOrderProfiles($this->db, $this->type);
				$this->view->orderProfilesType = $orderProfilesType;
				$this->view->orderProfiles = $this->adminOrders->orderProfiles;		

				$this->view->type = $this->type;
			}
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
		}
		
		public function vieworderprofiledetailsAction(){
			$id = $this->getRequest()->getParam('profileId');
			$order_id = $this->getRequest()->getParam('orderId');
			
			if(isset($id)&&$id!=''){
			$order = DatabaseObject_Helper_Admin_OrderManager::retrieveOrderProfile($this->db, $id, 'profile_id');
			$order['statusTracking']=DatabaseObject_Helper_Admin_OrderManager::retrieveStatusTracking($this->db, $id);
			$this->view->viewType = '_profile_detail.tpl';

			}elseif(isset($order_id)&& $order_id!=''){
				$order = DatabaseObject_Helper_Admin_OrderManager::retrieveOrderSummaryFromOrderUniqueId($this->db, $order_id);

				$this->view->viewType = '_order_detail.tpl';

			}
			$this->view->product = $order;
			$this->view->orderProfiles = $this->adminOrders->orderProfiles;		

			Zend_Debug::dump($order);
		}
		
	}
?>