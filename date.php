<?php if(false){ ?>
	<div id="text0">日期选择：
	<?php 
	$this_year = date('Y');
	$this_month = date('m');
	$this_day = date('d')+1;
    //echo $this_day;
	for($i=1;$i<=$this_day;$i++){
		if($i < 10)
			$day = "0" . $i;
		else
			$day = $i;
		$this_date = $this_year . $this_month . $day;
        $show_date = (int)$this_month . "月" . $i . "日";
        if(date('Ymd') == $this_date)
            echo "<a href='?'>" . "<font color=red>今天</font>" . "</a> ";
        else
            echo "<a href='?date=$this_date'>" . $show_date . "</a> ";
	}

?>
	</div>
<?php }else{ ?>
	<div id="text0">日期选择：
<?php
	$this_year = date('Y');
	$this_month = date('m');
	$this_day = date('d');
	$this_date = $this_month . "月" . $this_day . "日";
	
	
	$sql = "select * from day_sheet group by pubdate";
	$r = sql($sql);
	//print_r($r);
	if($r){
		foreach($r as $k => $v){
			
				
			echo "<a href='day.php?date=" . $v['pubdate'] . "' >" .$v['pubdate']. "</a> ";
		}
	}
?>
	</div>
<?php
}
?>