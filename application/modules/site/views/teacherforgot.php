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
        <div class="formlogin frmfogotpass">
            <div class="supportfogotpassword"><a href="#">Hướng dẫn lấy lại mật khẩu</a></div>
            <div class="fogotmypassword">
                
                <div class="title">Quên mật khẩu</div>
                <div class="note"><span>(<b>*</b>) Thông tin bắt buộc</b></span>  </div>  
                <div class="fogotemail">
                <div class="group-control">
                        <label class="control-label required">Tài khoản</label>
                        <div class="form-control"><input type="text" id="emailuser" name="emailuser" placeholder="Điền tài khoản"/></div>
                        
                </div>
                <div class="col-md-8 text-left col-md-offset-3">
                        <div class="group-radio">
                        <input id="radio-1" value="1" class="radio-custom" name="radio-group" type="radio" checked>
                        <label for="radio-1" class="radio-custom-label">Gọi điện</label>
                        </div>
                        <div class="group-radio">
                            <input id="radio-2" value="0" class="radio-custom"name="radio-group" type="radio">
                            <label for="radio-2" class="radio-custom-label">Gửi tin nhắn</label>
                        </div>
                    </div>
                </div>
                <p>Mời bạn nhập số điện thoạil đã đăng kí trên tài khoản vieclam123.vn. vieclam123.vn sẽ gửi tới bạn hướng dẫn để tạo mật khẩu mới, vui lòng kiểm tra tin nhắn. </p>
                <a class="btnforgotpassword" id="btn_teacherforgot" >Lấy lại mật khẩu</a>
            
            </div>
            <div class="linkregister">
                <span>Bạn đã có tài khoản? <a href="<?php echo base_url() ?>dang-nhap-chung">đăng nhập</a></span>
            </div>
        </div>
    </div>
</section>
<div class="modal fade capnhattrangthaiclass" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title"><b>Phương thức nhận mã xác nhận</b></div>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row padd-top-15 padd-bot-5" style="">                    
                    <div class="col-md-12">
                        
                    </div>
                </div>                
            </div>            
        </div>
        <div class="modal-footer" style="text-align:left;">
            <button type="button" id="btnhuy" class="btn btn-primary btn-warning" data-dismiss="modal" style="padding: 6px 20px;width: 109px;margin-left: 5px;display: inline-block;">Hủy</button>
            <button type="button" class="btn btn-primary btn-success" id="" style="padding: 6px 20px;width: 143px;margin-left: 7px;display: inline-block;">Đồng ý</button>
        </div>
      </div>
    </div>
</div>