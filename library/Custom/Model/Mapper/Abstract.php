<?php

abstract class Custom_Model_Mapper_Abstract
{

	protected $_dbTable;
	// protected $_dbTableClass; Should be set in child class
	
	protected function setDbTable($dbTable) {
		if(is_string($dbTable)) $dbTable = new $dbTable();
		if(!$dbTable instanceof Zend_Db_Table_Abstract) throw new Exception('Invalid table data gateway provided');
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	protected function getDbTable() {
		if($this->_dbTable === null) $this->setDbTable($this->_dbTableClass);
		return $this->_dbTable;
	}

}

?>