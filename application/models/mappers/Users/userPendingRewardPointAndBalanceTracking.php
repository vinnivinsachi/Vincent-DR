<?php

class Application_Model_Mapper_Users_UserPendingRewardPointAndBalanceTracking extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Users_UserPendingRewardPointAndBalanceTracking';
	protected $_modelClass = 'Application_Model_Users_UserPendingRewardPointAndBalanceTracking';

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
	
	public function save(Application_Model_Users_UserPendingRewardPointAndBalanceTracking $pendingTracking){
		//new pendingTrackingDefaults
		if(($uniqueID = $pendingTracking->userPendingRewardPointAndBalanceTrackingUniqueID) === null) {
			$pendingTracking->dateCreated = date('Y-m-d H:i:s');
			
			//this requirs that the abstract method to support the createUniqueID() methods. 
			$pendingTracking->userPendingRewardPointAndBalanceTrackingUniqueID = $this->createUniqueID();
		}
		
		return parent::save($pendingTracking);
	}
	
	
	
}
?>