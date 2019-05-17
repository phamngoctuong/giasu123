<? 

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
    $str = str_replace('?','',$str);
    $str = str_replace('"','',$str);
    $str = str_replace('“','',$str);
    $str = str_replace('”','',$str);
    $str = str_replace("'",'',$str);
    $str = str_replace("---",'-',$str);
    $strs = str_replace("--",'-',$str);
    return $strs;
}

function searchhome($key,$subject,$place,$lophoc,$result,$result_sj,$result_lh)
    {
        $tinhthanh="";
        $monhoc="";

        if(intval($subject)>0){
            $monhoc = $result_sj[$subject]['SubjectName'];
        }

        if(intval($place)>0){
			$tinhthanh = $result[$place]['cit_name'];
		}

		if(intval($lophoc)>0){
			$class = $result_lh[$lophoc]['name'];
		}

        
        $link='';

        if(intval($key)==1){
					if(intval($lophoc)>0){ // nếu có giá trị tham số lớp học truyền vào.
						if(intval($subject)>0 && intval($place)>0){
								$link="https://vieclam123.vn/"."gia-su-".vn_str_filter($monhoc)."-".vn_str_filter($class)."-tai-".vn_str_filter($tinhthanh)."-s$subject"."c$place"."r$lophoc.html";
						}else if((intval($subject)==0) && (intval($place)==0)){
								$link="https://vieclam123.vn/"."gia-su-".vn_str_filter($class)."-s$subject"."c$place"."r$lophoc.html";
						}else if((intval($subject)> 0) && (intval($place)==0)){
								$link="https://vieclam123.vn/"."gia-su-".vn_str_filter($monhoc)."-".vn_str_filter($class)."-s$subject"."c$place"."r$lophoc.html";
						}else if((intval($subject)== 0) && (intval($place)> 0)){
								$link="https://vieclam123.vn/"."gia-su-".vn_str_filter($class)."-tai-".vn_str_filter($tinhthanh)."-s$subject"."c$place"."r$lophoc.html";
						}
					}else{
						if(intval($subject)>0 && intval($place)>0){
								$link="https://vieclam123.vn/"."gia-su-".vn_str_filter($monhoc)."-tai-".vn_str_filter($tinhthanh)."-s$subject"."c$place"."r$lophoc.html";
						}else if((intval($subject)==0) && (intval($place)==0)){
								$link="https://vieclam123.vn/"."tat-ca-giao-vien";
						}else if((intval($subject)> 0) && (intval($place)==0)){
								$link="https://vieclam123.vn/"."gia-su-".vn_str_filter($monhoc)."-s$subject"."c$place"."r$lophoc.html";
						}else if((intval($subject)== 0) && (intval($place)> 0)){
								$link="https://vieclam123.vn/"."gia-su"."-tai-".vn_str_filter($tinhthanh)."-s$subject"."c$place"."r$lophoc.html";
						}
					}

        }elseif($key==2){
					if(intval($lophoc)>0){
						if(intval($subject)>0 && intval($place)>0){
                $link="https://vieclam123.vn/"."tim-lop-gia-su-".vn_str_filter($monhoc)."-".vn_str_filter($class)."-tai-".vn_str_filter($tinhthanh)."-s$subject"."c$place"."r$lophoc.html";
            }else if((intval($subject)==0) && (intval($place)==0)){
								$link="https://vieclam123.vn/"."tim-lop-gia-su-".vn_str_filter($class)."-s$subject"."c$place"."r$lophoc.html";
            }else if((intval($subject)> 0) && (intval($place)==0)){
                $link="https://vieclam123.vn/"."tim-lop-gia-su-".vn_str_filter($monhoc)."-".vn_str_filter($class)."-s$subject"."c$place"."r$lophoc.html";
            }else if((intval($subject)== 0) && (intval($place)>0)){
                $link="https://vieclam123.vn/"."tim-lop-gia-su-".vn_str_filter($class)."-tai-".vn_str_filter($tinhthanh)."-s$subject"."c$place"."r$lophoc.html";
            }
					}else{
						if(intval($subject)>0 && intval($place)>0){
                $link="https://vieclam123.vn/"."tim-lop-gia-su-".vn_str_filter($monhoc)."-tai-".vn_str_filter($tinhthanh)."-s$subject"."c$place"."r$lophoc.html";
            }else if((intval($subject)==0) && (intval($place)==0)){
								$link="https://vieclam123.vn/"."tat-ca-lop-hoc";
            }else if((intval($subject)> 0) && (intval($place)==0)){
                $link="https://vieclam123.vn/"."tim-lop-gia-su-".vn_str_filter($monhoc)."-s$subject"."c$place"."r$lophoc.html";
            }else if((intval($subject)== 0) && (intval($place)>0)){
                $link="https://vieclam123.vn/"."tim-lop-gia-su"."-tai-".vn_str_filter($tinhthanh)."-s$subject"."c$place"."r$lophoc.html";
            }
					}
        }

        return $link;
    }


?>