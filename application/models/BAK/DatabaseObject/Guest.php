<?php

	class DatabaseObject_Guest extends DatabaseObject
	{
		public $orderShoppingCart;
		public $orderCartObject;

		public function __construct($db)
		{
			
			parent::__construct($db, 'guests', 'guest_id');
			
			$this->add('first_name');
			$this->add('last_name');
			$this->add('email');
			$this->add('address');
			$this->add('phone');
			$this->add('city');
			$this->add('state');
			$this->add('zip');
			$this->add('car');
			$this->add('boombox');
			$this->add('ethnicity');
			$this->add('hear_about_us');
			$this->add('school');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
		}
		
		
		protected function preInsert()
		{
		
			//$this->_newPassword = Text_Password::create(8);
			//$this->password = $this->_newPassword;
			//$this->profile->num_posts =10;
			
			return true;
		}
		
		protected function postLoad()
		{
			//$this->profile->setUserId($this->getId());
			//$this->profile->load();
			
	
		}
		
		protected function postInsert()
		{
			/*$this->profile->setUserId($this->getId());
			$this->profile->save(false);
			
			$this->sendEmail('user-register.tpl');
			
			if($this->user_type == 'clubAdmin')
			{
				DatabaseObject_StaticUtility::addClubNumber($this->_db, $this->university_id);
				DatabaseObject_StaticUtility::addTypeClubNumber($this->_db, $this->type_id);
			}*/
			
			//echo "message being sent";
			//$this->addToIndex();
			return true;
		}
		
		protected function postUpdate()
		{
			
			return true;
		}
		
		protected function preDelete() 
		{
		
			return true;
		}
		
		
		public function loadByID($id)
		{
			$select = $this->_db->select();
			
			$select->from('guests')
				   ->where('guest_id = ?', $id);
		
			return $this->_load($select);
		}
		
		public function sendEmail($tpl, $secondUser='', $invoiceID='')
		{
			$templater = new Templater();
			$templater->user = $this;
			
			if($secondUser != '')
			{
			$templater->member = $secondUser;
			}
			
			

			if($invoiceID!='')
			{
				$order = new DatabaseObject_Order($this->_db);

				if($order->loadOrderByUrl($invoiceID))
				{
					if($order->promotion_code == '')
					{
						$templater->addPromo = 'true';
					}
					else
					{
						$templater->promoCode = $order->promotion_code;
						$templater->discount = $order->total_after_p-$order->total_before_p;
						$templater->finalTotal = $order->total_after_p;
					}
					
					//echo "promotion code: ";
					
					
					
					$orderProfile = new Profile_Order($this->_db);
				
					
					$result = $orderProfile->loadProifleByOrderID($order->getId());
					
					
					if($order->buyer_id>30000000)
					{
						
						$member = new DatabaseObject_Guest($this->_db);
						
						$member->loadByID($order->buyer_id-30000000);
						$templater->guest = 'true';
	
					}
					else
					{
						$member = new DatabaseObject_User($this->_db);
						
						if($type=='buyer')
						{	
							$member->loadByUserId($order->user_id);
							////echo "here at odertype buyer";
						}
					}
					
					echo "order status: ".$order->url."<br/>";
					echo "count of order in that order: ".count($result)."<br/>";
					echo $result[0]['profile_id'];
					echo $result[0]['product_name'];
					
					
					$templater->member=$member;
					$productProfile=array();
					
					foreach ($result as $k => $v)
					{
						//echo "<br/>here0<br/>";
						
						$productProfile[$result[$k]['profile_id']] = new Profile_Order($this->_db);
						
						$productProfile[$result[$k]['profile_id']]->loadOrder($result[$k]['profile_id'], $order->url);
						
						
						
						//echo "<br/>heels are for profile_id: ".$result[$k]['profile_id']." and heels are: ".$productProfileArray[$result[$k]['profile_id']]->orderAttribute->heel."<br/>";
						//echo "<br/>name: ".$productProfileArray[1]->product_name;
	
					}
				
					$templater->productsProfile=$productProfile;
	
				$templater->invoice = $invoiceID;
				$templater->dateTime= date(date("F j, Y, g:i a"), $order->ts_created);
				$templater->finalTotal = $order->total_after_p;
				
				//////////////////////////////////////////////////////////////////////////////////
				/*
					$this->orderShoppingCart = new DatabaseObject_Order($this->_db);
					
					$this->orderCartObject=$this->orderShoppingCart->loadOrderByUrl($invoiceID);
					
					if($this->orderShoppingCart->promotion_code == '')
					{
						$templater->addPromo = 'true';
						$templater->total = $this->orderShoppingCart->total_before_p;
	
					}
					else
					{
						$templater->promoCode = $this->orderShoppingCart->promotion_code;
						$templater->total = $this->orderShoppingCart->total_before_p;
						$templater->discount = $this->orderShoppingCart->total_after_p-$this->orderShoppingCart->total_before_p;
						$templater->finalTotal = $this->orderShoppingCart->total_after_p;
					}
					
					
					$product = $this->orderCartObject;
					
					echo "count product: ".count($product);
					$templater->shoppingCart = $this->orderShoppingCart;
					$templater->dateTime= date(date("F j, Y, g:i a"), $this->orderShoppingCart->ts_created);
					$templater->products = $product;
					
					
					$productProfile=array();
					
					foreach($product as $k => $v)
					{
						echo $product[$k]->getId();
						
						$productProfile[$product[$k]['profile_id']] = new Profile_Order($this->db);
						
						$productProfile[$product[$k]['profile_id']]->loadOrder($product[$k]['profile_id'], $order->url);
						
						
						
															
					}
				
					$templater->productsProfile=$productProfile;*/
				
				}
			}
			//fetch teh e-amil body
			$body = $templater->render('email/'.$tpl);
			
			//extract the subject from the first line
			list($subject, $body) = preg_split('/\r|\n/', $body, 2);
			
			//now set up and send teh email
			
			echo "here at mail"."<br/>";
			$mail = new Zend_Mail();
			
			//set the to address and the user's full name in the 'to' line
			echo "the email sent out is: ".$this->email."<br />";
			$mail->addTo($this->email, trim($this->first_name.' '.$this->last_name));
			
			//get the admin 'from details form teh config
			$mail->setFrom('ve-no-reply@visachidesign.com', 've-no-reply');
			
			//set the subject and boy and send the mail
			$mail->setSubject(trim($subject));
			$mail->setBodyText(trim($body));
			$mail->send();
			

		}
		
	
	}
?>