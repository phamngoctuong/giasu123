/*
* ----------------------------------------------------------------------------------------
Author       :  pixshed
Template Name:  Mega Jobs - Job board
Version      :  1.0
* ----------------------------------------------------------------------------------------
*/
var configulr='http://localhost/timviec3';
$(document).ready(function () {
var um=new UserManager();
// DROPDOWN ANIMATION
	$('.dropdown').on('show.bs.dropdown', function() {
    	$(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  	});
  	$('.dropdown').on('hide.bs.dropdown', function() {
    	$(this).find('.dropdown-menu').first().stop(true, true).slideUp();
  	});
//	CLIENTS SLIDER
	$(".clients").slick({
		dots:false,
		arrows:false,
		infinite:true,
		slidesToShow:10,
		slidesToScroll:1,
		autoplay:true,
		autoplaySpeed:2000,
		responsive:[
		{
			breakpoint:770,
			settings:{
				slidesToShow:8,
				slidesToScroll:1
			}
		},
		{
			breakpoint:650,
			settings:{
				slidesToShow:6,
				slidesToScroll:2
			}
		},
		{
			breakpoint:490,
			settings:{
				slidesToShow:4,
				slidesToScroll:1
			}
		},
		{
			breakpoint:370,
			settings:{
				slidesToShow:2,
				slidesToScroll:1
			}
		}]
	});
//	ALERT VERTICAL SLIDER
	//$(".alert-list").slick({
//		dots:false,
//		arrows:false,
//		infinite:true,
//		slidesToShow:8,
//		slidesToScroll:1,
//		autoplay:true,
//		autoplaySpeed:1500,
//		vertical:true
//	});
//	A to Z FILTER SLIDER
	$(".filter-by").slick({
		dots:false,
		arrows:false,
		infinite:false,
		slidesToShow:28,
		slidesToScroll:1,
		autoplay:false,
		autoplaySpeed:2000,
		responsive:[
		{
			breakpoint:770,
			settings:{
				slidesToShow:16,
				slidesToScroll:15
			}
		},
		{
			breakpoint:650,
			settings:{
				slidesToShow:14,
				slidesToScroll:13
			}
		},
		{
			breakpoint:490,
			settings:{
				slidesToShow:10,
				slidesToScroll:9
			}
		},
		{
			breakpoint:370,
			settings:{
				slidesToShow:7,
				slidesToScroll:6
			}
		}]
	});

//	MARK AND UNMARK FAVORITE
	$("a.mark-favorite").on("click", function(){
		$(this).find("i").toggleClass("fa-star-o");
		$(this).find("i").toggleClass("fa-star");
	});

//	TOGGLE LIST AND GRID VIEW ON HOME PAGE

	var toggleView = $(".change-view a");
	var toggleList = $(".change-view a.list");
	var toggleGrid = $(".change-view a.grid");
	var classicListView = $(".classic-list-view");
	var gridView = $(".grid-view");

	// Toggle active class to toggle buttons
	toggleView.on("click", function(){
		toggleView.removeClass("active");
		$(this).addClass("active");
	});

	// Toggle between list view and grid view
	toggleList.on("click", function(){
		classicListView.slideDown();
		gridView.slideUp();
	});
	toggleGrid.on("click", function(){
		gridView.slideDown();
		classicListView.slideUp();
	});

//	TOGGLE JOBLISTING FILTERS
	var categoryExpand = $(".category-title a.expand");
	categoryExpand.on("click", function(){
		var categoryExpandIcon = $(this).find("i");
		var filterList = $(this).closest("div.filters-wrap").find("div.filter-list")

		// Toogle icon class
		categoryExpandIcon.toggleClass("fa-plus");
		categoryExpandIcon.toggleClass("fa-minus");
		
		// Toggle filter wrapper
		filterList.slideToggle(500);
	});

//	COUNTDOWN TIMER
	/*$('#clock').countdown('2020/12/31').on('update.countdown', function(event) {
	  var $this = $(this).html(event.strftime(''
	    + '<span>%-w<small>week%!w</small></span>'
	    + '<span>%-d<small>day%!d</small></span>'
	    + '<span>%H<small>hr</small></span>'
	    + '<span>%M<small>min</small></span>'
	    + '<span>%S<small>sec</small></span>'));
	});*/

// TEXT EDITOR
	/*$('.summernote').summernote({
		height: 200,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
		focus: true,
		fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica Neue', 'Helvetica', 'Impact', 'Lucida Grande', 'Tahoma', 'Times New Roman', 'Verdana']
	});*/
});

function UserManager()
{
    $(".loginform").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
            if ($('#username').val() == '') {
                $('#username').focus();
            }
            else if ($('#password').val() == '' && $('#username').val() != '') {
                $('#password').focus();
            }
            else if ($('#password').val() != '' && $('#username').val() != '') {
                $('#btndangnhap').focus();
                $('#btndangnhap').trigger('click');
            }
        }
    });
    var self = this;
    $('#btndangnhap').on('click',function(){
        var cknhatuyendung=1;
        if(typeof ($('input[name=typelogin]:checked').val())=== "undefined"){
            cknhatuyendung=0;
        }
       $.ajax(
              {
                  
                  url: configulr+"/site/loginuser",
                  type: "POST",
                  data: { username: $('#username').val(), password: $('#password').val(),typelogin:cknhatuyendung },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        window.location.reload();
                          
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
                      window.location.href = configulr;
                  }
              }); 
    });
    $('#btnlogout').on('click',function(){
        $.ajax(
              {
                  
                  url: configulr+"/site/logout",
                  type: "POST",
                  data: {},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
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
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
        
    })
    $('#citycandi').change(function () {
        //alert($(this).val()); 
        var tinhthanh=$(this).val();
        
              if(tinhthanh != '' || tinhthanh !=0){
              $.ajax(
              {
                  
                  url: configulr+"/site/GetListDistrict",
                  type: "POST",
                  data: { province: tinhthanh },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {
                     var strhtml='<option value="">Chọn Quận, Huyện</option>';
                     if(obj.kq != ''){
                        var reponse=obj.kq;
                        $("#districtcandi option").remove();
                        var o1 = new Option('Chọn Quận, Huyện', '');
                        $("#districtcandi").append(o1);
                      for (var i = 0; i < reponse.length; i++) {
                           //strhtml+="<option value='"+reponse[i].cit_name+"'>"+reponse[i].cit_name+"</option>";
                          var o = new Option(reponse[i].cit_name, reponse[i].cit_name);
                            $("#districtcandi").append(o);
                           
                        }
                        
                        //$("#district").html=strhtml;
                        //document.getElementById('district').innerHTML=strhtml;
                        //$("#districtcandi").selectpicker('refresh');
                        }else{
                            //alert('không tồn tại');
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
    $('.dangkyungvien').on('click',function(){
        if (self.validateregister()) {
            var hoten = $('#namecandi').val();
            var phone = $("#phonecandi").val();
            var email = $("#emailcandi").val();
            var pass = $("#passcandi").val();
            var city=$('#citycandi').val();
            /* moi bo xung*/
            var district=$('#districtcandi').val();
            /*thong tin them*/
            var school=$('#school').val();
            var schooltype=$('#schooltype').val();
            var xeploaihoctap=$('#xeploaihoctap').val();
            var languagecandi=$('#languagecandi').val();
            /*ket thuc moi bo xung*/
            var ngaysinh=$('#txtngaysinh').val();
            var gioitinh=$('#candisex').val();
            var honnhan=$('#candimarriage').val();
            var cvtitle=$('#jobwish').val();
            var bangcap=$('#candibangcap').val();
            var hinhthuclamviec=$('#candihtlv').val();
            var capbac=$('#candicapbac').val();
            var noilamvieckhac=$('#citycandimore').val();
            var nganhnghe=$('#candicategory').val();
            var nganhnghe1=$('#candicategorymore').val();
            var nganhnghe2=$('#candicategorymore2').val();
            //var extrann=nganhnghe1+','+nganhnghe2;
            var muctieu=$('#canditarget').val();
            var kynang=$('#candiskill').val();
            var diachi=$('#diachicandi').val();
            var mucluong=$('#salarycandi').val();
            var kinhnghiem=$('#candiexp').val();
            $.ajax(
              {
                  
                  url: configulr+"/site/registercandi",
                  type: "POST",
                  data: { 
                        hoten: hoten, 
                        phone: phone,
                        email:email,
                        city:city,
                        pass:pass,
                        ngaysinh:ngaysinh,
                        gioitinh:gioitinh,
                        honnhan:honnhan,
                        cvtitle:cvtitle,
                        bangcap:bangcap,
                        hinhthuclamviec:hinhthuclamviec,
                        capbac:capbac,
                        noilamvieckhac:noilamvieckhac,
                        nganhnghe:nganhnghe,
                        nganhnghe1:nganhnghe1,
                        nganhnghe2:nganhnghe2,
                        muctieu:muctieu,
                        kynang:kynang,
                        diachi:diachi,
                        mucluong:mucluong,
                        kinhnghiem:kinhnghiem,
                        district:district,
                        school:school,
                        schooltype:schooltype,
                        xeploaihoctap:xeploaihoctap,
                        languagecandi:languagecandi
                        },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        alert(reponse.msg)
                          
                      }
                      else {
                          
                      }
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                      //window.location = configulr;
                  }
              }); 
            }
    })
    $('.dangkynhatuyendung').on('click',function(){
        var hoten = $('#namecompany').val();
        var phone = $("#phonecompany").val();
        var email = $("#usercompany").val();
        var pass = $("#passcompany").val();
        var repass = $("#repasscompany").val();
        var term = $('input[name=company-terms]:checked').val();
        var city=$('#citycompany').val();
        var website=$('#websitecompany').val();
        var addresscom=$('#addresscompany').val();
        if(self.validatecomregister()){
            $.ajax(
              {
                  
                  url: configulr+"/site/registercompany",
                  type: "POST",
                  data: { tencongty: hoten, phone: phone,email:email,city:city,pass:pass,website:website,addresscom:addresscom },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        alert(reponse.msg);
                          window.location = configulr;
                      }
                      else {
                          
                      }
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                      //window.location = configulr;
                  }
              }); 
        }
    })
     //Check valid register
    self.validateregister = function () {
        var flag = true;

        var hoten = $('#namecandi').val();
        var phone = $("#phonecandi").val();
        var email = $("#emailcandi").val();
        var pass = $("#passcandi").val();
        var repass = $("#repasscandi").val();
        var term = $('input[name=user-terms]:checked').val();
        var city=$('#citycandi').val();
        var ngaysinh=$('#txtngaysinh').val();
        if ($.trim(ngaysinh) == '') {
            $($('#txtngaysinh')).attr('data-original-title', 'Nhập ngày sinh').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#txtngaysinh').data("title", "").removeClass("errorClass").tooltip("destroy");;
        } 
            var gioitinh=$('#candisex').val();
        if($.trim(gioitinh)=='0'){
            $('#candisex').addClass('errorClass');
        }else{
            $('#candisex').removeClass('errorClass');
        }
            var honnhan=$('#candimarriage').val();
        if($.trim(honnhan)=='0'){
            $('#candimarriage').addClass('errorClass');
        }else{
            $('#candimarriage').removeClass('errorClass');
        }
            var cvtitle=$('#jobwish').val();
            var bangcap=$('#candibangcap').val();
        if($.trim(bangcap)=='0'){
            $('#candibangcap').addClass('errorClass');
        }else{
            $('#candibangcap').removeClass('errorClass');
        }
            var hinhthuclamviec=$('#candihtlv').val();
        if($.trim(hinhthuclamviec)=='0'){
            $('#candihtlv').addClass('errorClass');
        }else{
            $('#candihtlv').removeClass('errorClass');
        }
            var capbac=$('#candicapbac').val();
        if($.trim(capbac)=='0'){
            $('#candicapbac').addClass('errorClass');
        }else{
            $('#candicapbac').removeClass('errorClass');
        }
            var nganhnghe=$('#candicategory').val();
        if($.trim(nganhnghe)=='0'){
            $('#candicategory').addClass('errorClass');
        }else{
            $('#candicategory').removeClass('errorClass');
        }
            var muctieu=$('#canditarget').val();
        if ($.trim(muctieu) == '') {
            $($('#canditarget')).attr('data-original-title', 'Nhập mục tiêu').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#canditarget').data("title", "").removeClass("errorClass").tooltip("destroy");;
        } 
            var kynang=$('#candiskill').val();
        if ($.trim(kynang) == '') {
            $($('#candiskill')).attr('data-original-title', 'Nhập kỹ năng').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#candiskill').data("title", "").removeClass("errorClass").tooltip("destroy");;
        } 
        if ($.trim(hoten) == '') {
            $($('#namecandi')).attr('data-original-title', 'Nhập họ tên').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#namecandi').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(phone) == '') {
            $($('#phonecandi')).attr('data-original-title', 'Nhập số điện thoại').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#phonecandi').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(email) == '') {
            $($('#emailcandi')).attr('data-original-title', 'Nhập địa chỉ email').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#emailcandi').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(email) != '') {
            if (!Common.IsValidEmail(email)) {
                $($('#emailcandi')).attr('data-original-title', 'Email không hợp lệ').tooltip('show').addClass('errorClass');
                flag = false;
            } else {
                $('#emailcandi').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }
if ($.trim(pass) == '') {
            $($('#passcandi')).attr('data-original-title', 'Nhập mật khẩu').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#passcandi').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }
        if (checkPassword(pass, $('#passcandi')) == 1) {
            flag = false;
        }
        if (checkPassword(repass, $('#repasscandi')) == 1) {
            flag = false;
        }

        if (checkPassword(pass, $('#repasscandi')) == 0 && pass != repass) {
            $($('#passcandi')).attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('show').addClass('errorClass');
            flag = false;
        }

        if ($.trim(term) != 'ok') {
            $('#user-terms').addClass('errorClass');
            flag = false;
        } else {
            
        }
        if(city =='0'){
            flag = false;
            
        }
        return flag;
    };
    self.validatecomregister = function () {
        var flag = true;

        var hoten = $('#namecompany').val();
        var phone = $("#phonecompany").val();
        var email = $("#usercompany").val();
        var pass = $("#passcompany").val();
        var repass = $("#repasscompany").val();
        var term = $('input[name=company-terms]:checked').val();
        var city=$('#citycompany').val();
        var website=$('#websitecompany').val();
        var addresscom=$('#addresscompany').val();
        
        if ($.trim(addresscom) == '') {
            $($('#addresscompany')).attr('data-original-title', 'Nhập địa chỉ Công ty').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#addresscompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }
        if ($.trim(hoten) == '') {
            $($('#namecompany')).attr('data-original-title', 'Nhập tên công ty').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#namecompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(phone) == '') {
            $($('#phonecompany')).attr('data-original-title', 'Nhập số điện thoại').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#phonecompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(email) == '') {
            $($('#usercompany')).attr('data-original-title', 'Nhập địa chỉ email').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#usercompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }

        if ($.trim(email) != '') {
            if (!Common.IsValidEmail(email)) {
                $($('#usercompany')).attr('data-original-title', 'Email không hợp lệ').tooltip('show').addClass('errorClass');
                flag = false;
            } else {
                $('#usercompany').data("title", "").removeClass("errorClass").tooltip("destroy");
            }
        }
if ($.trim(pass) == '') {
            $($('#passcompany')).attr('data-original-title', 'Nhập mật khẩu').tooltip('show').addClass('errorClass');
            flag = false;
        } else {
            $('#passcompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }
        if (checkPassword(pass, $('#passcompany')) == 1) {
            flag = false;
        }
        if (checkPassword(repass, $('#repasscompany')) == 1) {
            flag = false;
        }

        if (checkPassword(pass, $('#repasscompany')) == 0 && pass != repass) {
            $($('#passcompany')).attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('show').addClass('errorClass');
            flag = false;
        }

        if ($.trim(term) != 'ok') {
            $('.checkboxcom').addClass('errorClass');
            flag = false;
        } else {
            $('.checkboxcom').removeClass('errorClass');
        }
        if(city =='0'){
            $($('#citycompany')).attr('title', 'Chọn tỉnh thành').tooltip('show').addClass('errorClass');
            flag = false;
            
        }else{
            $('#citycompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
        }
        return flag;
    };
}
function checkPassword(pwd, element) {
    var Hoa = 0;
    var Thuong = 0;
    var So = 0;

    if (pwd.length < 6) {
        $(element).attr('title', 'Mật khẩu phải nhiều hơn hoặc có 6 ký tự').tooltip('show').addClass('errorClass');
        return 1;
    }
    //for (i = 0; i < pwd.length; i++) {
    //    a = toAscii(pwd.charAt(i));
    //    if (a >= 65 && a <= 90) {
    //        Hoa = 1;
    //    }
    //    if (a >= 97 && a <= 122) {
    //        Thuong = 1;
    //    }
    //    if (a >= 48 && a <= 57) {
    //        So = 1;
    //    }
    //}
    //if (Hoa == 0) {
    //    $(element).tooltip('hide').attr('title', 'Mật khẩu phải gồm cả ký tự viết hoa').tooltip('fixTitle').addClass('errorClass');
    //    return 1;
    //}
    //else if (Thuong == 0) {
    //    $(element).tooltip('hide').attr('title', 'Mật khẩu phải gồm cả ký tự viết thường').tooltip('fixTitle').addClass('errorClass');
    //    return 1;
    //}
    //else if (So == 0) {
    //    $(element).tooltip('hide').attr('title', 'Mật khẩu phải gồm cả số').tooltip('fixTitle').addClass('errorClass');
    //    return 1;
    //}
    $(element).data("title", "").removeClass("errorClass").tooltip("destroy");
    return 0;

}
function SearchJob()
{
    $('.timvieclam').on('click',function(){
        var findkey=$('#findkeyjob').val();
        var location=$('#index_dia_diem').val();
        var nganhnghe=$('#index_nganhnghe').val();
        
        $.ajax(
              {
                  
                  url: configulr+"/site/searchjob",
                  type: "POST",
                  data: { findkey: findkey, location: location,nganhnghe:nganhnghe,type:1 },
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
    })
    //searchcompany
    $('.timdoanhnghiep').on('click',function(){
        var findkey=$('#keyworkcom').val();
        if(findkey !=''){
            $.ajax(
              {
                  
                  url: configulr+"/site/searchcompany",
                  type: "POST",
                  data: { findkey: findkey},
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
            $('#keyworkcom').addClass('errClass').focus();
        }
    });
    //searchcandi
    $('.timungvien').on('click',function(){
         var findkey=$('#findkeycandi').val();
        var location=$('#candilocation').val();
        var nganhnghe=$('#candinganhnghe').val();
        
        $.ajax(
              {
                  
                  url: configulr+"/site/searchcandi",
                  type: "POST",
                  data: { findkey: findkey, location: location,nganhnghe:nganhnghe },
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
    })
}
function AllClearCooke()
{
    $('#xoacookie').on('click',function(){
         $.ajax(
              {
                  
                  url: configulr+"/site/delcookiephp",
                  type: "POST",
                  data: {  },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          window.location=window.location.href;
                      }
                      
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              }); 
    })
}
