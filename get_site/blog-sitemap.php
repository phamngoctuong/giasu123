<?
date_default_timezone_set("Asia/Bangkok");
$day = date('Y-m-d\TH:i:sP', time());
$curentPage = 250;


$conn = new mysqli('localhost', 'timviec365_tvlt', 'Longtt@132', 'timviec365_giasum');
$conn->set_charset('utf8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$numrow =  $conn->query('SELECT id FROM baiviet WHERE status=1');
$numcount = $numrow->num_rows;

$nb_file = $numcount/$curentPage;

$nb_file = (int)$nb_file + 1;

for ($i=0; $i < $nb_file ; $i++) { 
    $start = $i * $curentPage;
    $urls = array();

    // 250 link bài viết blog

    $result = $conn->query("SELECT id, alias, created_day,content  FROM baiviet ORDER BY id DESC LIMIT ".$start.",".$curentPage);  

    while($row = mysqli_fetch_object($result)) {
            $time = strtotime($row->created_day);
            $day = date('Y-m-d\TH:i:sP', $time);

            $link = "https://vieclam123.vn/".$row->alias."-b".$row->id.".html";
            preg_match_all('/<img[^>]+src=(?:\"|\')\K(.[^">]+?)(?=\"|\')/', $row->content, $imgs);
            $imgs = $imgs[1];
            $imgs = array_unique($imgs);
            $urls[] = array($link , $day,  'daily', '0.5',$imgs);

        unset($imgs);
    }
    //cấu trúc sitemap
    $xml = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="https://vieclam123.vn/css/css-sitemap.xsl"?>
    <urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $key => $value) { 
        $xml .= '<url><loc>'.$value['0'].'</loc><lastmod>'.$value['1'].'</lastmod><changefreq>'.$value['2'].'</changefreq><priority>'.$value['3'].'</priority>';
        if (count($value['4']) > 0) {
            foreach ($value['4'] as $keys => $values) {
                $xml .= '<image:image><image:loc>https://timviec365.vn'.$values.'</image:loc></image:image>';
            }
        }
        $xml .= '</url>';
    }
    $xml .= '</urlset>';
    $stt_file = ($i == 0) ? '':$i;
    $file =  '../sitemap-blog'.$stt_file.'.xml';
    $fp = fopen($file,"w"); 
    fputs($fp, $xml); 
    fclose($fp);
    unset($xml,$url);
}

echo 'done';

?>

