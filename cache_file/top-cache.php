<?
include("../confighome/config.php");
// text file cache 
$file = '../cache_file/sql_cache.json'; 
$expire = 86400; // 24 hours 
// Nếu có cache file và còn trong thời gian chưa hết $expire 
if (file_exists($file) && filemtime($file) > (time() - $expire)) 
{ 
    // Uunserialize data từ cache file 
    $arraytong       = json_decode(file_get_contents($file),true); 
    $db_result       = $arraytong['db_result'];
    $arrcity         = $arraytong['db_city'];
    $db_cat          = $arraytong['db_cat'];
    $db_tag          = $arraytong['db_tag'];
} 
else // Cập nhật cache file 
{ 
    //$db_qr = new db_query("SELECT cat_id,cat_name,cat_count FROM category WHERE cat_active = 1 ORDER BY cat_count DESC");
//    $db_result  = $db_qr->result_array();
//    $db_qrr = new db_query("SELECT cit_id,cit_name,cit_count FROM city ORDER BY cit_count DESC,cit_name ASC");
//    $arrcity  = $db_qrr->result_array('cit_id');
//    $db_qr = new db_query("SELECT cat_id,cat_name,cat_tags,cat_count FROM category WHERE cat_active = 1 ORDER BY cat_count DESC");
//    $db_cat  = $db_qr->result_array('cat_id');
//    $db_qrs = new db_query("SELECT tag_id,tag_key FROM tag");
//    $db_tag  = $db_qrs->result_array('tag_id');
//    $arraytong = array('db_result' => $db_result,
//                       'db_city'   => $arrcity,
//                       'db_cat'    => $db_cat,
//                       'db_tag'    => $db_tag);
//    // Serialize data và push vào cache file 
//    $OUTPUT = json_encode($arraytong);  
//    $fp = fopen($file,"w"); 
//    fputs($fp, $OUTPUT); 
//    fclose($fp);     
} // end else 
?>