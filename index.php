<?php 
include_once('action.php');
$cid = 0;
$name = "首页";
$date_id = g('date');


$page=isset($_GET['page'])?intval($_GET['page']):1;
$num = 12;
	
    if($date_id){  

		$fy_sql = "select * from log where date_format(pubtime,'%Y-%m-%d') = '" . $date_id . "'";
		$fy = fy($page, $num, $fy_sql); 
		$offset = $fy['offset'];
		$show_page = $fy['showpage'];
		
		
        $sql = $fy_sql . " order by id desc limit $offset,$num";
        $c = sql($sql);
        //print_r($c);exit;
    }
	else{

		$fy_sql = "select * from log where cid <> 21 and cid <> 22 and cid <> 27 and cid <> 23 ";
		$fy = fy($page, $num, $fy_sql); 
		$offset = $fy['offset'];
		$show_page = $fy['showpage'];
		
		
		$sql = $fy_sql . " order by id desc limit $offset,$num";
		$c = sql($sql);
		//$id = $c[0]['id'];
	}
$this_webname = $webname . " - " . $name;  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $webdescription; ?>" />
<meta name="keywords" content="<?php echo $webkeywords; ?>" />
<title><?php echo $webname; ?></title>
<link rel="stylesheet" href="style/css.css?v=1.2" type="text/css" media="all" />
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
		<h1><?php echo $webname;?> <font color="red" size="4"></font></h1>
		<hr />
		
		
		<div class="left">
            <?php include_once('left.php'); ?>

        </div>
		
		
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
	</div>
<?php include_once('foot.php'); ?>
</div>
</body></html>
<?php include_once('cache.php'); ?>
