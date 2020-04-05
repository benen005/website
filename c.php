<?php 
include_once('action.php');
$cid = inject_check(g('cid'));
$name = getCategory($cid);


    $id = inject_check(g('id'));
    if($id){
        $sql = "update log set read_num = read_num + 1 where id = " . $id;
        sqli($sql);
        
        $sql = "select * from log where id = " . $id;
        $c = sql($sql);
        //print_r($c);
		$cid = $c[0]['cid'];
		//$webname = $c[0]["title"];
		//$webname = $c[0]["title"] . " - " . $name . " - " . $webname;  
		$keywords = keywords($c[0]['tags']) != "" ? keywords($c[0]['tags']) : $webname;
		
		$sql_prev = "select * from log where id < $id order by id desc limit 0, 1";
		$c_prev = sql($sql_prev);
		$prev = $c_prev[0]['id'];
		
		$sql_next = "select * from log where id > $id order by id limit 0, 1";
		$c_next = sql($sql_next);
		$next = $c_next[0]['id'];
		//print_r($c_prev);print_r($c_next);
		//echo $prev,$next;exit;
    }
	else{
		
$page=isset($_GET['page'])?intval($_GET['page']):1;
$num = 12;
$fy_sql = "select * from log where cid = $cid ";
$fy = fy($page, $num, $fy_sql, 'c.php?cid='.$cid); 
$offset = $fy['offset'];
$show_page = $fy['showpage'];
		
		$sql = $fy_sql . " order by id desc limit $offset,$num";
		$c = sql($sql);
		
		//$sql = "select * from log where cid = $cid order by id desc limit 0,1";
		//$c = sql($sql);
		//$id = $c[0]['id'];
		$this_webname =  $name . " - " . $webname;  
		$keywords = $webname;
	}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo $webname; ?>" />
<title><?php echo $webname; ?></title>
<link rel="stylesheet" href="style/css.css?v=1.1" type="text/css" media="all" />
<link rel="stylesheet" href="ueditor/third-party/SyntaxHighlighter/shCoreDefault.css" type="text/css" media="all" />
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.pjax.js" type="text/javascript"></script>
<script src="js/js.js" type="text/javascript"></script>
<script src="ueditor/third-party/SyntaxHighlighter/shCore.js" type="text/javascript"></script>
<script type="text/javascript">
	SyntaxHighlighter.all();
</script>
</head>
<body>
<?php include_once('head.php'); ?>
<div class="page">
	<div id="main">
		<h1><?php echo $webname; ?> <font color="red" size="4"></font></h1>
		<hr />
		
		
		<div class="left">
            <?php include_once('left.php'); ?>
        </div>
		
		<?php if($id){ ?>
		<div class="right">
            

            <div class="right_box">
                <div class="right_title" align="center"><?php echo $c[0]['title']; ?></div>
                
                <div class="right_author" align="center">作者: <?php echo $c[0]['user_id'] == 1 ? "benen005" : "other"; ?> | 发布时间: <?php echo $c[0]['pubtime']; ?> | 点击量: <?php echo $c[0]['read_num']; ?></div>
				<div class="right_tag">标签: <?php echo keywords_a($c[0]['tags']); ?></div>
				<!-- 一键分享 -->
				
				<!-- 一键分享 end -->
                <hr />
                <div class="right_content"><?php echo $c[0]['content']; ?>
				<!-- 赏分享 -->
				
				<!-- 赏分享 end -->
				</div>
                
            </div>
			<?php include_once('sogou_ad.php'); ?>
			<?php include_once('comment.php'); ?>
        </div>
		<!-- 翻页 -->
<div id="post-nav">
	<?php if($prev){ ?><a class="prev" href="c.php?id=<?php echo $prev; ?>"></a><?php } ?>
	<?php if($next){ ?><a class="next" href="c.php?id=<?php echo $next; ?>"></a><?php } ?>
</div>
		<!-- 翻页 -->
		<?php }else{ ?>
		<div class="right">
            
<?php if($c){
		foreach($c as $k => $v){
			$src = get_content_img($v['content'], $v['cid']);

?>
            <div class="index_right_box">
                
                <div class="index_right_box_word">
					<div class="index_right_title"><a href="c.php?cid=<?php echo $v['cid']; ?>" class="title"><?php echo getCategory($v['cid']); ?></a> - <a href="c.php?cid=<?php echo $v['cid']; ?>&id=<?php echo $v['id']; ?>" class="no_under"><?php echo $v['title']; ?> <?php if(date('Y-m-d') == date('Y-m-d', strtotime($v["pubtime"]))) echo '<img src="images/new.gif" />'; ?></a></div>
					<div class="index_right_content"><?php echo t(strip_tags($v['content']), 100); ?></div>
					<div class="index_right_tag">
						<div class="index_right_tag_date"><?php echo $v['pubtime']; ?></div>
						<div class="index_right_tag_read"><a href="c.php?cid=<?php echo $v['cid']; ?>&id=<?php echo $v['id']; ?>" class="title">阅读全文</a> | 浏览: <?php echo $v['read_num']; ?> | 评论: <a href="c.php?cid=<?php echo $v['cid']; ?>&id=<?php echo $v['id']; ?>#comment" class="title"><?php echo $v['comment_num']; ?></a> </div>
					</div>
				</div>
				
				<div class="index_right_box_img"><a href="c.php?cid=<?php echo $v['cid']; ?>&id=<?php echo $v['id']; ?>"><img class="img_f" src="<?php echo $src; ?>" width="200" height="180" /></a></div>
				
            </div>
<?php }} ?>

		
		<?php include_once('sogou_ad.php'); ?>
		
		<!-- 分页代码 -->
		<?php include_once('fy.php'); ?>
		<!-- 分页代码 -->
        </div>
		<?php } ?>
	</div>
<?php include_once('foot.php'); ?>
</div>
</body></html>
