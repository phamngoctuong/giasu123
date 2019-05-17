<?php $userinfo1=$_SESSION['UserInfo'];

?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left4'); ?>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right right-uv" style="min-height:300px;">
                <div class="fromdatime">
                    <div class="clr" style="height:10px;position: relative;"><a class="btnlogout"><i class="fa fa-logout"></i> Thoát</a></div>
                    <div class="clr" style="height:40px;"></div>
                    <!--<div class="form-control">
                        <input type="text" id="datepiker" name="datepiker" placeholder="Chọn khoảng thời gian" />
                        <i class="fa fa-datetime"></i>
                    </div>-->

                </div>
                <?php if($userinfo1['Type']==4){ ?>
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
                                                <option value="" >Chọn mức lương</option>
                                                <option value="1">Thỏa thuận</option>
                                                <option value="2">1 - 3 triệu</option>
                                                <option value="3">3 - 5 triệu</option>
                                                <option value="4">5 - 7 triệu</option>
                                                <option value="5">7 - 10 triệu</option>
                                                <option value="6">10 - 15 triệu</option>
                                                <option value="7">15 - 20 triệu</option>
                                                <option value="8">20 - 30 triệu</option>
                                                <option value="9">Trên 30 triệu</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-2">
                                            <div class="form-control"><input type="text" id="findkey" name="findkey" placeholder="Nhập tiêu đề tin"/></div>
                                        </div>
                                        <div class="col-md-3 col-3">
                                            <div class='input-group date' id='datetimepicker1' style="width: 100%">
                                                    <input type='text' placeholder="Ngày lưu" id="txtngaysinh" class="form-control" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-4">
                                            <a class="btncategorymanager" id="loctimkiem">Lọc tìm kiếm</a>

                                        </div>
                                    </div>
               				 </div>
                			</div>
                    </div>

                    <div class="box-file-newest">
                        <a class="btnntdaddnew btn-info pull-right text-center btn"  style="padding:0px 20px;">Thêm tin tuyển dụng</a>
                    <table id="tbllstclass">
                        <thead>
                        <tr>
                            <th style="width: 8.4%;">STT
                            </th>
                            <th style="width:35%">Họ Tên
                            </th>
                            <th style="width:15%;">Hạn nộp</th>
                            <th style="width: 14%;">Mức lương</th>
                            <th style="">Ngày lưu</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($tintuyendung)){
                            foreach($tintuyendung as $n){
                              ?>
                            <tr>
                                <td class="stt"><?php echo $i; ?></td>
                                <td>
                                    <a href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html"; ?>" target="_blank"><?php echo $n->new_title ?></a>
                                </td>
                                <td class="txtnote"><?php echo date("d/m/Y",$n->new_han_nop) ?></td>
                                <td><span><?php echo GetLuong($n->new_money)  ?></span></td>
                                <td><?php echo date("d/m/Y",$n->new_create_time) ?></td>
                                <td class="actionjob">
                                    <a data-val="<?php echo $n->new_id; ?>" data-id="<?php echo $n->active ?>" class="btnntdedit" >Sửa</a>
                                </td>
                            </tr>
                            <?php } }else{ ?>
                            <tr><td colspan="6">Không tìm thấy bản ghi</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</section>
<script src="js/moment.js"></script>
<script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script>
$(document).ready(function(){
     var configulr='<?php echo site_url(); ?>';

     $('#monhoc').select2({ width: '100%',placeholder: 'Chọn mức lương' });
    $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD-MM-YYYY'
    });
    $('#loctimkiem').on('click',function(event){

    event.stopPropagation();

    $.ajax({

                          url: configulr+"site/ajaxfiltercompanyjobspost",
                          type: "POST",
                          data: {
                            monhoc: $('#monhoc').val(),
                            findkey:$('#findkey').val(),
                            ngaythang:$('#txtngaysinh').val()
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                              $('#loctimkiem').hide();
                          },
                          success: function (obj) {

                             if(obj.kq ==true){
                                $('#tbllstclass tbody tr').remove();
                                $('#tbllstclass tbody').append(obj.data);
                                }else{
                                     alert('Không tìm thấy kết quả phù hợp');
                                }
                          },
                          error: function (xhr) {
                              alert("error");
                          },
                          complete: function () {

                              $('#loctimkiem').show();
                          }
                      });
                    });
    $('.btnntdaddnew').on('click',function(){
      <?php
      $userid=0;
      if($_SESSION['UserInfo'] !=''){
          $tg=$_SESSION['UserInfo'];
          $userid=$tg['UserId'];
      }
      $companyid=$this->db->select('usc_id');
      $companyid=$this->db->get_where('user_company',array('UserID'=>$userid))->row();
       if($companyid->usc_id!=0){
        ?>
            window.location.href=configulr+'mn-company-addnew';

        <?php }else{ ?>
          alert("Bạn cần phải điền thông tin công ty");
          window.location.href=configulr+'mn-company-updateinfo';
        <?php } ?>
    });
    $('#tbllstclass').on('click','a.btnntdedit',function(){

            window.location.href=configulr+'mn-company-addnew/'+$(this).attr('data-val');
        });
    });
</script>
