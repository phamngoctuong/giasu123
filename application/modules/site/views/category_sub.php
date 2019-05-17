<?php
$urlweb=base_url().$this->uri->segment(1);
$urlweb=str_replace('_','.',$urlweb);
?>
<section class="inner-header-title detailcom padd-top-30 padd-bot-30" style="background-image:url(images/banner-10.jpg);">
	<div class="container">
		<h1 style="text-transform: capitalize;"><?php echo $item->name ?></h1>
        <?php echo $item->content ?>
	</div>
</section>
<div class="clearfix"></div>
<!-- SubHeader -->
<section class="section">
				<div class="container">
					<div class="row no-mrg">
						<!-- Start Blogs -->
						<div class="col-md-8 catnews">

                            <?php if($query->num_rows()>0){
        						foreach ($query->result() as $nub) {
                                  ?>
                            <article class="blog-news">
								<div class="short-blog">
									<figure class="img-holder">
										<a rel="dofollow"class="imgnews" href="<?php echo site_url($nub->alias.'-b'.$nub->id.'.html'); ?>"><img alt="<?php echo $nub->title; ?>" src="<?echo base_url().'upload/news/thumb/'.$nub->image; ?>" alt="<?php echo $nub->title; ?>"></a>
										<div class="blog-post-date">
											<?php
            						$d = explode('-',explode(' ', $nub->created_day)[0]);
            						echo $d[2].'/'.$d[1].'/'.$d[0]; ?>
										</div>
									</figure>
									<div class="blog-content">
										<a rel="nofollow"href="<?php echo site_url($nub->alias.'-b'.$nub->id.'.html'); ?>"><h2><?php echo $nub->title; ?></h2></a>
										<div class="blog-text">
											<?php echo $nub->sapo; ?>
											<!-- <div class="post-meta">Danh mục :  <span class="category"><a rel="nofollow"href="<?php echo site_url($item->alias.'.html') ?>"><?php echo $item->name ?></a></span></div> -->
										</div>
									</div>
								</div>
							</article>
            				<?php } } ?>
           					<div class="pagation pull-right">
          						<?php echo $pagination; ?>
           					</div>
                        </div>
                        <div class="col-md-4">
                            <div class="box_job_search user" style="margin-top:0px;">
        	        <h3 style="text-indent: 10px;text-transform: uppercase;"><i class="fa fa-userl" ></i> Gia sư tiêu biểu</h3>
                    <div class="boxfeature">
                        <?php if(!empty($chude)){
                            foreach($chude as $n){ ?>
                            <div class="itemfeature">
                                <div class="feature-icon">
                                    <?php if(!empty($n->Image)){?>
                                        <img alt="<?php echo $n->Name; ?>" src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),60,60,80) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                    <?php }else{ ?>
                                     <img alt="<?php echo $n->Name; ?>" src="images/no-image2.png" alt="#" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>
                                </div>
                                <div class="feature-caption">
                                    <a rel="nofollow"href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name; ?>" class="feature_name"><?php echo $n->Name ?></a>
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
                               <li><a rel="nofollow"href="<?php echo base_url() ?>gia-su-<?php echo vn_str_filter($n->SubjectName)."-s".$n->ID ?>c0r0.html"><?php echo $n->SubjectName ?> <span>(<?php echo $n->sogiasu ?>)</span></a></li>
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
