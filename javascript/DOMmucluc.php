<script type="text/javascript">
$(document).ready(function(){
  //xử lí mục lục
    var urlHref= "<?=str_replace(base_url(),'',current_url());?>";
    var mucluc= document.getElementById("muc-luc-content-thu");
    var input1= document.getElementById("content-thu");
    var input2=input1.getElementsByTagName("*");
    if(input2.length>0){
      var tieudemucluc=document.getElementById("tieudemucluc");
      var strong= document.createElement("strong");
      strong.innerHTML="mục lục bài viết";
      // tieudemucluc.style.textAlign= "center";
      tieudemucluc.appendChild(strong);
    }

    for(i=0;i<input2.length;i++){
      if(input2[i].tagName=='H1' ||input2[i].tagName=='H2'||input2[i].tagName=='H3'||input2[i].tagName=='H4'||input2[i].tagName=='H5'||input2[i].tagName=='H6'){
        // alert(input2[a].tagName);

        mucluc.style.minHeight="100px";
        mucluc.style.width="500px";
        mucluc.style.background="#dce1ea";
        mucluc.style.marginTop="20px";


        if(input2[i].tagName=='H1'){
          input2[i].setAttribute("class", "H1abc"); //set class phục vụ cho css.
          input2[i].setAttribute("id", "H1abc"+i); //set id cho thẻ.
          var li=document.createElement("div"); //tạo biến chứa thẻ li.
          var href=document.createElement("a");// tạo biến chứa thẻ a.

          href.href=urlHref+"#H1abc"+i;
          href.innerHTML=input2[i].innerHTML; //ghi text vào trong đoạn thẻ li.
          li.appendChild(href);
          mucluc.appendChild(li);

        }
        if(input2[i].tagName=='H2'){
          input2[i].setAttribute("class", "H2abc"); //set class phục vụ cho css.
          input2[i].setAttribute("id", "H2abc"+i); //set id cho thẻ.
          var li=document.createElement("div"); //tạo biến chứa thẻ li.
          var href=document.createElement("a");// tạo biến chứa thẻ a.
          li.style.marginLeft="5px";
          href.href=urlHref+"#H2abc"+i;
          href.innerHTML=input2[i].innerHTML; //ghi text vào trong đoạn thẻ li.
          li.appendChild(href);
          mucluc.appendChild(li);
          input2[i].style.marginLeft="20px";
        }
        if(input2[i].tagName=='H3'){
          input2[i].setAttribute("class", "H3abc"); //set class phục vụ cho css.
          input2[i].setAttribute("id", "H3abc"+i); //set id cho thẻ.
          var li=document.createElement("div"); //tạo biến chứa thẻ li.
          var href=document.createElement("a");// tạo biến chứa thẻ a.
          li.style.marginLeft="9px";
          href.href=urlHref+"#H3abc"+i;
          href.innerHTML=input2[i].innerHTML; //ghi text vào trong đoạn thẻ li.
          li.appendChild(href);
          mucluc.appendChild(li);
        }
        if(input2[i].tagName=='H4'){
          input2[i].setAttribute("class", "H4abc"); //set class phục vụ cho css.
          input2[i].setAttribute("id", "H4abc"+i); //set id cho thẻ.
          var li=document.createElement("div"); //tạo biến chứa thẻ li.
          var href=document.createElement("a");// tạo biến chứa thẻ a.
          li.style.marginLeft="13px";
          href.href=urlHref+"#H4abc"+i;
          href.innerHTML=input2[i].innerHTML; //ghi text vào trong đoạn thẻ li.
          li.appendChild(href);
          mucluc.appendChild(li);
        }
        if(input2[i].tagName=='H5'){
          input2[i].setAttribute("class", "H5abc"); //set class phục vụ cho css.
          input2[i].setAttribute("id", "H5abc"+i); //set id cho thẻ.
          var li=document.createElement("div"); //tạo biến chứa thẻ li.
          var href=document.createElement("a");// tạo biến chứa thẻ a.
          li.style.marginLeft="17px";
          href.href=urlHref+"#H5abc"+i;
          href.innerHTML=input2[i].innerHTML; //ghi text vào trong đoạn thẻ li.
          li.appendChild(href);
          mucluc.appendChild(li);
        }
        if(input2[i].tagName=='H6'){
          input2[i].setAttribute("class", "H6abc"); //set class phục vụ cho css.
          input2[i].setAttribute("id", "H6abc"+i); //set id cho thẻ.
          var li=document.createElement("div"); //tạo biến chứa thẻ li.
          var href=document.createElement("a");// tạo biến chứa thẻ a.
          li.style.marginLeft="21px";
          href.href=urlHref+"#H6abc"+i;
          href.innerHTML=input2[i].innerHTML; //ghi text vào trong đoạn thẻ li.
          li.appendChild(href);
          mucluc.appendChild(li);
        }

      }

    }

  //kết thúc xử lí mục lục.
});

</script>
