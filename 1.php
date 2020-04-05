<?php 
require_once 'inc.php';

$file = root_dir . '/www/cp_data/pl3.txt';
logger::init();

// 读入历史数据
$r = logger::read_pl3($file); 


foreach($r as $k => $v){
    $tmp = $v[0] . $v[1] . $v[2];
    if($tmp == '963')
        echo 1;
}
?>