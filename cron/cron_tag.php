<meta http-equiv="refresh" content="5"/>
<?
include("config.php");
set_time_limit(0);
$db_qr8 = new db_query("SELECT * FROM new WHERE new_tag = '' ORDER BY new_id DESC LIMIT 1");
if(mysql_num_rows($db_qr8->result) == 1)
{
While($row8 = mysql_fetch_assoc($db_qr8->result))
{
   $string = $row8['new_rewrite'];
   $arr = '';
   $string = mb_strtolower(removeAccent($string),'UTF-8');
   $db_qr4 = new db_query("SELECT * FROM tag");
   While($row = mysql_fetch_assoc($db_qr4->result))
   {
      $key = $row['tag_key'];
      $key = removeAccent($key);
      if(preg_match('/'.$key.'/',$string))
      {
         $arr[] = $row['tag_id'];
      }
   }
   if(count($arr) <6)
   {
      $limit = 5 - count($arr); 
      $db_qr5 = new db_query("SELECT * FROM tag ORDER BY rand() LIMIT ".$limit."");
      While($row5 = mysql_fetch_assoc($db_qr5->result))
      {
      $arr[] = $row5['tag_id'];
      }
   }
   $stringtag = implode(',',$arr);
   $db_ex4 = new db_execute("UPDATE new SET new_tag = '".$stringtag."' WHERE new_id = ".$row8['new_id']."");
   echo $stringtag;
}
}
else
{
   echo "Không có tin mới";
}
?>