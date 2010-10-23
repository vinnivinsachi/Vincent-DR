{include file="layouts/$layout/header.tpl" lightbox=true}

<div id="leftContainer" style="width:210px; float:left;">

{include file='adminorders/_orderStatusControls/_orderTabs.tpl'}

</div>

<div id="rightContainer" style='width:790px; float:left;'>
{include file="adminorders/_orderProfileDetails/$viewType"}
    
     

</div>           
{include file="layouts/$layout/footer.tpl"}