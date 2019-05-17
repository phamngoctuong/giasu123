<?php $ui=$_SESSION['UserInfo']; ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left'); ?>
        </div>
        <?php if($ui['Type']==1){ ?>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right " style="min-height:300px;">
                <div class="clr" style="height:10px;position: relative;"><a class="btnlogout"><i class="fa fa-logout"></i> Thoát</a></div>
                <div class="clr" style="height:50px;"></div>
                <div class="ntdlist">
                    
                    <div class="box-file-newest">
                    <div class="title">Danh sách lớp đã đề nghị dạy<span>Tổng hồ sơ: <?php echo intval(count($uservsclass)); ?></span></div>
                    <table class="listungtuyen">
                        <thead>
                        <tr>
                            <th style="width: 6.5%;">STT
                            </th>
                            <th style="width:27%">Thông tin lớp
                            </th>
                            <th style="width:25%;">Môn học</th>
                            <th style="width:11%;">Ngày gửi</th>
                            <th style="width:13%">Trạng thái</th>                            
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($uservsclass)){
                            foreach($uservsclass as $n){ ?>
                             <tr>
                                <td>1</td>
                                <td><div><a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" target="_blank"><?php echo $n->ClassTitle ?></a><label><?php echo $n->Name ?></label>
                                    <span>Mức học phí: <i><?php echo number_format($n->Money) ?> vnđ</i></span>
                                    </div>
                                </td>
                                
                                <td><a><?php echo $n->SubjectName ?></a></td>                                
                                <td><?php echo date("d/m/Y",strtotime($n->CreateDate)) ?></td>
                                <td><?php if($n->daday == 1){echo "Đang dạy";}else if($n->daday == 0){echo "Chưa cập nhật";}else if($n->daday == 2){echo "Đã dừng";}else{echo "Tạm nghỉ";} ?></td>
                                <td class="actionjob">
                                    <a class="btnntdupdate" data-val="<?php echo $n->ClassID ?>"><i class="fa fa-refresh"></i>Cập nhật trạng thái</a>
                                    <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" target="_blank" class="btnntdviewdetail"><i class="fa fa-view-detail"></i>Xem chi tiết</a>
                                </td>
                            </tr>   
                            <?php }
                        } ?>
                            
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</section>
<!--modal fade-->
<div class="modal fade capnhattrangthaiclass" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title"><b>Cập nhật trạng thái</b></div>
          <input type="hidden" id="txtclassid" name="txtclassid" />
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row padd-top-15 padd-bot-5" style="">
                    <div class="col-md-5 padd-r-0">
                        <div class="group-radio">
                        <input id="radio-1" value="2" class="radio-custom" name="radio-group" type="radio" checked>
                        <label for="radio-1" class="radio-custom-label">Đã dừng</label>
                        </div>
                        <div class="group-radio">
                            <input id="radio-2" value="1" class="radio-custom"name="radio-group" type="radio">
                            <label for="radio-2" class="radio-custom-label">Đang dạy</label>
                        </div>
                        <div class="group-radio">
                            <input id="radio-3" value="3" class="radio-custom" name="radio-group" type="radio">
                            <label for="radio-3" class="radio-custom-label">Tạm nghỉ</label>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group" style="margin:5px auto;">
                            <textarea rows="4" cols="5" id="txtghichu" name="txtghichu" placeholder="Ghi chú" style="width:100%;padding:7px;height:118px;"></textarea>
                        </div>
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
  <script>
    $(document).ready(function () {
        var configulr='<?php echo base_url(); ?>';
        $('.btnntdupdate').on('click',function(){
            $('#txtghichu').val('');
            $('#txtclassid').val($(this).attr('data-val'));
            $('#myModal').modal('show');
        });
        $('#btnluuthaydoi').on('click',function(){
            if($('#txtghichu').val()!=''){
                $($('#txtghichu')).removeClass('errorClass');
                $.ajax(
                      {
                          
                          url: configulr+"site/ajaxupdatestatususervsclass",
                          type: "POST",
                          data: { 
                            classid: $('#txtclassid').val() ,
                            note:$('#txtghichu').val(),
                            trangthai:$('input[name=radio-group]:checked').val()
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                          },
                          success: function (obj) {
                             
                             if(obj.kq ==true){
                                alert('Cập nhật thành công');
                                }else{
                                    if(obj.data==true){
                                     alert('Lớp được mời dạy, bạn phải sang quản lý lớp mời dạy để cập nhật');   
                                    }else{
                                    alert('cập nhật thất bại, vui lòng kiểm tra lại');
                                    }
                                }
                          },
                          error: function (xhr) {
                              alert("error");
                          },
                          complete: function () {                              
                              $('#myModal').modal('hide');
                              window.location.reload();
                          }
                      }); 
            }else{
                $($('#txtghichu')).addClass('errorClass');
            }
        });
        });
  </script>