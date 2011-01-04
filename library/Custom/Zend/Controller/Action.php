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
			$this->_acl = new Application_Model_Acl_Acl;			
			
	}
	
	public function preDispatch() {
		// Make path constants available in views / templates
			$this->view->siteRoot = SITE_ROOT;
			$this->view->cssDir = CSS_DIR;
			$this->view->imagesDir = IMAGES_DIR;
			$this->view->jsDir = JS_DIR;
		
		// set layout
			$this->view->layout = DEFAULT_LAYOUT;
			if($layout = $this->_request->getParam('layout')) $this->view->layout = $layout;
		
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
	protected function errorAndRedirect($message, $action = null, $controller = null, array $params = null) {
		$this->msg(array('error' => $message));
		$this->redirect($action, $controller, $params);
	}
	
	// redirect
	protected function redirect($action = null, $controller = null, array $params = null) {
		if($action == null && $controller == null) {
			$action = 'index';
			$controller = 'index';
		}
		if($controller == null) $controller = $this->_request->getControllerName();
		if($params == null) $params = array();
		$this->_helper->redirector($action, $controller, null, $params);
	}
	
	// add a javascript to view and inlineScript
	protected function addScript($script) {
		// initiate view->scripts variable (used for AJAX calls)
			if(!$this->view->scripts) $this->view->scripts = '';
		// add script to $scripts variable (AJAX calls)
			$this->view->scripts .= $script;	
		
		// initiate inlineScripts (non-AJAX calls)
			$inlineScripts = $this->view->inlineScript();		
		// add scripts to inlineScripts (non-AJAX calls)
			$inlineScripts->appendScript($script);
		
	} // END addScript()
	
}
