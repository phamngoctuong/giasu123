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
<form name="frmsearch" method="post" action="<?php echo site_url('admin/linkseo'); ?>">
<input class="text-search" name="txt_search" type="text" value="<?php if(isset($_SESSION['txt_search'])){ echo $_SESSION['txt_search'];} ?>" placeholder="Từ khóa tìm kiếm" />
<?php
$lstcity=$CI->admin_model->getlistcity();
$lstsub=$CI->admin_model->getlistsubject();
 ?>
<select name="citylinkseo" style="width:110px;">
	<option value="">- Tỉnh thành -</option>
    <option value="0">Không chọn</option>
    <?php foreach($lstcity as $item){ ?>
    <option value="<?php echo $item->cit_id ?>" <?php if(isset($_SESSION['citylinkseo']) and $_SESSION['citylinkseo']==$item->cit_id){ ?>selected="selected"<?php } ?>><?php echo $item->cit_name ?></option>
    <?php } ?>
	
</select>
<select  name="subjectseo" style="width:110px;">
<option value="">- Môn học -</option>
<option value="0">Không chọn</option>
<?php foreach($lstsub as $item){ ?>
    <option value="<?php echo $item->ID ?>" <?php if(isset($_SESSION['subjectseo']) and $_SESSION['subjectseo']==$item->ID){ ?>selected="selected"<?php } ?>><?php echo $item->SubjectName ?></option>
    <?php } ?>
</select>
<select id="index_lophoc" class="form-control">
                                            <option value="0">Chọn lớp</option>
                                                                                              <option value="1" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==1){ ?>selected="selected"<?php } ?>>lớp 1</option>
                                                                                    <option value="2" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==2){ ?>selected="selected"<?php } ?>>lớp 2</option>
                                                                                    <option value="3" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==3){ ?>selected="selected"<?php } ?>>lớp 3</option>
                                                                                    <option value="4" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==4){ ?>selected="selected"<?php } ?>>lớp 4</option>
                                                                                    <option value="5" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==5){ ?>selected="selected"<?php } ?>>lớp 5</option>
                                                                                    <option value="6" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==6){ ?>selected="selected"<?php } ?>>lớp 6</option>
                                                                                    <option value="7" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==7){ ?>selected="selected"<?php } ?>>lớp 7</option>
                                                                                    <option value="8" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==8){ ?>selected="selected"<?php } ?>>lớp 8</option>
                                                                                    <option value="9" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==9){ ?>selected="selected"<?php } ?>>lớp 9</option>
                                                                                    <option value="10" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==10){ ?>selected="selected"<?php } ?>>lớp 10</option>
                                                                                    <option value="11" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==11){ ?>selected="selected"<?php } ?>>lớp 11</option>
                                                                                    <option value="12" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==12){ ?>selected="selected"<?php } ?>>lớp 12</option>
                                                                                    <option value="13" <?php if(isset($_SESSION['lophoc']) and $_SESSION['lophoc']==13){ ?>selected="selected"<?php } ?>>Ôn thi đại học</option>
</select>
<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_linkseo'); ?>">
<p class="sidebar"><a href="<?php echo site_url('admin/frmlinkseo'); ?>">Thêm mới</a> <input type="submit" name="submit" value="Xóa" /></p>
<table width="100%" style="display:block;">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>        
        <td width="80%">Tiêu đề</td>
		<td>Môn học</td>
        <td>Tỉnh thành</td>     
        <td>Lớp học</td>   	               
		<td width="10%">Loại</td>					
		<td width="5%" align="center">id</td>
    </tr>
	<?php 
	if($query!='')
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
				<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $item->id; ?>" />
			</div>
			</td>					
			<td><a href="<?php echo site_url('admin/edit_linkseo/'.$item->id); ?>"><?php echo $item->title; ?></a></td>			
			<td>
            <?php 
					$cats=$CI->admin_model->gettbl('subject',$item->subjectid);
					if($cats->num_rows()> 0){
					$cat= $cats->row();
						echo $cat->SubjectName;
					}
					else{
						echo 'Không chọn';
					}
			?>
            </td>
            <td>
            <?php 
					$cats=$CI->admin_model->getcitybyid($item->cityid);
					if($cats != ""){
						echo $cats->cit_name;
					}
					else{
						echo 'Không chọn';
					}
			?>
            </td>
            <td>
            <?php 
            if($item->lophoc==0){
                echo "không chọn";
            }else if($item->lophoc==13){
                echo "Ôn thi đại học";
            }else{
                echo"lớp".$item->lophoc;
            }
            ?>
            </td>			
			<td align="center">						
			  <?php 
			  if($item->type==1)
			  {					
			  
			  ?>
			  <a class="status" >Lớp học</a>
			  <?php 
			  }
			  else
			  {
			  ?>
			  <a class="status" >Gia sư</a>
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