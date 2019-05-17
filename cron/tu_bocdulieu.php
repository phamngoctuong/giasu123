<?
include("config.php");
?>
     <meta http-equiv="refresh" content="10"/>
<?
set_time_limit(-1);
ini_set('memory_limit',-1);
$db_qr = new db_query("SELECT * FROM crawler JOIN luatwebsite ON crawler.cra_luat = luatwebsite.web_id WHERE cra_type = 0 ORDER BY RAND() DESC LIMIT 1");
if(mysql_num_rows($db_qr->result) > 0)
{
   //Lấy tin
   $row = mysql_fetch_assoc($db_qr->result);
   //$link = file_get_contents($row['cra_link']);
   //echo $link;
  echo $row['cra_link'];
  if($row['cra_luat'] == 8 || $row['cra_luat'] == 7)
  {
   $curl = 	curl_init();
   $header[] =	"Cookie:";
   curl_setopt($curl, CURLOPT_URL, $row['cra_link']);
   curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00");
   curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
   $data	=	curl_exec($curl);
   $link = str_get_html($data);
  }
  else
  {
   $link = file_get_html($row['cra_link']);
  }
   //Bảng luật website
   $luattitle  = $row["web_luat_title"];
   $luatchucvu = $row["web_luat_chuc_vu"];
   $idcra = $row["cra_id"];
   $new_cat_id = $row["cra_cat_id"];
   //Tiêu đề
   if(preg_match("/nha-tuyen-dung/",$row['cra_link']))
   {
      $db_ex6 = new db_execute("UPDATE crawler SET cra_type = 1 WHERE cra_id = ".$idcra."");  
      exit();
   }
   $tieude = $link->find($luattitle,0);
   $new_title = trim($tieude->plaintext);
   $new_title = mb_strtolower($new_title,'UTF-8');
   $new_title = mb_convert_case($new_title, MB_CASE_TITLE, "UTF-8");
   if($row['cra_luat'] == 8)
   {
      //Chức vụ
      $chucvu = $link->find($luatchucvu,0);
      $new_chuc_vu = getInfo($chucvu,"li","/Chức vụ:/");
      $new_chuc_vu = trim($new_chuc_vu);
      $new_chuc_vu = decodeHtmlEnt($new_chuc_vu);
      $new_chuc_vu = removeAccent($new_chuc_vu);
      $new_chuc_vu = $array_capbac_24h_ss[$new_chuc_vu];
      //Số lượng
      $soluong = getInfo5($chucvu,"li","/Số lượng cần tuyển:/");
      $soluong = trim($soluong);
//      //Trình độ
      $trinhdo = getInfo5($chucvu,"li","/Yêu cầu bằng cấp:/");
      $trinhdo = removeAccent(trim($trinhdo));
      $trinhdo = $array_hoc_van_24h_ss[$trinhdo];
//      //Hình thức
      $hinhthuc = getInfo5($chucvu,"li","/Hình thức làm việc:/");
      $hinhthuc = $array_hinh_thuc_24h_ss[removeAccent(trim(decodeHtmlEnt($hinhthuc)))];
//      //Kinh nghiệm
      $kinhnghiem = getInfo5($chucvu,"li","/Kinh nghiệm:/");
      $kinhnghiem = removeAccent(trim($kinhnghiem));
      $kinhnghiem = $array_kinh_nghiem_24h_ss[$kinhnghiem];
//      //Địa điểm làm việc 
      $diadiem = getInfo5($chucvu,"li","/Địa điểm làm việc:/");
      $diadiem = explode(",",$diadiem);
      $diadiem = $diadiem[0];    
      $html_cleanup = new html_cleanup(trim($diadiem));		 
      $html_cleanup->clean();
      $diadiem = $html_cleanup->output_html;
      if($diadiem == 'TP.HCM')
      {
         $diadiem = "Hồ Chí Minh";
      }
      $db_qrr = new db_query("SELECT * FROM city WHERE cit_name = '".$diadiem."'"); 
      $row2 = mysql_fetch_assoc($db_qrr->result);
      $diadiem = $row2["cit_id"];
//      //Mức lương
      $luong = getInfo5($chucvu,"li","/Mức lương:/");
      $mucluong =  getmoney222(trim($luong));
//      //Hạn nộp
      $chucvu2 = $link->find(".block-sub-content",0)->plaintext;
      $hannop = explode(":",$chucvu2);
      $hannop2 = $hannop[1];
      $hannop2 = str_replace('/', '-', $hannop2);
      $hannop2 = strtotime(trim($hannop2));
//      //Mô tả công việc
      $mota = $link->find(".dataOne",0)->innertext;
      $mota = removeLink(trim($mota));
      $html_cleanup = new html_cleanup($mota);		 
      $html_cleanup->clean();
      $mota = $html_cleanup->output_html;	  
      $mota = str_replace("<strong>","",$mota);
      $mota = str_replace("</strong>","",$mota);
      $mota = str_replace("<div>","<p>",$mota);
      $mota = str_replace("</div>","</p>",$mota);
      $mota = strip_tags($mota,"<br><p>");
      $thongtin_lh = '';
//      //Quyen loi
      $quyenloi = $link->find(".dataOne",1)->innertext;
      $quyenloi = removeLink(trim($quyenloi));
      $html_cleanup1 = new html_cleanup($quyenloi);		 
      $html_cleanup1->clean();
      $quyenloi = $html_cleanup1->output_html;
      $quyenloi = str_replace("<strong>","",$quyenloi);
      $quyenloi = str_replace("</strong>","",$quyenloi);
      $quyenloi = str_replace("<div>","<p>",$quyenloi);
      $quyenloi = str_replace("</div>","</p>",$quyenloi);
      $quyenloi = strip_tags($quyenloi,"<br><p>");
//      //Yêu cầu khác
      $yeucau = $link->find(".dataOne",2)->innertext;
      $yeucau = removeLink(trim($yeucau));
      $html_cleanup2 = new html_cleanup($yeucau);		 
      $html_cleanup2->clean();
      $yeucau = $html_cleanup2->output_html;	
      $yeucau = str_replace("<strong>","",$yeucau);
      $yeucau = str_replace("</strong>","",$yeucau);
      $yeucau = str_replace("<div>","<p>",$yeucau);
      $yeucau = str_replace("</div>","</p>",$yeucau);
      $yeucau = strip_tags($yeucau,"<br><p>");
//      //Yêu cầu hồ sơ
//      //Yêu cầu khác
//      $yeucauhs = $link->find(".desjob-company",4)->innertext;
//      $yeucauhs = str_replace("Yêu cầu công việc","",$yeucauhs);
//      $yeucauhs = removeLink(trim($yeucauhs));
//      $html_cleanup3 = new html_cleanup($yeucauhs);		 
//      $html_cleanup3->clean();
//      $yeucauhs = $html_cleanup3->output_html;	
//      $yeucauhs = str_replace("<strong>","",$yeucauhs);
//      $yeucauhs = str_replace("</strong>","",$yeucauhs);
//      $yeucauhs = str_replace("<div>","<p>",$yeucauhs);
//      $yeucauhs = str_replace("</div>","</p>",$yeucauhs);
//      $yeucauhs = strip_tags($yeucauhs,"<br><p>");
      $yeucauhs = '';
//      //Thông tin liên hệ
      $nguoilh = $link->find(".box-white-ttlh p",0)->plaintext;
      $nguoilh = removeHTML(removeLink(trim($nguoilh)));
      $nguoilh = explode(":",$nguoilh);
      $nguoilh = $nguoilh[1];
      $nguoilh = trim($nguoilh);
//      ////Địa chỉ
      $diachi    = $link->find(".box-white-ttlh p",1)->plaintext;
      $diachi    = removeHTML(removeLink(trim($diachi)));
      $diachi = explode(":",$diachi);
      $diachi = $diachi[1];
      $diachi = trim($diachi);
//      //Tên công ty
      $tencongty = $link->find(".company-work",0)->plaintext;
      $tencongty = removeHTML(trim($tencongty));
      $tencongty = mb_strtolower($tencongty,'UTF-8');
//      //Info công ty
      $linkcom = $link->find("a.colorBlack",0)->href;
      $linkcom = str_replace("m.vieclam24h.vn","vieclam24h.vn",$linkcom);
      $curl = 	curl_init();
      $header[] =	"Cookie:";
      curl_setopt($curl, CURLOPT_URL, $linkcom);
      curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:7.0.1) Gecko/20100101 Firefox/7.0.12011-10-16 20:23:00");
      curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
      $data	=	curl_exec($curl);
      $linkgetcom = str_get_html($data);
      if($linkgetcom->find(".company-description",0))
      {
        $info = $linkgetcom->find(".company-description",0)->plaintext;
        $info = trim(removeHTML($info)); 
      }
      else
      {
         $info = '';
      }
      $email = '';
      if($email != '')
      {
         $checkemail = 1;
      }
      else
      {
         $checkemail = 0;
      }  
//      //Điện thoại
      $ccinfo = $linkgetcom->find(".box_chi_tiet_nha_tuyen_dung",0);
      $ccsdt = getInfo5($ccinfo,".mb_4","/Điện thoại:/");
      $phone = trim($ccsdt);
//      //Quy mô công ty
      $quymo_ct = getInfo($ccinfo,".mb_4","/ Quy mô công ty:/");
      if($quymo_ct != '')
      {
         $quymo_ct    = removeHTML(trim(decodeHtmlEnt($quymo_ct)));
         $quymo_ct = $array_quy_mo_tv_ss[$quymo_ct];
      }
      else
      {
         $quymo_ct = 0;
      }
//      //Email 
//      if($link->find(".boxcontact-copmpany table tr",5))
//      {
//         $email    = $link->find(".boxcontact-copmpany table tr",5)->plaintext;
//         $email    = removeHTML(trim($email));
//         $email    = removeHTML(removeLink(trim($email)));
//         $email = explode(":",$email);
//         $email = $email[1];
//         $email = trim($email);
//      } 
//      else 
//      {
//         $pattern = '/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i';
//         if(preg_match($pattern,$mota,$matches))
//         {
//            $email = $matches[0];
//            $email = replaceMQ($email);
//            $email = trim($email);
//         }
//         else if(preg_match($pattern,$yeucau,$matches))
//         {
//            $email = $matches[0];
//            $email = replaceMQ($email);
//            $email = trim($email);
//         }
//         else if(preg_match($pattern,$quyenloi,$matches))
//         {
//            $email = $matches[0];
//            $email = replaceMQ($email);
//            $email = trim($email);
//         }
//         else if(preg_match($pattern,$yeucauhs,$matches))
//         {
//            $email = $matches[0];
//            $email = replaceMQ($email);
//            $email = trim($email);
//         }
//         else if(preg_match($pattern,$info,$matches))
//         {
//            $email = $matches[0];
//            $email = replaceMQ($email);
//            $email = trim($email);
//         }
//         else
//         {
//            $email = '';
//         }
//      }
//      //Website
      $website    = getInfo4($ccinfo,".mb_4","/Website:/");
      $website    = removeHTML(removeLink(trim($website)));
      $website = trim($website);
      echo "<br>";
      $linklogo = $linkgetcom->find(".logo-company img",0)->src;
      echo $linklogo;
      echo "<br>";
   }
   else if($row['cra_luat'] == 7)
   {
      //Chức vụ
      $chucvu = $link->find($luatchucvu,0);
      $cv = $link->find(".job_detail_general",0);
      $new_chuc_vu = getInfo($cv,"p","/Chức vụ/");
      $new_chuc_vu = trim($new_chuc_vu);
      $new_chuc_vu = decodeHtmlEnt($new_chuc_vu);
      $new_chuc_vu = removeAccent($new_chuc_vu);
      $new_chuc_vu = $array_capbac_mywork_ss[$new_chuc_vu];
      //Số lượng
      $soluong = getInfo($cv,"p","/Số lượng cần tuyển/");
      $soluong = trim($soluong);
      //Trình độ
      $trinhdo = getInfo($cv,"p","/Yêu cầu bằng cấp/");
      $trinhdo = removeAccent(trim($trinhdo));
      $trinhdo = $array_hoc_van_24h_ss[$trinhdo];
      //Hình thức
      $hinhthuc = getInfo($cv,"p","/Hình thức làm việc/");
      $hinhthuc = removeAccent(trim($hinhthuc));
      $hinhthuc = $array_hinh_thuc_24h_ss[$hinhthuc];
      //Kinh nghiệm
      $kinhnghiem = getInfo($cv,"p","/Kinh nghiệm/");
      $kinhnghiem = removeAccent(trim($kinhnghiem));
      $kinhnghiem = $array_kinh_nghiem_24h_ss[$kinhnghiem];
      //Địa điểm làm việc 
      $diadiem = $link->find(".location_tag a",0)->plaintext;
      $diadiem = trim($diadiem);
      $html_cleanup = new html_cleanup(trim($diadiem));		 
      $html_cleanup->clean();
      $diadiem = $html_cleanup->output_html;
      $diadiem = explode(",",$diadiem);
      $diadiem = $diadiem[0];
      $diadiem = trim($diadiem);
      $db_qrr = new db_query("SELECT * FROM city WHERE cit_name = '".$diadiem."'"); 
      $row2 = mysql_fetch_assoc($db_qrr->result);
      $diadiem = $row2["cit_id"];
      //Mức lương
      $luong = $link->find(".text_red",0)->plaintext;
      $mucluong =  getmoney222(trim($luong));
      //Hạn nộp
      $chucvu2 = $link->find("#detail-el",0);
      $hannop2 = getInfo6($chucvu2,"p","/Hạn nộp hồ sơ/");
      $hannop2 = removeHTML($hannop2);
      $hannop2 = htmlentities($hannop2, null, 'utf-8');
      $hannop2 = str_replace("&nbsp;", "", $hannop2);
      $hannop2 = html_entity_decode($hannop2);
      $hannop2 = str_replace('/','-',trim($hannop2));
      $hannop2 = strtotime(trim($hannop2));
      //Mô tả công việc
      $mota = $link->find(".multiple .mw-box-item",2)->innertext;
      $mota = str_replace("Mô tả công việc","",$mota);
      $mota = removeLink(trim($mota));
      $html_cleanup = new html_cleanup($mota);		 
      $html_cleanup->clean();
      $mota = $html_cleanup->output_html;	  
      $mota = str_replace("<strong>","",$mota);
      $mota = str_replace("</strong>","",$mota);
      $mota = str_replace("<div>","<p>",$mota);
      $mota = str_replace("</div>","</p>",$mota);
      $mota = strip_tags($mota,"<br><p>");
      $thongtin_lh = '';
      //Quyen loi
      $quyenloi = $link->find(".multiple .mw-box-item",3)->innertext;
      $quyenloi = str_replace("Quyền lợi được hưởng","",$quyenloi);
      $quyenloi = removeLink(trim($quyenloi));
      $html_cleanup1 = new html_cleanup($quyenloi);		 
      $html_cleanup1->clean();
      $quyenloi = $html_cleanup1->output_html;
      $quyenloi = str_replace("<strong>","",$quyenloi);
      $quyenloi = str_replace("</strong>","",$quyenloi);
      $quyenloi = str_replace("<div>","<p>",$quyenloi);
      $quyenloi = str_replace("</div>","</p>",$quyenloi);
      $quyenloi = strip_tags($quyenloi,"<br><p>");
      //Yêu cầu khác
      $yeucau = $link->find(".multiple .mw-box-item",4)->innertext;
      $yeucau = str_replace("Yêu cầu công việc","",$yeucau);
      $yeucau = removeLink(trim($yeucau));
      $html_cleanup2 = new html_cleanup($yeucau);		 
      $html_cleanup2->clean();
      $yeucau = $html_cleanup2->output_html;	
      $yeucau = str_replace("<strong>","",$yeucau);
      $yeucau = str_replace("</strong>","",$yeucau);
      $yeucau = str_replace("<div>","<p>",$yeucau);
      $yeucau = str_replace("</div>","</p>",$yeucau);
      $yeucau = strip_tags($yeucau,"<br><p>");
      //Yêu cầu hồ sơ
      //Yêu cầu khác
      $yeucauhs = $link->find(".multiple .mw-box-item",5)->innertext;
      $yeucauhs = str_replace("Yêu cầu công việc","",$yeucauhs);
      $yeucauhs = removeLink(trim($yeucauhs));
      $html_cleanup3 = new html_cleanup($yeucauhs);		 
      $html_cleanup3->clean();
      $yeucauhs = $html_cleanup3->output_html;	
      $yeucauhs = str_replace("<strong>","",$yeucauhs);
      $yeucauhs = str_replace("</strong>","",$yeucauhs);
      $yeucauhs = str_replace("<div>","<p>",$yeucauhs);
      $yeucauhs = str_replace("</div>","</p>",$yeucauhs);
      $yeucauhs = strip_tags($yeucauhs,"<br><p>");
      //Thông tin liên hệ
      $nguoilh = $link->find(".box-contact .row",0)->plaintext;
      $nguoilh = removeHTML(removeLink(trim($nguoilh)));
      $nguoilh = explode(":",$nguoilh);
      $nguoilh = $nguoilh[1];
      $nguoilh = trim($nguoilh);
      ////Địa chỉ
      $diachi    = $link->find(".box-contact .row",3)->plaintext;
      $diachi    = removeHTML(removeLink(trim($diachi)));
      $diachi = explode(":",$diachi);
      $diachi = $diachi[1];
      $diachi = trim($diachi);
      //Tên công ty
      $tencongty = $link->find(".desc-for-title span",0)->plaintext;
      $tencongty = removeHTML(trim($tencongty));
      $tencongty = mb_strtolower($tencongty,'UTF-8');
      //Info công ty
      $linkcom = $link->find(".capitalize",0)->href;
      $linkcom = "https://mywork.com.vn".$linkcom;
      $linkgetcom = file_get_html($linkcom);
      if($linkgetcom->find(".col-md-8 .box_general .mw-box-item div",0))
      {
        $info = $linkgetcom->find(".col-md-8 .box_general .mw-box-item div",0)->plaintext;
        $info = trim(removeHTML($info)); 
      }
      else
      {
         $info = '';
      }
      if($info == '')
      {
         if($linkgetcom->find("#company-info",0))
         {
            $info = $linkgetcom->find("#company-info",0)->innertext();
            $info = removeLink($info);
         }
      }
      //Quy mô công ty
      $quymo_ct = getInfo($linkgetcom,"p","/Số nhân viên:/");
      if($quymo_ct != '')
      {
         $quymo_ct    = removeHTML(trim(decodeHtmlEnt($quymo_ct)));
         $quymo_ct = $array_quy_mo_mywork_ss[$quymo_ct];
      }
      else
      {
         $quymo_ct = 0;
      }
      //Email 
      if($link->find(".box-contact .row",1))
      {
         $email    = $link->find(".box-contact .row",1)->plaintext;
         $email    = removeHTML(trim($email));
         $email    = removeHTML(removeLink(trim($email)));
         $email = explode(":",$email);
         $email = $email[1];
         $email = trim($email);
      } 
      if($email == '')
      {
         $pattern = '/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i';
         if(preg_match($pattern,$mota,$matches))
         {
            $email = $matches[0];
            $email = replaceMQ($email);
            $email = trim($email);
         }
         else if(preg_match($pattern,$yeucau,$matches))
         {
            $email = $matches[0];
            $email = replaceMQ($email);
            $email = trim($email);
         }
         else if(preg_match($pattern,$quyenloi,$matches))
         {
            $email = $matches[0];
            $email = replaceMQ($email);
            $email = trim($email);
         }
         else if(preg_match($pattern,$yeucauhs,$matches))
         {
            $email = $matches[0];
            $email = replaceMQ($email);
            $email = trim($email);
         }
         else if(preg_match($pattern,$info,$matches))
         {
            $email = $matches[0];
            $email = replaceMQ($email);
            $email = trim($email);
         }
         else
         {
            $email = '';
         }
      }
      if($email != '')
      {
         $checkemail = 1;
      }
      else
      {
         $checkemail = 0;
      }  
      //Điện thoại
      $phone = $link->find(".box-contact .row",2)->plaintext;
      $phone    = removeHTML(trim($phone));
      $phone    = removeHTML(removeLink(trim($phone)));
      if($phone != '')
      {
         $phone = explode(":",$phone);
         $phone = $phone[1];
      }
      //Website
      $website    = getInfo($linkgetcom,"p","/Website:/");
      $website    = removeHTML(removeLink(trim($website)));
      $website = trim($website);
      echo "<br>";
      $linklogo = $link->find("meta[itemprop='image']",0)->src;
      $linklogo = str_replace("company-logo-medium","company-logo",$linklogo);
      echo "<br>";
   }
   if($row['cra_luat'] == 6)
   {
      //Chức vụ
      $chucvu = $link->find($luatchucvu,1);
      $yeucauhs = '';
      $new_chuc_vu = 4;
      $new_chuc_vu = getInfo($chucvu,"li","/Cấp bậc/");
      $new_chuc_vu = $array_capbac_ss[removeAccent(trim($new_chuc_vu))]; 
      //Số lượng
      $soluong = 0;
      //Trình độ
      $trinhdo = getInfo($chucvu,"li","/Trình độ học vấn:/");
      $trinhdo = removeAccent(trim(decodeHtmlEnt($trinhdo)));
      $trinhdo = $array_hoc_van_ss[$trinhdo];
      //Hình thức
      $hinhthuc = getInfo($chucvu,"li","/Loại công việc:/");
      $hinhthuc = removeAccent(trim(decodeHtmlEnt($hinhthuc)));
      $hinhthuc = $array_hinh_thuc_ss[$hinhthuc];
      //Kinh nghiệm
      $kinhnghiem = getInfo($chucvu,"li","/Mức kinh nghiệm:/");
      $kinhnghiem = removeAccent(trim(decodeHtmlEnt($kinhnghiem)));
      $kinhnghiem = $array_kinh_nghiem_ss[$kinhnghiem];
      //Địa điểm làm việc 
      $diadiem = getLocation($chucvu,"li ul li a","/Nơi làm việc/"); 
      $diadiem = removeLink(trim($diadiem));
      $html_cleanup = new html_cleanup(trim($diadiem));		 
      $html_cleanup->clean();
      $diadiem = $html_cleanup->output_html;
      $diadiem = explode(",",$diadiem);
      $diadiem = $diadiem[0];
      $diadiem = trim($diadiem);
      $db_qrr = new db_query("SELECT * FROM city WHERE cit_name = '".$diadiem."'"); 
      $row2 = mysql_fetch_assoc($db_qrr->result);
      $diadiem = $row2["cit_id"];
      //Mức lương
      $luong = $link->find(".job-data .list-unstyled",0);
       
      $mucluong = getInfo($luong,"li","/Lương:/");
      $mucluong =  getmoney222(trim($mucluong));
     
      //Mô tả công việc
      $mota = $link->find($row["web_mo_ta"],0)->next_sibling()->outertext;
      $mota = removeLink(trim($mota));
      $html_cleanup = new html_cleanup($mota);		 
      $html_cleanup->clean();
      $mota = $html_cleanup->output_html;	  
      $mota = str_replace("<strong>","",$mota);
      $mota = str_replace("</strong>","",$mota);
      $mota = preg_replace("/<\/?div[^>]*\>/i", "", $mota);                 
      $quyenloi = '';
      //Yêu cầu khác
      $yeucau = $link->find($row["web_yeu_cau"],1)->next_sibling()->outertext;
      $yeucau = removeLink(trim($yeucau));
      $html_cleanup2 = new html_cleanup($yeucau);		 
      $html_cleanup2->clean();
      $yeucau = $html_cleanup2->output_html;	
      $yeucau = str_replace("<strong>","",$yeucau);
      $yeucau = str_replace("</strong>","",$yeucau);
      $yeucau = str_replace("<div>","",$yeucau);
      $yeucau = str_replace("</div>","",$yeucau);      
      //Hạn nộp
      $hannop = $link->find($row["web_han_nop"]);
      $hannop2 = $link->find("dd",1)->plaintext;
      $hannop2 = str_replace('/', '-', $hannop2);
      $hannop2 = strtotime(trim($hannop2));
      //Thông tin liên hệ
      $thongtin_lh = '';
      $thongtin_cl0 = $link->find($row["web_lien_he"],2);     
      $thongtin_cl = removeHTML($thongtin_cl0);
      
      //Người liên hệ
      $nguoilh = $link->find(".job-side-data .list-unstyled",0);
      $nguoilh = getInfo($nguoilh,"li","/Tên liên hệ:/");
      $nguoilh = removeHTML(removeLink(trim($nguoilh)));
      //Quy mô
      $quymo_ct = $link->find(".job-side-data .list-unstyled",0);
      $quymo_ct = getInfo($quymo_ct,"li","/Số nhân viên:/");
      $quymo_ct = removeHTML(removeLink(trim($quymo_ct)));
      $quymo_ct = removeAccent($quymo_ct);
      $quymo_ct = $array_quy_mo_car_ss[$quymo_ct];
      //
      //Email 
      $email    = getmail($thongtin_cl);
      if($email != '')
      {
         $email = $email[0];
      }
      else{
         $email = '';
      }
      $email = trim($email);
      if($email)
      {
         $checkemail = 1;
      }
      else
      {
         $checkemail = 0;
      }  
      //Điện thoại
      $phone    = getInfo($thongtin_cl0,"li","/Điện thoại liên lạc:/");
      $phone    = removeHTML(trim($phone));
      if(isset($phone))
      {
         $phone = $phone;
      }
      else
      {
         $phone = '';
      }
      //Tên công ty
      $tencongty = $link->find(".critical-job-data li",0);
      $tencongty = $tencongty->plaintext;
      $tencongty = trim($tencongty);
      //Địa chỉ
      $diachi    = $link->find(".critical-job-data li",1);
      $diachi    = $diachi->plaintext;
      $diachi    = trim($diachi);
      //Info công ty
      $info = $link->find(".job-side-data .list-unstyled",0)->next_sibling()->innertext;
      $info = removeLink(trim($info));
      $html_cleanup3 = new html_cleanup($info);		 
      $html_cleanup3->clean();
      $info = $html_cleanup3->output_html;	
      $info = str_replace("<strong>","",$info);
      $info = str_replace("</strong>","",$info);
      $info = str_replace("<div>","<p>",$info);
      $info = str_replace("</div>","</p>",$info);
      $info = strip_tags($info,"<br><p>");
      //Website
      $website = $link->find(".job-side-data .company-name",0)->next_sibling()->plaintext;
      $website = trim($website);
      echo "<br>";
      $linklogo = $link->find('.job-side-data .text-center img',0)->src;
      $linklogo = "http://www.careerlink.vn".$linklogo;
      echo $linklogo;
      echo "<br>";
   }
   if($row["cra_luat"] == 5)
   {
      $chucvu = $link->find($luatchucvu,0);
      $new_chuc_vu =  3;
      //Địa điểm làm việc
      $diadiem = getInfo2($chucvu,".row","/Địa điểm làm việc:/");
      $diadiem = trim($diadiem);
      $diadiem = htmlentities($diadiem, null, 'utf-8');
      $diadiem = preg_replace("/&nbsp;/",'',$diadiem);
      $diadiem = html_entity_decode($diadiem);
      $diadiem = explode(",",$diadiem);
      $diadiem = $diadiem[0];
      if($diadiem == 'Tp. Hồ Chí Minh')
      {
         $diadiem = 'Hồ Chí Minh';
      }
      $db_qrr = new db_query("SELECT * FROM city WHERE cit_name = '".$diadiem."'"); 
      $row2 = mysql_fetch_assoc($db_qrr->result);
      $diadiem = $row2["cit_id"];
      //Mức lương
      if(isset($link->find('#cphMainContent_pnNegotiableSalary',0)->plaintext))
      {
         $mucluong = 1;
      }
      else
      {
         $luongmin = $link->find("#cphMainContent_lblMinSalary",0)->plaintext;
         $luongmin = trim($luongmin);
         $luongmax = $link->find("#cphMainContent_lblMaxSalary",0)->plaintext;
         $luongmax = trim($luongmax);
         $mucluong = arrss($luongmin,$luongmax);
      }
      //Hạn nộp
      $chucvu2 = $link->find($luatchucvu,1);
      $hannop  = getInfo2($chucvu2,".row","/Hạn nộp HS:/");
      $hannop2 = str_replace('/', '-', $hannop);
      $hannop2 = strtotime(trim($hannop2));
      //Mô tả công việc
      $mota = $link->find("#cphMainContent_lblDescription",0)->innertext;
      $mota = removeLink(trim($mota));
      $html_cleanup = new html_cleanup($mota);		 
      $html_cleanup->clean();
      $mota = $html_cleanup->output_html;	  
      $mota = str_replace("<strong>","",$mota);
      $mota = str_replace("</strong>","",$mota);
      $mota = str_replace("<div>","<p>",$mota);
      $mota = str_replace("</div>","</p>",$mota);
      $mota = strip_tags($mota,"<br><p>");
      //Quyen loi
      $quyenloi = $link->find("#cphMainContent_lblOtherAdvanced",0)->innertext;
      $quyenloi = removeLink(trim($quyenloi));
      $html_cleanup1 = new html_cleanup($quyenloi);		 
      $html_cleanup1->clean();
      $quyenloi = $html_cleanup1->output_html;
      $quyenloi = str_replace("<strong>","",$quyenloi);
      $quyenloi = str_replace("</strong>","",$quyenloi);
      $quyenloi = str_replace("<div>","<p>",$quyenloi);
      $quyenloi = str_replace("</div>","</p>",$quyenloi);
      $quyenloi = strip_tags($quyenloi,"<br><p>");
      //Yêu cầu khác
      $yeucau = $link->find("#cphMainContent_lblRequirements",0)->innertext;
      $yeucau = removeLink(trim($yeucau));
      $html_cleanup2 = new html_cleanup($yeucau);		 
      $html_cleanup2->clean();
      $yeucau = $html_cleanup2->output_html;	
      $yeucau = str_replace("<strong>","",$yeucau);
      $yeucau = str_replace("</strong>","",$yeucau);
      $yeucau = str_replace("<div>","<p>",$yeucau);
      $yeucau = str_replace("</div>","</p>",$yeucau);
      $yeucau = strip_tags($yeucau,"<br><p>");
      //Thông tin liên hệ
      $nguoilh = $link->find("#cphMainContent_lblContactPerson",0)->innertext;
      $nguoilh = removeHTML(removeLink(trim($nguoilh)));
      ////Địa chỉ
      $diachi    = $link->find("#cphMainContent_lblContactAddress",0)->innertext;
      $diachi    = removeHTML(removeLink(trim($diachi)));
      $thongtin_lh = '';
      //Email 
      $email    = $link->find("#cphMainContent_lblContactEmail",0)->innertext;
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
      $phone    = $link->find("#cphMainContent_lblContactPhone",0)->innertext;
      $phone    = removeHTML(trim($phone));
      //Tên công ty
      $tencongty = $link->find(".building",0)->innertext;
      $tencongty = removeHTML(trim($tencongty));
      $tencongty = mb_strtolower($tencongty,'UTF-8');
      //Info công ty
      $info = '';
      //Website
      $website    = $link->find(".website a",0)->innertext;
      $website    = removeHTML(trim($website));
      echo "<br>";
      $linklogo = $link->find("#cphMainContent_imgCompany_Logo",0)->src;
      $linklogo = "http://vieclam.laodong.com.vn".$linklogo;
      echo $linklogo;
      echo "<br>";
      //Số lượng
      $soluong = 0;
      //Trình độ
      $trinhdo = 0;
      //Hình thức
      $hinhthuc = 0;
      //Kinh nghiệm
      $kinhnghiem = 0;
      //Yêu cầu hồ sơ
      $yeucauhs = '';
      $quymo_ct = 0;
   }
   if($row["cra_luat"] == 4)
   {
      $chucvu = $link->find($luatchucvu,0);
      $new_chuc_vu = 3;
      //Địa điểm làm việc
      $diadiem = $link->find("#content form table tr p[class=text_normal]",4)->plaintext;
      $diadiem = trim($diadiem);
      $diadiem = htmlentities($diadiem, null, 'utf-8');
      $diadiem = preg_replace("/&nbsp;/",'',$diadiem);
      $diadiem = html_entity_decode($diadiem);
      $diadiem = explode(",",$diadiem);
      $diadiem = $diadiem[0];
      if($diadiem == 'TP. Hồ Chí Minh')
      {
         $diadiem = 'Hồ Chí Minh';
      }
      $db_qrr = new db_query("SELECT * FROM city WHERE cit_name = '".$diadiem."'"); 
      $row2 = mysql_fetch_assoc($db_qrr->result);
      $diadiem = $row2["cit_id"];
      //Mức lương
      $mucluong = $link->find("#content form table tr p[class=text_normal]",5)->plaintext;
      $mucluong = trim($mucluong);
      $mucluong = decodeHtmlEnt($mucluong);
      $mucluong = trim($mucluong,"\t\n\r\0\x0B\xC2\xA0");
      $mucluong = preg_replace("[^\p{L}\s]",'',$mucluong);
      echo $mucluong;
      if($mucluong == 'Thỏa Thuận')
      {
         $mucluong = 1;
      }
      else if($mucluong == 'Thỏa thuận')
      {
         $mucluong = 1;
      }
      else if($mucluong == 'Cạnh Tranh')
      {
         $mucluong = 1;
      }
      else if($mucluong == 'Cạnh tranh')
      {
         $mucluong = 1;
      }
      else
      {
         
         $mucluong = explode(",",$mucluong);
         $mucluong = $mucluong[0];
         $mucluong = mb_strtolower($mucluong,'UTF-8');
         $mucluong = getmoney222(trim($mucluong));
      }
      //Hạn nộp
      $hannop = $link->find("#content form table tr p[class=text_normal]",10)->plaintext;
      $hannop2 = str_replace('/', '-', $hannop);
      $hannop2 = strtotime(trim($hannop2));
      //Mô tả công việc
      $mota = $link->find("#content form table tr div[class=text_normal]",0)->innertext;
      $mota = removeLink(trim($mota));
      $html_cleanup = new html_cleanup($mota);		 
      $html_cleanup->clean();
      $mota = $html_cleanup->output_html;	  
      $mota = str_replace("<strong>","",$mota);
      $mota = str_replace("</strong>","",$mota);
      $mota = str_replace("<div>","<p>",$mota);
      $mota = str_replace("</div>","</p>",$mota);
      $mota = strip_tags($mota,"<br><p>");
      //Quyen loi
      $quyenloi = $link->find("#content form table tr div[class=text_normal]",1)->innertext;
      $quyenloi = removeLink(trim($quyenloi));
      $html_cleanup1 = new html_cleanup($quyenloi);		 
      $html_cleanup1->clean();
      $quyenloi = $html_cleanup1->output_html;
      $quyenloi = str_replace("<strong>","",$quyenloi);
      $quyenloi = str_replace("</strong>","",$quyenloi);
      $quyenloi = str_replace("<div>","<p>",$quyenloi);
      $quyenloi = str_replace("</div>","</p>",$quyenloi);
      $quyenloi = strip_tags($quyenloi,"<br><p>");
      //Yêu cầu khác
      $yeucau = $link->find("#content form table tr div[class=text_normal]",3)->innertext;
      $yeucau = removeLink(trim($yeucau));
      $html_cleanup2 = new html_cleanup($yeucau);		 
      $html_cleanup2->clean();
      $yeucau = $html_cleanup2->output_html;	
      $yeucau = str_replace("<strong>","",$yeucau);
      $yeucau = str_replace("</strong>","",$yeucau);
      $yeucau = str_replace("<div>","<p>",$yeucau);
      $yeucau = str_replace("</div>","</p>",$yeucau);
      $yeucau = strip_tags($yeucau,"<br><p>");
      //Thông tin liên hệ
      $nguoilh = $link->find("#content form table tr p[class=text_normal]",12)->innertext;
      $nguoilh = removeHTML(removeLink(trim($nguoilh)));
      ////Địa chỉ
      $diachi    = $link->find("#content form table tr div[class=text_normal]",5)->innertext;
      $diachi    = removeHTML(removeLink(trim($diachi)));
      $thongtin_lh = '';
      //Email 
      $email    = $link->find("#content form table tr p[class=text_normal]",13)->innertext;
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
      $phone    = $link->find("#content form table tr p[class=text_normal]",14)->innertext;
      $phone    = removeHTML(trim($phone));
      //Tên công ty
      $tencongty = $link->find("#content form table tr p[class=text_normal]",15)->innertext;
      $tencongty = removeHTML(trim($tencongty));
      $tencongty = mb_strtolower($tencongty,'UTF-8');
      //Info công ty
      $info = $link->find("#content form table tr div[class=text_normal]",6)->innertext;
      $info = removeLink(trim($info));
      $html_cleanup3 = new html_cleanup($info);		 
      $html_cleanup3->clean();
      $info = $html_cleanup3->output_html;	
      $info = str_replace("<strong>","",$info);
      $info = str_replace("</strong>","",$info);
      $info = str_replace("<div>","<p>",$info);
      $info = str_replace("</div>","</p>",$info);
      $info = strip_tags($info,"<br><p>");
      //Website
      $website    = $link->find("#content form table tr p[class=text_normal]",16)->innertext;
      $website    = removeHTML(trim($website));
	   $linklogo = '';
   }
   if($row["cra_luat"] == 3)
   {
      $chucvu = $link->find($luatchucvu,0);
      $new_chuc_vu =  3;
      //Số lượng
      $soluong = getInfo2($chucvu,".m-b-5","/- Số lượng tuyển dụng:/");
      $soluong = trim($soluong);
      //Trình độ
      $trinhdo = getInfo2($chucvu,".m-b-5","/- Trình độ:/");
      $trinhdo = removeAccent(trim(decodeHtmlEnt($trinhdo)));
      $trinhdo = $array_hoc_van_24h_ss[$trinhdo];
      //Hình thức
      $hinhthuc = getInfo2($chucvu,".m-b-5","/- Hình thức làm việc:/");
      $hinhthuc = removeAccent(trim(decodeHtmlEnt($hinhthuc)));
      $hinhthuc = $array_hinh_thuc_tvn_ss[$hinhthuc];
      //Kinh nghiệm
      $kinhnghiem = getInfo2($chucvu,".m-b-5","/- Kinh nghiệm:/");
      $kinhnghiem = removeAccent(trim(decodeHtmlEnt($kinhnghiem)));
      $kinhnghiem = $array_kinh_nghiem_24h_ss[$kinhnghiem];
      //Yêu cầu hồ sơ
      $yeucauhs = '';
      //Địa điểm làm việc 
      $diadiem = getInfo2($chucvu,".m-b-5","/- Tỉnh-Thành phố:/");
      $diadiem = explode(",",$diadiem);
      $diadiem = $diadiem[0];
      $diadiem = str_replace("Việc làm ","",$diadiem);
      $diadiem = trim($diadiem);
      $db_qrr = new db_query("SELECT * FROM city WHERE cit_name = '".$diadiem."'"); 
      $row2 = mysql_fetch_assoc($db_qrr->result);
      $diadiem = $row2["cit_id"];
      //Mức lương
      $luong = getInfo($chucvu,".m-b-5","/- Mức lương:/");
      $luong = removeAccent(trim($luong));
      $mucluong = $array_muc_luong_tvn_ss[$luong];
      //Hạn nộp
      $hannop = $link->find($row["web_han_nop"],0);
      $hannop = removeHTML($hannop);
      $hannop2 = str_replace('/', '-', $hannop);
      $hannop2 = strtotime(trim($hannop2));
      //Mô tả công việc
      $mota = $link->find(".block-content table td",1)->innertext;
      $mota = removeLink(trim($mota));
      $html_cleanup = new html_cleanup($mota);		 
      $html_cleanup->clean();
      $mota = $html_cleanup->output_html;	  
      //Quyen loi
      $quyenloi = $link->find(".block-content table td",5)->innertext;
      $quyenloi = removeLink(trim($quyenloi));
      $html_cleanup1 = new html_cleanup($quyenloi);		 
      $html_cleanup1->clean();
      $quyenloi = $html_cleanup1->output_html;	
      //Yêu cầu khác
      $yeucau = $link->find(".block-content table td",3)->innertext;
      $yeucau = removeLink(trim($yeucau));
      $html_cleanup2 = new html_cleanup($yeucau);		 
      $html_cleanup2->clean();
      $yeucau = $html_cleanup2->output_html;
      //Thông tin liên hệ
      $nguoilh = $link->find(".block-info-company .block-content .width-100 tr td",1)->innertext;
      $nguoilh = removeHTML(removeLink(trim($nguoilh)));
      //Địa chỉ
      $diachi    = $link->find(".block-info-company .block-content .width-100 tr td",3)->innertext;
      $diachi    = removeHTML(removeLink(trim($diachi)));
      $thongtin_lh = '';
      //Email 
      if($link->find(".block-info-company .block-content .width-100 tr td",5))
      {
        $email    = $link->find(".block-info-company .block-content .width-100 tr td",5)->innertext;
        $email    = removeHTML(trim($email)); 
      }
      else
      {
         $email = '';
      }
      if($email)
      {
         $checkemail = 1;
      }
      else
      {
         $checkemail = 0;
      }      
      $linkcom = $link->find("#employer-viewall a",0)->href;
      $linkgetcom = file_get_html($linkcom);
      //Điện thoại
      if($link->find(".block-info-company .block-content .width-100 tr td",7))
      {
         $phone    = $link->find(".block-info-company .block-content .width-100 tr td",7)->innertext;
         $phone    = removeHTML(trim($phone));
      }
      else
      {
         $phone = getInfo($linkgetcom,'.summay-company p','/Điện thoại:/');
      }
      //Tên công ty
      $tencongty = $link->find(".block-content h3",0);
      $tencongty = $tencongty->plaintext;
      $tencongty = removeHTML(trim($tencongty));
      $info = $linkgetcom->find(".summay-company p",-1);
      $info = trim($info);
      $info = removeLink($info);
      $website = getInfo4($linkgetcom,'.summay-company p','/Website:/');;
      echo "<br>";
      echo $linklogo = $link->find(".sidebar .block-sidebar img",0)->src;
      echo "<br>";
      $quymo_ct = 0;
   }
   //Hiển thị dữ liệu lấy được
   echo "Tiêu đề :".$new_title."<hr>";
   echo "Chức vụ :".$new_chuc_vu."<hr>";
   echo "Địa điểm :".$diadiem."<hr>";
   echo "Mức lương :".$mucluong."<hr>";
   echo "Quyền lợi :".$quyenloi."<hr>";
   echo "Hạn nộp :".$hannop2."<hr>";
   echo "Mô tả :".$mota."<hr>";
   echo "Yêu cầu :".$yeucau."<hr>";
   echo "Thông tin liên hệ :".$nguoilh."<hr>";
   echo "Tên công ty :".$tencongty."<hr>";
   echo "Địa chỉ :".$diachi."<hr>";
   echo "Email :".$email."<hr>";
   echo "Điện thoại :".$phone."<hr>";
   echo "Info :".$info."<hr>";
   echo "Website :".$website."<hr>";
   echo "Hồ sơ :".$yeucauhs."<hr>";
   echo "Website :".$website."<hr>";
   echo "Số lượng :".$soluong."<hr>";
   echo "Trình độ :".$trinhdo."<hr>";
   echo "Hình thức :".$hinhthuc."<hr>";
   echo "Kinh nghiệm :".$kinhnghiem."<hr>";
   echo "Quy mô :".$quymo_ct."<hr>";
   //Array post dữ liệu
   $data_post = array('new_title'           => $new_title,
                     'new_cat_id'           => $new_cat_id,
                     'new_chuc_vu'          => $new_chuc_vu,
                     'new_city'             => $diadiem,
                     'new_money_cra'        => $mucluong,                     
                     'new_han_nop'          => $hannop2,   
                     'new_mo_ta'            => $mota,
                     'new_yeu_cau'          => $yeucau,
                     'new_lh_cra'           => $thongtin_lh,
                     'new_company_cra'      => $tencongty,
                     'new_address_cra'      => $diachi,
                     'new_quyen_loi'        => $quyenloi,
                     'new_name_user'        => $nguoilh,
                     'new_email_user'       => $email,
                     'new_phone_user'       => $phone,
                     'new_info'             => $info,
                     'new_website'          => $website,
                     'linklogo'             => $linklogo,
                     'usc_type'             => $quymo_ct,
                     'new_ho_so'            => $yeucauhs,
                     'new_exp'              => $kinhnghiem,
                     'new_bang_cap'         => $trinhdo,
                     'new_so_luong'         => $soluong,
                     'new_hinh_thuc'        => $hinhthuc,
                     'luatweb'              => $row['cra_luat']
                     );
$url = 'https://timviec365.vn/cron/tu_get_data.php';   
if($new_title != '')
{
      $curl = new cURL;
      echo $curl->post_no_header($url,$data_post);
}
$db_ex6 = new db_execute("UPDATE crawler SET cra_type = 1 WHERE cra_id = ".$idcra."");  
unset($db_ex6);
}
else
{
   $db_ex6 = new db_execute("UPDATE linkdetail SET lin_active = 0 ");  
   header("Location:tu_get_link.php");
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
function getInfo6($linkab, $att_title,$label){
   $title = '';    
   $value = '';
   foreach($linkab->find($att_title) as $e){
   	$title = $e->innertext();
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
   	$value = $title[1];
   	break;
   	}   
   }
   return $value;
}
function getInfo4($linkab, $att_title,$label){
   $title = '';    
   $value = '';
   foreach($linkab->find($att_title) as $e){
   	$title = $e->plaintext;
      if($title != '')
      {
         if(preg_match($label,$title))
      	{
      	$title = explode(':',$title);
      	$value = $title[1].":".$title[2];
         $value = trim($value,":");
      	break;
      	} 
      }
      else
      {
         $value = '';
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
function getInfo5($linkab, $att_title,$label){
   $title = '';    
   $value = '';
   foreach($linkab->find($att_title) as $e){
   	$title = $e->plaintext;
   	if(preg_match($label,$title,$matches))
   	{
   	$value = str_replace($matches[0],"",$title);
   	break;
   	}   
   }
   return $value;
}
?>