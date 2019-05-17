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
if(current_url()==site_url('mn-candi-updateinfo')){
   $menutt=true;
$activett=true;
}else if(current_url()==site_url('mn-candi-changepass')){
    $menutt=true;
$activett=true;
}
$menuhoso=false;
$activehoso=false;
if(current_url()==site_url('mn-candi-viec-da-ung-tuyen')){
    $menuhoso=true;
$activehoso=true;
}else if(current_url()==site_url('mg-candi-viec-da-luu')){
    $menuhoso=true;
$activehoso=true;
}

$userlogin="";
$footer="";
$usertype="";
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){

    $tg=$_SESSION['UserInfo'];
    $usertype=$tg['Type'];
    $userlogin=$tg['FullName'];
    $userid = $tg['UserId'];
    $footer=$CI->site_model->GetUserInfoByUserID($tg['UserId']);
    }
 if($usertype==3) {
    $uinfo=$this->site_model->GetUserInfoByUserID($userid);
?>
<div class="row">
            <div class="left-menu">
            <div class="logonuv">
                <span class="imglogo"><img src="images/employersp.png" alt="logo ntd" /></span>
                <a><?php echo $userlogin; ?></a>
            </div>
            <div class="col-md-12" style="margin: 0 auto 23px auto;">
                <div class="groupbtnuv">
                    <span class="btnrefreshuv" onclick="">Làm mới</span>
                    <span class="btnupdateuv" onclick="location.href='<?php echo site_url('mn-candi-updateinfo') ?>'">Hoàn thiện</span>
                    <!--<div style="width:100%;"><p>Bạn đang có: <a>0 đ</a></p></div>-->
                </div>
                <div class="uvactiventd" style="margin-left:10px;text-align:center">
                  <br>Cho phép doanh nghiệp tìm kiếm </br>

                  <label for="uvduyetsearch">
                  <input value="1"<?php if($uinfo->IsSearch2==0){ $view ="background:#bec4bf";?> checked="checked"<?php }else{$view = "";} ?> type="checkbox" name="uvduyetsearch" id="uvduyetsearch" class="uvduyetsearch"/>
                  <div style="<?php echo  $view ?>";>
                    <span class="on"></span>
                    <span class="off"></span>
                  </div>
                  <i></i>
                </label>
                </div>
            </div>

            <div style="clear:bold;"></div>
            <nav id="sidebar">
                <ul class="list-unstyled components">
                <?php if(current_url()==site_url('mn-candi-manager')){ ?>
                    <li class="active">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('mn-candi-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php }else{ ?>
                    <li class="">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('mn-candi-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php } ?>



                    <li>
                        <i class="fa fa-message"></i><a href="<?php echo site_url('mn-candi-manager') ?>">Chat online</a>
                    </li>
                    <li>
                        <i class="fa fa-searchuv"></i><a href="#infocompany" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menuhoso){echo "";}else{echo "collapsed";} ?>">Thông tin việc làm</a>
                        <ul class="list-unstyled collapse <?php if($activehoso){echo "in";}else{echo "";} ?>" id="infocompany" style="">
                            <?php if(current_url()==site_url('mn-candi-viec-da-ung-tuyen')){ ?>
                            <li class="active">
                                <i class="fa fa-timkiemungv"></i><a href="<?php echo site_url('mn-candi-viec-da-ung-tuyen') ?>">Việc đã ứng tuyển</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-timkiemungv"></i><a href="<?php echo site_url('mn-candi-viec-da-ung-tuyen') ?>">Việc đã ứng tuyên</a>
                            </li>
                            <?php } ?>

                            <?php if(current_url()==site_url('mg-candi-viec-da-luu')){ ?>
                            <li class="active">
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mg-candi-viec-da-luu'); ?>">Việc đã lưu</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mg-candi-viec-da-luu'); ?>">Việc đã lưu</a>
                            </li>
                            <?php } ?>

                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-uv-info"></i><a href="#candiinfojob" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menutt){echo "";}else{echo "collapsed";} ?>">Thông tin ứng viên</a>
                        <ul class="list-unstyled collapse <?php if($activett){echo "in";}else{echo "";} ?>" id="candiinfojob" style="">
                            <?php if(current_url()==site_url('mn-candi-updateinfo')){ ?>
                            <li class="active">
                                <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-candi-updateinfo') ?>">Cập nhật thông tin</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-candi-updateinfo') ?>">Cập nhật thông tin</a>
                            </li>
                            <?php } ?>

                            <?php if(current_url()==site_url('mn-candi-changepass')){ ?>
                            <li class="active">
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mn-candi-changepass'); ?>">Đổi mật khẩu</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mn-candi-changepass'); ?>">Đổi mật khẩu</a>
                            </li>
                            <?php } ?>

                        </ul>
                    </li>
                    <?php if(current_url()==site_url('mn-candi-nap-tien')){ ?>
                   <li class="active">
                        <i class="fa fa-cashout"></i><a href="<?php echo site_url('mn-candi-nap-tien'); ?>">Nạp tiền vào tài khoản</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-cashout"></i><a href="<?php echo site_url('mn-candi-nap-tien'); ?>">Nạp tiền vào tài khoản</a>
                    </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-candi-rut-tien')){ ?>
                    <li class="active">
                        <i class="fa fa-cashout-return"></i><a href="<?php echo site_url('mn-candi-rut-tien'); ?>">Mua điểm xem thông tin</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-cashout-return"></i><a href="<?php echo site_url('mn-candi-rut-tien'); ?>">Mua điểm xem thông tin</a>
                    </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-candi-qua-tang-km')){ ?>
                        <li class="active">
                            <i class="fa fa-bonus-ntd"></i><a href="<?php echo site_url('mn-candi-qua-tang-km'); ?>">Quà tặng - khuyến mãi</a>
                        </li>
                    <?php }else{?>
                        <li>
                            <i class="fa fa-bonus-ntd"></i><a href="<?php echo site_url('mn-candi-qua-tang-km'); ?>">Quà tặng - khuyến mãi</a>
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

    $('.uvactiventd input[name="uvduyetsearch"]').each(function () {
$(this).change(function () {
    /*if($(this).prop('checked')==true){
        alert('đã bật search');
    }*/
    cknhatuyendung=0;
    if(typeof ($('.uvactiventd input[name="uvduyetsearch"]:checked').val())=== "undefined"){
        cknhatuyendung=1;
    };
    $.ajax({
              url: configulr+"site/ajaxupdateissearch1",
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
                  $("#boxLoading").hide();window.location.reload();
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
