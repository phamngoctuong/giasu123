<?php  $ui=$_SESSION['UserInfo']; ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left1');  ?>
        </div>
        <?php if($ui['Type']==0){ ?>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right updatepass" style="min-height:300px;display:none">
                <div class="clr" style="height:10px;position: relative;"></div>
                <div class="clr" style="height:30px;"></div>
                <div class="title"><span>Chuyển tiền qua Internet Banking</span></div>
                <div class="ntdlist banklist">
                    <ul class="lisbank col-md-12">
                        <?php if(!empty($bankused) ){
                            foreach($bankused as $m){ ?>
                             <li class="col-md-4 text-center" >
                            <a data-id="b<?php echo $m->ID  ?>"><img src="<?php echo $m->Image  ?>"/></a>
                        </li>
                            <?php }
                        } ?>
                    </ul>
                    <div class="bankinfo" style="display: none;">
                        <?php if(!empty($bankused) ){
                            foreach($bankused as $m){ ?>
                             <div id="b<?php echo $m->ID ?>" class="infobank" style="display: none;">
                                <div class="info-name">Thông tin tài khoản <?php echo $m->Name ?>:</div>
                                <div class="info-info">
                                    <span>Số tài khoản: <b><?php echo $m->BankNumber ?></b></span>
                                    <span>Chủ tài khoản: <b><?php echo $m->BankAccount ?></b></span>
                                    <span>Chi nhánh: <b><?php echo $m->BankBrand ?></b></span>
                                    <span>Nội dung chuyển tiền: <b><?php echo $m->Note ?></b></b></span>
                                </div>
                            </div>
                            <?php }
                        } ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="title naptientk"><span><i class="fa fa-creditcard"></i> Thông báo nạp tiền vào tài khoản</span></div>
                <div class="fieldset sendnotifymoney">
                <div class="group-control">
                    <label class="control-label">Ngân hàng nhận tiền:</label>
                    <select class="form-control" id="cbobank" name="cbobank" data-width="100%">
                                 <option value="">Chọn ngân hàng</option>
                                 <?php if(!empty($lstbank)){
                                    foreach($lstbank as $n){ ?>
                                        <option value="<?php echo $n->Name ?>"><?php echo $n->Description ?></option>
                                    <?php }
                                 } ?>
                              </select>

                </div>
                <div class="clearfix"></div>
                <div class="group-control">
                    <label class="control-label">Số tiền nạp:</label>
                    <div class="form-control"><input type="text" id="sotiennap" name="sotiennap" placeholder="Số tiền nạp"/></div>
                </div>
                <div class="clearfix"></div>

                <div class="clearfix"></div>
                 <div class="group-control">
                    <label class="control-label">Hình thức chuyển tiền:</label>
                    <select class="form-control" id="transfertype" name="transfertype" >
                                 <option value="1">Chuyển tiền internet banking</option>
                                 <option value="2">Chuyển ATM</option>
                              </select>

                </div>
                <div class="clearfix"></div>
                 <div class="group-control">
                    <label class="control-label">Ngân hàng chuyển tiền:</label>
                    <select class="form-control" id="banktranfer" name="banktranfer" >
                                 <option value="" >Chọn ngân hàng</option>
                                 <?php if(!empty($lstbank)){
                                    foreach($lstbank as $n){ ?>
                                        <option value="<?php echo $n->Name ?>"><?php echo $n->Description ?></option>
                                    <?php }
                                 } ?>
                    </select>

                </div>
                <div class="clearfix" style="height:30px;"></div>
                <div class="group-control">
                    <label class="control-label">Tên người chuyển:</label>
                    <div class="form-control"><input type="text" id="CustomerName" name="CustomerName" placeholder="Tên người chuyển"/></div>

                </div>
                <div class="clearfix"></div>
                <div class="group-control">
                    <label class="control-label">Số tài khoản chuyển tiền:</label>
                    <div class="form-control"><input type="text" id="CustomerBN" name="CustomerBN" placeholder="Số tk chuyển"/></div>

                </div>
                <div class="clearfix"></div>
                <div class="group-control">
                    <label class="control-label">Ngày chuyển:</label>
                    <div class="form-control"><div class='input-group date' id='datetimepicker1' style="width: 100%">
                                    <input type='text' placeholder="Ngày chuyển" id="txtTransferDate" class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                      </div>

                </div>
                </div>
                <div class="clearfix"></div>
                <div class="group-control">
                    <label class="control-label">Nội dung chuyển tiền:</label>
                        <div class="form-control"><input type="text" id="txtNote" name="txtNote" placeholder="Nội dung chuyển"/></div>

                    </div>

                <div class="btngroup">

                        <a class="btnsendnotify" id="btnsendnotifymoney">Gửi thông báo</a>
                    </div>

                <!--nội dung-->
                <div class="ntdlist infonotify">
                    <div>
                        <p><strong>THÔNG BÁO NẠP TIỀN</strong> là tính năng giúp các thành viên gửi thông báo cho Timviec365.vn số tiền bạn đã chuyển xác nhận việc chuyển tiền
                        của bạn và bạn sẽ được cộng nhanh chóng trong vòng 3 giây khi gửi thông báo thành công cho hệ thống của chúng tôi.</p>
                        <p>- Khách hàng nạp dưới 5 triệu thì có thể chuyển khoản và tài khoản cá nhân hoặc công ty mà không cần thông báo cho Timviec365.vn</p>
                        <p>- Ngược lại, khi số tiền lớn hơn 5 triệu thì khách hàng bắt buộc phải chuyển khoản vào tài khoản Công ty và nội dung chuyển tiền theo cú pháp
                         theo quy định của Tìm việc 365 sau đó vào gửi thông báo nạp tiền tại đây</p>
                         <br />
                         <p>Sau khi thực hiện đúng yêu cầu trên, nếu muốn xác nhận chuyển khoản thanh công nhanh chóng Quý khách có thể gọi điện đến số hotline: <strong style="color:#ff0000">1900 633682</strong> chọn <strong>phím 2</strong> để được hỗ trợ dịch vụ timviec365, hoặc thông báo
                         tại mục <strong>chatbox</strong> hỗ trợ trực tuyến ngay trên website.</p>
                         <h3 style="font-size:14px;font-weight:700;">HƯỚNG DẪN THÔNG BÁO NẠP TIỀN</h3>
                         <p>Thực hiện thông báo nạp tiền như sau:</p>
                         <ul>
                            <li>- Nhập số tiền cần nạp</li>
                            <li>- Lựa chọn hình thức chuyển tiền</li>
                            <li>- Lựa chọn ngân hàng chuyển tiền của thành viên</li>
                            <li>- Nhập tiền người chuyển tiền</li>
                            <li>- Nhập số tài khoản chuyển tiền</li>
                            <li>- Thời gian chuyển tiền</li>
                            <li>- Chọn ngân hàng nhận tiền của timviec365.vn</li>
                         </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php } ?>
</div>
</section>
<script src="js/jquery.numeric.js"></script>
<script src="js/common.js"></script>
<script src="js/moment.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	   $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD-MM-YYYY'
    });
    var configulr='<?php echo site_url(); ?>';
    var self=this;
    $('#sotiennap').numeric();
	   $('.lisbank li a').on('click',function(e){
            e.preventDefault();
            var tg=document.getElementById('open');
            if(tg == null){
                $('body').prepend('<div id="open" ></div>');
            };

            if($(this).parent('li').hasClass('active')){
                $(this).parent('li').removeClass('active');
                $('.infobank').hide();
                $('.bankinfo').hide();
                var iddiv= $(this).attr('data-id');
                $('#'+iddiv).hide();
                $('#open').hide();
            }else{
                $('.lisbank li').removeClass('active');
                $(this).parent('li').addClass('active');
                var iddiv= $(this).attr('data-id');
                $('.infobank').hide();
                $('.bankinfo').show();
                $('#'+iddiv).show();
                $('#open').show();
            };

        });
        $('body').on('click','#open',function(){
            $('.lisbank li').removeClass('active');
            $('.infobank').hide();
            $('.bankinfo').hide();
            $('#open').hide();
            $('body #open').remove();
        });
        $('#btnsendnotifymoney').on('click',function(){
            if(self.validatesendnotify())
            {
                $.ajax({

                                      url: configulr+"/site/ajaxsendnotifymoney",
                                      type: "POST",
                                      data: {
                                        ReceiveBank:$('#cbobank').val(),
                                        TransferType:$('#transfertype').val(),
                                        TransferBank:$('#banktranfer').val(),
                                        CustomerName:$('#CustomerName').val(),
                                        CustomerBN:$('#CustomerBN').val(),
                                        TransferDate:$('#txtTransferDate').val(),
                                        Amount:$('#sotiennap').val(),
                                        Note:$('#txtNote').val()
                                      },
                                      dataType: 'json',
                                      beforeSend: function () {
                                          $("#boxLoading").show();
                                      },
                                      success: function (obj) {

                                         if(obj.kq ==true){
                                            alert(obj.data);
                                            }else{
                                                alert('Gửi thông báo thất bại');
                                            }
                                      },
                                      error: function (xhr) {
                                          alert("error");
                                      },
                                      complete: function () {
                                          window.location.href='<?php echo site_url('mn-candi-manager') ?>';
                                      }
                                  });
            }

        });
        self.validatesendnotify=function()
        {
            var flag=true;
        var uemail = $('#cbobank').val();
                if ($.trim(uemail) == '') {
                    $($('#cbobank')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#cbobank').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#sotiennap').val()) == '') {
                    $($('#sotiennap')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#sotiennap').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#transfertype').val()) == '') {
                    $($('#transfertype')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#transfertype').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#banktranfer').val()) == '') {
                    $($('#banktranfer')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#banktranfer').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#CustomerName').val()) == '') {
                    $($('#CustomerName')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#CustomerName').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#CustomerBN').val()) == '') {
                    $($('#CustomerBN')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#CustomerBN').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#txtTransferDate').val()) == '') {
                    $($('#txtTransferDate')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtTransferDate').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#txtNote').val()) == '') {
                    $($('#txtNote')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtNote').data("title", "").removeClass("errorClass");
                };
                return flag;
        }
	   });

</script>
