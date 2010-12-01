


	<tr class="row">
		<td {if $post->payment_status=='paid'}class="live"{else}class="draft"{/if}>
			
				{$post->profile->name}
		
		</td>
		
		<td>
			{$post->profile->price}
		</td>
		<td>
			{$post->profile->content}
		</td>
		<td>
			{$post->payment_status}
		</td>
		
		<td>
			<a href="{geturl action='individualduepreview'}?key={$post->getId()}">View details</a>
		</td>
			
	</tr>
