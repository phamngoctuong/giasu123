<?
	include("config.php");
	set_time_limit(-1);
	ini_set('memory_limit',-1);
	
	function post()
	{
		$curl = 	curl_init();
	
		$url	=	'http://tuyendung.com.vn/timvieclam/194611-giam-doc-ban-marketing-dien-tu-gia-dung-dien-may.aspx';
		$header[] =	"Cookie:  .ASPXANONYMOUS=L9jaQzUK0gEkAAAAYmRlMjFkMWQtZjFjMS00ZDI0LTlkMTUtY2I4Y2Y1OTI1NTljMFZo6mdloZ-3ak6Tr9oh7eVmrAE1; ASP.NET_SessionId=ha0i1155f1oqkta0tzhvswnm; __utmt=1; __utma=147890738.2103061964.1467382713.1469672739.1469788429.5; __utmb=147890738.18.10.1469788429; __utmc=147890738; __utmz=147890738.1467382713.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); __atuvc=3%7C26%2C0%7C27%2C0%7C28%2C0%7C29%2C10%7C30; __atuvs=579b311166845858007";
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00");
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
		$data	=	curl_exec($curl);
		
		return $data;
	}

	echo post();
	