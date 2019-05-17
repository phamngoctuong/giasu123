<?php
$CI=&get_instance();

$CI->load->model('admin/admin_model');
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();
?>
<div class="form-search">
<form name="frmsearch" method="post" action="<?php echo site_url('admin/managecodeSMS'); ?>">
<input style="width:100px" class="text-search" name="txt_search" type="text" value="<?php if(!empty($_POST['txt_search'])){ echo $_POST['txt_search'];} ?>" placeholder="nhập mã code" />
<?php
$loaima=array(
  '1'=>'Kích hoạt tài khoản',
  '2'=>'Lấy lại mật khẩu'
);
$status=array(
  '0'=>'Thành công',
  '-4'=>'ip bị chặn',
  '1'=>'Mã gửi theo cuộc gọi',
);

 ?>
<select name="typecode" style="width:130px;">
	<option value="">- Chọn loại mã  -</option>
    <?php foreach($loaima as $keycode => $valuecode){ ?>
    <option value="<?php echo intval($keycode) ?>" <?php if(!empty($_POST['typecode']) and $_POST['typecode']==intval($keycode)){ ?>selected="selected"<?php } ?>><?php echo $valuecode ?></option>
    <?php } ?>

</select>
<select  name="status" style="width:150px;">
<option value="">- Loại trạng thái -</option>
<?php foreach($status as $keystatus=> $valuecode){ ?>
    <option value="<?php echo intval($keystatus) ?>" <?php if(!empty($_POST['status']) and $_POST['status']==intval($keystatus)){ ?>selected="selected"<?php } ?>><?php echo $valuecode ?></option>
    <?php } ?>
</select>
<input type="text" id="date" name="date" value="<?php if(!empty($_POST['date'])){ echo $_POST['date'];} ?>" placeholder="Từ ngày" style="width:100px;">
<input type="text" id="todate" name="todate" value="<?php if(!empty($_POST['todate'])){ echo $_POST['todate'];} ?>" placeholder="Đến ngày" style="width:100px;">
<select name="iscall" id="iscall">
    <option value="">Chọn hình thức gửi</option>
    <option value="0" <?php if($_POST['iscall'] !='' and $_POST['iscall']=="0"){ ?>selected="selected"<?php } ?>>Tin nhắn</option>
    <option value="1" <?php if(!empty($_POST['iscall']) and $_POST['iscall']=="1"){ ?>selected="selected"<?php } ?>>Cuộc gọi</option>
</select>
<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<br><br><br>
<table width="100%" style="display:block;">
    <tr class="title">
        <td width="5%" align="center">STT</td>
        <td width="20%">mã code</td>
		<td>Loại mã</td>
        <td>Trạng thái</td>
		<td width="10%">Thời gian</td>
		<td width="5%" align="center">id</td>
    </tr>
	<?php
	if(!empty($query))
	{
	?>
    <?php
        $stt=0;
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$day = date('Y-m-d H:i:s');
		foreach($query as $item)
        {
		$stt++;
    ?>
		<tr class="<?php echo $stt%2 ? 'odd' : 'even'; ?>">
			<td align="center"><?php echo $stt; ?></td>
			<td align="center"><?php echo $item->Code ?></td>
			<td align="center"><?php echo $loaima[$item->Type] ?></td>
      <td align="center"><?php echo @$status[$item->Statuscode] ?></td>
			<td align="center"><?php echo $item->CreateDate ?></td>
			<td align="center"><?php echo $item->id; ?></td>
		</tr>
    <?php
    }
    ?>
	<?php
	}
	else
	{
	?>
	<tr><td colspan="8">Dữ liệu đang cập nhật</td></tr>
	<?php
	}
	?>
</table>
<div class="clr"></div>
<div class="pagation">
	<?php echo $pagination; ?>
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
$(function() {
	$( "#date" ).datepicker();
    $( "#todate" ).datepicker();
	$.datepicker.setDefaults($.datepicker.regional['vi']);
    
});
</script>