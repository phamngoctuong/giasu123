<?php 
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
        <div class="formlogin frmfogotpass">
                <div class="title"><h3>Xác nhận lấy lại mật khẩu</h3></div>
                <div class="note"><span>(<b>*</b>) Thông tin bắt buộc</b></span>  
                    <input type="hidden" id="usp" value="<?php echo $username ?>" />
                </div>  
                <div class="fogotemail">
                <div class="group-control">
                        <label class="control-label required">Mã xác nhận</label>
                        <div class="form-control"><input type="text" id="emailuser" name="emailuser" placeholder="Điền mã xác nhận"/></div>                        
                </div>
                </div>
                <p>Mời bạn nhập mã xác nhận đã gửi về tin nhắn. </p>
                <a class="btnforgotpassword" id="btnconfirmpass">Xác nhận</a>            
            </div>
            <div class="linkregister">
                <span>&nbsp;</span>
            </div>
        </div>
    </div>
</section>