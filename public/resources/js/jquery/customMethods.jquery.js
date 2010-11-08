function showLoadingImage() {
	$j('#loading-image').show(200);
}

function showLoadingAndSubmit(form) {
	showLoadingImage();
	form.submit();
}
