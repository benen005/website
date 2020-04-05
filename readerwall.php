<?php 
include_once('action.php');
$cid = 0;
$name = "首页";


    $id = g('id');
    if($id){
        $sql = "update log set read_num = read_num + 1 where id = " . $id;
        sqli($sql);
        
        $sql = "select * from log where id = " . $id;
        $c = sql($sql);
        //print_r($c);
    }
	else{
		$sql = "select * from log order by id desc limit 0,1";
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
<script src="js/js_readerwall.js" type="text/javascript"></script>
</head>
<body>
<?php include_once('head.php'); ?>
<div class="page">
	<div id="main">
		<hr />
		
		<div class="middle">
				<p>读者墙</p>
                <hr />
                    <ul class="readers-list">

<?php
	$conn = new db_conn();
	$sql = "select email,addr,name, count(*) as num from log_comment group by email order by num desc limit 0, 100";
	$result = $conn->db_query($sql);
	while($rows = mysql_fetch_assoc($result)){
?>

    
    <li class="readerwall-li">
    <?php 
        $str = getGravatar($rows['email'], 45); 
        $str = $str . "<em>" . $rows['name'] . "</em>";
        $str .= "<strong>+" . $rows['num'] . "</strong>";
    ?>
    <?php echo url_test($rows['addr'],$str); ?> 
    </li>

<?php
	}
	
    $conn->db_close();
    


?>
            </ul>
        </div>
		
	
	</div>
<?php include_once('foot.php'); ?>
</div>

</body></html>
