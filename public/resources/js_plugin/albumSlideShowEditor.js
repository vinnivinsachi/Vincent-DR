// JavaScript Document

//*********************************************************MAIN SLIDE EDITOR******************************************/


/*var SlideShow={
	
	create:function(el, name, htmlContent){
		this.body=$(el);
		this.name=name;
		//this.initUI(htmlContent);
		Ajax.Responders.register(
								 {
									 onComplete:function(request,transport,json)
									 {
										 if(json && 'folder'==json.action){
											 this.initDragDrop();
										 }
									 }.bind(this)
								 }
								 );
	}
	
}*/
	
	

function initDragDrop()
{
	//alert('here at initi drag and drop');
	Sortable.create(
					'albumImages',
					{
						tag: "div",
						containment: ['albumSlides'],
						constraint:false
					}
					);
	 
	Sortable.create(
					'albumSlides',
					{
						tag:"div",
					containment:['albumTrash'],
					constraint:false
					}
					);
	Droppables.add(
				   'albumSlides',
				   {
					  // onDrop: function(tile,target){alert('here at dropped');}
					   hoverclass: 'hoverSlides',
						   
					   onDrop:function(tile,target){ //tile is the draggable element, and target is the drop target
					   	if(tile.className=="Slide"){ return;}
						createSlide(tile,target);
					   }
				   }
				   );
	
	
	Droppables.add(
				  'albumTrash',
				  {
					  hoverclass: 'hoverSlides',
					  onDrop:function(tile, target){
						  if(tile.className=="Slide"){
							  tile.remove();
							  if(this.trashEffect)
							  {
								  this.trashEffect.cancel();
							  }
							  this.trashEffect=new Effect.Pulsate(target);
						  }
					  }
				  }
				  );
	
}
						   
function createSlide(tile, target){
	
	
	
	
	//alert('here at creating slides for');
	
	var newSlide = Builder.node("div", {className: "Slide"});
	newSlide.innerHTML=tile.innerHTML;
	target.appendChild(newSlide);
	var img = newSlide.getElementsByTagName("img")[0];
	img.onclick=null;
	
	Sortable.create(
					'albumSlides',
					{
						tag:"div",
					containment:['albumSlides','albumTrash'],
					constraint:false
					}
					);
	
}

	



/*
initUI:function(htmlContent)
{

	this.body.innerHTML='';
	Element.removeClassName(this.body, "hidden");
	Element.removeClassName('trash', "hidden");
	//Element.removeClassName('SlideshowName', "hidden");
	Element.hide('albumCloseup');
	Element.show('albumImages');
}
*/