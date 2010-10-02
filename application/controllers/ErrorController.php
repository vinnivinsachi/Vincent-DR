<?php
	
	class ErrorController extends CustomControllerAction
	{
		public function errorAction()
		{
			
			$request = $this->getRequest();
			$error = $request->getParam('error_handler');
		
			switch($error->type)
			{
				case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
				case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACITON:
					$this->_forward('error404');
					return;
				
				case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER:
					
					$this->_forward('other');
					return;
					
				default:
					//fall through
			}
			
			$this->getResponse()->clearBody(); //clearing all that was outputted incase of half rendered page. 
			Zend_Registry::get('logger')->crit($error->exception->getMessage());	
		
		}
		
		public function otherAction()
		{
			Zend_Registry::get('logger')->warn($error->exception->getMessage());	
		
		}
	}
?>
		