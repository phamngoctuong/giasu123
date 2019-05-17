<?php 
header('Content-Type: text/html; charset=utf-8');
function get_link($num){
    require_once 'simple_html_dom_helper.php';  

    $htmls = file_get_html('http://vieclam.nld.com.vn/nha-tuyen-dung/tim-sinh-vien?token=9490&p='.$num);

    $link = array();
    foreach($htmls->find('.table a') as $el){           
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
        //Lay ung vien
        $member = file_get_html('http://vieclam.nld.com.vn/'.$lk);
        foreach ($member->find('.page-body tr') as $mb){
            $label = $mb->find('td',0)->plaintext;
            $text = $mb->find('td',1)->innertext;
            echo $label.': '.$text.'<hr>';
            if(vn_str_filter($label)=='ho-ten'){
                $hoten = $text;
            }
        }
        die;
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
function vn_str_filter ($str){
    $str = trim(strtolower($str));
    $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd'=>'đ|Đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',                         
        '-'=>' |%|,|=|;|!',     
    );
    foreach($unicode as $nonUnicode=>$uni){
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }
    $str = str_replace('?','',$str);
    $str = str_replace('"','',$str);
    $str = str_replace('“','',$str);
    $str = str_replace('”','',$str);
    $str = str_replace("'",'',$str);
    $str = str_replace("---",'-',$str);
    $str = str_replace("--",'-',$str);
    return $str;
}
?>