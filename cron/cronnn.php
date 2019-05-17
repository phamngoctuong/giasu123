<?
include("config.php");

?>
 <meta http-equiv="refresh" content="5"/>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 <?php
 $db_qr = new db_query("SELECT * FROM cronnn where isactive=0 ORDER BY id LIMIT 1");

if(mysql_num_rows($db_qr->result) > 0)
{
    $row = mysql_fetch_assoc($db_qr->result); 
    $resultcat=new db_execute("update cronnn set isactive='1' where id='".$row['id']."'");
    $urlcat=$row['link']; 
 for($i=1;$i<300;$i++){
  //  $i=1;
    $link = file_get_html($urlcat."?page=".$i);
    echo $link;
 //$link1=$link->find('#alphabet-sort',0);
 //foreach($link1->find('.col a') as $tg){
 //   $url="http://vieclam.laodong.com.vn".$tg->href;
 //   //echo $url;
 //   $db_ex=new db_execute("INSERT INTO cronnn(link,isactive) VALUES('".$url."','0')"); 
 //}
 $arrlink=$link->find('.normal-news .hot-news .name a');
 //if(!empty($arrlink)){
    //var_dump($arrlink);die();
 foreach($arrlink as $tg){
    $url="http://vieclam.laodong.com.vn".$tg->href;
    $checklink=new db_query("SELECT * FROM crondetail where link like'%".$url."%'");
    if(mysql_num_rows($checklink->result) == 0)
    {
        
    
        $db_ex=new db_execute("INSERT INTO crondetail(link,idnn,isactive) VALUES('".$url."','1','0')"); 
    }
    echo $link;
 }
 //$i+=1;
 //}
 }
 }
 
  ?>