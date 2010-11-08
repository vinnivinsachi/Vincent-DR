<?php
	/**account**
	*AdminAccount is the master account that manages all network flow. 
	*/
	class AdminaccountController extends CustomControllerAction
	{	
	
		/*init**********
		*initializes all the variables necessary for this control
		*heavily rely on $this->userObject instantiated and loaded in CustomController
		*uses $this->signedInUserSessionInfoHolder instantiated and loaded in customController
		*sets up breadcrumbs for all the actions
		****************/
		public function init(){
			parent::init();
		}
		
		/*init*********
		*checks to see if the user is logged in
		*loads all the shipping information of a user into a session variables
		***************/
		public function preDispatch(){				
			parent::preDispatch();	
			if($this->auth->hasIdentity()){
			} 
		}
	
		/*index***********
		*displays everything there is that is in the session variable
		******************/
		public function indexAction(){
			
			$options=array('status'=>'PENDING');
			$withdraws = DatabaseObject_Helper_Admin_UserManager::loadAllWithdraws($this->db, $options);
			$transfers = DatabaseObject_Helper_Admin_UserManager::loadAllTransfers($this->db);
			$this->view->withdraws = count($withdraws);
			$this->view->transfers = count($transfers);
			
		}
		
		public function managewithdrawsAction(){
			$options=array('status'=>'PENDING');
			$withdraws = DatabaseObject_Helper_Admin_UserManager::loadAllWithdraws($this->db, $options);
			$this->view->withdraws = $withdraws;
			Zend_Debug::dump($withdraws);
		}
		
		public function processwithdrawAction(){
			$withdrawId = $this->getRequest()->getParam('withdrawId');
			$withdrawTracking = new DatabaseObject_Account_UserAccountBalanceWithdrawTracking($this->db);
			if($withdrawTracking->load($withdrawId)){
				echo 'here at loaded<br/>';
				if($withdrawTracking->status=='PENDING'){
					echo 'here at pending<br/>';
					$user = new DatabaseObject_User($this->db);
					
					$user->load($withdrawTracking->user_id);
					
					$userPendingBalanceProcessor = new AccountBalanceAndRewardPointProcessor($this->db, $user);
					if($userPendingBalanceProcessor->postPendingRewardPointsAndBalanceForUser($withdrawTracking->pending_tracking_id)){
						echo 'here at processed';
						$withdrawTracking->status='PROCESSED';
						$withdrawTracking->date_processed = date('Y-m-d G:i:s');
						$withdrawTracking->save();
					}
				}else{
					echo 'not pending, can not be done';
				}
			}else{
				echo 'here at not loaded';	
			}
		}
		
		public function withdrawhistoryAction(){
			$options=array('status'=>'PROCESSED');
			$withdraws = DatabaseObject_Helper_Admin_UserManager::loadAllWithdraws($this->db, $options);
			$this->view->withdraws = $withdraws;
			Zend_Debug::dump($withdraws);
		}
		
		public function managetransfersAction(){
			$options=array('status'=>'PENDING');
			$transfers = DatabaseObject_Helper_Admin_UserManager::loadAllTransfers($this->db, $options);
			$this->view->transfers = $transfers;
			Zend_Debug::dump($transfers	);
		}
		
		public function processtransfersAction(){
			$transferId = $this->getRequest()->getParam('transferId');
			$transferTracking = new DatabaseObject_Account_UserAccountBalanceTransferTracking($this->db);
			if($transferTracking->load($transferId)){
				echo 'here at loaded<br/>';
				if($transferTracking->status=='PENDING'){
					echo 'here at pending<br/>';
					$user = new DatabaseObject_User($this->db);
					
					$user->load($transferTracking->from_user_id);
					
					$userPendingBalanceProcessor = new AccountBalanceAndRewardPointProcessor($this->db, $user);
					
					$toUser = new DatabaseObject_User($this->db);
					$toUser->load($transferTracking->to_user_id);
					$toUserPendingBalanceProcessor =  new AccountBalanceAndRewardPointProcessor($this->db, $toUser);
					
					if($userPendingBalanceProcessor->postPendingRewardPointsAndBalanceForUser($transferTracking->sender_pending_tracking_id) && $toUserPendingBalanceProcessor->postPendingRewardPointsAndBalanceForUser($transferTracking->receiver_pending_tracking_id) ){
						echo 'here at processed';
						$transferTracking->status='PROCESSED';
						$transferTracking->date_processed = date('Y-m-d G:i:s');
						$transferTracking->save();
					}
				}else{
					echo 'not pending, can not be done';
					echo $transferTracking->status;
				}
			}else{
				echo 'here at not loaded';
			}
		}
		
		public function transferhistoryAction(){
			$options=array('status'=>'PROCESSED');
			$transfers = DatabaseObject_Helper_Admin_UserManager::loadAllTransfers($this->db, $options);
			$this->view->transfers = $transfers;
			Zend_Debug::dump($transfers	);
		}
		
		public function allusersAction(){
			
			$this->request = $this->getRequest();
			//echo $this->request->getParam('variable');
			
			$generalSellers = DatabaseObject_Helper_Admin_UserManager::loadAllUsers($this->db, 'generalSeller');
			$storeSellers = DatabaseObject_Helper_Admin_UserManager::loadAllUsers($this->db, 'storeSeller');
			$members = DatabaseObject_Helper_Admin_UserManager::loadAllUsers($this->db, 'member');
			
			$this->view->generalSellers = $generalSellers;
		
			echo '///===========';
			Zend_Debug::dump($generalSellers);
					$this->view->storeSellers = $storeSellers;

			echo '///===========';
			Zend_Debug::dump($storeSellers);
			$this->view->members = $members;

			echo '///===========';
			Zend_Debug::dump($members);
		}
		
		
		public function systemvariablesAction(){
			
		}
		
		public function promotionsAction(){
				
		}
	}
?>