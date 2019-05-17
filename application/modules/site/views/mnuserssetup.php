<?php $ui=$_SESSION['UserInfo']; ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left1'); ?>
        </div>
        <?php if($ui['Type']==0){ ?>
        <div class="manager-col-right col-md-9 col-sm-12 updatepass">
            <div class="content-right " style="min-height:300px;">
               <div class="fromdatime">
                    <div class="clr" style="height:0px"></div>
                    <!--<div class="form-control">
                        <input type="text" id="datepiker" name="datepiker" placeholder="Chọn khoảng thời gian" />
                        <i class="fa fa-datetime"></i> 
                    </div>-->
                    <!--<a class="btnhoanthienhoso"><i class="fa fa-uv-hths"></i> Hoàn thiện hồ sơ</a>-->
                </div>
                <div class="sumjob updatesuccess">
                    <span><i class="fa fa-uv-update-success"></i>Hồ sơ của bạn đã hoàn thiện</span>
                </div>
                <div class="box-file-newest uvupdatesuccess">
                    <div class="tablediv">
                        <div class="title"><i class="fa fa-uv-man"></i> Cài đặt hiển thị                    
                        </div>
                    </div>
                    <div class="tablediv">
                        <div class="clr" style="height:10px;"></div>
                        <div class="uvactiventd">                            
                            <span style="display:inline-block;float:left;margin-right:20px;">Cho phép nhà tuyển dụng tìm kiếm (Ẩn / Hiện hồ sơ):</span>
                            <label for="uvduyetsearch">
                              <input value="1"<?php if($uinfo->IsSearch==1){ ?> checked="checked"<?php } ?> type="checkbox" name="uvduyetsearch" id="uvduyetsearch" class="uvduyetsearch"/>
                              <div>
                                <span class="on">Bật</span>
                                <span class="off">Tắt</span>
                              </div>  
                              <i></i>
                            </label>                            
                        </div>
                        <div class="clearfix" style="height:8px;"></div>
                        <div class="divbantinhangngay" style="overflow: hidden;">
                            <span>Nhận bản tin việc làm:</span>
                            <span class="uvvaluethaydoi"><?php if($uinfo->Notify==0){echo "Hàng ngày";}else if($uinfo->Notify==1){echo "Một tuần";}else{echo "Một tháng";} ?>
                            </span><span class="uvthaydoibantin">Thay đổi</span>
                        </div>
                        <div class="clearfix" style="height:15px;"></div>
                    </div>
                </div>          
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</section>
<div class="modal fade capnhattrangthaiclass" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title"><b>Cập nhật trạng thái</b></div>
          <input type="hidden" id="txtclassid" name="txtclassid" />
          <input type="hidden" id="txtid" name="txtid" /> 
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row padd-top-15 padd-bot-5" style="">
                    <div class="form-group">
                        <select class="form-control" id="txtnotify" name="txtnotify">
                            <option value="0">Hàng ngày</option>
                            <option value="1">Một tuần</option>
                            <option value="2">Một tháng</option>
                        </select>
                    </div>
                </div>                
            </div>            
        </div>
        <div class="modal-footer" style="text-align:left;">
            <button type="button" id="btnhuy" class="btn btn-primary btn-warning" data-dismiss="modal" style="padding: 6px 20px;width: 109px;margin-left: 5px;display: inline-block;">Hủy</button>
            <button type="button" class="btn btn-primary btn-success" id="btnluuthaydoi" style="padding: 6px 20px;width: 143px;margin-left: 7px;display: inline-block;">Lưu thay đổi</button>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
	$(document).ready(function() {
	    var configulr='<?php echo base_url(); ?>';
        $('.uvactiventd input[name="uvduyetsearch"]').each(function () {
    $(this).change(function () {
        /*if($(this).prop('checked')==true){
            alert('đã bật search');
        }*/
        cknhatuyendung=1;
        if(typeof ($('.uvactiventd input[name="uvduyetsearch"]:checked').val())=== "undefined"){
            cknhatuyendung=0;
        };
        $.ajax({                  
                  url: configulr+"site/ajaxupdateissearch",
                  type: "POST",
                  data: { issearch:cknhatuyendung},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          alert(reponse.data);
                      }else{
                        alert('Thay đổi trạng thái thất bại');
                      }
                      
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();window.location.reload();
                  }
              }); 
        /*alert($('.uvactiventd input[name="uvduyetsearch"]:checked').val());*/
    });
    });
    $('.uvthaydoibantin').on('click',function(){
        $('#myModal').modal('show');
    });
    $('#btnluuthaydoi').on('click',function(){
          $.ajax({
                          
                          url: configulr+"site/ajaxupdatenotify",
                          type: "POST",
                          data: { 
                            notify: $('#txtnotify').val()                             
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                          },
                          success: function (obj) {
                             
                             if(obj.kq ==true){
                                alert('Cập nhật thành công');
                                }
                          },
                          error: function (xhr) {
                              alert("error");
                          },
                          complete: function () {                              
                              window.location.reload();
                              
                          }
                      }); 
            
        });
	   });
 </script>