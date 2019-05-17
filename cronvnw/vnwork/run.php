<?php 
header('Content-Type: text/html; charset=utf-8');
function get_link($num){
    require_once '../simple_html_dom_helper.php';  

    $htmls = file_get_html('https://careerbuilder.vn/viec-lam/tat-ca-viec-lam-trang-'.$num.'-vi.html');

    $link = array();
    foreach($htmls->find('.job a') as $el){           
        $link[] = $el->href;
    }       

    $htmls->clear();
    unset($htmls);
    foreach ($link as $lk) {
        echo $lk.'<hr>';
        //Insert link
        $conn = new mysqli('localhost', 'root', 'root', 'timviec365');
        $conn->set_charset('utf8');
        // Check connection
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        } 
        $check = $conn->query('SELECT id FROM tbl_link_vl WHERE vl_link ="'.$lk.'"');
        if($check->num_rows==0){
            $sql = "INSERT INTO tbl_link_vl (vl_link, web_id) VALUES ('$lk', 1)";
            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }else{
                echo 'Inserted: ';
            }         
        }else{
            echo 'Link đã tồn tại: ';
        }        
    }       
}    
get_link($_GET['num']);
?>