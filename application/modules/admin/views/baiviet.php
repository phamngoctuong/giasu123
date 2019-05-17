<?php 
$CI=&get_instance();

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
<form name="frmsearch" method="post" action="<?php echo site_url('admin/baiviet'); ?>">
<input class="text-search" name="txt_search" type="text" value="<?php if(isset($_SESSION['txt_search'])){ echo $_SESSION['txt_search'];} ?>" placeholder="Từ khóa tìm kiếm" />
<?php 
if(isset($_SESSION['search_cid'])){
	$CI->admin_model->selectCtrl($_SESSION['search_cid'],'cid', 'search_cid');
}
else{ $CI->admin_model->selectCtrl('','cid', 'search_cid'); }
$list_user=$this->db->get('tbl_admin')->result();
?>
<select name="search_user" style="width:125px;">
<option value="0">-- Người đăng --</option>
<?php foreach($list_user as $luser){?>
<option value="<?php echo $luser->id; ?>" <?php if(isset($_SESSION['search_user']) and $_SESSION['search_user']==$luser->id){ ?>selected="selected"<?php } ?>><?php echo $luser->fullname; ?></option>
<?php } ?>
</select>
<select name="search_status" style="width:110px;">
	<option value="-1">- Trạng thái -</option>
	<option value="1" <?php if(isset($_SESSION['search_status']) and $_SESSION['search_status']==1){ ?>selected="selected"<?php } ?>>Đã đăng</option>
	<option value="0" <?php if(isset($_SESSION['search_status']) and $_SESSION['search_status']==0){ ?>selected="selected"<?php } ?>>Chưa đăng</option>
</select>
<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_baiviet'); ?>">
<p class="sidebar"><a href="<?php echo site_url('admin/frmbaiviet'); ?>">Thêm mới</a> <input type="submit" name="submit" value="Xóa" /></p>
<table width="100%" style="display:block;">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>        
        <td>Tiêu đề</td>
		<td align="center" width="10%">Ngày đăng</td>		
		<td width="8%">Trạng thái</td>
        <td width="15%">Chuyên mục</td>        	               
		<td width="10%">Người đăng</td>					
		<td width="5%" align="center">id</td>
    </tr>
	<?php 
	if($query->num_rows() >0)
	{
	?>
    <?php 
        $stt=0;	
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$day = date('Y-m-d H:i:s');	
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
			<td><a href="<?php echo site_url('admin/edit_baiviet/'.$item->id.'-'.url_title($item->alias)); ?>"><?php echo $item->title; ?></a></td>			
			<td align="center"><?php 
			$ngays	=explode(' ',$item->created_day);
			$ngay=explode('-',$ngays[0]);
			$created_day=$ngay[2].'-'.$ngay[1].'-'.$ngay[0];			
			echo $created_day; ?></td>			
			<td align="center">						
			  <?php 
			  if($item->status=='1')
			  {					
			  if($day < $item->created_day){
			  ?>
			  <a class="status" onclick="check_status(<?php echo $item->id; ?>,'baiviet','baiviet')"><img src="images/toolbar/publish_y.png"></a>
			  <?php
			  }else{
			  ?>
			  <a class="status" onclick="check_status(<?php echo $item->id; ?>,'baiviet','baiviet')"><img src="images/toolbar/tick.png"></a>
			  <?php }
			  }
			  else
			  {
			  ?>
			  <a class="status" onclick="check_status(<?php echo $item->id; ?>,'baiviet','baiviet')"><img src="images/toolbar/publish_x.png"></a>
			  <?php
			  }
			  ?>
			</td>    			
			<td><?php 
					$cats=$CI->admin_model->gettbl('chuyenmuc',$item->cid);
					if($cats->num_rows()> 0){
					$cat= $cats->row();
						echo $cat->name;
					}
					else{
						echo '-';
					}
			?></td>
			<td align="center">
			<?php 										
				$users=$CI->admin_model->gettbl('tbl_admin',$item->uid);										
				if($users->num_rows()> 0){
				$user= $users->row();
					echo $user->fullname;
				}
				else{
					echo '';
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