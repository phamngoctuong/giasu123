<?php ?>
<?php ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left4'); ?>
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
                <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc" style="overflow: hidden;">
                <?php if(empty($comdetail)){ ?>
                    <div><h4 class="title">Bạn cần phải cập nhật thông tin công ty</h4>
                    <a class="btn-link" href="<?php echo site_url('mn-company-updateinfo'); ?>">Chi tiết tại đây</a> Hoặc bạn có thể vào <span><b>Thông tin công ty</b> >> <b>Cập nhật thông tin</b></span>
                    
                    </div>
                <?php } ?>
                </div>
                
            </div>
        </div>
    </div>
</div>
</section>