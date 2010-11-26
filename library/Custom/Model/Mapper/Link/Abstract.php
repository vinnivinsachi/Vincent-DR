<?php
// this mapper works with arrays rather than models
abstract class Custom_Model_Mapper_Link_Abstract extends Custom_Model_Mapper_Abstract
{
	// protected $_dbTableClass; NEED TO DEFINE IN CHILD CLASS
	// protected $_modelClass = 'Custom_Model_Links'; NEED TO DEFINE IN CHILD CLASS
	// protected $_firstMapperClass;
	// protected $_secondMapperClass;
	
	
	public function __construct() {
		parent::__construct();
		if(!isset($this->getDbTable()->firstIDColumn)) throw new Exception('You must set a firstIDColumn in the associated DbTable class: '.$this->_dbTableClass);
		if(!isset($this->getDbTable()->secondIDColumn)) throw new Exception('You must set a secondIDColumn in the associated DbTable class: '.$this->_dbTableClass);
		if(!isset($this->_firstMapperClass)) throw new Exception('You must set a _firstMapperClass in the Mapper: '.get_class($this));
		if(!isset($this->_secondMapperClass)) throw new Exception('You must set a _secondMapperClass in the Mapper: '.get_class($this));
	}
	
	// test whether or not a link between two ID's exists
	protected function findLink($firstID, $secondID, array $options = null) {
		// convert arguments to strings
			$firstID = (string) $firstID;
			$secondID = (string) $secondID;
		
		// get columns
			$columns = $this->getColumns($options);
			
		// get ID columns
			$firstIDColumn = $this->getDbTable()->firstIDColumn;
			$secondIDColumn = $this->getDbTable()->secondIDColumn;
			
		// build select statement
			$select = $this->getDbTable()->select();
			$select->from($this->getDbTable(), $columns)
				   ->where("$firstIDColumn = ?", $firstID)
				   ->where("$secondIDColumn = ?", $secondID);
		
		// query
			$links = $this->loadByQuery($select);
			
		// return result
			if($links == null) return false;
			else if(count($links) > 1) throw new Exception('Multiple rows with same link found in table: '.$this->getDbTable()->info('name'));
			else return $links[0];
	}
	
	// get all the secondID's for a given firstID
	protected function getLinksForFirstID($firstID, array $options = null) {
		return $this->findByColumn($this->getDbTable()->firstIDColumn, $firstID, $options);
	}
	
	// get all the firstID's for a given secondID
	protected function getLinksForSecondID($secondID, array $options = null) {
		return $this->findByColumn($this->getDbTable()->secondIDColumn, $secondID, $options);
	}
	
	// fetch link data and data of all first models associated with provided second model ID
	protected function fetchAllFirstsForSecondID($secondID, array $linkColumns = null, array $firstColumns = null) {			
		// get table names and primaryKeys
			$firstMapper = new $this->_firstMapperClass;
			$firstTable = $firstMapper->getDbTable();
			$firstIDColumn = array_shift($firstTable->info('primary'));
			$firstName = $firstTable->info('name');
			$secondMapper = new $this->_secondMapperClass;
			$secondTable = $secondMapper->getDbTable();
			$secondName = $secondTable->info('name');
			$linksTableName = $this->getDbTable()->info('name');
			$linkSecondIDColumn = $this->getDbTable()->secondIDColumn;
			$linkFirstIDColumn = $this->getDbTable()->firstIDColumn;
		
		$select = $this->getDbTable()->select();
		$select->from($this->getDbTable(), $linkColumns)
			   ->where("$linkSecondIDColumn = ?", $secondID)
			   ->join($firstName, "$linksTableName.$linkFirstIDColumn = $firstName.$firstIDColumn", $firstColumns)
			   ->setIntegrityCheck(false);
		
		return $this->loadByQuery($select);
	}
	
	// fetch link data and data of all second models associated with provided first model ID
	protected function fetchAllSecondsForFirstID($firstID, array $linkColumns = null, array $secondColumns = null) {			
		// get table names and primaryKeys
			$secondMapper = new $this->_secondMapperClass;
			$secondTable = $secondMapper->getDbTable();
			$secondIDColumn = array_shift($secondTable->info('primary'));
			$secondName = $secondTable->info('name');
			$firstMapper = new $this->_firstMapperClass;
			$firstTable = $firstMapper->getDbTable();
			$firstName = $firstTable->info('name');
			$linksTableName = $this->getDbTable()->info('name');
			$linkFirstIDColumn = $this->getDbTable()->firstIDColumn;
			$linkSecondIDColumn = $this->getDbTable()->secondIDColumn;
		
		$select = $this->getDbTable()->select();
		$select->from($this->getDbTable(), $linkColumns)
			   ->where("$linkFirstIDColumn = ?", $firstID)
			   ->join($secondName, "$linksTableName.$linkSecondIDColumn = $secondName.$secondIDColumn", $secondColumns)
			   ->setIntegrityCheck(false);
		
		return $this->loadByQuery($select);
	}
	
	
	// override abstract functions to make them unusable	
	public function createUniqueID() {
		throw new Exception('You cannot call the createUniqueID() method for a Profile');
	}

	public function findByUniqueID($uniqueID, array $options = null) {
		throw new Exception('You cannot call the findByUniqueID() method for a Profile');
	}

}
