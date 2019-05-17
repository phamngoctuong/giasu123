<?
	include("config.php");
	$curl = 	curl_init();
   $url = 'https://m.vieclameva.com/tuyen-nhan-vien-ban-hang-tai-ha-noi-ha-noi-737487.html';
	$header[] =	"Cookie:  PHPSESSID=tufq8mrbbvutt63j896h80lev5; USER_REMEMBER=2BIsGHM0SwYPA95LHLFh30gL; USER_ID=7CQvaz5X6NiARWRfmtNyBzsLKMM%2FnBRRwpf8%2FWhky4HR8HjVkrtFEHxvC9xq1EPCtgvSL8GX2%2FgqlvXGouxMxw%3D%3D; USER_TYPE=%2B613AMBSz1UUeGs69ybVl4oCJIPFGVoC2L3thvlVifsFcQsJzQS%2FpCVmSerwFQcOdRNL13P0rr55ntzlcb06og%3D%3D; JobListSaved=r3d2rXrHNnoG4qmwzjFFkzkfvaCTunsP9GK08Yj2BAFu%2BQlhgOY4iAntluAJU5cdBjcar8n42JPkcEKRDOwi7g%3D%3D; LOCATION=F9%2BoQtxZemq2auYmgd2k6XKLono0NhQ2HPJ7WFrNldSbSCpToZHUdXVDu7if2B8CPqbNKji3Uq2711yX4YE7EA%3D%3D; job_search_form=dc%2BH9E%2BW9eli1Go8VO2WYEtfU6uIbEzQlNQFtN5Iln8qz5cS9xn3KHB7rGejQwNH0tu%2FYrNbRfNs1m7kpDzueBvDC9EHUQQdrJ4ucbXE4goTvQjDU7gfnL5Qpqtn7UAOpBxiI4tHDpozTADor%2BF3lHzTdAAKbChUze3x7phIevHPj%2BqZPPFrJZAS5yCd%2FcTJpaMmqrk30tYQ92pMbp4%2B4A%3D%3D; _gat=1; SvID=w132|WBsPQ|WBsDL; _ga=GA1.2.930036796.1474442350";
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00");
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
	$data	=	curl_exec($curl);
   $link = str_get_html($data);
	echo $link;
?>