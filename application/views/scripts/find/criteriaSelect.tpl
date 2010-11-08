<div id='criteria-select'>

<div id='criteria-select-bg-t'></div>
<div id='criteria-select-bg-b'></div>

	<table>
	<tr>
	<td class='icon-column'>
		<ul id='criteria-select-icon-list'>
			<li><img src='{$imagesDir}/criteria/criteria-icon-color_off.jpg'/></li>
			<li><img src='{$imagesDir}/criteria/criteria-icon-price_off.jpg'/></li>
			<li><img src='{$imagesDir}/criteria/criteria-icon-heel_off.jpg'/></li>
		</ul>
	</td>
	
	<td class='criteria-column'>
		<ul id='criteria-select-content-list'>
			<li>
				<ul>
					<li>Black</li>
					<li>Brown</li>
					<li>Yellow</li>
					<li>Green</li>
					<li>Pink</li>
					<li>Red</li>
					<li>Pinstripe</li>
					<li>Other</li>
				</ul>
			</li>
			<li>
				<ul>
					<li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~$100</li>
					<li> $100~$200</li>
					<li> $200~$500</li>
					<li> $500~$1000</li>
					<li>$1000~$5000</li>
					<li>$5000~</li>
				</ul>
			</li>
			<li>
				<ul>
					<li>0"</li>
					<li>0.5"</li>
					<li>1"</li>
					<li>1.5"</li>
					<li>2"</li>
					<li>2.5"</li>
					<li>3"</li>
					<li>over 3"</li>
				</ul>
			</li>
		</ul>
	</td>
	</tr>
	</table>
	
	
	<!-- JAVASCRIPT -->
	<script type='text/javascript' src='{$jsDir}/jquery/plugins/rolloverTabs.jquery.js'></script>
	{literal}
	<script type='text/javascript'>
		// create rollover tabs menu from criteria
		$j('#criteria-select-icon-list').rolloverTabs({
				'rolloverImages': true,
				'contentListId'	: 'criteria-select-content-list'
			});

		// rollover styling for criteria contents
		$j('#criteria-select-content-list li ul li').hover(function(){$j(this).toggleClass('hover');});
		// toggle criteria contents styling
		$j('#criteria-select-content-list li ul li').click(function(){$j(this).toggleClass('selected');});
	</script>
	{/literal}
		
</div>
