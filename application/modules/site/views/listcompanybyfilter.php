<?php

/**
 * @author GallerySoft.info
 * @copyright 2018
 */


?>
<section class="inner-header-title" style="background-image:url(images/banner-10.jpg);">
	<div class="container">
		<h1>Nhà tuyển dụng</h1>
	</div>
</section>
<div class="clearfix"></div>
<section class="browse-company">
				<div class="container">
					<!-- Company Searrch Filter Start -->
					<div class="row extra-mrg">
						<div class="wrap-search-filter">
							<form>
								<div class="col-md-10 col-sm-10">
									<input class="form-control" id="keyworkcom" value="<?php echo $params['keywork'] ?>" placeholder="Nhập từ khóa" type="text">
								</div>

								<div class="col-md-2 col-sm-2">
									<button name="submit" type="button" class="timdoanhnghiep btn btn-success full-width">Tìm kiếm</button>
								</div>
                                <div class="col-md-12">
                                    <div class="filter-by slider">
                                        <?php
                                        if(!empty($fillabc)){
                                            foreach($fillabc as $abc){
                                                if($params['keywork']==$abc['name'] && $params['type']==2){ ?>
                                                    <div><a onclick="load('<?php echo $abc['url']  ?>')" class="active"><?php echo $abc['name'] ?></a></div>
                                                <?php }else{ ?>
                                                    <div><a onclick="load('<?php echo $abc['url']  ?>')" ><?php echo $abc['name'] ?></a></div>
                                                <?php }
                                            }
                                        }
                                        ?>

                                      </div>
                                </div>
							</form>
						</div>
					</div>
                    <?php if(!empty($itemcom)){
                         foreach($itemcom as $n){
                    ?>
                    <div class="item-click">
						<article>
							<div class="brows-company">
								<div class="col-md-2 col-sm-2">
									<div class="brows-company-pic">
										<a href="<?php echo base_url()."".vn_str_filter($n->usc_company)."-ntd".$n->usc_id.".html"; ?>" class="careerfy-employer-grid-image">
											<?php if(!empty($item->usc_logo)){?>
	                        <img src="<?= gethumbnail(geturlimageAvatar(strtotime($item->usc_create_time)).$item->usc_logo,$item->usc_logo,strtotime($item->usc_create_time),174,174,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="<?php echo $item->usc_company?>"/>
	                    <?php }else{ ?>
	                     <img src="images/clgt.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
	                     <?php } ?></a>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="brows-company-name">
										<a title="<?php echo $n->usc_company; ?>" href="<?php echo base_url()."".vn_str_filter($n->usc_company)."-ntd".$n->usc_id.".html"; ?>"><h4><?php echo $n->usc_company; ?></h4></a>
										<span class="brows-company-tagline">Quy mô: <?php echo GetQuyMoCty($n->usc_size); ?></span>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="brows-company-location">
										<p><i class="fa fa-map-marker"></i> <?php echo $n->usc_address; ?></p>
									</div>
								</div>
								<div class="col-md-2 col-sm-2">
									<div class="brows-company-position">
										<p><?php echo number_format($n->sobaiviet); ?> Việc</p>
									</div>
								</div>
							</div>
						</article>
					</div>

                    <?php } }else{ ?>
                        <div class="col-md-12"><h5>Không tìm thấy doanh nghiệp nào phù hợp</h5></div>
                    <?php } ?>
                    <div class="pagation pull-right">
    						<?php echo $pagination; ?>
    					</div>
                </div>
</section>
<!-- SubHeader -->
<script>


function load(elm){window.location = elm;}
</script>
