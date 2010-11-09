<?php
	class DatabaseObject_Affiliation extends DatabaseObject
	{
		protected $memberID;
		protected $clubID;
		
		protected $affiliationKey;
		public function __construct($db)
		{
			parent::__construct($db, 'affiliation', 'affiliation_key');
		
			
			$this->add('member_id');
			$this->add('clubAdmin_id');
			$this->add('status', 'pending');
			$this->add('affiliation_key', md5(uniqid(rand(), true)));
			$this->add('date_approved', time(), self::TYPE_TIMESTAMP);
		}
		
		
		public function setAffiliation($memberID, $clubID)
		{
			$this->member_id = $memberID;
			$this->clubAdmin_id = $clubID;
		}
		
		
		public function checkAffiliation($memberID, $clubID)
		{
			$select =$this->_db->select();
			
			$select->from('affiliation', '*')
				   ->where('member_id = ?', $memberID)
				   ->where('clubAdmin_id =?', $clubID);
				  // ->where('status = ?', 'confirmed');
				   
			$return = $this->_db->fetchAll($select);
			
			if(count($return) ==0)
			{
				return false;
			}
			elseif(count($return)>0)
			{
				return true;
			}
		
		}
		
		public static function loadMemberAffiliation($db, $memberID, $status='')
		{
			$select =$db->select();
			
			$select->from('affiliation', '*')
				   ->where('member_id = ?', $memberID);
				   
			if($status!='')
			{
				$select->where('status = ?', $status);
			}
				   
			return $db->fetchAll($select);
		}
		
		
		public static function loadClubAffiliation($db, $clubID, $status='')
		{
			$select =$db->select();
			
			$select->from('affiliation', '*')
				   ->where('clubAdmin_id = ?', $clubID);
				   
			if($status!='')
			{
				$select->where('status = ?', $status);
			}
			
			return $db->fetchAll($select);
		}
		
		
		
		public static function removeAffiliation($db, $clubID, $memberID)
		{
			$select=$db->select();
			
			
			$select->from('affiliation', 'affiliation_key')
				   ->where('clubAdmin_id = ?', $clubID)
				   ->where('member_id = ?', $memberID);
				   
			$result = $db->fetchAll($select);
			
			
			$where[] = "affiliation_key = '".$result[0]['affiliation_key']."'";
			
			return $db->delete('affiliation', $where);
		}	
		
		
		public static function confirmAffiliation($db, $clubID, $memberID)
		{	
			
			$data = array('status' => 'confirmed');
			
			$where[]="clubAdmin_id = '".$clubID."'";
			$where[]="member_id = '".$memberID."'";
			
			return $db->update('affiliation', array('status' => 'confirmed'), $where);			
		}
			
		

	}
?>