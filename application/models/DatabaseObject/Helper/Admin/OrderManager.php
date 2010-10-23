<?php

	class DatabaseObject_Helper_Admin_OrderManager extends DatabaseObject
	{
		public static $orderStatusTrackingMessage = array('SHIPPED'=>'This product is now shipped and awaits for delivery.', 
											'DELIVERED'=>'This product is now delivered and will wait 7 days before it will be AUTOMATICALLY completed. Please confirm satisfaction or return this item by that time!', 
											'RETURN_SHIPPED'=>'This product is now return shipped and awaits for delivery to the seller',
											'RETURN_DELIVERED'=>'This product is now return delivered and will wait 3 days before it will be automatically completed. Please confirm satisfaction or file a claim by that time if you are the seller!',
											'ORDER_COMPLETED'=>'This order is now complete and awaits balance to be transfered to the seller&acute;s account.', 
											'RETURN_COMPLETED'=>'This order is now return completed and awaits balance to be refunded to the buyer&acute;s account.',
											'BALANCE_UPDATED'=>'The amount of this order had been updated.',
											'BALANCE_REFUNDED'=>'The amount of this order had been refunded.',
											'CANCELLED_BY_SELLER'=>'This order is now cancelled by the seller. The amount of this order will be refunded to the buyer.',
											'CANCELLED_BY_BUYER'=>'This order is now cancelled by the buyer. The amount of this order will be refunded to the buyer.',
											'HELD_BY_BUYER_FOR_ARBITRATION'=>'This order is now held for arbitration by the buyer and awaits DanceRialto approval.',
											'HELP_BY_SELLER_FOR_ARBITRATION'=>'This order is now held for arbitration by the seller and awaits DanceRialto approval.',
											'SELLER_CLAIM_APPROVED_UNSHIPPED'=>'DanceRialto had approved the sellers claim and the returned item from the buyer will now be able to be shipped back to the buyer.',
											'SELLER_CLAIM_APPROVED_RESHIPPED'=>'Seller had now shipped the returned item back to the buyer.',
											'SELLER_CLAIM_APPROVED_DELIVERED'=>'This item is now delivered back to the buyer and awaits for order completion.');
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
			
			foreach($result as $k => $v){
				$select2 = $db->select();
				$select2->from('order_profile_status_tracking', '*')
				->where('order_profile_id = ?', $v['order_profile_id'])
				->order('status_changed_date DESC');
				
				$result[$k]['statusTracking']= $db->fetchAll($select2);
				
			}
			//Zend_Debug::dump($result);
			
			return $result;
		}
		
		public static function retrieveOrderProfile($db, $id, $type){
			
				$select2=$db->select();
				$select2->from(array('o'=>'order_profile'),'*');
				if($type=='profile_id'){
				$select2->where('o.order_profile_id = ?', $id);
				}elseif($type=='order_unique_id'){
				$select2->where('o.order_unique_id = ?', $id);
				}
				$select2->join(array('s'=>'order_profile_status_and_delivery'),'s.order_profile_id = o.order_profile_id');
				//getting attributes
				
				$orderProfiles = $db->fetchAll($select2);
				$orderProfiles['orderInfo']=new DatabaseObject_Order($db);
				$orderProfiles['orderInfo']->load($orderProfiles[0]['order_id']);
				
				$select3=$db->select();
				$select3->from(array('pa'=>'order_profile_attribute'), '*')
				->where('pa.order_profile_attribute_id = ? ', $orderProfiles[0]['order_profile_id']);
				
				$orderProfiles['attributes']=$db->fetchAll($select3);
				
				//getting message tracking
				$MessageSelect=$db->select();
				$MessageSelect->from('sender_message' , '*')
				->where('sender_subject = ? ', 'orderID: '.$orderProfiles[0]['order_unique_id'])
				->where('product_id = ?', $orderProfiles[0]['product_id'])
				->order('ts_created DESC');
				//echo $MessageSelect.'<br />';
				$orderProfiles['sender_message'] = $db->fetchAll($MessageSelect);
				
				//getting seller information
				$orderProfiles['uploader_info'] = new DatabaseObject_user($db);
				$orderProfiles['uploader_info']->load($orderProfiles[0]['uploader_id']);
				$orderProfiles['uploader_info']->createSellerInfoSessionObject();
				
				$orderProfiles['buyer_info'] = new DatabaseObject_user($db);
				$orderProfiles['buyer_info']->load($orderProfiles[0]['buyer_id']);
				
				
				
				//Zend_Debug::dump($order->products);
				
			
			return $orderProfiles;
						
			
		}
		
		public static function retrieveStatusTracking($db, $profile_id){
			
			$select=$db->select();
			$select->from('order_profile_status_tracking', '*')
			->where('order_profile_id = ?', $profile_id)
			->order('status_changed_date DESC');
			
			
			echo $select;
			return $db->fetchAll($select);
		}
		
		public static function retrieveOrderSummaryFromOrderUniqueId($db, $id, $params=array()){
			$orderArray = array();
			$select=$db->select();
			$select->from('orders', '*')
					->where('order_unique_id = ?', $id)
					->order('ts_created DESC');
			//echo $select;
			$order= $db->fetchAll($select);
			
			$select2=$db->select();
				$select2->from(array('o'=>'order_profile'),'*')
				->where('o.order_id = ?', $order[0]['order_id'])
				->join(array('s'=>'order_profile_status_and_delivery'),'s.order_profile_id = o.order_profile_id');
			
			$order['profile']=$db->fetchAll($select2);
			
			foreach($order['profile'] as $k=>$v){
				
				$select3=$db->select();
				$select3->from(array('pa'=>'order_profile_attribute'), '*')
				->where('pa.order_profile_attribute_id = ? ', $order['profile'][$k]['order_profile_id']);
				$order['profile'][$k]['attributes']=$db->fetchAll($select3);
				
			}
			
			return $order;
		}
	
		public static function updateStatusTracking($db, $orderProfileId, $status, $buyerEmail='', $sellerEmail=''){
			$statusTracking=new DatabaseObject_OrderProfileStatusTracking($db);
			$statusTracking->order_profile_id=$orderProfileId;
			$statusTracking->status=$status;
			$statusTracking->message=self::$orderStatusTrackingMessage[$status];
			$statusTracking->save();
			
			//send out emails now to notify the buyer and seller. 
		}
	}
?>