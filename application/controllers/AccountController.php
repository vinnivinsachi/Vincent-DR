<?php
	/**account**
	*ALL account actions must be required to sign in!
	*/
	class AccountController extends CustomControllerAction
	{	
		/*init**********
		*initializes all the variables necessary for this control
		*heavily rely on $this->userObject instantiated and loaded in CustomController
		*uses $this->signedInUserSessionInfoHolder instantiated and loaded in customController
		*sets up breadcrumbs for all the actions
		****************/
		public function init(){
			parent::init();
			$this->breadcrumbs->addStep('Account', $this->getUrl(null, 'account'));
		}
		
		/*init*********
		*checks to see if the user is logged in
		*loads all the shipping information of a user into a session variables
		***************/
		public function preDispatch(){					
			parent::preDispatch();	
			if($this->auth->hasIdentity()){
				if(!isset($this->signedInUserSessionInfoHolder->generalInfo->shippingAddress)){
					$this->userObject->createShippingAddressInfoSessionObject($this->signedInUserSessionInfoHolder->generalInfo->shippingAddress);
				}
				$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
			} 
			//Zend_Debug::dump($_SERVER);
		}
	
		/*index***********
		*displays everything there is that is in the session variable
		******************/
		public function indexAction(){
		}
		
		public function messagesAction(){
			
			$this->view->signedInUser=$this->signedInUserSessionInfoHolder;
			$this->view->user=$this->signedInUserSessionInfoHolder;
			$this->view->userRewardPoint=$this->userObject->reward_point;
			if(isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id)){
				$this->view->defaultShippingKey = $this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id;
			}
			else{
				//echo "there is no default shipping key set in session variable";
			}
			$this->breadcrumbs->addStep('Details', $this->getUrl('details', 'account'));
			$ip=$_SERVER['REMOTE_ADDR'];
			echo "ip is: ".$ip;
			
			$allShoutBoxMessages = DatabaseObject_Helper_Communication::retrieveShoutOutMessagesForUser($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID);
			$this->view->allShoutBoxMessages = $allShoutBoxMessages;
			
			$inboxMessages = DatabaseObject_Helper_Communication::retrieveMessagesForUser($this->db, $this->signedInUserSessionInfoHolder->generalInfo->email, 'inbox');
			$this->view->inboxMessages = $inboxMessages;
			
			$outboxMessages = DatabaseObject_Helper_Communication::retrieveMessagesForUser($this->db, $this->signedInUserSessionInfoHolder->generalInfo->email, 'outbox');
			$this->view->outboxMessages = $outboxMessages;
		}
		
		
		/*details*
		*if there is a default address, then it sets default address
		*/
		public function detailsAction(){				
			//echo "here at dump variable: ".Zend_Debug::dump($this->signedInUserSessionInfoHolder->sellerInfo);
			$this->view->user=$this->signedInUserSessionInfoHolder;
			$this->view->userRewardPoint=$this->userObject->reward_point;
			
			if(isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id)){
				$this->view->defaultShippingKey = $this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id;
			}
			else{
				echo "there is no default shipping key set in session variable";
			}
			$rewardTracking = DatabaseObject_Helper_UserManager::loadRewardPointTracking($this->db, $this->signedInUserSessionInfoHolder->generalInfo->referee_id);
			$this->view->rewardPointTracking = $rewardTracking;
			$this->breadcrumbs->addStep('Details', $this->getUrl('details', 'account'));
			if($this->signedInUserSessionInfoHolder->generalInfo->user_type=='generalSeller'||$this->signedInUserSessionInfoHolder->generalInfo->user_type=='storeSeller'){
				$userReviews = DatabaseObject_Helper_UserManager::loadUserReviews($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID);
				//Zend_Debug::dump($userReviews);
				$this->view->userReviews = $userReviews;
				$this->view->numberOfReview = $this->userObject->review_count;
				$this->view->averageRating = $this->userObject->review_average_score;
			}
			$ip=$_SERVER['REMOTE_ADDR'];
			echo "ip is: ".$ip;
		}
		
		public function rewardpointsAction(){
			$this->view->user=$this->signedInUserSessionInfoHolder;
			$this->view->userRewardPoint=$this->userObject->reward_point;
			
			if(isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id)){
				$this->view->defaultShippingKey = $this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id;
			}
			else{
				echo "there is no default shipping key set in session variable";
			}
			$rewardTracking = DatabaseObject_Helper_UserManager::loadRewardPointTracking($this->db, $this->signedInUserSessionInfoHolder->generalInfo->referee_id);
			$this->view->rewardPointTracking = $rewardTracking;
			$this->breadcrumbs->addStep('Details', $this->getUrl('details', 'account'));
			if($this->signedInUserSessionInfoHolder->generalInfo->user_type=='generalSeller'||$this->signedInUserSessionInfoHolder->generalInfo->user_type=='storeSeller'){
				$userReviews = DatabaseObject_Helper_UserManager::loadUserReviews($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID);
				//Zend_Debug::dump($userReviews);
				$this->view->userReviews = $userReviews;
				$this->view->numberOfReview = $this->userObject->review_count;
				$this->view->averageRating = $this->userObject->review_average_score;
			}
			$ip=$_SERVER['REMOTE_ADDR'];
			echo "ip is: ".$ip;
			
		}
		
		public function editbasicinfoAction(){
			$request=$this->getRequest();
			$fp = new FormProcessor_Account_UserBasicInfo($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID);
			$this->view->fp = $fp;
			if($request->isPost()) {
				//database are changed in FormProcessor_Account
				if($fp->process($request)){	
					//session is being updated after FormProcessor_Account returns true
					$this->signedInUserSessionInfoHolder->generalInfo->first_name=$fp->first_name;
					$this->signedInUserSessionInfoHolder->generalInfo->last_name=$fp->last_name;
					$this->signedInUserSessionInfoHolder->generalInfo->affiliation=$fp->affiliation;
					$this->signedInUserSessionInfoHolder->generalInfo->experience=$fp->experience;
					$this->_forward('details');
				}
			}
			
			$this->breadcrumbs->addStep('Details', $this->getUrl('details', 'account'));
			$this->breadcrumbs->addStep('Edit basic information', $this->getUrl('editbasicinfo', 'account'));

		}
		/*editshipping*
		*handles the creation and edition of an shipping address
		*requires param editAddress
		*sets the defaultAddress when a new address is created when there is none
		*/
		public function editshippingAction(){
			$request=$this->getRequest();
			$addressID=$request->getParam('editAddress');
			
			if(!isset($addressID)){
				$addressID='';
			}
			$fp = new FormProcessor_Account_ShippingAddress($this->db, $addressID, $this->signedInUserSessionInfoHolder->generalInfo->userID);
			$validate = $request->isXmlHttpRequest();//check to see if it is ajax request

			if($request->isPost()) {
				if($validate){
					//echo 'here';
					$fp->validateOnly(true); 
					if($fp->process($request)){
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->address_one=$fp->address_one;
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->address_two=$fp->address_two;
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->city=$fp->city;
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->state=$fp->state;
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->country=$fp->country;
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->zip=$fp->zip;
						//if there is no defaultShippingAddress, then it stores it in database, and set session variable
						if(!isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id))
						{
							
							$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id=$fp->shippingId;		
							$this->userObject->profile->defaultShippingAddress = $fp->shippingId;
							$this->userObject->save();
							$fp->previousDefaultShipping=0;
						}elseif(isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id) && $fp->defaultShipping=='on'){
						    $fp->previousDefaultShipping=$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id;
							$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id=$fp->shippingId;		
							$this->userObject->profile->defaultShippingAddress = $fp->shippingId;
							$this->userObject->save();
					    }else{
							$fp->previousDefaultShipping=0;
						}
						$json = array('name'=>$this->signedInUserSessionInfoHolder->generalInfo->first_name.' '.$this->signedInUserSessionInfoHolder->generalInfo->last_name,'address_one'=>$fp->address_one, 'address_two'=>$fp->address_two,'city'=>$fp->city, 'state'=>$fp->state, 'country'=>$fp->country, 'zip'=>$fp->zip, 'shippingId'=>$fp->shippingId, 'defaultShipping'=>$fp->defaultShipping, 'previousDefaultShipping'=>$fp->previousDefaultShipping, 'existingAddresses'=>count($this->signedInUserSessionInfoHolder->generalInfo->shippingAddress));
						$this->sendJson($json);
					}else{
						$json = array('errors'=> $fp->getErrors());	
						$this->sendJson($json); 
					}
				}else{
					if($fp->process($request)){
						//sets shippingAddress information
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->address_one=$fp->address_one;
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->address_two=$fp->address_two;
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->city=$fp->city;
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->state=$fp->state;
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->country=$fp->country;
						$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$fp->shippingId]->zip=$fp->zip;
						//if there is no defaultShippingAddress, then it stores it in database, and set session variable
						if(!isset($this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id) ||$fp->defaultShipping=='on')
						{
							$this->signedInUserSessionInfoHolder->generalInfo->defaultShippingAddress->address_id=$fp->shippingId;						
							$this->userObject->profile->defaultShippingAddress = $fp->shippingId;
							$this->userObject->save();
						}
					
						$this->_redirect($_SERVER['HTTP_REFERER']);
					}

				}
			}
			$this->view->addressID=$addressID;
			$this->view->fp = $fp;
			$this->breadcrumbs->addStep('Details', $this->getUrl('details', 'account'));
			$this->view->returnAddress = $_SERVER['HTTP_REFERER'];
			$this->breadcrumbs->addStep('Edit shipping information', $this->getUrl('editshipping', 'account'));
		}
		
		/*deleteshipping*
		*handles the deletion of an shipping address
		*requires param editAddress
		*removes defaultAddress in database and session if the one being deleted is default address
		*/
		public function deleteshippingAction(){
			$request=$this->getRequest();
			$addressID = $request->getParam('editAddress');
			if(!isset($addressID)){
				$addressID='';
			}
			if($this->userObject->deleteShipping($addressID, $this->signedInUserSessionInfoHolder->generalInfo)){
				if($request->isXmlHttpRequest()){
				$json = array('deletedShippingId'=>$addressID, 'defaultShippingAddressId'=>$this->userObject->profile->defaultShippingAddress);
				
				$this->sendJson($json);
				}else{
				$this->_redirect($_SERVER['HTTP_REFERER']);
				}
			}
			else{
				echo"failed to delete";
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}
		}
		
		/*makedefaultshipping*
		*responsible of making an address the default address
		*uses: $editAddress
		*edits the database to the selected default address and modifies the session to represent the change
		*/
		public function makedefaultshippingAction(){
			$request=$this->getRequest();
			$addressID = $request->getParam('editAddress');
			if(!isset($addressID)){
				$addressID='';
			}
			
			$previousDefaultShippingAddress=$this->userObject->profile->defaultShippingAddress;
			if($this->userObject->madeDefaultShipping($addressID, $this->signedInUserSessionInfoHolder->generalInfo)){
				if($request->isXmlHttpRequest()){
				$json = array('newShippingAddress'=>$addressID,
							  'name'=>$this->signedInUserSessionInfoHolder->generalInfo->first_name.' '.$this->signedInUserSessionInfoHolder->generalInfo->last_name,
							  'address_one' => $this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$addressID]->address_one,
							  'address_two' => $this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$addressID]->address_two,
							  'city'=>$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$addressID]->city,
							  'state'=>$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$addressID]->state,
							  'country'=>$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$addressID]->country,
							  'zip' =>$this->signedInUserSessionInfoHolder->generalInfo->shippingAddress[$addressID]->zip,
							  'previousShippingAddressId'=>$previousDefaultShippingAddress);
				
				$this->sendJson($json);
				}else{
				$this->_redirect($_SERVER['HTTP_REFERER']);
				}
			}
			else{
				$this->_redirect($_SERVER['HTTP_REFERER']);
			}
		}
		
		public function upgradegeneralsellerAction(){
			if($this->userObject->user_type=='member' || $this->userObject->user_type=='generalSeller'){
				$request=$this->getRequest();
				$fp=new FormProcessor_Account_UpgradeAccount($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID, 'generalSeller');
				if($request->isPost()) {
					if($fp->process($request)){
						echo "here at good process";
						if($this->userObject->user_type!=$fp->type){
							$this->userObject->user_type=$fp->type;
							$this->userObject->save();
						}
						$this->signedInUserSessionInfoHolder->generalInfo->user_type = $fp->type;
						$this->signedInUserSessionInfoHolder->sellerInfo->paypal_email = $fp->paypal_email;
						$this->signedInUserSessionInfoHolder->sellerInfo->verified = $fp->verified;
						$this->signedInUserSessionInfoHolder->sellerInfo->unique_identifier=$fp->unique_identifier;
						$this->signedInUserSessionInfoHolder->sellerInfo->phone_number = $fp->phone_number;
						$this->signedInUserSessionInfoHolder->sellerInfo->address_one = $fp->address_one;
						$this->signedInUserSessionInfoHolder->sellerInfo->address_two = $fp->address_two;
						$this->signedInUserSessionInfoHolder->sellerInfo->city = $fp->city;
						$this->signedInUserSessionInfoHolder->sellerInfo->state = $fp->state;
						$this->signedInUserSessionInfoHolder->sellerInfo->country = $fp->country;
						$this->signedInUserSessionInfoHolder->sellerInfo->zip = $fp->zip;
						$this->signedInUserSessionInfoHolder->sellerInfo->seller_type = $fp->type;
						$this->_forward('details');
					}else{
						echo "here at bad process";
					}
				}
				$this->view->fp=$fp;
			}else{
				echo"you can not go here";
				$this->_forward('details');
			}
		}
		
		public function upgradestoresellerAction(){
			$request=$this->getRequest();
			$fp=new FormProcessor_Account_UpgradeAccount($this->db, $this->signedInUserSessionInfoHolder->generalInfo->userID, 'storeSeller');
			if($request->isPost()) {
				if($fp->process($request)){	
					if($this->userObject->user_type!=$fp->type){
						$this->userObject->user_type=$fp->type;
						$this->userObject->save();
					}
					$this->signedInUserSessionInfoHolder->generalInfo->user_type = $fp->type;
					$this->signedInUserSessionInfoHolder->sellerInfo->paypal_email = $fp->paypal_email;
					$this->signedInUserSessionInfoHolder->sellerInfo->verified = $fp->verified;
					$this->signedInUserSessionInfoHolder->sellerInfo->unique_identifier=$fp->unique_identifier;
					$this->signedInUserSessionInfoHolder->sellerInfo->phone_number = $fp->phone_number;
					$this->signedInUserSessionInfoHolder->sellerInfo->items_description=$fp->items_description;
					$this->signedInUserSessionInfoHolder->sellerInfo->store_description = $fp->store_description;
					$this->signedInUserSessionInfoHolder->sellerInfo->address_one = $fp->address_one;
					$this->signedInUserSessionInfoHolder->sellerInfo->address_two = $fp->address_two;
					$this->signedInUserSessionInfoHolder->sellerInfo->city = $fp->city;
					$this->signedInUserSessionInfoHolder->sellerInfo->state = $fp->state;
					$this->signedInUserSessionInfoHolder->sellerInfo->country = $fp->country;
					$this->signedInUserSessionInfoHolder->sellerInfo->zip = $fp->zip;
					$this->signedInUserSessionInfoHolder->sellerInfo->seller_type = $fp->type;
					//proceed to checkout here if it is the first time and not paid
					//-------
					$this->_forward('details');
				}
			}
			$this->view->fp=$fp;
		}
		
		public function uploadmeasurementAction(){
			$request=$this->getRequest();
			if($this->signedInUserSessionInfoHolder->generalInfo->sex=='woman')
			{
				$fp = new FormProcessor_Measurement_WomenMeasurement($this->db, $this->userObject);
			}elseif($this->signedInUserSessionInfoHolder->generalInfo->sex=='man'){
				$fp = new FormProcessor_Measurement_MenMeasurement($this->db, $this->userObject);
			}
			
			if($request->getPost('submit'))
			{
				if($fp->process($request)){
					echo 'processed';
					
				}else{
					echo 'erro';
				}
			}
			
			$this->view->fp=$fp;
			$this->view->user=$this->userObject;
		}
		
		public function loginAction()
		{
			//if a user's already logged in, send them to their account home page
			$auth = Zend_Auth::getInstance();
			if($auth->hasIdentity()){
				$this->_redirect('/account/index');
			}
	
			$request=$this->getRequest();
			
			if($request->getPost('register')){
				$this->_redirect($this->geturl('newmember', 'registration'));
			}
			
				//determin the page the user was originally trying t request
			$redirect = $request->getPost('redirect');
			if(strlen($redirect)==0){
				//$redirect= $request->getServer('REQUEST_URI');
			}
			if(strlen($redirect)==0){
				$redirect = '/index';
			}
			//initialize errors
			$errors=array(); 
			if($request->isPost()){
				$username= DatabaseObject_StaticUtility::cleanHtml($request->getPost('username'));
				$password= DatabaseObject_StaticUtility::cleanHtml($request->getPost('password'));
				if(strlen($username)==0){
					$errors['username']='Required field must not be blank';
				}
				if(strlen($password)==0){
					$errors['password']='Required field must not be blank';
				}
				if(count($errors)==0){
					//setup teh authentication adapter
					//Zend_auth_adapter_dbtable takes($database, $table, $identity, $password, $passwordtreatment
					$adapter = new Zend_Auth_Adapter_DbTable($this->db, 'users', 'username', 'password', 'md5(?)');
					$adapter->setIdentity($username);
					$adapter->setCredential($password);
					//try and authenticate the user
					$result = $auth->authenticate($adapter);
					if($result->isValid()){
						$user=new DatabaseObject_User($this->db);
						$user->load($adapter->getResultRowObject()->userID);
						//record login attemp
						$user->loginSuccess(); //in user.php
						//create identity data and write it to session
						$signedInUser = $user->createAuthIdentity(); //in user.php
						$auth->getStorage()->write($signedInUser); //writing more stuff in the signedInUser data stored in session. rewrite the new signedInUser created in users into our ZendAuth_Session_write stuff. //anypage can ues this information.
						//send user to page they originally request
						$this->_redirect($redirect);
					}
					//record failed login attempt
					DatabaseObject_User::LoginFailure($username,$result->getCode()); //in user.php
					
					$errors['username'] = 'Your login details were invalid';
				}
			}
			$this->breadcrumbs->addStep('Login');
			$this->view->errors=$errors; 
			$this->view->redirect=$redirect;
			$fp=new FormProcessor_Account_UsermemberRegistration($this->db);
			$this->view->fp = $fp;
		}
		
		public function logoutAction(){
			//destorys auth identity
			Zend_Auth::getInstance()->clearIdentity();
			//destroys all session
			Zend_Session::destroy(false);
			//clears the shoppingcart
			
			//return $this->_redirect($this->geturl('index', 'index'));	
		}
		
		public function fetchpasswordAction(){
			//if a user's already loged in, send them to the thier account home page
			if(Zend_Auth::getInstance()->hasIdentity()){
				$this->_redirect('/account');
			}
			$errors = array();
			$action = $this->getRequest()->getQuery('action');
			if($this->getRequest()->isPost()){
				$action = 'submit';
			}
			
			switch($action){
				case 'submit':
					$username = trim($this->getRequest()->getPost('username'));
					
					if(strlen($username)==0){
						$errors['username']='Required field must not be blank';
					}
					else{
						$user= new DatabaseObject_User($this->db);
						if($user->load($username, 'username')){
							$user->fetchPassword();
							
							$url = '/account/fetchpassword?action=complete';
							
							$this->_redirect($url);
						}
						else{
							$errors['username'] ='Specified user not found';
						}
					}
					break;
				
				case 'complete':
					//nothing to do
					break;
				case 'confirm':
					$id = $this->getRequest()->getQuery('id');
					$key = $this->getRequest()->getQuery('key');
					$user= new DatabaseObject_User($this->db);
					if(!$user->load($id)){
					
						echo "here at bad load";
						$errors['confirm'] = 'Error confirming new password at badload';
					}
					elseif(!$user->confirmNewPassword($key)){
						echo "here at bad key";
						$errors['confirm'] = 'Error confirming new password at bad key';
					}
					break;
			}		
			$this->view->errors = $errors;
			$this->view->action = $action;
		}		

		public function imagesAction(){
			$request= $this->getRequest();
			$json = array();
			$user_id=(int)$request->getPost('id');
			$user = new DatabaseObject_User($this->db);
			if(!$user->load(Zend_Auth::getInstance()->getIdentity()->userID)){
				$this->_redirect($this->getUrl());
			}
			if($request->getPost('upload')){
				$fp=new FormProcessor_Image($user);
				if($fp->process($request)){
					$this->messenger->addMessage('Image uploaded');
				}
				else{
					foreach($fp->getErrors() as $error){
						$this->messenger->addMessage($error);
					}
				}
			}
			elseif($request->getPost('reorder')){
				$order = $request->getPost('post_images');
				$options=array('user_id' =>Zend_Auth::getInstance()->getIdentity()->userID); //loading images
				$images = DatabaseObject_Image::GetImages($this->db, $options, 'user_id', 'users_profiles_images');
				$user->images=$images;
				$user->setImageOrder($order);
			}
			elseif($request->getPost('delete')){
				$image_id = (int) $request->getPost('image');
				$image = new DatabaseObject_Image($this->db);
				if($image->loadForPost($user->getId(), $image_id)){
					$image->delete(); //the files are unlinked/deleted at preDelete.
					//echo "image at delete";
					if($request->isXmlHttpRequest()){
						$json = array('deleted' =>true, 'image_id' =>$image_id);
					}
					else{
						$this->messenger->addMessage('Image deleted');
					}
				}
			}
			if($request->isXmlHttpRequest()){
				$this->sendJson($json);
			}
			else{
				$url = $this->getUrl('details');
				$this->_redirect($url);
			}
		}
		
		public function verifyselleraccountAction(){
			$request= $this->getRequest();
			
			$uniqueIdForSeller = $request->getParam('sUqid');
			
			if(isset($uniqueIdForSeller)&&$uniqueIdForSeller!=''){
				if(DatabaseObject_SellerInformation::verifyPaypalEmailAccount($this->db, $uniqueIdForSeller)){
					//$this->messenger->addMessage('Congratulations! Seller account verified. You may now list items');
					//update the sellerInformation session if the user is logged in. 
					if($this->auth->hasIdentity()){
						if(isset($this->signedInUserSessionInfoHolder->sellerInfo)){
							$this->signedInUserSessionInfoHolder->sellerInfo->verified=1;
							$this->messenger->addMessage('Congratulations, your seller account has been verified. please log back in again to start your listing.');
							$this->_redirect('/account/logout');
						}
					}else{
						$this->messenger->addMessage('Congratulations, your seller account has been verified. please log back in again to start your listing.');
						$this->_redirect('/index/index');
					}
					
				}else{
					$this->messenger->addMessage('We are sorry, but your account has not been verified. Please check your email for the correct verification link. Thank you for your patience.');

				}
			}else{
				$this->messenger->addMessage('We are sorry, but you do not have the privalidge to view this page.');
			}
			$this->_redirect('/index');
		}
	}
?>