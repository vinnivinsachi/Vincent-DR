<?php

	//pg 223
	class Profile_BlogPost extends Profile
	{
		public function __construct($db, $post_id=null)
		{
			parent::__construct($db, 'blog_posts_profile');//second is the table name for the profile
			
			
			//echo "<br/> here at profile_blogpost.";
			//echo "<br/>current post id at profile_blogpost: ".$post_id;
			if($post_id>0)
			{
				//echo "<br/> here at setting the id";
				$this->setPostId($post_id); //inserting the post id
			}
		}
		
		public function setPostId($postId)
		{
			$filters = array('post_id' => (int)$postId);  //this is very important because with out this being correct, you would run into foreign key errors. 
			$this->_filters=$filters;
		}
	}
			
			

?>