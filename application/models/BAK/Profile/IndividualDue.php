<?php
	class Profile_IndividualDue extends Profile
	{
		public function __construct($db, $individualDue_key = null)
		{
			parent::__construct($db, 'individual_dues_profile');
			
			//echo "<br/>here at profile construct<br/>";
			
			if(strlen($individualDue_key)>0)
			{
				$this->setIndividualDueId($individualDue_key);
			}
		}
		
		public function setIndividualDueId($individualDue_key)
		{
			$filters = array('individual_dues_key'=>$individualDue_key);
			$this->_filters = $filters;
		}
		
	}
?>