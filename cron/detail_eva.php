<?
include("config.php");
?>
    <meta http-equiv="refresh" content="15"/>
<?
set_time_limit(0);
$db_qr = new db_query("SELECT * FROM eva_crawler JOIN luat_eva ON eva_crawler.cra_luat = luat_eva.web_id WHERE cra_type = 0 AND cra_luat = 2 ORDER BY RAND() LIMIT 1");
if(mysql_num_rows($db_qr->result) > 0)
{
   
   //Lấy tin
   $row = mysql_fetch_assoc($db_qr->result);
   echo $row['cra_link'];
   echo "<pre/>";
	$url	=	$row['cra_link'];
   if($row["cra_luat"] == 1)
   {
      $curl = 	curl_init();
   	$header[] =	"Cookie:  LOCATION=1Jtb2j7msMacELBJ6pWODtPywSiuQG5Kp%2Fiy19As7%2Fg3XxfuFTaEITT3DfQ5CYfFGlnm9eHDJf%2BGmVurYzDTDg%3D%3D; USER_ID=psbOXv3KYj2576PGbasCaXweTuJ756GhuscfY188N0d%2FYA%2Bj2uJOJDMAcZ6jxm1T7Wsa7oxw%2FqGszakjW1UtDw%3D%3D; USER_TYPE=hIwmfuVfrodg4yQiKTN%2BYcXRX1xUQA1wxCXOI2oGAwb280bOLKM9zok1WPxT411vOUEf5%2BDKj6%2By23g1TOsWuQ%3D%3D; JobListSaved=rNWZglAMXNEl%2FCKdmz55eBRG%2BbJ%2FKFIj0xEVYkzvkykzVdX2BVw1e5gNGqj0mK1ue%2B0mf4zCBB9vyI%2B4TcwiXg%3D%3D; PHPSESSID=qderori6dn67ck9ubrvr10t930; _ga=GA1.2.548085937.1480342222; _gat=1; USER_REMEMBER=QOO3nGjNK2ftKKqGf41Pyoh%2BWSBJk9hoacw3whOhf6OdX4u6pycqjkCR3p5reHMc9CyHB7lxe9b602ytNF%2BLaBEElIY4t3fGJPNpuWBzSEEHV%2BSdYe6k55idp3zlFfMk; SvID=w131|WGuPu|WGuPJ; USER=aI7ds%2BT9J2GBxvKMBN7V0D14UL8ooNo%2FV5LlSOWgxrQFT9CYsirKn24Dm44Ya%2FSp1QFsE7G2Sp%2Be9Y%2BT79%2BWJJ2O5zuI8KRiKnJ%2FcVcZZ5rkWVTPMJwxbLCHnebnnvm4WMgwH82JYCPu0MJew29CrqOexSG2SJcmZl3zsQcSgVy5VPnPqcg4qK8SsJybjPBZgqN05sXQsavezAd%2Bu03FxIs78v04zdDKiaDUhsCUepMEhQ1v3YRm8EHmVDsN0XbT729rFeWVGcPz2q9wNwXPbf8obz0kfoNCE2R2GkTVO27R0c%2B0lDo9kWDg8zW6jbVlqWe%2FpHU4Io9jeN9F4YQjOx4vmgszK6XjLREVsy6rcjPUH025LeGQColwTNFZDBFE; AMP_ECID_GOOGLE=amp-jdXPQc9skVWi-5pt_rU3hRGmm-TEXCevt2IXENssT8sa3ShQkwZE_jEfhuPi5Qb2";
   	curl_setopt($curl, CURLOPT_URL, $url);
   	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00");
   	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
   	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
   	$data	=	curl_exec($curl);
      $link = str_get_html($data);
      //Bảng luật website
      $luattitle  = $row["web_luat_title"];
      $idcra = $row["cra_id"];
      //Tiêu đề
      $chucvu = $link->find(".request-line",0);
      $tieude = $link->find(".content-body2 p",0);
      $new_title = trim($tieude->plaintext);
      $new_chuc_vu = 4;
      $diadiem = $row['cra_city_id'];
      $luong = getInfo($chucvu,".salary","/Mức lương:/");
      $luong = removeAccent(trim($luong));
      $mucluong = $array_muc_luong_tvn_ss[$luong];
      $hannop2 = $link->find(".deadline .text-danger",0);
      $hannop2 = trim($hannop2->plaintext);
      $hannop2 = strtotime(trim($hannop2));
      //Mô tả công việc
      $mota = $link->find("#collapseOne .center-p24p12",0)->innertext;
      $mota = removeLink(trim($mota));
      $html_cleanup = new html_cleanup($mota);		 
      $html_cleanup->clean();
      $mota = $html_cleanup->output_html;
      //Yêu cầu khác
      $yeucau = $link->find("#collapseTwo .center-p24p12",0)->innertext;
      $yeucau = removeLink(trim($yeucau));
      $html_cleanup2 = new html_cleanup($yeucau);		 
      $html_cleanup2->clean();
      $yeucau = $html_cleanup2->output_html;
      //Quyen loi
      $quyenloi = $link->find("#collapseFour .center-p24p12",0)->innertext;
      $quyenloi = removeLink(trim($quyenloi));
      $html_cleanup1 = new html_cleanup($quyenloi);		 
      $html_cleanup1->clean();
      $quyenloi = $html_cleanup1->output_html;
      //Quyen loi
      $hoso = $link->find("#collapseThree .center-p24p12",0)->innertext;
      $hoso = removeLink(trim($hoso));
      $html_cleanup3 = new html_cleanup($hoso);		 
      $html_cleanup3->clean();
      $hoso = $html_cleanup3->output_html;
      $hoso = str_replace("Timviecnhanh.com","123Viec.com",$hoso);
      //Thông tin liên hệ
      $chucvu = $link->find("#collapseLienhe .line17",0);
      $nguoilh = getInfo($chucvu,"li","/Người liên hệ:/");
            
      $nguoilh = removeHTML(removeLink(trim($nguoilh)));
      //Địa chỉ
      $diachi    = getInfo($chucvu,"li","/Địa chỉ:/");
      $diachi    = removeHTML(removeLink(trim($diachi)));
      //Email 
      $email    = getInfo($chucvu,"li","/Email:/");
      $email    = removeHTML(trim($email));
      if($email)
      {
         $checkemail = 1;
      }
      else
      {
         $checkemail = 0;
      }      
      //Điện thoại
      $phone    = getInfo($chucvu,"li","/Điện thoại:/");
      $phone    = removeHTML(trim($phone));
      $phone = trim($phone,"-");
      $didong = getInfo($chucvu,"li","/Di động:/");
      $didong    = removeHTML(trim($didong));
      $phone = $phone." - ".$didong;
      $phone = trim($phone,"-");
      //Tên công ty
      $tencongty = $link->find(".company-work",0);
      $tencongty = $tencongty->plaintext;
      $tencongty = removeHTML(trim($tencongty));
      $company = $link->find("#accordion",0)->next_sibling();
      $linkcompany = $company->find("strong a",0)->href;
      $link2 = file_get_html($linkcompany);
      //Get info công ty
      $info = $link2->find("#show-description span",0)->innertext;
      $info = removeLink(trim($info));
      //Get website
      $com = $link2->find(".line17",0);
      $website = getInfo3($com,"li","/Website:/");
      $website    = removeHTML(trim($website));
      $quymo_ct = getInfo($com,"li","/Quy mô:/");
      $quymo_ct    = removeHTML(trim($quymo_ct));
      $quymo_ct = $array_quy_mo_ss[$quymo_ct];
      $linklogo = $link2->find(".clearfix img",0)->src;
      //Hiển thị dữ liệu lấy được
      $nganhnghe = $link->find(".careers a",0)->plaintext;
      $nganhnghe = $array_nganhnghe_ss[trim($nganhnghe)];
      $new_cat_id = $nganhnghe;
      //Kinh nghiem
      $kinhnghiem2 = $link->find(".request-line",0);
      $kinhnghiem=  getInfo($kinhnghiem2,".exp","/Kinh nghiệm:/");
      $kinhnghiem = removeAccent(trim($kinhnghiem));
      $kinhnghiem = $array_kinh_nghiem_24h_ss[$kinhnghiem];
      $trinhdo = getInfo($kinhnghiem2,".level","/Trình độ:/");
      $trinhdo = removeAccent(trim($trinhdo));
      $trinhdo = $array_hoc_van_24h_ss[$trinhdo];
      $gioitinh = getInfo($kinhnghiem2,".sexual","/Giới tính:/");
      $gioitinh = trim($gioitinh);
      $soluong = getInfo($kinhnghiem2,".numb","/Số lượng tuyển dụng:/");
      $soluong = trim($soluong);
      $hinhthuc = getInfo($kinhnghiem2,".form","/Hình thức:/");
      $hinhthuc = removeAccent(trim($hinhthuc));
      $hinhthuc = $array_hinh_thuc_tvn_ss[$hinhthuc];
   }
   if($row['cra_luat'] == 2)
   {
      $link = file_get_html($url);
      //Bảng luật website
      $luattitle  = $row["web_luat_title"];
      $idcra = $row["cra_id"];
      //Tiêu đềư
      $chucvu = $link->find("#main-left .viecchitiet",0);
      $tieude = getInfo($chucvu,".view-rutgon tr","/Vị trí tuyển dụng:/");
      $new_title  = trim($tieude);
      $new_chuc_vu = $chucvu->find(".postd4[0] .br-L[0]",0);
      $new_chuc_vu = $new_chuc_vu->plaintext;
      $new_chuc_vu = removeAccent(trim(html_entity_decode($new_chuc_vu)));
      $new_chuc_vu = $array_capbac_tv_ss[html_entity_decode($new_chuc_vu)];
      //Địa điểm
      $diadiem = $chucvu->find(".postd4",1);
      $diadiem = $diadiem->find(".br-L",0)->plaintext;
      $diadiem = trim($diadiem);
      $diadiem = explode(",",$diadiem);
      $diadiem = $diadiem[0];
      $diadiem = trim($diadiem);
      $db_qrr = new db_query("SELECT * FROM city WHERE cit_name = '".$diadiem."'"); 
      $row2 = mysql_fetch_assoc($db_qrr->result);
      $diadiem = $row2["cit_id"];
      //Mức lương
      $luong = $chucvu->find(".postd4",2);
      $luong = $luong->find(".br-L",0)->plaintext;
      $luong = removeAccent(trim($luong));
      $mucluong = $array_muc_luong_tv_ss[trim(html_entity_decode($luong))];
      //Hạn nộp
      $hannop2 = getInfo($chucvu,".view-rutgon tr","/Hạn nộp HS:/");
      $hannop2 = trim($hannop2);
      $hannop2 = str_replace('/', '-', $hannop2);
      $hannop2 = strtotime(trim($hannop2));
      //Mô tả công việc
      $mota = $link->find(".mota-cv",0);
      $mota = $mota->find("td",1)->innertext;
      $mota = removeLink(trim($mota));
      $html_cleanup = new html_cleanup($mota);		 
      $html_cleanup->clean();
      $mota = $html_cleanup->output_html;
      //Quyen loi
      $quyenloi = $link->find(".mota-cv",1);
      $quyenloi = $quyenloi->find("td",1)->innertext;
      $quyenloi = removeLink(trim($quyenloi));
      $html_cleanup1 = new html_cleanup($quyenloi);		 
      $html_cleanup1->clean();
      $quyenloi = $html_cleanup1->output_html;
      //Yêu cầu khác
      $yeucau = $link->find(".mota-cv",2);
      $yeucau = $yeucau->find("td",1)->innertext;
      $yeucau = removeLink(trim($yeucau));
      $html_cleanup2 = new html_cleanup($yeucau);		 
      $html_cleanup2->clean();
      $yeucau = $html_cleanup2->output_html;
      //Quyen loi
      $hoso = $link->find(".mota-cv",3);
      $hoso = $hoso->find("td",1)->innertext;
      $hoso = removeLink(trim($hoso));
      $html_cleanup3 = new html_cleanup($hoso);		 
      $html_cleanup3->clean();
      $hoso = $html_cleanup3->output_html;
      //Thông tin liên hệ
      $chucvu2 = $link->find("#main-left .viecchitiet",1);
      $nguoilh = getInfo($chucvu2,"tr","/Người liên hệ:/");
      $nguoilh = removeHTML(removeLink(trim($nguoilh)));
      //Địa chỉ
      $diachi    = getInfo($chucvu2,"tr","/Địa chỉ liên hệ:/");
      $diachi    = removeHTML(removeLink(trim($diachi)));
      //Email 
      $email    = getInfo($chucvu2,"tr","/Email liên hệ:/");
      $email    = removeHTML(trim($email));
      if($email)
      {
         $checkemail = 1;
      }
      else
      {
         $checkemail = 0;
      } 
      //Điện thoại
      $phone    = getInfo($chucvu2,"tr","/Điện thoại liên hệ:/");
      $phone    = removeHTML(trim($phone));
      $phone = trim($phone,"-");
      //Tên công ty
      $chucvu3 = $link->find("#main-left .viecchitiet",2);
      $tencongty = getInfo($chucvu3,"tr","/Tên công ty:/");
      $tencongty = removeHTML(trim($tencongty));
      if($diachi == '')
      {
         $diachi = $chucvu3->find("tr",1);
         $diachi = $diachi->find("td",1)->plaintext;
         $diachi = trim($diachi);
      }
      //Get info công ty
      $info = getInfo($chucvu3,"tr","/Giới thiệu:/");
      $info = removeLink(trim($info));
      //Get website
      $website = $chucvu3->find("tr",2);
      $website = $website->find("td",1)->plaintext;
      $website = removeHTML(trim($website));
      $quymo_ct = 0;
      if($chucvu3->find("img",0))
      {
      $linklogo = $chucvu3->find("img",0)->src;
      $linklogo = trim($linklogo);
      }
      else
      {
         $linklogo = '';      
      }
      if($linklogo != '')
      {
         $linklogo = "http://vieclam.tv".$linklogo;
      }
      //Hiển thị dữ liệu lấy được
      $new_cat_id = $row['cra_cat_id'];
      //Kinh nghiem
      $kinhnghiem=  getInfo($chucvu,"tr","/Kinh nghiệm tối thiểu:/");
      $kinhnghiem = removeAccent(trim(htmlentities($kinhnghiem)));
      if(isset($array_kinh_nghiem_24h_ss[$kinhnghiem]))
      {
         $kinhnghiem = $array_kinh_nghiem_24h_ss[$kinhnghiem];
      }
      else if(isset($array_kinh_nghiem_ss[$kinhnghiem]))
      {
         $kinhnghiem = $array_kinh_nghiem_ss[$kinhnghiem];
      }
      else
      {
         $kinhnghiem = 0;
      }
      $trinhdo = $chucvu->find(".postd4",2);
      $trinhdo = $trinhdo->find(".br-L",1)->plaintext;
      $trinhdo = removeAccent(trim($trinhdo));
      $trinhdo = $array_hoc_van_24h_ss[$trinhdo];
      $gioitinh = $chucvu->find(".postd4",0);
      $gioitinh = $gioitinh->find(".br-L",1)->plaintext;
      $gioitinh = trim($gioitinh);
//      $soluong = getInfo($kinhnghiem2,".numb","/S? lu?ng tuy?n d?ng:/");
      $soluong = 0;
      $hinhthuc = getInfo($chucvu,"tr","/Hình thức làm việc:/");
      $hinhthuc = removeAccent(trim($hinhthuc));
      $hinhthuc = $array_hinh_thuc_24h_ss[$hinhthuc];
      
   }
   $new_title = mb_strtolower($new_title,'UTF-8');
   $new_title = mb_convert_case($new_title, MB_CASE_TITLE, "UTF-8");
   echo "Tiêu đề :".$new_title."<hr>";
   echo "Chức vụ :".$new_chuc_vu."<hr>";
   echo "Địa điểm :".$diadiem."<hr>";
   echo "Mức lương :".$mucluong."<hr>";
   echo "Hạn nộp :".$hannop2."<hr>";
   echo "Mô tả :".$mota."<hr>";
   echo "Quyền lợi :".$quyenloi."<hr>";
   echo "Yêu cầu :".$yeucau."<hr>";
   echo "Hồ sơ :".$hoso."<hr>";
   echo "Thông tin liên hệ :".$nguoilh."<hr>";
   echo "Email :".$email."<hr>";
   echo "Điện thoại:".$phone."<hr>";
   echo "Tên công ty :".$tencongty."<hr>";
   echo "Info :".$info."<hr>";
   echo "Địa chỉ :".$diachi."<hr>";
   echo "Website :".$website."<hr>";
   echo "Quy mô :".$quymo_ct."<hr>";
   echo "Logo :".$linklogo."<hr>";
   echo "Ngành nghề :".$new_cat_id."<hr>";
   echo "Kinh nghiệm :".$kinhnghiem."<hr>";
   echo "Trình độ :".$trinhdo."<hr>";
   echo "Giới tính :".$gioitinh."<hr>";
   echo "Số lượng :".$soluong."<hr>";
   echo "Hình thức :".$hinhthuc."<hr>";
   
   //Array post dữ liệu
   $data_post = array('new_title'           => $new_title,
                     'new_cat_id'           => $new_cat_id,
                     'new_chuc_vu'          => $new_chuc_vu,
                     'new_city'             => $diadiem,
                     'new_money_cra'        => $mucluong,                     
                     'new_han_nop'          => $hannop2,   
                     'new_mo_ta'            => $mota,
                     'new_yeu_cau'          => $yeucau,
                     'new_quyen_loi'        => $quyenloi,
                     'new_ho_so'            => $hoso,
                     'new_name_user'        => $nguoilh,
                     'new_email_user'       => $email,
                     'new_phone_user'       => $phone,
                     'new_company_cra'      => $tencongty,
                     'new_info'             => $info,
                     'new_address_cra'      => $diachi,
                     'new_website'          => $website,
                     'usc_type'             => $quymo_ct,
                     'linklogo'             => $linklogo,
                     'new_exp'              => $kinhnghiem,
                     'new_bang_cap'         => $trinhdo,
                     'new_gioitinh'         => $gioitinh,
                     'new_so_luong'         => $soluong,
                     'new_hinh_thuc'        => $hinhthuc,
                     'luatweb'              => $row['cra_luat']
                     );
$url = 'https://123viec.com/cron/geteva.php';   
if($mucluong > 0  && $hannop2 > time() && $new_cat_id > 0)
{
   if($checkemail == 1 || $phone != '')
   {
      $curl = new cURL;
      echo $curl->post_no_header($url,$data_post);
   }
}
$db_ex6 = new db_execute("UPDATE eva_crawler SET cra_type = 1 WHERE cra_id = ".$idcra."");  
unset($db_ex6);
}
else
{
   $db_ex6 = new db_execute("UPDATE link_eva SET lin_active = 0");  
   header("Location:link_eva.php");
}

function getInfo($linkab, $att_title,$label){
   $title = '';    
   $value = '';
   foreach($linkab->find($att_title) as $e){
   	$title = $e->plaintext;
   	if(preg_match($label,$title))
   	{
   	$title = explode(':',$title);
   	$value = $title[1];
   	break;
   	}   
   }
   return $value;
}
function getInfo2($linkab, $att_title,$label){
   $title = '';    
   $value = '';
   foreach($linkab->find($att_title) as $e){
   	$title = $e->plaintext;
      $title = str_replace("/","-",$title);
   	if(preg_match($label,$title))
   	{
   	$title = explode(':',$title);
   	$value = $title[1];
   	break;
   	}   
   }
   return $value;
}
function getInfo3($linkab, $att_title,$label){
   $title = '';    
   $value = '';
   foreach($linkab->find($att_title) as $e){
   	$title = $e->plaintext;
      $title = str_replace("/","-",$title);
   	if(preg_match($label,$title))
   	{
   	$title = explode(':',$title);
      if(isset($title[2]))
      {
         $value = $title[1].$title[2];
      }
   	else
      {
         $value = $title[1];
      }
   	break;
   	}   
   }
   return $value;
}
function getLocation($linkab, $att_title,$label){
   $title = '';    
   $value = '';
   foreach($linkab->find($att_title) as $e){
     $title = decodeHtmlEnt($e->innertext);	  
   }
   return $title;
}   
?>