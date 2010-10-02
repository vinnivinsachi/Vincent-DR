// JavaScript Document

var settings ={
		messages: 'messages',
		statusSuccessColor: '#003399',
		messages_hide_delay: 0.5
};

var options={
	duration: 1.5,
	from: 0,
	to: 1
};

function init(e)
{
		//check if the messages element exists and is visible,
		//and if so, apply the highlight effect to it
		var messages =$(settings.messages);
		
		if(messages && messages.visible())
		{
			new Effect.Fade(messages, options);
		}
		
		//new SearchSuggestor('search');
		
}

function message_write(message)
{
	var messages = $(settings.messages);
	if(!messages)
	{
		return;
	}
	
	if(message.length==0)
	{
		messages.hide();
		return;
	}
	
	messages.update(message);
	messages.show();
	/*messages_clear();*/
}


function message_clear()
{
	setTimeout("message_write('')", settings.messages_hide_delay*1000);
}

Event.observe(window, 'load', init);

function filterStringWithSymbol(str_str,str_symbol) {
	str_str=str_str.trim();
    re = /\$|,| |@|#|~|`|\%|\*|\^|\&|\(|\)|\+|\=|\[|\-|\_|\]|\[|\}|\{|\;|\:|\'|\"|\<|\>|\?|\||\\|\!|\$|\./g;
    // remove special characters like "$" and "," etc...
    return str_str.replace(re, str_symbol);
}

/*creation of new attirbute in product-----*/
function createNewAttributeSet(nameInput, mainDiv, hideControlDiv, action, paramSet, id){
	attributeSetNameOriginal=$(nameInput).value;
	
	//alert('count is: '+fabricSetNameOriginal.length);
	if(attributeSetNameOriginal.length==0){
		alert('Please enter a name for this attribute set');
	}else{
		attributeSetName=filterStringWithSymbol(attributeSetNameOriginal,'_');
		//alert(fabricSetName);
		attributeSetDivMain=$(mainDiv);
		if(!$('attributeSet-'+attributeSetName)){
	
		var timestamp = new Date();
		attributeSetDivMain.insert( { bottom: "<form method='post' id='attributeSet-"+attributeSetName+"' action='/manageattribute/uploadattribute?actioncall="+action+"&paramSet="+paramSet+"&id="+id+"' enctype='multipart/form-data'>"
										  +"<div id='attributeSetForm-"+attributeSetName+"' >"
										  +"<strong>Color/fabric set name: "+attributeSetNameOriginal+"</strong><input type='hidden' value='"+attributeSetName+"' name=attributeSet["+attributeSetName+"]/>"
										  +"<br/><br/><div class='attributeSetDetail box'>"
										  +"<label>Color/fabric:</label> <input type='text' class='formSetNameText inputShiftOne' name=attributeSet["+attributeSetName+"][name]["+timestamp.getTime()+"] /><br/>"
										  +"<label>Price offset (optional):</label> $<input type='text' class='formSetPriceOffsetNumeric' name=attributeSet["+attributeSetName+"][price]["+timestamp.getTime()+"] /><br/>"
										  +"<label>Image upload (optional):</label> <input type='file' class='inputShiftOne' name=customAttributeDetailImage["+timestamp.getTime()+"] />"
										  +"<div class='fieldError'></div><button type='button' onclick='this.up().remove();' style='float:left;'>Delete</button></div>"
										  +"</div><div style='float:left; width:100%;'><button type='button' onclick=verfityAndSubmitForm('attributeSet-"+attributeSetName+"') style='float:right;'>Save</button><button type='button' style='float:right;' onclick=\"addDetailAttributeInSet('"+mainDiv+"', this)\">Add another to this set</button></div></form>" } );
		//alert('here');
		//alert(attributeSetDivMain.down().id);
		$(hideControlDiv).hide();
		alert('here');
		//alert("'attributeSet-"+attributeSetName+"'"); 
		//new formEnhancer('attributeSet-'+attributeSetName);
		alert('here2');
		}else{
			alert('Attribute set named: '+attributeSetName+' already exist. You may not add a duplicate set.');
		}	
	}
}

function addDetailAttributeInSet(mainDiv, element){
	alert(element.innerHTML);
	attributeSet=$(mainDiv).down();
	attributeSetName=attributeSet.id.split("-")[1];
	alert(attributeSetName);
	attributeSetForm = $('attributeSetForm-'+attributeSetName);

	var timestamp = new Date();
	attributeSetForm.insert( { bottom: "<div class='attributeSetDetail box' style='padding-top:8px;'>"
		  							+"<label>Color/fabric:</label> <input type='text' class='formSetNameText inputShiftOne' name=attributeSet["+attributeSetName+"][name]["+timestamp.getTime()+"]/><br/>"
		  							+"<label>Price offset (optional):</label>$<input type='text'  class='formSetPriceOffsetNumeric' name=attributeSet["+attributeSetName+"][price]["+timestamp.getTime()+"]/><br/>"
		  							+"<label>Image upload (optional):</label> <input type='file' class='inputShiftOne' name=customAttributeDetailImage["+timestamp.getTime()+"] />"
		  							+"<div class='fieldError'></div><button type='button' onclick='this.up().remove();' style='float:left;'>Delete</button></div>"
		  							});
	//alert('here at add new');
	
}
function verfityAndSubmitForm(formName){
	//textFormFields= $A('formText');
	alert('form name is: '+formName);
	alert('here');
	attributeSetDetails = $$('.attributeSetDetail');
	alert('here2');
	alert(attributeSetDetails.length);

	verifiedForm=true;
	attributeSetDetails.each(function(value){
		errorArray='';
		hasError=false;
		setName = value.down('input.formSetNameText');
		if(setName.value.length==0){
			alert('name is none can not process');
			errorArray +='You must enter a name for this attribute. ';
			hasError=true;
		}
		priceOffset = value.down('input.formSetPriceOffsetNumeric');
		alert(priceOffset.className);
		alert('here inside');
		if(priceOffset.value.length==0){
			alert('settin value to zero');
			priceOffset.value=0;
		}else if(isNaN(priceOffset.value)){
			alert('value is not zero');
			errorArray+='Price offset is not a number value. ';
			hasError=true;
		}

		if(hasError){
			alert('displaying error message');
			alert('fieldError existing '+value.down('div.fieldError').innerHTML);
			value.down('div.fieldError').innerHTML = errorArray;
			verifiedForm=false;
		}else{
			value.down('div.fieldError').innerHTML='';
		}
	});

	if(verifiedForm){
		showloadingImage(); 
		$(formName).submit();
	}	
}

function showloadingImage(){
	//alert('showing loading image');
	$('loadingImage').show();
}

function hideloadingImage(){
	//alert('hiding loading image');
	$('loadingImage').hide();
}

function addNewImageBlock(){
	var images = $$('.imageInput');
	var timestamp = new Date();
	var nextImageNumber = images.length;
	imageBlock = $('imageBlock');
	//alert(images.length);
	imageBlock.insert( { bottom: "<div class='imageInput' id='image_"+timestamp.getTime()+"'>"
		   +"<label style='width:185px;'>Image: </label>"
		   +"<input type='file' name='generalImages["+timestamp.getTime()+"]' />"
		   +"<a onclick='this.up().remove();' style='float:right; padding-right:10px;'>Delete</a>"
		   +"</div>" } );
}

function submitMainForm(form){
	showloadingImage();
	$(form).submit();
}

function showCustomizableSection(section){
	$(section).show(); 
}

function tooltipReset(){
	//alert('tooltipSetting');
	$j(".tooltipControl").tooltip({position: 'center right'});
	//alert('finished');
}

function addToCompareChart(element){
	var form = element.up().down('.addToCompareChartForm');
	var options={
			parameters: form.serialize(true),
			method: form.method,
			onLoaded: showloadingImage(), 
			onSuccess: function(transport){
						hideloadingImage();
						alert('Product added to compare chart.');
	}
	};

//alert('here');
	new Ajax.Request(form.action, options);
	//alert($form.innerHTML);
}

function removeFromCompareChart(element){
	var form = element.up().down('.removeFromCompareChartForm');
	var options={
			parameters: form.serialize(true),
			method: form.method,
			onLoaded: showloadingImage(), 
			onSuccess: function(transport){
						hideloadingImage();
						alert('Product removed from compare chart.');
						form.up('.productBox').remove();
	}
	};

//alert('here');
	new Ajax.Request(form.action, options);
	//alert($form.innerHTML);
}