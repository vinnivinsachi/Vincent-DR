{include file='header.tpl' section='account'}
	
	<p> Thank You, {$user->profile->first_name|escape},
	Your details have been updated.
	</p>
{include file='footer.tpl' leftcolumn='lib/university-list.tpl' products=$cartObject}	