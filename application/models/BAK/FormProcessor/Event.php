<?php
	class FormProcessor_Event extends FormProcessor
	{
		protected $db = null;
		public $user = null;
		public $event = null;
		
		
		public function __construct($db, $userID, $event_id=0)
		{
			parent::__construct();
			
			$this->db = $db;
			$this->user= new DatabaseObject_User($db);
			$this->user->load($userID); //load everything about the user.
			
			$this->event= new DatabaseObject_Event($db);			
			
			$databaseColumn = 'event_id';
			
			DatabaseObject_StaticUtility::loadObjectForUser($this->event, $this->user->getId(), $event_id, $databaseColumn);
			
			if($this->event->isSaved())
			{
				//echo "<br/>post at is saved.";
				$this->name= $this->event->profile->name;
				$this->content = $this->event->profile->content;
				$this->ts_created = $this->event->ts_created;
				$this->ts_end= $this->event->ts_end;
			}
			else
			{
				//echo "<br/>post user_id is getId(): ".$this->user->getId();
				$this->event->user_id = $this->user->getId(); //$this->user_id at blogPost object came from this. 
			}
		}
		
		
		public function process(Zend_Controller_Request_Abstract $request)
		{
			
			//echo "<br/>here at process.";
			$this->name = $this->sanitize($request->getPost('title'));
			$this->name = substr($this->name, 0, 255);
			
			if(strlen($this->name)==0)
			{
				$this->addError('title', 'Please enter a title for this post'); //this is a giving FormProcessor.php function. 
			}
			
			$cdate = array('y' => (int)$request->getPost('ts_createdYear'),
						  'm' => (int)$request->getPost('ts_createdMonth'),
						  'd' => (int)$request->getPost('ts_createdDay')
						  );
			
			$ctime = array('h' =>(int) $request->getPost('ts_createdHour'),
						  'm' =>(int) $request->getPost('ts_createdMinute')
						  );
			
			$ctime['h'] = max(1, min(12, $ctime['h']));
			$ctime['m'] = max(0, min(59, $ctime['m']));
			
			$cmeridian = strtolower($request->getPost('ts_createdMeridian'));
			
			
			
			if($cmeridian !='pm')
			{
				$cmeridian = 'am';
			}
			
			//conver the hour into 23 hour time
			if($ctime['h'] <12 && $cmeridian =='pm')
			{
				$ctime['h']+=12;
			}
			else if($ctime['h']==12 && $cmeridian =='am')
			{
				$ctime['h'] =0;
			}
			
			if(!checkDate($cdate['m'], $cdate['d'], $cdate['y']))
			{
				$this->addError('ts_created', 'Please select a valid date');
			}
			
			$this->ts_created = mktime($ctime['h'],
									   $ctime['m'],
									   0,
									   $cdate['m'],
									   $cdate['d'],
									   $cdate['y']
									  	);
										
			//echo "<br/>you are at the end of firs ttime";
			//------------------------------------------------------------------------------
			$edate = array('y' => (int)$request->getPost('ts_endYear'),
						  'm' => (int)$request->getPost('ts_endMonth'),
						  'd' => (int)$request->getPost('ts_endDay')
						  );
			
			$etime = array('h' =>(int) $request->getPost('ts_endHour'),
						  'm' =>(int) $request->getPost('ts_endMinute')
						  );
			
			$etime['h'] = max(1, min(12, $etime['h']));
			$etime['m'] = max(0, min(59, $etime['m']));
			
			$emeridian = strtolower($request->getPost('ts_endMeridian'));
			
			if($emeridian !='pm')
			{
				$emeridian = 'am';
			}
			
			//conver the hour into 23 hour time
			if($etime['h'] <12 && $emeridian =='pm')
			{
				$etime['h']+=12;
			}
			else if($etime['h']==12 && $emeridian =='am')
			{
				$etime['h'] =0;
			}
			
			if(!checkDate($edate['m'], $edate['d'], $edate['y']))
			{
				$this->addError('ts_created', 'Please select a valid date');
			}
			
			$this->ts_end = mktime($etime['h'],
									   $etime['m'],
									   0,
									   $edate['m'],
									   $edate['d'],
									   $edate['y']
									  	);
			//echo "<br/>you are at the end of the second time";
			//-----------------------------------------------------------------------------
			$this->ticket_price = $this->sanitize(trim(($request->getPost('ticket_price'))));
			
			
			//echo "<br/>your ticket_price is: ".$this->ticket_price;
			if($this->ticket_price == 'FREE')
			{
				//echo "<br/>after ticket_price";
				$this->ticket_price=(int)0;
				//echo "<br/>after ticket_price is: ".$this->ticket_price;
			}
			
			if($this->ticket_price =='')
			{
				$this->ticket_price=(int)0;
			}
			if(!is_numeric($this->ticket_price))
			{
				$this->addError('ticket_price', 'Please enter a valid product price');
			}
		
			$this->content = FormProcessor_BlogPost::cleanHtml($request->getPost('content'));
			
			
			$this->location = $this->sanitize($request->getPost('location'));
			//echo "<br/>you are at after clean HTML";
			
			if(!$this->hasError())
			{
			
				//echo "<br/>you are at no error";
				$this->event->profile->name = $this->name;
				$this->event->profile->price = $this->ticket_price;
				$this->event->profile->content = $this->content;
				$this->event->ts_created = $this->ts_created;
				$this->event->ts_end = $this->ts_end;
				$this->event->profile->location = $this->location;
				
				//echo "<br/>you are at before save()";
				$this->event->save();
				
			}
			
			
			//echo "<br/>you are at before return";
			return !$this->hasError();
		
		
		}
		

	}	


?>