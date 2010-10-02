BlogTagSummary = Class.create();

BlogTagSummary.prototype={
	container: null, 
	linkContainer: null, 
	
	initialize: function(container, linkContainer)
	{
		this.container = $(container);
		this.linkContainer = $(linkContainer);
		
		if(!this.container || !this.linkContainer)
		{
			return;
		}
		
		this.linkContainer.getElementsBySelector('a').each(function(link){
						link.observe('click', this.onLinkClick.bindAsEventListener(this));
						}.bind(this));
		
	},
	
	onLinkClick: function(e)
	{
		var link=Event.element(e);
		
		var options={
			onComplete: message_clear
		};
		
		message_write('loading category posts...');
		
		new Ajax.Updater(this.container, link.href, options);
		
		
		Event.stop(e);
		
	}
};