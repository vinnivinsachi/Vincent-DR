function showLoadingImage() {
	$j('#loading-image').fadeIn(400);
}
function hideLoadingImage() {
	$j('#loading-image').fadeOut(400);
}

function showLoadingAndSubmit(form, ajaxSubmit) {
	submitBtn = $j(form).find('input:submit');
	submitBtn.button('disable').attr('value', submitBtn.attr('loading-text'));
	//showLoadingImage();
	// IF ajax submit
		if(ajaxSubmit) $j(form).ajaxSubmit(ajaxComplete);
	// ELSE (a regular submit)
		else form.submit();
}

function flashMessage(message) {
	$j('#js-flash-message').html(message).delay(700).fadeIn(400).delay(2500).fadeOut(400);
}
