/**
 * Theme Name: mak
 * Version: 4
 * File Name: jquery.js
 */

jQuery(document).ready(function() {
//鼠标经过显示区域(tips)效果
var tip = $(this);//添加本行代码去除IE下提示tip未定义
$(".image-pre").hover(function(a){//鼠标经过区域
	tip = $(this).next().next().next().next();//鼠标经过显示区域
	tip.css("top", (a.pageY+5) + "px").css("left", (a.pageX+5) + "px").fadeIn("slow"); //调用jquery方法显示tips
	//tip.next().css("top", (a.pageY+20) + "px").css("right", (300) + "px").fadeIn("slow");
	}, function() {
	tip.hide();
	//tip.next().hide(); //调用jquery方法隐藏tips
	}).mousemove(function(e) {
	});
});

/* @reply js by zwwooooo */
jQuery(document).ready(function($){	//Begin jQuery
	$('.reply').click(function() {
	var atid = '"#' + $(this).parent().parent().parent().attr("id") + '"';
	var atname = $(this).parent().prev().children('span').children('a').text();
	$("#comment").attr("value","<a href=" + atid + ">@" + atname + "</a>").focus();
});
	$('#cancel-comment-reply a').click(function() {	//点击取消回复评论清空评论框的内容
	$("#comment").attr("value",'');
});
})	//End jQuery
 
jQuery(document).ready(function(){ 
	$('#tab-title').children('span').children('em').click(function(){
		$('#tab-title').find('.selected').removeClass('selected');
		$(this).addClass('selected');
		var anm=$(this).attr('data-value');
		$('#tab-content').animate({left:anm},{queue:false,duration:500});  
	});
	var b,
	a = function(){
		if ($('.selected').next().is('em')) {
			$('.selected').next().trigger('click'); 
		} else {
			$('#tab-title span em:first').trigger('click');
		}
		b = setTimeout(a, 3500); 
	};
	$('#widget_tab').hover(function(){ //鼠标移进的事件
		clearTimeout(b);
	},
	function(){ //鼠标移开事件
		b = setTimeout(a, 3500);
	});
	b = setTimeout(a, 3500);
});

jQuery(document).ready(function(){ 
	$('#mottowid span').click(function(){
		$('#mottowid span:visible').fadeOut(500,function(){
			if ($(this).next().is('span')) {
				$(this).next().fadeIn(500);
			} else {
				$('#mottowid span:first').fadeIn(500);
			}
		});
	});
	var b,
	a = function(){
		$('#mottowid span').trigger('click'); 
		b = setTimeout(a, 3500); 

	};
	$('#mottowid').hover(function(){
		clearTimeout(b);
	},
	function(){
		b = setTimeout(a, 3500);
	});
	b = setTimeout(a, 3500);	
});

function grin(tag) { // 表情
  tag = ' ' + tag + ' '; myField = document.getElementById('comment');
  document.selection ? (myField.focus(), sel = document.selection.createRange(), sel.text = tag, myField.focus()) : insertTag(tag);
}

function insertTag(tag) { // 插入表情
  myField = document.getElementById('comment');
  myField.selectionStart || myField.selectionStart == '0' ? (
   startPos = myField.selectionStart,
   endPos = myField.selectionEnd,
   cursorPos = startPos,
   myField.value = myField.value.substring(0, startPos)
                 + tag
                 + myField.value.substring(endPos, myField.value.length),
   cursorPos += tag.length,
   myField.focus(),
   myField.selectionStart = cursorPos,
   myField.selectionEnd = cursorPos
  ) : (
   myField.value += tag,
   myField.focus()
  );
}
