<?php
	class EmailLogger extends Zend_Log_Writer_Abstract
	{
		protected $_email;
		protected $_events = array();
		
		
		public function __construct($email)
		{
			$this->_formatter = new Zend_Log_Formatter_Simple();
			$this->setEmail($email);
		}
		
		public function setEmail($email)
		{
			$validator = new Zend_Validate_EmailAddress();
			if(!$validator->isValid($email))
			{
				throw new Exception('Invalid e-mail address specified');
			}
			
			$this->_email = $email;
		}
		
		protected function _write($event)
		{
			$this->_events[]=$this->_formatter->format($event);
		}
		
		public function shutdown()
		{
			if(count($this->_events) == 0)
			{
				return;
			}
			
			$subject = sprintf('web site log messages(%d)', count($this->_events));
			
			$mail = new Zend_Mail();
			$mail->addTo($this->_email)
				 ->setSubject($subject)
				 ->setBodyText(join(' ', $this->_events))
				 ->send();
		}
		
    	static public function factory($config){}
		
	}
?>