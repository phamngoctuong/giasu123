<?php
$CI=&get_instance();
$CI->load->model('site/site_model');
$footer=$CI->site_model->getconfig();
$city=0;
if(isset($_SESSION['filterhome'])){
    $tg=$_SESSION['filterhome'];
    $city=$tg['place'];
}
?>
<?php $urlweb= current_url();
if($content=='forusers' || $content=='forteacher' || $content=='news'){
?>

<div   style="background:#f9f9f9;width:100%">
  <div class="container">

    <div class="viewleft">
      <p style="text-align:center"><img src="images/image_gril.jpg" alt="Founder gia sư 123 lê hồng hạnh" class = "image_gril"></p>
    </div>
    <div class="viewright">
        <h3> <span> <strong style="font-size:14px;"> Founder</strong>
          <a href="https://www.facebook.com/lehonghanh1991" style="font-size:16px;" rel="nofollow" target="_blank">LÊ HỒNG HẠNH</a> </span>
        </h3>
        <p style="padding: 0px; margin: 0px; font-size: 14px; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif;  padding-top :20px;">
          <span>✅ 6 năm gia sư tiếng Anh tại nhà / trực tuyến</span>
        </p>
        <p style="padding: 0px; margin: 0px; font-size: 14px; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif;">
          <span>✅ Trực tiếp tuyển dụng hơn 1500 ứng viên</span>
        </p>
        <p style="padding: 0px; margin: 0px; font-size: 14px; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif;">
          <span>✅ Chuyên nghiên cứu và thiết kế hàng trăm mẫu cv xin việc 365 đẹp và ấn tượng</span>
        </p >
        <p style="padding: 0px; margin: 0px; font-size: 14px; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; padding-top :20px;">
           <span>"Vieclam123 - Trang kết nối hiệu quả gia sư với phụ huynh cả nước, giúp tìm kiếm gia sư và lớp mới cần dạy kèm không qua trung gian, miễn phí"</span>
        </p>
        <p style="height: 50px;padding-top:30px"> <span>
          <a href="https://twitter.com/lehonghanh1991" target="_blank" rel="nofollow" > <i class = "fa fa-twitter-square" style="font-size:50px;color: #00aced;margin-right: 5px"></i> </a>
          <a href="https://www.instagram.com/lehonghanh1991/" target="_blank" rel="nofollow"> <i  class="fa fa-instagram fa-5x" style="font-size:50px;margin-right: 5px"></i> </a>
          <a href="https://www.pinterest.com/lehonghanh1991/" target="_blank" rel="nofollow"> <i class = "fa fa-pinterest-square" style="font-size:50px; color:#f44242"></i> </a>
        </span>
        </p>
    </div>
  </div>
  </div>
<?php } ?>
<div class="clearfix"></div>
			<!-- Footer Section Start -->
			<footer class="footer" <?php if($showcontact){echo "style='border-top:1px solid #e6e6e6'";} ?>>
				<div class="row copyright">
					<div class="container">
                        <div class="row">
                            <div class="col-md-8 col-sm-12 text-left">
        			             <a rel="nofollow" href="//www.dmca.com/Protection/Status.aspx?ID=36574d47-81c3-45bf-af23-035af047bd2c" title="DMCA.com Protection Status" class="dmca-badge"> <img style="width:60px" src ="https://images.dmca.com/Badges/dmca_protected_1_120.png"  alt="DMCA.com Protection Status" /></a>
        						<a rel="nofollow" href="http://online.gov.vn/HomePage/WebsiteDisplay.aspx?DocId=52941"><img style="width:80px" alt="Bộ công thương" title="" src="https://vieclam123.vn/images/bocongthuong.jpg" /></a>
                                <?php
                                if($content=='forusers' || $content=='forteacher' || $content=='news'){
                                  ?>
                                  <p style="margin-top:20px"> <strong>Mọi thắc mắc cần tư vấn Tìm gia sư 123 xin liên hệ:</strong> </p>
                                  <p > <strong>Công ty TNHH nguồn nhân lực Thanh Xuân</strong> </p>
                                  <p> <img src="images/vl13.png" alt="Văn phòng 1" style="height:16px; width:16px">
                                     <span> VP1: <a href="https://goo.gl/maps/Qc2f2ynYij8Wtn1o8" rel="nofollow" style="color:#fff" target="_blank">Tầng 5, B50, Khu đô thị Định Công, Hoàng Mai, Hà Nội</a></span></p>
                                  <p><img src="images/vl13.png" alt="Văn phòng 2" style="height:16px; width:16px"> VP2: Xóm 7, xã Nhân Khang, huyện Lý Nhân, Tỉnh Hà Nam</p>
                                  <p> <span>
                                    <p><img src="images/vl14.png" alt="Hotline" style="height:16px; width:16px">Hotline: 0869.154.226</p>
                                    <p> <img src="images/vl12.png" alt="Email công ty" style="height:12px; width:16px"> </i> Email công ty: jobthanhxuan@gmail.com</p>

                                  </span> </p>
                                  <p><img src="images/vl12.png" alt="Email cá nhân" style="height:12px; width:16px"></i> Email cá nhân: lehonghanh.giasu123@gmail.com</p>
                                <?php
                                }else{
                                   echo $footer->content_thu;
                                }
                                 ?>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="footer-widget">
                        							<h3 class="widgettitle widget-title">Quy định & Bảo mật</h3>
                        							<div class="textwidget">
                                      <ul>
                                      <li><a rel="nofollow" href="<?php echo base_url().'gioi-thieu-chung'?>">Về chúng tôi</a></li>
                                      <li><a rel="nofollow" href="<?php echo base_url().'thoa-thuan-su-dung'?>">Thỏa thuận sử dụng</a></li>
                                      <li><a rel="nofollow" href="<?php echo base_url().'thong-tin-can-biet'?>">Thông tin cần biết</a></li>
                                      <li><a rel="nofollow" href="<?php echo base_url().'quy-trinh-giai-quyet-tranh-chap'?>">Quy trình giải quyết tranh chấp</a></li>
                                      <li><a rel="nofollow" href="<?php echo base_url().'quy-trinh-bao-mat'?>">Quy trình bảo mật</a></li>
                                      </ul>

                        							</div>
                        					</div>
                              </div>

                        </div>

					        </div>
                  <div class="icon-news" id="icon-news-footer" >
                    <div style="padding:10px">
                      <span style="color:white;margin:50px">Liên kết với chúng tôi trên MXH</span>
                      <span id="icon-news-footer2" >
                        <a aria-label="facebook" rel="nofollow" href="https://www.facebook.com/ViecLam123Vietnam/" target="_blank" style="padding-left:10px;color:white;margin:50px"><i class="fa fa-facebook-square" style="padding-right: 10px"></i>Facebook</a>
                        <a aria-label="facebook" rel="nofollow" href="https://twitter.com/vieclam123" target="_blank" style="padding-left:10px;color:white;margin:50px"><i class="fa fa-twitter-square" style="padding-right: 10px"></i>Twitter</a>
                        <a aria-label="facebook" rel="nofollow" href="https://www.linkedin.com/in/vieclam123/" target="_blank" style="padding-left:10px;color:white;margin:50px"><i class="fa fa-linkedin" style="padding-right: 10px"></i>Linkedin</a>
                      </span>
                    </div>
                  </div>
                  <div class="icon-news" id="icon-news-footer1" >
                    <div style="margin-bottom: 10px;" >
                      <span style="color:white">Liên kết với chúng tôi trên MXH</span>
                      <br>
                      <span id="icon-news-footer2" >
                        <a aria-label="facebook" rel="nofollow" href="https://www.facebook.com/ViecLam123Vietnam/" target="_blank" style="padding-left:10px;color:white"><i class="fa fa-facebook-square" style="padding-right: 10px"></i></a>
                        <a aria-label="facebook" rel="nofollow" href="https://twitter.com/vieclam123" target="_blank" style="padding-left:10px;color:white"><i class="fa fa-twitter-square" style="padding-right: 10px"></i></a>
                        <a aria-label="facebook" rel="nofollow" href="https://www.linkedin.com/in/vieclam123/" target="_blank" style="padding-left:10px;color:white"><i class="fa fa-linkedin" style="padding-right: 10px"></i></a>
                      </span>
                    </div>
                  </div>
				    </div>


			</footer>
<!-- Footer -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137221656-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-137221656-1');
</script> -->
<div id="btn-top" style="display: none;"></div>
<div class="chatbox" id="chatbox" style="display: none;">
  <!-- <div class="chatbox" id="chatbox"> -->

  <div class="chatbox-chat" >
     <div id="ten-gia-su" >
       <span id="name-teacher-here"></span>
       <span id="hide-chatbox">X</span>
     </div>
    <div class="messenger">
      <div id="hienthi-messenger">

      </div>
    </div>
    <div class="chatbox2">
      <textarea id="text-chat" placeholder="Soạn tin nhắn...." maxlength="5000" name="text-chat" ></textarea>
      <div class="icon-box" style="display:none">
      </div>
      <div class="chatbox-toolbar">
        <button type="button" id="emoji" >icon</button>
        <button type="button" id="send-messenger">Gửi</button>

      </div>
    </div>
  </div>
  <div class="chatbox-list">
    <div id="chatbox-list-header">
      <div class="header-chatbox-2" id="all-chat">Tất cả</div>
      <div id="inbox-waitting">Chưa đọc</div>
    </div>
    <div class="listuser">

    </div>
  </div>
</div>
<?php
if(!empty($_SESSION['UserInfo'])){
  ?>
  <a rel="nofollow" title="chatbox" class="chatbox-icon-vieclam123" ><i class="fa fa-comments" aria-hidden="true"></i></a>
  <?php
}
 ?>
<a rel="nofollow" target="_blank" href="skype:live:hhp.trankien?chat" id="skypefix" name="skypefix" class="skypefix" title="Skype"><i class="fa fa-skype"></i></a>
<a rel="nofollow" target="_blank" href="http://m.me/100007119133262" id="messenger-facebook" class="messenger-facebook" title="messenger" ><i class='fab fa-facebook-messenger'></i></a>

<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script>
var userid='<?=$_SESSION['UserInfo']['UserId']?>';
var name='<?=$_SESSION['UserInfo']['FullName'];?>';
jQuery(window).scroll(function(){
if(jQuery(this).scrollTop()>300){
 jQuery('#btn-top').fadeIn(800);
}else{
 jQuery('#btn-top').fadeOut(800);
}
  });
document.addEventListener("DOMContentLoaded", function(event) {
    console.log("DOM fully loaded and parsed");
  });
$(document).ready(function(){

    $("#all-chat").click(function(){
      $("#inbox-waitting").removeClass("header-chatbox-2");
      $(this).toggleClass("header-chatbox-2");
    });
    $("#inbox-waitting").click(function(){
      $("#all-chat").removeClass("header-chatbox-2");
      $(this).toggleClass("header-chatbox-2");
    });
    $(".chatbox-icon-vieclam123").click(function(){
      $(".chatbox-icon-vieclam123").hide(200);
      $("#chatbox").show(500);
      $("#messenger-facebook").css("bottom","540px");
      $("#skypefix").css("bottom","470px");
    });
    $("#hide-chatbox").click(function(){
      $("#chatbox").hide(200);
      $(".chatbox-icon-vieclam123").show(200);
      $("#messenger-facebook").css("bottom","196px");
      $("#skypefix").css("bottom","96px");
    });


    var configulr='<?=base_url();?>';
    $('#btn-top').click(function() {
$('body,html').animate({
 scrollTop: 0
 }, 800);
 });
    $('[data-toggle="tooltip"]').tooltip();

    $('#index_nganhnghe').select2({ width: 'calc(100%)' });
$('#index_dia_diem').select2({ width: 'calc(100%)' });
$('#index_lophoc').select2({ width: 'calc(100%)' });
$('#candinganhnghe').select2({ width: 'calc(100%)' });
$('#candilocation').select2({ width: 'calc(100%)' });
   $('#morelocation').on('click',function(){

        if($('#showlocation').hasClass("morelocation"))
        {
            $('#showlocation').removeClass("morelocation");
        }
        else {
            $('#showlocation').addClass('morelocation');
        }
    });
    $('#morenganhnghe').on('click',function(){

        if($('#shownganhnghe').hasClass("morelocation"))
        {
            $('#shownganhnghe').removeClass("morelocation");
        }
        else {
            $('#shownganhnghe').addClass('morelocation');
        }
    });

    $('.timvieclam').on('click',function(){
        var findkey=$('#findkeyjob').val();
        var strsubj=$('#index_nganhnghe').val();
        var strtopic=$('#index_dia_diem').val();
        var strclass=$('#index_lophoc').val();

        if(findkey !=''){
        $.ajax({
                  url: configulr+"site/searchhome",
                  type: "POST",
                  data: { key:findkey,subject:strsubj,place:strtopic,class:strclass },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          window.location.href=reponse.data;
                      }
                  },
                  error: function (xhr) {
                      alert('Có lỗi xảy ra, xin vui lòng thử lại');
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
            }else{
                alert('Bạn phải chọn yêu cầu tìm kiếm');
            }
    });

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
                },
              });
      });
    var urlHref= "<?=str_replace('_html','.html',str_replace(base_url(),'',current_url()));?>";
    var mucluc= document.getElementById("muc-luc-content-thu");
    var input1= document.getElementById("content-thu");
    var contentmucluc= document.getElementById("content-mucluc");
    if(mucluc!= null && input1!= null){
        var input2=input1.getElementsByTagName("*");
        var h2 = input1.getElementsByTagName("H2").length;
        var h3 = input1.getElementsByTagName("H3").length;
        var h4 = input1.getElementsByTagName("H4").length;
        var h5 = input1.getElementsByTagName("H5").length;
      if(h2>0 || h3>0 || h4>0 || h5>0){
        var tieudemucluc=document.getElementById("tieudemucluc");
        var strong= document.createElement("strong");

        strong.innerHTML="Mục lục bài viết";
        mucluc.style.minHeight="100px";
        mucluc.style.width="600px";
        mucluc.style.background="#f2f4f7";
        mucluc.style.margin="30px 30px 0 30px";
        mucluc.style.fontSize="16px";
        mucluc.style.color="black";

        tieudemucluc.appendChild(strong);
      }else{
        mucluc.style.display="none";
      }
      for(i=0;i<input2.length;i++){
        if(input2[i].tagName=='H1'||input2[i].tagName=="IMG" ||input2[i].tagName=='H2'||input2[i].tagName=='H3'||input2[i].tagName=='H4'||input2[i].tagName=='H5'||input2[i].tagName=='H6'){
          if(input2[i].tagName=='H1'){
            input2[i].setAttribute("id", "H1abc"+i);
            var li=document.createElement("div");
            var href=document.createElement("a");
            if(input2[i].hasAttribute("img")){
            }

            href.href=urlHref+"#H1abc"+i;
            href.innerHTML=input2[i].textContent;
            href.className="H1abc";
            li.appendChild(href);
            contentmucluc.appendChild(li);

          }
          if(input2[i].tagName=='H2'){
            input2[i].setAttribute("id", "H2abc"+i);
            var li=document.createElement("li");
            var href=document.createElement("a");

            href.href=urlHref+"#H2abc"+i;
            href.innerHTML=input2[i].textContent;
            href.className ="H2abc";
            li.appendChild(href);
            contentmucluc.appendChild(li);
            input2[i].style.marginLeft="20px";

          }

          if(input2[i].tagName=='H3'){
            input2[i].setAttribute("id", "H3abc"+i);
            var li=document.createElement("li");
            var href=document.createElement("a");

            href.href=urlHref+"#H3abc"+i;
            href.className ="H3abc";
            href.innerHTML=input2[i].textContent;
            li.appendChild(href);
            contentmucluc.appendChild(li);
          }
          if(input2[i].tagName=='H4'){
            input2[i].setAttribute("id", "H4abc"+i);
            var li=document.createElement("div");
            var href=document.createElement("a");

            href.href=urlHref+"#H4abc"+i;
            href.className ="H4abc";
            href.innerHTML=input2[i].textContent;
            li.appendChild(href);
            contentmucluc.appendChild(li);
          }
          if(input2[i].tagName=='H5'){
            input2[i].setAttribute("id", "H5abc"+i);
            var li=document.createElement("div");
            var href=document.createElement("a");

            href.href=urlHref+"#H5abc"+i;
            href.className ="H5abc";
            href.innerHTML=input2[i].textContent;
            li.appendChild(href);
            contentmucluc.appendChild(li);
          }
          if(input2[i].tagName=='H6'){
            input2[i].setAttribute("id", "H6abc"+i);
            var li=document.createElement("div");
            var href=document.createElement("a");

            href.href=urlHref+"#H6abc"+i;
            href.className ="H6abc";
            href.innerHTML=input2[i].textContent;
            li.appendChild(href);
            contentmucluc.appendChild(li);
          }

        }
        if(input2[i].tagName == 'IMG'){
          input2[i].setAttribute("class", "view");
        }

      }
    }

});
</script>
<!-- <script type="text/javascript" src="javascript/chatbox.js"></script> -->
