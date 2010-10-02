// JavaScript Document
//This is the main javascript that manages the behavior of images across the entire webplatform. 
//implemented in all the prviews of main objects such as posts, products, events, memberships.


BlogImageManager =Class.create();
BlogImageManager.prototype = {
	
	initialize: function(container)
	{
			this.container = $(container);
			
			if(!this.container)
			{
				return;
			}
			
			this.container.getElementsBySelector('form').each(function(form){
																	   form.observe('submit', this.onDeleteClick.bindAsEventListener(this));
																	   }.bind(this));
			
			var options={
				overlap : 'horizontal',
				constraint : false,
				onUpdate : this.onSortUpdate.bind(this)
			};
			
			Sortable.create(this.container, options);
	},
	
	onDeleteClick: function(e)
	{
			Event.stop(e);
			
			var form = Event.element(e);  //was form that was clicked. 
			
			var options ={
				method: 'post',
				parameters : form.serialize(),
				onSuccess: this.onDeleteSuccess.bind(this),
				onFailure: this.onDeleteFailure.bind(this)
			}
			
			message_write('Deleting image...');
			
			new Ajax.Request(form.action, options); //this request the delete // the action of the form. 
	}, 
	
	onDeleteSuccess: function(transport) //this responds by hiding the element. 
	{
		var json = transport.responseText.evalJSON(true);
		
		if(json.deleted){
			var image_id = json.image_id;
			
			var input = this.container.down('input[value='+image_id+ ']'); //down to search for an input with value = to imageId
			if (input){
				var options ={
					duration :0.3,
					afterFinish: function(effect){
						message_clear();
						effect.element.remove();
					}
				}
				
				new Effect.Fade(input.up('li'), options); //because we looked down to find the input, we look up to remove the list 'li' element.
				return;
			}
		}
		this.onDeleteFailure(transport);
	},
	
	onDeleteFailure: function(transport)
	{
			message_write('Error deleting image');
	},
	
	
	onSortUpdate : function(draggable)
	{
		var form = this.container.down('form');
		var post_id = $F(form.down('input[name=id]')); //find the input with name=id;
		
		var options ={
				method :'post',
				parameters: 'reorder=1'+'&id='+ post_id + '&' + Sortable.serialize(draggable),
				onSuccess :function(){message_clear();}
		};
		
		//alert(options.parameters);
		
		message_write('Updating image order...');
		new Ajax.Request(form.action, options);
	}
				
};