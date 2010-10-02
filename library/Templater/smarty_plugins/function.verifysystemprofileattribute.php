<?php
	function smarty_function_verifysystemprofileattribute($profilekey, $value, $smarty)
	{
		if((substr($profilekey,0, 4)='sys_') && ($value!='NULL')){
			return true;
		}
	}
?>