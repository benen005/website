<?php
// *************** PHP7 START ***************  
if(!function_exists('mysql_connect')){
    function mysql_connect($host,$user,$passwd){
        return mysqli_connect($host,$user,$passwd);
    }
 
    function mysql_select_db($dbname,$conn){
        return mysqli_select_db($conn,$dbname);
    }
 
    function mysql_errno($cxn=null){
        return mysqli_errno($cxn);
    }
 
    function mysql_error($cxn=null){
        return mysqli_error($cxn);
    }
 
    function mysql_fetch_array($result){
        return mysqli_fetch_array($result);
    }
 
    function mysql_fetch_assoc($result){
        return mysqli_fetch_assoc($result);
    }
 
    function mysql_fetch_row($result){
        return mysqli_fetch_row($result);
    }
 
    function mysql_insert_id(){
        global $conn;
        return mysqli_insert_id($conn);
    }
 
    function mysql_num_rows($result){
        return mysqli_num_rows($result);
    }
 
    function mysql_query($sql){
        global $conn;
        return mysqli_query($conn,$sql);
    }
 
    function mysql_real_escape_string($data){
        return mysqli_real_escape_string($cxn,$data);
    }
 
    function  mysql_get_server_info($cxn){
        return  mysqli_get_server_info($cxn);
    }
 
    function mysql_ping($cxn){
        return mysqli_ping($cxn);
    }
}
?>

