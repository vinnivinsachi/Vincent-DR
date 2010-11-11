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
	public function getColumns(array $options = null) {
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
		if(count($result) > 1) throw new Exception('More than one user with the same primary key: '.$id);
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
	
	// can save an array, or just one object
	public function save($objects) {
		if(is_array($objects)) {
			$returnValues = array();
			foreach($objects as $object) $returnValues[] = $this->saveOne($object);
			return $returnValues;
		}
		else return $this->saveOne($objects);
	}
	protected function saveOne($object) {
		// make sure the right type of model was provided
		if(get_class($object) != $this->_modelClass) throw new Exception('Incorrect type of object provided');
		
		$primaryKey = $this->getPrimaryKey();
		
		// if primary key is an empty string, make it null instead (or else ->insert() methods won't return the promary key)
		if($object->$primaryKey == '') $object->$primaryKey = null;
		
		$data = array();
		foreach($this->_columns as $key => $value) {
			if(isset($object->$key)) $data[$key] = $object->$key;
		}
		
		// Add a new object, or update and existing one
		if(($id = $object->$primaryKey) === null) return $this->getDbTable()->insert($data);
		else return $this->getDbTable()->update($data, array("$primaryKey = ?" => $id));
	}
	
	public function delete($id) {
		$primaryKey = $this->getPrimaryKey();
		$where = $this->getDbTable()->getAdapter()->quoteInto($primaryKey.' = ?', $id);
		return $this->getDbTable()->delete($where);
	}

}
