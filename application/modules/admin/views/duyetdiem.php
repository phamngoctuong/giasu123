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
<form name="frmsearch" method="post" action="<?php echo site_url('admin/duyetdiem'); ?>">
<input class="text-search" name="findkey" type="text" value="<?php if(isset($_SESSION['findkey'])){ echo $_SESSION['findkey'];} ?>" placeholder="Từ khóa tìm kiếm" />


<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/duyetdiem'); ?>">
<p class="sidebar"><div style="height:30px;">&nbsp;</div></p>
<table width="100%" style="display:block;">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>        
        <td width="10%">Tài khoản</td>
        <td width="10%">Username</td>
        <td width="10%">Ngày mua</td>
        <td width="10%">Số tiền</td>
        <td width="20%">Số điểm</td>
        <td>
            Duyệt
        </td>
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
    				<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $item->ID; ?>" />
    			</div>
			</td>					
			<td ><a><?php echo $item->UserID; ?></a></td>	
            <td><?php echo $item->UserName ?></td>
            <td><?php echo date("d/m/Y",strtotime($item->CreateDate)) ?></td>	
            <td><?php echo number_format($item->Money)  ?></td>
            <td>
                <?php echo $item->BuyPoint ?>
            </td>
            <td>
            <?php 
			  if($item->Status=='1')
			  {
			  ?>			  
			  <a class="status"><img src="images/toolbar/tick.png"></a>
			  <?php 
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="checkduyetdiem(<?php echo $item->ID; ?>,<?php echo $item->UserID; ?>)"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
            </td>					
			<td align="center"><?php echo $item->ID; ?></td>            
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

$('#findkey').val('<?php echo $_SESSION['findkey']; ?>');
var url='<?php echo base_url(); ?>';
function checkduyetdiem(id,userid)
{
    if (confirm('Bạn muốn duyệt số tiền cho khách hàng?')) {
        $.ajax({
		cache:false,
			type:"POST",  
			url:url+"admin/duyetcongdiem", 
			data:{id : id, userid : userid},
			success:function(html){				
				window.location.href = ""+'/'+name;
				location.reload();
			}                                                          
	});
        }
	  
}
</script>