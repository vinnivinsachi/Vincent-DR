<?php

	class Breadcrumbs
	{
		private $_trail=array();
		
		public function addStep($title, $link='')
		{
			$this->_trail[]=array('title'=>$title,
								  'link' =>$link);
			//echo "One trail added<br/>";
		}
		
		public function getTrail()
		{
			return $this->_trail;
		}
		
		public function getTitle()
		{
			//echo "current count trail: ".count($this->_trail)."<br/>";
			if(count($this->_trail) ==0)
			{
				//echo "current getTitle is NULL";
				return null;
			}
			
			return $this->_trail[count($this->_trail)-1]['title'];
		}
	}
?>