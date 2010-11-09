<?php

class Application_Model_Mapper_Users_UserDetailsMapper extends Custom_Model_Mapper_Abstract
{
	protected $_dbTableClass = 'Application_Model_DbTable_Users_UserDetails';
	
	public function save(Application_Model_Users_UserDetails $details) {
		$data = array(
			'userID'		=> $details->userID,
			'referralID'	=> $details->referralID,
			'refereeID'	=> $details->refereeID,
			'email'	=> $details->email,
			'sex'	=> $details->sex,
			'measurement'	=> $details->measurement,
			'firstName'	=> $details->firstName,
			'lastName'	=> $details->lastName,
			'isInstructor'	=> $details->isInstructor,
			'findingPartner'	=> $details->findingPartner,
			'status'	=> $details->status,
			'rewardPoints'	=> $details->rewardPoints,
			'verification'	=> $details->verification,
			'typeID'	=> $details->typeID,
			'reviewCount'	=> $details->reviewCount,
			'reviewAverageScore'	=> $details->reviewAverageScore,
			'reviewTotalScore'	=> $details->reviewTotalScore,
		);
		
		// update details
		$this->getDbTable()->update($data, array('userID = ?' => $details->userID));
	}
	
	public function getDetailsForUser(Application_Model_Users_User $user) {
		$select = $this->getDbTable()->select();
		$select->where('userID = ?', $user->id);
		$result = $this->getDbTable()->fetchAll($select);
		if(count($result) == 0) return null;
		if(count($result) > 1) exit('More than one details for a single user, userID: '.$user->id);
		$row = $result->current();
		$detailsData = $row->toArray();
		$details = new Application_Model_Users_UserDetails($detailsData);
		$user->details = $details;
		return $details;
	}
	
	public function newDetailsForUserID($userID) {
		$data = array('userID'	=> $userID);
		$this->getDbTable()->insert($data);
	}

}

