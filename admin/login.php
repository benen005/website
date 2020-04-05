<?php
/*
	智汀网络开发 http://www.go0663.cn
	作者：R
	邮箱：go522000@126.com
*/
session_start();
include_once('action.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
</head>

<body>
<?php 

extract($_POST);

if(empty($username) || empty($password)){
	echo "<html>";
	die('<script language="javascript">alert("请填写完整表单！");history.back(-1)</script>');
	echo "</html>";
}

$password = sha1($password);

$conn = new db_conn();
$sql = "SELECT * FROM user WHERE name='$username' AND pass='$password'";
$result = $conn->db_query($sql);
if($result){
	$num = $conn->db_num($result);
	if($num == 1){
		$rows = mysqli_fetch_assoc($result);
		$_SESSION['adminuserid'] = $rows['id'];
		$_SESSION['adminusername'] = $rows['name'];
		//headers();
		echo '<script language="javascript">alert("登陆成功");history.back(-1)</script>';
		//footer();
	}else{
		echo '<script language="javascript">alert("帐号或密码错误，请重新登陆！");history.back(-1)</script>';
		//echo printTop("出现错误！");
	}
}
$conn->db_close();
?>
</body>
</html>