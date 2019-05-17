<?php $ui=$_SESSION['UserInfo']; ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left'); ?>
        </div>
        <?php if($ui['Type']==1){ ?>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right " style="min-height:300px;">
                <div class="clr" style="height:10px;position: relative;"><a id="btnlogout" class="btnlogout"><i class="fa fa-logout"></i> Thoát</a></div>
                <div class="clr" style="height:50px;"></div>
                <div class="ntdsearchuvhome">
                    <div class="box-searchuv">
                        <div class="title">Tìm kiếm hồ sơ</div>
                    <div class="from-search-ntd">
                        <div class="form-control"><input type="text" id="findkey" name="findkey" placeholder="Nhập từ khóa"/> <i class="fa fa-searchbtn"></i></div>
                        <div class="clr"></div>
                        <select id="txtmonhoc" class="nganhnghe_ab_tag">                        
                            <option ></option>
                            <?php 
                                    if(!empty($monhoc)){
                                        foreach($monhoc as $n){ ?>
                                            <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                        <?php }
                                    }
                                ?>                    
                         </select>
                        <div class="clr"></div>
                        <select id="txtchude" class="city_ab_tag">                        
                            <option ></option>
                            <option>Toán lớp 1</option>                         
                         </select>
                         <div class="clr"></div>
                        <select id="txthinhthuchoc" class="kinhnghiem_ab_tag">                        
                            <option value="">Chọn hình thức dạy</option><option value="1">(Offline) Gặp mặt</option><option value="2">(Online) Trực tuyến</option>                     
                         </select>
                         <div class="clr"></div>
                        <select id="txtinhthanh" class="mucluong_ab_tag">                        
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
                        <div class="clr"></div>
                        <select id="txtgioitinh" class="ngoaingu_ab_tag">                        
                            <option value="" ></option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>                          
                         </select>
                         
                         <div class="clr"></div>
                         <a class="btn btnsearchuv">Tìm kiếm</a>
                    </div>                    
                    </div>
                    <div class="box-view">
                        <div class="hosoungtuyen">
                            <a>300.000+</a>
                            <span>Hồ sơ ứng tuyển</span>
                        </div>
                        <div class="nguoitimviec">
                            <a>100.000+</a>
                            <span>Người tìm việc</span>
                        </div>
                        <div class="luotungtuyen">
                            <a>300.000+</a>
                            <span>Lượt ứng tuyển</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
	   var configulr='<?php echo base_url(); ?>';
		$('#txtmonhoc').select2({ width: '100%',placeholder:"Chọn môn học" });
        $('#txtchude').select2({ width: '100%',placeholder:"Chọn chủ đề" });
        $('#txthinhthuchoc').select2({ width: '100%',placeholder:"Hình thức học" });
        $('#txtinhthanh').select2({ width: '100%',placeholder:"Chọn tỉnh thành" });
        $('#txtgioitinh').select2({ width: '100%',placeholder:"Chọn giới tính" });
        
     $('#txtmonhoc').change(function () {
            var monhoc=$(this).val();
            if(monhoc != '' || monhoc !=0){
                    $.ajax(
              {
                  
                  url: configulr+"site/Ajaxchude",
                  type: "POST",
                  data: { idmon: monhoc },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {
                     
                     if(obj.kq != ''){
                        var reponse=obj.kq;
                        $("#txtchude option").remove();                        
                            $("#txtchude").append(obj.data);                           
                        
                        $("#txtchude").select2();
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
        var strsubj=$('#txtmonhoc').val();
        var strtopic=$('#txtchude').val();
        var strtinhthanh=$('#txtinhthanh').val();
        var strgioitinh=$('#txtgioitinh').val();
        var strtype=$('#txthinhthuchoc').val();
        if(findkey != ''){
        $.ajax(
              {
                    url: configulr+"site/searchteacher",
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
        }else{
            $('#findkey').addClass('errorClass');
        }
    })
	});
</script>