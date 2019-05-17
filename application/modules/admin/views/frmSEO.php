<h3 class="header"><?php include("includes/headerSEO.php"); ?></h3>
<?php
	if(!empty($mess)){
		echo '<div class="" style="color: red">'.$mess.'</div>';
	}
 ?>

<div class="content-inner" >
	<form name="frmslider" action="<?php echo site_url('admin/add_SEO'); ?>" method="post" enctype="multipart/form-data">
		<?php
			if(isset($id))
			{
				$this->db->where('id',$id);
				$item=$this->db->get('tbl_footer')->row();
				$id=$item->id;
			}
		?>
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />
		<div class="gray">
		<table class="tab1">
		<tr class="second"><td width="200"><strong>Tiêu đề</strong></td>
			<td>
			<input type="text" name="title" value="<?php if(isset($id)) { echo $item->meta_title; }; ?>" />
		</td></tr>
		<tr><td width="200">
			<strong>metadesc</strong></td>
			<td>
            <textarea name="metadesc" id="metadesc" rows="5" cols="40" ><?php if(isset($id)) { echo $item->meta_des; }; ?></textarea>
		      </td>
        </tr>
		<tr><td width="200">
			<strong>metakeywork</strong></td>
			<td>
			<textarea name="metakeywork" id="metakeywork" rows="5" cols="40" ><?php if(isset($id)) { echo $item->meta_key; }; ?></textarea>
		</td></tr>
		<tr>
			<td colspan="2"><strong>Nội dung</strong>
			​<textarea rows="5" cols="70" name="content" id="editor" /><?php if(isset($id)) {echo $item->content_thu;} ?></textarea></td>
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
