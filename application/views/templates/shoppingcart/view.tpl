{include file='header.tpl' lightbox='true'}


<br/>

<div>
	
	
	{if $edit==TRUE}
	
	<div class="post-title">
		EDIT: {$post->profile->name}
	</div>
	{else}
	<div class="post-title">
		CART ITEM: {$post->profile->name}
	</div>
	{/if}
	
	
	
	{foreach from=$post->images item=image}
		<div class="post-image">
			<a href="{imagefilename id=$image->getId() }" rel="lightbox[{$title|escape}]" >
				<img src="{imagefilename id=$image->getId() w=200 }" />
			</a>
		</div>
	{/foreach}
	
	<div class="post-content">
		{$post->profile->description}
	</div>
	
	<div class="post-price">
		$ {$post->profile->price}
	</div>


	
	
{if ($post->profile->type=='Women Latin Shoe' || $post->profile->type=='Women Standard Shoe')}
		
		{if $edit == TRUE}
		<form method="get" action="{geturl controller='shoppingcart' action='edit'}">
			<input type="hidden" name="profileID" value="{$productProfile->getId()}" />
			<input type="hidden" name="cartID" value="{$cartID}" />
			<table class="optionsBox" width="100%" cellspacing="1" cellpadding="3" border="0">
			<tbody>
			<tr>
			<td class="optionsBoxHeading">Available Options:</td>
			</tr>
			<tr>
			<td class="optionsBoxHeading">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Heel:</td>
			<td class="main" valign="top">
			{if $post->profile->two_inch=='on' && $post->profile->two_half_inch=='off' && $post->profile->three_inch=='off' }
<select name="heel">

<option value="2inch" {if $productProfile->ProductAttribute->heel=='2inch'}selected='selected'{/if}>2 inch</option>
</select>
{elseif $post->profile->two_inch=='off' && $post->profile->two_half_inch=='on' && $post->profile->three_inch=='off' }
<select name="heel">

<option value="2_5inch" {if $productProfile->ProductAttribute->heel=='2_5inch'}selected='selected'{/if}>2 1/2 inch</option>
</select>

{elseif $post->profile->two_inch=='off' && $post->profile->two_half_inch=='off' && $post->profile->three_inch=='on' }
<select name="heel">

<option value="3inch" {if $productProfile->ProductAttribute->heel=='3inch'}selected='selected'{/if}>3 inch</option>
</select>


{elseif $post->profile->two_inch=='off' && $post->profile->two_half_inch=='on' && $post->profile->three_inch=='on' }
<select name="heel">
<option value="2_5inch" {if $productProfile->ProductAttribute->heel=='2_5inch'}selected='selected'{/if}>2 1/2 inch</option>
<option value="3inch" {if $productProfile->ProductAttribute->heel=='3inch'}selected='selected'{/if}>3 inch</option>
</select>


{elseif $post->profile->two_inch=='on' && $post->profile->two_half_inch=='off' && $post->profile->three_inch=='on' }
<select name="heel">
<option value="2inch" {if $productProfile->ProductAttribute->heel=='2inch'}selected='selected'{/if}>2 inch</option>
<option value="3inch" {if $productProfile->ProductAttribute->heel=='3inch'}selected='selected'{/if}>3 inch</option>
</select>


{elseif $post->profile->two_inch=='on' && $post->profile->two_half_inch=='on' && $post->profile->three_inch=='off' }
<select name="heel">
<option value="2inch" {if $productProfile->ProductAttribute->heel=='2inch'}selected='selected'{/if}>2 inch</option>
<option value="2_5inch" {if $productProfile->ProductAttribute->heel=='2_5inch'}selected='selected'{/if}>2 1/2 inch</option>
</select>


{elseif $post->profile->two_inch=='on' && $post->profile->two_half_inch=='on' && $post->profile->three_inch=='on' }
<select name="heel">
<option value="2inch" {if $productProfile->ProductAttribute->heel=='2inch'}selected='selected'{/if}>2 inch</option>
<option value="2_5inch" {if $productProfile->ProductAttribute->heel=='2_5inch'}selected='selected'{/if}>2 1/2 inch</option>
<option value="3inch" {if $productProfile->ProductAttribute->heel=='3inch'}selected='selected'{/if}>3 inch</option>

</select>
{/if}

			</td>
			<tr class="optionsBoxContent">
	<td colspan="2" style="font-weight:100">Hint* The picture of the heels are under the product pictures</td>
</tr>

			</tr>
			
			{if $post->profile->euro =='off'}
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Foot length:</td>
			<td class="main" valign="top">
			<select name="foot_size">
			<option value="0">Select a size</option>
			
			<option value="5" {if $productProfile->ProductAttribute->foot_size =='5'} selected="selected"{/if}>5</option>
			<option vlaue="5.5" {if $productProfile->ProductAttribute->foot_size =='5.5'} selected="selected"{/if}>5.5</option>
			<option value="6" {if $productProfile->ProductAttribute->foot_size =='6'} selected="selected"{/if}>6</option>
			<option value="6.5" {if $productProfile->ProductAttribute->foot_size =='6.5'} selected="selected"{/if}>6.5</option>
			<option value="7" {if $productProfile->ProductAttribute->foot_size =='7'} selected="selected"{/if}>7</option>
			<option value="7.5" {if $productProfile->ProductAttribute->foot_size =='7.5'} selected="selected"{/if}>7.5</option>
			<option value="8" {if $productProfile->ProductAttribute->foot_size =='8'} selected="selected"{/if}>8</option>
			<option value="8.5" {if $productProfile->ProductAttribute->foot_size =='8.5'} selected="selected"{/if}>8.5</option>
			<option value="9" {if $productProfile->ProductAttribute->foot_size =='9'} selected="selected"{/if}>9</option>
			<option value="9.5" {if $productProfile->ProductAttribute->foot_size =='9.5'} selected="selected"{/if}>9.5</option>
			<option value="10" {if $productProfile->ProductAttribute->foot_size =='10'} selected="selected"{/if}>10</option>
			<option value="10.5" {if $productProfile->ProductAttribute->foot_size =='10.5'} selected="selected"{/if}>10.5</option>
			<option value="11" {if $productProfile->ProductAttribute->foot_size =='11'} selected="selected"{/if}>11</option>
			</select>
			</td>
			</tr>
			{else}
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Foot length:</td>
			<td class="main" valign="top">
			<select name="foot_size">
			<option value="0">Select European size</option>
			<option value="34" {if $productProfile->ProductAttribute->foot_size =='34'} selected="selected"{/if}>34</option>
			<option value="34.5" {if $productProfile->ProductAttribute->foot_size =='34.5'} selected="selected"{/if}>34.5</option>
			<option value="35" {if $productProfile->ProductAttribute->foot_size =='35'} selected="selected"{/if}>35</option>
			<option value="35.5" {if $productProfile->ProductAttribute->foot_size =='35.5'} selected="selected"{/if}>35.5</option>
			<option value="36" {if $productProfile->ProductAttribute->foot_size =='36'} selected="selected"{/if}>36</option>
			<option value="36.5" {if $productProfile->ProductAttribute->foot_size =='36.5'} selected="selected"{/if}>36.5</option>
			<option vlaue="37" {if $productProfile->ProductAttribute->foot_size =='37'} selected="selected"{/if}>37</option>
			<option value="37.5" {if $productProfile->ProductAttribute->foot_size =='37.5'} selected="selected"{/if}>37.5</option>
			<option value="38" {if $productProfile->ProductAttribute->foot_size =='38'} selected="selected"{/if}>38</option>
			<option value="38.5" {if $productProfile->ProductAttribute->foot_size =='38.5'} selected="selected"{/if}>38.5</option>
			<option value="39" {if $productProfile->ProductAttribute->foot_size =='39'} selected="selected"{/if}>39</option>
			<option value="39.5" {if $productProfile->ProductAttribute->foot_size =='39.5'} selected="selected"{/if}>39.5</option>
			<option value="40" {if $productProfile->ProductAttribute->foot_size =='40'} selected="selected"{/if}>40</option>
			<option value="40.5" {if $productProfile->ProductAttribute->foot_size =='40.5'} selected="selected"{/if}>40.5</option>
			<option value="41" {if $productProfile->ProductAttribute->foot_size =='41'} selected="selected"{/if}>41</option>
			</select>
			</td>
			</tr>
			{/if}
			
			
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Color:</td>
			<td class="main" valign="top">
			{if $post->profile->light_color=="on" && $post->profile->dark_color=="on" && $post->profile->black =="on"}
<select name="color">
<option value="light tan" {if $productProfile->ProductAttribute->color =='light tan'} selected="selected"{/if}>Light tan</option>
<option value="dark tan" {if $productProfile->ProductAttribute->color =='dark tan'} selected="selected"{/if}>Dark tan</option>
<option value="black" {if $productProfile->ProductAttribute->color =='black'} selected="selected"{/if}>Black</option>
</select>
{elseif $post->profile->light_color=="on" && $post->profile->dark_color=="off" && $post->profile->black =="off"}
<select name="color">
<option value="light tan" {if $productProfile->ProductAttribute->color =='light tan'} selected="selected"{/if}>Light tan</option>

</select>

{elseif $post->profile->light_color=="off" && $post->profile->dark_color=="on" && $post->profile->black =="off"}
<select name="color">
<option value="dark tan" {if $productProfile->ProductAttribute->color =='dark tan'} selected="selected"{/if}>Dark tan</option>
</select>
{elseif $post->profile->light_color=="off" && $post->profile->dark_color=="off" && $post->profile->black =="on"}
<select name="color">
<option value="black" {if $productProfile->ProductAttribute->color =='black'} selected="selected"{/if}>Black</option>
</select>
{elseif $post->profile->light_color=="off" && $post->profile->dark_color=="on" && $post->profile->black =="on"}
<select name="color">
<option value="dark tan" {if $productProfile->ProductAttribute->color =='dark tan'} selected="selected"{/if}>Dark tan</option>
<option value="black" {if $productProfile->ProductAttribute->color =='black'} selected="selected"{/if}>Black</option>
</select>
{elseif $post->profile->light_color=="on" && $post->profile->dark_color=="on" && $post->profile->black =="off"}
<select name="color">
<option value="light tan" {if $productProfile->ProductAttribute->color =='light tan'} selected="selected"{/if}>Light tan</option>

<option value="dark tan" {if $productProfile->ProductAttribute->color =='dark tan'} selected="selected"{/if}>Dark tan</option>

</select>
{elseif $post->profile->light_color=="on" && $post->profile->dark_color=="off" && $post->profile->black =="on"}
<select name="color">
<option value="light tan" {if $productProfile->ProductAttribute->color =='light tan'} selected="selected"{/if}>Light tan</option>
<option value="black" {if $productProfile->ProductAttribute->color =='black'} selected="selected"{/if}>Black</option>
</select>
{/if}
			
			</td>
			</tr>
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Width:</td>
			<td class="main" valign="top">
			<select name="foot_width">
			<option value="Regular" {if $productProfile->ProductAttribute->foot_width=='Regular'}selected="selected"{/if}>Regular</option>
			<!--<option value="Wide" {if $productProfile->ProductAttribute->foot_width=='Wide'}selected="selected"{/if}>Wide</option>-->
			</select>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			<br/>
			<input type="submit" value="Save"/>
			<span style="font-weight:bold"><a href="{geturl controller='shoppingcart' action='view'}?profileID={$productProfile->getId()}&cartID={$cartID}">Back to item</a></span>
			<span style="font-weight:bold"><a href="{geturl controller='shoppingcart' action='index'}">Cart</a></span>
		</form>
	{else}

	<form method="get" action="{geturl controller='shoppingcart' action='view'}">
	<input type="hidden" name="profileID" value="{$productProfile->getId()}" />
	<input type="hidden" name="cartID" value="{$cartID}" />
		<table class="optionsBox" width="100%" cellspacing="1" cellpadding="3" border="0">
			<tbody>
			<tr>
				<td class="optionsBoxHeading">Selected Options:</td>
			</tr>
			<tr>
				<td class="optionsBoxHeading">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tbody>
				<tr class="optionsBoxContent">
					<td class="main" valign="top">Heel:</td>
					<td class="main" valign="top">
					{$productProfile->ProductAttribute->heel}
					</td>
				</tr>
				<tr class="optionsBoxContent">
				<td class="main" valign="top">Foot length:</td>
				<td class="main" valign="top">
					{$productProfile->ProductAttribute->foot_size}
				</td>
			</tr>
			
			<tr class="optionsBoxContent">
				<td class="main" valign="top">Color:</td>
				<td class="main" valign="top">
					{$productProfile->ProductAttribute->color}
				</td>
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Foot Width:</td>
			<td class="main" valign="top">
			{$productProfile->ProductAttribute->foot_width}
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			
			<br/>
		
		<input type="submit" value="Edit Options" />
		<input type="hidden" value="true" name="edit"/>
		<span style="font-weight:bold"><a href="{geturl controller='shoppingcart' action='index'}">Cart</a></span>
	</form>
	{/if}

{elseif $post->profile->type=='Men Latin Shoe' || $post->profile->type=='Men Standard Shoe'}

		{if $edit == TRUE}
		<form method="get" action="{geturl controller="shoppingcart" action="edit"}">
			<input type="hidden" name="profileID" value="{$productProfile->getId()}" />
			<input type="hidden" name="cartID" value="{$cartID}" />
			<table class="optionsBox" width="100%" cellspacing="1" cellpadding="3" border="0">
			<tbody>
			<tr>
			<td class="optionsBoxHeading">Available Options:</td>
			</tr>
			<tr>
			<td class="optionsBoxHeading">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
			
			
			{if $post->profile->euro=='off'}
<tr class="optionsBoxContent">
<td class="main" valign="top">Foot Size:</td>
<td class="main" valign="top">
<select name="foot_size">
			<option value="0">Select a size</option>
			<option value="5" {if $productProfile->ProductAttribute->foot_size =='5'} selected="selected"{/if}>5</option>
			<option vlaue="5.5" {if $productProfile->ProductAttribute->foot_size =='5.5'} selected="selected"{/if}>5.5</option>
			<option value="6" {if $productProfile->ProductAttribute->foot_size =='6'} selected="selected"{/if}>6</option>
			<option value="6.5" {if $productProfile->ProductAttribute->foot_size =='6.5'} selected="selected"{/if}>6.5</option>
			<option value="7" {if $productProfile->ProductAttribute->foot_size =='7'} selected="selected"{/if}>7</option>
			<option value="7.5" {if $productProfile->ProductAttribute->foot_size =='7.5'} selected="selected"{/if}>7.5</option>
			<option value="8" {if $productProfile->ProductAttribute->foot_size =='8'} selected="selected"{/if}>8</option>
			<option value="8.5" {if $productProfile->ProductAttribute->foot_size =='8.5'} selected="selected"{/if}>8.5</option>
			<option value="9" {if $productProfile->ProductAttribute->foot_size =='9'} selected="selected"{/if}>9</option>
			<option value="9.5" {if $productProfile->ProductAttribute->foot_size =='9.5'} selected="selected"{/if}>9.5</option>
			<option value="10" {if $productProfile->ProductAttribute->foot_size =='10'} selected="selected"{/if}>10</option>
			<option value="10.5" {if $productProfile->ProductAttribute->foot_size =='10.5'} selected="selected"{/if}>10.5</option>
			<option value="11" {if $productProfile->ProductAttribute->foot_size =='11'} selected="selected"{/if}>11</option>
			<option value="11.5" {if $productProfile->ProductAttribute->foot_size =='11.5'} selected="selected"{/if}>11.5</option>
			<option value="12" {if $productProfile->ProductAttribute->foot_size =='12'} selected="selected"{/if}>12</option>
			<option value="12.5" {if $productProfile->ProductAttribute->foot_size =='12.5'} selected="selected"{/if}>12.5</option>
			<option value="13" {if $productProfile->ProductAttribute->foot_size =='13'} selected="selected"{/if}>13</option>
			</select>
<br/>
{else}

<tr class="optionsBoxContent">
<td class="main" valign="top">Foot Size:</td>
<td class="main" valign="top">
<select name="foot_size">
<option value="0">Select European size</option>
<option value="35" {if $productProfile->ProductAttribute->foot_size =='35'} selected="selected"{/if}>35</option>
<option value="36" {if $productProfile->ProductAttribute->foot_size =='36'} selected="selected"{/if}>36</option>
<option vlaue="37" {if $productProfile->ProductAttribute->foot_size =='37'} selected="selected"{/if}>37</option>
<option value="37.5" {if $productProfile->ProductAttribute->foot_size =='37.5'} selected="selected"{/if}>37.5</option>
<option value="38" {if $productProfile->ProductAttribute->foot_size =='38'} selected="selected"{/if}>38</option>
<option value="38.5" {if $productProfile->ProductAttribute->foot_size =='38.5'} selected="selected"{/if}>38.5</option>
<option value="39" {if $productProfile->ProductAttribute->foot_size =='39'} selected="selected"{/if}>39</option>
<option value="39.5" {if $productProfile->ProductAttribute->foot_size =='39.5'} selected="selected"{/if}>39.5</option>
<option value="40" {if $productProfile->ProductAttribute->foot_size =='40'} selected="selected"{/if}>40</option>
<option value="40.5" {if $productProfile->ProductAttribute->foot_size =='40.5'} selected="selected"{/if}>40.5</option>
<option value="41" {if $productProfile->ProductAttribute->foot_size =='41'} selected="selected"{/if}>41</option>
<option value="41.5" {if $productProfile->ProductAttribute->foot_size =='41.5'} selected="selected"{/if}>41.5</option>
<option value="42" {if $productProfile->ProductAttribute->foot_size =='42'} selected="selected"{/if}>42</option>
<option value="42.5" {if $productProfile->ProductAttribute->foot_size =='42.5'} selected="selected"{/if}>42.5</option>
<option value="43" {if $productProfile->ProductAttribute->foot_size =='43'} selected="selected"{/if}>43</option>
<option value="43.5" {if $productProfile->ProductAttribute->foot_size =='43.5'} selected="selected"{/if}>43.5</option>
<option value="44" {if $productProfile->ProductAttribute->foot_size =='44'} selected="selected"{/if}>44</option>
<option value="44.5" {if $productProfile->ProductAttribute->foot_size =='44.5'} selected="selected"{/if}>44.5</option>
<option value="45" {if $productProfile->ProductAttribute->foot_size =='45'} selected="selected"{/if}>45</option>
<option value="45.5" {if $productProfile->ProductAttribute->foot_size =='45.5'} selected="selected"{/if}>45.5</option>
<option value="46" {if $productProfile->ProductAttribute->foot_size =='46'} selected="selected"{/if}>46</option>
<option value="46.5" {if $productProfile->ProductAttribute->foot_size =='46.5'} selected="selected"{/if}>46.5</option>
<option value="47" {if $productProfile->ProductAttribute->foot_size =='47'} selected="selected"{/if}>47</option>
</select>
{/if}
			
			<tr class="optionsBoxContent">
				<td colspan="2" style="font-weight:100">Hint* if your foot length is in between two measurements, select the larger one</td>
			</tr>
			
			
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Leather: </td>
			<td class="main" valign="top">
			{if $post->profile->patent=="on" && $post->profile->calf=="on"}
<select name="color">
<option value="patent" {if $productProfile->ProductAttribute->color=='patent'}selected="selected"{/if}>Patent</option>
<option value="black leather" {if $productProfile->ProductAttribute->color=='black leather'}selected="selected"{/if}>Black leather</option>
</select>
{elseif $post->profile->patent=="on" && $post->profile->calf=="off"}
<select name="color">
<option value="patent" {if $productProfile->ProductAttribute->color=='patent'}selected="selected"{/if}>Patent</option>

</select>

{elseif $post->profile->patent=="off" && $post->profile->calf=="on"}
<select name="color">
<option value="black leather" {if $productProfile->ProductAttribute->color=='black leather'}selected="selected"{/if}>Black leather</option>
</select>
{/if}
	</td>
	</tr>
			
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Width:</td>
			<td class="main" valign="top">
			<select name="foot_width">
			<option value="Regular" {if $productProfile->ProductAttribute->foot_width=='Regular'}selected="selected"{/if}>Regular</option>
			<!--<option value="Wide" {if $productProfile->ProductAttribute->foot_width=='Wide'}selected="selected"{/if}>Wide</option>-->
			</select>
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			<br/>
			<input type="submit" value="Save"/>
			<span style="font-weight:bold"><a href="{geturl controller='shoppingcart' action='view'}?profileID={$productProfile->getId()}&cartID={$cartID}">Back to item</a></span>
			<span style="font-weight:bold"><a href="{geturl controller='shoppingcart' action='index'}">Cart</a></span>
		</form>
	{else}

	<form method="get" action="{geturl controller='shoppingcart' action='view'}">
	<input type="hidden" name="profileID" value="{$productProfile->getId()}" />
	<input type="hidden" name="cartID" value="{$cartID}" />
		<table class="optionsBox" width="100%" cellspacing="1" cellpadding="3" border="0">
			<tbody>
			<tr>
				<td class="optionsBoxHeading">Selected Options:</td>
			</tr>
			<tr>
				<td class="optionsBoxHeading">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tbody>
				
				<tr class="optionsBoxContent">
				<td class="main" valign="top">Foot length:</td>
				<td class="main" valign="top">
					{$productProfile->ProductAttribute->foot_size}
				</td>
				</tr>
				<tr class="optionsBoxContent">
				<td class="main" valign="top">Leather:</td>
				<td class="main" valign="top">
					{$productProfile->ProductAttribute->color}
				</td>
				</tr>
			
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Foot Width:</td>
			<td class="main" valign="top">
			{$productProfile->ProductAttribute->foot_width}
			</td>
			</tr>
			</tbody>
			</table>
			</td>
			</tr>
			</tbody>
			</table>
			
			<br/>
		
		<input type="submit" value="Edit Options" />
		<input type="hidden" value="true" name="edit"/>
		<span style="font-weight:bold"><a href="{geturl controller='shoppingcart' action='index'}">Cart</a></span>
	</form>
	{/if}
	

{elseif $post->profile->type=='Pants'}
	{if $edit ==TRUE}
	
	<form method="get" action="{geturl controller='shoppingcart' action='edit'}">
			<input type="hidden" name="profileID" value="{$productProfile->getId()}" />
			<input type="hidden" name="cartID" value="{$cartID}" />
		<table class="optionsBox" width="100%" cellspacing="1" cellpadding="3" border="0">
		<tbody>
			<tr>
			<td class="optionsBoxHeading">Available Options:</td>
			</tr>
			<tr>
			<td class="optionsBoxHeading">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
			</tr>
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Height:</td>
			<td class="main" valign="top">
			<select name="Height">
			<option value="0">Select a size</option>
			<option value="150cm" {if $productProfile->ProductAttribute->Height=='150cm'}selected='selected'{/if}>150cm or 4f 11in</option>
			<option value="155cm" {if $productProfile->ProductAttribute->Height=='155cm'}selected='selected'{/if}>155cm or 5f 1in</option>
			<option value="160cm" {if $productProfile->ProductAttribute->Height=='160cm'}selected='selected'{/if}>160cm or 5f 3in</option>
			<option vlaue="165cm" {if $productProfile->ProductAttribute->Height=='165cm'}selected='selected'{/if}>165cm or 5f 5in</option>
			<option value="170cm" {if $productProfile->ProductAttribute->Height=='170cm'}selected='selected'{/if}>170cm or 5f 7in</option>
			<option value="175cm" {if $productProfile->ProductAttribute->Height=='175cm'}selected='selected'{/if}>175cm or 5f 9in</option>
			<option value="180cm" {if $productProfile->ProductAttribute->Height=='180cm'}selected='selected'{/if}>180cm or 5f 11in</option>
			<option value="185cm" {if $productProfile->ProductAttribute->Height=='185cm'}selected='selected'{/if}>185cm or 6f 1in</option>
			<option value="190cm" {if $productProfile->ProductAttribute->Height=='190cm'}selected='selected'{/if}>190cm or 6f 3in</option>
			<option value="195cm" {if $productProfile->ProductAttribute->Height=='195cm'}selected='selected'{/if}>195cm or 6f 5in</option>
			<option value="200cm" {if $productProfile->ProductAttribute->Height=='200cm'}selected='selected'{/if}>200cm or 6f 7in</option>
			</select>
			</td>
			</tr>
			<tr class="optionsBoxContent">
				<td colspan="2" style="font-weight:100">Hint* if your height is in between two measurements, select the larger one</td>
			</tr>
			
			
			
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Waist</td>
			<td class="main" valign="top">
			
			<select name="Waist">
			
			
			<option value="0">Select a size</option>
			
			{foreach from=$waist key=k item=v}
			<option value="{$k}cm" {if $productProfile->ProductAttribute->Waist==$k} selected='selected'{/if} >{$v}</option>
			{/foreach}
			
			
			</select>
			</td>
			</tr>
			
			
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Hip</td>
			<td class="main" valign="top">
			<select name="Hip">
			<option value="0">Select a size</option>
			{foreach from=$hip key=k item=v}
			<option value="{$k}cm" {if $productProfile->ProductAttribute->Hip==$k} selected='selected' {/if} >{$v}</option>
			{/foreach}
			</select>
			</td>
			</tr>
			
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Length of pants</td>
			<td class="main" valign="top">
			<select name="Pants_Height">
			<option value="0">Select a size</option>
			{foreach from=$pantsLength key=k item=v}
			<option value="{$k}cm" {if $productProfile->ProductAttribute->Pants_Height==$k} selected='selected' {/if}>{$v}</option>
			{/foreach}
			</select>
			</td>
			</tr>
			
			</tbody> 
</table>
</td>
</tr>
</tbody>
</table>
<br/>
	
		<input type="submit" value="Save"/>
			<span style="font-weight:bold"><a href="{geturl controller='shoppingcart' action='view'}?profileID={$productProfile->getId()}&cartID={$cartID}">Back to item</a></span>
			<span style="font-weight:bold"><a href="{geturl controller='shoppingcart' action='index'}">Cart</a></span>
	</form>
	
	{else}
		
	<form method="get" action="{geturl controller='shoppingcart' action='view'}">
	<input type="hidden" name="profileID" value="{$productProfile->getId()}" />
	<input type="hidden" name="cartID" value="{$cartID}" />
		<table class="optionsBox" width="100%" cellspacing="1" cellpadding="3" border="0">
		<tbody>
			<tr>
			<td class="optionsBoxHeading">Available Options:</td>
			</tr>
			<tr>
			<td class="optionsBoxHeading">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
			</tr>
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Height:</td>
			<td class="main" valign="top">
				{$productProfile->ProductAttribute->Height}			
			</td>
			</tr>
			<tr class="optionsBoxContent">
				<td colspan="2" style="font-weight:100">Hint* if your height is in between two measurements, select the larger one</td>
			</tr>
			
			
			
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Waist</td>
			<td class="main" valign="top">
			{$productProfile->ProductAttribute->Waist}
			
			</td>
			</tr>
			
			
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Hip</td>
			<td class="main" valign="top">
		
			{$productProfile->ProductAttribute->Hip}
			</td>
			</tr>
			
			<tr class="optionsBoxContent">
			<td class="main" valign="top">Length of pants</td>
			<td class="main" valign="top">
		
			{$productProfile->ProductAttribute->Pants_Height}
		
			</td>
			</tr>
			
			</tbody> 
</table>
</td>
</tr>
</tbody>
</table>

<input type="submit" value="Edit Options" />
		<input type="hidden" value="true" name="edit"/>
		<span style="font-weight:bold"><a href="{geturl controller='shoppingcart' action='index'}">Cart</a></span>
	</form>

	{/if}
{/if}
</div>


{include file='footer.tpl'  leftcolumn='lib/ProductList.tpl' products=$cartObject}