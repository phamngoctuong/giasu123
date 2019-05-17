<?php 
$CI=&get_instance();
$CI->load->model('admin/admin_model');
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
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_admin'); ?>">
<p class="sidebar"><a href="<?php echo site_url('admin/frmadmin'); ?>">Thêm mới</a> <input type="submit" name="submit" value="Xóa" /></p>
<table width="100%">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>        
        <td>Tài khoản</td>
        <td width="10%">Mật khẩu</td>
		<td width="15%">Tên đăng nhập</td>    
		<td width="10%">Quyền</td>
        <td width="10%">Trạng thái</td>
		<td width="8%" align="center">id</td>
    </tr>
<?php 
    if($query->num_rows() >0)
    {
?>
    <?php 
        $stt=0;
		foreach($query->result() as $item)
        {
		$stt++;
		$role=$CI->admin_model->gettbl('tblrole',$item->role)->row();	
    ?>
		<tr class="<?php echo $stt%2 ? 'odd' : 'even'; ?>">
			<td align="center">
			<div id="request-form">
				<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $item->id; ?>" />
			</div>
			</td>					
			<td><a href="<?php echo site_url('admin/edit_admin/'.$item->id); ?>"><?php echo $item->fullname; ?></a></td>			
			<td><?php echo $item->pass; ?></td>
			<td><?php echo $item->name; ?></td>			
			<td align="center"><?php echo $role->name; ?></td>
			<td align="center">						
			  <?php 
			  if($item->status=='1')
			  {
			  ?>
			  <a class="status" onclick="check_status(<?php echo $item->id; ?>,'tbl_admin','tbladmin')"><img src="images/toolbar/tick.png"></a>
			  <?php
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_status(<?php echo $item->id; ?>,'tbl_admin','tbladmin')"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>			
			</td>          
			<td align="center"><?php echo $item->id; ?></td>
		</tr>
    <?php 
    }
}
else
{
?>
<tr>
	<td></td>						
	<td></td>						
	<td></td>						
	<td></td>						
	<td></td>						
	<td></td>						
	<td></td>						
	<td></td>						
</tr>
<?php    
}
?>
</table>
</form>
<div class="clr"></div>
<div class="pagation">
	<?php echo $pagination; ?>
</div>
