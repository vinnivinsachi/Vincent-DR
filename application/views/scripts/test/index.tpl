{include file="layouts/$layout/header.tpl" lightbox=true}

INDEX

<form enctype="multipart/form-data" method="post" action="/public/test/imagetest">

		<div class='formRightDivision'>
		        <div style='margin-bottom:10px;'>
		        <div class='box' >
					<div class='fullTitleBarMid'><strong>Description</strong></div>
				</div>
              
		        
		        <div class='box marginTop20'>
					<div class='fullTitleBarMid'><strong>Upload sample image</strong></div>
		        <div id="imageBlock" >
		        	<div id="image_0" class="imageInput">
			        <label style='width:185px;'>Image:</label>
						<input type="file" name="generalImages[0]" />
						
					</div>
                    <div id="image_1" class="imageInput">
			        <label style='width:185px;'>Image:</label>
						<input type="file" name="generalImages[1]" />
						
					</div>
                    <div id="image_2" class="imageInput">
			        <label style='width:185px;'>Image:</label>
						<input type="file" name="generalImages[2]" />
						
					</div>
				</div>
                <input type="submit" value="submit" />
				</div>
				
				
				<br/>
			</div>
        </div>
            

</form>


{include file="layouts/$layout/footer.tpl"}
