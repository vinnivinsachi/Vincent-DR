{include file="layouts/$layout/header.tpl"}

<div id='content-wide'>
	
		
	    <fieldset> 	
			<legend>{$user->username}</legend>
		    <table class='right-align-table'>
				
				<tr>
					<td>Affiliation:</td>
					<td><b>{$user->affiliation}</b></td>
				</tr>
				
				<tr>
					<td>Dance Experience:</td>
					<td><b>{$user->experience}</b></td>
				</tr>

			</table>
		</fieldset>  

</div>

{include file="layouts/$layout/footer.tpl"}