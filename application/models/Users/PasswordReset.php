<?php

class Application_Model_Users_PasswordReset extends Custom_Model_Abstract
{
	// setup
	protected $_primaryIDColumn = 'resetID';
	protected $_mapperClass = 'Application_Model_Mapper_Users_PasswordResetsMapper';
	
	// columns
	public $resetID;
	public $userEmail;
	public $resetUniqueID;
	public $expiration;
	
}
