<?php
	class RegistrationController extends CustomControllerAction{
		public function newmemberAction()
		{
			$request=$this->getRequest(); 
			$fp = new FormProcessor_Account_UsermemberRegistration($this->db);
			$validate = $request->isXmlHttpRequest();//check to see if it is ajax request
			
			if($request->isPost()) {
				//echo 'validate is: '.$validate;
				if($validate){
					//echo 'here';
					$fp->validateOnly(true); 
					$fp->process($request);//this just process the form for ajax request. 
											//when ajax request is finished, the form submits and the following code takes care of it. 
				}
				elseif($fp->process($request)){	//custom defined function in UserRegistration.php
					//this creates the session so that the registrationcomplete can use this session to pull our information!
					$session = new Zend_Session_Namespace('tempregistration'); 
					$session->userID=$fp->user->getId();
					$session->first_name =$fp->user->first_name;
					$session->last_name=$fp->user->last_name;
					$session->email = $fp->user->email;
					$this->_forward('registrationcomplete');
				}			
			}
			if($validate){
				$json = array('errors'=> $fp->getErrors());	
				$this->sendJson($json); 
			}
			else{
				$this->breadcrumbs->addStep('Register', $this->getUrl('register'));
				$this->breadcrumbs->addStep('Create an Account');
				$this->view->fp = $fp;  
			}
		}
		
		public function registrationcompleteAction(){
			//retrieve the same session naemspace used in register
			$session = new Zend_Session_Namespace('tempregistration'); 
			if(!isset($session)){
				$this->_forward('newmember');
				return;
			}
			$this->view->user = $session;
		}
	}
?>