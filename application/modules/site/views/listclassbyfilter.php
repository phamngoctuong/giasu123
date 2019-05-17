<div class="container">
    <?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-top-30 padd-bot-30">
    <div class="container">
        <div class="row">
            <div class="col-md-70 col-sm-12">
               <div class="titlesearch">
                   <h1 class="vltg"><i class="fa fa-uv-newsest"></i> <span><?php
                   if(!empty($classname)){
                     if(!empty($subjectname) && !empty($cityname)){
                       echo 'Tổng hợp tin tuyển gia sư dạy kèm '.$subjectname.' '.$classname.' tại '.$cityname.' mới nhất';
                     }elseif (!empty($subjectname)) {
                       echo 'Tổng hợp tin tuyển gia sư dạy kèm '.$subjectname.' '.$classname.' mới nhất';
                     }elseif (!empty($cityname)) {
                       echo 'Tổng hợp tin tuyển gia sư dạy kèm '.$classname.' tại '.$cityname.' mới nhất';
                     }else{
                       echo 'Tổng hợp tin tuyển gia sư dạy kèm '.$classname.' mới nhất';
                     }
                   }else{
                     if(!empty($subjectname) && !empty($cityname)){
                       echo 'Tổng hợp tin tuyển gia sư dạy kèm '.$subjectname.' tại '.$cityname.' mới nhất';
                     }elseif (!empty($subjectname)) {
                       echo 'Tổng hợp tin tuyển gia sư dạy kèm '.$subjectname.' mới nhất';
                     }elseif (!empty($cityname)) {
                       echo 'Tổng hợp tin tuyển gia sư dạy kèm tại '.$cityname.' mới nhất';
                     }
                   }
                    ?></span></h1>
                </div>
                <div class="main_itg">
                    <?php
                        if(!empty($lstitem)){
                            foreach($lstitem as $n){ if($n->dongyday ==0){ ?>
                                <div class="itemnews">
                                    <div class="itemnews_l">
                                        <a rel="nofollow" class="logouser">
                                        <?php if(!empty($n->Image)){?>
                                        <img src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),63,63,100) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' alt="no image" />
                                    <?php }else{ ?>
                                     <img src="images/no-image2.png" alt="no image" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                     <?php } ?>
                                     </a>
                                        <a rel="nofollow" href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" class="nameu" title="<?php echo $n->Name ?>"><?php echo $n->Name ?></a>
                                        <span><?php echo date("d/m/Y",strtotime($n->CreateDate)); ?></span>
                                    </div>
                                    <div class="itemnews_r">
                                        <a rel="nofollow" target="_blank" href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" class="item-uv-name" tabindex="0"><i class="fa fa-online"></i> <?php echo $n->ClassTitle ?> </a>
                                        <p><?php $gn_text=$n->DescClass;
                                                if ( strlen( $n->DescClass ) > 250 ) {
                            						   $gn_text = substr( $n->DescClass, 0, 250 );
                            						   $space   = strrpos( $gn_text, ' ' );
                            						   $gn_text = substr( $gn_text, 0, $space ). '...';
                            					  }
                                                echo $gn_text ;  ?></p>
                                                <?php if(intval($n->Money)>0){ ?>
                                        <span class="btn btn-freelance"><?php echo number_format($n->Money)." vnđ/buổi" ?></span>
                                        <?php }else{ ?>
                                        <span class="btn btn-freelance">Thỏa thuận</span>
                                        <?php } ?>
                                        <span class="btn"><?php $tg=explode(',',$n->LearnType);
                                            echo GetLearnType($tg[0]);
                                        ?></span>
                                        <span class="btn"><?php echo Getcitybyindex($n->City) ?></span>
                                        <span class="xacthuc"><i class="fa fa-shield" data-toggle="tooltip" data-placement="top" title="Phụ huynh đã xác thực"></i><i class="fa fa-uv-chat-cam"></i></span>
                                        <span class="dadenghiday">Đã đề nghị dạy:&nbsp;&nbsp;<?php echo $n->denghiday  ?><i class="fa fa-user-dnd"></i></span>
                                    </div>
                                </div>
                            <?php } }
                        }else{
                            echo "<div class='col-md-12'>Không tìm thấy bản ghi.</div>";
                        }
                    ?>


                </div>
                <div class="home_camnang catmore box24h">
                  <?php

                    if(!empty($linkSubject)&&!empty($titleSubject)){
                      ?>
                      <div class="tit_hd headertt">
                         <h2><img src="images/ic_cn.png" alt="<?php echo $titleSubject ?>"><span><?php echo $titleSubject ?></span></h2>
                      </div>
                      <div class="main_cn">
                         <ul style="min-height:50px;">
                           <?php
                             foreach ($linkSubject as  $valuelinksubject) {
                               ?>
                               <li class="col-md-4 padd-0 col-sm-12">

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
                   if(!empty($linkClass)&&!empty($titleClass)){
                     ?>
                     <div class="tit_hd headertt">
                        <h2><img src="images/ic_cn.png" alt="<?php echo $titleClass ?>"><span><?php echo $titleClass ?></span></h2>
                     </div>
                     <div class="main_cn">
                        <ul style="min-height:50px;">
                          <?php
                            foreach ($linkClass as  $valuelinkclass) {
                              ?>
                              <li class="col-md-4 padd-0 col-sm-12">

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
                    if(!empty($linkCity)&&!empty($titleCity)){
                      ?>
                      <div class="tit_hd headertt">
                         <h2><img src="images/ic_cn.png" alt="<?php echo $titleCity ?>"><span><?php echo $titleCity ?></span></h2>
                      </div>
                      <div class="main_cn">
                         <ul style="min-height:50px;">
                           <?php
                             foreach ($linkCity as  $valuelinkclass) {
                               ?>
                               <li class="col-md-4 padd-0 col-sm-12">

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
                <div class="clearfix" style="height:20px"></div>
                <div class="row timkiemungvien">
                    <div class="col-md-6 padd-r-5">
                        <div class="box-f box-document">
                                            <h3 class="title">Gửi email cho ứng viên</h3>
                                            <ul>
                                                <li>Kết nối, tuyển dụng và quản lý nhân tài</li>
                                                <li>Talent Solution - Giải pháp tuyển dụng toàn diện dành cho doanh nghiệp được sáng tạo độc quyền bởi timviec365.vn</li>
                                            </ul>
                                            <span class="btnuvboxcreatedocument">Gửi email ngay</span>
                                        </div>
                    </div>
                    <div class="col-md-6 padd-l-5">
                        <div class="box-f box-adsrecruit">
                                             <h3 class="title">Quảng bá tuyển dụng</h3>
                                            <ul>
                                                <li>Tạo sự khác biệt cho thương hiệu Công ty</li>
                                                <li>Thông tin tuyển dụng của bạn sẽ nổi bật hơn nhờ nội dung đăng tuyển được thiết kế hấp dẫn nhấn mạnh văn hóa và thương hiệu Công ty</li>
                                            </ul>
                                            <span class="btnuvboxcruit">Quảng bá ngay</span>
                                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-30 col-sm-12 col-right-search padd-l-0">
                <div class="box_job_search user">
        	        <h2><i class="fa fa-userl"></i> Tìm kiếm lớp dạy</h2>
        	        <div class="main_sc">
        	        	<form action="" method="post">
        	        		<div class="input">
        		        		<input value="<?php echo $keyfilter['keywork'] ?>" type="text" name="findkey" id="findkey" placeholder="Nhập từ khóa..." />
        		        	</div>
        		        	<div class="input">
        		        		<span class="icon-before"><img src="images/s_01.png" alt="Tìm kiếm theo môn học"></span>
        						<select id="monhoc" name="monhoc">
        							<option value="">Chọn môn học</option>
                                     <?php
                                    if(!empty($monhoc)){
                                        foreach($monhoc as $n){
                                            if($n->ID == $keyfilter['subject']){
                                            ?>
                                            <option selected="selected" value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                            <?php } }
                                        }
                                    ?>
        						</select>
        					</div>
                            <div class="input">
                                <span class="icon-before"><img src="images/s_01.png" alt="Tìm kiếm theo chủ đề môn học"></span>
                                <select id="chudehoc" class="city_ab_tag">
                                    <option value="" >Chọn chủ đề môn học</option>

                                 </select>
                            </div>
        					<div class="input">
        						<span class="icon-before" style="top:8px"><img src="images/s_02.png" alt="Tìm kiếm theo tỉnh thành"></span>
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
        						<span class="icon-before"><img src="images/icongioitinh.png" alt="Tìm kiếm theo giới tính"></span>
        						<select id="gioitinh" class="ngoaingu_ab_tag">
                                    <option value="" ></option>
                                    <option <?php if($keyfilter['sex']==1){?> selected="selected" <?php } ?> value="1" >Nam</option>
                                    <option <?php if($keyfilter['sex']==2){?> selected="selected" <?php } ?> value="2">Nữ</option>
                                 </select>
        					</div>
        					<div class="input">
        						<span class="icon-before" style="top:8px"><img src="images/iconhinhthuchoc.png" alt="Chọn hình thức học"></span>
        						<select id="hinhthuchoc" class="kinhnghiem_ab_tag">
                                    <option value="">Chọn hình thức dạy</option>
                                    <option <?php if($keyfilter['type']==1){?> selected="selected" <?php } ?> value="1">(Offline) Gặp mặt</option>
                                    <option <?php if($keyfilter['type']==2){?> selected="selected" <?php } ?> value="2">(Online) Trực tuyến</option>
                                 </select>
        					</div>
        					<center><input class="btn btnsearchuv" type="button" name="submit" value="Tìm kiếm"></center>
        				</form>
        		    </div>
        	    </div>
                <div class="box_job_search tagwork uvonline">
                    <h2>Phụ huynh, học viên đang online
                    </h2>
                    <div class="formtagwork">
                        <div class="col-md-8 col-sm-12 padd-l-0 padd-r-5">
                            <input placeholder="Nhập từ khóa tìm lớp" id="keyworktag" />
                        </div>
                        <div class="col-md-4 col-sm-12 padd-0">
                            <select id="tag_city" class="city_ab_tag">
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
                                <div class="item-uv-onlien-job"><a rel="nofollow" href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>"><i class="fa fa-online"></i> <?php echo $n->ClassTitle ?></a></div>
                                <div class="item-uv-name"><a rel="nofollow" href="">Học phí: <?php echo number_format($n->Money)." vnđ/buổi" ?> </a><span><span>Địa điểm:</span> <?php echo Getcitybyindex($n->City); ?></span></div>
                                <div class="item-uv-online-chat">
                                    <span class="uvonline-chat"><i class="fa fa-chat" ></i> Chat với phụ huynh</span>
                                    <span class="uvonline-kinhnghiem"><span>Hình thức: </span><?php $tg=explode(',',$n->LearnType);
                                                    echo GetLearnType($tg[0]);
                                                ?></span>
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
    </div>

    <?php if(!empty($linkseo)){ ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 linkseo">
              <div id="muc-luc-content-thu">
                <div id="tieudemucluc" style="text-align:center;">

                </div>
                  <ul id="content-mucluc">

                  </ul>
                </div>
                <div name="content-thu" id="content-thu">
                    <?php echo $linkseo->htmltext; ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</section>
<script src="js/theme6/jquery.slimscroll.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
	   var configulr='<?php echo site_url(); ?>';
	   $('.list_workonline').slimscroll({
          height: '670'

        });


       $('#monhoc').select2({ width: '100%',placeholder:"Chọn môn học" });
       $('#chudehoc').val('<?php echo $keyfilter['topic']  ?>').select2({ width: '100%',placeholder: "Chọn chủ đề"});
       $('#gioitinh').select2({ width: '100%',placeholder:"Chọn giới tính" });
       $('#hinhthuchoc').select2({ width: '100%',placeholder:"Chọn hình thức học" });
       $('#tag_city').select2();
       $('#monhoc').change(function () {
            var monhoc=$(this).val();
            if(monhoc != '' || monhoc !=0){
                    $.ajax(
              {

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
       $('#tinhthanh').val('<?php echo $keyfilter['place']  ?>').select2({ width: '100%',placeholder:"Chọn tỉnh thành" });
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
    $("#keyworktag").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
           $.ajax(
              {

                  url: configulr+"/site/ajaxlstclass",
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

                  url: configulr+"/site/ajaxlstclass",
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
$('[data-toggle="tooltip"]').tooltip();
});
</script>
