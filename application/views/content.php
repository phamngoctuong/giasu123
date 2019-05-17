<?php
$CI=&get_instance();
$CI->load->model('site/site_model');
$footer=$CI->site_model->getconfig();
$check=false;
$taohoso=site_url('dang-ky-chung');
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
    if($tg['Type']==0){
        $taohoso=site_url('mn-hv-dang-tin');
        $text = "Đăng Tin Miễn Phí";
        $img1 = "fa fa-external-link";
        $giasu = site_url('tim-gia-su');
        $icongiasu = "images/tim-gia-su.png";
        $namegiasu = "TÌM GIA SƯ";
        $lophoc = site_url('tim-lop-gia-su');
        $iconlophoc= "images/tim-lop-hoc.png";
        $namelophoc = "TÌM LỚP GIA SƯ";


    }else if($tg['Type']==1){
        $taohoso=site_url('mn-gia-su-cap-nhat-thong-tin');
        $text = "Cập Nhật Hồ Sơ";
        $img1 = "fa fa-file-text";
        $giasu = site_url('tim-gia-su');
        $icongiasu = "images/tim-gia-su.png";
        $namegiasu = "TÌM GIA SƯ";
        $lophoc = site_url('tim-lop-gia-su');
        $iconlophoc= "images/tim-lop-hoc.png";
        $namelophoc = "TÌM LỚP GIA SƯ";

    }else if($tg['Type']==3){
        $taohoso=site_url('mn-candi-updateinfo');
        $text = "Cập Nhật Hồ Sơ";
        $img1 = "fa fa-file-text";
        $giasu = site_url('viec-lam-full-time');
        $icongiasu = "images/tim-viec-lam.png";
        $namegiasu = "TÌM VIỆC LÀM";

        $lophoc = site_url('nguoi-tim-viec.html');
        $iconlophoc= "images/tim-ung-vien.png";
        $namelophoc = "TÌM ỨNG VIÊN";

    }else{
      $text = "Đăng Tin Miễn Phí";
      $img1 = "fa fa-external-link";
      $giasu = site_url('viec-lam-full-time');
      $icongiasu = "images/tim-viec-lam.png";
      $namegiasu = "TÌM VIỆC LÀM";
      $lophoc = site_url('nguoi-tim-viec.html');
      $iconlophoc= "images/tim-ung-vien.png";
      $namelophoc = "TÌM ỨNG VIÊN";

      $userid=$tg['UserId'];
      $companyid=$this->db->select('usc_id');
      $companyid=$this->db->get_where('user_company',array('UserID'=>$userid))->row();
       if($companyid->usc_id!=0){
          $taohoso=site_url('mn-company-addnew');
       }else{

          $taohoso=site_url('mn-company-updateinfo');
       }
    }
    $check=true;
    }
?>
<!-- Main Banner Section Start -->
    <div class="container">
        <!--<div class="breaking-news">
          <div class="col-md-2">
            <div class="row"><span class="title">Cập nhật hôm nay!</span>
            </div>
          </div>
          <div class="col-md-10">
            <div class="row">
                <span class="text">
                 Có <span class="text-danger-B">30.196</span> việc làm mới hôm nay trong <span class="text-danger-B">56.000</span> việc làm đang tuyển dụng
                 <a rel="nofollow" href="" class="text-danger-C">
                     <span class="icon icon-xs icon-2-arrow"></span>
                     BẤM XEM NGAY!<img src="images/icxn.png" alt="#">
                 </a>
              </span>
            </div>
          </div>
       </div>
       <div class="banner_home1"><a rel="nofollow" href="#" title="#"><img src="images/banner1.png" alt="#"></a></div>-->
       <div class="box_4">
       <?php if(!$check){ ?>
       <a rel="nofollow"  href="<?php echo base_url(); ?>dang-nhap-chung" title="Đăng nhập" ><i class="fa fa-lock"></i><span>Đăng nhập</span></a>
       <a rel="nofollow" href="<?php echo base_url() ?>dang-ky-chung" title="đăng ký"><i class="fa fa-edit"></i><span style="">Đăng ký</span></a>
       <a rel="nofollow" href="javascript:void(0)" target="_blank"  title="Tài liệu gia sư"><i class="fa fa-file-o"></i><span>TÀI LIỆU GIA SƯ</span></a>
       <a rel="nofollow" href="<?php echo site_url('dang-ky-chung') ?>" title="Tạo hồ sơ"><i class="fa fa-file-text"></i><span>TẠO HỒ SƠ</span></a>
     <?php } else{?>

              <!--class="active"-->
          <a rel="nofollow" href="<?php echo $giasu; ?>"   title="Đăng tin tìm gia sư"><img src="<?php echo $icongiasu;?>"></i><span><?php echo $namegiasu?></span></a>
          <a rel="nofollow" href="<?php echo $lophoc; ?>"   title="Đăng tin tìm lớp"><img src="<?php echo $iconlophoc;?>"></i><span><?php echo $namelophoc?></span></a>

          <a rel="nofollow" href="<?php echo $taohoso; ?>" title="Đăng tin miễn phí"><i class= "<?php echo $img1; ?>" ></i><span><?php echo $text ?></span></a>
          <?php }?>
       </div>
       <hr class="timeline" style="width: 40%;">
    </div>
    <div class="clearfix"></div>
    <section class="video-sec dark padd-top-30 padd-bot-30" id="video" style="background-image:url(images/banner-10.jpg);">
				<div class="container">
          <div class="text-info">
        <h1 style="margin-bottom:20px" >VIỆC LÀM 123</h1>
        <!-- <p style="font-size:20px;line-height:35px">Tặng mỗi tài khoản <span style="color:#ffb11b">5 điểm miễn phí mỗi ngày</span> để xem thông tin Gia sư - Phụ huynh</p> -->
        <p style="font-size:25px;line-height:35px"><span style="color:#ffb11b;font-weight:bold;">TÌM KIẾM GIA SƯ - ỨNG VIÊN MIỄN PHÍ - KHÔNG QUA TRUNG TÂM - KHÔNG PHÍ NHẬN LỚP</span></p>
                    </div>
				</div>
			</section>

    <div class="clearfix"></div>
    <div class="container col-popover">
        <div class="tit_hd">
         <div class="ir_h3"><h2><span>Gia sư tiêu biểu</span></h2>
         </div>
         <a rel="nofollow" href="<?php echo base_url(); ?>tat-ca-giao-vien" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="tất cả gia sư"/></a>
        </div>
        <div class="">
            <div class="giasutieubieu row">
                <?php if(!empty($tinmoinhat)){

                  foreach($tinmoinhat as $n){

                    ?><div class="col-md-3 col-sm-12 featureitem">
                            <div class="item_hd vip" data-object="<?php echo $n->UserID ?>" data-type="<?php echo $n->UserID ?>" >
                               <div class="company_logo">
                                  <a rel="nofollow" href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>">
                                    <?php if(!empty($n->Image)){?>
                                        <img src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),240,175,80) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="<?php echo $n->Name?>" />
                                    <?php }else{ ?>
                                     <img src="/images/no-image2.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>
                                  </a>
                               </div>
                               <div class="right_item">
                                    <a rel="nofollow" href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>" class="title_co"><?php echo $n->Name ?> </a>
                                  <a title="<?php echo $n->Name ?>" class="title_new"><?php $search=' ,'; $replace=', '; $title= $n->TitleView;echo str_replace($search,$replace,$title); ?></a>
                                  <span class="money_item">
                                    <?php
                                      $money=$n->Free;
                                      if($money>0){
                                        echo 'Từ: <span>'.number_format($money).' vnđ/buổi</span>';
                                      }else{
                                        echo '<span>Thỏa thuận</span>';
                                      }
                                     ?>
                                    </span>
                                  <span class="time_item"><?php echo $n->CityName ?></span>
                               </div>
                            </div>
                        </div>
                  <?php
                     } }
                    ?>
            </div>
        </div>

    </div>
    <div class="clearfix"></div>
    <section class="padd-top-20 padd-bot-20">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 padd-r-5">
              <div class="vl_lc">
                <div class="tit_hd">
                    <div class="ir_h3">
                       <h2><span>Các lớp cần tìm gia sư</span></h2>
                    </div>
                    <a rel="nofollow" href="<?php echo base_url()?>tat-ca-lop-hoc" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="Các lớp tìm gia sư"/></a>
                 </div>
             <div class="main_lc">
                 <?php if(!empty($vansudia)){

                      foreach($vansudia as $n){

                        ?>
                            <div class="item_lc">
                                <div class="col-md-3 col-sm-12 padd-0">
                                    <div class="giasu_logo">
                                      <a rel="nofollow" href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" title="<?php echo $n->ClassTitle ?>">
                                        <?php if(!empty($n->Image) || strlen($n->Image) > 5){?>
                                            <img src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),174,174,80) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="no image" /><!-- onerror='this.onerror=null;this.src="images/no-image2.png";'-->
                                        <?php }else{ ?>
                                         <img src="<?= gethumbnail('/images/no-image2.png','no-image2.png',strtotime($n->CreateDate),174,174,80) ?>" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                         <?php } ?>
                                      </a>
                                   </div>
                                </div>
                                <div class="col-md-9 col-sm-12 padd-r-0">
                                    <div class="giasu_info">
                                        <a rel="nofollow" href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" title="<?php echo $n->ClassTitle ?>" class="giasu_name"><?php echo $n->ClassTitle ?></a>
                                        <div title="Thành viên" class="giasu_titleview"><span>Thành viên: </span><?php
                                        echo $n->Name;

                                        ?><a rel="nofollow"><?php echo Getcitybyindex($n->City) ?></a></div>
                                        <?php if($n->Money > 0){ ?>
                                        <span class="giasu_luong">Từ: <span><?php echo number_format($n->Money)." vnđ/buổi" ?></span></span>
                                        <?php }else{ ?>
                                            <span class="giasu_luong"><span>Thỏa thuận</span></span>
                                        <?php } ?>
                                        <span>&nbsp;&nbsp;&nbsp;<?php echo date('d/m/Y',strtotime($n->CreateDate)) ?></span>
                                        <p><?php
                                            $gn_text=$n->DescClass;
                                                    if ( strlen( $n->DescClass ) > 175 ) {
                                						   $gn_text = substr( $n->DescClass, 0, 175 );
                                						   $space   = strrpos( $gn_text, ' ' );
                                						   $gn_text = substr( $gn_text, 0, $space ). '...';
                                					  }
                                                    echo $gn_text ;

                                         ?></p>
                                    </div>
                                </div>
                            </div>
                      <?php
                         } }
                        ?>
             </div>
          </div>
            </div>
            <div class="col-md-4 col-sm-12">


                <div class="box_job_search user padd-top-20">
        	        <h3>TÌM KIẾM VIỆC LÀM THÊM</h3>
        	        <div class="main_sc">
        	        	<form action="" method="post">
        	        		<div class="input">
        		        		<input type="text" name="findkeylt" id="findkeylt" placeholder="Nhập từ khóa..." />
        		        	</div>
        		        	<div class="input">
        		        		<span class="icon-before"><img src="images/s_01.png" alt="ngành nghề"></span>
        						<select id="monhoc" name="monhoc" class="nganhnghelt">
        							<option value="">Chọn ngành nghề</option>
                                    <option data-tokens="1" value="1">Kế toán - Kiểm toán</option><option data-tokens="2" value="2">Hành chính - Văn phòng</option>
                                                                        <option data-tokens="3" value="3">Sinh viên làm thêm</option>
                                                                        <option data-tokens="4" value="4">Xây dựng</option>
                                                                        <option data-tokens="5" value="5">Điện - Điện tử</option>
                                                                        <option data-tokens="6" value="6">Làm bán thời gian</option>
                                                                        <option data-tokens="7" value="7">Vận tải - Lái xe</option>
                                                                        <option data-tokens="8" value="8">Khách sạn - Nhà hàng</option>
                                                                        <option data-tokens="9" value="9">Nhân viên kinh doanh</option>
                                                                        <option data-tokens="10" value="10">Việc làm bán hàng</option>
                                                                        <option data-tokens="11" value="11">Cơ khí - Chế tạo</option>
                                                                        <option data-tokens="12" value="12">Lao động phổ thông</option>
                                                                        <option data-tokens="13" value="13">IT phần mềm</option>
                                                                        <option data-tokens="14" value="14">Marketing-PR</option>
                                                                        <option data-tokens="17" value="17">Giáo dục-Đào tạo</option>
                                                                        <option data-tokens="18" value="18">Kỹ thuật</option>
                                                                        <option data-tokens="19" value="19">Y tế-Dược</option>
                                                                        <option data-tokens="20" value="20">Quản trị kinh doanh</option>
                                                                        <option data-tokens="21" value="21">Dịch vụ</option>
                                                                        <option data-tokens="22" value="22">Biên-Phiên dịch</option>
                                                                        <option data-tokens="23" value="23">Dệt may - Da giày</option>
                                                                        <option data-tokens="24" value="24">Kiến trúc - Tk nội thất</option>
                                                                        <option data-tokens="25" value="25">Xuất,nhập khẩu</option>
                                                                        <option data-tokens="26" value="26">IT Phần cứng-mạng</option>
                                                                        <option data-tokens="27" value="27">Nhân sự</option>
                                                                        <option data-tokens="28" value="28">Thiết kế - Mỹ thuật</option>
                                                                        <option data-tokens="29" value="29">Tư vấn</option>
                                                                        <option data-tokens="30" value="30">Bảo vệ</option>
                                                                        <option data-tokens="31" value="31">Ô tô - xe máy</option>
                                                                        <option data-tokens="32" value="32">Thư ký-Trợ lý</option>
                                                                        <option data-tokens="33" value="33">KD bất động sản</option>
                                                                        <option data-tokens="34" value="34">Du lịch</option>
                                                                        <option data-tokens="35" value="35">Báo chí-Truyền hình</option>
                                                                        <option data-tokens="36" value="36">Thực phẩm-Đồ uống</option>
                                                                        <option data-tokens="37" value="37">Ngành nghề khác</option>
                                                                        <option data-tokens="38" value="38">Vật tư-Thiết bị</option>
                                                                        <option data-tokens="39" value="39">Thiết kế web</option>
                                                                        <option data-tokens="40" value="40">In ấn - Xuất bản</option>
                                                                        <option data-tokens="41" value="41">Nông-Lâm-Ngư-Nghiệp</option>
                                                                        <option data-tokens="42" value="42">Thương mại điện tử</option>
                                                                        <option data-tokens="43" value="43">Nhập liệu</option>
                                                                        <option data-tokens="44" value="44">Việc làm thêm tại nhà</option>
                                                                        <option data-tokens="45" value="45">Chăm sóc khách hàng</option>
                                                                        <option data-tokens="46" value="46">Sinh viên mới tốt nghiệp -
 Thực tập</option>
                                                                        <option data-tokens="47" value="47">Kỹ thuật ứng dụng</option>
                                                                        <option data-tokens="48" value="48">Bưu chính viễn thông</option>
                                                                        <option data-tokens="49" value="49">Dầu khí -
 Địa chất</option>
                                                                        <option data-tokens="50" value="50">Giao thông vận tải -
 Thủy lợi - Cầu đường</option>
                                                                        <option data-tokens="51" value="51">Khu chế xuất - Khu công nghiệp</option>
                                                                        <option data-tokens="52" value="52">Làm đẹp -
 Thể lực -
 Spa</option>
                                                                        <option data-tokens="53" value="53">Luật - Pháp lý</option>
                                                                        <option data-tokens="54" value="54">Môi trường - Xử lý chất thải</option>
                                                                        <option data-tokens="55" value="55">Mỹ phẩm -
 Thời trang -
 Trang sức</option>
                                                                        <option data-tokens="56" value="56">Ngân hàng - Chứng khoán - Đầu tư</option>
                                                                        <option data-tokens="57" value="57">Nghệ thuật - Điện ảnh</option>
                                                                        <option data-tokens="58" value="58">Phát triển thị trường</option>
                                                                        <option data-tokens="59" value="59">Phục vụ -
 Tạp vụ -
 Giúp việc</option>
                                                                        <option data-tokens="60" value="60">Quan hệ đối ngoại</option>
                                                                        <option data-tokens="61" value="61">Quản lý điều hành</option>
                                                                        <option data-tokens="62" value="62">Sản xuất -
 Vận hành sản xuất</option>
                                                                        <option data-tokens="63" value="63">Thẩm định - Giám thẩm định - Quản lý chất lượng</option>
                                                                        <option data-tokens="64" value="64">Thể dục -
 Thể thao</option>
                                                                        <option data-tokens="65" value="65">Hóa học -
 Sinh học</option>
                                                                        <option data-tokens="66" value="66">Bảo hiểm</option>
                                                                        <option data-tokens="67" value="67">Freelancer</option>
                                                                        <option data-tokens="68" value="68">Công chức - Viên chức </option>
        						</select>
        					</div>
        					<div class="input">
        						<span class="icon-before" style="top:8px"><img src="images/s_02.png" alt="tỉnh thành"></span>
        						<select id="tinhthanh" class="mucluong_ab_tag tinhthanhlt">
                                <option data-tokens="0" value="">Tỉnh thành</option>
                                                                        <option data-tokens="1" value="1">Hà Nội</option>
                                                                        <option data-tokens="45" value="45">Hồ Chí Minh</option>
                                                                        <option data-tokens="49" value="49">An Giang</option>
                                                                        <option data-tokens="47" value="47">Bà Rịa Vũng Tàu</option>
                                                                        <option data-tokens="3" value="3">Bắc Giang</option>
                                                                        <option data-tokens="4" value="4">Bắc Kạn</option>
                                                                        <option data-tokens="50" value="50">Bạc Liêu</option>
                                                                        <option data-tokens="5" value="5">Bắc Ninh</option>
                                                                        <option data-tokens="52" value="52">Bến Tre</option>
                                                                        <option data-tokens="46" value="46">Bình Dương</option>
                                                                        <option data-tokens="51" value="51">Bình Phước</option>
                                                                        <option data-tokens="31" value="31">Bình Thuận</option>
                                                                        <option data-tokens="30" value="30">Bình Định</option>
                                                                        <option data-tokens="53" value="53">Cà Mau</option>
                                                                        <option data-tokens="48" value="48">Cần Thơ</option>
                                                                        <option data-tokens="6" value="6">Cao Bằng</option>
                                                                        <option data-tokens="34" value="34">Gia Lai</option>
                                                                        <option data-tokens="10" value="10">Hà Giang</option>
                                                                        <option data-tokens="11" value="11">Hà Nam</option>
                                                                        <option data-tokens="35" value="35">Hà Tĩnh</option>
                                                                        <option data-tokens="9" value="9">Hải Dương</option>
                                                                        <option data-tokens="2" value="2">Hải Phòng</option>
                                                                        <option data-tokens="56" value="56">Hậu Giang</option>
                                                                        <option data-tokens="8" value="8">Hòa Bình</option>
                                                                        <option data-tokens="12" value="12">Hưng Yên</option>
                                                                        <option data-tokens="28" value="28">Khánh Hòa</option>
                                                                        <option data-tokens="57" value="57">Kiên Giang</option>
                                                                        <option data-tokens="36" value="36">Kon Tum</option>
                                                                        <option data-tokens="14" value="14">Lai Châu</option>
                                                                        <option data-tokens="29" value="29">Lâm Đồng</option>
                                                                        <option data-tokens="15" value="15">Lạng Sơn</option>
                                                                        <option data-tokens="13" value="13">Lào Cai</option>
                                                                        <option data-tokens="58" value="58">Long An</option>
                                                                        <option data-tokens="17" value="17">Nam Định</option>
                                                                        <option data-tokens="37" value="37">Nghệ An</option>
                                                                        <option data-tokens="16" value="16">Ninh Bình</option>
                                                                        <option data-tokens="38" value="38">Ninh Thuận</option>
                                                                        <option data-tokens="18" value="18">Phú Thọ</option>
                                                                        <option data-tokens="39" value="39">Phú Yên</option>
                                                                        <option data-tokens="40" value="40">Quảng Bình</option>
                                                                        <option data-tokens="41" value="41">Quảng Nam</option>
                                                                        <option data-tokens="42" value="42">Quảng Ngãi</option>
                                                                        <option data-tokens="19" value="19">Quảng Ninh</option>
                                                                        <option data-tokens="43" value="43">Quảng Trị</option>
                                                                        <option data-tokens="59" value="59">Sóc Trăng</option>
                                                                        <option data-tokens="20" value="20">Sơn La</option>
                                                                        <option data-tokens="61" value="61">Tây Ninh</option>
                                                                        <option data-tokens="21" value="21">Thái Bình</option>
                                                                        <option data-tokens="22" value="22">Thái Nguyên</option>
                                                                        <option data-tokens="44" value="44">Thanh Hóa</option>
                                                                        <option data-tokens="27" value="27">Thừa Thiên Huế</option>
                                                                        <option data-tokens="60" value="60">Tiền Giang</option>
                                                                        <option data-tokens="62" value="62">Trà Vinh</option>
                                                                        <option data-tokens="23" value="23">Tuyên Quang</option>
                                                                        <option data-tokens="63" value="63">Vĩnh Long</option>
                                                                        <option data-tokens="24" value="24">Vĩnh Phúc</option>
                                                                        <option data-tokens="25" value="25">Yên Bái</option>
                                                                        <option data-tokens="26" value="26">Đà Nẵng</option>
                                                                        <option data-tokens="32" value="32">Đắk Lắk</option>
                                                                        <option data-tokens="33" value="33">Đắk Nông</option>
                                                                        <option data-tokens="7" value="7">Điện Biên</option>
                                                                        <option data-tokens="55" value="55">Đồng Nai</option>
                                                                        <option data-tokens="54" value="54">Đồng Tháp</option>
                             </select>
        					</div>
        					<!--<div class="input">
        						<span class="icon-before"><img src="images/icongioitinh.png" alt=""></span>
        						<select id="gioitinh" class="ngoaingu_ab_tag">
                                    <option value="" ></option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                 </select>
        					</div>-->
        					<div class="input">
        						<span class="icon-before" style="top:8px"><img src="images/iconhinhthuchoc.png" alt="ca làm việc"></span>
        						<select id="hinhthuchoc" class="kinhnghiem_ab_tag calamthem">
                                    <option value="">Chọn ca làm việc</option>
                                    <option value="1">Ca sáng</option>
                                    <option value="2">Ca tối</option>
                                    <option value="3">Thời gian bất kỳ</option>
                                </select>
        					</div>
        					<center><input class="btn btnsearchvlt" type="button" name="submit" value="Tìm kiếm"></center>
        				</form>
        		    </div>
        	    </div>
                <div class="box_hotline">
        	    	<div class="bg1">
        	    		<p>HOTLINE CHO PHỤ HUYNH</p>
        	    		<strong><img src="images/vl9.png" alt="hotline cho phụ huynh">HOTLINE:  0869154226</strong>
        	    	</div>
        	    	<div class="bg2">
        	    		<p>HOTLINE CHO GIA SƯ</p>
        	    		<strong><img src="images/vl10.png" alt="hotline cho gia sư">HOTLINE:  0869154226</strong>
        	    	</div>
        	    </div>
            </div>
        </div>
    </div>
    </section>

<div class="clearfix"></div>
<section class="padd-top-0">
    <div class="container">
        <div class="row">
            <div class="title"><h2 class="text-center" id="h2-text-center">Tài liệu gia sư</h2></div>
            <div class="col-md-6 col-sm-12">
                <div class="home_camnang">
                     <div class="tit_hd">
                        <h3><span>Môn tự nhiên</span></h3>
                        <a rel="nofollow" href="" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="môn tự nhiên"/></a>
                     </div>
                     <div class="main_cn">
                        <div class="row">
                        <?php $news = $this->db->query('SELECT b.id,b.alias,b.title,b.image,b.sapo,b.created_day,c.`name`,c.alias as aliascat,c.id as idcat FROM baiviet as b inner join chuyenmuc as c on b.cid=c.id WHERE b.cid=5 and b.status=1 ORDER BY b.id DESC LIMIT 2');
                                    if($news->num_rows()>0){
                                      foreach($news->result() as $n){
                                    ?>
                                    <div class="col-md-6 col-sm-12 item_cn">
                                       <img src="upload/news/thumb/240/<?php echo $n->image==''?'images-09.jpg':$n->image; ?>" alt="<?php echo $n->title; ?>" title="<?php echo $n->title; ?>"/>
                                       <a rel="nofollow" class="title_cn" href="<?php echo site_url($n->alias.'-b'.$n->id.'.html'); ?>"><?php echo $n->title; ?></a>
                                       <p><?php
                                        $gn_text=$n->sapo;
                                                        if ( strlen( $n->sapo ) > 70 ) {
                                    						   $gn_text = substr( $n->sapo, 0, 70 );
                                    						   $space   = strrpos( $gn_text, ' ' );
                                    						   $gn_text = substr( $gn_text, 0, $space ). '...';
                                    					  }
                                                        echo $gn_text ;
                                                          ?></p>
                                    </div>


                        <?php } } ?>
                        </div>
                     </div>
                  </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="home_camnang">
                     <div class="tit_hd">
                        <h3><span>Môn xã hội</span></h3>
                        <a rel="nofollow" href="" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="môn xã hội"/></a>
                     </div>
                     <div class="main_cn">
                        <div class="row">
                          <?php $news = $this->db->query('SELECT b.id,b.alias,b.title,b.image,b.sapo,b.created_day,c.`name`,c.alias as aliascat,c.id as idcat FROM baiviet as b inner join chuyenmuc as c on b.cid=c.id WHERE b.cid=6 and b.status=1 ORDER BY b.id DESC LIMIT 2');
                                    if($news->num_rows()>0){
                                      foreach($news->result() as $n){
                                    ?>
                                    <div class="col-md-6 col-sm-12 item_cn">
                                       <img src="upload/news/thumb/240/<?php echo $n->image==''?'images-09.jpg':$n->image; ?>" alt="<?php echo $n->title; ?>" title="<?php echo $n->title; ?>"/>
                                       <a rel="nofollow" class="title_cn" href="<?php echo site_url($n->alias.'-b'.$n->id.'.html'); ?>"><?php echo $n->title; ?></a>
                                       <p><?php
                                        $gn_text=$n->sapo;
                                                        if ( strlen( $n->sapo ) > 70 ) {
                                    						   $gn_text = substr( $n->sapo, 0, 70 );
                                    						   $space   = strrpos( $gn_text, ' ' );
                                    						   $gn_text = substr( $gn_text, 0, $space ). '...';
                                    					  }
                                                        echo $gn_text ;
                                                          ?></p>
                                    </div>


                        <?php } } ?>
                        </div>
                     </div>
                  </div>
            </div>
            <div class="clearfix"></div>
            <div class="vl_lc">
                <div class="col-md-12"><div class="tit_hd">
                    <div class="ir_h3">
                       <h3><span>Việc làm thêm mới nhất</span></h3>
                    </div>
                    <a rel="nofollow" href="" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="việc làm thêm"/></a>
                 </div>
                 </div>
                <div class="col-md-6 col-sm-12 padd-r-5 vlthemmoi">
                    <div class="main_itg">
                    <?php
                        if(!empty($parttime)){ $i=0;
                            foreach($parttime as $n){ if($i<3){ ?>
                                <div class="itemnews">
                                    <div class="itemnews_l">
                                        <a rel="nofollow" class="logouser">
                                        <?php if(!empty($n->Image)){?>
                                        <img src="<?= gethumbnail(geturlimagejob($n->usc_create_time).$n->usc_logo,$n->usc_logo,$n->usc_create_time,63,63,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="<?php echo $n->new_title?>" />
                                    <?php }else{ ?>
                                     <img src="images/no-image2.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>
                                     </a>

                                        <span><?php echo date('d/m/Y',$n->new_han_nop) ?></span>
                                    </div>
                                    <div class="itemnews_r">
                                        <a rel="nofollow" href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html"; ?>" class="item-uv-name" title="<?php echo $n->new_title ?>"><?php echo $n->new_title ?></a>
                                        <p><?php echo $n->usc_company ?></p>
                                        <span class="btn btn-freelance"><?php echo GetLuong($n->new_money) ?></span>

                                        <span class="btn"><?php echo Getcitybyindex($n->new_city) ?></span>

                                        <span class="dadenghiday">Số lượng:&nbsp;&nbsp;<?php echo $n->new_so_luong  ?><i class="fa fa-user-dnd"></i></span>
                                    </div>
                                </div>
                            <?php } $i +=1; }
                        }else{
                            echo "<div class='col-md-12'>Không tìm thấy bản ghi.</div>";
                        }
                    ?>

                </div>
                </div>
                <div class="col-md-6 col-sm-12 padd-l-5 vlthemmoi">
                    <div class="main_itg">
                    <?php
                        if(!empty($parttime)){ $i=0;
                            foreach($parttime as $n){ if($i>= 3){ ?>
                                <div class="itemnews">
                                    <div class="itemnews_l">
                                        <a rel="nofollow" class="logouser">
                                        <?php if(!empty($n->Image)){?>
                                        <img src="<?= gethumbnail(geturlimagejob($n->usc_create_time).$n->usc_logo,$n->usc_logo,$n->usc_create_time,63,63,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                    <?php }else{ ?>
                                     <img src="images/no-image2.png" alt="#" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>
                                     </a>
                                        <span><?php echo date('d/m/Y',$n->new_han_nop)  ?></span>
                                    </div>
                                    <div class="itemnews_r">
                                        <a rel="nofollow" href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html"; ?>" class="item-uv-name" title="<?php echo $n->new_title ?>"><?php echo $n->new_title ?></a>
                                        <p><?php echo $n->usc_company ?></p>
                                        <span class="btn btn-freelance"><?php echo GetLuong($n->new_money) ?></span>
                                        <span class="btn"><?php echo Getcitybyindex($n->new_city) ?></span>
                                        <span class="dadenghiday">Số lượng:&nbsp;&nbsp;<?php echo $n->new_so_luong  ?><i class="fa fa-user-dnd"></i></span>
                                    </div>
                                </div>
                            <?php } $i +=1; }
                        }else{
                            echo "<div class='col-md-12'>Không tìm thấy bản ghi.</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--<script src="js/theme6/jquery.slimscroll.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url() ?>combine.php?type=javascript&files=jquery.slimscroll.min.js"  type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
	    var configulr='<?php echo site_url() ?>';
$('#monhoc').select2({ width: '100%',placeholder:"Chọn ngành nghề" });
       /*$('#chudehoc').select2({ width: '100%',placeholder: "Chọn chủ đề"});*/
       $('#gioitinh').select2({ width: '100%',placeholder:"Chọn giới tính" });
       $('#hinhthuchoc').select2({ width: '100%',placeholder:"Chọn ca làm việc" });
       $('#tinhthanh').select2({ width: '100%',placeholder:"Chọn tỉnh thành" });
       /*$('#monhoc').change(function () {
            var monhoc=$(this).val();
            if(monhoc != '' || monhoc !=0){
                    $.ajax(
              {

                  url: configulr+"/site/Ajaxchude",
                  type: "POST",
                  data: { idmon: monhoc },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {

                     if(obj.kq != ''){
                        var reponse=obj.kq;
                        $("#chudehoc option").remove();
                            $("#chudehoc").append(obj.data);

                        $("#chudehoc").select2();
                        }else{

                        }
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
                }
            });*/
            $('.btnsearchvlt').on('click',function(){
        var findkey=$('#findkeylt').val();
        var nganhnghelt=$('.nganhnghelt').val();
        var tinhthanhlt =$('.tinhthanhlt').val();
        var calamthem=$('.calamthem').val();
        if(findkey==''){
            findkey='all';
        }
        if(nganhnghelt==''){
            nganhnghelt=0;
        }
        if(tinhthanhlt==''){
            tinhthanhlt=0;
        }
        if(calamthem==''){
            calamthem=0;
        }
        $.ajax(
              {

                  url: configulr+"/site/ajaxsearchparttime",
                  type: "POST",
                  data: { key:findkey,ca:calamthem,nganh:nganhnghelt,tinh:tinhthanhlt },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          window.location=reponse.data;
                      }

                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
    });
            $('.btnsearchuv').on('click',function(){
        var findkey=$('#findkey').val();
        var strsubj=$('#monhoc').val();
        var strtopic=$('#chudehoc').val();
        var strtinhthanh=$('#tinhthanh').val();
        var strgioitinh=$('#gioitinh').val();
        var strtype=$('#hinhthuchoc').val();
        if(findkey==''){
            findkey='all';
        }
        if(strtopic==''){
            strtopic=0;
        }
        if(place==''){
            place=0;
        }
        $.ajax(
              {

                  url: configulr+"/site/searchteacher",
                  type: "POST",
                  data: { key:findkey,subject:strsubj,topic:strtopic,place:strtinhthanh,type:strtype,sex:strgioitinh },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          window.location=reponse.data;
                      }

                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
    });
	   /*index_dia_diem ,placeholder:"Chọn ngành nghề"*/
if(jQuery(this).scrollTop()<566 && jQuery('hr.timeline').width()!=1170){
	        jQuery('hr.timeline').animate({
	        	'width': '100%'
	        },800);
	    }else{
	        jQuery('hr.timeline').css('width','100%');
	    }
        $('.right_tg').slimscroll({
  height: '400',
  allowPageScroll: true,
});

 $('.giasutt').slimscroll({
  height: '400',
  allowPageScroll: true,
});

$("#keymonhon").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
           $.ajax(
              {

                  url: configulr+"/site/ajaxtimgiasutheomonhoc",
                  type: "POST",
                  data: { monhoc:$("#keymonhon").val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                            $(".right_tg li").remove();
                          /*$("#list_workonline").innerHTML = reponse.data;*/
                            $(".right_tg").append(reponse.data);
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
        }
    });

    $("#keytinhthanh").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
           $.ajax(
              {

                  url: configulr+"/site/ajaxtimgiasutheotinhthanh",
                  type: "POST",
                  data: { monhoc:$("#keytinhthanh").val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                            $(".giasutt li").remove();
                          /*$("#list_workonline").innerHTML = reponse.data;*/
                            $(".giasutt").append(reponse.data);
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
        }
    });
});
</script>
