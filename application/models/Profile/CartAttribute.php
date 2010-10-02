<?php
	
	class Profile_CartAttribute extends Profile
	{
	
		public function __construct($db, $profile_id=null)
		{
			parent::__construct($db, 'shopping_cart_profile_attribute');//second is the table name for the profile
			
			
			//echo "<br/> here at profile_blogpost.";
			//echo "<br/>current post id at profile_blogpost: ".$post_id;
			if($profile_id>0)
			{
				//echo "<br/> here at setting the id";
				$this->setPostId($profile_id); //inserting the post id
			}
		}
		
		public function setPostId($profile_id)
		{
			$filters = array('profile_id' => (int)$profile_id);  //this is very important because with out this being correct, you would run into foreign key errors. 
			$this->_filters=$filters;
		}
	}
			
			

?>