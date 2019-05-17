<?php 
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();	
?>
<div class="webcome">
<?php if($admin->role==1 or $admin->role==3){ ?>
	<div class="box"><div class="box-inner"><a href="<?php echo site_url('admin/chuyenmuc/'); ?>"><img src="images/toolbar/categories.png"><span>Chuyên mục</span></a></div></div>
	<!--<div class="box"><div class="box-inner"><a href="<?php echo site_url('admin/slider/'); ?>"><img src="images/toolbar/image-editing.png"><span>Slider</span></a></div></div>-->
<?php } ?>
	<div class="box"><div class="box-inner"><a href="<?php echo site_url('admin/frmbaiviet'); ?>"><img src="images/toolbar/icon-48-article-add.png"><span>Đăng bài</span></a></div></div>	
	<div class="box"><div class="box-inner"><a href="<?php echo site_url('admin/baiviet/'); ?>"><img src="images/toolbar/icon-48-article.png"><span>Bài viết</span></a></div></div>	
	<!--<div class="box"><div class="box-inner"><a href="#"><img src="images/toolbar/tags.png"><span>Từ khóa</span></a></div></div>	
	<div class="box"><div class="box-inner"><a href="#"><img src="images/toolbar/extra-fields.png"><span>Trường dữ liệu</span></a></div></div>	
	<div class="box"><div class="box-inner"><a href="#"><img src="images/toolbar/icon-48-category.png"><span>Quản lý File</span></a></div></div>	
	<div class="box"><div class="box-inner"><a href="#"><img src="images/toolbar/help.png"><span>Trợ giúp</span></a></div></div>	
	<div class="box"><div class="box-inner"><a href="#"><img src="images/toolbar/icon-48-config.png"><span>Cài đặt</span></a></div></div>	
	<div class="box"><div class="box-inner"><a href="#"><img src="images/toolbar/icon-48-user-profile.png"><span>Góp ý</span></a></div></div>-->		
</div>

<div class="clr"></div>