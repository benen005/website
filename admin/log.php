<?php 
include_once('action.php');
log_add();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $webname; ?>" />
<meta name="description" content="<?php echo $webname; ?>" />
<title><?php echo $webname; ?></title>
<link rel="stylesheet" href="../style/css.css" type="text/css" media="all" />
<script src="../jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="../js/js.js" type="text/javascript"></script>
</head>
<body>
<?php include_once('head.php'); ?>
<div class="page">
	<div id="main">
		<h1>小ben成长手册 <font color="red" size="4">QQ群：478709617</font></h1>
		<hr />
        
		<div id="text2">
<?php 
	$sql = "select * from log";
	$t = sql($sql);
	if($t){
		foreach($t as $k => $v){
			echo '<a href=log_edit.php?id=' . $v['id'] . '>' . $v['title'] . "</a><br />";
		}
	}
?>
		</div>
		<div id='text3'><span>欢迎光临  </span></div>
		
		<div class="text">
		<span>个人简介</span><?php echo $web; ?> <font color="red" style="font-size:9px;">今天是(<?php echo $date ? $date : date('Ymd'); ?>)</font>
		<div class="content">
<?php 

	$sql = "select * from log where id = 1";
	$t = sql($sql);
	//print_r($t);
	
    $t = $t[0];


?>
            <form id="J_Form" action="" method="post" >
                <input type="hidden" name="user_id" id="user_id" value="1" />
                <input name="title" />
                <textarea class="textarea" name="content"></textarea>
                <input type="submit" />
            </form>
		</div>
	</div>
	
	</div>
</div>
<?php include_once('../foot.php'); ?>
</body></html>
