<?php
// this mapper works with arrays rather than models
abstract class Custom_Model_Mapper_Profile_Abstract extends Custom_Model_Mapper_Abstract
{
	//abstract protected $_dbTableClass; NEED TO DEFINE IN CHILD CLASS
	protected $_modelClass;
	
	public function __construct() {
		parent::__construct();
		if(!isset($this->getDbTable()->associatedObjectIDColumn)) throw new Exception('You must set a associatedObjectIDColumn in the associated DbTable class');
	}
	
	// provide the id of the associated object
	// returns a Custom_Model_Profiles object with properties filled with key value pairs
	public function fetchByAssociatedID($id) {		
		$idColumn = $this->getDbTable()->associatedObjectIDColumn;

		$columns = array('profileKey', 'profileValue', $idColumn);
		
		$select = $this->getDbTable()->select();
		$select->from($this->getDbTable(), $columns)
			   ->where("$idColumn = ?", $id);
		
		$resultSet = $this->getDbTable()->fetchAll($select);
		$profiles = new $this->_modelClass();
		
		foreach($resultSet as $row) {
			$rowData = $row->toArray();
			$key = $row->profileKey;
			$profiles->$key = $row->profileValue;
		}
		
		return $profiles;
	}
	
	/* takes a Custom_Model_Profiles object and an associated object's id
	 * pulls each key / value pair from the Profiles object
	 * and compares to what's in the database to see if it already exists
	 * if it exists, it updates it
	 * if it's null, it deletes it from the database
	 * if it doesn't already exit in the database, it is created as a new row
	 * 
	 * @param	Custom_Model_Profile	$profiles
	 * @param	int						$id
	 */
	public function saveForAssociatedID($profiles, $id) {
		if(!get_class($profiles) == $this->_modelClass) throw new Exception('You must provide an object of type: '.$this->_modelClass.' to the save() method');
		
		// load the existing keys / values
		$currentProfiles = $this->fetchByAssociatedID($id);
		$currentProperties = $currentProfiles->getProperties();
		foreach($profiles->getProperties() as $key => $value) {
			if($value == null) $this->deleteKey($key, $id);
			else if(isset($currentProperties[$key])) $this->updateKey($key, $value, $id);
			else $this->saveNewKey($key, $value, $id);
		}
	}
	
	private function updateKey($key, $value, $id) {
		$data = array();
		$data['profileValue'] = $value;
		$associatedObjectIDColumn = $this->getDbTable()->associatedObjectIDColumn;
		$this->getDbTable()->update($data, array(
			'profileKey = ?' => $key,
			"$associatedObjectIDColumn = ?" => $id
		));
	}
	
	private function saveNewKey($key, $value, $id) {
		$data = array();
		$data['profileKey'] = $key;
		$data['profileValue'] = $value;
		$data[$this->getDbTable()->associatedObjectIDColumn] = $id;
		$this->getDbTable()->insert($data);
	}
	
	private function deleteKey($key, $id) {
		$associatedObjectIDColumn = $this->getDbTable()->associatedObjectIDColumn;
		$this->getDbTable()->delete(array(
			'profileKey = ?' => $key,
			"$associatedObjectIDColumn = ?" => $id
		));
	}
	
	
	
	// override abstract functions to make them unusable
	public function find($id, array $options = null) {
		throw new Exception('You cannot call the find() method for a Profile');
	}
	
	public function findByColumn($column, $search, array $options = null) {
		throw new Exception('You cannot call the fetchByColumn() method for a Profile');
	}
	
	public function loadByQuery($query){
		throw new Exception('You cannot call the loadByQuery() method for a Profile');
	}
	
	public function fetchAll(array $options = null) {
		throw new Exception('You cannot call the fetchAll() method for a Profile');
	}
	
	public function save($objects) {
		throw new Exception('You cannot call the save() method for a Profile');
	}
	
	public function createUniqueID() {
		throw new Exception('You cannot call the createUniqueID() method for a Profile');
	}

	public function findByUniqueID($uniqueID, array $options = null) {
		throw new Exception('You cannot call the findByUniqueID() method for a Profile');
	}

}
