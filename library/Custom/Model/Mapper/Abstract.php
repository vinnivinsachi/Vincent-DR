<?php

abstract class Custom_Model_Mapper_Abstract
{

	//abstract protected $_dbTableClass = array(); NEED TO DEFINE IN CHILD CLASS
	//abstract protected $_modelClass; NEED TO DEFINE IN CHILD CLASS
	
	protected $_dbTable;
	protected $_columns;
	
	public function __construct() {
		if(!isset($this->_dbTableClass)) throw new Exception('You must set $_dbTableClass in your model: '.get_class($this));
		if(!isset($this->_modelClass)) throw new Exception('You must set $_modelClass in your model: '.get_class($this));
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
	protected function getPrimaryKeyColumn() {
		$primaryKeyColumn = $this->getDbTable()->info('primary');
		return $primaryKeyColumn[1];
	}
		
	// return an array of column names to include in select statement
	// $options should be an array containing a key of either 'include' or 'exclude'
	// the values of these two keys should be an array containing column names
	public function getColumns(array $options = null) {
		// start with all columns
			$columns = array();
			foreach($this->_columns as $key => $value) $columns[] = $key;
			$availableColumns = $columns; // all the columns that could be included
		
		if(is_array($options)) {
			if(isset($options['include']) && is_array($options['include'])) {
				$columns = array(); // start with no columns
				$object = new $this->_modelClass; // create an object to check properties against
				foreach($options['include'] as $key => $col) {
					if(array_search($col, $availableColumns)) $columns[] = $col;
				}
			}
			if(isset($options['exclude']) && is_array($options['exclude'])) {
				foreach($options['exclude'] as $col) {
					if($index = array_search($col, $columns)) unset($columns[$index]);
				}
			}
		}
				
		// make sure the primary key column is incuded, or else saving changes won't work
			$primaryKeyColumn = $this->getPrimaryKeyColumn();
			if(array_search($primaryKeyColumn, $columns) === false) $columns[] = $primaryKeyColumn;
		
		return $columns;
	}
	
	public function find($id, array $options = null) {
		// get columns to pull
			$columns = $this->getColumns($options);
				
		// what's the primary ID column?
			$idColumn = $this->getPrimaryKeyColumn();
			
		// build select statement
			$select = $this->getDbTable()->select();
			$select->from($this->getDbTable(), $columns)
				   ->where("$idColumn = ?", $id);
		
		// fetch
			$result = $this->getDbTable()->fetchAll($select);
			
		// should never be more than one user for a single ID
			if(count($result) > 1) throw new Exception('More than one user with the same primary key: '.$id);
			
		// return null if nothing found
			if(count($result) == 0) return null; // return null if nothing found
			
		// get row
			$row = $result->current();
			
			
		// get dependant data if specified
//$options['dependentTables'][] = array(
//	'table'		=> new Application_Model_DbTable_Users_ShippingAddresses,
//	'relationship'	=> 'User',
//	'columns'	=> array('addressOne', 'addressTwo'),
//);
//			
//			if(isset($options['dependentTables'])) {
//				foreach($options['dependentTables'] as $dependent) {
//					$otherTable = $dependent['table'];
//					$select = $otherTable->select()->from($otherTable, $dependent['columns']);
//					$rowset = $row->findDependentRowset($otherTable, $dependent['relationship'], $select);
//					Zend_Debug::dump($rowset->toArray());
//				}
//			}

		
		// inset data into model
			$rowData = $row->toArray();
			$object = new $this->_modelClass($rowData);
			
		// return results
			return $object;
	}
	
	// search for a single entry depending on the given columna and value
	// throws an exception is more than on entry is found
	// *should be used for finding things by a unique index
	// returns null or the appropriate Model
	public function findByColumn($column, $search, array $options = null) {
		// filter columns
			$columns = $this->getColumns($options);
		
		// build select statement
			$select = $this->getDbTable()->select();
			$select->from($this->getDbTable(), $columns)
				   ->where("$column = ?", $search);

		// query the database
			$rowSet = $this->getDbTable()->fetchAll($select);
			
		// get all results in an array
			$rowArray = $rowSet->toArray();
		
		// return null if nothing found
			if(count($rowArray) == 0) return null;
		
		// only one object should be found / returned by this method
			if(count($rowArray) > 1) throw new Exception('More than result found in table: '.$this->getDbTable()->info('name')." where $column = $search");
		
		// get the info and construct an object
			$object = new $this->_modelClass($rowArray[0]);
			
		// return the single object
			return $object;

	} // END fundByColumn()
	
	// search for multiple entries inthe tables depending on the given column and value
	// OK to find one or more entries
	// returns null or an array of the appropriate Model
	public function fetchByColumn($column, $search, array $options = null) {
		// filter columns
			$columns = $this->getColumns($options);
		
		// build select statement
			$select = $this->getDbTable()->select();
			$select->from($this->getDbTable(), $columns);
		
		// if $search is an array
			if(is_array($search)) $select->where("$column IN (?)", $search);
		// else	
			else  $select->where("$column = ?", $search);
		
		// query the database
			$resultSet = $this->getDbTable()->fetchAll($select);
		
		// construct an array of appropriate Models
			$objects = array();
			foreach($resultSet as $row) {
				$rowData = $row->toArray();
				$object = new $this->_modelClass($rowData);
				$objects[] = $object;
			}
			
		// return null if nothing was found
			if(count($objects) == 0) return null;
			
		// return an array of Models
			return $objects;
			
	} // END fetchByColumn()
	
	public function loadByQuery($query){
		$resultSet = $this->getDbTable()->fetchAll($query);
		if(count($resultSet) == 0) return null; // return null if nothing found
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
		
		// get primary key column name
			$primaryKey = $this->getPrimaryKeyColumn();
		
		// if primary key is an empty string, make it null instead (or else ->insert() methods won't return the promary key)
			if($object->$primaryKey == '') $object->$primaryKey = null;
		
		// put the object data in an array
			$data = array();
			foreach($this->_columns as $key => $value) {
				if(isset($object->$key)) $data[$key] = $object->$key;
			}
		
		// Add a new object, or update and existing one

			if(($id = $object->$primaryKey) === null) return $this->getDbTable()->insert($data);
			else{
				$this->getDbTable()->update($data, array("$primaryKey = ?" => $id));
				return $id;
			}
			
	}
	
	public function delete($id) {
		$primaryKey = $this->getPrimaryKeyColumn();
		$where = $this->getDbTable()->getAdapter()->quoteInto($primaryKey.' = ?', $id);
		return $this->getDbTable()->delete($where);
	}

	public function createUniqueID() {
		// make sure the associated model and dbtable have a uniqueID property
			$model = new $this->_modelClass;
			if(!property_exists($this->getDbTable(), 'uniqueIDColumn')) throw new Exception('The DbTable '.get_class($this->getDbTable()).' must have a uniqueIDColumn to create a uniqueID');
			if(!property_exists($model, $this->getDbTable()->uniqueIDColumn)) throw new Exception('The model '.$this->_modelClass.' must have the property: '.$this->getDbTable()->uniqueIDColumn.' to create a uniqueID');
		
		do {
			$uniqueID = Text_Password::create(10, 'unpronounceable');
		} while($this->findByUniqueID($uniqueID));
		return $uniqueID;
	}

	public function findByUniqueID($uniqueID, array $options = null) {
		$objects = $this->findByColumn($this->getDbTable()->uniqueIDColumn, $uniqueID, $options);
		if(count($objects) == 0) return null;
		if(count($objects) > 1) throw new Exception('More than one object found with the uniqueID: '.$uniqueID);
		return $objects[0];
	}

}
