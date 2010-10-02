<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" type="text/css" href="/htdocs/css/index.css">

<title>{$productUser->username}, {$product->product_type}: {$product->name}</title>


<meta content="From VisachiDesign, {$product->product_type}:{$product->name}, Price: {$product->price}, {$product->profile->description}, dancewear, dance shoes, ballroom dance shoes, ballroom shoes, latin and standard dance shoes">

</head>

</head>

<body>        
        {if $product->images|@count>0}
            <ul id="post_images">
                {foreach from=$product->images item=image}
                    <li id="">
                      	<img src="/data/tmp/thumbnails/{$productUser->username}/{$product->product_type}/{$image.image_id}.W150_homeFrontFour" alt="{$image.filename}" />
                    </li>
                {/foreach}
            </ul>
        {else}
        no images
        {/if}
        
        brand: {$product->brand}<br />
		pants waist: {$product->body_waist}<br />
		pants hip: {$product->body_hip}<br />
		pants length: {$product->waist_to_floor}<br />
		Description: {$product->profile->description}<br />
</body>