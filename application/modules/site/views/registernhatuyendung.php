<?php ?>
<div class="container">

    <?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-top-30 padd-bot-30">
    <div class="container">
        <div class="row register">
            <h1 class="title titleregister">Đăng ký tài khoản nhà tuyển dụng</h1>
            <p style="text-align:center;">Đăng ký tài khoản nhà tuyển dụng</p>
        </div>
        <div class="row padd-bot-40">
            <div class="col-md-10 col-md-offset-1">
                <div class="registerform">
                    <h3 class="col-md-12"><i class="fa fa-plus-circle"></i> Thông tin đăng nhập <span>Bạn đã có tài khoản? <a>Đăng nhập</a></span></h3>
                    <div class="col-md-6">
                        <label>Số điện thoại <span style="font-weight:300;font-size:13">(SĐT là tài khoản để bạn đăng nhập)</span> *</label>
                        <div class="form-control">
                            <input type="text" name="username" autocomplete="off" class="" id="phonecompany" placeholder="Số điện thoại" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Mật khẩu <span  style="font-weight:300;font-size:13">(Mật khẩu tối thiểu 6 ký tự)</span> *</label>
                        <div class="form-control">
                            <input type="password" name="password" autocomplete="off" id="passcompany" class="" placeholder="Mật khẩu" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <div class="form-control">
                            <input type="email" name="email" autocomplete="off" id="usercompany" class="" placeholder="Email công ty" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Nhập lại mật khẩu *</label>
                        <div class="form-control">
                            <input type="password" name="retype-password" autocomplete="off" id="repasscompany" class="" placeholder="Nhập lại mật khẩu" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group lblcheck">
                            <input type="radio" name="accuracy" id="sendsms" value="2" checked="checked"><label for="sendsms">
                             Nhắn tin xác thực
                            </label>
                            <input type="radio" name="accuracy" id="sendsms1" value="1"><label for="sendsms1">
                              Gọi điện xác thực
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="row padd-top-20 padd-bot-20">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc">
                    <div class="row">
                        <h4><i class="fa fa-plus-circle"></i> Thông tin Công ty</h4>
                        <div class="col-md-12">
                            <label class="control-label">Tên công ty</label>
                        <div class="form-group">
                          <input type="text" name="company-name" autocomplete="off" class="form-control" id="namecompany" placeholder="Tên Công ty">
                        </div>
                        <label class="control-label">Tỉnh thành</label>
                        <div class="form-group">
                        <select id="citycompany" class="city_ab form-control">
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
                        <label class="control-label">Website</label>
                        <div class="form-group">
                          <input type="text" name="website" autocomplete="off" id="websitecompany" class="form-control" placeholder="Website">
                        </div>
                        <label class="control-label">Địa chỉ
                        </label>
                        <div class="form-group">
                          <input type="text" name="address" autocomplete="off" id="addresscompany" class="form-control" placeholder="Địa chỉ">
                        </div>
                        </div>
                     <div class="col-md-8 col-md-offset-2 text-center">
                        <div class="form-group checkboxcom">
                          <input type="checkbox" name="company-terms" id="company-terms" value="ok">
                          <label for="company-terms">Tôi đồng ý với <a href="javascript:void(0);">Điều khoản và điều kiện</a> của Vieclam123.vn</label>
                        </div>
                        <button name="submit" class="btn btn-primary btn-secondary btn-block dangkynhatuyendung" >Đăng ký ngay</button>
                      </div>

                    </div>
                </div>
            </div>
         </div>
    </div>
</section>
