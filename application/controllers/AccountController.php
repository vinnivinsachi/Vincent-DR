<?php

class AccountController extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    	$this->_ajaxContext->addActionContext('checkusername', 'json')
    					   ->addActionContext('editbasicinfo', 'json')
			 			   ->initContext();
    }
    
    public function preDispatch() {
    	parent::preDispatch();
    	if($this->_auth->hasIdentity()) {
			$this->usersMapper = new Application_Model_Mapper_Users_UsersMapper;
			// get user info
				$this->user = $this->usersMapper->findByUsername($this->loggedInUser->username);
		}
		else throw new Exception('User not logged in: In account/details');
    }

    public function indexAction() {
        // action body
    }
    
	public function detailsAction(){		
		// get user's shipping addresses
			$shippingMapper = new Application_Model_Mapper_Users_ShippingAddressesMapper;
			$this->user->shippingAddresses = $shippingMapper->getShippingAddressesForUser($this->user);
			
		// send the user to the view
			$this->view->user = $this->user;
		
//		$this->view->user=$this->signedInUserSessionInfoHolder;
//		$this->view->userRewardPoint=$this->userObject->reward_point;
//		
//		if(isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id)){
//			$this->view->defaultShippingKey = $this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id;
//		}
//		else{
//			echo "there is no default shipping key set in session variable";
//		}
//		$rewardTracking = DatabaseObject_Helper_UserManager::loadRewardPointTracking($this->db, $this->signedInUserSessionInfoHolder->generalInfo->referee_id);
//		$this->view->rewardPointTracking = $rewardTracking;
//		$this->breadcrumbs->addStep('Details', $this->getUrl('details', 'account'));
//		if($this->signedInUserSessionInfoHolder->generalInfo->user_type=='generalSeller'||$this->signedInUserSessionInfoHolder->generalInfo->user_type=='storeSeller'){
//			$userReviews = DatabaseObject_Helper_UserManager::loadUserReviews($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID);
//			//Zend_Debug::dump($userReviews);
//			$this->view->userReviews = $userReviews;
//			$this->view->numberOfReview = $this->userObject->review_count;
//			$this->view->averageRating = $this->userObject->review_average_score;
//		}
//		$ip=$_SERVER['REMOTE_ADDR'];
//		echo "ip is: ".$ip;
	}
	
	public function editbasicinfoAction(){
		// send the user to the view
			$this->view->user = $this->user;
			
			
//			$request=$this->getRequest();
//			$fp = new FormProcessor_Account_UserBasicInfo($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID);
//			$this->view->fp = $fp;
//			if($request->isPost()) {
//				//database are changed in FormProcessor_Account
//				if($fp->process($request)){	
//					//session is being updated after FormProcessor_Account returns true
//					$this->signedInUserSessionInfoHolder->generalInfo->first_name=$fp->first_name;
//					$this->signedInUserSessionInfoHolder->generalInfo->last_name=$fp->last_name;
//					$this->signedInUserSessionInfoHolder->generalInfo->affiliation=$fp->affiliation;
//					$this->signedInUserSessionInfoHolder->generalInfo->experience=$fp->experience;
//					$this->_forward('details');
//				}
//			}
//			
//			$this->breadcrumbs->addStep('Details', $this->getUrl('details', 'account'));
//			$this->breadcrumbs->addStep('Edit basic information', $this->getUrl('editbasicinfo', 'account'));

		}


}

