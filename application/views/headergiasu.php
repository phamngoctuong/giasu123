<?php $urlweb= current_url();
$userlogin="";
$CI=&get_instance();
$CI->load->model('site/site_model');
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){

    $tg=$_SESSION['UserInfo'];
    $userlogin=number_format($tg['Balance']);
    $userid=$tg['UserId'];
    $subtract = "";
    $point=$CI->site_model->sumpointbyuserid($userid,$subtract);
    }

?>
<!-- Start Navigation -->
<header class="manager">
   <div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <div class="logo">
              <a href="<?=base_url();?>" title="Trang chủ Vieclam123.vn">
                 <img src="images/logo-2.png" alt="Vieclam123.vn">
              </a>
            </div>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="row">
            <div class="infontd">
                <div class="infosupport">
                    <img class="imgemployer" src="images/employersp.png">
                    <span class="chuyenvien">Chuyên viên tư vấn dành cho Gia sư</span>
                    <!--<span><b>Ms Hải Yến - SĐT: </b><span>0977.648.623</span> <b>- Email: </b><a>yen.nguyen@gmail.com</a></span>-->
                </div>
                <div class="functionntd">
                    <a href="<?php echo base_url(); ?>"><i class="fa fa-backhome" data-toggle="tooltip" title="" data-original-title="Trở về trang chủ"></i></a>
                    <a class="ndtnotify"><i class="fa fa-notify"></i>
                    <img src="images/icon-notify.png" alt="notify">
                    </a>
                    <span class="ntdmoney">TKC: <?php echo $userlogin; ?> vnđ và <?php echo number_format($point->point)." điểm" ?></span>

                    <span class="btnntdaddnews" onclick="location.href='<?php echo site_url('mn-gia-su-cap-nhat-thong-tin') ?>'">Cập nhật hồ sơ</span>
                </div>
            </div>
            </div>
        </div>
    </div>

   </div>
</header>
