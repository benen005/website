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
    <td align="center">栏目</td>
    <td width="100" align="center">操作</td>
    
    
  </tr>
  </thead>
  <tbody>
<?php
	$conn = new db_conn();
	$sql = "SELECT * FROM category";
	$result = $conn->db_query($sql);
	while($rows = mysqli_fetch_assoc($result)){
?>
  <tr>
    <td><?php echo $rows['id']."# ".$rows['name']; ?></td>

    <td align="center">
	<a href="?type=edit&id=<?php echo $rows['id']; ?>">编辑</a>
    </id>
  </tr>
<?php
	}
?>
  </tbody>
</table>
<?php
}# END INDEX

function add(){
?>
<form action="?type=saveCategory" method="post" name="form1" id="form1">
<table class="t" width="100%" border="0" cellpadding="0" cellspacing="1">
  <thead>
  <tr>
    <td colspan="2">添加栏目</td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td width="11%" align="right">栏目：</td>
    <td width="89%">&nbsp;<input name="name" type="text" id="name" size="40" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input value="提交" type="submit"  /></td>
  </tr>
  </tbody>
</table>
</form>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
	function sub_it(){
		var d = $('#content').val(ue.getContent());
		form1.submit();

	}
</script>
<?php
}

function saveCategory()
{
	extract($_POST);
	if($name ==""){
		die(printTop("对不起，请填写完整表单！"));
	}
	
	$conn = new db_conn();
	$sql = "INSERT INTO category (name) VALUES ('$name')";
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
$sql = "SELECT * FROM category WHERE id=".$id;
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
    <td width="11%" align="right">栏&nbsp;&nbsp;目：</td>
    <td width="89%">&nbsp;<input name="name" id="name" type="text" value="<?php echo $rows['name']; ?>" size="40"/></td>
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
	$sql = "UPDATE category SET name='$name' WHERE id=$id";
	$result = $conn->db_query($sql);
	if($result){
		adminLos("修改栏目 ".$id);
		echo printTop("编辑成功");
	}else{
		echo printTop("编辑成功");
	}
	$conn->db_close();
}

	footers();
?>