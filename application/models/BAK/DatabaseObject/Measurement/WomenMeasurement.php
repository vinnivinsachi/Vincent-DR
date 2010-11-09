<?php
// this class handles all the images that are being added as a product attribute image. 
// such as a product may have an image associated attribute like color or fabric or heel or size. 


	class DatabaseObject_Measurement_WomenMeasurement extends DatabaseObject
	{
	
		public $username;
		public $userID;
		public function __construct($db)
		{	
			parent::__construct($db, 'user_women_measurement', 'user_women_measurement_id');
			$this->add('User_referee_id');
			$this->add('arm_length');
			$this->add('bicept');
			$this->add('bust');
			$this->add('bust_bust');
			$this->add('bust_waist');
			$this->add('chest');
			$this->add('crotch');
			$this->add('hip');
			$this->add('nape_waist');
			$this->add('neck');
			$this->add('shoulder_bust');
			$this->add('shoulder');
			$this->add('shoulder_to_waist');
			$this->add('waist');
			$this->add('waist_floor');
			$this->add('wrist');
			$this->add('armpit_circumference');
			$this->add('body_height');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
		}

		protected function postLoad()
		{

		}
		
		protected function postInsert()
		{
			DatabaseObject_Helper_UserManager::addRewardPointToUser($this->_db, $this->User_referee_id, '16', 'addition of user measurement', $_SERVER['REMOTE_ADDR'], $this->username, $this->User_referee_id, $this->User_referee_id);
			
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
		
		protected function preInsert()
		{
			return true;
		}
		
		public function loadForPost($User_referee_id){
			$select = $this->_db->select();
			$select->from($this->_table, '*')
					->where('User_referee_id = ?', $User_referee_id);
					
			echo $select.'<br />';
			return $this->_load($select);
		}
		
	}
?>