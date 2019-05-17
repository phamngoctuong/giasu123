function homeestimatesalary()
{
    var self=this;
    $('#btnuocluong').on('click',function(){
        window.location = '/ssl/nhap-uoc-tinh-luong';
    })
    $('#btnuoctinhluong').on('click',function(){
        window.location = '/ssl/nhap-uoc-tinh-luong';
    })
    $.ajax(
              {
                  
                  url: "/ssl/site/GetListEstimateSalaryByProvince",
                  type: "POST",
                  data: { province: $('#txtfinKeyprovince').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (result) {
                     var strhtml='';
                      for (var i = 0; i < result.length; i++) {
                        strhtml+="<div class='itemcity'><div class='imgcity'><img alt='"+result[i].tentp+"' src='images/province/province"+result[i].idtp+".jpg'/></div>";
                        strhtml+="<div class='infocity'><a class='namejob' href='"+result[i].urlprovince+"'>"+result[i].tentp+"</a><span class='catcom'> Số lượng việc làm("+result[i].soluong+")</span></div>";             
                        strhtml+="<div class='moreinfo'><span class='moneycom'><i class='glyphicon glyphicon-usd'></i> "+result[i].trungbinh+" /Tháng</span>"                
                        strhtml+="</div></div>";
                        }
                        //$("#homelistjob").html=''
                        document.getElementById('listitemcity').innerHTML=strhtml;
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
     $("#txtfinKeyprovince").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $.ajax(
              {
                  
                  url: "/ssl/site/GetListEstimateSalaryByProvince",
                  type: "POST",
                  data: { province: $('#txtfinKeyprovince').val() },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (result) {
                     var strhtml='';
                      for (var i = 0; i < result.length; i++) {
                        strhtml+="<div class='itemcity'><div class='imgcity'><img alt='"+result[i].tentp+"' src='images/province/province"+result[i].idtp+".jpg'/></div>";
                        strhtml+="<div class='infocity'><a class='namejob' href='"+result[i].urlprovince+"'>"+result[i].tentp+"</a><span class='catcom'>Số lượng việc làm("+result[i].soluong+")</span></div>";             
                        strhtml+="<div class='moreinfo'><span class='moneycom'><i class='glyphicon glyphicon-usd'></i> "+result[i].trungbinh+" /Tháng</span>"                
                        strhtml+="</div></div>";
                        }
                        //$("#homelistjob").html=''
                        document.getElementById('listitemcity').innerHTML=strhtml;
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
    // load theo tinh thanh
    $.ajax(
              {
                  
                  url: "/ssl/site/GetListaverageSalarybyCompany",
                  type: "POST",
                  data: { findkey: $('#txtfinKeycompaney').val(),page:1 },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {
                    var result=obj.data;
                    if(result.length > 0){
                     var strhtml='';
                      for (var i = 0; i < result.length; i++) {
                        strhtml+="<div class='itemjob'><div class='imgjob'><img alt='"+result[i].tencp+"' src='https://timviec365.vn/images/no-image.png' /></div>";
                        strhtml+="<div class='infojob'><a class='namejob' href='"+result[i].urlcompany+"'><i class='fa fa-building-o'></i>"+result[i].tencp+"</a>";
                        strhtml+="<div class='companyjob'><span class='addjob'><i class='fa fa-map-marker'></i> "+result[i].diachi+"</span></div>";        
                        strhtml+="<div class='countjob'><a href='"+result[i].urlcompany+"'>Tin nhà tuyển dụng("+result[i].soluong+")</a></div></div>";             
                        strhtml+="<div class='jobmoney'><span class='money'><i class='glyphicon glyphicon-usd'></i> "+result[i].trungbinh+" /Tháng</span></div></div>";        
                        
                        }
                        //$("#homelistjob").html=''
                        document.getElementById('ulbycompany').innerHTML=strhtml;
                        }
                        
                            $('#pagination-demo').twbsPagination({
                                totalPages: obj.totalpage,
                                visiblePages: 5,
                                startPage: 1,
                                first: '',
                                prev: 'Trước',
                                next: 'Sau',
                                last: '',
                                onPageClick: function (event, page) {
                                    event.preventDefault();
                                    self.loadsearch($('#txtfinKeycompaney').val(),page);
                                }
                            });
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
    $("#txtfinKeycompaney").keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $.ajax(
              {
                  
                  url: "/ssl/site/GetListaverageSalarybyCompany",
                  type: "POST",
                  data: { findkey: $('#txtfinKeycompaney').val(),page:1},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {
                    var result=obj.data;
                     if(result.length > 0){
                     var strhtml='';
                      for (var i = 0; i < result.length; i++) {
                        strhtml+="<div class='itemjob'><div class='imgjob'><img alt='"+result[i].tencp+"' src='https://timviec365.vn/images/no-image.png' /></div>";
                        strhtml+="<div class='infojob'><a class='namejob' href='"+result[i].urlcompany+"'><i class='fa fa-building-o'></i>"+result[i].tencp+"</a>";
                        strhtml+="<div class='companyjob'><span class='addjob'><i class='fa fa-map-marker'></i> "+result[i].diachi+"</span></div>";        
                        strhtml+="<div class='countjob'><a href='"+result[i].urlcompany+"'>Tin nhà tuyển dụng("+result[i].soluong+")</a></div></div>";             
                        strhtml+="<div class='jobmoney'><span class='money'><i class='glyphicon glyphicon-usd'></i> "+result[i].trungbinh+" /Tháng</span></div></div>";        
                        
                        }
                        document.getElementById('ulbycompany').innerHTML=strhtml;
                      } 
                      
                      $('#pagination-demo').twbsPagination({
                                totalPages: obj.totalpage,
                                visiblePages: 5,
                                startPage: 1,
                                first: '',
                                prev: 'Trước',
                                next: 'Sau',
                                last: '',
                                onPageClick: function (event, page) {
                                    event.preventDefault();
                                    self.loadsearch($('#txtfinKeycompaney').val(),page);
                                }
                            });  
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
    self.loadsearch=function(keywork,page)
    {
        $.ajax(
              {
                  
                  url: "/ssl/site/GetListaverageSalarybyCompany",
                  type: "POST",
                  data: { findkey: keywork,page:page},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {
                    var result=obj.data;
                     if(result.length > 0){
                     var strhtml='';
                      for (var i = 0; i < result.length; i++) {
                        strhtml+="<div class='itemjob'><div class='imgjob'><img alt='"+result[i].tencp+"' src='https://timviec365.vn/images/no-image.png' /></div>";
                        strhtml+="<div class='infojob'><a class='namejob' href='"+result[i].urlcompany+"'><i class='fa fa-building-o'></i>"+result[i].tencp+"</a>";
                        strhtml+="<div class='companyjob'><span class='addjob'><i class='fa fa-map-marker'></i> "+result[i].diachi+"</span></div>";        
                        strhtml+="<div class='countjob'><a href='"+result[i].urlcompany+"'>Tin nhà tuyển dụng("+result[i].soluong+")</a></div></div>";             
                        strhtml+="<div class='jobmoney'><span class='money'><i class='glyphicon glyphicon-usd'></i> "+result[i].trungbinh+" /Tháng</span></div></div>";        
                        
                        }
                        document.getElementById('ulbycompany').innerHTML=strhtml;
                      } 
                      
                     
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                  }
              });
    }; 
    
    // end load theo tinh thanh
}