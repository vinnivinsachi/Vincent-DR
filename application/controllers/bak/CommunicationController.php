<?php
	class CommunicationController extends CustomControllerAction
	{
	
		public function init()
		{
			parent::init();
			//$this->breadcrumbs->addStep('User product preview', $this->getUrl(null, 'Userproductpreview'));	
			//$this->request=new stdClass();
		}
		
		public function preDispatch()
		{
			parent::preDispatch();
		}
	
	
		public function indexAction()
		{
		
		}
		
		public function postshoutoutAction(){
			
			$request=$this->getRequest(); 
			if($this->auth->hasIdentity()){
				//echo 'here';
				$fp = new FormProcessor_ShoutOut($this->db, $this->userObject);
			}else{
				$fp = new FormProcessor_ShoutOut($this->db);
			}
			$validate = $request->isXmlHttpRequest();//check to see if it is ajax request
			
			if($request->isPost()) {
				//echo 'validate is: '.$validate;
				if($validate){
					//echo 'here';
					$fp->validateOnly(true); 
					if($fp->process($request)){
						$json = array('name'=>$fp->shoutout_name, 'message'=>$fp->shoutout_message,'ts_created'=>$fp->shoutout->ts_created);
						$this->sendJson($json);
					}else{
						$json = array('errors'=> $fp->getErrors());	
						$this->sendJson($json); 
					}
				}else{
					if($fp->process($request)){
						//send out emails to the people that are part of that product shoutbox. 
						//-------------------
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}else{
						$this->messenger->addMessage('We are very sorry, but there is an error during this request');
						$this->_redirect($_SERVER['HTTP_REFERER']);
						
						//echo 'error during process';
					}
				}
			}
				
		}
		
		public function privatemessageAction(){
			
			$request=$this->getRequest(); 
			if($this->auth->hasIdentity()){
				//echo 'here1';
				$fp = new FormProcessor_Message($this->db, $this->userObject);
			}else{
				//echo 'here2';
				$fp = new FormProcessor_Message($this->db);
			}
			$validate = $request->isXmlHttpRequest();//check to see if it is ajax request
			
			if($request->isPost()) {
				//echo 'validate is: '.$validate;
				if($validate){
					//echo 'here';
					$fp->validateOnly(true); 
					if($fp->process($request)){
						$json = array('name'=>$fp->sender_name, 'message'=>$fp->sender_message,'ts_created'=>$fp->sender->ts_created);
						$this->sendJson($json);
					}else{
						$json = array('errors'=> $fp->getErrors());	
						$this->sendJson($json); 
					}
				}else{
					if($fp->process($request)){
						//send out emails to the people that are part of that product shoutbox. 
						//-------------------
						$this->messenger->addMessage('Your message has been sent. You may check your out going messages under Outbox in your private messages section');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}else{
						echo 'error during process';
					}
				}
			}
				
		}
		
		public function loadoutboxmessagesAction(){
			
		}
		
		public function loadinboxmessageAction(){
			
		}
}
?>