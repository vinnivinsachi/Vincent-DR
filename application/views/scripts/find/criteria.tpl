<div id='criteria'>
<div id='criteria-bg-t'></div>
<div id='criteria-bg-b'></div>

	{include file='find/criteriaSelect.tpl'}
	
	{include file='find/criteriaCurrent.tpl'}

	{literal}
	<script type='text/javascript'>
		$j('#criteria').mouseover(function(){
				$j('#criteria-current').hide();
				$j('#criteria-select').show();
			});
		$j('#criteria').mouseout(function(){
				$j('#criteria-select').hide();
				$j('#criteria-current').show();
			});
	</script>
	{/literal}

</div>
