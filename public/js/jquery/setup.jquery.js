// ----------------------------------------- CONFIGURE AJAX -------------------------------------------
	jQuery.ajaxSetup({
		beforeSend:	ajaxBeforeSend,
		success:	ajaxSuccess,
		complete:	ajaxComplete,
	});

	function ajaxBeforeSend(request) {
		showLoadingImage();
	}

	function ajaxSuccess(data, textStatus, request) {
		eval(data.scripts);
	}

	function ajaxComplete(request, status) {
		//alert(request.responseText);
		hideLoadingImage();
	}
	

// ----------------------------------------- ROLLOVER IMAGES -------------------------------------------
	// set off and on state strings
		var off = '_off';
		var on = '_on';
	
	// preload rollover images
		$j('img.rollover').preload({
			find:		off,
			replace:	on
		});
		
	// make images rollover on mouse over
		$j('img.rollover').rolloverImage({
			off:	off,
			on:		on
		});


// ----------------------------------------- LOADING IMAGES -------------------------------------------
	$j('a.loading-image-link', 'input:submit').click(function(){showLoadingImage();});


// ----------------------------------------- APPLY JQUERY UI -------------------------------------------
	// apply button ui to regular buttons and form submit buttons
		$j('button, input:submit').button();
		
		
// ----------------------------------------- SELECT FIRST FORM ELEMENT -------------------------------------------
		$j('input:visible:enabled:first').focus();
