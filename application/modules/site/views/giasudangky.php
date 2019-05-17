<?php ?>
<div class="container">

    <?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-top-30 padd-bot-30">
    <div class="container">
        <div class="row register padd-bot-40">
            <h1 class="title titleregister">Đăng ký làm gia sư</h1>
            <p style="text-align:center;">Bạn vui lòng điền đầy đủ và chính xác thông tin bên dưới</p>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="registerform">
                <form action="<?php echo site_url('site/postformteacherregistersuccess') ?>" method="POST" id="my_form">
                    <h3 class="col-md-12"><i class="fa fa-plus-circle"></i> Thông tin đăng nhập <span>Bạn đã có tài khoản? <a>Đăng nhập</a></span></h3>
                    <div class="col-md-6">
                        <label>Họ tên đầy đủ *</label>
                        <div class="form-control"><input type="text" id="txthoten" name="txthoten" /></div>
                    </div>
                    <div class="col-md-6">
                        <label>Mật khẩu <span  style="font-weight:300;font-size:13">(Mật khẩu tối thiểu 6 ký tự)</span> *</label>
                        <div class="form-control"><input type="password" id="txtmatkhau" name="txtmatkhau" /></div>
                    </div>
                    <div class="col-md-6">
                        <label>Số điện thoại <span style="font-weight:300;font-size:13">(SĐT là tài khoản để bạn đăng nhập)</span> *</label>
                        <div class="form-control"><input type="text" id="txtusername" name="txtusername" /></div>
                    </div>
                    <div class="col-md-6">
                        <label>Nhập lại mật khẩu *</label>
                        <div class="form-control"><input type="password" id="txtrepass" name="txtrepass" /></div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group lblcheck">
                          <input type="radio" name="accuracy" id="sendsms" value="2" checked="checked"/><label for="sendsms">
                           Nhắn tin xác thực
                          </label>
                          <input type="radio" name="accuracy" id="sendsms1" value="1"/><label for="sendsms1">
                           Gọi điện xác thực
                          </label>
                      </div>
                    </div>
                    <input type="hidden" name="code" id="code">
                <input type="hidden" name="csrf" id="csrf">
                </form>
                </div>
            </div>
        </div>
        <div class="row padd-top-20 padd-bot-20">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc" style="display: none;">
                    <div class="row">
                        <div class="col-md-12 batbuoc">
                            <h4><i class="fa fa-plus-circle"></i> Thông tin cá nhân</h4>
                            <div>(<span>*</span>) Thông tin bắt buộc nhập</div>
                        </div>
                    </div>
                    <form enctype="multipart/form-data">
                    <div class="col-md-10 col-md-offset-1">

                            <label class="required">Email</label>
                            <div class="form-control">
                                <input type="text" placeholder="Vui lòng nhập email của bạn" id="txtemail">
                            </div>
                            <label class="required">Ảnh đại diện</label>
                            <div class="form-control">
                                <input accept="image/x-png,image/gif,image/jpeg" type="file" name="danhdaidien" id="danhdaidien" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
					               <label for="danhdaidien"><strong> Chọn tệp</strong> <span>không có file nào được chọn</span></label>
                            </div>
                            <label>Ảnh CMND, thẻ sinh viên hoặc bằng cấp chuyên môn cao nhất <span>(để tăng sự tin tưởng của học viên với bạn)</span></label>
                            <div class="form-control">
                                <input accept="image/x-png,image/gif,image/jpeg" type="file" name="anhcmnd" id="anhcmnd" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
					               <label for="anhcmnd"><strong> Chọn tệp</strong> <span>không có file nào được chọn</span></label>
                            </div>
                            <label class="required">Ngày tháng năm sinh</label>
                            <div class='input-group date' id='datetimepicker1' style="width: 100%">
                                    <input type='text' placeholder="Ngày sinh" id="txtngaysinh" class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                            </div>
                            <div class="form-inline">
                                <label style="margin-right:30px;">Giới tính: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" checked="checked" name="location1" id="location1" type="checkbox">
                                    <label for="location1">Nam</label>
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2" name="location2" id="location2" type="checkbox">
                                    <label for="location2">Nữ</label>
                                </div>
                            </div>
                            <label>Nơi ở hiện tại</label>
                            <div class="form-control">
                                <input type="text" placeholder="Vui lòng nhập chi tiết nơi ở hiện tại" id="txtnoiohientai">
                            </div>
                            <label>Hiện tại là</label>
                            <div class="form-control">
                                <select id="txtteachtype" name="txtteachertype">
                                    <option value="">Lựa chọn gia sư</option>
                                    <?php
                                        if(!empty($lstitem)){
                                            foreach($lstitem as $n){ ?>
                                        <option value="<?php echo $n->ID ?>"><?php echo $n->NameType ?></option>
                                    <?php }
                                        }
                                    ?>
                                </select>
                            </div>
                            <label>Học trường</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập trường học của bạn" id="txtschool">
                            </div>
                            <label>Chuyên ngành</label>
                            <div class="form-control">
                                <input type="text" placeholder="Chuyên ngành học" id="txtmajor">
                            </div>
                            <label>Năm tốt nghiệp</label>
                            <div class="form-control">
                                <input type="text" placeholder="Năm tốt nghiệp" id="txtGraduationyear">
                            </div>
                            <label>Nơi công tác <span>(nếu đã đi làm)</span></label>
                            <div class="form-control">
                                <input type="text" placeholder="Nơi công tác" id="txtworkplace">
                            </div>
                            <div class="clearfix"></div>
                            <label>Kinh nghiệm đi dạy</label>
                            <div class="">
                                <textarea id="kinhnghiem" name="kinhnghiem" placeholder="Chi tiết nội dung" rows="5" cols="30"></textarea>
                            </div>
                            <label>Thành tích</label>
                            <div class="">
                                <textarea id="thanhtich" name="thanhtich" placeholder="Chi tiết nội dung" rows="5" cols="30"></textarea>
                            </div>
                            <label>Giới thiệu về bản thân</label>
                            <div class="">
                                <textarea id="infouser" name="infouser" placeholder="Chi tiết nội dung" rows="5" cols="30"></textarea>
                            </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4><i class="fa fa-plus-circle"></i> Thông tin gia sư</h4>
                        </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                            <label>Môn học sẽ dạy</label>
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
                                <div id="group-topic0">
                                <label>Lớp hoặc chủ đề môn học <span>(Chọn lớp hoặc chủ đề giúp giáo viên tìm kiếm bạn dễ hơn)</span></label>
                                <div class="form-group">
                                    <ul class="ultopic">
                                        <li>
                                            <input class="radio-calendar" id="morning-calendar-2" type="checkbox" name="sang_2" value="sang_2">
                                            <label for="morning-calendar-2" class="lbl-active">Sáng</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar" id="afternoon-calendar-2" type="checkbox" name="chieu_2" value="chieu_2">
                                            <label for="afternoon-calendar-2">Chiều</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar" id="evening-calendar-2" type="checkbox" name="toi_2" value="toi_2">
                                            <label for="evening-calendar-2">Tối</label>

                                        </li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            <label>Khu vực dạy</label>
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
                                    <input value="1" checked="checked" name="teachtype" id="teachtype" type="radio">
                                    <label for="teachtype">Gia sư tại nhà</label>
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2" name="teachtype" id="teachtype1" type="radio">
                                    <label for="teachtype1">Online trực tuyến</label>
                                </div>
                            </div>
                            <label class="required">Học phí dự kiến<span>(vnđ/buổi)</span></label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập học phí dự kiến" id="txthocphi" name="txthocphi">
                            </div>
                            <label>Buổi có thể dạy <span>(Bấm để chọn những buổi bạn có thể học)</span></label>
                            <div class="detaijob-body2 lichday checklichday">
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 2
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar2" id="CMonMorning" type="checkbox" name="CMonMorning" value="1">
                                            <label class="" for="CMonMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CMonAfter" type="checkbox" name="CMonAfter" value="1">
                                            <label class="" for="CMonAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CMonNight" type="checkbox" name="CMonNight" value="1">
                                            <label class="" for="CMonNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 3
                                 </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar2" id="CTueMorning" type="checkbox" name="CTueMorning" value="1">
                                            <label class="" for="CTueMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CTueAfter" type="checkbox" name="CTueAfter" value="1">
                                            <label class="" for="CTueAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CTueNight" type="checkbox" name="CTueNight" value="1">
                                            <label class="" for="CTueNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 4
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar2" id="CWeMorning" type="checkbox" name="CWeMorning" value="1">
                                            <label class="" for="CWeMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CWeAfter" type="checkbox" name="CWeAfter" value="1">
                                            <label class="" for="CWeAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CWeNight" type="checkbox" name="CWeNight" value="1">
                                            <label class="" for="CWeNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 5
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar2" id="CThuMorning" type="checkbox" name="CThuMorning" value="1">
                                            <label class="" for="CThuMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CThuAfter" type="checkbox" name="CThuAfter" value="1">
                                            <label class="" for="CThuAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CThuNight" type="checkbox" name="CThuNight" value="1">
                                            <label class="" for="CThuNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 6
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar2" id="CFriMorning" type="checkbox" name="CFriMorning" value="1">
                                            <label class="" for="CFriMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CFriAfter" type="checkbox" name="CFriAfter" value="1">
                                            <label class="" for="CFriAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CFriNight" type="checkbox" name="CFriNight" value="1">
                                            <label class="" for="CFriNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 7
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar2" id="CSatMorning" type="checkbox" name="CSatMorning" value="1">
                                            <label class="" for="CSatMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CSatAfter" type="checkbox" name="CSatAfter" value="1">
                                            <label class="" for="CSatAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CSatNight" type="checkbox" name="CSatNight" value="1">
                                            <label class="" for="CSatNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Chủ nhật
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar2" id="CSunMorning" type="checkbox" name="CSunMorning" value="1">
                                            <label class="" for="CSunMorning">Sáng</label>
                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CSunAfter" type="checkbox" name="CSunAfter" value="1">
                                            <label class="" for="CSunAfter">Chiều</label>

                                        </li>
                                        <li>
                                            <input class="radio-calendar2" id="CSunNight" type="checkbox" name="CSunNight" value="1">
                                            <label class="" for="CSunNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                            </div>
                            <div class="clearfix"></div>
                            <label>Thông tin khác</label>
                            <div class="">
                                <textarea id="chitietnoidung" name="chitietnoidung" placeholder="Chi tiết nội dung" rows="5" cols="30"></textarea>
                            </div>
                        </div>
                        </form>
                </div>
            </div>


        </div>
        <div class="col-md-12 captchavalue">
                    <div class="form-group lblcheck">
                        <input type="checkbox" id="dongydieukhoan" /><label for="dongydieukhoan">
                          Tôi đồng ý với <a href="javascript:void(0);">Điều khoản và điều kiện</a> của Vieclam123.vn
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="fun">
                        <span class="btn btn-primary btn-success" id="dangkygiaovien">Hoàn tất</span>
                        <span class="btn btn-primary btn-warning">Làm lại</span>
                    </div>
                </div>

    </div>
</section>
<!---->
<div id="mymodalregistersuccess" class="modal fade top" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title titlesuccess"><img src="images/icon-tick.png" alt="tick" />Tìm kiếm nâng cao</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12 col-sm-12">
           <p><span id="txttenthongbao">Xin chào: <b>Quang Anh</b></span></p>
           <p>Bạn đã đăng ký tài khoản thành công. Ngay bây giờ bạn có thể sử dụng dịch vụ của giasu365</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade capnhattrangthaiclass" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title"><b>Bạn vui lòng chờ</b></div>
          <input type="hidden" id="txtclassid" name="txtclassid" />
          <input type="hidden" id="txtid" name="txtid" />
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row padd-top-15 padd-bot-5" style="">
                    <div class="col-md-12">
                        <div><h4 class="text-center" id="demo"></h4></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="text-align:left;">

        </div>
      </div>
    </div>
  </div>
<script src="js/jquery.numeric.js"></script>
<script src="js/common.js"></script>
<script src="js/moment.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
<script>
$(document).ready(function () {
     AccountKit_OnInteractive = function(){
                        AccountKit.init(
                          {
                            appId:"401264273790288",
                            state:'0ca21fe16dde6d9a3b3c38206391b0dd',
                            version:"v1.0",
                            fbAppEventsEnabled:true
                          }
                        );
                      };
$('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD-MM-YYYY'
    });
    $('#txtusername').numeric();
    $("#txthocphi").numeric();
     $('#txtteachtype').select2();
        $('#monhoc').select2({ width: '100%',placeholder: 'Chọn ngành nghề (tối đa 3 ngành nghề)' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
        $('#txtcityclass').select2();
     var configulr='<?php echo site_url(); ?>';
    $('#dangkygiaovien').on('click',function(){

        /*validategiasu() && typeof($('input[id=dongydieukhoan]:checked').val())!=='undefined'*/
        if(validategiasu() && typeof($('input[id=dongydieukhoan]:checked').val())!=='undefined'){
            var tg=[];
            var sexteach=[];
            if(typeof($('input[id=location1]:checked').val())!=='undefined'){
                sexteach.push($('input[id=location1]:checked').val());
            };
            if(typeof($('input[id=location2]:checked').val())!=='undefined'){
                sexteach.push($('input[id=location2]:checked').val());
            };
            var itemtopic=document.getElementsByClassName('radio-calendar');
            for(var i=0;i< itemtopic.length;i++){

              var valuethis=  $('input[id='+$(itemtopic[i]).attr('id')+']:checked').val();
               if (typeof (valuethis) !== "undefined") {
                tg.push(valuethis);
                }

            };
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
            var sendsms=0;
            if(typeof($('input[name=accuracy]:checked').val())!=='undefined'){
                sendsms=$('input[name=accuracy]:checked').val();
            }
            var arrmonhoc=$('#monhoc').val();
            var file_data = $('#danhdaidien')[0].files[0];
            var filecmnd=$('#anhcmnd')[0].files[0];

            data = new FormData();
            data.append('hoten',$('#txthoten').val());
            data.append('username',$('#txtusername').val());
            data.append('password',$('#txtmatkhau').val());
            data.append('emailuser', $('#txtemail').val());
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
            if(arrmonhoc != null){
                data.append('monhoc', arrmonhoc.join());
            }else{
                data.append('monhoc', '');
            }
            if(tg != null){
            data.append('chudemonhoc', tg.join());
            }else{
               data.append('chudemonhoc', "");
            }
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
            data.append('sms', sendsms);
            data.append('chitietnoidung', $('#chitietnoidung').val());
            data.append('imageuser', file_data);
            data.append('cmnduser', filecmnd);
            if(sendsms==0){
              alert('Bạn vui lòng chọn kiểu xác thực');
            }else if(sendsms==1){
              $.ajax({
                        url: configulr+"/site/ajaxteacherregistersuccess",
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
                              if(sendsms==2){
                                  alert('Bạn đã đăng ký tài khoản thành công. Vui lòng kiểm tra tin nhắn để nhận mã xác thực kích hoạt tài khoản');
                              }else{
                                  alert('Bạn đã đăng ký tài khoản thành công. Vui lòng nghe điện thoại để nhận mã xác thực kích hoạt tài khoản');
                              }
                              $('#myModal').modal('show');
                              var countDownDate = new Date().getTime();
                               countDownDate =countDownDate+10000;

                                var x = setInterval(function() {
                                  var now = new Date().getTime();

                                  var distance = countDownDate - now;


                                  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                  var seconds = Math.floor((distance % (1000 * 60)) / 1000);


                                  document.getElementById("demo").innerHTML =  seconds + "Giây ";


                                  if (distance <= 0) {
                                    clearInterval(x);
                                     var urlredirect=configulr+"kichhoattaikhoan?c="+reponse.code+"&u="+reponse.data;
                                      window.location.href=urlredirect;
                                  }
                                }, 1000);

                            }
                            else {
                               alert('Tài khoản đã tồn tại, bạn vui lòng đăng nhập hệ thống để tạo tin');
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
                $.ajax({

                  url: configulr+"/site/ajaxgetforgotpasswordfacebook",
                  type: "POST",
                  data: { username: $('#txtusername').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        alert('Tai khoan da ton tai');
                        }
                      else {
                         smsLogin('+84',$('#txtusername').val());
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
    });

    $('#monhoc').change(function () {
            var monhoc=$(this).val();
            /*monhoc=monhoc1.split(',');*/
            if(monhoc.length > 0){


                    $('#grouptopic div#group-topic0').remove();
                    for(var i=0; i<monhoc.length; i++) {
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

                           /*alert($(this).find('option[value="' + monhoc[i] + '"]').text());*/
                     }

                }
            });
            function smsLogin(countryCode,phoneNumber) {

            AccountKit.login(
              'PHONE',
              {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
              loginCallback
            );
          }
function loginCallback(response) {
            if (response.status === "PARTIALLY_AUTHENTICATED") {
              var code = response.code;
              var csrf = response.state;

document.getElementById("code").value = response.code;
      document.getElementById("csrf").value = response.state;
      document.getElementById("my_form").submit();


            }
            else if (response.status === "NOT_AUTHENTICATED") {
              }
            else if (response.status === "BAD_PARAMS") {
              }
          }
    function validategiasu()
    {
        var flag=true;
        var uemail = $('#txthoten').val();
                if ($.trim(uemail) == '') {
                    $($('#txthoten')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txthoten').data("title", "").removeClass("errorClass");
                };
             if ($.trim($('#txtmatkhau').val()) == '') {
                    $($('#txtmatkhau')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtmatkhau').data("title", "").removeClass("errorClass");
                };
             if ($.trim($('#txtusername').val()) == '') {
                    $($('#txtusername')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtusername').data("title", "").removeClass("errorClass");
                };
             if ($.trim($('#txtrepass').val()) == '') {
                    $($('#txtrepass')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtrepass').data("title", "").removeClass("errorClass");
                };
            var pass = $("#txtmatkhau").val();
            var repass = $("#txtrepass").val();
             if (checkPassword(pass, $('#txtmatkhau')) == 1) {
                flag = false;
            };
            if (checkPassword(repass, $('#txtrepass')) == 1) {
                flag = false;
            };
            if (checkPassword(pass, $('#ctrlrepasstxt')) == 0 && pass != repass) {
                $($('#ctrlpasstxt')).tooltip('hide').attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('show').addClass('errorClass');
                flag = false;
            };
        /*if ($.trim($('#txtemail').val()) == '') {
                    $($('#txtemail')).addClass('errorClass');

                    flag = false;
                } else {
                    $('#txtemail').data("title", "").removeClass("errorClass");
                };
        if ($.trim($('#danhdaidien').val()) == '') {
                    $($('#danhdaidien + label')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#danhdaidien + label')).removeClass('errorClass');
                };
        if ($.trim($('#anhcmnd').val()) == '') {
                    $($('#anhcmnd + label')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#anhcmnd + label')).removeClass('errorClass');
                };
        if ($.trim($('#txtngaysinh').val()) == '') {
                    $($('#txtngaysinh')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#txtngaysinh')).removeClass('errorClass');
                };
        if ($.trim($('#txtnoiohientai').val()) == '') {
                    $($('#txtnoiohientai')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#txtnoiohientai')).removeClass('errorClass');
                };
        if ($.trim($('#txtteachtype').val()) == '') {
                    $($('#select2-txtteachtype-container')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#select2-txtteachtype-container')).removeClass('errorClass');
                };
        if ($.trim($('#txtschool').val()) == '') {
                    $($('#txtschool')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#txtschool')).removeClass('errorClass');
                };
        if ($.trim($('#txtmajor').val()) == '') {
                    $($('#txtmajor')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#txtmajor')).removeClass('errorClass');
                };
        if ($.trim($('#txtGraduationyear').val()) == '') {
                    $($('#txtGraduationyear')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#txtGraduationyear')).removeClass('errorClass');
                };
        if ($.trim($('#txtworkplace').val()) == '') {
                    $($('#txtworkplace')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#txtworkplace')).removeClass('errorClass');
                };
        if ($.trim($('#kinhnghiem').val()) == '') {
                    $($('#kinhnghiem')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#kinhnghiem')).removeClass('errorClass');
                };
        if ($.trim($('#thanhtich').val()) == '') {
                    $($('#thanhtich')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#thanhtich')).removeClass('errorClass');
                };
        if ($.trim($('#infouser').val()) == '') {
                    $($('#infouser')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#infouser')).removeClass('errorClass');
                };
        if ($.trim($('#monhoc').val()) == '') {
                    $($('.select2-selection--multiple')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('.select2-selection--multiple')).removeClass('errorClass');
                };
        if ($.trim($('#txtcityclass').val()) == '0') {
                    $($('#select2-txtcityclass-container')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#select2-txtcityclass-container')).removeClass('errorClass');
                };
        if ($.trim($('#txthocphi').val()) == '') {
                    $($('#txthocphi')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#txthocphi')).removeClass('errorClass');
                };
        if ($.trim($('#chitietnoidung').val()) == '') {
                    $($('#chitietnoidung')).addClass('errorClass');
                    flag = false;
                } else {
                    $($('#chitietnoidung')).removeClass('errorClass');
                };  */
        return flag;
    };
    function checkPassword(pwd, element) {
            var Hoa = 0;
            var Thuong = 0;
            var So = 0;
            if (pwd.length < 6) {
                $(element).tooltip('hide').attr('title', 'Mật khẩu phải nhiều hơn hoặc có 6 ký tự').tooltip('show').addClass('errorClass');
                return 1;
            }
            $(element).data("title", "").removeClass("errorClass").tooltip("hide");
            return 0;
        }
    });
</script>
