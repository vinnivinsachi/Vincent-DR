<?php
	class Profile_Promotion extends Profile
	{
		public function __construct($db, $promotion_id = null)
		{
			parent::__construct($db, 'promotions_profile');
			
			//echo "<br/>here at profile construct<br/>";
			
			if($promotion_id>0)
			{
				$this->setPromotionId($promotion_id);
			}
		}
		
		public function setPromotionId($promotion_id)
		{
			$filters = array('promotion_id'=>(int)$promotion_id);
			$this->_filters = $filters;
		}
	
	}

?>