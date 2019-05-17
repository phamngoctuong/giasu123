<h3 class="header">Nội dung trang</h3>
<div class="content-inner">
	<form name="frmfooter" action="<?php echo site_url('admin/add_footer'); ?>" method="post" enctype="multipart/form-data">
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
		<tr>
			<td><strong>H1</strong></td>
			<td>
				<input type="text" name="name" value="<?php if(isset($id)){ echo $item->name;} ?>" />
			</td>
		</tr>			
		<tr class="second">
			<td><strong>Điện thoại</strong></td>
			<td>
				<input style="width:200px;" type="text" name="textlogo" value="<?php if(isset($id)){ echo $item->textlogo;} ?>" />
			</td>
		</tr>
		<tr>
			<td><strong>Địa chỉ</strong></td>
			<td>
				<input type="text" name="diachi" value="<?php if(isset($id)){ echo $item->diachi;} ?>" />
			</td>
		</tr>			
		<tr class="second">
			<td><strong>Email</strong></td>
			<td>
				<input style="width:200px;" type="text" name="email" value="<?php if(isset($id)){ echo $item->email;} ?>" />
			</td>
		</tr>		
		<tr>
			<td><strong>Facebook</strong></td>
			<td>
				<input type="text" name="face" value="<?php if(isset($id)){ echo $item->face;} ?>" />
			</td>
		</tr>		
		<tr class="second">
			<td><strong>Google</strong></td>
			<td>
				<input type="text" name="google" value="<?php if(isset($id)){ echo $item->google;} ?>" />
			</td>
		</tr>				
		<tr>
			<td width="150"><strong>SEO Title</strong></td>
			<td><input type="text" name="meta_title" value="<?php if(isset($id)) {echo htmlspecialchars($item->meta_title);} ?>" /></td>
		</tr>
		<tr class="second">
			<td><strong>SEO Key</strong></td>
			<td>
				<input type="text" name="meta_key" value="<?php if(isset($id)){ echo $item->meta_key;} ?>" />
			</td>
		</tr>
		<tr>
			<td><strong>SEO Des</strong></td>
			<td>
				​<textarea rows="3" cols="70" name="meta_des" /><?php if(isset($id)) {echo $item->meta_des;} ?></textarea>
			</td>
		</tr>		
		<tr class="second">
			<td><strong>Nội dung 5</strong></td>
			<td>
				​<textarea rows="5" cols="50" name="content" id="editor" /><?php if(isset($id)) {echo $item->content;} ?></textarea>
			</td>
		</tr>
		<tr class="second">
			<td><strong>Content SEO THU</strong></td>
			<td>
				​<textarea rows="5" cols="50" name="content_thu" id="editor2" /><?php if(isset($id)) {echo $item->content_thu;} ?></textarea>
			</td>
		</tr>			
		<tr>
			<td><strong>Menu chân trang</strong></td>
			<td>
				​<textarea rows="5" cols="50" name="meta_footer" id="editor1" /><?php if(isset($id)) {echo $item->meta_footer;} ?></textarea>
			</td>
		</tr>			
		<tr class="second">
			<td><strong>Map</strong></td>
			<td>
				<input style="width: 200px" type="text" name="map" value="<?php if(isset($id)){ echo $item->map;} ?>" />
			</td>
		</tr>
		<tr>
			<td><strong>Nội dung 6</strong></td>
			<td>
				​<textarea rows="7" cols="70" name="anatic" /><?php if(isset($id)) {echo $item->anatic;} ?></textarea>
			</td>
		</tr>
        <tr class="second">
			<td><strong>Nội dung 1</strong></td>
			<td>
				<textarea rows="7" cols="70" name="meta_titleestimate"> <?php if(isset($id)){ echo $item->meta_titleestimate;} ?> </textarea>
			</td>
		</tr>
        <tr>
			<td><strong>Nội dung 2</strong></td>
			<td>
				​<textarea rows="7" cols="70" name="meta_estimate" /><?php if(isset($id)) {echo $item->meta_estimate;} ?></textarea>
			</td>
		</tr>
        <tr>
			<td><strong>Nội dung 3</strong></td>
			<td>
				​<textarea rows="7" cols="70" name="meta_descestimate" ><?php if(isset($id)) {echo $item->meta_descestimate;} ?></textarea>
			</td>
		</tr>
        <tr>
            <td>
                <strong>Nội dung 4</strong>
            </td>
            <td>
                <textarea rows="7" cols="70" name="estimateh1"><?php if(isset($id)) {echo $item->estimateh1;} ?></textarea>
            </td>
        </tr>
		<tr><td width="200">
			<strong>Trạng thái</strong></td>
			<td>									
				<?php if(isset($id)){ ?>
					<input class="news_checkbox" type="checkbox" name="status" value="1" <?php if($item->status==1){echo 'checked';} ?> />Xuất bản
				<?php }else{ ?>
					<input class="news_checkbox" type="checkbox" name="status" value="1" checked="checked" />Xuất bản
				<?php } ?>
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
<script type="text/javascript"> 
	CKEDITOR.replace( 'editor', {
	toolbar: [				
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
		{ name: 'styles', items: [ 'Styles', 'Format', 'FontSize'] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor'] },
		//{ name: 'about', items: [ 'About' ] },
		'/',		
		{ name: 'insert', items: [ 'Link', 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
		{ name: 'tools', items: ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']},
		{ name: 'tools', items: [ 'Maximize' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
		{ name: 'others', items: [ '-' ] }
	]
});
		CKEDITOR.replace( 'editor1', {
	toolbar: [				
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
		{ name: 'styles', items: [ 'Styles', 'Format', 'FontSize'] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor'] },
		//{ name: 'about', items: [ 'About' ] },
		'/',		
		{ name: 'insert', items: [ 'Link', 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
		{ name: 'tools', items: ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']},
		{ name: 'tools', items: [ 'Maximize' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
		{ name: 'others', items: [ '-' ] }
	]
});
		CKEDITOR.replace( 'editor2', {
	toolbar: [				
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
		{ name: 'styles', items: [ 'Styles', 'Format', 'FontSize'] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor'] },
		//{ name: 'about', items: [ 'About' ] },
		'/',		
		{ name: 'insert', items: [ 'Link', 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
		{ name: 'tools', items: ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']},
		{ name: 'tools', items: [ 'Maximize' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
		{ name: 'others', items: [ '-' ] }
	]
});
		CKEDITOR.replace( 'editor3', {
	toolbar: [				
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
		{ name: 'styles', items: [ 'Styles', 'Format', 'FontSize'] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor'] },
		//{ name: 'about', items: [ 'About' ] },
		'/',		
		{ name: 'insert', items: [ 'Link', 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
		{ name: 'tools', items: ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']},
		{ name: 'tools', items: [ 'Maximize' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
		{ name: 'others', items: [ '-' ] }
	]
});
</script>