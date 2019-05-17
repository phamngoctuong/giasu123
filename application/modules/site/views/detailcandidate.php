<?php

/**
 * @author GallerySoft.info
 * @copyright 2018
 */
//$urlweb="http://localhost/giasusv".$_SERVER['REQUEST_URI'] ;
//if($urlweb != $canonical)
//{
//   header("HTTP/1.1 301 Moved Permanently"); 
//   header("Location: $canonical");
//   exit();
//}
$CI=&get_instance();
$CI->load->model('site/site_model');
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
    
    }
    $userid=$tg['UserId'];
    
    $trace="users_".$userinfo->UserID;
  $logpoint=$CI->site_model->getlogpoint($userid,$trace); 
  //
?>
<div class="container">

    <?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-top-20 padd-bot-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12 titledetail">
                <div class="tit_hd">
                 <h3>Thông tin gia sư</h3>         
              </div>
            </div>             
        </div>
        <div class="row">
            <div class="col-md-2 col-sm-12 padd-r-0">
                <div class="detailjob-header teacher">
                    <?php if(!empty($userinfo->Image)){?>
                                        <img class="img-responsive" src="<?= gethumbnail(geturlimageAvatar(strtotime($userinfo->CreateDate)).$userinfo->Image,$userinfo->Image,strtotime($userinfo->CreateDate),180,180,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                    <?php }else{ ?>
                                     <img class="img-responsive" src="images/no-image2.png" alt="#" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>
                </div>
            </div>
            <div class="col-md-10 col-sm-12 padd-l-10">
                <div class="detailjob-header">                    
                    <div class="detailjob-info col-md-8 col-sm-12 padd-l-0">
                        <h1 class="detailjob-name"><a><?php echo $userinfo->Name; ?></a></h1>
                        <div class="detailjob-cty teacher"><a href=""><?php
                if(empty($userinfo->cv_cate_id)){
                    $catname=0;
                }else{
                    $catname=$userinfo->cv_cate_id;
                }
                 echo GetCategory($catname); ?> </a></div>
                        <div class="detailjob-location teacher"><strong>Địa chỉ: </strong><?php echo $userinfo->Address." | "; if(intval($userinfo->cv_city_id)==0){echo "Chưa cập nhật";}else{ echo Getcitybyindex($userinfo->cv_city_id);} ?></div>
                        <div class="detailjob-salary"><strong>Mức lương: </strong> <?php
                                            if(empty($userinfo->cv_money_id)){
                                                $mucluong=0;
                                            }else{
                                                $mucluong=$userinfo->cv_money_id;
                                            }
                                             echo GetLuong($mucluong); ?>
                                             </div>
                        <div class="detailjob-location teacher"><strong>Kinh nghiệm: </strong><?php if(intval($userinfo->cv_exp)==0){echo "Chưa có kinh nghiệm";}else{ echo Getexp($userinfo->cv_exp);} ?></div>
                        
                    </div>
                    <div class="detailjob-social col-md-4 col-sm-12 teacher">                        
                        <div class="divbtn" style="text-align: center;margin-bottom:15px;">
                            <?php if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
                            $infologin=$_SESSION['UserInfo'];
                            //var_dump($infologin);
                            if($infologin['Type']==4){
                                $footer=$CI->site_model->GetUserJobby($userinfo->UserID,$infologin['UserId'],0,3);
                                
                                ?>
                                <input type="hidden" id="ucom" value="<?php echo $userinfo->UserID ?>" />
                                <?php if($footer == ''){ ?>                                    
                                    <span class="btn btndaxacthuc luuhoso">Lưu hồ sơ</span>
                                    <?php } ?>
                            <?php } } ?>
                        </div>
                        <p>
                        
                        </p>
                        <ul>
                    					<li><div class="fb-like fb_iframe_widget" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=0&amp;href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;layout=button&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true&amp;size=small"><span style="vertical-align: bottom; width: 112px; height: 20px;"><iframe name="ff41c8dbc049a8" width="1000px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" title="fb:like Facebook Social Plugin" src="https://www.facebook.com/v3.1/plugins/like.php?action=like&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2F__Bz3h5RzMx.js%3Fversion%3D42%23cb%3Df2afb4f993516a%26domain%3Dlocalhost%26origin%3Dhttp%253A%252F%252Flocalhost%253A9001%252Ff25d959f42fbcb8%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;layout=button&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true&amp;size=small" style="border: none; visibility: visible; width: 112px; height: 20px;" class=""></iframe></span></div></li>
                                        <li><a aria-label="facebook" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=https://timviec365.vn/ssl/trai-nganh-luong-cao-hay-dung-nganh-luong-thap-b87.html" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                    					<li><a aria-label="facebook" rel="nofollow" href="http://www.twitter.com/share?url=https://timviec365.vn/ssl/trai-nganh-luong-cao-hay-dung-nganh-luong-thap-b87.html" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                    					<li><a aria-label="facebook" rel="nofollow" href="https://plus.google.com/share?url={https://timviec365.vn/ssl/trai-nganh-luong-cao-hay-dung-nganh-luong-thap-b87.html}" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>
                                        <li><a aria-label="facebook" rel="nofollow" href="#"><i class="fa fa-instalgram"></i></a></li>
                    					<!-- <li><a href=""><i class="img share"></i>Chia sẻ ẩn danh</a></li> -->
                    	</ul>
                    </div>
               </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-70 col-sm-12">
                <div class="top-detail">
                    <div class="detailjob-body">
                        <h3 class="title">Thông tin chung</h3>
                        <div class="detailjob-body1 detailteach">
                            
                            <p>
                                <small><i class="fa fa-envelope"></i>
                                          <?php if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){ 
                                            if(empty($userinfo->use_email)){echo ' Chưa cập nhật';}else{echo $userinfo->use_email;}
                                            ?>
                                                
                                          <?php }else{ ?>
                                          <b style="color:#ff0000">Đăng nhập để xem</b>
                                          <?php } ?>
                                    </small></p>
                                <p>
                                    <small><i class="fa fa-phone"></i>
                                          <?php if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){ 
                                            if(empty($userinfo->use_phone)){echo ' Chưa cập nhật';}else{echo $userinfo->use_phone;}
                                            ?>
                                                
                                          <?php }else{ ?>
                                          <b style="color:#ff0000">Đăng nhập để xem</b>
                                          <?php } ?>
                                    </small>
                            </p>
                            <p>Mức lương: <small><?php if(intval($userinfo->cv_money_id)==0){echo "Thỏa thuận";}else{ echo GetLuong($userinfo->cv_money_id);} ?></small></p>
                            <p>Cấp bậc: <small><?php if(intval($userinfo->cv_capbac_id)==0){echo "Chưa cập nhật";}else{ echo GetCapBac($userinfo->cv_capbac_id);} ?></small></p>
                                            <p>Kinh nghiệm: <small><?php if(intval($userinfo->cv_exp)==0){echo "Chưa có kinh nghiệm";}else{ echo Getexp($userinfo->cv_exp);} ?></small></p>
                                            <p>Giới tính: <small><?php if($userinfo->use_gioi_tinh==0){
                                                    echo"Chưa cập nhật";
                                                  }else if($userinfo->use_gioi_tinh==1){
                                                    echo "Nam";
                                                  }else{
                                                    echo "Nữ";
                                                  } ?></small></p>
                                            <p>Ngành nghề: <small><?php if(intval($userinfo->cv_cate_id)==0){echo "Chưa cập nhật";}else{ echo GetCategory($userinfo->cv_cate_id);} ?></small></p>
                                            <p>Học vấn: <small><?php if(intval($userinfo->cv_hocvan)==0){echo "Chưa cập nhật";}else{ echo Geteduhome($userinfo->cv_hocvan);} ?></small></p>
                                            <p>Địa chỉ: <small><?php 
                                                    if(empty($userinfo->use_address)){echo ' Chưa cập nhật';}else{echo $userinfo->use_address;}
                                                    ?></small></p>
                                            <p>Nơi làm việc: <small><?php if(intval($userinfo->cv_city_id)==0){echo "Chưa cập nhật";}else{ echo Getcitybyindex($userinfo->cv_city_id);} ?></small></p>
                                            <p>Ngày sinh: <small><?php echo date("d/m/Y",$userinfo->use_birth_day); ?></small></p>
                                            
                            
                        </div>
                        <div class="clr"></div>
                        <h3 class="title">Mục tiêu nghề nghiệp</h3>
                        <div class="detaijob-body2">
                            <p><?php if(empty($userinfo->cv_muctieu)){echo "Mục tiêu nghề nghiệp chưa cập nhật";}else{ echo $userinfo->cv_muctieu ;} ?></p>
                        </div>
                        <h3 class="title">Kỹ năng bản thân</h3>
                        <div class="detaijob-body2">
                            <p><?php if(empty($userinfo->cv_kynang)){echo "Chưa cập nhật";}else{ echo $userinfo->cv_kynang;} ?></p>
                        </div>
                        <h3 class="title">Giới thiệu bản thân</small></h3>
                        <div class="detaijob-body2">
                              <p><?php echo $userinfo->Description ?></p>
                             
                             
                             
                             
                             
                                                                      
                        </div>
                    </div>
                </div>
                <ul class="blockfun">
                        
                        
                        <li>
                            <a data-val="<?php echo "users_".$userinfo->UserID ?>" class="btnviewcontactinfo"><i class="fa fa-view-att-white"></i> Xem liên hệ</a>
                        </li>
                        
                        
                        <li>
                            <a><i class="fa fa-envelope-o"></i> Gửi email</a>
                        </li>
                    </ul>
            </div>
            <div class="col-md-30 col-sm-12 col-right-search padd-l-0">
                <div class="box_job_search user" style="margin-top:24px;">
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
                 <div class="box_job_search cate">
                 	<h3>GIA SƯ THEO MÔN HỌC</h3>
                 	<div class="main_sc">
                    <input type="text" placeholder="Nhập từ khóa..." id="keymonhon" name="keymonhoc">
                    <ul class="right_tg">
                        <?php if(!empty($giasutheomonhoc)){
                            foreach($giasutheomonhoc as $n){?>
                               <li><a href="<?php echo base_url() ?>gia-su-<?php echo vn_str_filter($n->SubjectName)."-s".$n->ID."c0r0.html" ?>"><?php echo $n->SubjectName ?> <span>(<?php echo $n->sogiasu ?>)</span></a></li> 
                            <?php }
                        } ?>
                       
                    </ul>
                 </div>
              	</div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade capnhattrangthaiclass" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title"><b>Thông tin ứng viên</b></div>          
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row padd-top-15 padd-bot-5" style="">                    
                    <div class="col-md-12">                        
                         <div class="form-group" style="margin:5px auto;">
                            <label class="control-label" id="txtviewphone"></label>
                            </div>
                            <div class="form-group" style="margin:5px auto;">
                            <label class="control-label" id="txtviewemail"></label>
                            </div>                        
                    </div>
                </div>                
            </div>            
        </div>
        <div class="modal-footer" style="text-align:left;">
            <button type="button" id="btnhuy" class="btn btn-primary btn-warning" data-dismiss="modal" style="padding: 6px 20px;width: 109px;margin-left: 5px;display: inline-block;">Đóng</button>
            
        </div>
      </div>
    </div>
  </div>
<script src="<?php echo base_url() ?>combine.php?type=javascript&files=jquery.slimscroll.min.js"  type="text/javascript"></script>
<script>
$(document).ready(function(){
    var configulr='<?php echo base_url(); ?>';
    $('.luuhoso').on('click',function(){
        $.ajax(
              {
                  
                  url: configulr+"/site/ajaxcompanysaveuser",
                  type: "POST",
                  data: { use: $('#ucom').val()},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                         alert(reponse.msg);
                      }else{
                        alert('Thất bại, bạn đã lưu ứng viên này');
                        $('.luuhoso').hide();
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
    $('.btnviewcontactinfo').on('click',function(){
        var trace=$(this).attr('data-val');
        $.ajax(
              {
                  
                  url: configulr+"/site/ajaxviewcontactinfo",
                  type: "POST",
                  data: { keyview:trace },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {                          
                          $('#txtviewphone').text('Phone: '+reponse.obj.phone);
                          $('#txtviewemail').text('Email: '+reponse.obj.email);
                          $('#myModal').modal('show');
                      }else{
                        alert('Thất bại, bạn vui lòng kiểm tra lại, có thể bạn không đủ điểm để xem');
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
