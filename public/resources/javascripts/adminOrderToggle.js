// JavaScript Document
adminOrderToggle = Class.create();

adminOrderToggle.prototype={
	buyerMessageAnchor:null,
	sellerMessageAnchor:null,
	messageThreadAnchor:null,
	trackingAnchor:null,
	returnTrackingAnchor:null,
	cssCurrentSTatus:null,
	
	initialize:function(buyerMessageAnchor, sellerMessageAnchor, messageThreadAnchor, trackingAnchor, returnTrackingAnchor, currentStatus){
		//alert('here');
		this.buyerMessageAnchor = $$(buyerMessageAnchor);
		this.sellerMessageAnchor = $$(sellerMessageAnchor);
		this.messageThreadAnchor = $$(messageThreadAnchor);
		this.trackingAnchor = $$(trackingAnchor);
		this.returnTrackingAnchor = $$(returnTrackingAnchor);
		this.cssCurrentStatus = currentStatus;
		
		
		this.buyerMessageAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
		
		this.sellerMessageAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
		this.messageThreadAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
		this.trackingAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
		this.returnTrackingAnchor.each(function(value){
									 value.observe('click', this.toggleSection.bindAsEventListener(this));
									 }.bind(this));
	},
	
	toggleSection:function(e){
		var element = e.element();
		parser = element.id.split('-');
		strToggleDiv=parser[1]+'-'+parser[2];
		//alert('strToggleDiv is: '+strToggleDiv);
		sectionRow = $$('.'+parser[2]);
		//alert('here');
		sectionRow.each(function(value){
								// alert('value id is: '+value.id);
								 currentAchor = $('anchorID-'+value.id);
								// alert(currentAchor);
								 if(value.id==strToggleDiv){
									 if(currentAchor.hasClassName(this.cssCurrentStatus)){
										//alert('here at hiding');
								  	 	value.hide();
										if(currentAchor){
										currentAchor.removeClassName(this.cssCurrentStatus);
										}
									 }else{	
									   // alert('here1');
										if(currentAchor.hasClassName('anchorTrackingStatus') || currentAchor.hasClassName('anchorReturnTrackingStatus')){
										//	alert('here2');
											if(value.innerHTML.strip()==''){
											var ttp_width = '745'; var ttp_m_width = '200'; var ttp_key='86229f7a29121871a58d1ad8'; var ttp_number = currentAchor.title;
										//	alert(currentAchor.title);
											if(!ttp_width){var ttp_width=575;}
											if(!ttp_height){var ttp_height=300;}
											if(!ttp_m_width){var ttp_m_width=260;}
											if(!ttp_m_height){var ttp_m_height=200;}
											if(!ttp_debug){var ttp_debug=false;}
											
											value.innerHTML="<iframe src='http://commercial.trackthepack.com/embed?u="+escape(window.location.hostname)+"&k="+ttp_key+"&n="+ttp_number+"&mw="+ttp_m_width+"&mh="+ttp_m_height+"&debug="+ttp_debug+"' height='"+ttp_height+"' width='"+ttp_width+"' frameborder='0' scrolling='no'></iframe>";
											}
										}
										//alert('here at showing');
										value.show();
									 	currentAchor.addClassName(this.cssCurrentStatus);
									 }
								 }else{
									// alert('here3');
									 if(currentAchor){
										 currentAchor.removeClassName(this.cssCurrentStatus);
									 }
									 
								  	 value.hide();
								 }
								 }.bind(this));
	}
}