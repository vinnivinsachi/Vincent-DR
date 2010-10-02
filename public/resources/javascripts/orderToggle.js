// JavaScript Document
orderToggle = Class.create();

orderToggle.prototype={
	messageAnchor:null,
	trackInfoAnchor:null,
	submitTrackingAnchor:null,
	returnTrackInfoAnchor:null,
	returnItemFormAnchor:null,
	cssCurrentStatus:null,
	cancelOrderAnchor:null,
	productReviewAnchor:null,
	marketSide:null,
	sectionRow:null,
	initialize:function(messageAnchor, trackInfoAnchor, returnTrackInfoAnchor, returnItemFormAnchor, submitTrackingAnchor, cancelOrderAnchor, productReviewAnchor, currentStatus, marketSide){
		//alert('here');
		this.marketSide = marketSide;
		this.messageAnchor = $$(messageAnchor);
		this.trackInfoAnchor = $$(trackInfoAnchor);
		this.returnTrackInfoAnchor = $$(returnTrackInfoAnchor);
		this.returnItemFormAnchor = $$(returnItemFormAnchor);
		this.submitTrackingAnchor=$$(submitTrackingAnchor);
		this.cancelOrderAnchor=$$(cancelOrderAnchor);
		this.productReviewAnchor=$$(productReviewAnchor);
		this.cssCurrentStatus = currentStatus;
		this.messageAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
		
		this.trackInfoAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
		this.returnTrackInfoAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
		this.returnItemFormAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
		this.submitTrackingAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
		this.cancelOrderAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
		this.productReviewAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
									 
	},
	
	toggleSection:function(e){
		var element = e.element();
		parser = element.id.split('-');
		strToggleDiv=parser[1]+'-'+parser[2];
		sectionRow = $$('.'+parser[2]);
		sectionRow.each(function(value){
								 currentAchor = $('anchorID-'+value.id);
								 if(value.id==strToggleDiv){
									 if(currentAchor.hasClassName(this.cssCurrentStatus)){
										
								  	 	value.hide();
										currentAchor.removeClassName(this.cssCurrentStatus);

									 }else{	
									 
										if(currentAchor.hasClassName('anchorTrackingStatus') || currentAchor.hasClassName('anchorReturnTrackingStatus')){
											if(value.innerHTML.strip()==''){
											var ttp_width = '640'; var ttp_m_width = '200'; var ttp_key='86229f7a29121871a58d1ad8'; var ttp_number = currentAchor.title;
											//alert(currentAchor.title);
											if(!ttp_width){var ttp_width=575;}
											if(!ttp_height){var ttp_height=300;}
											if(!ttp_m_width){var ttp_m_width=260;}
											if(!ttp_m_height){var ttp_m_height=200;}
											if(!ttp_debug){var ttp_debug=false;}
											
											value.innerHTML="<iframe src='http://commercial.trackthepack.com/embed?u="+escape(window.location.hostname)+"&k="+ttp_key+"&n="+ttp_number+"&mw="+ttp_m_width+"&mh="+ttp_m_height+"&debug="+ttp_debug+"' height='"+ttp_height+"' width='"+ttp_width+"' frameborder='0' scrolling='no'></iframe>";
											}
											//alert('here');
										}
										value.show();
									 	currentAchor.addClassName(this.cssCurrentStatus);
									 }
								 }else{
									
									 currentAchor.removeClassName(this.cssCurrentStatus);
								  	 value.hide();
								 }
								 }.bind(this));
	}
}