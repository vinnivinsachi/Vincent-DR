$.ajaxSetup({
	beforeSend: beforeSend,
	complete: complete,
});

function beforeSend(request) {
	$j('#loading-image').fadeIn(200);
}

function complete(request, status) {
	$j('#loading-image').fadeOut(200);
}
