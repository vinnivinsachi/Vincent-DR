<?php

class Application_Model_Mapper_Users_UserAccountBalanceWithdrawTracking extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Users_UserAccountBalanceWithdrawTracking';
	protected $_modelClass = 'Application_Model_Users_UserAccountBalanceWithdrawTracking';

	public function getPendingSummaryForUser(Application_Model_Users_User $user, array $options = null){
		return $this->findByColumn('userID', $user->userID, $options);	
	}
	
	public function loadUserPendingTrackingFromTrackingID(Application_Model_Users_User $user, $pendingTrackingId){
		
			$select = $this->getDbTable()->select();
			$select->from($this->getDbTable(), '*')
			->where('userID = ?', $user->userID)
			->where($this->getPrimaryKey()." = ?", $pendingTrackingId);
			echo $select;
			return $this->loadByQuery($select);
	}
	
	public function loadAllUserRecords(Application_Model_Users_User $user, $param=array()){
		$records=array();
		$select=$this->getDbTable()->select();
		$select->from($this->getDbTable(), '*')
		->where('userID = ?', $user->userID)
		->order('dateUpdated DESC');
		
		if(isset($param['beginDate'])){
			$select->where('dateCreated > ?', $param['beginDate']);
		}
		
		if(isset($param['endDate'])){
			$select->where('dateCreated < ?', $param['endDate']);
		}
		
		if(isset($param['limit'])){
			$select->limitPage($param['limit'],40);
		}
		echo '<br />record loader select: '.$select;
		
		return $this->getDbTable()->fetchAll($select);
	}	
	
	public function loadTrackingIdByColumnId(Application_Model_Users_User $user, $column, $id){
		$select=$this->getDbTable()->select();
		$select->from($this->getDbTable(), '*')
		->where('userID = ?', $user->userID)
		->where('status = ?', 'PENDING')
		->where("$column = ?", $id);
		
		echo $select;
		$result = $this->loadByQuery($select);
		return $result;
	}
	
	public function save(Application_Model_Users_UserAccountBalanceWithdrawTracking $pendingTracking){
		//new pendingTrackingDefaults
		if(($uniqueID = $pendingTracking->userAccountBalanceWithdrawTrackingID) === null) {
			$pendingTracking->dateCreated = date('Y-m-d H:i:s');
			$pendingTracking->dateUpdated=date('Y-m-d G:i:s');
			
			//this requirs that the abstract method to support the createUniqueID() methods. 
			$pendingTracking->userAccountBalanceWithdrawTrackingUniqueID = $this->createUniqueID();
		}
		
		return parent::save($pendingTracking);
	}
	
	public function createUniqueID() {
		do {
			$uniqueID = Text_Password::create(10, 'unpronounceable');
		} while($this->findByUniqueID($uniqueID));
		return $uniqueID;
	}
	
	public function findByUniqueID($uniqueID, array $options = null) {
		
		$column = $this->findByColumn('userAccountBalanceWithdrawTrackingUniqueID', $uniqueID, $options);
		if(count($column) == 0) return null;
		if(count($column) > 1) throw new Exception('More than one user with the uniqueID: '.$uniqueID);
		return $column[0];
	}
}
?>