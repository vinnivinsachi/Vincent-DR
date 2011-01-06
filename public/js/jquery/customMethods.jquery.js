// show the global loading image
function showLoadingImage() {
	$j('#loading-image').fadeIn(400);
}
// hide the global loading image
function hideLoadingImage() {
	$j('#loading-image').fadeOut(400);
}

// show the global loading image, disable the button, submit the form
function showLoadingAndSubmit(form, ajaxSubmit) {
	submitBtn = $j(form).find('input:submit');
	submitBtn.button('disable').attr('value', submitBtn.attr('loading-text'));
	//showLoadingImage();
	// IF ajax submit
		if(ajaxSubmit) $j(form).ajaxSubmit(ajaxComplete);
	// ELSE (a regular submit)
		else form.submit();
}

// flash a message to the screen
function flashMessage(message) {
	$j('#js-flash-message').html(message).delay(700).fadeIn(400).delay(2500).fadeOut(400);
}
