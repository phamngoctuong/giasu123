<?
$keyword = 'việc làm 24h';
$url = '123viec.com';
$lang = 'vi';
echo g_serp($keyword,$url,$lang);
 
//helper function -- file_get_contents using curl
function file_get_contents_curl($url, $referer='', $ua='')
    {
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if ($referer!='') {
        curl_setopt($ch, CURLOPT_REFERER, $referer);
    }
 
    if ($ua!='') {
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
	}
 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $data=curl_exec($ch);
    curl_close ($ch);
 
    return $data;
    }
 
//this is the main function
function g_serp($keyword, $url, $lang)
{
	$g_url='http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q='.urlencode($keyword).
			'&rsz=large&hl='.$lang;
   echo $g_url;
	for ($i = 0; $i < 64; $i+=8)
	{
		$start=$i;
 
		$referer='http://localhost/'; //change this into your real domain
		$rawdata=file_get_contents_curl($g_url.'&start='.$start, $referer, $_SERVER['HTTP_USER_AGENT']);
		$decoded=json_decode($rawdata, TRUE); //decode as assoc array
		
 
		if (is_array($decoded['responseData']['results']))
		{
			
			$pos = $start;
			foreach ($decoded['responseData']['results'] as $result) {
				if (substr_count(strtolower ($result['url']), $url))
				{
					$res['position']=$pos+1;
					$res['title']=$result['titleNoFormatting'];
					$res['url']=$result['unescapedUrl'];
 
					return $res;
				}
 
				$pos++;
			}
		}
	}
   
}
?>