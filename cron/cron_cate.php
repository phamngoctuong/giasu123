<?
include("config.php");
$db_qr = new db_query("SELECT new_id,new_tag FROM new LIMIT 1");
$db_qrs = new db_query("SELECT * FROM tag");
$arrbc = $db_qrs->result_array('tag_id');
foreach($arrbc as $item)
{
   $arrkey[$item['tag_id']] = $item['tag_key'];
}
While($row = mysql_fetch_assoc($db_qr->result))
{
   $tag = $row['new_tag'];
   $arrtag = explode(",",$tag);
   foreach($arrtag as $type => $item)
   {
      
   }
   $rowtag = implode(",",$key.$row['new_id']);
   echo $rowtag."<br/>";
}

?>