<?php

class Application_Model_Mapper_Users_PasswordResetsMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Users_PasswordResets';
	protected $_modelClass = 'Application_Model_Users_PasswordReset';
	
	public function save(Application_Model_Users_PasswordReset $reset) {
		// create a uniqueID if it doesn't have one
			$uniqueIDColumn = $this->getDbTable()->uniqueIDColumn;
			if($reset->$uniqueIDColumn === null) $reset->$uniqueIDColumn = $this->createUniqueID();
			
		// set expiration date (30 minutes from now)
			$timeSpan = 60*30;
			$reset->expiration = date('Y-m-d H:i:s', time()+$timeSpan);
		
		// call the parent funciton
			return parent::save($reset);
	} // END save()
	
	public function findByEmailAndUniqueID($email, $uniqueID, array $options = null) {
		// get columns
			$columns = $this->getColumns($options);
		
		// build select
			$uniqueIDColumn = $this->getDbTable()->uniqueIDColumn;
			$select = $this->getDbTable()->select();
			$select->from($this->getDbTable(), $columns)
				   ->where("$uniqueIDColumn = ?", $uniqueID)
				   ->where('userEmail = ?', $email);
		
		// load from the database
			$reset = $this->loadByQuery($select);
			
		// return result
			return $reset[0];
	} // END findByEmailAndUniqueID()
	
}

