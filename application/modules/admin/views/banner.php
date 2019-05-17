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
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_banner'); ?>">
<p class="sidebar"><a href="<?php echo site_url('admin/frmbanner'); ?>">Thêm mới</a> <input type="submit" name="submit" value="Xóa" /></p>
<table width="100%">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>        
        <td>Tên</td>        
        <td>Tên file</td>        
        <td width="25%">Link liên kết</td>
		<td width="10%">Vị trí</td>        
        <td width="8%">Trạng thái</td>
		<td width="5%" align="center">id</td>
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
    ?>
		<tr class="<?php echo $stt%2 ? 'odd' : 'even'; ?>">
			<td align="center">
				<div id="request-form">
					<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $item->id; ?>" />
				</div>
			</td>					
			<td><a href="<?php echo site_url('admin/edit_banner/'.$item->id); ?>"><?php echo $item->name; ?></a></td>									
			<td><img src="<?php echo 'upload/banner/'.$item->file; ?>" width="300"></td>							
			<td><?php echo $item->link; ?></td>
			<td align="center"><?php echo strtoupper($item->vitri); ?></td>			
			<td align="center">						
			  <?php 
			  if($item->status=='1')
			  {
			  ?>
			  <a class="status" onclick="check_status(<?php echo $item->id; ?>,'tbl_banner','banner')"><img src="images/toolbar/tick.png"></a>
			  <?php
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_status(<?php echo $item->id; ?>,'tbl_banner','banner')"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>			
			</td>       
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
<tr><td></td><tr>
<?php    
}
?>
</table>
</form>
<div class="clr"></div>
<div class="pagation">
	<?php echo $pagination; ?>
</div>
