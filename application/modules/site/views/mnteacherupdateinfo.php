<?php
$CI=&get_instance();
$CI->load->model('site/site_model');
$ui=$_SESSION['UserInfo'];
// pr($ui);
?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left'); ?>
        </div>
        <?php if($ui['Type']==1){ ?>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right " style="min-height:300px;">
                <div class="clr" style="height:10px;position: relative;"><a class="btnlogout"><i class="fa fa-logout"></i> Thoát</a></div>
                <div class="clr" style="height:50px;"></div>
                <div class="col-md-12">
                  <?php if(empty($ui['EmailAddress'])){
                    ?>
                      <div class="thong-bao-dien-thong-tin">* <?php echo $mess ?></div>
                    <?php
                  } ?>
                <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc">
                    <div class="row">
                        <div class="col-md-12 batbuoc">
                            <h4><i class="fa fa-plus-circle"></i> Thông tin cá nhân</h4>

                        </div>
                    </div>
                    <form enctype="multipart/form-data">
                    <div class="col-md-12">
                            <label  class="required">Họ tên</label>
                            <div class="form-control ">
                                <input type="text" placeholder="Vui lòng nhập họ tên" id="txthoten" value="<?php echo $info->Name ?>">
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <label>Ảnh đại diện</label>
                                    <div class="form-control">
                                        <input accept="image/x-png,image/gif,image/jpeg" type="file" name="danhdaidien" id="danhdaidien" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
        					               <label for="danhdaidien"><strong> Chọn tệp</strong> <span>không có file nào được chọn</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php if(!empty($info->Image)){
                                        $tg=explode('-',date('d-m-Y',strtotime($info->CreateDate)));

                                        ?>
                                    <img src="upload/users/thumb/<?php echo $tg[2]."/".$tg[1]."/".$tg[0]."/".$info->Image  ?>" width="60px" height="60px"/>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label>Ảnh CMND, thẻ sinh viên hoặc bằng cấp chuyên môn cao nhất <span>(để tăng sự tin tưởng của học viên với bạn)</span></label>
                                    <div class="form-control">
                                        <input accept="image/x-png,image/gif,image/jpeg" type="file" name="anhcmnd" id="anhcmnd" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
        					               <label for="anhcmnd"><strong> Chọn tệp</strong> <span>không có file nào được chọn</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php if(!empty($info->ImgPassport)){
                                        $tg=explode('-',date('d-m-Y',strtotime($info->CreateDate)));

                                        ?>
                                    <img src="upload/users/thumb/<?php echo $tg[2]."/".$tg[1]."/".$tg[0]."/".$info->ImgPassport  ?>" width="60px" height="60px"/>
                                    <?php } ?>
                                </div>
                            </div>

                            <label class="required">Ngày tháng năm sinh</label>
                            <div class='input-group date' id='datetimepicker1' style="width: 100%">
                                    <input type='text' placeholder="Ngày sinh" id="txtngaysinh" class="form-control" value="<?php echo date('d-m-Y',strtotime($info->Birth)) ?>" />
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                            </div>
                            <div class="form-inline">
                                <label style="margin-right:30px;">Giới tính: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" <?php if($info->Sex==1){ ?> checked="checked" <?php } ?> name="location1" id="location1" type="radio">
                                    <label for="location1">Nam</label>
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2"  <?php if($info->Sex==2){ ?> checked="checked" <?php } ?>  name="location1" id="location2" type="radio">
                                    <label for="location2">Nữ</label>
                                </div>
                            </div>
                            <label class="required">Email</label>
                            <div class="form-control" style="width: 100%">
                              <input type="text" name="email"  placeholder="Email" required="" id="email" value="<?php if(!empty($info->Email))echo $info->Email; ?>">
                            </div>
                            <label>Nơi ở hiện tại</label>
                            <div class="form-control">
                                <input type="text" value="<?php echo $info->Address ?>" placeholder="Vui lòng nhập chi tiết nơi ở hiện tại" id="txtnoiohientai">
                            </div>
                            <label class="required">Hiện tại là</label>
                            <div class="form-control">
                                <select id="txtteachtype" name="txtteachertype">
                                    <option value="">Lựa chọn gia sư</option>
                                    <?php
                                        if(!empty($teachtype)){
                                            foreach($teachtype as $n){
                                                if($n->ID == intval($info->TeachType)){
                                                ?>
                                        <option selected="selected" value="<?php echo $n->ID ?>"><?php echo $n->NameType ?></option>
                                    <?php }else{ ?>
                                        <option value="<?php echo $n->ID ?>"><?php echo $n->NameType ?></option>
                                    <?php } }
                                        }
                                    ?>
                                </select>
                            </div>
                            <label class="required">Học trường</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập trường học của bạn" id="txtschool" value="<?php echo $info->School ?>">
                            </div>
                            <label>Chuyên ngành</label>
                            <div class="form-control">
                                <input type="text" placeholder="Chuyên ngành học" id="txtmajor" value="<?php echo $info->Major ?>">
                            </div>
                            <label>Năm tốt nghiệp</label>
                            <div class="form-control">
                                <input type="text" placeholder="Năm tốt nghiệp" id="txtGraduationyear" value="<?php echo $info->Graduationyear ?>">
                            </div>
                            <label>Nơi công tác <span>(nếu đã đi làm)</span></label>
                            <div class="form-control">
                                <input type="text" placeholder="Nơi công tác" id="txtworkplace" value="<?php echo $info->Workplace ?>">
                            </div>
                            <div class="clearfix"></div>
                            <label>Kinh nghiệm đi dạy</label>
                            <div class="">
                                <textarea id="kinhnghiem" name="kinhnghiem" placeholder="Chi tiết nội dung" rows="5" cols="30"><?php echo $info->Exp ?></textarea>
                            </div>
                            <label>Thành tích</label>
                            <div class="">
                                <textarea id="thanhtich" name="thanhtich" placeholder="Chi tiết nội dung" rows="5" cols="30"><?php echo $info->Bonus ?></textarea>
                            </div>
                            <label class="required">Giới thiệu về bản thân</label>
                            <div class="">
                                <textarea id="infouser" name="infouser" placeholder="Chi tiết nội dung" rows="5" cols="30"><?php echo $info->Description ?></textarea>
                            </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4><i class="fa fa-plus-circle"></i> Thông tin gia sư</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                            <label class="required">Môn học sẽ dạy</label>
                            <div class="form-control">
                                <select id="monhoc" name="monhoc" multiple="multiple">
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
                            <div id="grouptopic">
                            <?php if(count($usersubject) > 0 && !empty($usersubject)){
                                for($i=0;$i<count($usersubject);$i++){
                                    echo "<div id='group-topic".$usersubject[$i]."'>" ;
                                    echo "<label>Lớp hoặc chủ đề môn học <span>(".$subjectname[$i].")</span></label>";
                                    $lstopic=$CI->site_model->ListTopicBySubject($usersubject[$i]);
                                    $lsclass=$this->site_model->getclassbysubject($usersubject[$i]);
                                    if(count($lstopic) >0 || count($lsclass)>0){
                                        echo "<div class='form-group'><ul class='ultopic'>";
                                        $data="";
                                        if(count($lstopic)>0){
                                          for($j=0;$j<count($lstopic);$j++){
                                           if(in_array($lstopic[$j]->ID,$usertopic) ){
                                              $data.="<li>";
           $data.="<input class='radio-calendar' id='toppic-".$lstopic[$j]->ID."' checked='checked' type='checkbox' name='toppicchk' value='".$lstopic[$j]->ID."'>
                   <label for='toppic-".$lstopic[$j]->ID."'>".$lstopic[$j]->NameTopic."</label>";
           $data.="</li>";
                                           }else{
                                              $data.="<li>";
           $data.="<input class='radio-calendar' id='toppic-".$lstopic[$j]->ID."' type='checkbox' name='toppicchk' value='".$lstopic[$j]->ID."'>
                   <label for='toppic-".$lstopic[$j]->ID."'>".$lstopic[$j]->NameTopic."</label>";
           $data.="</li>";
                                           }
                                          }
                                        }
                                        if(count($lsclass)>0){
                                          foreach($lsclass as $valueClass){
                                            $idClass=$usersubject[$i].'-'.$valueClass->id;
                                            if(in_array($idClass,$userclass)){
                                              $data.="<li>";
                                  						$data.="<input class='radio-class' id='subject-class-".$idClass."' checked='checked' type='checkbox' name='subjectclass' value='".$idClass."'>
                                  										<label for='subject-class-".$idClass."'>".$valueClass->name."</label>";
                                  						$data.="</li>";
                                            }else{
                                              $data.="<li>";
                                  						$data.="<input class='radio-class' id='subject-class-".$idClass."' type='checkbox' name='subjectclass' value='".$idClass."'>
                                  										<label for='subject-class-".$idClass."'>".$valueClass->name."</label>";
                                  						$data.="</li>";
                                            }
                                          }
                                        }
                                           echo $data;
                                        echo "</ul></div>";
                                    }
                                    echo '</div>';
                                }
                                ?>

                            <?php }else{ ?>
                                <div id="group-topic0">
                                <label class="required">Chủ đề môn học <span>(Chọn lớp hoặc chủ đề giúp giáo viên tìm kiếm bạn dễ hơn)</span></label>
                                <div class="form-group">
                                    <ul class="ultopic">
                                        <!-- <li>
                                            <input class="radio-calendar" id="morning-calendar-2"  type="checkbox" name="sang_2" value="sang_2">
                                            <label for="morning-calendar-2" class="lbl-active">Sáng</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar" id="afternoon-calendar-2" type="checkbox" name="chieu_2" value="chieu_2">
                                            <label for="afternoon-calendar-2">Chiều</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar" id="evening-calendar-2" type="checkbox" name="toi_2" value="toi_2">
                                            <label for="evening-calendar-2">Tối</label>

                                        </li> -->
                                    </ul>
                                </div>
                                </div>
                                <?php } ?>
                            </div>

                            <label  class="required">Khu vực dạy</label>
                            <div class="form-control">
                                <select id="txtcityclass" class="city_ab_tag">
                                <option data-tokens="0" value="">Địa điểm lớp</option>
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
                            <div class="form-inline">
                                <label style="margin-right:30px;" class="required">Hình thức dạy: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" <?php if($info->WorkID==1){ ?> checked="checked" <?php } ?> name="teachtype" id="teachtype" type="radio">
                                    <label for="teachtype">Gia sư tại nhà</label>
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2" <?php if($info->WorkID==2){ ?> checked="checked" <?php } ?> name="teachtype" id="teachtype1" type="radio">
                                    <label for="teachtype1">Online trực tuyến</label>
                                </div>
                            </div>
                            <label class="required">Học phí dự kiến<span>(vnđ/buổi)</span></label>
                            <div class="form-control">
                                <input type="text" value="<?php echo $info->Free ?>" placeholder="Nhập học phí dự kiến" id="txthocphi" name="txthocphi">
                            </div>
                            <label >Buổi có thể dạy <span>(Bấm để chọn những buổi bạn có thể học)</span></label>
                            <div class="detaijob-body2 lichday checklichday">
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 2
                                    </div>
                                    <ul>
                                        <li>
                                            <input <?php if($info->MonMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CMonMorning" type="checkbox" name="CMonMorning" value="1">
                                            <label class="" for="CMonMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input <?php if($info->MonAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CMonAfter" type="checkbox" name="CMonAfter" value="1">
                                            <label class="" for="CMonAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input <?php if($info->MonNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CMonNight" type="checkbox" name="CMonNight" value="1">
                                            <label class="" for="CMonNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 3
                                 </div>
                                    <ul>
                                        <li>
                                            <input <?php if($info->TueMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CTueMorning" type="checkbox" name="CTueMorning" value="1">
                                            <label class="" for="CTueMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input  <?php if($info->TueAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CTueAfter" type="checkbox" name="CTueAfter" value="1">
                                            <label class="" for="CTueAfter">Chiều</label>
                                        </li>
                                        <li>
                                            <input  <?php if($info->TueNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CTueNight" type="checkbox" name="CTueNight" value="1">
                                            <label class="" for="CTueNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 4
                                    </div>
                                    <ul>
                                        <li>
                                            <input  <?php if($info->WeMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CWeMorning" type="checkbox" name="CWeMorning" value="1">
                                            <label class="" for="CWeMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input  <?php if($info->WeAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CWeAfter" type="checkbox" name="CWeAfter" value="1">
                                            <label class="" for="CWeAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input  <?php if($info->WeNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CWeNight" type="checkbox" name="CWeNight" value="1">
                                            <label class="" for="CWeNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 5
                                    </div>
                                    <ul>
                                        <li>
                                            <input  <?php if($info->ThuMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CThuMorning" type="checkbox" name="CThuMorning" value="1">
                                            <label class="" for="CThuMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input  <?php if($info->ThuAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CThuAfter" type="checkbox" name="CThuAfter" value="1">
                                            <label class="" for="CThuAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input  <?php if($info->ThuNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CThuNight" type="checkbox" name="CThuNight" value="1">
                                            <label class="" for="CThuNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 6
                                    </div>
                                    <ul>
                                        <li>
                                            <input  <?php if($info->FriMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CFriMorning" type="checkbox" name="CFriMorning" value="1">
                                            <label class="" for="CFriMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input  <?php if($info->FriAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CFriAfter" type="checkbox" name="CFriAfter" value="1">
                                            <label class="" for="CFriAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input  <?php if($info->FriNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CFriNight" type="checkbox" name="CFriNight" value="1">
                                            <label class="" for="CFriNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 7
                                    </div>
                                    <ul>
                                        <li>
                                            <input  <?php if($info->SatMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSatMorning" type="checkbox" name="CSatMorning" value="1">
                                            <label class="" for="CSatMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input  <?php if($info->SatAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSatAfter" type="checkbox" name="CSatAfter" value="1">
                                            <label   class="" for="CSatAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input <?php if($info->SatNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSatNight" type="checkbox" name="CSatNight" value="1">
                                            <label class="" for="CSatNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Chủ nhật
                                    </div>
                                    <ul>
                                        <li>
                                            <input  <?php if($info->SunMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSunMorning" type="checkbox" name="CSunMorning" value="1">
                                            <label class="" for="CSunMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input  <?php if($info->SunAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSunAfter" type="checkbox" name="CSunAfter" value="1">
                                            <label class="" for="CSunAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input  <?php if($info->SunNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSunNight" type="checkbox" name="CSunNight" value="1">
                                            <label class="" for="CSunNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                            </div>
                            <div class="clearfix"></div>
                            <label>Thông tin khác</label>
                            <div class="">
                                <textarea id="chitietnoidung" name="chitietnoidung" placeholder="Chi tiết nội dung" rows="5" cols="30"><?php echo $info->Orther ?></textarea>
                            </div>
                        </div>
                        </form>
                        <div class="col-md-12">
                            <div class="fun">
                                <span class="btn btn-primary btn-success" id="btnteacherupdateinfo">Hoàn tất</span>
                            </div>
                        </div>
                </div>
            </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</section>
<script src="js/jquery.numeric.js"></script>
<script src="js/common.js"></script>
<script src="js/moment.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script>
$(document).ready(function () {
    var abc='<?php echo join(',',$usersubject) ?>';

$('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD-MM-YYYY'
    });
    $('#txtusername').numeric();
    $("#txthocphi").numeric();
     $('#txtteachtype').select2();
      var tg1=abc.split(",");
    if(abc !=''){
    $('#monhoc').val(tg1).select2({ width: '100%',placeholder: 'Chọn ngành nghề (tối đa 3 ngành nghề)' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
    }else{
        $('#monhoc').select2({ width: '100%',placeholder: 'Chọn ngành nghề (tối đa 3 ngành nghề)' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
    }
        $('#txtcityclass').val(<?php echo $info->CityID ?>).select2();
     var configulr='<?php echo site_url(); ?>';

     $('#monhoc').change(function () {
            var monhoc=$(this).val();
            var abc1= '<?php echo join(',',$usersubject) ?>';
            var tg=abc1.split(",");
            if(monhoc.length > 0){
                    $('#grouptopic div#group-topic0').remove();
                    for(var i=0; i<monhoc.length; i++) {
                        if(tg.indexOf(monhoc[i]) < 0){
                        if(typeof($('#group-topic'+monhoc[i]).attr('data-val'))==='undefined'){
                        var strhtml="<div id='group-topic"+monhoc[i]+"' data-val='"+monhoc[i]+"'>";

                            strhtml+="<label>Lớp hoặc chủ đề môn học <span>("+$(this).find('option[value="' + monhoc[i] + '"]').text()+")</span></label>";
                            $.ajax({
                                      url: configulr+"/site/AjaxchudeCheckbox",
                                      type: "POST",
                                      data: { idmon: monhoc[i] },
                                      dataType: 'json',
                                      beforeSend: function () {
                                          $("#boxLoading").show();
                                      },
                                      success: function (obj) {
                                         if(obj.kq != ''){
                                            var reponse=obj.kq;
                                            strhtml+="<div class='form-group'><ul class='ultopic'>";
                                            strhtml+=obj.data;
                                            strhtml+="</ul></div>";
                                            strhtml+="</div>";
                                            $('#grouptopic').append(strhtml);
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
                         }
                     }

                }
            });
     $('#btnteacherupdateinfo').on('click',function(){
            var tg=[];
            var sexteach=[];
            var lophoc=[];

                sexteach.push($('input[name=location1]:checked').val());

            var itemtopic=document.getElementsByClassName('radio-calendar');
            for(var i=0;i< itemtopic.length;i++){

              var valuethis=  $('input[id='+$(itemtopic[i]).attr('id')+']:checked').val();
               if (typeof (valuethis) !== "undefined") {
                tg.push(valuethis);
                }

            };

            var itemclass=document.getElementsByClassName('radio-class');
            for(var x=0;x< itemclass.length;x++){

              var valueclass=  $('input[id='+$(itemclass[x]).attr('id')+']:checked').val();
               if (typeof (valueclass) !== "undefined") {
                lophoc.push(valueclass);
                }

            };
            var checkgt1= document.getElementById('location1');
            var checkgt2= document.getElementById('location2');

            var sang2=0;
            if(typeof($('input[name=CMonMorning]:checked').val())!=='undefined'){
                sang2=$('input[name=CMonMorning]:checked').val();
            };
            var chieu2=0;
            if(typeof($('input[name=CMonAfter]:checked').val())!=='undefined'){
                chieu2=$('input[name=CMonAfter]:checked').val();
            };
            var toi2=0;
            if(typeof($('input[name=CMonNight]:checked').val())!=='undefined'){
                toi2=$('input[name=CMonNight]:checked').val();
            };
            var sang3=0;
            if(typeof($('input[name=CTueMorning]:checked').val())!=='undefined'){
                sang3=$('input[name=CTueMorning]:checked').val();
            };
            var chieu3=0;
            if(typeof($('input[name=CTueAfter]:checked').val())!=='undefined'){
                chieu3=$('input[name=CTueAfter]:checked').val();
            };
            var toi3=0;
            if(typeof($('input[name=CTueNight]:checked').val())!=='undefined'){
                toi3=$('input[name=CTueNight]:checked').val();
            };
            var sang4=0;
            if(typeof($('input[name=CWeMorning]:checked').val())!=='undefined'){
                sang4=$('input[name=CWeMorning]:checked').val();
            };
            var chieu4=0;
            if(typeof($('input[name=CWeAfter]:checked').val())!=='undefined'){
                chieu4=$('input[name=CWeAfter]:checked').val();
            };
            var toi4=0;
            if(typeof($('input[name=CWeNight]:checked').val())!=='undefined'){
                toi4=$('input[name=CWeNight]:checked').val();
            };
            var sang5=0;
            if(typeof($('input[name=CThuMorning]:checked').val())!=='undefined'){
                sang5=$('input[name=CThuMorning]:checked').val();
            };
            var chieu5=0;
            if(typeof($('input[name=CThuAfter]:checked').val())!=='undefined'){
                chieu5=$('input[name=CThuAfter]:checked').val();
            };
            var toi5=0;
            if(typeof($('input[name=CThuNight]:checked').val())!=='undefined'){
                toi5=$('input[name=CThuNight]:checked').val();
            };
            var sang6=0;
            if(typeof($('input[name=CFriMorning]:checked').val())!=='undefined'){
                sang6=$('input[name=CFriMorning]:checked').val();
            };
            var chieu6=0;
            if(typeof($('input[name=CFriAfter]:checked').val())!=='undefined'){
                chieu6=$('input[name=CFriAfter]:checked').val();
            };
            var toi6=0;
            if(typeof($('input[name=CFriNight]:checked').val())!=='undefined'){
                toi6=$('input[name=CFriNight]:checked').val();
            };
            var sang7=0;
            if(typeof($('input[name=CSatMorning]:checked').val())!=='undefined'){
                sang7=$('input[name=CSatMorning]:checked').val();
            };
            var chieu7=0;
            if(typeof($('input[name=CSatAfter]:checked').val())!=='undefined'){
                chieu7=$('input[name=CSatAfter]:checked').val();
            };
            var toi7=0;
            if(typeof($('input[name=CSatNight]:checked').val())!=='undefined'){
                toi7=$('input[name=CSatNight]:checked').val();
            };
            var sang8=0;
            if(typeof($('input[name=CSunMorning]:checked').val())!=='undefined'){
                sang8=$('input[name=CSunMorning]:checked').val();
            };
            var chieu8=0;
            if(typeof($('input[name=CSunAfter]:checked').val())!=='undefined'){
                chieu8=$('input[name=CSunAfter]:checked').val();
            };
            var toi8=0;
            if(typeof($('input[name=CSunNight]:checked').val())!=='undefined'){
                toi8=$('input[name=CSunNight]:checked').val();
            };

            var arrmonhoc=$('#monhoc').val();
            var file_data = $('#danhdaidien')[0].files[0];
            var filecmnd=$('#anhcmnd')[0].files[0];
            data = new FormData();
            data.append('hoten',$('#txthoten').val());
            data.append('ngaysinh', $('#txtngaysinh').val());
            data.append('ngaysinh', $('#txtngaysinh').val());
            data.append('gioitinh', sexteach[0]);
            data.append('noiohientai', $('#txtnoiohientai').val());
            data.append('hientaila', $('#txtteachtype').val());
            data.append('hoctruong', $('#txtschool').val());
            data.append('chuyennganh', $('#txtmajor').val());
            data.append('namtotnghiep', $('#txtGraduationyear').val());
            data.append('noicongtac', $('#txtworkplace').val());
            data.append('kinhnghiem', $('#kinhnghiem').val());
            data.append('thanhtich', $('#thanhtich').val());
            data.append('gioithieubanthan', $('#infouser').val());
            data.append('monhoc', arrmonhoc.join());
            data.append('chudemonhoc', tg.join());
            data.append('khuvucday', $('#txtcityclass').val());
            data.append('tenkhuvucday', $('#txtcityclass option:selected').text());
            data.append('hinhthucday', $('input[name=teachtype]:checked').val());
            data.append('hocphi', $('#txthocphi').val());
            data.append('sang2', sang2);
            data.append('chieu2', chieu2);
            data.append('toi2', toi2);
            data.append('sang3', sang3);
            data.append('chieu3', chieu3);
            data.append('toi3', toi3);
            data.append('sang4', sang4);
            data.append('chieu4', chieu4);
            data.append('toi4', toi4);
            data.append('sang5', sang5);
            data.append('chieu5', chieu5);
            data.append('toi5', toi5);
            data.append('sang6', sang6);
            data.append('chieu6', chieu6);
            data.append('toi6', toi6);
            data.append('sang7', sang7);
            data.append('chieu7', chieu7);
            data.append('toi7', toi7);
            data.append('sang8', sang8);
            data.append('chieu8', chieu8);
            data.append('toi8', toi8);
            data.append('chitietnoidung', $('#chitietnoidung').val());
            data.append('imageuser', file_data);
            data.append('cmnduser', filecmnd);
            data.append('idclass', lophoc.join());
            data.append('email',$('#email').val());
            var hocphidukien=$('#txthocphi').val();
            if(self.validatephuhuynh()){
                  if(!isNaN(hocphidukien) && parseInt(hocphidukien)%1000==0){
                        $.ajax({
                          url: "<?=base_url().'site/ajaxteacherupdateinfo';?>",
                          type: "POST",
                          contentType: false,
                          processData: false,
                          data: data,
                          dataType: 'json',
                          enctype: 'multipart/form-data',
                          beforeSend: function () {
                                $("#boxLoading").show();
                            },
                            success: function (reponse) {
                                if (reponse.kq == true) {
                                      alert('Cập nhật thành công');
                                        window.location.href = configulr;
                                      }
                                else {
                                   alert('Cập nhật thất bại');
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
                          alert('Học phí phải là dạng bội số của 1000 hoặc bằng 0 (nếu giá cả là thỏa thuận)');
                        }
            }else{
              alert('Bạn cần điền đầy đủ thông tin vào các mục bắt buộc')
            }

        });

          self.validatephuhuynh=function(){
            var flag=true;
            if ($.trim($('#txthoten').val()) == '') {
                    $($('#txthoten')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txthoten').data("title", "").removeClass("errorClass");
                };
            if ($.trim($('#txtngaysinh').val()) == '') {
                      $($('#txtngaysinh')).addClass('errorClass');
                      flag = false;
                } else {
                      $('#txtngaysinh').data("title", "").removeClass("errorClass");
                };
            if ($.trim($('#email').val()) == '') {
                      $($('#email')).addClass('errorClass');
                        flag = false;
                } else {
                      $('#email').data("title", "").removeClass("errorClass");
            };
            if ($.trim($('#txtschool').val()) == '') {
                      $($('#txtschool')).addClass('errorClass');
                          flag = false;
                      } else {
                      $('#txtschool').data("title", "").removeClass("errorClass");
            };
            if ($.trim($('#infouser').val()) == '') {
                        $($('#infouser')).addClass('errorClass');
                            flag = false;
                        } else {
                        $('#infouser').data("title", "").removeClass("errorClass");
                      };
            if ($.trim($('#txthocphi').val()) == '') {
                      $($('#txthocphi')).addClass('errorClass');
                      flag = false;
                } else {
                      $('#txthocphi').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#monhoc').val()) == '0') {
                          $($('#monhoc')).addClass('errorClass');
                          flag = false;
                    } else {
                          $('#monhoc').data("title", "").removeClass("errorClass");
                    };


            if ($.trim($('#txtteachtype').val()) == '') {
                $($('#select2-txtteachtype-container')).addClass('errorClass');
                flag = false;
            } else {
                $('#select2-txtteachtype-container').data("title", "").removeClass("errorClass");
            };
            if ($.trim($('#txtcityclass').val()) == '') {
                $($('#select2-txtcityclass-container')).addClass('errorClass');
                flag = false;
            } else {
                $('#select2-txtcityclass-container').data("title", "").removeClass("errorClass");
            };
            return flag;
          }


     })
</script>
