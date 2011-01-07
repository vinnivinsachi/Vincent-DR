<?php

class ErrorController extends Custom_Zend_Controller_Action
{

	public function init() {
        parent::init();  // Because this is a custom controller class
    }
	
    public function errorAction() {
        $errors = $this->_getParam('error_handler');
        
        if (!$errors) {
            $this->view->message = 'You have reached the error page';
            return;
        }
        
        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
        
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Page not found';
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = 'Application error';
                break;
        }
        
        // Log exception, if logger available
        if ($log = $this->getLog()) {
            $log->crit($this->view->message, $errors->exception);
        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }
        
        $this->view->request = $errors->request;
       
        // IF application in PRODUCTION ENVIRONMENT
        	if(APPLICATION_ENV == 'production') {
        		// send an email to us with the error info
	        		$this->sendErrorEmail();
        		// display a friendly error page
        			$this->redirect('friendlyerror');
        	}
    } // END errorAction()

    public function getLog() {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    } // END getLog()
    
    public function friendlyerrorAction() {
    	// friendlyerror action
    } // END friendlyerrorAction()
    
	// send an error email
    private function sendErrorEmail() {
       	// capture view in variable
       		$bodyHtml = $this->view->render('error/error.tpl');
       	// create
       		$mail = new Zend_Mail('utf-8');
       		$mail->addTo('markisacat@gmail.com');
			$mail->setSubject('ERROR REPORT');
			$mail->setFrom('admin@dancerialto.com','Dance Rialto');
			$mail->setBodyHtml($bodyHtml);
			$mail->send();
    } // END sendErrorEmail()

}

