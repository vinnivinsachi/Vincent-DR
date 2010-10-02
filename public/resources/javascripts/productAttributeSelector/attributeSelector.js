// JavaScript Document
MeasurementAttribute=Class.create();

MeasurementAttribute.prototype={
	productDiv : null,
	ColorAttributes : null,
	ColorAttributesSelected:null,
	MeasurementAttributes: null ,
	MeasurementAttributesSelected:null,
	SizeAttributes:null,
	SizeAttributesSelected:null,
	addToCart:null,
	error:null,
	useMyMeasurementCheckBox:null,
	useMyMeasurementCheckBoxChecked:null,
	//the div that the color is called. 
	ColorAttributesName:null,
	compositeAttributeObject: new Object(),
	
	currentProductInfo:null,
	
	//productDetails

	
	initialize:function(productType)
	{
		this.MeasurementAttributes = new Object();
		this.MeasurementAttributesSelected= new Object();
		this.error = new Object();
		this.ColorAttributesSelected = new Object();
		this.productDiv = $(productType);
		this.productDiv.down('input.addToCart').observe('click', this.addProductToCart.bindAsEventListener(this));
		
		if(this.productDiv.down('.colorSelection')){
			this.ColorAttributes = this.productDiv.down('.colorSelection').getElementsBySelector('li');
					//alert('here');
					this.ColorAttributesName=this.productDiv.down('.colorSelection');
					//alert('color attribute name is: '+ColorAttributesName.id);
					this.ColorAttributesSelected[this.ColorAttributesName.id]='none';
					this.ColorAttributes.each(function(value){$(value.id).observe('click', this.setSelectedAttribute.bindAsEventListener(this))
												}.bind(this));
		}else{
			//alert('here2');
		}
		
		//worry about measurement selection
		//alert('here');
		if(this.productDiv.down('input.useMyMeasurementForOrder')!=null){
			this.useMyMeasurementCheckBox = this.productDiv.down('input.useMyMeasurementForOrder');
			this.useMyMeasurementCheckBox.observe('change', this.setUploadedAttributesForUser.bindAsEventListener(this));
		}
		temp = this.productDiv.down('div#measurementSelection');
		//alert('here1');
		temp2= temp.getElementsByClassName('measurementAttribute');
		//alert('here2');
		this.MeasurementAttributesArray = $A(this.productDiv.down('div#measurementSelection').getElementsByClassName('measurementAttribute'));
		//alert(this.MeasurementAttributesArray);
		this.MeasurementAttributesArray.each(function(value,index){
													  var attributeId = value.id;
													  //alert('here');
													  this.MeasurementAttributes[attributeId]= $A(value.getElementsBySelector('li'));
													  }.bind(this));
		
		$H(this.MeasurementAttributes).each(function(value,index){
			//sets the attributes to measurementAttributesSelected
				measurementAttributeName = value[0];
				//alert(measurementAttributeName);
				this.MeasurementAttributesSelected[measurementAttributeName]='none';
				value[1].each(function(value2){
									   //alert('here');
						$(value2.id).observe('click', this.setSelectedAttribute.bindAsEventListener(this))
												}.bind(this));
																 }.bind(this));			
		
		//alert(this.ColorAttributes);
		//alert(window.location);
		//alert('here');
		this.setProductPropertyInAjax();
	},
	
	setProductPropertyInAjax:function(){
		this.compositeAttributeObject.product_id = $('product_id_ajax').innerHTML;
		this.compositeAttributeObject.product_type = $('product_type_ajax').innerHTML;
		this.compositeAttributeObject.product_market = $('product_market_ajax').innerHTML;
		this.compositeAttributeObject.product_Username = $('product_Username_ajax').innerHTML;
		this.compositeAttributeObject.product_UserId = $('product_UserId_ajax').innerHTML;
		this.compositeAttributeObject.product_name = $('product_name_ajax').innerHTML;
		this.compositeAttributeObject.product_tag = $('product_tag_ajax').innerHTML;
		this.compositeAttributeObject.reward_points = $('product_reward_points_ajax').innerHTML;
		this.compositeAttributeObject.shipping_costs = $('product_shipping_ajax').innerHTML;
		this.compositeAttributeObject.product_image_id = $('product_image_id_ajax').innerHTML;
		this.compositeAttributeObject.backorder_time = $('product_backorder_time_ajax').innerHTML;
		this.compositeAttributeObject.product_user_name = $('product_user_name_ajax').innerHTML;
		if($('product_discount_price_ajax').innerHTML=='' ||$('product_discount_price_ajax').innerHTML=='0' ){
			this.compositeAttributeObject.product_price = $('product_price_ajax').innerHTML;
		}else{
			this.compositeAttributeObject.product_price = $('product_discount_price_ajax').innerHTML;
		}
		//alert(Object.toJSON(this.product));
	},
	setUploadedAttributesForUser:function(event){
		if(event.element().checked){
			//hide all the measurement attributes
			this.MeasurementAttributesArray.each(function(value){value.hide()});
			this.useMyMeasurementCheckBoxChecked=true;
		}else{
			this.useMyMeasurementCheckBoxChecked=false;
			this.MeasurementAttributesArray.each(function(value){value.show()});
		}
		this.checkAvailability();
		//alert('here at clicked');
	},
	
	setSelectedAttribute:function(event){
		//alert('here');
		var element = event.element();
		//alert(element.up('div').id);
		
		if(element.hasClassName('attributeSelected')){
			$A($(element.up('div').id).getElementsBySelector('li')).each(function(value){
																			  value.removeClassName('attributeSelected');
																			  });
		
			this.removeSelectedAttributeToProduct(element);								
		}else{
			$A($(element.up('div').id).getElementsBySelector('li')).each(function(value){
																			   value.removeClassName('attributeSelected');
																			  });
			//alert(parentDiv);
  			element.addClassName('attributeSelected');
			this.addSelectedAttributeToProduct(element);
		}
		//alert(element.id);
		
	},
	
	addSelectedAttributeToProduct:function(element){
		var attributeClassName=element.up('div').className;
		//alert(attributeClassName);
		var attributeId=element.up('div').id;
		if(attributeClassName=='measurementAttribute'){
			//alert(attributeId);
			this.MeasurementAttributesSelected[attributeId]=element.id;
			this.compositeAttributeObject[attributeId]=element.id;
			//alert(this.MeasurementAttributesSelected[attributeId]);
		}else if(attributeClassName=='colorSelection'){
			//alert('here');
			this.ColorAttributesSelected[attributeId]=element.id;
			this.compositeAttributeObject[attributeId]=element.id;

			//******************this is where to change the pictures on the right side
			element.up('.productDetailRightSidePanel').down('.productColorAttributeIndividualImage').innerHTML=element.down('.productImageColorAttributeHiddenSpan').innerHTML;
		}
		//check to see if all the required attributes are needed
		/*$H(this.MeasurementAttributesSelected).each(function(value, index){
															 alert(value[0]);
															alert(value[1]);
														 });*/
		this.checkAvailability();
	},
	removeSelectedAttributeToProduct:function(element){
		var attributeClassName=element.up('div').className;
		//alert(attributeClassName);
		var attributeId = element.up('div').id;
		if(attributeClassName=='measurementAttribute'){
			//alert(attributeId);
			this.MeasurementAttributesSelected[attributeId]='none';
			//alert(this.MeasurementAttributesSelected[attributeId]);
		}else if(attributeClassName=='colorSelection'){
			this.ColorAttributesSelected[attributeId]='none';
			//************************this is where to remove the pictures from the rigth side
			//alert(this.ColorAttributesSelected[attributeId]);
		}
		this.checkAvailability();
	},
	
	checkAvailability:function(){
		delete this.error;
		this.error = new Object();
		
		if(this.useMyMeasurementCheckBoxChecked!=true){
		$H(this.MeasurementAttributesSelected).each(function(value, index){
															 //alert('value 0: '+value[0]);
															 //alert('value 1: '+value[1]);
															 if(value[1]=='none'){
																// alert('before error');
																this.error[value[0]]=value[1];
																this.error['exists']=true;
																//alert('after error: '+this.error[value[0]]);
															 }
														 }.bind(this));
		}
		
		//alert(this.ColorAttributesSelected);
			//alert(this.productDiv.down('.colorSelection').getElementsBySelector('li').size());
			$H(this.ColorAttributesSelected).each(function(value, index){
																if(value[1]=='none'){
																	this.error[value[0]]=value[1];
																	this.error['exists']=true;
																}
																 //alert('value 0: '+value[0]);
																 //alert('value 1: '+value[1]);
														   }.bind(this));
		
		//alert('here at add product to element');
		if(this.error['exists'])
		{
			//alert('here at error');
			this.productDiv.down('input.addToCart').writeAttribute('disabled', 'disabled');
		}else{
			//alert('here at no error');
			this.productDiv.down('input.addToCart').removeAttribute('disabled');	
		}
	},
	
	addProductToCart:function(){
		this.compositeAttributeObject.useMyMeasurement=this.useMyMeasurementCheckBoxChecked;	
		
		
		//tempProduct.serialize();
		//alert(tempProduct);
		var options={
			parameters: this.compositeAttributeObject,
			method: 'get',
			onSuccess: this.addedToCart.bind(this)
		};
		
		new Ajax.Request('http://www.dancewearrialto.com/shoppingcart/additemtoshoppingcart', options);
		//alert(this.ColorAttributesSelected);
	},
	addedToCart:function(transport){
		var json = transport.responseText.evalJSON(true);
		//alert(json);
	}
}