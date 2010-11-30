// JavaScript Document
individualToggle = Class.create();

individualToggle.prototype={
	toggleKey:null,
	toggleDiv:null,
	hiddenDivs:null,
	cssCurrentStatus:null,
	otherToggleRemoveCurrentAnchor:null,
	initialize:function(toggleAnchor, toggleDiv, currentStatus, hiddenDivs, otherToggleAnchors){
		this.toggleKey = $(toggleAnchor);
		this.toggleDiv = $(toggleDiv);
		this.hiddenDivs = hiddenDivs;
		this.otherToggleRemoveCurrentAnchor = otherToggleAnchors;
		this.cssCurrentStatus = currentStatus;
		
		this.toggleKey.observe('click', this.toggleSection.bindAsEventListener(this));
	},
	
	toggleSection:function(e){
		this.otherToggleRemoveCurrentAnchor.each(function(value){
														  //alert('here');
					$(value).removeClassName(this.cssCurrentStatus)}.bind(this));
		this.hiddenDivs.each(function(value){
									  section = $(value);
									  section.hide();
									  });
		this.toggleDiv.show();
		this.toggleKey.addClassName(this.cssCurrentStatus);
	}
}