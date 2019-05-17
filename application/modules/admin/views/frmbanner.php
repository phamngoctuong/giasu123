<?php 
$CI=&get_instance();
$CI->load->model('admin/admin_model');
?>
<h3 class="header">Thêm Banner</h3>
<div class="content-inner">
	<form name="frmslider" action="<?php echo site_url('admin/add_banner'); ?>" method="post" enctype="multipart/form-data">
		<?php 
			if(isset($id))
			{
				$this->db->where('id',$id);
				$item=$this->db->get('tbl_banner')->row();
				$id=$item->id;            
			}
		?>    
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />	
		<div class="gray">
		<table width="100%"><tr>
		<td>
			<table class="tab1">
			<tr><td width="200">
				<strong>Tên Banner</strong></td>
				<td>
				<input type="text" name="name" value="<?php if(isset($id)) { echo $item->name; }; ?>" />
			</td></tr>
			<tr class="second"><td>
				<strong>File</strong></td>
				<td>
				<input type="file" name="file" value="" />
				<?php if(isset($id)){?>				
				<br />
				<input style="margin-top:5px;" type="hidden" name="file" value="<?php echo $item->file; ?>">					
				<img src="<?php echo 'upload/banner/'.$item->file; ?>" style="max-width: 500px; margin-top: 5px">
				<?php } ?>				
			</td></tr>
			<tr><td width="200">
				<strong>Đường dẫn liên kết</strong></td>
				<td>
				<input type="text" name="link" value="<?php if(isset($id)) { echo $item->link; } else{ echo 'http://';}; ?>" />
			</td></tr>
			<tr class="second"><td width="200">
				<strong>Trạng thái</strong></td>
				<td>
				<p class="message_head">									
					<?php 
					if(isset($id)){							 
					?>
						<input class="news_checkbox" type="checkbox" name="status" value="1" <?php if($item->status==1){ echo "checked"; } ?> />Xuất bản				
					<?php }else{ ?>
						<input class="news_checkbox" type="checkbox" name="status" checked="checked" value="1" />Xuất bản
					<?php } ?>			
				</p>
				<p class="message_head">									
					<?php if(isset($id)){ ?>
						<input class="news_checkbox" type="checkbox" name="vip" value="1" <?php if($item->vip==1){ echo "checked"; } ?> />VIP
					<?php }else{ ?>
						<input class="news_checkbox" type="checkbox" name="vip" value="1" />VIP
					<?php } ?>			
				</p>
			</td></tr>
			<tr><td width="200">
				<strong>Vị trí quảng cáo</strong></td>
				<td>											
					<select name="vitri" style="width:100px;">
						<?php if(isset($id)){ ?>
						<option value="<?php echo $item->vitri; ?>" selected="selected" ><?php echo strtoupper($item->vitri); ?></option>
						<?php } ?>						
						<option value="a0">A0</option>
						<option value="a1">A1</option>
						<option value="a2">A2</option>
						<option value="a3">A3</option>
						<option value="a4">A4</option>
						<option value="a5">A5</option>
						<option value="a6">A6</option>
						<option value="a7">A7</option>
					</select>					
			</td></tr>	
			<tr><td width="200">
				<strong>Thứ tự</strong></td>
				<td>
				<input type="text" style="width:100px" name="sort" value="<?php if(isset($id)) { echo $item->sort; }; ?>" />
			</td></tr>
			<tr><td width="200">
				<strong>Chuyên mục hiển thị</strong></td>
				<td>											
					<select name="cid">
						<option value="">------------------</option>
						<?php
							$cm = $this->db->query('SELECT id,name FROM tbl_chuyenmuc WHERE status=1');
							foreach ($cm->result() as $c) {
						?>
						<option <?php if(isset($id) and $item->cid==$c->id){ echo 'selected'; }?> value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
						<?php } ?>
					</select>					
			</td></tr>		
			</table>
		</td>
		<td valign="top">
			<table width="100%">
				<tr><td>
					<p class="message_head"><strong>Kích thước file: </strong><br /><cite>Đơn vị pixel (width x height)</cite></p>
					<p class="message_head" style="color:red;">A0: full x full</p>
					<p class="message_head" style="color:red;">A1: 435 x 265</p>
					<p class="message_head" style="color:red;">A2: 270 x 500</p>
					<p class="message_head" style="color:red;">A3: 270 x *</p>
				</td></tr>
			</table>
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
