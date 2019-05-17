<?php 
$ui=$_SESSION['UserInfo']; 
?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php  $this->load->view('left4'); ?>
        </div>
        <?php if($ui['Type']==4){ ?>
        <div class="manager-col-right col-md-9 col-sm-12 updatepass">
            <div class="content-right " style="min-height:300px;">
                <div class="clr" style="height:10px;position: relative;"><a id="btnlogout" class="btnlogout"><i class="fa fa-logout"></i> Thoát</a></div>
                <div class="clr" style="height:40px;"></div>                
                <div class="title"><span><i class="fa fa-pincode"></i>Đổi mật khẩu</span></div>               
                <div class="fieldset">
                <div class="note"><span>(<b>*</b>) Thông tin bắt buộc</b></span>  </div>              
                <div class="group-control">
                    <label class="control-label required">Mật khẩu cũ</label>
                    <div class="form-control"><input type="password" id="oldpassword" name="oldpassword" placeholder=""/><i class="fa-showpass" data-val="oldpassword"></i></div>                    
                </div>                
                <div class="clr"></div>
                <div class="group-control">
                    <label class="control-label required">Mật khẩu mới</label>
                    <div class="form-control"><input type="password" id="newpassword" name="newpassword"/><i class="fa-showpass" data-val="newpassword"></i></div>
                    <div class="note-1">Mật khẩu tối thiểu 8 ký tự, trong đó ít nhất 1 ký tự chữ và 1 ký tự số</div>
                </div>
                <div class="clr"></div>
                <div class="group-control">
                    <label class="control-label required">Xác nhận mật khẩu</label>
                    <div class="form-control"><input type="password" id="confirmnewpass" name="confirmnewpass"/></div>                    
                </div>
                <div class="btngroup">
                        <a id="btncancel" class="btncancel"><i class="fa fa-cancel"></i> Hủy</a>
                        <a id="btnupdatepasscompany" class="btnupdatepassntd">Đổi mật khẩu</a>
                    </div>
                </div>                 
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
	    var configulr='<?php echo base_url(); ?>';
        var self = this;
	   $('#btncancel').on('click',function(){
	       $('#oldpassword').val('');
           $('#newpassword').val('');
           $('#confirmnewpass').val('');
	   });
       $('.fa-showpass').on('click',function(){
        var tg=$(this).attr('data-val');
        if($("#"+tg).attr('type')=='password'){
            $("#"+tg).attr('type','text');
        }else if($("#"+tg).attr('type')=='text'){
            $("#"+tg).attr('type','password');
        };
       });
       $('#btnupdatepasscompany').on('click',function(){
        if(self.validateteacherpass()){
            var oldpass=$('#oldpassword').val();
            var newpass=$('#newpassword').val();
            $.ajax(
              {                  
                  url: configulr+"site/ajaxteacherchangepass",
                  type: "POST",
                  data: { oldpass:oldpass,newpass:newpass},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          alert(reponse.data);
                      }else{
                        alert('Thay đổi mật khẩu thất bại');
                      }
                      
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              }); 
        }
        
        
    });
       self.validateteacherpass = function(){
       var flag=true;
        if($.trim($('#oldpassword').val())==''){
            $('#oldpassword').addClass('errorClass');
            flag=false;
        }else{
            $('#oldpassword').removeClass('errorClass');
        };
        if($.trim($('#newpassword').val())==''){
            flag=false;
            $('#newpassword').addClass('errorClass');
        }else{
            $('#newpassword').removeClass('errorClass');
        };
        if($.trim($('#confirmnewpass').val())==''){
            flag=false;
            $('#confirmnewpass').addClass('errorClass');
        }else{
            $('#confirmnewpass').removeClass('errorClass');
        };
        if(($('#newpassword').val().length < 8) && $.trim($('#newpassword').val())!= ''){
            flag=false;
            $('#newpassword').addClass('errorClass');
        }else{
               $('#newpassword').removeClass('errorClass'); 
            };
        if(($.trim($('#newpassword').val()) !=$.trim($('#confirmnewpass').val())) && $.trim($('#newpassword').val()) !=''){
            flag=false;
            $('#newpassword').addClass('errorClass');
            $('#confirmnewpass').addClass('errorClass');
        }else{
               $('#newpassword').removeClass('errorClass'); 
               $('#confirmnewpass').removeClass('errorClass'); 
            };
        return flag; 
       }
    });
 </script>