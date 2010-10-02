// JavaScript Document

BlogMonthlySummary = Class.create();

BlogMonthlySummary.prototype={
	container :null,
	linkContainer:null,
	
	initialize:function(container, linkContainer)
	{
		this.container = $(container);
		this.linkContainer=$(linkContainer);
		
		if(!this.container || !this.linkContainer)
		{
			return;
		}
		
		this.linkContainer.getElementsBySelector('a').each(function(link){
																  link.observe('click', this.onLinkClick.bindAsEventListener(this));
																  }.bind(this));
	},
	
	onLinkClick :function(e)
	{
		var link=Event.element(e);
		var options ={
			onComplete: message_clear
		};
		
		message_write('loading blog posts...');
		
		new Ajax.Updater(this.container, link.href, options); //this finds 
		
		Event.stop(e);
	}
};