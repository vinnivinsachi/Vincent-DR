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
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
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