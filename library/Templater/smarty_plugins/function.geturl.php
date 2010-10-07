<?php

	function smarty_function_geturl($params, $smarty)
	{
		$action = isset($params['action'])?$params['action']:null;
		$controller = isset($params['controller'])?$params['controller']:null;
		$route = isset($params['route'])?$params['route']:null;
		
		$helper = Zend_Controller_Action_HelperBroker::getStaticHelper('url');
		
		if(strlen($route)>0)
		{
			unset($params['route']);
			$url=$helper->url($params,$route);
		}
		else
		{
		$request = Zend_Controller_Front::getInstance()->getRequest();
		
		$url = rtrim($request->getBaseUrl(), '/');
		$url .=$helper->simple($action, $controller);
		}
		
		return $url;
	}
?>