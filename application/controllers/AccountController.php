<?php

class AccountController extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    	$this->_ajaxContext->addActionContext('checkusername', 'json')
			 ->initContext();
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
            else exit(print_r($form->getMessages()));
        }
    }
    
    public function checkusernameAction() {
    	$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
    	$this->view->available = $usersMapper->usernameAvailable($this->_request->getParam('username'));    	
    }
    
	public function detailsAction(){		
		if($this->_auth->hasIdentity()) {		
			//$user = 
		}
		else exit('User not logged in: In account/details');
		
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


}

