<?php
?>
<section class="inner-header-title detailcom" style="background-image:url(images/banner-10.jpg);">
	<div class="container">
		<h1><?php echo $item->title; ?></h1>

	</div>
</section>
<div class="clearfix"></div>
<!-- SubHeader -->
<section class="section" id="section-news">
				<div class="container">
					<div class="row no-mrg">
						<div class="col-md-8">
							<article class="blog-news">
								<div class="full-blog detailnews">

								<!--	<figure class="img-holder">
                                        <div class="sapo"><?php echo $item->sapo; ?></div>
										<a class="imgnews" href="<?php echo site_url($item->alias.'-b'.$item->id.'.html'); ?>"><img src="<?echo base_url().'upload/news/'.$item->image; ?>" alt="<?php echo $item->title; ?>"></a>
										<div class="blog-post-date">
											<?php
            						$d = explode('-',explode(' ', $item->created_day)[0]);
            						echo $d[2].'/'.$d[1].'/'.$d[0]; ?>
										</div>
									</figure>-->

									<div class="full blog-content">

										<!--<a rel="nofollow" href="<?php echo site_url($item->alias.'-b'.$item->id.'.html'); ?>"><h2><?php echo $item->title; ?></h2></a>-->
										<div class="blog-text">
											<div id="muc-luc-content-thu" class = "views">
		                    <div id="tieudemucluc" style="text-align:center;">

		                    </div>
		                      <ul id="content-mucluc" style="padding-inline-start: 10px">

		                      </ul>
		                    </div>
		                    	<div name="content-thu" id="content-thu" >
														<?php echo $item->content; ?>
													</div>
													<div class="icon-news" style="margin-bottom:50px;">
														<p style="float:right">
														<a ><span id="span-icon-news" >Chia sẻ:</span><a>
														<a aria-label="facebook" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?=trim($canonical);?>" target="_blank"><i style="color:#3b5998" class="fa fa-facebook-square"></i></a>
														<a aria-label="facebook" rel="nofollow" href="http://www.twitter.com/share?url=<?=trim($canonical);?>" target="_blank"><i style="color:#1da1f2" class="fa fa-twitter-square"></i></a>
														<a aria-label="facebook" rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?=trim($canonical);?>" target="_blank"><i style="color:#0077b5" class="fa fa-linkedin"></i></a>
													</p>
													</div>
										</div>

									</div>

								</div>
								<?php
									if(!empty($item->linkRelationship)){
										$linkRelationship = explode(',',$item->linkRelationship);
										?>
										<div class="post-meta" style="font-weight:bold;margin-top:10px;margin-left:20px">Các bài viết liên quan</div>
										<ul>
										<?php
										foreach ($linkRelationship as $value) {
											$link=$this->db->select('id,alias,title');
											$link=$this->db->get_where('baiviet',array('id'=>$value))->row();
											?>
											<div class="post-meta" style="font-size:14px;font-family: 'Montserrat',sans-serif;" >
													<li>
														<span class="category"><a rel="dofollow" href="<?php echo base_url().$link->alias.'-b'.$link->id.'.html' ?>"><?php echo $link->title ?></a></span>
													</li>
											</div>
											<?php
										}
										?>
									</ul>
										<?php
									}
								 ?>
							</article>
                        </div>
                        <div class="col-md-4">
                        <div class="box_job_search user" style="margin-top:0px;">
        	        <h3 style="text-indent: 10px;text-transform: uppercase;"><i class="fa fa-userl"></i> Gia sư tiêu biểu</h3>
                    <div class="boxfeature">
                        <?php if(!empty($chude)){
                            foreach($chude as $n){ ?>
                            <div class="itemfeature">
                                <div class="feature-icon">
                                    <?php if(!empty($n->Image)){?>
                                        <img src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),174,174,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="<?php echo $n->Name?>" />
                                    <?php }else{ ?>
                                     <img src="images/no-image2.png" alt="#no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>
                                </div>
                                <div class="feature-caption">
                                    <a rel="nofollow" href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name; ?>" class="feature_name"><?php echo $n->Name ?></a>
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
                 <div class="box_job_search cate">
                 	<h3>GIA SƯ THEO MÔN HỌC</h3>
                 	<div class="main_sc">
                    <input type="text" placeholder="Nhập từ khóa..." id="keymonhon" name="keymonhoc">
                    <ul class="right_tg">
                        <?php if(!empty($giasutheomonhoc)){
                            foreach($giasutheomonhoc as $n){?>
                               <li><a rel="nofollow" href="<?php echo base_url() ?>giao-vien&key=all&subject=<?php echo $n->ID ?>&topic=0&place=0&type=0&sex=0&order=last"><?php echo $n->SubjectName ?> <span>(<?php echo $n->sogiasu ?>)</span></a></li>
                            <?php }
                        } ?>

                    </ul>
                 </div>
              	</div>
                        </div>
                    </div>
                </div>
</section>

<!-- SubHeader -->

<script src="<?php echo base_url() ?>combine.php?type=javascript&files=jquery.slimscroll.min.js"  type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    var configulr='<?php echo site_url() ?>';
        $('.right_tg').slimscroll({
  height: '400',
  allowPageScroll: true,
});
$("#keymonhon").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
           $.ajax(
              {

                  url: configulr+"/site/ajaxtimgiasutheomonhoc",
                  type: "POST",
                  data: { monhoc:$("#keymonhon").val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                            $(".right_tg li").remove();
                          /*$("#list_workonline").innerHTML = reponse.data;*/
                            $(".right_tg").append(reponse.data);


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
        });
 </script>
