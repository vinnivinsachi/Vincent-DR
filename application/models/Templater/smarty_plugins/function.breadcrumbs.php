<?php
	function smarty_function_breadcrumbs($params, $smarty)
	{
		$defaultParams = array('trail' 		=>array(),
							   'separator'	=>' > ',
							   'truncate'	=>40);
		
		//echo"here";
		//initialize the paramters
		
		//echo "<br/>params count: ".count($params)."<br/>";
		foreach($params as $k =>$v)
		{
			if(isset($params[$k]))
			{
				$params[$k]=$v;
				//echo "params[k]: ".$params[$k]."<br/>";
			}
		}
		
		//load the truncate modifier
		if($params['truncate']>0)
		{
			require_once $smarty->_get_plugin_filepath('modifier', 'truncate');
		}
		
		$links = array();
		
		$numSteps = count($params['trail']);
		//echo "current numSteps are: ".$numSteps."<br/>";
		for($i =0; $i<$numSteps; $i++)
		{
			//echo "numSteps in for loops: ".$numSteps."<br>";     
			$step = $params['trail'][$i];
			//echo "the step are here: ".$step['title'];
			//echo "the link are here: ".$step['link'];
			
			//truncate the title if required
			if($params['truncate']>0)
			{
				$step['title']=smarty_modifier_truncate($step['title'], $params['truncate']);
			}
				
				//build the link if it's set and isn't the last step
			if(strlen($step['link']) >0 && $i <($numSteps -1))
			{
				$link[] = sprintf('<a href="%s" title="%s">%s</a>',
									htmlSpecialChars($step['link']),
									htmlSpecialChars($step['title']),
									htmlSpecialChars($step['title']));
			}
			else
			{
				$link[] = htmlSpecialChars($step['title']);
			}
			
			//join the links using the specified separator
		}
			//echo $params['separator'];
			return join('  &raquo;  ', $link);

	}


?>