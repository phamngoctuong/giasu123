<?php $urlweb= current_url();
$CI=&get_instance();
$CI->load->model('site/site_model');

?>
<!-- Start Navigation -->
<header class="manager">
   <div class="container">
   <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <div class="logo">
              <a href="<?=base_url();?>" title="Trang chủ Vieclam123.vn">
                 <img src="images/logo-2.png" alt="Vieclam123.vn">
              </a>
            </div>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12" style="background-color: #fff;">
        <div class="row mrg-r-0">
            <div class="infontd">
                <div class="infosupport">
                    <img class="imgemployer" src="images/uv-support.png" />
                    <span class="chuyenvien">Chuyên viên hỗ trợ, tư vấn dành cho phụ huynh, học viên</span>
                    <!--<span><b>SĐT: </b><span>1900633682</span> <b>- Email: </b><a>yen.nguyen@gmail.com</a></span>-->
                </div>
                <div class="functionungvien">
                    <a href="<?php echo site_url() ?>" class="returnhome"><i class="fa fa-backhome" title="Trở lại trang chủ" ></i>
                    Trở lại trang chủ
                    </a>
                    <a class="uvnotify"><i class="fa fa-notify"></i>
                    <img src="images/icon-notify.png" alt="notify" />Thông báo
                    </a>
                    <a class="btnlogout"><i class="fa fa-logout"></i> Đăng xuất</a>
                </div>
            </div>
            </div>
        </div>
        </div>
   </div>
</header>
