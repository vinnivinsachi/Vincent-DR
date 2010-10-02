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
				
				/*if($this->adminOrders->orderProfilesLoaded == true){
					echo 'here at already loaded';
				}else*/
				if(true){
					//load all the orders;
					$orderProfiles = DatabaseObject_Helper_Admin_OrderManager::loadAllOrderProfiles($this->db);
					echo 'here at dumping';
					Zend_Debug::dump($orderProfiles);
					foreach($orderProfiles as $k => $v)
					{
						
						switch ($orderProfiles[$k]['order_status']) {
							case 'UNSHIPPED':
								$this->adminOrders->orderProfiles->unshippedOrders[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;
							case 'SHIPPED':
								$this->adminOrders->orderProfiles->shippedOrders[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;
							/*case 'delivered':
								$this->adminOrders->orderProfiles->deliveredOrders[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;*/
							case 'RETURN_SHIPPED':
								$this->adminOrders->orderProfiles->returnShippedOrders[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;
							case 'payment transfered':
								$this->adminOrders->orderProfiles->paymentTransfered[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;
							/*case 'return delivered':
								$this->adminOrders->orderProfiles->returnShippedDeliveredOrders[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;*/
							case 'completed':
								$this->adminOrders->orderProfiles->completedOrders[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
								break;
							case 'return completed':
								$this->adminOrders->orderProfiles->returnCompleteOrders[$orderProfiles[$k]['order_profile_id']]= $orderProfiles[$k];
								break;
							case 'payment returned':
								$this->adminOrders->orderProfiles->paymentReturned[$orderProfiles[$k]['order_profile_id']] = $orderProfiles[$k];
								break;
							case 'cancelled by buyer':
								$this->adminOrders->orderProfiles->cancelledByBuyer[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
								break;
							case 'cancelled by seller':
								$this->adminOrders->orderProfiles->cancelledBySeller[$orderProfiles[$k]['order_profile_id']]=$orderProfiles[$k];
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
				$this->view->type = $this->type;
			}
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
		}
		
		
	}
?>