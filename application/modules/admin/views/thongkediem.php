<?php
$CI=&get_instance();

$CI->load->model('admin/admin_model');
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();
?>
<div class="form-search">
<form name="frmsearch" method="post" action="<?php echo site_url('admin/thongkediem'); ?>">
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


<input type="text" id="date" name="date" value="<?php if(!empty($_POST['date'])){ echo $_POST['date'];} ?>" placeholder="Từ ngày" style="width:100px;">
<input type="text" id="todate" name="todate" value="<?php if(!empty($_POST['todate'])){ echo $_POST['todate'];} ?>" placeholder="Đến ngày" style="width:100px;">

<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<br><br><br>
<hr />
<br />
<h4>Tổng điểm trên hệ thống: <b style="color:#ff0000"><?php echo number_format($query->tongdiem)." điểm" ?></b></h4>
<br />
<h4>Trong đó:</h4>
<br />
<h4>Điểm cộng hàng ngày: <b style="color:#ff0000"><?php echo number_format($query->diemfree)." điểm" ?></b></h4>
<br />
<h4>Điểm tiêu dùng(xem thông tin): <b style="color:#ff0000"><?php echo number_format($query->diemdung)." điểm" ?></b></h4>
<br />
<h4>Điểm đã mua(từ tiền): <b style="color:#ff0000"><?php echo number_format($query->diemmua)." điểm" ?></b></h4>
<div class="clr"></div>

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