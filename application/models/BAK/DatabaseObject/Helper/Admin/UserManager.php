<?php

	class DatabaseObject_Helper_Admin_UserManager extends DatabaseObject
	{
		
		public static function loadAllUsers($db, $type=null){
			$select=$db->select();
			$select->from('users','*');
			if($type!=null){
			$select->where('user_type = ?', $type);
			}
				
			$result = $db->fetchAll($select);
			//Zend_Debug::dump($result);
			
			return $result;
		}
		
		public static function loadAllWithdraws($db, $options=array()){
			
			$select= $db->select();
			$select->from(array('u' => 'users'), 'u.*')
			->join(array('w'=>'user_account_balance_withdraw_tracking'), 'u.userID = w.user_id')
			
			
			->order('date_of_request ASC');
			
			if(isset($options['status'])){
				$select->where('w.status = ?', $options['status']);	
			}
			
			echo $select.'<br/>';
			
			$result = $db->fetchAll($select);
			
			return $result;
			
		}
		
		public static function loadAllTransfers($db, $options=array()){
			$select= $db->select();
			$select->from(array('u'=>'users'), 'u.*')
			->join(array('t'=>'user_account_balance_transfer_tracking'), 'u.userID = t.from_user_id')
			->order('date_of_request ASC');
			
		
			if(isset($options['status'])){
				$select->where('t.status = ?', $options['status']);
			}
			
			echo $select.'<br/>';
			$result = $db->fetchAll($select);
			
			foreach($result as $k=>$v){
				$select2 =$db->select();	
				$select2->from('users', '*')
				->where('userID=?', $result[$k]['to_user_id']);
				
				$result[$k]['to_user'] = $db->fetchAll($select2);
			}
	
			return $result;
		}
		
	}
?>