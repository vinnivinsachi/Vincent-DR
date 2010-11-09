<?php
// this class handles all the images that are being added as a product attribute image. 
// such as a product may have an image associated attribute like color or fabric or heel or size. 


	class DatabaseObject_Measurement_MenMeasurement extends DatabaseObject
	{
	
		
		public function __construct($db)
		{	
			parent::__construct($db, 'user_men_measurement', 'user_men_measurement_id');
			$this->add('User_referee_id');
			$this->add('body_height');
			$this->add('chest');
			$this->add('hip');
			$this->add('length_pants');
			$this->add('neck');
			$this->add('shoulder');
			$this->add('thigh');
			$this->add('waist');
			$this->add('waist_floor');
			$this->add('armpit_circumference');
			$this->add('arm_length');
			$this->add('shoulder_to_waist');
			$this->add('ts_created', time(), self::TYPE_TIMESTAMP);
		}

		protected function postLoad()
		{

		}
		
		protected function postInsert()
		{
			
			DatabaseObject_Helper_Usermanager::addRewardPointToUser($this->_db, $this->User_referee_id, '20', 'addition of user measurement', $_SERVER['REMOTE_ADDR'], $this->User_referee_id);
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