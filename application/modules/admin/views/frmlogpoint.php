<h3 class="header">Cấu hình điểm cộng</h3>
<div class="content-inner">
	<form name="frmslider" action="<?php echo site_url('admin/addlogpoint'); ?>" method="post" enctype="multipart/form-data">
		<?php 
			if(isset($id))
			{
				$this->db->where('ID',$id);			          
				$item=$this->db->get('configpoint')->row();				
				$id=$item->ID;            
			}
		?>     
		<input type="hidden" name="ID" value="<?php if(isset($id)) { echo $id; }; ?>" />	
		<div class="gray">
		<table class="tab1">		
		<tr class="second"><td width="200"><strong>Điểm cộng/ ngày</strong></td>
			<td>
			<input type="text" name="PointPerDay" value="<?php if(isset($id)) { echo $item->PointPerDay; }; ?>" />
		</td></tr>				
		<tr><td width="200">
			<strong>Điểm trừ xem</strong></td>
			<td>
            <input type="text" name="PointSub" value="<?php if(isset($id)) { echo $item->PointSub; }; ?>" />
            </td>
        </tr>
		<tr><td width="200">
			<strong>Điểm cộng</strong></td>
			<td>
            <input type="text" name="PointPlus" value="<?php if(isset($id)) { echo $item->PointPlus; }; ?>" />
            </td>
        </tr>
		<tr><td width="200">
			<strong>Mua 1 điểm</strong></td>
			<td>
            <input type="text" name="MoneyPerPoint" value="<?php if(isset($id)) { echo $item->MoneyPerPoint; }; ?>" />
            </td>
        </tr>
		
		
		</table>
		</div>
		<div class="gray">
		<center>
		<?php 
			if(isset($id))
			{
			?>			
				<input class="button" type="submit" name="submit" value="Lưu thay đổi" />						
			<?php    
			}
			else
			{
			?>			
				<input class="button" type="submit" name="submit" value="Nhập tin" />					
			<?php 
			}
		?>
		</center>
		</div>
	</form>
	<div class="clr"></div>
</div>