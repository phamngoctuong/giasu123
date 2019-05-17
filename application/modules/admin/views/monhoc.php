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
<form name="frmsearch" method="post" action="<?php echo site_url('admin/monhoc'); ?>">
<input class="text-search" name="findkey" type="text" value="<?php if(isset($_SESSION['findkey'])){ echo $_SESSION['findkey'];} ?>" placeholder="Từ khóa tìm kiếm" />


<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_monhoc'); ?>">
<p class="sidebar"><a href="<?php echo site_url('admin/frmmonhoc'); ?>">Thêm mới</a> <input type="submit" name="submit" value="Xóa" /></p>
<table width="100%" style="display:block;">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>        
        <td>Tên môn học</td>
        <td>Ngày tạo</td>				
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
			<td><a href="<?php echo site_url('admin/edit_monhoc/'.$item->ID); ?>"><?php echo $item->SubjectName; ?></a></td>	
            <td><?php echo date("d/m/Y",strtotime($item->CreateDate)) ?></td>						
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