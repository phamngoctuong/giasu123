<?php 
$CI=&get_instance();
$CI->load->model('admin/admin_model');
$category=$CI->admin_model->gettbl('tblrole','')->result();	
?>
<?php 
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin');	
$admin=$admin->row(); 
?>
<h3 class="header">Thêm tài khoản</h3>
<div class="content-inner">
	<form name="frmdanhmuc" action="<?php echo site_url('admin/add_admin'); ?>" method="post" enctype="multipart/form-data">
		<?php 
			if(isset($id))
			{
				$this->db->where('id',$id);
				$item=$this->db->get('tbl_admin')->row();
				$id=$item->id;            
			}
		?>    		
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />
		<div class="gray">
		<table class="tab1">	
		<tr>
			<td width="150">
			<strong>Tài khoản</strong></td>
			<td><input type="text" style="width:200px;" name="name" value="<?php if(isset($id)) {echo $item->name;} ?>" /></td>
		</tr>
		<tr>
			<td><strong>Mật khẩu</strong></td>
			<td><input type="password" name="pass" style="width:200px;" value="<?php if(isset($id)){ echo $item->pass;} ?>" /></td>
		</tr>
		<tr>
			<td><strong>Tên hiển thị</strong></td>
			<td><input type="text" name="fullname"  style="width:250px;" value="<?php if(isset($id)){ echo $item->fullname;} ?>" /></td>
		</tr>
		<tr>
			<td><strong>Ảnh đại diện</strong></td>
			<td><?php if(isset($id)){?>
			<input type="hidden" name="image" value="<?php echo $item->image; ?>">				
			<?php if($item->image != ''){?>
				<img src="<?php echo $item->image; ?>" width="200"><br />
			<?php } }			
			?>
			<input type="file" name="image" value="" /></td>
		</tr>
		<?php
		if($admin->role==1)
		{       
		?>
		<tr>
			<td><strong>Quyền</strong></td>
			<td><select name="role" style="width:200px;">
				<option value="-1">--Chọn quyền--</option>
				<?php 																								           			
						foreach($category as $cat)
						{
							if($cat->id==$item->role)
							{
						?>
						<option value="<?php echo $cat->id; ?>" selected="selected"><?php echo $cat->name; ?></option>
						<?php
						}
						else
						{
						?>
						<option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
						<?php    
						}    
						}   
					
				?>
			</select></td>
		</tr>
		<tr>
			<td><strong>Trạng thái</strong></td>
			<td><?php 
			 if(isset($id))
			 {							 
			?>
				<input class="news_checkbox" type="checkbox" name="status" value="1" <?php if($item->status==1): ?>checked="checked"<?php endif; ?> />Xuất bản				
				<?php         
			 }
				else
				{
				?>
					<input class="news_checkbox" type="checkbox" name="status" value="1" />Xuất bản
				<?php             
			}
			?>	</td>
		</tr>
		<?php } ?>	
		</table>
		</div>
		<div class="gray">
		<center>
		<?php 
			if(isset($id))
			{
			?>			
				<input class="button" type="submit" name="submit" value="Lưu thay đổi" />						
			<?php    
			}
			else
			{
			?>			
				<input class="button" type="submit" name="submit" value="Nhập tin" />					
			<?php 
			}
		?>
		</center>
		</div>
	</form>
	<div class="clr"></div>
</div>
