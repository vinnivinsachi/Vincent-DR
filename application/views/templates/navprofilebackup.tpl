{if $user->user_type=='member'}
<div id="navp">
		<ul>
			<li {if $section=='preview'}class="active"{/if}><a href="{geturl username=$user->username route='clubpreview'}">Profile</a></li>
			
		</ul>
</div>
{elseif $user->user_type=='clubAdmin'}


<div id="navp">
		<ul>
			<li {if $section=='preview'}class="active"{/if}><a href="{geturl username=$user->username route='clubpreview'}">Profile</a></li>
			<li {if $section=='posts'}class="active"{/if}><a href="{geturl username=$user->username route='clubpost'}">Posts</a></li>
			<li {if $section=='products'}class="active"{/if}><a href="{geturl username=$user->username route='clubproduct'}">Product</a></li>
			<li {if $section=='events'}class="active"{/if}><a href="{geturl username=$user->username route='clubevent'}">Events</a></li>
			<li {if $section=='memberships'}class="active"{/if}><a href="{geturl memberusername=$user->username route='clubmemberdue'}">Memberships</a></li>
			
			
			{if $identity->userId==null}
			
			<li {if $section=='individualDue'}class="active"{/if}><a href="{geturl route='clubmemberindividualdue' memberusername=$user->username}">Individual Due</a></li>
			
			
			{elseif $identity->userId != $user->userID}
			<li {if $section=='individualDue'}class="active"{/if}><a href="{geturl route='clubmemberindividualdue' memberusername=$user->username}">Individual Due</a></li>
			{/if}
		</ul>
</div>
{/if} 