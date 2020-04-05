<?php
/*
	智汀网络开发 http://www.go0663.cn
	作者：R
	邮箱：go522000@126.com
*/
	include("admin.func.php");
	headers();
?>
<table class="t" width="100%" border="0" cellpadding="0" cellspacing="1">
  <thead>
  <tr>
    <td>掌聚后台管理程序</td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td>欢迎： <?php echo $_SESSION['adminusername']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  </tbody>
</table>
<?php
	footers();
?>
