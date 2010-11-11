<?php
	function smarty_function_removeunderscore($params, $smarty)
	{
		
		$newString = str_replace('_', ' ', $params['phrase']);
		$newString = str_replace('sys ','',$newString);
		$newString = str_replace('Measurement ','',$newString);
		$newString = str_replace('shoe metric','size system', $newString);
		//$newString = str_replace('mea');
		$newString = trim($newString);
		$newString = ucfirst(strtolower($newString));
		return $newString;
	}
?>