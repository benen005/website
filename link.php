<?php 
include_once('action.php');
$cid = 22;
$name = getCategory($cid);


    $id = g('id');
    if($id){
        $sql = "update log set read_num = read_num + 1 where id = " . $id;
        sqli($sql);
        
        $sql = "select * from log where id = " . $id;
        $c = sql($sql);
        //print_r($c);
    }
	else{
		$sql = "select * from log where cid = $cid order by id limit 0,1";
		$c = sql($sql);
		$id = $c[0]['id'];
	}
$webname = $webname . "-" . $name . "-" . $c[0]["title"];  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $webname; ?>" />
<meta name="description" content="<?php echo $webname; ?>" />
<title><?php echo $webname; ?></title>
<link rel="stylesheet" href="style/css.css" type="text/css" media="all" />
<script src="jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/js.js" type="text/javascript"></script>
</head>
<body>
<?php include_once('head.php'); ?>
<div class="page">
	<div id="main">
		
		<hr />
		<?php require_once('date.php'); ?>
		
		<div class="left">
            <?php include_once('left.php'); ?>
            
        </div>
		
		
		<div class="right">
            

            <div class="right_box">
                <div class="right_title" align="center"><?php echo $c[0]['title']; ?></div>
                
                <div class="right_author" align="center">作者: <?php echo $c[0]['user_id'] == 1 ? "admin" : "other"; ?> | 发布时间: <?php echo $c[0]['pubtime']; ?> | 点击量: <?php echo $c[0]['read_num']; ?></div>
                <hr />
                <div class="right_content"><?php echo $c[0]['content']; ?></div>
                
            </div>
			<?php include_once('comment.php'); ?>
        </div>
		
	</div>
<?php include_once('foot.php'); ?>
</div>

</body></html>
