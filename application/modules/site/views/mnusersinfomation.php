<?php $ui=$_SESSION['UserInfo'];?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left1'); ?>
        </div>
        <?php if($ui['Type']==0){ ?>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right right-uv" style="min-height:300px;">
                <div class="fromdatime">
                <div class="clr" style="height:0px"></div>
                </div>
                <?php if(empty($ui['EmailAddress'])){
                  ?>
                    <div class="thong-bao-dien-thong-tin">* <?php echo $mess ?></div>
                  <?php
                } ?>
                <div class="box-file-newest uvupdatesuccess">

                        <div class="title"><i class="fa fa-infomation-black"></i> Thông tin hồ sơ
                        </div>
                        <div class="uvinfo-header edit">
                            <div class="uvinfoheader-l">
                                <span class="uvimgrepresent">
                                    <?php if(!empty($uinfo->Image)){ ?>
                                    <img src="<?= gethumbnail(geturlimageAvatar(strtotime($uinfo->CreateDate)).$uinfo->Image,$uinfo->Image,strtotime($uinfo->CreateDate),120,120,100) ?>"  onerror='this.onerror=null;this.src="images/no-image2.png";'/><!--onerror='this.onerror=null;this.src="images/no-image2.png";'-->

                                    <?php }else{ ?>
                                    <img src="images/icon-anhdaidien.png" onerror='this.onerror=null;this.src="images/no-image2.png";'/>
                                    <?php } ?>
                                </span>
                                <input type="file"  accept="image/x-png,image/gif,image/jpeg" name="file-4[]" id="file-4" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple="">
            					<label for="file-4"><span>Thay ảnh đại diện</span></label>
                            </div>
                            <div class="uvinfoheader-r">
                                <table style="width:100%;">

                                    <tr>
                                        <td style="width:60%;"><label class="label-control required-left">Họ và tên</label>
                                            <div class="form-control"><input placeholder="Họ và tên" value="<?php echo $uinfo->Name ?>" type="text" id="txtname" name="txtname" /></div>
                                        </td>
                                        <td rowspan="2" style="vertical-align: top;">
                                            <div class="form-inline">
                                                <label style="margin-right:30px;" class="required-left">Giới thiệu bản thân: </label>
                                                <div class="form-group">
                                                    <textarea id="txtdescription" name="txtdescription" placeholder="Giới thiệu bản thân" style="width:100%;padding:10px;height:110px;"><?php echo trim($uinfo->Description) ?></textarea>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="label-control required-left">Ngày sinh</label>
                                            <div class='input-group date' id='datetimepicker1' style="width: 100%">
                                                    <input type='text' placeholder="Ngày sinh" value="<?php echo date('m-d-Y',strtotime($uinfo->Birth))  ?>" id="txtngaysinh" class="form-control" />
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </span>
                                            </div>
                                        </td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="uvfun-bottom">
                            <span class="btnuvhuy btnhuy"><i class="fa fa-uv-cancel" ></i> Hủy</span>
                            <span class="btnuvcapnhat capnhat1"><i class="fa fa-uv-updateall"></i> Cập nhật</span>
                        </div>
                        <!--info function-->

                        <div class="uvinfo-canhan edit" style="clear: both;overflow: hidden;">
                            <div class="tablediv">
                                <div class="title2"><span>Thông tin cá nhân </span>
                                </div>
                            </div>
                            <div class="tablediv col-md-12">
                                <div class="tablediv_l col-md-6 padd-l-0">
                                    <label class="label-control required-left">Email:</label>
                                            <div class="form-control"><input placeholder="abc@gmail.com" value="<?php echo $uinfo->Email ?>" type="text" id="txtemail" name="txtemail" /></div>
                                </div>
                                <div class="tablediv_r col-md-6 padd-r-0">
                                    <label class="label-control required-left">Giới tính:</label>
                                    <select id="txtgioitinh" name="txtgioitinh" class="form-control">
                                                <option value="">Chọn giới tính</option>
                                                <option value="1" <?php if($uinfo->Sex==1){?> selected <?php } ?> >Nam</option>
                                                <option value="2" <?php if($uinfo->Sex==2){?> selected <?php } ?>>Nữ</option>
                                    </select>
                                 </div>
                                 <div class="col-md-12 padd-0">
                                    <label class="label-control required-left">Địa chỉ:</label>
                                    <div class="form-control"><input placeholder="Việt Nam" value="<?php echo $uinfo->Address ?>" type="text" id="txtaddress" name="txtaddress" /></div>
                                 </div>
                            </div>
                        </div>
                        <div class="uvfun-bottom">
                            <span class="btnuvhuy btnhuy1"><i class="fa fa-uv-cancel"></i> Hủy</span>
                            <span class="btnuvcapnhat capnhat2"><i class="fa fa-uv-updateall"></i> Cập nhật</span>
                        </div>
                        <!--end info function-->
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</section>
<script src="js/common.js"></script>
<script src="js/moment.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script>
$(document).ready(function () {
   var configulr='<?php echo site_url(); ?>';
    $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD-MM-YYYY'
    });
    $('.capnhat1').on('click',function(){
        var hoten1 = $('#txtname').val();

        if(validategiasu()){
          if(checkname(hoten1)){
            var file_data = $('#file-4')[0].files[0];
            data = new FormData();
            data.append('hoten',$('#txtname').val());
            data.append('ngaysinh',$('#txtngaysinh').val());
            data.append('mota',$('#txtdescription').val());
            data.append('imguser', file_data);

            $.ajax({
                  url: configulr+"/site/ajaxupdateusersinfomation1",
                  type: "POST",
                  contentType: false,
                  processData: false,
                  data: data,
                  dataType: 'json',
                  enctype: 'multipart/form-data',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                            alert(reponse.data);
                      }
                      else {
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
            }else{
              alert("Tên chỉ điền ký tự");
            }
        }
    });
    $('.capnhat2').on('click',function(){
          var email = $('#txtemail').val();

        if(validate2giasu()){
            if (validateEmail(email)) {

                  $.ajax(
                      {
                          url: configulr+"site/ajaxupdateusersinfomation2",
                          type: "POST",
                          data: {
                            email: $('#txtemail').val() ,
                            gioitinh:$('#txtgioitinh').val(),
                            diachi:$('#txtaddress').val()
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                          },
                          success: function (obj) {

                             if(obj.kq ==true){
                                alert('Cập nhật thành công');
                                }else{
                                    alert(obj.data);
                                }
                          },
                          error: function (xhr) {
                              alert("error");
                          },
                          complete: function () {

                              $('#myModal').modal('hide');
                              /*window.location.reload();*/
                          }
                      });

              }else{
                alert('Email không đúng định dạng');
            }
        }
    });
    $('.btnhuy').on('click',function(){
        $('#txtname').val("");
        $('#txtdescription').val("");
        $('#txtngaysinh').val("");

    });
    $('.btnhuy1').on('click',function(){
        $('#txtgioitinh').val("");
        $('#txtemail').val("") ;
        $('#txtaddress').val("") ;
    });
    function validategiasu()
    {
        var flag=true;
        if ($.trim($('#txtname').val()) == '') {
                    $($('#txtname')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtname').data("title", "").removeClass("errorClass");
                }
        if ($.trim($('#txtdescription').val()) == '') {
                    $($('#txtdescription')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtdescription').data("title", "").removeClass("errorClass");
                }
        if ($.trim($('#txtngaysinh').val()) == '') {
                    $($('#txtngaysinh')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtngaysinh').data("title", "").removeClass("errorClass");
                }
        return flag;
        };
    function validate2giasu()
    {
        var flag=true;
        if ($.trim($('#txtemail').val()) == '') {
                    $($('#txtemail')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtemail').data("title", "").removeClass("errorClass");
                }

        if ($.trim($('#txtgioitinh').val()) == '') {
                    $($('#txtgioitinh')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtgioitinh').data("title", "").removeClass("errorClass");
                }
        if ($.trim($('#txtaddress').val()) == '') {
                    $($('#txtaddress')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtaddress').data("title", "").removeClass("errorClass");
                }
        return flag;
        };
        function validateEmail(email) {
              var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return re.test(email);
            }
        function checkname(hoten) {
            var re = /^[a-zA-Z]+$/;
            return re.test(hoten);
        }
});
</script>
