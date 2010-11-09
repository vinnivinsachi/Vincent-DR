<?php 

	class DatabaseObject_TestObject extends DatabaseObject
	{
		public function __construct($db)
		{
			parent::__construct($db, 'users', 'userID');
			
			$this->add('username');
			$this->add('password');
			$this->add('email');
			$this->add('first_name');
			$this->add('last_name');
			$this->add('user_type', 'member');
			$this->add('status', 'D');
			$this->add('verification', 'unverified');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->add('ts_last_login', null, self::TYPE_TIMESTAMP);
		}
		
		
		public function echoString()
		{
			return 'echo string';
		}
	}
?>