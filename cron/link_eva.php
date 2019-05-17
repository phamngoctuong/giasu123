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
$db_qrr = new db_query("SELECT * FROM link_eva INNER JOIN luat_eva ON link_eva.lin_luat = luat_eva.web_id WHERE lin_active = 0 AND lin_luat = 2 LIMIT 1");
if(mysql_num_rows($db_qrr->result) > 0)
{
    if($rowss = mysql_fetch_assoc($db_qrr->result))
    {
    $website    = $rowss["lin_luat"];
    $link       = $rowss["lin_name"];
    $catedt     = $rowss["web_luat_ct"];
    $city       = $rowss["lin_city"];
    $catid      = $rowss['lin_cat'];
    $linkid     = $rowss["lin_id"];
    // Find all links 
    $html   = file_get_html($link);
    //$boxcontent = $html->find('.box-content',2);
    if(count($html->find($catedt)) != 0)
    {
        foreach($html->find($catedt) as $element) 
        {      
            if($website == 1)
            {
               $catname = $element->href;
               $catname = str_replace("https://vieclameva.com","https://m.vieclameva.com",$catname);
               echo '<pre>';
            } 
            if($website == 2)
            {
               $catname = "http://vieclam.tv".$element->href;
               $catname;
               echo '<pre>';
            }
            $catten = $element->title; 
            $arrlink[] = $catname; 
            
        }
        foreach($arrlink as $key => $value)
        {
            $db_qr = new db_query("SELECT * FROM eva_crawler WHERE cra_link = '".replaceMQ($value)."'");
            if(mysql_num_rows($db_qr->result) == 0)
            {
                $db_ex = new db_execute("INSERT INTO eva_crawler(cra_link,cra_type,cra_city_id,cra_cat_id,cra_luat) VALUES('".replaceMQ($value)."','0','".$city."','".$catid."','".$website."')");  
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
    $db_excute = new db_execute("UPDATE link_eva SET lin_active = 1 WHERE lin_id = ".$linkid);
    unset($db_excute);
    } 
}
else
{
    header("Location:detail_eva.php");
    echo "<script>alert('Lấy link thành công')</script>";
}
 unset($db_qrr,$rowss,$website,$link,$catedt,$cat,$catname,$catten,$db_qr,$db_ex,$db_excute);
?>
</body>
</html>
<? ob_end_flush(); ?>