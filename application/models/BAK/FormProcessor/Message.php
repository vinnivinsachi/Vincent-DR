<?php
	class FormProcessor_Message extends FormProcessor
	{
	
		protected $db = null;

		public $outboxMessage = null;
		public $inboxMessage = null;
		protected $_validateOnly = false;

				
		public function __construct($db, $loggedInUser=NULL)
		{
			parent::__construct();
			
			$this->db = $db;
			
			$this->sender= new DatabaseObject_SenderMessage($db);		
			$this->receiver = new DatabaseObject_ReceiverMessage($db);
			
			if($loggedInUser !=NULL){
			//echo 'here at lggedInUser != null';
			$this->loggedInUser = true;
			$this->sender_username = $loggedInUser->username;
			$this->sender_user_id=$loggedInUser->getId();
			//echo $this->sender_username;
			}
		}
		
		public function validateOnly($flag)
		{
			$this->_validateOnly =(bool)$flag;
		}
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			$this->receiver_User_id = $request->getParam('receiver_User_id');
			$this->receiver_Username = $request->getParam('receiver_Username');
			$this->product_id = $request->getParam('product_id');
			$this->receiver_name = $request->getParam('receiver_name');
			$this->sender_name = $request->getParam('sender_name');
			
			//find out receiver_email from ID and not from getParam;
			if($this->receiver_User_id!=''){
				$this->receiver_email = DatabaseObject_Helper_UserManager::loadUserEmail($this->db, $this->receiver_User_id);
			}else{
				$this->receiver_email = $request->getParam('receiver_email');
			}
			
			if(strlen($this->receiver_email)==0){
				$this->addError('receiver_email', 'Internal error.');
			}
			
			if(strlen($this->sender_name)==0){
				$this->addError('sender_name', 'Please enter a valid message name');
			}
			$this->sender_email = $request->getParam('sender_email');
			
			
			$validator = new Zend_Validate_EmailAddress();
			
			if(strlen($this->sender_email)==0)
			{
				$this->addError('sender_email', 'Please enter you email address');
			}
			elseif(!$validator->isValid($this->sender_email))
			{
				$this->addError('sender_email', 'Please enter a valid email address');
			}else{
				$this->removeError('sender_email');
			}
			
			$this->sender_subject = $request->getParam('sender_subject');
			if(strlen($this->sender_subject)==0){
				$this->addError('sender_subject', 'Please enter a valid message subject');
			}
			
			//$this->sender_user_receive_notification = 1;
			//$this->sender_user_id = $request->getParam('sender_user_id');
			
			$this->sender_message = $request->getParam('sender_message');
			if(strlen($this->sender_message)==0){
				$this->addError('sender_message', 'Please enter a valid message');
			}
			
			if(!$this->hasError()){
				$this->sender->receiver_User_id = $this->receiver_User_id;
				$this->sender->receiver_username = $this->receiver_Username;
				$this->sender->receiver_email = $this->receiver_email;
				$this->sender->receiver_name = $this->receiver_name;
				$this->sender->product_id = $this->product_id;
				
				$this->sender->sender_name = $this->sender_name;
				$this->sender->sender_email = $this->sender_email;
				$this->sender->sender_subject= $this->sender_subject;
				
				if($this->loggedInUser){
					//echo 'here at loggedInUser isset';
					$this->sender->sender_username = $this->sender_username;
					$this->sender->sender_user_id = $this->sender_user_id;
					//echo 'USER_ID IS:'.$this->sender_user_id;
				}
				$this->sender->sender_message = $this->sender_message;
				$this->sender->save();
				
				$this->receiver->receiver_User_id = $this->receiver_User_id;
				$this->receiver->receiver_username = $this->receiver_Username;
				$this->receiver->receiver_email = $this->receiver_email;
				$this->receiver->receiver_name = $this->receiver_name;
				$this->receiver->product_id = $this->product_id;
				$this->receiver->sender_name = $this->sender_name;
				$this->receiver->sender_email = $this->sender_email;
				$this->receiver->sender_subject= $this->sender_subject;
				
				if($this->loggedInUser){
					//echo 'here at loggedInUser isset';
					$this->receiver->sender_username = $this->sender_username;
					$this->receiver->sender_user_id = $this->sender_user_id;
					//echo 'USER_ID IS:'.$this->sender_user_id;
				}
				$this->receiver->sender_message = $this->sender_message;
				$this->receiver->save();
			}
			return !$this->hasError(); 
		}
	}	
?>