<?php 
?>

<section class="inner-header-title padd-top-20 padd-bot-20" style="background-image:url(images/banner-10.jpg);">
	<div class="container">
		<div class="row">
            <div class="col-md-12"><h1 class="padd-0 mrg-0 text-center font-30">Tìm kiếm ứng viên</h1></div>
                <form class="frmparttime">
					<div class="col-md-4 col-sm-4">
									<input class="form-control" value="<?php if(!empty($filterkey['key'])&&$filterkey['key']!='all' ){ echo $filterkey['key'];} ?>" id="findparttime" aria-label="tìm việc" placeholder="Nhập tên công việc muốn tìm" type="text">
					</div>
                        <div class="col-md-3 col-sm-3">
									<select id="txtnnpartime" class="city_ab form-control">
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
									<select id="txtcityparttim" class="city_ab form-control">                        
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
									<button name="submit" type="button" class="timvieclampartime btn btn-success full-width">Tìm kiếm</button>
								</div>
							</form>
        </div>
	</div>
</section>
<div class="container">
    <?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-top-0">
    <div class="container">
        <div class="row">
            <div class="col-md-70 col-sm-12">
                <div class="vl_lc jobfulltime">
                    <div class="col-md-12 padd-0 mrg-bot-20"><div class="tit_hd">
                        <div class="ir_h3">
                           <h3><span>Kết quả tìm kiếm</span></h3>
                        </div>
                     </div>
                     </div>                    
                    <div class="resultsearch row">
                        <?php if(!empty($itemcandi)){
                            
                          foreach($itemcandi as $n){ 
                            
                            ?><div class="col-md-12 col-sm-12 vlthemmoi">
                                    <div class="main_itg">
                                        <div class="itemnews">
                                            <div class="itemnews_l">
                                                <a href="<?php echo base_url()."ung-vien/".vn_str_filter($n->Name)."-uv".$n->UserID.".html"; ?>" class="logouser">
                                                <?php if(!empty($n->Image)){?>
                                            <img alt="<?php echo $n->new_title ?>" src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),63,63,80) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                        <?php }else{ ?>
                                         <img src="<?= gethumbnail("images/no-image2.png","no-image2.png",strtotime($n->usc_create_time),63,40,80) ?>" alt="#" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                         <?php } ?>
                                                </a>                                                
                                                <span><?php if(!empty($n->Birth)){echo date("d/m/Y",strtotime($n->Birth));} ?></span>
                                            </div>
                                            <div class="itemnews_r">                                        
                                                <a href="<?php echo base_url()."ung-vien/".vn_str_filter($n->Name)."-uv".$n->UserID.".html"; ?>" class="item-uv-name" title="<?php echo $n->Name ?>"><?php echo $n->Name ?></a>
                                                <p><?php echo $n->Description ?></p>  
                                                <span class="btn btn-freelance"><?php echo GetLuong($n->cv_money_id) ?></span>
                                                <span class="btn"><?php echo Getcitybyindex($n->cv_city_id) ?></span>
                                                <span class="dadenghiday"><?php if(!empty($n->cv_exp)){echo Getexp($n->cv_exp); }else{echo "Chưa cập nhật";}   ?></span>                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          <?php
                             } }else{ 
                            ?>
                            <div class="col-md-12">Không tìm thấy bản ghí</div>
                            <?php } ?>
                    </div>                
                    <div class="row">
                     <div class="col-md-12">
                        <div class="pagation pull-right mrg-top-20">
          						<?php echo $pagination; ?>
           					</div>
                     </div>
                    </div>       
                </div>                
            </div>
            <div class="col-md-30 col-sm-12 col-right-search padd-l-0 allteacher">
                <div class="box_job_search topcompany">
                            <h3 class="title2">NHÀ TUYỂN DỤNG UY TÍN
                            </h3>
                            <div class="listcom">
                                 <div><a title="flc"><img src="images/logocty/flc.jpg" alt="flc" title="flc" /></a></div>
                                 <div><a title="gia sư toán"><img src="images/logocty/fpt.jpg" alt="fpt" title="fpt" /></a></div>
                                 <div><a title="gia sư lớp 12"><img src="images/logocty/samsung.jpg" alt="sam sung" title="sam sung" /></a></div>
                                 <div><a title="gia sư toán"><img src="images/logocty/sunhouse.jpg" alt="sunhouse" title="sunhouse" /></a></div>
                                 <div><a title="gia sư lớp 12"><img src="images/logocty/vietcombank.jpg" alt="vietcombank" title="vietcombank" /></a></div>
                                 <div><a title="gia sư toán"><img src="images/logocty/vingroup.jpg" alt="vingroup" title="vingroup" /></a></div>                                
                            </div>
                </div>
                <div class="box_job_search cate">
                 	<h3>NGÀNH NGHỀ TIÊU BIỂU</h3>
                 	<div class="main_sc">                    
                    <ul class="right_tg">
                        <?php if(!empty($topcat)){
                            foreach($topcat as $n){?>
                               <li><a href=""><?php echo $n->cat_name ?> <span>(<?php echo $n->tongbanghi ?>)</span></a></li> 
                            <?php }
                        } ?>                       
                    </ul>
                 </div>
              	</div>
            </div>
            
        </div>
        <div class="ad-banner">
            <img src="images/banner-10.jpg" class="adsimage" alt="quảng cáo" title="quảng cáo" />
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tit_hd">
                 <div class="ir_h3"><h3><span>Việc làm đang tuyển gấp</span></h3>
                 </div>
                 
                </div>
                <div class="">
                    <div class="giasutieubieu row">
                        <?php if(!empty($tinmoinhat)){
                            
                          foreach($tinmoinhat as $n){ 
                            
                            ?><div class="col-md-3 col-sm-12 featureitem">
                                    <div class="item_hd vip" data-object="<?php echo $n->new_id ?>" data-type="<?php echo $n->new_id ?>">
                                       <div class="company_logo">
                                          <a href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html"; ?>" title="<?php echo $n->new_title ?>">
                                            <?php if(!empty($n->Image)){?>
                                                <img alt="<?php echo $n->new_title ?>" src="<?= gethumbnail(geturlimageAvatar(strtotime($n->usc_create_time)).$n->usc_logo,$n->usc_logo,strtotime($n->usc_create_time),268,150,80) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                            <?php }else{ ?>
                                             <img src="<?= gethumbnail("images/no-image2.png","no-image2.png",strtotime($n->usc_create_time),268,171,80) ?>" alt="#" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                             <?php } ?>
                                          </a>
                                       </div>
                                       <div class="right_item">
                                            <a href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html"; ?>" title="<?php echo $n->new_title ?>" class="title_co"><?php echo $n->new_title ?> </a>
                                          <a  class="title_new"><?php echo $n->usc_company ?></a>                                  
                                          <span class="money_item">Từ: <span><?php echo GetLuong($n->new_money); ?></span></span>
                                          <span class="time_item"><?php echo Getcitybyindex($n->new_city) ?></span>
                                       </div>
                                    </div>
                                </div>
                          <?php
                             } }else{ 
                            ?>
                            <div>Không tìm thấy bản ghí</div>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="featured">
            <div class="tit_hd">
             <div class="ir_h3"><h3><span>Ứng viên mới nhất</span></h3>
             </div>
            </div>
            <div class="">
                <div class="giasutieubieu row">
                    <?php if(!empty($topcandi)){ ////ung-vien/tran-trong-long-uv35.html                        
                            foreach($topcandi as $n){                        
                        ?><div class="col-md-3 col-sm-12 featureitem">
                                <div class="item_hd vip" data-object="<?php echo $n->UserID ?>" data-type="<?php echo $n->UserID ?>">
                                   <div class="company_logo">
                                      <a href="<?php echo base_url()."ung-vien/".vn_str_filter($n->Name).'-uv'.$n->UserID.".html" ?>" title="<?php echo $n->Name ?>">
                                        <?php if(!empty($n->Image)){?>
                                            <img alt="<?php echo $n->new_title ?>" src="<?= gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),268,150,80) ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                        <?php }else{ ?>
                                         <img src="<?= gethumbnail("images/no-image2.png","no-image2.png",strtotime($n->usc_create_time),268,171,80) ?>" alt="#" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                         <?php } ?>
                                      </a>
                                   </div>
                                   <div class="right_item">
                                        <a href="<?php echo base_url()."ung-vien/".vn_str_filter($n->Name).'-uv'.$n->UserID.".html" ?>" title="<?php echo $n->Name ?>" class="title_co"><?php echo $n->Name ?> </a>
                                      <a href="<?php echo base_url()."ung-vien/".vn_str_filter($n->Name).'-uv'.$n->UserID.".html" ?>" title="<?php echo $n->Name ?>" class="title_new"><?php echo GetCategory(intval($n->cv_cate_id));  ?></a>                                   
                                      <span class="money_item">Từ: <span><?php echo GetLuong(intval($n->cv_money_id)) ?></span></span>
                                      <span class="time_item"><?php echo $n->CityName ?></span>
                                   </div>
                                </div>
                            </div>
                      <?php
                         } } 
                        ?>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="tit_hd">
                    <div class="ir_h3">
                        <h3>Việc làm ngành IT</h3>
                    </div>
                </div>
                <div class="vlthemmoi jobcategory">
                    <div class="main_itg">
                    <?php
                        if(!empty($jobit)){ 
                            foreach($jobit as $n){ ?>
                                <div class="itemnews">                                    
                                    <div class="itemnews_r">                                        
                                        <a href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html"; ?>" class="item-uv-name" title="<?php echo $n->new_title ?>"><?php echo $n->new_title ?></a>
                                        <p><?php echo $n->usc_company ?></p>  
                                        <span class="btn btn-freelance"><?php echo GetLuong($n->new_money) ?></span> 
                                        
                                        <span class="btn"><?php echo Getcitybyindex($n->new_city) ?></span>
                                        
                                        <span class="dadenghiday">Số lượng:&nbsp;&nbsp;<?php if(!empty($n->new_so_luong)){ echo $n->new_so_luong;}else{echo "1";}  ?><i class="fa fa-user-dnd"></i></span>                    
                                    </div>
                                </div>
                            <?php }
                        }else{
                            echo "<div class='col-md-12'>Không tìm thấy bản ghi.</div>";
                        } 
                    ?>
                     
                </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="tit_hd">
                    <div class="ir_h3">
                        <h3>Việc làm cấp quản lý</h3>
                    </div>
                </div>
                <div class="vlthemmoi jobcategory">
                    <div class="main_itg">
                    <?php
                        if(!empty($jobmanager)){ 
                            foreach($jobmanager as $n){ ?>
                                <div class="itemnews">                                    
                                    <div class="itemnews_r">                                        
                                        <a href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html"; ?>" class="item-uv-name" title="<?php echo $n->new_title ?>"><?php echo $n->new_title ?></a>
                                        <p><?php echo $n->usc_company ?></p>  
                                        <span class="btn btn-freelance"><?php echo GetLuong($n->new_money) ?></span> 
                                        
                                        <span class="btn"><?php echo Getcitybyindex($n->new_city) ?></span>
                                        
                                        <span class="dadenghiday">Số lượng:&nbsp;&nbsp;<?php if(!empty($n->new_so_luong)){ echo $n->new_so_luong;}else{echo "1";}  ?><i class="fa fa-user-dnd"></i></span>                    
                                    </div>
                                </div>
                            <?php }
                        }else{
                            echo "<div class='col-md-12'>Không tìm thấy bản ghi.</div>";
                        } 
                    ?>
                     
                </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="tit_hd">
                    <div class="ir_h3">
                        <h3>Sinh viên mới ra trường</h3>
                    </div>
                </div>
                <div class="vlthemmoi jobcategory">
                    <div class="main_itg">
                    <?php
                        if(!empty($jobstudent)){ 
                            foreach($jobstudent as $n){ ?>
                                <div class="itemnews">                                    
                                    <div class="itemnews_r">                                        
                                        <a href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html"; ?>" class="item-uv-name" title="<?php echo $n->new_title ?>"><?php echo $n->new_title ?></a>
                                        <p><?php echo $n->usc_company ?></p>  
                                        <span class="btn btn-freelance"><?php echo GetLuong($n->new_money) ?></span> 
                                        
                                        <span class="btn"><?php echo Getcitybyindex($n->new_city) ?></span>
                                        
                                        <span class="dadenghiday">Số lượng:&nbsp;&nbsp;<?php if(!empty($n->new_so_luong)){ echo $n->new_so_luong;}else{echo "1";}  ?><i class="fa fa-user-dnd"></i></span>                    
                                    </div>
                                </div>
                            <?php }
                        }else{
                            echo "<div class='col-md-12'>Không tìm thấy bản ghi.</div>";
                        } 
                    ?>
                     
                </div>
                </div>
            </div>
        </div>
        
    </div>
    
</section>
<script type="text/javascript">
	$(document).ready(function() {
	   var configulr='<?php echo site_url() ?>';
       $('#txtnnpartime').val(<?php echo $filterkey['nganh']; ?>).select2();
       $('#txtcityparttim').val(<?php echo $filterkey['tinh']; ?>).select2();
       $('.timvieclampartime').on('click',function(){
            var key=$('#findparttime').val();
            var nganh=$('#txtnnpartime').val();
            var tinh=$('#txtcityparttim').val();
            if(key !='' ||  nganh !='' || tinh !=''){
                $.ajax({
                  
                  url: configulr+"site/ajaxsearchcandi",
                  type: "POST",
                  data: { key:key,nganh:nganh,tinh:tinh },
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
                alert('Bạn phải chọn một trong các điều kiện');
            }
        });
	});
 </script>