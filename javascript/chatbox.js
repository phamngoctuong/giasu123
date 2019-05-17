//bắt đầu xử lí gửi-nhận tin nhắn.

if(userid!=''){
  var socket = io("192.168.0.107:6969"); //lưu ý về địa chỉ này.

  function clickuser(id,iddoitac,room){
    if(userid==id && userid!=''){
      socket.emit("Client-join-room",{userpartner:id,user:iddoitac,room:room});
      var name=$('div[id='+iddoitac+']').text();
      $("#name-teacher-here").text(name);
    }
  }
  function pickicon(iconID){
    var text= $.trim($("#text-chat").val()+':'+iconID+':');
    $("#text-chat").val(text);
    $(".icon-box").hide();
  }
}

$(document).ready(function(){
  $("#text-chat").keypress(function(event){
    var test=$('#text-chat').val();
    $('#text-chat').text("");
    $('#text-chat').append(test);
  });
  var listuser=[];
  var connect='';
  if(userid!=''){
    var hienthi='';
    // socket.on("connect",()=>{ //kiểm tra kết nối tới server.
    //   connect =  socket.connected;
    //   // alert(socket.disconnected);
    // });
    socket.emit("Client-send-register",{userid:userid,username:name});
    socket.on("Server-send-list-user",function(data){
      if(data!=''){
        data.forEach(function(i){
          $(".listuser").append(i);
        });
        listuser=data;
      }
    });

    socket.on("Server-send-history-chat",function(datahistory){
      $("#hienthi-messenger div").remove();
      datahistory.forEach(function(i){
        $("#hienthi-messenger").append(i);
      });
      $('div[wtf-id='+userid+']').removeClass();
      $('div[wtf-id='+userid+']').addClass('this-user');
      var lastline= $("#hienthi-messenger").height();
      $('.messenger').scrollTop(lastline);
    });

    socket.on("Server-send-messenger",function(data){ //hiển thị dữ liệu được gửi xuống từ server.
      if(data.id==userid){
        var hienthi = '<div  class="this-user"><span>'+data.text+'</span></div>';
      }else{
        var hienthi = '<div class="that-user"><span>'+data.text+'</span></div>';
      }
      $("#hienthi-messenger").append(hienthi);
      $("#hienthi-messenger").append(data.emojitest);
    });

    socket.on("Server-send-new-user-chat",function(data){
      $(".listuser div").remove();
      if($.trim($(".listuser").text())=='Bạn chưa có tin nhắn với ai cả!'){
        listuser.push(data);
      }else{
        listuser.unshift(data);
      }
      $(".listuser").append(listuser);

    });

    socket.on("Server-send-inbox-waiting",function(data){
      $(".listuser div").remove();
      var userwaiting='';
      if($.trim(data)!=''){
        data.forEach(function(i){
          var useri= '<div onclick="clickuser(`'+userid+'`,`'+i.user+'`,`'+i.room+'`)" id="'+i.user+'" >'+i.name+'</div>';
            $(".listuser").append(useri);
        });
      }else{
        userwaiting='<div><h4>Không có tin nhắn đang đợi nào</h4></div>';
        $(".listuser").append(userwaiting);
      }
    });

    socket.on("Server-send-all-user-chat",function(data){
      $(".listuser div").remove();
      var nonedata='<div><h4>Bạn chưa có tin nhắn với ai cả!</h4></div>';
      if(data!=''){
        data.forEach(function(i){
          $(".listuser").append(i);
        });
      }else{
        $(".listuser").append(nonedata);
      }

    });

    socket.on("Server-send-emoji",function(data){
      for(var key in data){
        var icon='<div onclick="pickicon(`'+key+'`)" >'+data[key]+'</div>';

        $(".icon-box").append(icon);
        $("#text-chat").show();
      }
    });
    $('#emoji').click(function(){
      $(".icon-box").show();
    });

    $("#text-chat").keypress(function(event){
      keycode = (event.keyCode ? event.keyCode : event.which);
      if(event.keyCode=='13' && !event.shiftKey){
        var chattext = $('#text-chat').val();
        var alltext=document.getElementById("hienthi-messenger").innerText;
        if($.trim(chattext)!=''){
          if($.trim(alltext) === ''){
            socket.emit("Client-send-new-user-chat",{iddoitac:userid2,namedoitac:namedoitac});
          }
          socket.emit("Client-send-messenger",chattext);
        }
        var lastline= $("#hienthi-messenger").height();
        $('.messenger').scrollTop(lastline);
        $("#text-chat").val('');
        return false;
      }
    });

    $("#send-messenger").click(function(){
      var chattext = $('#text-chat').val();
      var alltext=document.getElementById("hienthi-messenger").innerText;
      if(chattext!=''){
        if(alltext === ''){
          socket.emit("Client-send-new-user-chat",{iddoitac:userid2,namedoitac:namedoitac});
        }
        socket.emit("Client-send-messenger",chattext);
      }
      var lastline= $("#hienthi-messenger").height();
      $('.messenger').scrollTop(lastline);
      $("#text-chat").val('');
    });

    $("#all-chat").click(function(){
      socket.emit("Client-get-all-user-chat");
    });

    $("#inbox-waitting").click(function(){
      socket.emit("Client-get-inbox-waiting");
    });

  }
  $('.sendmessenger').click(function(){
    if(userid!=''){
      socket.emit("Client-send-room",{iddoitac1:userid,iddoitac2:userid2,name2:namedoitac});
      $('#name-teacher-here').text("");
      $('#name-teacher-here').text(namedoitac);
      $(".chatbox-icon-vieclam123").hide(200);
      $("#chatbox").show(500);
      $("#messenger-facebook").css("bottom","540px");
      $("#skypefix").css("bottom","470px");
    }else{
      alert('Bạn phải đăng nhập để có thể nhắn tin')
    }
  });
});
