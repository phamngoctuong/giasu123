<?php

$urlgiasu='0';
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
    if($tg['Type']==2){
        $urlgiasu='2';
    }else{
        $urlgiasu='1';
    }
    }
?>
<div class="container">

     <?php $this->load->view('headerfun'); ?>
</div>

<div class="container">
    <div class="row">
        <div class="searchandbanner-l col-md-4 padd-r-0">
            <div class="box-searchuv">
                 <div class="title"><h1>Tìm lớp gia sư</h1></div>
                        <div class="from-search-ntd">
                            <div class="form-control"><input type="text" id="findkey" name="findkey" placeholder="Ví dụ: tìm gia sư tiếng anh"/> <i class="fa fa-searchbtn"></i></div>
                            <div class="clr"></div>
                            <select id="monhoc" class="nganhnghe_ab_tag">
                                <option ></option>
                                <?php
                                    if(!empty($monhoc)){
                                        foreach($monhoc as $n){ ?>
                                            <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                        <?php }
                                    }
                                ?>
                             </select>
                            <div class="clr"></div>
                            <select id="chudehoc" class="city_ab_tag">
                                <option ></option>

                             </select>
                             <div class="clr"></div>
                            <select id="hinhthuchoc" class="kinhnghiem_ab_tag">
                                <option value="">Chọn hình thức dạy</option><option value="1">(Offline) Gặp mặt</option><option value="2">(Online) Trực tuyến</option>
                             </select>
                             <div class="clr"></div>
                            <select id="tinhthanh" class="mucluong_ab_tag">
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
                             <div class="clr"></div>
                            <select id="gioitinh" class="ngoaingu_ab_tag">
                                <option value="" ></option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                             </select>
                             <div class="clr"></div>

                             <a rel="nofollow" class="btn btnsearchuv">Tìm kiếm</a>
                        </div>
                </div>
        </div>
        <div class="searchandbanner-r uvslides col-md-8">
            <div><img src="images/banneruvserach.jpg" alt="search and banner" /></div>
            <div><img src="images/banneruvserach.jpg" alt="search and banner" /></div>
        </div>
    </div>

<!-- scroll -->


<section class="padd-top-20 padd-bot-30">

    <div class="row giasutieubieu">
    <div class="tit_hd resultfindteacher">
     <div class="ir_h3"><h3><span> <?php if(strtolower($keywork)=='all' || empty($keywork)){echo "Tất cả lớp gia sư";}else{echo "Hồ sơ gia sư dạy ".$keywork;} ?></span></h3>

     </div>
     <span class="span_hd">Sắp xếp theo:
     <select  id="slkbox" aria-label="lọc" name="slkbox">

        <option value="<?php echo $selectbox.'last' ?>"  <?php if(strtolower($order)=='last'){echo "selected";} ?>>Mới nhất</option>
        <option value="<?php echo $selectbox.'pricelow' ?>" <?php if(strtolower($order)=='pricelow'){echo "selected";} ?>>Lương từ thấp đến cao</option>
        <option value="<?php echo $selectbox.'pricehigh' ?>" <?php if(strtolower($order)=='pricehigh'){echo "selected";} ?>>Lương từ cao xuống thấp</option>


        </select>
     </span>
    </div>
<div class="col-md-12 topmoney" id="viewxx">
<div class="row">
<div class="row-allteacher1">
<?php

    foreach($newitem as $n){
      if(!empty($n->ClassTitle)){
  ?>
      <div class="col-md-3 col-sm-12 featureitem">
          <div class="item_hd vip" data-object="<?php echo $n->UserID ?>" data-type="<?php echo $n->UserID ?>">
             <div class="company_logo">
                <a rel="nofollow" href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" title="<?php echo $n->ClassTitle; ?>">
                  <?php if(!empty($n->Image)){?>
                      <img src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),63,63,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="no image" />
                  <?php }else{ ?>
                   <img src="images/no-image2.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                   <?php } ?>
                </a>
             </div>
             <div class="right_item">
                   <a rel="nofollow" href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" title="<?php echo $n->ClassTitle; ?>" class="title_co"><?php echo $n->ClassTitle ?></a>
                  <a rel="nofollow" href="" title=""  class="title_new" >Môn Học :<?php echo $n->SubjectName?></a>
                  <?php if($n->Money > 0){ ?>
                      <span class="money_item">Từ: <span><?php echo number_format($n->Money)." vnđ/buổi" ?></span></span>
                      <?php }else{ ?>
                          <span class="money_item"><span>Thỏa thuận</span></span>
                      <?php } ?>

                <span class="time_item"><?php echo Getcitybyindex($n->City) ?></span>
             </div>
          </div>
      </div>
 <?php
   } }
  ?>

    </div>
  </div>
   </div>
 </div>
</section>
    <?php
      if(!empty($linkSubject)){
        ?>
        <div class="tit_hd headertt">
           <h2><img src="images/ic_cn.png" alt="Danh sách lớp cần gia sư theo môn học"><span>Danh sách lớp cần gia sư theo môn học</span></h2>
        </div>
        <div class="main_cn">
           <ul style="min-height:50px;list-style:none;">
             <?php
               foreach ($linkSubject as  $valuelinksubject) {
                 ?>
                 <li class="col-md-3 padd-0 col-sm-12">

                 <?php
                 echo $valuelinksubject;
                  ?>
                  </li>
                 <?php
               }
              ?>

           </ul>
         </div>
        <?php

      }

     ?>
     <?php
     if(!empty($linkClass)){
       ?>
       <div class="tit_hd headertt">
          <h2><img src="images/ic_cn.png" alt="Danh sách lớp cần gia sư theo lớp học"><span>Danh sách lớp cần gia sư theo lớp học</span></h2>
       </div>
       <div class="main_cn">
          <ul style="min-height:50px;list-style:none;">
            <?php
              foreach ($linkClass as  $valuelinkclass) {
                ?>
                <li class="col-md-3 padd-0 col-sm-12">

                <?php
                echo $valuelinkclass;
                 ?>
                 </li>
                <?php
              }
             ?>
          </ul>
        </div>
       <?php

     }
      ?>

      <?php
      if(!empty($linkCity)){
        ?>
        <div class="tit_hd headertt">
           <h2><img src="images/ic_cn.png" alt="Danh sách lớp cần gia sư theo tỉnh thành"><span>Danh sách lớp cần gia sư theo tỉnh thành</span></h2>
        </div>
        <div class="main_cn">
           <ul style="min-height:50px;list-style:none;">
             <?php
               foreach ($linkCity as  $valuelinkclass) {
                 ?>
                 <li class="col-md-3 padd-0 col-sm-12">

                 <?php
                 echo $valuelinkclass;
                  ?>
                  </li>
                 <?php
               }
              ?>

           </ul>
         </div>
        <?php

      }
       ?>
       <?php if(!empty($linkseo)){ ?>
       <div class="container">
           <div class="row">
               <div class="col-md-12 linkseo">
                 <div id="muc-luc-content-thu">
                   <div id="tieudemucluc" style="text-align:center;">

                   </div>
                     <ul id="content-mucluc" style="padding-inline-start: 10px">

                     </ul>
                   </div>
                   <div name="content-thu" id="content-thu" style="margin-top:10px;">
                       <?php echo $linkseo->content_thu; ?>
                   </div>
               </div>
           </div>
       </div>
       <?php } ?>
  </div>
<div class="clearfix" style="height:36px;"></div>
<script src="<?php echo base_url() ?>combine.php?type=javascript&files=slick.min.js"  type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script>
$(document).ready(function() {

    var configulr='<?php echo site_url(); ?>';
    var checkuser='<?php echo $urlgiasu;  ?>';
	   $('.uvslides').slick({dots: false,autoplay: true, prevArrow: false,nextArrow: false});
		$('#monhoc').select2({ width: '100%',placeholder:"Chọn môn học" });
        $('#hinhthuchoc').select2({ width: '100%',placeholder:"Chọn hình thức học" });
        $('#tinhthanh').select2({ width: '100%',placeholder:"Chọn tỉnh thành" });
        $('#gioitinh').select2({ width: '100%',placeholder:"Chọn giới tính" });
        $('#chudehoc').select2({ width: '100%',placeholder: "Chọn chủ đề"});
         $('#monhoc').change(function () {
            var monhoc=$(this).val();
            // alert('test');
            if(monhoc != '' || monhoc !=0){
              $.ajax({
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
                            /*alert('không tồn tại');*/
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
            });
            $('.btnsearchuv').on('click',function(){
        var findkey=$('#findkey').val();
        var strsubj=$('#monhoc').val();
        var strtopic=$('#chudehoc').val();
        var strtinhthanh=$('#tinhthanh').val();
        var strgioitinh=$('#gioitinh').val();
        var strtype=$('#hinhthuchoc').val();
        if(findkey !=''){
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
              }else{
                 $('#findkey').addClass('errorClass');
                 alert('Bạn phải nhập từ khóa');
              }
        });
    $('.btnuvboxsalary').on('click',function(){
        if(checkuser=='2'){
            window.location='<?php echo site_url('mn-gia-su-cap-nhat-thong-tin'); ?>';
        }else if(checkuser=='1'){
            window.location='<?php echo site_url('mn-hv-dang-tin'); ?>';
        }
    });
    $('#slkbox').change(function(){
        var url=$(this).val();
        window.location.href=url;
    })
	});
</script>
