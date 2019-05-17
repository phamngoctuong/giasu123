<?php $ui=$_SESSION['UserInfo']; ?>
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
                    <!--<div class="form-control">
                        <input type="text" id="datepiker" name="datepiker" placeholder="Chọn khoảng thời gian" />
                        <i class="fa fa-datetime"></i> 
                    </div>-->
                    <div class="countitem">Tổng số: <?php echo $giaovienluu->sogiaovien ?></div>
                </div>
               <div class="box-file-newest uvrecruitjob">
                    <div class="title"><i class="fa fa-man-brown"></i> Danh sách gia sư đã mời dạy                    
                    </div>
                    <table class="uv-ungtuyen box-has-news teacherinvite">
                        <thead>
                        <tr>                            
                            <th style="width:45%">Gia sư/Môn học</th>
                            <th style="width:13%">Hình thức dạy</th>
                            <th style="width:15%">Mức học phí</th>
                            <th style="width:15%">Ngày cập nhật</th>
                            <th style="width:12%">Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($giasudaluu)){
                                foreach($giasudaluu as $n){
                            ?>
                                <tr>                                
                                <td><a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>"><?php echo $n->Name; ?></a>
                                    <span><?php echo $n->TitleView; ?></span>
                                </td>
                                <td><?php echo GetLearnType($n->WorkID) ?></td>                                
                                <td><?php echo "Từ: ".number_format($n->Free)." vnđ/buổi"; ?></td>
                                <td><?php echo date('d/m/Y',strtotime($n->CreateDate)) ?></td>       
                                <td class="actionjob">
                                    <a class="btnntdupdate" data-val="<?php echo $n->ClassID ?>" data-id="<?php echo $n->UserID ?>"><i class="fa fa-refresh"></i> Cập nhật </a>
                                    <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" target="_blank" class="btnntdviewdetail"><i class="fa fa-view-detail"></i> Chi tiết</a>
                                </td>                         
                            </tr>
                            <?php } } ?>
                        </tbody>
                        <?php if(!empty($giasudaluu) && count($giasudaluu) >= 6){ ?>
                           <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <div class="loadmoreitem"><input type="hidden" id="txtpage" name="txtpage" value="2" /><span id="btnloadmoreitem" class="btn-link"><i class="fa fa-arrow-loadmore"></i> Xem thêm</span></div>
                                    </td>
                                </tr>
                            </tfoot> 
                        <?php } ?>
                        
                    </table>
                    
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
          <input type="hidden" id="txtid" name="txtid" /> 
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row padd-top-15 padd-bot-5" style="">
                    <div class="col-md-5 padd-r-0">
                        <div class="group-radio">
                        <input id="radio-1" value="2" class="radio-custom" name="radio-group" type="radio" checked>
                        <label for="radio-1" class="radio-custom-label">Không đồng ý</label>
                        </div>
                        <div class="group-radio">
                            <input id="radio-2" value="1" class="radio-custom" name="radio-group" type="radio">
                            <label for="radio-2" class="radio-custom-label">Đồng ý</label>
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
            $('#txtid').val($(this).attr('data-id'))
            $('#myModal').modal('show');
        });
        $('#btnluuthaydoi').on('click',function(){
            if($('#txtghichu').val()!=''){
                $($('#txtghichu')).removeClass('errorClass');
                $.ajax(
                      {
                          
                          url: configulr+"site/ajaxupdatestatusteachersuggest",
                          type: "POST",
                          data: { 
                            classid: $('#txtclassid').val() ,
                            note:$('#txtghichu').val(),
                            trangthai:$('input[name=radio-group]:checked').val(),
                            id:$('#txtid').val()
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