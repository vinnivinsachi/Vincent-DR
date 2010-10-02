<?php

	class DatabaseObject_Helper_Admin_OrderManager extends DatabaseObject
	{
		
		public static function loadAllOrderProfiles($db, $type=null, $date=null){
			$select=$db->select();
			$select->from(array('s'=>'order_profile_status_and_delivery'),'*');
			if($type!=null){
			$select->where('s.order_status = ?', $type);
			}
			$select->join(array('o'=>'order_profile'),'s.order_profile_id = o.order_profile_id');
			//date is only specified when durin admin order process
			if($date!=null){
				if($type=='DELIVERED')
				$select->where('s.product_latest_delivery_date >= ?', $date);
				elseif($type=='RETURN_DELIVERED')
				$select->where('s.product_return_latest_delivery_date >= ?', $date);	
			}
			
			$select->order('product_latest_delivery_date DESC');

			$result = $db->fetchAll($select);
			//echo $select;
			//Zend_Debug::dump($result);
			
			return $result;
		}
		
		
		
		public static function changeOrderStatus($db, $date){
			
			$data = array('product_order_status'=>'completed',
						  'order_profile_completion_date'=>$date);
			
			$db->update('orders_profile', $data, "late_delivery_confirmation_date <= '".$date."' AND product_order_status = 'delivered'");
			
			$data = array('product_order_status'=>'return completed',
						  'order_profile_return_completion' =>$date);
			$db->update('orders_profile', $data, "late_return_delivery_confirmation_date <= '".$date."' AND product_order_status = 'return delivered'");
			
		}
		
	
	}
?>