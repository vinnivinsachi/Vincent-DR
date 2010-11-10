<?php

class AccountController extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    	$this->_ajaxContext->addActionContext('checkusername', 'json')
			 ->initContext();
    }
    
    public function preDispatch() {
    	parent::preDispatch();
    	if($this->_auth->hasIdentity()) {
			$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
			// get user info
				$user = $usersMapper->findByUsername($this->loggedInUser->username);
		}
		else throw new Exception('User not logged in: In account/details');
    }

    public function indexAction() {
        // action body
    }
    
	public function registerAction() {
    	$form = new Application_Form_Account_Register;
    	$request = $this->getRequest();
    	// If form was submitted
        if($request->isPost()) {
        	// If form is valid
            if($form->isValid($request->getPost())) {
            	$user = new Application_Model_Users_User($form->getValues());
            	$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
            	if(!$usersMapper->usernameAvailable($user->username)) $this->_helper->flashMessenger(array('error' => 'That username is not available, please choose a new one'));
            	else {
            		$usersMapper->save($user);
	            	// Forward to authentication/login
	            	$request->setControllerName('authentication')
					        ->setActionName('login')
					        ->setDispatched(false);
            	}
            }
            // If form is NOT valid display errors
            //else $this->_helper->flashMessenger(array('error' => 'There were problems with your submission, please make sure javascript is enabled, and try again'));
            else throw new Exception(print_r($form->getMessages()));
        }
    }
    
    public function checkusernameAction() {
    	$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
    	$this->view->available = $usersMapper->usernameAvailable($this->_request->getParam('username'));    	
    }
    
	public function detailsAction(){		
		
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
		if($this->_auth->hasIdentity()) {
			$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
			// get user info
				$user = $usersMapper->findByUsername($this->loggedInUser->username);
			// get user's shipping addresses
				$shippingMapper = new Application_Model_Mapper_Users_ShippingAddressesMapper;
				$user->shippingAddresses = $shippingMapper->getShippingAddressesForUser($user);
			$this->view->user = $user;
		}
		else throw new Exception('User not logged in: In account/details');
		
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

