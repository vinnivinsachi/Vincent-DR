toggleClass = Class.create();

toggleClass.prototype={
	shoutboxDiv:null,
	arrIndividualShoutMessages:null,
	strFormName:null,
	strToggleKey:null,
	strToggleKeyDiv:null,
	initialize:function(div, formName, toggleKey, toggleKeyDiv){
		this.shoutboxDiv = $(div);
		//alert('here');
		this.strFormName=formName;
		//alert('form name is: '+this.strFormName);
		this.strToggleKey=toggleKey;
		this.strToggleKeyDiv = toggleKeyDiv;
		//alert(this.strToggleKey);
		this.arrIndividualShoutMessages = $A(this.shoutboxDiv.getElementsByClassName(this.strToggleKey));
		
		this.arrIndividualShoutMessages.each(function(value){
					value.observe('click', this.openForm.bindAsEventListener(this));
						//value.down(this.strFormName)
					}.bind(this));
		
	},
	openForm:function(e){
		//alert('here at opening form');
		var element = e.element();
		if(element.hasClassName('shoutBoxFormOpen')){
			var formElement = element.up('.'+this.strToggleKeyDiv).down('.'+this.strFormName);
			//alert(formElement.innerHTML);
			formElement.hide();
			element.removeClassName('shoutBoxFormOpen');
			element.addClassName('shoutBoxFormClosed');
		}else{
		//alert(this.strFormName);
		var formElement = element.up('.'+this.strToggleKeyDiv).down('.'+this.strFormName);
		//alert(formElement.innerHTML);
		formElement.show();
		element.addClassName('shoutBoxFormOpen');
		
		}

	}
	
}
