SearchSuggestor = Class.create();

SearchSuggestor.prototype = {
	url : '/search/suggestion',
	delay : 0.3,
	container: null,
	input : null,
	timer : null,
	query : null,
	
	initialize : function(container)
	{
		this.container = $(container);
		if(!this.container)
		{
			return;
		}
		
		this.input = this.container.down('input[name=q]');
		if(!this.input)
		{
			return;
		}
		
		this.input.setAttribute('AUTOCOMPLETE', 'off');
		this.input.observe('keypress', this.onQueryChanged.bindAsEventListener(this));
	},
	
	
	
	
	onQueryChanged :function(e)
	{
		clearTimeout(this.timer);
		this.timer = setTimeout(this.loadSuggestions.bind(this), this.delay * 1000);
	},
	
	loadSuggestions : function()
	{
		var query = $F(this.input).strip();
		
		if(query.length==0)
		{
			this.clearSuggestions();
		}
		
		if(query.length ==0 || query == this.query)
		{
			return;
		}
		
		this.query = query;
		
		var options = {
			parameters : 'q=' + query,
			onSuccess : this.onSuggestionLoad.bind(this)
		};
		
		new Ajax.Request(this.url, options);
	},
	
	onSuggestionLoad : function(transport)
	{
		var json = transport.responseText.evalJSON(true);
		//alert('here at suggestion load');
		this.showSuggestions(json);
		
	},
	
	showSuggestions : function(suggestions)
	{
		this.clearSuggestions();
		
		//alert('here at show suggestions');
		if(suggestions.size() ==0)
		{
			return;
		}
		
		var ul = Builder.node('ul'); //creating <ul></ul>
		
		for(var i=0; i < suggestions.size(); i++)
		{
			var li = $(Builder.node('li')); //createing <li></li>
			li.update(suggestions[i]); //adding value to the li
			
			li.observe('mouseover', function(e){Event.element(e).addClassName('active')});
			
			li.observe('mouseout', function(e) {Event.element(e).removeClassName('active')});
			
			li.observe('click', this.suggestionClicked.bindAsEventListener(this));
			
			
			ul.appendChild(li); //adding li to the ul
		}
		
		this.container.appendChild(ul); //adding<ul> to search
	},
	
	suggestionClicked : function(e)
	{
		var elt = Event.element(e);
		var term = elt.innerHTML.strip();
		
		this.input.value = term;
		this.input.form.submit();
		
		this.clearSuggestions();
	},
	
	clearSuggestions :function()
	{
			this.container.getElementsBySelector('ul').each(function(e){
						e.remove();
																	 });
			this.query =null;
	}
	
};