<?php ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left'); ?>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right " style="min-height:300px;">
                <div class="fromdatime">
                    <div class="form-control">
                        <input type="text" id="datepiker" name="datepiker" placeholder="Chọn khoảng thời gian" />
                        <i class="fa fa-calendar"></i> 
                    </div>
                </div>
                <div class="dashboard">                    
                    <div class="dashboard_r col-md-12">
                        <div class="row">
                        <span class="col-md-2"><b><?php echo intval($classinvite->solopdamoi) ?></b><br/>Lớp mời dạy</span>
                        <span class="col-md-2"><b><?php echo intval($lopday->lopdaday); ?></b><br/>Lớp đã nhận dạy</span>
                        <span class="col-md-2"><b><?php echo intval($lopday->lopdenghiday); ?></b><br/>Lớp đã đề nghị dạy</span>
                        <span class="col-md-2"><b><?php echo intval($classsave->solopdaluu) ?></b><br/>Lớp đã lưu</span>
                        <span class="col-md-2"><b>3</b><br/>Lượt xem hồ sơ</span>
                        <span class="col-md-2"><b>3</b><br/>Số lần làm mới</span>
                        </div>
                        <div style="clear:bold;"></div>                        
                    </div>
                </div>                
                <div class="box-file-newest">
                    <div class="title"><i class="fa fa-newest"></i>Lớp đã được mời dạy mới nhất
                    <span><i class="fa fa-services"></i> <span class="btnregisterservices"> Xem tất cả</span></span>
                    </div>
                    <table class="ungtuyen">
                        <thead>
                        <tr>
                            <th style="width: 9.4%;">STT
                            </th>
                            <th style="width:35%">Học viên
                            </th>
                            <th style="width:35%">Hình thức</th>
                            <th style="width:21.6%">Ngày nhận</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if($topclasssave != ''){ 
                                $j=0;
                                foreach($topclasssave as $i){
                                    $j+=1;
                                ?>
                            <tr>
                                <td><?php echo $j; ?></td>
                                <td><a target="_blank" href="<?php echo base_url().'lop-hoc/'.vn_str_filter($i->ClassTitle).'-'.$i->ClassID ?>"><?php echo $i->ClassTitle ?></a></td>
                                <td><?php echo GetWorking($i->LearnType) ?></td>
                                <td><?php echo date('d/m/Y',strtotime($i->ngaynhan)); ?></td>
                            </tr>
                            <?php } 
                                }
                            ?>                            
                        </tbody>
                    </table>
                </div>
                <div class="box-file-newest">
                    <div class="title"><i class="fa fa-listservices"></i>Danh sách dịch vụ
                    <span><i class="fa fa-services"></i> <span class="btnlistservices"> Đăng ký dịch vụ</span></span>
                    </div>
                    <table class="ntdservices">
                        <thead>
                        <tr>
                            <th style="width: 9.4%;">STT
                            </th>
                            <th style="width:35%">Tên dịch vụ
                            </th>
                            <th style="width:35%">Ngày đăng ký</th>
                            <th style="width:21.6%">Ngày hết hạn</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Gói điểm xem hồ sơ</td>
                                <td>02/06/2018</td>
                                <td>02/06/2018</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Gói điểm xem hồ sơ</td>
                                <td>02/06/2018</td>
                                <td>02/06/2018</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Gói điểm xem hồ sơ</td>
                                <td>02/06/2018</td>
                                <td>02/06/2018</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Gói điểm xem hồ sơ</td>
                                <td>02/06/2018</td>
                                <td>02/06/2018</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>