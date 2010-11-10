<?php
// this class works for all controller/action because all other controller will extend from this one. 
class Custom_Zend_Controller_Action extends Zend_Controller_Action
{
	protected $_ajaxContext = null;
	
	public function init() {
		// Enable context switching for JSON
		$this->_ajaxContext = $this->_helper->getHelper('AjaxContext');
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
	}
	
	public function postDispatch() {
	}
	
	
	
	protected function isJsonContext() {
		return ($this->_ajaxContext->getCurrentContext() == 'json') ? true : false;
	}


}
