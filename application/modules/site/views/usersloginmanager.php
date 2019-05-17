<?php ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left1'); ?>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right right-uv" style="min-height:300px;">
                <div class="fromdatime">
                    <div class="clr" style="height:28px"></div>
                    <!--<div class="form-control">
                        <input type="text" id="datepiker" name="datepiker" placeholder="Chọn khoảng thời gian" />
                        <i class="fa fa-datetime"></i>
                    </div>-->

                </div>
                <div class="dashboard-uv">

                    <div class="dashboard_r">
                        <div>
                        <span><b><?php echo $giasuphuhop->sogiaovien ?></b><br/>Gia sư phù hợp</span>
                        <span><b><?php echo $giaovienluu->sogcluu ?></b><br/>Gia sư đã lưu</span>
                        <span><b>3</b><br/>Lượt xem hồ sơ</span>
                        <span><b>3</b><br/>Lượt xem<br /> thông tin liên hệ</span>
                        <span><b><?php echo $teacherinvite->giasumoiday ?></b><br/>Gia sư mời dạy</span>
                        </div>
                        <div style="clear:bold;"></div>
                    </div>
                </div>
                <div class="box-file-newest uvnewest">
                    <div class="title"><i class="fa fa-uv-document"></i> Gia sư đã mời dạy gần nhất

                    </div>

                    <table class="uv-ungtuyen">
                        <thead>
                        <tr>

                            <th style="width:45%">Họ tên gia sư
                            </th>
                            <th style="width:35%">Gia sư môn</th>
                            <th style="width:20%">Ngày mời</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($topteacherinvite)){
                            foreach($topteacherinvite as $n){ ?>
                            <tr>

                                <td><a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>"><?php echo $n->Name; ?></a></td>
                                <td><?php echo $n->TitleView; ?></td>
                                <td><?php echo date('d/m/Y',strtotime($n->ngaymoi)) ?></td>
                            </tr>
                        <?php }
                        } ?>

                        </tbody>
                    </table>
                </div>
                <div class="box-file-newest uvnewest">
                    <div class="title"><i class="fa fa-disk-brown"></i> Gia sư đã lưu mới nhất

                    </div>

                    <?php if(!empty($topteachsave)){ ?>
                        <table class="uv-ungtuyen box-has-news" style="">
                        <thead>
                        <tr>

                            <th style="width:45%">Tên công việc
                            </th>
                            <th style="width:35%">Công ty</th>
                            <th style="width:20%">Ngày nộp</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($topteachsave as $n){ ?>
                            <tr>
                                <td><a href=""><?php echo $n->Name; ?></a></td>
                                <td><?php echo $n->TitleView; ?></td>
                                <td><?php echo date('d/m/Y',strtotime($n->ngayluu)) ?></td>
                            </tr>
                        <?php } ?>


                        </tbody>
                    </table>
                    <?php }else{ ?>
                    <div class="box-no-newest">
                        <p>Bạn chưa có việc làm nào. Tham khảo danh sách <a>việc làm phù hợp</a> hoặc <a>tìm kiếm hàng ngàn việc làm có sẵn</a> trên timviec365.vn</p>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
</section>
