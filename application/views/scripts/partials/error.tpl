<span class="error" {if !(($error|is_array) || ($error|strlen)>0)} style="display:none;" {/if}>
	{if $error|@is_array}
		<ul>
			{foreach from=$error item=str}
				<li>{$str|escape}</li>
			{/foreach}
		</ul>
	{else}
		{$error|escape}
	{/if}
</span>