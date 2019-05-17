<?php ?>
<div class="container">
    
    <?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-top-30 padd-bot-30">
    <div class="container">
        <div class="row register">
            <h1 class="title titleregister">Đăng ký tìm gia sư</h1>
            <p style="text-align:center;">Quý phụ huynh, học sinh vui lòng điền đầy đủ và chính xác thông tin bên dưới</p>
        </div>
        <div class="row padd-bot-40">
            <div class="col-md-10 col-md-offset-1">
                <div class="registerform">
                    <h3 class="col-md-12"><i class="fa fa-plus-circle"></i> Thông tin đăng nhập <span>Bạn đã có tài khoản? <a>Đăng nhập</a></span></h3>
                    <div class="col-md-6">
                        <label>Họ tên đầy đủ *</label>
                        <div class="form-control"><input type="text" id="txthoten" /></div>
                    </div>
                    <div class="col-md-6">
                        <label>Mật khẩu <span  style="font-weight:300;font-size:13">(Mật khẩu tối thiểu 6 ký tự)</span> *</label>
                        <div class="form-control"><input type="password" id="txtpass" /></div>
                    </div>
                    <div class="col-md-6">
                        <label>Số điện thoại <span style="font-weight:300;font-size:13">(SĐT là tài khoản để bạn đăng nhập)</span> *</label>
                        <div class="form-control"><input type="text" id="txtusername" /></div>
                    </div>
                    <div class="col-md-6">
                        <label>Nhập lại mật khẩu *</label>
                        <div class="form-control"><input type="password" id="txtrepass" /></div>
                    </div>
                    <div class="col-md-12">
                    
                               <div class="form-group lblcheck">
                        <input type="checkbox" id="sendsms" value="1"><label for="sendsms">
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
                        <h4><i class="fa fa-plus-circle"></i> Mô tả yêu cầu tìm gia sư</h4>
                        <div class="col-md-10 col-md-offset-1">
                            <label>Tóm tắt yêu cầu tìm gia sư</label>
                            <div class="form-control">
                                <input type="text" placeholder="Ví dụ: Tìm gia sư tiếng Anh lớp 1 tại Hoàn Kiếm" id="txtclassname" />
                            </div>
                            <label>Yêu cầu gia sư là</label>
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
                            <div class="form-inline">
                                <label style="margin-right:30px;">Giới tính: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" checked="checked" name="location1" id="location1" type="checkbox">
                                    <label for="location1">Nam</label>                                     
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2"  name="location2" id="location2" type="checkbox">
                                    <label for="location2">Nữ</label>                                     
                                </div>
                            </div>
                            <label>Môn học</label>
                            <div class="form-control">
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
                            <label>Lớp hoặc chủ đề môn học <span>(Chọn lớp hoặc chủ đề giúp giáo viên tìm kiếm bạn dễ hơn)</span></label>
                            <div class="form-group">
                                <ul class="ultopic">
                                    
                                </ul>
                            </div>
                            <label>Số lượng học sinh</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập số lượng học sinh" id="txtsohocsinh" />
                            </div>
                            <label>Số giờ học 1 buổi</label>
                            <div class="form-inline durationtime"> 
                                <div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="1" id="duration1" checked=""><label for="duration1">1h</label>
                                </div>                               
                          		<div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="1.5" id="duration2"><label for="duration2">1.5h</label>
                                </div>
                                <div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="2" id="duration3" ><label for="duration3">2h</label>
                                </div>
                                <div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="2.5" id="duration4"><label for="duration4">2.5h</label>
                                </div>    								        
                            </div>
                            <div class="form-inline">
                                <label style="margin-right:30px;">Hình thức học: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" checked="checked" name="teachtype" id="teachtype" type="radio">
                                    <label for="teachtype">Gia sư tại nhà</label>                                     
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2"  name="teachtype" id="teachtype1" type="radio">
                                    <label for="teachtype1">Online trực tuyến</label>                                     
                                </div>
                                
                            </div>
                            <label>Học phí dự kiến</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập học phí dự kiến" id="txthocphi"/>
                            </div>
                            <label>Địa chỉ email</label>
                            <div class="form-control">
                                <input type="text" placeholder="Địa chỉ email" id="txtemail" />
                            </div>
                            <label>Điện thoại liên hệ</label>
                            <div class="form-control">
                                <input type="text" placeholder="Số điện thoại liên hệ" id="txtphone" />
                            </div>
                            <label>Địa điểm diễn ra lớp học</label>
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
                            <label>Địa chỉ cụ thể diễn ra lớp học</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập địa chỉ diễn ra lớp học" id="txtdiachilop"/>
                            </div>
                            <label>Buổi có thể học <span>(Bấm để chọn những buổi bạn có thể học)</span></label>
                            <div class="detaijob-body2 lichday checklichday">
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 2
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CMonMorning" type="checkbox" name="CMonMorning" value="1">
                                            <label class="" for="CMonMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CMonAfter" type="checkbox" name="CMonAfter" value="1">
                                            <label class="" for="CMonAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CMonNight" type="checkbox" name="CMonNight" value="1">
                                            <label class="" for="CMonNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div> 
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 3
                                 </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CTueMorning" type="checkbox" name="CTueMorning" value="1">
                                            <label class="" for="CTueMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CTueAfter" type="checkbox" name="CTueAfter" value="1">
                                            <label class="" for="CTueAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CTueNight" type="checkbox" name="CTueNight" value="1">
                                            <label class="" for="CTueNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 4
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CWeMorning" type="checkbox" name="CWeMorning" value="1">
                                            <label class="" for="CWeMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CWeAfter" type="checkbox" name="CWeAfter" value="1">
                                            <label class="" for="CWeAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CWeNight" type="checkbox" name="CWeNight" value="1">
                                            <label class="" for="CWeNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 5
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CThuMorning" type="checkbox" name="CThuMorning" value="1">
                                            <label class="" for="CThuMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CThuAfter" type="checkbox" name="CThuAfter" value="1">
                                            <label class="" for="CThuAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CThuNight" type="checkbox" name="CThuNight" value="1">
                                            <label class="" for="CThuNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 6
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CFriMorning" type="checkbox" name="CFriMorning" value="1">
                                            <label class="" for="CFriMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CFriAfter" type="checkbox" name="CFriAfter" value="1">
                                            <label class="" for="CFriAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CFriNight" type="checkbox" name="CFriNight" value="1">
                                            <label class="" for="CFriNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 7
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CSatMorning" type="checkbox" name="CSatMorning" value="1">
                                            <label class="" for="CSatMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CSatAfter" type="checkbox" name="CSatAfter" value="1">
                                            <label class="" for="CSatAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CSatNight" type="checkbox" name="CSatNight" value="1">
                                            <label class="" for="CSatNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Chủ nhật
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CSunMorning" type="checkbox" name="CSunMorning" value="1">
                                            <label class="" for="CSunMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CSunAfter" type="checkbox" name="CSunAfter" value="1">
                                            <label class="" for="CSunAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CSunNight" type="checkbox" name="CSunNight" value="1">
                                            <label class="" for="CSunNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>                                                                           
                            </div>
                            <div class="clearfix"></div>
                            <label>Mô tả chi tiết nội dung</label>
                            <div class="">
                                <textarea id="chitietnoidung" name="chitietnoidung" placeholder="Chi tiết nội dung" rows="5" cols="30"></textarea>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-12 captchavalue">
                    <div class="form-group lblcheck">
                        <input type="checkbox" id="dongydieukhoan" /><label for="dongydieukhoan">
                         Tôi cam kết thông tin tạo lớp là thật và không thu bất kỳ phí nào của giáo viên. Tôi chấp nhận các quy định của Giasu365.
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="fun">
                        <span class="btn btn-primary btn-success" id="dangkytaikhoan">Hoàn tất</span>
                        <span class="btn btn-primary btn-warning">Làm lại</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/jquery.numeric.js"></script>
<script src="js/common.js"></script>
<script>
    $(document).ready(function () {
        var self=this;
        $("#txthocphi").numeric();
        $('#txtsohocsinh').numeric();
        $('#txtusername').numeric();
        var configulr='<?php echo base_url(); ?>';
        $('#txtteachtype').select2();
        $('#monhoc').select2();
        $('#txtcityclass').select2();
        $('#monhoc').change(function () {
            var monhoc=$(this).val();
            if(monhoc != '' || monhoc !=0){
                    $.ajax(
              {
                  
                  url: configulr+"/site/AjaxchudeCheckbox",
                  type: "POST",
                  data: { idmon: monhoc },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {
                     
                     if(obj.kq != ''){
                        var reponse=obj.kq;
                        $(".ultopic li").remove();                        
                            $(".ultopic").append(obj.data);
                        /*$(".ultopic").select2();*/
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
        $('#dangkytaikhoan').on('click',function(){
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
            if(typeof($('input[id=sendsms]:checked').val())!=='undefined'){
                sendsms=$('input[id=sendsms]:checked').val();
            }
            if(self.validatephuhuynh() && typeof($('input[id=dongydieukhoan]:checked').val())!=='undefined'){
            $.ajax(
              {
                  
                  url: configulr+"/site/ajaxuserregistersuccess",
                  type: "POST",
                  data: { 
                        hoten:$('#txthoten').val(),
                        password:$('#txtpass').val(),
                        username:$('#txtusername').val(),
                        topicarr:tg.join(),
                        classname:$('#txtclassname').val(),
                        teachertype:$('#txtteachtype').val(),
                        teachersex:sexteach.join(),
                        monhoc:$('#monhoc').val(),
                        tenmonhoc:$('#monhoc option:selected').text(),
                        studens:$('#txtsohocsinh').val(),
                        hours:$('input[name=duration]:checked').val(),
                        workid:$('input[name=teachtype]:checked').val(),
                        money:$('#txthocphi').val(),
                        email:$('#txtemail').val(),
                        phone:$('#txtphone').val(),
                        cityid:$('#txtcityclass').val(),
                        cityname:$('#txtcityclass option:selected').text(),
                        address:$('#txtdiachilop').val(),
                        descclass:$('#chitietnoidung').val(),
                        sang2:sang2,
                        chieu2:chieu2,
                        toi2:toi2,
                        sang3:sang3,
                        chieu3:chieu3,
                        toi3:toi3,
                        sang4:sang4,
                        chieu4:chieu4,
                        toi4:toi4,
                        sang5:sang5,
                        chieu5:chieu5,
                        toi5:toi5,
                        sang6:sang6,
                        chieu6:chieu6,
                        toi6:toi6,
                        sang7:sang7,
                        chieu7:chieu7,
                        toi7:toi7,
                        sang8:sang8,
                        chieu8:chieu8,
                        toi8:toi8,
                        sms:sendsms
                        },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                            alert('Bạn đã đăng ký thành công tài khoản gia sư, bạn vui lòng kiểm tra email để xác nhận tài khoản. Một cuộc gọi đến số điện thoại của bạn để thông báo mã xác thực');
                          var urlredirect=configulr+"kichhoattaikhoan&c="+reponse.code+"&u="+reponse.uname;
                          window.location.href = urlredirect;
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
              }
        });
        self.validatephuhuynh=function(){
             var flag = true;
                var uemail = $('#txthoten').val();
                if ($.trim(uemail) == '') {
                    $($('#txthoten')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txthoten').data("title", "").removeClass("errorClass");
                }
             if ($.trim($('#txtpass').val()) == '') {
                    $($('#txtpass')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtpass').data("title", "").removeClass("errorClass");
                }
             if ($.trim($('#txtrepass').val()) == '') {
                    $($('#txtrepass')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtrepass').data("title", "").removeClass("errorClass");
                }   
            var pass = $("#txtpass").val();
            var repass = $("#txtrepass").val();
             if (checkPassword(pass, $('#txtpass')) == 1) {
                flag = false;
            }
            if (checkPassword(repass, $('#txtrepass')) == 1) {
                flag = false;
            }
            if (checkPassword(pass, $('#ctrlrepasstxt')) == 0 && pass != repass) {
                $($('#ctrlpasstxt')).tooltip('hide').attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('show').addClass('errorClass');
                flag = false;
            }
            if ($.trim($('#txtclassname').val()) == '') {
                    $($('#txtclassname')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtclassname').data("title", "").removeClass("errorClass");
                }
                if ($.trim($('#txtteachtype').val()) == '') {
                    $($('#select2-txtteachtype-container')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#select2-txtteachtype-container').data("title", "").removeClass("errorClass");
                }
                if ($.trim($('#monhoc').val()) == '') {
                    $($('#select2-monhoc-container')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#select2-monhoc-container').data("title", "").removeClass("errorClass");
                }
                if ($.trim($('#txtsohocsinh').val()) == '') {
                    $($('#txtsohocsinh')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtsohocsinh').data("title", "").removeClass("errorClass");
                }
                if ($.trim($('#txthocphi').val()) == '') {
                    $($('#txthocphi')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txthocphi').data("title", "").removeClass("errorClass");
                }
                if ($.trim($('#txtemail').val()) == '') {
                    $($('#txtemail')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtemail').data("title", "").removeClass("errorClass");
                }
                if ($.trim($('#txtemail').val()) == '') {
                    $($('#txtemail')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtemail').data("title", "").removeClass("errorClass");
                }
                if ($.trim($('#txtemail').val()) != '') {
                    if (!Common.IsValidEmail($('#txtemail').val())) {
                        $($('#txtemail')).tooltip('hide').attr('data-original-title', 'Email không hợp lệ').tooltip('show').addClass('errorClass');
                        flag = false;
                    } else {
                        $('#txtemail').data("title", "").removeClass("errorClass").tooltip("hide");
                    }
                }
                if ($.trim($('#txtphone').val()) == '') {
                    $($('#txtphone')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtphone').data("title", "").removeClass("errorClass");
                }
                if ($.trim($('#txtdiachilop').val()) == '') {
                    $($('#txtdiachilop')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtdiachilop').data("title", "").removeClass("errorClass");
                }
                if ($.trim($('#txtcityclass').val()) == '') {
                    $($('#select2-txtcityclass-container')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#select2-txtcityclass-container').data("title", "").removeClass("errorClass");
                }
                if(typeof($('input[id=dongydieukhoan]:checked').val())==='undefined'){
                    flag = false;
                }
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
        };
    });
</script>