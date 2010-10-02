<?php

	
	class DatabaseObject_User extends DatabaseObject
	{
		static $userTypes= array('member' 	    => 'member',
								'admin' => 'admin',
								'generalSeller'     => 'generalSeller',
								'storeSeller' =>'storeSeller' );	
		public $profile =null;				
		public $images;
		public $_newPassword = null;
		public $defaultShippingAddress = null;
		public $shippingAddress=array();
		public $sellerInformation;
		public $shippingObject;
		
		public function __construct($db)
		{
			parent::__construct($db, 'users', 'userID');
			$this->add('referral_id');
			$this->add('referee_id', Text_Password::create(10, 'unpronounceable'));
			$this->add('username');
			$this->add('password');
			$this->add('email');
			$this->add('sex');
			$this->add('first_name');
			$this->add('last_name');
			$this->add('user_type', 'member');
			$this->add('reward_point', 0);
			$this->add('status', 'D');
			$this->add('measurement', '0');
			$this->add('review_count','0');
			$this->add('review_average_score','0');
			$this->add('review_total_score','0');
			$this->add('verification', 'unverified');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
			$this->add('ts_last_login', null, self::TYPE_TIMESTAMP);
			
			$this->profile = new Profile_User($db);
			$this->shippingObject = new DatabaseObject_ShippingAddress($db);
			//$this->defaultShippingAddress = new DatabaseObject_ShippingAddress($db);
		}
		
		   
		
		protected function preInsert()
		{
			//$this->_newPassword = Text_Password::create(8);
			//$this->password = $this->_newPassword;
			return true;
		}
		
		protected function postLoad()
		{
			$this->profile->setUserId($this->getId());
			$this->profile->load();
			//$this->defaultShippingAddress->load($this->profile->defaultShippingAddress);
	
		}
		
		protected function postInsert()
		{
			$this->profile->setUserId($this->getId());
			$this->profile->save(false);
						
			/*$this->sendEmail('user-register.tpl');*/
			
			if($this->user_type == 'admin')
			{
				DatabaseObject_StaticUtility::addClubNumber($this->_db, $this->university_id);
				DatabaseObject_StaticUtility::addTypeClubNumber($this->_db, $this->type_id);
			}
			
			unset($_SESSION['referral']);
			//remove the current referral session
			
			echo "at post insert person: ".$this->referral_id;
			if($this->referral_id !='')
			{
				DatabaseObject_Helper_UserManager::addRewardPointToUser($this->_db, $this->referral_id, '4', 'from referred new member registration', $_SERVER['REMOTE_ADDR'], $this->username, $this->getId(), $this->referee_id);
			}
			
			
			
			DatabaseObject_Helper_UserManager::addRewardPointToUser($this->_db, $this->referee_id, '16', 'Registration reward point bonus', $_SERVER['REMOTE_ADDR'], $this->username, $this->getId(),$this->referee_id);
			/*send email to referral person information of invitation accepted and reward point earned*/
			
			return true;
		}
		
		protected function postUpdate()
		{
			$this->profile->save(false);
			//$this->addToIndex();
			return true;
		}
		
		

		
		/***********************************************************************
		**WHEN DELETING A USER, PROFILE, IMAGES, EVENTS, PRODUCTS, POSTS, MEMBERS,
		**ALL MUST BE DELETED
		************************************************************************/
		protected function preDelete() 
		{
			foreach ($this->images as $image)
			{
				$image->delete(false);
			}
		
			$this->profile->delete();
			
			//$this->deleteFromIndex();
			return true;
		}
		
		
		
		public function __set($name, $value) //automatically setts things when not defined. 
		{
			switch ($name)   // if the set name is any one of these, it does the following. 
			{
				case 'password': //if trying to set password, convert to $value and then call parent
					$value = md5($value);
					break;
				case 'user_type': //if trying to set user_type that is not currenlty existant in the userType array, change $value to 'member';
					if(!array_key_exists($value, self::$userTypes))
					$value = 'member';
					break;
			}
			
			return parent::__set($name, $value);
		
		}
		
		
		public function usernameExists($username)
		{
			$query=sprintf('select count(*) as num from %s where username=?', $this->_table);
			//echo "$query";
			$result = $this->_db->fetchOne($query, $username);
			return $result;
		}
		
		public function emailExists($email){
			
			$query=sprintf('select count(*) as num from %s where email = ?', $this->_table);
			$result = $this->_db->fetchOne($query, $email);
			return $result;
		}
		
		static public function IsValidUsername($username)
		{
			$validator = new Zend_Validate_Alnum(); //validates only if the username contain alphebetical and numeric values. 
			return $validator->isValid($username);
		}
		
		/************
		*this creates a standard class filled with general user information of the current instance
		************/
		public function createAuthIdentity(){
			$identity = new stdClass;
			$identity->userID = $this->getId();
			$identity->username = $this->username;
			$identity->user_type = $this->user_type;
			$identity->first_name = $this->first_name;
			$identity->last_name = $this->last_name;
			$identity->sex = $this->sex;
			$identity->measurement=$this->measurement;
			$identity->email = $this->email;
			$identity->dance_experience = $this->profile->experience;
			$identity->affiliation = $this->profile->affiliation;
			return $identity;
		}
		
		public function createGeneralInfoSessionObject(){
			$identity = new stdClass;
			$identity->userID = $this->getId();
			$identity->username = $this->username;
			$identity->user_type = $this->user_type;
			$identity->first_name = $this->first_name;
			$identity->last_name = $this->last_name;
			$identity->email = $this->email;
			$identity->sex = $this->sex;
			$identity->measurement=$this->measurement;
			$identity->experience = $this->profile->experience;
			$identity->affiliation = $this->profile->affiliation;
			$identity->referee_id = $this->referee_id;
			if(isset($this->profile->defaultShippingAddress))
				$identity->defaultShippingAddress->address_id=$this->profile->defaultShippingAddress;
			return $identity;
		}
		
		public function createSellerInfoSessionObject(){
			$this->sellerInformation = new DatabaseObject_SellerInformation($this->_db);
			if(($this->user_type=='generalSeller' || $this->user_type=='storeSeller')){
				if($this->sellerInformation->load($this->getId())){
					$object = new stdClass;
					$object->paypal_email = $this->sellerInformation->paypal_email;
					$object->verified = $this->sellerInformation->verified;
					$object->unique_identifier=$this->sellerInformation->unique_identifier;
					$object->phone_number = $this->sellerInformation->phone_number;
					$object->items_description = $this->sellerInformation->items_description;
					$object->store_description = $this->sellerInformation->store_description;
					$object->address_one = $this->sellerInformation->address_one;
					$object->address_two = $this->sellerInformation->address_two;
					$object->zip =$this->sellerInformation->zip;
					$object->city = $this->sellerInformation->city;
					$object->state = $this->sellerInformation->state;
					$object->country = $this->sellerInformation->country;
					return $object;
				}
			}	
		}
		
		public function createShippingAddressInfoSessionObject(&$shippingSession){
			//uses a global object and seeks to retrive all shipping address related to this person.
			$address=DatabaseObject_ShippingAddress::loadByUserId($this->_db, $this->getId());
			foreach($address as $k=>$v){
				foreach ($v as $Key=>$Value){
					if($Key =='address_id'){
						$address_id = $Value;
					}
					else{
						$shippingSession[$address_id]->$Key=$Value;
					}
				}
			}
			$this->shippingAddress=$address;
		}
		
		/***************
		*Account management activities
		********************/
		public function deleteShipping($addressID, &$userSession){
			//check to see if the address belongs to the user.
			if($this->shippingObject->loadByIDs($addressID, $this->getId())){	
				//check to see if there is a default address
				if(isset($this->profile->defaultShippingAddress)){
					//check to see if the removed address is defaultShippingAddress
					if($addressID==$this->profile->defaultShippingAddress)
					{
						//unset the esssion variable
						unset($userSession->defaultShippingAddress);
						//removes the databaseobject
						$this->profile->defaultShippingAddress='';
						$this->save();
					}
				}
				//unset session shipping Address
				unset($userSession->shippingAddress[$addressID]);
				//remove address from database
				$this->shippingObject->delete();
				return true;
			}else{
				return false;
			}
		}
		
		public function madeDefaultShipping($addressID, &$userSession)
		{
			if($this->shippingObject->loadByIDs($addressID, $this->getId())){
				//sets the database
				$this->profile->defaultShippingAddress=$addressID;
				$this->save();
				//sets the session
				$userSession->defaultShippingAddress->address_id=$addressID;
				return true;
			}else{
				return false;
			}
		}
		
		public function loginSuccess()
		{
			$this->ts_last_login = time();
			
			unset($this->profile->new_password);
			unset($this->profile->new_password_ts);
			unset($this->profile->new_password_key);
			
			$this->save();
			
			//$message=sprintf('Successful login attempt from %s user %s', $_SERVER['REMOTE_ADDR'], $this->username);
			//$logger = Zend_Registry::get('logger');
			//$logger->notice($message);
		}
		
		static public function LoginFailure($username, $code='')
		{
			switch($code)
			{
				case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
					$reason = 'Unknown username';
					break;
				case Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS:
					$reason = 'Multiple users found with this username';
					break;
				case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
					$reason = 'Invalid password';
					break;
				default:
					$reason = '';
			}
			
			$message = sprintf('Failed login attempt from %s user %s', $_SERVER['REMOTE_ADDR'], $username);
			
			if(strlen($reason)>0)
			$message .= sprintf('(%s)', $reason);
			
			$logger = Zend_Registry::get('logger');
			$logger->warn($message);
			
		}
		
		
		public function loadByUsername($username, $user_type, $status)
		{
			$username = trim($username);
			if(strlen($username)==0)
			{
				return false;
			}
			
			$query = sprintf('select %s from %s where user_type =? ', join(', ', $this->getSelectFields()), $this->_table, $user_type);
			
			
			$query=$this->_db->quoteInto($query, $user_type); 
			

			$query=$query.' and username = ?';
			
			$query=$this->_db->quoteInto($query, $username);
			
			$query=$query.' and status = ?';
			$query=$this->_db->quoteInto($query, $status);

			return $this->_load($query);
		}
		
		public function loadByUserId($ID)
		{
			//echo "you are here at load by user id";
			$id = (int)$ID;
			
			if(strlen($ID)<=0)
			{
				echo "your ID is invalid";
				return false;
			}
			
			$query = sprintf('select %s from %s where userID = ?', join(', ', $this->getSelectFields()), $this->_table);
			$query = $this->_db->quoteInto($query, $ID);
			
			return $this->_load($query);
		}
		
		public function getTeaser($length)
		{
			return DatabaseObject_StaticUtility::GetTeaser($this->profile->club_description, $length);
		}
		
		
		
		public function sendEmail($tpl)
		{
			$templater = new Templater();
			$templater->user = $this;
			
			
			//fetch teh e-amil body
			$body = $templater->render('email/'.$tpl);
			
			//extract the subject from the first line
			list($subject, $body) = preg_split('/\r|\n/', $body, 2);
			
			//now set up and send teh email
			$mail = new Zend_Mail();
			
			//set the to address and the user's full name in the 'to' line
			//echo "<br/> here at user email address: ".$this->email."<br/>";
			$mail->addTo($this->email, trim($this->first_name.' '.$this->last_name));
			
			//get the admin 'from details form teh config
			$mail->setFrom('ballroom-no-reply@visachidesign.com', 'bt-no-reply');
			
			//set the subject and boy and send the mail
			$mail->setSubject(trim($subject));
			$mail->setBodyText(trim($body));
			$mail->send();
			
			//$logger->warn('at send email at usre.php complete<br/>');
		}
		
		
		
		
		public function fetchPassword()
		{
			if(!$this->isSaved())
			{
				return false;
			}
			
			//generate new password properties
			$this->_newPassword = Text_Password::create(8);
			
			$this->profile->new_password = md5($this->_newPassword);
			$this->profile->new_password_ts =time();
			$this->profile->new_password_key = md5(uniqid().$this->getId().$this->_newPassword);
			
			//save new password to profile and send emial
			$this->profile->save();
			
			$this->sendEmail('user-fetch-password.tpl');
			
			return true;
		}
		
		
		
		
		public function confirmNewPassword($key)
		{
			//check that valid password reset data is set
			if(!isset($this->profile->new_password) || !isset($this->profile->new_password_ts) || !isset($this->profile->new_password_key))
			{
				return false;
			}
			
			//check if the password is being confirm winthin a day
			if(time() - $this->profile->new_password_ts >86400)
			{
				return false;
			}
			
			if($this->profile->new_password_key != $key)
			{
				return false;
			}
			
			//everything is valid, nowupadte the account to use the new password
			//bypass the local setter as new_password is already an md5
			
			parent::__set('password', $this->profile->new_password);
			
			unset($this->profile->new_password);
			unset($this->profile->new_password_ts);
			unset($this->profile->new_password_key);
			
			//finally, save the updated user record and the updated profile
			return $this->save();
		}	
	}
?>