{get_tag_summary user_id=$identity->getId() object="universal_dues" assign=summary}

{if $summary|@count>0}
	<div id="preview-tags2" class="box">
		<h3>Your Dues Categories</h3>
		<ul>
			{foreach from=$summary item=tag}
			<li>
				<a href="{geturl controller='membershipmanager'}?tag={$tag.tag}">
				{$tag.tag|escape}
				</a>
				
				({$tag.count} post{if $tag.count != 1}s{/if})
			</li>
			{/foreach}
		</ul>
	</div>
	
<script type="text/javascript" src="/htdocs/js_plugin/BlogTagSummary.class.js"></script>
<script type="text/javascript">new BlogTagSummary('month-preview', 'preview-tags2');</script>
	
{/if}

{get_monthly_blogs_summary user_id=$identity->getId() object="universal_dues" assign=summary}

{if $summary|@count >0}
	<div id="preview-months" class="box">
		<h3>Your Dues Archives</h3>
		<ul>
			{foreach from=$summary key=month item=numPosts}
				<li>
					<a href="{geturl controller='membershipmanager'}?month={$month}">
						{$month|date_format:'%B %Y'}
					</a>
					({$numPosts} post{if $numPosts!=1}s{/if})
				</li>
			{/foreach}
		</ul>
	</div>

<script type="text/javascript" src="/htdocs/js_plugin/BlogMonthlySummary.class.js"></script>
<script type="text/javascript">new BlogMonthlySummary('month-preview', 'preview-months');</script>

{/if}