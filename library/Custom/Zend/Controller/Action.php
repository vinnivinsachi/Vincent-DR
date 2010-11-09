<?php
// this class works for all controller/action because all other controller will extend from this one. 
class Custom_Zend_Controller_Action extends Zend_Controller_Action
{
	protected $_ajaxContext = null;
	
	public function init() {
		// Enable context switching for JSON
		$this->_ajaxContext = $this->_helper->getHelper('AjaxContext');
		
		//$this->breadcrumbs->addStep('Account', $this->getUrl(null, 'account'));
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
		$this->view->loggedInUser = Zend_Auth::getInstance()->getIdentity();
	}
	
	public function postDispatch() {
	}


}
