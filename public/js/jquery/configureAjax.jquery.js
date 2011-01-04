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
