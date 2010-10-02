// JavaScript DocumentzxcDockAry=new Array();

function zxcInit() {
document.getElementById('Move').onmousedown=function(event) { zxcMseDown(event,this);}
zxcobjs=document.getElementsByTagName('BODY')[0].getElementsByTagName('*');
for (zxc0=0;zxc0<zxcobjs.length;zxc0++){
if (zxcobjs[zxc0].className=='Dock'){
zxcDockAry[zxcDockAry.length]=zxcobjs[zxc0];
}
}
}

function zxcMseDown(event,obj) {
document.onmousemove=function(event){zxcDrag(event);}
document.onmouseup=function(event){zxcMseUp(event);}
zxcObj=obj;
zxcMse(event);
zxcDragX=zxcMseX-zxcObj.offsetLeft;
zxcDragY=zxcMseY-zxcObj.offsetTop;
}

function zxcMseUp(event){
document.onmousemove=null; zxcDragX=-1; zxcDragY=-1;
for (zxc0=0;zxc0<zxcDockAry.length;zxc0++){
if (zxcPos(zxcObj)[0]>zxcPos(zxcDockAry[zxc0])[0]&&zxcPos(zxcObj)[0]+zxcObj.offsetWidth<zxcPos(zxcDockAry[zxc0])[0]+zxcDockAry[zxc0].offsetWidth&&zxcPos(zxcObj)[1]>zxcPos(zxcDockAry[zxc0])[1]&&zxcPos(zxcObj)[1]+zxcObj.offsetHeight<zxcPos(zxcDockAry[zxc0])[1]+zxcDockAry[zxc0].offsetHeight){
zxcObj.style.left=zxcPos(zxcDockAry[zxc0])[0]+'px';
zxcObj.style.top=zxcPos(zxcDockAry[zxc0])[1]+'px';
alert('Docked');
}
}
}

function zxcDrag(event){
zxcMse(event);
zxcObj.style.left=(zxcMseX-zxcDragX)+'px';
zxcObj.style.top=(zxcMseY-zxcDragY)+'px';
}

function zxcMse(event){
if(!event) var event=window.event;
if (document.all){ zxcMseX=event.clientX; zxcMseY=event.clientY; }
else {zxcMseX=event.pageX; zxcMseY=event.pageY; }
}

function zxcPos(zxc){
zxcObjLeft = zxc.offsetLeft;
zxcObjTop = zxc.offsetTop;
while(zxc.offsetParent!=null){
zxcObjParent=zxc.offsetParent;
zxcObjLeft+=zxcObjParent.offsetLeft;
zxcObjTop+=zxcObjParent.offsetTop;
zxc=zxcObjParent;
}
return [zxcObjLeft,zxcObjTop];
}