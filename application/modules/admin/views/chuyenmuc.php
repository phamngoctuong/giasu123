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

<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_chuyenmuc'); ?>">
<p class="sidebar"><a href="<?php echo site_url('admin/frmchuyenmuc'); ?>">Thêm mới</a> <input type="submit" name="submit" value="Xóa" /></p>
<table width="100%">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>        
        <td>Tên</td>
        <td>Đường dẫn</td>
		<td>Chuyên mục cha</td>
        <td width="10%">Menu</td>        
        <td width="8%">Thứ tự</td>                       
        <td width="8%">Trạng thái</td>
		<td width="5%" align="center">id</td>
    </tr>
<?php 
    if($query->num_rows()>0)
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
			<td><a href="<?php echo site_url('admin/edit_chuyenmuc/'.$item->id); ?>"><?php echo $item->name; ?></a></td>			
			<td><?php echo $item->alias; ?></td>
			<td>
			<?php 
				if($item->parent!=0)
				{
					$this->db->where('id',$item->parent);
					$chuyenmuc=$this->db->get('chuyenmuc')->row();					
					echo $chuyenmuc->name;            
				}
				else{
					echo '-';
				}
			?>  
			</td>
			<td align="center"><?php echo $item->menu!=0?'Có':'Không'; ?></td>			
			<td align="center"><?php echo $item->sort; ?></td>			
			<td align="center">						
			  <?php 
			  if($item->status=='1')
			  {
			  ?>
			  <a class="status" onclick="check_status(<?php echo $item->id; ?>,'chuyenmuc','chuyenmuc')"><img src="images/toolbar/tick.png"></a>
			  <?php
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_status(<?php echo $item->id; ?>,'chuyenmuc','chuyenmuc')"><img src="images/toolbar/publish_x.png"></a>
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
<tr><td colspan="6"></td></tr>
<?php    
}
?>
</table>
</form>
<div class="clr"></div>
<div class="pagation">
	<?php echo $pagination; ?>
</div>
