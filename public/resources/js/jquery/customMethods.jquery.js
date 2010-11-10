function showLoadingImage() {
	$j('#loading-image').fadeIn(400);
}
function hideLoadingImage() {
	$j('#loading-image').fadeOut(400);
}

function showLoadingAndSubmit(form) {
	showLoadingImage();
	form.submit();
}

function flashMessage(message) {
	$j('#js-flash-message').html(message).delay(700).fadeIn(400).delay(2500).fadeOut(400);
}
