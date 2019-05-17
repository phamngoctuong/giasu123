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
                    <div class="countitem">Tổng số: <?php echo $countclass ?></div>
                </div>
               <div class="box-file-newest uvrecruitjob">
                    <div class="title"><i class="fa fa-man-brown"></i> Danh sách lớp học
                        <a class="btn btn-link btnthemmoilophoc pull-right" href="<?php echo site_url('mn-hv-dang-tin') ?>" >Thêm mới</a>
                    </div>
                    <table class="uv-ungtuyen box-has-news teacherinvite">
                        <thead>
                        <tr>

                            <th style="width:45%">Tiêu đề</th>
                            <th style="width:13%">Hình thức dạy</th>
                            <th style="width:10%">Mức học phí</th>
                            <th style="width:10%">Môn học</th>
                            <th style="width:10%">Ngày đăng</th>
                            <th style="width:12%">Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($uclass as $n){
                              if(!empty($n->ClassTitle)){
                            ?>
                                <tr>
                                <td><a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>"><?php echo $n->ClassTitle; ?></a>
                                    <span><?php echo $n->TitleView; ?></span>
                                </td>
                                <td class="actionjob"><?php echo GetLearnType($n->LearnType) ?>
                                <a class="btnrefresh" data-val="<?php echo $n->ClassID ?>" data-id="<?php echo $n->ClassID ?>" style="color: #00baba;cursor: pointer;"><i class="fa fa-refresh"></i> Làm mới </a>
                                </td>
                                <td><?php echo number_format($n->Money)." vnđ/buổi"; ?></td>
                                <td><?php echo $n->SubjectName ?></td>
                                <td><?php echo date('d-m-Y',strtotime($n->CreateDate)) ?>
                                <?php if($n->Active == 1){ ?>
                                    <a style="display: block;cursor: pointer;color:#ff0000;" data-val="<?php echo $n->ClassID ?>" data-id="0" class="btnhatin" title="Hạ tin đăng"><i class="fa fa-trash"></i></a>
                                    <?php }else{ ?>
                                    <a style="display: block;cursor: pointer;color:#00baba" data-val="<?php echo $n->ClassID ?>" data-id="1" class="btnhatin" title="Đăng tin"><i class="fa fa-check"></i></a>
                                    <?php } ?>
                                </td>
                                <td class="actionjob">
                                    <a class="btnntdupdate" data-val="<?php echo $n->ClassID ?>" data-id="<?php echo $n->ClassID ?>"><i class="fa fa-refresh"></i> Cập nhật </a>
                                    <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" target="_blank" class="btnntdviewdetail"><i class="fa fa-view-detail"></i> Chi tiết</a>
                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                        <?php if(!empty($uclass) && count($uclass) >= 6){ ?>
                           <tfoot>
                                <tr>
                                    <td colspan="6">
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

  <script>
    $(document).ready(function () {
        var configulr='<?php echo base_url(); ?>';
        $('.teacherinvite').on('click','a.btnntdupdate',function(){
           var tg= $(this).attr('data-val');
            window.location.href='<?php echo site_url('mn-hv-dang-tin')."/" ?>'+tg;
        });
        $('.teacherinvite').on('click','a.btnhatin',function(){
           var tg= $(this).attr('data-val');
           var dataid=$(this).attr('data-id');
            $.ajax(
              {

                  url: configulr+"/site/ajaxhatindang",
                  type: "POST",
                  data: {
                    cid:tg,
                    ctype: dataid
                        },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                            alert('Hạ tin thành công');
                          window.location.reload();
                      }
                      else {
                         alert('Cập nhật thất bại, bạn vui lòng kiểm tra lại');
                      }
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();

                  }
              });
        });
        $('.teacherinvite').on('click','a.btnrefresh',function(){
           var tg= $(this).attr('data-val');
           var dataid=$(this).attr('data-id');
            $.ajax(
              {

                  url: configulr+"/site/ajaxrefreshclass",
                  type: "POST",
                  data: {
                    cid:tg
                        },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                            alert('Làm mới thành công');
                          window.location.reload();
                      }
                      else {
                         alert('Làm mới không thành công');
                      }
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();

                  }
              });
        });
        $('#btnloadmoreitem').on('click',function(){
            $.ajax(
                      {
                          url: configulr+"site/ajaxloadmoreclassbyuser",
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
                                $('.teacherinvite tbody').append(obj.data);
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
        });
  </script>
