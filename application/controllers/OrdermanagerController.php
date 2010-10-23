<?php
	/**account**
	*ALL account actions must be required to sign in!
	*/
	class OrdermanagerController extends CustomControllerAction
	{	
		/*init**********
		*initializes all the variables necessary for this control
		
		****************/
		public function init(){
			parent::init();
			$this->breadcrumbs->addStep('Ordermanager', $this->getUrl(null, 'account'));
		}
		
		/*init*********
		*checks to see if the user is logged in
		*loads all the shipping information of a user into a session variables
		***************/
		public function preDispatch(){					
			parent::preDispatch();	
			
		}
	
		/*index***********
		 * summary
		******************/
		public function indexAction(){
			
		}
		
		
		public function ordersAction(){
			$params=array();
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
			$this->view->user=$this->signedInUserSessionInfoHolder;
			$this->view->userRewardPoint=$this->userObject->reward_point;
			if(isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id)){
				$this->view->defaultShippingKey = $this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id;
			}
			else{
				echo "there is no default shipping key set in session variable";
			}
			$this->breadcrumbs->addStep('Orders', $this->getUrl('Orders', 'account'));
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$orders = DatabaseObject_Helper_Ordermanager::retrieveOrdersForUser($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID, $params);
			Zend_Debug::dump($orders);
			
			$this->view->orders = $orders;
			
		}
		
		//this is only available to sellers
		public function soldordersAction(){
			
			
			$params=array();
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
			$this->view->user=$this->signedInUserSessionInfoHolder;
			$this->view->userRewardPoint=$this->userObject->reward_point;
			if(isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id)){
				$this->view->defaultShippingKey = $this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id;
			}
			else{
				echo "there is no default shipping key set in session variable";
			}
			$this->breadcrumbs->addStep('Orders', $this->getUrl('Orders', 'account'));
			$ip=$_SERVER['REMOTE_ADDR'];
			if($this->signedInUserSessionInfoHolder->generalInfo->user_type=='generalSeller'||$this->signedInUserSessionInfoHolder->generalInfo->user_type=='storeSeller'){
				
				$itemsSold = DatabaseObject_Helper_Ordermanager::retrieveOrdersForSeller($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID, $params);
				Zend_Debug::dump($itemsSold);
				$this->view->itemsSold=$itemsSold;
			}
		}
		
		public function addtrackingtoproductAction(){
			
				$request = $this->getRequest();
				$this->productId = $request->getParam('productId');
				$this->productTrackingInfo=$request->getParam('productTracking');
				$this->productTrackingCarrier = $request->getParam('productCarrier');
				if($this->productId=='' ||!is_numeric($this->productId)|| $this->productTrackingInfo=='' || $this->productTrackingCarrier==''){
					$this->messenger->addMessage('We are very sorry, there is an error with this request.');
					$this->_redirect($_SERVER['HTTP_REFERER']);
				}
				
				$product = new DatabaseObject_OrderProfile($this->db);
				if($product->load($this->productId)){
					if($product->orderStatus->order_status=='UNSHIPPED'){
						echo 'here at time good';
						echo 'product loaded<br />';
						echo 'product loaded ID: '.$product->product_UserId;
						echo 'user session is:'. $this->signedInUserSessionInfoHolder->generalInfo->userID;
						if($product->uploader_id == $this->signedInUserSessionInfoHolder->generalInfo->userID){//update tracking info
						echo 'user session is:'. $this->signedInUserSessionInfoHolder->generalInfo->userID;
						//$product->
						echo 'tracking saved to product<br />';
						echo 'carrier registered<br />';
						echo 'product status need to be changed';
						
						$product->orderStatus->product_tracking = $this->productTrackingInfo;
						$product->orderStatus->product_tracking_carrier = $this->productTrackingCarrier;
						$product->orderStatus->product_shipping_date = date('Y-m-d G:i:s');
						echo 'time is: '.time();
						echo 'strtotime is: '.date('Y-m-d G:i:s');
						$product->orderStatus->order_status = 'SHIPPED';
						if($product->orderStatus->save()){
							//updateing the status of this order.
							DatabaseObject_Helper_Admin_OrderManager::updateStatusTracking($this->db, $this->productId, 'SHIPPED');
							
						}
						
						//$product->save();
						$this->messenger->addMessage('thank you, your tracking information has been updated');
						$this->_redirect($_SERVER['HTTP_REFERER']);
						}else{
							$this->messenger->addMessage( 'you do not have permission to edit tracking for this product');
							$this->_redirect($_SERVER['HTTP_REFERER']);
						}
					}else{
						$this->messenger->addMessage(
						'we are sorry, but you have already entered a tracking info for this item We are sorry, your order is late for delivery. and the Buyer has issued a refund. you may confirm the returned items inorder for the buyer to be refunded after you have received the returned items. Thank you very much.');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}
				}
			//echo $this->signedInUserSessionInfoHolder->generalInfo->user_type;
		}
		
		
		//must be shipped, 
		public function addtrackingtoreturnproductAction(){
			
				$request = $this->getRequest();
				$this->productId = $request->getParam('returnProductId');
				$this->productTrackingInfo=$request->getParam('returnProductTracking');
				$this->productTrackingCarrier = $request->getParam('returnProductCarrier');
				if($this->productId=='' ||!is_numeric($this->productId) || $this->productTrackingInfo=='' || $this->productTrackingCarrier==''){
					$this->messenger->addMessage('We are very sorry, there is an error with this request.');
					$this->_redirect($_SERVER['HTTP_REFERER']);
				}
				
				$product = new DatabaseObject_OrderProfile($this->db);
				if($product->load($this->productId)){
					//strtotime ($product->product_latest_delivery_date)>time() this is how you check for time difference.
					if($product->orderStatus->order_status=='DELIVERED'){
						echo 'here at time good';
						echo 'product loaded<br />';
						echo 'product loaded ID: '.$product->product_UserId;
						echo 'user session is:'. $this->signedInUserSessionInfoHolder->generalInfo->userID;
						if($product->buyer_id == $this->signedInUserSessionInfoHolder->generalInfo->userID){//update tracking info
						echo 'user session is:'. $this->signedInUserSessionInfoHolder->generalInfo->userID;
						//$product->
						echo 'tracking saved to product<br />';
						echo 'carrier registered<br />';
						echo 'product status need to be changed';
						
						$product->orderStatus->product_return_tracking = $this->productTrackingInfo;
						$product->orderStatus->product_return_tracking_carrier = $this->productTrackingCarrier;
						$product->orderStatus->product_return_shipping_date = date('Y-m-d G:i:s');
						echo 'time is: '.time();
						echo 'strtotime is: '.date('Y-m-d G:i:s');
						$product->orderStatus->order_status = 'RETURN_SHIPPED';
						$product->orderStatus->product_returned=1;
						if($product->orderStatus->save()){
							//now processing status tracking
							DatabaseObject_Helper_Admin_OrderManager::updateStatusTracking($this->db, $this->productId, 'RETURN_SHIPPED');
							
							
							//now processing reviews for a returned product.
							$rating = $request->getParam('buyerExperienceRating');			
							$productReview = $request->getParam('returnReason');
							$product_user = new DatabaseObject_User($this->db);
							$product_user->load($product->uploader_id);
							$review = new DatabaseObject_UserReview($this->db);
							$review->rating = $rating;
							$review->description = $productReview;
							$review->order_profile_id = $product->getId();
							$review->order_unique_id = $product->order_unique_id;
							$review->order_product_name = $product->product_name;
							$review->User_id = $product->uploader_id;
							$product_user->review_count = $product_user->review_count+1;
							$product_user->review_total_score = $product_user->review_total_score+$rating;
							$product_user->review_average_score = $product_user->review_total_score/($product_user->review_count+1);
							$product_user->save();
							$review->save();
							
						}
						
						//$product->save();
						$this->messenger->addMessage('thank you, your tracking information has been updated');
						$this->_redirect($_SERVER['HTTP_REFERER']);
						}else{
							$this->messenger->addMessage( 'you do not have permission to edit tracking for this product');
							$this->_redirect($_SERVER['HTTP_REFERER']);
						}
					}else{
						$this->messenger->addMessage(
						'We are sorry, your order is late for delivery. and the Buyer has issued a refund. you may confirm the returned items inorder for the buyer to be refunded after you have received the returned items. Thank you very much.');
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}
					
				}
			//echo $this->signedInUserSessionInfoHolder->generalInfo->user_type;
		}
		
		public function writereviewAction()
		{
			$request = $this->getRequest();
			$productId = $request->getParam('productId');
			$rating = $request->getParam('starRating');			
			$productReview = $request->getParam('productReview');
			if($productId=='' || $productReview==''){
				$this->messenger->addMessage('Oops, there is an error with this request');
				echo 'badd stuff1';
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}else{
				$product = new DatabaseObject_OrderProfile($this->db);
				if($product->load($productId)){
					if(($product->buyer_UserID==$this->signedInUserSessionInfoHolder->generalInfo->userID)&&$product->product_order_status=='order completed' && $product->product_returned==0&&$product->seller_review_written!=1){
						$product_user = new DatabaseObject_User($this->db);
						$product_user->load($product->product_UserId);
						$review = new DatabaseObject_UserReview($this->db);
						$review->rating = $rating;
						$review->description = $productReview;
						$review->order_profile_id = $productId;
						$review->order_unique_id = $product->order_unique_id;
						$review->order_product_name = $product->product_name;
						$review->User_id = $product->product_UserId;
						$product_user->review_count = $product_user->review_count+1;
						$product_user->review_total_score = $product_user->review_total_score+$rating;
						$product_user->review_average_score = $product_user->review_total_score/($product_user->review_count+1);
						$product_user->save();
						$review->save();
						$product->seller_review_written=1;
						$product->save();
						echo 'here';
						//add reward points.
						DatabaseObject_Helper_UserManager::addRewardPointToUser($this->db, $this->signedInUserSessionInfoHolder->generalInfo->referee_id, '8', 'review written for product: '.$product->product_name.'from order: '.$product->order_unique_id, $_SERVER['REMOTE_ADDR'], $this->signedInUserSessionInfoHolder->generalInfo->username, $this->signedInUserSessionInfoHolder->generalInfo->userID, $this->signedInUserSessionInfoHolder->generalInfo->referee_id);
						echo 'here2';
						//$this->messenger->addMessage('thank you for your review. you have been rewarded the the appropriate reward points: '.$review->rating);
						$this->_redirect($_SERVER['HTTP_REFERER']);

					}else{
					$this->messenger->addMessage('We are sorry, but you are not able to write a review for this product order');
					echo 'sorry, bad stuff';
					$this->_redirect($_SERVER['HTTP_REFERER']);
					}
				}
			}
		}
		
		//can only cancel when it is unshipped, past absolute latest shipping date, and the buyer matches the current signed in user. 
		public function ordercancellationbybuyerAction(){
			$request=$this->getRequest();
			$cancellation_reason = $request->getParam('cancellationReason');
			$productId = $request->getParam('productId');
			$product = new DatabaseObject_OrderProfile($this->db);
			if($product->load($productId)){
				if(($product->buyer_UserID == $this->signedInUserSessionInfoHolder->generalInfo->userID) &&$product->product_order_status =='unshipped' && (strtotime($product->product_absolute_latest_delivery_date)<time())){
					echo 'here';
					$product->product_order_status ='Cancelled by buyer';
					$product->cancellation_reason = $cancellation_reason;
					$product->save();
					$this->messenger->addMessage('You have successfully cancelled this order. The seller will be notified');
					$this->_redirect($_SERVER['HTTP_REFERER']);
				}else{
					echo 'sorry but you are not able to cancel this order';	
				}
			}
		}
		
		
		public function viewAction()
		{	
			//transfer to url system when things gets too busy. so customers can check their things
		}
		
		public function verificationAction()
		{
			
		}
			
		public function productstatAction()
		{
			
		}
				
		public function testAction()
		{
			
		}	
		
		
		//this is a public ordermanager action where people can check their order without signing in and stuff. uses the order_unique_id
		public function orderquickviewAction(){
			
			
		}
	}
?>