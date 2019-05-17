<? include("config.php");
ob_start();
?>

<!DOCTYPE html>
<html>
<head>  
    <meta http-equiv="refresh" content="5"/>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?
$db_qrr = new db_query("SELECT * FROM linkdetail INNER JOIN luatwebsite ON linkdetail.lin_website = luatwebsite.web_id WHERE lin_active = 0 AND lin_pen = 0 AND lin_website <> 5  LIMIT 1");
if(mysql_num_rows($db_qrr->result) > 0)
{
    if($rowss = mysql_fetch_assoc($db_qrr->result))
    {
    $website    = $rowss["lin_website"];
    $link       = $rowss["lin_name"];
    $catedt     = $rowss["web_luat_ct"];
    $cat        = $rowss["lin_cat"];
    $cat_con    = $rowss["lin_cat_con"];
    $linkid     = $rowss["lin_id"];
    // Find all links 
    $html   = file_get_html($link);
    //$boxcontent = $html->find('.box-content',2);
    if(count($html->find($catedt)) != 0)
    {
        foreach($html->find($catedt) as $element) 
        {     
            if($website == 4)
            {
               $catname = $element->href;
               echo '<pre>';
            }
            else if($website == 3)
            {
               $linkbd = $element->href;
               if(!preg_match("/mtalent/",$linkbd))
      			{
      				$catname = $linkbd;
      				echo "<pre>";
      			}
            }  
            else if($website == 5)
            {
               $catname = $element->href;
               $catname = "http://vieclam.laodong.com.vn".$catname;
               echo '<pre>';
            } 
            else if($website == 6)
            {
               $catname = $element->href;
               $catname = "https://www.careerlink.vn".$catname;
               echo '<pre>';
            }
            else if($website == 7)
            {
               $catname2 = $element->href;
               if(!preg_match("/nha-tuyen-dung/",$catname2))
      			{
      				 $catname = "https://mywork.com.vn".$catname2;
      				 echo "<pre>";
      			}
            } 
            else if($website == 8)
            {
               $catname2 = $element->href;
               if(preg_match("/m.vieclam24h.vn/",$catname2))
               {
                  echo $catname = $catname2;
                  echo "<pre>";
               }
            } 
            $catten = $element->title; 
            $arrlink[] = $catname; 
        }
        
        foreach($arrlink as $key => $value)
        {
            $db_qr = new db_query("SELECT * FROM crawler WHERE cra_link = '".replaceMQ($value)."'");
            if(mysql_num_rows($db_qr->result) == 0)
            {
                $db_ex = new db_execute("INSERT INTO crawler(cra_link,cra_type,cra_cat_id,cra_cat_con_id,cra_luat) VALUES('".replaceMQ($value)."','0','".$cat."','".$cat_con."','".$website."')");  
                unset($db_ex);
                echo $value;
                echo "<hr>";
            } 
        }
    }
    else
    {
        echo "Chuyên mục không có link";
    }
    $db_excute = new db_execute("UPDATE linkdetail SET lin_active = 1 WHERE lin_id = ".$linkid);
    unset($db_excute);
    } 
}
else
{
   //$db_ex6 = new db_execute("UPDATE linkdetail SET lin_active = 0 ");
    header("Location:tu_bocdulieu.php");
    echo "<script>alert('Lấy link thành công')</script>";
}
 unset($db_qrr,$rowss,$website,$link,$catedt,$cat,$catname,$catten,$db_qr,$db_ex,$db_excute);
?>
</body>
</html>
<? ob_end_flush(); ?>