<?php

abstract class Custom_Model_Mapper_Abstract
{

	//abstract protected $_dbTableClass = array(); NEED TO DEFINE IN CHILD CLASS
	//abstract protected $_modelClass; NEED TO DEFINE IN CHILD CLASS
	
	protected $_dbTable;
	protected $_columns;
	
	public function __construct() {
		$this->_columns = get_object_vars(new $this->_modelClass);
	}
	
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
	
	// get the name of the primary key column of the associated table
	private function getPrimaryKey() {
		$primaryKey = $this->getDbTable()->info('primary');
		return $primaryKey[1];
	}
	
	// return an array of column names to include in select statement
	// $options should be an array containing a key of either 'include' or 'exclude'
	// the values of these two keys should be an array containing column names
	protected function getColumns(array $options = null) {
		// start with all columns
		$columns = array();
		foreach($this->_columns as $key => $value) $columns[] = $key;
		
		if(is_array($options)) {
			if(isset($options['include']) && is_array($options['include'])) $columns = $options['include'];
			if(isset($options['exclude']) && is_array($options['exclude'])) {
				foreach($options['exclude'] as $col) {
					if($index = array_search($col, $columns)) unset($columns[$index]);
				}
			}
		}
		
		// make sure the primary key column is incuded, or else saving changes won't work
		$primaryKey = $this->getPrimaryKey();;
		if(!array_search($primaryKey, $columns)) $columns[] = $primaryKey;
		
		return $columns;
	}
	
	public function find($id, array $options = null) {
		$columns = $this->getColumns($options);
		
		$idColumn = $this->getPrimaryKey();
		$select = $this->getDbTable()->select();
		$select->from($this->getDbTable(), $columns)
			   ->where("$idColumn = ?", $id);
		
		$result = $this->getDbTable()->fetchAll($select);
		if(count($result) == 0) return null; // return null if nothing found
		if(count($result) > 1) exit('More than one user with the same primary key: '.$id);
		$row = $result->current();
		$rowData = $row->toArray();
		$object = new $this->_modelClass($rowData);
		return $object;
	}
	
	public function findByColumn($column, $search, array $options = null) {
		$columns = $this->getColumns($options);
		
		$select = $this->getDbTable()->select();
		$select->from($this->getDbTable(), $columns)
			   ->where("$column = ?", $search);
		
		$resultSet = $this->getDbTable()->fetchAll($select);
		$objects = array();
		foreach($resultSet as $row) {
			$rowData = $row->toArray();
			$object = new $this->_modelClass($rowData);
			$objects[] = $object;
		}
		return $objects;
	}
	
	public function fetchAll(array $options = null) {
		$columns = $this->getColumns($options);
		
		$select = $this->getDbTable()->select();
		$select->from($this->getDbTable(), $columns);
		
		$resultSet = $this->getDbTable()->fetchAll($select);
		$objects = array();
		foreach($resultSet as $row) {
			$rowData = $row->toArray();
			$object = new $this->_modelClass($rowData);
			$objects[] = $object;
		}
		return $objects;
	}
	
	protected function save($object) {
		// make sure the right type of model was provided
		if(get_class($object) != $this->_modelClass) throw new Exception('Incorrect type of object provided');
		
		$data = array();
		foreach($this->_columns as $key => $value) {
			if(isset($object->$key)) $data[$key] = $object->$key;
		}
		
		$primaryKey = $this->getPrimaryKey();
		
		// Add a new object, or update and existing one
		if(($id = $object->$primaryKey) === null) $this->getDbTable()->insert($data);
		else $this->getDbTable()->update($data, array("$primaryKey = ?" => $id));
	}

}

