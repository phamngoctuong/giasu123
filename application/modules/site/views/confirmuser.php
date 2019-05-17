<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

// pr(current_url());
// echo md5('Thanh#Xuan@123?/');
$phone='';
if(!empty($_SESSION['UserInfo'])){
  $phone=$_SESSION['UserInfo']['UserName'];
}
?>
<div class="container">
    <div class="breaking-news">

          <div class="col-md-2">
            <div class="row"><span class="title">Cập nhật hôm nay!</span>
            </div>
          </div>
          <div class="col-md-10">
            <div class="row">
                <span class="text">
                 Có <span class="text-danger-B">30.196</span> việc làm mới hôm nay trong <span class="text-danger-B">56.000</span> việc làm đang tuyển dụng
                 <a href="" class="text-danger-C">
                     <span class="icon icon-xs icon-2-arrow"></span>
                     BẤM XEM NGAY!<img src="images/icxn.png" alt="#">
                 </a>
              </span>
            </div>
          </div>
    </div>
    <?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-0">
    <div class="container">
    <br />
        <div class="formlogin frmfogotpass" style="border:1px solid #ccc;border-radius: 4px;padding:10px;">
                <br />
                <h3 class="text-center">Xác nhận đăng ký tài khoản</h3>
                <div class="note"><span>(<b>*</b>) Thông tin bắt buộc</b></span>
                    <input type="hidden" id="usp" value="<?php echo $username ?>" />
                </div>
                <div class="fogotemail">
                <div class="group-control">
                        <label class="control-label required">Mã xác nhận</label>
                        <div class="form-control" style="position: relative;padding-left:20px;"><i style="position: absolute;left: 2px;top: 5px;">u_</i><input type="text" id="emailuser" name="emailuser" placeholder="Điền mã xác nhận"/></div>
                </div>
                </div>
                <p>Mời bạn nhập mã xác nhận đã gửi về tin nhắn. </p>
                <a class="btnforgotpassword" id="btnconfirmuserregister">Xác nhận</a>
                <div class="" style="color:red">
                  Bạn chưa nhận được mã xác thực?
                  <input type="button" name="resend" id="resend" value="Gửi lại mã xác thực">
                </div>
            </div>
            <div class="linkregister">
                <span>&nbsp;</span>
            </div>
        </div>
    </div>
</section>
<div class="modal fade capnhattrangthaiclass" id="checkconfirm" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title"><b>
            <?php
              if(strpos(current_url(),'/confirmuser')){
                $text=' Vui lòng nhập mã kích hoạt đang được gửi đến SĐT dùng để đăng kí của bạn là:'.$phone.' trong giây lát';
              }elseif(strpos(current_url(),'/endconfirm')){
                $text='Tài khoản của bạn chưa được kích hoạt và đã hết số lần lấy lại mã trong hôm nay, vui lòng thử lại vào ngày mai hoặc nhập mã kích hoạt cuối cùng được gửi đến sđt '.$phone.' của bạn';
              }
              echo $text;
             ?>
          </b></div>
        </div>
        <div class="modal-body">

            <div class="modal-footer-confirmuser">
              <button type="button" id="OK">OK</button>
            </div>
        </div>

      </div>
    </div>
  </div>
<script>
$(document).ready(function () {
    var configulr='<?php echo site_url(); ?>';
        var confirmuser='<?php if( strpos(current_url(),'/confirmuser') || strpos(current_url(),'/endconfirm') ){echo 1;}else{echo 0;} ?>';
        if(confirmuser==1){
        // alert(confirmuser);
        $('#checkconfirm').modal('show');
        }
      $('#OK').on('click',function(){
        $('#checkconfirm').modal('hide');
      });
    $('#btnconfirmuserregister').on('click',function(){
          if($('#emailuser').val() !=''){
              $.ajax({

                                        url: configulr+"/site/ajaxconfirmusersregister",
                                        type: "POST",
                                        data: { code: $('#emailuser').val(),usp:$('#usp').val() },
                                        dataType: 'json',
                                        beforeSend: function () {
                                            $("#boxLoading").show();
                                        },
                                        success: function (obj) {

                                           if(obj.kq == true){
                                              alert('Bạn đã kích hoạt thành công');
                                              window.location.href=configulr;
                                              }else{
                                                  alert('Xác nhận thất bại');
                                              }
                                        },
                                        error: function (xhr) {
                                            alert("error");
                                        },
                                        complete: function () {
                                            $("#boxLoading").hide();
                                        }
                                    });
          }else{alert('Bạn phải điền mã code xác nhận')}
        });

    });
    $('#resend').on('click',function(){
      var username='<?php echo $_SESSION['UserInfo']['UserId']; ?>';
      var type='<?php echo $_SESSION['UserInfo']['Type']; ?>'
      $.ajax({
        url: configulr+"/site/ajaxgetcodeconfirm",
        type: "POST",
        data: { code: username,type:type},
        dataType: 'json',
        beforeSend: function () {
            alert('Vui lòng nhấn OK, mã xác thực sẽ được gửi đến sđt bạn đã dùng để đăng kí trong giây lát')
        },
        success: function (obj) {
           if(obj.kq == true){
                  alert('Mã kích hoạt đang được gửi tới máy của bạn, vui lòng đợi trong giây lát');
              }else{
                  alert('Bạn đã vượt quá số lần lấy lại mã kích hoạt, vui lòng thử lại vào ngày mai');
              }
        },
        error: function (xhr) {
            alert("Đã có lỗi xảy ra, vui lòng thử lại sau");
        },
      });
    });
</script>
