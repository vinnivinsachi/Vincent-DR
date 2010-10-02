<fieldset id="preview-add-image-attribute">
    <legend>measurement w/ image-attribute</legend>
    
    
    <form method="post" action="{geturl action='addmeasurementtoproduct'}?id={$product->getId()}&product={$product->product_type}" enctype="multipart/form-data">
        <div>
            Measurement name(example: Length): <input type="text" name="measurement_name" />  <br />          
            Beginning Measurement: <input type="text" name="beginning_measurement" />
            Ending Measurement: <input type="text" name="ending_measurement" /><br />
            Incremental Measurement: <input type="text" name="incremental_measurement" />
         	
            Video_youtube: <input type="text" name="video_youtube" />
            <input type="hidden" name="id" value="{$product->getId()}" />
            <input type="hidden" name="product" value="{$product->product_type}" />
            
            
            Price adjustment(example: 10)<input type="text" name="price_adjustment" /><br />
            Measurement Description: <input type="text" name="description" /><br />
            <input type="file" name="image" />
            <input type="submit" value="Add New Measurment Attribute" name="upload" />		
        </div>
    </form>
</fieldset>