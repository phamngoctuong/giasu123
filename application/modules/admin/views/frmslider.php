<h3 class="header">Thêm Slider</h3>
<div class="content-inner">
	<form name="frmslider" action="<?php echo site_url('admin/add_slider'); ?>" method="post" enctype="multipart/form-data">
		<?php
			if(isset($id))
			{
				$this->db->where('id',$id);
				$item=$this->db->get('tbl_slider')->row();
				$id=$item->id;
			}
		?>
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />
		<div class="gray">
		<table class="tab1">
		<tr class="second"><td width="200"><strong>Tiêu đề</strong></td>
			<td>
			<input type="text" name="name" value="<?php if(isset($id)) { echo $item->name; }; ?>" />
		</td></tr>
		<tr><td><strong>Ảnh đại diện</strong></td>
			<td><?php if(isset($id)){?>
			<input type="hidden" name="image" value="<?php echo $item->image; ?>">
			<img src="<?php echo 'upload/slider/'.$item->image; ?>" width="450"><br />
			<?php }
			?>
			<input type="file" name="image" value="" />
		</td></tr>
		<tr><td width="200">
			<strong>Link liên kết</strong></td>
			<td>
			<input type="text" name="link" value="<?php if(isset($id)) { echo $item->link; }; ?>" />
		</td></tr>
		<tr><td width="200">
			<strong>Nội dung</strong></td>
			<td>
			​<textarea rows="5" cols="70" name="content" id="editor" /><?php if(isset($id)) {echo $item->content;} ?></textarea>
		</td></tr>
		<tr><td width="200">
			<strong>Trạng thái</strong></td>
			<td>
			<p class="message_head">
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
							<input class="news_checkbox" type="checkbox" name="status" value="1" />Xuất bản
						<?php
					}
					?>
				</p>
		</td></tr>
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
