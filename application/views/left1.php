<?php
$CI=&get_instance();
$CI->load->model('site/site_model');

 $menu1=false;
 $active1=false;
 if(current_url()==site_url('mn-hv-gia-su-da-luu')){
    $menu1=true;
 $active1=true;
 }else if(current_url()==site_url('mn-hv-gia-su-moi-day')){
   $menu1=true;
    $active1=true;
 }else if(current_url()==site_url('mn-hv-gia-su-phu-hop')){
    $menu1=true;
    $active1=true;
 }else if(current_url()==site_url('mn-hv-gia-su-de-nghi-day')){
    $menu1=true;
    $active1=true;
 }
$menutt=false;
$activett=false;
if(current_url()==site_url('mn-hv-thay-doi-mk')){
   $menutt=true;
$activett=true;
}else if(current_url()==site_url('mn-hv-cai-dat-ho-so')){
    $menutt=true;
$activett=true;
}else if(current_url()==site_url('mn-hv-thong-tin-ho-so')){
    $menutt=true;
$activett=true;
}
$menuhoso=false;
$activehoso=false;
if(current_url()==site_url('mn-danh-sach-lop-de-nghi-day')){
    $menuhoso=true;
$activehoso=true;
}else if(current_url()==site_url('mn-danh-sach-lop-moi-day')){
    $menuhoso=true;
$activehoso=true;
}else if(current_url()==site_url('mn-danh-sach-lop-da-day')){
    $menuhoso=true;
$activehoso=true;
}else if(current_url()==site_url('mn-danh-sach-lop-da-luu')){
    $menuhoso=true;
$activehoso=true;
}

$userlogin="";
$footer="";
$usertype="";
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){

    $tg=$_SESSION['UserInfo'];
    $userlogin=$tg['FullName'];
    $usertype=$tg['Type'];
    $footer=$CI->site_model->GetUserInfoByUserID($tg['UserId']);



    $balance=number_format($tg['Balance']);
    $userid=$tg['UserId'];
    $point=$CI->site_model->sumpointbyuserid($userid);

    }
  if($usertype==0) {
?>
<div class="row">
            <div class="left-menu">
            <div class="logonuv">
                <span class="imglogo"><img src="images/employersp.png" alt="logo ntd" /></span>
                <!-- <a><?php echo $userlogin; ?></a> -->
                <a href="<?=base_url();?>"><?php echo $userlogin; ?></a>
            </div>
            <div class="col-md-12" style="margin: 0 auto 23px auto;">
            <span class="ntdmoney" style="text-align:center;display:block;">TKC: <?php echo $balance; ?> vnđ và <?php echo number_format($point->point)." điểm" ?></span>
            <div class="groupbtnuv">

                <span class="btnrefreshuv" onclick="location='<?php echo site_url() ?>'">Làm mới</span>
                <span class="btnupdateuv" onclick="location.href='<?php echo site_url('mn-hv-thong-tin-ho-so') ?>'">Hoàn thiện</span>
                <!--<div style="width:100%;"><p>Bạn đang có: <a>0 đ</a></p></div>-->
            </div>
            </div>
            <div style="clear:bold;"></div>
            <nav id="sidebar">
                <ul class="list-unstyled components">
                <?php if(current_url()==site_url('phu-huynh-manager')){ ?>
                    <li class="active">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('phu-huynh-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php }else{ ?>
                    <li class="">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('phu-huynh-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php } ?>
                    <li>
                        <i class="fa fa-uv-jobmanager"></i><a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle <?php if($menu1){echo "";}else{echo "collapsed";} ?>">Quản lý gia sư</a>
                        <ul class="list-unstyled collapse <?php if($active1){echo "in";}else{echo "";} ?>" id="homeSubmenu" style="">
                            <?php if(current_url()==site_url('mn-hv-gia-su-da-luu')){ ?>
                            <li class="active">
                                <i class="fa fa-disk"></i><a href="<?php echo site_url('mn-hv-gia-su-da-luu'); ?>">Gia sư đã lưu</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-disk"></i><a href="<?php echo site_url('mn-hv-gia-su-da-luu'); ?>">Gia sư đã lưu</a>
                            </li>
                            <?php } ?>
                            <?php if(current_url()==site_url('mn-hv-gia-su-moi-day')){ ?>
                            <li class="active">
                                <i class="fa fa-uv-ungtuyen"></i><a href="<?php echo site_url('mn-hv-gia-su-moi-day'); ?>">Gia sư đã mời dạy</a>
                            </li>
                            <?php }else{ ?>
                             <li>
                                <i class="fa fa-uv-ungtuyen"></i><a href="<?php echo site_url('mn-hv-gia-su-moi-day'); ?>">Gia sư đã mời dạy</a>
                            </li>
                            <?php } ?>
                           <?php if(current_url()==site_url('mn-hv-gia-su-phu-hop')){ ?>
                               <li class="active">
                                  <i class="fa fa-uv-phuhop"></i><a href="<?php echo site_url('mn-hv-gia-su-phu-hop') ?>">Gia sư phù hợp</a>
                                </li>
                           <?php }else{ ?>
                               <li>
                                  <i class="fa fa-uv-phuhop"></i><a href="<?php echo site_url('mn-hv-gia-su-phu-hop') ?>">Gia sư phù hợp</a>
                                </li>
                           <?php } ?>
                           <?php if(current_url()==site_url('mn-hv-gia-su-de-nghi-day')){ ?>
                               <li class="active">
                                  <i class="fa fa-uv-phuhop"></i><a href="<?php echo site_url('mn-hv-gia-su-de-nghi-day') ?>">Gia sư đề nghị dạy</a>
                                </li>
                           <?php }else{ ?>
                               <li>
                                  <i class="fa fa-uv-phuhop"></i><a href="<?php echo site_url('mn-hv-gia-su-de-nghi-day') ?>">Gia sư đề nghị dạy</a>
                                </li>
                           <?php } ?>

                        </ul>
                    </li>
                    <?php if(current_url()==site_url('mn-hv-quan-ly-lop-hoc')){ ?>
                    <li class="active">
                        <i class="fa fa-uv-updatevip"></i><a href="<?php echo site_url('mn-hv-quan-ly-lop-hoc') ?>">Quản lý lớp học</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-uv-updatevip"></i><a href="<?php echo site_url('mn-hv-quan-ly-lop-hoc') ?>">Quản lý lớp học</a>
                    </li>
                    <?php } ?>

                    <li>
                        <i class="fa fa-message"></i><a href="<?php echo site_url('phu-huynh-manager') ?>">Chat online</a>
                    </li>
                    <li>
                        <i class="fa fa-uv-info"></i><a href="#infocompany" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menutt){echo "";}else{echo "collapsed";} ?>">Thông tin cá nhân</a>
                        <ul class="list-unstyled collapse <?php if($activett){echo "in";}else{echo "";} ?>" id="infocompany" style="">
                            <?php if(current_url()==site_url('mn-hv-thong-tin-ho-so')){ ?>
                                <li class="active">
                                    <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-hv-thong-tin-ho-so'); ?>">Thông tin hồ sơ</a>
                                </li>
                            <?php }else{ ?>
                                <li>
                                    <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-hv-thong-tin-ho-so'); ?>">Thông tin hồ sơ</a>
                                </li>
                            <?php } ?>

                            <?php if(current_url()==site_url('mn-hv-cai-dat-ho-so')){ ?>
                            <li class="active">
                                <i class="fa fa-uv-setting"></i><a href="<?php echo site_url('mn-hv-cai-dat-ho-so'); ?>">Cài đặt hồ sơ</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-uv-setting"></i><a href="<?php echo site_url('mn-hv-cai-dat-ho-so'); ?>">Cài đặt hồ sơ</a>
                            </li>
                            <?php } ?>

                            <?php if(current_url()==site_url('mn-hv-thay-doi-mk')){ ?>
                             <li class="active">
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mn-hv-thay-doi-mk'); ?>">Đổi mật khẩu</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mn-hv-thay-doi-mk'); ?>">Đổi mật khẩu</a>
                            </li>
                            <?php } ?>


                        </ul>
                    </li>
                    <?php if(current_url()==site_url('mn-hv-nap-tien')){ ?>
                   <li class="active">
                        <i class="fa fa-cashout"></i><a href="<?php echo site_url('mn-hv-nap-tien'); ?>">Nạp tiền vào tài khoản</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-cashout"></i><a href="<?php echo site_url('mn-hv-nap-tien'); ?>">Nạp tiền vào tài khoản</a>
                    </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-hv-rut-tien')){ ?>
                    <li class="active">
                        <i class="fa fa-cashout-return"></i><a href="<?php echo site_url('mn-hv-rut-tien'); ?>">Mua điểm xem thông tin</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-cashout-return"></i><a href="<?php echo site_url('mn-hv-rut-tien'); ?>">Mua điểm xem thông tin</a>
                    </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-hv-qua-tang-khuyen-mai')){ ?>
                        <li class="active">
                            <i class="fa fa-bonus-ntd"></i><a href="<?php echo site_url('mn-hv-qua-tang-khuyen-mai'); ?>">Quà tặng - khuyến mãi</a>
                        </li>
                    <?php }else{?>
                        <li>
                            <i class="fa fa-bonus-ntd"></i><a href="<?php echo site_url('mn-hv-qua-tang-khuyen-mai'); ?>">Quà tặng - khuyến mãi</a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
           </div>
           </div>
<?php } ?>
           <script type="text/javascript">
	$(document).ready(function() {
	    var configulr='<?php echo base_url(); ?>';
        $('.uvhoanthienhoso input[name="buttonRounded"]').each(function () {
    $(this).change(function () {
        /*if($(this).prop('checked')==true){
            alert('đã bật search');
        }*/
        cknhatuyendung=1;
        if(typeof ($('.uvhoanthienhoso input[name="buttonRounded"]:checked').val())=== "undefined"){
            cknhatuyendung=0;
        }
        $.ajax(
              {
                  url: configulr+"site/ajaxupdateissearch",
                  type: "POST",
                  data: { issearch:cknhatuyendung},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          alert(reponse.data);
                      }else{
                        alert('Thay đổi trạng thái thất bại');
                      }

                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                      window.location.reload();
                  }
              });
        /*alert($('.uvactiventd input[name="uvduyetsearch"]:checked').val());*/
    });
    });
   $('.btnrefreshuv').on('click',function(){
    $.ajax(
              {
                  url: configulr+"site/ajaxrefreshusers",
                  type: "POST",
                  data: { },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          alert('Cập nhật thành công');
                      }else{
                        alert('Cập nhật thất bại');
                      }

                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                      window.location.reload();
                  }
              });
   });
	   });
 </script>
