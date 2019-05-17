<?php
header('Content-Type: text/html; charset=utf-8');
function mem(){        
    //Set memcached
    $mem = new Memcached();
    $mem->addServer("127.0.0.1", 11211);        
    $pref='cv_';

    // Create connection
    $conn = new mysqli('localhost', 'root', '123456', 'db');
    $conn->set_charset('utf8');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $result = $conn->query('SELECT id,alias FROM tbl_baiviet');
    if($result->num_rows > 0) {     
        $r = array();
        while($row = mysqli_fetch_object($result)) {
            $r[] = $row;   
        }        
        $mem->set($pref.'key_news', $r); 
    }

    $result = $conn->query('SELECT * FROM tbl_chuyenmuc');    
    if($result->num_rows > 0) {     
        $r = array();
        while($row = mysqli_fetch_object($result)) {
            $r[] = $row;   
            $mem->set($pref.'key_cat_'.$row->id, $row);
        }        
        $mem->set($pref.'key_cats', $r); 
    }    

    $conn->close();
}
mem();  
?>
