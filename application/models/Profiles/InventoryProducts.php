<?php
	class Application_Profiles_InventoryProfile extends Profile
	{
		public function __construct($db, $product_id = null)
		{
			parent::__construct($db, 'productInventoryProfile');
			
			//echo "<br/>here at profile construct<br/>";
			
			if($product_id>0)
			{
				$this->setPostId($product_id);
			}
		}
		
		public function setProductId($product_id)
		{
			$filters = array('productInventoryID'=>(int)$product_id);
			$this->_filters = $filters;
		}
	}

?>