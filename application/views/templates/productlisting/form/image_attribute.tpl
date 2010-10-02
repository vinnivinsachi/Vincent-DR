<fieldset id="preview-add-image-attribute" style="padding:20px;">
    <legend>Different Color Images</legend>
    
    Images you upload should reflect the different color products that they can select. 
    <form method="post" action="{geturl action='addimageattributetoproduct'}?id={$product->getId()}&product={$product->product_type}" enctype="multipart/form-data">
        <div>
            Attribute Category(example: Color): <select name="attribute_name" ><option value="color">Color</option></select>
            
            name of attribute(example: Black): <input type="text" name="image_name"/><br />
            <input type="hidden" name="id" value="{$product->getId()}" />
            <input type="hidden" name="product" value="{$product->product_type}" />
            <input type="hidden" name="tag" value="{$product->product_tag}" />
            Price adjustment(example: 10)<input type="text" name="price_adjustment" /><br />
            <input type="file" name="image" />

            <input type="submit" value="Upload new color attribute" name="upload" />		
        </div>
    </form>
</fieldset>