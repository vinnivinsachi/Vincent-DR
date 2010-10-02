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
		
	
	}
?>