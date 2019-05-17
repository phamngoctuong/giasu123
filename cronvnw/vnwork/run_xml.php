<meta http-equiv="refresh" content="86400"/>
<?php 
header('Content-Type: text/html; charset=utf-8');
function get_link(){
    require_once '../simple_html_dom_helper.php';  

    $link = getlinkfromxmlsitemap('https://www.vietnamworks.com/sitemap/jobs.xml');
	$j=0;
	$k=0;
	
	echo '<hr>';
    for($i=count($link);$i>=0;$i--) {
        $lk = $link[$i];
        echo $lk.'<hr>';
        //Insert link
        $conn = new mysqli('localhost',  'root', '', 'timviec6');
        $conn->set_charset('utf8');
        // Check connection
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        } 
        $check = $conn->query('SELECT id FROM tbl_link_vl WHERE vl_link ="'.$lk.'"');
        if($check->num_rows==0){
			$k++;
            $sql = "INSERT INTO tbl_link_vl (vl_link, web_id) VALUES ('$lk', 2)";
            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
            }else{
                echo 'Inserted: ';
            }         
        }else{
            echo 'Link đã tồn tại: ';
			if($j==10){
                break;
            }
            $j++;
        }        
    }     
	echo 'Tong tin lay ve: '.$k;	
}    
get_link();
function getlinkfromxmlsitemap($sUrl) {
    // echo "Get link from: $sUrl<br>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
    //curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0");
    curl_setopt($ch, CURLOPT_URL, $sUrl);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    $error= curl_error($ch);
    curl_close($ch);
    $links = array();
	//var_dump($data);die;
    $listcard = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $data);
    $listcard = new SimpleXMLElement($listcard);
    $count = json_decode(json_encode((array)$listcard), TRUE);

    foreach ($count['url'] as $c) {
        $type = explode('-',$c['loc']);
        if($type[count($type)-1]=='jv'){
            $links[] = $c['loc'];
        }
    }
    return $links;  
}
function getlinkfromxmlsitemap1($sUrl) {
    // echo "Get link from: $sUrl<br>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0");
    curl_setopt($ch, CURLOPT_URL, $sUrl);
    $data = curl_exec($ch);
    $error= curl_error($ch);
    curl_close($ch);
    $links = array();
    $count = preg_match_all('@<loc>(.+?)<\/loc>@', $data, $matches);
    for ($i = 0; $i < $count; $i++) {
        $ls = strip_tags($matches[0][$i]);
        $type = explode('-',$ls);
        if($type[count($type)-1]=='jv'){
            $links[] = $matches[0][$i];
        }
    }
	var_dump($data);die;
    return $links;  
}
?>