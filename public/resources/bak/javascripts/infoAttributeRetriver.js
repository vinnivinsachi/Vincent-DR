//this class contacts ajaxtest and return the details of all the product attributes and product attribute details. used for http://localhost/userproductpreview/tag?tag=Latin%20pants
infoAttributeRetriver = Class.create();
infoAttributeRetriver.prototype={
	products : null,
	currentAttributesArrayValueHolder:new Object(),
	currentAttributesArray:null,
	//this variable keeps track of the values of the specific attribute. 
	productIdArray: null,
	finalAttributeArray:null,
	attributeDiv : null,
	tagBodyDiv:null,
	
	currentExistingAttribute: null,
	currentSelectedAttribute:null,
	currentExistingAttributeIndex:null,
	finalProductArrayCollection:null,
	productTagBrand:null,
	BrandCurrent:'All',
	CityCurrent:'All',
	PriceCurrent:'All',
	productTagCity:null,
	ProductTagPrice:null,
	currentProducts:null,
	numProductAttributeArray:null,
	rightString:new Array(),
	
	initialize:function(div, tag)
	{
		this.attributeDiv = $(div);
		this.tagBodyDiv = $('productTagBody');
		//alert(tag);
		//alert(this.attributeDiv.innerHTML);
		
		var options={
			parameters: 'tag='+tag,
			method: 'get',
			onSuccess: this.onRetriverSuccess.bind(this),
			onFailure: function(){alert('failed')}
		};
		new Ajax.Request('/userproductpreview/ajaxtest?tag='+tag, options);
		
		this.productTagBrand = $('productTagBrand');
		this.productTagBrand.observe('change', this.changeBrandCurrent.bindAsEventListener(this));

		this.productTagCity = $('productTagCity');
		this.productTagCity.observe('change', this.changeCityCurrent.bindAsEventListener(this));
		
		this.productTagPrice = $('productTagPrice');
		this.productTagPrice.observe('change', this.changePriceCurrent.bindAsEventListener(this));
		//alert(this.productTagBrand.innerHTML);
		//alert(this.productTagCity.innerHTML);
		
		this.showAllProductButton = $('showAllProductButton');
		this.showAllProductButton.observe('click', this.showAllProductButtonAndResetAllAttributeSelection.bindAsEventListener(this));
		
		this.finalAttributeArray=$A(this.attributeDiv.getElementsBySelector('li'));
		//alert(this.finalAttributeArray);
											   
		this.finalAttributeArray.each(function(value){
									   value.observe('click', this.setSelectedAttribute.bindAsEventListener(this))
												}.bind(this));
	},
	onRetriverSuccess: function(transport){
		var json = transport.responseText.evalJSON(true);
		this.products = json;
		this.currentAttributesArray = $A(this.products.productType);	
		this.numProductAttributeArray=this.currentAttributesArray.size();
		this.currentProducts = $A(this.products.product);
		
		this.currentAttributesArray.each(function(value, index){
			this.currentAttributesArrayValueHolder[value]='All';
												  }.bind(this));		
		//-----------------------------------------------------------
		this.currentExistingAttributeIndex=0;
		this.currentExistingAttribute=this.currentAttributesArray[this.currentExistingAttributeIndex].strip();
		
		this.productIdArray = $A(this.products.productIdArray);
		var currentArrayValue;
	},
	//this searches the product with a set of consecutive selections and spits out the selections for a given attribute. 
	findNextLevelAttribute:function(arrCurrentAttribute, strNextAttribute){
		var currentProductsWithAttribute=this.currentProducts.findAll(function(str){
			return this.searchAttribute(str, arrCurrentAttribute);
							}.bind(this));
		//alert(currentProductsWithAttribute);
		var nextAttributes = currentProductsWithAttribute.pluck(strNextAttribute);
		
		if(nextAttributes.size()==0){
			alert('no product available with the selected attributes');	
		}
		nextAttributes.each(function(value){
					$(strNextAttribute+'-'+value).addClassName('productAttributeAvailable')});
		//alert(nextAttributes);
	},
	//this searches that attributes of an array and return true is that object is a match. else, return false
	searchAttribute:function(obj, arrSelections){
		var error=false;
		arrSelections.each(function(value){
				strElementParser = value.split('-');
				if(obj[strElementParser[0]]==strElementParser[1]){
				}else{
					error = true;
				}
		});
		return !error;
	},
	//this is the event listener for each li item. sets the clickability of the next attributes that can be selected. and crand out an Array of already clicked attribute and the availability of the next attribute. 
	setSelectedAttribute:function(event){
		var element = event.element();
		
		var classNameAttributeParser=element.id.split('-');
		this.currentAttributesArrayValueHolder[classNameAttributeParser[0].strip()]=classNameAttributeParser[1].strip();
		
		
		//find out the current attribute index selected. 
		var clickedIndex=this.currentAttributesArray.indexOf(classNameAttributeParser[0].strip());
		
		//find out the next attribute index that will be selected.
		var nextAvailableIndexForClicking=clickedIndex+1;
		var missingString;
		//alert(clickedIndex);
		var problems=false;
		//if not the last attribute selected
		if(nextAvailableIndexForClicking<this.numProductAttributeArray){
			this.currentAttributesArray.each(function(value,index){
				//if the current attribute is greater than the clicked attribute, reset everything.
				if(index>=nextAvailableIndexForClicking){
					
					this.currentAttributesArrayValueHolder[value]='All';
					//alert(this.currentAttributesArrayValueHolder[value]);
					//remove all selected attributes
					$A($(value+'-productPreviewAttribute').getElementsBySelector('li')).each(function(value){
				   	value.removeClassName('productAttributeSelected');
					value.removeClassName('productAttributeAvailable');
				  	});

				}
				//else if the current attribute is less than the clicked index and it dosn't exist, then there is an error and that attributes need to be selected. 
				else if((index<clickedIndex)&&(this.currentAttributesArrayValueHolder[value]=='All')){	
					alert('please select a previous attribute '+value);
					problems=true;

					throw $break;
				}
													  }.bind(this));
			
			if(!problems){
				//adding CSSselection color to the item when there is no problems in selection. 
				$A($(element.up('ul').id).getElementsBySelector('li')).each(function(value){
				   value.removeClassName('productAttributeSelected');
				  });
				element.addClassName('productAttributeSelected');
				
				this.rightString.clear();
				this.currentAttributesArray.each(function(value, index){
						if(this.currentAttributesArrayValueHolder[value]!='All'){
						this.rightString[index]=(value+'-'+this.currentAttributesArrayValueHolder[value]);
						}
												}.bind(this));
				//alert(this.rightString);
				//only check the availability if there is no problems. 
				this.fetchProductsToSelectedAttribute();
				this.findNextLevelAttribute(this.rightString, this.currentAttributesArray[nextAvailableIndexForClicking]);
			}
		//when the item is the last one clicked,
		}else{
			//make sure that no problem happen, 
			this.currentAttributesArray.each(function(value,index){
				if((index<nextAvailableIndexForClicking)&&(this.currentAttributesArrayValueHolder[value]=='All')){	
					alert('please select a previous attribute '+value);
					problems=true;

					throw $break;
				}
													  }.bind(this));
			//if no problems, check the availability of the item and present the appropriate sign for product fetch. 
			if(!problems){
				$A($(element.up('ul').id).getElementsBySelector('li')).each(function(value){
				   value.removeClassName('productAttributeSelected');
				  });
				element.addClassName('productAttributeSelected');
				
				if(element.hasClassName('productAttributeAvailable') || this.numProductAttributeArray==1){
				this.rightString.push(element.id);

				}else{

					alert('We are sorry that we do not have products that match your selected measurments');	
				}
				//alert('here at checking all selected attributes');
				//verify the all the selected attributes and check if it is in stock. then color the fetch button. 	
			}	
		}
	},
	fetchProductsToSelectedAttribute:function(e){
		//alert('here at fetch product');
		//alert(this.rightString);
		$A(this.tagBodyDiv.getElementsByClassName('productBox')).each(function(value){value.hide()});
		var strClassSelections='';
		this.rightString.each(function(value){strClassSelections = strClassSelections+' '+value;});
		//alert(strClassSelections);
		if(this.BrandCurrent!='All'){
			strClassSelections=strClassSelections+' '+this.BrandCurrent;
		}
		if(this.CityCurrent!='All'){
			strClassSelections=strClassSelections+' '+this.CityCurrent;
		}
		if(this.PriceCurrent!='All'){
			strClassSelections=strClassSelections+' '+this.PriceCurrent;
		}
		strClassSelections=strClassSelections.strip();

		//alert(strClassSelections);
		if(strClassSelections==''){
			//alert('here');
		$A(this.tagBodyDiv.getElementsByClassName('productBox')).each(function(value){value.show()});
		}else{
			//alert('here2');
		$A(this.tagBodyDiv.getElementsByClassName(strClassSelections)).each(function(value){value.show()});
		}
		//this.ResetAllAttributeSelection();
	},
	ResetAllAttributeSelection:function(){
		this.rightString.clear();
		
		this.currentAttributesArray.each(function(value,index){
				//if the current attribute is greater than the clicked attribute, reset everything.
			this.currentAttributesArrayValueHolder[value]='All';
			//remove all selected attributes
				$A($(value+'-productPreviewAttribute').getElementsBySelector('li')).each(function(value){
				value.removeClassName('productAttributeSelected');
				if(index!=0){
					value.removeClassName('productAttributeAvailable');
																																}
				});
												  }.bind(this));
		
		this.productTagBrand.selectedIndex=0;
		this.productTagCity.selectedIndex=0;
		this.productTagPrice.selectedIndex=0;
			
		
	},
	showAllProductButtonAndResetAllAttributeSelection:function(e){
		$A(this.tagBodyDiv.getElementsByClassName('productBox')).each(function(value){value.show()});
		this.ResetAllAttributeSelection();
	},
	changeBrandCurrent:function(e){
		element = e.element();
		this.BrandCurrent=element[element.selectedIndex].value;
		//alert(this.BrandCurrent);
		this.fetchProductsToSelectedAttribute();
	},
	changeCityCurrent:function(e){
		element = e.element();
		this.CityCurrent=element[element.selectedIndex].value;
		//alert('here at city change');
		this.fetchProductsToSelectedAttribute();
	},
	changePriceCurrent:function(e){
		element = e.element();
		this.PriceCurrent=element[element.selectedIndex].value;
		//alert('here at city change');
		this.fetchProductsToSelectedAttribute();
		
	}
}

