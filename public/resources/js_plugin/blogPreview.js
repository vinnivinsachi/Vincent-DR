// JavaScript Document
//pg253
Event.observe(window, 'load', function(){
		
		var publishButton = $('status-publish');
		var unpublishButton = $('status-unpublish');
		var deleteButton = $('status-delete');
		var deleteMessageButton = $('messageDelete');
		var im = new BlogImageManager('post_images');
		
		if(publishButton){
			publishButton.observe('click', function(e){
				if(!confirm('Click OK to publish this post'))
				{
					Event.stop(e);
				}
			});
		}
		
		if(unpublishButton){
			unpublishButton.observe('click', function(e){
				if(!confirm('Click OK to unpublish this post'))
				{
					Event.stop(e);
				}
			});
		}
			
		if(deleteButton){
			deleteButton.observe('click', function(e){
				if(!confirm('Are you sure you permanently delete this post?'))
				{
					Event.stop(e);
				}
			});
		}
		
		if(deleteMessageButton){
			deleteButton.observe('click', function(e){
				if(!confirm('Are you sure you permanently delete this message?'))
				{
					Event.stop(e);
				}
			});
		}
		
		
		
});