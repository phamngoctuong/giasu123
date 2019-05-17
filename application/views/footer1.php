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
?>
<div class="clearfix"></div>
			<!-- Footer Section Start -->
			<footer class="footer" <?php if($showcontact){echo "style='border-top:1px solid #e6e6e6'";} ?>>
				<div class="row copyright">
					<div class="container">
                        <div class="row">
                            <div class="col-md-8 col-sm-12 text-left">
        			             <a rel="nofollow" href="//www.dmca.com/Protection/Status.aspx?ID=36574d47-81c3-45bf-af23-035af047bd2c" title="DMCA.com Protection Status" class="dmca-badge"> <img style="width:60px" src ="https://images.dmca.com/Badges/dmca_protected_1_120.png"  alt="DMCA.com Protection Status" /></a>
        						<a rel="nofollow" href="http://online.gov.vn/HomePage/WebsiteDisplay.aspx?DocId=52941"><img style="width:80px" alt="Bộ công thương" title="" src="https://vieclam123.vn/images/bocongthuong.jpg" /></a>
                                <?php echo $footer->content_thu ?>
                                <p><i class="fa fa-envelope" aria-hidden="true"></i>   Email: lehonghanh.giasu123@gmail.com</p>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="footer-widget">
                        							<h3 class="widgettitle widget-title">Quy định & Bảo mật</h3>
                        							<div class="textwidget">
                                      <ul>
                                      <li><a rel="nofollow" href="<?php echo base_url().'gioi-thieu-chung'?>">Về chúng tôi</a></li>
                                      <li><a rel="nofollow" href="<?php echo base_url().'thoa-thuan-su-dung'?>">Thỏa thuận sử dụng</a></li>
                                      <li><a rel="nofollow" href="<?php echo base_url().'thong-tin-can-biet'?>">Thông tin cần biết</a></li>
                                      <li><a rel="nofollow" href="<?php echo base_url().'quy-trinh-giai-quyet-tranh-chap'?>">Quy trinh giải quyết tranh chấp</a></li>
                                      <li><a rel="nofollow" href="<?php echo base_url().'quy-trinh-bao-mat'?>">Quy trình bảo mật</a></li>
                                      </ul>

                        							</div>
                        					</div>
                              </div>
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
<a rel="nofollow" href="skype:live:hhp.trankien?chat" name="skypefix" class="skypefix" title="Skype" style="position: fixed;cursor: pointer;bottom: 96px;right: 0px;z-index: 9999999;"><i class="fa fa-skype"></i></a>
<a rel="nofollow" href="http://m.me/100007119133262" class="messenger-facebook" title="messenger" style="position: fixed;cursor:pointer;bottom:196px;right:0px;z-index:9999999" ><i class="fa fa-facebook-square" aria-hidden="true"></i></a>

<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<script>

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
    var configulr='<?php echo base_url(); ?>';
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
        if(findkey !='' || strsubj !='' || strtopic!='' || strclass!='' ){
        $.ajax({
                  url: "<?=base_url().'site/searchhome'?>",
                  type: "POST",
                  data: { key:findkey,subject:strsubj,place:strtopic,class:strclass },
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
                      alert('Có lỗi xảy ra, xin vui lòng thử lại');
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
            }
    });
    var urlHref= "<?=str_replace('_html','.html',str_replace(base_url(),'',current_url()));?>";
    var mucluc= document.getElementById("muc-luc-content-thu");
    var input1= document.getElementById("content-thu");
    if(mucluc!= null && input1!= null){
        var input2=input1.getElementsByTagName("*");
      if(input2.length>0){
        var tieudemucluc=document.getElementById("tieudemucluc");
        var strong= document.createElement("strong");

        strong.innerHTML="Mục lục bài viết";
        mucluc.style.minHeight="100px";
        mucluc.style.width="500px";
        mucluc.style.background="#f2f4f7";
        mucluc.style.margin="30px 30px 0 30px";
        mucluc.style.fontSize="16px";
        mucluc.style.color="black";

        tieudemucluc.appendChild(strong);
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
            mucluc.appendChild(li);

          }
          if(input2[i].tagName=='H2'){
            input2[i].setAttribute("id", "H2abc"+i);
            var li=document.createElement("div");
            var href=document.createElement("a");

            href.href=urlHref+"#H2abc"+i;
            href.innerHTML=input2[i].textContent;
            href.className ="H2abc";
            li.appendChild(href);
            mucluc.appendChild(li);
            input2[i].style.marginLeft="20px";

          }

          if(input2[i].tagName=='H3'){
            input2[i].setAttribute("id", "H3abc"+i);
            var li=document.createElement("div");
            var href=document.createElement("a");

            href.href=urlHref+"#H3abc"+i;
            href.className ="H3abc";
            href.innerHTML=input2[i].textContent;
            li.appendChild(href);
            mucluc.appendChild(li);
          }
          if(input2[i].tagName=='H4'){
            input2[i].setAttribute("id", "H4abc"+i);
            var li=document.createElement("div");
            var href=document.createElement("a");

            href.href=urlHref+"#H4abc"+i;
            href.className ="H4abc";
            href.innerHTML=input2[i].textContent;
            li.appendChild(href);
            mucluc.appendChild(li);
          }
          if(input2[i].tagName=='H5'){
            input2[i].setAttribute("id", "H5abc"+i);
            var li=document.createElement("div");
            var href=document.createElement("a");

            href.href=urlHref+"#H5abc"+i;
            href.className ="H5abc";
            href.innerHTML=input2[i].textContent;
            li.appendChild(href);
            mucluc.appendChild(li);
          }
          if(input2[i].tagName=='H6'){
            input2[i].setAttribute("id", "H6abc"+i);
            var li=document.createElement("div");
            var href=document.createElement("a");

            href.href=urlHref+"#H6abc"+i;
            href.className ="H6abc";
            href.innerHTML=input2[i].textContent;
            li.appendChild(href);
            mucluc.appendChild(li);
          }
          if(input2[i].tagName == 'IMG'){
            input2[i].setAttribute("class", "view");
          }
        }

      }
    }

});
</script>
