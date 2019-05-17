<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

$CI=&get_instance();
//$CI->load->helper('locdau');
$CI->load->model('admin/admin_model');
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();

?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#frmxoaall').submit(function(){
			if(!$('#request-form input[type="checkbox"]').is(':checked')){
  				alert("Bạn phải chọn ít nhất 1 bản ghi.");
 			 return false;
			}
		});
	});

	function checkall(class_name,obj)
	{
		var items=document.getElementsByClassName(class_name);
		if(obj.checked == true)
		{
			for(i=0;i<items.length;i++)
				items[i].checked=true;
		}
		else
		{
			for(i=0;i<items.length;i++)
				items[i].checked=false;

		}
	}
</script>
<div class="form-search">
<form name="frmsearch" method="post" action="<?php echo site_url('admin/trangungvien'); ?>">
<input class="text-search" name="findkey" type="text" value="<?php if(isset($_SESSION['findkey'])){ echo $_SESSION['findkey'];} ?>" placeholder="Từ khóa tìm kiếm" />
<select id="city" name="city" class="city_ab" style="width:150px;">
                        <option data-tokens="0" value="0">Tỉnh thành</option>
                                                                        <option data-tokens="1" value="1">Hà Nội</option>
                                                                        <option data-tokens="45" value="45">Hồ Chí Minh</option>
                                                                        <option data-tokens="49" value="49">An Giang</option>
                                                                        <option data-tokens="47" value="47">Bà Rịa Vũng Tàu</option>
                                                                        <option data-tokens="3" value="3">Bắc Giang</option>
                                                                        <option data-tokens="4" value="4">Bắc Kạn</option>
                                                                        <option data-tokens="50" value="50">Bạc Liêu</option>
                                                                        <option data-tokens="5" value="5">Bắc Ninh</option>
                                                                        <option data-tokens="52" value="52">Bến Tre</option>
                                                                        <option data-tokens="46" value="46">Bình Dương</option>
                                                                        <option data-tokens="51" value="51">Bình Phước</option>
                                                                        <option data-tokens="31" value="31">Bình Thuận</option>
                                                                        <option data-tokens="30" value="30">Bình Định</option>
                                                                        <option data-tokens="53" value="53">Cà Mau</option>
                                                                        <option data-tokens="48" value="48">Cần Thơ</option>
                                                                        <option data-tokens="6" value="6">Cao Bằng</option>
                                                                        <option data-tokens="34" value="34">Gia Lai</option>
                                                                        <option data-tokens="10" value="10">Hà Giang</option>
                                                                        <option data-tokens="11" value="11">Hà Nam</option>
                                                                        <option data-tokens="35" value="35">Hà Tĩnh</option>
                                                                        <option data-tokens="9" value="9">Hải Dương</option>
                                                                        <option data-tokens="2" value="2">Hải Phòng</option>
                                                                        <option data-tokens="56" value="56">Hậu Giang</option>
                                                                        <option data-tokens="8" value="8">Hòa Bình</option>
                                                                        <option data-tokens="12" value="12">Hưng Yên</option>
                                                                        <option data-tokens="28" value="28">Khánh Hòa</option>
                                                                        <option data-tokens="57" value="57">Kiên Giang</option>
                                                                        <option data-tokens="36" value="36">Kon Tum</option>
                                                                        <option data-tokens="14" value="14">Lai Châu</option>
                                                                        <option data-tokens="29" value="29">Lâm Đồng</option>
                                                                        <option data-tokens="15" value="15">Lạng Sơn</option>
                                                                        <option data-tokens="13" value="13">Lào Cai</option>
                                                                        <option data-tokens="58" value="58">Long An</option>
                                                                        <option data-tokens="17" value="17">Nam Định</option>
                                                                        <option data-tokens="37" value="37">Nghệ An</option>
                                                                        <option data-tokens="16" value="16">Ninh Bình</option>
                                                                        <option data-tokens="38" value="38">Ninh Thuận</option>
                                                                        <option data-tokens="18" value="18">Phú Thọ</option>
                                                                        <option data-tokens="39" value="39">Phú Yên</option>
                                                                        <option data-tokens="40" value="40">Quảng Bình</option>
                                                                        <option data-tokens="41" value="41">Quảng Nam</option>
                                                                        <option data-tokens="42" value="42">Quảng Ngãi</option>
                                                                        <option data-tokens="19" value="19">Quảng Ninh</option>
                                                                        <option data-tokens="43" value="43">Quảng Trị</option>
                                                                        <option data-tokens="59" value="59">Sóc Trăng</option>
                                                                        <option data-tokens="20" value="20">Sơn La</option>
                                                                        <option data-tokens="61" value="61">Tây Ninh</option>
                                                                        <option data-tokens="21" value="21">Thái Bình</option>
                                                                        <option data-tokens="22" value="22">Thái Nguyên</option>
                                                                        <option data-tokens="44" value="44">Thanh Hóa</option>
                                                                        <option data-tokens="27" value="27">Thừa Thiên Huế</option>
                                                                        <option data-tokens="60" value="60">Tiền Giang</option>
                                                                        <option data-tokens="62" value="62">Trà Vinh</option>
                                                                        <option data-tokens="23" value="23">Tuyên Quang</option>
                                                                        <option data-tokens="63" value="63">Vĩnh Long</option>
                                                                        <option data-tokens="24" value="24">Vĩnh Phúc</option>
                                                                        <option data-tokens="25" value="25">Yên Bái</option>
                                                                        <option data-tokens="26" value="26">Đà Nẵng</option>
                                                                        <option data-tokens="32" value="32">Đắk Lắk</option>
                                                                        <option data-tokens="33" value="33">Đắk Nông</option>
                                                                        <option data-tokens="7" value="7">Điện Biên</option>
                                                                        <option data-tokens="55" value="55">Đồng Nai</option>
                                                                        <option data-tokens="54" value="54">Đồng Tháp</option>
                     </select>
										 <input type="text" id="date" name="date" value="<?php if(!empty($_POST['date'])){ echo $_POST['date'];} ?>" placeholder="Từ ngày" style="width:100px;">
										 <input type="text" id="todate" name="todate" value="<?php if(!empty($_POST['todate'])){ echo $_POST['todate'];} ?>" placeholder="Đến ngày" style="width:100px;">
<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_trangungvien'); ?>">
<p class="sidebar"> <input type="submit" name="submit" value="Xóa" /></p><!--href="<?php echo site_url('admin/frmvieclam'); ?>"-->
<table width="100%" style="display:block;">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>
        <td>Họ tên</td>
        <td width="10%">SDT Đăng ký</td>
        <td width="10%">Công việc mong muốn</td>
		    <td align="center" width="10%">Ngày đăng ký</td>
        <td width="10%">Mức lương</td>
        <td width="8%">Trạng thái</td>
        <td width="15%">Tỉnh Thànhc</td>
		<td width="5%" align="center">id</td>
    </tr>
	<?php
	if($query !='')
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
			<td align="center">
			<div id="request-form">
				<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $item->UserID; ?>" />
			</div>
			</td>
			<td><a ><?php echo $item->Name; ?></a></td>	<!--href="<?php echo site_url('admin/edit_vieclam/'.$item->UserID); ?>"-->
            <td><?php echo $item->UserName ?></td>
            <td><?php echo $item->cv_title?></td>
			<td align="center"><?php

			echo date('d/m/Y',strtotime($item->CreateDate)); ?></td>
      <td><?php echo GetLuong($item->cv_money_id)?></td>

			<td align="center">
			  <?php
			  if($item->IsSearch2=='1')
			  {

			  ?>
			  <!--<a class="status" onclick="check_status(<?php echo $item->UserID; ?>,'new','vieclam')"><img src="images/toolbar/publish_y.png"></a>-->
			  <?php
			  //}else{
			  ?>
			  <a class="status" onclick="check_statusck('users','IsSearch2',0,'UserID',<?php echo $item->UserID; ?>)"><img src="images/toolbar/tick.png"></a>
			  <?php
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_statusck('users','IsSearch2 ',1,'UserID',<?php echo $item->UserID; ?>)"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
			</td>
			<td><?php echo Getcitybyindex($item->cv_city_id);?></td>

			<td align="center"><?php echo $item->UserID; ?></td>
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

</form>
<div class="clr"></div>
<div class="pagation">
	<?php echo $pagination; ?>
</div>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript">

function check_statusck(tblname,field,status,fieldid,id)
{
	$.ajax({
		cache:false,
			type:"POST",
			url:"<?php echo site_url() ?>admin/statusck",
			data:{tblname : tblname, field : field,fieldvl:status,fieldid:fieldid,id:id},
			success:function(html){
				//window.location.href = ""+'/'+name;
				location.reload();
			}
	});
}
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
