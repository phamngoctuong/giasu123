<meta http-equiv="refresh" content="15"/>
<?
include("config.php");
set_time_limit(0);
$db_qr = new db_query("SELECT * FROM user_company WHERE usc_md5 = '' ORDER BY usc_id ASC LIMIT 50");
While($row = mysql_fetch_assoc($db_qr->result))
{
$tit = $row['usc_company'];
$tit = trim(mb_strtolower($tit,'UTF-8'));
$tit = removeAccent($tit);
$tit = htmlentities($tit);
$tit = md5($tit);
echo $tit;
$db_ex = new db_execute("UPDATE user_company SET usc_md5 = '".$tit."' WHERE usc_id = '".$row['usc_id']."'");
}
?>