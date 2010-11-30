// JavaScript Document
checkOutEnhancer = Class.create();

checkOutEnhancer.prototype={
	form : null,
	boolResponseRequestUpdate:null,
	strResponseRequestUpdateDiv:null,
	arrShippingDelete:null,
	arrMakeShipping:null,
	btnProceedToComfirmation:null,
	initialize:function(form, boolResponseUpdate, strUpdateDiv)
	{
		////alert('at form init');
		this.form=$(form);
		this.form.observe('submit', this.onSubmit.bindAsEventListener(this));
		this.resetErrors();
		if(boolResponseUpdate==1){
			this.boolResponseRequestUpdate=1;
			this.strResponseRequestUpdateDiv=$(strUpdateDiv);
		}
		
		this.arrShippingDelete = $A($$('.deleteShippingAddressAnchor'));

		
		this.arrShippingDelete.each(function(value){
							 value.observe('click', this.ajaxDeleteShippingAddress.bindAsEventListener(this))
										  }.bind(this));
		this.arrMakeShipping = $A($$('.makeShippingAddressAnchor'));

		
		this.arrMakeShipping.each(function(value){
							 value.observe('click', this.ajaxMakeShippingAddress.bindAsEventListener(this))
										  }.bind(this));
		
		this.btnProceedToComfirmation=$("proceedToComfirmation");
		this.btnProceedToComfirmation.observe('click', this.proceedToComfirmationAction.bindAsEventListener(this));
							 
		//check all the delete shipping address buttons. 
	},
	resetErrors : function(){	
		this.form.getElementsBySelector('.error').invoke('hide');
	},
	
	showError :function(key, val){
		////alert('here at show error');
		var formElement=this.form[key];
		////alert('form key is: '+key);
		var container = formElement.up().down('.error');
		////alert('container is: '+container.innerHTML);
		if(container){
			container.update(val);
			container.show();
		}
	},
	onSubmit :function(e){
		Event.stop(e);
		
		var options={
			parameters: this.form.serialize(),
			method: this.form.method,
			onSuccess: this.onFormSuccess.bind(this)
		};
		
		this.resetErrors();
		new Ajax.Request(this.form.action, options);
	},
	onFormSuccess: function(transport){
		////alert('on form success');
		var shippingAddressDiv=$("allShippingAddresses");

		var json = transport.responseText.evalJSON(true);
		var errors = $H(json.errors);
		////alert('error size is: '+errors.size());
		if(errors.size()>0 && errors.size()!=38  &&errors.size()!=43 ){ //38 characters is very strange here because when there is no error, the size of errors is 38... hm..
			////alert('here at form error');
			
			this.form.down('.error').show();
			errors.each(function(pair)
								 {
									// //alert(pair.key);
									// //alert(pair.value);
									 this.showError(pair.key, pair.value);
								 }.bind(this));
		}else{
			//alert('here1');
			var address=this.createShippingAddressHtml(json);

			if(json.defaultShipping=='off' && json.previousDefaultShipping!=0 ){
				//alert('here2');
				lastShippingAddress = $$('.shippingAddressBox').last();
				new Insertion.After(lastShippingAddress, address);
				//alert('here3');
				$('toggleAddShipping').removeClassName('selectionOn');
				$('editShippingForm').hide();
				
				$('makeShippingAddress_'+json.shippingId).observe('click', this.ajaxMakeShippingAddress.bindAsEventListener(this));
				
			}else if(json.defaultShipping=='on' || json.previousDefaultShipping==0){
				
				//alert('-here1');
				//if there is a previous tag, adding make default button next to the previous defaul tag
				if(json.previousDefaultShipping!=0){
					//alert('-here1.5');
				$('shippingAddress_'+json.previousDefaultShipping).innerHTML=$('shippingAddress_'+json.previousDefaultShipping).innerHTML+'<a id="makeShippingAddress_'+json.previousDefaultShipping+'" class="makeShippingAddressAnchor" href="/account/makedefaultshipping?editAddress='+json.previousDefaultShipping+'"><img src="/public/resources/css/images/ShippingButton.gif" /></a><br />';
				$("deleteShippingAddress_"+json.previousDefaultShipping).observe('click', this.ajaxDeleteShippingAddress.bindAsEventListener(this));
				$('makeShippingAddress_'+json.previousDefaultShipping).observe('click', this.ajaxMakeShippingAddress.bindAsEventListener(this));
				//alert('-here1.9');
				}
				
								//alert('-here2');

				if(json.previousDefaultShipping!=0 || (json.previousDefaultShipping==0 && json.existingAddresses>1)){ //need to add the fact that it has shipping. 

				lastShippingAddress = $$('.shippingAddressBox').last();
								//alert('-here3'); 

				new Insertion.After(lastShippingAddress, address);
								//alert('-here4');
					if(json.defaultShipping!='on'){
					$('makeShippingAddress_'+json.shippingId).observe('click', this.ajaxMakeShippingAddress.bindAsEventListener(this));
					}
				}else{
				$("allShippingAddresses").innerHTML=address;
				}
				//add event listiner here for the new deleteShippingAddress_Key object.
				$("deleteShippingAddress_"+json.shippingId).observe('click', this.ajaxDeleteShippingAddress.bindAsEventListener(this));
				//alert('defaultShipping is: '+json.defaultShipping);
				if(json.defaultShipping=='on' || json.existingAddresses==1){
				$('finalUserOrderShippingInfo').innerHTML=this.createShippingAddressHtmlForDelivery(json);
				//alert('here5');
				$('nextToRewardPointAnchor').show();
				}
				$('toggleAddShipping').removeClassName('selectionOn');
				$('editShippingForm').hide();
			}
		}
	}, 
	
	createShippingAddressHtml:function(jsonObject){
		if((jsonObject.defaultShipping=='off' && jsonObject.previousDefaultShipping!=0)||(jsonObject.previousDefaultShipping==0 &&jsonObject.existingAddresses>1 &&jsonObject.defaultShipping=='off')){
			//alert('ba');
		var shippingAddressString = '<div class="shippingAddressBox" id="shippingAddress_'+jsonObject.shippingId+'">'+jsonObject.address_one+'<br/>'							+   ''+jsonObject.address_two+'<br/>'
								+	''+jsonObject.city+', '+jsonObject.state+' '+jsonObject.zip+'<br/>'
								+	''+jsonObject.country+'<br/><a id="deleteShippingAddress_'+jsonObject.shippingId+'" class="deleteShippingAddressAnchor" href="/account/deleteshipping?editAddress='+jsonObject.shippingId+'">Delete</a><br/><a id="makeShippingAddress_'+jsonObject.shippingId+'" class="makeShippingAddressAnchor" href="/account/makedefaultshipping?editAddress='+jsonObject.shippingId+'"><img src="/public/resources/css/images/ShippingButton.gif"></a><br/></div>';
		}else if(jsonObject.defaultShipping=='on' || jsonObject.previousDefaultShipping=='0'){
			//alert('ba2');
			var shippingAddressString = '<div class="shippingAddressBox" id="shippingAddress_'+jsonObject.shippingId+'">'+jsonObject.address_one+'<br/>'							+   ''+jsonObject.address_two+'<br/>'
								+	''+jsonObject.city+', '+jsonObject.state+' '+jsonObject.zip+'<br/>'
								+	''+jsonObject.country+'<br/><a id="deleteShippingAddress_'+jsonObject.shippingId+'" class="deleteShippingAddressAnchor" href="/account/deleteshipping?editAddress='+jsonObject.shippingId+'">Delete</a><br/></div>';
		}
		return shippingAddressString;
		
	},
	createShippingAddressHtmlForDelivery:function(jsonObject){
		//alert('jsonobject1');
		var deliveryShippingAddressString = jsonObject.name+'<br/>'+jsonObject.address_one+'<br/>';
		if(jsonObject.address_two!=''){
			deliveryShippingAddressString = deliveryShippingAddressString+jsonObject.address_two+'<br/>';
		}
		//alert('jsonobject2');
		deliveryShippingAddressString=deliveryShippingAddressString+jsonObject.city+', '+jsonObject.state+' '+jsonObject.zip+'<br/>'+jsonObject.country;
		//alert(deliveryShippingAddressString);
		return deliveryShippingAddressString;
	},
	ajaxDeleteShippingAddress:function(e){Event.stop(e);
			var parentClass = this;
			var dialog = $j('<div></div>').html('Are you sure you want to delete this address?').dialog({
			autoOpen: false,
			title: 'Stop!',
			maxHeight: 200,
			minHeight:50,
			modal: true,
			buttons:{"ok":function(){
				parentClass.sendAjaxRequestToDeleteShippingAddress(e);
				$j(this).dialog("close");
			},
			"cancel":function(){
				//alert('here2');
				$j(this).dialog("close");
			}}
		});
		dialog.dialog('open');
	},
	sendAjaxRequestToDeleteShippingAddress:function(e){
		var element = e.element();
		strParsed = element.id.split('_');
		parentClass = this;

		var options={
			parameters: {'editAddress':strParsed[1]},
			method: 'get',
			onSuccess: parentClass.onDeleteShippingSuccess
		};
		
		new Ajax.Request('/account/deleteshipping', options);
		
		//alert('element id is: '+strParsed[1]);
	},
	onDeleteShippingSuccess:function(transport){
		var json = transport.responseText.evalJSON(true);
		//alert(json);
		if(json.deletedShippingId != json.defaultShippingAddressId){
			//alert('deleting top section');
			$("shippingAddress_"+json.deletedShippingId).remove();
		}
		if(json.defaultShippingAddressId==null){
			//alert('deleting second section');
			$('finalUserOrderShippingInfo').innerHTML="Please add or select a delivery address from above.";
			$('nextToRewardPointAnchor').hide();
		}
		//alert('deleted id is: '+json.deletedShippingId);
		//alert('default shipping id is: '+json.defaultShippingAddressId);
	},
	ajaxMakeShippingAddress:function(e){Event.stop(e);
		var parentClass = this;
		var dialog2 = $j('<div></div>').html('Are you sure you want to ship to this address?').dialog({
				autoOpen: false,
				title: 'Stop!',
				maxHeight: 200,
				minHeight:50,
				modal: true,
				buttons:{"ok":function(){
					parentClass.sendAjaxRequestToMakeShippingAddress(e);
					$j(this).dialog("close");
				},
				"cancel":function(){
					//alert('here2');
					$j(this).dialog("close");
				}}
			});
			dialog2.dialog('open');
	},
	sendAjaxRequestToMakeShippingAddress:function(event){
		//alert('here at send ajax request');
		//alert(event);
		var element = event.element().up('a');
		////alert('element is: '+element);
		////alert('element id is: '+element.id);
		strParsed = element.id.split('_');
		parentClass = this;

		var options={
			parameters: {'editAddress':strParsed[1]},
			method: 'get',
			onSuccess: parentClass.onMakeShippingSuccess.bind(this)
		};
		
		new Ajax.Request('/account/makedefaultshipping', options);
		
		//alert('element id is: '+strParsed[1]);
		
	},

	onMakeShippingSuccess:function(transport){
		var json = transport.responseText.evalJSON(true);
		//alert('here at make default successfull');
		if(json.previousShippingAddressId!=null){
			
		}
		if(json.newShippingAddress>0){
			//alert('adding 1');
			$('finalUserOrderShippingInfo').innerHTML=this.createShippingAddressHtmlForDelivery(json);
			$('nextToRewardPointAnchor').show();
			//alert('adding 2');
			$('makeShippingAddress_'+json.newShippingAddress).remove();
			
			//alert('adding 3');
			$('shippingAddress_'+json.previousShippingAddressId).innerHTML=$('shippingAddress_'+json.previousShippingAddressId).innerHTML+'<a id="makeShippingAddress_'+json.previousShippingAddressId+'" class="makeShippingAddressAnchor" href="/account/makedefaultshipping?editAddress='+json.previousShippingAddressId+'"><img src="/public/resources/css/images/ShippingButton.gif" /></a>';
			//alert('adding 4');
			$("deleteShippingAddress_"+json.previousShippingAddressId).observe('click', this.ajaxDeleteShippingAddress.bindAsEventListener(this));
			$('makeShippingAddress_'+json.previousShippingAddressId).observe('click',  this.ajaxMakeShippingAddress.bindAsEventListener(this));
		}
			
	},
	proceedToComfirmationAction:function(e){
		Event.stop(e);
		rewardPoints = $$('#rewardPointSelection option').find(function(ele){return !!ele.selected})
		//alert(rewardPoints.value);
		promotionCode = $('promotionCode').value;
		//alert(promotionCode);
		//alert('here at paused href');
		
		var options = {
			parameters: {'rewardPoints': rewardPoints.value, 'promotionCode': promotionCode},
			method: 'get',
			onSuccess: this.onCalcPromotionSuccessful.bind(this)
		};
		
		new Ajax.Request('/checkout/rewardsandpromotions/', options);
	},
	onCalcPromotionSuccessful:function(transport){
		//alert('here at response');
		var json = transport.responseText.evalJSON(true);
		//alert(json);
		//alert(json.successful);
		//alert(json.rewardPoints);
		//alert(json.promotionCode);
		if(json.successful!=true){
			var dialog2 = $j('<div></div>').html('We are sorry, but either your reward points or promotion code is incorrect.').dialog({
				autoOpen: false,
				title: 'Warning!',
				maxHeight: 200,
				minHeight:50,
				modal: true,
				buttons:{"ok":function(){
					$j(this).dialog("close");
				}}
			});
			dialog2.dialog('open');
		}else{
			//alert('here at json true');
			window.location= 'http://localhost/checkout/confirmation';
		}
	}
	
}

