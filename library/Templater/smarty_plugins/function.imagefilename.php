<?php

	function smarty_function_imagefilename($params, $smarty)
	{
		if(!isset($params['id']))
		{
			$params['id']=0;
		}
		
		if(!isset($params['w']))
		{
			$params['w']=0;
		}
		
		if(!isset($params['h']))
		{
			$params['h']=0;
		}
		
		require_once $smarty->_get_plugin_filepath('function', 'geturl');
		
		$hash = DatabaseObject_Image::GetImageHash(
			$params['id'], $params['w'], $params['h']);
		
		$options = array('controller' => 'utility', 'action' =>'image');
		$username=$params['username'];
		
		return sprintf('%s?id=%d&w=%d&h=%d&hash=%s&username=%s', smarty_function_geturl($options, $smarty), $params['id'], $params['w'], $params['h'], $hash, $username);
	}

?>