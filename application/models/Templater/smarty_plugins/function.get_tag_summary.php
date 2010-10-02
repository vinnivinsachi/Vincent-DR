<?php 
	
	function smarty_function_get_tag_summary($params, $smarty)//pass in userid. and then it go and grabs the tags with all the post and tags form that id. 
	
	{
		$db = Zend_Registry::get('db');
		
		$user_id = (int) $params['user_id'];
		
		$object = $params['object'];
		
		if($object =='post')
		{
			$summary = DatabaseObject_BlogPost::GetTagSummary($db, $user_id);
		}
		elseif($object =='post_cat')
		{
			$summary = DatabaseObject_BlogPost::GetCatSummary($db, $user_id);

		
		}
		elseif($object =='product')
		{
			//echo "you are here";
			$summary = DatabaseObject_Product::GetTagSummary($db, $user_id);
		}
		elseif($object =='event')
		{
			//echo "you are here";
			$summary = DatabaseObject_Event::GetTagSummary($db, $user_id);
			
			//echo "you summary count is: ".count($summary);
		}
		elseif($object =='universal_dues')
		{
			$summary = DatabaseObject_UniversalDue::GetTagSummary($db, $user_id);
		}
		elseif($object == 'product_cat')
		{
			$summary = DatabaseObject_Product::GetCatSummary($db, $user_id);
		}
		
		if(isset($params['assign']) && strlen($params['assign']) >0)
		{
			$smarty->assign($params['assign'], $summary);
		}
		
	}
?>