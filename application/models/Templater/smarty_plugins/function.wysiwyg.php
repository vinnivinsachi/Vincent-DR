<?php

	function smarty_function_wysiwyg($params, $smarty)
	{
		$name ='';
		$value='';
		
		if(isset($params['name']))
		{
			$name = $params['name'];
		}
		
		if(isset($params['value']))
		{
			$value=$params['value'];
		}
		
		$fckeditor= new FCKeditor($name);
		
		$fckeditor->BasePath = '/htdocs/js_plugin/fckeditor/';
		$fckeditor->ToolbarSet ='Basic';
		$fckeditor->Value =$value;
		$fcdeditor->Height='400';
		
		return $fckeditor->CreateHtml();
		
	}
?>