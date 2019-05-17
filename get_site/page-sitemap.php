<?
date_default_timezone_set("Asia/Bangkok");

$file = '../sitemap-page.xml'; 

$urls = array();

$day = date('Y-m-d\TH:i:sP', time());


$urls[] = array('https://vieclam123.vn/' , $day,  'daily', '1');
$urls[] = array('https://vieclam123.vn/tim-gia-su' , $day,  'daily', '0.9');
$urls[] = array('https://vieclam123.vn/tim-lop-gia-su' , $day,  'daily', '0.9');

$urls[] = array('https://vieclam123.vn/tat-ca-lop-hoc' , $day,  'daily', '0.7');
$urls[] = array('https://vieclam123.vn/tat-ca-giao-vien' , $day,  'daily', '0.7');

$urls[] = array('https://vieclam123.vn/cam-nang-hoc-tap.html' , $day,  'daily', '0.6');
$urls[] = array('https://vieclam123.vn/gia-su-can-biet.html' , $day,  'daily', '0.6');
$urls[] = array('https://vieclam123.vn/phu-huynh-can-biet.html' , $day,  'daily', '0.6');


$urls[] = array('https://vieclam123.vn/tong-hop-viec-lam-them' , $day,  'daily', '0.5');
$urls[] = array('https://vieclam123.vn/viec-lam-full-time' , $day,  'daily', '0.5');
$urls[] = array('https://vieclam123.vn/nguoi-tim-viec.html' , $day,  'daily', '0.5');










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

