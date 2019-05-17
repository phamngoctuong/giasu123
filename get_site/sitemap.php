<?

date_default_timezone_set("Asia/Bangkok");

$file = '../sitemap.xml'; 

$url = array();
$url2 = array();
$urls = array();
$links = array();

$files=glob("../*.*");
foreach ($files as $key => $value) {
	$u = explode('.', $value);
	if(end($u) == 'xml'){
		$file_name = end(explode('/', $value));
		if ($file_name != 'sitemap.xml' && $file_name != 'sitemap-page.xml') {
			$links[] = array('https://vieclam123.vn/'.$file_name,date('Y-m-d\TH:i:sP', filemtime($value)));
		}

		if ($file_name == 'sitemap-page.xml') {
			$url[] = array('https://vieclam123.vn/'.$file_name,date('Y-m-d\TH:i:sP', filemtime($value)));
		}
	}
}

foreach ($links as $key => $value) {
        $urls[] = array($value['0'] ,$value['1'] ,  'daily', '0.7', array());	
}

foreach ($url as $key => $value) {
        $url2[] = array($value['0'] ,$value['1'] ,  'daily', '0.7', array());	
}



$xml = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="https://vieclam123.vn/css/css-sitemap.xsl"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach ($url2 as $key => $value) {	
	$xml .= '<sitemap><loc>'.$value['0'].'</loc><lastmod>'.$value['1'].'</lastmod></sitemap>';
}

foreach ($urls as $key => $value) {	
	$xml .= '<sitemap><loc>'.$value['0'].'</loc><lastmod>'.$value['1'].'</lastmod></sitemap>';
}

$xml .= '</sitemapindex>';

$fp = fopen($file,"w"); 
fputs($fp, $xml); 
fclose($fp);

echo 'done';

?>

