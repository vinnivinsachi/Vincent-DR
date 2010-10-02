 <div id='productTagBody' class='box' style="width:100%;">

 {foreach from=$products item=product}
 	<div class="productBox box" style="width:30%; height:220px; margin-right: 3%; margin-bottom:30px; ">
         <div class='productBoxLeft box' style="width:191px; height:200px; border:1px solid #eee; z-index:0;" >
         		<table>
         		<tr height='200px;' ><td style='padding:0px; margin:0px; width:191px;' align="center">
         		<div class="productFirstImage">
                	<div class="productDescription">
                       
                    </div>
                    {if isset($product.product_inventory_id)}
             			<a class='fullOrderDetailsColorBox' href="{geturl controller='productdisplay' action='purchasedetails'}?number={$product.product_inventory_id}&product=inventory" >
             		{elseif $product.purchase_type=='Buy_now'}
             			<a class='fullOrderDetailsColorBox' href="{geturl controller='productdisplay' action='purchasedetails'}?number={$product.product_id}&product=products" >
             		{else}
             			<a class='fullOrderDetailsColorBox' href="{geturl controller='productdisplay' action='purchasedetails'}?number={$product.product_id}&product=products">
             		{/if}
                	{if $product.images|@count>0}
                
                	<img src="/public/resources/userdata/tmp/thumbnails/{$product.uploader_username}/{$product.product_tag}/{$product.images[0].image_id}.W191_productFirstImage.jpg"/>
                	{else}
                        No image
                    {/if}</a>
                </div>
         		</td></tr>
               </table>
                <div class="productDetails box" style='height:20px;'>
              
               {removeunderscore phrase=$product.purchase_type}
                    
               <div class="quickLook">
							<div class="priceBlock" style='padding-top:3px; font-weight:bold;'>
				                 {if $product.discount_price=='' || $product.discount_price==0}
				                  <div class="discountBoxPrice">
				                     ${$product.price}
				                  </div>
				                 {elseif $product.discount_price>0}
				                  <div class="productBoxPrice">
				                      ${$product.price}
				                   </div>
				
					               <div class="discountBoxPrice">
					                ${$product.discount_price}
					               </div>
				               {/if}
				            </div>                    
						</div>
                </div>
         </div>
         <div class='productBoxRight box' style="width:37px; height:100%;">
         	
            <table><tr height="220px;"><td style='padding:0px; margin:0px;'> 
            {if isset($controller) AND $controller=='Comparechart'}
            <div class='box' style='height:35px; text-align: center;'>  
           	 <div class='removeFromCompareChartDIV' style='display:none'>
	           	 <form class='removeFromCompareChartForm' action="{geturl controller='comparechart' action='removefromcomparelist'}">
				 	<input type='hidden' name='product' value="{if isset($product.product_inventory_id)}inventory{else}products{/if}"/>
				 	<input type='hidden' name='number' value='{if isset($product.product_inventory_id)}{$product.product_inventory_id}{else}{$product.product_id}{/if}'/>
				 </form>
			 </div>
			  <a onclick="removeFromCompareChart(this);"><img src='/public/resources/css/images/chart_minus.png' alt='Add to compare list' title='Remove from compare list'/></a>
            </div>
            {else}
           	<div class='box' style='height:35px; text-align: center;'>  
           	 <div class='addToCompareChartDIV' style='display:none'>
	           	 <form class='addToCompareChartForm' action="{geturl controller='comparechart' action='addtocomparelist'}">
				 	<input type='hidden' name='product' value="{if isset($product.product_inventory_id)}inventory{else}products{/if}"/>
				 	<input type='hidden' name='number' value='{if isset($product.product_inventory_id)}{$product.product_inventory_id}{else}{$product.product_id}{/if}'/>
				 </form>
			 </div>
			  <a onclick="addToCompareChart(this);"><img src='/public/resources/css/images/chart_add.png' alt='Add to compare list' title='Add to compare list'/></a>
            </div>
            {/if}
            <div class='box' style='height:30px;'> 
				<a><img src='/public/resources/css/images/flags/flag_{$product.uploader_network}.png' alt='From {$product.uploader_network}' title='From {$product.uploader_network}' height='30'/></a>
            </div>
            
            
            
            {if $product.video_youtube!=''}
            <div class='box' style='height:35px;'>               
                <a class='videoColorBox' href="http://www.youtube.com/v/{$product.video_youtube}"><img src="/public/resources/css/images/video_icon.png" width=37 alt='Product video' title='Product video'/></a>
            </div>    
            {/if}
             
             <div class='productBox2' style='height:35px; text-align: center;'>
             	<span class="tooltipControl box" style='margin-top:5px;'><img src='/public/resources/css/images/add_to_compare_flattened.png'/></span>
				<div class='tooltip' style='width:600px; height:400px; background-color:white; border:1px solid #eee; z-index:10;'>
				<!-- now comes the partials -->
					<div class='box' style='width:300px; height:100%;'>
						<table>
		         		<tr style='height:350px;'><td style='padding:0px; margin:0px; width:300px;'>
		         		<div class="productFirstImage">
		                	<div class="productDescription">
		                       
		                    </div>
		                	{if $product.images|@count>0}
		                	<img src="/public/resources/userdata/tmp/thumbnails/{$product.uploader_username}/{$product.product_tag}/{$product.images[0].image_id}.W300_productDetailImage.jpg"/>
		                	{else}
		                        No image
		                    {/if}
		                </div>
		         		
		         		</td></tr>
		                
		               </table>
		                <div class="productDetails box">
	                    <div class="productMedia">
	                        <div class="productImages">
	                            {foreach from=$product.images item=image}
	                                <div class="productIndividualImage">
	                                <img src="/public/resources/userdata/tmp/thumbnails/{$product.uploader_username}/{$product.product_tag}/{$image.image_id}.W50_productSmallPreview.jpg" />
	                                <span class="imageLargeAddress" style="display:none">
	                                <img src="/public/resources/userdata/tmp/thumbnails/{$product.uploader_username}/{$product.product_tag}/{$image.image_id}.W300_productDetailImage.jpg""/></span>					
	                                </div>
	                            {/foreach}
	                            {foreach from=$product.inventoryImages item=inventoryImage}
	                            	<div class="productIndividualImage">
	                                <img src="/public/resources/userdata/tmp/thumbnails/{$product.uploader_username}/inventory/{$inventoryImage.image_id}.W50_productSmallPreview.jpg" />
	                                <span class="imageLargeAddress" style="display:none">
	                                <img src="/public/resources/userdata/tmp/thumbnails/{$product.uploader_username}/inventory/{$inventoryImage.image_id}.W300_productDetailImage.jpg""/></span>					
	                                </div>
	                            {/foreach}
	                        </div>
	                    </div>
						</div>
						
				</div>
				<div class='productProfiles' style='width:260px; float:right; text-align: left; padding:0px 10px 0px 30px; background-color:#eee; height:100%;'>
	           
						{if isset($product.product_inventory_id)}
	            		{assign var='orderAttribute' value=$product.inventory_attribute_table}
	                  	{include file="productdisplay/_orderAttribute/_$orderAttribute.tpl"}
	                  	
	                  	{else}
	                  	
	                  	{include file="productdisplay/_orderAttribute/_basic.tpl"}
	                  	
	                  	{/if}
	                  	
						 <div class='quickOrderActions' style='float:left; width:100%;'>
						 {if $product.purchase_type=='Customizable'}
						 
						 <a class='fullOrderDetailsColorBox largeAnchorButton'  style='float:left;' href="{geturl controller='productdisplay' action='purchasedetails'}?number={$product.product_id}&product=products">
Customize this</a>
						 {/if}	
						 {if isset($product.product_inventory_id)}
						  <a class='largeAnchorButton' style='float:left;' href="{geturl controller='shoppingcart' action='additemtoshoppingcart'}?product=Inventory&id={$product.product_inventory_id}">Add to cart</a>
						 {/if}
						 
						 </div>
	            </div>
             </div>
             </div>
             
             </td></tr></table>
         </div>
    </div>
 {/foreach}
 </div>
<div class='box bottomPagination'>
<span style='font-size:1.2em; float:right;'><a>1</a></span>
</div>
 
{literal}
<script src="/public/resources/javascripts/productPreview/productImagePreviews.js" type="text/javascript"></script>

<script type="text/javascript">
new productPreviewImage('productTagBody');
$j(".tooltipControl").tooltip({position: 'bottom center'});
$j('a.fullOrderDetailsColorBox').colorbox({width:'800', height:'100%'});
$j('a.videoColorBox').colorbox({width:'480', height:'385', iframe:true});
</script>
{/literal}