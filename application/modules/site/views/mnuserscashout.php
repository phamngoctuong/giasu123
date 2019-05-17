<?php $ui=$_SESSION['UserInfo']; ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left1');  ?>
        </div>
        <?php if($ui['Type']==0){ ?>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right updatepass" style="min-height:300px;">
                <div class="clr" style="height:10px;position: relative;"></div>
                <div class="clr" style="height:40px;"></div>
                <div class="title"><span>Mua điểm xem thông tin</span></div>
                <p>Tỷ lệ quy đổi tiền là 1000vnđ tương ứng với 1 điểm</p>
                 
                <!--nội dung-->
                <div class="fieldset">                         
                <div class="group-control">
                    <label class="control-label required">Nhập số điểm</label>
                    <div class="form-control"><input type="number" id="txtsodiemmua" name="txtsodiemmua" placeholder=""/></div>                    
                </div>
                    <div class="btngroup">
                        <a id="btnmuadiem" class="btnmuadiem btn-success" style="width:150px">Mua điểm ngay</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
	    var configulr='<?php echo base_url(); ?>';
        $('#btnmuadiem').on('click',function(){
        if($('#txtsodiemmua').val()!=''){
            var diemmua=$('#txtsodiemmua').val();            
            $.ajax({                  
                  url: configulr+"site/jaxuserbuypoint",
                  type: "POST",
                  data: { amount:diemmua},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          alert(reponse.msg);
                      }else{
                        alert(reponse.msg);
                      }                      
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              }); 
        }else{
            $('#txtsodiemmua').addClass('errorClass');
            alert('Bạn cần điền số điểm cần mua!')
        }
    });
        })
 </script>