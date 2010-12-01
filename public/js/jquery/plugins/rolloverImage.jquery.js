// Replaces '_off' with '_on' in an image name upon rollover
// and replaces upon rollout
(function( $ ){
$.fn.rolloverImage = function( options ){

	// Default settings
	var settings = {
		'off'	: '_off',
		'on'	: '_on'
	};
	// Merge passed options with defaults
	if(options){$.extend(settings, options);}

	// Make sure to return 'this' in order to allow chaining with other jquery functions
	return this.each(function(){
	
		// Get 'this' as a jQuery object
		var $this = $(this);
		
		$this.hover(function(){ this.src = this.src.replace(settings.off, settings.on); },
				   function(){ this.src = this.src.replace(settings.on, settings.off); });
		
	});

};
})( jQuery )
