<?php $ui=$_SESSION['UserInfo']; ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left'); ?>
        </div>
        <?php if($ui['Type']==1){ ?>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right " style="min-height:300px;">
                <div class="clr" style="height:10px;position: relative;"><a id="btnlogout" class="btnlogout"><i class="fa fa-logout"></i> Thoát</a></div>
                <div class="clr" style="height:10px;"></div>
                <div class="ntdsearchbyprovince" style="">
                    <div class="form-control"><input type="text" id="findkey" name="findkey" placeholder="Vui lòng nhập ngành nghề"/> <i class="fa fa-searchbtn"></i></div>
                </div>
                <div class="listnganhnghe">
                    <ul>
                         <?php
                                    if(!empty($tinhthanh)){
                                        foreach($tinhthanh as $n){ ?>
                                            <li class="col-md-4 padd-0"><a target="_blank" href="<?php echo base_url(); ?>gia-su&key=all&subject=0&topic=0&place=<?php echo $n->cit_id ?>&type=0&sex=0"><?php echo $n->cit_name ?></a></li>
                                        <?php }
                                    }
                         ?>
                    </ul>
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
	   $("#findkey").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $.ajax(
              {

                  url: configulr+"site/ajaxfindprovince",
                  type: "POST",
                  data: { findkey: $('#findkey').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {

                     if(obj.kq ==true){

                        $(".listnganhnghe ul li").remove();
                            $(".listnganhnghe ul").append(obj.data);


                        }else{

                        }
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
        };
    });
	   })
 </script>
