<?php

/**
 * @author GallerySoft.info
 * @copyright 2018
 */

//$urlweb="http://localhost".$_SERVER['REQUEST_URI'] ;
//if($urlweb != $canonical)
//{
//   header("HTTP/1.1 301 Moved Permanently"); 
//   header("Location: $canonical");
//   exit();
//}
if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
    $infologin=$_SESSION['UserInfo'];
}
$CI=&get_instance();
$CI->load->model('site/site_model');
?>
<!-- Title Header Start -->
			<section class="inner-header-title detailcom" style="background-image:url(images/banner-10.jpg);">
				<div class="container">
					<h1><?php echo $itemjob->new_title ?></h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
<section class="detail-desc">
				<div class="container white-shadow">				
					<div class="row">					
						<div class="detail-pic">
							<img height="120px" width="120px" src="<?= gethumbnail(geturlimageAvatar($itemjob->usc_create_time).$itemjob->usc_logo,$itemjob->usc_logo,$itemjob->usc_create_time,155,155,85) ?>" alt="<?php echo $itemjob->usc_company ?>" onerror='this.onerror=null;this.src="images/no-image.png";'>							
						</div>						
						<div class="detail-status">
							<!--<span>2 Days Ago</span>-->
						</div>						
					</div>					
					<div class="row bottom-mrg">
						<div class="col-md-12 col-sm-12">
							<div class="detail-desc-caption">
								<h4><?php echo $itemjob->usc_company ?> </h4>
								<p class="designation"><?php                        
                                                    $arr=explode(',',$itemjob->new_cat_id);
                                                    for($i=0;$i< count($arr);$i++){
                                                        echo "<a href='javascript:void(0);' class=''>".GetCategory(intval($arr))."</a>";
                                                    } 
                                                    ?>
                                </p>
								<ul>
									<li><i class="fa fa-briefcase"></i><span><?php echo GetTypeJob($itemjob->new_hinh_thuc) ?></span></li>
									<li><i class="fa fa-flask"></i><span><?php echo Getexp($itemjob->new_exp) ?></span></li>
                                    <li><i class="fa fa-map-marker"></i><span><?php echo Getcitybyindex($itemjob->new_city) ?> </span></li>
									<li><i class="fa fa-venus-mars"></i><span><?php if(empty($itemjob->new_gioi_tinh)){echo "Không yêu cầu";}else{ echo $itemjob->new_gioi_tinh;} ?></span></li>
									<li><i class="fa fa-level-up"></i><span><?php echo GetCapBac($itemjob->new_cap_bac) ?></span></li>
									<li><i class="fa fa-calendar"></i><span><?php echo date('F j, Y',$itemjob->new_han_nop); ?></span></li>
									<li><i class="fa fa-money"></i><span><?php echo GetLuong($itemjob->new_money) ?>/Month</span></li>                                    
                                    <li><i class="fa fa-graduation-cap"></i><span><?php if(empty($itemjob->new_bang_cap)){echo "Không yêu cầu";}else{ echo Getedu($itemjob->new_bang_cap);} ?></span></li>
								</ul>
							</div>
						</div>
					</div>					
					<div class="row no-padd">
						<div class="detail pannel-footer">
							<div class="col-md-5 col-sm-5">
								<ul class="detail-footer-social">
									<li>
            						      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $canonical; ?>" target="_blank">
            								<i class="fa fa-facebook facebook-cl"></i>
            							</a>
                					</li>
                					<li>
                							<a href="http://www.twitter.com/share?url=<?php echo $canonical; ?>" target="_blank">
                								<i class="fa fa-twitter twitter-cl"></i>
                							</a>
                					</li>
                					<li>
                							<a href="https://plus.google.com/share?url={<?php echo $canonical; ?>}" target="_blank">
                								<i class="fa fa-google-plus google-plus-cl"></i>
                							</a>
                					</li>
                					<li>
                							<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $canonical; ?>&title=<?php echo $meta_title; ?>&summary=<?php echo $meta_title; ?>&source=LinkedIn" target="_blank">
                								<i class="fa fa-linkedin linkedin-cl"></i>
                							</a>
                					</li>
								</ul>
							</div>							
							<div class="col-md-7 col-sm-7">
								<div class="detail-pannel-footer-btn pull-right">
                                    <?php if($infologin['Type']==3){
                                                $footer=$CI->site_model->GetUserJobby($infologin['UserId'],$itemjob->UserID,$itemjob->new_id,1);                                               
                                         ?>
                                            <input type="hidden" id="idc" value="<?php echo $itemjob->UserID ?>" />
                                            <input type="hidden" id="idj" value="<?php echo $itemjob->new_id ?>" />
                                           <div>
                                            <?php if($footer ==''){ ?>
									<a class="footer-btn grn-btn nopdon" title="">Nộp đơn</a>
                                    <?php } 
                                            $footer1=$CI->site_model->GetUserJobby($infologin['UserId'],$itemjob->UserID,$itemjob->new_id,2);
                                            if($footer1 ==''){
                                            ?>
									<a class="footer-btn blu-btn luucongviec" title="">Lưu việc</a>
                                    <?php }else{ ?>
                                              <a class="footer-btn btn btn-primary">Bạn đã lưu công việc này</a>  
                                            <?php } }  ?>
                                    
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</section>
<!-- SubHeader -->
<section class="full-detail-description full-detail jobdetail">
	<div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="row row-bottom">
                        <h2 class="detail-title">Mô tả công việc</h2>
                        <?php if(empty($itemjob->new_mota)){echo "Nội dung chưa cập nhật";}else{ echo $itemjob->new_mota;} ?>
                </div>
                <div class="row row-bottom">
                                <h2 class="detail-title">Yêu cầu kỹ năng</h2>
                                <?php if(empty($itemjob->new_yeucau)){echo "Nội dung chưa cập nhật";}else{ echo $itemjob->new_yeucau;} ?>
                </div>
                <div class="row row-bottom">
                                <h2 class="detail-title">Quyền lợi được hưởng</h2>
                                <?php if(empty($itemjob->new_quyenloi)){echo "Nội dung chưa cập nhật";}else{ echo $itemjob->new_quyenloi;} ?>
                </div>
                <div class="row row-bottom">
                                <h2 class="detail-title">Yêu cầu hồ sơ</h2>
                                <?php if(empty($itemjob->new_ho_so)){echo "Nội dung chưa cập nhật";}else{ echo $itemjob->new_ho_so;} ?>
                </div> 
            </div>
            <div class="col-md-4 col-sm-12 col-right-search">
                <div class="box_job_search user" style="margin-top:20px;">
        	        <h3 style="text-indent: 10px;text-transform: uppercase;"><i class="fa fa-userl"></i> Gia sư tiêu biểu</h3>
                    <div class="boxfeature">
                        <?php if(!empty($chude)){
                            foreach($chude as $n){ ?>
                            <div class="itemfeature">
                                <div class="feature-icon">
                                    <?php if(!empty($n->Image)){?>
                                        <img src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),174,174,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                    <?php }else{ ?>
                                     <img src="images/no-image2.png" alt="#" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>
                                </div>
                                <div class="feature-caption">
                                    <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name; ?>" class="feature_name"><?php echo $n->Name ?></a>
                                    <div title="#" class="feature_titleview"><span>Gia sư:</span><?php 
                                    echo str_replace('Gia sư','',$n->TitleView); 
                                    
                                    ?><a><?php echo $n->CityName ?></a></div>
                                    <span class="feature_luong">Từ: <span><?php echo number_format($n->Free)." vnđ/buổi" ?></span></span>
                                </div>
                            </div>    
                         <?php   }
                        } ?>
                    </div>
                 </div>
            </div>
        </div>		                   
    </div>                
</section>
<script>
$(document).ready(function() {
    $('.nopdon').on('click',function(){
        $.ajax(
              {                  
                  url: configulr+"/site/ajaxuseramplyjob",
                  type: "POST",
                  data: { com: $('#idc').val(), job: $('#idj').val()},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                    if (reponse.kq == true) {
                         alert("Nộp don thành công");
                         $('.nopdon').attr('style','display:none;');
                         window.location.reload();
                      }else{
                        alert('Thất bại');
                      }                      
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              }); 
    });
    $('.luucongviec').on('click',function(){
        $.ajax(
              {
                  
                  url: configulr+"/site/ajaxusersavejob",
                  type: "POST",
                  data: { com: $('#idc').val(), job: $('#idj').val()},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                         alert(reponse.msg);
                         window.location.reload();
                      }else{
                        alert('Thất bại');
                      }
                      
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              }); 
    });
});
</script>
<!-- SubHeader -->
