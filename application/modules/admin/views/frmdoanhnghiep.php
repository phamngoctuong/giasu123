<?php

/**
 * @author lolkittens
 * @copyright 2018
 */



?>
<h3 class="header">Thêm doanh nghiệp</h3>
<div class="content-inner1">
	<form name="frmtintuc" action="<?php echo site_url('admin/add_doanhnghiep'); ?>" method="post" enctype="multipart/form-data">
		<?php
			if(isset($id))
			{
				$this->db->where('usc_id',$id);
				$item=$this->db->get('user_company')->row();
				$id=$item->usc_id;
                $this->db->where('usc_id',$id);
                $item1=$this->db->get('user_company_multi')->row();
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
                			<td><input type="text" name="usc_company" value="<?php if(isset($id)) {echo htmlspecialchars($item->usc_company);} ?>" /></td>
                		</tr>
                        <tr>
            			<td colspan="2"><strong>Giới thiệu Công ty</strong><br />
            			​	<textarea id="editor"  rows="7" cols="50" name="usc_company_info"><?php if(isset($id)) {echo $item1->usc_company_info;} ?></textarea>
            			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Địa chỉ</strong><br />
                			​	<input type="text" name="usc_address" value="<?php if(isset($id)) {echo $item->usc_address;} ?>" />
                			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Số điện thoại</strong><br />
                			​		<input type="text" name="usc_phone" value="<?php if(isset($id)) {echo $item->usc_phone;} ?>" />
                			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Website</strong><br />
                			​		<input type="text" name="usc_website" value="<?php if(isset($id)) {echo $item->usc_website;} ?>" />
                			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>mã số thuế</strong><br />
                			​		<input type="text" name="usc_mst" value="<?php if(isset($id)) {echo $item->usc_mst;} ?>" />
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
<script type="text/javascript" src="javascript/formCKEDITOR.js">

</script>
