<?
include('config.php');
$url = "https://mywork.com.vn/tuyen-dung/6/ke-toan-kiem-toan.html/trang/1#list_job";
$curl = 	curl_init();
$header[] =	'Cookie:';
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/63.4.160 Chrome/57.4.2987.160 Safari/537.36");
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
$data	=	curl_exec($curl);
$data = str_replace("|","",$data);
$data = str_get_html($data);
echo $data;

?>