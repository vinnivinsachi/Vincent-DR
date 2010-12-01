// JavaScript Document

Event.observe(
			  window,
			  'load',
			  function(){
				  
				  var ui=$('albumBackdrop');
				  
				  if($('videoSubmitForm'))
				  {
					  var button=$('videoSubmitForm');
					  button.observe('click',function(){
												  Element.removeClassName(ui,'hidden');
												  document.forms.videoSubmitForm.submit();
													  }
													  );
				  }
			  }
			  );

				  