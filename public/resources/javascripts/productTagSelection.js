// JavaScript Document
//product tag selection

var productTagAnchor = $$('.productTagAnchor');
var productBackgroundImageDiv = $('productUploadTagImage');

productTagAnchor.each(function(value){
							   
							   value.observe('mouseover', function(){
															   $j('#productUploadTagImage').removeClass();
															   productBackgroundImageDiv.addClassName(value.id);
															   //alert('here')
															   });
							   //alert(value);
							   //value.observe('click', alert('here'));
							   });