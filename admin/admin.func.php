<?php
/*
	智汀网络开发 http://www.go0663.cn
	作者：R
	邮箱：go522000@126.com
*/
session_start();
include_once("../include/conn.class.php");
include_once("../include/page.class.php");

if(empty($_SESSION['adminusername'])){
	die('<script language="javascript">window.location="index.php"</script>');
}

//头文件
function headers(){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link type="text/css" rel="stylesheet" href="css.css" />
<link rel="stylesheet" href="../ueditor/third-party/SyntaxHighlighter/shCoreDefault.css" type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="../jquery-1.3.2.min.js"></script>
<script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.config.js"></script><!-- baidu edit -->
<script type="text/javascript" charset="utf-8" src="../ueditor/ueditor.all.min.js"> </script><!-- baidu edit -->
<script type="text/javascript" charset="utf-8" src="../ueditor/lang/zh-cn/zh-cn.js"></script><!-- baidu edit -->
<script src="../ueditor/third-party/SyntaxHighlighter/shCore.js" type="text/javascript"></script>
<script type="text/javascript">
	SyntaxHighlighter.all();
</script>
<style>
body{
	padding: 5px;	
}
div.fy{float:left;width:670px;margin-top:10px;margin-left:10px;margin-bottom:10px;border:1px dotted #000;padding:5px;text-align:center;}
.fy b{float:left;width:20px;border:1px solid #999;margin:2px;background:#eee;}
.fy a{float:left;width:20px;border:1px solid #999;margin:2px;background:#eee;color:#000;}
.fy a:link{color:#000;text-decoration:underline;}
.fy a:hover{color:#000;text-decoration:none;}
</style>
</head>

<body>
<?php
}

//底文件
function footers(){
?>
</body>
</html>
<?php
}

//输出JS返回
function printTop($text="",$up=1)
{
	if(is_int($up)){
		if(empty($text)){
			return '<script language="javascript">history.back(-'.$up.')</script>';
		}else{
			return '<script language="javascript">alert("'.$text.'");history.back(-'.$up.')</script>';
		}
	}else{
		if(empty($text)){
			return '<script language="javascript">window.location="'.$up.'"</script>';
		}else{
			return '<script language="javascript">alert("'.$text.'");window.location="'.$up.'"</script>';
		}
	}
}

//截取字符串
function str_number($string,$num)
{
	$j=0;
	for($i=0;$i<$num;$i++)
	{
		if(ord(substr($string,$i,1))>0xa0)
		{
			$j++;
		}
	}
	if($j%2!=0){
		$num++;
	}
	$str=substr($string,0,$num);
	if(strlen($string)>strlen($str))
	{
		$str=substr($string,0,$num);
	}
	return $str;
}

function ResizeImage($im,$maxwidth,$maxheight,$name,$mode=1)
{
  global $thumb_type;
//mode=1 mode=0
  $width = imagesx($im);
  $height = imagesy($im);
  if(($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight) || ($mode==0))
  {
    if($maxwidth && $width > $maxwidth)
    {
      $widthratio = $maxwidth/$width;
      $RESIZEWIDTH=true;
    }
    if($maxheight && $height > $maxheight)
    {
      $heightratio = $maxheight/$height;
      $RESIZEHEIGHT=true;
    }
    if($RESIZEWIDTH && $RESIZEHEIGHT)
    {
      if($widthratio < $heightratio)
      {
        $ratio = $widthratio;
      }else{
        $ratio = $heightratio;
      }
    }elseif($RESIZEWIDTH)
    {
      $ratio = $widthratio;
    }elseif($RESIZEHEIGHT)
    {
      $ratio = $heightratio;
    }
    $newwidth = $width * $ratio;
    $newheight = $height * $ratio;
    if ($mode==0){$newwidth=$maxwidth;$newheight=$maxheight;}//modeΪ0Աʡ
    if(function_exists("imagecopyresampled"))
    {
        $newim = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    }else{
      $newim = imagecreate($newwidth, $newheight);
        imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    }
    imagejpeg($newim,$name);
    imagedestroy($newim);
	return true;
  }else{
     imagejpeg($newim,$name,80);
	 return true;
  }
}

//后台操作记录
function adminLos($text){
	return null;
	$conn = new db_conn();
	$date = date("Y-m-d H:i:s");
	$sql = "INSERT INTO managelog (user,descript,datetime,comment) VALUES ('".$_SESSION['adminusername']."','".$text."','".$date."','')";
	$result = $conn->db_query($sql);
	$conn->db_close();
}
?>