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
<form name="frmsearch" method="post" action="<?php echo site_url('admin/lophoc'); ?>">
<input class="text-search" name="findkey" type="text" value="<?php if(isset($_SESSION['findkey'])){ echo $_SESSION['findkey'];} ?>" placeholder="Từ khóa tìm kiếm" />
<select id="category" name="category" class="city_ab" style="width:150px;">
                        <option data-tokens="" value="">Môn học</option> 
                                    <?php 
                                    if(!empty($monhoc)){
                                        foreach($monhoc as $n){
                                            if($n->ID== $idsub){
                                            ?>
                                            <option selected="selected" value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                        <?php } }
                                    }
                                ?>
                                                                                      
                     </select>
<select id="city" name="city" class="city_ab" style="width:150px;">                        
                        <option data-tokens="" value="">Tỉnh thành</option>
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
<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_lophoc'); ?>">
<p class="sidebar"><div style="height:30px">&nbsp;</div><!-- <input type="submit" name="submit" value="Xóa" />--></p>
<table width="100%" style="display:block;">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>        
        <td>Tên lớp</td>
        <td>SĐT</td>
		<td align="center" width="10%">Ngày tạo</td>
        <td width="8%">Môn học</td>
        <td width="8%">Số tiền</td>
        <td width="5%">Đã xác thực</td>
        <td>HOT</td>
        <td>Vip</td>	
        <td>Địa điểm</td>			
		<td width="5%" align="center">id</td>
        <td>Hình thức học</td>
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
				<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $item->ClassID; ?>" />
			</div>
			</td>					
			<td><a href="<?php echo site_url('admin/edit_lophoc/'.$item->ClassID); ?>"><?php echo $item->ClassTitle; ?></a></td>	
            <td><?php echo $item->Phone; ?></td>		
			<td align="center"><?php 
			//$ngays	=explode(' ',$item->created_day);
			//$ngay=explode('-',$ngays[0]);
			//$created_day=$ngay[2].'-'.$ngay[1].'-'.$ngay[0];			
			echo date('d/m/Y',strtotime($item->CreateDate)); ?></td>			
			<td align="center">						
			  <?php 
			  echo $item->SubjectName;
			  ?>
			</td>
            <td><?php echo number_format($item->Money); ?></td>
            <td align="center">						
			  <?php 
			  if($item->Active=='1')
			  {
			  ?>
			  
			  <a class="status" onclick="check_statusck('teacherclass','Active',0,'ClassID',<?php echo $item->ClassID; ?>)"><img src="images/toolbar/tick.png"></a>
			  <?php 
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_statusck('teacherclass','Active',1,'ClassID',<?php echo $item->ClassID; ?>)"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
			</td> 
            <td align="center">						
			  <?php 
			  if($item->Hot=='1')
			  {
			  ?>
			  
			  <a class="status" onclick="check_statusck('teacherclass','Hot',0,'ClassID',<?php echo $item->ClassID; ?>)"><img src="images/toolbar/tick.png"></a>
			  <?php 
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_statusck('teacherclass','Hot',1,'ClassID',<?php echo $item->ClassID; ?>)"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
			</td>
            <td align="center">						
			  <?php 
			  if($item->Vip=='1')
			  {
			  ?>
			  
			  <a class="status" onclick="check_statusck('teacherclass','Vip',0,'ClassID',<?php echo $item->ClassID; ?>)"><img src="images/toolbar/tick.png"></a>
			  <?php 
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_statusck('teacherclass','Vip',1,'ClassID',<?php echo $item->ClassID; ?>)"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
			</td> 		
			<td><?php 
				echo Getcitybyindex($item->City);
			?></td>
									
			<td align="center"><?php echo $item->UserID; ?></td>
            <td>
            <?php echo GetLearnType(intval($item->LearnType)) ?>
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
$('#category').val('<?php echo $_SESSION['category']; ?>');
$('#city').val('<?php echo $_SESSION['city']; ?>');
$('#findkey').val('<?php echo $_SESSION['findkey']; ?>');
var url='<?php echo base_url(); ?>'
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