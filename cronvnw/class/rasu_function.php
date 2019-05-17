<?php 

function html_clear($str,$no='<p><br>'){
	$str = strip_tags($str, $no);	
	$str = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $str);
	$str = str_replace('  ', ' ',$str);
	return $str;
}
function getmoney222($string)
{
   $value = '';
   $string = trim($string);
   $string = removeHTML($string);
   $string = removeAccent($string);
   if(preg_match("/trieu/",$string) == true)
   {
      if(preg_match("/Hon/",$string) == true)
      {
         if(preg_match("VND",$string) == true)
         {
            $string = str_replace("VND","",$string);
         }
         $string = str_replace("Hon","",$string);
         $string = explode(",",$string);
         $string = $string[0];
         $value = arrss(0,$string);
      }
      else
      {
         $string = str_replace("trieu","",$string);
         $string = trim($string);
         if(preg_match("/-/",$string) == true)
         {
            $arrmn = explode("-",$string);
            $onearr = explode(",",$arrmn[0]);
            $onearr = $onearr[0];
            $onearr = trim($onearr);
            $twoarr = explode(",",$arrmn[1]);
            $twoarr = $twoarr[0];
            $twoarr = trim($twoarr);
            $value =  arrss($onearr,$twoarr);
         }
         else
         {
            $onearr = explode(",",$string);
            $onearr = $onearr[0];
            $value = arrss(0,$onearr);
         }
      }
   }
   else if(preg_match("/VND/",$string) == true)
   {
      if(preg_match("/Hon/",$string) == true)
      {
         if(preg_match("VND",$string) == true)
         {
            $string = str_replace("VND","",$string);
         }
         $string = str_replace("Hon","",$string);
         $string = explode(",",$string);
         $string = $string[0];
         $value = arrss(0,$string+1);
      }
      else
      {
         $string = str_replace("VND","",$string);
         $string = trim($string);
         if(preg_match("/-/",$string) == true)
         {
            $arrmn = explode("-",$string);
            $onearr = explode(",",$arrmn[0]);
            $onearr = $onearr[0];
            $onearr = trim($onearr);
            $twoarr = explode(",",$arrmn[1]);
            $twoarr = $twoarr[0];
            $twoarr = trim($twoarr);
            $value =  arrss($onearr,$twoarr);
         }
         else
         {
            $onearr = explode(",",$string);
            $onearr = $onearr[0];
            $value = arrss(0,$onearr);
         }
      }
   }
   else if(preg_match("/Thuong luong/",$string) == true)
   {
      //echo "Thỏa thuận";
      $value = 1;
   }
   else if(preg_match("/Canh tranh/",$string) == true)
   {
      //echo "Thỏa thuận";
      $value = 1;
   }
   else if(preg_match("/USD/",$string) == true)
   {
      if(preg_match("/Hon/",$string) == true)
      {
         $string = str_replace("USD","",$string);
         $string = str_replace("Hon","",$string);
         $string = str_replace(",","",$string);
         $string = $string * 22000;
         $string = number_format($string);
         $string = explode(",",$string);
         $string = $string[0];
         $value = arrss(0,$string + 2);
      }
      else
      {
         $string = str_replace("USD","",$string);
         $string = str_replace(",","",$string);
         if(preg_match("/-/",$string) == true)
         {
            $arrmn  = explode("-",$string);
            $oneusd = $arrmn[0] * 22000;
            $oneusd = number_format($oneusd);
            $onearr = explode(",",$oneusd);
            $onedola = $onearr[0];
            $twousd = $arrmn[1] * 22000;
            $twousd = number_format($twousd);
            $twoarr = explode(",",$twousd);
            $twodola = $twoarr[0];
            $value = arrss($onedola,$twodola);
         }
         else
         {
            $string = $string * 22000;
            $string = number_format($string);
            $string = explode(",",$string);
            $string = $string[0];
            $value = arrss(0,$string);
         }     
      }
      
   }else{
      if(preg_match("/Tu/",$string) == true)
      {
         $string = str_replace("$","",$string);
         $string = str_replace("Tu","",$string);
         $string = str_replace(",","",$string);
         $string = $string * 22000;
         $string = number_format($string);
         $string = explode(",",$string);
         $string = $string[0];
         $value = arrss(0,$string + 2);
      }
      else
      {
         $string = str_replace("$","",$string);
         $string = str_replace(",","",$string);
         if(preg_match("/-/",$string) == true)
         {
            $arrmn  = explode("-",$string);
            $oneusd = $arrmn[0] * 22000;
            $oneusd = number_format($oneusd);
            $onearr = explode(",",$oneusd);
            $onedola = $onearr[0];
            $twousd = $arrmn[1] * 22000;
            $twousd = number_format($twousd);
            $twoarr = explode(",",$twousd);
            $twodola = $twoarr[0];
            $value = arrss($onedola,$twodola);
         }
         else
         {
            $string = $string * 22000;
            $string = number_format($string);
            $string = explode(",",$string);
            $string = $string[0];
            $value = arrss(0,$string);
         }     
      }
      
   }
   return $value;
}
function arrss($item1,$item2)
{
   $abc = '';
   if($item2 <= 3)
   {
      $abc = 2;
   }
   else if($item2 >3 && $item2 <= 5)
   {
      $abc = 3;
   }
   else if($item2 >5 && $item2 <= 7)
   {
      $abc = 4;
   }
   else if($item2 >7 && $item2 <= 10)
   {
      $abc = 5;
   }
   else if($item2 >10 && $item2 <= 15)
   {
      $abc = 6;
   }
   else if($item2 >15 && $item2 <= 20)
   {
      $abc = 7;
   }
   else if($item2 >20 && $item2 <= 30)
   {
      $abc = 8;
   }
   else if($item2 > 30)
   {
      $abc = 9;
   }
   return $abc;
}
function removeAccent($mystring){
    $marTViet=array(
        // Chữ thường
        "à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
        "è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
        "ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ","Đ","'",
        // Chữ hoa
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
        "Đ","Đ","'"
        );
    $marKoDau=array(
        /// Chữ thường
        "a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
        "e","e","e","e","e","e","e","e","e","e","e",
        "i","i","i","i","i",
        "o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
        "u","u","u","u","u","u","u","u","u","u","u",
        "y","y","y","y","y",
        "d","D","",
        //Chữ hoa
        "A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
        "E","E","E","E","E","E","E","E","E","E","E",
        "I","I","I","I","I",
        "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
        "U","U","U","U","U","U","U","U","U","U","U",
        "Y","Y","Y","Y","Y",
        "D","D","",
        );
    return str_replace($marTViet, $marKoDau, $mystring);
}
function vn_str_filter ($str){
    $str = trim(strtolower($str));
    $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd'=>'đ|Đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',                         
        '-'=>' |%|,|=|;|!',     
    );
    foreach($unicode as $nonUnicode=>$uni){
        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
    }        
    $arrRep = array("'", '"', "+", "?", "=", "*", "?", "/", "!", "~", "#", "@", "%", "$", "^", "&", "(", ")", ";", ":", "\\", ".", ",", "[", "]", "{", "}", "‘", "’", '“', '”');
    $str = str_replace($arrRep, " ", $str);
    $str = str_replace(" ", "-", trim($str));
    $str = str_replace("---",'-',$str);
    $str = str_replace("--",'-',$str);
    return $str;
}
function replaceFCK($string, $type=1){
    $array_fck  = array ("&Agrave;", "&Aacute;", "&Acirc;", "&Atilde;", "&Egrave;", "&Eacute;", "&Ecirc;", "&Igrave;", "&Iacute;", "&Icirc;",
                                "&Iuml;", "&ETH;", "&Ograve;", "&Oacute;", "&Ocirc;", "&Otilde;", "&Ugrave;", "&Uacute;", "&Yacute;", "&agrave;",
                                "&aacute;", "&acirc;", "&atilde;", "&egrave;", "&eacute;", "&ecirc;", "&igrave;", "&iacute;", "&ograve;", "&oacute;",
                                "&ocirc;", "&otilde;", "&ugrave;", "&uacute;", "&ucirc;", "&yacute;",
                                );
    $array_text = array ("À", "Á", "Â", "Ã", "È", "É", "Ê", "Ì", "Í", "Î",
                                "Ï", "Ð", "Ò", "Ó", "Ô", "Õ", "Ù", "Ú", "Ý", "à",
                                "á", "â", "ã", "è", "é", "ê", "ì", "í", "ò", "ó",
                                "ô", "õ", "ù", "ú", "û", "ý",
                                );
    if($type == 1) $string = str_replace($array_fck, $array_text, $string);
    else $string = str_replace($array_text, $array_fck, $string);
    return $string;
}
function removeHTML($string){
    $string = preg_replace ('/<script.*?\>.*?<\/script>/si', ' ', $string);
    $string = preg_replace ('/<style.*?\>.*?<\/style>/si', ' ', $string);
    $string = preg_replace ('/<.*?\>/si', ' ', $string);
    $string = str_replace ('&nbsp;', ' ', $string);
    $string = mb_convert_encoding($string, "UTF-8", "UTF-8");
    $string = str_replace (array(chr(9),chr(10),chr(13)), ' ', $string);
    for($i = 0; $i <= 5; $i++) $string = str_replace ('  ', ' ', $string);
    return $string;
}
function htmlspecialr($str){
	$arrDenied	= array('<', '>', '\"', '"');
	$arrReplace	= array('&lt;', '&gt;', '&quot;', '&quot;');
	$str = str_replace($arrReplace, $arrDenied, $str);
	return $str;
}
function removeLink($string){
	$string = preg_replace ('/<a.*?\>/si', '', $string);
	$string = preg_replace ('/<\/a>/si', '', $string);
	return $string;
}

$ar_cate = array(
    'kế toán/kiểm toán'  => 1,
    'Hành chính-văn phòng'  => 2,
    'Sinh viên làm thêm'    => 3,
    'Xây dựng'  => 4,
    'Điện - Điện tử'    =>  5,
    'Làm bán thời gian' =>  6,
    'Vận tải - lái xe'  =>  7,
    'khách sạn nhà hàng'=>  8,
    'nhân viên kinh doanh' => 9,
    'Việc làm bán hàng'    => 10,
    'Cơ khí chế tạo'    => 11,
    'Lao động phổ thông' => 12,
    'IT phần mềm'   =>  13,
    'Nhập liệu'     =>  43,
    'Giáo dục đào tạo'  =>  17,
    'Kỹ thuật'  =>  18,
    'Y tế dược' =>  19,
    'Quản trị kinh doanh'   => 20,
    'Dịch vu'   =>  21,
    'Biên phiên dịch'   =>  22,
    'Dệt may da giày'   =>  23,
    'Kiến trúc tk nội thất' => 24,
    'Xuất, nhập khẩu'   =>  25,
    'IT Phần cứng mạng' => 26,
    'Nhân sự'   =>  27,
    'Thiết kế mỹ thuật' =>  28,
    'Tư vấn'    => 29,
    'Bảo vệ'    => 30,
    'Oto xe máy'    =>  31,
    'Thư ký trợ lý' =>  32,
    'KD bất động sản'   =>  33,
    'Du lịch'   =>  34,
    'Báo chí truyền hình'   => 35,
    'Thực phẩm đồ uống' =>  36,
    'Ngành nghề khác'   => 37,
    'Vật tư thiết bị'   =>  38,
    'Thiết kế web'  => 39,
    'In ấn xuất bản'    => 40,
    'Nông nâm nghư nghiệp'  =>  41,
    'Thương mại điện tử'    =>  42,
    'Việc làm thêm tại nhà' =>  43,
    'Chăm sóc khách hàng'   => 45,
    'Sinh viên mới tốt nghiệp'  => 46,
    'Kỹ thuật ứng dụng'     =>  47,
    'Bưu chính viễn thông'  => 48,
    'Dầu khí địa chất'  => 49,
    'Giao thông vân tải'    =>  50,
    'Khu chế xuất - khu công nghiệp'    =>  51,
    'Làm đẹp spa'   =>  52,
    'Luật pháp lý'  =>   53,
    'Môi trường , xử lý rác'    =>  54,
    'Mỹ phẩm thời trang'    =>  55,
    'ngân hàng chứng khoáng đầu tư' => 56,
    'Nghệ thuật diện ảnh'   =>  57,
    'Phát triển thị trường' =>  58,
    'Phục vu tạp vụ'    => 59,
    'Quan hệ đối ngoại'   => 60,
    'Quản lý điều hành' => 61,
    'Sản xuất - vận hành sản xuất'  => 62,
    'Thẩm định - giám thẩm định'    =>  63,
    'Thể dục thể thao'  =>  64,
    'Hoá học sinh học'  => 65,
    'Bảo hiểm'  => 66,
    'Freelance' =>  67,
    'Công chức viên chức'   =>  68    
);
?>