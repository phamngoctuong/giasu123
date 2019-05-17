<script type="text/javascript">
function check_status(id,tblname,name)
{
	$.ajax({
		cache:false,
			type:"POST",  
			url:"<?php echo site_url('admin/status/'); ?>", 
			data:{id : id,tblname : tblname, name : name},
			success:function(html){				
				//window.location.href = "<?php //echo site_url('admin/'); ?>"+'/'+name;
				location.reload();
			}                                                          
	});  
}
</script>