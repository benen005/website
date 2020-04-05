<?php
/*
	智汀网络开发 http://www.go0663.cn
	作者：R
	邮箱：go522000@126.com
*/
	include("admin.func.php");
	include_once('action.php');
	headers();
	
@$type = $_GET['type'];
if($type){
	$type();
}
function index(){
?>
<form action="?type=editPassword" method="post" name="form1" id="form1">
<table class="t" width="100%" border="0" cellpadding="0" cellspacing="1">
  <thead>
  <tr>
    <td colspan="2">修改密码</td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td width="11%" align="right">旧&nbsp;密&nbsp;码：</td>
    <td width="89%">&nbsp;<input name="password" id="password" type="password" /></td>
  </tr>
  <tr>
    <td align="right">新&nbsp;密&nbsp;码：</td>
    <td>&nbsp;<input name="password2" id="password2" type="password" /></td>
  </tr>
  <tr>
    <td align="right">确认密码：</td>
    <td>&nbsp;<input name="password3" id="password3" type="password" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input value="修改" type="submit" /></td>
  </tr>
  </tbody>
</table>
</form>
<?php
}
function editPassword(){
	extract($_POST);
	
	if(empty($password) || empty($password2)){
		echo printTop("请填写完整表单");
	}
	$password = sha1($password);
	if($password2 == $password3){
		$password2 = sha1($password2);
	}else{
		echo printTop("请确定新密码");
	}
	
	$conn = new db_conn();
	$sql = "SELECT count(*) as num FROM user WHERE id=".$_SESSION['adminuserid']." AND pass='$password'";
	$result = $conn->db_query($sql);
	if($result){
		$rows = mysqli_fetch_assoc($result);
		if($rows['num']==1){
			$sql = "UPDATE user SET pass='$password2' WHERE id=".$_SESSION['adminuserid'];
			$result = $conn->db_query($sql);
			if($result){
				adminLos("修改密码");
				echo printTop("修改密码成功");
			}else{
				echo printTop("修改失败");
			}
		}else{
			echo printTop("出现错误");
		}
	}
	$conn->db_close();
}

function exits()
{
	unset($_SESSION['uid']);
	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['admin']);
	
	session_destroy();
	die('<script language="javascript">window.parent.location="index.php";</script>');
}

	footers();
?>
