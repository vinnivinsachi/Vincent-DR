<div class='titleBarBig'>Order Details</div>
		{foreach from=$product.profile item=profile}
             <div class='box' style='width:100%; margin-bottom:15px;'>

<div style="font-weight:bold; width:500px; float:left;">
                    {$profile.product_name}
                    </div>
		                    		
									<table width="100%;" style='border:none;'>
		                            <tr >
		                            <td width="200px;"><img src='/public/resources/userdata/tmp/thumbnails/{$profile.uploader_username}/{$profile.product_tag}/{$profile.product_image_id}.W150_homeFrontFour.jpg'/></td>
		                            <td width="400px;">
		                            <table width='100%;'>
		                            {foreach from=$profile.attributes item=attribute key=attributeKey}
		                            <tr width="400px;">
		                            <td style='width:60%; text-align:right;'>{removeunderscore phrase=$attribute.profile_key}: </td>
		                            <td style='width:40%; text-align:left;'>{removeunderscore phrase=$attribute.profile_value}</td>
		                            </tr>
                                    
		                            {/foreach}
		                            <tr>
		                      		<td style='width:60%; text-align:right;'>Quantity: 1</td>  
									<td style='width:40%; text-align:left;' class='price'>${$profile.product_price}</td> 
									</tr>
		                            </table>
		                            </td>
                                    <td width="100px;">
                                    Profile id: #{$profile.order_profile_id}
                                    <a href="{geturl controller='adminorders' action='vieworderprofiledetails'}?profileId={$profile.order_profile_id}">profile details</a>
                                    
                     
                                    </td>
		                            </tr>
		                        	</table>
		                           
		                       
            </div>
        {/foreach}
