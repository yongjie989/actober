/*
* Author: YongJie Huang
* Email : yongjie989@gmail.com
* Date  : 2013-12-10
* DevURL: http://127.0.0.1:8080/actober.php?userid=1
*/

var canvas = new fabric.Canvas('actober_painter');
$("div[class='canvas-container']").css({
	'z-index':'0',
	'left':'260px',
	'top':'10px',
	'border':'1px solid #cccccc',
	'background-color':'#ffffff',
	'box-shadow':' 10px 10px 5px #333333'
});

//set css style need before canvas.setHeight;
canvas.setWidth(500);
canvas.setHeight(600);


fabric.Image.fromURL('tpl/images/t-shirt-front.png', function (oImg) {
	oImg.set('id',1);
	oImg.set('isdelete','N');
	oImg.set('left', 0);
	oImg.set('top', 20);
	oImg.set('selectable',false);
	canvas.add(oImg);
	canvas.renderAll();
});  



canvas.add(new fabric.Circle({ radius: 30, fill: '#f55', top: 100, left: 100 }));
canvas.item(0).set({
borderColor: 'gray',
cornerColor: 'black',
cornerSize: 6,
transparentCorners: true
});

canvas.setActiveObject(canvas.item(0));
canvas.item(0).lockUniScaling = true;
canvas.item(0).hasRotatingPoint=false
canvas.renderAll();


