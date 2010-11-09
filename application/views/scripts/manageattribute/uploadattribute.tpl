{include file="layouts/$layout/header.tpl" lightbox=true}
	<br/>
	Name of attribute: {$attribute.name}<br/>
	<div>
		<form method='post' action="{geturl controller='manageattribute' action='uploadattribute'}?actioncall=3&paramSet={$attribute.table}">
			<!--<a href="{geturl controller='manageattribute' action='uploadattribute'}?actioncall=3&paramSet={$attribute.table}&id={$detail.id}">delete</a>-->
			{foreach from=$attribute.details item=detail}
			<input type="checkbox" name='image_id[{$detail.id}]' value='{$detail.id}' />
			{$detail.details_name} / {$detail.price_offset} 
				{if $detail.filename!=NULL}
					<img src='/public/resources/userdata/tmp/thumbnails/{$detail.username}/{$attribute.attributeTable}/{$attribute.name}/{$detail.id}.W30_miniDetailImage.jpg'>
				{/if}
				<br/>
			{/foreach}
			<button onclick="showloadingImage()">Delete selected color/fabric(s)</button>
		</form>
	</div>
	
	<div>
		<div id="customAttributeSetsCreationMainDiv">
	
		</div>
		<div id='createNewAttributeDivControls'>
			Name of new color/fabric set: <input type="text" value='{$attribute.name}' id='newAttributeSetNameInputID' style='display:none';/><button type='button' onclick="createNewAttributeSet('newAttributeSetNameInputID', 'customAttributeSetsCreationMainDiv', 'createNewAttributeDivControls', '2', '{$attribute.table}','{$attribute.id}')">Add more colors to this color/fabric set</button>
		</div>
	</div>
{include file="layouts/$layout/footer.tpl"}