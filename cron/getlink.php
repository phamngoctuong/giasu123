<? include("config.php");
for($i = 1;$i<16;$i++)
{
   $link = "https://m.vieclam24h.vn/thiet-ke-do-hoa-web-c75.html?page=".$i;
   $catid = 39;
   $db_ex = new db_execute("INSERT INTO linkdetail(lin_name,lin_cat,lin_cat_con,lin_website,lin_active,lin_pen)
                        VALUES ('".$link."','".$catid."','".$catid."',8,0,0)");
}
?>