<?
include("config.php");

?> <!--<meta http-equiv="refresh" content="5"/>-->
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
$db_qr = new db_query("SELECT * FROM crondetail where isactive=0 ORDER BY id LIMIT 1");

if(mysql_num_rows($db_qr->result) > 0)
{
    $row = mysql_fetch_assoc($db_qr->result); 
    $resultcat=new db_execute("update crondetail set isactive='1' where id='".$row['id']."'");
    $catid=$row['idnn'];
    $urlcat=$row['link']; 
    $html=file_get_html("http://vieclam.laodong.com.vn/ky-tuyen-dung/nhan-vien-bao-ve-11188.html");
    
    
    $arrcapbac=["Tất cả cấp bậc"=>0,
"Mới tốt nghiệp/Thực tập sinh"=>2,
"Nhân viên"=>3,
"Trưởng nhóm/Giám sát"=>4,
"Trưởng (phó) phòng"=>5,
"Phó giám đốc"=>6,
"Giám đốc"=>7,
"Tổng giám đốc điều hành"=>8,
"Phó chủ tịch"=>9,
"Chủ tịch"=>10,
"Kỹ thuật viên/kỹ sư"=>11,
"Quản trị cấp cao"=>12,
"Công nhân/ Công nhân kỹ thuật"=>13,
"Chuyên viên"=>14,
"Giảng viên"=>15];
$arrcity=['An Giang'=>1,
	'Bà Rịa - Vũng Tàu'=>2,
	'Bắc Giang'=>3,
	'Bắc Kạn'=>4,
	'Bạc Liêu'=>5,
	'Bắc Ninh'=>6,
	'Bến Tre'=>7,
	'Bình Định'=>8,
	'Bình Dương'=>9,
	'Bình Phước'=>10,
	'Bình Thuận'=>11,
	'Cà Mau'=>12,
	'Cần Thơ'=>13,
	'Cao Bằng'=>14,
	'Đà Nẵng'=>15,
	'Đắc Lắc'=>16,
	'Đắk Nông'=>17,
	'Điện Biên'=>18,
	'Đồng Nai'=>19,
	'Đồng Tháp'=>20,
	'Gia Lai'=>21,
	'Hà Giang'=>22,
	'Hà Nam'=>23,
	'Hà Nội'=>24,
	'Hà Tây'=>25,
	'Hà Tĩnh'=>26,
	'Hải Dương'=>27,
	'Hải Phòng'=>28,
	'Hậu Giang'=>29,
	'Hòa Bình'=>30,
	'Hưng Yên'=>31,
	'Khánh Hòa'=>32,
	'Kiên Giang'=>33,
	'Kon Tum'=>34,
	'Lai Châu'=>35,
	'Lâm Đồng'=>36,
	'Lạng Sơn'=>37,
	'Lào Cai'=>38,
	'Long An'=>39,
	'Nam Định'=>40,
	'Nghệ An'=>41,
	'Ninh Bình'=>42,
	'Ninh Thuận'=>43,
	'Phú Thọ'=>44,
	'Phú Yên'=>45,
	'Quảng Bình'=>46,
	'Quảng Nam'=>47,
	'Quảng Ngãi'=>48,
	'Quảng Ninh'=>49,
	'Quảng Trị'=>50,
	'Sóc Trăng'=>51,
	'Sơn La'=>52,
	'Tây Ninh'=>53,
	'Thái Bình'=>54,
	'Thái Nguyên'=>55,
	'Thanh Hóa'=>56,
	'Tiền Giang'=>57,
	'Tp. Hồ Chí Minh'=>58,
	'Trà Vinh'=>59,
	'TT Huế'=>60,
	'Tuyên Quang'=>61,
	'Vĩnh Long'=>62,
	'Vĩnh Phúc'=>63,
	'Yên Bái'=>64,
	'Khác'=>65];
    $arrnn=['Bán hàng'=>113,
'Bán hàng kỹ thuật'=>114,
'Bán lẻ/Bán sỉ'=>115,
'Bảo hiểm'=>116,
'Bất động sản'=>117,
'Biên phiên dịch'=>118,
'Cấp quản lý điều hành'=>119,
'Chứng khoán'=>120,
'Cơ khí - Chế tạo/Lắp ráp'=>121,
'Công nghệ cao'=>122,
'Dầu khí - Hóa chất'=>123,
'Dệt may/Da giày'=>124,
'Dịch vụ khách hàng'=>125,
'Dược Phẩm/Công nghệ sinh học'=>126,
'Giáo dục/Đào tạo'=>127,
'Hàng cao cấp'=>128,
'Hàng không/Du lịch/Khách sạn'=>129,
'Hành chính - Văn phòng'=>130,
'Hóa học/Hóa sinh'=>131,
'Hoạch định/Dự án'=>132,
'Internet/Online Media'=>133,
'IT - Phần mềm'=>134,
'IT-Phần cứng/Mạng'=>135,
'Kế toán/ Kiểm toán'=>136,
'Kho vận'=>137,
'Kiểm toán'=>138,
'Kiến trúc/Thiết kế nội thất'=>139,
'Marketing - PR'=>140,
'Mới tốt nghiệp'=>141,
'Môi trường/Xử lý chất thải'=>142,
'Mỹ thuật/Thiết kế'=>143,
'Ngân hàng'=>144,
'Người nước ngoài/Việt Kiều'=>145,
'Nhân sự'=>146,
'Nông nghiệp/Lâm nghiệp'=>147,
'Ô tô - Xe máy'=>148,
'Pháp lý'=>149,
'Phi chính phủ/Phi lợi nhuận'=>150,
'QA/QC'=>151,
'Tiếp thị-Quảng cáo'=>152,
'Sản phẩm công nghiệp'=>153,
'Sản Xuất'=>154,
'Tài chính/Đầu tư'=>155,
'Thời trang/Lifestyle'=>156,
'Thời vụ/Hợp đồng ngắn hạn'=>157,
'Thực phẩm &amp; Đồ uống'=>158,
'Truyền hình/Truyền thông/Báo chí'=>159,
'Tư vấn/Chăm sóc khách hàng'=>160,
'Vận tải - Lái xe'=>161,
'Vật Tư/Thiết bị'=>162,
'Điện tử - Viễn thông'=>163,
'Xây dựng'=>164,
'Xuất nhập khẩu'=>165,
'Y tế - Chăm sóc sức khỏe'=>166,
'Điện/Điện tử'=>167,
'Khác'=>168,
'Nghiên cứu thị trường'=>169,
'Vệ sinh - An toàn lao động'=>170,
'Part time'=>171,
'Gia sư'=>172,
'Việc làm cho sinh viên'=>173,
'Thiết kế đồ họa - web'=>174,
'Kinh doanh'=>175,
'Bảo vệ/Vệ sĩ'=>176,
'Quản lý kho/thủ kho'=>177,
'Điện/Điện lạnh'=>178,
'Lao động phổ thông'=>179,
'Kỹ thuật'=>180,
'Quản trị kinh doanh'=>181,
'Thương mại điện tử'=>182,
'Thư ký - trợ lý'=>183,
'In ấn - Xuất bản'=>184,
'Nghệ thuật/ Điện ảnh/ Giải trí'=>185,
'Quan hệ đối ngoại'=>186,
'Làm bán thời gian'=>187,
'Công nghệ thông tin'=>188,
'Bưu chính'=>189,
'Chăn nuôi - Thú y'=>191,
'Promotion Girl (PG)'=>192,
'Hàng hải'=>193,
'Giao nhận, vận chuyển'=>194,
'Tự động hóa'=>195,
'Công nhân'=>196,
'Kỹ thuật ứng dụng'=>197,
'Chế tác trang sức, đá quý/Đồ mỹ nghệ'=>198,
'Giáo viên'=>199,
'Giảng viên Quản trị KD, Truyền thông đa phương tiện, Luật'=>200,
'Mỹ phẩm/Chăm sóc sắc đẹp'=>201,
'Kinh doanh bảo hiểm phi nhân thọ'=>202,
'PB'=>203,
'mỏ - địa chất công trình'=>204,
'Thương mại quốc tế'=>205];
    /*
    .featured-info-content .name title
    .featured-info-content .building cong ty
    .featured-info-content .addres dia chi
    .featured-info-content .phone dien thoai
    .featured-info-content .website website
    .content #cphMainContent_lblDescription mo ta cong viec
    .content #cphMainContent_lblRequirements yeu cau cong viec
    .content #cphMainContent_pnNegotiableSalary muc luong thoa thuan
    .content #cphMainContent_pnFixedSalary muc luong thuong
    .content #cphMainContent_lblOtherAdvanced quyen loi
    .content #cphMainContent_lblJobLevelID cap bac
    .content #cphMainContent_lblWorkLocationID thanh pho
    .content #cphMainContent_lblExpiryDate han nop
    .content #cphMainContent_lblContactAddress dia chi lien he
    .content #cphMainContent_lblContactPerson nguoi lien he
    .content #cphMainContent_lblContactPhone so dien thoai lien he
    .content #cphMainContent_lblContactEmail email lien he
    .content #cphMainContent_lblMinAge do tuoi 1
    .content 2 yeu cau ho so
    */
    $title=$html->find('.featured-info-content .name #cphMainContent_lblTitle',0);
    echo $title."<hr/>";
    $namecom=$html->find('.featured-info-content .building',0)->plaintext;
    echo $namecom."<hr/>";
    $addresscom=$html->find('.featured-info-content .addres span',0)->plaintext;
    echo $addresscom."<hr/>";
     $phonecom=$html->find('.featured-info-content .phone span',0)->plaintext;
    echo $phonecom."<hr/>";
     $webcom=$html->find('.featured-info-content .website a',0)->plaintext;
    echo $webcom."<hr/>";
    $nganhnghe=$html->find('.content #cphMainContent_lblJobCategoryID',0)->plaintext;
    $arrtg=explode(',',$nganhnghe);
    $nn="";
    for($i=0;$i<count($arrtg);$i++){
        $nn[]=$arrnn[trim($arrtg[$i])];
    }
    echo join(',',$nn)."<hr/>";
    
    $capbac=$html->find('.content #cphMainContent_lblJobLevelID',0)->innertext;
    echo $arrcapbac[$capbac]."<hr/>";
    $mucluong=$html->find('.content #cphMainContent_pnNegotiableSalary',0)->innertext;
    if(empty($mucluong)){
        $mucluong=$html->find('.content #cphMainContent_pnFixedSalary .row',0)->innertext;
        $mucluong.=$html->find('.content #cphMainContent_pnFixedSalary .row',1)->innertext;
    }
    echo $mucluong."<hr/>";
    $mota=$html->find('.content #cphMainContent_lblDescription',0)->innertext;
    echo $mota."<hr/>";
    $yeucau=$html->find('.content #cphMainContent_lblRequirements',0)->innertext;
    echo $yeucau."<hr/>";
    $quyenloi=$html->find('.content #cphMainContent_lblOtherAdvanced',0)->innertext;
    echo $quyenloi."<hr/>";
    $noilamviec=$html->find('.content #cphMainContent_lblWorkLocationID',0)->plaintext;
    echo $arrcity[trim($noilamviec)]."<hr/>";
    $hannop=$html->find('.content #cphMainContent_lblExpiryDate',0)->plaintext;
    $hannop=explode('/',$hannop);
    echo strtotime( $hannop[2]."-".$hannop[1]."-".$hannop[0])."<hr/>";
    $diachilh=$html->find('.content #cphMainContent_lblContactAddress',0)->innertext;
    echo $diachilh."<hr/>";
    $tenlh=$html->find('.content #cphMainContent_lblContactPerson',0)->innertext;
    echo $tenlh."<hr/>";
    $phonelh=$html->find('.content #cphMainContent_lblContactPhone',0)->innertext;
    echo $phonelh."<hr/>";
    $emaillh=$html->find('.content #cphMainContent_lblContactEmail',0)->innertext;
    echo $emaillh."<hr/>";
    $yeucauhoso=$html->find('.content',2)->innertext;
    echo $yeucauhoso."<hr/>";
    $meta_title=$title." ".$namecom;
    $meta_desc="tuyển dụng ".$title." ".$namecom;
    $meta_keywork=$title;
    $data_post = array('new_title'           => $title,
                     'new_cat_id'           => join(',',$nn),
                     'new_chuc_vu'          => $arrcapbac[$capbac],
                     'new_city'             => $arrcity[trim($noilamviec)],
                     'new_money_cra'        => $mucluong,                     
                     'new_han_nop'          => strtotime( $hannop[2]."-".$hannop[1]."-".$hannop[0]),   
                     'new_mo_ta'            => $mota.$yeucau.$quyenloi,
                     'new_yeu_cau'          => $yeucau,
                     'new_lh_cra'           => $addresscom,
                     'new_company_cra'      => $namecom,
                     'new_address_cra'      => $addresscom,
                     'new_quyen_loi'        => $quyenloi,
                     'new_name_user'        => $tenlh,
                     'new_email_user'       => $emaillh,
                     'new_phone_user'       => $phonelh,
                     'new_info'             => $info,
                     'new_website'          => $webcom,
                     'linklogo'             => $linklogo,
                     'usc_type'             => $quymo_ct,
                     'new_ho_so'            => $yeucauhoso,
                     'new_exp'              => 0,
                     'new_bang_cap'         => 0,
                     'new_so_luong'         => 0,
                     'new_hinh_thuc'        => 1,
                     'luatweb'              => 1,
                     'meta_title'=>$meta_title,
                     'meta_desc'=>$meta_desc,
                     'meta_keywork'=>$meta_keywork
                     );
                     
$url = 'https://vieclam24h.net.vn/cron/cron/tu_get_data_rasu.php';
if($new_title != '')
{
      $curl = new cURL;
      
      echo $curl->post_no_header($url,$data_post);
}
    
}
?>