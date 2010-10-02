<?php

	class DatabaseObject_Helper_Communication extends DatabaseObject
	{
		public static function retriveShoutOutForProduct($db, $product_id)
		{
			$select=$db->select();
			$select->from(array('s'=>'product_shoutouts'), '*')
					->where('product_id = ?', $product_id)
					->order('ts_created DESC');
			//echo $select;
			return $db->fetchAll($select);
		}
		
		public static function retrieveShoutOutMessagesForUser($db, $user_id){
			$select = $db->select();
			$select->from(array('s'=>'product_shoutouts'), '*')
				   ->where('shoutout_user_id = ?', $user_id)
				   ->orwhere('s.uploader_id = ?', $user_id)
				   ->order('s.ts_created DESC')
				   ->join(array('p'=>'products'), 's.product_id = p.product_id');
				   
				   //->order(array( 'product_id DESC', 'ts_created DESC' ));
				   
			//echo $select;
			return $db->fetchAll($select);
			
		}
		
		public static function retrieveMessagesForUser($db, $user_id, $messageBox){
			$select = $db->select();
			if($messageBox == 'inbox'){
				$select->from(array('m'=>'receiver_message'), '*')
				   ->where('receiver_email = ?', $user_id)
				   ->order('ts_created DESC');
			}elseif($messageBox=='outbox'){
				$select->from('sender_message', '*')
				   ->where('sender_email = ?', $user_id)
				   ->order('ts_created DESC');
			}
				   //->order(array( 'product_id DESC', 'ts_created DESC' ));
			//echo $select;
			return $db->fetchAll($select);
		}
	}
?>