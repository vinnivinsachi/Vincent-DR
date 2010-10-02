<?php
	class Profile_ReceiverMessage extends Profile
	{
		public function __construct($db, $message_id = null)
		{
			parent::__construct($db, 'receiver_messages_profile');
			
			//echo "<br/>here at profile construct<br/>";
			
			if(strlen($message_id)>0)
			{
				$this->setMessageId($message_id);
			}
		}
		
		public function setMessageId($message_id)
		{
			$filters = array('message_id'=>$message_id);
			$this->_filters = $filters;
		}
		
	}
?>