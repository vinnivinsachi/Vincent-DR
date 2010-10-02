// JavaScript Document

///***********************************************************MAIN ALBUM AJAX****************************************/
var ui={};


/*
Ajax.Responders.register(
						 
						 {
							 onComplete:function(request, transport,json){
								 showBreadcrumbs();
								 showFolders(json.folders);
								 if(json.count!=null){
									 if(json.count>0)
									 {
										 Element.show(ui.images);
									 }
									 else
									 {
										 Element.hide(ui.images);
									 }
								 }
							 }
						 }
						 );*/

Event.observe(
	window,
	'load',
	function(){
	ui.title=$('albumTitle');
	ui.closeup=$('albumCloseup');
	ui.closeupImg=$('albumCloseup_img');
	ui.folders=$('albumFolders');
	ui.images=$('albumImages');
	ui.backdrop=$('albumBackdrop');
	
	var content=$('content');
	Element.setStyle(content, {background:'#333'});
	Element.hide(ui.closeup, ui.closeupImg, ui.images);
	load('');
	}
);


function load(path){

	new Ajax.Request( //make sure your requset is capital letters
					  "/media/imagerequestjason?path="+path,
					  
					  {
						method: "get",
						onLoading:albumLoading,
						onSuccess:parseAjaxResponse
					  } 
					  
					  
					  );
}

var data={};

function albumLoading()
{
	Element.removeClassName(ui.backdrop,'hidden');
	//alert('here at on loading');	
}

function parseAjaxResponse(transport){
	//alert('hi here at getting stuff form transport');
 	var response = transport.responseXML;
	var docRoot=response.getElementsByTagName('gallery')[0];
	data.path=docRoot.attributes.getNamedItem("path").value;
	//alert("data path"+data.path);
	data.pre = docRoot.attributes.getNamedItem("pre").value;
	//alert("data pre"+data.pre);
	data.folders = parseChildNodes(docRoot, 'folders', 'folder');
	data.images=parseChildNodes(docRoot,'images','image');
	//alert('here at before showDir');
	showDir();	
}

function parseChildNodes(node, parentTag, childTag)
{
	var results=[];
	try{
		var children = $A(
						  node.getElementsByTagName(parentTag)[0].getElementsByTagName(childTag)
						  );
		results=children.collect(
								 function (value, index){
									 return value.firstChild.data;
								 }
								 )
	}
	catch(e){
	}
	
	//alert('at parseChildnode result');
	return results;
	
}

function showDir(){
	Element.addClassName(ui.backdrop,"hidden");
	showBreadcrumbs();
	showFolders();
	showThumbnails();
	initDragDrop();

}

function showBreadcrumbs(){
	//alert('here at show breadcrumbs');
 	var crumbHTML = "<img src='/data/images/folderIcon.png' class='folderIcon'><span onclick='load(\"\")'>Home</span>";
	var crumbs=data.path.split('/');
	for (var i=0; i<crumbs.length; i++)
	{
		//alert('here at in the breadcrumbs forloop');
		var crumb=crumbs[i];
		if(crumb.length>0)
		{
			var path=subpath(data.path,'/',i);
			crumbHTML+= "<img src='/data/images/folderIcon.png' class='folderIcon' onclick='load(\""+path+"/\")'> <span onclick='load(\""+path+"/\")'>"+crumb+"</span>";
		}
	}
	//alert('here at displaying breadcrumbs');
	
	new Effect.Appear(ui.title, {duration:1, from:0.0, to:1.0});
	ui.title.innerHTML=crumbHTML;
}

function subpath(str, delim, ix){
	var all=str.split(delim);
	var some=all.findAll(
						 function(v,i){
							 return (i<=ix);
						 }
						 );
	return some.join(delim);
}

function showFolders(){
	//alert('here at displaying folders option');
	if(data.folders.length==0)
	{
		//alert('show folder hide folder elements');
		Element.hide(ui.folders);
	}
	else
	{
		//alert('show folder at good');
		var links=data.folders.collect(
									   function(value,index){
										   var path=data.path+value;
										   return "<img src='/data/images/folderIcon.png' class='folderIcon' onclick='load(\""+path+"/\")'><span onclick='load(\""+path+"/\")'>"+value+"</span><br/>";
										   } 
									   );
		//alert("before element show folder");

		new Effect.Appear(ui.folders, {duration:1, from:0.0, to:1.0});
		//alert("here at link join: "+links.join(""));
		ui.folders.innerHTML=links.join("");
	}
}

var imageNavigator={};


function showThumbnails(){
	Element.hide(ui.closeup);
	if(data.images.length==0)
	{
		Element.hide(ui.images);
	}
	else
	{
		data.images.each(
						 function(value, index)
						 {	
						 	  imageNavigator[index]={};
							  imageNavigator[index].value=value;
							  imageNavigator[index].thumbUrl="/data/media/"+data.path+value+".thumb.jpg";
							  imageNavigator[index].closeImage="/data/media/"+data.path+value+".jpg";
						 }
						 );
		
		//alert('here at data.images each');
		//alert('number of data.images'+data.images.length
		
		var links=[];
		
		
		
		for(i=0;i<data.images.length; i++)
		{
			if(i==0)
			{
			//alert('here at links joins');
			links[i]="<div class='albumImage_title'>"
										  +"<img onclick='showCloseup(\""
										  +imageNavigator[i].closeImage
										  +"\",\""
										  +""
										  +"\","
										  +(i+1)
										  +")' src='"
										  + imageNavigator[i].thumbUrl
										  +"'/>"
										  +"<br/>"
										  + imageNavigator[i].value
										  +"</div>";
			}
			else if(i==data.images.length-1)
			{
				links[i]="<div class='albumImage_title'>"
										  +"<img onclick='showCloseup(\""
										  +imageNavigator[i].closeImage
										  +"\","
										  +(i-1)
										  +",\""
										  +""
										  +"\")' src='"
										  + imageNavigator[i].thumbUrl
										  +"'/>"
										  +"<br/>"
										  + imageNavigator[i].value
										  +"</div>";
				
				
			}
			else{
				links[i]="<div class='albumImage_title'>"
										  +"<img onclick='showCloseup(\""
										  +imageNavigator[i].closeImage
										  +"\","
										  +(i-1)
										  +","
										  +(i+1)
										  +")' src='"
										  + imageNavigator[i].thumbUrl
										  +"'/>"
										  +"<br/>"
										  + imageNavigator[i].value
										  +"</div>";
			
			}
			//alert('the link information is: '+links[i]);
		}
		
		/*var links=data.images.collect(
									  function(value, index){
										  var imgUrl="/data/media/"+data.path+value+".thumb.jpg";
										  var closeImage="/data/media/"+data.path+value+".jpg";
										  imageNavigator[index]=closeImage;
										  return "<div class='albumImage_title'>"
										  +"<img onclick='showCloseup(\""
										  +closeImage
										  +"\")' src='"
										  +imgUrl
										  +"'/>"
										  +"<br/>"
										  +value
										  +"</div>";
									  }
									  );
		*/
		
		

		
		
	
	
		//Element.show(ui.images);
		new Effect.Appear(ui.images, {duration:1, from:0.0, to:1.0});
		ui.images.innerHTML=links.join("");
	}
}


	
function showCloseup(imgSrc, prevSrc, afterSrc){
	
	ui.closeupImg.src=imgSrc; 

	if(prevSrc=="")
	{
		$('nextImageButton').innerHTML="<img onclick='showCloseup(\""
										  +imageNavigator[afterSrc].closeImage
										  +"\","
										  +(afterSrc-1)
										  +","
										  +(afterSrc+1)
										  +")' src='/data/images/nextImageButton.png'/>";
		
	}
	else if(afterSrc=="")
	{
		
		$('previousImageButton').innerHTML="<img onclick='showCloseup(\""
										  +imageNavigator[prevSrc].closeImage
										  +"\","
										  +(prevSrc-1)
										  +","
										  +(prevSrc+1)
										  +")' src='/data/images/previousImageButton.png'/>";
		
	}
	else if(prevSrc==0)
	{
		$('nextImageButton').innerHTML="<img onclick='showCloseup(\""
										  +imageNavigator[afterSrc].closeImage
										  +"\","
										  +(afterSrc-1)
										  +","
										  +(afterSrc+1)
										  +")' src='/data/images/nextImageButton.png'/>";
		
		$('previousImageButton').innerHTML="<img onclick='showCloseup(\"" 
										  +imageNavigator[prevSrc].closeImage
										  +"\",\""
										  +""
										  +"\","
										  +(prevSrc+1)
										  +")' src='/data/images/previousImageButton.png'/>";
	}
	else if(afterSrc==data.images.length-1)
	{
		$('nextImageButton').innerHTML="<img onclick='showCloseup(\""
										  +imageNavigator[afterSrc].closeImage
										   +"\","
										  +(afterSrc-1)
										  +",\""
										  +""
										  +"\")' src='/data/images/nextImageButton.png'/>";
		
		$('previousImageButton').innerHTML="<img onclick='showCloseup(\""
										  +imageNavigator[prevSrc].closeImage
										  +"\","
										  +(prevSrc-1)
										  +","
										  +(prevSrc+1)
										  +")' src='/data/images/previousImageButton.png'/>";
		
	}
	else
	{
		$('nextImageButton').innerHTML="<img onclick='showCloseup(\""
										  +imageNavigator[afterSrc].closeImage
										+"\","
										  +(afterSrc-1)
										  +","
										  +(afterSrc+1)
										  +")' src='/data/images/nextImageButton.png'/>";
		
		$('previousImageButton').innerHTML="<img onclick='showCloseup(\""
										  +imageNavigator[prevSrc].closeImage
										  +"\","
										  +(prevSrc-1)
										  +","
										  +(prevSrc+1)
										  +")' src='/data/images/previousImageButton.png'/>"; 
		
		
		
	}
	

	showCloseupImage(imgSrc);
}


function hideCloseupImage(imgSrc)
{
		new Effect.Fade(ui.closeup, {duration:1, from:1.0, to:0.0, afterFinish: showCloseupImage(imgSrc)});
}

function showCloseupImage(imgSrc){
		new Effect.Appear(ui.closeup, {duration:1, from:0.0, to:1.0});
}
	
	












