
<div id="navp">
		<ul>
			<li {if $section=='inbox'}class="active"{/if}><a href="{geturl action='index' controller='message'}">Inbox</a></li>
			<li {if $section=='outbox'}class="active"{/if}><a href="{geturl action='outbox' controller='message'}">Outbox</a></li>
			
			{if $userType=='buyer'}
			<li {if $section=='compose'}class="active"{/if}><a href="{geturl username=vedancewear action='write' route='message'}">Compose</a></li>
			{else}
			<li {if $section=='compose'}class="active"{/if}><a href="{geturl action='compose' controller='message'}">Compose</a></li>
			{/if}
		</ul>
</div>
