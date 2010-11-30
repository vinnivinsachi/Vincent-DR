// JavaScript Document

UserRegistrationForm = Class.create();

UserRegistrationForm.prototype ={
		
	form :null,
	
	initialize : function(form)
	{
		
		this.form = $(form);
		//alert(this.form);
		this.form.observe('submit', this.onSubmit.bindAsEventListener(this));
		//alert('you are at observe initialize button');
		this.resetErrors();
	},
	
	resetErrors : function()
	{
		this.form.getElementsBySelector('.error').invoke('hide');
		//alert('hello you are at reset Errors');
	},
	
	showError: function(key, val) //this is a bizzare function. it scrolls the elements in the form and find class of '.error' and update and show the message.
	{
		var formElement = this.form[key];
		var container= formElement.up().down('.error');
		
		if(container){
			container.update(val); //change the innerhtml in container to val
			//alert('container is about to be show');
			container.show();
		}
	},
	
	onSubmit: function(e)
	{
		Event.stop(e);
		//alert(this.form.serialize());
		//alert(this.form.method);
		//alert(this.form.action);
		var options={
			parameters	:this.form.serialize(),
			method		:'post', //!!!!!!if this is this.form.method it would not work!!
			onSuccess	: this.onFormSuccess.bind(this)
			//onFailure 	: this.onFormFailure.bind(this)
		};
		
		this.resetErrors();
		new Ajax.Request(this.form.action, options); //this sends the ajax request.
	},
	
	/*onFormFailure: function(transport)
	{
		alert('you have failed the connectoin');
	},*/
	
	onFormSuccess: function(transport)
	{
		//alert('you are here at successfull connection');
		var json=transport.responseText.evalJSON(true); //here is the problem!!
		
		//alert('json.errors'); //it is going to here and below at all. 
		
		var errors = $H(json.errors);
		
		//alert(errors);
		//alert('errors at $H(json.error)');
		
		//alert(errors.size());
		if(errors.size()!=39 && errors.size()>0)
		{
			//alert('you are here at errors.size()>0) on line 70');
			this.form.down('.error').show();
			errors.each(function(pair){
								 this.showError(pair.key, pair.value);
								 }.bind(this));
		}
		else
		{
			//alert('you are here at form.submit()');
			this.form.submit();
		}
	}
};