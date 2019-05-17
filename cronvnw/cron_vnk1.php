<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  
    <!--<meta http-equiv="refresh" content="10"/>-->
</head>  
<?php    

    $conn = new mysqli('localhost', 'root', '', 'timviec365');
    $conn->set_charset('utf8');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $cron = $conn->query('SELECT vl_link FROM tbl_link_vl WHERE visited = 1 AND web_id=2 ORDER BY RAND() LIMIT 1');
    if($cron->num_rows>0){
    	$url = $cron->fetch_assoc()['vl_link'];
		$sql = "UPDATE tbl_link_vl SET visited=0 WHERE vl_link='".$url."'";
    	get_job($url);    	
        if ($conn->query($sql) === FALSE){
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        echo 'Đã quét hết tin!!!';
        //header("Location:timviec365.vn");
    }

    function get_job($url){
        require_once 'simple_html_dom_helper.php';   
        require_once 'class/rasu_function.php'; 
        require_once 'class/curl.php'; 
        require_once 'class/html_cleanup.php'; 
        $newtime = strtotime(date('d-m-Y'));

        $curl =     curl_init();
        $header[] =  "Cookie:_ga=GA1.2.1132520530.1532568712; user_on_board_ab_testing_reset=2; user_on_board_ab_testing=B; search_result_ab_testing_reset=3; search_result_ab_testing=B; gr_splitv_GLOBAL=1; homepage_ab_testing_reset=4; homepage_ab_testing=B; familiar_jobs_all_industries_ab_testing_reset=5; familiar_jobs_all_industries_ab_testing=B; search_job_title_ab_testing_reset=1; search_job_title_ab_testing=B; lang=1; PHPSESSID=47l8a2urihvpjjefhkdaeb4295; VNW128450527232960=m6Cjz26uncSKjniGas7QoJ6qoJaHin6GcaGb1JmlmZJbjHmGcpmi; VNWJSAll128450527232960=m6Cjz26uncSKjniGas7QoJ6qoJaHin6GcaGb1JmlmZJbjHmGcpmi%7C47l8a2urihvpjjefhkdaeb4295; VNWWS128450527232960=iL3E2JLJ09tzrZnDkta3n4bMrdx%2Fi4yKhr3Dnoa8rsp%2Fw53Ck9a754XJrZd0nZHBktOznoXJssqAxpnAhr2w2YXJz9p%2FrbKJhq2755LMrst1rYjNh%2BDmvKK64rBtrsCjo9HVyI%2FOnLF9ssGjs9HWvXzKmryTo7OlgL%2FVx6LL1LF6pnulfdCbvHzOnLBYnnuvpsPWu4zH06%2BTpnuvs7vTvI%2FP0bF9q7Gjo6rju4k%3D; VNWSearchJob[city]=-1; VNWSearchJob[industry]=-1; FIREBASE_JWT=eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJ2aWV0bmFtd29ya3MtbWVzc2FnZUB2aWV0bmFtd29ya3MtbWVzc2FnZS5pYW0uZ3NlcnZpY2VhY2NvdW50LmNvbSIsInN1YiI6InZpZXRuYW13b3Jrcy1tZXNzYWdlQHZpZXRuYW13b3Jrcy1tZXNzYWdlLmlhbS5nc2VydmljZWFjY291bnQuY29tIiwiYXVkIjoiaHR0cHM6XC9cL2lkZW50aXR5dG9vbGtpdC5nb29nbGVhcGlzLmNvbVwvZ29vZ2xlLmlkZW50aXR5LmlkZW50aXR5dG9vbGtpdC52MS5JZGVudGl0eVRvb2xraXQiLCJpYXQiOjE1MzMzNTA1OTgsImV4cCI6MTUzMzM1NDE5OCwidWlkIjo1MzIwOTA4fQ.fYxMZG_7DL34YV8jphEqcpz40WRFZ1VrtPmuTSyVrQDZM4l899d7loRbPUoM0iorgkOipwbHtMT-BQIlDETSzAKmpxV4JoduWIPr5KxhLGK3VH0iy6izIW5egqt4Eh1EW0MplhSdIJJJNPf92sxL-1De8Yx9jiU3ko3qhlLf0HtNKilhugVE25b8tETEBdw9FRudCezwM6fuZfYWwnOyNM57ReY4so_4H8KUbSgGRBJnFKLBMbPivvesDfXo7wl3oJgcj9aV94roatj7kxJuJoRb1n8UOAk5zH2bo-8gnlEjhAid65A_0ylAJqGNsEa67Kx1tqwiX7hthmFMh8tacQ; search_job_title_check=0; VNWSearchJob[keyword]=l%C3%A2tr; VNW_LAST_JOB_SEEN=985461%2C5320908; __sharethis_cookie_test__=1; __unam=37cc167-164df0f36f9-53322d11-25; __utma=136564663.1132520530.1532568712.1533287361.1533350348.11; __utmb=136564663.25.9.1533351230934; __utmc=136564663; __utmz=136564663.1533287361.10.2.utmcsr=jobdetail|utmccn=relevantjobs|utmcmd=rightcorner|utmcct=SmartNaviIOP; __utmv=136564663.|1=Job%20Detail%20Display=VB=1^5=Search%20Result%20Page%20Display=VB=1; _gac_UA-103236-1=1.1532568712.Cj0KCQjwv-DaBRCcARIsAI9sba9vPDnOtLFCJm3dJ-Jl51CenBrIpf1OvwyG-HDpqyIV2sE496VjOAQaAjYeEALw_wcB; gr_split_GLOBAL=A; gr_reco=164d436e824-a1b5f35191662e7b; __imaxv=399729646.1532568727.1533287362.1533350350.11; __imaxs=6.1533350350; __imaxc=1533287362.10.3.utmcsr=jobdetail|utmccn=relevantjobs|utmcmd=rightcorner|utmcct=SmartNaviIOP";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
        $data    =   curl_exec($curl);
        $html = str_get_html($data);
        //$html = file_get_html($url);        
        //Lấy thông tin nhà tuyển dụng
        $conn = new mysqli('localhost', 'root', '', 'timviec365');
        $conn->set_charset('utf8');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $cp_name = $html->find('.job-header-info a.track-event',0)->plaintext;      
        $cp_city = $html->find('.company-location', 0)->plaintext;
        $city = '';
        $citys = explode(',', $cp_city);

        foreach ($citys as $c) {
            $checks = $conn->query('SELECT cit_id FROM city WHERE cit_name ="'.replaceFCK(trim($c)).'"');
                if($checks->num_rows>0){
                $city .= $checks->fetch_assoc()['cit_id'].',';             
            }
        }
        $city = substr($city,0,-1);
       
        $cp_logo = $html->find(".col-logo img", 0)->src;

        //$cp_alias = vn_str_filter($cp_name);
        //$type_img = end(explode('/', $cp_logo));
        foreach($html->find('#company-info .summary-content') as $cpf){
            $clabel = trim($cpf->find('.content-label',0)->plaintext);
           
            if(vn_str_filter($clabel)=='dia-diem'){
                $cp_address = $cpf->find('.content',0)->plaintext;
            }
            if(vn_str_filter($clabel)=='quy-mo-cong-ty'){
                $member = $cpf->find('.content',0)->plaintext;
                $mb = explode('-',$member);
                if(count($mb)==1){
                    $mb_num = trim(preg_replace('/(trên)|(dưới)/','',$member));
                }else{
                    $mb_num = trim(end($mb));
                    $mb_num = trim(str_replace(' nhân viên', '', $mb_num));
                }
                if($mb_num>500){
                    $member = 6;
                }else if($mb_num>200){
                    $member = 5;
                }else if($mb_num>100){
                    $member = 4;
                }else if($mb_num>50){
                    $member = 3;
                }else if($mb_num>10){
                    $member = 2;
                }else if($mb_num>0){
                    $member = 1;
                }else{
                    $member = 1;
                }
            }
        }
        $cp_content = $html->find('.company-info',0)->innertext;
        $cp_content = htmlspecialr(trim($cp_content));
        $cp_content = html_clear(trim($cp_content));
        $cp_content = trim(removeHTML($cp_content));
        
        //Chi tiết tin tuyển dụng
        $title = trim($html->find('h1.job-title',0)->plaintext);
        $price = $html->find('.job-header-info .salary',0)->plaintext;
        $price = getmoney222(trim($price));
        $benefits = '';
        foreach ($html->find('.benefits .benefit-name') as $bs) {
            $benefits .= '- '.$bs->plaintext.'<br>';
        }
        $benefits = removeLink(trim($benefits));
        $html_cleanup = new html_cleanup($benefits);       
        $html_cleanup->clean();
        $benefits = $html_cleanup->output_html;     
        $benefits = str_replace("<strong>","",$benefits);
        $benefits = str_replace("</strong>","",$benefits);
        $benefits = preg_replace("/<\/?div[^>]*\>/i", "", $benefits);

        $mota = $html->find('.job-description .description',0)->innertext;
        $mota = removeLink(trim($mota));
        $html_cleanup = new html_cleanup($mota);       
        $html_cleanup->clean();
        $mota = $html_cleanup->output_html;     
        $mota = str_replace("<strong>","",$mota);
        $mota = str_replace("</strong>","",$mota);
        $mota = preg_replace("/<\/?div[^>]*\>/i", "", $mota);

        $job_requirements = $html->find('.job-requirements .requirements',0)->innertext;
        $job_requirements = removeLink(trim($job_requirements));
        $html_cleanup = new html_cleanup($job_requirements);       
        $html_cleanup->clean();
        $job_requirements = $html_cleanup->output_html;     
        $job_requirements = str_replace("<strong>","",$job_requirements);
        $job_requirements = str_replace("</strong>","",$job_requirements);
        $job_requirements = preg_replace("/<\/?div[^>]*\>/i", "", $job_requirements);
      
        foreach ($html->find('.link-list .summary-item') as $lt) {
            $label = $lt->find('.content-label',0)->plaintext;
            if(vn_str_filter($label)=='ngay-dang-tuyen'){
                $ngaydang = trim($lt->find('.content',0)->plaintext);
                $d = explode('/',$ngaydang);
                $end_day = strtotime($d[2].'-'.$d[1].'-'.$d[0]) + 86400*30;
            }
            if(vn_str_filter($label)=='cap-bac'){
                $capbac = trim($lt->find('.content',0)->plaintext);
                $ar_capbac = array(
                        "moi-tot-nghiep"    => 1,
                        "nhan-vien"         => 3,
                        "truong-phong"      => 6,
                        "giam-doc-va-cap-cao-hon"  => 7
                    );
                $capbac = $ar_capbac[vn_str_filter($capbac)];
            }
            if(vn_str_filter($label)=='nganh-nghe'){
                $ar_cate = array(
                    58 => 1,
                    1 =>  1,
                    2 => 2,
                    7 => 4,
                    64 =>  5,                 
                    36 =>  7,
                    73 =>  8,
                    27 => 14,
                    33 => 10,
                    65 => 11,
                    35 =>  13,
                    12 =>  17,
                    34 =>  18,
                    22 =>  19,
                    11 =>  21,
                    47 =>  22,
                    52 =>  23,
                    5 => 24,
                    19 =>  25,
                    55 => 26,
                    23 =>  27,
                    10 =>  28,
                    8 => 29,
                    30 =>  33,
                    37 =>  34,
                    48 => 35,
                    54 =>  36,
                    49 =>  38,
                    72 => 40,
                    4 =>  41,
                    15 => 46,
                    41 => 48,
                    28 => 49,
                    25 => 53,
                    16 => 54,
                    63 => 55,
                    42 => 56,
                    56 => 56,
                    3 => 60,
                    17 => 61,
                    26 => 62,
                    43 => 65,
                    24 => 66
                );
                $cate ='';
                foreach($lt->find('.content a') as $l){
                    $not='';
                    $lin = explode('-',trim($l->href));
                    $cate_id = str_replace('i','', $lin[count($lin)-2]);
                    if($ar_cate[$cate_id]!=''){
                        $check_cate = explode(',', substr($cate,0,-1));
                        foreach ($check_cate as $cc) {
                            if($ar_cate[$cate_id]==$cc){
                                $not = 'true';
                            }
                        }
                        if($not==''){
                            $cate .= $ar_cate[$cate_id].',';
                        }
                    }
                }
                $cate = substr($cate,0,-1);
            }
        }
             
        $html->clear();
        unset($html);
        $yeucau = 'Hồ sơ theo yêu cầu của nhà tuyển dụng khi liên hệ trực tiếp';
        $start_day = strtotime(date('Y-m-d'));
        $meta_tit = "Tuyển dụng ".$title." tại ".$cp_name." | timviec365";
        $meta_des = "Tuyển dụng việc làm ".$title." tại công ty ".$cp_name.". Việc làm ".$title." mới nhất, uy tín nhất trên Timviec365.vn."; 
        $meta_key = "Việc làm " .$title.", tuyển dụng " .$title.", Việc làm " .$title." mới nhất, ";
        $meta_more = str_replace('-',' ',vn_str_filter($title));
        $meta_key .= 'viec lam '.$meta_more.',tuyen dung '.$meta_more.',viec lam '.$meta_more.' moi nhat';
        //Array post dữ liệu
        if($cate!=''){
            $data_post = array(
                'new_title'          => $title,
                'new_cat_id'           => $cate,
                'new_chuc_vu'          => $capbac,
                'new_city'             => $city,
                'new_money_cra'        => $price,                     
                'new_han_nop'          => $end_day,   
                'new_mo_ta'            => $mota,
                'new_yeu_cau'          => $job_requirements,
                'new_lh_cra'           => '',
                'new_company_cra'      => $cp_name,
                'new_address_cra'      => $cp_address,
                'new_quyen_loi'        => $benefits,
                'new_name_user'        => '',
                'new_email_user'       => '',
                'new_phone_user'       => '',
                'new_info'             => $cp_content,
                'new_website'          => '',
                'linklogo'             => $cp_logo,
                'usc_type'             => $member,
                'new_ho_so'            => $yeucau,
                'new_exp'              => 0,
                'new_bang_cap'         => 0,
                'new_so_luong'         => 0,
                'new_hinh_thuc'        => 0,
                'meta_tit'             => $meta_tit,
                'meta_key'             => $meta_key,
                'meta_des'             => $meta_des,
                'luatweb'              => 9
                             );
            $url = 'https://timviec365.vn/cron/tu_get_data_rasu.php';
            if($title != '')
            {
                $curl = new cURL;
                echo $curl->post_no_header($url,$data_post);
            }
			/*$url1 = 'https://timviec365.com/cron/tu_get_data_rasu.php';
            if($title != '')
            {
                $curl1 = new cURL;
                echo $curl1->post_no_header($url1,$data_post);
            }*/
        }      
    }    

?>
</html>
<?php ob_end_flush(); ?>