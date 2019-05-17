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
<div class="form-search" style="position: relative !important;">
<form name="frmsearch" method="post" action="<?php echo site_url('admin/jobmanager'); ?>">
<input class="text-search" name="findkey" type="text" value="<?php if(isset($_SESSION['findkey'])){ echo $_SESSION['findkey'];} ?>" placeholder="Từ khóa tìm kiếm" />
<select id="category" name="category" class="city_ab" style="width:150px;">
                        <option data-tokens="0" value="0">Ngành nghề</option> 
                                    <option data-tokens="1" value="1">Kế toán - Kiểm toán</option> 
                                                                        <option data-tokens="2" value="2">Hành chính - Văn phòng</option> 
                                                                        <option data-tokens="3" value="3">Sinh viên làm thêm</option> 
                                                                        <option data-tokens="4" value="4">Xây dựng</option> 
                                                                        <option data-tokens="5" value="5">Điện - Điện tử</option> 
                                                                        <option data-tokens="6" value="6">Làm bán thời gian</option> 
                                                                        <option data-tokens="7" value="7">Vận tải - Lái xe</option> 
                                                                        <option data-tokens="8" value="8">Khách sạn - Nhà hàng</option> 
                                                                        <option data-tokens="9" value="9">Nhân viên kinh doanh</option> 
                                                                        <option data-tokens="10" value="10">Việc làm bán hàng</option> 
                                                                        <option data-tokens="11" value="11">Cơ khí - Chế tạo</option> 
                                                                        <option data-tokens="12" value="12">Lao động phổ thông</option> 
                                                                        <option data-tokens="13" value="13">IT phần mềm</option> 
                                                                        <option data-tokens="14" value="14">Marketing-PR</option> 
                                                                        <option data-tokens="17" value="17">Giáo dục-Đào tạo</option> 
                                                                        <option data-tokens="18" value="18">Kỹ thuật</option> 
                                                                        <option data-tokens="19" value="19">Y tế-Dược</option> 
                                                                        <option data-tokens="20" value="20">Quản trị kinh doanh</option> 
                                                                        <option data-tokens="21" value="21">Dịch vụ</option> 
                                                                        <option data-tokens="22" value="22">Biên-Phiên dịch</option> 
                                                                        <option data-tokens="23" value="23">Dệt may - Da giày</option> 
                                                                        <option data-tokens="24" value="24">Kiến trúc - Tk nội thất</option> 
                                                                        <option data-tokens="25" value="25">Xuất,nhập khẩu</option> 
                                                                        <option data-tokens="26" value="26">IT Phần cứng-mạng</option> 
                                                                        <option data-tokens="27" value="27">Nhân sự</option> 
                                                                        <option data-tokens="28" value="28">Thiết kế - Mỹ thuật</option> 
                                                                        <option data-tokens="29" value="29">Tư vấn</option> 
                                                                        <option data-tokens="30" value="30">Bảo vệ</option> 
                                                                        <option data-tokens="31" value="31">Ô tô - xe máy</option> 
                                                                        <option data-tokens="32" value="32">Thư ký-Trợ lý</option> 
                                                                        <option data-tokens="33" value="33">KD bất động sản</option> 
                                                                        <option data-tokens="34" value="34">Du lịch</option> 
                                                                        <option data-tokens="35" value="35">Báo chí-Truyền hình</option> 
                                                                        <option data-tokens="36" value="36">Thực phẩm-Đồ uống</option> 
                                                                        <option data-tokens="37" value="37">Ngành nghề khác</option> 
                                                                        <option data-tokens="38" value="38">Vật tư-Thiết bị</option> 
                                                                        <option data-tokens="39" value="39">Thiết kế web</option> 
                                                                        <option data-tokens="40" value="40">In ấn - Xuất bản</option> 
                                                                        <option data-tokens="41" value="41">Nông-Lâm-Ngư-Nghiệp</option> 
                                                                        <option data-tokens="42" value="42">Thương mại điện tử</option> 
                                                                        <option data-tokens="43" value="43">Nhập liệu</option> 
                                                                        <option data-tokens="44" value="44">Việc làm thêm tại nhà</option> 
                                                                        <option data-tokens="45" value="45">Chăm sóc khách hàng</option> 
                                                                        <option data-tokens="46" value="46">Sinh viên mới tốt nghiệp -
 Thực tập</option> 
                                                                        <option data-tokens="47" value="47">Kỹ thuật ứng dụng</option> 
                                                                        <option data-tokens="48" value="48">Bưu chính viễn thông</option> 
                                                                        <option data-tokens="49" value="49">Dầu khí -
 Địa chất</option> 
                                                                        <option data-tokens="50" value="50">Giao thông vận tải -
 Thủy lợi - Cầu đường</option> 
                                                                        <option data-tokens="51" value="51">Khu chế xuất - Khu công nghiệp</option> 
                                                                        <option data-tokens="52" value="52">Làm đẹp -
 Thể lực -
 Spa</option> 
                                                                        <option data-tokens="53" value="53">Luật - Pháp lý</option> 
                                                                        <option data-tokens="54" value="54">Môi trường - Xử lý chất thải</option> 
                                                                        <option data-tokens="55" value="55">Mỹ phẩm -
 Thời trang -
 Trang sức</option> 
                                                                        <option data-tokens="56" value="56">Ngân hàng - Chứng khoán - Đầu tư</option> 
                                                                        <option data-tokens="57" value="57">Nghệ thuật - Điện ảnh</option> 
                                                                        <option data-tokens="58" value="58">Phát triển thị trường</option> 
                                                                        <option data-tokens="59" value="59">Phục vụ -
 Tạp vụ -
 Giúp việc</option> 
                                                                        <option data-tokens="60" value="60">Quan hệ đối ngoại</option> 
                                                                        <option data-tokens="61" value="61">Quản lý điều hành</option> 
                                                                        <option data-tokens="62" value="62">Sản xuất -
 Vận hành sản xuất</option> 
                                                                        <option data-tokens="63" value="63">Thẩm định - Giám thẩm định - Quản lý chất lượng</option> 
                                                                        <option data-tokens="64" value="64">Thể dục -
 Thể thao</option> 
                                                                        <option data-tokens="65" value="65">Hóa học -
 Sinh học</option> 
                                                                        <option data-tokens="66" value="66">Bảo hiểm</option> 
                                                                        <option data-tokens="67" value="67">Freelancer</option> 
                                                                        <option data-tokens="68" value="68">Công chức - Viên chức </option>              
                     </select>
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
<select name="hot" style="width:125px;">
<option value="0">-- Chọn --</option>
<option value="1" <?php if(isset($_SESSION['tinhot']) and $_SESSION['tinhot']==1){ ?>selected="selected"<?php } ?>>Hot</option>

</select>
<select name="do" style="width:110px;">
	<option value="0">- Chọn -</option>
	<option value="1" <?php if(isset($_SESSION['tindo']) and $_SESSION['tindo']==1){ ?>selected="selected"<?php } ?>>Tin đỏ</option>
</select>
<select name="gap" style="width:110px;">
	<option value="0">- Chọn -</option>
	<option value="1" <?php if(isset($_SESSION['tingap']) and $_SESSION['tingap']==1){ ?>selected="selected"<?php } ?>>Tuyển gấp</option>
</select>
<select name="cao" style="width:110px;">
	<option value="0">- Chọn -</option>
	<option value="1" <?php if(isset($_SESSION['tincao']) and $_SESSION['tincao']==1){ ?>selected="selected"<?php } ?>>Ưu tiên cao</option>
</select>
<select name="parttime" style="width: 110px;">
<option value="">Chon ca</option>
    <option value="2" <?php if(isset($_SESSION['parttime']) and $_SESSION['parttime']==2){ ?>selected="selected"<?php } ?>>Ca sáng</option>
    <option value="3" <?php if(isset($_SESSION['parttime']) and $_SESSION['parttime']==3){ ?>selected="selected"<?php } ?>>Ca chiều</option>
    <option value="4" <?php if(isset($_SESSION['parttime']) and $_SESSION['parttime']==4){ ?>selected="selected"<?php } ?>>Không xác đinh</option>
    <option value="1" <?php if(isset($_SESSION['parttime']) and $_SESSION['parttime']==1){ ?>selected="selected"<?php } ?>>Fulltime</option>
</select>
<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_jobmanager'); ?>">
<p class="sidebar"><!--<a href="<?php echo site_url('admin/frmjobmanager'); ?>">Thêm mới</a>--> <input type="submit" name="submit" value="Xóa" /></p>
<table width="100%" style="display:block;">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>        
        <td>Tiêu đề</td>
		<td align="center" width="10%">Ngày đăng</td>
        <td width="8%">Trạng thái</td>
        <td width="8%">Tin hot</td>
        <td width="8%">Gấp</td>
        <td width="8%">Ưu tiên(cao)</td>
        <td width="15%">Chuyên mục</td>				
		<td width="5%" align="center">id</td>
        <td>Parttime</td>
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
				<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $item->new_id; ?>" />
			</div>
			</td>					
			<td><a href="<?php echo site_url('admin/edit_jobmanager/'.$item->new_id); ?>"><?php echo $item->new_title; ?></a></td>			
			<td align="center"><?php 
			//$ngays	=explode(' ',$item->created_day);
			//$ngay=explode('-',$ngays[0]);
			//$created_day=$ngay[2].'-'.$ngay[1].'-'.$ngay[0];			
			echo date('d/m/Y',$item->new_create_time); ?></td>			
			<td align="center">						
			  <?php 
			  if($item->new_active=='1')
			  {					
			  //if(time() > $item->new_create_time){
			  ?>
			  <!--<a class="status" onclick="check_status(<?php echo $item->new_id; ?>,'new','vieclam')"><img src="images/toolbar/publish_y.png"></a>-->
			  <?php
			  //}else{
			  ?>
			  <a class="status" onclick="check_statusck('new','new_active',0,'new_id',<?php echo $item->new_id; ?>)"><img src="images/toolbar/tick.png"></a>
			  <?php //}
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_statusck('new','new_active',1,'new_id',<?php echo $item->new_id; ?>)"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
			</td> 
              
            <td align="center">						
			  <?php 
			  if($item->new_hot=='1')
			  {
			  ?>
			  
			  <a class="status" onclick="check_statusck('new','new_hot',0,'new_id',<?php echo $item->new_id; ?>)"><img src="images/toolbar/tick.png"></a>
			  <?php 
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_statusck('new','new_hot',1,'new_id',<?php echo $item->new_id; ?>)"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
			</td> 
            <td align="center">						
			  <?php 
			  if($item->new_gap=='1')
			  {
			  ?>
			  
			  <a class="status" onclick="check_statusck('new','new_gap',0,'new_id',<?php echo $item->new_id; ?>)"><img src="images/toolbar/tick.png"></a>
			  <?php 
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_statusck('new','new_gap',1,'new_id',<?php echo $item->new_id; ?>)"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
			</td> 
            <td align="center">						
			  <?php 
			  if($item->new_cao=='1')
			  {
			  ?>
			  
			  <a class="status" onclick="check_statusck('new','new_cao',0,'new_id',<?php echo $item->new_id; ?>)"><img src="images/toolbar/tick.png"></a>
			  <?php 
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_statusck('new','new_cao',1,'new_id',<?php echo $item->new_id; ?>)"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
			</td> 			
			<td><?php 
					$arrtg=explode(',',$item->new_cat_id) ;
                    for($i=0;$i<count($arrtg);$i++){
                        echo '<span>'.GetCategory($arrtg[$i]).'</span>';
                    }
			?></td>
									
			<td align="center"><?php echo $item->new_id; ?></td>
            <td align="center">						
			  <?php 
			  if(intval($item->type)==1)
			  {
			  ?>
			  
			  <a class="status" onclick="check_statusck('new','`type`',0,'new_id',<?php echo $item->new_id; ?>)"><img src="images/toolbar/tick.png"></a>
			  <?php 
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_statusck('new','`type`',1,'new_id',<?php echo $item->new_id; ?>)"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
			</td> 
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
<script type="text/javascript">
$('#category').val(<?php echo $_SESSION['category']; ?>);
$('#city').val(<?php echo $_SESSION['city']; ?>);
var url='<?php echo site_url(); ?>';
function check_statusck(tblname,field,status,fieldid,id)
{
	$.ajax({
		cache:false,
			type:"POST",  
			url:url+"admin/statusck", 
			data:{tblname : tblname, field : field,fieldvl:status,fieldid:fieldid,id:id},
			success:function(html){				
				//window.location.href = ""+'/'+name;
				location.reload();
			}                                                          
	});  
}
</script>