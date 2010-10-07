{include file="layouts/$layout/header.tpl" lightbox=true}
<div id="leftContainer" style="width:190px; float:left;">
    
        	<div class='titleBarBig'>My listing categories</div>
        	
           	<ul id="qm0" class="qmmc" >
				<li><a href="{geturl action='viewpendingproduct'}?tag=all" style='font-size:1.2em;'>ALL LISTINGS</a></li>
				
				{foreach from=$menuBars item=menubar key=Key}
                		{if $Key=='JEWELRY' || $Key=='ACCESSORIES'}
                			{if $menubar|@count>0}
		                	    <li><a class="qmparent" href="javascript:void(0)" style='font-size:1.2em;'>{$Key}</a>
		                			<ul>
		                			{foreach from=$menubar item=ItemSetOne}
		                				<li><a href="{geturl action='viewpendingproduct'}?tag={$ItemSetOne}">{$ItemSetOne}</a></li>
		                			{/foreach}
		                			</ul></li>
		                	{/if}
                		{elseif $Key=='MEN'}
                			{if $menubar|@count>0}
		                		<li><a class="qmparent" href="javascript:void(0)" style='font-size:1.2em;'>{$Key}</a>
		                		    <ul>
		                			{foreach from=$menubar item=ItemSetTwo key=KeyTwo}
		                				{if $KeyTwo=='Shirts'||$KeyTwo=='Pants'||$KeyTwo=='Vests'||$KeyTwo=='Jackets'}
		                					<li><a href="{geturl action='viewpendingproduct'}?tag={$ItemSetTwo}">{$ItemSetTwo}</a></li>
		                				{else}
		                	    			<li><a class="qmparent" href="javascript:void(0)">{$KeyTwo}</a>
		                	    				<ul>
		                					{foreach from=$ItemSetTwo item=ItemSetThree}
		                						<li><a href="{geturl action='viewpendingproduct'}?tag={$ItemSetThree}">{$ItemSetThree}</a></li>
		                					{/foreach}
		                						</ul>
		                					</li>
		                				{/if}
		                			{/foreach}
		                			</ul></li>
		                	{/if}
                		{elseif $Key=='WOMEN'}
                			{if $menubar|@count>0}
								<li><a class="qmparent" href="javascript:void(0)" style='font-size:1.2em;'>{$Key}</a>
							         <ul>
	                			{foreach from=$menubar item=ItemSetTwo key=KeyTwo}
	                				{if $KeyTwo=='Ladies tops'}
	                					<li><a href="{geturl action='viewpendingproduct'}?tag={$ItemSetTwo}">{$ItemSetTwo}</a></li>
	                				{else}
	                	    			<li><a class="qmparent" href="javascript:void(0)">{$KeyTwo}</a>
	                	    				<ul>
	                					{foreach from=$ItemSetTwo item=ItemSetThree}
	                						<li><a href="{geturl action='viewpendingproduct'}?tag={$ItemSetThree}">{$ItemSetThree}</a></li>
	                					{/foreach}
	                						</ul>
	                					</li>
	                				{/if}
	                			{/foreach}
	                			      </ul>
	                			</li>
	                		{/if}
                		{/if}
                {/foreach}
               	<li><a href="{geturl action='viewpendingproduct'}?status=removed" style='font-size:1.2em;'>REMOVED</a></li>
           </ul>
        
<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all', 'main' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
{literal}
<script type="text/javascript">qm_create(0,true,0,500,'all',false,false,false,false);</script>
{/literal}
    
    </div>

<div id="rightContainer" style='width:790px; float:right;'>

        <div class='titleBarBig'>My listings<span style='float:right; font-weight:normal;'><a href="#" style='padding-right:5px;'>Help</a></span></div>
                {if $productList|@count>0}
        
    	<table width="100%" id="productListTable">
            	<tr class='trTitle'>
                	<td>Name</td>
                    <td>Price</td><!--
                    <td>RP</td>
                    --><td>Category</td>
                   <td>
                    	<select id="productBrandJavascript">
                    	    <option value="All">Brand</option>
                        	<option value="All">All</option>
                        	{foreach from=$brands item=brand}
                            <option value='{$brand.brand}'>{$brand.brand}</option>
                            {/foreach}
                        </select></td>
                     <td>
                     	<select id="productStatusJavascript">
                     	    <option value="All">Status</option>
                        	<option value="All">All</option>
                        	<option value="Unlisted">Unlisted</option>
                            <option value="Listed">Listed</option>
                        </select></td>
                     <td>
                     	<select id="productTypeJavascript">
                    	    <option value="All">Type</option>
                        	<option value="All">All</option>
                        	<option value="Customizable">Customizable</option>
                            <option value="Buy_now">Buy now</option>
                        </select></td>
                    <td>Created</td>
                    
                    <td style='width:111px;'>Actions</td>
    	{foreach from=$productList item=product}
    		
        		<tr class="{$product.product_type} {$product.brand} {$product.status} {$product.purchase_type} itemRow" style='border-bottom: 2px solid white;'>
                	<td>{if $product.purchase_type=='Customizable'}
 <a href="{geturl controller='productlisting' action='editcustomproduct'}?purchase_type={$product.purchase_type}&category={$product.product_category}&type={$product.product_type}&tag={$product.product_tag}&id={$product.product_id}">{$product.name}</a>
 						{elseif $product.purchase_type=='Buy_now'}
 						 <a href="{geturl controller='productlisting' action='editbuynowproduct'}?purchase_type={$product.purchase_type}&category={$product.product_category}&type={$product.product_type}&tag={$product.product_tag}&id={$product.product_id}">{$product.name}</a>
 						{/if}
                	</td>
                    <td>${$product.price}</td><!--
                    <td>{$product.reward_point}</td>
                    --><td>{$product.product_tag}</td>
                    <td>{$product.brand}</td>
                    <td>{$product.status}</td>
             		<td>{removeunderscore phrase=$product.purchase_type}</td>
             		<td>{$product.ts_created|date_format:"%m/%d/%Y"}</td>
					<td>
                		{assign var='status' value=$product.status}
                    	{include file="productlisting/_actions/_$status.tpl"}
                    </td>
               	</tr>
                
        {/foreach}
        </table>
        {else}
        There are no products here. 
        {/if}
	</div>
    
    {literal}
		<script src="/public/resources/javascripts/inventorySelector/inventorySelector.js" type="text/javascript"></script>
        <script type="text/javascript">
			new productListing('productListTable');
		</script>
    {/literal}
{include file="layouts/$layout/footer.tpl"}