<?php

/**
 * @author lolkittens
 * @copyright 2018
 */



?>
<h3 class="header">Thêm doanh nghiệp</h3>
<div class="content-inner1">
	<form name="frmtintuc" action="<?php echo site_url('admin/add_lophoc'); ?>" method="post" enctype="multipart/form-data">		 
		<?php 
			if(isset($id))
			{
				$this->db->where('ClassID',$id);
				$item=$this->db->get('`teacherclass`')->row();	
                //print_r($item);			
				$id=$item->ClassID;  
                $this->db->where('ClassID',$id);  
                $item1=$this->db->get('teacherclassmeta')->row();	        
			}
			?>  
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />		
		<div class="gray">
        <table width="100%">
            <tr>
                <td>
                    <table class="tab1">
                		<tr>
                			<td width="150"><strong>Tên lớp học</strong></td>
                			<td><input type="text" name="ClassTitle" value="<?php if(isset($id)) {echo $item->ClassTitle;} ?>" /></td>
                		</tr>
                        <tr>
                			<td width="150"><strong>Địa chỉ</strong></td>
                			<td><input type="text" name="Address" value="<?php if(isset($id)) {echo $item->Address;} ?>" /></td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Meta desc</strong><br />
                			​	<textarea id="MetaDesc"  rows="7" cols="50" name="MetaDesc"><?php if(isset($id)) {echo $item1->MetaDesc;} ?></textarea>
                			</td>
                		</tr>
                        <tr>
                			<td colspan="2"><strong>Meta Title</strong><br />
                			​	<textarea id="MetaTitle"  rows="7" cols="50" name="MetaTitle"><?php if(isset($id)) {echo $item1->MetaTitle;} ?></textarea>
                			</td>
                		</tr> 
                        <tr>
                			<td colspan="2"><strong>Meta Title</strong><br />
                			​	<textarea id="MetaKeywork"  rows="7" cols="50" name="MetaKeywork"><?php if(isset($id)) {echo $item1->MetaKeywork;} ?></textarea>
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

	
</script>