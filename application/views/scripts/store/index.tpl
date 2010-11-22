{include file="layouts/$layout/header.tpl"}

<div id='content-wide'>

<h1>All Stores</h1>
{foreach from=$stores item=store}
	<a href='{$siteRoot}/store/profile?storeName={$store->storeName}'>{$store->storeDisplayName}</a><br />
{/foreach}

</div>

{include file="layouts/$layout/footer.tpl"}
