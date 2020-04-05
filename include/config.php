<?php 
/**
 * 配置文件
 */
 
//$ftp_url = "127.0.0.1:21:myweb:myweb";
$service_url = "http://127.0.0.1:81";
$ftp_url = array('127.0.0.1', '21', 'myweb', 'myweb');
$conn_array = array('localhost', 'root', '123456', 'ben');
$webname = "benen005模板网站";
$website = "http://www.benen005.cn/";


/* 本地图片 */
$pic_is_del = 1;//默认删除本地图片
$pic_local_addr = "upload_files/phone/";

/* Gravatar 图片缓存目录 */
$file_gravatar = "upload_files/ava/";
$cache_time_gravatar = 1296000; //15天

/* 文件缓存时间 */
$cache_time = 180;

/* 回复时邮件提醒 */
$is_mail_flag = 1;

$image_info = array(
    'hash_layer'  => 2,
    'image_exts'  => array('jpg', 'gif', 'png'),
    'image_sizes' => array(
        'large'  => array(
            'default' => 'face_large.gif',
            'width'   => 800,
            'height'  => 800
        ),
        'small'  => array(
            'default' => 'face_small.gif',
            'width'   => 192,
            'height'  => 800
        ),
        'tiny'  => array(
            'default' => 'face_tiny.gif',
            'width'   => 57,
            'height'  => 57
        )
    )
);


?>