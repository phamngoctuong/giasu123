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
                    <div class="filter">
                        <ul  class="nav nav-tabs">
                			<li class="active">
                                <a href="#1a" data-toggle="tab">Bộ lọc</a>
                			</li>
                			
                		</ul>
                
                			<div class="tab-content clearfix">
                			  <div class="tab-pane active" id="1a">
                                    <div class="row mrg-0">
                                        <div class="col-md-3 col-1">
                                            <select id="monhoc" class="nganhnghe_ab_tag">                        
                                                <option value="" >Chọn môn học</option>
                                                <?php 
                                                    if(!empty($monhoc)){
                                                        foreach($monhoc as $n){ ?>
                                                            <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                                            <?php }
                                                        }
                                                    ?>                          
                                             </select>
                                        </div>
                                        <div class="col-md-3 col-2">
                                            <div class="form-control"><input type="text" id="findkey" name="findkey" placeholder="Nhập tiêu đề hồ sơ muốn tìm"/></div>
                                        </div>
                                        <div class="col-md-3 col-3">
                                            <div class='input-group date' id='datetimepicker1' style="width: 100%">
                                                    <input type='text' placeholder="Ngày mở lớp" id="txtngaysinh" class="form-control" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-4">
                                        <a class="btncategorymanager" id="loctimkiem">Lọc tìm kiếm</a>
                                            <a id="xuatexel" class="btnexportexcel">Xuất file excel</a>
                                        </div>
                                    </div>
               				 </div>                			
                			</div>
                    </div>
                    <div class="box-file-newest">
                    <table id="tbllstclass">
                        <thead>
                        <tr>
                            <th style="width: 8.4%;">STT
                            </th>
                            <th style="width:35%">Họ Tên
                            </th>
                            <th style="width:15%;">Ghi chú</th>
                            <th style="width: 14%;">Môn học</th>
                            <th style="">Ngày lưu</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($uservsclass)){ $i=0;
                            foreach($uservsclass as $n){ $i+=1; ?>
                            <tr>
                                <td class="stt"><?php echo $i; ?></td>
                                <td><label><?php echo $n->Name ?></label>
                                    <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" target="_blank"><?php echo $n->ClassTitle ?></a>
                                </td>
                                <td><?php echo $n->ghichu; ?></td>
                                <td><span><?php echo $n->SubjectName ?></span></td>
                                <td><?php echo date("d/m/Y",strtotime($n->CreateDate)) ?></td>
                                <td class="actionjob">
                                    <a data-val="<?php echo $n->ClassID; ?>" class="btnntdedit" id="sualopdaluu">Sửa</a>
                                    <a data-val="<?php echo $n->ClassID; ?>" id="xoalopdaluu" class="btnntddelete">Xóa</a>
                                </td>
                            </tr>
                            <?php } } ?>                            
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
          <div class="modal-title"><b>Cập nhật ghi chú</b></div>
          <input type="hidden" id="txtclassid" name="txtclassid" />
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
<script src="js/moment.js"></script>
<script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script>
$(document).ready(function(){
     var configulr='<?php echo site_url(); ?>';
     $('#monhoc').select2({ width: '100%',placeholder: 'Chọn môn học' });
    $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD-MM-YYYY'
    });
    $('#loctimkiem').on('click',function(){
        $.ajax({
                          
                          url: configulr+"site/ajaxfilterusersaveclass",
                          type: "POST",
                          data: { 
                            monhoc: $('#monhoc').val(),
                            findkey:$('#findkey').val(),
                            ngaythang:$('#txtngaysinh').val()
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                          },
                          success: function (obj) {
                             
                             if(obj.kq ==true){
                                $('#tbllstclass tbody tr').remove();
                                $('#tbllstclass tbody').append(obj.data);
                                }else{                                    
                                                                    
                                }
                          },
                          error: function (xhr) {
                              alert("error");
                          },
                          complete: function () {                              
                              
                              
                          }
                      }); 
    });
    $('.btnntdedit').on('click',function(){
            $('#txtghichu').val('');
            $('#txtclassid').val($(this).attr('data-val'));
            $('#myModal').modal('show');
        });
    $('.btnntddelete').on('click',function(){            
                $.ajax({
                          
                          url: configulr+"site/ajaxdeleteuserssaveclass",
                          type: "POST",
                          data: { 
                            classid: $(this).attr('data-val')
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
    $('#btnluuthaydoi').on('click',function(){
            if($('#txtghichu').val()!=''){
                $($('#txtghichu')).removeClass('errorClass');
                $.ajax(
                      {
                          
                          url: configulr+"site/ajaxupdateuserssaveclass",
                          type: "POST",
                          data: { 
                            classid: $('#txtclassid').val() ,
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
                                    
                                    alert('cập nhật thất bại, vui lòng kiểm tra lại')
                                    
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
        $('#xuatexel').on("click", function () {
            $.ajax(
                      {
                          
                          url: configulr+"site/ajaxusersaveclassexcel",
                          type: "POST",
                          data: {
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                          },
                          success: function (obj) {
                             
                             if(obj.kq ==true){
                                var str = obj.data;
        var excelFile = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:" + "excel" + "' xmlns='http://www.w3.org/TR/REC-html40'>";
        excelFile += "<meta http-equiv='content-type' content='application/vnd.ms-excel; charset=UTF-8'>"
        excelFile += "<head>";
        excelFile += "<!--[if gte mso 9]>";
        excelFile += "<xml>";
        excelFile += "<x:ExcelWorkbook>";
        excelFile += "<x:ExcelWorksheets>";
        excelFile += "<x:ExcelWorksheet>";
        excelFile += "<x:Name>";
        excelFile += "{worksheet}";
        excelFile += "</x:Name>";
        excelFile += "<x:WorksheetOptions>";
        excelFile += "<x:DisplayGridlines/>";
        excelFile += "</x:WorksheetOptions>";
        excelFile += "</x:ExcelWorksheet>";
        excelFile += "</x:ExcelWorksheets>";
        excelFile += "</x:ExcelWorkbook>";
        excelFile += "</xml>";
        excelFile += "<![endif]-->";
        excelFile += "</head>";
        excelFile += "<body>";
        excelFile += str;
        excelFile += "</body>";
        excelFile += "</html>";
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(excelFile));
                                }else{
                                    
                                    
                                    
                                }
                          },
                          error: function (xhr) {
                              alert("error");
                          },
                          complete: function () {                              
                              
                          }
                      }); 
        
    });
    });
</script>