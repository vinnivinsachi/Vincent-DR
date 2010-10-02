<?php


	function smarty_function_get_monthly_blogs_summary($params, $smarty)
	{
		$options = array();
		
		$object=$params['object'];
		
		
		
		if($object =='post')
		{
			if(isset($params['liveOnly']) && $params['liveOnly'])
			{
				$options['status'] = DatabaseObject_BlogPost::STATUS_LIVE;
			}
		}
		else if($object =='product')
		{
			if(isset($params['liveOnly']) && $params['liveOnly'])
			{
				$options['status'] = DatabaseObject_Product::PRODUCT_STATUS_LIVE;
			}
		}
		else if($object =='event')
		{
			if(isset($params['liveOnly']) && $params['liveOnly'])
			{
				$options['status'] = DatabaseObject_Event::EVENT_STATUS_LIVE;
			}
		}
		
		else if($object =='universal_dues')
		{
			if(isset($params['liveOnly']) && $params['liveOnly'])
			{
				$options['status'] = DatabaseObject_UniversalDue::UNIVERSAL_DUE_STATUS_LIVE;
			}
		}
		
		
		if(isset($params['user_id']))
		{
			$options['user_id'] = (int) $params['user_id'];
		}
		$db = Zend_Registry::get('db');
		
		
		
		if($object =='post')
		{
			$summary= DatabaseObject_BlogPost::GetMonthlySummary($db, $options);
		}
		elseif($object =='product')
		{
			$summary= DatabaseObject_Product::GetMonthlySummary($db, $options);
		}
		elseif($object =='event')
		{
			$summary= DatabaseObject_Event::GetMonthlySummary($db, $options);
		}
		elseif($object =='universal_dues')
		{
			$summary= DatabaseObject_UniversalDue::GetMonthlySummary($db, $options);
		}
		
		if(isset($params['assign']) && strlen($params['assign'])>0)
		{
			$smarty->assign($params['assign'], $summary);
		}
	}
?>