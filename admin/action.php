<?php 
include_once('../include/config.php');
include_once('../include/conn.class.php');
include_once('../include/base.php');

/* 记录tags */
function record_tags($str){
    $tmp = explode(",", $str);
    foreach($tmp as $k => $v){
        $tmp2 = trim($v);
        search_tag($tmp2);
    }
    
    return 1;
}

function search_tag($str){
    $sql = "select * from tags where tag = '" . $str . "'";
    $r = ssql($sql);
    if($r){
        $sql2 = "update tags set hit = hit + 1 where id = " . $r['id'];
        sqli($sql2);
        return 0;
    }
    else{
        $sql2 = "insert into tags(tag) values('".$str."')";
        sqli($sql2);
        return 1;
    }
}

/* 返回栏目名称 */
function getCategory($id){
    if($id){
        $sql = "select * from category where id = " . $id;
        $r = sql($sql);
        return $r[0]['name'];
    }
    else{
        return "";
    }
}

function getCategoryList(){
    $sql = "select * from category";
    $r = sql($sql);
    return $r;
}
//print_r(getCategoryList());


function log_add(){
    $user_id = p('user_id');
    if(is_post()){
        
        $user_id = p('user_id');
        $date = date("Y-m-d H:i:s");
        $title = p('title');
        $tags = p('tags');
        $content = p('content');
        
        
        $conn = new db_conn();
        $sql = "INSERT INTO `log` (`user_id`,`title`,`tags`, `content`, `pubtime`) VALUES ('$user_id','$title','$tags', '$content', '$date')";
        $result = $conn->db_query($sql);
        if($result){
            echo ("<script>location.href='log.php';</script>");
        }else{
            echo ("保存失败");
        }
        $conn->db_close();
        exit;
    }
}

function log_edit(){
    $user_id = p('user_id');
    $id = p('id', null);
    if(is_post() && $id){
        
        
        $date = date("Y-m-d H:i:s");
        $title = p('title');
        $tags = p('tags');
        $content = p('content');
        
        
        $conn = new db_conn();
        $sql = "update `log` set `title` = '".$title."',`tags` = '".$tags."', `pubtime` = '".$date."', `content` = '".$content."' where id = " . (int)$id;
        //echo $sql;exit;
        $result = $conn->db_query($sql);
        if($result){
            echo ("<script>location.href='log_edit.php?id='+$id;</script>");
        }else{
            echo ("保存失败");
        }
        $conn->db_close();
        exit;
    }
}

function log_del(){
    $id = g('id', null);
    if($id){
        $conn = new db_conn();
        $sql = "delete from log where id = " . (int)$id;
        //echo $sql;exit;
        $result = $conn->db_query($sql);
        if($result){
            echo ("<script>location.href='log_edit.php';</script>");
        }else{
            echo ("保存失败");
        }
        $conn->db_close();
        exit;
    }
}

//分页
function fy($page, $num = 10, $sql, $string = ''){
        
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

           $show=($i!=$page)?"<a href='?$string"."page=".$i."'>$i</a>":"<b>$i</b>";
           $show_page = $show_page . $show." ";
    }

        $conn->db_close();
        $r = array();
        $r['showpage'] = $show_page;
        $r['offset'] = $offset;
        $r['num'] = $num;
        return $r;
}

?>