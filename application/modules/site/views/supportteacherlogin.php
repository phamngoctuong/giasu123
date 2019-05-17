<?php ?>
<section class="padd-top-0">
    <div class="container huongdan">
        <div class="row">
        <div class="col-right col-md-3">
      	<div class="box_job_search thaotac">
            <h3>Hướng dẫn thao tác</h3>
            <div class="main_thaotac">
            <ul>
                <li class="active"><a>Hướng dẫn đăng ký tài khoản</a></li>
                <li><a>Hướng dẫn đăng nhập tài khoản</a></li>
                <li><a>Hướng dẫn đổi mật khẩu</a></li>
                <li><a>Hướng dẫn đăng tin tuyển dụng</a></li>
                <li><a>Hướng dẫn tìm kiếm hồ sơ</a></li>
                <li><a>Hướng dẫn gửi email phản hồi ứng viên</a></li>
                <li><a>Hướng dẫn đăng tải giấy phép kinh doanh</a></li>
                <li><a>Hướng dẫn lấy lại mật khẩu</a></li>
            </ul>
            </div>
      	</div>      	
      	
	    <div class="box_job_search user">
        	        <h3 style="    text-indent: 10px;"><i class="fa fa-userl"></i> Tìm kiếm lớp dạy</h3>
        	        <div class="main_sc">        
        	        	<form action="" method="post">	
        	        		<div class="input">
        		        		<input type="text" name="findkey" id="findkey" placeholder="Nhập từ khóa..." />
        		        	</div>
        		        	<div class="input">
        		        		<span class="icon-before"><img src="images/s_01.png" alt=""></span>
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
                                <span class="icon-before"><img src="images/s_01.png" alt=""></span>
                                <select id="chudehoc" class="city_ab_tag">                        
                                    <option value="" >Chọn chủ đề môn học</option>
                                                           
                                 </select>
                            </div>
        					<div class="input">
        						<span class="icon-before" style="top:8px"><img src="images/s_02.png" alt=""></span>
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
        						<span class="icon-before"><img src="images/icongioitinh.png" alt=""></span>
        						<select id="gioitinh" class="ngoaingu_ab_tag">                        
                                    <option value="" ></option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>                         
                                 </select>
        					</div>
        					<div class="input">
        						<span class="icon-before" style="top:8px"><img src="images/iconhinhthuchoc.png" alt=""></span>
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
	    <div class="box-social hdsocial">
            <div class="title_1">FanPage Timviec 365</div>
        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTimviec365.Vn&tabs&width=270&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="270" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        </div>
   	</div>
    <div class="col-left col-md-9 hdright">
      <div class="info">        
        <h3 class="title support"><i class="fa fa-info-circle"></i> Hướng dẫn đăng nhập tài khoản</h3>
      </div>
      <div class="content">
        <p>Việc đăng kí tài khoản gia sư trên Gia sư 365 rất đơn giản, Quý khách chỉ mất khoảng 1 phút để thực hiện theo các bước sau đây</p>
        <div class="step01"><h2><span><span>Bước 1:</span> Bấm vào nút <b>"Tạo tài khoản"</b> ở góc phải màn hình hoặc </span><a>bấm vào đây >></a></h2>            
        </div>
        <p><img src="images/buoc1.jpg" /></p>
        <div class="step01"><h2><span><span>Bước 2:</span> Chọn <b>"ĐĂNG NHẬP LÀM GIA SƯ"</b></span></h2>    
              
        </div>
        <p><img src="images/buoc2.jpg" /></p>  
        <div class="step01"><h2><span><span>Bước 3:</span> Nhập email và mật khẩu đã đăng ký sau đó bấm nút <b>"Đăng nhập"</b></span></h2>    
              
        </div>
        <p>Ngày ra Quý khách có thể chọn tích vào ô "Nhớ đăng nhập" để bật tính năng duy trì đăng nhập tài khoản</p>
        <p><center> <img src="images/buoc3.jpg" /></center></p>
        <br />
        <div class="infonews">
            <p>Như vậy, Quý khách đã hoàn thành xong việc đăng nhập tài khoản gia sư và có thể sử dụng các tính năng </p>
            <p><a>Cập nhật hồ sơ</a>
            và <a>Tìm kiếm lớp</a> phù hợp trên Gia sư 365</p>
            <p>Trường hợp Quý khách quên mật khẩu của tài khoản đã đăng ký, vui lòng <a>xem hướng dẫn lấy lại mật khẩu tại đây >></a></p>
            <hr />
            <div>Nếu gặp khó khăn trong quá trình thao tác, Quý khách vui lòng liên hệ tới bộ phận hỗ trợ Gia sư:</div>
            <ul>
                <li><b>Hotline: </b><span>1900633682</span></li>
                <li><b>Email: </b><a>timviec365.vn@gmail.com</a></li>
            </ul>
            <p>Gia sư 365 xin chúc Quý khách tìm được lớp dạy phù hợp</p>            
        </div>
        <br />
      </div>
      
      
   </div>
    
    </div>
    </div>
</section>
<script>
$(document).ready(function() {
    var configulr='<?php echo site_url() ?>';
$('#monhoc').select2({ width: '100%',placeholder:"Chọn môn học" });
       $('#chudehoc').select2({ width: '100%',placeholder: "Chọn chủ đề"});
       $('#gioitinh').select2({ width: '100%',placeholder:"Chọn giới tính" });
       $('#hinhthuchoc').select2({ width: '100%',placeholder:"Chọn hình thức học" });
       $('#tinhthanh').select2({ width: '100%',placeholder:"Chọn tỉnh thành" });
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
        $.ajax({
                  
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
});
</script>