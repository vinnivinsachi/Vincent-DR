<?php
// this class works for all controller/action because all other controller will extend from this one. 
class Custom_Zend_Controller_Action extends Zend_Controller_Action
{
	protected $_ajaxContext = null;
	protected $_db;
	
	public function init() {
		// setup db adapter
			$this->_db = Zend_Db_Table::getDefaultAdapter();
		
		// Enable context switching for JSON
			$this->_ajaxContext = $this->_helper->getHelper('AjaxContext');
		
		// Enable ACL
			$this->_acl = new Application_Model_Acl;
	}
	
	public function preDispatch() {
		// Make path constants available in views / templates
			$this->view->siteRoot = SITE_ROOT;
			$this->view->cssDir = CSS_DIR;
			$this->view->imagesDir = IMAGES_DIR;
			$this->view->jsDir = JS_DIR;
		
		// default layout variable
			$this->view->layout = 'default';
		
		// Logged in user

			$this->_auth = Zend_Auth::getInstance();
			$this->loggedInUser = $this->_auth->getIdentity();
			$this->view->loggedInUser = $this->loggedInUser;
			
		// check ACL
			$role = ($this->_auth->hasIdentity())
				? $this->loggedInUser->role
				: 'guest';
			$controller = $this->_request->getControllerName();
			$action = $this->_request->getActionName();
			if(!$this->_acl->isAllowed($role, $controller, $action)) {
				$this->msg(array('error' => 'Please login to view that page'));
				$this->_helper->redirector('login', 'authentication');
			}
	}
	
	public function postDispatch() {
	}
	
	protected function isJsonContext() {
		return ($this->_ajaxContext->getCurrentContext() == 'json') ? true : false;
	}

	// flash messenger shortcut function
	protected function msg($message) {
		$this->_helper->flashMessenger($message);
	}
	
	// set an error message and redirect
	protected function errorAndRedirect($message, $action, $controller = null) {
		if($controller == null) $controller = 'account';
		$this->msg(array('error' => $message));
		$this->_helper->redirector($action, $controller);
	}
	
}
