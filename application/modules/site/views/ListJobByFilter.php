<?php

/**
 * @author GallerySoft.info
 * @copyright 2018
 */

//echo $querystring;
//print_r($city);
$CI=&get_instance();
$CI->load->model('site/site_model');
?>
<!-- Title Header Start -->
<section class="inner-header-title" style="background-image:url(images/banner-10.jpg);">
	<div class="container">
		<h1>Danh sách việc làm</h1>
	</div>
</section>
<div class="clearfix"></div>
<section class="brows-job-category">
				<div class="container">
					<!-- Company Searrch Filter Start -->
					<div class="row extra-mrg">
						<div class="wrap-search-filter filterchild">
							<form>
								<div class="col-md-4 col-sm-4">
									<input class="form-control" id="findkeyjob" placeholder="Nhập từ khóa" type="text">
								</div>
								<div class="col-md-3 col-sm-3">
									<select id="index_nganhnghe" class="city_ab form-control">
                                        <option data-tokens="0" value="0">Ngành nghề</option> 
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
								<div class="col-md-3 col-sm-3">
									<select id="index_dia_diem" class="city_ab">                        
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
								<div class="col-md-2 col-sm-2">
									<button name="submit" type="button" class="timvieclam btn btn-success full-width">Tìm kiếm</button>
								</div>
							</form>
						</div>
					</div>
					<!-- Company Searrch Filter End -->
					
					<!--Browse Job In Grid-->
					<div class="row extra-mrg listjob">
					   <?php if(!empty($itemjob)){
                              foreach($itemjob as $n){
                       ?>
                            <div class="col-md-4 col-sm-6">
    							<div class="grid-view brows-job-list">
    								<div class="brows-job-company-img">
    									<img src="<?= gethumbnail(geturlimageAvatar($n->usc_create_time).$n->usc_logo,$n->usc_logo,$n->usc_create_time,80,80,85) ?>" alt="<?php echo $n->usc_company ?>">
    								</div>
    								<div class="brows-job-position">
    									<h3><a target="_blank" href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html"; ?>"><?php echo $n->new_title ?></a> 
                                                                </h3>
    									<p><span>@ <?php echo $n->usc_company ?></span></p>
    								</div>
    								<div class="job-position">
    									<span class="job-num"><?php if(intval($n->new_so_luong) < 1){echo "1 vị trí";}else{ echo $n->new_so_luong." vị trí";} ?></span>
    								</div>
    								<div class="brows-job-type">
                                        <?php if($n->new_hinh_thuc > 0 && $n->new_hinh_thuc < 3){ ?>
                                                                  <span class="full-time"><?php echo GetTypeJob($n->new_hinh_thuc) ?></span>
                                                                  <?php }else if($n->new_hinh_thuc >= 3 && $n->new_hinh_thuc < 5) { ?>
                                                                  <span class="freelanc"><?php echo GetTypeJob($n->new_hinh_thuc) ?></span>
                                                                  <?php }else{ ?>
                                                                  <span class="part-time"><?php echo GetTypeJob($n->new_hinh_thuc)?></span>
                                        <?php } ?>
    								</div>
    								<ul class="grid-view-caption">
    									<li>
    										<div class="brows-job-location">
    											<p><i class="fa fa-map-marker"></i><?php echo Getcitybyindex($n->new_city) ?></p>
    										</div>
    									</li>
    									<li>
    										<p><span class="brows-job-sallery"><i class="fa fa-money"></i><?php echo GetLuong($n->new_money) ?></span></p>
    									</li>
    								</ul>
                                    <?php if($n->new_hot==1){ ?>
                                                                <span class="tg-themetag tg-featuretag">HOT</span>
                                                                <?php } ?>
                                                                <?php if($n->new_do==1||$n->new_cao==1){ ?>
                                                                <span class="tg-themetag tg-featuretag">VIP</span>
                                                                <?php } ?>
                                                                <?php if($n->new_gap==1){ ?>
                                                                <span class="tg-themetag tg-featuretag">Tuyển gấp</span>
                                                                <?php } ?>
    								
    							</div>
    						</div>
                                   
                                            
                         <?php } }else{
                            echo "<div class='col-md-12'><h5>Không tìm thấy kết quả phù hợp</h5></div>";
                         } ?> 
						
					</div>
					<!--/.Browse Job In Grid-->

					<div class="row">
						
                        <div class="pagation">
            						<?php echo $pagination; ?>
            					</div>
					</div>
					
				</div>
			</section>
<!-- Main Content -->


<script>
    jQuery( ".careerfy-click-btn" ).on('click', function (e) {
  jQuery( this ).parents('.careerfy-search-filter-toggle').find('.careerfy-checkbox-toggle').slideToggle( "slow", function() {});
  jQuery( this ).parents('.careerfy-search-filter-toggle').toggleClass( "careerfy-remove-padding", function() {});
   return false;
});
$(document).on('ready', function() {

});
function filledu(e)
{
var fillzero = $(e).attr("value");
window.location = window.location.href;
setCookie('jobedu', fillzero);
}
function filterlevel(e)
{
    var fillzero = $(e).attr("value");
window.location = window.location.href;
setCookie('joblevel', fillzero);
}
function fillexp(e)
{
    var fillzero = $(e).attr("value");
window.location = window.location.href;
setCookie('jobexperion', fillzero);
}
function fillupdate(e)
{
    var fillzero = $(e).attr("value");
window.location = window.location.href;
setCookie('jobupdate', fillzero);
}
function setCookie(key, value) {
var expires = new Date();
expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}
function delCookie(key) {
var expires = new Date();
expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
document.cookie = key + '=;expires=' + expires.toUTCString();
}
/*var delcook = new AllClearCooke();*/
$('#index_nganhnghe').select2({ width: 'calc(100%)' }).select2("val", "<?php echo $checkcat ?>");
$('#index_dia_diem').select2({ width: 'calc(100%)' }).select2("val", "<?php echo $checkpro ?>");

function clearcooke()
{
    delCookie('jobedu');
    delCookie('joblevel');
    delCookie('jobexperion');
    delCookie('jobupdate');
    window.location = '<?php echo base_url().'tin-tuyen-dung.html' ?>';
}
function load(elm){window.location = elm;}
</script>