<?php 
if(!empty($_SESSION['UserInfo'])){
    redirect(site_url());
}
?>
<header class="logingenaral">
   <div class="container">
    <a href="<?php echo base_url() ?>" class="backurl"><i class="fa fa-backurl"></i></a>
    <div class="logo-login">
            <a href="<?php echo base_url() ?>" title="trang chủ">
               <img src="images/logo-2.png" alt="#" style="background-color:#203043;">
            </a>
         </div>
    <a href="<?php echo base_url() ?>dang-ky-chung" class="btn btndangky">Đăng ký</a>
   </div>
</header>
<section class="padd-0">
<div class="container">
    <div class="formlogin">
        <div class="col-md-6 col-sm-12">
            <div class="login_user">  
                <br />              
                <span class="btnloginuv" onclick="location='phu-huynh-dang-nhap'">Đăng nhập tìm gia sư</span>                
            </div>    
        </div>    
        <div class="col-md-6 col-sm-12">
            <div class="login_ntd">
                <br />
                <span class="btnloginntd" onclick="location='gia-su-dang-nhap'">Đăng nhập làm gia sư</span>            
            </div>
        </div>
        <div style="height:10px;clear: both;"></div>
        <div class="col-md-6 col-sm-12">
            <div class="login_user">  
                <br />              
                <span class="btnloginuv" onclick="location='ung-vien-dang-nhap'">Đăng nhập ứng viên tìm việc</span>                
            </div>    
        </div>    
        <div class="col-md-6 col-sm-12">
            <div class="login_ntd">
                <br />
                <span class="btnloginntd" onclick="location='dang-nhap-nha-tuyen-dung'">Đăng nhập nhà tuyển dụng</span>            
            </div>
        </div>
        <div class="linkregister">
            <span>Bạn chưa có tài khoản? <a href="<?php echo base_url() ?>dang-ky-chung">đăng ký</a></span>
        </div>
    </div>
</div>
<div style="clear: both;height:110px;"></div>

</section>