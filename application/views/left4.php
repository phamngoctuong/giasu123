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
if(current_url()==site_url('mn-company-updateinfo')){
   $menutt=true;
$activett=true; 
}else if(current_url()==site_url('mn-company-changepass')){
    $menutt=true;
$activett=true; 
}
$menuhoso=false;
$activehoso=false;
if(current_url()==site_url('mn-company-ds-ung-tuyen')){
    $menuhoso=true;
$activehoso=true;
}else if(current_url()==site_url('mn-company-ds-ung-vien-luu')){
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
    }
  if($usertype==4) {   
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
                <span class="btnupdateuv" onclick="location.href='<?php echo site_url('mn-company-updateinfo') ?>'">Hoàn thiện</span>
                <!--<div style="width:100%;"><p>Bạn đang có: <a>0 đ</a></p></div>-->
            </div>
            </div>
            <div style="clear:bold;"></div>
            <nav id="sidebar">
                <ul class="list-unstyled components">
                <?php if(current_url()==site_url('mn-company-manager')){ ?>
                    <li class="active">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('mn-company-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php }else{ ?>
                    <li class="">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('mn-company-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php } ?>
                    
                    
                    <li>
                        <i class="fa fa-message"></i><a href="<?php echo site_url('mn-company-manager') ?>">Chat online</a>                       
                    </li> 
                    <?php if(current_url()==site_url('mn-company-manager-news')){ ?>
                        <li class="active">
                            <i class="fa fa-settings"></i><a href="<?php echo site_url('mn-company-manager-news') ?>">Quản lý tin đăng</a>
                        </li>
                    <?php }else{ ?>
                        <li>
                            <i class="fa fa-settings"></i><a href="<?php echo site_url('mn-company-manager-news') ?>">Quản lý tin đăng</a>
                        </li>
                    <?php } ?>
                    <li>
                        <i class="fa fa-searchuv"></i><a href="#candicompany" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menuhoso){echo "";}else{echo "collapsed";} ?>">Thông tin ứng viên</a>
                        <ul class="list-unstyled collapse <?php if($activehoso){echo "in";}else{echo "";} ?>" id="candicompany" style="">
                            <?php if(current_url()==site_url('mn-company-ds-ung-tuyen')){ ?>
                            <li class="active">
                                <i class="fa fa-timkiemungv"></i><a href="<?php echo site_url('mn-company-ds-ung-tuyen') ?>">Ứng viên ứng tuyển</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-timkiemungv"></i><a href="<?php echo site_url('mn-company-ds-ung-tuyen') ?>">Ứng viên ứng tuyên</a>
                            </li>
                            <?php } ?>
                            
                            <?php if(current_url()==site_url('mn-company-ds-ung-vien-luu')){ ?>
                            <li class="active">
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mn-company-ds-ung-vien-luu'); ?>">Ứng viên đã lưu</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mn-company-ds-ung-vien-luu'); ?>">Ứng viên đã lưu</a>
                            </li>
                            <?php } ?>
                             
                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-uv-info"></i><a href="#infocompany" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menutt){echo "";}else{echo "collapsed";} ?>">Thông tin công ty</a>
                        <ul class="list-unstyled collapse <?php if($activett){echo "in";}else{echo "";} ?>" id="infocompany" style="">
                            <?php if(current_url()==site_url('mn-company-updateinfo')){ ?>
                            <li class="active">
                                <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-company-updateinfo') ?>">Cập nhật thông tin</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-company-updateinfo') ?>">Cập nhật thông tin</a>
                            </li>
                            <?php } ?>
                            
                            <?php if(current_url()==site_url('mn-company-changepass')){ ?>
                            <li class="active">
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mn-company-changepass'); ?>">Đổi mật khẩu</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mn-company-changepass'); ?>">Đổi mật khẩu</a>
                            </li>
                            <?php } ?>
                             
                        </ul>
                    </li>
                    <?php if(current_url()==site_url('mn-company-nap-tien')){ ?>
                   <li class="active">
                        <i class="fa fa-cashout"></i><a href="<?php echo site_url('mn-company-nap-tien'); ?>">Nạp tiền vào tài khoản</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-cashout"></i><a href="<?php echo site_url('mn-company-nap-tien'); ?>">Nạp tiền vào tài khoản</a>
                    </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-company-rut-tien')){ ?>
                    <li class="active">
                        <i class="fa fa-cashout-return"></i><a href="<?php echo site_url('mn-company-rut-tien'); ?>">Mua điểm xem thông tin</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-cashout-return"></i><a href="<?php echo site_url('mn-company-rut-tien'); ?>">Mua điểm xem thông tin</a>
                    </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-company-qua-tang-km')){ ?>
                        <li class="active">
                            <i class="fa fa-bonus-ntd"></i><a href="<?php echo site_url('mn-company-qua-tang-km'); ?>">Quà tặng - khuyến mãi</a>
                        </li>
                    <?php }else{?>
                        <li>
                            <i class="fa fa-bonus-ntd"></i><a href="<?php echo site_url('mn-company-qua-tang-km'); ?>">Quà tặng - khuyến mãi</a>
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