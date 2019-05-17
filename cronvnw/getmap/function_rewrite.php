<?
function generate_cate_url($row){
   $url	=	"/blog/".replaceTitle($row['cat_name'])."-c" . $row["cat_id"] . "/";
	return $url;
}
function rewrite_news($cat_name,$row){
	$url	=	"/blog/".replaceTitle($cat_name)."/" . replaceTitle($row['new_title'])  . "-" . $row["new_id"] . ".html";
	return $url;
}

function hide_mail($data)
{
	$mail =  stripos($data, '@', 0) - 3;
	$data = substr_replace($data, "*******", 3,$mail);
	return $data;
}

function rewriteNews($id,$title){
   return  "/".replaceTitle($title). "-p" . $id.".html";
}
function rewriteNewsUV($id,$title){
   return  "/ung-vien/".replaceTitle($title). "-uv" . $id.".html";
}
function list_cate_par($catid){
	$result = $catid.',';
	$db_sel = new db_query("SELECT * FROM categories_multi WHERE cat_parent_id = " . $catid . " AND cat_active = 1");
	if(mysql_num_rows($db_sel->result) > 0){
		while ($row = mysql_fetch_assoc($db_sel->result)) {
			$result .= $row['cat_id'] . ',';
		}
	}
	return substr($result, 0, -1);
}

function rewriteCate($catid,$catname,$city,$cityname){
$linkrt = "";
if($catid == 0 && $city == 0)
{
   $linkrt = "/tuyen-dung";
}
else if($catid != 0 && $city == 0)
{
   $linkrt = "/viec-lam-".replaceTitle($catname)."-c".$catid."v".$city;
}
else if($catid == 0 && $city != 0)
{
   $linkrt = "/viec-lam-tai-".replaceTitle($cityname)."-c".$catid."v".$city;
}
else if($catid != 0 && $city != 0)
{
   $linkrt = "/viec-lam-".replaceTitle($catname)."-tai-".replaceTitle($cityname)."-c".$catid."v".$city;
}
return  $linkrt;
}

function rewriteTag($id,$name,$city,$cit_name){
 if($city == 0)
 {
  return  "/".replaceTitle($name). "-id" . $id;
 }
 else
 {
  return  "/".replaceTitle($name)."-tai-".replaceTitle($cit_name). "-id" . $id;
 }
}

function rewriteKey($key_id,$key_name,$key_cate_id,$cate_name,$key_city_id,$city_name,$key_qh_id,$qh_name,$key_cb_id,$cb_name,$key_type){
	$linkrt = "";
	if($key_qh_id != 0 && $key_city_id != 0 && $key_cate_id != 0 && $key_name == Null && $key_cb_id == 0 && $key_type == 0)
	{
	   $linkrt = "/tag2/viec-lam-".replaceTitle($cate_name)."-tai-".replaceTitle($qh_name)."-".replaceTitle($city_name)."-".$key_id;
	}
	else if($key_qh_id != 0 && $key_city_id != 0 && $key_name != Null && $key_cate_id == 0 && $key_cb_id == 0 && $key_type == 0 )
	{
	   $linkrt = "/tag6/viec-lam-".replaceTitle($key_name)."-tai-".replaceTitle($qh_name)."-".replaceTitle($city_name)."-".$key_id;
	}
	else if($key_cb_id != 0 && $key_cate_id != 0 && $key_city_id != 0 && $key_name == Null && $key_qh_id == 0 && $key_type == 0)
	{
	   $linkrt = "/tag3/tuyen-dung-viec-lam-".replaceTitle($cb_name)."-".replaceTitle($cate_name)."-tai-".replaceTitle($city_name)."-".$key_id;
	}
	else if($key_cb_id != 0 && $key_name != Null && $key_city_id != 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_type == 0)
	{
	   $linkrt = "/tag4/viec-lam-".replaceTitle($cb_name)."-".replaceTitle($key_name)."-tai-".replaceTitle($city_name)."-".$key_id;
	}
	else if($key_name != Null && $key_city_id != 0 && $key_type == 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_cb_id == 0)
	{
	   $linkrt = "/tag5/tuyen-dung-viec-lam-".replaceTitle($key_name)."-tai-".replaceTitle($city_name)."-".$key_id;
	}
	else if($key_qh_id != 0 && $key_city_id != 0 && $key_cb_id == 0 && $key_cate_id == 0 && $key_name == Null && $key_type == 0)
	{
	   $linkrt = "/tag1/viec-lam-tai-".replaceTitle($qh_name)."-".replaceTitle($city_name)."-".$key_id;
	}
	else if( $key_name != Null && $key_type == 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_city_id == 0 && $key_cb_id == 0)
	{
	   $linkrt = "/tag7/DS-viec-lam-tuyen-dung-".replaceTitle($key_name)."-".$key_id;
	}
	else if( $key_name != Null && $key_type != 0 && $key_cate_id == 0 && $key_qh_id == 0 && $key_city_id == 0 && $key_cb_id == 0)
	{
	   $linkrt = "/tuyen-dung-viec-lam/".$key_id."-".replaceTitle($key_name);
	}
	return  $linkrt;
}

 function rewritemoney($catid,$catname,$city,$cityname){
   $linkrt = "";
   if($catid == 0 && $city == 0)
   {
      $linkrt = "/viec-lam-luong-cao.html";
   }
   else if($catid != 0 && $city == 0)
   {
      $linkrt = "/viec-lam-".replaceTitle($catname)."-luong-cao-i".$catid."v".$city.".html";
   }
   else if($catid == 0 && $city != 0)
   {
      $linkrt = "/viec-lam-luong-cao-tai-".replaceTitle($cityname)."-i".$catid."v".$city.".html";
   }
   else if($catid != 0 && $city != 0)
   {
      $linkrt = "/viec-lam-".replaceTitle($catname)."-luong-cao-tai-".replaceTitle($cityname)."-i".$catid."v".$city.".html";
   }
	return  $linkrt;
 }
function rewriteCateUV($catid,$catname,$city,$cityname){
$linkrt = "";
if($catid == 0 && $city == 0)
{
   $linkrt = "/ung-vien";
}
else if($catid != 0 && $city == 0)
{
   $linkrt = "/ung-vien-".replaceTitle($catname)."-u".$catid."v".$city;
}
else if($catid == 0 && $city != 0)
{
   $linkrt = "/ung-vien-tai-".replaceTitle($cityname)."-u".$catid."v".$city;
}
else if($catid != 0 && $city != 0)
{
   $linkrt = "/ung-vien-".replaceTitle($catname)."-tai-".replaceTitle($cityname)."-u".$catid."v".$city;
}
return  $linkrt;
}
function rewriteSearch($keyword,$nganhnghe,$catname,$diadiem,$namediadiem)
{
   $titrw = '';
   if($keyword != ''&&$nganhnghe == 0 &&$diadiem == 0)
   {
   $titrw = str_replace(" ","-",$keyword)."+toan-quoc"."-c".$nganhnghe."p".$diadiem.".html";
   }
   else if($keyword != ''&& $nganhnghe != 0 && $diadiem == 0)
   {
   $titrw = str_replace(" ","-",$keyword)."+"."nganh-".replaceTitle($catname)."-c".$nganhnghe."p".$diadiem.".html";
   }
   else if($keyword != '' && $nganhnghe == 0 && $diadiem != 0)
   {
   $titrw = str_replace(" ","-",$keyword)."+"."tai-".replaceTitle($namediadiem)."-c".$nganhnghe."p".$diadiem.".html";
   }
   else if($keyword != '' && $nganhnghe != 0 && $diadiem != 0)
   {
   $titrw =  str_replace(" ","-",$keyword)."+"."tai-".replaceTitle($namediadiem)."-c".$nganhnghe."p".$diadiem.".html";
   }
   return "/tim-kiem/".$titrw;
}
function rewrite_company($idcp,$namecp)
{
   $compn = "/".replaceTitle($namecp)."-co".$idcp;
   return $compn;
}
function replaceTitle($title){
	$title	= remove_accent($title);
	$arr_str	= array( "&lt;","&gt;","/","\\","&apos;", "&quot;","&amp;","lt;", "gt;","apos;", "quot;","amp;","&lt", "&gt","&apos", "&quot","&amp","&#34;","&#39;","&#38;","&#60;","&#62;");
	$title	= str_replace($arr_str, " ", $title);
	$title = preg_replace('/[^0-9a-zA-Z\s]+/', ' ', $title);
	//Remove double space
	$array = array(
		'    ' => ' ',
		'   ' => ' ',
		'  ' => ' ',
	);
	$title = trim(strtr($title, $array));
	$title	= str_replace(" ", "-", $title);
	$title	= urlencode($title);
	// remove cac ky tu dac biet sau khi urlencode
	$array_apter = array("%0D%0A","%","&");
	$title	=	str_replace($array_apter,"-",$title);
	$title	= strtolower($title);
	return $title;
}
//Loại bỏ dấu
function remove_accent($mystring){
	$marTViet=array(
	"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ",
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ",
	"'");
	
	$marKoDau=array(
	"a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
	"e","e","e","e","e","e","e","e","e","e","e",
	"i","i","i","i","i",
	"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
	"u","u","u","u","u","u","u","u","u","u","u",
	"y","y","y","y","y",
	"d",
	"A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
	"E","E","E","E","E","E","E","E","E","E","E",
	"I","I","I","I","I",
	"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
	"U","U","U","U","U","U","U","U","U","U","U",
	"Y","Y","Y","Y","Y",
	"D",
	"");
	
	return str_replace($marTViet,$marKoDau,$mystring);
}
?>
