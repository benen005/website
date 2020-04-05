<?php 
include_once('action.php');
//测试 inner join
$sql = "select * from user";

$r = sql($sql);

//foreach($r as $k => $v){
//    for($i=1;$i<11;$i++){
//        if($v['fjy'] == $i)
//            echo $i. $v['fl'].$v['num']."\n";
//    }
//}
print_r($r);