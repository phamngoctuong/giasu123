<?php ?>
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
        <div class="formloginntd">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-4 col-sm-12">
                <div class="login_user">
                    <div class="frmtitle">Đăng nhập tìm gia sư</div>
                    <div class="form-control">
                        <i class="fa fa-email"></i>
                        <input type="text" class="form-input" id="useremail" name="useremail" placeholder="Nhập số điện thoại" />
                    </div>
                    <div class="form-control">
                        <i class="fa fa-password"></i>
                        <input type="password" class="form-input" id="userpassword" name="userpassword" placeholder="Nhập mật khẩu" />
                        <i class="fa-showpass"></i>
                    </div>
                    <span class="rememberlogin"><input type="checkbox" id="rememberlogin" name="rememberlogin"/> Nhớ đăng nhập</span>
                    
                    <span class="btnloginuv phuhuynhlogin" id="phuhuynhlogin">Đăng nhập</span>
                    <a href="<?php echo base_url() ?>tk-lay-lai-mat-khau" class="forgotpass">Quên mật khẩu?</a>
                </div>   
            </div>     
        </div>
    </div>
</section>