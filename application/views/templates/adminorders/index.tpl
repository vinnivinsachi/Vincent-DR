{include file="layouts/$layout/header.tpl" lightbox=true}


<div id="leftContainer" style="width:210px; float:left;">
Welcome to order management, {$signedInUser->generalInfo->first_name}.<br />
<br/>

<a href="{geturl controller='ordermanager' action='automatedeliveryttocomplete'}"><strong>Automate [delivered/return delivered] to [order completed/return completed]</strong></a>
<br /><br />
<br />

{include file='adminorders/_orderStatusControls/_orderTabs.tpl'}
</div>

{literal}
<!--<script type="text/javascript">
$j(document).ready(function(){
							
							$j('#orderTabs').tabs({
								load: function(event, ui) {
									$j('a', ui.panel).click(function() {
										$j(ui.panel).load(this.href);
										return false;
									});
								}
});
});
</script>-->
{/literal}
{include file="layouts/$layout/footer.tpl"}