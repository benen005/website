<div class="right_comment">
<?php $comment_list = getCommentList($id);
if($comment_list){
    foreach($comment_list as $k => $v){
?>
    <div class="comment_list" id="comment<?php echo $v->id; ?>">
        <div class="comment_ava"><?php echo url_test($v->addr, getGravatar2($v->email)); ?></div>
        <div m="<?php echo $v->id; ?>" n="<?php echo $v->name; ?>" class="comment_name"><?php echo url_test($v->addr, $v->name); ?></div>
        <div class="comment_time"><?php echo $v->pubtime; ?></div>
        
        <div class="comment_time"><?php echo url_test($v->addr); ?></div>
        <div class="comment_reply"><a href="javascript:void(0);" class="reply_comment">回复</a></div>
        <div class="comment_content"><?php echo $v->content; ?></div>
        
    </div>
<?php }} ?>
<?php 
    $user = get_cookie_userinfo();
?>
    <div class="comment_reply_box"></div><div class="cancel_reply"><a href="javascript:void(0);" class="reply_cancel">取消回复</a></div>
    <div class="comment_add">
        <form name="comment" action="?cid=<?php echo $cid; ?>&id=<?php echo $id; ?>&action=comment_add" id="comment" method="post">
            <input name="id" value="<?php echo $id; ?>" type="hidden"/>
            <input id="is_reply_to" name="is_reply_to" value="0" type="hidden" />
            <p><input name="name" value="<?php echo $user['name']; ?>" />名称(*)</p>
            <p><input name="email" value="<?php echo $user['email']; ?>" />邮箱</p>
            <p><input name="addr" value="<?php echo $user['addr']; ?>" />网址</p>
            <p><input name="checktxt" value="" /><?php echo get_checktxt(); ?></p>
            <p><textarea id="txaArticle" name="content"></textarea>(*)
            <p><input type="submit" value="提交" class="submit" id="comment_add_btn" onclick="javascript:{this.disabled=true;document.comment.submit();}" /></p>
        </form>
    </div>
</div>