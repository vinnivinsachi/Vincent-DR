productListing = Class.create();

productListing.prototype={
	
	listingDiv:null,
	productTypeArray:null,
	productTypeCurrent:'All',
	productBrandArray:null,
	productBrandCurrent:'All',
	productStatusArray:null,
	productStatusCurrent:'All',
	
	initialize:function(listingDiv){
		
		this.listingDiv = $(listingDiv);
		//alert(this.listingDiv.innerHTML);
		
		this.productTypeArray = $('productTypeJavascript');
		this.productTypeArray.observe('change', this.changeTypeCurrent.bindAsEventListener(this));
		//alert(this.productTypeArray);
		//this.productTypeArray = $A($('productTypeJavascript').getElementsBySelector('option'));
		
			
		this.productBrandArray = $('productBrandJavascript');
		this.productBrandArray.observe('change', this.changeBrandCurrent.bindAsEventListener(this));

		//alert(this.productBrandArray);
		//this.productBrandArray.each(function(value){alert(value.innerHTML);});
		this.productStatusArray = $('productStatusJavascript');
		this.productStatusArray.observe('change', this.changeStatusCurrent.bindAsEventListener(this));
		//this.productStatusArray = $A($('productStatusJavascript').getElementsBySelector('option'));
		//this.productStatusArray.each(function(value){alert(value.innerHTML);});

	},
	changeTypeCurrent:function(e){
		element = e.element();
		this.productTypeCurrent=element[element.selectedIndex].value;
		this.showProductElements(this.productTypeCurrent, this.productBrandCurrent, this.productStatusCurrent);
		//alert(this.productTypeCurrent);
	},
	changeBrandCurrent:function(e){
		element=e.element();
		this.productBrandCurrent=element[element.selectedIndex].value;
		this.showProductElements(this.productTypeCurrent, this.productBrandCurrent, this.productStatusCurrent);
	},
	changeStatusCurrent:function(e){
		element=e.element();
		this.productStatusCurrent=element[element.selectedIndex].value;
		this.showProductElements(this.productTypeCurrent, this.productBrandCurrent, this.productStatusCurrent);
	},

	showProductElements:function(productType, brand, status){
		//this.listingDiv.hide();
		
		if(productType=='All' && brand=='All' && status=='All'){
			//alert('here1');
			$A(this.listingDiv.getElementsByClassName('itemRow')).each(function(value){value.show()});
		}else if(productType=='All' && brand=='All' &&status!='All'){
			//alert('here2');
			$A(this.listingDiv.getElementsByClassName('itemRow')).each(function(value){value.hide()});
			$A(this.listingDiv.getElementsByClassName(status)).each(function(value){value.show()});
		}else if(productType!='All' && brand=='All' &&status=='All'){
			$A(this.listingDiv.getElementsByClassName('itemRow')).each(function(value){value.hide()});
			$A(this.listingDiv.getElementsByClassName(productType)).each(function(value){value.show()});
		}else if(productType=='All' && brand!='All' &&status=='All'){
			$A(this.listingDiv.getElementsByClassName('itemRow')).each(function(value){value.hide()});
			$A(this.listingDiv.getElementsByClassName(brand)).each(function(value){value.show()});
		}else if(productType!='All' && brand!='All' &&status=='All'){
			$A(this.listingDiv.getElementsByClassName('itemRow')).each(function(value){value.hide()});
			$A(this.listingDiv.getElementsByClassName(brand+' '+productType)).each(function(value){value.show()});
		}else if(productType!='All' && brand=='All' &&status!='All'){
			$A(this.listingDiv.getElementsByClassName('itemRow')).each(function(value){value.hide()});
			$A(this.listingDiv.getElementsByClassName(status+' '+productType)).each(function(value){value.show()});
		}else if(productType=='All' && brand!='All' &&status!='All'){
			$A(this.listingDiv.getElementsByClassName('itemRow')).each(function(value){value.hide()});
			$A(this.listingDiv.getElementsByClassName(brand+' '+status)).each(function(value){value.show()});
		}else if(productType!='All' && brand!='All' &&status!='All'){
			$A(this.listingDiv.getElementsByClassName('itemRow')).each(function(value){value.hide()});
			$A(this.listingDiv.getElementsByClassName(brand+' '+productType+' '+status)).each(function(value){value.show()});
		}	
	}
}