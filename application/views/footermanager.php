<?php 
$CI=&get_instance();
$CI->load->model('site/site_model');
//$footer=$CI->memcached_library->get('key_footer');
$footer=$CI->site_model->getconfig();
?>
<?php $urlweb= current_url();
?>
<div class="clearfix"></div>
<!-- Footer Section Start -->
	<div style="clear: both;height:50px;"></div>	
<!-- Footer -->        

<script>
document.addEventListener("DOMContentLoaded", function(event) {
    console.log("DOM fully loaded and parsed");
  });
$(document).ready(function(){
    
    $('#index_nganhnghe').select2({ width: 'calc(100%)' });
$('#index_dia_diem').select2({ width: 'calc(100%)' });
$('#candinganhnghe').select2({ width: 'calc(100%)' });
$('#candilocation').select2({ width: 'calc(100%)' });

   $('#morelocation').on('click',function(){
        
        if($('#showlocation').hasClass("morelocation"))
        {
            $('#showlocation').removeClass("morelocation");
        }
        else {
            $('#showlocation').addClass('morelocation');
        }
    });  
    $('#morenganhnghe').on('click',function(){
        
        if($('#shownganhnghe').hasClass("morelocation"))
        {
            $('#shownganhnghe').removeClass("morelocation");
        }
        else {
            $('#shownganhnghe').addClass('morelocation');
        }
    });
    $('.timvieclam').on('click',function(){
        var findkey=$('#findkeyjob').val();
        var strsubj=$('#index_nganhnghe').val();
        var strtopic=$('#index_dia_diem').val();
        /*var strtinhthanh=$('#tinhthanh').val();
        var strgioitinh=$('#gioitinh').val();
        var strtype=$('#hinhthuchoc').val();*/
        if(findkey !='' || strsubj !='' || strtopic!=''){
        $.ajax(
              {
                  
                  url: configulr+"/site/searchteacher",
                  type: "POST",
                  data: { key:findkey,subject:strsubj,topic:0,place:strtopic,type:0,sex:0 },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          window.location=reponse.data;
                      }
                      
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              }); 
              }
    });
})
</script>