<?php 
echo 22;
$serve = 'localhost';
$username = 'root';
$password = '123456';
$dbname = 'ben';
$mysqli = new Mysqli($serve,$username,$password,$dbname);
if($mysqli->connect_error){
	die('connect error:'.$mysqli->connect_errno);
}
else
    echo "ok";
$mysqli->set_charset('UTF-8'); // 设置数据库字符集

$result = $mysqli->query('select * from user');
$data = $result->fetch_array(); // 从结果集中获取所有数据
print_r($data);
echo 3;


?>