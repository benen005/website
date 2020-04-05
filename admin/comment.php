<?php
	include("admin.func.php");
	headers();
	include_once('action.php');
    
    @$type = $_GET['type'];
if($type){
	$type();
}

function index(){
?>
<table class="t" width="100%" border="0" cellpadding="0" cellspacing="1">
  <thead>
  <tr>
    <td align="center">名称 内容</td>
    <td width="100" align="center">操作</td>
    
    
  </tr>
  </thead>
  <tbody>
<?php
$page=isset($_GET['page'])?intval($_GET['page']):1;
$num = 30;
$fy_sql = "SELECT * FROM log_comment";
$fy = fy($page, $num, $fy_sql, 'type=index&'); 
$offset = $fy['offset'];
$show_page = $fy['showpage'];

		$sql = $fy_sql . " order by id desc limit $offset,$num";
		$c = sql($sql);

	//$conn = new db_conn();
	//$sql = "SELECT * FROM log_comment order by id desc";
	//$result = $conn->db_query($sql);
	//while($rows = mysql_fetch_assoc($result)){
	if($c){foreach($c as $k => $rows){
?>
  <tr>
    <td><?php echo $rows['id']."# ".$rows['name']; ?> <?php echo $rows['content']; ?> <?php echo $rows['pubtime']; ?></td>

    <td align="center">
	<a href="?type=edit&id=<?php echo $rows['id']; ?>">编辑</a> <a href="?type=del&id=<?php echo $rows['id']; ?>" onclick="return confirm('确认删除?');">删除</a>
    </id>
  </tr>
<?php
	}}
?>
  </tbody>
</table>

<div class="fy">
<?php echo $show_page; ?>
</div>

<?php
}# END INDEX

function addcomment(){

}

function savecomment()
{
	extract($_POST);
	if($name ==""){
		die(printTop("对不起，请填写完整表单！"));
	}
	
	$conn = new db_conn();
	$sql = "INSERT INTO log_comment (name, addr, weight, pubtime) VALUES ('$name', '$addr', '$weight', now())";
	$result = $conn->db_query($sql);
	if($result){
		adminLos("添加栏目");
		echo printTop("保存成功");
	}else{
		echo printTop("保存失败");
	}
	$conn->db_close();
}

function edit(){
$conn = new db_conn();
@$id = (int)$_GET['id'];
$sql = "SELECT * FROM log_comment WHERE id=".$id;
$result = $conn->db_query($sql);
if($result){
	$rows = mysqli_fetch_assoc($result);
}
?>
<form action="?type=save&id=<?php echo $id; ?>" method="post" name="form1" id="form1">
<table class="t" width="100%" border="0" cellpadding="0" cellspacing="1">
  <thead>
  <tr>
    <td colspan="2">修改栏目</td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td width="11%" align="right">用户名：</td>
    <td width="89%">&nbsp;<input name="name" id="name" type="text" value="<?php echo $rows['name']; ?>" size="40"/></td>
  </tr>
  <tr>
    <td width="11%" align="right">Email：</td>
    <td width="89%">&nbsp;<input name="email" id="email" type="text" value="<?php echo $rows['email']; ?>" size="40"/></td>
  </tr>
  <tr>
    <td width="11%" align="right">链接网址：</td>
    <td width="89%">&nbsp;<input name="addr" id="addr" type="text" value="<?php echo $rows['addr']; ?>" size="40"/></td>
  </tr>
  <tr>
    <td width="11%" align="right">留言：</td>
    <td width="89%">&nbsp;<input name="content" id="content" type="text" value="<?php echo $rows['content']; ?>" size="40"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input value="编辑" type="submit"  /></td>
  </tr>
  </tbody>
</table>
</form>
<?php
}

function save(){
	@$id = (int)$_GET['id'];
	if(empty($id)){
		die(printTop("NOT ID"));
	}
	extract($_POST);

	$conn = new db_conn();
	$sql = "UPDATE log_comment SET name='$name', email='$email', addr='$addr',content='$content' WHERE id=$id";
	$result = $conn->db_query($sql);
	if($result){
		adminLos("修改栏目 ".$id);
		echo printTop("编辑成功");
	}else{
		echo printTop("编辑成功");
	}
	$conn->db_close();
}

function del(){
	@$id = (int)$_GET['id'];
	if(empty($id)){
		die(printTop("NOT ID"));
	}
	$sql = "delete from log_comment where id = ".$id;
	$r = sqli($sql);
	if($r)
		echo printTop("删除成功");
	else
		echo printTop("删除失败");
}


	footers();
?>