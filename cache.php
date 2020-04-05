<script>
$(document).ready(function(){
    var cache_flag = <?php echo $_GET['close_cache'] == 1 ? 0 : 1; ?>;  //默认开启缓存
    
    if(cache_flag){
        $.ajax({
            type:'get',
            url:'1.php',
            data:'url=<?php echo urlencode($cache_web); ?>'+'&time='+get_time(),
            dataType:'text',
            success:function(msg){
             if(msg==1)
                $('#result').html('<font color=red>成功</font>');
             else
                $('#result').html('<font color=red></font>');
            },
            error:function(){
                $('#result').html('<font color=red>失败</font>');
            }
        })  
    }
});
</script>