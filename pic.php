<?php 
include_once('include/config.php');
include_once('include/conn.class.php');
include_once('include/base.php');
    header("Content-Type: image/png");
     
    $q = g('q');
    $zoom = g('zoom');

    $give = explode(",", $q);
    $give2 = $give;


    //if($zoom)
        //$zoom = $zoom;
    //else{
            //$zoom = 5;  //默认放大5倍
    if($zoom == "auto"){
        /* 自动设置zoom */
        $give3 = $give;
        sort($give3);
        $max_num = $give3[count($give3)-1];
        
        if($max_num>0 and $max_num<=10)
            $zoom = 50;
        elseif($max_num >10 and $max_num<=50)
            $zoom =5;
        elseif($max_num >50 and $max_num<=100)
            $zoom =2.5;
        elseif($max_num >100 and $max_num<=200)
            $zoom = 0.5;
        elseif($max_num >200 and $max_num<=1000)
            $zoom = 0.5;
        elseif($max_num >1000 and $max_num<=2000)
            $zoom = 0.1;
        else
            $zoom = 0.01;
    }
    else
        $zoom = $zoom;
        //echo $zoom;exit;
        //}
        /* ------ */
    
    //print_r($give);exit;
    
    //$give = array(20,25,30,14,25,30,40,50,70,120,160);
    $count = count($give);
    
    $tmp = array();
    for($i=0;$i<$count;$i++)
        array_push($tmp, $give[$i]*$zoom);
    $give = $tmp;
    
    $canvas_x = 60*$count;
    $canvas_y = 60*$count;
    
    $image = imagecreatetruecolor($canvas_x, $canvas_y);
    $gray = imagecolorallocate($image, 180, 180, 180);
    $gray = imagecolorallocate($image, 159,207,169);
    $red = imagecolorallocate($image, 255, 0, 0);
    
    /* 画横坐标 */
    $o = 60*$count-10;
    imageline($image, 10, 20, 10, $o, $red);    /*纵*/
    imageline($image, 10, $o, $o, $o, $red);  /*横*/
    imagefill($image, 0,0, $gray);
    
    imageline($image, 10,20,5,27,$red); /*箭头 */
    imageline($image, 10,20,15,27,$red); /*箭头 */
    
    imageline($image, $o,$o,$o-7,$o-5,$red); /*箭头 */
    imageline($image, $o,$o,$o-7,$o+5,$red); /*箭头 */
    
    for($i=1;$i<=$count;$i++){
        imageline($image,10,$o-$i*50,15,$o-$i*50,$red);
        imageline($image,10+$i*50,$o,10+$i*50,$o-5,$red);
    }
    
    for($i=0;$i<$count;$i++){
        if($i==0){
            //imageline($image, 10+$i*50,$o,10+($i+1)*50,($o-$give[$i]),$red);
        }
        else
            imageline($image, 10+$i*50,($o-$give[$i-1]),10+($i+1)*50,($o-$give[$i]),$red);  //画线
    }

    for($i=1;$i<=$count;$i++){
        $x = 10 + $i*50;
        $y = $o-$give[$i-1];
        imagefilledellipse($image, $x, $y,5,5,$red);   //画点
    }
    
    for($i=1;$i<=$count;$i++){
        $x = 10 + $i*50;
        $y = $o-$give[$i-1]-15;
        $y1 = $give2[$i-1];
        $pot = $y1;
        imagestring($image,2,$x,$y,$pot,$textcolor);  //文字
    }
    
    for($i=1;$i<=$count;$i++){
        $x = 10 + $i*50;
        $y = $o-1;
        
        $pot = $i;
        imagestring($image,2,$x,$y,$pot,$textcolor);  //文字 横坐标
    }
    
    for($i=1;$i<=$count;$i++){
        $x = 1;
        $y = $o-$i*50;
        
        $pot = $i * 50 / $zoom;
        imagestring($image,2,$x,$y,$pot,$textcolor);  //文字 纵坐标
        
    }
    
    
    imagepng($image);
    imagedestory($image);
?>