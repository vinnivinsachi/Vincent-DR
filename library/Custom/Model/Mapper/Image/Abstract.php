<?php
// this mapper works with arrays rather than models
// this need more work! it is not finished!
abstract class Custom_Model_Mapper_Image_Abstract extends Custom_Model_Mapper_Abstract
{
	
	public function __construct() {
		parent::__construct();
		
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
