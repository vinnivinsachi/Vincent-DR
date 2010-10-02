<?php
	class Profile_Product_Pants extends Profile
	{
		public function __construct($db, $product_id = null)
		{
			parent::__construct($db, 'PantsProfile');
			
			//echo "<br/>here at profile construct<br/>";
			
			if($product_id>0)
			{
				$this->setPostId($product_id);
			}
		}
		
		public function setProductId($product_id)
		{
			$filters = array('Pants_id'=>(int)$product_id);
			$this->_filters = $filters;
		}
	}

?>