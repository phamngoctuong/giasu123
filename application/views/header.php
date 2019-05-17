<?php $urlweb= current_url();
// pr($_SESSION);
$urlindex=$_SERVER['REQUEST_URI'];
if(strpos($urlindex,'index.php')){
  $searchindex=array('index.php/?','index.php?/','index.php/','index.php?','index.php');
  foreach ($searchindex as $keyurl) {
    if(strpos($urlindex,$keyurl)){
      $replace='';
      $urlnew=str_replace($keyurl,$replace,$urlindex);
      break;
    }
  }
  if(!empty($urlnew)){
    redirect('http://localhost/ubuntu/giasu123'.$urlnew);
  }
}
$CI=&get_instance();
$CI->load->model('site/site_model');
$lstitem=$CI->site_model->GetTeacherType(12);
$monhoc=$CI->site_model->ListSubject();
$urlgiasu=site_url('dang-nhap-chung');
$urldangtin=site_url('dang-ky-chung');
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    $view = "viewavatar";
    $tg=$_SESSION['UserInfo'];
    if($tg['Type']==0){
        $urlgiasu=site_url('mn-hv-dang-tin');
    }
    if($tg['Type']==4){
        $urldangtin=site_url('mn-company-addnew');
    }
  }else{
    $view = "viewavatar1";
  }
   if(isset($_SESSION['filterhome']))
    {
         $tg=$_SESSION['filterhome'];
         $keyhome=$tg['key'];
        $idsub=$tg['sub'];
        $place=$tg['place'];
    }

    $uri=$this->uri->segment(1);
    $string=explode('-',$uri);

    if(!empty($uri)){
      if($string[3]=='su' && $string[1]!='su'){
        $keyhome=2;
      }elseif($string[1]=='su' || substr($string[1],0,4)=='vien' || ($uri='tat-ca-giao-vien')){
      // }elseif(($string[0]=='gia' && $string[1]=='su') || $uri='tat-ca-giao-vien'){
        $keyhome=1;
      }
    }else{
      $keyhome='';
    }

    if(!empty($string)){
      $count=count($string)-1;
      $array=explode('_',$string[$count]);
      $search=array('s','c','r');
      $replace='/';
      $string2=str_replace($search,$replace,$array[0]);
      $array2=explode('/',$string2);
      if(!empty($array2[1])){
        $idsub=$array2[1];
        $idlophoc=$array2[3];
      }
    }
    $tinhthanh=array(
      1=>'Hà Nội',
      45=>'Hồ Chí Minh',
      49=>'An Giang',
      47=>'Bà Rịa Vũng Tàu',
      3=>'Bắc Giang',
      4=>'Bắc Kạn',
      50=>'Bạc Liêu',
      5=>'Bắc Ninh',
      52=>'Bến Tre',
      46=>'Bình Dương',
      51=>'Bình Phước',
      31=>'Bình Thuận',
      30=>'Bình Định',
      53=>'Cà Mau',
      48=>'Cần Thơ',
      6=>'Cao Bằng',
      34=>'Gia Lai',
      10=>'Hà Giang',
      11=>'Hà Nam',
      35=>'Hà Tĩnh',
      9=>'Hải Dương',
      2=>'Hải Phòng',
      56=>'Hậu Giang',
      8=>'Hòa Bình',
      12=>'Hưng Yên',
      28=>'Khánh Hòa',
      57=>'Kiên Giang',
      36=>'Kon Tum',
      14=>'Lai Châu',
      29=>'Lâm Đồng',
      15=>'Lạng Sơn',
      13=>'Lào Cai',
      58=>'Long An',
      17=>'Nam Định',
      37=>'Nghệ An',
      16=>'Ninh Bình',
      38=>'Ninh Thuận',
      18=>'Phú Thọ',
      39=>'Phú Yên',
      40=>'Quảng Bình',
      41=>'Quảng Nam',
      42=>'Quảng Ngãi',
      19=>'Quảng Ninh',
      43=>'Quảng Trị',
      59=>'Sóc Trăng',
      20=>'Sơn La',
      61=>'Tây Ninh',
      21=>'Thái Bình',
      22=>'Thái Nguyên',
      44=>'Thanh Hóa',
      27=>'Thừa Thiên Huế',
      60=>'Tiền Giang',
      62=>'Trà Vinh',
      23=>'Tuyên Quang',
      63=>'Vĩnh Long',
      24=>'Vĩnh Phúc',
      25=>'Yên Bái',
      26=>'Đà Nẵng',
      32=>'Đắk Lắk',
      33=>'Đắk Nông',
      7=>'Điện Biên',
      55=>'Đồng Nai',
      54=>'Đồng Tháp'
    );
    if($array2[1]==0 || empty($array2[1])){
      $lophoc=$this->db->get('lophoc')->result();
    }elseif($array2[1]>0){
      $danhsachmonhoc=$this->db->select('areaclass');
      $danhsachmonhoc=$this->db->get_where('subject',array('id'=>$array2[1]))->row();
      // pr($danhsachmonhoc->areaclass);
      if(!empty($danhsachmonhoc->areaclass)){
        $queryfind='select id,name from lophoc where id IN('.$danhsachmonhoc->areaclass.')';
        $lophoc=$this->db->query($queryfind)->result();
      }
    }
?>
<!-- Start Navigation -->
			<nav class="<?php echo $classheader?> <?php if(!$showsearch){ echo "navnosearch"; }?>">

				<div class="container">
					<button type="button" name="menun1" aria-label="menun1" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
						<i class="fa fa-bars"></i>
					</button>
					<!-- Start Header Navigation -->
					<div class="navbar-header">
						<a class="navbar-brand" href="<?php echo base_url() ?>">
                        <?php if(!$home){ ?>
							<img src="images/logo-2.png" class="logo logo-display" alt="Gia sư 123">
                            <?php }else{ ?>
                            <img src="images/logo-2.png" class="logo logo-display" alt="Gia sư 123">
                            <?php } ?>
						</a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling animated  animated data-in="fadeInDown" data-out="fadeOutUp" animated data-in="fadeInDown" data-out="fadeOutUp"-->
					<div class="collapse navbar-collapse" id="navbar-menu">

						<ul class="nav navbar-nav top_head <?php if(!$showsearch){ echo "nosearch"; }?>" >

                          <li  class="<?php echo $view?>" style="Background:white;margin-right:10px;border-radius:10px">
                              <span >
                            <img src="images/avatar.png" alt="ảnh giao diện" class="imgavatar" style="margin-left:20px">
                            <a href="#" style="margin-left:20px"> <?php echo $_SESSION['UserInfo']['FullName']?> </a>
                          </span>
                          </li>
                          <li  class="<?php echo $view?>">
                              <?php if($userinfo['Type']==1){ ?>
                                  <li ><a class="<?php echo $view?>" rel="nofollow" href="<?php echo base_url() ?>giao-vien-manager">Thông tin cá nhân</a></li>
                                  <?php }else if($userinfo['Type']==0){ ?>
                                  <li ><a class="<?php echo $view?>" rel="nofollow" href="<?php echo base_url() ?>phu-huynh-manager">Thông tin cá nhân</a></li>
                                  <?php }else if($userinfo['Type']==3){ ?>
                                  <li ><a  class="<?php echo $view?>" rel="nofollow" href="<?php echo base_url() ?>mn-candi-manager">Thông tin cá nhân</a></li>
                                  <?php }else{ ?>
                                  <li><a class="<?php echo $view?>" rel="nofollow" href="<?php echo base_url() ?>mn-company-manager">Thông tin cá nhân</a></li>
                                  <?php } ?>
                            </li>
                            <li class="<?php echo $view?>"><a rel="nofollow" href="#myModaltype" data-toggle="modal" data-target="#myModaltype" >Đổi trạng thái</a></li>
                            <li class="dropdown p1">
                                <a rel="nofollow" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void()">Dành cho gia sư</a>
                                <ul class="dropdown-menu " role="menu">
                                    <li><a rel="<?php $rel=(strpos(current_url(),'tat-ca-lop-hoc'))?"dofollow":"nofollow";echo $rel; ?>" href="<?php echo base_url() ?>tat-ca-lop-hoc" title="">Danh sách lớp học</a></li>
                                    <li><a rel="<?php $rel=(strpos(current_url(),'tim-gia-su'))?"nofollow":"dofollow";echo $rel; ?>" href="<?php echo base_url() ?>tim-lop-gia-su" title="">Tìm lớp gia sư</a></li>
                                </ul>

                            </li>
              							<li class="dropdown p1"><a rel="nofollow" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void()">Dành cho phụ huynh</a>
              								<ul class="dropdown-menu " role="menu">
                                <li><a rel="<?php $rel=(strpos(current_url(),'tim-lop-gia-su'))?"nofollow":"dofollow";echo $rel; ?>" href="<?php echo base_url() ?>tim-gia-su">Tìm gia sư</a></li>
              									                  <li><a rel="<?php $rel=(strpos(current_url(),'tat-ca-giao-vien'))?"dofollow":"nofollow";echo $rel; ?>" href="<?php echo base_url() ?>tat-ca-giao-vien">Gia sư hàng đầu</a></li>
                                                  <li <?php if(!empty($_SESSION['UserInfo']) && $_SESSION['UserInfo']['Type']!=0){echo 'style="display:none"';} ?> ><a rel="nofollow" href="<?php echo $urlgiasu; ?>">Đăng tin tìm gia sư</a></li>
              								</ul>
              							</li>

                            <li class="dropdown p1"> <a rel="nofollow" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void()">Dành cho ứng viên</a>
              								<ul class="dropdown-menu " role="menu">

                                                  <li><a rel="<?php $rel=(strpos(current_url(),'viec-lam-full-time'))?"dofollow":"nofollow";echo $rel; ?>" href="<?php echo site_url() ?>viec-lam-full-time">Việc làm fulltime</a></li>
                                                  <li><a rel="<?php $rel=(strpos(current_url(),'tong-hop-viec-lam-them'))?"dofollow":"nofollow";echo $rel; ?>" href="<?php echo site_url(); ?>tong-hop-viec-lam-them">Việc làm thêm</a></li>
                                                  <li><a href="<?php echo base_url() ?>cong-ty.html" title="Đăng tin tuyển dụng">Nhà tuyển dụng hàng đầu</a></li>
                                                  <li <?php if(!empty($_SESSION['UserInfo']) && $_SESSION['UserInfo']['Type']!=3){echo 'style="display:none"';} ?> ><a rel="nofollow" href="<?php echo site_url(); ?>mn-candi-updateinfo">Tạo hồ sơ ứng viên</a></li>
              								</ul>
              							</li>
                            <li class="dropdown p1"><a rel="nofollow" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void()">Dành cho nhà tuyển dụng</a>
                                <ul class="dropdown-menu " role="menu">
                                    <li><a rel="<?php $rel=(strpos(current_url(),'nguoi-tim-viec_html'))?"dofollow":"nofollow";echo $rel; ?>" href="<?php echo site_url() ?>nguoi-tim-viec.html">Người tìm việc</a></li>
                                    <li <?php if(!empty($_SESSION['UserInfo']) && $_SESSION['UserInfo']['Type']!=4){echo 'style="display:none"';} ?> ><a rel="nofollow" href="<?php echo site_url() ?>mn-company-addnew">Đăng tin tuyển dụng miễn phí</a></li>
                            </ul>
                          </li>

                          <li class="dropdown p1"><a rel="nofollow" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void()">Tài liệu gia sư</a>
              								<ul class="dropdown-menu " role="menu">
                                                  <!-- <?php $news = $this->db->query('SELECT c.`name`,c.alias as aliascat,c.id as idcat FROM chuyenmuc as c WHERE c.status=1 and c.id > 4 ORDER BY c.id');
                                                  if($news->num_rows()>0){

                                                     foreach($news->result() as $n){
                                                  ?>

                                                  <li><a rel="nofollow" href="<?php echo site_url($n->aliascat.'.html') ?>"><?php echo $n->name ?></a></li>
                                       <?php } } ?> -->

              								</ul>
              							</li>

                            <li class="dropdown p1"><a rel="nofollow" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void()" title="">Chia sẻ kinh nghiệm</a>
                            <ul class="dropdown-menu " role="menu">
                                	<?php
                                  // $news1 = $this->db->query('SELECT c.`name`,c.alias as aliascat,c.id as idcat FROM chuyenmuc as c WHERE c.status=1 and c.id < 4 ORDER BY c.id');
                                  $news1 = $this->db->query('SELECT c.`name`,c.alias as aliascat,c.id as idcat FROM chuyenmuc as c WHERE c.status=1 ORDER BY c.id');
                                    if($news1->num_rows()>0){

                                       $tg= $news1->result();
                                       foreach($news1->result() as $n){
                                    ?>

                                    <li><a rel="<?php $rel=(strpos(current_url(),$n->aliascat))?"dofollow":"nofollow";echo $rel; ?>" href="<?php echo site_url($n->aliascat.'.html') ?>"><?php echo $n->name ?></a></li>
                                <?php } } ?>
                            </ul>
                            </li>

                            <li class="<?php echo $view?>" ><a  rel="nofollow" href="javascript:void(0);" id="btnlogout">Đăng xuất</a></li>


						</ul>


					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
			<!-- End Navigation -->
			<div class="clearfix"></div>
   <div class="menu_cate hidden-mobile">
   <div class="container">
      <?php if($showsearch){ ?>
                        <div class="banner-caption hidden-mobile">
						<div class="banner-text">
							<form class="form-horizontal">
								<div class="col-md-4 no-padd" id="header-keyjob" style="width:20%;">
									 <div class="input-group">
                                        <span class="span-before"><i class="nn"></i></span>
                                        <select id="findkeyjob" class="form-control right-bor">
                                            <option value="">Chọn yêu cầu</option>
                                            <option <?php if($keyhome==1){?> selected="selected" <?php } ?> value="1">Tìm gia sư</option>
                                            <option <?php if($keyhome==2){?> selected="selected" <?php } ?> value="2">Tìm lớp gia sư</option>
                                        </select>
									 </div>
								</div>
								<div class="col-md-3 no-padd nganhnghe" style="width:20%;">
									 <div class="input-group">
                    <span class="span-before"><i class="nn"></i></span>
										 <select id="index_nganhnghe" class="form-control right-bor" >
                                            <option  value="0">Môn học</option>
                                                  <?php
                                    if(!empty($monhoc)){
                                        foreach($monhoc as $n){
                                            if( ($n->ID== $idsub) && !empty($keyhome)){
                                            ?>
                                            <option selected="selected" value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                        <?php } }
                                    }
                                    ?>
                     </select>
									 </div>
								</div>

                <div class="col-md-3 no-padd nganhnghe" style="width:20%;">
									 <div class="input-group">
                    <span class="span-before"><i class="nn"></i></span>
										 <select id="index_lophoc" class="form-control right-bor">
                                            <option  value="0">Chọn lớp</option>
                                                  <?php
                                    if(!empty($lophoc)){
                                      foreach($lophoc as $valuelop){
                                      if(($valuelop->id==$idlophoc) && !empty($keyhome)){
                                        ?>
                                        <option selected="selected"  value="<?php echo $valuelop->id ?>"><?php echo $valuelop->name ?></option>
                                        <?php
                                      }else{
                                        ?>
                                        <option  value="<?php echo $valuelop->id ?>"><?php echo $valuelop->name ?></option>
                                    <?php
                                      }
                                    }
                                  }
                                  ?>
                     </select>
									 </div>
								</div>

								<div class="col-md-3 no-padd diadiem" id="header-tinhthanh" style="width:20%;">
									 <div class="input-group">
                    <span class="span-before"><i class="nn2"></i></span>
										<select id="index_dia_diem" class="form-control">
                        <option data-tokens="0" value="0" >Tỉnh thành</option>
                        <?php
                        foreach ($tinhthanh as $key => $value) {
                          if($key==$array2[2] && !empty($keyhome)){
                            echo '<option selected="selected" data-tokens="'.$key.'" value="'.$key.'" >'.$value.'</option>';
                          }else{
                            echo '<option data-tokens="'.$key.'" value="'.$key.'">'.$value.'</option>';
                          }

                      }
                    ?>
                     </select>
									 </div>
								</div>


								<div class="col-md-2 no-padd btnsearch" >
									<div class="input-group">
										<button class="btn btn-primary timvieclam" ><i class="fa fa-search"></i></button>

									</div>
								</div>
							</form>
						</div>

					</div>
                    <?php } ?>
        <ul class="navbar-right loginmenu" >
                        <?php  if(!isset($_SESSION['UserInfo']) || empty($_SESSION['UserInfo'])){ ?>
							<li><a rel="nofollow" href="<?php echo base_url() ?>dang-ky-chung">Đăng ký</a></li>
							<li><a rel="nofollow" href="<?php echo base_url(); ?>dang-nhap-chung">Đăng nhập</a></li>
                           <?php }else{
                            $userinfo=$_SESSION['UserInfo'];
                            $settype=$userinfo['Type'];
                            ?>
                            <li class="dropdown logininfo"><a rel="nofollow" class="dropdown-toggle" data-toggle="dropdown"><?php echo $userinfo['FullName']; ?></a>
                                <ul class="dropdown-menu " role="menu">
                                <?php if($userinfo['Type']==1){ ?>
                                    <li><a rel="nofollow" href="<?php echo base_url() ?>giao-vien-manager">Thông tin cá nhân</a></li>
                                    <?php }else if($userinfo['Type']==0){ ?>
                                    <li><a rel="nofollow" href="<?php echo base_url() ?>phu-huynh-manager">Thông tin cá nhân</a></li>
                                    <?php }else if($userinfo['Type']==3){ ?>
                                    <li><a rel="nofollow" href="<?php echo base_url() ?>mn-candi-manager">Thông tin cá nhân</a></li>
                                    <?php }else{ ?>
                                    <li><a rel="nofollow" href="<?php echo base_url() ?>mn-company-manager">Thông tin cá nhân</a></li>
                                    <?php } ?>
                                <li><a rel="nofollow" href="#myModaltype" data-toggle="modal" data-target="#myModaltype">Đổi trạng thái</a></li>
                                    <li><a rel="nofollow" href="javascript:void(0);" class="btnlogout">Thoát</a></li>
								           </ul>
                      </li>
               <?php } ?>
						</ul>
   </div>
</div>
<div class="modal fade capnhattrangthaiclass" id="myModaltype" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="modal-title"><b>Thay đổi tài khoản</b></div>

        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="row padd-top-15 padd-bot-5" style="">
                    <div class="col-md-12">
                        <div class="group-radio">
                        <input id="radio-1" value="0" class="radio-custom" name="radio-group" type="radio" <?php if($settype==0){ ?> checked <?php } ?>>
                        <label for="radio-1" class="radio-custom-label">Phụ huynh/ học viên</label>
                        </div>
                        <div class="group-radio">
                            <input id="radio-2" value="1" class="radio-custom" name="radio-group" type="radio" <?php if($settype==1){ ?> checked <?php } ?>>
                            <label for="radio-2" class="radio-custom-label">Gia sư</label>
                        </div>
                        <div class="group-radio">
                            <input id="radio-3" value="3" class="radio-custom" name="radio-group" type="radio" <?php if($settype==3){ ?> checked <?php } ?>>
                            <label for="radio-3" class="radio-custom-label">Ứng viên tìm việc</label>
                        </div>
                        <div class="group-radio">
                            <input id="radio-4" value="4" class="radio-custom" name="radio-group" type="radio" <?php if($settype==4){ ?> checked <?php } ?>>
                            <label for="radio-4" class="radio-custom-label">Nhà tuyển dụng</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="text-align:left;">
            <button type="button" id="btnhuy" class="btn btn-primary btn-warning" data-dismiss="modal" style="padding: 6px 20px;width: 109px;margin-left: 5px;display: inline-block;">Hủy</button>
            <button type="button" class="btn btn-primary btn-success" id="btnluuthaydoitrangthai" style="padding: 6px 20px;width: 143px;margin-left: 7px;display: inline-block;">Lưu thay đổi</button>
        </div>
      </div>
    </div>
  </div>
  <script src="javascript/custom.js"></script>
<script>
$(document).ready(function() {
    var configulr='<?php echo base_url(); ?>';
$('#myModalmorsearch #hinhthuc,#myModalmorsearch #ppgioitinh,#myModalmorsearch #txtteachtype,#myModalmorsearch #txtteachtypemd, #findkeyjob').select2();
$('.btnsearchmore').on('click',function(){
    $('#myModalmorsearch').modal('hide');
});
$('#btnluuthaydoitrangthai').on('click',function(){
    $.ajax({
                  url: configulr+"/site/ajaxchangetypeuser",
                  type: "POST",
                  data: { typeu: $('input[name=radio-group]:checked').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        alert(reponse.msg);
                        window.location.href=configulr;
                      }
                      else {
                         alert(reponse.msg) ;
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

    $('#index_nganhnghe').change(function(){
      var urlString="<?=base_url().'site/getarrayclass';?>"
      var monhoc = $(this).val();
        $.ajax({
                // url: configulr+"/site/ajaxchangetypeuser",
                url : urlString,
                type: "POST",
                data: { idmonhoc: monhoc },
                dataType: 'json',
                success: function (reponse) {
                    if (reponse.kq == true) {
                      $("#index_lophoc option").remove();
                          $("#index_lophoc").append(reponse.data);

                      $("#index_lophoc").select2();
                    }
                    // else {
                    //   $("#index_lophoc option").remove();
                    //       $("#index_lophoc").append(reponse.data);
                    //
                    //   $("#index_lophoc").select2();
                    // }
                },
              });

      });

      $("#btnlogout").click(function(){
        $.ajax({
                  url: "<?=base_url();?>/site/logout",
                  type: "POST",
                  data: {},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                      // alert("Bạn thực sự muốn logout?");
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        window.location.reload();
                          $(location).attr('href', configulr);
                      }
                      else {
                         alert(reponse.msg) ;
                      }
                  },
                  error: function (xhr) {
                      alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
      });

});


</script>
