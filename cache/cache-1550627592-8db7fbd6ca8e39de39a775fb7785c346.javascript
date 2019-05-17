

﻿/*************************************


All custom js files contents are below
**************************************
* 01. Company Brand Carousel
* 02. Client Story testimonial
* 03. Bootstrap wysihtml5 editor
* 04. Tab Js
* 05. Add field Script
**************************************/
var configulr='https://vieclam123.vn';
(function($){
"use strict";
var um=new UserManager();	
	//$(".Loader").fakeLoader({
//		timeToHide:200,
//		bgColor:"#1c2733",
//		spinner:"spinner2"
//	});	 
	 jQuery('#box-contact .more').click(function() {
		if($(this).hasClass('open')){
			$(this).removeClass('open');
			$("#box-contact .gt").css('height','72px');			
		}else{
			$(this).addClass('open');
			$("#box-contact .gt").css('height','auto');
		}
	});
	
	$('#choose-city').select2();
	$("#simple-design-tab a").on('click', function(e){
		e.preventDefault();
		$(this).tab('show');
	});
	$('.extra-field-box').each(function() {
    var $wrapp = $('.multi-box', this);
    $(".add-field", $(this)).on('click', function() {
        $('.dublicat-box:first-child', $wrapp).clone(true).appendTo($wrapp).find('input').val('').focus();
    });
    $('.dublicat-box .remove-field', $wrapp).on('click', function() {
        if ($('.dublicat-box', $wrapp).length > 1)
            $(this).parent('.dublicat-box').remove();
		});
	});
		var a = $(".bg");
		a.each(function (a) {
			if ($(this).attr("data-bg")) $(this).css("background-image", "url(" + $(this).data("bg") + ")");
		});
		

    function csselem() {
        $(".slideshow-container .slideshow-item").css({
            height: $(".slideshow-container").outerHeight(true)
        });
        $(".slider-container .slider-item").css({
            height: $(".slider-container").outerHeight(true)
        });
    }
    csselem();
    /*if($('.col-popover').size() && window.innerWidth >= 1000){ 
    var timer,timer2;
    var check = 0;
    $('.col-popover .item_hd').each(function(index, element){
        $(this).popover({ 
            trigger: "manual" , 
            html: true, 
            animation:false,
            placement:function(tip,element){
            	var left = $(element).offset().left;
            	var windowWidth = $(window).width();
            	if(left < windowWidth/2){
            		return 'right';
            	}else{
            		return 'left';
            	}
            },
            content: function() {
              return "Loading...";
            }
          })
          .on("mouseenter", function () {
                clearTimeout(timer);
                var _this = this;
                 $('.col-popover .item_hd', $(this));
                var object_id=$(this).attr('data-object');
             	  $('.col-popover .item_hd', $(this));
                  var object_type =$(this).attr('data-type');                
                $('.col-md-4 .item_hd').not(_this).popover('hide');
                var left = $(this).offset().left;
                var windowWidth = $(window).width();
                var width = this.offsetWidth;
                var position = 0;
                var arrow = "";
                if(left < windowWidth/2){
                	position = -0;//-10
                	arrow = "left-arrow";
                }else{
                	position = -295;//215;
                	arrow = "right-arrow";
                }
                var height =0;// this.offsetHeight/2;
                timer2 = setTimeout(function(){

                  if($(_this).is(':hover'))
                  {		
                  	$.ajax({
	                  url: configulr+'/site/quickviewuser',
	                  type: "POST",
                      data: {objid: object_id },
                      dataType: 'json',
	                  success: function(data) {
	                  	$(".popover-content").empty();
	                  	$(".popover-content").append(data.data);	                    
	                    $('#quick-view-box .tooltiptext').addClass(arrow);
	                    $('#quick-view-box').css('top', -height);
	                    $('#quick-view-box').css('left', position);	                    
	                  }
	                });       
                      $(_this).popover("show");
                  }
                  $(".popover").on("mouseleave", function () {
                      $('.col-md-4 .item_hd').popover('hide');
                  });
                  }, 500);
                // $(".popover").on("mouseleave", function () {
                //     $(_this).popover('hide');
                // });
                  
            
          }).on("mouseleave", function () {
              clearTimeout(timer2);
              var _this = this;
              setTimeout(function () {
                  if (!$(".popover:hover").length) {
                      $(_this).popover("hide");
                  }
              }, 200);
      });
    }); 
  }; */
     var inputs = document.querySelectorAll( '.inputfile' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				label.querySelector( 'span' ).innerHTML = fileName;
			else
				label.innerHTML = labelVal;
		});

		input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
		input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
	});		
	})(jQuery);
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
    $(".login_user").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
            if ($('#useremail').val() == '') {
                $('#useremail').focus();
            }
            else if ($('#userpassword').val() == '' && $('#useremail').val() != '') {
                $('#userpassword').focus();
            }
            else if ($('#userpassword').val() != '' && $('#useremail').val() != '') {
                if(typeof($('#phuhuynhlogin').text())!=='undefined'){
                    $('#phuhuynhlogin').focus();
                $('#phuhuynhlogin').trigger('click');
                }
                $('#dangnhapgiasu').focus();
                $('#dangnhapgiasu').trigger('click');
                
            }
        }
    });
    
    var self = this;
    $('#btndangnhap').on('click',function(){
        $.ajax(
              {
                  
                  url: configulr+"/site/loginuser",
                  type: "POST",
                  data: { username: $('#username').val(), password: $('#password').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
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
    $('#ungvienlogin').on('click',function(){
        $.ajax(
              {
                  
                  url: configulr+"/site/logincandidate",
                  type: "POST",
                  data: { username: $('#useremail').val(), password: $('#userpassword').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
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
    $('#dangnhapgiasu').on('click',function(){
        var cknhatuyendung=1;
        if(typeof ($('input[name=rememberlogin]:checked').val())=== "undefined"){
            cknhatuyendung=0;
        }
       $.ajax(
              {
                  
                  url: configulr+"/site/loginteacher",
                  type: "POST",
                  data: { username: $('#useremail').val(), password: $('#userpassword').val(),typelogin:cknhatuyendung },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
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
    $('#phuhuynhlogin').on('click',function(){
        var cknhatuyendung=1;
        if(typeof ($('input[name=rememberlogin]:checked').val())=== "undefined"){
            cknhatuyendung=0;
        }
       $.ajax(
              {                  
                  url: configulr+"/site/loginusers",
                  type: "POST",
                  data: { username: $('#useremail').val(), password: $('#userpassword').val(),typelogin:cknhatuyendung },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
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
     $('#laylaimk').on('click',function(){
        $('#myModal').modal('show');
    });
    $('#btnusersforgot').on('click',function(){
        if($('#emailuser').val()!=''){
            $.ajax(
              {
                  
                  url: configulr+"/site/ajaxgetforgotpassword",
                  type: "POST",
                  data: { username: $('#emailuser').val(),trangthai:$('input[name=radio-group]:checked').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        alert(reponse.data);
                        window.location.href=configulr+'/lay-lai-mat-khau&u='+reponse.unam;//configulr+'/lay-lai-mk-thanh-cong';                          
                      }
                      else {
                         alert('tài khoản không tồn tại') ;
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
            $('#emailuser').addClass('errorClass')
        }
    });
    $('#btn_teacherforgot').on('click',function(){
        if($('#emailuser').val()!=''){
            $.ajax(
              {                  
                  url: configulr+"/site/ajaxgetforgotpassword",
                  type: "POST",
                  data: { username: $('#emailuser').val(),trangthai:$('input[name=radio-group]:checked').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        alert(reponse.data);
                        window.location.href=configulr+'/lay-lai-mat-khau&u='+reponse.unam;//window.location.href=configulr;                          
                      }
                      else {
                         alert('tài khoản không tồn tại') ;
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
            $('#emailuser').addClass('errorClass')
        }
    });
    $('#btnconfirmpass').on('click',function(){
        if($('#emailuser').val()!=''){
             $.ajax(
              {                  
                  url: configulr+"/site/ajaxconfirmpass",
                  type: "POST",
                  data: { code: $('#emailuser').val(),usp:$('#usp').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        alert('mật khẩu mới của quý khách là: '+reponse.mk);
                        window.location.href=configulr;                          
                      }
                      else {
                         alert('Đổi mật khẩu thất bại') ;
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
    })
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
        
    });
    $('.btnlogout').on('click',function(){
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
        
    });
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
                     var strhtml='<option value="">Chọn quận huyện</option>';
                     if(obj.kq != ''){
                        var reponse=obj.kq;
                        $("#districtcandi option").remove();
                        var o1 = new Option('Chọn quận huyện', '');
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
                            //alert('không t?n t?i');
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
            var sendsms=0;
            if(typeof($('input[id=sendsms]:checked').val())!=='undefined'){
                sendsms=$('input[id=sendsms]:checked').val();
            }
            $.ajax(
              {
                  
                  url: configulr+"/site/registercandi",
                  type: "POST",
                  data: { 
                        hoten: hoten, 
                        phone: email,
                        email:phone,
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
                        languagecandi:languagecandi,
                        sms:sendsms
                        },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        alert('Bạn đã đăng ký thành công, vui lòng check email để xác nhận tài khoản, mã xác nhận được đọc qua cuộc gọi tới số điện thoại của bạn');
                        var urlredirect=configulr+"/kichhoattaikhoan&c="+reponse.code+"&u="+reponse.uname;
                          window.location.href = urlredirect;                               
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
        var sendsms=0;
            if(typeof($('input[id=sendsms]:checked').val())!=='undefined'){
                sendsms=$('input[id=sendsms]:checked').val();
            }
        if(self.validatecomregister()){
            $.ajax(
              {                  
                  url: configulr+"/site/registercompany",
                  type: "POST",
                  data: { tencongty: hoten, phone: phone,email:email,city:city,pass:pass,website:website,addresscom:addresscom,sms:sendsms },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                        alert('Bạn đã đăng ký thành công, vui lòng check email để xác nhận tài khoản, mã xác nhận được đọc qua cuộc gọi tới số điện thoại của bạn');
                        var urlredirect=configulr+"/kichhoattaikhoan&c="+reponse.code+"&u="+reponse.uname;
                          window.location.href = urlredirect;
                          //window.location = configulr;
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
        var email = $("#phonecandi").val();
        var pass = $("#passcandi").val();
        var repass = $("#repasscandi").val();
        var term = $('input[name=user-terms]:checked').val();
        var city=$('#citycandi').val();
        var ngaysinh=$('#txtngaysinh').val();
        /*if ($.trim(ngaysinh) == '') {
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
*/
        //if ($.trim(email) != '') {
//            if (!Common.IsValidEmail(email)) {
//                $($('#emailcandi')).attr('data-original-title', 'Email không hợp lệ').tooltip('show').addClass('errorClass');
//                flag = false;
//            } else {
//                $('#emailcandi').data("title", "").removeClass("errorClass").tooltip("destroy");
//            }
//        }
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
        /*if(city =='0'){
            flag = false;
            
        }*/
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
            $($('#addresscompany')).attr('data-original-title', 'Nhập địa chỉ công ty').tooltip('show').addClass('errorClass');
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

        //if ($.trim(email) != '') {
//            if (!Common.IsValidEmail(email)) {
//                $($('#usercompany')).attr('data-original-title', 'Email không hợp lệ').tooltip('show').addClass('errorClass');
//                flag = false;
//            } else {
//                $('#usercompany').data("title", "").removeClass("errorClass").tooltip("destroy");
//            }
//        }
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
    //    $(element).tooltip('hide').attr('title', 'M?t kh?u ph?i g?m c? ký t? vi?t hoa').tooltip('fixTitle').addClass('errorClass');
    //    return 1;
    //}
    //else if (Thuong == 0) {
    //    $(element).tooltip('hide').attr('title', 'M?t kh?u ph?i g?m c? ký t? vi?t thu?ng').tooltip('fixTitle').addClass('errorClass');
    //    return 1;
    //}
    //else if (So == 0) {
    //    $(element).tooltip('hide').attr('title', 'M?t kh?u ph?i g?m c? s?').tooltip('fixTitle').addClass('errorClass');
    //    return 1;
    //}
    $(element).data("title", "").removeClass("errorClass").tooltip("destroy");
    return 0;

}
function SearchJob()
{
   // $('.timvieclam').on('click',function(){
//        var findkey=$('#findkeyjob').val();
//        var location=$('#index_dia_diem').val();
//        var nganhnghe=$('#index_nganhnghe').val();
//        
//        $.ajax(
//              {
//                  
//                  url: configulr+"/site/searchjob",
//                  type: "POST",
//                  data: { findkey: findkey, location: location,nganhnghe:nganhnghe,type:1 },
//                  dataType: 'json',
//                  beforeSend: function () {
//                      $("#boxLoading").show();
//                  },
//                  success: function (reponse) {
//                      if (reponse.kq == true) {
//                          window.location=reponse.data;
//                      }
//                      
//                  },
//                  error: function (xhr) {
//                      alert("error");
//                  },
//                  complete: function () {
//                      $("#boxLoading").hide();
//                  }
//              }); 
//    })
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