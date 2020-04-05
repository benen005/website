<?php 
include_once('include/config.php');
include_once('include/conn.class.php');
include_once('include/base.php');
    header("Content-Type: image/png");
    //$im = imagecreate(100,100);
    //$bg = imagecolorallocate($im, 255, 255, 0);
    //$textcolor = imagecolorallocate($im, 255, 0, 0);
    //imagestring($im,5,0,0,"hello world",$textcolor);
    //imagepng($im);
    //imagedestory($im);
     
    $q = g('q');
    $give = explode(",", $q);
    //print_r($give);exit;
    
    $image = imagecreatetruecolor(300, 300);
    $gray = imagecolorallocate($image, 180, 180, 180);
    $red = imagecolorallocate($image, 255, 0, 0);
    
    /* 画横坐标 */
    imageline($image, 10, 20, 10, 290, $red);    /*纵*/
    imageline($image, 10, 290, 290, 290, $red);  /*横*/
    imagefill($image, 0,0, $gray);
    
    imageline($image, 10,20,5,27,$red); /*箭头 */
    imageline($image, 10,20,15,27,$red); /*箭头 */
    
    imageline($image, 290,290,283,285,$red); /*箭头 */
    imageline($image, 290,290,283,295,$red); /*箭头 */
    
    for($i=1;$i<=5;$i++){
        imageline($image,10,290-$i*50,15,290-$i*50,$red);
        imageline($image,10+$i*50,290,10+$i*50,285,$red);
    }
    
    imageline($image, 10,290,60,240,$red);
    imageline($image, 60,240,110,210,$red);
    imageline($image, 110,210,160,90,$red);
    imageline($image, 160,90,210,150,$red);
    imageline($image, 210,150,260,170,$red);
    
    imagefilledellipse($image, 60,240,5,5,$red);
    imagefilledellipse($image, 110,210,5,5,$red);
    imagefilledellipse($image, 160,90,5,5,$red);
    imagefilledellipse($image, 210,150,5,5,$red);
    imagefilledellipse($image, 260,170,5,5,$red);
    
    imagestring($image,2,160,170,"(260,170)",$textcolor);
    imagestring($image,2,210,150,"(260,170)",$textcolor);
    imagestring($image,2,260,170,"(260,170)",$textcolor);
    
    
    imagepng($image);
    imagedestory($image);
?>