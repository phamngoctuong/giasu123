<?php
$urlgiasu='0';
$CI=&get_instance();
$CI->load->model('site/site_model');
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
    if($tg['Type']==0){
      $an = "";
    }else if($tg['Type'] == 1){
      $an = "display:none";

    }else if($tg['Type'] == 3){
      $an = "display:none";
    }else if($tg['Type']==4){
      $an = "display:none";
    }
    }
    $userid=$tg['UserId'];
    $kq=$CI->site_model->countclassnotteacherbyuserid($userid);
    $trace="users_".$item->UserID;
    $expiry = 20;
    $lionel = "";
    $logpoint=$CI->site_model->getlogpoint($userid,$trace);
    if (isset($_SESSION['lasttime']) && (time() - $_SESSION['lasttime'] > $expiry)) {
        $logpoint = "";
        $lionel = "lionel";
    }
    $_SESSION['lasttime'] = time();
    // lionel 17
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
                    <?php if(!empty($item->Image)){?>
                                        <img class="img-responsive" src="<?= gethumbnail(geturlimageAvatar(strtotime($item->CreateDate)).$item->Image,$item->Image,strtotime($item->CreateDate),180,180,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="<?echo $item->TitleView?>" />
                                    <?php }else{ ?>
                                     <img class="img-responsive" src="images/no-image2.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>
                </div>
            </div>
            <div class="col-md-10 col-sm-12 padd-l-10">
                <div class="detailjob-header">
                    <div class="detailjob-info col-md-8 col-sm-12 padd-l-0">
                        <h1 class="detailjob-name"><a><?php echo $item->Name; ?></a></h1>
                        <div class="detailjob-cty teacher"><a rel="nofollow"href=""><?php $search=' ,';$replace=', ';$subject=$item->TitleView;echo str_replace($search,$replace,$subject);
                        ?> </a></div>
                        <div class="detailjob-location teacher"><strong>Khu vực nhận dạy: </strong><?php if(!empty($item->Address)){echo $item->Address;}else{echo $item->Addressu;} ?></div>
                        <div class="detailjob-salary"><strong>Mức học phí: </strong><?php if(intval($item->Free)>0){ echo  "Từ ".number_format($item->Free)." vnđ/buổi"; }else{ echo "Thỏa thuận";}?></div>
                        <div class="detailjob-location teacher"><strong>Hình thức dạy: </strong><?php echo GetLearn($item->WorkID) ?></div>

                    </div>
                    <div class="detailjob-social col-md-4 col-sm-12 teacher">
                        <div class="divbtn" style="text-align: center;margin-bottom:15px;"><span class="btn btndaxacthuc">Đã xác thực</span></div>
                        <p><span class="jobview teacher">Lượt xem: <?php echo number_format($countview); ?></span>
                        <span class="jobview teacher">Ngày cập nhật: <?php echo date('d/m/Y',strtotime($item->CreateDate)) ?></span>
                        </p>
                        <ul>
                          <li>Chia sẻ MXH:</li>
                          <li><a aria-label="facebook" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?=current_url();?>" target="_blank"><i style="color:#3b5998" class="fa fa-facebook-square"></i></a></li>
                          <meta property="og:title" content="<?php echo $item->ClassTitle?>">
                          <meta property="og:description" content="<?php echo $item->DescClass?>">

                          <meta property="og:image:width" content="400" />
                          <meta property="og:image:height" content="300" />
                          <li><a aria-label="facebook" rel="nofollow" href="http://www.twitter.com/share?url=<?=current_url();?>" target="_blank"><i style="color:#1da1f2" class="fa fa-twitter-square"></i></a></li>
                          <li><a aria-label="facebook" rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?=current_url();?>"&title="Gia sư "&summary="<?php echo $item->ClassTitle?>"&source="" target="_blank"><i style="color:#0077b5" class="fa fa-linkedin"></i></a></li>
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
                    <ul class="blockfun">
                        <li class="color-orange">
                            <a class="sendmessenger"><i class="fa fa-chat-white"></i> Gửi tin nhắn</a>
                            <!-- <button type="button" id="sendmessenger"><i class="fa fa-chat-white"></i> Gửi tin nhắn</button> -->
                        </li>

                        <?php if($logpoint ==""){ ?>
                        
                        <?php } ?>
                        <?php if($tg['Type']==1){ ?>
                        <li>
                            <a class="btnluuhosogv"><i class="fa fa-block-download"></i> Lưu hồ sơ</a>
                        </li>
                        <?php } ?>
                        <?php if($kq > 0){ ?>

                        <li style = "<?php echo $an ?>">
                            <a class="btnmoidayngay"><i class="fa fa-uv-upload-small"></i> Mời dạy ngay</a>

                        </li>
                        <?php } ?>
                        <li>
                            <a><i class="fa fa-envelope-o"></i> Gửi email</a>
                        </li>
                    </ul>
                    <div class="detailjob-body">
                        <h3 class="title">Thông tin chung</h3>
                        <div class="detailjob-body1 detailteach">
                            <div class="chiso">1. Giới thiệu chung</div>
                            <p>
                                <?php echo $item->Description ?>
                            </p>
                            <div class="chiso">2. Chủ đề dạy</div>
                            <ul class="topicteach">
                                <?php if(!empty($topic)){
                                 foreach($topic as $n){
                                   if(!empty($n->TopicName)){
                                     ?>
                                      <li><label><?php echo $n->TopicName ?></label></li>
                                  <?php }
                                   }
                                }?>
                            </ul>
                            <div class="chiso">3. Kiểu giáo viên</div>
                            <?php
                            if(!empty(GetTeacherType($item->TeachType))){
                              ?>
                              <ul class="starteach">
                                  <li><label><?php echo GetTeacherType($item->TeachType) ?></label></li>
                              </ul>
                              <?php
                            }
                             ?>
                        </div>
                        <div class="clr"></div>
                        <h3 class="title">Kinh nghiệm</h3>
                        <div class="detaijob-body2">
                            <p><?php if(!empty($item->Exp)){ echo $item->Exp;}else{echo "Chưa cập nhật";} ?></p>
                        </div>
                        <h3 class="title">Thành tích</h3>
                        <div class="detaijob-body2">
                            <p><?php if(!empty($item->Bonus)){ echo $item->Bonus;}else{echo "Chưa cập nhật";} ?></p>
                        </div>
                        <h3 class="title">Buổi có thể dạy</small></h3>
                        <div class="detaijob-body2 lichday">
                             <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                <div>Thứ 2
                                </div>
                                <ul>
                                    <li>
                                        <label class="<?php if($item->MonMorning ==0){ echo""; }else{ echo "active";}?>">Sáng</label>
                                    </li>
                                    <li>

                                        <label class="<?php if($item->MonAfter ==0){ echo""; }else{ echo "active";}?>">Chiều</label>

                                    </li>
                                    <li>
                                        <label class="<?php if($item->MonNight ==0){ echo""; }else{ echo "active";}?>">Tối</label>
                                    </li>
                                </ul>
                             </div>
                             <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                             <div>Thứ 3
                                </div>
                                <ul>
                                    <li>
                                        <label class="<?php if($item->TueMorning ==0){ echo""; }else{ echo "active";}?>">Sáng</label>
                                    </li>
                                    <li>

                                        <label class="<?php if($item->TueAfter ==0){ echo""; }else{ echo "active";}?>">Chiều</label>

                                    </li>
                                    <li>
                                        <label class="<?php if($item->TueNight ==0){ echo""; }else{ echo "active";}?>">Tối</label>
                                    </li>
                                </ul>
                             </div>
                             <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                             <div>Thứ 4
                                </div>
                                <ul>
                                    <li>
                                        <label class="<?php if($item->WeMorning ==0){ echo""; }else{ echo "active";}?>">Sáng</label>
                                    </li>
                                    <li>

                                        <label class="<?php if($item->WeAfter ==0){ echo""; }else{ echo "active";}?>">Chiều</label>

                                    </li>
                                    <li>
                                        <label class="<?php if($item->WeNight ==0){ echo""; }else{ echo "active";}?>">Tối</label>
                                    </li>
                                </ul>
                             </div>
                             <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                <div>Thứ 5
                                </div>
                                <ul>
                                    <li>
                                        <label class="<?php if($item->ThuMorning ==0){ echo""; }else{ echo "active";}?>">Sáng</label>
                                    </li>
                                    <li>

                                        <label class="<?php if($item->ThuAfter ==0){ echo""; }else{ echo "active";}?>">Chiều</label>

                                    </li>
                                    <li>
                                        <label class="<?php if($item->ThuNight ==0){ echo""; }else{ echo "active";}?>">Tối</label>
                                    </li>
                                </ul>
                             </div>
                             <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                <div>Thứ 6
                                </div>
                                <ul>
                                    <li>
                                        <label class="<?php if($item->FriMorning ==0){ echo""; }else{ echo "active";}?>">Sáng</label>
                                    </li>
                                    <li>

                                        <label class="<?php if($item->FriAfter ==0){ echo""; }else{ echo "active";}?>">Chiều</label>

                                    </li>
                                    <li>
                                        <label class="<?php if($item->FriNight ==0){ echo""; }else{ echo "active";}?>">Tối</label>
                                    </li>
                                </ul>
                             </div>
                             <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                <div>Thứ 7
                                </div>
                                <ul>
                                    <li>
                                        <label class="<?php if($item->SatMorning ==0){ echo""; }else{ echo "active";}?>">Sáng</label>
                                    </li>
                                    <li>

                                        <label class="<?php if($item->SatAfter ==0){ echo""; }else{ echo "active";}?>">Chiều</label>

                                    </li>
                                    <li>
                                        <label class="<?php if($item->SatNight ==0){ echo""; }else{ echo "active";}?>">Tối</label>
                                    </li>
                                </ul>
                             </div>
                             <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                <div>Chủ nhật
                                </div>
                                <ul>
                                    <li>
                                        <label class="<?php if($item->SunMorning ==0){ echo""; }else{ echo "active";}?>">Sáng</label>
                                    </li>
                                    <li>

                                        <label class="<?php if($item->SunAfter ==0){ echo""; }else{ echo "active";}?>">Chiều</label>

                                    </li>
                                    <li>
                                        <label class="<?php if($item->SunNight ==0){ echo""; }else{ echo "active";}?>">Tối</label>
                                    </li>
                                </ul>
                             </div>
                        </div>
                    </div>
                    </div>
                    <ul class="blockfun">
                        <li class="color-orange">
                            <a class="sendmessenger"><i  class="fa fa-chat-white"></i> Gửi tin nhắn</a>
                            <!-- <button id="sendmessenger"><i  class="fa fa-chat-white"></i> Gửi tin nhắn</button> -->

                        </li>
                         <?php if($logpoint ==""){ ?>
                      
                        <?php } ?>
                        <?php if($tg['Type']==1){ ?>
                        <li>
                            <a rel="nofollow"class="btnluuhosogv"><i class="fa fa-block-download"></i> Lưu hồ sơ</a>
                        </li>
                        <?php } ?>
                        <?php if($kq > 0){ ?>

                        <li style = "<?php echo $an ?>">

                            <a rel="nofollow"class="btnmoidayngay"><i class="fa fa-uv-upload-small"></i> Mời dạy ngay</a>
                        </li>
                        <?php } ?>
                        <li>
                            <a><i class="fa fa-envelope-o"></i> Gửi email</a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <hr style="border-top:1px dotted #dbdbdb">
                    <div class="detailjob-keywork">
                        <div class="title"><i class="fa fa-keywork-relative"></i> Từ khóa liên quan</div>
                        <ul>
                            <li><a>Gia sư tiếng anh</a></li>
                            <li><a>Gia sư tiếng nhật</a></li>
                            <li><a>Gia sư toán</a></li>
                            <li><a>Gia sư tiếng việt</a></li>
                            <li><a>Luyện thi THPT</a></li>
                            <li><a>Luyện thi đại học</a></li>
                            <li><a>Gia sư toán cấp 3</a></li>
                            <li><a>Tiếng anh chuyên đề</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <hr style="border-top:1px dotted #dbdbdb">
                    <div class="vl_lc detailjobrelative">
                         <div class="tit_hd">
                            <div class="ir_h3">
                               <h3><span>gia sư tương tự</span></h3>
                            </div>
                            <a rel="nofollow"href="" class="span_hd">Xem thêm <img src="images/ic_muiten.png" alt="Gia sư tương tự"/></a>
                         </div>
                         <div class="main_lc">
                            <?php if(!empty($moreteach)){
                              foreach($moreteach as $n){
                                ?>
                                    <div class="item_lc">
                                        <div class="col-md-3 col-sm-12 padd-0">
                                            <div class="giasu_logo">
                                              <a rel="nofollow"href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name; ?>">
                                                <?php if(!empty($n->Image)){?>
                                                    <img src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),174,174,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="<?echo $n->Name ?>" />
                                                <?php }else{ ?>
                                                 <img src="images/no-image2.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                                 <?php } ?>
                                                 <span class="viewnow">Xem hồ sơ</span>
                                              </a>
                                           </div>
                                        </div>
                                        <div class="col-md-9 col-sm-12">
                                            <div class="giasu_info">
                                                <a rel="nofollow"href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name; ?>" class="giasu_name"><?php echo $n->Name ?></a>
                                                <div title="#" class="giasu_titleview"><span>Gia sư:</span><?php
                                                $search=array('Gia sư',' ,');
                                                $replace=array('',', ');
                                                $subject=$n->TitleView;
                                                echo str_replace($search,$replace,$subject);

                                                ?><a><?php echo $n->CityName ?></a></div>
                                                <span class="giasu_luong">Từ: <span><?php echo number_format($n->Free)." vnđ/buổi" ?></span></span>
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
                    </div>
            </div>
            <div class="col-md-30 col-sm-12 col-right-search padd-l-0">
                <div class="box_job_search detailungvien" id="thongtin1">
                <div class="fullname">
                    Thông tin cá nhân
                </div>
                <div class="uvngaysinh">
                    Ngày sinh: <?php if(empty($item->Birth)){echo "01/01/1970";}else{echo date('d/m/Y',strtotime($item->Birth));} ?>
                </div>
                <div class="uvgioitinh">
                   Giới tính: <?php echo GetSex(intval($item->Sex)); ?>
                </div>
                <div class="uvhonnhan">
                    Hôn nhân: Độc thân
                </div>
                <div class="uvdiachi">
                    Địa chỉ: <?php echo $item->Addressu ?>
                </div>
                <div class="uvsodienthoai">
                    SĐT:&nbsp;&nbsp;&nbsp;<span data-val="<?php echo "users_".$item->UserID ?>" data-lionel=<?php echo $lionel; ?> id="txtviewphone" class="btnviewlienhe btnviewcontactinfo"><?php if($logpoint !=""){ echo $item->phoneu;}else{echo "Xem liên hệ";} ?></span>
                    <!-- lionel 18 -->
                </div>
                <div class="uvemail">
                    Email:&nbsp;<span data-val="<?php echo "users_".$item->UserID ?>" id="txtviewemail" class="btnviewlienhe btnviewcontactinfo"><?php if($logpoint !=""){ echo $item->Email;}else{echo "Xem liên hệ";} ?></span>
                </div>
            </div>
                <div class="box_job_search tagwork uvonline">
                    <h3>Gia sư đang online
                    </h3>
                    <div class="formtagwork">
                        <div class="col-md-8 col-sm-12 padd-l-0 padd-r-5">
                            <input placeholder="Nhập từ khóa" id="keyworktag" aria-label="từ khóa " />
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
                <div class="box_job_search user">
        	        <h3><i class="fa fa-userl"></i> Tìm kiếm nâng cao</h3>
        	        <div class="main_sc">
        	        	<form action="" method="post">
        	        		<div class="input">
        		        		<input type="text" name="findkey" id="findkey" placeholder="Nhập từ khóa..." />
        		        	</div>
        		        	<div class="input">
        		        		<span class="icon-before"><img src="images/s_01.png" alt="Chọn môn học"></span>
        						<select id="monhoc" name="monhoc">
        							<option value="">Chọn môn học</option>
                                     <?php
                                    if(!empty($monhoc)){
                                        foreach($monhoc as $n){ ?>
                                            <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                            <?php }
                                        }
                                    ?>
        						</select>
        					</div>
                            <div class="input">
                                <span class="icon-before"><img src="images/s_01.png" alt="Chọn chủ đề môn học"></span>
                                <select id="chudehoc" class="city_ab_tag">
                                    <option value="" >Chọn chủ đề môn học</option>

                                 </select>
                            </div>
        					<div class="input">
        						<span class="icon-before" style="top:8px"><img src="images/s_02.png" alt="Tỉnh thành"></span>
        						<select id="tinhthanh" class="mucluong_ab_tag">
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
        					<div class="input">
        						<span class="icon-before"><img src="images/icongioitinh.png" alt="Giới tính"></span>
        						<select id="gioitinh" class="ngoaingu_ab_tag">
                                    <option value="" ></option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                 </select>
        					</div>
        					<div class="input">
        						<span class="icon-before" style="top:8px"><img src="images/iconhinhthuchoc.png" alt="Chọn hình thức dậy"></span>
        						<select id="hinhthuchoc" class="kinhnghiem_ab_tag">
                                    <option value="">Chọn hình thức dạy</option>
                                    <option value="1">Offline) Gặp mặt</option>
                                    <option value="2">Online) Trực tuyến</option>
                                 </select>
        					</div>
        					<center><input class="btn btnsearchuv" type="button" name="submit" value="Tìm kiếm"></center>
        				</form>
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
          <div class="modal-title"><b>Mời dạy lớp</b></div>
          <input type="hidden" id="txtuserid" name="txtuserid" value="<?php echo $item->UserID ?>" />
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row padd-top-15 padd-bot-5" style="">
                    <div class="col-md-12">
                        <div class="form-group" style="margin:5px auto;">
                            <label class="control-label">Chọn lớp</label>
                            <select id="txtchonlop" name="txtchonlop" class="form-control"></select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="text-align:left;">
            <button type="button" id="btnhuy" class="btn btn-primary btn-warning" data-dismiss="modal" style="padding: 6px 20px;width: 109px;margin-left: 5px;display: inline-block;">Hủy</button>
            <button type="button" class="btn btn-primary btn-success" id="btnmoigiaovien" style="padding: 6px 20px;width: 143px;margin-left: 7px;display: inline-block;">Lưu thay đổi</button>
        </div>
      </div>
    </div>
</div>
 <script src="js/theme6/jquery.slimscroll.min.js" type="text/javascript"></script>
<script>

      var configulr='<?php echo site_url() ?>';
      var namedoitac='<?=$item->Name;?>';
      var userid2='<?=$item->UserID;?>';

      $('#chatbox').hide();
      $(document).ready(function() {


             $('#monhoc').select2({ width: '100%',placeholder:"Chọn môn học" });
             $('#chudehoc').select2({ width: '100%',placeholder: "Chọn chủ đề"});
             $('#gioitinh').select2({ width: '100%',placeholder:"Chọn giới tính" });
             $('#hinhthuchoc').select2({ width: '100%',placeholder:"Chọn hình thức học" });
             $('#tinhthanh').select2({ width: '100%',placeholder:"Chọn tỉnh thành" });
             $('#monhoc').change(function () {
                  var monhoc=$(this).val();
                  if(monhoc != '' || monhoc !=0){
                  $.ajax({
                        url: configulr+"/site/Ajaxchude",
                        type: "POST",
                        data: { idmon: monhoc },
                        dataType: 'json',
                        beforeSend: function () {
                            $("#boxLoading").show();
                        },
                        success: function (obj) {

                           if(obj.kq != ''){
                              var reponse=obj.kq;
                              $("#chudehoc option").remove();
                                  $("#chudehoc").append(obj.data);

                              $("#chudehoc").select2();
                              }else{
                                  /*alert('không tồn tại');*/
                              }
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

              $('.btnsearchuv').on('click',function(){
              var findkey=$('#findkey').val();
              var strsubj=$('#monhoc').val();
              var strtopic=$('#chudehoc').val();
              var strtinhthanh=$('#tinhthanh').val();
              var strgioitinh=$('#gioitinh').val();
              var strtype=$('#hinhthuchoc').val();

              $.ajax(
                    {
                        url: configulr+"/site/searchteacher",
                        type: "POST",
                        data: { key:findkey,subject:strsubj,topic:strtopic,place:strtinhthanh,type:strtype,sex:strgioitinh },
                        dataType: 'json',
                        beforeSend: function () {
                            $("#boxLoading").show();
                        },
                        success: function (reponse) {
                            if (reponse.kq == true) {
                                window.location=reponse.data;
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
          $('.btnluuhosogv').on('click',function(){
              $.ajax(
                    {

                        url: configulr+"/site/ajaxusersaveuser",
                        type: "POST",
                        data: { giaovien:$('#txtuserid').val() },
                        dataType: 'json',
                        beforeSend: function () {
                            $("#boxLoading").show();
                        },
                        success: function (reponse) {
                            if (reponse.kq == true) {
                                alert(reponse.data);
                            }else{
                              alert('Thất bại, bạn vui lòng kiểm tra lại');
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
          $('.btnviewcontactinfo').on('click',function(){
              var trace = $(this).data('val');
              var lionel = $(this).data('lionel');
              $.ajax(
                    {
                        url: configulr+"/site/ajaxviewcontactinfo",
                        type: "POST",
                        data: { keyview:trace,lionel: lionel},
                        // lionel 19
                        dataType: 'json',
                        beforeSend: function () {
                            $("#boxLoading").show();
                        },
                        success: function (reponse) {
                            if (reponse.kq == true) {
                                $('span[id=txtviewphone]').text(reponse.obj.phone1);
                                $('span[id=txtviewemail]').text(reponse.obj.email);
                            }else{
                              alert(reponse.data);
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
          $('#btnmoigiaovien').on('click',function(){
              if($('#txtchonlop').val()!=''){
                  $.ajax(
                    {

                        url: configulr+"/site/ajaxaddclassvsusers",
                        type: "POST",
                        data: { lophoc:$('#txtchonlop').val(),giaovien:$('#txtuserid').val() },
                        dataType: 'json',
                        beforeSend: function () {
                            $("#boxLoading").show();
                        },
                        success: function (reponse) {
                            if (reponse.kq == true) {
                                $('#myModal').modal('hide');
                                alert(reponse.data);
                            }

                        },
                        error: function (xhr) {
                            alert("error");
                        },
                        complete: function () {
                            $("#boxLoading").hide();
                        }
                    });
              }else{
                  alert('Bạn phải chọn lớp');
              }
          });
          $('.btnmoidayngay').on('click',function(){
              $.ajax({

                        url: configulr+"/site/ajaxgetclassnotteacherbyuserid",
                        type: "POST",
                        data: { },
                        dataType: 'json',
                        beforeSend: function () {
                            $("#boxLoading").show();
                        },
                        success: function (reponse) {
                            if (reponse.kq == true) {
                                $('#txtchonlop').append(reponse.data);
                                $('#myModal').modal('show');
                            }else{
                              alert('Bạn không còn lớp học trống để mời gia sư');
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
             $('.list_workonline').slimscroll({
                height: '500'
              });
              $('#tag_city').select2();
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
                      }
                  });
          });
      </script>
