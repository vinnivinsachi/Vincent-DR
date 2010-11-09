<?php
	class Profile_UniversalDue extends Profile
	{
		public function __construct($db, $univeralDue_id = null)
		{
			parent::__construct($db, 'universal_dues_profile');
			
			//echo "<br/>here at profile construct<br/>";
			
			if($univeralDue_id>0)
			{
				$this->setUniversalDueId($univeralDue_id);
			}
		}
		
		public function setUniversalDueId($univeralDue_id)
		{
			$filters = array('universal_dues_id'=>(int)$univeralDue_id);
			$this->_filters = $filters;
		}
		
		
	}

?>