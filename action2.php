<?php 

include_once('include/config.php');
include_once('include/conn.class.php');
include_once('include/base.php');

$action = g('action', null);
$id = g('id', null);
$url = g('url', null);

$this_web = $_SERVER['REQUEST_URI'];

/*重定向*/
if($_SERVER['HTTP_HOST'] == "benen005.cn"){
    header('Location: http://www.benen005.cn'. $_SERVER['REQUEST_URI']);
    exit;
}

//判断手机端
$request_uri = $_SERVER['REQUEST_URI'];
$is_phone = stripos($request_uri, "phone");
$agent = get_agent();
//echo $is_phone;exit;
/*
if($agent == 'mobile' && !$is_phone){
    if(get_cookie_of_computer()){  //如果已经写入cookie, 则可以访问电脑端
        //访问电脑端
       
    }
    else{
        $tmp = explode("/", $request_uri);
        header('Location: phone/' . $tmp[count($tmp)-1]);exit;
    }
    
}
*//////

/* 页面缓存 */
$cache_web = $service_url . $this_web;
//echo $cache_web;exit;
if(get_cache($cache_web)){ //如果存在缓存直接输出
    exit;
}
else{
    //todo
    set_cache($cache_web);
}
/* 页面缓存 end */

if($action == 'face'){
    face($id);
}
elseif($action == 'face2'){
    face2();
}
elseif($action == 'face_del'){
    face_del();
}
elseif($action == 'face_run'){
    face_run($url);
}
elseif($action == 'comment_add'){
    comment_add();
}
elseif($action == 'phone_upload'){
    phone_upload();
}
elseif($action == 'phone_del'){
    phone_del();
}


function comment_add(){
    global $this_web, $is_mail_flag;
	extract($_POST);
	if(trim($name) =="" && trim($content)==""){
		die(printTop("请填写评论内容"));
	}
    if(trim($checktxt) > 21 && trim($checktxt) < 26){
        
    }
    else
        die(printTop("请进行数字验证"));
    clean_xss($name);
    clean_xss($content);
    clean_xss($email);
    clean_xss($addr);
    
	$conn = new db_conn();
	$sql = "INSERT INTO log_comment (log_id, name, email, addr, content, pubtime, comment_id) VALUES ('$id', '$name', '$email', '$addr', '$content', now(), '$is_reply_to')";
	$result = $conn->db_query($sql);
    $sql2 = "update log set comment_num = comment_num + 1 where id = $id";
    $result2 = $conn->db_query($sql2);
    $conn->db_close();
    
	if($result){
        setcookie("name",$name, time()+3600*24*30);  //加入一个月的cookie
        setcookie("email",$email, time()+3600*24*30);
        setcookie("addr",$addr, time()+3600*24*30);
        $this_web = str_replace("&action=comment_add", "", $this_web);
        $last_id = ssql("select * from log_comment order by id desc limit 0, 1");
        $this_web .= "#comment" . $last_id["id"];
        
        /* 发送邮件 */
        if($is_mail_flag){
            $reply_email = getComment($is_reply_to);
            $a_id = getLog($reply_email['log_id']);
            $a_title = $a_id['title'];
            $name = $reply_email["name"];
            $a_content = $reply_email["content"];
            $auther = $last_id['name'];
            $reply = $last_id['content'];
            $reply_email = $reply_email["email"];
            
            
                if($reply_email && $is_reply_to){
                    send_email($reply_email, "您在 [小ben成长手册] 网站的留言有了回复", $content, $this_web, $name, $a_title, $a_content, $auther, $reply); 
            }
        }
        /* 发送邮件 end */
        
		echo printTop("留言成功", $this_web);
        //header("location: $this_web");exit;
	}else{
		echo printTop("留言失败");
	}
	
}

function send_email($to, $title, $content, $url, $name, $a_title, $a_content, $auther, $reply){
try {
    global $webname, $service_url;
	$mail = new PHPMailer(true); 
	$mail->IsSMTP();
	$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
	$mail->SMTPAuth   = true;                  //开启认证
	$mail->Port       = 25;                    
	$mail->Host       = "smtp.sina.com"; 
	$mail->Username   = "benen005@sina.com";    
	$mail->Password   = "benen005_";            
	//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
	$mail->AddReplyTo("benen005@sina.com","benen005");//回复地址
	$mail->From       = "benen005@sina.com";
	$mail->FromName   = $webname;
	//$to = "benen005@zju.edu.cn";
	$mail->AddAddress($to);
	$mail->Subject  = $title;
	$mail->Body = $content . email_reply($service_url . $url, $name, $a_title, $a_content, $auther, $reply);
	$mail->AltBody    = ""; //当邮件不支持html时备用显示，可以省略
	$mail->WordWrap   = 80; // 设置每行字符串的长度
	//$mail->AddAttachment("f:/test.png");  //可以添加附件
	$mail->IsHTML(true); 
	$mail->Send();
	return 1;
} catch (phpmailerException $e) {
	return 0; //.$e->errorMessage();
}
}

function email_reply($url, $name, $a_title, $a_content, $auther, $reply){
    global $webname, $service_url;
    //return "<br /><h1><a href='$url'>您可以点此查看完整回复内容</a></h1>（来自<font color=red><a href='http://benen005.cn/'>benen005.cn</a></font>）";
    return '<div class="mailMainArea" style="font-size:14px;font-family:Verdana,&quot;宋体&quot;,Helvetica,sans-serif;line-height:1.66;padding:8px 10px;margin:0;overflow:auto"><div style="border-bottom:7px solid #028fdb; repeat-x 0 1px;width:70%;"><div style="border:1px solid #c8cfda; padding:30px;"><div style="border: 1px solid #e0e0e0; margin: 0 0 20px 0;"><p style="font-weight: bold; padding: 5px 10px;">' . $name. ',您曾在《'.$a_title.'》上的留言：<br></p><p style="padding: 5px 10px;">'.$a_content.'</p></div><div style="border: 1px solid #e0e0e0;"><p style="font-weight: bold; padding: 5px 10px;">'.$auther.'，给您的回复：<br></p><p style="padding: 5px 10px;">'.$reply.'</p></div><div style="color:#999; font-size:12px; line-height:2;"><p style="padding: 5px;">可以点此 <a target="_blank" style="color:#BDBDBD" href="'.$url.'" _act="check_domail">'.$url.'</a> 查看完整回复內容<br><br></p></div><div style="padding:0; line-height:1.6;  font-size:14px; margin:5px 0 0;">'.$webname.'&nbsp;&nbsp;<css style="color:#999; font-size:12px; line-height:2;">官网地址：<a target="_blank" style="color:#BDBDBD" href="'.$service_url.'" _act="check_domail">'.$service_url.'</a> 打造世界级宇宙大师</css></div><div style="border-top:1px solid #c8cfda; width:60%; color:#999; font-size:12px; line-height:1.5;"><br>小ben提醒您：添加 <a target="_blank" style="color:#BDBDBD" href="mailto:benen005@sina.com" _act="check_domail">benen005@sina.com</a> 至您的邮箱通讯录，以便正常接收本站邮件！<br>温馨提醒：【此为小ben给您的回复,由系统自动推送您邮箱.】</div></div></div></div>';
}


function face_run($url){
    //echo $url;
    
    global $website, $face_api_key, $face_api_secret;
    $url = $website . $url;
    //echo $url;exit;
    $api_key = $face_api_key;
    $api_secret = $face_api_secret;
    $api = new FacePPClientDemo($api_key, $api_secret);
    $face_ids = array();
    $r = array();
    detect($api, $url, $face_ids, $r);
    //echo $p[0]->face[0]->attribute->age->value;
    $r = face_detect($r);
    $callback = $_GET["callback"]; 
    
    if($r){
        $array = array(
            "status"=>"success",
            "picture" => $r
        );
    }
    else{
        $array = array(
            "status"=>"failure"
        ); 
    }
    $result = json_encode($array);  
    echo "$callback($result)";
}

function getPhone(){
    $sql = "select * from phone order by id desc limit 0,10";
    $r = sqlo($sql);
    return $r;
}
function getComment($id){
    $sql = "select * from log_comment where id = $id";
    $r = ssql($sql);
    return $r;
}
function getCommentList($id){
    $sql = "select * from log_comment where log_id = $id order by id desc";
    $r = sqlo($sql);
    return $r;
}
function getLinkList(){
    $sql = "select * from link order by weight desc, id asc";
    $r = sqlo($sql);
    return $r;
}
function getCategory($id){
    $sql = "select * from category where id =" .$id;
    $r = ssql($sql);
    if($r['name'])
        return $r['name'];
    else
        return '未分类';
}
function getCategoryList(){
    $sql = "select * from category";
    $r = sql($sql);
    return $r;
}
function getLog($id){
    $sql = "select * from log where id = $id";
    $r = ssql($sql);
    return $r;
}

function phone_upload(){  //随手拍上传图片
	$picname = $_FILES['mypic']['name'];
	$picsize = $_FILES['mypic']['size'];
	if ($picname != "") {
		if ($picsize > 6120000) {
			echo '图片大小不能超过5M';
			exit;
		}
		$type = strstr($picname, '.');
		if ($type != ".gif" && $type != ".jpg" && $type != ".png" && $type != ".jepg" && $type != ".bmp" && $type != ".GIF" && $type != ".JPG" && $type != ".PNG" && $type != ".JEPG" && $type != ".BMP") {
			echo '图片格式不对！';
			exit;
		}
		$rand = rand(100, 999);
		$pics = date("YmdHis") . $rand . $type;
        //记录数据库
        $name = $pics;
        $date = date("Y-m-d H:i:s");
        $ip = ip();
        $sql = "INSERT INTO `phone` (`name`, `pubtime`, `ip`) VALUES ('$name', '$date', '$ip')";
        sqli($sql);
		//上传路径
		$pic_path = "upload_files/phone/". $pics;
		move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path);
        




/* 上传到七牛 */
global $qiniu_accessKey, $qiniu_secretKey, $qiniu_bucket, $qiniu_flag, $pic_is_del;
if($qiniu_flag){
    $auth = new Auth($qiniu_accessKey, $qiniu_secretKey);
    $token = $auth->uploadToken($qiniu_bucket);
    // 要上传文件的本地路径
    $filePath = $pic_path;
    // 上传到七牛后保存的文件名
    $key = $name;
    // 初始化 UploadManager 对象并进行文件的上传。
    $uploadMgr = new UploadManager();
    // 调用 UploadManager 的 putFile 方法进行文件的上传。
    list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
    //echo "\n====> putFile result: \n";
    if ($err !== null) {
        //var_dump($err);
    } else {
        //var_dump($ret);
    }
}
/* 上传到七牛 end */
        
       
	}
	$size = round($picsize/1024,2);
	$arr = array(
		'name'=>$picname,
		'pic'=>$pics,
		'size'=>$size
	);
    
/* 上传到七牛  删除本地 */
if($qiniu_flag){
    if($pic_is_del){
        //删除本地资源
        unlink('upload_files/phone/'.$name);
    }
}
/* 上传到七牛  删除本地 end */
	echo json_encode($arr);
}

function phone_del(){
	$filename = $_POST['imagename'];
	if(!empty($filename)){
		unlink('upload_files/phone/'.$filename);
		echo '1';
	}else{
		echo '删除失败.';
	}
}

function face(){

    if(is_post()){

        $date = date("Y-m-d H:i:s");
        $name = upload(f('photo', null));

        $conn = new db_conn();
        $sql = "INSERT INTO `face` (`name`, `pubtime`) VALUES ('$name', '$date')";
        $result = $conn->db_query($sql);
        if($result){
            echo ("<script>location.href='face.php?action=detect&name=$name';</script>");
        }else{
            echo ("保存失败");
        }
        $conn->db_close();
        exit;
    }
}

function face_del(){
	$filename = $_POST['imagename'];
	if(!empty($filename)){
		unlink('upload_files/face/'.$filename);
		echo '1';
	}else{
		echo '删除失败.';
	}
}

function face2(){  //face上传图片
	$picname = $_FILES['mypic']['name'];
	$picsize = $_FILES['mypic']['size'];
	if ($picname != "") {
		if ($picsize > 6120000) {
			echo '图片大小不能超过5M';
			exit;
		}
		$type = strstr($picname, '.');
		if ($type != ".gif" && $type != ".jpg" && $type != ".png" && $type != ".jepg" && $type != ".bmp" && $type != ".GIF" && $type != ".JPG" && $type != ".PNG" && $type != ".JEPG" && $type != ".BMP") {
			echo '图片格式不对！';
			exit;
		}
		$rand = rand(100, 999);
		$pics = date("YmdHis") . $rand . $type;
        //记录数据库
        $name = $pics;
        $date = date("Y-m-d H:i:s");
        $ip = ip();
        $sql = "INSERT INTO `face` (`name`, `pubtime`, `ip`) VALUES ('$name', '$date', '$ip')";
        sqli($sql);
		//上传路径
		$pic_path = "upload_files/face/". $pics;
		move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path);
	}
	$size = round($picsize/1024,2);
	$arr = array(
		'name'=>$picname,
		'pic'=>$pics,
		'size'=>$size
	);
	echo json_encode($arr);
}

function upload($image){
            include_once('include/filer.php');
            include_once('include/image.php');
            global $image_info;    

            $date = date("Y_m_d_H_i_s")."_".new_image();
            $photo_name = $date.'.jpg';
            upload_to('upload_files/face/'.$photo_name, $image, 1); 
            
            // 准备参数
            $state = 'failure';
            // 过滤开始

            if ($image === null) {
                $message = '您必须指定一个图像文件';
                
            }                    

            if ($image['error'] !== UPLOAD_ERR_OK) {
                $message = '文件上传失败';
                
            }
                                                                                    
            $file_info = pathinfo($image['name']);
            # 保证小写
            $file_ext = strtolower($file_info['extension']);

            if (!in_array($file_ext, $image_info['image_exts'])) {
                $message = '扩展名不正确';
                
            }

            // 过滤结束
            // 处理
            $file_name  = $date;
            $file = $file_name . '.' . $file_ext;
            $state = 'success';
            return $file;
}

function upload_photo($image){
            include_once('include/filer.php');
            include_once('include/image.php');
            global $image_info;    

            $date = date("Y_m_d_H_i_s")."_".new_image();
            $photo_name = $date.'.jpg';
            upload_to('upload_files/original/'.$photo_name, $image, 1); 
    
            // 准备参数
            $state = 'failure';
            // 过滤开始

            if ($image === null) {
                $message = '您必须指定一个图像文件';
                
            }                    

            if ($image['error'] !== UPLOAD_ERR_OK) {
                $message = '文件上传失败';
                
            }
                                                                                    
            $file_info = pathinfo($image['name']);
            # 保证小写
            $file_ext = strtolower($file_info['extension']);

            if (!in_array($file_ext, $image_info['image_exts'])) {
                $message = '扩展名不正确';
                
            }

            // 过滤结束
            // 处理
            $file_name  = $date;
            $file = $file_name . '.' . $file_ext;
            
            $tmp_file = 'upload_files/original/'.$photo_name;
            
            foreach ($image_info['image_sizes'] as $size_name=>$size_info) {
                $tmp_file2 = 'upload_files/' . $size_name . '/' . $file;
                $t = new ThumbHandler();
                $t->setSrcImg($tmp_file);
                $t->setDstImg($tmp_file2);
                $t->createImg($size_info['width'], $size_info['height']);
            }
            //repo::set_by_id('user', array('face' => $file), visitor::get_id_of('user'));
            // 重定向
            $state = 'success';
            return $file;
}


function upload_photo2($image) {   //通过网址传照片
        //先传过来
        include_once('include/filer.php');
        $date = date("Y_m_d_H_i_s")."_".new_image();
        $photo_name = $date.'.jpg';
        
        global $ftp_file;
        upload_to($ftp_file.'original/'.$photo_name, $image, 2);  //已经指定了 upload_files/
        //传过来了
        
        // 准备参数
        $state = 'failure';
        // 过滤开始

        if ($image === null) {
            $message = '您必须指定一个图像文件';
           
        }                    
                                                                  
        $file_info = pathinfo($image);
        # 保证小写
        $file_ext = strtolower($file_info['extension']);

        // 过滤结束
        // 处理
        //$file_name  = new_image();
        $file_name = $date;
        $file = $file_name . '.' . $file_ext;
        
        $tmp_file = 'upload_files/original/'.$photo_name;
        
        include_once('include/image.php');
        global $image_info;
        
        foreach ($image_info['image_sizes'] as $size_name=>$size_info) {
            $tmp_file2 = 'upload_files/' . $size_name . '/' . $file;
            //$tmp_file2 = handle_upload_image($size_info['width'], $size_info['height'], $tmp_file);
            
            
            
            
            
            
            
            $t = new ThumbHandler();
            $t->setSrcImg($tmp_file);
            $t->setDstImg($tmp_file2);
            $t->createImg($size_info['width'], $size_info['height']);
            
            //upload_to($size_name . '/' . $file, $tmp_file2);  已经切好图, 无需再传
        }
        
        // 重定向
        $state = 'success';
        return $file;
        

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

//分页
function fy($page, $num = 10, $sql, $url = "index.php"){
        
        $conn = new db_conn();
        
        $result = $conn->db_query($sql);
        $total = $conn->db_num($result);      //查询数据的总数total
    $pagenum=ceil($total/$num);               //获得总页数 pagenum

    If($page>$pagenum || $page == 0){
           //Echo "Error : Can Not Found The page .";
          //Exit;
    }

    $offset=($page-1)*$num;         //获取limit的第一个参数的值 offset ，假如第一页则为(1-1)*10=0,第二页为(2-1)*10=10。             (传入的页数-1) * 每页的数据 得到limit第一个参数的值
    //$info=mysql_query("select * from log limit $offset,$num ");   //获取相应页数所需要显示的数据
    //While($it=mysql_fetch_array($info)){
    //       Echo $it['id']."<br />";
    //}                                                              //显示数据
    $show_page = '';
    For($i=1;$i<=$pagenum;$i++){
        if($url == "index.php")
            $show=($i!=$page)?"<a href='".$url."?page=".$i."'>$i</a>":"<b>$i</b>";
        else
            $show=($i!=$page)?"<a href='".$url."&page=".$i."'>$i</a>":"<b>$i</b>";
           $show_page = $show_page . $show." ";
    }

        $conn->db_close();
        $r = array();
        $r['showpage'] = $show_page;
        $r['offset'] = $offset;
        $r['num'] = $num;
        return $r;
}

//得到图片
function get_content_img($contents, $cid, $is_phone = 0){
    $pattern="/<IMG[\s\w=\'\"]+src=[\"\']*([\w:\/\.]+)[\"\']*/i";
    preg_match_all($pattern,$contents,$match);
    $src = '';
    if(!empty($match[1][0])){
        $src=$match[1][0];
    }
    else{
        if($is_phone)
            $src="../images/category/".$cid.".jpg";
        else
            $src="images/category/".$cid.".jpg";
    } 
    return $src;
}

//得到banner
function get_banner(){
    $r = rand(1, 10);
    if($r > 7){
        echo '<img src="images/banner2.jpg" />';
    } 
    //elseif($r > 3){
    //    echo '<script src="http://e.e708.net/cpc/diy/index.php?76135_4_20_2_d70000_940|90_" charset="gb2312"></script>';
    //}
    else{
        echo '<img src="images/banner2.jpg" />';
    }
}
function get_tj($table){
    $sql = "select count(*) as num from $table";
    $r = ssql($sql);
    $r = $r['num'];
    return $r;
}

/* $array为一个纵坐标数组, $title为表名 */
function draw_z2($array, $title, $zoom = 'auto'){
        $query = implode(",", $array);
        $str = "<div class=\"picture\"><span>".$title."</span><img src=\"pic.php?q=".$query."&zoom=".$zoom."\" /></div>";
        return $str;
}

/* $array为纵坐标数组, $wz为横坐标,$zzb是否光标跟随 1-是 0-否 $xz旋转度数 */
function draw_wz($array, $wz, $title, $zoom = 'auto', $zzb = 0, $xz = 0){
        $query = implode(",", $array);
        $wz = implode(",", $wz);
        $str = "<div class=\"picture\"><span>".$title."</span><img src=\"picwz.php?q=".$query."&wz=".$wz."&zzb=".$zzb."&xz=".$xz."&zoom=".$zoom."\" /></div>";
        return $str;
}

/* $c为内容, $zd为纵坐标字段, $title, $zoom */
function draw_z($c, $zd, $title, $zoom = 'auto'){
        $give = array();
        foreach($c as $k => $v){
            array_push($give, $v[$zd]);
        }
        $str = draw_z2($give, $title, $zoom);
        return $str;
}

/* $c为内容, $zd1为纵坐标字段, $zd2为横坐标字段, $title, $zoom, $zzb, $xz旋转度数 */
function draw_zh($c, $zd1, $zd2, $title, $zoom = 'auto', $zzb = 0, $xz = 0){
        $give = array();
        $wz = array();
        foreach($c as $k => $v)
            array_push($give, $v[$zd1]);
        foreach($c as $k => $v)
            array_push($wz, $v[$zd2]);    
        echo draw_wz($give,$wz, $title, $zoom, $zzb, $xz);
 
}

function get_checktxt(){
    $arr = array();
    $arr[] = "二十一加三等于几？";//24
    $arr[] = "二十二加三等于几？";//25
    $arr[] = "三十二减十等于几？";//22
    $arr[] = "一百五十减一百二十七等于几？";//23
    
    $rand_k = array_rand($arr, 1);
    
    return $arr[$rand_k];
}
?>