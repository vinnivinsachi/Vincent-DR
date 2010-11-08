// JavaScript Document
//pg253
Event.observe(window, 'load', function(){
		
		
		var deleteMessageButton = $('messageDelete');
		
		var deleteAffiliationButton = $('affiliateDelete');
		
		
		if(deleteMessageButton){
			deleteMessageButton.observe('click', function(e){
				if(!confirm('Are you sure you permanently delete this message?'))
				{
					Event.stop(e);
				}
			});
		}
		
		if(deleteAffiliationButton){
			deleteAffiliationButton.observe('click', function(e){
				if(!confirm('Are you sure you permanently delete this member?'))
				{
					Event.stop(e);
				}
			});
		}
		
});