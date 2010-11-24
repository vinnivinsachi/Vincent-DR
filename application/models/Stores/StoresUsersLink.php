<?php

class Application_Model_Stores_StoresUsersLink extends Custom_Model_Abstract
{
	// setup
	protected $_primaryIDColumn = 'linkID';
	protected $_mapperClass = 'Application_Model_Mapper_Stores_StoresUsersLinksMapper';
	
	// columns
	public $linkID;
	public $storeID;
	public $userID;
	public $linkRole;
	
	public function getFirstID() {
		return $this->storeID;
	}
	public function setFirstID($id) {
		$this->storeID = $id;
	}
	
	public function getSecondID() {
		return $this->userID;
	}
	public function setSecondID($id) {
		$this->userID = $id;
	}
	
}
