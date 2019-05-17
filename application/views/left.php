<?php  site_url('mn-giao-vien-tim-lop-day');
 $menu1=false;
 $active1=false;
 if(current_url()==site_url('mn-giao-vien-tim-lop-day')){
    $menu1=true;
 $active1=true;
 }else if(current_url()==site_url('mn-giao-vien-tim-lop-day-theo-mon')){
   $menu1=true;
    $active1=true;
 }else if(current_url()==site_url('mn-giao-vien-tim-lop-day-theo-tt')){
    $menu1=true;
    $active1=true;
 }
$menutt=false;
$activett=false;
if(current_url()==site_url('mm-giao-vien-thay-doi-mk')){
   $menutt=true;
$activett=true;
}else if(current_url()==site_url('mn-gia-su-cap-nhat-thong-tin')){
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
$usertype="";
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){

    $tg=$_SESSION['UserInfo'];
    $usertype=$tg['Type'];
    $userlogin=$tg['FullName'];
    $userid = $tg['UserId'];
    }
     if($usertype==1) {
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
                <span class="btnrefreshuv" onclick="location='<?php echo site_url() ?>'">Làm mới</span>
                <span class="btnupdateuv" onclick="location.href='<?php echo site_url('mn-gia-su-cap-nhat-thong-tin') ?>'">Chỉnh sửa</span>
                <!--<div style="width:100%;"><p>Bạn đang có: <a>0 đ</a></p></div>-->
            </div>
            <div class="uvactiventd" style="margin-left:10px;text-align:center">
              <br>Cho phép phụ huynh tìm kiếm </br>

              <label for="uvduyetsearch">
              <input value="1"<?php if($uinfo->IsSearch==0){ $view ="background:#bec4bf";?> checked="checked"<?php }else{$view = "";} ?> type="checkbox" name="uvduyetsearch" id="uvduyetsearch" class="uvduyetsearch"/>
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
                <?php if(current_url()==site_url('giao-vien-manager')){ ?>
                    <li class="active">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('giao-vien-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php }else{ ?>
                    <li class="">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('giao-vien-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php } ?>
                    <li>
                        <i class="fa fa-searchuv"></i><a href="#pageSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menu1){echo "";}else{echo "collapsed";} ?>">Tìm kiếm lớp dạy</a>
                        <ul class="list-unstyled collapse <?php if($active1){echo "in";}else{echo "";} ?>" id="pageSubmenu" style="">
                            <?php if(current_url()==site_url('mn-giao-vien-tim-lop-day')){ ?>
                    <li class="active">
                                <i class="fa fa-timkiemungv"></i><a href="<?php echo base_url() ?>mn-giao-vien-tim-lop-day">Tìm kiếm lớp dạy</a>
                            </li>
                    <?php }else{ ?>
                    <li>
                                <i class="fa fa-timkiemungv"></i><a href="<?php echo base_url() ?>mn-giao-vien-tim-lop-day">Tìm kiếm lớp dạy</a>
                            </li>
                    <?php } ?>
                            <?php if(current_url()==site_url('mn-giao-vien-tim-lop-day-theo-mon')){ ?>
                    <li class="active">
                                <i class="fa fa-timkiemnn"></i><a href="<?php echo base_url()  ?>mn-giao-vien-tim-lop-day-theo-mon">Theo môn học</a>
                            </li>
                    <?php }else{ ?>
                        <li>
                                <i class="fa fa-timkiemnn"></i><a href="<?php echo base_url()  ?>mn-giao-vien-tim-lop-day-theo-mon">Theo môn học</a>
                            </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-giao-vien-tim-lop-day-theo-tt')){ ?>
                        <li class="active">
                                <i class="fa fa-locationp"></i><a href="<?php echo site_url('mn-giao-vien-tim-lop-day-theo-tt'); ?>">Theo tỉnh thành</a>
                            </li>
                    <?php }else{ ?>
                            <li>
                                <i class="fa fa-locationp"></i><a href="<?php echo site_url('mn-giao-vien-tim-lop-day-theo-tt'); ?>">Theo tỉnh thành</a>
                            </li>
                    <?php } ?>
                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-filemanager"></i><a href="#quanlyhoso" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menuhoso){echo "";}else{echo "collapsed";} ?>">Quản lý hồ sơ</a>
                        <ul class="list-unstyled collapse <?php if($activehoso){echo "in";}else{echo "";} ?>" id="quanlyhoso" style="">
                            <?php if(current_url()==site_url('mn-danh-sach-lop-moi-day')){ ?>
                                <li class="active">
                                  <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-moi-day'); ?>">Lớp đã mời dạy</a>
                                </li>
                            <?php }else{ ?>
                                <li>
                                  <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-moi-day'); ?>">Lớp đã mời dạy</a>
                                </li>
                            <?php } ?>
                            <?php if(current_url()==site_url('mn-danh-sach-lop-da-day')){ ?>
                            <li class="active">
                              <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-da-day'); ?>">Lớp đã nhận dạy</a>
                            </li>
                            <?php }else{ ?>
                                <li>
                              <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-da-day'); ?>">Lớp đã nhận dạy</a>
                            </li>
                            <?php } ?>
                            <?php if(current_url()==site_url('mn-danh-sach-lop-de-nghi-day')){ ?>
                            <li class="active">
                              <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-de-nghi-day') ?>">Lớp đã đề nghị dạy</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                              <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-de-nghi-day') ?>">Lớp đã đề nghị dạy</a>
                            </li>
                            <?php } ?>
                            <?php if(current_url()==site_url('mn-danh-sach-lop-da-luu')){ ?>
                                <li class="active">
                                  <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-da-luu'); ?>">Lớp đã lưu</a>
                                </li>
                            <?php }else{ ?>
                            <li>
                              <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-da-luu'); ?>">Lớp đã lưu</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-message"></i><a href="<?php echo site_url('giao-vien-manager') ?>">Chat online</a>

                    </li>
                    <li>
                        <i class="fa fa-uv-info"></i><a href="#infocompany" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menutt){echo "";}else{echo "collapsed";} ?>">Thông tin gia sư</a>
                        <ul class="list-unstyled collapse <?php if($activett){echo "in";}else{echo "";} ?>" id="infocompany" style="">
                            <?php if(current_url()==site_url('mn-gia-su-cap-nhat-thong-tin')){ ?>
                            <li class="active">
                                <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-gia-su-cap-nhat-thong-tin') ?>">Cập nhật thông tin</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-gia-su-cap-nhat-thong-tin') ?>">Cập nhật thông tin</a>
                            </li>
                            <?php } ?>

                            <?php if(current_url()==site_url('mm-giao-vien-thay-doi-mk')){ ?>
                            <li class="active">
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mm-giao-vien-thay-doi-mk'); ?>">Đổi mật khẩu</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mm-giao-vien-thay-doi-mk'); ?>">Đổi mật khẩu</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php if(current_url()==site_url('mn-gia-su-nap-tien')){ ?>
                   <li class="active">
                        <i class="fa fa-cashout"></i><a href="<?php echo site_url('mn-gia-su-nap-tien'); ?>">Nạp tiền vào tài khoản</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-cashout"></i><a href="<?php echo site_url('mn-gia-su-nap-tien'); ?>">Nạp tiền vào tài khoản</a>
                    </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-gia-su-rut-tien')){ ?>
                    <li class="active">
                        <i class="fa fa-cashout-return"></i><a href="<?php echo site_url('mn-gia-su-rut-tien'); ?>">Mua điểm xem thông tin</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-cashout-return"></i><a href="<?php echo site_url('mn-gia-su-rut-tien'); ?>">Mua điểm xem thông tin</a>
                    </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-gia-su-qua-tang-km')){ ?>
                    <li class="active">
                        <i class="fa fa-bonus-ntd"></i><a href="<?php echo site_url('mn-gia-su-qua-tang-km'); ?>">Quà tặng - khuyến mãi</a>
                    </li>
                    <?php }else{?>
                    <li>
                        <i class="fa fa-bonus-ntd"></i><a href="<?php echo site_url('mn-gia-su-qua-tang-km'); ?>">Quà tặng - khuyến mãi</a>
                    </li>
                    <?php } ?>

                </ul>
            </nav>
           </div>
           </div>
<?php } ?>
<script>
$(document).ready(function() {
	    var configulr='<?php echo base_url(); ?>';
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
                          $("#boxLoading").hide();window.location.reload();
                      }
                  });
            /*alert($('.uvactiventd input[name="uvduyetsearch"]:checked').val());*/
        });
        });
        });

</script>
