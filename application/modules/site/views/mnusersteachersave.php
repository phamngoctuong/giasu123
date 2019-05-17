<?php ?><section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left1'); ?>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right right-uv" style="min-height:300px;">
            <div class="fromdatime">
                    <div class="clr" style="height:0px"></div>
                    <!--<div class="form-control">
                        <input type="text" id="datepiker" name="datepiker" placeholder="Chọn khoảng thời gian" />
                        <i class="fa fa-datetime"></i> 
                    </div>-->
                    <div class="countitem">Tổng số: <?php echo $giaovienluu->sogcluu ?></div>
                </div>
               <div class="box-file-newest uvrecruitjob">
                    <div class="title"><i class="fa fa-man-brown"></i> Danh sách gia sư đã lưu                    
                    </div>
                    <table class="uv-ungtuyen box-has-news teachersave">
                        <thead>
                        <tr>
                            <th style="width:5%">STT</th>
                            <th style="width:50%">Gia sư/Môn học
                            </th>
                            <th style="width:13%">Ghi chú</th>
                            <th style="width:15%">Ngày lưu</th>
                            <th style="width:17%">Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($giasudaluu)){
                                $i=0;
                                foreach($giasudaluu as $n){
                                    $i+=1;
                                
                            ?>
                                <tr>
                                <td><?php echo $i ?></td>
                                <td><a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>"><?php echo $n->Name; ?></a>
                                    <span><?php echo $n->TitleView; ?></span>
                                </td>                                
                                <td><?php echo $n->Note; ?></td>
                                <td><?php echo date('d/m/Y',strtotime($n->ngaymoi)) ?></td>
                                <td class="actionjob">
                                    <a data-val="<?php echo $n->UserID ?>" class="btnntdedit" id="sualopdaluu">Sửa</a>
                                    <a data-val="<?php echo $n->UserID ?>" id="xoalopdaluu" class="btnntddelete">Xóa</a>
                                </td>
                            </tr>
                            <?php } } ?>                            
                            
                        </tbody>
                        <?php if(!empty($giasudaluu) && count($giasudaluu) >= 6){ ?>
                           <tfoot>
                            <tr>
                                <td colspan="5">
                                <div class="loadmoreitem"><input type="hidden" id="txtpage" name="txtpage" value="2" /><span id="btnloadmoreitem" class="btn-link"><i class="fa fa-arrow-loadmore"></i> Xem thêm</span></div>
                                </th>
                            </tr>
                        </tfoot> 
                        <?php }?>
                        
                    </table>
                    
                </div> 
            </div>
        </div>
    </div>
</div>
</section>
<div class="modal fade capnhattrangthaiclass" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title"><b>Cập nhật ghi chú</b></div>
          <input type="hidden" id="txtuserid" name="txtuserid" />
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row padd-top-15 padd-bot-5" style="">                    
                    <div class="col-md-12">
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
        $('#btnloadmoreitem').on('click',function(){
            $.ajax(
                      {                          
                          url: configulr+"site/ajaxloadmoreteachersave",
                          type: "POST",
                          data: { 
                            page: $('#txtpage').val()
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                          },
                          success: function (obj) {
                             
                             if(obj.kq ==true){
                                var j=parseInt($('#txtpage').val())+1;
                                $('.teachersave tbody').append(obj.data);
                                $('#txtpage').val(j);
                                }else{
                                   alert('Đã tải toàn bộ lớp bạn đã lưu');
                                }
                          },
                          error: function (xhr) {
                              alert("error");
                          },
                          complete: function () {
                              
                          }
                      }); 
        });
        
        $('.teachersave').on('click','a.btnntdedit',function(){
            $('#txtghichu').val('');
            $('#txtuserid').val($(this).attr('data-val'));
            $('#myModal').modal('show');
        });
        $('#btnluuthaydoi').on('click',function(){
            if($('#txtghichu').val()!=''){
                $($('#txtghichu')).removeClass('errorClass');
                $.ajax(
                      {
                          
                          url: configulr+"site/ajaxupdatenoteusersaveuser",
                          type: "POST",
                          data: { 
                            giaovien: $('#txtuserid').val() ,
                            note:$('#txtghichu').val()
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                          },
                          success: function (obj) {
                             
                             if(obj.kq ==true){
                                alert('Cập nhật thành công');
                                }else{
                                    
                                    alert('cập nhật thất bại, vui lòng kiểm tra lại');
                                    
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
        $('.teachersave').on('click','a.btnntddelete',function(){            
                $.ajax({
                          
                          url: configulr+"site/ajaxdeleteusersvaveuser",
                          type: "POST",
                          data: { 
                            giaovien: $(this).attr('data-val') ,
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                          },
                          success: function (obj) {
                             
                             if(obj.kq ==true){
                                alert('Xóa bản ghi thành công');
                                }else{                                    
                                    alert('cập nhật thất bại, vui lòng kiểm tra lại');                                    
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