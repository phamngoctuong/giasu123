<div class="logo">
	<a href="<?php echo site_url('admin/'); ?>"><h1 style="color:#fff;">Gia Sư</h1></a>
</div>
<?php 
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin');	

if($admin->num_rows() >0)
$admin=$admin->row(); 
{
?>
<div class="header-right">
	Chào <a href="<?php echo site_url('admin/edit_thanhvien/'.$admin->id); ?>" class="name-admin"><?php echo $admin->fullname;?></a><a class="exit" href="<?php echo site_url('admin/thoat'); ?>">Thoát</a>
</div>
<?php } ?>