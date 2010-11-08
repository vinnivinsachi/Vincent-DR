


Event.observe(
			  window,
			  'load',
			  function(){
				  var nextLink=$('nextLink');
				  var previousLink=$('previousLink');
				  var previousValue=$('previousValue');
				  var nextValue=$('nextValue');
				  var counter=$('counter');
				
				  nextLink.observe('click',function(){
												if(nextValue.value!='')
												   {
													   counter.value=nextValue.value;
													   document.forms.videoQueryForm.submit();
												   }
												   }
												   );
				  previousLink.observe('click', function(){
												   if(previousValue.value!='')
												   {
													   counter.value=previousValue.value;
													   document.forms.videoQueryForm.submit();
												   }
												   }
												   );
												   
													 
			  }
			  );
