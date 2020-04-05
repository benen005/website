<?php
/*
	智汀网络开发 http://www.go0663.cn
	作者：R
	邮箱：go522000@126.com
*/
	include("admin.func.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>连接</title>
<link type="text/css" rel="stylesheet" href="css.css" />
<style type="text/css">
body{
	background-color: #888888;
	padding: 5px;
}
</style>
</head>

<body>










<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="t">
  <thead>
  <tr>
    <td align="center" bgcolor="#EEEEEE"><strong>新闻管理</strong></td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td bgcolor="#FFFFFF"><a href="news.php?type=index" target="mainFrame">管理所有新闻</a></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><a href="news.php?type=addNews" target="mainFrame">添加新闻</a></td>
  </tr>


  </tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="t">
  <thead>
  <tr>
    <td align="center" bgcolor="#EEEEEE"><strong>栏目管理</strong></td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td bgcolor="#FFFFFF"><a href="category.php?type=index" target="mainFrame">管理栏目</a></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><a href="category.php?type=add" target="mainFrame">添加栏目</a></td>
  </tr>
  </tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="t">
  <thead>
  <tr>
    <td align="center" bgcolor="#EEEEEE"><strong>留言管理</strong></td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td bgcolor="#FFFFFF"><a href="comment.php?type=index" target="mainFrame">管理留言</a></td>
  </tr>
  </tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="t">
  <thead>
  <tr>
    <td align="center" bgcolor="#EEEEEE"><strong>链接管理</strong></td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td bgcolor="#FFFFFF"><a href="link.php?type=index" target="mainFrame">管理所有链接</a></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><a href="link.php?type=addLink" target="mainFrame">添加链接</a></td>
  </tr>
  </tbody>
</table>



<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="t">
  <thead>
  <tr>
    <td align="center" bgcolor="#EEEEEE"><strong>帐号管理</strong></td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td bgcolor="#FFFFFF"><a href="admin.php?type=index" target="mainFrame">修改后台密码</a></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF"><a href="admin.php?type=exits" target="mainFrame">安全退出</a></td>
  </tr>
  </tbody>
</table>
</body>
</html>
