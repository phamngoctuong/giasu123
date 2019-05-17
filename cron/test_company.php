<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<?

include("config.php");
$db_qr = new db_query("SELECT count(usc_md5),usc_company,usc_md5,user_company.usc_id as usc_id,usc_name,usc_address,usc_phone,usc_size,usc_website,usc_company_info
                       FROM user_company 
                       JOIN user_company_multi  
                       ON user_company.usc_id = user_company_multi.usc_id                     
                       WHERE usc_md5 <> '' 
                       AND usc_redirect = ''
                       GROUP BY usc_md5 
                       HAVING COUNT(usc_md5) > 1 
                       ORDER BY usc_id ASC
                       ");
$i = 1;
While($row = mysql_fetch_assoc($db_qr->result))
{
   //echo $i.".".$row['new_title']."<hr>";
   echo "Tin chính :".$row['usc_company']."   :ID:".$row['usc_id']."<br>";
   $db_qrs = new db_query("SELECT usc_name,usc_company,usc_md5,user_company.usc_id as usc_id2,usc_address,usc_phone,usc_size,usc_website,usc_company_info FROM user_company JOIN user_company_multi ON user_company.usc_id = user_company_multi.usc_id WHERE usc_md5 = '".$row['usc_md5']."' AND user_company.usc_id <> ".$row['usc_id']."");
   $idred = $row['usc_id'];
   $arrid[] = $row['usc_id'];
   $title = $row['usc_company'];
   $name    = $row['usc_name'];
   $address = $row['usc_address'];
   $phone   = $row['usc_phone'];
   $size    = $row['usc_size'];
   $website = $row['usc_website'];
   $info    = $row['usc_company_info'];
   While($rows = mysql_fetch_assoc($db_qrs->result))
   {
      $arrid[] = $rows['usc_id2'];
      echo "Tin phụ :".$rows['usc_company']."   :ID:".$rows['usc_id2']."<br>";
      if($rows['usc_name'] != '')
      {
         if(count($rows['usc_name']) > count($name))
         {
            $name = $rows['usc_name'];
         }
      }
      if($rows['usc_address'] != '')
      {
         if(count($rows['usc_address']) > count($address))
         {
            $address = $rows['usc_address'];
         }
      }
      if($rows['usc_phone'] != '')
      {
         if(count($rows['usc_phone']) > count($phone))
         {
            $phone = $rows['usc_phone'];
         }
      }
      if($rows['usc_website'] != '')
      {
         if(count($rows['usc_website']) > count($website))
         {
            $website = $rows['usc_website'];
         }
      }
      if(!empty($rows['usc_company_info']))
      {
         if(count($rows['usc_company_info']) > count($info))
         {
            $info = $rows['usc_company_info'];
         }
      }
      if($rows['usc_size'] > 0)
      {
         if($rows['usc_size'] > $size)
         {
            $size = $rows['usc_size'];
         }
      }
      if($rows['usc_id2'] > $idred)
      {
         $idred = $rows['usc_id2'];
         $title = $rows['usc_company'];
      }
   }
   $db_ex = new db_execute("UPDATE usc_company SET usc_name = '".$name."',usc_address = '".$address."',usc_phone = '".$phone."',usc_size = '".$size."',usc_website = '".$website."' WHERE usc_id = '".$idred."'");
   $db_ex5 = new db_execute("UPDATE user_company_multi SET usc_company_info = '".$info."' WHERE usc_id = '".$idred."'");
   $arrcuoi = array_search($idred,$arrid);
   unset($arrid[$arrcuoi]);
   $url301 = "http://123viec.com".rewrite_company($idred,$title);
   if(count($arrid) > 0)
   {
      foreach($arrid as $item => $type)
      {
         $db_ex2 = new db_execute("UPDATE user_company SET usc_redirect = '".$url301."' WHERE usc_id = '".$type."'");
         $db_ex3 = new db_execute("UPDATE new SET new_user_id = '".$idred."' WHERE new_user_id = ".$type."");
      }
   }
   echo "<br>";
   echo $url301;
   echo "<br>";
   echo $title;
   echo "<br>";
   echo $address;
   echo "<br>";
   echo $name;
   echo "<br>";
   echo $phone;
   echo "<br>";
   echo $size;
   echo "<br>";
   echo $website;
   echo "<br>";
   echo $info;
   echo "<hr>";
   unset($arrid,$view,$item,$type,$address,$name,$phone,$size,$website,$info);
}
?>