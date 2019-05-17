<?php
    header('Content-Type: text/html; charset=utf-8');	   
    
    function gindex(){
        require_once 'simple_html_dom_helper.php';   
        $newtime = strtotime(date('d-m-Y'));
        $html = file_get_html('https://www.timviecnhanh.com/tuyen-nhan-vien-ky-thuat-co-dien-ta-i-ha-no-i-3121130.html');
        $pattern = '#left-content';
        $item = array();
        //Lấy thông tin nhà tuyển dụng
        $cp_link = $html->find('#employer-viewall a',0)->href;

        $html_cp = file_get_html($cp_link);
        $cp_title = $html->find('.box_vnb_right .title-employer',0)->plaintext;
        
        $cp_logo = $html_cp->find('.logo-company img',0)->src;
        foreach($html_cp->find('.summay-company > p') as $cpm){
            $check = explode(':',$cpm->plaintext);
            if(trim($check[0])=='Địa chỉ'){
                $cp_address = trim($check[1]);
            }
            elseif(trim($check[0])=='Website'){
                $cp_web = trim($check[1]);
            }else{
                $cp_content = $cpm->innertext;
            }
        }
        $alias = vn_str_filter($cp_title);
        $type_img = end(explode('/', $cp_logo));
        $timg = end(explode('.', $type_img));
        $logo = $alias.'.'.$timg;            
        if($cp_logo==''){
            $logo='';
        }else{
            //$imageData = file_get_contents('http://cdn.timviecnhanh.com/asset/home/img/employer/5566d81c74b41_1432803356_140x140.png');
            //file_put_contents('tmp/5566d81c74b41_1432803356_140x140.png', $imageData);die;
            $ch = curl_init('http://cdn.timviecnhanh.com/asset/home/img/employer/5566d81c74b41_1432803356_140x140.png');
            $fp = fopen('tmp/'.$logo, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);die;
            demo('', $logo);
        }
        $data_cp = array(
            'name'          =>  $cp_title,
            'logo'          =>  $logo,
            'address'       =>  $cp_address,
            'website'       =>  $cp_web,
            'cp_content'    =>  $cp_content
        );

        $html_cp->clear();
        unset($html_cp);
        //Chi tiết tin tuyển dụng
        foreach($html->find($pattern) as $el){   
            $title = $el->find('h1.title',0)->plaintext;     
            $time = $el->find('.entry-date',0)->plaintext;
            foreach ($el->find('.col-xs-4 li') as $e) {
               $check = explode(':',$e->plaintext);
               if(trim($check[0])=='- Mức lương'){
                $mucluong = trim($check[1]);
               }
               if(trim($check[0])=='- Kinh nghiệm'){
                $kinhnghiem = trim($check[1]);
               }
               if(trim($check[0])=='- Trình độ'){
                $trinhdo = trim($check[1]);
               }
               if(trim($check[0])=='- Tỉnh/Thành phố'){
                $citys = trim($check[1]);
               }
               if(trim($check[0])=='- Ngành nghề'){
                $categories = trim($check[1]);
               }
               if(trim($check[0])=='- Số lượng tuyển dụng'){
                $soluong = trim($check[1]);
               }
               if(trim($check[0])=='- Giới tính'){
                $gioitinh = trim($check[1]);
               }
               if(trim($check[0])=='- Tính chất công việc'){
                $tinhchat = trim($check[1]);
               }
               if(trim($check[0])=='- Hình thức làm việc'){
                $hinhthuc = trim($check[1]);
               }
            }
            //////
            foreach ($el->find('table tr') as $e) {
                if(trim($e->find('td',0)->plaintext) == 'Mô tả'){
                    $mota = trim($e->find('td',1)->innertext);
                }
                if(trim($e->find('td',0)->plaintext) == 'Yêu cầu'){
                    $yeucau = trim($e->find('td',1)->innertext);
                }
                if(trim($e->find('td',0)->plaintext) == 'Quyền lợi'){
                    $quyenloi = trim($e->find('td',1)->innertext);
                }
                if(trim($e->find('td',0)->plaintext) == 'Hạn nộp'){
                    $hannop = trim($e->find('td',1)->plaintext);
                }
                if(trim($e->find('td',0)->plaintext) == 'Người liên hệ'){
                    $nguoilh = trim($e->find('td',1)->plaintext);
                }
                if(trim($e->find('td',0)->plaintext) == 'Địa chỉ'){
                    $diachi = trim($e->find('td',1)->plaintext);
                }
            }
        }
        echo '<p>Tiêu đề: '.$title.'</p>';
        echo '<p>Time: '.$time.'</p>';
        echo '<p>Mức lương: '.$mucluong.'</p>';
        echo '<p>Kinh nghiệm: '.$kinhnghiem.'</p>';
        echo '<p>Trình độ: '.$trinhdo.'</p>';
        echo '<p>Tỉnh thành: '.$citys.'</p>';
        echo '<p>Ngành nghề: '.$categories.'</p>';
        echo '<p>Số lượng: '.$soluong.'</p>';
        echo '<p>Giới tính: '.$gioitinh.'</p>';
        echo '<p>Tính chất: '.$tinhchat.'</p>';
        echo '<p>Hình thức: '.$hinhthuc.'</p>';
        echo '<p>Mô tả: '.$mota.'</p>';
        echo '<p>Yêu cầu: '.$yeucau.'</p>';
        echo '<p>Quyền lợi: '.$quyenloi.'</p>';
        echo '<p>Hạn nộp: '.$hannop.'</p>';
        echo '<p>Người liên hệ: '.$nguoilh.'</p>';
        echo '<p>Địa chỉ: '.$diachi.'</p>';
        $data = array(
            'title'     =>      $title,
            'time'      =>      $time,
            'mucluong'  =>      $mucluong,
            'kinhnghiem'=>      $kinhnghiem,
            'trinhdo'   =>      $trinhdo,
            'citys'     =>      $citys,
            'categories'=>      $categories,
            'soluong'   =>      $soluong,
            'gioitinh'  =>      $gioitinh,
            'tinhchat'  =>      $tinhchat,
            'hinhthuc'  =>      $hinhthuc,
            'mota'      =>      $mota,
            'yeucau'    =>      $yeucau,
            'quyenloi'  =>      $quyenloi,
            'hannop'    =>      $hannop,
            'nguoilh'   =>      $nguoilh,
            'diachi'    =>      $diachi
        );
        
        //End left content
        
        $html->clear();
        unset($html);
    }
    gindex();
    function demo($basetmp,$image){
        require_once 'lib_image.php';
        $tmp = $basetmp.'tmp/'. $image;
        $folder = 'upload/company/'.date('mY');
        $foldersub = 'upload/company/thumb/'.date('mY');
        if(!is_dir($folder)){
            mkdir($folder, 0755, TRUE);
            mkdir($foldersub, 0755, TRUE);
        }
        if(file_exists($tmp)){
            $imageThumb = new Image($tmp);                         
            $temp=explode('.',$image);  
            if($imageThumb->getWidth()>300){
                $imageThumb->resize(300,'resize');
            }
            $imageThumb->save($temp[0], $basetmp.$folder, $temp[1]); 
            
            $imageThumb->resize(80,'resize');
            $imageThumb->save($temp[0], $basetmp.$foldersub, $temp[1]);

            //unlink($tmp);
        }
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
        $str = str_replace('?','',$str);
        $str = str_replace('"','',$str);
        $str = str_replace('“','',$str);
        $str = str_replace('”','',$str);
        $str = str_replace("'",'',$str);
        $str = str_replace("---",'-',$str);
        $str = str_replace("--",'-',$str);
        return $str;
    }
?>
