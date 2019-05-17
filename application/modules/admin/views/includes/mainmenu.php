<?php
$CI=&get_instance();
$CI->load->model('admin/admin_model');
$footer=$CI->admin_model->gettbl('tbl_meta',1)->row();
// $uoctinhluong=$CI->admin_model->gettbl('tbl_meta',2)->row();
// $formresultsosanh=	$CI->admin_model->gettbl('tbl_meta',3)->row();
$ketquauoctinhluong=	$CI->admin_model->gettbl('tbl_meta',4)->row();
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();
$huongdan=	$CI->admin_model->gettbl('tbl_footer',1)->row();
?>
<div class="navbar-inner">
	<ul>
		<li><a href="<?php echo site_url('admin'); ?>">Quản trị</a></li>
		<?php if($admin->role==1){?>
		<li><a href="javascript:void(0)">Module phụ</a>
			<ul class="sub-menu">
				<!--<li><a href="<?php echo site_url('admin/banner'); ?>">Banner</a></li>
				<li><a href="<?php echo site_url('admin/slider'); ?>">Slider</a></li>-->
				<li><a href="<?php echo site_url('admin/custom'); ?>">Custom HTML</a></li>
			</ul>
		</li>
		<?php } ?>
		<li><a href="javascript:void(0)">Quản lý bài viết</a>
			<ul class="sub-menu">
				<li><a href="<?php echo site_url('admin/chuyenmuc'); ?>">Chuyên mục</a></li>
				<li><a href="<?php echo site_url('admin/baiviet'); ?>">Bài viết</a></li>
			</ul>
		</li>
		<?php if($admin->role==1){?>
		<li>
			<a href="javascript:void(0)">Trang gia sư</a>
			<ul class="sub-menu">
				<li><a href="<?php echo site_url('admin/vieclam'); ?>">Quản lý gia sư</a></li>
								<li><a href="<?php echo site_url('admin/doanhnghiep'); ?>">Quản lý doanh nghiệp</a></li>
								<li><a href="<?php echo site_url('admin/trangungvien'); ?>">Quản lý ứng viên</a></li>
								<li><a href="<?php echo site_url('admin/ungvien'); ?>">Quản lý Chung</a></li>
                <li><a href="<?php echo site_url('admin/lophoc'); ?>">Quản lý lớp học</a></li>
                <li><a href="<?php echo site_url('admin/jobmanager');?>">Quản lý việc làm</a></li>
                <li><a href="<?php echo site_url('admin/monhoc');?>">Quản lý môn học</a></li>
                <li><a href="<?php echo site_url('admin/chudemonhoc');?>">Quản lý chủ đề</a></li>
			</ul>
		</li>
		<li>
            <a href="javascript:void(0)">Kế toán</a>
			<ul class="sub-menu">
				<li><a href="<?php echo site_url('admin/duyettien'); ?>">Duyệt cộng tiền</a></li>
                <li><a href="<?php echo site_url('admin/duyetdiem'); ?>">Duyệt điểm</a></li>
                <li><a href="<?php echo site_url('admin/editlogpoint/1'); ?>">Cấu hình điểm</a></li>
                <li><a href="<?php echo site_url('admin/tieudung') ?>">Tiêu dùng</a></li>
                <li><a href="<?php echo site_url('admin/thongkediem') ?>">Thống kê điểm</a></li>
			</ul>
        </li>
		<li>
            <a href="admin/pagemeta">Quản lý Meta</a>
            <ul class="sub-menu">
                <li><a href="<?php if (count($footer)==0){echo site_url('admin/edit_meta/1');}
            			else{
            			echo site_url('admin/edit_meta/'.$footer->id);
            			}
            		?>">Home</a>
                </li>
								  <li><a href="<?php echo site_url('admin/edit_meta/2')?>">Danh sách việc làm thêm</a>
								<li><a href="<?php echo site_url('admin/edit_meta/3')?>">Việc làm fulltime</a>
                <li><a href="<?php if (count($ketquauoctinhluong)==0){echo site_url('admin/edit_meta/4');}
            			else{
            			echo site_url('admin/edit_meta/'.$ketquauoctinhluong->id);
            			}
            		?>">Ứng viên</a>
                </li>
                <li><a href="<?php echo site_url('admin/edit_meta/5')?>">Danh sách lớp học</a>
                </li>
                <li><a href="<?php echo site_url('admin/edit_meta/6')?>">Tìm gia sư(tat-ca-gia-su)</a>
                </li>
            </ul>
            </li>
						<li>
							<a href="javascript:void(0)">SEO</a>
							<ul class="sub-menu">
										<li><a href="<?php echo site_url('admin/linkseo')?>">Link seo</a></li>
										<li><a href="<?php echo site_url('admin/edit_SEO/2')?>">SEO-tim lop gia su</a></li>
										<li><a href="<?php echo site_url('admin/edit_SEO/3')?>">SEO-tim gia su</a></li>
							</ul>
						</li>
						<li>
							<a href="admin/managecodeSMS">quản lí mã xác thực sms</a>
						</li>

        <li><a href="<?php if (count($huongdan)==0){echo site_url('admin/edit_footer/1');}
            			else{
            			echo site_url('admin/edit_footer/'.$huongdan->id);
            			}
            		?>">Thông số chung</a>
                </li>
		<li><a href="<?php echo site_url('admin/tbladmin'); ?>">Thành viên</a></li>
		<?php } ?>
	</ul>
</div>
