// JavaScript Document

var ui={};

currentBannerIndex=1;
maxBannerNumber=0;
Event.observe(
			  window,
			  'load',
			  function(){
				  ui.banner=$('banner');
				  ui.bannerImages=$('bannerImageSlide').getElementsByTagName('img');
				  
				  maxBannerNumber=ui.bannerImages.length;
				  
				  hideAllBanners();
				  
			  }
			  );

function hideAllBanners(){
	

	
	//alert('there are '+maxBannerNumber+' banners');	
	
		$A(ui.bannerImages).each(
						 function(value,index){
							 if(index!=0){
							 	Element.hide(value);
							 }
						 }
						 );
		
	Element.removeClassName(ui.banner,'hidden');

	
	new PeriodicalExecuter(bannerSlide, 8);
}


function bannerSlide()
{
	
	
	if(currentBannerIndex< maxBannerNumber)
	{
		$A(ui.bannerImages).each(
								 function(value,index){
									 if(currentBannerIndex!=index)
									 {
										 Element.hide(value);
									 }
								 }
								 );
		
		new Effect.Appear(ui.bannerImages[currentBannerIndex], {duration:2, from:0.0, to:1.0});
		currentBannerIndex++;
	}
	else{
		currentBannerIndex=0;
		$A(ui.bannerImages).each(
								 function(value,index){
									 if(currentBannerIndex!=index)
									 {
										 Element.hide(value);
									 }
								 }
								 );
		new Effect.Appear(ui.bannerImages[currentBannerIndex], {duration:2, from:0.0, to:1.0});

		currentBannerIndex++;
	}
}




	