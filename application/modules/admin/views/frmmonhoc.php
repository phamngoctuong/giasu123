<?php
$CI=&get_instance();
$CI->load->model('admin/admin_model');
//$listdefault=$CI->admin_model->Getallsubjecttype();
// print($listdefault);
// print_r($lophoc);
?>
<h3 class="header">Thêm chuyên mục</h3>
<div class="content-inner1">
	<form name="frmdanhmuc" action="<?php echo site_url('admin/add_monhoc'); ?>" method="post" enctype="multipart/form-data">
		<?php
			if(isset($id))
			{
				$this->db->where('ID',$id);
				$item=$this->db->get('`subject`')->row();

			}
		?>
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />
		<div class="gray">
		<table class="tab1">
		<tr>
			<td width="150"><strong>Tên</strong></td>
			<td><input type="text" name="SubjectName" width="250" value="<?php if(isset($id)) {echo $item->SubjectName;} ?>" /></td>
		</tr>

		<tr class="second">
			<td><strong>Loại môn học</strong></td>
			<td>
                <select id="SubjectType" name="SubjectType">
                    <option value="">Chọn loại môn học</option>
                    <?php if(!empty($listdefault)){
                        foreach($listdefault as $i){
                            if($item->SubjectType == $i->ID && !empty($item)){
                    ?>
                        <option value="<?php echo $i->ID ?>" selected="selected"><?php echo $i->TypeName ?></option>
                    <?php }else{ ?>
                        <option value="<?php echo $i->ID ?>"><?php echo $i->TypeName ?></option>
                    <?php } ?>
                    <?php } } ?>
                </select>
			</td>


		</tr>
		</table>
		<div class="">
			<div style="Height:20px;line-height:20px;">
				<h4>Chọn lớp học hiển thị đi kèm:</h4>
			</div>

		  <div class="">
		    <?php
		      if(!empty($mess)) echo '<br><div class="col-sm-12" style="color:red">'.$mess.'</div><br>';
		     ?>
		  </div>
		  <table width="30%" style="display:block;">
		    <tr class="title">
		      <td width="5%" align="center">
		        <input type="checkbox" name="checkAll">
		      </td>
		      <td width="15%">tên lớp</td>
		    </tr>
		    <?php
		    $stt=1;
		    foreach ($lophoc as  &$valuelop) {
		      $idlophoc=$valuelop->id;
					$areaclass=explode(',',$item->areaclass);
		      ?>
		      <tr class="<?php echo $stt%2 ? 'odd' : 'even'; ?>">
		        <td align="center">
		          <input type="checkbox" name="lophoc[]" id="checkbox" value="<?php echo intval($idlophoc); ?>" <?php if(!empty($areaclass) && in_array($idlophoc,$areaclass)) {?> checked <?php };  ?>>
		        </td>
		        <td align="center"><?php echo $valuelop->name; ?></td>
		      </tr>
		      <?php $stt++; }   ?>
		  </table>

		</div>
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
$(document).ready(function(){
	jQuery("[name=checkAll]").click(function(source) {
	checkboxes = jQuery("[ id=checkbox ]");
	for(var i in checkboxes){
		 checkboxes[i].checked = source.target.checked;
	 }
	});
});
</script>
