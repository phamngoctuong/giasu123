<h3 class="header">Thêm HTML</h3>
<div class="content-inner">
	<form name="frmslider" action="<?php echo site_url('admin/add_custom'); ?>" method="post" enctype="multipart/form-data">
		<?php
			if(isset($id))
			{
				$this->db->where('id',$id);
				$item=$this->db->get('tbl_custom_html')->row();
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
		<tr><td width="200">
			<strong>HTML</strong></td>
			<td>
			​<textarea rows="5" cols="70" name="html" id="editor" /><?php if(isset($id)) {echo $item->html;} ?></textarea>
		</td></tr>
		<tr><td width="200">
			<strong>Vị trí</strong></td>
			<td>
			<input type="text" name="sort" value="<?php if(isset($id)) { echo $item->sort; }; ?>" />
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
