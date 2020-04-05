<?php
/*
	智汀网络开发 http://www.go0663.cn
	作者：R
	邮箱：go522000@126.com
*/
session_start();
//include_once("../include/conn.class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link type="text/css" rel="stylesheet" href="css.css" />
</head>

<?php
if(empty($_SESSION['adminusername'])){
?>
<body>
<form id="form1" name="form1" method="post" action="login.php">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" align="center">后台登陆</td>
  </tr>
  <tr>
    <td height="30" align="left">帐号：
    	<input name="username" type="text" id="username" style="width: 150px;" />
    </td>
  </tr>
  <tr>
    <td height="30" align="left">密码：
        <input name="password" type="password" id="password" style="width: 150px;" />
	</td>
  </tr>
  <tr>
    <td height="30" align="center">
      <input type="submit" name="Submit" value="登陆" />
	</td>
  </tr>
</table>
</form>
</body>
</html>
<?php
}else{
?>
<frameset cols="180,*" frameborder="no" border="0" framespacing="0">
  <frame src="leftFrame.php" name="leftFrame" scrolling="auto" id="leftFrame" title="leftFrame" />
  <frame src="mainFrame.php" name="mainFrame" scrolling="auto" id="mainFrame" title="mainFrame" />
</frameset>
<noframes><body>
</body>
</noframes></html>
<?php
}
?>
