// Turn display objects into tabs
// Optionally specifiy an area in which to display content
// Default selects the first tab
// Option to specifiy tabs as rollover images
(function( $ ){
$.fn.rolloverTabs = function( options ){

	// Default settings
	var settings = {
		'contentListId'		: 'rolloverTabs-content-list',
		'selected'			: 0,
		'rolloverImages'	: false,
		'off'				: '_off',
		'on'				: '_on'
	};
	// Merge passed options with defaults
	if(options){$.extend(settings, options);}
	
	
	// ------------------- VARIABLES-------------------
	currentImage = null; // HTMLImageElement
	currentContent = null; // jQuery Object
	
	
	// ------------------- FUNCTIONS -------------------
	onTabMouseOver = function() { // 'this' is a 'li' element
		if(settings.rolloverImages) { $(this).find('img:first').each(function(){selectImage(this);}); } // image rollover
		showContent($(this).index()); // show corresponding content 'li' element
	};
	
	// select a new rollover image to be active (hover state)
	selectImage = function(newImage) {
		if(currentImage){ currentImage.src = currentImage.src.replace(settings.on, settings.off); } // roll off current image
		currentImage = newImage; // set next current image
		currentImage.src = currentImage.src.replace(settings.off, settings.on); // roll on current image
	};
	
	// show content from a 'li' element in [#contentListId]
	showContent = function(index) {
		if(currentContent){ currentContent.hide(); } // hide previous content
		currentContent = $('#'+settings.contentListId).children('li').eq(index); // set new current content
		currentContent.show(); // show current content
	};

	
	// ------------------- EXECUTE -------------------
	// Make sure to return 'this' in order to allow chaining with other jquery functions
	return this.each(function(){

		var $this = $(this); // Get 'this' as a jQuery object
		
		// initially hide all content
		$('#'+settings.contentListId).children('li').hide();
		
		// set initial rollover image
		if(settings.rolloverImages) { $this.children('li').eq(settings.selected).find('img:first').each(function(){selectImage(this);}); }
		// set initial displayed content
		showContent(settings.selected);
		
		// when a 'li' element is rolled over
		$this.children('li').mouseover(onTabMouseOver);
	});

};
})( jQuery )
