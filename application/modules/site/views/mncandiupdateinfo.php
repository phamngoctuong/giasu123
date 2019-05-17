<?php
$userinfo = $_SESSION['UserInfo'];
?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php if($userinfo1['Type']==3){ $this->load->view('left3'); }?>
        </div>
        <?php if($userinfo1['Type']==3){ ?>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right right-uv" style="min-height:300px;">
                <div class="fromdatime">
                <div class="clr" style="height:28px"></div>
                </div>
                <?php if(empty($userinfo1['EmailAddress'])){
                  ?>
                    <div class="thong-bao-dien-thong-tin" >* <?php echo $mess ?></div>
                  <?php
                } ?>
                <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc" style="overflow: hidden;">
            <div class="register-form col-md-12">
                    <h5>Thông tin cá nhân</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-control">
                              <input type="text" name="username" autocomplete="off" id="namecandi" placeholder="Họ và tên" value="<?php echo $userinfo->Name ?>" required>
                            </div>
                            <div class="form-control">
                              <input type="text" name="mobile" autocomplete="off" id="phonecandi" placeholder="Số điện thoại" value="<?php echo $userinfo->Phone ?>" required="">
                            </div>
                            <div class="form-control">
                              <input type="text" name="email" id="email"  placeholder="nhập email" value="<?php echo $userinfo->Email ?>">
                            </div>
                            <div class="form-control">
                            <select id="citycandi" class="city_ab">
                                <option data-tokens="0" value="0">Tỉnh thành</option>
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
                            <div class="form-control">
                            <select id="districtcandi" class="city_ab">
                            <option data-tokens="0" value="0">Chọn quận/huyện</option>

                                </select>

                            </div>
                            <div class="form-control">
                              <input type="text" name="school" autocomplete="off" id="school" placeholder="Tên trường học" value="<?php echo $userinfo->school ?>" required>

                            </div>
                            <div class="form-control">
                              <input type="text" name="schooltype" autocomplete="off" id="schooltype" value="<?php echo $userinfo->schooltype ?>" placeholder="Chuyên ngành học" required>

                            </div>
                        </div>
                        <div class="col-md-6">

                                <div class='input-group date' id='datetimepicker1' style="width: 100%">
                                        <input type='text' value="<?php echo date('d-m-Y',strtotime($userinfo->Birth)) ?>" placeholder="Ngày hết hạn" id="txtngaysinh" class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                </div>


                            <div class="form-control">
                                <select id="candisex" class="city_ab">
                                    <option value="0">Chọn giới tính</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <select id="candimarriage" name="lg_honnhan">
                                    <option value="0">Chọn tình trạng hôn nhân *</option>
                                    <option value="1">Độc thân</option>
                                    <option value="2">Đã có gia đình</option>
                                </select>
                            </div>
                            <div class="form-control">
                              <input type="text" name="diachicandi" autocomplete="off" value="<?php echo $userinfo->Address ?>" id="diachicandi" placeholder="Nhập địa chỉ thường trú" required>

                            </div>
                            <div class="form-control">
                                <select id="xeploaihoctap" class="xeploaihoctap">
                                    <option value="0">Chọn xếp loại học tập</option>
                                    <option value="1">Yếu</option>
                                    <option value="2">Trung bình</option>
                                    <option value="5">TB khá</option>
                                    <option value="3">Khá</option>
                                    <option value="4">Giỏi</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <select id="languagecandi" name="languagecandi">
                                      <option value="0">Chọn ngôn ngữ bạn biết</option>
                                      <option value="1">Tiếng Anh</option>
                                      <option value="2">Tiếng Pháp</option>
                                      <option value="3">Tiếng Nga</option>
                                      <option value="4">Tiếng Hàn</option>
                                      <option value="5">Tiếng Trung</option>
                                      <option value="6">Tiếng Nhật</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <h5>Công việc mong muốn</h5>
                    <div class="row thongtinboxung">
                        <div class="col-sm-6">

                            <div class="form-control">
                              <input type="text" name="jobwish" autocomplete="off" value="<?php echo $userinfo->cv_title ?>" id="jobwish" placeholder="Công việc mong muốn" required>

                            </div>
                            <div class="form-control">
                                <select id="candibangcap" class="valid error" name="candibangcap">
                                <option value="0">Chọn bằng cấp *</option><option value="7">Đại học</option>
                                <option value="5">Cao đẳng</option>
                                <option value="1">PTCS</option>
                                <option value="2">Trung học</option>
                                <option value="3">Chứng chỉ</option>
                                <option value="4">Trung cấp</option>
                                <option value="6">Cử nhân</option>
                                <option value="8">Thạc sĩ</option>
                                <option value="9">Thạc sĩ Nghệ thuật</option>
                                <option value="10">Thạc sĩ Thương mại</option>
                                <option value="11">Thạc sĩ Khoa học</option>
                                <option value="12">Thạc sĩ Kiến trúc</option>
                                <option value="13">Thạc sĩ QTKD</option>
                                <option value="14">Thạc sĩ Kỹ thuật ứng dụng</option>
                                <option value="15">Thạc sĩ Luật</option>
                                <option value="16">Thạc sĩ Y học</option>
                                <option value="17">Thạc sĩ Dược phẩm</option>
                                <option value="18">Tiến sĩ</option>
                                <option value="19">Khác</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <select id="candihtlv" class="valid error" name="candihtlv">
                                <option value="0">Chọn hình thức làm việc *</option>
                                <option value="1">Toàn thời gian cố định</option>
                                <option value="2">Toàn thời gian tạm thời</option>
                                <option value="3">Bán thời gian</option>
                                <option value="4">Bán thời gian tạm thời</option>
                                <option value="5">Hợp đồng</option>
                                <option value="6">Khác</option>
                                </select>
                            </div>
                            <div class="form-control">
                                <select id="candicapbac" class="valid error" name="candicapbac">
                                    <option value="">Chọn cấp bậc mong muốn </option>
                                    <option value="1">Mới Tốt Nghiệp</option>
                                  <option value="3">Nhân viên</option>
                                  <option value="2">Thực tập sinh</option>
                                  <option value="4">Trưởng phòng</option>
                                  <option value="6">Giám Đốc</option>
                                  <option value="5">Phó giám đốc</option>
                                  <option value="7">Tổng giám đốc điều hành</option>
                                 </select>
                            </div>
                            <div class="form-control">
                                <select id="salarycandi" class=" valid error" name="salarycandi">
                                <option value="0">Chọn mức lương *</option>
                                <option value="1">Thỏa thuận</option>
                                <option value="2">1 - 3 triệu</option>
                                <option value="3">3 - 5 triệu</option>
                                <option value="4">5 - 7 triệu</option>
                                <option value="5">7 - 10 triệu</option>
                                <option value="6">10 - 15 triệu</option>
                                <option value="7">15 - 20 triệu</option>
                                <option value="8">20 - 30 triệu</option>
                                <option value="9">Trên 30 triệu</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="form-control">
                                <select id="citycandimore" class="city_ab ">
                                    <option data-tokens="0" value="0">Nơi làm việc khác</option>
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
                                <div class="form-control">
                                    <select id="candicategory" class="city_ab ">
                                        <option data-tokens="0" value="0">Công việc 1</option>
                                        <option data-tokens="1" value="1">Kế toán - Kiểm toán</option>
                                        <option data-tokens="2" value="2">Hành chính - Văn phòng</option>
                                        <option data-tokens="3" value="3">Sinh viên làm thêm</option>
                                        <option data-tokens="4" value="4">Xây dựng</option>
                                        <option data-tokens="5" value="5">Điện - Điện tử</option>
                                        <option data-tokens="6" value="6">Làm bán thời gian</option>
                                        <option data-tokens="7" value="7">Vận tải - Lái xe</option>
                                        <option data-tokens="8" value="8">Khách sạn - Nhà hàng</option>
                                        <option data-tokens="9" value="9">Nhân viên kinh doanh</option>
                                        <option data-tokens="10" value="10">Việc làm bán hàng</option>
                                        <option data-tokens="11" value="11">Cơ khí - Chế tạo</option>
                                        <option data-tokens="12" value="12">Lao động phổ thông</option>
                                        <option data-tokens="13" value="13">IT phần mềm</option>
                                        <option data-tokens="14" value="14">Marketing-PR</option>
                                        <option data-tokens="17" value="17">Giáo dục-Đào tạo</option>
                                        <option data-tokens="18" value="18">Kỹ thuật</option>
                                        <option data-tokens="19" value="19">Y tế-Dược</option>
                                        <option data-tokens="20" value="20">Quản trị kinh doanh</option>
                                        <option data-tokens="21" value="21">Dịch vụ</option>
                                        <option data-tokens="22" value="22">Biên-Phiên dịch</option>
                                        <option data-tokens="23" value="23">Dệt may - Da giày</option>
                                        <option data-tokens="24" value="24">Kiến trúc - Tk nội thất</option>
                                        <option data-tokens="25" value="25">Xuất,nhập khẩu</option>
                                        <option data-tokens="26" value="26">IT Phần cứng-mạng</option>
                                        <option data-tokens="27" value="27">Nhân sự</option>
                                        <option data-tokens="28" value="28">Thiết kế - Mỹ thuật</option>
                                        <option data-tokens="29" value="29">Tư vấn</option>
                                        <option data-tokens="30" value="30">Bảo vệ</option>
                                        <option data-tokens="31" value="31">Ô tô - xe máy</option>
                                        <option data-tokens="32" value="32">Thư ký-Trợ lý</option>
                                        <option data-tokens="33" value="33">KD bất động sản</option>
                                        <option data-tokens="34" value="34">Du lịch</option>
                                        <option data-tokens="35" value="35">Báo chí-Truyền hình</option>
                                        <option data-tokens="36" value="36">Thực phẩm-Đồ uống</option>
                                        <option data-tokens="37" value="37">Ngành nghề khác</option>
                                        <option data-tokens="38" value="38">Vật tư-Thiết bị</option>
                                        <option data-tokens="39" value="39">Thiết kế web</option>
                                        <option data-tokens="40" value="40">In ấn - Xuất bản</option>
                                        <option data-tokens="41" value="41">Nông-Lâm-Ngư-Nghiệp</option>
                                        <option data-tokens="42" value="42">Thương mại điện tử</option>
                                        <option data-tokens="43" value="43">Nhập liệu</option>
                                        <option data-tokens="44" value="44">Việc làm thêm tại nhà</option>
                                        <option data-tokens="45" value="45">Chăm sóc khách hàng</option>
                                        <option data-tokens="46" value="46">Sinh viên mới tốt nghiệp - Thực tập</option>
                                        <option data-tokens="47" value="47">Kỹ thuật ứng dụng</option>
                                        <option data-tokens="48" value="48">Bưu chính viễn thông</option>
                                        <option data-tokens="49" value="49">Dầu khí - Địa chất</option>
                                        <option data-tokens="50" value="50">Giao thông vận tải - Thủy lợi - Cầu đường</option>
                                        <option data-tokens="51" value="51">Khu chế xuất - Khu công nghiệp</option>
                                        <option data-tokens="52" value="52">Làm đẹp - Thể lực - Spa</option>
                                        <option data-tokens="53" value="53">Luật - Pháp lý</option>
                                        <option data-tokens="54" value="54">Môi trường - Xử lý chất thải</option>
                                        <option data-tokens="55" value="55">Mỹ phẩm - Thời trang - Trang sức</option>
                                        <option data-tokens="56" value="56">Ngân hàng - Chứng khoán - Đầu tư</option>
                                        <option data-tokens="57" value="57">Nghệ thuật - Điện ảnh</option>
                                        <option data-tokens="58" value="58">Phát triển thị trường</option>
                                        <option data-tokens="59" value="59">Phục vụ - Tạp vụ - Giúp việc</option>
                                        <option data-tokens="60" value="60">Quan hệ đối ngoại</option>
                                        <option data-tokens="61" value="61">Quản lý điều hành</option>
                                        <option data-tokens="62" value="62">Sản xuất - Vận hành sản xuất</option>
                                        <option data-tokens="63" value="63">Thẩm định - Giám thẩm định - Quản lý chất lượng</option>
                                        <option data-tokens="64" value="64">Thể dục - Thể thao</option>
                                        <option data-tokens="65" value="65">Hóa học - Sinh học</option>
                                        <option data-tokens="66" value="66">Bảo hiểm</option>
                                        <option data-tokens="67" value="67">Freelancer</option>
                                        <option data-tokens="68" value="68">Công chức - Viên chức </option>
                                     </select>
                                </div>
                                <div class="form-control">
                                    <select id="candicategorymore" class="city_ab " multiple>
                                        <option data-tokens="0" value="0">Công khác</option>
                                        <option data-tokens="1" value="1">Kế toán - Kiểm toán</option>
                                        <option data-tokens="2" value="2">Hành chính - Văn phòng</option>
                                        <option data-tokens="3" value="3">Sinh viên làm thêm</option>
                                        <option data-tokens="4" value="4">Xây dựng</option>
                                        <option data-tokens="5" value="5">Điện - Điện tử</option>
                                        <option data-tokens="6" value="6">Làm bán thời gian</option>
                                        <option data-tokens="7" value="7">Vận tải - Lái xe</option>
                                        <option data-tokens="8" value="8">Khách sạn - Nhà hàng</option>
                                        <option data-tokens="9" value="9">Nhân viên kinh doanh</option>
                                        <option data-tokens="10" value="10">Việc làm bán hàng</option>
                                        <option data-tokens="11" value="11">Cơ khí - Chế tạo</option>
                                        <option data-tokens="12" value="12">Lao động phổ thông</option>
                                        <option data-tokens="13" value="13">IT phần mềm</option>
                                        <option data-tokens="14" value="14">Marketing-PR</option>
                                        <option data-tokens="17" value="17">Giáo dục-Đào tạo</option>
                                        <option data-tokens="18" value="18">Kỹ thuật</option>
                                        <option data-tokens="19" value="19">Y tế-Dược</option>
                                        <option data-tokens="20" value="20">Quản trị kinh doanh</option>
                                        <option data-tokens="21" value="21">Dịch vụ</option>
                                        <option data-tokens="22" value="22">Biên-Phiên dịch</option>
                                        <option data-tokens="23" value="23">Dệt may - Da giày</option>
                                        <option data-tokens="24" value="24">Kiến trúc - Tk nội thất</option>
                                        <option data-tokens="25" value="25">Xuất,nhập khẩu</option>
                                        <option data-tokens="26" value="26">IT Phần cứng-mạng</option>
                                        <option data-tokens="27" value="27">Nhân sự</option>
                                        <option data-tokens="28" value="28">Thiết kế - Mỹ thuật</option>
                                        <option data-tokens="29" value="29">Tư vấn</option>
                                        <option data-tokens="30" value="30">Bảo vệ</option>
                                        <option data-tokens="31" value="31">Ô tô - xe máy</option>
                                        <option data-tokens="32" value="32">Thư ký-Trợ lý</option>
                                        <option data-tokens="33" value="33">KD bất động sản</option>
                                        <option data-tokens="34" value="34">Du lịch</option>
                                        <option data-tokens="35" value="35">Báo chí-Truyền hình</option>
                                        <option data-tokens="36" value="36">Thực phẩm-Đồ uống</option>
                                        <option data-tokens="37" value="37">Ngành nghề khác</option>
                                        <option data-tokens="38" value="38">Vật tư-Thiết bị</option>
                                        <option data-tokens="39" value="39">Thiết kế web</option>
                                        <option data-tokens="40" value="40">In ấn - Xuất bản</option>
                                        <option data-tokens="41" value="41">Nông-Lâm-Ngư-Nghiệp</option>
                                        <option data-tokens="42" value="42">Thương mại điện tử</option>
                                        <option data-tokens="43" value="43">Nhập liệu</option>
                                        <option data-tokens="44" value="44">Việc làm thêm tại nhà</option>
                                        <option data-tokens="45" value="45">Chăm sóc khách hàng</option>
                                        <option data-tokens="46" value="46">Sinh viên mới tốt nghiệp - Thực tập</option>
                                        <option data-tokens="47" value="47">Kỹ thuật ứng dụng</option>
                                        <option data-tokens="48" value="48">Bưu chính viễn thông</option>
                                        <option data-tokens="49" value="49">Dầu khí - Địa chất</option>
                                        <option data-tokens="50" value="50">Giao thông vận tải - Thủy lợi - Cầu đường</option>
                                        <option data-tokens="51" value="51">Khu chế xuất - Khu công nghiệp</option>
                                        <option data-tokens="52" value="52">Làm đẹp - Thể lực - Spa</option>
                                        <option data-tokens="53" value="53">Luật - Pháp lý</option>
                                        <option data-tokens="54" value="54">Môi trường - Xử lý chất thải</option>
                                        <option data-tokens="55" value="55">Mỹ phẩm - Thời trang - Trang sức</option>
                                        <option data-tokens="56" value="56">Ngân hàng - Chứng khoán - Đầu tư</option>
                                        <option data-tokens="57" value="57">Nghệ thuật - Điện ảnh</option>
                                        <option data-tokens="58" value="58">Phát triển thị trường</option>
                                        <option data-tokens="59" value="59">Phục vụ - Tạp vụ - Giúp việc</option>
                                        <option data-tokens="60" value="60">Quan hệ đối ngoại</option>
                                        <option data-tokens="61" value="61">Quản lý điều hành</option>
                                        <option data-tokens="62" value="62">Sản xuất - Vận hành sản xuất</option>
                                        <option data-tokens="63" value="63">Thẩm định - Giám thẩm định - Quản lý chất lượng</option>
                                        <option data-tokens="64" value="64">Thể dục - Thể thao</option>
                                        <option data-tokens="65" value="65">Hóa học - Sinh học</option>
                                        <option data-tokens="66" value="66">Bảo hiểm</option>
                                        <option data-tokens="67" value="67">Freelancer</option>
                                        <option data-tokens="68" value="68">Công chức - Viên chức </option>
                                     </select>
                                </div>
                                <div class="form-control">
                                <select id="candiexp" class=" valid error" name="candiexp">
                                    <option value="">Chọn kinh nghiệm bản thân *</option>
                                    <option value="0">Chưa có kinh nghiệm</option>
                                    <option value="1">Dưới 1 năm</option>
                                    <option value="2">1 năm</option>
                                    <option value="3">2 năm</option>
                                    <option value="4">3 năm</option>
                                    <option value="5">4 năm</option>
                                    <option value="6">5 năm</option>
                                    <option value="7">Trên 5 năm</option>
                                    </select>
                               </div>
                        </div>
                    </div>
                    <h5>Mục tiêu nghề nghiệp</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="canditarget" class="textarea" rows="7" cols="50" style="width:100%;" wrap="hard"><?php echo $userinfo->cv_muctieu ?></textarea>
                            </div>
                        </div>
                    </div>
                    <h5>Kỹ năng bản thân</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="candiskill" class="textarea" rows="7" cols="50" style="width:100%;" wrap="hard"><?php echo $userinfo->cv_kynang ?></textarea>
                            </div>
                        </div>
                    </div>
                    <h5>Giới thiệu chung</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="gioithieuchung" class="textarea" rows="7" cols="50" style="width:100%;" wrap="hard"><?php echo $userinfo->Description ?></textarea>

                            </div>
                        </div>
                    </div>
                    <h5>Mô tả kinh nghiệm</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="motaexp" class="textarea" rows="7" cols="50" style="width:100%;" wrap="hard"><?php echo $userinfo->Exp ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="form-group" style="float:left;width:100%;text-align:center;">
                <button type="button" class="btn btn-primary" id="luutaikhoan">Lưu</button>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</section>
<script src="js/jquery.numeric.js"></script>
<script src="js/moment.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script>
    $(document).ready(function(){
    var configulr='<?php echo base_url(); ?>';
    $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD-MM-YYYY'
    });
    var city='<?php echo $userinfo->CityID ?>';
    $('#citycandi').val('<?php echo $userinfo->CityID ?>').select2({ width: '100%',placeholder: 'Chọn tỉnh thành' });
    if(parseInt(city) > 0){
            $.ajax(
              {

                  url: configulr+"/site/GetListDistrict",
                  type: "POST",
                  data: { province: city },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {
                     var strhtml='<option value="">Chọn Quận, Huyện</option>';
                     if(obj.kq != ''){
                        var reponse=obj.kq;
                        $("#districtcandi option").remove();
                        var o1 = new Option('Chọn quận huyện', '');
                        $("#districtcandi").append(o1);
                      for (var i = 0; i < reponse.length; i++) {

                          var o = new Option(reponse[i].cit_name, reponse[i].cit_id);
                            $("#districtcandi").append(o);

                        }
                        $('#districtcandi').val('<?php echo $userinfo->district ?>').select2({ width: '100%',placeholder: 'Chọn quận huyện' });

                        }else{

                        }
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
        };

    $('#candisex').val('<?php echo $userinfo->Sex ?>').select2({ width: '100%',placeholder: 'Giới tính' });
    $('#candimarriage').val('<?php echo $userinfo->HonNhan ?>').select2({ width: '100%',placeholder: 'Tình trạng hôn nhân' });
    $('#xeploaihoctap').val('<?php echo $userinfo->xeploaihoctap ?>').select2({ width: '100%',placeholder: 'Xếp loại học tập' });
    $('#languagecandi').val('<?php echo $userinfo->language ?>').select2({ width: '100%',placeholder: 'Chọn ngôn ngữ' });
    $('#candibangcap').val('<?php echo $userinfo->cv_hocvan ?>').select2({ width: '100%',placeholder: 'Chọn bằng cấp' });
    $('#citycandimore').val('<?php echo $userinfo->city_extra ?>').select2({ width: '100%',placeholder: 'Nơi làm việc khác' });
    $('#districtcandi').val('<?php echo $userinfo->cv_loaihinh_id ?>').select2({ width: '100%',placeholder: 'Quận huyện làm việc' });
    $('#candihtlv').val('<?php echo $userinfo->cv_loaihinh_id ?>').select2({ width: '100%',placeholder: 'Hình thức làm việc' });

    $('#candicategory').val('<?php echo $userinfo->cv_cate_id ?>').select2({ width: '100%',placeholder: 'Ngành nghề mong muốn' });
    $('#candicapbac').val('<?php echo $userinfo->cv_capbac_id ?>').select2({ width: '100%',placeholder: 'Cấp bậc mong muốn' });
    $('#salarycandi').val('<?php echo $userinfo->cv_money_id ?>').select2({ width: '100%',placeholder: 'Chọn mức lương' });
    $('#candiexp').val('<?php echo $userinfo->cv_exp ?>').select2({ width: '100%',placeholder: 'Kinh nghiệm' });
    var tg='';
    var tg1='<?php echo $userinfo->cate_extra ?>';
        if(tg1 != null){
        tg=tg1.split(',');
        }
    $('#candicategorymore').val(tg).select2({ width: '100%',placeholder: 'Chọn ngành nghề khác' ,multiple: true, maximumSelectionLength: 2,minimumInputLength: 0 });

    $('#luutaikhoan').on('click',function(){
        if(validateedituser()){
            var nganhkhach=$('#candicategorymore').val();
            $.ajax({
                  url: configulr+"site/ajaxluuthongtinungvien",
                  type: "POST",
                  data: {
                        hoten: $('#namecandi').val(),
                        sodienthoai: $('#phonecandi').val(),
                        gioitinh: $('#candisex').val(),
                        tinhthanh: $('#citycandi').val(),
                        honnhan: $('#candimarriage').val(),
                        quanhuyen: $('#districtcandi').val(),
                        diachi: $('#diachicandi').val(),
                        truong: $('#school').val(),
                        xeploai: $('#xeploaihoctap').val(),
                        nganhhoc: $('#schooltype').val(),
                        ngonngu: $('#languagecandi').val(),
                        congviec: $('#jobwish').val(),
                        noilamvieckhac: $('#citycandimore').val(),
                        bangcap: $('#candibangcap').val(),
                        nganhnghe: $('#candicategory').val(),
                        hinhthuclv: $('#candihtlv').val(),
                        nganhnghekhac: nganhkhach.join(','),
                        capbac: $('#candicapbac').val(),
                        kinhnghiem: $('#candiexp').val(),
                        mucluong: $('#salarycandi').val(),
                        muctieu: $('#canditarget').val(),
                        kynang: $('#candiskill').val(),
                        ngaysinh:$('#txtngaysinh').val(),
                        gioithieuchung:$('#gioithieuchung').val(),
                        motaexp:$('#motaexp').val(),
                        email:$('#email').val()
                         },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                         alert(reponse.data);
                         window.location.href = configulr+"mn-candi-manager";
                      }
                      else {
                         alert(reponse.data) ;
                      }
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                       /*window.location.reload();*/
                  }
              });
        }
    });
    function validateedituser() {
        var flag = true;

        var hoten = $('#namecandi').val();
        var phone = $("#phonecandi").val();

        var city=$('#citycandi').val();
        var ngaysinh=$('#txtngaysinh').val();
        if ($.trim(ngaysinh) == '') {
            $($('#txtngaysinh')).attr('data-original-title', 'Nh?p ngày sinh').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#txtngaysinh').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }
            var gioitinh=$('#candisex').val();
        if($.trim(gioitinh)=='0'){
            $('#candisex').addClass('errorClass');
        }else{
            $('#candisex').removeClass('errorClass');
        }
            var honnhan=$('#candimarriage').val();
        if($.trim(honnhan)=='0'){
            $('#candimarriage').addClass('errorClass');
        }else{
            $('#candimarriage').removeClass('errorClass');
        }
            var cvtitle=$('#jobwish').val();
            var bangcap=$('#candibangcap').val();
        if($.trim(bangcap)=='0'){
            $('#candibangcap').addClass('errorClass');
        }else{
            $('#candibangcap').removeClass('errorClass');
        }
            var hinhthuclamviec=$('#candihtlv').val();
        if($.trim(hinhthuclamviec)=='0'){
            $('#candihtlv').addClass('errorClass');
        }else{
            $('#candihtlv').removeClass('errorClass');
        }
            var capbac=$('#candicapbac').val();
        if($.trim(capbac)=='0'){
            $('#candicapbac').addClass('errorClass');
        }else{
            $('#candicapbac').removeClass('errorClass');
        }
            var nganhnghe=$('#candicategory').val();
        if($.trim(nganhnghe)=='0'){
            $('#candicategory').addClass('errorClass');
        }else{
            $('#candicategory').removeClass('errorClass');
        }
            var muctieu=$('#canditarget').val();
        if ($.trim(muctieu) == '') {
            $($('#canditarget')).attr('data-original-title', 'Nhập mục tiêu').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#canditarget').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }
            var kynang=$('#candiskill').val();
        if ($.trim(kynang) == '') {
            $($('#candiskill')).attr('data-original-title', 'Nhập kỹ năng').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#candiskill').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }
        if ($.trim(hoten) == '') {
            $($('#namecandi')).attr('data-original-title', 'Nhập họ tên').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#namecandi').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(phone) == '') {
            $($('#phonecandi')).attr('data-original-title', 'Nhập số điện thoại').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#phonecandi').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }
        if($.trim(candicategorymore)=='0'){
            $('#candihtlv').addClass('errorClass');
        }else{
            $('#candihtlv').removeClass('errorClass');
        }
        if(city =='0'){
            flag = false;

        }
        return flag;
    };
    });
</script>
