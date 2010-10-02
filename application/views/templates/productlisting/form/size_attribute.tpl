<fieldset id="preview-add-image-attribute">
    <legend>size-attribute</legend>
    
    
    <form method="post" action="{geturl action='addsizeattributetoproduct'}?id={$product->getId()}&product={$product->product_type}" enctype="multipart/form-data">
        <div>
            size category(example: Heel): <input type="text" name="attribute_name" />  <br />          
           	size option: <input type="text" name="size_name" />
           
            <input type="hidden" name="id" value="{$product->getId()}" />
            <input type="hidden" name="product" value="{$product->product_type}" />
            
  
            Price adjustment(example: 10)<input type="text" name="price_adjustment" /><br />
            <input type="submit" value="Add New Measurment Attribute" name="upload" />		
        </div>
    </form>
</fieldset>