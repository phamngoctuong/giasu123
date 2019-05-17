<?php
$CI=&get_instance();
$CI->load->model('admin/admin_model');
$this->db->select('id');
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();
$lstcity=$CI->admin_model->getlistcity();
$lstsub=$CI->admin_model->getlistsubject();
?>

<h3 class="header">Thêm bài viết</h3>
<div class="content-inner1">
	<form name="frmtintuc" action="<?php echo site_url('admin/add_linkseo'); ?>" method="post" enctype="multipart/form-data">
		<?php
			if(isset($id))
			{
				$this->db->where('id',$id);
				$item=$this->db->get('linkseo')->row();
				$id=$item->id;
			}
			?>
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />

		<div class="gray">
		<table width="100%"><tr><td>
		<table class="tab1">
		<tr>
			<td width="150"><strong>Tiêu đề</strong></td>
			<td><input type="text" name="title" value="<?php if(isset($id)) {echo htmlspecialchars($item->title);} ?>" /></td>
		</tr>
		<tr>
			<td><strong>Môn học</strong></td>
			<td>
                <select name="subjectid" style="width:110px;">
                <option value="0" <?php if($item->subjectid ==0){ ?> selected="selected" <?php } ?>>Không chọn</option>
                <?php foreach($lstsub as $item1){ ?>
                <option value="<?php echo $item1->ID ?>" <?php if($item->subjectid==$item1->ID){ ?>selected="selected"<?php } ?>><?php echo $item1->SubjectName ?></option>
                <?php } ?>
                </select>
            </td>
		</tr>
        <tr>
			<td><strong>Tỉnh thành</strong></td>
			<td>
                <select name="cityid" style="width:110px;">
                <option value="0" <?php if($item->subjectid ==0){ ?> selected="selected" <?php } ?>>Không chọn</option>
                <?php foreach($lstcity as $item2){ ?>
                <option value="<?php echo $item2->cit_id ?>" <?php if($item->cityid==$item2->cit_id){ ?>selected="selected"<?php } ?>><?php echo $item2->cit_name ?></option>
                <?php } ?>
                </select>
            </td>
		</tr>
        <tr>
            <td><strong>Lớp học</strong></td>
            <td>
                <select id="lophoc" name="lophoc" class="form-control">
                                            <option value="0">Chọn lớp</option>
                                                                                              <option value="1" <?php if($item->lophoc==1){ ?>selected="selected"<?php } ?>>lớp 1</option>
                                                                                    <option value="2" <?php if($item->lophoc==2){ ?>selected="selected"<?php } ?>>lớp 2</option>
                                                                                    <option value="3" <?php if($item->lophoc==3){ ?>selected="selected"<?php } ?>>lớp 3</option>
                                                                                    <option value="4" <?php if($item->lophoc==4){ ?>selected="selected"<?php } ?>>lớp 4</option>
                                                                                    <option value="5" <?php if($item->lophoc==5){ ?>selected="selected"<?php } ?>>lớp 5</option>
                                                                                    <option value="6" <?php if($item->lophoc==6){ ?>selected="selected"<?php } ?>>lớp 6</option>
                                                                                    <option value="7" <?php if($item->lophoc==7){ ?>selected="selected"<?php } ?>>lớp 7</option>
                                                                                    <option value="8" <?php if($item->lophoc==8){ ?>selected="selected"<?php } ?>>lớp 8</option>
                                                                                    <option value="9" <?php if($item->lophoc==9){ ?>selected="selected"<?php } ?>>lớp 9</option>
                                                                                    <option value="10" <?php if($item->lophoc==10){ ?>selected="selected"<?php } ?>>lớp 10</option>
                                                                                    <option value="11" <?php if($item->lophoc==11){ ?>selected="selected"<?php } ?>>lớp 11</option>
                                                                                    <option value="12" <?php if($item->lophoc==12){ ?>selected="selected"<?php } ?>>lớp 12</option>
                                                                                    <option value="13" <?php if($item->lophoc==13){ ?>selected="selected"<?php } ?>>Ôn thi đại học</option>
</select>
            </td>
        </tr>
		<tr>
			<td><strong>Loại bài</strong></td>
			<td>
                <select name="type" style="width:110px;">
                <option value="1" <?php if($item->type==1){ ?>selected="selected"<?php } ?>>Lớp học</option>

                <option value="2" <?php if($item->type==2){ ?>selected="selected"<?php } ?>>Gia sư</option>

                </select>
            </td>
		</tr>
		</table>
		</td>

		</tr>
		<tr><td colspan="2">
			<strong>Nội dung</strong>
			​<textarea rows="5" cols="70" name="htmltext" id="editor" /><?php if(isset($id)) {echo $item->htmltext;} ?></textarea>
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
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>

<!-- Tích hợp jck soạn thảo-->
<script type="text/javascript" src="javascript/formCKEDITOR.js">

</script>
