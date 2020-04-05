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
<?php $category = getCategoryList(); 
if($category){
	foreach($category as $k=>$v){
		echo "<a href='?type=index&cid=".$v["id"]."'>" . $v["name"] . "</a> ";
}}
?>
<table class="t" width="100%" border="0" cellpadding="0" cellspacing="1">
  <thead>
  <tr>
    <td align="center">标题</td>
    <td width="100" align="center">作者</td>
    <td width="80" align="center">栏目</td>
    <td width="120" align="center">编辑</td>
  </tr>
  </thead>
  <tbody>
<?php
$cid = g('cid');
$page=isset($_GET['page'])?intval($_GET['page']):1;
$num = 30;
$fy_sql = "SELECT * FROM log";
if($cid)
	$fy_sql = "select * from log where cid=" . $cid;
$fy = fy($page, $num, $fy_sql, 'type=index&'); 
$offset = $fy['offset'];
$show_page = $fy['showpage'];

		$sql = $fy_sql . " order by id desc limit $offset,$num";
		$c = sql($sql);
		
	//$conn = new db_conn();
	//$sql = "SELECT * FROM log order by id desc";
	//$result = $conn->db_query($sql);
	//while($rows = mysqli_fetch_assoc($result)){
	if($c){foreach($c as $k => $rows){
?>
  <tr>
    <td><?php echo $rows['id']."# ".$rows['title']; ?></td>
	<td align="center"><?php echo $rows['user_id']; ?></td>
    <td align="center"><a href="?type=index&cid=<?php echo $rows['cid']; ?>"><?php echo getCategory($rows['cid']); ?></a></td>
    <td align="center">
	<a href="?type=editNews&id=<?php echo $rows['id']; ?>">编辑</a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript:if(confirm('你确实要删除吗?')) location.href='?type=delNews&id=<?php echo $rows['id']; ?>';">删除</a></td>
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
function delNews(){
	$conn = new db_conn();
	$sql = "DELETE FROM log WHERE id=".(int)$_GET['id'];
	$result = $conn->db_query($sql);
	if($result){
		adminLos("删除新闻 ".(int)$_GET['id']);
		echo printTop("删除成功");
	}else{
		echo printTop("删除失败");
	}
}

function addNews(){
?>
<form action="?type=saveNews" method="post" name="form1" id="form1">
<table class="t" width="100%" border="0" cellpadding="0" cellspacing="1">
  <thead>
  <tr>
    <td colspan="2">添加新闻</td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td width="11%" align="right">标&nbsp;&nbsp;题：</td>
    <td width="89%">&nbsp;<input name="title" type="text" id="title" size="40" /></td>
  </tr>
  <tr>
    <td align="right">作&nbsp;&nbsp;者：</td>
    <td>&nbsp;<input name="user_id" type="text" id="user_id" size="20" /></td>
  </tr>
  <tr>
    <td align="right">标&nbsp;&nbsp;签：</td>
    <td>&nbsp;<input name="tags" type="text" id="tags" size="40" />(用,分开)</td>
  </tr>
  <tr>
    <td align="right">栏&nbsp;&nbsp;目：</td>
    <td>&nbsp;
		<select name="category" id="category">
			<option value="0">--请选择--</option>
		<?php $category = getCategoryList();foreach($category as $k => $v){ ?>
			<option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
		<?php } ?>
		</select></td>
  </tr>
  <tr>
    <td align="right">内&nbsp;&nbsp;容：</td>
    <td>&nbsp;<textarea name="content" cols="40" rows="10" id="content" style="display:none;"></textarea><script id="editor" type="text/plain" style="width:1024px;height:500px;"></script></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input value="提交" type="button" onclick="sub_it();" /></td>
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
function saveNews()
{
	extract($_POST);
	if($title == "" || $content==""){
		die(printTop("对不起，请填写完整表单！"));
	}
	record_tags($tags);
	$content = nl2br($content);
	$date = date("Y-m-d H:i:s");
	$conn = new db_conn();
	
	$sql = "INSERT INTO log (title,tags,user_id,content,cid,pubtime) VALUES ('$title','$tags','$user_id','$content','$category','$date')";
	$result = $conn->db_query($sql);
	if($result){
		adminLos("添加新闻");
		echo printTop("保存成功");
	}else{
		echo printTop("保存失败");
	}
	$conn->db_close();
}

function editNews(){
$conn = new db_conn();
@$id = (int)$_GET['id'];
$sql = "SELECT * FROM log WHERE id=".$id;
$result = $conn->db_query($sql);
if($result){
	$rows = mysqli_fetch_assoc($result);
}
?>
<form action="?type=saveEditNews&id=<?php echo $id; ?>" method="post" name="form1" id="form1">
<table class="t" width="100%" border="0" cellpadding="0" cellspacing="1">
  <thead>
  <tr>
    <td colspan="2">修改新闻</td>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td width="11%" align="right">标&nbsp;&nbsp;题：</td>
    <td width="89%">&nbsp;<input name="title" id="title" type="text" value="<?php echo $rows['title']; ?>" size="40"/></td>
  </tr>
  <tr>
    <td align="right">作&nbsp;&nbsp;者：</td>
    <td>&nbsp;<input name="user_id" id="user_id" type="text" value="<?php echo $rows['user_id']; ?>" /></td>
  </tr>
  <tr>
    <td align="right">标&nbsp;&nbsp;签：</td>
    <td>&nbsp;<input name="tags" type="text" id="tags" size="40" value="<?php echo $rows['tags']; ?>" />(用,分开)</td>
  </tr>
  <tr>
    <td align="right">栏&nbsp;&nbsp;目：</td>
    <td>&nbsp;
		<select name="category" id="category">
			<option value="0">--请选择--</option>
		<?php $category = getCategoryList();foreach($category as $k => $v){ ?>
			<option value="<?php echo $v['id']; ?>" <?php echo $rows['cid'] == $v['id']?"selected":""; ?>><?php echo $v['name']; ?></option>
		<?php } ?>
		</select></td>
  </tr>
  <tr>
    <td align="right">简&nbsp;&nbsp;介：</td>
    <td>&nbsp;<textarea name="content" cols="40" rows="10" id="content" style="display:none;"><?php echo $rows['content']; ?></textarea></textarea><script id="editor" type="text/plain" style="width:1024px;height:500px;"></script></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input value="编辑" type="button" onclick="save_it();" /></td>
  </tr>
  </tbody>
</table>
</form>
<script type="text/javascript">
    //var ue = UE.getEditor('editor');
	


	//$(document).ready(function(){
		//ue.setContent('欢迎使用ueditor');
		
		var ue = new baidu.editor.ui.Editor();
			ue.render('editor');
			ue.ready(function() {
				ue.setContent($('#content').val());  //赋值给UEditor
			});
			
			
	//});
	
	function save_it(){

		$('#content').val(ue.getContent());
		
		form1.submit();

	}
</script>
<?php
}
function saveEditNews(){
	@$id = (int)$_GET['id'];
	if(empty($id)){
		die(printTop("NOT ID"));
	}
	extract($_POST);
	record_tags($tags, 0);
	$content = nl2br($content);
	$conn = new db_conn();
	$sql = "UPDATE log SET title='". $title . "',tags='" . $tags. "', user_id='" . $user_id. "', content='" . $content . "', cid='" . $category . "' WHERE id=$id";
	$result = $conn->db_query($sql);
	if($result){
		adminLos("修改新闻 ".$id);
		echo printTop("编辑成功");
	}else{
		echo printTop("编辑失败");
	}
	$conn->db_close();
}



	footers();
?>
