<?php 
	$sql = "select * from phone order by id desc";
	$pai_img = sql($sql);
	$imgs = array();
	#if($pai_img){
	#	foreach($pai_img as $k => $v){
	#		$imgs[] = $qiniu_addr . $v['name'] . "?imageView2/2/w/200/h/200";
	#	}
	#}
	#else{
		for($i=0;$i<16;$i++){
			$imgs[] = "images/category/$i.jpg";
			}
	#	}
	$rand_img = implode(",", $imgs);
?>
			<div id="text2"><a href="#" title="随手拍"><img id="pai_img" m="<?php echo $rand_img; ?>" src="images/logo.jpg" width="200" height="200" /></a></div>
            <div class="left_word">
			<?php if($cid){ ?>
				<li align="center"><b style="color:red;"><?php echo getCategory($cid); ?></b></li>
				
			<?php }else{ ?>
				<li align="center"><b>最新文章</b></li>
			<?php } ?>
<?php
	$conn = new db_conn();
	if($cid)
		$sql = "SELECT * FROM log where cid = $cid order by id desc";
	else
		$sql = "select * from log where cid <> 21 and cid <> 22 and cid <> 1 and cid <> 27 order by id desc limit 0, 10";
	$result = $conn->db_query($sql);
	while($rows = mysqli_fetch_assoc($result)){
?>

    
    <li><a href="c.php?cid=<?php echo $rows['cid']; ?>&id=<?php echo $rows['id']; ?>" title="<?php echo $rows['title']; ?>"><?php echo t($rows['title'], 11); ?> <?php if(date('Y-m-d') == date('Y-m-d', strtotime($rows["pubtime"]))) echo '<img src="images/new.gif" />'; ?></a></li>
    

<?php
	}
    $conn->db_close();
    


?>
            </div>
            <div class="left_word">
				<li align="center"><b>热门文章</b></li>

<?php
	$conn = new db_conn();
	$sql = "select * from log where cid <> 21 and cid <> 22 and cid <> 1 and cid <> 27 order by read_num desc limit 0, 10";
	$result = $conn->db_query($sql);
	while($rows = mysqli_fetch_assoc($result)){
?>

    
    <li><a href="c.php?cid=<?php echo $rows['cid']; ?>&id=<?php echo $rows['id']; ?>" title="<?php echo $rows['title']; ?>"><?php echo t($rows['title'], 11); ?> <?php if($rows['read_num']>100) echo '<img src="images/hot.gif" />'; ?></a></li>
    

<?php
	}
    $conn->db_close();
    


?>
            </div>
            <div class="left_word">
				<li align="center"><b>热评文章</b></li>

<?php
	$conn = new db_conn();
	$sql = "select * from log where cid <> 21 and cid <> 22 and cid <> 1 and cid <> 27  order by comment_num desc limit 0, 10";
	$result = $conn->db_query($sql);
	while($rows = mysqli_fetch_assoc($result)){
?>

    
    <li><a href="c.php?cid=<?php echo $rows['cid']; ?>&id=<?php echo $rows['id']; ?>" title="<?php echo $rows['title']; ?>"><?php echo t($rows['title']); ?></a></li>
    

<?php
	}
    $conn->db_close();
    


?>
            </div>
            <div class="left_word">
				<li align="center"><b>最新评论</b></li>

<?php
	$conn = new db_conn();
	$sql = "select * from log_comment order by id desc limit 0, 10";
	$result = $conn->db_query($sql);
	while($rows = mysqli_fetch_assoc($result)){
?>

    
    <li><?php echo url_test($rows['addr'], getGravatar2($rows['email'], 20, 'mm', 'g', 'ava')); ?><b><?php echo url_test($rows['addr'], $rows['name']); ?></b> <a href="c.php?cid=21&id=<?php echo $rows['log_id']; ?>#comment<?php echo $rows['id']; ?>" title="<?php echo $rows['content']; ?>"><?php echo t($rows['content']); ?></a></li>
    

<?php
	}
    $conn->db_close();
?>
            </div>
			<div class="left_word">
				<li align="center"><b>标签云</b></li>
<?php
	$conn = new db_conn();
	$sql = "select * from tags order by hit desc limit 0,50";
	$result = $conn->db_query($sql);
	while($rows = mysqli_fetch_assoc($result)){
?>
				<li class="tag" title="<?php $hit = $rows['hit']; $hit++; echo "". $hit.""; ?>个话题"><a href="tag.php?tag=<?php echo $rows['tag']; ?>" class="no_under"><?php echo $rows['tag']; ?></a></li>
<?php
	}
    $conn->db_close();
?>
			</div>

            <div class="left_word">
				<li align="center"><b>本站统计</b></li>
				<li>文章总数:<?php echo get_tj('log'); ?>篇</li>
				<li>评论总数:<?php echo get_tj('log_comment'); ?>条</li>
				<li>分类总数:<?php echo get_tj('category'); ?>个</li>
				<li>标签总数:<?php echo get_tj('tags'); ?>个</li>
				<li>友链总数:<?php echo get_tj('link'); ?>个</li>
				<li>建站日期:2020-01-07</li>
				
			</div>

		
<?php include_once('taobao_ad.php'); ?>

