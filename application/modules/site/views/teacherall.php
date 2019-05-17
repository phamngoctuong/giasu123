<?php

 ?>
  <div class="container">
    <?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-top-30 padd-bot-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="overflow: hidden;">
                <div class="tit_hd resultfindteacher">
                 <div class="ir_h3"><h3><span> <?php if(strtolower($keywork)=='all' || empty($keywork)){echo "Tất cả gia sư";}else{echo "Hồ sơ gia sư dạy ".$keywork;} ?></span></h3>
                 </div>
                 <span class="span_hd">Sắp xếp theo:
                 <select  id="slkbox" aria-label="lọc" name="slkbox">

                        <option value="<?php echo $selectbox.'last' ?>"  <?php if(strtolower($order)=='last'){echo "selected";} ?>>Mới nhất</option>
                    <option value="<?php echo $selectbox.'pricelow' ?>" <?php if(strtolower($order)=='pricelow'){echo "selected";} ?>>Lương từ thấp đến cao</option>
                    <option value="<?php echo $selectbox.'pricehigh' ?>" <?php if(strtolower($order)=='pricehigh'){echo "selected";} ?>>Lương từ cao xuống thấp</option>


                    </select>
                 </span>
                </div>
            </div>
            <div class="col-md-70 col-sm-12">
                <div class="main_giaovien">
             <?php if(!empty($lstitem)){
                  foreach($lstitem as $n){
                    ?>
                        <div class="item_lc">
                            <div class="col-md-3 col-sm-12 padd-0">
                                <div class="giasu_logo">
                                  <a rel="nofollow" href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name;?>" target="_blank">
                                    <?php if(!empty($n->Image)){?>
                                        <img src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),174,174,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="<?php echo $n->Name?>" />
                                    <?php }else{ ?>
                                     <img src="images/no-image2.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>

                                  </a>
                               </div>
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div class="giasu_info">
                                    <a rel="nofollow" href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>" class="giasu_name"><?php echo $n->Name ?></a>
                                    <div title="#" class="giasu_titleview"><span>Gia sư:</span><?php
                                    $search=array('Gia sư',' ,');
                                    $replace=array('',', ');
                                    $subject=$n->TitleView;
                                    echo str_replace($search,$replace,$subject);

                                    ?><a rel="nofollow"><?php echo $n->CityName ?></a></div>
                                    <span class="giasu_luong"><span><?php if(intval($n->Free)>0){echo "Từ ".number_format($n->Free)." vnđ/buổi";}else{echo "Thỏa thuận";}  ?></span></span>
                                    <p><?php
                                        $gn_text=$n->Description;
                                                if ( strlen( $n->Description ) > 175 ) {
                            						   $gn_text = substr( $n->Description, 0, 175 );
                            						   $space   = strrpos( $gn_text, ' ' );
                            						   $gn_text = substr( $gn_text, 0, $space ). '...';
                            					  }
                                                echo $gn_text ;
                                     ?></p>
                                </div>
                            </div>
                        </div>
                  <?php
                     } }
                    ?>
                </div>
                <div class="clearfix" style="overflow: hidden;">
            		 <div class="col-md-3 col-sm-12 padd-0"></div>
                     <div class="col-md-9 col-sm-12">
                        <div class="pagation">
                        <?php echo $pagination; ?>
                        </div>
                     </div>
                 </div>
            </div>
            <div class="col-md-30 col-sm-12 col-right-search padd-l-0">
                <div class="box_job_search user">
        	        <h3><i class="fa fa-userl"></i> Gia sư tiêu biểu</h3>
                    <div class="boxfeature">
                        <?php if(!empty($chude)){
                            foreach($chude as $n){ ?>
                            <div class="itemfeature">
                                <div class="feature-icon">
                                    <?php if(!empty($n->Image)){?>
                                        <img src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),174,174,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="<?php echo $n->Name?>"/>
                                    <?php }else{ ?>
                                     <img src="images/no-image2.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>
                                </div>
                                <div class="feature-caption">
                                    <a rel="nofollow" href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name; ?>" class="feature_name"><?php echo $n->Name ?></a>
                                    <div title="#" class="feature_titleview"><span>Gia sư:</span><?php
                                    echo str_replace('Gia sư','',$n->TitleView);

                                    ?><a rel="nofollow"><?php echo $n->CityName ?></a></div>
                                    <span class="feature_luong">Từ: <span><?php echo number_format($n->Free)." vnđ/buổi" ?></span></span>
                                </div>
                            </div>
                         <?php   }
                        } ?>
                    </div>
                 </div>
                <div class="box_job_search tagwork uvonline">
                    <h3>Gia sư đang online
                    </h3>
                    <div class="formtagwork">
                        <div class="col-md-8 col-sm-12 padd-l-0 padd-r-5">
                            <input placeholder="Nhập từ khóa" id="keyworktag" aria-label="từ khóa tìm gia sư" />
                        </div>
                        <div class="col-md-4 col-sm-12 padd-0">
                            <select id="tag_city" class="city_ab_tag" name="tag_city" aria-label="tag">
                                <option data-tokens="0" value="">Tỉnh thành</option>
                                <option data-tokens="1" value="1">Hà Nội</option>
                                <option data-tokens="45" value="45">Hồ Chí Minh</option>
                                <option data-tokens="49" value="49">An Giang</option>
                                <option data-tokens="47" value="47">Bà Rịa Vũng Tàu</option>
                                <option data-tokens="3" value="3">Bắc Giang</option>
                                <option data-tokens="4" value="4">Bắc Kạn</option>
                                <option data-tokens="50" value="50">Bạc Liêu</option>
                                <option data-tokens="5" value="5">Bắc Ninh</option>
                                <option data-tokens="52" value="52">Bến Tre</option>
                                <option data-tokens="46" value="46">Bình Dương</option>
                                <option data-tokens="51" value="51">Bình Phước</option>
                                <option data-tokens="31" value="31">Bình Thuận</option>
                                <option data-tokens="30" value="30">Bình Định</option>
                                <option data-tokens="53" value="53">Cà Mau</option>
                                <option data-tokens="48" value="48">Cần Thơ</option>
                                <option data-tokens="6" value="6">Cao Bằng</option>
                                <option data-tokens="34" value="34">Gia Lai</option>
                                <option data-tokens="10" value="10">Hà Giang</option>
                                <option data-tokens="11" value="11">Hà Nam</option>
                                <option data-tokens="35" value="35">Hà Tĩnh</option>
                                <option data-tokens="9" value="9">Hải Dương</option>
                                <option data-tokens="2" value="2">Hải Phòng</option>
                                <option data-tokens="56" value="56">Hậu Giang</option>
                                <option data-tokens="8" value="8">Hòa Bình</option>
                                <option data-tokens="12" value="12">Hưng Yên</option>
                                <option data-tokens="28" value="28">Khánh Hòa</option>
                                <option data-tokens="57" value="57">Kiên Giang</option>
                                <option data-tokens="36" value="36">Kon Tum</option>
                                <option data-tokens="14" value="14">Lai Châu</option>
                                <option data-tokens="29" value="29">Lâm Đồng</option>
                                <option data-tokens="15" value="15">Lạng Sơn</option>
                                <option data-tokens="13" value="13">Lào Cai</option>
                                <option data-tokens="58" value="58">Long An</option>
                                <option data-tokens="17" value="17">Nam Định</option>
                                <option data-tokens="37" value="37">Nghệ An</option>
                                <option data-tokens="16" value="16">Ninh Bình</option>
                                <option data-tokens="38" value="38">Ninh Thuận</option>
                                <option data-tokens="18" value="18">Phú Thọ</option>
                                <option data-tokens="39" value="39">Phú Yên</option>
                                <option data-tokens="40" value="40">Quảng Bình</option>
                                <option data-tokens="41" value="41">Quảng Nam</option>
                                <option data-tokens="42" value="42">Quảng Ngãi</option>
                                <option data-tokens="19" value="19">Quảng Ninh</option>
                                <option data-tokens="43" value="43">Quảng Trị</option>
                                <option data-tokens="59" value="59">Sóc Trăng</option>
                                <option data-tokens="20" value="20">Sơn La</option>
                                <option data-tokens="61" value="61">Tây Ninh</option>
                                <option data-tokens="21" value="21">Thái Bình</option>
                                <option data-tokens="22" value="22">Thái Nguyên</option>
                                <option data-tokens="44" value="44">Thanh Hóa</option>
                                <option data-tokens="27" value="27">Thừa Thiên Huế</option>
                                <option data-tokens="60" value="60">Tiền Giang</option>
                                <option data-tokens="62" value="62">Trà Vinh</option>
                                <option data-tokens="23" value="23">Tuyên Quang</option>
                                <option data-tokens="63" value="63">Vĩnh Long</option>
                                <option data-tokens="24" value="24">Vĩnh Phúc</option>
                                <option data-tokens="25" value="25">Yên Bái</option>
                                <option data-tokens="26" value="26">Đà Nẵng</option>
                                <option data-tokens="32" value="32">Đắk Lắk</option>
                                <option data-tokens="33" value="33">Đắk Nông</option>
                                <option data-tokens="7" value="7">Điện Biên</option>
                                <option data-tokens="55" value="55">Đồng Nai</option>
                                <option data-tokens="54" value="54">Đồng Tháp</option>
                        </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="list_workonline">
                        <?php if(!empty($lstonline)){
                            foreach($lstonline as $n){ ?>
                            <div class="item-uv-online">
                              <div class="item-uv-name"><a style="color:#069d86;font-weight: bold;" rel="nofollow"href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>"><?php echo $n->Name ?> </a><span><span>Từ:</span> <?php echo number_format($n->Free)." vnđ/buổi" ?></span></div>
                                <div class="item-uv-name"><?php echo $n->TitleView;?><span><span>Hình thức: </span><?php echo GetLearnType($n->WorkID);?></span></div>
                                <div class="item-uv-online-chat">
                                    <span class="uvonline-chat">Chat với gia sư</span>

                                </div>
                            </div>
                            <?php }
                        } ?>

                    </div>
            </div>
                <div class="box_job_search topkeyword">
                            <h3 class="title2"> <i class="fa fa-key"></i> Top từ khóa
                            </h3>
                            <div class="listtag">
                                <ul>
                                                                        <li><a rel="nofollow" title="gia sư lớp 12">Gia sư lớp 12</a></li>
                                                                        <li><a rel="nofollow"  title="gia sư toán">Gia sư toán</a></li>
                                                                        <li><a rel="nofollow" title="gia sư lớp 12">Gia sư lớp 12</a></li>
                                                                        <li><a rel="nofollow"  title="gia sư toán">Gia sư toán cấp 3</a></li>
                                                                        <li><a rel="nofollow" title="gia sư lớp 12">Gia sư tiếng Anh</a></li>
                                                                        <li><a rel="nofollow"  title="gia sư toán">Gia sư toán cấp 2</a></li>
                                                                        <li><a rel="nofollow" title="gia sư lớp 12">Gia sư luyện thi đại học</a></li>
                                                                        <li><a rel="nofollow"  title="gia sư toán">Gia sư tiếng việt</a></li>
                                                                        <li><a rel="nofollow" title="gia sư lớp 12">Gia sư toán cấp 1</a></li>
                                                                        <li><a rel="nofollow"  title="gia sư toán">Gia sư toán cấp 3</a></li>
                                                                    </ul>
                            </div>
                </div>
            </div>
        </div>
        <?php

          if(!empty($linkSubject)){
            ?>
            <div class="tit_hd headertt">
               <h2><img src="images/ic_cn.png" alt="Gia sư theo môn học"><span>Gia sư theo môn học</span></h2>
            </div>
            <div class="main_cn">
               <ul style="min-height:50px;list-style:none;">
                 <?php
                   foreach ($linkSubject as  $valuelinksubject) {
                     ?>
                     <li class="col-md-3 padd-0 col-sm-12">

                     <?php
                     echo $valuelinksubject;
                      ?>
                      </li>
                     <?php
                   }
                  ?>

               </ul>
             </div>
            <?php

          }

         ?>
         <?php
         if(!empty($linkClass)){
           ?>
           <div class="tit_hd headertt">
              <h2><img src="images/ic_cn.png" alt="Gia sư theo lớp học"><span>Gia sư theo lớp học</span></h2>
           </div>
           <div class="main_cn">
              <ul style="min-height:50px;list-style:none;">
                <?php
                  foreach ($linkClass as  $valuelinkclass) {
                    ?>
                    <li class="col-md-3 padd-0 col-sm-12">

                    <?php
                    echo $valuelinkclass;
                     ?>
                     </li>
                    <?php
                  }
                 ?>

              </ul>
            </div>
           <?php

         }
          ?>

          <?php
          if(!empty($linkCity)){
            ?>
            <div class="tit_hd headertt">
               <h2><img src="images/ic_cn.png" alt="Gia sư theo tỉnh thành"><span>Gia sư theo tỉnh thành</span></h2>
            </div>
            <div class="main_cn">
               <ul style="min-height:50px;list-style:none;">
                 <?php
                   foreach ($linkCity as  $valuelinkclass) {
                     ?>
                     <li class="col-md-3 padd-0 col-sm-12">

                     <?php
                     echo $valuelinkclass;
                      ?>
                      </li>
                     <?php
                   }
                  ?>

               </ul>
             </div>
            <?php

          }
           ?>
    </div>
 </section>
 <script src="javascript/jquery.slimscroll.min.js" type="text/javascript"></script>
 <script>
	$(document).ready(function() {
	    var configulr='<?php echo site_url() ?>';
        $('.list_workonline').slimscroll({
          height: '700'

        });
        $('#tag_city').select2();
        $('#slkbox').select2({minimumResultsForSearch: -1});
        $("#keyworktag").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
           $.ajax(
              {

                  url: configulr+"/site/ajaxlstteacher",
                  type: "POST",
                  data: { keytag:$("#keyworktag").val(),city:$('#tag_city').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                            $(".list_workonline div").remove();
                            $(".list_workonline").append(reponse.data);
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
    $('#tag_city').change(function () {
            var cityval=$(this).val();
            if(cityval != '' || cityval !=0){
               $.ajax(
              {

                  url: configulr+"/site/ajaxlstteacher",
                  type: "POST",
                  data: { keytag:$("#keyworktag").val(),city:cityval },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                            $(".list_workonline div").remove();
                          /*$("#list_workonline").innerHTML = reponse.data;*/
                            $(".list_workonline").append(reponse.data);


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
            $('#slkbox').change(function(){
                var url=$(this).val();
                window.location.href=url;
            })
$('[data-toggle="tooltip"]').tooltip();
$('.viewallnganhnghe').on('click',function(){

        if($('.catmore ul').hasClass("rutgon"))
        {
            $('.catmore ul').removeClass("rutgon").addClass('fullcat');
            $('.viewallnganhnghe i').removeClass("fa-angle-down").addClass('fa-angle-up');
        }
        else if($('.catmore ul').hasClass("fullcat")){
            $('.catmore ul').removeClass("fullcat").addClass('rutgon');
            $('.viewallnganhnghe i').removeClass("fa-angle-up").addClass('fa-angle-down');
        };
    });
	})
    </script>
