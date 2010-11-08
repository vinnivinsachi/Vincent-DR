<div id='criteria-current'>

	<table>
		<tr>
			<td class='icon-column'><img src='{$imagesDir}/criteria/criteria-icon-color_off.jpg'/></td>
			<td class='criteria-column'>
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
			</td>
		</tr>
		<tr class='criteria-current-line'><td colspan='2'></td></tr>
	</table>
	
	
	<table>
		<tr>
			<td class='icon-column'><img src='{$imagesDir}/criteria/criteria-icon-price_off.jpg'/></td>
			<td class='criteria-column'>
				<ul>
					<li> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~$100</li>
					<li> $100~$200</li>
					<li> $200~$500</li>
					<li> $500~$1000</li>
					<li>$1000~$5000</li>
					<li>$5000~</li>
				</ul>
			</td>
		</tr>
		<tr class='criteria-current-line'><td colspan='2'></td></tr>
	</table>
	
	<table><tr>
		<td class='icon-column'><img src='{$imagesDir}/criteria/criteria-icon-heel_off.jpg'/></td>
		<td class='criteria-column'>
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
		</td>
	</tr></table>
	
	
	<!-- JAVASCRIPT -->
	{literal}
	<script type='text/javascript'>
		// first hide all current criteria
		$j('#criteria-current td.criteria-column li').hide();
		// show selected criteria in current criteria list
		$j('#criteria-select-content-list li ul li').click(function(){
			parentIndex = $j(this).parent().parent().index(); // get index of category (color / price / etc)
			index = $j(this).index(); // get index of selection (brown / black / etc)
			criteria = $j('#criteria-current > table').eq(parentIndex).find('td.criteria-column:first').find('ul > li').eq(index); // get criteria in question
			// show if selected / hide if deselected
			if($j(this).hasClass('selected')){ criteria.show(); }
			else{ criteria.hide(); }
		});
	</script>
	{/literal}
	
</div>