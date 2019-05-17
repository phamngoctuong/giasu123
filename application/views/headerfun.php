<?php 
$type=-1;
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
    $type=$tg['Type'];
    }
    
?>
<?php if($type ==0){ ?>
    <div class="uvheaderfun">
        <ul>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('phu-huynh-manager') ?>" title="Tủ hồ sơ"><i class="fa fa-uv-documentfile"></i> Tủ hồ sơ</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-hv-thong-tin-ho-so') ?>" title="Tài khoản"><i class="fa fa-uv-account"></i> Tài khoản</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-hv-dang-tin') ?>" title="Đăng tin tìm gia sư"><i class="fa fa-uv-newspaper"></i> Đăng tin tìm gia sư</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-hv-gia-su-da-luu') ?>" title="Gia sư đã mời dạy"><i class="fa fa-uv-downloadbox"></i> Gia sư đã lưu</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-hv-gia-su-moi-day') ?>" title="gia sư mời dạy"><i class="fa fa-uv-sendmail"></i> Gia sư mời dạy</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-hv-cai-dat-ho-so') ?>" title="Thiết lập thông báo"><i class="fa fa-uv-pencilouline"></i> Thiết lập thông báo</a>
            </li>
        </ul>
    </div>
    <?php }else if($type==1){?>
    <div class="uvheaderfun">
        <ul>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('giao-vien-manager') ?>"><i class="fa fa-uv-account"></i> Tài khoản</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-gia-su-cap-nhat-thong-tin') ?>" title="Đăng tin tìm lớp"><i class="fa fa-uv-newspaper"></i> Đăng tin tìm lớp</a>
            </li>            
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-gia-su-nap-tien') ?>"><i class="fa fa-uv-documentfile"></i> Quản lý tin đăng</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-danh-sach-lop-da-luu') ?>" title="lớp đã lưu"><i class="fa fa-uv-savefolder"></i> Lớp đã lưu</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-danh-sach-lop-de-nghi-day') ?>" title="Lớp đề nghị dạy"><i class="fa fa-uv-uploadfolder"></i> Lớp đã đề nghị dạy</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-giao-vien-tim-lop-day') ?>" title="Thông báo lớp"><i class="fa fa-uv-pencilouline"></i> Thông báo lớp</a>
            </li>
        </ul>
    </div>
    <?php }else if($type==4){ ?>
    <div class="uvheaderfun">
        <ul>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-company-manager') ?>"><i class="fa fa-uv-account"></i> Tài khoản</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-company-addnew') ?>" title="Đăng tin tuyển dụng"><i class="fa fa-uv-newspaper"></i> Đăng tin tuyển dụng</a>
            </li>            
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-company-manager-news') ?>"><i class="fa fa-uv-documentfile"></i> Quản lý tin đăng</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-company-ds-ung-vien-luu') ?>" title="Ứng viên đã lưu"><i class="fa fa-uv-savefolder"></i> Ứng viên đã lưu</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-company-nap-tien') ?>" title="Nạp tiền"><i class="fa fa-uv-uploadfolder"></i> Nạp tiền</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-company-rut-tien') ?>" title="Điểm xem thông tin"><i class="fa fa-uv-pencilouline"></i> Điểm xem thông tin</a>
            </li>
        </ul>
    </div>
    <? }else if($type==3){ ?>
    <div class="uvheaderfun">
        <ul>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-candi-manager') ?>"><i class="fa fa-uv-account"></i> Quản lý chung</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-candi-updateinfo') ?>" title="Cập nhật thông tin"><i class="fa fa-uv-newspaper"></i> Cập nhật thông tin</a>
            </li>            
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-candi-nap-tien') ?>" title="Nạp tiền tài khoản"><i class="fa fa-uv-documentfile"></i> Nạp tiền tài khoản</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mg-candi-viec-da-luu') ?>" title="Việc đã lưu"><i class="fa fa-uv-savefolder"></i> Việc đã lưu</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-candi-viec-da-ung-tuyen') ?>" title="Việc đã ứng tuyển"><i class="fa fa-uv-uploadfolder"></i> Việc đã ứng tuyển</a>
            </li>
            <li class="col-md-2 col-sm-12">
                <a href="<?php echo site_url('mn-candi-rut-tien') ?>" title="Điểm xem thông tin"><i class="fa fa-uv-pencilouline"></i> Điểm xem thông tin</a>
            </li>
        </ul>
    </div>
    <?php } ?>