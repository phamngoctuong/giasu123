<?
include("function_rewrite.php");
date_default_timezone_set("Asia/Bangkok");

$file = '../sitemap-search2.xml'; 


$conn = new mysqli('localhost', 'timviec365_tvlt', 'Longtt@132', 'timviec365_giasum');

$conn->set_charset('utf8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$link = '';
$links = '';

$urls = array();

$day = date('Y-m-d\TH:i:sP', time());


$city = array();
$subject = array();
$lophoc = array();


$result = $conn->query('select * FROM city ORDER BY `cit_name`');
while($row = mysqli_fetch_assoc($result)) {
      $city[$row['cit_id']] = $row;
}

$result_sj = $conn->query('select * FROM subject');
while($row_sj = mysqli_fetch_assoc($result_sj)) {
      $subject[$row_sj['ID']] = $row_sj;
}

$result_lh = $conn->query('select * FROM lophoc');
while($row_lh = mysqli_fetch_assoc($result_lh)) {
      $lophoc[$row_lh['id']] = $row_lh;
}





foreach ($lophoc as $key_lh => $item_lh) {
  foreach ($city as $key => $item) {
    foreach ($subject as $key_sj => $item_sj) {
      $array = explode(',', $item_sj['areaclass']);
      if (in_array($item_lh['id'], $array)) {
        $link = searchhome(2,$item_sj['ID'],$item['cit_id'],$item_lh['id'],$city,$subject,$lophoc);
        $urls[] = array($link , $day,  'daily', '0.6',array());
      }
      unset($array);
    }
  }
}




$xml = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="https://vieclam123.vn/css/css-sitemap.xsl"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach ($urls as $key => $value) {	
	$xml .= '<url><loc>'.$value['0'].'</loc><lastmod>'.$value['1'].'</lastmod><changefreq>'.$value['2'].'</changefreq><priority>'.$value['3'].'</priority></url>';
}

$xml .= '</urlset>';

$fp = fopen($file,"w"); 
fputs($fp, $xml); 
fclose($fp);

echo 'done';

?>

