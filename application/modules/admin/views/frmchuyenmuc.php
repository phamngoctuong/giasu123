<?php
$CI=&get_instance();
$CI->load->model('admin/admin_model');
?>
<h3 class="header">Thêm chuyên mục</h3>
<div class="content-inner1">
	<form name="frmdanhmuc" action="<?php echo site_url('admin/add_chuyenmuc'); ?>" method="post" enctype="multipart/form-data">
		<?php
			if(isset($id))
			{
				$this->db->where('id',$id);
				$item=$this->db->get('chuyenmuc')->row();
				$id=$item->id;
			}
		?>
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />
		<div class="gray">
		<table class="tab1">
		<tr>
			<td width="150"><strong>Tên</strong></td>
			<td><input type="text" name="name" width="250" value="<?php if(isset($id)) {echo $item->name;} ?>" /></td>
		</tr>
		<tr class="second">
			<td><strong>Đường dẫn thân thiện</strong><br /></td>
			<td><input type="text" name="alias" value="<?php if(isset($id)){ echo $item->alias;} ?>" /></td>
		</tr>
		<tr>
			<td><strong>Ảnh đại diện</strong><br /></td>
			<td><?php if(isset($id)){?>
			<input type="hidden" name="image" value="<?php echo $item->image; ?>">
			<?php if($item->image !=''){?>
			<img src="<?php echo 'upload/'.$item->image; ?>"><br />
			<?php }}
			?>
			<input type="file" name="image" value="" /></td>
		</tr>
		<tr class="second">
			<td><strong>Chuyên mục cha</strong></td>
			<td><?php
				if(isset($id)){ $CI->admin_model->selectCtrl($item->parent,'parent', 'forFormDim');}
				else{
					$CI->admin_model->selectCtrl('','parent', 'forFormDim');
				}
			?>
			</td>
		</tr>
		<tr>
			<td><strong>Vị trí hiển thị</strong></td>
			<td>
				<?php
				if(isset($id))
				{
				?>
					<input class="news_checkbox" type="checkbox" name="menu" value="1" <?php if($item->menu==1): ?>checked<?php endif; ?> />Hiển thị menu
					<?php
				}
				else
				{
				?>
					<input class="news_checkbox" type="checkbox" name="menu" value="1" checked="checked" />Hiển thị menu
				<?php
				}
				?>
			</td>
		</tr>
		<tr>
			<td><strong>Mô tả</strong></td>
			<td>​<textarea id="editor" rows="5" cols="70" name="content" /><?php if(isset($id)) {echo $item->content;} ?></textarea></td>
		</tr>
		<tr>
			<td><strong>Thứ tự<strong></td>
			<td>​
				<input style="width:50px" type="text" name="sort" value="<?php if(isset($id)){ echo $item->sort;} else
				{
					$sqltt="SELECT sort FROM chuyenmuc ORDER BY sort DESC";
					$tt=$this->db->query($sqltt);
					if($tt->num_rows()>0){
						$sort=$tt->row()->sort+1;
					}else{
						$sort=1;
					}
					echo $sort;
				}
				?>" />
			</td>
		</tr>
		<tr>
			<td><strong>Trạng thái</strong></td>
			<td>
			<?php
			 if(isset($id))
			 {
			?>
				<input class="news_checkbox" type="checkbox" name="status" value="1" <?php if($item->status==1): ?>checked="checked"<?php endif; ?> />Xuất bản
				<?php
			 }
				else
				{
				?>
					<input class="news_checkbox" type="checkbox" name="status" value="1" checked="checked" />Xuất bản
				<?php
			}
			?></td>
		</tr>
		</table>
		</div>
		<div class="gray">
		<table width="100%">
			<tr>
				<td width="150"><strong>SEO Title</strong></td>
				<td><input type="text" name="meta_title" value="<?php if(isset($id)) {echo htmlspecialchars($item->meta_title);} ?>" /></td>
			</tr>
			<tr>
				<td width="150"><strong>SEO Key</strong></td>
				<td><input type="text" name="meta_key" value="<?php if(isset($id)) {echo htmlspecialchars($item->meta_key);} ?>" /></td>
			</tr>
			<tr>
				<td width="150"><strong>SEO Description</strong></td>
				<td>​<textarea rows="4" cols="70" style="width:95%" name="meta_des" /><?php if(isset($id)) {echo $item->meta_des;} ?></textarea></td>
			</tr>
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
<script type="text/javascript" src="javascript/formCKEDITOR.js">

</script>
