<?php
 $userinfo1=$_SESSION['UserInfo'];
?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php  $this->load->view('left4');?>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right right-uv" style="min-height:300px;">
                <div class="fromdatime">
                    <div class="clr" style="height:28px"></div>
                    <!--<div class="form-control">
                        <input type="text" id="datepiker" name="datepiker" placeholder="Chọn khoảng thời gian" />
                        <i class="fa fa-datetime"></i>
                    </div>-->
                    <input type="hidden" id="txtidcongty" value="<?php echo $itemcom->usc_id ?>" />
                </div>
                <?php if($userinfo1['Type']==4){ ?>
                <h4>Cập nhật thông tin Công ty</h4>
                <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc" style="overflow: hidden;">
                    <div class="col-md-12 col-sm-12">
                        <label>Tên Công ty</label>
                        <input id="txttencongty" class="form-control" value="<?php echo $itemcom->usc_company; ?>" />
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label>Địa chỉ</label>
                        <input id="txtdiachi" class="form-control" value="<?php echo $itemcom->usc_address ?>" />
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label>Website</label>
                                <input id="txtwebsite" class="form-control" value="<?php echo $itemcom->usc_website ?>" />
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label>Số điện thoại</label>
                                <input id="txtsdt" class="form-control" value="<?php echo $itemcom->usc_phone ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label>Email công ty</label>
                                <input id="txtemail" class="form-control" value="<?php echo $itemcom->usc_email ?>" />
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label>Quy mô công ty</label>
                                <select id="txtquymocty" class="form-control">
                                    <option value="0">Chọn Quy mô</option>
                                    <?php for($i=1;$i<=6;$i++){
                                        if($i==$itemcom->usc_size){ ?>
                                         <option value="<?php echo $i ?>" selected="selected"><?php echo GetQuyMoCty($i); ?></option>
                                    <?php    }else{ ?>
                                        <option value="<?php echo $i ?>"><?php echo GetQuyMoCty($i); ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label>Mô tả chung</label>
                        <textarea id="txtmotacongty" class="textarea" style="width: 100%;" rows="10"><?php echo $itemcom->usc_company_info ?></textarea>
                    </div>
                    <div class="form-group" style="text-align:center;">
                        <button type="button" class="btn btn-primary" id="savecongty">Lưu thông tin</button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</section>
<script src="js/jquery.numeric.js"></script>
<script src="js/moment.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script>
    $(document).ready(function(){
    var configulr='<?php echo base_url(); ?>';
    $('#savecongty').on('click',function(){
        if(validateedituser()){
          if(validateEmail($('#txtemail').val())){
        $.ajax({

                  url: configulr+"/site/ajaxluuthongtincongty",
                  type: "POST",
                  data: {
                         mota: $('#txtmotacongty').val(),
                         quymo:$('#txtquymocty').val()   ,
                         email:$('#txtemail').val(),
                         sodienthoai:$('#txtsdt').val(),
                         website:$('#txtwebsite').val(),
                         diachi:$('#txtdiachi').val(),
                         tencongty:$('#txttencongty').val(),
                         comid:$('#txtidcongty').val()
                         },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                         alert('Cập nhật thành công');
                      }
                      else {
                         alert("Tên công ty đã tồn tại");
                      }
                  },
                  error: function (xhr){
                      alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                  },
                  complete: function (){
                       window.location.reload();
                  }
              });
            }else{
              alert("Email không đúng định dạng");
            }
        }
    });
    function validateEmail(email) {
					var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					return re.test(email);
				}
    function validateedituser() {
        var flag = true;

        var hoten = $('#txtquymocty').val();
        if ($.trim(hoten) == '') {
            $($('#txtquymocty')).attr('data-original-title', 'chọn quy mô công ty').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#txtquymocty').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim($('#txtmotacongty').val()) == '') {
            $($('#txtmotacongty')).attr('data-original-title', 'Nhập mô tả công ty').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#txtmotacongty').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim($('#txttencongty').val()) == '') {
            $($('#txttencongty')).attr('data-original-title', 'Nhập tên công ty').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#txttencongty').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim($('#txtdiachi').val()) == '') {
            $($('#txtdiachi')).attr('data-original-title', 'Nhập địa chỉ công ty').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#txtdiachi').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim($('#txtwebsite').val()) == '') {
            $($('#txtwebsite')).attr('data-original-title', 'Nhập website công ty').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#txtwebsite').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim($('#txtsdt').val()) == '') {
            $($('#txtsdt')).attr('data-original-title', 'Nhập số điện thoại công ty').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#txtsdt').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        if ($.trim($('#txtemail').val()) == '') {
            $($('#txtemail')).attr('data-original-title', 'Nhập email công ty').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#txtemail').data("title", "").removeClass("errorClass").tooltip("destroy");
        }
        return flag;
    };
    });
</script>
