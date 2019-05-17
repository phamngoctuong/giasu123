<?php $ui=$_SESSION['UserInfo'];  ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left'); ?>
        </div>
        <?php if($ui['Type']==1){ ?>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right updatepass" style="min-height:300px;">
                <div class="clearfix" style="height:10px;position: relative;"><a class="btnlogout"><i class="fa fa-logout"></i> Thoát</a></div>
                <div class="clearfix" style="height:30px;"></div>
                <div class="title"><span>Thông tin khuyến mãi</span></div>
                <div class="ntdlist infobonus">
                    
                    
                </div>
                <div class="clearfix"></div>
                <div class="title naptientk"><span><i class="fa fa-bonus-black"></i> Thông báo nạp tiền vào tài khoản</span></div>
                 <div class="ntdlist infobonus">
                    
                    
                </div>
                
                 
                <!--nội dung-->
                
                
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</section>