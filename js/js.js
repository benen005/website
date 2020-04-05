$(document).ready(function(){
    $('#span_toggle').toggle(function(){
        $('#block_link').css('height', '500px');
        $('#span_toggle').css('background', 'url(./images/up1.png)');
        var h = $(document).height()-$(window).height();
        $('html, body').animate({scrollTop:h}, 'slow');
    },function(){
        
        $('#block_link').animate({height:"140px"}, 'slow');
        $(this).css('background', 'url(./images/down1.png)');
    });
    

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
    
    $(function(){
        var img = $("#pai_img");
        var rand_img = img.attr("m").split(",");    
        img.hover(function(){
            $(this).attr("src", rand_img[get_rand(rand_img.length)]).fadeTo(500,0.4);
            }, function(){
            $(this).attr("src", "images/logo.jpg").fadeTo(500,1);
                });
    });
        
        
    $(function(){
        $('.index_right_box').mouseover(function(e) {
            //$(this).siblings().stop().fadeTo(500,0.4);
            $(this).css('border', '1px solid blue'); 
        });
        $('.index_right_box').mouseout(function(e) {
            //$(this).siblings().stop().fadeTo(500,1);
             $(this).css('border', '1px dotted #000'); 
        });
    });
    
    $(".link_div").hover(function(){
        $(this).css("background", "pink");
        $(this).css("border", "1px dotted pink");
        }, function(){
        $(this).css("background", "");
            $(this).css("border", "1px solid #000");
            });
    
    
    /*
     $("#comment_add_btn").click(function(){
         
         $(".right_comment").prepend('<div class="comment_list" id="comment24"><div class="comment_ava"><a href="http://benen005.cn" target="_blank" title=""><img src="http://cn.gravatar.com/avatar/c6d7c0c835b119301a2c3ae6054c49b5?s=45&d=mm&r=g" width="45" height="45" class="rotate " /></a> </div><div class="comment_name"><a href="http://benen005.cn" target="_blank" title="">benen005</a> </div><div class="comment_time">2016-06-05 00:06:04</div><div class="comment_time"><a href="http://benen005.cn" target="_blank" title="">benen005.cn</a> </div><div class="comment_content">test5</div></div>');
         
        
     });
    */

     $(".index_right_box").each(function() {
               var t = $(this).find(".index_right_box_word");
               var m = $(this).find(".index_right_box_img");
         
        var imgWid = 0 ;
        var imgHei = 0 ; //变量初始化
        var big = 1.2;//放大倍数


        var imgWid2 = 0;
        var imgHei2 = 0;//局部变量
        imgWid = $(this).find(".img_f").width();
        imgHei = $(this).find(".img_f").height();
        imgWid2 = imgWid * big;
        imgHei2 = imgHei * big;
    
            
       m.hover(
            function() {
                $(this).find(".img_f").animate({"width":imgWid2,"height":imgHei2,"margin-left":-30,"margin-top":-10});
                //t.hide("fast");
                
                //$(this).hide();
                //$(this).show();
                //m.append(t);
                //t.animate(t.insertAfter(m));
                //m.hide("slow");
                //m.show("fast");
                //m.fadeTo(500,0.4);
                
           },
            function() {
                $(this).find(".img_f").stop().animate({"width":imgWid,"height":imgHei, "margin-left":0,"margin-top":0});
                //m.insertAfter(t);
                //t.show("fast");
                //m.fadeTo(500,1);
                
       });
    });
    
    $(".readerwall-li").each(function() {

               var t = $(this).children().find("strong");
               var m = $(this).children().find("img");
       $(this).hover(
        
            function() {
                t.hide("fast");
                //t.show("fast");
                //$(this).hide();
                //$(this).show();
           },
            function() {
                t.show("fast");
       });
    });
    
    $(".rotate").each(function() {
        var img = $(this);
        //alert(img.attr("m"));
        img.attr("src", img.attr("m"));
    });
    
     $('#backtotop').click(function(){
            $('html, body').animate({scrollTop:0}, 'slow');
        });     
        
     $('#backtobottom').click(function(){
         var h = $(document).height()-$(window).height();
            $('html, body').animate({scrollTop:h}, 'slow');
        }); 
});

function get_time(){
    var d = new Date();
    return d.getTime();
}  

function get_rand(length){
    return Math.floor(Math.random()*length);
}

//$('#li1').mousever(function(){alert(0);});
//$("#li1").hover(function(){
    //alert(0);
    //var t = $(o).children().find("strong");
    //var m = $(o).children().find("img");
    //m.replaceWith(t);
    
    //t.replaceWith("<img src='"+m[0].src+"' />");
    //m.toggle("fast");
   
//},
//function(){}
//);


function currentTime(){
    var d = new Date(),str = '';
     str += d.getFullYear()+'年';
     str  += d.getMonth() + 1+'月';
     str  += d.getDate()+'日';
     str += d.getHours()+'时'; 
     str  += d.getMinutes()+'分'; 
    str+= d.getSeconds()+'秒'; 
    return str;
}
setInterval(function(){$('#current_time').html(currentTime())},1000);


function runTime(){
    var d = new Date(),str = '';
    BirthDay=new Date("may 11,2016");
    today=new Date();
    timeold=(today.getTime()-BirthDay.getTime());
    sectimeold=timeold/1000
    secondsold=Math.floor(sectimeold);
    msPerDay=24*60*60*1000
    e_daysold=timeold/msPerDay
    daysold=Math.floor(e_daysold);
    str = "网站已经运行: "+daysold+"天";
    str += d.getHours()+'时'; 
    str  += d.getMinutes()+'分'; 
    str+= d.getSeconds()+'秒'; 
    return str;
}
setInterval(function(){$('#run_time').html(runTime())},1000);

