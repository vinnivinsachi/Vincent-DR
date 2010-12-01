// set off and on state strings
	var off = '_off';
	var on = '_on';

// preload roloover images
	$j('img.rollover').preload({
		find:		off,
		replace:	on
	});
	
// make images rollover on mouse over
	$j('img.rollover').rolloverImage({
		off:	off,
		on:		on
	});
