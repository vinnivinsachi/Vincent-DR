<?php
	class Profile_Event extends Profile
	{
		public function __construct($db, $event_id = null)
		{
			parent::__construct($db, 'events_profile');
			
			//echo "<br/>here at profile construct<br/>";
			
			if($event_id>0)
			{
				$this->setEventId($event_id);
			}
		}
		
		public function setEventId($event_id)
		{
			$filters = array('event_id'=>(int)$event_id);
			$this->_filters = $filters;
		}
	
	}

?>