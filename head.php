<?php 
$flag = 0;  //是否开启缓存
$web = "<span class='web'>(来自 benen005.cn)</span>";
$userip = ip();


?>

<div id="top-header">
	<div class="loading"><div class="progress"></div></div>
	<div class="top-nav">
		<div id="user-profile">您好, 欢迎访问<?php echo $webname;?>, 现在是<span id="current_time"><?php echo date('Y年m月d日'); ?></span></div>
		<ul class="top-menu">
			<li><a href="reply.php">留言板</a></li>
			
			
			
		</ul>
	</div>
</div>
<div id="block_header">
	<div id="head">
	    
			<li><a href="index.php">首页</a></li>
			<?php 
			$category = getCategoryList(5);
			if($category){
				foreach($category as $k => $v){
			?>
			<li><a href="c.php?cid=<?php echo $v['id']; ?>"><?php echo $v['name']; ?></a></li>
			<?php }} ?>
			
			<?php $category_total = getCategoryTotal();
				  if($category_total['num'] > 5){   ?>
			<li><a href="#">更多...</a>
				<ul>
				<?php $category_more = getCategoryMore(5); 
					  if($category_more){
						foreach($category_more as $k => $v){
					?>
					<li><a href="c.php?cid=<?php echo $v['id']; ?>"><?php echo $v['name']; ?></a></li>
					<?php }} ?>
				</ul>
			</li>
			<?php } ?>
			
		
	</div>
	<div id="head2">
		<div class="head3" onclick="document.getElementById('block_header').style.background='#164E87';document.getElementById('block_footer').style.background='#164E87';"></div>
		<div class="head4" onclick="document.getElementById('block_header').style.background='green';document.getElementById('block_footer').style.background='green';"></div>
		<div class="head5" onclick="document.getElementById('block_header').style.background='yellow';document.getElementById('block_footer').style.background='yellow';"></div>
		<div class="head6" onclick="document.getElementById('block_header').style.background='orange';document.getElementById('block_footer').style.background='orange';"></div>
		<div class="head7" onclick="document.getElementById('block_header').style.background='red';document.getElementById('block_footer').style.background='red';"></div>
	</div>
</div>
<div class="banner">
	<?php get_banner(); ?>
</div>
<div class="pjax_loading"><img src="images/load3.gif" /></div>