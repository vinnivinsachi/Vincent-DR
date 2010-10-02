//'this' can be bind to function like function(){...}.bind(this)
//or it can be bind to methods such as with in observe('action', this.Methods.bindAsEventListener(this))
productPreviewImage = Class.create();

productPreviewImage.prototype={
	
	productsTable:null,
	products:null,
	initialize:function(productsTableDiv){
		
		this.productsTable=$(productsTableDiv);
		//alert(this.productsTable.innerHTML);
		//this.productsBoxes = $A(this.productsTable.getElementsByClassName('productBox'));
		this.productsImages = $A(this.productsTable.getElementsByClassName('productIndividualImage'));
		this.productsImages.each(function(value){
										 // alert(value.innerHTML);
     									value.observe('click', 
													  	this.switchImage.bindAsEventListener(this)
													  );
									}.bind(this));
	},
	switchImage:function(e){
		element = e.element();
		element.up('.productBox2').down('.productFirstImage').innerHTML = element.up('.productIndividualImage').down('.imageLargeAddress').innerHTML;
		
		$A(element.up('.productBox2').getElementsByClassName('productIndividualImage')).each(function(value){
																								 value.removeClassName('currentImage');
																								 });
		element.up('.productIndividualImage').addClassName('currentImage');
	}
}