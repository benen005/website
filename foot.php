<div id="block_link">
	
<?php 

$link = getLinkList();
if($link){
	$i = 0;
	
	foreach($link as $k => $v){
		$link_div = "link_div";
		$i++;
		if($i < 7){
			$link_div = "link_div link_div2";
		}
		if(substr($v->addr, 0, 4) == "http")
			echo "<div class='$link_div'><a href='" . $v->addr . "' target='_blank'>" . $v->name . "</a></div>";
		else
			echo "<div class='$link_div'><a href='http://" . $v->addr . "' target='_blank'>" . $v->name . "</a></div>";
	}
}
?>
	
</div>

<div id="block_link_toggle">
	<span id="span_toggle"></span>
</div>
<div id="block_footer">
	<div class="foot"><span>Copyright © 2020-2020 design by benen005</span></div>
</div>

<div id="block_time"><span id="run_time"></span></div>



<div class="side-bar">  
    <a href="#" class="icon-qq" id="backtotop">totop</a>  
    <a href="#" class="icon-chat">微信<div class="chat-tips"><i></i> 
    <img style="width:138px;height:138px;" src="images/logo2.jpg" alt=""></div></a>  
    <a href="#"  class="icon-blog">微博</a>  
    <a href="#" class="icon-mail" id="backtobottom">tobottom</a>  
</div> 

<!--
<div style="display:none;"><script src='http://media.ttxknb.com/getcode.jsp?uid=16841'></script></div>
-->


<script>
$(document).pjax('a[target!=_blank]', '.right', {fragment:'.right', timeout:8000});
$(document).on('pjax:send', function() { //pjax链接点击后显示加载动画；
	
	$(".progress").fadeIn();
	$(".right").empty();
    $(".pjax_loading").css("display", "block");
	
});
$(document).on('pjax:complete', function() { //pjax链接加载完成后隐藏加载动画；
	$(".progress").fadeOut();
    $(".pjax_loading").css("display", "none");
    pajx_loadDuodsuo();
	SyntaxHighlighter.all(); //高亮代码
});
function pajx_loadDuodsuo(){
    var dus=$(".right_comment");
    if($(dus).length==1){
		$(function(){
			$('.reply_comment').click(function(){
				$(".comment_reply_box").html("回复：" + $(this).parents().find(".comment_name").html());
				$(".comment_reply_box").css("display", "block");
				$(".cancel_reply").css("display", "block");
				//alert($(this).parents().find(".comment_name").html());
				
				$("#is_reply_to").val($(this).parents().find(".comment_name").attr("m"));
				//alert($("#is_reply_to").val());
				
				$("#txaArticle").focus().val("@" + $(this).parents().find(".comment_name").attr("n") + " ");
				//$("#txaArticle").focus().val();
			});
			
			$('.reply_cancel').click(function(){
				$(".cancel_reply").css("display", "none");
				$(".comment_reply_box").css("display", "none");
				$("#txaArticle").focus().val('');
				$("#is_reply_to").val("0");
			});
		});
    }
}
</script>