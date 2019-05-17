<?
include("config.php");
$db_qr = new db_query("SELECT new_title,new_redirect,new_id FROM new WHERE new_redirect <> ''");
While($row = mysql_fetch_assoc($db_qr->result))
{
   $rediect = str_replace("http:","https:",$row['new_redirect']);
   $db_ex = new db_execute("UPDATE new SET new_redirect = '".$rediect."' WHERE new_id = '".$row['new_id']."'");
   echo '456';
   unset($rediect,$db_ex);
}
?>