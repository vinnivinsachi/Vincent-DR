<?php
	
	class Profile_User extends Profile
	{
		public function __construct($db, $userID = null)
		{
			parent::__construct($db, 'users_profiles');
			
			if($userID >0)
			{
				$this->setUserId($userID);
			}
		}
		
		public function setUserId($userID)
		{
			$filters = array('userID'=>(int) $userID);
			$this->_filters = $filters;  //this is require for the parent
			//Profile.php to load. 
		}
	
	}
?>