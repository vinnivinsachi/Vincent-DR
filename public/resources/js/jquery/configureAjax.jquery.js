$.ajaxSetup({
	beforeSend: beforeSend,
	complete: complete,
});

function beforeSend(request) {
	showLoadingImage();
}

function complete(request, status) {
	hideLoadingImage();
}
