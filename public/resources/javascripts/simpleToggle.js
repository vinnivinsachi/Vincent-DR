// JavaScript Document
simpleToggle = Class.create();

simpleToggle.prototype={
	toggleKey:null,
	toggleDiv:null,
	cssCurrentStatus:null,
	initialize:function(toggleAnchor, toggleDiv, currentStatus){
		//alert('here');
		this.toggleKey = $(toggleAnchor);
		this.toggleDiv = $(toggleDiv);
		this.cssCurrentStatus = currentStatus;
		
		this.toggleKey.observe('click', this.toggleSection.bindAsEventListener(this));
	},
	
	toggleSection:function(e){
		var element = e.element();
		if(element.hasClassName(this.cssCurrentStatus)){
			this.toggleDiv.hide();
			this.toggleKey.removeClassName(this.cssCurrentStatus);
		}else{	
			this.toggleDiv.show();
			this.toggleKey.addClassName(this.cssCurrentStatus);
		}
	}
}