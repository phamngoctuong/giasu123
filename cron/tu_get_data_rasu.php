<?
include("config.php");
echo $new_title           = getValue('new_title','str','POST','');
 $meta_title          = getValue('meta_title','str','POST','');
 $meta_desc           = getValue('meta_desc','str','POST','');
 $meta_keywork           = getValue('meta_keywork','str','POST','');
 $meta_title = trim($meta_title);
 $meta_desc = trim($meta_desc);
 $meta_keywork = trim($meta_keywork);
$new_title = trim($new_title);
$new_title = str_replace("    "," ",$new_title);
$new_title = str_replace("   "," ",$new_title);
$new_title = str_replace("  "," ",$new_title);
echo "<hr>";
echo $new_cat_id          = getValue('new_cat_id','int','POST',0);
echo "<hr>";
echo $new_chuc_vu         = getValue('new_chuc_vu','int','POST',0);
echo "<hr>";
echo $new_city            = getValue('new_city','int','POST',0);
echo "<hr>";
echo $new_money           = getValue('new_money_cra','str','POST','');
echo "<hr>";
echo $new_han_nop         = getValue('new_han_nop','int','POST',0);
echo "<hr>";
echo $new_mo_ta           = getValue('new_mo_ta','str','POST','');
$new_mo_ta = replaceMQ($new_mo_ta);
$new_mo_ta = preg_replace('#(<br */?>\s*)+#i', '<br />',$new_mo_ta);
echo "<hr>";
echo $new_yeu_cau         = getValue('new_yeu_cau','str','POST','');
$new_yeu_cau = replaceMQ($new_yeu_cau);
$new_yeu_cau = preg_replace('#(<br */?>\s*)+#i', '<br />',$new_yeu_cau);
echo "<hr>";
echo $new_lh_cra          = getValue('new_lh_cra','str','POST','');
$new_lh_cra = replaceMQ($new_lh_cra);
echo "<hr>";
echo $new_company_cra     = getValue('new_company_cra','str','POST',''); 
$new_company_cra = replaceMQ($new_company_cra);

echo "<hr>";
echo $new_address_cra     = getValue('new_address_cra','str','POST','');
$new_address_cra = replaceMQ($new_address_cra);
echo "<hr>";
echo $new_quyen_loi       = getValue('new_quyen_loi','str','POST','');
$new_quyen_loi = replaceMQ($new_quyen_loi);
$new_quyen_loi = preg_replace('#(<br */?>\s*)+#i', '<br />',$new_quyen_loi);
echo "<hr>";
echo $new_name_user       = getValue('new_name_user','str','POST','');
echo "<hr>";
echo $new_email_user      = getValue('new_email_user','str','POST','');
$new_email_user = trim($new_email_user);
echo "<hr>";
echo $new_phone_user      = getValue('new_phone_user','str','POST','');
echo "<hr>";
echo $new_info            = getValue('new_info','str','POST','');
$new_info = replaceMQ($new_info);
echo "<hr>";
echo $new_website         = getValue('new_website','str','POST','');
$new_website = replaceMQ($new_website);
echo "<hr>";
echo $linklogo            = getValue("linklogo",'str','POST','');

$linklogo = trim($linklogo);
if($linklogo == 'http://cdn.timviecnhanh.com/asset/home/img/default.gif')
{
   $linklogo = '';
}
else if($linklogo == 'https://cdn.timviecnhanh.com/asset/home/img/default.gif')
{
   $linklogo = '';
}
else if($linklogo == 'https://secure1.vncdn.vn/data/images/logo/0.gif')
{
   $linklogo = '';
}
else if($linklogo == 'https://cdn.timviecnhanh.com/asset/home/img/default_no_ok.png')
{
   $linklogo = '';
}
else if($linklogo == 'http://vieclam.laodong.com.vn/Uploaded/ViecLam/CompanyLogo/bcd878be-0170-4ac4-aae8-2e6ea21640fe.jpg')
{
   $linklogo = '';
}
else if($linklogo == 'https://vieclam24h.vn/asset/default/images/logo_demo.png')
{
   $linklogo = '';
}
else if($linklogo == 'https://cdn1.mywork.com.vn/company-logo/myworkfb.png')
{
   $linklogo = '';
}
echo "<hr>";
echo $usc_type            = getValue("usc_type",'int','POST',0);
echo "<hr>";
echo $new_exp             = getValue("new_exp",'int','POST',0);
echo "<hr>";
echo $new_bang_cap        = getValue("new_bang_cap",'int','POST',0);
echo "<hr>";
echo $new_so_luong        = getValue("new_so_luong",'int','POST',0);
echo "<hr>";
echo $new_hinh_thuc        = getValue("new_hinh_thuc",'int','POST',0);
echo "<hr>";
echo $luatweb             = getValue('luatweb','str','POST','');
echo $new_active = 1;
echo "<hr>";
echo $new_crawler = 1;
$new_create_time = time();
$createdate=date("Y-m-d H:i:s",time());

if($new_title != '' && $new_mo_ta != '' && $new_money > 0  && $new_city != 0)
{

   $tit = $new_title;
   $tit = trim(mb_strtolower($tit,'UTF-8'));
   $tit = removeAccent($tit);
   $tit = htmlentities($tit);
   $tit = md5($tit);
   $newmd5 = $tit;
   $comp = $new_company_cra;
   $comp = trim(mb_strtolower($comp,'UTF-8'));
   $comp = removeAccent($comp);
   $comp = htmlentities($comp);
   $comp = md5($comp);
   $new_company_cra = mb_strtolower($new_company_cra,'UTF-8');
   $new_company_cra = str_replace("tnhh","TNHH",$new_company_cra);
   $new_company_cra = str_replace("cp","CP",$new_company_cra);
   if($new_email_user != '')
   {
   $db_qr = new db_query("SELECT user_company.usc_id as userid,usc_phone,usc_website,usc_size,usc_company_info,usc_logo,usc_create_time FROM user_company JOIN user_company_multi ON user_company.usc_id = user_company_multi.usc_id WHERE usc_email = '".$new_email_user."' AND usc_redirect = ''  LIMIT 1");  
   }
   else if($new_phone_user != '')
   {
   $db_qr = new db_query("SELECT user_company.usc_id as userid,usc_phone,usc_website,usc_size,usc_company_info,usc_logo,usc_create_time FROM user_company JOIN user_company_multi ON user_company.usc_id = user_company_multi.usc_id WHERE usc_phone = '".$new_phone_user."' AND usc_redirect = ''  LIMIT 1");    
   }
   else
   {
    $db_qr = new db_query("SELECT user_company.usc_id as userid,usc_phone,usc_website,usc_size,usc_company_info,usc_logo,usc_create_time FROM user_company JOIN user_company_multi ON user_company.usc_id = user_company_multi.usc_id WHERE usc_md5 = '".$comp."' AND usc_redirect = ''  LIMIT 1");    
   }
   echo $linklogo;
   if(mysql_num_rows($db_qr->result) == 0)
   {
      $db_qr7 = new db_query("SELECT * FROM user_company WHERE usc_md5 = '".$comp."' AND usc_redirect = '' LIMIT 1");
      var_dump($db_qr7->result);
      if(mysql_num_rows($db_qr7->result) == 0)
      {
         if($linklogo == 'http://www.careerlink.vn')
         {
            $name = '';
            
         }
         else if($linklogo == '')
         {
            $name = '';
            
         }
         else if($linklogo == 'http://vieclam.laodong.com.vn')
         {
            $name = '';
         }
         else
         {
            $dir  = geturlimageAvatar(time());
            $name = generate_name($linklogo.".jpg.jpg");
            if($luatweb == 6)
            {
               file_put_contents($dir.$name, file_get_contents($linklogo.".jpg"));
            }
            else
            {
               file_put_contents($dir.$name, file_get_contents($linklogo));
            }
            //echo $dir.$name;
            //var_dump($dir,$name,$$linklogo);die();
            $resizeObjj = new resize($dir.$name);
            $resizeObjj -> resizeImage(177,130,'resize');
            $resizeObjj -> saveImage($dir.$name, 100);
            opz($dir.$name);
         }
         $qr = "INSERT INTO user_company(usc_email,usc_name,usc_pass,usc_md5,usc_company,usc_type,usc_address,usc_phone,usc_logo,usc_create_time,usc_website,usc_size) 
                VALUES('".$new_email_user."','".$new_name_user."','".md5('123viec'.trim($new_email_user))."','".$comp."','".$new_company_cra."','1','".$new_address_cra."','".$new_phone_user."','".$name."','".time()."','".$new_website."','".$usc_type."')";
         $db_qr1 = new db_execute_return();
         $id_user = $db_qr1->db_execute($qr);
         $db_ex2 = new db_execute("INSERT INTO user_company_multi(usc_id,usc_company_info) VALUES('".$id_user."','".$new_info."')");
         $query = "INSERT INTO new(new_title,new_md5,new_cat_id,new_city,new_money,new_cap_bac,new_han_nop,new_create_time,new_update_time,new_active,new_user_id,new_exp,new_bang_cap,new_so_luong,new_hinh_thuc,new_cra) 
                  VALUES('".$new_title."','".$newmd5."','".$new_cat_id."','".$new_city."','".$new_money."','".$new_chuc_vu."','".$new_han_nop."','".$new_create_time."','".$new_create_time."','1','".$id_user."','".$new_exp."','".$new_bang_cap."','".$new_so_luong."','".$new_hinh_thuc."','".$luatweb."')";
         $db_ex = new db_execute_return();
         $last_id = $db_ex->db_execute($query);
         $dbex5 = new db_execute("INSERT INTO new_multi(new_id,new_mota,new_yeucau,new_quyenloi,meta_title,meta_desc,meta_keywork)VALUES('".$last_id."','".$new_mo_ta."','".$new_yeu_cau."','".$new_quyen_loi."','".$meta_title."','".$meta_desc."','".$meta_keywork."')");
      }
      else
      {
         $row = mysql_fetch_assoc($db_qr7->result);
         $id_user = $row['usc_id'];
         if($row['usc_logo'] == NULL)
         {
            if($linklogo == 'http://www.careerlink.vn')
            {
               $name = '';
               
            }
            else if($linklogo == '')
            {
               $name = '';
               
            }
            else if($linklogo == 'http://vieclam.laodong.com.vn')
            {
               $name = '';
            }
            else
            {
               $dir  = geturlimageAvatar($row['usc_create_time']);
               $name = generate_name($linklogo.".jpg.jpg");
               
               if($luatweb == 6)
               {
                  file_put_contents($dir.$name, file_get_contents($linklogo.".jpg"));
               }
               else
               {
                  file_put_contents($dir.$name, file_get_contents($linklogo));
               }
               $resizeObjj = new resize($dir.$name);
               $resizeObjj -> resizeImage(177,130,'resize');
               $resizeObjj -> saveImage($dir.$name, 100);
               opz($dir.$name);
               $db_ex10 = new db_execute("UPDATE user_company SET usc_logo = '".$name."' WHERE usc_id = '".$id_user."'");
            }
         }
         if($new_phone_user != '')
         {
            if($row['usc_phone'] == '')
            {
               $db_ex11 = new db_execute("UPDATE user_company SET usc_phone = '".$new_phone_user."' WHERE usc_id = '".$id_user."'");
            }
         }
         if($new_website != '')
         {
            if(empty($row['usc_website']))
            {
               $db_ex11 = new db_execute("UPDATE user_company SET usc_website = '".$new_website."' WHERE usc_id = '".$id_user."'");
            }
            if($row['usc_website'] == 'http')
            {
               $db_ex11 = new db_execute("UPDATE user_company SET usc_website = '".$new_website."' WHERE usc_id = '".$id_user."'");
            }
            if($row['usc_website'] == 'https')
            {
               $db_ex11 = new db_execute("UPDATE user_company SET usc_website = '".$new_website."' WHERE usc_id = '".$id_user."'");
            }
         }
         if($usc_type != 0)
         {
            if($row['usc_size'] == 0)
            {
               $db_ex11 = new db_execute("UPDATE user_company SET usc_size = '".$usc_type."' WHERE usc_id = '".$id_user."'");
            }
         }
         $db_qr455 = new db_query("SELECT new_id FROM new WHERE new_md5 = '".$newmd5."' AND new_user_id = ".$id_user." AND new_active = 1  LIMIT 1");
         $db_qr456 = new db_query("SELECT new_id FROM new WHERE new_title like '%".$new_title."%' AND new_user_id = ".$id_user." AND new_active = 1  LIMIT 1");
         if(mysql_num_rows($db_qr455->result) == 0 and mysql_num_rows($db_qr456->result))
         {
            $query = "INSERT INTO new(new_title,new_md5,new_cat_id,new_city,new_money,new_cap_bac,new_han_nop,new_create_time,new_update_time,new_active,new_user_id,new_exp,new_bang_cap,new_so_luong,new_hinh_thuc,new_cra) 
                       VALUES('".$new_title."','".$newmd5."','".$new_cat_id."','".$new_city."','".$new_money."','".$new_chuc_vu."','".$new_han_nop."','".$new_create_time."','".$new_create_time."','1','".$id_user."','".$new_exp."','".$new_bang_cap."','".$new_so_luong."','".$new_hinh_thuc."','".$luatweb."')";
            $db_ex = new db_execute_return();
            $last_id = $db_ex->db_execute($query);
            $dbex5 = new db_execute("INSERT INTO new_multi(new_id,new_mota,new_yeucau,new_quyenloi,meta_title,meta_desc,meta_keywork)VALUES('".$last_id."','".$new_mo_ta."','".$new_yeu_cau."','".$new_quyen_loi."','".$meta_title."','".$meta_desc."','".$meta_keywork."')");
         }
         else
         {
            $row4 = mysql_fetch_assoc($db_qr455->result);
            $db_ex8 = new db_execute("UPDATE new SET new_han_nop = ".$new_han_nop.",new_create_time = ".time()." WHERE new_id = ".$row4['new_id'].""); 
         }
      }
   }
   else
   {
      $row= mysql_fetch_assoc($db_qr->result);
      $db_qr455 = new db_query("SELECT new_id FROM new WHERE new_md5 = '".$newmd5."' AND new_user_id = ".$row['userid']." AND new_active = 1  LIMIT 1");
      $db_qr456 = new db_query("SELECT new_id FROM new WHERE new_title like '%".$new_title."%' AND new_user_id = ".$row['userid']." AND new_active = 1  LIMIT 1");
      if(mysql_num_rows($db_qr455->result) == 0 and mysql_num_rows($db_qr456->result) == 0){
         $id_user = $row['userid'];
         if($row['usc_logo'] == NULL)
         {
            if($linklogo == 'http://www.careerlink.vn')
            {
               $name = '';
               
            }
			else if($linklogo == '')
			{
				$name = '';
				
			}
            else if($linklogo == 'http://vieclam.laodong.com.vn')
            {
               $name = '';
            }
            else
            {
               $dir  = geturlimageAvatar($row['usc_create_time']);
               $name = generate_name($linklogo.".jpg.jpg");
               if($luatweb == 6){
                  file_put_contents($dir.$name, file_get_contents($linklogo.".jpg"));
               }
               else
               {
                  file_put_contents($dir.$name, file_get_contents($linklogo));
               }
               $resizeObjj = new resize($dir.$name);
               $resizeObjj -> resizeImage(177,130,'resize');
               $resizeObjj -> saveImage($dir.$name, 100);
               opz($dir.$name);
               $db_ex10 = new db_execute("UPDATE user_company SET usc_logo = '".$name."' WHERE usc_id = '".$id_user."'");
            }
         } 
         if($new_phone_user != '')
         {
            if($row['usc_phone'] == '')
            {
               $db_ex11 = new db_execute("UPDATE user_company SET usc_phone = '".$new_phone_user."' WHERE usc_id = '".$id_user."'");
            }
         }
         if($new_website != '')
         {
            if(empty($row['usc_website']))
            {
               $db_ex11 = new db_execute("UPDATE user_company SET usc_website = '".$new_website."' WHERE usc_id = '".$id_user."'");
            }
            if($row['usc_website'] == 'http')
            {
               $db_ex11 = new db_execute("UPDATE user_company SET usc_website = '".$new_website."' WHERE usc_id = '".$id_user."'");
            }
            if($row['usc_website'] == 'https')
            {
               $db_ex11 = new db_execute("UPDATE user_company SET usc_website = '".$new_website."' WHERE usc_id = '".$id_user."'");
            }
         }
         if($new_info != '')
         {
            if(empty($row['usc_company_info']))
            {
               $db_ex11 = new db_execute("UPDATE user_company_multi SET usc_company_info = '".$new_info."' WHERE usc_id = '".$id_user."'");
            }
         }
         if($usc_type != 0)
         {
            if($row['usc_size'] == 0)
            {
               $db_ex11 = new db_execute("UPDATE user_company SET usc_size = '".$usc_type."' WHERE usc_id = '".$id_user."'");
            }
         }
         $query = "INSERT INTO new(new_title,new_md5,new_cat_id,new_city,new_money,new_cap_bac,new_han_nop,new_create_time,new_update_time,new_active,new_user_id,new_exp,new_bang_cap,new_so_luong,new_hinh_thuc,new_cra) 
                  VALUES('".$new_title."','".$newmd5."','".$new_cat_id."','".$new_city."','".$new_money."','".$new_chuc_vu."','".$new_han_nop."','".$new_create_time."','".$new_create_time."','1','".$id_user."','".$new_exp."','".$new_bang_cap."','".$new_so_luong."','".$new_hinh_thuc."','".$luatweb."')";
         $db_ex = new db_execute_return();
         $last_id = $db_ex->db_execute($query);
         $dbex5 = new db_execute("INSERT INTO new_multi(new_id,new_mota,new_yeucau,new_quyenloi,meta_title,meta_desc,meta_keywork)VALUES('".$last_id."','".$new_mo_ta."','".$new_yeu_cau."','".$new_quyen_loi."','".$meta_title."','".$meta_desc."','".$meta_keywork."')");
      }
      else
      {
         $row4 = mysql_fetch_assoc($db_qr455->result);
         $db_ex8 = new db_execute("UPDATE new SET new_han_nop = ".$new_han_nop.",new_create_time = ".time()." WHERE new_id = ".$row4['new_id']."");
      }
   }
}
function opz($imagePath){     
   $checkValidImage = @getimagesize($imagePath);
   $type = strtolower(substr(strrchr($imagePath,"."),1));

   if(file_exists($imagePath) && $checkValidImage) //Continue only if 2 given parameters are true
   {     
       $type = strtolower($type);
       if($type=='png'){
           exec('optipng '.$imagePath);
           var_dump($imagePath);    
       }
       if($type=='jpg' or $type=='jpeg'){
           exec('jpegoptim '.$imagePath);
       }     
   }     
}
?>