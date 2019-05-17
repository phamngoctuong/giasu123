<?php

/**
 * @author lolkittens
 * @copyright 2018
 */



?>
<h3 class="header">Thêm doanh nghiệp</h3>
<div class="content-inner1">
	<form name="frmtintuc" action="<?php echo site_url('admin/add_ungvien'); ?>" method="post" enctype="multipart/form-data">
		<?php
			if(isset($id))
			{
				// $this->db->where('use_id',$id);
				// $item=$this->db->get('`user`')->row();
				$this->db->where('UserID',$id);
				$item=$this->db->get('`users`')->row();	
                //print_r($item);
				$id=$item->use_id;
                $this->db->where('cv_user_id',$id);
                $item1=$this->db->get('cv')->row();
			}
			?>
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />
		<div class="gray">
        <table width="100%">
            <tr>
                <td>
                    <table class="tab1">
                		<tr>
                			<td width="150"><strong>Tên Công ty</strong></td>
                			<td><input type="text" name="use_first_name" value="<?php if(isset($id)) {echo $item->use_first_name;} ?>" /></td>
                		</tr>
                        <tr>
                			<td width="150"><strong>Địa chỉ</strong></td>
                			<td><input type="text" name="use_address" value="<?php if(isset($id)) {echo $item->use_address;} ?>" /></td>
                		</tr>
                        <tr>
            			<td colspan="2"><strong>Kỹ năng</strong><br />
            			​	<textarea id="editor"  rows="7" cols="50" name="cv_kynang"><?php if(isset($id)) {echo $item1->cv_kynang;} ?></textarea>
            			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Mục tiêu nghề nghiệp</strong><br />
                			​	<textarea id="editor1"  rows="7" cols="50" name="cv_muctieu"><?php if(isset($id)) {echo $item1->cv_muctieu;} ?></textarea>
                			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Ngành nghề</strong><br />
                			​		<select name="category" id="category">
                            <?php $sql1=	$this->db->query("select c.cat_id,c.cat_name from category as c");
                            if($sql1->num_rows() >0)
                                {
                                    foreach($sql1->result() as $n)
                                    {
                                        if($item1->cv_cate_id== $n->cat_id){?>
                                            <option value="<?php echo $n->cat_id ?>" selected="selected"><?php echo $n->cat_name ?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $n->cat_id ?>"><?php echo $n->cat_name ?></option>
                                        <?php }
                                    }
                                    }
                             ?>
                            </select>
                			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Thành phố</strong><br />
                			​	<select name="city" id="city">
                                <?php $sql1=	$this->db->query("select c.cit_id,c.cit_name from city as c");
                                if($sql1->num_rows() >0)
                                    {
                                        foreach($sql1->result() as $n)
                                        {
                                            if($item1->cv_city_id== $n->cit_id){?>
                                                <option value="<?php echo $n->cit_id ?>" selected="selected"><?php echo $n->cit_name ?></option>
                                            <?php }else{ ?>
                                                <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                            <?php }
                                        }
                                        }
                                 ?>
                                </select>
                			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Cấp bậc</strong><br />
                			​		<select name="capbac" id="capbac">
                            <?php
                            $arrcapbac=['Không chọn','Mới tốt nghiệp','Thực tập sinh','Nhân viên','Trưởng phòng','Phó giám đốc','Giám đốc','Tổng giám đốc điều hành'];
                            for($i=0;$i<count($arrcapbac);$i++){
                                if($i== $item1->cv_capbac_id){ ?>
                                    <option value="<?php echo $i ?>" selected="selected"><?php echo $arrcapbac[$i] ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $i ?>"><?php echo $arrcapbac[$i] ?></option>
                                <?php }
                            }
                            ?>
                            </select>
                			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Kinh nghiệm</strong><br />
                			​		<select name="kinhnghiem" id="kinhnghiem">
                            <?php
                            $arrexp=['Chưa có kinh nghiệm','0 - 1 năm kinh nghiệm','1 - 2 năm kinh nghiệm','2 - 5 năm kinh nghiệm','5 - 10 năm kinh nghiệm','Hơn 10 năm kinh nghiệm'];
                            for($i=0;$i<count($arrexp);$i++){
                                if($i== $item1->cv_exp){ ?>
                                    <option value="<?php echo $i ?>" selected="selected"><?php echo $arrexp[$i] ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $i ?>"><?php echo $arrexp[$i] ?></option>
                                <?php }
                            }
                            ?>
                            </select>
                			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Hình thức làm việc</strong><br />
                			​		<select name="hinhthuc" id="hinhthuc">
                            <?php
                            $arrtypejob=['Chọn hình thức làm việc','Toàn thời gian cố định','Toàn thời gian tạm thời','Bán thời gian cố định','Bán thời gian tạm thời','Hợp đồng','Khác'];
                            for($i=0;$i<count($arrtypejob);$i++){
                                if($i== $item1->cv_loaihinh_id){ ?>
                                    <option value="<?php echo $i ?>" selected="selected"><?php echo $arrtypejob[$i] ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $i ?>"><?php echo $arrtypejob[$i] ?></option>
                                <?php }
                            }
                            ?>
                            </select>
                			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Học vấn</strong><br />
                			​		<select name="hocvan" id="hocvan">
                            <?php
                            $arrtypejob=['Không yêu cầu','Đại học','Cao đẳng','PTCS','Trung học','Chứng chỉ','Trung cấp','Cử nhân','Thạc sĩ','Thạc sĩ Nghệ thuật','Thạc sĩ Thương mại','Thạc sĩ Khoa học','Thạc sĩ Kiến trúc','Thạc sĩ QTKD','Thạc sĩ Kỹ thuật ứng dụng','Thạc sĩ Luật','Thạc sĩ Y học','Thạc sĩ Dược phẩm','Tiến sĩ','Khác'];
                            for($i=0;$i<count($arrtypejob);$i++){
                                if($i== $item1->cv_hocvan){ ?>
                                    <option value="<?php echo $i ?>" selected="selected"><?php echo $arrtypejob[$i] ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $i ?>"><?php echo $arrtypejob[$i] ?></option>
                                <?php }
                            }
                            ?>
                            </select>
                			</td>
                		</tr>
                  </table>
                </td>
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
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript">
jQuery(function($){

	$.datepicker.regional['vi'] = {

		closeText: 'Đóng',

		prevText: '&#x3c;Trước',

		nextText: 'Tiếp&#x3e;',

		currentText: 'Hôm nay',

		monthNames: ['Tháng Một', 'Tháng Hai', 'Tháng Ba', 'Tháng Tư', 'Tháng Năm', 'Tháng Sáu',

		'Tháng Bảy', 'Tháng Tám', 'Tháng Chín', 'Tháng Mười', 'Tháng Mười Một', 'Tháng Mười Hai'],

		monthNamesShort: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',

		'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],

		dayNames: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],

		dayNamesShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],

		dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],

		weekHeader: 'Tu',

		dateFormat: 'dd-mm-yy',

		firstDay: 0,

		isRTL: false,

		showMonthAfterYear: false,

		yearSuffix: ''};

	$.datepicker.setDefaults($.datepicker.regional['vi']);
});

</script>
<!-- Tích hợp jck soạn thảo-->
<script type="text/javascript">
	CKEDITOR.replace( 'editor', {
	toolbar: [
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
		{ name: 'styles', items: [ 'Styles', 'Format', 'FontSize'] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor'] },
		{ name: 'links', items: [ 'Link', 'Unlink'] },
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
		{ name: 'links', items: [ 'Link', 'Unlink'] },
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
