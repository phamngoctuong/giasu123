<?php
//var_dump($tintuyendung);
//$catid=explode($tintuyendung->new_cat_id);
$gioitinh=getunsex($tintuyendung->new_gioi_tinh)
?>
<section class="padd-0">
    <div class="container">
        <div class="row">
            <div class="manager-col-left col-md-3 col-sm-12 width-250">
                <?php $this->load->view('left4'); ?>
            </div>
            <div class="manager-col-right col-md-9 col-sm-12">
                <div class="content-right right-uv" style="min-height:300px;">
                    <div class="fromdatime">
                        <div class="clr" style="height:10px;position: relative;"><a class="btnlogout"><i class="fa fa-logout"></i> Thoát</a></div>
                        <!--<div class="form-control">
                            <input type="text" id="datepiker" name="datepiker" placeholder="Chọn khoảng thời gian" />
                            <i class="fa fa-datetime"></i>
                        </div>-->
                    </div>
                    <div class="box-file-newest uvupdatesuccess">
                    <?php if($newid > 0){ ?>
                        <h4 class="title">Sửa thông tin tuyển dụng</h4>
                        <input type="hidden" id="txtidnew" value="<?php echo $newid; ?>" />
                        <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc" style="overflow: hidden;">
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Tiêu đề tuyển dụng</label>
                    <input type="text" id="txttieudetin" class="form-control" value="<?php echo $tintuyendung->new_title ?>" />
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                                <label>Ngành nghề</label>
                                <select id="index_nganhnghelv" class="form-control" multiple>
                                    <option  value="0">Ngành nghề</option>
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
                        <div class="col-md-6 col-sm-12">
                            <label>Nơi làm việc</label>
                            <select id="index_dia_diemlv" class="city_ab" multiple>
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
                    </div>

                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label>Bằng cấp</label>
                            <select id="txtbangcap" class="form-control">

                                         <option data-tokens="1" value="1">Tất cả trình độ</option>
                                                                            <option data-tokens="2" value="2">Sau đại học</option>
                                                                            <option data-tokens="3" value="3">Đại học</option>
                                                                            <option data-tokens="4" value="4">Cao đẳng</option>
                                                                            <option data-tokens="5" value="5">Trung cấp</option>
                                                                            <option data-tokens="6" value="6">Trung học</option>
                                                                            <option data-tokens="7" value="7">Khác</option>

                                    </select>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label>Kinh nghiệm</label>
                            <select id="txtkinhnghiem" class="form-control">
                                       <option data-tokens="" value="">Không yêu cầu kinh nghiệm</option>
                                        <option value="0">Chưa có kinh nghiệm</option>
                                        <option value="1">0 - 1 năm kinh nghiệm</option>
                                        <option value="2">1 - 2 năm kinh nghiệm</option>
                                        <option value="3">2 - 5 năm kinh nghiệm</option>
                                        <option value="4">5 - 10 năm kinh nghiệm</option>
                                        <option value="5">Hơn 10 năm kinh nghiệm</option>
                                      </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label>Mức lương</label>
                            <select class="mucluong form-control" id="txtmucluong">
                                  <option value="0">Chọn mức lương</option>
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
                        <div class="col-md-6 col-sm-12">
                            <label>Hình thức làm việc</label>
                            <select id="txthinhthuc" class="form-control">
                                       <option data-tokens="1" value="1">Toàn thời gian cố định</option>
                                                                            <option data-tokens="2" value="2">Toàn thời gian tạm thời</option>
                                                                            <option data-tokens="3" value="3">Bán thời gian cố định</option>
                                                                            <option data-tokens="4" value="4">Bán thời gian tạm thời</option>
                                                                            <option data-tokens="5" value="5">Hợp đồng</option>
                                                                            <option data-tokens="6" value="6">Khác</option>
                                      </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label>Giới tính</label>
                            <select class="mucluong form-control" id="txtgioitinh">
                                  <option value="">Giới tính</option>
                                  <option value="0">Không yêu cầu</option>
                                  <option data-tokens="1" value="1">Nam</option>
                                  <option data-tokens="2" value="2">Nữ</option>
                              </select>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label>Cấp bấc</label>
                            <select id="txtcapbac" class="form-control">
                                        <option data-tokens="0" value="0">Không yêu cầu</option>
                                        <option data-tokens="1" value="1">Mới tốt nghiệp</option>
                                                                            <option data-tokens="2" value="2">Thực tập sinh</option>
                                                                            <option data-tokens="3" value="3">Nhân viên</option>
                                                                            <option data-tokens="4" value="4">Trưởng phòng</option>
                                                                            <option data-tokens="5" value="5">Phó giám đốc</option>
                                                                            <option data-tokens="6" value="6">Giám đốc</option>
                                                                            <option data-tokens="7" value="7">Tổng giám đốc điều hành</option>
                                      </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Ngày hết hạn</label>

                        <div class='input-group date' id='datetimepicker1' style="width: 100%">
                                <input type='text' placeholder="Ngày hết hạn" id="txtngaysinh" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>

                </div>
                <div class="col-md-12 col-sm-12">
                    <label>Mô tả công việc</label>
                    <textarea id="txtmotacongviec" class="textarea" style="width: 100%;" rows="10"></textarea>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label>Yêu cầu hồ sơ</label>
                    <textarea id="txtyeucauhoso" class="textarea" style="width: 100%;" rows="10"></textarea>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label>Yêu cầu chung</label>
                    <textarea id="txtyeucau" class="textarea" style="width: 100%;" rows="10"></textarea>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label>Quyền lợi</label>
                    <textarea id="txtquyenloi" class="textarea" style="width: 100%;" rows="10"></textarea>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Là việc làm thêm?</label>
                    <select id="txtvieclamthem" class="form-control">
                        <option value="">Chọn ca làm việc</option>
                        <option value="2">Ca sáng(8h - 14h)</option>
                        <option value="3">Ca chiều(14h - 21h)</option>
                    </select>
                </div>
                <div class="clearfix" style="height:30px;float:left;width:100%;"></div>
                <div class="col-md-12">
                    <div class="fun">
                        <span class="btn btn-primary btn-success" id="savenews">Hoàn tất</span>
                        <span class="btn btn-primary btn-warning" onclick="window.location='<?php echo site_url('mn-company-manager-news') ?>'">Quay lại</span>
                    </div>
                </div>
                </div>
                    <?php }else{ ?>
                        <h4 class="title">Đăng tin tuyển dụng</h4>
                        <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc" style="overflow: hidden;">
                         <input type="hidden" id="txtidnew" value="<?php echo $newid; ?>" />
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Tiêu đề tuyển dụng</label>
                    <input type="text" id="txttieudetin" placeholder="Nhập tiêu đề tin tuyển dụng" class="form-control" value="<?php echo $tintuyendung->new_title ?>" />
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                                <label>Ngành nghề</label>
                                <select id="index_nganhnghelv" class="form-control" multiple>
                            <option  value="0">Ngành nghề</option>
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
                                                                            <option data-tokens="46" value="46">Sinh viên mới tốt nghiệp -
     Thực tập</option>
                                                                            <option data-tokens="47" value="47">Kỹ thuật ứng dụng</option>
                                                                            <option data-tokens="48" value="48">Bưu chính viễn thông</option>
                                                                            <option data-tokens="49" value="49">Dầu khí -
     Địa chất</option>
                                                                            <option data-tokens="50" value="50">Giao thông vận tải -
     Thủy lợi - Cầu đường</option>
                                                                            <option data-tokens="51" value="51">Khu chế xuất - Khu công nghiệp</option>
                                                                            <option data-tokens="52" value="52">Làm đẹp -
     Thể lực -
     Spa</option>
                                                                            <option data-tokens="53" value="53">Luật - Pháp lý</option>
                                                                            <option data-tokens="54" value="54">Môi trường - Xử lý chất thải</option>
                                                                            <option data-tokens="55" value="55">Mỹ phẩm -
     Thời trang -
     Trang sức</option>
                                                                            <option data-tokens="56" value="56">Ngân hàng - Chứng khoán - Đầu tư</option>
                                                                            <option data-tokens="57" value="57">Nghệ thuật - Điện ảnh</option>
                                                                            <option data-tokens="58" value="58">Phát triển thị trường</option>
                                                                            <option data-tokens="59" value="59">Phục vụ -
     Tạp vụ -
     Giúp việc</option>
                                                                            <option data-tokens="60" value="60">Quan hệ đối ngoại</option>
                                                                            <option data-tokens="61" value="61">Quản lý điều hành</option>
                                                                            <option data-tokens="62" value="62">Sản xuất -
     Vận hành sản xuất</option>
                                                                            <option data-tokens="63" value="63">Thẩm định - Giám thẩm định - Quản lý chất lượng</option>
                                                                            <option data-tokens="64" value="64">Thể dục -
     Thể thao</option>
                                                                            <option data-tokens="65" value="65">Hóa học -
     Sinh học</option>
                                                                            <option data-tokens="66" value="66">Bảo hiểm</option>
                                                                            <option data-tokens="67" value="67">Freelancer</option>
                                                                            <option data-tokens="68" value="68">Công chức - Viên chức </option>
                                    </select>

                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label>Nơi làm việc</label>
                            <select id="index_dia_diemlv" class="city_ab" multiple>
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
                    </div>

                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label>Bằng cấp</label>
                            <select id="txtbangcap" class="form-control">

                                         <option data-tokens="1" value="1">Tất cả trình độ</option>
                                                                            <option data-tokens="2" value="2">Sau đại học</option>
                                                                            <option data-tokens="3" value="3">Đại học</option>
                                                                            <option data-tokens="4" value="4">Cao đẳng</option>
                                                                            <option data-tokens="5" value="5">Trung cấp</option>
                                                                            <option data-tokens="6" value="6">Trung học</option>
                                                                            <option data-tokens="7" value="7">Khác</option>

                                    </select>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label>Kinh nghiệm</label>
                            <select id="txtkinhnghiem" class="form-control">
                                       <option data-tokens="" value="">Không yêu cầu kinh nghiệm</option>
                                        <option value="0">Chưa có kinh nghiệm</option>
                                        <option value="1">0 - 1 năm kinh nghiệm</option>
                                        <option value="2">1 - 2 năm kinh nghiệm</option>
                                        <option value="3">2 - 5 năm kinh nghiệm</option>
                                        <option value="4">5 - 10 năm kinh nghiệm</option>
                                        <option value="5">Hơn 10 năm kinh nghiệm</option>
                                      </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label>Mức lương</label>
                            <select class="mucluong form-control" id="txtmucluong">
                                  <option value="0">Chọn mức lương</option>
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
                        <div class="col-md-6 col-sm-12">
                            <label>Hình thức làm việc</label>
                            <select id="txthinhthuc" class="form-control">
                                       <option data-tokens="1" value="1">Toàn thời gian cố định</option>
                                                                            <option data-tokens="2" value="2">Toàn thời gian tạm thời</option>
                                                                            <option data-tokens="3" value="3">Bán thời gian cố định</option>
                                                                            <option data-tokens="4" value="4">Bán thời gian tạm thời</option>
                                                                            <option data-tokens="5" value="5">Hợp đồng</option>
                                                                            <option data-tokens="6" value="6">Khác</option>
                                      </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label>Giới tính</label>
                            <select class="mucluong form-control" id="txtgioitinh">
                                    <option value="">Giới tính</option>
                                    <option value="0">Không yêu cầu</option>
                                  <option data-tokens="1" value="1">Nam</option>
                                  <option data-tokens="2" value="2">Nữ</option>
                              </select>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label>Cấp bấc</label>
                            <select id="txtcapbac" class="form-control">
                                        <option data-tokens="0" value="0">Không yêu cầu</option>
                                        <option data-tokens="1" value="1">Mới tốt nghiệp</option>
                                                                            <option data-tokens="2" value="2">Thực tập sinh</option>
                                                                            <option data-tokens="3" value="3">Nhân viên</option>
                                                                            <option data-tokens="4" value="4">Trưởng phòng</option>
                                                                            <option data-tokens="5" value="5">Phó giám đốc</option>
                                                                            <option data-tokens="6" value="6">Giám đốc</option>
                                                                            <option data-tokens="7" value="7">Tổng giám đốc điều hành</option>
                                      </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Ngày hết hạn</label>

                        <div class='input-group date' id='datetimepicker1' style="width: 100%">
                                <input type='text' placeholder="Ngày hết hạn" id="txtngaysinh" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>

                </div>
                <div class="col-md-12 col-sm-12">
                    <label>Mô tả công việc</label>
                    <textarea rows="10" id="editor1" name="editor1" cols="70" rows="10" style="width: 100%;"/></textarea>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label>Yêu cầu hồ sơ</label>
                  <textarea rows="10" id="editor2" cols="70" rows="10" style="width: 100%;"/></textarea>
                </div>
                <div class="col-md-12 col-sm-12">
                    <label>Yêu cầu chung</label>


              			​<textarea rows="10" id="editor3" cols="70" rows="10" style="width: 100%;"/></textarea>
                </div>
                <div class="col-md-12 col-sm-12" colspan ="5">
                    <label>Quyền lợi</label>
                    <textarea rows="10" id="editor4" cols="70" rows="10" style="width: 100%;"/></textarea>
                </div>
                <div class="col-md-12 col-sm-12 form-group">
                    <label>Là việc làm thêm? (nếu bạn không chọn thì công việc bạn đăng sẽ là fulltime)</label>
                    <select id="txtvieclamthem" class="form-control">
                        <option value="">Chọn ca làm việc</option>
                        <option value="2">Ca sáng(8h - 14h)</option>
                        <option value="3">Ca chiều(14h - 21h)</option>
                    </select>
                </div>
                <div class="clearfix" style="height:30px;float:left;width:100%;"></div>
                <div class="col-md-12">
                    <div class="fun">
                        <span class="btn btn-primary btn-success" id="savenews">Hoàn tất</span>
                        <span class="btn btn-primary btn-warning" onclick="window.location='<?php echo site_url('mn-company-manager-news') ?>'">Quay lại</span>
                    </div>
                </div>
                </div>
                    <?php } ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="javascript/formCKEDITOR.js"></script>
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
    var newid='<?php echo $newid; ?>';
    var newgioitinh='<?php echo $gioitinh; ?>';
    if(parseInt(newid) > 0){
        var tgcat='<?php echo $tintuyendung->new_cat_id; ?>';
        var arcat=tgcat.split(',');
        $('#index_nganhnghelv').val(arcat).select2({ width: '100%',placeholder: 'Chọn ngành nghề' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
        tgcat='<?php echo $tintuyendung->new_city; ?>';
        arcat=tgcat.split(',');
        $('#index_dia_diemlv').val(arcat).select2({ width: '100%',placeholder: 'Chọn tỉnh thành' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
        $('#editor1').val('<?php echo trim($tintuyendung->new_mota); ?>')
        $('#editor2').val('<?php echo trim($tintuyendung->new_ho_so); ?>')
        $('#editor3').val('<?php echo trim($tintuyendung->new_yeucau); ?>')
        $('#editor4').val('<?php echo trim($tintuyendung->new_quyenloi); ?>')
        $('#txtkinhnghiem').val('<?php echo $tintuyendung->new_exp ?>');
        $('#txtbangcap').val('<?php echo $tintuyendung->new_bang_cap ?>');
        $('#txthinhthuc').val('<?php echo $tintuyendung->new_hinh_thuc ?>');
        $('#txtmucluong').val('<?php echo $tintuyendung->new_money ?>');
        $('#txtgioitinh').val(newgioitinh);
        $('#txtcapbac').val('<?php echo $tintuyendung->new_cap_bac ?>');
        $('#txtngaysinh').val('<?php echo date('d-m-Y',$tintuyendung->new_han_nop)  ?>');
        $('#txtvieclamthem').val('<?php echo trim($tintuyendung->new_type);?>')
    }else{
        $('#index_nganhnghelv').select2({ width: '100%',placeholder: 'Chọn ngành nghề' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
        $('#index_dia_diemlv').select2({ width: '100%',placeholder: 'Chọn tỉnh thành' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
        // $('#editor').val();
        // $('#editor1').val();
        // $('#editor2').val();
        // $('#editor3').val();

    };
     $('#savenews').on('click',function(){
       for (instance in CKEDITOR.instances) {
          CKEDITOR.instances[instance].updateElement();
        }
       //
       // alert($('#editor').val());
       //
       // alert($('#editor').val());

        if(validate()){
            $.ajax({

                  url: configulr+"site/ajaxluutindadang",
                  type: "POST",
                  data: {
                         id: $('#txtidnew').val(),
                         tieude:$('#txttieudetin').val(),
                         nganhnghe:$('#index_nganhnghelv').val(),
                         diadiem:$('#index_dia_diemlv').val(),
                         // mota:$('#editor').val(),
                         // yeucauhoso:$('#editor1').val(),
                         // yeucau:$('#editor2').val(),
                         // quyenloi:$('#editor3').val(),
                         mota:$('#editor1').val(),
                         yeucauhoso:$('#editor2').val(),
                         yeucau:$('#editor3').val(),
                         quyenloi:$('#editor4').val(),
                         kinhnghiem:$('#txtkinhnghiem').val(),
                         bangcap:$('#txtbangcap').val(),
                         hinhthuc:$('#txthinhthuc').val(),
                         luong:$('#txtmucluong').val(),
                         capbac:$('#txtcapbac').val(),
                         gioitinh:$('#txtgioitinh').val(),
                         ngayhethan:$('#txtngaysinh').val(),
                         parttime:$('#txtvieclamthem').val()
                         },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                            alert('Cập nhật thành công');
                            window.location.href=configulr+'/mn-company-manager-news';
                      }
                      else {
                         alert(reponse.msg) ;
                      }
                  },
                  error: function (xhr) {
                      alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                  },
                  complete: function () {

                  }
              });
        }else{
          alert("Bạn cần phải điền đầy đủ thông tin");
        }
     });
    function validate()
    {
        var flag=true;
        if($.trim($('#txttieudetin').val())==''){
            flag=false;
            $('#txttieudetin').addClass('errorClass');
        }else{
            $('#txttieudetin').removeClass('errorClass');
        }
        if($.trim($('#txtbangcap').val())=='0'){
            flag=false;
            $('#txtbangcap').addClass('errorClass');
        }else{
            $('#txtbangcap').removeClass('errorClass');
        }
        if($.trim($('#txthinhthuc').val())==''){
            flag=false;
            $('#txthinhthuc').addClass('errorClass');
        }else{
            $('#txthinhthuc').removeClass('errorClass');
        }
        if($.trim($('#txtmucluong').val())=='0'){
            flag=false;
            $('#txtmucluong').addClass('errorClass');
        }else{
            $('#txtmucluong').removeClass('errorClass');
        }
        if($.trim($('#txtcapbac').val())==''){
            flag=false;
            $('#txtcapbac').addClass('errorClass');
        }else{
            $('#txtcapbac').removeClass('errorClass');
        }
        if($.trim($('#txtgioitinh').val())==''){
            flag=false;
            $('#txtgioitinh').addClass('errorClass');
        }else{
            $('#txtgioitinh').removeClass('errorClass');
        }
        if($.trim($('#txtngaysinh').val())==''){
            flag=false;
            $('#datetimepicker1').addClass('errorClass');
        }else{
            $('#datetimepicker1').removeClass('errorClass');
        }
        if($.trim($('#index_nganhnghelv').val())==''){
            flag=false;
            $('.select2-container--default').addClass('errorClass');
        }else{
            $('.select2-container--default').removeClass('errorClass');
        }
        if($.trim($('#index_dia_diemlv').val())==''){
            flag=false;
            $('.select2-container--default').addClass('errorClass');
        }else{
            $('.select2-container--default').removeClass('errorClass');
        }
        // if($.trim($('#txtmotacongviec').val())==''){
        //     flag=false;
        //     $('#txtmotacongviec').addClass('errorClass');
        // }else{
        //     $('#txtmotacongviec').removeClass('errorClass');
        // }
        // if($.trim($('#txtyeucauhoso').val())==''){
        //     flag=false;
        //     $('#txtyeucauhoso').addClass('errorClass');
        // }else{
        //     $('#txtyeucauhoso').removeClass('errorClass');
        // }
        // if($.trim($('#txtyeucau').val())==''){
        //     flag=false;
        //     $('#txtyeucau').addClass('errorClass');
        // }else{
        //     $('#txtyeucau').removeClass('errorClass');
        // }
        // if($.trim($('#txtquyenloi').val())==''){
        //     flag=false;
        //     $('#txtquyenloi').addClass('errorClass');
        // }else{
        //     $('#txtquyenloi').removeClass('errorClass');
        // }
        return flag;
    }

    });
</script>
