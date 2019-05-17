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

<section class="inner-header-title  detailcom" style="background-image:url(images/banner-10.jpg);" >
	<div class="container">
		<h1>Nhà tuyển dụng: <?php echo $itemcom->usc_company ?></h1>
	</div>
</section>
<div class="clearfix"></div>
<section class="detail-desc" id="view3">
	<div style="margin-bottom:20px">

				<div class="container white-shadow" >

					<div class="row bottom-mrg">
						<a href="#">
							<div class="detail-pic">
                <?php if(!empty($item->usc_logo)){?>
                    <img src="<?= gethumbnail(geturlimageAvatar(strtotime($item->usc_create_time)).$item->usc_logo,$item->usc_logo,strtotime($item->usc_create_time),174,174,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="<?php echo $item->usc_company?>"/>
                <?php }else{ ?>
                 <img src="images/clgt.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                 <?php } ?>
							</div></a>
						<div class="col-md-12 col-sm-12" id="view4">

							<div class="detail-desc-caption">
								<h4><?php echo $itemcom->usc_company; ?></h4>
							</div>
                            <div class="get-touch">
								<ul>
									<li><i class="fa fa-map-marker"></i><span><?php echo $itemcom->usc_address ?></span></li>
									<li><i class="fa fa-envelope"></i><span><?php if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
                                        if(empty($itemcom->usc_email)){echo "Chưa cập nhật";}else{ echo $itemcom->usc_email;}
                                    }else{
                                        echo "<b style='' class='btn_login_do' data-type='0'>Đăng nhập để xem</b>";
                                    }?></span></li>
																		<li><i class="fa fa-globe"></i><span><?php if(empty($itemcom->usc_website )){
																			echo "Chưa cập nhật";
																		}else{
																			echo $itemcom->usc_website;
																		}?></span></li>
																		<li><i class="fa fa-phone"></i><span><?php
                                    if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
                                        if(empty($itemcom->usc_phone)){
                                            echo "Chưa cập nhật";
                                        }else{
                                        echo $itemcom->usc_phone;
                                        }
                                    }else{
                                        echo "<b style='' class='btn_login_do' data-type='0'>Đăng nhập để xem</b>";
                                    }
                                    ?></span></li>
									<li><i class="fa fa-users"></i><span><?php echo GetQuyMoCty($itemcom->usc_size); ?></span></li>
									<li><?php echo $itemcom->usc_company_info ?></li>
								</ul>
							</div>
						</div>

					</div>
					<div class="row no-padd" style="margin-bottom:20px">
						<div class="detail pannel-footer">
							<div class="col-md-5 col-sm-5">
								<p>

								<a aria-label="facebook" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?=trim($canonical);?>" target="_blank"><i style="font-size:50px;color:#3b5998;margin-left:30px" class="fa fa-facebook-square"></i></a>
								<a aria-label="facebook" rel="nofollow" href="http://www.twitter.com/share?url=<?=trim($canonical);?>" target="_blank"><i style="font-size:50px;color:#1da1f2;margin-left:30px" class="fa fa-twitter-square"></i></a>
								<a aria-label="facebook" rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?=trim($canonical);?>" target="_blank"><i style="font-size:50px;color:#0077b5;margin-left:30px" class="fa fa-linkedin"></i></a>
							</p>
							</div>
							<div class="col-md-7 col-sm-7">
								<div class="detail-pannel-footer-btn pull-right">
									<!--<a class="footer-btn grn-btn" title="">Favourite</a>-->
									<a class="footer-btn blu-btn" title="">Nộp đơn</a>
								</div>
							</div>
						</div>
					</div>
</div>
</div>

				<div class="container white-shadow">
					<h2 class="detail-title">Công ty <?php echo $itemcom->usc_company?> tuyển dụng </h2>
					<?php if(!empty($morejob)){
							foreach($morejob as $n){
					?>
					<div class="list_vl_com">
							 <div class="item_vl_com">
												 <span  class="title_com_com1"><a target="_blank" href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html";  ?>" class="title_com_com"><?php echo $n->new_title ?></a>
												 <span class="hannop_hs"><?php echo date('j/ n/ Y',$n->new_han_nop); ?></span></span>
              		<div class="box_tomtat">

											<div class="form_control ic1">
													<span><i class="fa fa-money" ></i><span style="margin-left:14px"><strong>Mức Lương:</strong> <?php echo GetLuong($n->new_money) ?>/Triệu</span></span>
											</div>
											<div class="form_control ic1">
													<span><i class="fa fa-flask"></i> <span style="margin-left:10px"><strong>Kinh nghiệm:</strong> <?php echo Getexp($n->new_exp) ?></span></span>
											</div>
											<div class="form_control ic1">
													<span><i class="fa fa-graduation-cap"></i><span style="margin-left:10px"><strong>Bằng cấp:</strong> <?php if(empty($n->new_bang_cap)){echo "Không yêu cầu";}else{ echo Getedu($n->new_bang_cap);} ?></span></span>
											</div>
											<div class="form_control ic1">
													<span><i class="fa fa-briefcase"></i><span style="margin-left:10px"><strong>Hình thức:</strong> <?php echo GetTypeJob($n->new_hinh_thuc) ?></span></span>
											</div>
											<div class="form_control ic1">
													<span><i class="fa fa-map-marker" ></i><span style="margin-left:20px"><strong>Địa Điểm:</strong> <?php echo Getcitybyindex($n->new_city) ?></span></span>
											</div>
											<div class="form_control ic1">
													<span><i class="fa fa-venus-mars"></i><span style="margin-left:9px"><strong>Giới tính:</strong> <?php if(empty($n->new_gioi_tinh)){echo "Không yêu cầu";}else{ echo $n->new_gioi_tinh;} ?></span></span>
											</div>
											<div class="form_control ic1">
													<span><i class="fa fa-briefcase" ></i> <span style="margin-left:10px"> <strong>Ngành Nghề:</strong> <?php echo GetCategory($n->new_cat_id)?></span> </span>
											</div>
											<div class="form_control ic1">
													<span><i class="fa fa-level-up"></i><span style="margin-left:13px"> <strong>Chức vụ :</strong> <?php echo GetCapBac($n->new_cap_bac) ?></span></span>
											</div>


                                        <!-- <?php if($n->new_hinh_thuc > 0 && $n->new_hinh_thuc < 3){ ?>
                                                                  <span class="full-time"><?php echo GetTypeJob($n->new_hinh_thuc) ?></span>
                                                                  <?php }else if($n->new_hinh_thuc >= 3 && $n->new_hinh_thuc < 5) { ?>
                                                                  <span class="freelanc"><?php echo GetTypeJob($n->new_hinh_thuc) ?></span>
                                                                  <?php }else{ ?>
                                                                  <span class="part-time"><?php echo GetTypeJob($n->new_hinh_thuc)?></span>
                                        <?php } ?>

                                    <?php if($n->new_hot==1){ ?>
                                                                <span class="tg-themetag tg-featuretag">HOT</span>
                                                                <?php } ?>
                                                                <?php if($n->new_do==1||$n->new_cao==1){ ?>
                                                                <span class="tg-themetag tg-featuretag">VIP</span>
                                                                <?php } ?>
                                                                <?php if($n->new_gap==1){ ?>
                                                                <span class="tg-themetag tg-featuretag">Tuyển gấp</span>
                                                                <?php } ?> -->


											 </div>
										 </div>
				</div>
			<?php } }else{
				 echo "<div class='col-md-12'><h5>Không tìm thấy kết quả phù hợp</h5></div>";
			} ?>
			</div>


</section>
